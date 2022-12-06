<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class VasValidationEdit extends VasValidation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'vas_validation';

    // Page object name
    public $PageObjName = "VasValidationEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (vas_validation)
        if (!isset($GLOBALS["vas_validation"]) || get_class($GLOBALS["vas_validation"]) == PROJECT_NAMESPACE . "vas_validation") {
            $GLOBALS["vas_validation"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'vas_validation');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("vas_validation");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "vasvalidationview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->order->setVisibility();
        $this->po->setVisibility();
        $this->sap_art->setVisibility();
        $this->sub_index->setVisibility();
        $this->concept->setVisibility();
        $this->ctn->setVisibility();
        $this->season2->setVisibility();
        $this->qty_oss->setVisibility();
        $this->shipment->setVisibility();
        $this->aju->setVisibility();
        $this->actual_price->setVisibility();
        $this->price_foto->setVisibility();
        $this->snow->setVisibility();
        $this->remarks->setVisibility();
        $this->date_upload->setVisibility();
        $this->user->setVisibility();
        $this->status->setVisibility();
        $this->date_update->setVisibility();
        $this->time_update->setVisibility();
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("vasvalidationlist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "vasvalidationlist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
        $this->price_foto->Upload->Index = $CurrentForm->Index;
        $this->price_foto->Upload->uploadFile();
        $this->price_foto->CurrentValue = $this->price_foto->Upload->FileName;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'order' first before field var 'x_order'
        $val = $CurrentForm->hasValue("order") ? $CurrentForm->getValue("order") : $CurrentForm->getValue("x_order");
        if (!$this->order->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->order->Visible = false; // Disable update for API request
            } else {
                $this->order->setFormValue($val);
            }
        }

        // Check field name 'po' first before field var 'x_po'
        $val = $CurrentForm->hasValue("po") ? $CurrentForm->getValue("po") : $CurrentForm->getValue("x_po");
        if (!$this->po->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->po->Visible = false; // Disable update for API request
            } else {
                $this->po->setFormValue($val);
            }
        }

        // Check field name 'sap_art' first before field var 'x_sap_art'
        $val = $CurrentForm->hasValue("sap_art") ? $CurrentForm->getValue("sap_art") : $CurrentForm->getValue("x_sap_art");
        if (!$this->sap_art->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sap_art->Visible = false; // Disable update for API request
            } else {
                $this->sap_art->setFormValue($val);
            }
        }

        // Check field name 'sub_index' first before field var 'x_sub_index'
        $val = $CurrentForm->hasValue("sub_index") ? $CurrentForm->getValue("sub_index") : $CurrentForm->getValue("x_sub_index");
        if (!$this->sub_index->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sub_index->Visible = false; // Disable update for API request
            } else {
                $this->sub_index->setFormValue($val);
            }
        }

        // Check field name 'concept' first before field var 'x_concept'
        $val = $CurrentForm->hasValue("concept") ? $CurrentForm->getValue("concept") : $CurrentForm->getValue("x_concept");
        if (!$this->concept->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->concept->Visible = false; // Disable update for API request
            } else {
                $this->concept->setFormValue($val);
            }
        }

        // Check field name 'ctn' first before field var 'x_ctn'
        $val = $CurrentForm->hasValue("ctn") ? $CurrentForm->getValue("ctn") : $CurrentForm->getValue("x_ctn");
        if (!$this->ctn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ctn->Visible = false; // Disable update for API request
            } else {
                $this->ctn->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'season2' first before field var 'x_season2'
        $val = $CurrentForm->hasValue("season2") ? $CurrentForm->getValue("season2") : $CurrentForm->getValue("x_season2");
        if (!$this->season2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->season2->Visible = false; // Disable update for API request
            } else {
                $this->season2->setFormValue($val);
            }
        }

        // Check field name 'qty_oss' first before field var 'x_qty_oss'
        $val = $CurrentForm->hasValue("qty_oss") ? $CurrentForm->getValue("qty_oss") : $CurrentForm->getValue("x_qty_oss");
        if (!$this->qty_oss->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->qty_oss->Visible = false; // Disable update for API request
            } else {
                $this->qty_oss->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'shipment' first before field var 'x_shipment'
        $val = $CurrentForm->hasValue("shipment") ? $CurrentForm->getValue("shipment") : $CurrentForm->getValue("x_shipment");
        if (!$this->shipment->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shipment->Visible = false; // Disable update for API request
            } else {
                $this->shipment->setFormValue($val);
            }
        }

        // Check field name 'aju' first before field var 'x_aju'
        $val = $CurrentForm->hasValue("aju") ? $CurrentForm->getValue("aju") : $CurrentForm->getValue("x_aju");
        if (!$this->aju->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->aju->Visible = false; // Disable update for API request
            } else {
                $this->aju->setFormValue($val);
            }
        }

        // Check field name 'actual_price' first before field var 'x_actual_price'
        $val = $CurrentForm->hasValue("actual_price") ? $CurrentForm->getValue("actual_price") : $CurrentForm->getValue("x_actual_price");
        if (!$this->actual_price->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->actual_price->Visible = false; // Disable update for API request
            } else {
                $this->actual_price->setFormValue($val);
            }
        }

        // Check field name 'snow' first before field var 'x_snow'
        $val = $CurrentForm->hasValue("snow") ? $CurrentForm->getValue("snow") : $CurrentForm->getValue("x_snow");
        if (!$this->snow->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->snow->Visible = false; // Disable update for API request
            } else {
                $this->snow->setFormValue($val);
            }
        }

        // Check field name 'remarks' first before field var 'x_remarks'
        $val = $CurrentForm->hasValue("remarks") ? $CurrentForm->getValue("remarks") : $CurrentForm->getValue("x_remarks");
        if (!$this->remarks->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->remarks->Visible = false; // Disable update for API request
            } else {
                $this->remarks->setFormValue($val);
            }
        }

        // Check field name 'date_upload' first before field var 'x_date_upload'
        $val = $CurrentForm->hasValue("date_upload") ? $CurrentForm->getValue("date_upload") : $CurrentForm->getValue("x_date_upload");
        if (!$this->date_upload->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_upload->Visible = false; // Disable update for API request
            } else {
                $this->date_upload->setFormValue($val, true, $validate);
            }
            $this->date_upload->CurrentValue = UnFormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern());
        }

        // Check field name 'user' first before field var 'x_user'
        $val = $CurrentForm->hasValue("user") ? $CurrentForm->getValue("user") : $CurrentForm->getValue("x_user");
        if (!$this->user->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user->Visible = false; // Disable update for API request
            } else {
                $this->user->setFormValue($val);
            }
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'date_update' first before field var 'x_date_update'
        $val = $CurrentForm->hasValue("date_update") ? $CurrentForm->getValue("date_update") : $CurrentForm->getValue("x_date_update");
        if (!$this->date_update->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_update->Visible = false; // Disable update for API request
            } else {
                $this->date_update->setFormValue($val);
            }
            $this->date_update->CurrentValue = UnFormatDateTime($this->date_update->CurrentValue, $this->date_update->formatPattern());
        }

        // Check field name 'time_update' first before field var 'x_time_update'
        $val = $CurrentForm->hasValue("time_update") ? $CurrentForm->getValue("time_update") : $CurrentForm->getValue("x_time_update");
        if (!$this->time_update->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->time_update->Visible = false; // Disable update for API request
            } else {
                $this->time_update->setFormValue($val);
            }
            $this->time_update->CurrentValue = UnFormatDateTime($this->time_update->CurrentValue, $this->time_update->formatPattern());
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->order->CurrentValue = $this->order->FormValue;
        $this->po->CurrentValue = $this->po->FormValue;
        $this->sap_art->CurrentValue = $this->sap_art->FormValue;
        $this->sub_index->CurrentValue = $this->sub_index->FormValue;
        $this->concept->CurrentValue = $this->concept->FormValue;
        $this->ctn->CurrentValue = $this->ctn->FormValue;
        $this->season2->CurrentValue = $this->season2->FormValue;
        $this->qty_oss->CurrentValue = $this->qty_oss->FormValue;
        $this->shipment->CurrentValue = $this->shipment->FormValue;
        $this->aju->CurrentValue = $this->aju->FormValue;
        $this->actual_price->CurrentValue = $this->actual_price->FormValue;
        $this->snow->CurrentValue = $this->snow->FormValue;
        $this->remarks->CurrentValue = $this->remarks->FormValue;
        $this->date_upload->CurrentValue = $this->date_upload->FormValue;
        $this->date_upload->CurrentValue = UnFormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern());
        $this->user->CurrentValue = $this->user->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->date_update->CurrentValue = $this->date_update->FormValue;
        $this->date_update->CurrentValue = UnFormatDateTime($this->date_update->CurrentValue, $this->date_update->formatPattern());
        $this->time_update->CurrentValue = $this->time_update->FormValue;
        $this->time_update->CurrentValue = UnFormatDateTime($this->time_update->CurrentValue, $this->time_update->formatPattern());
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->order->setDbValue($row['order']);
        $this->po->setDbValue($row['po']);
        $this->sap_art->setDbValue($row['sap_art']);
        $this->sub_index->setDbValue($row['sub_index']);
        $this->concept->setDbValue($row['concept']);
        $this->ctn->setDbValue($row['ctn']);
        $this->season2->setDbValue($row['season2']);
        $this->qty_oss->setDbValue($row['qty_oss']);
        $this->shipment->setDbValue($row['shipment']);
        $this->aju->setDbValue($row['aju']);
        $this->actual_price->setDbValue($row['actual_price']);
        $this->price_foto->Upload->DbValue = $row['price_foto'];
        $this->price_foto->setDbValue($this->price_foto->Upload->DbValue);
        $this->snow->setDbValue($row['snow']);
        $this->remarks->setDbValue($row['remarks']);
        $this->date_upload->setDbValue($row['date_upload']);
        $this->user->setDbValue($row['user']);
        $this->status->setDbValue($row['status']);
        $this->date_update->setDbValue($row['date_update']);
        $this->time_update->setDbValue($row['time_update']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['order'] = $this->order->DefaultValue;
        $row['po'] = $this->po->DefaultValue;
        $row['sap_art'] = $this->sap_art->DefaultValue;
        $row['sub_index'] = $this->sub_index->DefaultValue;
        $row['concept'] = $this->concept->DefaultValue;
        $row['ctn'] = $this->ctn->DefaultValue;
        $row['season2'] = $this->season2->DefaultValue;
        $row['qty_oss'] = $this->qty_oss->DefaultValue;
        $row['shipment'] = $this->shipment->DefaultValue;
        $row['aju'] = $this->aju->DefaultValue;
        $row['actual_price'] = $this->actual_price->DefaultValue;
        $row['price_foto'] = $this->price_foto->DefaultValue;
        $row['snow'] = $this->snow->DefaultValue;
        $row['remarks'] = $this->remarks->DefaultValue;
        $row['date_upload'] = $this->date_upload->DefaultValue;
        $row['user'] = $this->user->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['date_update'] = $this->date_update->DefaultValue;
        $row['time_update'] = $this->time_update->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // order
        $this->order->RowCssClass = "row";

        // po
        $this->po->RowCssClass = "row";

        // sap_art
        $this->sap_art->RowCssClass = "row";

        // sub_index
        $this->sub_index->RowCssClass = "row";

        // concept
        $this->concept->RowCssClass = "row";

        // ctn
        $this->ctn->RowCssClass = "row";

        // season2
        $this->season2->RowCssClass = "row";

        // qty_oss
        $this->qty_oss->RowCssClass = "row";

        // shipment
        $this->shipment->RowCssClass = "row";

        // aju
        $this->aju->RowCssClass = "row";

        // actual_price
        $this->actual_price->RowCssClass = "row";

        // price_foto
        $this->price_foto->RowCssClass = "row";

        // snow
        $this->snow->RowCssClass = "row";

        // remarks
        $this->remarks->RowCssClass = "row";

        // date_upload
        $this->date_upload->RowCssClass = "row";

        // user
        $this->user->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // date_update
        $this->date_update->RowCssClass = "row";

        // time_update
        $this->time_update->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

            // order
            $this->order->ViewValue = $this->order->CurrentValue;
            $this->order->ViewCustomAttributes = "";

            // po
            $this->po->ViewValue = $this->po->CurrentValue;
            $this->po->ViewCustomAttributes = "";

            // sap_art
            $this->sap_art->ViewValue = $this->sap_art->CurrentValue;
            $this->sap_art->ViewCustomAttributes = "";

            // sub_index
            $this->sub_index->ViewValue = $this->sub_index->CurrentValue;
            $this->sub_index->ViewCustomAttributes = "";

            // concept
            $this->concept->ViewValue = $this->concept->CurrentValue;
            $this->concept->ViewCustomAttributes = "";

            // ctn
            $this->ctn->ViewValue = $this->ctn->CurrentValue;
            $this->ctn->ViewValue = FormatNumber($this->ctn->ViewValue, $this->ctn->formatPattern());
            $this->ctn->ViewCustomAttributes = "";

            // season2
            $this->season2->ViewValue = $this->season2->CurrentValue;
            $this->season2->ViewCustomAttributes = "";

            // qty_oss
            $this->qty_oss->ViewValue = $this->qty_oss->CurrentValue;
            $this->qty_oss->ViewValue = FormatNumber($this->qty_oss->ViewValue, $this->qty_oss->formatPattern());
            $this->qty_oss->ViewCustomAttributes = "";

            // shipment
            $this->shipment->ViewValue = $this->shipment->CurrentValue;
            $this->shipment->ViewCustomAttributes = "";

            // aju
            $this->aju->ViewValue = $this->aju->CurrentValue;
            $this->aju->ViewCustomAttributes = "";

            // actual_price
            $this->actual_price->ViewValue = $this->actual_price->CurrentValue;
            $this->actual_price->ViewCustomAttributes = "";

            // price_foto
            if (!EmptyValue($this->price_foto->Upload->DbValue)) {
                $this->price_foto->ImageWidth = 100;
                $this->price_foto->ImageHeight = 100;
                $this->price_foto->ImageAlt = $this->price_foto->alt();
                $this->price_foto->ImageCssClass = "ew-image";
                $this->price_foto->ViewValue = $this->price_foto->Upload->DbValue;
            } else {
                $this->price_foto->ViewValue = "";
            }
            $this->price_foto->ViewCustomAttributes = "";

            // snow
            $this->snow->ViewValue = $this->snow->CurrentValue;
            $this->snow->ViewCustomAttributes = "";

            // remarks
            $this->remarks->ViewValue = $this->remarks->CurrentValue;
            $this->remarks->ViewCustomAttributes = "";

            // date_upload
            $this->date_upload->ViewValue = $this->date_upload->CurrentValue;
            $this->date_upload->ViewValue = FormatDateTime($this->date_upload->ViewValue, $this->date_upload->formatPattern());
            $this->date_upload->ViewCustomAttributes = "";

            // user
            $this->user->ViewValue = $this->user->CurrentValue;
            $this->user->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // date_update
            $this->date_update->ViewValue = $this->date_update->CurrentValue;
            $this->date_update->ViewValue = FormatDateTime($this->date_update->ViewValue, $this->date_update->formatPattern());
            $this->date_update->ViewCustomAttributes = "";

            // time_update
            $this->time_update->ViewValue = $this->time_update->CurrentValue;
            $this->time_update->ViewValue = FormatDateTime($this->time_update->ViewValue, $this->time_update->formatPattern());
            $this->time_update->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // order
            $this->order->LinkCustomAttributes = "";
            $this->order->HrefValue = "";

            // po
            $this->po->LinkCustomAttributes = "";
            $this->po->HrefValue = "";

            // sap_art
            $this->sap_art->LinkCustomAttributes = "";
            $this->sap_art->HrefValue = "";

            // sub_index
            $this->sub_index->LinkCustomAttributes = "";
            $this->sub_index->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // ctn
            $this->ctn->LinkCustomAttributes = "";
            $this->ctn->HrefValue = "";

            // season2
            $this->season2->LinkCustomAttributes = "";
            $this->season2->HrefValue = "";

            // qty_oss
            $this->qty_oss->LinkCustomAttributes = "";
            $this->qty_oss->HrefValue = "";

            // shipment
            $this->shipment->LinkCustomAttributes = "";
            $this->shipment->HrefValue = "";

            // aju
            $this->aju->LinkCustomAttributes = "";
            $this->aju->HrefValue = "";

            // actual_price
            $this->actual_price->LinkCustomAttributes = "";
            $this->actual_price->HrefValue = "";

            // price_foto
            $this->price_foto->LinkCustomAttributes = "";
            if (!EmptyValue($this->price_foto->Upload->DbValue)) {
                $this->price_foto->HrefValue = GetFileUploadUrl($this->price_foto, $this->price_foto->htmlDecode($this->price_foto->Upload->DbValue)); // Add prefix/suffix
                $this->price_foto->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->price_foto->HrefValue = FullUrl($this->price_foto->HrefValue, "href");
                }
            } else {
                $this->price_foto->HrefValue = "";
            }
            $this->price_foto->ExportHrefValue = $this->price_foto->UploadPath . $this->price_foto->Upload->DbValue;

            // snow
            $this->snow->LinkCustomAttributes = "";
            $this->snow->HrefValue = "";

            // remarks
            $this->remarks->LinkCustomAttributes = "";
            $this->remarks->HrefValue = "";

            // date_upload
            $this->date_upload->LinkCustomAttributes = "";
            $this->date_upload->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_update
            $this->date_update->LinkCustomAttributes = "";
            $this->date_update->HrefValue = "";

            // time_update
            $this->time_update->LinkCustomAttributes = "";
            $this->time_update->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->EditValue = FormatNumber($this->id->EditValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

            // order
            $this->order->setupEditAttributes();
            $this->order->EditCustomAttributes = "";
            if (!$this->order->Raw) {
                $this->order->CurrentValue = HtmlDecode($this->order->CurrentValue);
            }
            $this->order->EditValue = HtmlEncode($this->order->CurrentValue);
            $this->order->PlaceHolder = RemoveHtml($this->order->caption());

            // po
            $this->po->setupEditAttributes();
            $this->po->EditCustomAttributes = "";
            if (!$this->po->Raw) {
                $this->po->CurrentValue = HtmlDecode($this->po->CurrentValue);
            }
            $this->po->EditValue = HtmlEncode($this->po->CurrentValue);
            $this->po->PlaceHolder = RemoveHtml($this->po->caption());

            // sap_art
            $this->sap_art->setupEditAttributes();
            $this->sap_art->EditCustomAttributes = "";
            if (!$this->sap_art->Raw) {
                $this->sap_art->CurrentValue = HtmlDecode($this->sap_art->CurrentValue);
            }
            $this->sap_art->EditValue = HtmlEncode($this->sap_art->CurrentValue);
            $this->sap_art->PlaceHolder = RemoveHtml($this->sap_art->caption());

            // sub_index
            $this->sub_index->setupEditAttributes();
            $this->sub_index->EditCustomAttributes = "";
            if (!$this->sub_index->Raw) {
                $this->sub_index->CurrentValue = HtmlDecode($this->sub_index->CurrentValue);
            }
            $this->sub_index->EditValue = HtmlEncode($this->sub_index->CurrentValue);
            $this->sub_index->PlaceHolder = RemoveHtml($this->sub_index->caption());

            // concept
            $this->concept->setupEditAttributes();
            $this->concept->EditCustomAttributes = "";
            if (!$this->concept->Raw) {
                $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
            }
            $this->concept->EditValue = HtmlEncode($this->concept->CurrentValue);
            $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

            // ctn
            $this->ctn->setupEditAttributes();
            $this->ctn->EditCustomAttributes = "";
            $this->ctn->EditValue = HtmlEncode($this->ctn->CurrentValue);
            $this->ctn->PlaceHolder = RemoveHtml($this->ctn->caption());
            if (strval($this->ctn->EditValue) != "" && is_numeric($this->ctn->EditValue)) {
                $this->ctn->EditValue = FormatNumber($this->ctn->EditValue, null);
            }

            // season2
            $this->season2->setupEditAttributes();
            $this->season2->EditCustomAttributes = "";
            if (!$this->season2->Raw) {
                $this->season2->CurrentValue = HtmlDecode($this->season2->CurrentValue);
            }
            $this->season2->EditValue = HtmlEncode($this->season2->CurrentValue);
            $this->season2->PlaceHolder = RemoveHtml($this->season2->caption());

            // qty_oss
            $this->qty_oss->setupEditAttributes();
            $this->qty_oss->EditCustomAttributes = "";
            $this->qty_oss->EditValue = HtmlEncode($this->qty_oss->CurrentValue);
            $this->qty_oss->PlaceHolder = RemoveHtml($this->qty_oss->caption());
            if (strval($this->qty_oss->EditValue) != "" && is_numeric($this->qty_oss->EditValue)) {
                $this->qty_oss->EditValue = FormatNumber($this->qty_oss->EditValue, null);
            }

            // shipment
            $this->shipment->setupEditAttributes();
            $this->shipment->EditCustomAttributes = "";
            if (!$this->shipment->Raw) {
                $this->shipment->CurrentValue = HtmlDecode($this->shipment->CurrentValue);
            }
            $this->shipment->EditValue = HtmlEncode($this->shipment->CurrentValue);
            $this->shipment->PlaceHolder = RemoveHtml($this->shipment->caption());

            // aju
            $this->aju->setupEditAttributes();
            $this->aju->EditCustomAttributes = "";
            if (!$this->aju->Raw) {
                $this->aju->CurrentValue = HtmlDecode($this->aju->CurrentValue);
            }
            $this->aju->EditValue = HtmlEncode($this->aju->CurrentValue);
            $this->aju->PlaceHolder = RemoveHtml($this->aju->caption());

            // actual_price
            $this->actual_price->setupEditAttributes();
            $this->actual_price->EditCustomAttributes = "";
            if (!$this->actual_price->Raw) {
                $this->actual_price->CurrentValue = HtmlDecode($this->actual_price->CurrentValue);
            }
            $this->actual_price->EditValue = HtmlEncode($this->actual_price->CurrentValue);
            $this->actual_price->PlaceHolder = RemoveHtml($this->actual_price->caption());

            // price_foto
            $this->price_foto->setupEditAttributes();
            $this->price_foto->EditAttrs["capture"] = "environment";
            $this->price_foto->EditCustomAttributes = "";
            if (!EmptyValue($this->price_foto->Upload->DbValue)) {
                $this->price_foto->ImageWidth = 100;
                $this->price_foto->ImageHeight = 100;
                $this->price_foto->ImageAlt = $this->price_foto->alt();
                $this->price_foto->ImageCssClass = "ew-image";
                $this->price_foto->EditValue = $this->price_foto->Upload->DbValue;
            } else {
                $this->price_foto->EditValue = "";
            }
            if (!EmptyValue($this->price_foto->CurrentValue)) {
                $this->price_foto->Upload->FileName = $this->price_foto->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->price_foto);
            }

            // snow
            $this->snow->setupEditAttributes();
            $this->snow->EditCustomAttributes = "";
            if (!$this->snow->Raw) {
                $this->snow->CurrentValue = HtmlDecode($this->snow->CurrentValue);
            }
            $this->snow->EditValue = HtmlEncode($this->snow->CurrentValue);
            $this->snow->PlaceHolder = RemoveHtml($this->snow->caption());

            // remarks
            $this->remarks->setupEditAttributes();
            $this->remarks->EditCustomAttributes = "";
            if (!$this->remarks->Raw) {
                $this->remarks->CurrentValue = HtmlDecode($this->remarks->CurrentValue);
            }
            $this->remarks->EditValue = HtmlEncode($this->remarks->CurrentValue);
            $this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

            // date_upload
            $this->date_upload->setupEditAttributes();
            $this->date_upload->EditCustomAttributes = "";
            $this->date_upload->EditValue = HtmlEncode(FormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern()));
            $this->date_upload->PlaceHolder = RemoveHtml($this->date_upload->caption());

            // user

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // date_update

            // time_update

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // order
            $this->order->LinkCustomAttributes = "";
            $this->order->HrefValue = "";

            // po
            $this->po->LinkCustomAttributes = "";
            $this->po->HrefValue = "";

            // sap_art
            $this->sap_art->LinkCustomAttributes = "";
            $this->sap_art->HrefValue = "";

            // sub_index
            $this->sub_index->LinkCustomAttributes = "";
            $this->sub_index->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // ctn
            $this->ctn->LinkCustomAttributes = "";
            $this->ctn->HrefValue = "";

            // season2
            $this->season2->LinkCustomAttributes = "";
            $this->season2->HrefValue = "";

            // qty_oss
            $this->qty_oss->LinkCustomAttributes = "";
            $this->qty_oss->HrefValue = "";

            // shipment
            $this->shipment->LinkCustomAttributes = "";
            $this->shipment->HrefValue = "";

            // aju
            $this->aju->LinkCustomAttributes = "";
            $this->aju->HrefValue = "";

            // actual_price
            $this->actual_price->LinkCustomAttributes = "";
            $this->actual_price->HrefValue = "";

            // price_foto
            $this->price_foto->LinkCustomAttributes = "";
            if (!EmptyValue($this->price_foto->Upload->DbValue)) {
                $this->price_foto->HrefValue = GetFileUploadUrl($this->price_foto, $this->price_foto->htmlDecode($this->price_foto->Upload->DbValue)); // Add prefix/suffix
                $this->price_foto->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->price_foto->HrefValue = FullUrl($this->price_foto->HrefValue, "href");
                }
            } else {
                $this->price_foto->HrefValue = "";
            }
            $this->price_foto->ExportHrefValue = $this->price_foto->UploadPath . $this->price_foto->Upload->DbValue;

            // snow
            $this->snow->LinkCustomAttributes = "";
            $this->snow->HrefValue = "";

            // remarks
            $this->remarks->LinkCustomAttributes = "";
            $this->remarks->HrefValue = "";

            // date_upload
            $this->date_upload->LinkCustomAttributes = "";
            $this->date_upload->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_update
            $this->date_update->LinkCustomAttributes = "";
            $this->date_update->HrefValue = "";

            // time_update
            $this->time_update->LinkCustomAttributes = "";
            $this->time_update->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
        if ($this->order->Required) {
            if (!$this->order->IsDetailKey && EmptyValue($this->order->FormValue)) {
                $this->order->addErrorMessage(str_replace("%s", $this->order->caption(), $this->order->RequiredErrorMessage));
            }
        }
        if ($this->po->Required) {
            if (!$this->po->IsDetailKey && EmptyValue($this->po->FormValue)) {
                $this->po->addErrorMessage(str_replace("%s", $this->po->caption(), $this->po->RequiredErrorMessage));
            }
        }
        if ($this->sap_art->Required) {
            if (!$this->sap_art->IsDetailKey && EmptyValue($this->sap_art->FormValue)) {
                $this->sap_art->addErrorMessage(str_replace("%s", $this->sap_art->caption(), $this->sap_art->RequiredErrorMessage));
            }
        }
        if ($this->sub_index->Required) {
            if (!$this->sub_index->IsDetailKey && EmptyValue($this->sub_index->FormValue)) {
                $this->sub_index->addErrorMessage(str_replace("%s", $this->sub_index->caption(), $this->sub_index->RequiredErrorMessage));
            }
        }
        if ($this->concept->Required) {
            if (!$this->concept->IsDetailKey && EmptyValue($this->concept->FormValue)) {
                $this->concept->addErrorMessage(str_replace("%s", $this->concept->caption(), $this->concept->RequiredErrorMessage));
            }
        }
        if ($this->ctn->Required) {
            if (!$this->ctn->IsDetailKey && EmptyValue($this->ctn->FormValue)) {
                $this->ctn->addErrorMessage(str_replace("%s", $this->ctn->caption(), $this->ctn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ctn->FormValue)) {
            $this->ctn->addErrorMessage($this->ctn->getErrorMessage(false));
        }
        if ($this->season2->Required) {
            if (!$this->season2->IsDetailKey && EmptyValue($this->season2->FormValue)) {
                $this->season2->addErrorMessage(str_replace("%s", $this->season2->caption(), $this->season2->RequiredErrorMessage));
            }
        }
        if ($this->qty_oss->Required) {
            if (!$this->qty_oss->IsDetailKey && EmptyValue($this->qty_oss->FormValue)) {
                $this->qty_oss->addErrorMessage(str_replace("%s", $this->qty_oss->caption(), $this->qty_oss->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->qty_oss->FormValue)) {
            $this->qty_oss->addErrorMessage($this->qty_oss->getErrorMessage(false));
        }
        if ($this->shipment->Required) {
            if (!$this->shipment->IsDetailKey && EmptyValue($this->shipment->FormValue)) {
                $this->shipment->addErrorMessage(str_replace("%s", $this->shipment->caption(), $this->shipment->RequiredErrorMessage));
            }
        }
        if ($this->aju->Required) {
            if (!$this->aju->IsDetailKey && EmptyValue($this->aju->FormValue)) {
                $this->aju->addErrorMessage(str_replace("%s", $this->aju->caption(), $this->aju->RequiredErrorMessage));
            }
        }
        if ($this->actual_price->Required) {
            if (!$this->actual_price->IsDetailKey && EmptyValue($this->actual_price->FormValue)) {
                $this->actual_price->addErrorMessage(str_replace("%s", $this->actual_price->caption(), $this->actual_price->RequiredErrorMessage));
            }
        }
        if ($this->price_foto->Required) {
            if ($this->price_foto->Upload->FileName == "" && !$this->price_foto->Upload->KeepFile) {
                $this->price_foto->addErrorMessage(str_replace("%s", $this->price_foto->caption(), $this->price_foto->RequiredErrorMessage));
            }
        }
        if ($this->snow->Required) {
            if (!$this->snow->IsDetailKey && EmptyValue($this->snow->FormValue)) {
                $this->snow->addErrorMessage(str_replace("%s", $this->snow->caption(), $this->snow->RequiredErrorMessage));
            }
        }
        if ($this->remarks->Required) {
            if (!$this->remarks->IsDetailKey && EmptyValue($this->remarks->FormValue)) {
                $this->remarks->addErrorMessage(str_replace("%s", $this->remarks->caption(), $this->remarks->RequiredErrorMessage));
            }
        }
        if ($this->date_upload->Required) {
            if (!$this->date_upload->IsDetailKey && EmptyValue($this->date_upload->FormValue)) {
                $this->date_upload->addErrorMessage(str_replace("%s", $this->date_upload->caption(), $this->date_upload->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_upload->FormValue, $this->date_upload->formatPattern())) {
            $this->date_upload->addErrorMessage($this->date_upload->getErrorMessage(false));
        }
        if ($this->user->Required) {
            if (!$this->user->IsDetailKey && EmptyValue($this->user->FormValue)) {
                $this->user->addErrorMessage(str_replace("%s", $this->user->caption(), $this->user->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->date_update->Required) {
            if (!$this->date_update->IsDetailKey && EmptyValue($this->date_update->FormValue)) {
                $this->date_update->addErrorMessage(str_replace("%s", $this->date_update->caption(), $this->date_update->RequiredErrorMessage));
            }
        }
        if ($this->time_update->Required) {
            if (!$this->time_update->IsDetailKey && EmptyValue($this->time_update->FormValue)) {
                $this->time_update->addErrorMessage(str_replace("%s", $this->time_update->caption(), $this->time_update->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // order
        $this->order->setDbValueDef($rsnew, $this->order->CurrentValue, null, $this->order->ReadOnly);

        // po
        $this->po->setDbValueDef($rsnew, $this->po->CurrentValue, null, $this->po->ReadOnly);

        // sap_art
        $this->sap_art->setDbValueDef($rsnew, $this->sap_art->CurrentValue, null, $this->sap_art->ReadOnly);

        // sub_index
        $this->sub_index->setDbValueDef($rsnew, $this->sub_index->CurrentValue, null, $this->sub_index->ReadOnly);

        // concept
        $this->concept->setDbValueDef($rsnew, $this->concept->CurrentValue, null, $this->concept->ReadOnly);

        // ctn
        $this->ctn->setDbValueDef($rsnew, $this->ctn->CurrentValue, null, $this->ctn->ReadOnly);

        // season2
        $this->season2->setDbValueDef($rsnew, $this->season2->CurrentValue, null, $this->season2->ReadOnly);

        // qty_oss
        $this->qty_oss->setDbValueDef($rsnew, $this->qty_oss->CurrentValue, null, $this->qty_oss->ReadOnly);

        // shipment
        $this->shipment->setDbValueDef($rsnew, $this->shipment->CurrentValue, null, $this->shipment->ReadOnly);

        // aju
        $this->aju->setDbValueDef($rsnew, $this->aju->CurrentValue, null, $this->aju->ReadOnly);

        // actual_price
        $this->actual_price->setDbValueDef($rsnew, $this->actual_price->CurrentValue, null, $this->actual_price->ReadOnly);

        // price_foto
        if ($this->price_foto->Visible && !$this->price_foto->ReadOnly && !$this->price_foto->Upload->KeepFile) {
            $this->price_foto->Upload->DbValue = $rsold['price_foto']; // Get original value
            if ($this->price_foto->Upload->FileName == "") {
                $rsnew['price_foto'] = null;
            } else {
                $rsnew['price_foto'] = $this->price_foto->Upload->FileName;
            }
            $this->price_foto->ImageWidth = 640; // Resize width
            $this->price_foto->ImageHeight = 640; // Resize height
        }

        // snow
        $this->snow->setDbValueDef($rsnew, $this->snow->CurrentValue, null, $this->snow->ReadOnly);

        // remarks
        $this->remarks->setDbValueDef($rsnew, $this->remarks->CurrentValue, null, $this->remarks->ReadOnly);

        // date_upload
        $this->date_upload->setDbValueDef($rsnew, UnFormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern()), null, $this->date_upload->ReadOnly);

        // user
        $this->user->CurrentValue = CurrentUserName();
        $this->user->setDbValueDef($rsnew, $this->user->CurrentValue, null);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

        // date_update
        $this->date_update->CurrentValue = CurrentDate();
        $this->date_update->setDbValueDef($rsnew, $this->date_update->CurrentValue, null);

        // time_update
        $this->time_update->CurrentValue = CurrentTime();
        $this->time_update->setDbValueDef($rsnew, $this->time_update->CurrentValue, null);

        // Update current values
        $this->setCurrentValues($rsnew);
        if ($this->price_foto->Visible && !$this->price_foto->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->price_foto->Upload->DbValue) ? [] : [$this->price_foto->htmlDecode($this->price_foto->Upload->DbValue)];
            if (!EmptyValue($this->price_foto->Upload->FileName)) {
                $newFiles = [$this->price_foto->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->price_foto, $this->price_foto->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->price_foto->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->price_foto->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->price_foto->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->price_foto->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->price_foto->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->price_foto->setDbValueDef($rsnew, $this->price_foto->Upload->FileName, null, $this->price_foto->ReadOnly);
            }
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
                if ($this->price_foto->Visible && !$this->price_foto->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->price_foto->Upload->DbValue) ? [] : [$this->price_foto->htmlDecode($this->price_foto->Upload->DbValue)];
                    if (!EmptyValue($this->price_foto->Upload->FileName)) {
                        $newFiles = [$this->price_foto->Upload->FileName];
                        $newFiles2 = [$this->price_foto->htmlDecode($rsnew['price_foto'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->price_foto, $this->price_foto->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->price_foto->Upload->ResizeAndSaveToFile($this->price_foto->ImageWidth, $this->price_foto->ImageHeight, 100, $newFiles[$i], true, $i)) {
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->price_foto->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
            // price_foto
            CleanUploadTempPath($this->price_foto, $this->price_foto->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("vasvalidationlist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            if ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}

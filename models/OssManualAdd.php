<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class OssManualAdd extends OssManual
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'oss_manual';

    // Page object name
    public $PageObjName = "OssManualAdd";

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

        // Custom template
        $this->UseCustomTemplate = true;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (oss_manual)
        if (!isset($GLOBALS["oss_manual"]) || get_class($GLOBALS["oss_manual"]) == PROJECT_NAMESPACE . "oss_manual") {
            $GLOBALS["oss_manual"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'oss_manual');
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
        if (Post("customexport") === null) {
             // Page Unload event
            if (method_exists($this, "pageUnload")) {
                $this->pageUnload();
            }

            // Global Page Unloaded event (in userfn*.php)
            Page_Unloaded();
        }

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            if (is_array(Session(SESSION_TEMP_IMAGES))) { // Restore temp images
                $TempImages = Session(SESSION_TEMP_IMAGES);
            }
            if (Post("data") !== null) {
                $content = Post("data");
            }
            $ExportFileName = Post("filename", "");
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("oss_manual");
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
        if ($this->CustomExport) { // Save temp images array for custom export
            if (is_array($TempImages)) {
                $_SESSION[SESSION_TEMP_IMAGES] = $TempImages;
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
                    if ($pageName == "ossmanualview") {
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
            $key .= @$ar['sscc'];
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->date->setVisibility();
        $this->sscc->setVisibility();
        $this->scan->setVisibility();
        $this->shipment->setVisibility();
        $this->pallet_no->setVisibility();
        $this->idw->setVisibility();
        $this->order_no->setVisibility();
        $this->item_in_ctn->setVisibility();
        $this->no_of_ctn->setVisibility();
        $this->ctn_no->setVisibility();
        $this->checker->setVisibility();
        $this->shift->setVisibility();
        $this->status->setVisibility();
        $this->date_updated->setVisibility();
        $this->time_updated->setVisibility();
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
        $this->setupLookupOptions($this->idw);
        $this->setupLookupOptions($this->shift);
        $this->setupLookupOptions($this->status);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("sscc") ?? Route("sscc")) !== null) {
                $this->sscc->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("ossmanuallist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->GetAddUrl();
                    if (GetPageName($returnUrl) == "ossmanuallist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ossmanualview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->date->DefaultValue = CurrentDate();
        $this->date->OldValue = $this->date->DefaultValue;
        $this->shipment->DefaultValue = GetShipment();
        $this->shipment->OldValue = $this->shipment->DefaultValue;
        $this->pallet_no->DefaultValue = GetPallet();
        $this->pallet_no->OldValue = $this->pallet_no->DefaultValue;
        $this->idw->DefaultValue = GetIdw();
        $this->idw->OldValue = $this->idw->DefaultValue;
        $this->order_no->DefaultValue = GetOrder();
        $this->order_no->OldValue = $this->order_no->DefaultValue;
        $this->checker->DefaultValue = CurrentUserName();
        $this->checker->OldValue = $this->checker->DefaultValue;
        $this->shift->DefaultValue = GetShift();
        $this->shift->OldValue = $this->shift->DefaultValue;
        $this->status->DefaultValue = 'Done';
        $this->status->OldValue = $this->status->DefaultValue;
        $this->date_updated->DefaultValue = CurrentDate();
        $this->date_updated->OldValue = $this->date_updated->DefaultValue;
        $this->time_updated->DefaultValue = CurrentTime();
        $this->time_updated->OldValue = $this->time_updated->DefaultValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'date' first before field var 'x_date'
        $val = $CurrentForm->hasValue("date") ? $CurrentForm->getValue("date") : $CurrentForm->getValue("x_date");
        if (!$this->date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date->Visible = false; // Disable update for API request
            } else {
                $this->date->setFormValue($val, true, $validate);
            }
            $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        }

        // Check field name 'sscc' first before field var 'x_sscc'
        $val = $CurrentForm->hasValue("sscc") ? $CurrentForm->getValue("sscc") : $CurrentForm->getValue("x_sscc");
        if (!$this->sscc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sscc->Visible = false; // Disable update for API request
            } else {
                $this->sscc->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'scan' first before field var 'x_scan'
        $val = $CurrentForm->hasValue("scan") ? $CurrentForm->getValue("scan") : $CurrentForm->getValue("x_scan");
        if (!$this->scan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->scan->Visible = false; // Disable update for API request
            } else {
                $this->scan->setFormValue($val);
            }
        }

        // Check field name 'shipment' first before field var 'x_shipment'
        $val = $CurrentForm->hasValue("shipment") ? $CurrentForm->getValue("shipment") : $CurrentForm->getValue("x_shipment");
        if (!$this->shipment->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shipment->Visible = false; // Disable update for API request
            } else {
                $this->shipment->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pallet_no' first before field var 'x_pallet_no'
        $val = $CurrentForm->hasValue("pallet_no") ? $CurrentForm->getValue("pallet_no") : $CurrentForm->getValue("x_pallet_no");
        if (!$this->pallet_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pallet_no->Visible = false; // Disable update for API request
            } else {
                $this->pallet_no->setFormValue($val);
            }
        }

        // Check field name 'idw' first before field var 'x_idw'
        $val = $CurrentForm->hasValue("idw") ? $CurrentForm->getValue("idw") : $CurrentForm->getValue("x_idw");
        if (!$this->idw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->idw->Visible = false; // Disable update for API request
            } else {
                $this->idw->setFormValue($val);
            }
        }

        // Check field name 'order_no' first before field var 'x_order_no'
        $val = $CurrentForm->hasValue("order_no") ? $CurrentForm->getValue("order_no") : $CurrentForm->getValue("x_order_no");
        if (!$this->order_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->order_no->Visible = false; // Disable update for API request
            } else {
                $this->order_no->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'item_in_ctn' first before field var 'x_item_in_ctn'
        $val = $CurrentForm->hasValue("item_in_ctn") ? $CurrentForm->getValue("item_in_ctn") : $CurrentForm->getValue("x_item_in_ctn");
        if (!$this->item_in_ctn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->item_in_ctn->Visible = false; // Disable update for API request
            } else {
                $this->item_in_ctn->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'no_of_ctn' first before field var 'x_no_of_ctn'
        $val = $CurrentForm->hasValue("no_of_ctn") ? $CurrentForm->getValue("no_of_ctn") : $CurrentForm->getValue("x_no_of_ctn");
        if (!$this->no_of_ctn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_of_ctn->Visible = false; // Disable update for API request
            } else {
                $this->no_of_ctn->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'ctn_no' first before field var 'x_ctn_no'
        $val = $CurrentForm->hasValue("ctn_no") ? $CurrentForm->getValue("ctn_no") : $CurrentForm->getValue("x_ctn_no");
        if (!$this->ctn_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ctn_no->Visible = false; // Disable update for API request
            } else {
                $this->ctn_no->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'checker' first before field var 'x_checker'
        $val = $CurrentForm->hasValue("checker") ? $CurrentForm->getValue("checker") : $CurrentForm->getValue("x_checker");
        if (!$this->checker->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->checker->Visible = false; // Disable update for API request
            } else {
                $this->checker->setFormValue($val);
            }
        }

        // Check field name 'shift' first before field var 'x_shift'
        $val = $CurrentForm->hasValue("shift") ? $CurrentForm->getValue("shift") : $CurrentForm->getValue("x_shift");
        if (!$this->shift->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shift->Visible = false; // Disable update for API request
            } else {
                $this->shift->setFormValue($val);
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

        // Check field name 'date_updated' first before field var 'x_date_updated'
        $val = $CurrentForm->hasValue("date_updated") ? $CurrentForm->getValue("date_updated") : $CurrentForm->getValue("x_date_updated");
        if (!$this->date_updated->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_updated->Visible = false; // Disable update for API request
            } else {
                $this->date_updated->setFormValue($val, true, $validate);
            }
            $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        }

        // Check field name 'time_updated' first before field var 'x_time_updated'
        $val = $CurrentForm->hasValue("time_updated") ? $CurrentForm->getValue("time_updated") : $CurrentForm->getValue("x_time_updated");
        if (!$this->time_updated->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->time_updated->Visible = false; // Disable update for API request
            } else {
                $this->time_updated->setFormValue($val, true, $validate);
            }
            $this->time_updated->CurrentValue = UnFormatDateTime($this->time_updated->CurrentValue, $this->time_updated->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->date->CurrentValue = $this->date->FormValue;
        $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->sscc->CurrentValue = $this->sscc->FormValue;
        $this->scan->CurrentValue = $this->scan->FormValue;
        $this->shipment->CurrentValue = $this->shipment->FormValue;
        $this->pallet_no->CurrentValue = $this->pallet_no->FormValue;
        $this->idw->CurrentValue = $this->idw->FormValue;
        $this->order_no->CurrentValue = $this->order_no->FormValue;
        $this->item_in_ctn->CurrentValue = $this->item_in_ctn->FormValue;
        $this->no_of_ctn->CurrentValue = $this->no_of_ctn->FormValue;
        $this->ctn_no->CurrentValue = $this->ctn_no->FormValue;
        $this->checker->CurrentValue = $this->checker->FormValue;
        $this->shift->CurrentValue = $this->shift->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->date_updated->CurrentValue = $this->date_updated->FormValue;
        $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        $this->time_updated->CurrentValue = $this->time_updated->FormValue;
        $this->time_updated->CurrentValue = UnFormatDateTime($this->time_updated->CurrentValue, $this->time_updated->formatPattern());
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
        $this->date->setDbValue($row['date']);
        $this->sscc->setDbValue($row['sscc']);
        $this->scan->setDbValue($row['scan']);
        $this->shipment->setDbValue($row['shipment']);
        $this->pallet_no->setDbValue($row['pallet_no']);
        $this->idw->setDbValue($row['idw']);
        $this->order_no->setDbValue($row['order_no']);
        $this->item_in_ctn->setDbValue($row['item_in_ctn']);
        $this->no_of_ctn->setDbValue($row['no_of_ctn']);
        $this->ctn_no->setDbValue($row['ctn_no']);
        $this->checker->setDbValue($row['checker']);
        $this->shift->setDbValue($row['shift']);
        $this->status->setDbValue($row['status']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->time_updated->setDbValue($row['time_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['date'] = $this->date->DefaultValue;
        $row['sscc'] = $this->sscc->DefaultValue;
        $row['scan'] = $this->scan->DefaultValue;
        $row['shipment'] = $this->shipment->DefaultValue;
        $row['pallet_no'] = $this->pallet_no->DefaultValue;
        $row['idw'] = $this->idw->DefaultValue;
        $row['order_no'] = $this->order_no->DefaultValue;
        $row['item_in_ctn'] = $this->item_in_ctn->DefaultValue;
        $row['no_of_ctn'] = $this->no_of_ctn->DefaultValue;
        $row['ctn_no'] = $this->ctn_no->DefaultValue;
        $row['checker'] = $this->checker->DefaultValue;
        $row['shift'] = $this->shift->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
        $row['time_updated'] = $this->time_updated->DefaultValue;
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

        // date
        $this->date->RowCssClass = "row";

        // sscc
        $this->sscc->RowCssClass = "row";

        // scan
        $this->scan->RowCssClass = "row";

        // shipment
        $this->shipment->RowCssClass = "row";

        // pallet_no
        $this->pallet_no->RowCssClass = "row";

        // idw
        $this->idw->RowCssClass = "row";

        // order_no
        $this->order_no->RowCssClass = "row";

        // item_in_ctn
        $this->item_in_ctn->RowCssClass = "row";

        // no_of_ctn
        $this->no_of_ctn->RowCssClass = "row";

        // ctn_no
        $this->ctn_no->RowCssClass = "row";

        // checker
        $this->checker->RowCssClass = "row";

        // shift
        $this->shift->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // time_updated
        $this->time_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // date
            $this->date->ViewValue = $this->date->CurrentValue;
            $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());
            $this->date->ViewCustomAttributes = "";

            // sscc
            $this->sscc->ViewValue = $this->sscc->CurrentValue;
            $this->sscc->ViewCustomAttributes = "";

            // scan
            $this->scan->ViewValue = $this->scan->CurrentValue;
            $this->scan->ViewCustomAttributes = "";

            // shipment
            $this->shipment->ViewValue = $this->shipment->CurrentValue;
            $this->shipment->ViewCustomAttributes = "";

            // pallet_no
            $this->pallet_no->ViewValue = $this->pallet_no->CurrentValue;
            $this->pallet_no->ViewCustomAttributes = "";

            // idw
            if (strval($this->idw->CurrentValue) != "") {
                $this->idw->ViewValue = $this->idw->optionCaption($this->idw->CurrentValue);
            } else {
                $this->idw->ViewValue = null;
            }
            $this->idw->ViewCustomAttributes = "";

            // order_no
            $this->order_no->ViewValue = $this->order_no->CurrentValue;
            $this->order_no->ViewCustomAttributes = "";

            // item_in_ctn
            $this->item_in_ctn->ViewValue = $this->item_in_ctn->CurrentValue;
            $this->item_in_ctn->ViewValue = FormatNumber($this->item_in_ctn->ViewValue, $this->item_in_ctn->formatPattern());
            $this->item_in_ctn->ViewCustomAttributes = "";

            // no_of_ctn
            $this->no_of_ctn->ViewValue = $this->no_of_ctn->CurrentValue;
            $this->no_of_ctn->ViewValue = FormatNumber($this->no_of_ctn->ViewValue, $this->no_of_ctn->formatPattern());
            $this->no_of_ctn->ViewCustomAttributes = "";

            // ctn_no
            $this->ctn_no->ViewValue = $this->ctn_no->CurrentValue;
            $this->ctn_no->ViewValue = FormatNumber($this->ctn_no->ViewValue, $this->ctn_no->formatPattern());
            $this->ctn_no->ViewCustomAttributes = "";

            // checker
            $this->checker->ViewValue = $this->checker->CurrentValue;
            $this->checker->ViewCustomAttributes = "";

            // shift
            if (strval($this->shift->CurrentValue) != "") {
                $this->shift->ViewValue = $this->shift->optionCaption($this->shift->CurrentValue);
            } else {
                $this->shift->ViewValue = null;
            }
            $this->shift->ViewCustomAttributes = "";

            // status
            if (strval($this->status->CurrentValue) != "") {
                $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
            } else {
                $this->status->ViewValue = null;
            }
            $this->status->ViewCustomAttributes = "";

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
            $this->date_updated->ViewCustomAttributes = "";

            // time_updated
            $this->time_updated->ViewValue = $this->time_updated->CurrentValue;
            $this->time_updated->ViewValue = FormatDateTime($this->time_updated->ViewValue, $this->time_updated->formatPattern());
            $this->time_updated->ViewCustomAttributes = "";

            // date
            $this->date->LinkCustomAttributes = "";
            $this->date->HrefValue = "";

            // sscc
            $this->sscc->LinkCustomAttributes = "";
            $this->sscc->HrefValue = "";

            // scan
            $this->scan->LinkCustomAttributes = "";
            $this->scan->HrefValue = "";

            // shipment
            $this->shipment->LinkCustomAttributes = "";
            $this->shipment->HrefValue = "";

            // pallet_no
            $this->pallet_no->LinkCustomAttributes = "";
            $this->pallet_no->HrefValue = "";

            // idw
            $this->idw->LinkCustomAttributes = "";
            $this->idw->HrefValue = "";

            // order_no
            $this->order_no->LinkCustomAttributes = "";
            $this->order_no->HrefValue = "";

            // item_in_ctn
            $this->item_in_ctn->LinkCustomAttributes = "";
            $this->item_in_ctn->HrefValue = "";

            // no_of_ctn
            $this->no_of_ctn->LinkCustomAttributes = "";
            $this->no_of_ctn->HrefValue = "";

            // ctn_no
            $this->ctn_no->LinkCustomAttributes = "";
            $this->ctn_no->HrefValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";

            // shift
            $this->shift->LinkCustomAttributes = "";
            $this->shift->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";

            // time_updated
            $this->time_updated->LinkCustomAttributes = "";
            $this->time_updated->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // date
            $this->date->setupEditAttributes();
            $this->date->EditCustomAttributes = 'disabled';
            $this->date->EditValue = HtmlEncode(FormatDateTime($this->date->CurrentValue, $this->date->formatPattern()));
            $this->date->PlaceHolder = RemoveHtml($this->date->caption());

            // sscc
            $this->sscc->setupEditAttributes();
            $this->sscc->EditCustomAttributes = "";
            if (!$this->sscc->Raw) {
                $this->sscc->CurrentValue = HtmlDecode($this->sscc->CurrentValue);
            }
            $this->sscc->EditValue = HtmlEncode($this->sscc->CurrentValue);
            $this->sscc->PlaceHolder = RemoveHtml($this->sscc->caption());

            // scan
            $this->scan->setupEditAttributes();
            $this->scan->EditCustomAttributes = 'autofocus';
            if (!$this->scan->Raw) {
                $this->scan->CurrentValue = HtmlDecode($this->scan->CurrentValue);
            }
            $this->scan->EditValue = HtmlEncode($this->scan->CurrentValue);
            $this->scan->PlaceHolder = RemoveHtml($this->scan->caption());

            // shipment
            $this->shipment->setupEditAttributes();
            $this->shipment->EditCustomAttributes = "";
            if (!$this->shipment->Raw) {
                $this->shipment->CurrentValue = HtmlDecode($this->shipment->CurrentValue);
            }
            $this->shipment->EditValue = HtmlEncode($this->shipment->CurrentValue);
            $this->shipment->PlaceHolder = RemoveHtml($this->shipment->caption());

            // pallet_no
            $this->pallet_no->setupEditAttributes();
            $this->pallet_no->EditCustomAttributes = "";
            if (!$this->pallet_no->Raw) {
                $this->pallet_no->CurrentValue = HtmlDecode($this->pallet_no->CurrentValue);
            }
            $this->pallet_no->EditValue = HtmlEncode($this->pallet_no->CurrentValue);
            $this->pallet_no->PlaceHolder = RemoveHtml($this->pallet_no->caption());

            // idw
            $this->idw->EditCustomAttributes = "";
            $this->idw->EditValue = $this->idw->options(false);
            $this->idw->PlaceHolder = RemoveHtml($this->idw->caption());

            // order_no
            $this->order_no->setupEditAttributes();
            $this->order_no->EditCustomAttributes = "";
            $this->order_no->EditValue = HtmlEncode($this->order_no->CurrentValue);
            $this->order_no->PlaceHolder = RemoveHtml($this->order_no->caption());
            if (strval($this->order_no->EditValue) != "" && is_numeric($this->order_no->EditValue)) {
                $this->order_no->EditValue = $this->order_no->EditValue;
            }

            // item_in_ctn
            $this->item_in_ctn->setupEditAttributes();
            $this->item_in_ctn->EditCustomAttributes = "";
            $this->item_in_ctn->EditValue = HtmlEncode($this->item_in_ctn->CurrentValue);
            $this->item_in_ctn->PlaceHolder = RemoveHtml($this->item_in_ctn->caption());
            if (strval($this->item_in_ctn->EditValue) != "" && is_numeric($this->item_in_ctn->EditValue)) {
                $this->item_in_ctn->EditValue = FormatNumber($this->item_in_ctn->EditValue, null);
            }

            // no_of_ctn
            $this->no_of_ctn->setupEditAttributes();
            $this->no_of_ctn->EditCustomAttributes = "";
            $this->no_of_ctn->EditValue = HtmlEncode($this->no_of_ctn->CurrentValue);
            $this->no_of_ctn->PlaceHolder = RemoveHtml($this->no_of_ctn->caption());
            if (strval($this->no_of_ctn->EditValue) != "" && is_numeric($this->no_of_ctn->EditValue)) {
                $this->no_of_ctn->EditValue = FormatNumber($this->no_of_ctn->EditValue, null);
            }

            // ctn_no
            $this->ctn_no->setupEditAttributes();
            $this->ctn_no->EditCustomAttributes = "";
            $this->ctn_no->EditValue = HtmlEncode($this->ctn_no->CurrentValue);
            $this->ctn_no->PlaceHolder = RemoveHtml($this->ctn_no->caption());
            if (strval($this->ctn_no->EditValue) != "" && is_numeric($this->ctn_no->EditValue)) {
                $this->ctn_no->EditValue = FormatNumber($this->ctn_no->EditValue, null);
            }

            // checker
            $this->checker->setupEditAttributes();
            $this->checker->EditCustomAttributes = "";
            if (!$this->checker->Raw) {
                $this->checker->CurrentValue = HtmlDecode($this->checker->CurrentValue);
            }
            $this->checker->EditValue = HtmlEncode($this->checker->CurrentValue);
            $this->checker->PlaceHolder = RemoveHtml($this->checker->caption());

            // shift
            $this->shift->EditCustomAttributes = "";
            $this->shift->EditValue = $this->shift->options(false);
            $this->shift->PlaceHolder = RemoveHtml($this->shift->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            $this->status->EditValue = $this->status->options(true);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // date_updated
            $this->date_updated->setupEditAttributes();
            $this->date_updated->EditCustomAttributes = "";
            $this->date_updated->EditValue = HtmlEncode(FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()));
            $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

            // time_updated
            $this->time_updated->setupEditAttributes();
            $this->time_updated->EditCustomAttributes = "";
            $this->time_updated->EditValue = HtmlEncode(FormatDateTime($this->time_updated->CurrentValue, $this->time_updated->formatPattern()));
            $this->time_updated->PlaceHolder = RemoveHtml($this->time_updated->caption());

            // Add refer script

            // date
            $this->date->LinkCustomAttributes = "";
            $this->date->HrefValue = "";

            // sscc
            $this->sscc->LinkCustomAttributes = "";
            $this->sscc->HrefValue = "";

            // scan
            $this->scan->LinkCustomAttributes = "";
            $this->scan->HrefValue = "";

            // shipment
            $this->shipment->LinkCustomAttributes = "";
            $this->shipment->HrefValue = "";

            // pallet_no
            $this->pallet_no->LinkCustomAttributes = "";
            $this->pallet_no->HrefValue = "";

            // idw
            $this->idw->LinkCustomAttributes = "";
            $this->idw->HrefValue = "";

            // order_no
            $this->order_no->LinkCustomAttributes = "";
            $this->order_no->HrefValue = "";

            // item_in_ctn
            $this->item_in_ctn->LinkCustomAttributes = "";
            $this->item_in_ctn->HrefValue = "";

            // no_of_ctn
            $this->no_of_ctn->LinkCustomAttributes = "";
            $this->no_of_ctn->HrefValue = "";

            // ctn_no
            $this->ctn_no->LinkCustomAttributes = "";
            $this->ctn_no->HrefValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";

            // shift
            $this->shift->LinkCustomAttributes = "";
            $this->shift->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";

            // time_updated
            $this->time_updated->LinkCustomAttributes = "";
            $this->time_updated->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }

        // Save data for Custom Template
        if ($this->RowType == ROWTYPE_VIEW || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_ADD) {
            $this->Rows[] = $this->customTemplateFieldValues();
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
        if ($this->date->Required) {
            if (!$this->date->IsDetailKey && EmptyValue($this->date->FormValue)) {
                $this->date->addErrorMessage(str_replace("%s", $this->date->caption(), $this->date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date->FormValue, $this->date->formatPattern())) {
            $this->date->addErrorMessage($this->date->getErrorMessage(false));
        }
        if ($this->sscc->Required) {
            if (!$this->sscc->IsDetailKey && EmptyValue($this->sscc->FormValue)) {
                $this->sscc->addErrorMessage(str_replace("%s", $this->sscc->caption(), $this->sscc->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sscc->FormValue)) {
            $this->sscc->addErrorMessage($this->sscc->getErrorMessage(false));
        }
        if ($this->scan->Required) {
            if (!$this->scan->IsDetailKey && EmptyValue($this->scan->FormValue)) {
                $this->scan->addErrorMessage(str_replace("%s", $this->scan->caption(), $this->scan->RequiredErrorMessage));
            }
        }
        if ($this->shipment->Required) {
            if (!$this->shipment->IsDetailKey && EmptyValue($this->shipment->FormValue)) {
                $this->shipment->addErrorMessage(str_replace("%s", $this->shipment->caption(), $this->shipment->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->shipment->FormValue)) {
            $this->shipment->addErrorMessage($this->shipment->getErrorMessage(false));
        }
        if ($this->pallet_no->Required) {
            if (!$this->pallet_no->IsDetailKey && EmptyValue($this->pallet_no->FormValue)) {
                $this->pallet_no->addErrorMessage(str_replace("%s", $this->pallet_no->caption(), $this->pallet_no->RequiredErrorMessage));
            }
        }
        if ($this->idw->Required) {
            if ($this->idw->FormValue == "") {
                $this->idw->addErrorMessage(str_replace("%s", $this->idw->caption(), $this->idw->RequiredErrorMessage));
            }
        }
        if ($this->order_no->Required) {
            if (!$this->order_no->IsDetailKey && EmptyValue($this->order_no->FormValue)) {
                $this->order_no->addErrorMessage(str_replace("%s", $this->order_no->caption(), $this->order_no->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->order_no->FormValue)) {
            $this->order_no->addErrorMessage($this->order_no->getErrorMessage(false));
        }
        if ($this->item_in_ctn->Required) {
            if (!$this->item_in_ctn->IsDetailKey && EmptyValue($this->item_in_ctn->FormValue)) {
                $this->item_in_ctn->addErrorMessage(str_replace("%s", $this->item_in_ctn->caption(), $this->item_in_ctn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->item_in_ctn->FormValue)) {
            $this->item_in_ctn->addErrorMessage($this->item_in_ctn->getErrorMessage(false));
        }
        if ($this->no_of_ctn->Required) {
            if (!$this->no_of_ctn->IsDetailKey && EmptyValue($this->no_of_ctn->FormValue)) {
                $this->no_of_ctn->addErrorMessage(str_replace("%s", $this->no_of_ctn->caption(), $this->no_of_ctn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_of_ctn->FormValue)) {
            $this->no_of_ctn->addErrorMessage($this->no_of_ctn->getErrorMessage(false));
        }
        if ($this->ctn_no->Required) {
            if (!$this->ctn_no->IsDetailKey && EmptyValue($this->ctn_no->FormValue)) {
                $this->ctn_no->addErrorMessage(str_replace("%s", $this->ctn_no->caption(), $this->ctn_no->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ctn_no->FormValue)) {
            $this->ctn_no->addErrorMessage($this->ctn_no->getErrorMessage(false));
        }
        if ($this->checker->Required) {
            if (!$this->checker->IsDetailKey && EmptyValue($this->checker->FormValue)) {
                $this->checker->addErrorMessage(str_replace("%s", $this->checker->caption(), $this->checker->RequiredErrorMessage));
            }
        }
        if ($this->shift->Required) {
            if ($this->shift->FormValue == "") {
                $this->shift->addErrorMessage(str_replace("%s", $this->shift->caption(), $this->shift->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->date_updated->Required) {
            if (!$this->date_updated->IsDetailKey && EmptyValue($this->date_updated->FormValue)) {
                $this->date_updated->addErrorMessage(str_replace("%s", $this->date_updated->caption(), $this->date_updated->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_updated->FormValue, $this->date_updated->formatPattern())) {
            $this->date_updated->addErrorMessage($this->date_updated->getErrorMessage(false));
        }
        if ($this->time_updated->Required) {
            if (!$this->time_updated->IsDetailKey && EmptyValue($this->time_updated->FormValue)) {
                $this->time_updated->addErrorMessage(str_replace("%s", $this->time_updated->caption(), $this->time_updated->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->time_updated->FormValue, $this->time_updated->formatPattern())) {
            $this->time_updated->addErrorMessage($this->time_updated->getErrorMessage(false));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // date
        $this->date->setDbValueDef($rsnew, UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern()), null, false);

        // sscc
        $this->sscc->setDbValueDef($rsnew, $this->sscc->CurrentValue, "", false);

        // scan
        $this->scan->setDbValueDef($rsnew, $this->scan->CurrentValue, "", false);

        // shipment
        $this->shipment->setDbValueDef($rsnew, $this->shipment->CurrentValue, null, false);

        // pallet_no
        $this->pallet_no->setDbValueDef($rsnew, $this->pallet_no->CurrentValue, null, false);

        // idw
        $this->idw->setDbValueDef($rsnew, $this->idw->CurrentValue, null, false);

        // order_no
        $this->order_no->setDbValueDef($rsnew, $this->order_no->CurrentValue, null, false);

        // item_in_ctn
        $this->item_in_ctn->setDbValueDef($rsnew, $this->item_in_ctn->CurrentValue, null, false);

        // no_of_ctn
        $this->no_of_ctn->setDbValueDef($rsnew, $this->no_of_ctn->CurrentValue, null, false);

        // ctn_no
        $this->ctn_no->setDbValueDef($rsnew, $this->ctn_no->CurrentValue, null, false);

        // checker
        $this->checker->setDbValueDef($rsnew, $this->checker->CurrentValue, null, false);

        // shift
        $this->shift->setDbValueDef($rsnew, $this->shift->CurrentValue, null, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

        // date_updated
        $this->date_updated->setDbValueDef($rsnew, UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()), null, false);

        // time_updated
        $this->time_updated->setDbValueDef($rsnew, UnFormatDateTime($this->time_updated->CurrentValue, $this->time_updated->formatPattern()), null, false);

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['sscc']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ossmanuallist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_idw":
                    break;
                case "x_shift":
                    break;
                case "x_status":
                    break;
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

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
        SetClientVar("GetShipment",GetShipment() );
        SetClientVar("GetPallet",GetPallet() );
        SetClientVar("GetShift",GetShift() );
        SetClientVar("GetOrder",GetOrder() );
        SetClientVar("GetIdw",GetIdw() );    
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

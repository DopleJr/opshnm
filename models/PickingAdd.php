<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PickingAdd extends Picking
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'picking';

    // Page object name
    public $PageObjName = "PickingAdd";

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

        // Table object (picking)
        if (!isset($GLOBALS["picking"]) || get_class($GLOBALS["picking"]) == PROJECT_NAMESPACE . "picking") {
            $GLOBALS["picking"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'picking');
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
                $tbl = Container("picking");
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
                    if ($pageName == "pickingview") {
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
        $this->id->Visible = false;
        $this->po_no->setVisibility();
        $this->to_no->setVisibility();
        $this->to_order_item->setVisibility();
        $this->to_priority->setVisibility();
        $this->to_priority_code->setVisibility();
        $this->source_storage_type->setVisibility();
        $this->source_storage_bin->setVisibility();
        $this->carton_number->setVisibility();
        $this->creation_date->setVisibility();
        $this->gr_number->setVisibility();
        $this->gr_date->setVisibility();
        $this->delivery->setVisibility();
        $this->store_id->setVisibility();
        $this->store_name->setVisibility();
        $this->article->setVisibility();
        $this->size_code->setVisibility();
        $this->size_desc->setVisibility();
        $this->color_code->setVisibility();
        $this->color_desc->setVisibility();
        $this->concept->setVisibility();
        $this->target_qty->setVisibility();
        $this->picked_qty->setVisibility();
        $this->variance_qty->setVisibility();
        $this->confirmation_date->setVisibility();
        $this->confirmation_time->setVisibility();
        $this->box_code->setVisibility();
        $this->box_type->setVisibility();
        $this->picker->setVisibility();
        $this->status->setVisibility();
        $this->remarks->setVisibility();
        $this->aisle->Visible = false;
        $this->area->Visible = false;
        $this->aisle2->Visible = false;
        $this->store_id2->Visible = false;
        $this->close_totes->Visible = false;
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
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
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
                    $this->terminate("pickinglist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "pickinglist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "pickingview") {
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
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'po_no' first before field var 'x_po_no'
        $val = $CurrentForm->hasValue("po_no") ? $CurrentForm->getValue("po_no") : $CurrentForm->getValue("x_po_no");
        if (!$this->po_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->po_no->Visible = false; // Disable update for API request
            } else {
                $this->po_no->setFormValue($val);
            }
        }

        // Check field name 'to_no' first before field var 'x_to_no'
        $val = $CurrentForm->hasValue("to_no") ? $CurrentForm->getValue("to_no") : $CurrentForm->getValue("x_to_no");
        if (!$this->to_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->to_no->Visible = false; // Disable update for API request
            } else {
                $this->to_no->setFormValue($val);
            }
        }

        // Check field name 'to_order_item' first before field var 'x_to_order_item'
        $val = $CurrentForm->hasValue("to_order_item") ? $CurrentForm->getValue("to_order_item") : $CurrentForm->getValue("x_to_order_item");
        if (!$this->to_order_item->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->to_order_item->Visible = false; // Disable update for API request
            } else {
                $this->to_order_item->setFormValue($val);
            }
        }

        // Check field name 'to_priority' first before field var 'x_to_priority'
        $val = $CurrentForm->hasValue("to_priority") ? $CurrentForm->getValue("to_priority") : $CurrentForm->getValue("x_to_priority");
        if (!$this->to_priority->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->to_priority->Visible = false; // Disable update for API request
            } else {
                $this->to_priority->setFormValue($val);
            }
        }

        // Check field name 'to_priority_code' first before field var 'x_to_priority_code'
        $val = $CurrentForm->hasValue("to_priority_code") ? $CurrentForm->getValue("to_priority_code") : $CurrentForm->getValue("x_to_priority_code");
        if (!$this->to_priority_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->to_priority_code->Visible = false; // Disable update for API request
            } else {
                $this->to_priority_code->setFormValue($val);
            }
        }

        // Check field name 'source_storage_type' first before field var 'x_source_storage_type'
        $val = $CurrentForm->hasValue("source_storage_type") ? $CurrentForm->getValue("source_storage_type") : $CurrentForm->getValue("x_source_storage_type");
        if (!$this->source_storage_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->source_storage_type->Visible = false; // Disable update for API request
            } else {
                $this->source_storage_type->setFormValue($val);
            }
        }

        // Check field name 'source_storage_bin' first before field var 'x_source_storage_bin'
        $val = $CurrentForm->hasValue("source_storage_bin") ? $CurrentForm->getValue("source_storage_bin") : $CurrentForm->getValue("x_source_storage_bin");
        if (!$this->source_storage_bin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->source_storage_bin->Visible = false; // Disable update for API request
            } else {
                $this->source_storage_bin->setFormValue($val);
            }
        }

        // Check field name 'carton_number' first before field var 'x_carton_number'
        $val = $CurrentForm->hasValue("carton_number") ? $CurrentForm->getValue("carton_number") : $CurrentForm->getValue("x_carton_number");
        if (!$this->carton_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->carton_number->Visible = false; // Disable update for API request
            } else {
                $this->carton_number->setFormValue($val);
            }
        }

        // Check field name 'creation_date' first before field var 'x_creation_date'
        $val = $CurrentForm->hasValue("creation_date") ? $CurrentForm->getValue("creation_date") : $CurrentForm->getValue("x_creation_date");
        if (!$this->creation_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->creation_date->Visible = false; // Disable update for API request
            } else {
                $this->creation_date->setFormValue($val, true, $validate);
            }
            $this->creation_date->CurrentValue = UnFormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern());
        }

        // Check field name 'gr_number' first before field var 'x_gr_number'
        $val = $CurrentForm->hasValue("gr_number") ? $CurrentForm->getValue("gr_number") : $CurrentForm->getValue("x_gr_number");
        if (!$this->gr_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gr_number->Visible = false; // Disable update for API request
            } else {
                $this->gr_number->setFormValue($val);
            }
        }

        // Check field name 'gr_date' first before field var 'x_gr_date'
        $val = $CurrentForm->hasValue("gr_date") ? $CurrentForm->getValue("gr_date") : $CurrentForm->getValue("x_gr_date");
        if (!$this->gr_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gr_date->Visible = false; // Disable update for API request
            } else {
                $this->gr_date->setFormValue($val, true, $validate);
            }
            $this->gr_date->CurrentValue = UnFormatDateTime($this->gr_date->CurrentValue, $this->gr_date->formatPattern());
        }

        // Check field name 'delivery' first before field var 'x_delivery'
        $val = $CurrentForm->hasValue("delivery") ? $CurrentForm->getValue("delivery") : $CurrentForm->getValue("x_delivery");
        if (!$this->delivery->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delivery->Visible = false; // Disable update for API request
            } else {
                $this->delivery->setFormValue($val);
            }
        }

        // Check field name 'store_id' first before field var 'x_store_id'
        $val = $CurrentForm->hasValue("store_id") ? $CurrentForm->getValue("store_id") : $CurrentForm->getValue("x_store_id");
        if (!$this->store_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->store_id->Visible = false; // Disable update for API request
            } else {
                $this->store_id->setFormValue($val);
            }
        }

        // Check field name 'store_name' first before field var 'x_store_name'
        $val = $CurrentForm->hasValue("store_name") ? $CurrentForm->getValue("store_name") : $CurrentForm->getValue("x_store_name");
        if (!$this->store_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->store_name->Visible = false; // Disable update for API request
            } else {
                $this->store_name->setFormValue($val);
            }
        }

        // Check field name 'article' first before field var 'x_article'
        $val = $CurrentForm->hasValue("article") ? $CurrentForm->getValue("article") : $CurrentForm->getValue("x_article");
        if (!$this->article->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->article->Visible = false; // Disable update for API request
            } else {
                $this->article->setFormValue($val);
            }
        }

        // Check field name 'size_code' first before field var 'x_size_code'
        $val = $CurrentForm->hasValue("size_code") ? $CurrentForm->getValue("size_code") : $CurrentForm->getValue("x_size_code");
        if (!$this->size_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->size_code->Visible = false; // Disable update for API request
            } else {
                $this->size_code->setFormValue($val);
            }
        }

        // Check field name 'size_desc' first before field var 'x_size_desc'
        $val = $CurrentForm->hasValue("size_desc") ? $CurrentForm->getValue("size_desc") : $CurrentForm->getValue("x_size_desc");
        if (!$this->size_desc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->size_desc->Visible = false; // Disable update for API request
            } else {
                $this->size_desc->setFormValue($val);
            }
        }

        // Check field name 'color_code' first before field var 'x_color_code'
        $val = $CurrentForm->hasValue("color_code") ? $CurrentForm->getValue("color_code") : $CurrentForm->getValue("x_color_code");
        if (!$this->color_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->color_code->Visible = false; // Disable update for API request
            } else {
                $this->color_code->setFormValue($val);
            }
        }

        // Check field name 'color_desc' first before field var 'x_color_desc'
        $val = $CurrentForm->hasValue("color_desc") ? $CurrentForm->getValue("color_desc") : $CurrentForm->getValue("x_color_desc");
        if (!$this->color_desc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->color_desc->Visible = false; // Disable update for API request
            } else {
                $this->color_desc->setFormValue($val);
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

        // Check field name 'target_qty' first before field var 'x_target_qty'
        $val = $CurrentForm->hasValue("target_qty") ? $CurrentForm->getValue("target_qty") : $CurrentForm->getValue("x_target_qty");
        if (!$this->target_qty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->target_qty->Visible = false; // Disable update for API request
            } else {
                $this->target_qty->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'picked_qty' first before field var 'x_picked_qty'
        $val = $CurrentForm->hasValue("picked_qty") ? $CurrentForm->getValue("picked_qty") : $CurrentForm->getValue("x_picked_qty");
        if (!$this->picked_qty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->picked_qty->Visible = false; // Disable update for API request
            } else {
                $this->picked_qty->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'variance_qty' first before field var 'x_variance_qty'
        $val = $CurrentForm->hasValue("variance_qty") ? $CurrentForm->getValue("variance_qty") : $CurrentForm->getValue("x_variance_qty");
        if (!$this->variance_qty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->variance_qty->Visible = false; // Disable update for API request
            } else {
                $this->variance_qty->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'confirmation_date' first before field var 'x_confirmation_date'
        $val = $CurrentForm->hasValue("confirmation_date") ? $CurrentForm->getValue("confirmation_date") : $CurrentForm->getValue("x_confirmation_date");
        if (!$this->confirmation_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->confirmation_date->Visible = false; // Disable update for API request
            } else {
                $this->confirmation_date->setFormValue($val, true, $validate);
            }
            $this->confirmation_date->CurrentValue = UnFormatDateTime($this->confirmation_date->CurrentValue, $this->confirmation_date->formatPattern());
        }

        // Check field name 'confirmation_time' first before field var 'x_confirmation_time'
        $val = $CurrentForm->hasValue("confirmation_time") ? $CurrentForm->getValue("confirmation_time") : $CurrentForm->getValue("x_confirmation_time");
        if (!$this->confirmation_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->confirmation_time->Visible = false; // Disable update for API request
            } else {
                $this->confirmation_time->setFormValue($val, true, $validate);
            }
            $this->confirmation_time->CurrentValue = UnFormatDateTime($this->confirmation_time->CurrentValue, $this->confirmation_time->formatPattern());
        }

        // Check field name 'box_code' first before field var 'x_box_code'
        $val = $CurrentForm->hasValue("box_code") ? $CurrentForm->getValue("box_code") : $CurrentForm->getValue("x_box_code");
        if (!$this->box_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->box_code->Visible = false; // Disable update for API request
            } else {
                $this->box_code->setFormValue($val);
            }
        }

        // Check field name 'box_type' first before field var 'x_box_type'
        $val = $CurrentForm->hasValue("box_type") ? $CurrentForm->getValue("box_type") : $CurrentForm->getValue("x_box_type");
        if (!$this->box_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->box_type->Visible = false; // Disable update for API request
            } else {
                $this->box_type->setFormValue($val);
            }
        }

        // Check field name 'picker' first before field var 'x_picker'
        $val = $CurrentForm->hasValue("picker") ? $CurrentForm->getValue("picker") : $CurrentForm->getValue("x_picker");
        if (!$this->picker->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->picker->Visible = false; // Disable update for API request
            } else {
                $this->picker->setFormValue($val);
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

        // Check field name 'remarks' first before field var 'x_remarks'
        $val = $CurrentForm->hasValue("remarks") ? $CurrentForm->getValue("remarks") : $CurrentForm->getValue("x_remarks");
        if (!$this->remarks->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->remarks->Visible = false; // Disable update for API request
            } else {
                $this->remarks->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->po_no->CurrentValue = $this->po_no->FormValue;
        $this->to_no->CurrentValue = $this->to_no->FormValue;
        $this->to_order_item->CurrentValue = $this->to_order_item->FormValue;
        $this->to_priority->CurrentValue = $this->to_priority->FormValue;
        $this->to_priority_code->CurrentValue = $this->to_priority_code->FormValue;
        $this->source_storage_type->CurrentValue = $this->source_storage_type->FormValue;
        $this->source_storage_bin->CurrentValue = $this->source_storage_bin->FormValue;
        $this->carton_number->CurrentValue = $this->carton_number->FormValue;
        $this->creation_date->CurrentValue = $this->creation_date->FormValue;
        $this->creation_date->CurrentValue = UnFormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern());
        $this->gr_number->CurrentValue = $this->gr_number->FormValue;
        $this->gr_date->CurrentValue = $this->gr_date->FormValue;
        $this->gr_date->CurrentValue = UnFormatDateTime($this->gr_date->CurrentValue, $this->gr_date->formatPattern());
        $this->delivery->CurrentValue = $this->delivery->FormValue;
        $this->store_id->CurrentValue = $this->store_id->FormValue;
        $this->store_name->CurrentValue = $this->store_name->FormValue;
        $this->article->CurrentValue = $this->article->FormValue;
        $this->size_code->CurrentValue = $this->size_code->FormValue;
        $this->size_desc->CurrentValue = $this->size_desc->FormValue;
        $this->color_code->CurrentValue = $this->color_code->FormValue;
        $this->color_desc->CurrentValue = $this->color_desc->FormValue;
        $this->concept->CurrentValue = $this->concept->FormValue;
        $this->target_qty->CurrentValue = $this->target_qty->FormValue;
        $this->picked_qty->CurrentValue = $this->picked_qty->FormValue;
        $this->variance_qty->CurrentValue = $this->variance_qty->FormValue;
        $this->confirmation_date->CurrentValue = $this->confirmation_date->FormValue;
        $this->confirmation_date->CurrentValue = UnFormatDateTime($this->confirmation_date->CurrentValue, $this->confirmation_date->formatPattern());
        $this->confirmation_time->CurrentValue = $this->confirmation_time->FormValue;
        $this->confirmation_time->CurrentValue = UnFormatDateTime($this->confirmation_time->CurrentValue, $this->confirmation_time->formatPattern());
        $this->box_code->CurrentValue = $this->box_code->FormValue;
        $this->box_type->CurrentValue = $this->box_type->FormValue;
        $this->picker->CurrentValue = $this->picker->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->remarks->CurrentValue = $this->remarks->FormValue;
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
        $this->po_no->setDbValue($row['po_no']);
        $this->to_no->setDbValue($row['to_no']);
        $this->to_order_item->setDbValue($row['to_order_item']);
        $this->to_priority->setDbValue($row['to_priority']);
        $this->to_priority_code->setDbValue($row['to_priority_code']);
        $this->source_storage_type->setDbValue($row['source_storage_type']);
        $this->source_storage_bin->setDbValue($row['source_storage_bin']);
        $this->carton_number->setDbValue($row['carton_number']);
        $this->creation_date->setDbValue($row['creation_date']);
        $this->gr_number->setDbValue($row['gr_number']);
        $this->gr_date->setDbValue($row['gr_date']);
        $this->delivery->setDbValue($row['delivery']);
        $this->store_id->setDbValue($row['store_id']);
        $this->store_name->setDbValue($row['store_name']);
        $this->article->setDbValue($row['article']);
        $this->size_code->setDbValue($row['size_code']);
        $this->size_desc->setDbValue($row['size_desc']);
        $this->color_code->setDbValue($row['color_code']);
        $this->color_desc->setDbValue($row['color_desc']);
        $this->concept->setDbValue($row['concept']);
        $this->target_qty->setDbValue($row['target_qty']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->variance_qty->setDbValue($row['variance_qty']);
        $this->confirmation_date->setDbValue($row['confirmation_date']);
        $this->confirmation_time->setDbValue($row['confirmation_time']);
        $this->box_code->setDbValue($row['box_code']);
        $this->box_type->setDbValue($row['box_type']);
        $this->picker->setDbValue($row['picker']);
        $this->status->setDbValue($row['status']);
        $this->remarks->setDbValue($row['remarks']);
        $this->aisle->setDbValue($row['aisle']);
        $this->area->setDbValue($row['area']);
        $this->aisle2->setDbValue($row['aisle2']);
        $this->store_id2->setDbValue($row['store_id2']);
        $this->close_totes->setDbValue($row['close_totes']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['po_no'] = $this->po_no->DefaultValue;
        $row['to_no'] = $this->to_no->DefaultValue;
        $row['to_order_item'] = $this->to_order_item->DefaultValue;
        $row['to_priority'] = $this->to_priority->DefaultValue;
        $row['to_priority_code'] = $this->to_priority_code->DefaultValue;
        $row['source_storage_type'] = $this->source_storage_type->DefaultValue;
        $row['source_storage_bin'] = $this->source_storage_bin->DefaultValue;
        $row['carton_number'] = $this->carton_number->DefaultValue;
        $row['creation_date'] = $this->creation_date->DefaultValue;
        $row['gr_number'] = $this->gr_number->DefaultValue;
        $row['gr_date'] = $this->gr_date->DefaultValue;
        $row['delivery'] = $this->delivery->DefaultValue;
        $row['store_id'] = $this->store_id->DefaultValue;
        $row['store_name'] = $this->store_name->DefaultValue;
        $row['article'] = $this->article->DefaultValue;
        $row['size_code'] = $this->size_code->DefaultValue;
        $row['size_desc'] = $this->size_desc->DefaultValue;
        $row['color_code'] = $this->color_code->DefaultValue;
        $row['color_desc'] = $this->color_desc->DefaultValue;
        $row['concept'] = $this->concept->DefaultValue;
        $row['target_qty'] = $this->target_qty->DefaultValue;
        $row['picked_qty'] = $this->picked_qty->DefaultValue;
        $row['variance_qty'] = $this->variance_qty->DefaultValue;
        $row['confirmation_date'] = $this->confirmation_date->DefaultValue;
        $row['confirmation_time'] = $this->confirmation_time->DefaultValue;
        $row['box_code'] = $this->box_code->DefaultValue;
        $row['box_type'] = $this->box_type->DefaultValue;
        $row['picker'] = $this->picker->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['remarks'] = $this->remarks->DefaultValue;
        $row['aisle'] = $this->aisle->DefaultValue;
        $row['area'] = $this->area->DefaultValue;
        $row['aisle2'] = $this->aisle2->DefaultValue;
        $row['store_id2'] = $this->store_id2->DefaultValue;
        $row['close_totes'] = $this->close_totes->DefaultValue;
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

        // po_no
        $this->po_no->RowCssClass = "row";

        // to_no
        $this->to_no->RowCssClass = "row";

        // to_order_item
        $this->to_order_item->RowCssClass = "row";

        // to_priority
        $this->to_priority->RowCssClass = "row";

        // to_priority_code
        $this->to_priority_code->RowCssClass = "row";

        // source_storage_type
        $this->source_storage_type->RowCssClass = "row";

        // source_storage_bin
        $this->source_storage_bin->RowCssClass = "row";

        // carton_number
        $this->carton_number->RowCssClass = "row";

        // creation_date
        $this->creation_date->RowCssClass = "row";

        // gr_number
        $this->gr_number->RowCssClass = "row";

        // gr_date
        $this->gr_date->RowCssClass = "row";

        // delivery
        $this->delivery->RowCssClass = "row";

        // store_id
        $this->store_id->RowCssClass = "row";

        // store_name
        $this->store_name->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // size_code
        $this->size_code->RowCssClass = "row";

        // size_desc
        $this->size_desc->RowCssClass = "row";

        // color_code
        $this->color_code->RowCssClass = "row";

        // color_desc
        $this->color_desc->RowCssClass = "row";

        // concept
        $this->concept->RowCssClass = "row";

        // target_qty
        $this->target_qty->RowCssClass = "row";

        // picked_qty
        $this->picked_qty->RowCssClass = "row";

        // variance_qty
        $this->variance_qty->RowCssClass = "row";

        // confirmation_date
        $this->confirmation_date->RowCssClass = "row";

        // confirmation_time
        $this->confirmation_time->RowCssClass = "row";

        // box_code
        $this->box_code->RowCssClass = "row";

        // box_type
        $this->box_type->RowCssClass = "row";

        // picker
        $this->picker->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // remarks
        $this->remarks->RowCssClass = "row";

        // aisle
        $this->aisle->RowCssClass = "row";

        // area
        $this->area->RowCssClass = "row";

        // aisle2
        $this->aisle2->RowCssClass = "row";

        // store_id2
        $this->store_id2->RowCssClass = "row";

        // close_totes
        $this->close_totes->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // po_no
            $this->po_no->ViewValue = $this->po_no->CurrentValue;
            $this->po_no->ViewCustomAttributes = "";

            // to_no
            $this->to_no->ViewValue = $this->to_no->CurrentValue;
            $this->to_no->ViewCustomAttributes = "";

            // to_order_item
            $this->to_order_item->ViewValue = $this->to_order_item->CurrentValue;
            $this->to_order_item->ViewCustomAttributes = "";

            // to_priority
            $this->to_priority->ViewValue = $this->to_priority->CurrentValue;
            $this->to_priority->ViewCustomAttributes = "";

            // to_priority_code
            $this->to_priority_code->ViewValue = $this->to_priority_code->CurrentValue;
            $this->to_priority_code->ViewCustomAttributes = "";

            // source_storage_type
            $this->source_storage_type->ViewValue = $this->source_storage_type->CurrentValue;
            $this->source_storage_type->ViewCustomAttributes = "";

            // source_storage_bin
            $this->source_storage_bin->ViewValue = $this->source_storage_bin->CurrentValue;
            $this->source_storage_bin->ViewCustomAttributes = "";

            // carton_number
            $this->carton_number->ViewValue = $this->carton_number->CurrentValue;
            $this->carton_number->ViewCustomAttributes = "";

            // creation_date
            $this->creation_date->ViewValue = $this->creation_date->CurrentValue;
            $this->creation_date->ViewValue = FormatDateTime($this->creation_date->ViewValue, $this->creation_date->formatPattern());
            $this->creation_date->ViewCustomAttributes = "";

            // gr_number
            $this->gr_number->ViewValue = $this->gr_number->CurrentValue;
            $this->gr_number->ViewCustomAttributes = "";

            // gr_date
            $this->gr_date->ViewValue = $this->gr_date->CurrentValue;
            $this->gr_date->ViewValue = FormatDateTime($this->gr_date->ViewValue, $this->gr_date->formatPattern());
            $this->gr_date->ViewCustomAttributes = "";

            // delivery
            $this->delivery->ViewValue = $this->delivery->CurrentValue;
            $this->delivery->ViewCustomAttributes = "";

            // store_id
            $this->store_id->ViewValue = $this->store_id->CurrentValue;
            $this->store_id->ViewCustomAttributes = "";

            // store_name
            $this->store_name->ViewValue = $this->store_name->CurrentValue;
            $this->store_name->ViewCustomAttributes = "";

            // article
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";

            // size_code
            $this->size_code->ViewValue = $this->size_code->CurrentValue;
            $this->size_code->ViewCustomAttributes = "";

            // size_desc
            $this->size_desc->ViewValue = $this->size_desc->CurrentValue;
            $this->size_desc->ViewCustomAttributes = "";

            // color_code
            $this->color_code->ViewValue = $this->color_code->CurrentValue;
            $this->color_code->ViewCustomAttributes = "";

            // color_desc
            $this->color_desc->ViewValue = $this->color_desc->CurrentValue;
            $this->color_desc->ViewCustomAttributes = "";

            // concept
            $this->concept->ViewValue = $this->concept->CurrentValue;
            $this->concept->ViewCustomAttributes = "";

            // target_qty
            $this->target_qty->ViewValue = $this->target_qty->CurrentValue;
            $this->target_qty->ViewValue = FormatNumber($this->target_qty->ViewValue, $this->target_qty->formatPattern());
            $this->target_qty->ViewCustomAttributes = "";

            // picked_qty
            $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
            $this->picked_qty->ViewValue = FormatNumber($this->picked_qty->ViewValue, $this->picked_qty->formatPattern());
            $this->picked_qty->ViewCustomAttributes = "";

            // variance_qty
            $this->variance_qty->ViewValue = $this->variance_qty->CurrentValue;
            $this->variance_qty->ViewValue = FormatNumber($this->variance_qty->ViewValue, $this->variance_qty->formatPattern());
            $this->variance_qty->ViewCustomAttributes = "";

            // confirmation_date
            $this->confirmation_date->ViewValue = $this->confirmation_date->CurrentValue;
            $this->confirmation_date->ViewValue = FormatDateTime($this->confirmation_date->ViewValue, $this->confirmation_date->formatPattern());
            $this->confirmation_date->ViewCustomAttributes = "";

            // confirmation_time
            $this->confirmation_time->ViewValue = $this->confirmation_time->CurrentValue;
            $this->confirmation_time->ViewValue = FormatDateTime($this->confirmation_time->ViewValue, $this->confirmation_time->formatPattern());
            $this->confirmation_time->ViewCustomAttributes = "";

            // box_code
            $this->box_code->ViewValue = $this->box_code->CurrentValue;
            $this->box_code->ViewCustomAttributes = "";

            // box_type
            $this->box_type->ViewValue = $this->box_type->CurrentValue;
            $this->box_type->ViewCustomAttributes = "";

            // picker
            $this->picker->ViewValue = $this->picker->CurrentValue;
            $this->picker->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // remarks
            $this->remarks->ViewValue = $this->remarks->CurrentValue;
            $this->remarks->ViewCustomAttributes = "";

            // po_no
            $this->po_no->LinkCustomAttributes = "";
            $this->po_no->HrefValue = "";

            // to_no
            $this->to_no->LinkCustomAttributes = "";
            $this->to_no->HrefValue = "";

            // to_order_item
            $this->to_order_item->LinkCustomAttributes = "";
            $this->to_order_item->HrefValue = "";

            // to_priority
            $this->to_priority->LinkCustomAttributes = "";
            $this->to_priority->HrefValue = "";

            // to_priority_code
            $this->to_priority_code->LinkCustomAttributes = "";
            $this->to_priority_code->HrefValue = "";

            // source_storage_type
            $this->source_storage_type->LinkCustomAttributes = "";
            $this->source_storage_type->HrefValue = "";

            // source_storage_bin
            $this->source_storage_bin->LinkCustomAttributes = "";
            $this->source_storage_bin->HrefValue = "";

            // carton_number
            $this->carton_number->LinkCustomAttributes = "";
            $this->carton_number->HrefValue = "";

            // creation_date
            $this->creation_date->LinkCustomAttributes = "";
            $this->creation_date->HrefValue = "";

            // gr_number
            $this->gr_number->LinkCustomAttributes = "";
            $this->gr_number->HrefValue = "";

            // gr_date
            $this->gr_date->LinkCustomAttributes = "";
            $this->gr_date->HrefValue = "";

            // delivery
            $this->delivery->LinkCustomAttributes = "";
            $this->delivery->HrefValue = "";

            // store_id
            $this->store_id->LinkCustomAttributes = "";
            $this->store_id->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // size_code
            $this->size_code->LinkCustomAttributes = "";
            $this->size_code->HrefValue = "";

            // size_desc
            $this->size_desc->LinkCustomAttributes = "";
            $this->size_desc->HrefValue = "";

            // color_code
            $this->color_code->LinkCustomAttributes = "";
            $this->color_code->HrefValue = "";

            // color_desc
            $this->color_desc->LinkCustomAttributes = "";
            $this->color_desc->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // target_qty
            $this->target_qty->LinkCustomAttributes = "";
            $this->target_qty->HrefValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";

            // variance_qty
            $this->variance_qty->LinkCustomAttributes = "";
            $this->variance_qty->HrefValue = "";

            // confirmation_date
            $this->confirmation_date->LinkCustomAttributes = "";
            $this->confirmation_date->HrefValue = "";

            // confirmation_time
            $this->confirmation_time->LinkCustomAttributes = "";
            $this->confirmation_time->HrefValue = "";

            // box_code
            $this->box_code->LinkCustomAttributes = "";
            $this->box_code->HrefValue = "";

            // box_type
            $this->box_type->LinkCustomAttributes = "";
            $this->box_type->HrefValue = "";

            // picker
            $this->picker->LinkCustomAttributes = "";
            $this->picker->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // remarks
            $this->remarks->LinkCustomAttributes = "";
            $this->remarks->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // po_no
            $this->po_no->setupEditAttributes();
            $this->po_no->EditCustomAttributes = "";
            if (!$this->po_no->Raw) {
                $this->po_no->CurrentValue = HtmlDecode($this->po_no->CurrentValue);
            }
            $this->po_no->EditValue = HtmlEncode($this->po_no->CurrentValue);
            $this->po_no->PlaceHolder = RemoveHtml($this->po_no->caption());

            // to_no
            $this->to_no->setupEditAttributes();
            $this->to_no->EditCustomAttributes = "";
            if (!$this->to_no->Raw) {
                $this->to_no->CurrentValue = HtmlDecode($this->to_no->CurrentValue);
            }
            $this->to_no->EditValue = HtmlEncode($this->to_no->CurrentValue);
            $this->to_no->PlaceHolder = RemoveHtml($this->to_no->caption());

            // to_order_item
            $this->to_order_item->setupEditAttributes();
            $this->to_order_item->EditCustomAttributes = "";
            if (!$this->to_order_item->Raw) {
                $this->to_order_item->CurrentValue = HtmlDecode($this->to_order_item->CurrentValue);
            }
            $this->to_order_item->EditValue = HtmlEncode($this->to_order_item->CurrentValue);
            $this->to_order_item->PlaceHolder = RemoveHtml($this->to_order_item->caption());

            // to_priority
            $this->to_priority->setupEditAttributes();
            $this->to_priority->EditCustomAttributes = "";
            if (!$this->to_priority->Raw) {
                $this->to_priority->CurrentValue = HtmlDecode($this->to_priority->CurrentValue);
            }
            $this->to_priority->EditValue = HtmlEncode($this->to_priority->CurrentValue);
            $this->to_priority->PlaceHolder = RemoveHtml($this->to_priority->caption());

            // to_priority_code
            $this->to_priority_code->setupEditAttributes();
            $this->to_priority_code->EditCustomAttributes = "";
            if (!$this->to_priority_code->Raw) {
                $this->to_priority_code->CurrentValue = HtmlDecode($this->to_priority_code->CurrentValue);
            }
            $this->to_priority_code->EditValue = HtmlEncode($this->to_priority_code->CurrentValue);
            $this->to_priority_code->PlaceHolder = RemoveHtml($this->to_priority_code->caption());

            // source_storage_type
            $this->source_storage_type->setupEditAttributes();
            $this->source_storage_type->EditCustomAttributes = "";
            if (!$this->source_storage_type->Raw) {
                $this->source_storage_type->CurrentValue = HtmlDecode($this->source_storage_type->CurrentValue);
            }
            $this->source_storage_type->EditValue = HtmlEncode($this->source_storage_type->CurrentValue);
            $this->source_storage_type->PlaceHolder = RemoveHtml($this->source_storage_type->caption());

            // source_storage_bin
            $this->source_storage_bin->setupEditAttributes();
            $this->source_storage_bin->EditCustomAttributes = "";
            if (!$this->source_storage_bin->Raw) {
                $this->source_storage_bin->CurrentValue = HtmlDecode($this->source_storage_bin->CurrentValue);
            }
            $this->source_storage_bin->EditValue = HtmlEncode($this->source_storage_bin->CurrentValue);
            $this->source_storage_bin->PlaceHolder = RemoveHtml($this->source_storage_bin->caption());

            // carton_number
            $this->carton_number->setupEditAttributes();
            $this->carton_number->EditCustomAttributes = "";
            if (!$this->carton_number->Raw) {
                $this->carton_number->CurrentValue = HtmlDecode($this->carton_number->CurrentValue);
            }
            $this->carton_number->EditValue = HtmlEncode($this->carton_number->CurrentValue);
            $this->carton_number->PlaceHolder = RemoveHtml($this->carton_number->caption());

            // creation_date
            $this->creation_date->setupEditAttributes();
            $this->creation_date->EditCustomAttributes = "";
            $this->creation_date->EditValue = HtmlEncode(FormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern()));
            $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

            // gr_number
            $this->gr_number->setupEditAttributes();
            $this->gr_number->EditCustomAttributes = "";
            if (!$this->gr_number->Raw) {
                $this->gr_number->CurrentValue = HtmlDecode($this->gr_number->CurrentValue);
            }
            $this->gr_number->EditValue = HtmlEncode($this->gr_number->CurrentValue);
            $this->gr_number->PlaceHolder = RemoveHtml($this->gr_number->caption());

            // gr_date
            $this->gr_date->setupEditAttributes();
            $this->gr_date->EditCustomAttributes = "";
            $this->gr_date->EditValue = HtmlEncode(FormatDateTime($this->gr_date->CurrentValue, $this->gr_date->formatPattern()));
            $this->gr_date->PlaceHolder = RemoveHtml($this->gr_date->caption());

            // delivery
            $this->delivery->setupEditAttributes();
            $this->delivery->EditCustomAttributes = "";
            if (!$this->delivery->Raw) {
                $this->delivery->CurrentValue = HtmlDecode($this->delivery->CurrentValue);
            }
            $this->delivery->EditValue = HtmlEncode($this->delivery->CurrentValue);
            $this->delivery->PlaceHolder = RemoveHtml($this->delivery->caption());

            // store_id
            $this->store_id->setupEditAttributes();
            $this->store_id->EditCustomAttributes = "";
            if (!$this->store_id->Raw) {
                $this->store_id->CurrentValue = HtmlDecode($this->store_id->CurrentValue);
            }
            $this->store_id->EditValue = HtmlEncode($this->store_id->CurrentValue);
            $this->store_id->PlaceHolder = RemoveHtml($this->store_id->caption());

            // store_name
            $this->store_name->setupEditAttributes();
            $this->store_name->EditCustomAttributes = "";
            if (!$this->store_name->Raw) {
                $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
            }
            $this->store_name->EditValue = HtmlEncode($this->store_name->CurrentValue);
            $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

            // article
            $this->article->setupEditAttributes();
            $this->article->EditCustomAttributes = "";
            if (!$this->article->Raw) {
                $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
            }
            $this->article->EditValue = HtmlEncode($this->article->CurrentValue);
            $this->article->PlaceHolder = RemoveHtml($this->article->caption());

            // size_code
            $this->size_code->setupEditAttributes();
            $this->size_code->EditCustomAttributes = "";
            if (!$this->size_code->Raw) {
                $this->size_code->CurrentValue = HtmlDecode($this->size_code->CurrentValue);
            }
            $this->size_code->EditValue = HtmlEncode($this->size_code->CurrentValue);
            $this->size_code->PlaceHolder = RemoveHtml($this->size_code->caption());

            // size_desc
            $this->size_desc->setupEditAttributes();
            $this->size_desc->EditCustomAttributes = "";
            if (!$this->size_desc->Raw) {
                $this->size_desc->CurrentValue = HtmlDecode($this->size_desc->CurrentValue);
            }
            $this->size_desc->EditValue = HtmlEncode($this->size_desc->CurrentValue);
            $this->size_desc->PlaceHolder = RemoveHtml($this->size_desc->caption());

            // color_code
            $this->color_code->setupEditAttributes();
            $this->color_code->EditCustomAttributes = "";
            if (!$this->color_code->Raw) {
                $this->color_code->CurrentValue = HtmlDecode($this->color_code->CurrentValue);
            }
            $this->color_code->EditValue = HtmlEncode($this->color_code->CurrentValue);
            $this->color_code->PlaceHolder = RemoveHtml($this->color_code->caption());

            // color_desc
            $this->color_desc->setupEditAttributes();
            $this->color_desc->EditCustomAttributes = "";
            if (!$this->color_desc->Raw) {
                $this->color_desc->CurrentValue = HtmlDecode($this->color_desc->CurrentValue);
            }
            $this->color_desc->EditValue = HtmlEncode($this->color_desc->CurrentValue);
            $this->color_desc->PlaceHolder = RemoveHtml($this->color_desc->caption());

            // concept
            $this->concept->setupEditAttributes();
            $this->concept->EditCustomAttributes = "";
            if (!$this->concept->Raw) {
                $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
            }
            $this->concept->EditValue = HtmlEncode($this->concept->CurrentValue);
            $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

            // target_qty
            $this->target_qty->setupEditAttributes();
            $this->target_qty->EditCustomAttributes = "";
            $this->target_qty->EditValue = HtmlEncode($this->target_qty->CurrentValue);
            $this->target_qty->PlaceHolder = RemoveHtml($this->target_qty->caption());
            if (strval($this->target_qty->EditValue) != "" && is_numeric($this->target_qty->EditValue)) {
                $this->target_qty->EditValue = FormatNumber($this->target_qty->EditValue, null);
            }

            // picked_qty
            $this->picked_qty->setupEditAttributes();
            $this->picked_qty->EditCustomAttributes = "";
            $this->picked_qty->EditValue = HtmlEncode($this->picked_qty->CurrentValue);
            $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());
            if (strval($this->picked_qty->EditValue) != "" && is_numeric($this->picked_qty->EditValue)) {
                $this->picked_qty->EditValue = FormatNumber($this->picked_qty->EditValue, null);
            }

            // variance_qty
            $this->variance_qty->setupEditAttributes();
            $this->variance_qty->EditCustomAttributes = "";
            $this->variance_qty->EditValue = HtmlEncode($this->variance_qty->CurrentValue);
            $this->variance_qty->PlaceHolder = RemoveHtml($this->variance_qty->caption());
            if (strval($this->variance_qty->EditValue) != "" && is_numeric($this->variance_qty->EditValue)) {
                $this->variance_qty->EditValue = FormatNumber($this->variance_qty->EditValue, null);
            }

            // confirmation_date
            $this->confirmation_date->setupEditAttributes();
            $this->confirmation_date->EditCustomAttributes = "";
            $this->confirmation_date->EditValue = HtmlEncode(FormatDateTime($this->confirmation_date->CurrentValue, $this->confirmation_date->formatPattern()));
            $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());

            // confirmation_time
            $this->confirmation_time->setupEditAttributes();
            $this->confirmation_time->EditCustomAttributes = "";
            $this->confirmation_time->EditValue = HtmlEncode(FormatDateTime($this->confirmation_time->CurrentValue, $this->confirmation_time->formatPattern()));
            $this->confirmation_time->PlaceHolder = RemoveHtml($this->confirmation_time->caption());

            // box_code
            $this->box_code->setupEditAttributes();
            $this->box_code->EditCustomAttributes = "";
            if (!$this->box_code->Raw) {
                $this->box_code->CurrentValue = HtmlDecode($this->box_code->CurrentValue);
            }
            $this->box_code->EditValue = HtmlEncode($this->box_code->CurrentValue);
            $this->box_code->PlaceHolder = RemoveHtml($this->box_code->caption());

            // box_type
            $this->box_type->setupEditAttributes();
            $this->box_type->EditCustomAttributes = "";
            if (!$this->box_type->Raw) {
                $this->box_type->CurrentValue = HtmlDecode($this->box_type->CurrentValue);
            }
            $this->box_type->EditValue = HtmlEncode($this->box_type->CurrentValue);
            $this->box_type->PlaceHolder = RemoveHtml($this->box_type->caption());

            // picker
            $this->picker->setupEditAttributes();
            $this->picker->EditCustomAttributes = "";
            if (!$this->picker->Raw) {
                $this->picker->CurrentValue = HtmlDecode($this->picker->CurrentValue);
            }
            $this->picker->EditValue = HtmlEncode($this->picker->CurrentValue);
            $this->picker->PlaceHolder = RemoveHtml($this->picker->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // remarks
            $this->remarks->setupEditAttributes();
            $this->remarks->EditCustomAttributes = "";
            if (!$this->remarks->Raw) {
                $this->remarks->CurrentValue = HtmlDecode($this->remarks->CurrentValue);
            }
            $this->remarks->EditValue = HtmlEncode($this->remarks->CurrentValue);
            $this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

            // Add refer script

            // po_no
            $this->po_no->LinkCustomAttributes = "";
            $this->po_no->HrefValue = "";

            // to_no
            $this->to_no->LinkCustomAttributes = "";
            $this->to_no->HrefValue = "";

            // to_order_item
            $this->to_order_item->LinkCustomAttributes = "";
            $this->to_order_item->HrefValue = "";

            // to_priority
            $this->to_priority->LinkCustomAttributes = "";
            $this->to_priority->HrefValue = "";

            // to_priority_code
            $this->to_priority_code->LinkCustomAttributes = "";
            $this->to_priority_code->HrefValue = "";

            // source_storage_type
            $this->source_storage_type->LinkCustomAttributes = "";
            $this->source_storage_type->HrefValue = "";

            // source_storage_bin
            $this->source_storage_bin->LinkCustomAttributes = "";
            $this->source_storage_bin->HrefValue = "";

            // carton_number
            $this->carton_number->LinkCustomAttributes = "";
            $this->carton_number->HrefValue = "";

            // creation_date
            $this->creation_date->LinkCustomAttributes = "";
            $this->creation_date->HrefValue = "";

            // gr_number
            $this->gr_number->LinkCustomAttributes = "";
            $this->gr_number->HrefValue = "";

            // gr_date
            $this->gr_date->LinkCustomAttributes = "";
            $this->gr_date->HrefValue = "";

            // delivery
            $this->delivery->LinkCustomAttributes = "";
            $this->delivery->HrefValue = "";

            // store_id
            $this->store_id->LinkCustomAttributes = "";
            $this->store_id->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // size_code
            $this->size_code->LinkCustomAttributes = "";
            $this->size_code->HrefValue = "";

            // size_desc
            $this->size_desc->LinkCustomAttributes = "";
            $this->size_desc->HrefValue = "";

            // color_code
            $this->color_code->LinkCustomAttributes = "";
            $this->color_code->HrefValue = "";

            // color_desc
            $this->color_desc->LinkCustomAttributes = "";
            $this->color_desc->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // target_qty
            $this->target_qty->LinkCustomAttributes = "";
            $this->target_qty->HrefValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";

            // variance_qty
            $this->variance_qty->LinkCustomAttributes = "";
            $this->variance_qty->HrefValue = "";

            // confirmation_date
            $this->confirmation_date->LinkCustomAttributes = "";
            $this->confirmation_date->HrefValue = "";

            // confirmation_time
            $this->confirmation_time->LinkCustomAttributes = "";
            $this->confirmation_time->HrefValue = "";

            // box_code
            $this->box_code->LinkCustomAttributes = "";
            $this->box_code->HrefValue = "";

            // box_type
            $this->box_type->LinkCustomAttributes = "";
            $this->box_type->HrefValue = "";

            // picker
            $this->picker->LinkCustomAttributes = "";
            $this->picker->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // remarks
            $this->remarks->LinkCustomAttributes = "";
            $this->remarks->HrefValue = "";
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
        if ($this->po_no->Required) {
            if (!$this->po_no->IsDetailKey && EmptyValue($this->po_no->FormValue)) {
                $this->po_no->addErrorMessage(str_replace("%s", $this->po_no->caption(), $this->po_no->RequiredErrorMessage));
            }
        }
        if ($this->to_no->Required) {
            if (!$this->to_no->IsDetailKey && EmptyValue($this->to_no->FormValue)) {
                $this->to_no->addErrorMessage(str_replace("%s", $this->to_no->caption(), $this->to_no->RequiredErrorMessage));
            }
        }
        if ($this->to_order_item->Required) {
            if (!$this->to_order_item->IsDetailKey && EmptyValue($this->to_order_item->FormValue)) {
                $this->to_order_item->addErrorMessage(str_replace("%s", $this->to_order_item->caption(), $this->to_order_item->RequiredErrorMessage));
            }
        }
        if ($this->to_priority->Required) {
            if (!$this->to_priority->IsDetailKey && EmptyValue($this->to_priority->FormValue)) {
                $this->to_priority->addErrorMessage(str_replace("%s", $this->to_priority->caption(), $this->to_priority->RequiredErrorMessage));
            }
        }
        if ($this->to_priority_code->Required) {
            if (!$this->to_priority_code->IsDetailKey && EmptyValue($this->to_priority_code->FormValue)) {
                $this->to_priority_code->addErrorMessage(str_replace("%s", $this->to_priority_code->caption(), $this->to_priority_code->RequiredErrorMessage));
            }
        }
        if ($this->source_storage_type->Required) {
            if (!$this->source_storage_type->IsDetailKey && EmptyValue($this->source_storage_type->FormValue)) {
                $this->source_storage_type->addErrorMessage(str_replace("%s", $this->source_storage_type->caption(), $this->source_storage_type->RequiredErrorMessage));
            }
        }
        if ($this->source_storage_bin->Required) {
            if (!$this->source_storage_bin->IsDetailKey && EmptyValue($this->source_storage_bin->FormValue)) {
                $this->source_storage_bin->addErrorMessage(str_replace("%s", $this->source_storage_bin->caption(), $this->source_storage_bin->RequiredErrorMessage));
            }
        }
        if ($this->carton_number->Required) {
            if (!$this->carton_number->IsDetailKey && EmptyValue($this->carton_number->FormValue)) {
                $this->carton_number->addErrorMessage(str_replace("%s", $this->carton_number->caption(), $this->carton_number->RequiredErrorMessage));
            }
        }
        if ($this->creation_date->Required) {
            if (!$this->creation_date->IsDetailKey && EmptyValue($this->creation_date->FormValue)) {
                $this->creation_date->addErrorMessage(str_replace("%s", $this->creation_date->caption(), $this->creation_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->creation_date->FormValue, $this->creation_date->formatPattern())) {
            $this->creation_date->addErrorMessage($this->creation_date->getErrorMessage(false));
        }
        if ($this->gr_number->Required) {
            if (!$this->gr_number->IsDetailKey && EmptyValue($this->gr_number->FormValue)) {
                $this->gr_number->addErrorMessage(str_replace("%s", $this->gr_number->caption(), $this->gr_number->RequiredErrorMessage));
            }
        }
        if ($this->gr_date->Required) {
            if (!$this->gr_date->IsDetailKey && EmptyValue($this->gr_date->FormValue)) {
                $this->gr_date->addErrorMessage(str_replace("%s", $this->gr_date->caption(), $this->gr_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->gr_date->FormValue, $this->gr_date->formatPattern())) {
            $this->gr_date->addErrorMessage($this->gr_date->getErrorMessage(false));
        }
        if ($this->delivery->Required) {
            if (!$this->delivery->IsDetailKey && EmptyValue($this->delivery->FormValue)) {
                $this->delivery->addErrorMessage(str_replace("%s", $this->delivery->caption(), $this->delivery->RequiredErrorMessage));
            }
        }
        if ($this->store_id->Required) {
            if (!$this->store_id->IsDetailKey && EmptyValue($this->store_id->FormValue)) {
                $this->store_id->addErrorMessage(str_replace("%s", $this->store_id->caption(), $this->store_id->RequiredErrorMessage));
            }
        }
        if ($this->store_name->Required) {
            if (!$this->store_name->IsDetailKey && EmptyValue($this->store_name->FormValue)) {
                $this->store_name->addErrorMessage(str_replace("%s", $this->store_name->caption(), $this->store_name->RequiredErrorMessage));
            }
        }
        if ($this->article->Required) {
            if (!$this->article->IsDetailKey && EmptyValue($this->article->FormValue)) {
                $this->article->addErrorMessage(str_replace("%s", $this->article->caption(), $this->article->RequiredErrorMessage));
            }
        }
        if ($this->size_code->Required) {
            if (!$this->size_code->IsDetailKey && EmptyValue($this->size_code->FormValue)) {
                $this->size_code->addErrorMessage(str_replace("%s", $this->size_code->caption(), $this->size_code->RequiredErrorMessage));
            }
        }
        if ($this->size_desc->Required) {
            if (!$this->size_desc->IsDetailKey && EmptyValue($this->size_desc->FormValue)) {
                $this->size_desc->addErrorMessage(str_replace("%s", $this->size_desc->caption(), $this->size_desc->RequiredErrorMessage));
            }
        }
        if ($this->color_code->Required) {
            if (!$this->color_code->IsDetailKey && EmptyValue($this->color_code->FormValue)) {
                $this->color_code->addErrorMessage(str_replace("%s", $this->color_code->caption(), $this->color_code->RequiredErrorMessage));
            }
        }
        if ($this->color_desc->Required) {
            if (!$this->color_desc->IsDetailKey && EmptyValue($this->color_desc->FormValue)) {
                $this->color_desc->addErrorMessage(str_replace("%s", $this->color_desc->caption(), $this->color_desc->RequiredErrorMessage));
            }
        }
        if ($this->concept->Required) {
            if (!$this->concept->IsDetailKey && EmptyValue($this->concept->FormValue)) {
                $this->concept->addErrorMessage(str_replace("%s", $this->concept->caption(), $this->concept->RequiredErrorMessage));
            }
        }
        if ($this->target_qty->Required) {
            if (!$this->target_qty->IsDetailKey && EmptyValue($this->target_qty->FormValue)) {
                $this->target_qty->addErrorMessage(str_replace("%s", $this->target_qty->caption(), $this->target_qty->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->target_qty->FormValue)) {
            $this->target_qty->addErrorMessage($this->target_qty->getErrorMessage(false));
        }
        if ($this->picked_qty->Required) {
            if (!$this->picked_qty->IsDetailKey && EmptyValue($this->picked_qty->FormValue)) {
                $this->picked_qty->addErrorMessage(str_replace("%s", $this->picked_qty->caption(), $this->picked_qty->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->picked_qty->FormValue)) {
            $this->picked_qty->addErrorMessage($this->picked_qty->getErrorMessage(false));
        }
        if ($this->variance_qty->Required) {
            if (!$this->variance_qty->IsDetailKey && EmptyValue($this->variance_qty->FormValue)) {
                $this->variance_qty->addErrorMessage(str_replace("%s", $this->variance_qty->caption(), $this->variance_qty->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->variance_qty->FormValue)) {
            $this->variance_qty->addErrorMessage($this->variance_qty->getErrorMessage(false));
        }
        if ($this->confirmation_date->Required) {
            if (!$this->confirmation_date->IsDetailKey && EmptyValue($this->confirmation_date->FormValue)) {
                $this->confirmation_date->addErrorMessage(str_replace("%s", $this->confirmation_date->caption(), $this->confirmation_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->confirmation_date->FormValue, $this->confirmation_date->formatPattern())) {
            $this->confirmation_date->addErrorMessage($this->confirmation_date->getErrorMessage(false));
        }
        if ($this->confirmation_time->Required) {
            if (!$this->confirmation_time->IsDetailKey && EmptyValue($this->confirmation_time->FormValue)) {
                $this->confirmation_time->addErrorMessage(str_replace("%s", $this->confirmation_time->caption(), $this->confirmation_time->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->confirmation_time->FormValue, $this->confirmation_time->formatPattern())) {
            $this->confirmation_time->addErrorMessage($this->confirmation_time->getErrorMessage(false));
        }
        if ($this->box_code->Required) {
            if (!$this->box_code->IsDetailKey && EmptyValue($this->box_code->FormValue)) {
                $this->box_code->addErrorMessage(str_replace("%s", $this->box_code->caption(), $this->box_code->RequiredErrorMessage));
            }
        }
        if ($this->box_type->Required) {
            if (!$this->box_type->IsDetailKey && EmptyValue($this->box_type->FormValue)) {
                $this->box_type->addErrorMessage(str_replace("%s", $this->box_type->caption(), $this->box_type->RequiredErrorMessage));
            }
        }
        if ($this->picker->Required) {
            if (!$this->picker->IsDetailKey && EmptyValue($this->picker->FormValue)) {
                $this->picker->addErrorMessage(str_replace("%s", $this->picker->caption(), $this->picker->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->remarks->Required) {
            if (!$this->remarks->IsDetailKey && EmptyValue($this->remarks->FormValue)) {
                $this->remarks->addErrorMessage(str_replace("%s", $this->remarks->caption(), $this->remarks->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // po_no
        $this->po_no->setDbValueDef($rsnew, $this->po_no->CurrentValue, null, false);

        // to_no
        $this->to_no->setDbValueDef($rsnew, $this->to_no->CurrentValue, null, false);

        // to_order_item
        $this->to_order_item->setDbValueDef($rsnew, $this->to_order_item->CurrentValue, null, false);

        // to_priority
        $this->to_priority->setDbValueDef($rsnew, $this->to_priority->CurrentValue, null, false);

        // to_priority_code
        $this->to_priority_code->setDbValueDef($rsnew, $this->to_priority_code->CurrentValue, null, false);

        // source_storage_type
        $this->source_storage_type->setDbValueDef($rsnew, $this->source_storage_type->CurrentValue, null, false);

        // source_storage_bin
        $this->source_storage_bin->setDbValueDef($rsnew, $this->source_storage_bin->CurrentValue, null, false);

        // carton_number
        $this->carton_number->setDbValueDef($rsnew, $this->carton_number->CurrentValue, null, false);

        // creation_date
        $this->creation_date->setDbValueDef($rsnew, UnFormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern()), null, false);

        // gr_number
        $this->gr_number->setDbValueDef($rsnew, $this->gr_number->CurrentValue, null, false);

        // gr_date
        $this->gr_date->setDbValueDef($rsnew, UnFormatDateTime($this->gr_date->CurrentValue, $this->gr_date->formatPattern()), null, false);

        // delivery
        $this->delivery->setDbValueDef($rsnew, $this->delivery->CurrentValue, null, false);

        // store_id
        $this->store_id->setDbValueDef($rsnew, $this->store_id->CurrentValue, null, false);

        // store_name
        $this->store_name->setDbValueDef($rsnew, $this->store_name->CurrentValue, null, false);

        // article
        $this->article->setDbValueDef($rsnew, $this->article->CurrentValue, null, false);

        // size_code
        $this->size_code->setDbValueDef($rsnew, $this->size_code->CurrentValue, null, false);

        // size_desc
        $this->size_desc->setDbValueDef($rsnew, $this->size_desc->CurrentValue, null, false);

        // color_code
        $this->color_code->setDbValueDef($rsnew, $this->color_code->CurrentValue, null, false);

        // color_desc
        $this->color_desc->setDbValueDef($rsnew, $this->color_desc->CurrentValue, null, false);

        // concept
        $this->concept->setDbValueDef($rsnew, $this->concept->CurrentValue, null, false);

        // target_qty
        $this->target_qty->setDbValueDef($rsnew, $this->target_qty->CurrentValue, null, false);

        // picked_qty
        $this->picked_qty->setDbValueDef($rsnew, $this->picked_qty->CurrentValue, null, false);

        // variance_qty
        $this->variance_qty->setDbValueDef($rsnew, $this->variance_qty->CurrentValue, null, false);

        // confirmation_date
        $this->confirmation_date->setDbValueDef($rsnew, UnFormatDateTime($this->confirmation_date->CurrentValue, $this->confirmation_date->formatPattern()), null, false);

        // confirmation_time
        $this->confirmation_time->setDbValueDef($rsnew, UnFormatDateTime($this->confirmation_time->CurrentValue, $this->confirmation_time->formatPattern()), null, false);

        // box_code
        $this->box_code->setDbValueDef($rsnew, $this->box_code->CurrentValue, null, false);

        // box_type
        $this->box_type->setDbValueDef($rsnew, $this->box_type->CurrentValue, null, false);

        // picker
        $this->picker->setDbValueDef($rsnew, $this->picker->CurrentValue, null, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

        // remarks
        $this->remarks->setDbValueDef($rsnew, $this->remarks->CurrentValue, null, false);

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pickinglist"), "", $this->TableVar, true);
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

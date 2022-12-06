<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class InboundExcessAdd extends InboundExcess
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'inbound_excess';

    // Page object name
    public $PageObjName = "InboundExcessAdd";

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

        // Table object (inbound_excess)
        if (!isset($GLOBALS["inbound_excess"]) || get_class($GLOBALS["inbound_excess"]) == PROJECT_NAMESPACE . "inbound_excess") {
            $GLOBALS["inbound_excess"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'inbound_excess');
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
                $tbl = Container("inbound_excess");
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
                    if ($pageName == "inboundexcessview") {
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
        $this->total_scanned->setVisibility();
        $this->sscc->setVisibility();
        $this->pallet_id->setVisibility();
        $this->users->setVisibility();
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
                    $this->terminate("inboundexcesslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "inboundexcesslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "inboundexcessview") {
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
        $this->total_scanned->DefaultValue = GetTotalRecord2();
        $this->total_scanned->OldValue = $this->total_scanned->DefaultValue;
        $this->pallet_id->DefaultValue = GetPalletID();
        $this->pallet_id->OldValue = $this->pallet_id->DefaultValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'total_scanned' first before field var 'x_total_scanned'
        $val = $CurrentForm->hasValue("total_scanned") ? $CurrentForm->getValue("total_scanned") : $CurrentForm->getValue("x_total_scanned");
        if (!$this->total_scanned->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total_scanned->Visible = false; // Disable update for API request
            } else {
                $this->total_scanned->setFormValue($val);
            }
        }

        // Check field name 'sscc' first before field var 'x_sscc'
        $val = $CurrentForm->hasValue("sscc") ? $CurrentForm->getValue("sscc") : $CurrentForm->getValue("x_sscc");
        if (!$this->sscc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sscc->Visible = false; // Disable update for API request
            } else {
                $this->sscc->setFormValue($val);
            }
        }

        // Check field name 'pallet_id' first before field var 'x_pallet_id'
        $val = $CurrentForm->hasValue("pallet_id") ? $CurrentForm->getValue("pallet_id") : $CurrentForm->getValue("x_pallet_id");
        if (!$this->pallet_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pallet_id->Visible = false; // Disable update for API request
            } else {
                $this->pallet_id->setFormValue($val);
            }
        }

        // Check field name 'users' first before field var 'x_users'
        $val = $CurrentForm->hasValue("users") ? $CurrentForm->getValue("users") : $CurrentForm->getValue("x_users");
        if (!$this->users->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->users->Visible = false; // Disable update for API request
            } else {
                $this->users->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->total_scanned->CurrentValue = $this->total_scanned->FormValue;
        $this->sscc->CurrentValue = $this->sscc->FormValue;
        $this->pallet_id->CurrentValue = $this->pallet_id->FormValue;
        $this->users->CurrentValue = $this->users->FormValue;
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
        $this->total_scanned->setDbValue($row['total_scanned']);
        $this->sscc->setDbValue($row['sscc']);
        $this->pallet_id->setDbValue($row['pallet_id']);
        $this->users->setDbValue($row['users']);
        $this->date_update->setDbValue($row['date_update']);
        $this->time_update->setDbValue($row['time_update']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['total_scanned'] = $this->total_scanned->DefaultValue;
        $row['sscc'] = $this->sscc->DefaultValue;
        $row['pallet_id'] = $this->pallet_id->DefaultValue;
        $row['users'] = $this->users->DefaultValue;
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

        // total_scanned
        $this->total_scanned->RowCssClass = "row";

        // sscc
        $this->sscc->RowCssClass = "row";

        // pallet_id
        $this->pallet_id->RowCssClass = "row";

        // users
        $this->users->RowCssClass = "row";

        // date_update
        $this->date_update->RowCssClass = "row";

        // time_update
        $this->time_update->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // total_scanned
            $this->total_scanned->ViewValue = $this->total_scanned->CurrentValue;
            $this->total_scanned->ViewCustomAttributes = "";

            // sscc
            $this->sscc->ViewValue = $this->sscc->CurrentValue;
            $this->sscc->ViewCustomAttributes = "";

            // pallet_id
            $this->pallet_id->ViewValue = $this->pallet_id->CurrentValue;
            $this->pallet_id->ViewCustomAttributes = "";

            // users
            $this->users->ViewValue = $this->users->CurrentValue;
            $this->users->ViewCustomAttributes = "";

            // date_update
            $this->date_update->ViewValue = $this->date_update->CurrentValue;
            $this->date_update->ViewValue = FormatDateTime($this->date_update->ViewValue, $this->date_update->formatPattern());
            $this->date_update->ViewCustomAttributes = "";

            // time_update
            $this->time_update->ViewValue = $this->time_update->CurrentValue;
            $this->time_update->ViewValue = FormatDateTime($this->time_update->ViewValue, $this->time_update->formatPattern());
            $this->time_update->ViewCustomAttributes = "";

            // total_scanned
            $this->total_scanned->LinkCustomAttributes = "";
            $this->total_scanned->HrefValue = "";

            // sscc
            $this->sscc->LinkCustomAttributes = "";
            $this->sscc->HrefValue = "";

            // pallet_id
            $this->pallet_id->LinkCustomAttributes = "";
            $this->pallet_id->HrefValue = "";

            // users
            $this->users->LinkCustomAttributes = "";
            $this->users->HrefValue = "";

            // date_update
            $this->date_update->LinkCustomAttributes = "";
            $this->date_update->HrefValue = "";

            // time_update
            $this->time_update->LinkCustomAttributes = "";
            $this->time_update->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // total_scanned
            $this->total_scanned->setupEditAttributes();
            $this->total_scanned->EditCustomAttributes = 'readonly';
            if (!$this->total_scanned->Raw) {
                $this->total_scanned->CurrentValue = HtmlDecode($this->total_scanned->CurrentValue);
            }
            $this->total_scanned->EditValue = HtmlEncode($this->total_scanned->CurrentValue);
            $this->total_scanned->PlaceHolder = RemoveHtml($this->total_scanned->caption());

            // sscc
            $this->sscc->setupEditAttributes();
            $this->sscc->EditCustomAttributes = "";
            if (!$this->sscc->Raw) {
                $this->sscc->CurrentValue = HtmlDecode($this->sscc->CurrentValue);
            }
            $this->sscc->EditValue = HtmlEncode($this->sscc->CurrentValue);
            $this->sscc->PlaceHolder = RemoveHtml($this->sscc->caption());

            // pallet_id
            $this->pallet_id->setupEditAttributes();
            $this->pallet_id->EditCustomAttributes = "";
            if (!$this->pallet_id->Raw) {
                $this->pallet_id->CurrentValue = HtmlDecode($this->pallet_id->CurrentValue);
            }
            $this->pallet_id->EditValue = HtmlEncode($this->pallet_id->CurrentValue);
            $this->pallet_id->PlaceHolder = RemoveHtml($this->pallet_id->caption());

            // users

            // date_update

            // time_update

            // Add refer script

            // total_scanned
            $this->total_scanned->LinkCustomAttributes = "";
            $this->total_scanned->HrefValue = "";

            // sscc
            $this->sscc->LinkCustomAttributes = "";
            $this->sscc->HrefValue = "";

            // pallet_id
            $this->pallet_id->LinkCustomAttributes = "";
            $this->pallet_id->HrefValue = "";

            // users
            $this->users->LinkCustomAttributes = "";
            $this->users->HrefValue = "";

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
        if ($this->total_scanned->Required) {
            if (!$this->total_scanned->IsDetailKey && EmptyValue($this->total_scanned->FormValue)) {
                $this->total_scanned->addErrorMessage(str_replace("%s", $this->total_scanned->caption(), $this->total_scanned->RequiredErrorMessage));
            }
        }
        if ($this->sscc->Required) {
            if (!$this->sscc->IsDetailKey && EmptyValue($this->sscc->FormValue)) {
                $this->sscc->addErrorMessage(str_replace("%s", $this->sscc->caption(), $this->sscc->RequiredErrorMessage));
            }
        }
        if ($this->pallet_id->Required) {
            if (!$this->pallet_id->IsDetailKey && EmptyValue($this->pallet_id->FormValue)) {
                $this->pallet_id->addErrorMessage(str_replace("%s", $this->pallet_id->caption(), $this->pallet_id->RequiredErrorMessage));
            }
        }
        if ($this->users->Required) {
            if (!$this->users->IsDetailKey && EmptyValue($this->users->FormValue)) {
                $this->users->addErrorMessage(str_replace("%s", $this->users->caption(), $this->users->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // total_scanned
        $this->total_scanned->setDbValueDef($rsnew, $this->total_scanned->CurrentValue, "", false);

        // sscc
        $this->sscc->setDbValueDef($rsnew, $this->sscc->CurrentValue, "", false);

        // pallet_id
        $this->pallet_id->setDbValueDef($rsnew, $this->pallet_id->CurrentValue, "", false);

        // users
        $this->users->CurrentValue = CurrentUserName();
        $this->users->setDbValueDef($rsnew, $this->users->CurrentValue, null);

        // date_update
        $this->date_update->CurrentValue = CurrentDate();
        $this->date_update->setDbValueDef($rsnew, $this->date_update->CurrentValue, null);

        // time_update
        $this->time_update->CurrentValue = CurrentTime();
        $this->time_update->setDbValueDef($rsnew, $this->time_update->CurrentValue, null);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("inboundexcesslist"), "", $this->TableVar, true);
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

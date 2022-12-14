<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class CycleCountOfflineAdd extends CycleCountOffline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'cycle_count_offline';

    // Page object name
    public $PageObjName = "CycleCountOfflineAdd";

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

        // Table object (cycle_count_offline)
        if (!isset($GLOBALS["cycle_count_offline"]) || get_class($GLOBALS["cycle_count_offline"]) == PROJECT_NAMESPACE . "cycle_count_offline") {
            $GLOBALS["cycle_count_offline"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'cycle_count_offline');
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
                $tbl = Container("cycle_count_offline");
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
                    if ($pageName == "cyclecountofflineview") {
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
        $this->location->setVisibility();
        $this->su->setVisibility();
        $this->scan->setVisibility();
        $this->gtin->setVisibility();
        $this->gtin2->setVisibility();
        $this->gtin3->setVisibility();
        $this->article->setVisibility();
        $this->user->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->setVisibility();
        $this->divisi->Visible = false;
        $this->get_total->setVisibility();
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
                    $this->terminate("cyclecountofflinelist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "cyclecountofflinelist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "cyclecountofflineview") {
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
        $this->location->DefaultValue = GetLastestLocation();
        $this->location->OldValue = $this->location->DefaultValue;
        $this->su->DefaultValue = GetLastestSU();
        $this->su->OldValue = $this->su->DefaultValue;
        $this->user->DefaultValue = CurrentUserName();
        $this->user->OldValue = $this->user->DefaultValue;
        $this->date_created->DefaultValue = CurrentDate();
        $this->date_created->OldValue = $this->date_created->DefaultValue;
        $this->get_total->DefaultValue = GetTotalRecord();
        $this->get_total->OldValue = $this->get_total->DefaultValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'location' first before field var 'x_location'
        $val = $CurrentForm->hasValue("location") ? $CurrentForm->getValue("location") : $CurrentForm->getValue("x_location");
        if (!$this->location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location->Visible = false; // Disable update for API request
            } else {
                $this->location->setFormValue($val);
            }
        }

        // Check field name 'su' first before field var 'x_su'
        $val = $CurrentForm->hasValue("su") ? $CurrentForm->getValue("su") : $CurrentForm->getValue("x_su");
        if (!$this->su->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->su->Visible = false; // Disable update for API request
            } else {
                $this->su->setFormValue($val);
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

        // Check field name 'gtin' first before field var 'x_gtin'
        $val = $CurrentForm->hasValue("gtin") ? $CurrentForm->getValue("gtin") : $CurrentForm->getValue("x_gtin");
        if (!$this->gtin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gtin->Visible = false; // Disable update for API request
            } else {
                $this->gtin->setFormValue($val);
            }
        }

        // Check field name 'gtin2' first before field var 'x_gtin2'
        $val = $CurrentForm->hasValue("gtin2") ? $CurrentForm->getValue("gtin2") : $CurrentForm->getValue("x_gtin2");
        if (!$this->gtin2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gtin2->Visible = false; // Disable update for API request
            } else {
                $this->gtin2->setFormValue($val);
            }
        }

        // Check field name 'gtin3' first before field var 'x_gtin3'
        $val = $CurrentForm->hasValue("gtin3") ? $CurrentForm->getValue("gtin3") : $CurrentForm->getValue("x_gtin3");
        if (!$this->gtin3->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gtin3->Visible = false; // Disable update for API request
            } else {
                $this->gtin3->setFormValue($val);
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

        // Check field name 'user' first before field var 'x_user'
        $val = $CurrentForm->hasValue("user") ? $CurrentForm->getValue("user") : $CurrentForm->getValue("x_user");
        if (!$this->user->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user->Visible = false; // Disable update for API request
            } else {
                $this->user->setFormValue($val);
            }
        }

        // Check field name 'date_updated' first before field var 'x_date_updated'
        $val = $CurrentForm->hasValue("date_updated") ? $CurrentForm->getValue("date_updated") : $CurrentForm->getValue("x_date_updated");
        if (!$this->date_updated->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_updated->Visible = false; // Disable update for API request
            } else {
                $this->date_updated->setFormValue($val);
            }
            $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        }

        // Check field name 'get_total' first before field var 'x_get_total'
        $val = $CurrentForm->hasValue("get_total") ? $CurrentForm->getValue("get_total") : $CurrentForm->getValue("x_get_total");
        if (!$this->get_total->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->get_total->Visible = false; // Disable update for API request
            } else {
                $this->get_total->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->location->CurrentValue = $this->location->FormValue;
        $this->su->CurrentValue = $this->su->FormValue;
        $this->scan->CurrentValue = $this->scan->FormValue;
        $this->gtin->CurrentValue = $this->gtin->FormValue;
        $this->gtin2->CurrentValue = $this->gtin2->FormValue;
        $this->gtin3->CurrentValue = $this->gtin3->FormValue;
        $this->article->CurrentValue = $this->article->FormValue;
        $this->user->CurrentValue = $this->user->FormValue;
        $this->date_updated->CurrentValue = $this->date_updated->FormValue;
        $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        $this->get_total->CurrentValue = $this->get_total->FormValue;
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
        $this->location->setDbValue($row['location']);
        $this->su->setDbValue($row['su']);
        $this->scan->setDbValue($row['scan']);
        $this->gtin->setDbValue($row['gtin']);
        $this->gtin2->setDbValue($row['gtin2']);
        $this->gtin3->setDbValue($row['gtin3']);
        $this->article->setDbValue($row['article']);
        $this->user->setDbValue($row['user']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->divisi->setDbValue($row['divisi']);
        $this->get_total->setDbValue($row['get_total']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['location'] = $this->location->DefaultValue;
        $row['su'] = $this->su->DefaultValue;
        $row['scan'] = $this->scan->DefaultValue;
        $row['gtin'] = $this->gtin->DefaultValue;
        $row['gtin2'] = $this->gtin2->DefaultValue;
        $row['gtin3'] = $this->gtin3->DefaultValue;
        $row['article'] = $this->article->DefaultValue;
        $row['user'] = $this->user->DefaultValue;
        $row['date_created'] = $this->date_created->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
        $row['divisi'] = $this->divisi->DefaultValue;
        $row['get_total'] = $this->get_total->DefaultValue;
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

        // location
        $this->location->RowCssClass = "row";

        // su
        $this->su->RowCssClass = "row";

        // scan
        $this->scan->RowCssClass = "row";

        // gtin
        $this->gtin->RowCssClass = "row";

        // gtin2
        $this->gtin2->RowCssClass = "row";

        // gtin3
        $this->gtin3->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // user
        $this->user->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // divisi
        $this->divisi->RowCssClass = "row";

        // get_total
        $this->get_total->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location
            $this->location->ViewValue = $this->location->CurrentValue;
            $this->location->ViewCustomAttributes = "";

            // su
            $this->su->ViewValue = $this->su->CurrentValue;
            $this->su->ViewCustomAttributes = "";

            // scan
            $this->scan->ViewValue = $this->scan->CurrentValue;
            $this->scan->ViewCustomAttributes = "";

            // gtin
            $this->gtin->ViewValue = $this->gtin->CurrentValue;
            $this->gtin->ViewCustomAttributes = "";

            // gtin2
            $this->gtin2->ViewValue = $this->gtin2->CurrentValue;
            $this->gtin2->ViewCustomAttributes = "";

            // gtin3
            $this->gtin3->ViewValue = $this->gtin3->CurrentValue;
            $this->gtin3->ViewCustomAttributes = "";

            // article
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";

            // user
            $this->user->ViewValue = $this->user->CurrentValue;
            $this->user->ViewCustomAttributes = "";

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
            $this->date_created->ViewCustomAttributes = "";

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
            $this->date_updated->ViewCustomAttributes = "";

            // get_total
            $this->get_total->ViewValue = $this->get_total->CurrentValue;
            $this->get_total->ViewCustomAttributes = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // su
            $this->su->LinkCustomAttributes = "";
            $this->su->HrefValue = "";

            // scan
            $this->scan->LinkCustomAttributes = "";
            $this->scan->HrefValue = "";

            // gtin
            $this->gtin->LinkCustomAttributes = "";
            $this->gtin->HrefValue = "";

            // gtin2
            $this->gtin2->LinkCustomAttributes = "";
            $this->gtin2->HrefValue = "";

            // gtin3
            $this->gtin3->LinkCustomAttributes = "";
            $this->gtin3->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";

            // get_total
            $this->get_total->LinkCustomAttributes = "";
            $this->get_total->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // location
            $this->location->setupEditAttributes();
            $this->location->EditCustomAttributes = "";
            if (!$this->location->Raw) {
                $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
            }
            $this->location->EditValue = HtmlEncode($this->location->CurrentValue);
            $this->location->PlaceHolder = RemoveHtml($this->location->caption());

            // su
            $this->su->setupEditAttributes();
            $this->su->EditCustomAttributes = "";
            if (!$this->su->Raw) {
                $this->su->CurrentValue = HtmlDecode($this->su->CurrentValue);
            }
            $this->su->EditValue = HtmlEncode($this->su->CurrentValue);
            $this->su->PlaceHolder = RemoveHtml($this->su->caption());

            // scan
            $this->scan->setupEditAttributes();
            $this->scan->EditCustomAttributes = "";
            if (!$this->scan->Raw) {
                $this->scan->CurrentValue = HtmlDecode($this->scan->CurrentValue);
            }
            $this->scan->EditValue = HtmlEncode($this->scan->CurrentValue);
            $this->scan->PlaceHolder = RemoveHtml($this->scan->caption());

            // gtin
            $this->gtin->setupEditAttributes();
            $this->gtin->EditCustomAttributes = 'readonly';
            if (!$this->gtin->Raw) {
                $this->gtin->CurrentValue = HtmlDecode($this->gtin->CurrentValue);
            }
            $this->gtin->EditValue = HtmlEncode($this->gtin->CurrentValue);
            $this->gtin->PlaceHolder = RemoveHtml($this->gtin->caption());

            // gtin2
            $this->gtin2->setupEditAttributes();
            $this->gtin2->EditCustomAttributes = 'readonly';
            if (!$this->gtin2->Raw) {
                $this->gtin2->CurrentValue = HtmlDecode($this->gtin2->CurrentValue);
            }
            $this->gtin2->EditValue = HtmlEncode($this->gtin2->CurrentValue);
            $this->gtin2->PlaceHolder = RemoveHtml($this->gtin2->caption());

            // gtin3
            $this->gtin3->setupEditAttributes();
            $this->gtin3->EditCustomAttributes = 'readonly';
            if (!$this->gtin3->Raw) {
                $this->gtin3->CurrentValue = HtmlDecode($this->gtin3->CurrentValue);
            }
            $this->gtin3->EditValue = HtmlEncode($this->gtin3->CurrentValue);
            $this->gtin3->PlaceHolder = RemoveHtml($this->gtin3->caption());

            // article
            $this->article->setupEditAttributes();
            $this->article->EditCustomAttributes = 'readonly';
            if (!$this->article->Raw) {
                $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
            }
            $this->article->EditValue = HtmlEncode($this->article->CurrentValue);
            $this->article->PlaceHolder = RemoveHtml($this->article->caption());

            // user

            // date_updated

            // get_total
            $this->get_total->setupEditAttributes();
            $this->get_total->EditCustomAttributes = 'readonly';
            if (!$this->get_total->Raw) {
                $this->get_total->CurrentValue = HtmlDecode($this->get_total->CurrentValue);
            }
            $this->get_total->EditValue = HtmlEncode($this->get_total->CurrentValue);
            $this->get_total->PlaceHolder = RemoveHtml($this->get_total->caption());

            // Add refer script

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // su
            $this->su->LinkCustomAttributes = "";
            $this->su->HrefValue = "";

            // scan
            $this->scan->LinkCustomAttributes = "";
            $this->scan->HrefValue = "";

            // gtin
            $this->gtin->LinkCustomAttributes = "";
            $this->gtin->HrefValue = "";

            // gtin2
            $this->gtin2->LinkCustomAttributes = "";
            $this->gtin2->HrefValue = "";

            // gtin3
            $this->gtin3->LinkCustomAttributes = "";
            $this->gtin3->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";

            // get_total
            $this->get_total->LinkCustomAttributes = "";
            $this->get_total->HrefValue = "";
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
        if ($this->location->Required) {
            if (!$this->location->IsDetailKey && EmptyValue($this->location->FormValue)) {
                $this->location->addErrorMessage(str_replace("%s", $this->location->caption(), $this->location->RequiredErrorMessage));
            }
        }
        if ($this->su->Required) {
            if (!$this->su->IsDetailKey && EmptyValue($this->su->FormValue)) {
                $this->su->addErrorMessage(str_replace("%s", $this->su->caption(), $this->su->RequiredErrorMessage));
            }
        }
        if ($this->scan->Required) {
            if (!$this->scan->IsDetailKey && EmptyValue($this->scan->FormValue)) {
                $this->scan->addErrorMessage(str_replace("%s", $this->scan->caption(), $this->scan->RequiredErrorMessage));
            }
        }
        if ($this->gtin->Required) {
            if (!$this->gtin->IsDetailKey && EmptyValue($this->gtin->FormValue)) {
                $this->gtin->addErrorMessage(str_replace("%s", $this->gtin->caption(), $this->gtin->RequiredErrorMessage));
            }
        }
        if ($this->gtin2->Required) {
            if (!$this->gtin2->IsDetailKey && EmptyValue($this->gtin2->FormValue)) {
                $this->gtin2->addErrorMessage(str_replace("%s", $this->gtin2->caption(), $this->gtin2->RequiredErrorMessage));
            }
        }
        if ($this->gtin3->Required) {
            if (!$this->gtin3->IsDetailKey && EmptyValue($this->gtin3->FormValue)) {
                $this->gtin3->addErrorMessage(str_replace("%s", $this->gtin3->caption(), $this->gtin3->RequiredErrorMessage));
            }
        }
        if ($this->article->Required) {
            if (!$this->article->IsDetailKey && EmptyValue($this->article->FormValue)) {
                $this->article->addErrorMessage(str_replace("%s", $this->article->caption(), $this->article->RequiredErrorMessage));
            }
        }
        if ($this->user->Required) {
            if (!$this->user->IsDetailKey && EmptyValue($this->user->FormValue)) {
                $this->user->addErrorMessage(str_replace("%s", $this->user->caption(), $this->user->RequiredErrorMessage));
            }
        }
        if ($this->date_updated->Required) {
            if (!$this->date_updated->IsDetailKey && EmptyValue($this->date_updated->FormValue)) {
                $this->date_updated->addErrorMessage(str_replace("%s", $this->date_updated->caption(), $this->date_updated->RequiredErrorMessage));
            }
        }
        if ($this->get_total->Required) {
            if (!$this->get_total->IsDetailKey && EmptyValue($this->get_total->FormValue)) {
                $this->get_total->addErrorMessage(str_replace("%s", $this->get_total->caption(), $this->get_total->RequiredErrorMessage));
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

        // location
        $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, null, false);

        // su
        $this->su->setDbValueDef($rsnew, $this->su->CurrentValue, null, false);

        // scan
        $this->scan->setDbValueDef($rsnew, $this->scan->CurrentValue, null, false);

        // gtin
        $this->gtin->setDbValueDef($rsnew, $this->gtin->CurrentValue, "", false);

        // gtin2
        $this->gtin2->setDbValueDef($rsnew, $this->gtin2->CurrentValue, "", false);

        // gtin3
        $this->gtin3->setDbValueDef($rsnew, $this->gtin3->CurrentValue, "", false);

        // article
        $this->article->setDbValueDef($rsnew, $this->article->CurrentValue, null, false);

        // user
        $this->user->CurrentValue = CurrentUserName();
        $this->user->setDbValueDef($rsnew, $this->user->CurrentValue, null);

        // date_updated
        $this->date_updated->CurrentValue = CurrentDate();
        $this->date_updated->setDbValueDef($rsnew, $this->date_updated->CurrentValue, null);

        // get_total
        $this->get_total->setDbValueDef($rsnew, $this->get_total->CurrentValue, "", false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("cyclecountofflinelist"), "", $this->TableVar, true);
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

<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ExtraStockAdd extends ExtraStock
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'extra_stock';

    // Page object name
    public $PageObjName = "ExtraStockAdd";

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

        // Table object (extra_stock)
        if (!isset($GLOBALS["extra_stock"]) || get_class($GLOBALS["extra_stock"]) == PROJECT_NAMESPACE . "extra_stock") {
            $GLOBALS["extra_stock"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'extra_stock');
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
                $tbl = Container("extra_stock");
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
                    if ($pageName == "extrastockview") {
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
        $this->week->Visible = false;
        $this->art6->Visible = false;
        $this->art9->Visible = false;
        $this->art11->Visible = false;
        $this->article->setVisibility();
        $this->location->setVisibility();
        $this->ctn->setVisibility();
        $this->quantity->setVisibility();
        $this->size_desc->setVisibility();
        $this->color_desc->setVisibility();
        $this->size_code->setVisibility();
        $this->season->setVisibility();
        $this->no_box->setVisibility();
        $this->location_2nd->setVisibility();
        $this->date_created->setVisibility();
        $this->date_updated->setVisibility();
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
        $this->setupLookupOptions($this->article);

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
                    $this->terminate("extrastocklist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "extrastocklist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "extrastockview") {
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
        $this->date_created->DefaultValue = CurrentDate();
        $this->date_created->OldValue = $this->date_created->DefaultValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'article' first before field var 'x_article'
        $val = $CurrentForm->hasValue("article") ? $CurrentForm->getValue("article") : $CurrentForm->getValue("x_article");
        if (!$this->article->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->article->Visible = false; // Disable update for API request
            } else {
                $this->article->setFormValue($val);
            }
        }

        // Check field name 'location' first before field var 'x_location'
        $val = $CurrentForm->hasValue("location") ? $CurrentForm->getValue("location") : $CurrentForm->getValue("x_location");
        if (!$this->location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location->Visible = false; // Disable update for API request
            } else {
                $this->location->setFormValue($val);
            }
        }

        // Check field name 'ctn' first before field var 'x_ctn'
        $val = $CurrentForm->hasValue("ctn") ? $CurrentForm->getValue("ctn") : $CurrentForm->getValue("x_ctn");
        if (!$this->ctn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ctn->Visible = false; // Disable update for API request
            } else {
                $this->ctn->setFormValue($val);
            }
        }

        // Check field name 'quantity' first before field var 'x_quantity'
        $val = $CurrentForm->hasValue("quantity") ? $CurrentForm->getValue("quantity") : $CurrentForm->getValue("x_quantity");
        if (!$this->quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->quantity->Visible = false; // Disable update for API request
            } else {
                $this->quantity->setFormValue($val, true, $validate);
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

        // Check field name 'color_desc' first before field var 'x_color_desc'
        $val = $CurrentForm->hasValue("color_desc") ? $CurrentForm->getValue("color_desc") : $CurrentForm->getValue("x_color_desc");
        if (!$this->color_desc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->color_desc->Visible = false; // Disable update for API request
            } else {
                $this->color_desc->setFormValue($val);
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

        // Check field name 'season' first before field var 'x_season'
        $val = $CurrentForm->hasValue("season") ? $CurrentForm->getValue("season") : $CurrentForm->getValue("x_season");
        if (!$this->season->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->season->Visible = false; // Disable update for API request
            } else {
                $this->season->setFormValue($val);
            }
        }

        // Check field name 'no_box' first before field var 'x_no_box'
        $val = $CurrentForm->hasValue("no_box") ? $CurrentForm->getValue("no_box") : $CurrentForm->getValue("x_no_box");
        if (!$this->no_box->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_box->Visible = false; // Disable update for API request
            } else {
                $this->no_box->setFormValue($val);
            }
        }

        // Check field name 'location_2nd' first before field var 'x_location_2nd'
        $val = $CurrentForm->hasValue("location_2nd") ? $CurrentForm->getValue("location_2nd") : $CurrentForm->getValue("x_location_2nd");
        if (!$this->location_2nd->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_2nd->Visible = false; // Disable update for API request
            } else {
                $this->location_2nd->setFormValue($val);
            }
        }

        // Check field name 'date_created' first before field var 'x_date_created'
        $val = $CurrentForm->hasValue("date_created") ? $CurrentForm->getValue("date_created") : $CurrentForm->getValue("x_date_created");
        if (!$this->date_created->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_created->Visible = false; // Disable update for API request
            } else {
                $this->date_created->setFormValue($val, true, $validate);
            }
            $this->date_created->CurrentValue = UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
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

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->article->CurrentValue = $this->article->FormValue;
        $this->location->CurrentValue = $this->location->FormValue;
        $this->ctn->CurrentValue = $this->ctn->FormValue;
        $this->quantity->CurrentValue = $this->quantity->FormValue;
        $this->size_desc->CurrentValue = $this->size_desc->FormValue;
        $this->color_desc->CurrentValue = $this->color_desc->FormValue;
        $this->size_code->CurrentValue = $this->size_code->FormValue;
        $this->season->CurrentValue = $this->season->FormValue;
        $this->no_box->CurrentValue = $this->no_box->FormValue;
        $this->location_2nd->CurrentValue = $this->location_2nd->FormValue;
        $this->date_created->CurrentValue = $this->date_created->FormValue;
        $this->date_created->CurrentValue = UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_updated->CurrentValue = $this->date_updated->FormValue;
        $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
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
        $this->week->setDbValue($row['week']);
        $this->art6->setDbValue($row['art6']);
        $this->art9->setDbValue($row['art9']);
        $this->art11->setDbValue($row['art11']);
        $this->article->setDbValue($row['article']);
        $this->location->setDbValue($row['location']);
        $this->ctn->setDbValue($row['ctn']);
        $this->quantity->setDbValue($row['quantity']);
        $this->size_desc->setDbValue($row['size_desc']);
        $this->color_desc->setDbValue($row['color_desc']);
        $this->size_code->setDbValue($row['size_code']);
        $this->season->setDbValue($row['season']);
        $this->no_box->setDbValue($row['no_box']);
        $this->location_2nd->setDbValue($row['location_2nd']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['week'] = $this->week->DefaultValue;
        $row['art6'] = $this->art6->DefaultValue;
        $row['art9'] = $this->art9->DefaultValue;
        $row['art11'] = $this->art11->DefaultValue;
        $row['article'] = $this->article->DefaultValue;
        $row['location'] = $this->location->DefaultValue;
        $row['ctn'] = $this->ctn->DefaultValue;
        $row['quantity'] = $this->quantity->DefaultValue;
        $row['size_desc'] = $this->size_desc->DefaultValue;
        $row['color_desc'] = $this->color_desc->DefaultValue;
        $row['size_code'] = $this->size_code->DefaultValue;
        $row['season'] = $this->season->DefaultValue;
        $row['no_box'] = $this->no_box->DefaultValue;
        $row['location_2nd'] = $this->location_2nd->DefaultValue;
        $row['date_created'] = $this->date_created->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
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

        // week
        $this->week->RowCssClass = "row";

        // art6
        $this->art6->RowCssClass = "row";

        // art9
        $this->art9->RowCssClass = "row";

        // art11
        $this->art11->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // location
        $this->location->RowCssClass = "row";

        // ctn
        $this->ctn->RowCssClass = "row";

        // quantity
        $this->quantity->RowCssClass = "row";

        // size_desc
        $this->size_desc->RowCssClass = "row";

        // color_desc
        $this->color_desc->RowCssClass = "row";

        // size_code
        $this->size_code->RowCssClass = "row";

        // season
        $this->season->RowCssClass = "row";

        // no_box
        $this->no_box->RowCssClass = "row";

        // location_2nd
        $this->location_2nd->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // week
            $this->week->ViewValue = $this->week->CurrentValue;
            $this->week->ViewCustomAttributes = "";

            // art6
            $this->art6->ViewValue = $this->art6->CurrentValue;
            $this->art6->ViewCustomAttributes = "";

            // art9
            $this->art9->ViewValue = $this->art9->CurrentValue;
            $this->art9->ViewCustomAttributes = "";

            // art11
            $this->art11->ViewValue = $this->art11->CurrentValue;
            $this->art11->ViewCustomAttributes = "";

            // article
            $this->article->ViewValue = $this->article->CurrentValue;
            $curVal = strval($this->article->CurrentValue);
            if ($curVal != "") {
                $this->article->ViewValue = $this->article->lookupCacheOption($curVal);
                if ($this->article->ViewValue === null) { // Lookup from database
                    $filterWrk = "`article`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->article->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->article->Lookup->renderViewRow($rswrk[0]);
                        $this->article->ViewValue = $this->article->displayValue($arwrk);
                    } else {
                        $this->article->ViewValue = $this->article->CurrentValue;
                    }
                }
            } else {
                $this->article->ViewValue = null;
            }
            $this->article->ViewCustomAttributes = "";

            // location
            $this->location->ViewValue = $this->location->CurrentValue;
            $this->location->ViewCustomAttributes = "";

            // ctn
            $this->ctn->ViewValue = $this->ctn->CurrentValue;
            $this->ctn->ViewCustomAttributes = "";

            // quantity
            $this->quantity->ViewValue = $this->quantity->CurrentValue;
            $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());
            $this->quantity->ViewCustomAttributes = "";

            // size_desc
            $this->size_desc->ViewValue = $this->size_desc->CurrentValue;
            $this->size_desc->ViewCustomAttributes = "";

            // color_desc
            $this->color_desc->ViewValue = $this->color_desc->CurrentValue;
            $this->color_desc->ViewCustomAttributes = "";

            // size_code
            $this->size_code->ViewValue = $this->size_code->CurrentValue;
            $this->size_code->ViewCustomAttributes = "";

            // season
            $this->season->ViewValue = $this->season->CurrentValue;
            $this->season->ViewCustomAttributes = "";

            // no_box
            $this->no_box->ViewValue = $this->no_box->CurrentValue;
            $this->no_box->ViewCustomAttributes = "";

            // location_2nd
            $this->location_2nd->ViewValue = $this->location_2nd->CurrentValue;
            $this->location_2nd->ViewCustomAttributes = "";

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
            $this->date_created->ViewCustomAttributes = "";

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
            $this->date_updated->ViewCustomAttributes = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // ctn
            $this->ctn->LinkCustomAttributes = "";
            $this->ctn->HrefValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";

            // size_desc
            $this->size_desc->LinkCustomAttributes = "";
            $this->size_desc->HrefValue = "";
            $this->size_desc->TooltipValue = "";

            // color_desc
            $this->color_desc->LinkCustomAttributes = "";
            $this->color_desc->HrefValue = "";
            $this->color_desc->TooltipValue = "";

            // size_code
            $this->size_code->LinkCustomAttributes = "";
            $this->size_code->HrefValue = "";
            $this->size_code->TooltipValue = "";

            // season
            $this->season->LinkCustomAttributes = "";
            $this->season->HrefValue = "";
            $this->season->TooltipValue = "";

            // no_box
            $this->no_box->LinkCustomAttributes = "";
            $this->no_box->HrefValue = "";

            // location_2nd
            $this->location_2nd->LinkCustomAttributes = "";
            $this->location_2nd->HrefValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // article
            $this->article->setupEditAttributes();
            $this->article->EditCustomAttributes = "";
            if (!$this->article->Raw) {
                $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
            }
            $this->article->EditValue = HtmlEncode($this->article->CurrentValue);
            $curVal = strval($this->article->CurrentValue);
            if ($curVal != "") {
                $this->article->EditValue = $this->article->lookupCacheOption($curVal);
                if ($this->article->EditValue === null) { // Lookup from database
                    $filterWrk = "`article`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->article->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->article->Lookup->renderViewRow($rswrk[0]);
                        $this->article->EditValue = $this->article->displayValue($arwrk);
                    } else {
                        $this->article->EditValue = HtmlEncode($this->article->CurrentValue);
                    }
                }
            } else {
                $this->article->EditValue = null;
            }
            $this->article->PlaceHolder = RemoveHtml($this->article->caption());

            // location
            $this->location->setupEditAttributes();
            $this->location->EditCustomAttributes = "";
            if (!$this->location->Raw) {
                $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
            }
            $this->location->EditValue = HtmlEncode($this->location->CurrentValue);
            $this->location->PlaceHolder = RemoveHtml($this->location->caption());

            // ctn
            $this->ctn->setupEditAttributes();
            $this->ctn->EditCustomAttributes = "";
            if (!$this->ctn->Raw) {
                $this->ctn->CurrentValue = HtmlDecode($this->ctn->CurrentValue);
            }
            $this->ctn->EditValue = HtmlEncode($this->ctn->CurrentValue);
            $this->ctn->PlaceHolder = RemoveHtml($this->ctn->caption());

            // quantity
            $this->quantity->setupEditAttributes();
            $this->quantity->EditCustomAttributes = "";
            $this->quantity->EditValue = HtmlEncode($this->quantity->CurrentValue);
            $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
            if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
                $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
            }

            // size_desc
            $this->size_desc->setupEditAttributes();
            $this->size_desc->EditCustomAttributes = 'readonly';
            if (!$this->size_desc->Raw) {
                $this->size_desc->CurrentValue = HtmlDecode($this->size_desc->CurrentValue);
            }
            $this->size_desc->EditValue = HtmlEncode($this->size_desc->CurrentValue);
            $this->size_desc->PlaceHolder = RemoveHtml($this->size_desc->caption());

            // color_desc
            $this->color_desc->setupEditAttributes();
            $this->color_desc->EditCustomAttributes = 'readonly';
            if (!$this->color_desc->Raw) {
                $this->color_desc->CurrentValue = HtmlDecode($this->color_desc->CurrentValue);
            }
            $this->color_desc->EditValue = HtmlEncode($this->color_desc->CurrentValue);
            $this->color_desc->PlaceHolder = RemoveHtml($this->color_desc->caption());

            // size_code
            $this->size_code->setupEditAttributes();
            $this->size_code->EditCustomAttributes = 'readonly';
            if (!$this->size_code->Raw) {
                $this->size_code->CurrentValue = HtmlDecode($this->size_code->CurrentValue);
            }
            $this->size_code->EditValue = HtmlEncode($this->size_code->CurrentValue);
            $this->size_code->PlaceHolder = RemoveHtml($this->size_code->caption());

            // season
            $this->season->setupEditAttributes();
            $this->season->EditCustomAttributes = 'readonly';
            if (!$this->season->Raw) {
                $this->season->CurrentValue = HtmlDecode($this->season->CurrentValue);
            }
            $this->season->EditValue = HtmlEncode($this->season->CurrentValue);
            $this->season->PlaceHolder = RemoveHtml($this->season->caption());

            // no_box
            $this->no_box->setupEditAttributes();
            $this->no_box->EditCustomAttributes = "";
            if (!$this->no_box->Raw) {
                $this->no_box->CurrentValue = HtmlDecode($this->no_box->CurrentValue);
            }
            $this->no_box->EditValue = HtmlEncode($this->no_box->CurrentValue);
            $this->no_box->PlaceHolder = RemoveHtml($this->no_box->caption());

            // location_2nd
            $this->location_2nd->setupEditAttributes();
            $this->location_2nd->EditCustomAttributes = "";
            if (!$this->location_2nd->Raw) {
                $this->location_2nd->CurrentValue = HtmlDecode($this->location_2nd->CurrentValue);
            }
            $this->location_2nd->EditValue = HtmlEncode($this->location_2nd->CurrentValue);
            $this->location_2nd->PlaceHolder = RemoveHtml($this->location_2nd->caption());

            // date_created
            $this->date_created->setupEditAttributes();
            $this->date_created->EditCustomAttributes = "";
            $this->date_created->EditValue = HtmlEncode(FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()));
            $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

            // date_updated

            // Add refer script

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // ctn
            $this->ctn->LinkCustomAttributes = "";
            $this->ctn->HrefValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";

            // size_desc
            $this->size_desc->LinkCustomAttributes = "";
            $this->size_desc->HrefValue = "";

            // color_desc
            $this->color_desc->LinkCustomAttributes = "";
            $this->color_desc->HrefValue = "";

            // size_code
            $this->size_code->LinkCustomAttributes = "";
            $this->size_code->HrefValue = "";

            // season
            $this->season->LinkCustomAttributes = "";
            $this->season->HrefValue = "";

            // no_box
            $this->no_box->LinkCustomAttributes = "";
            $this->no_box->HrefValue = "";

            // location_2nd
            $this->location_2nd->LinkCustomAttributes = "";
            $this->location_2nd->HrefValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";
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
        if ($this->article->Required) {
            if (!$this->article->IsDetailKey && EmptyValue($this->article->FormValue)) {
                $this->article->addErrorMessage(str_replace("%s", $this->article->caption(), $this->article->RequiredErrorMessage));
            }
        }
        if ($this->location->Required) {
            if (!$this->location->IsDetailKey && EmptyValue($this->location->FormValue)) {
                $this->location->addErrorMessage(str_replace("%s", $this->location->caption(), $this->location->RequiredErrorMessage));
            }
        }
        if ($this->ctn->Required) {
            if (!$this->ctn->IsDetailKey && EmptyValue($this->ctn->FormValue)) {
                $this->ctn->addErrorMessage(str_replace("%s", $this->ctn->caption(), $this->ctn->RequiredErrorMessage));
            }
        }
        if ($this->quantity->Required) {
            if (!$this->quantity->IsDetailKey && EmptyValue($this->quantity->FormValue)) {
                $this->quantity->addErrorMessage(str_replace("%s", $this->quantity->caption(), $this->quantity->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->quantity->FormValue)) {
            $this->quantity->addErrorMessage($this->quantity->getErrorMessage(false));
        }
        if ($this->size_desc->Required) {
            if (!$this->size_desc->IsDetailKey && EmptyValue($this->size_desc->FormValue)) {
                $this->size_desc->addErrorMessage(str_replace("%s", $this->size_desc->caption(), $this->size_desc->RequiredErrorMessage));
            }
        }
        if ($this->color_desc->Required) {
            if (!$this->color_desc->IsDetailKey && EmptyValue($this->color_desc->FormValue)) {
                $this->color_desc->addErrorMessage(str_replace("%s", $this->color_desc->caption(), $this->color_desc->RequiredErrorMessage));
            }
        }
        if ($this->size_code->Required) {
            if (!$this->size_code->IsDetailKey && EmptyValue($this->size_code->FormValue)) {
                $this->size_code->addErrorMessage(str_replace("%s", $this->size_code->caption(), $this->size_code->RequiredErrorMessage));
            }
        }
        if ($this->season->Required) {
            if (!$this->season->IsDetailKey && EmptyValue($this->season->FormValue)) {
                $this->season->addErrorMessage(str_replace("%s", $this->season->caption(), $this->season->RequiredErrorMessage));
            }
        }
        if ($this->no_box->Required) {
            if (!$this->no_box->IsDetailKey && EmptyValue($this->no_box->FormValue)) {
                $this->no_box->addErrorMessage(str_replace("%s", $this->no_box->caption(), $this->no_box->RequiredErrorMessage));
            }
        }
        if ($this->location_2nd->Required) {
            if (!$this->location_2nd->IsDetailKey && EmptyValue($this->location_2nd->FormValue)) {
                $this->location_2nd->addErrorMessage(str_replace("%s", $this->location_2nd->caption(), $this->location_2nd->RequiredErrorMessage));
            }
        }
        if ($this->date_created->Required) {
            if (!$this->date_created->IsDetailKey && EmptyValue($this->date_created->FormValue)) {
                $this->date_created->addErrorMessage(str_replace("%s", $this->date_created->caption(), $this->date_created->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_created->FormValue, $this->date_created->formatPattern())) {
            $this->date_created->addErrorMessage($this->date_created->getErrorMessage(false));
        }
        if ($this->date_updated->Required) {
            if (!$this->date_updated->IsDetailKey && EmptyValue($this->date_updated->FormValue)) {
                $this->date_updated->addErrorMessage(str_replace("%s", $this->date_updated->caption(), $this->date_updated->RequiredErrorMessage));
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

        // article
        $this->article->setDbValueDef($rsnew, $this->article->CurrentValue, null, false);

        // location
        $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, null, false);

        // ctn
        $this->ctn->setDbValueDef($rsnew, $this->ctn->CurrentValue, null, false);

        // quantity
        $this->quantity->setDbValueDef($rsnew, $this->quantity->CurrentValue, null, false);

        // size_desc
        $this->size_desc->setDbValueDef($rsnew, $this->size_desc->CurrentValue, null, false);

        // color_desc
        $this->color_desc->setDbValueDef($rsnew, $this->color_desc->CurrentValue, null, false);

        // size_code
        $this->size_code->setDbValueDef($rsnew, $this->size_code->CurrentValue, null, false);

        // season
        $this->season->setDbValueDef($rsnew, $this->season->CurrentValue, null, false);

        // no_box
        $this->no_box->setDbValueDef($rsnew, $this->no_box->CurrentValue, null, false);

        // location_2nd
        $this->location_2nd->setDbValueDef($rsnew, $this->location_2nd->CurrentValue, null, false);

        // date_created
        $this->date_created->setDbValueDef($rsnew, UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()), null, false);

        // date_updated
        $this->date_updated->CurrentValue = CurrentDate();
        $this->date_updated->setDbValueDef($rsnew, $this->date_updated->CurrentValue, null);

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        if ($rsold) {
        }

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
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("extrastocklist"), "", $this->TableVar, true);
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
                case "x_article":
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

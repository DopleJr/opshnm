<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ExtraStockEdit extends ExtraStock
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'extra_stock';

    // Page object name
    public $PageObjName = "ExtraStockEdit";

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
        $this->week->setVisibility();
        $this->art6->setVisibility();
        $this->art9->setVisibility();
        $this->art11->setVisibility();
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
                        $this->terminate("extrastocklist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "extrastocklist") {
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

        // Check field name 'week' first before field var 'x_week'
        $val = $CurrentForm->hasValue("week") ? $CurrentForm->getValue("week") : $CurrentForm->getValue("x_week");
        if (!$this->week->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->week->Visible = false; // Disable update for API request
            } else {
                $this->week->setFormValue($val);
            }
        }

        // Check field name 'art6' first before field var 'x_art6'
        $val = $CurrentForm->hasValue("art6") ? $CurrentForm->getValue("art6") : $CurrentForm->getValue("x_art6");
        if (!$this->art6->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->art6->Visible = false; // Disable update for API request
            } else {
                $this->art6->setFormValue($val);
            }
        }

        // Check field name 'art9' first before field var 'x_art9'
        $val = $CurrentForm->hasValue("art9") ? $CurrentForm->getValue("art9") : $CurrentForm->getValue("x_art9");
        if (!$this->art9->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->art9->Visible = false; // Disable update for API request
            } else {
                $this->art9->setFormValue($val);
            }
        }

        // Check field name 'art11' first before field var 'x_art11'
        $val = $CurrentForm->hasValue("art11") ? $CurrentForm->getValue("art11") : $CurrentForm->getValue("x_art11");
        if (!$this->art11->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->art11->Visible = false; // Disable update for API request
            } else {
                $this->art11->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->week->CurrentValue = $this->week->FormValue;
        $this->art6->CurrentValue = $this->art6->FormValue;
        $this->art9->CurrentValue = $this->art9->FormValue;
        $this->art11->CurrentValue = $this->art11->FormValue;
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
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

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

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // week
            $this->week->LinkCustomAttributes = "";
            $this->week->HrefValue = "";

            // art6
            $this->art6->LinkCustomAttributes = "";
            $this->art6->HrefValue = "";

            // art9
            $this->art9->LinkCustomAttributes = "";
            $this->art9->HrefValue = "";

            // art11
            $this->art11->LinkCustomAttributes = "";
            $this->art11->HrefValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // week
            $this->week->setupEditAttributes();
            $this->week->EditCustomAttributes = "";
            if (!$this->week->Raw) {
                $this->week->CurrentValue = HtmlDecode($this->week->CurrentValue);
            }
            $this->week->EditValue = HtmlEncode($this->week->CurrentValue);
            $this->week->PlaceHolder = RemoveHtml($this->week->caption());

            // art6
            $this->art6->setupEditAttributes();
            $this->art6->EditCustomAttributes = "";
            if (!$this->art6->Raw) {
                $this->art6->CurrentValue = HtmlDecode($this->art6->CurrentValue);
            }
            $this->art6->EditValue = HtmlEncode($this->art6->CurrentValue);
            $this->art6->PlaceHolder = RemoveHtml($this->art6->caption());

            // art9
            $this->art9->setupEditAttributes();
            $this->art9->EditCustomAttributes = "";
            if (!$this->art9->Raw) {
                $this->art9->CurrentValue = HtmlDecode($this->art9->CurrentValue);
            }
            $this->art9->EditValue = HtmlEncode($this->art9->CurrentValue);
            $this->art9->PlaceHolder = RemoveHtml($this->art9->caption());

            // art11
            $this->art11->setupEditAttributes();
            $this->art11->EditCustomAttributes = "";
            if (!$this->art11->Raw) {
                $this->art11->CurrentValue = HtmlDecode($this->art11->CurrentValue);
            }
            $this->art11->EditValue = HtmlEncode($this->art11->CurrentValue);
            $this->art11->PlaceHolder = RemoveHtml($this->art11->caption());

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
            $this->size_desc->EditValue = $this->size_desc->CurrentValue;
            $this->size_desc->ViewCustomAttributes = "";

            // color_desc
            $this->color_desc->setupEditAttributes();
            $this->color_desc->EditCustomAttributes = 'readonly';
            $this->color_desc->EditValue = $this->color_desc->CurrentValue;
            $this->color_desc->ViewCustomAttributes = "";

            // size_code
            $this->size_code->setupEditAttributes();
            $this->size_code->EditCustomAttributes = 'readonly';
            $this->size_code->EditValue = $this->size_code->CurrentValue;
            $this->size_code->ViewCustomAttributes = "";

            // season
            $this->season->setupEditAttributes();
            $this->season->EditCustomAttributes = 'readonly';
            $this->season->EditValue = $this->season->CurrentValue;
            $this->season->ViewCustomAttributes = "";

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

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // week
            $this->week->LinkCustomAttributes = "";
            $this->week->HrefValue = "";

            // art6
            $this->art6->LinkCustomAttributes = "";
            $this->art6->HrefValue = "";

            // art9
            $this->art9->LinkCustomAttributes = "";
            $this->art9->HrefValue = "";

            // art11
            $this->art11->LinkCustomAttributes = "";
            $this->art11->HrefValue = "";

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
        if ($this->week->Required) {
            if (!$this->week->IsDetailKey && EmptyValue($this->week->FormValue)) {
                $this->week->addErrorMessage(str_replace("%s", $this->week->caption(), $this->week->RequiredErrorMessage));
            }
        }
        if ($this->art6->Required) {
            if (!$this->art6->IsDetailKey && EmptyValue($this->art6->FormValue)) {
                $this->art6->addErrorMessage(str_replace("%s", $this->art6->caption(), $this->art6->RequiredErrorMessage));
            }
        }
        if ($this->art9->Required) {
            if (!$this->art9->IsDetailKey && EmptyValue($this->art9->FormValue)) {
                $this->art9->addErrorMessage(str_replace("%s", $this->art9->caption(), $this->art9->RequiredErrorMessage));
            }
        }
        if ($this->art11->Required) {
            if (!$this->art11->IsDetailKey && EmptyValue($this->art11->FormValue)) {
                $this->art11->addErrorMessage(str_replace("%s", $this->art11->caption(), $this->art11->RequiredErrorMessage));
            }
        }
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

        // week
        $this->week->setDbValueDef($rsnew, $this->week->CurrentValue, null, $this->week->ReadOnly);

        // art6
        $this->art6->setDbValueDef($rsnew, $this->art6->CurrentValue, null, $this->art6->ReadOnly);

        // art9
        $this->art9->setDbValueDef($rsnew, $this->art9->CurrentValue, null, $this->art9->ReadOnly);

        // art11
        $this->art11->setDbValueDef($rsnew, $this->art11->CurrentValue, null, $this->art11->ReadOnly);

        // article
        $this->article->setDbValueDef($rsnew, $this->article->CurrentValue, null, $this->article->ReadOnly);

        // location
        $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, null, $this->location->ReadOnly);

        // ctn
        $this->ctn->setDbValueDef($rsnew, $this->ctn->CurrentValue, null, $this->ctn->ReadOnly);

        // quantity
        $this->quantity->setDbValueDef($rsnew, $this->quantity->CurrentValue, null, $this->quantity->ReadOnly);

        // no_box
        $this->no_box->setDbValueDef($rsnew, $this->no_box->CurrentValue, null, $this->no_box->ReadOnly);

        // location_2nd
        $this->location_2nd->setDbValueDef($rsnew, $this->location_2nd->CurrentValue, null, $this->location_2nd->ReadOnly);

        // date_created
        $this->date_created->setDbValueDef($rsnew, UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()), null, $this->date_created->ReadOnly);

        // date_updated
        $this->date_updated->CurrentValue = CurrentDate();
        $this->date_updated->setDbValueDef($rsnew, $this->date_updated->CurrentValue, null);

        // Update current values
        $this->setCurrentValues($rsnew);

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
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("extrastocklist"), "", $this->TableVar, true);
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

<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JobControlEdit extends JobControl
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'job_control';

    // Page object name
    public $PageObjName = "JobControlEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

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

        // Table object (job_control)
        if (!isset($GLOBALS["job_control"]) || get_class($GLOBALS["job_control"]) == PROJECT_NAMESPACE . "job_control") {
            $GLOBALS["job_control"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'job_control');
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
                $tbl = Container("job_control");
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
                    if ($pageName == "jobcontrolview") {
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
        $this->job_category->setVisibility();
        $this->aisle->setVisibility();
        $this->user->setVisibility();
        $this->status->setVisibility();
        $this->date_created->setVisibility();
        $this->date_updated->setVisibility();
        $this->test->setVisibility();
        $this->test2->setVisibility();
        $this->test3->setVisibility();
        $this->test4->setVisibility();
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
        $this->setupLookupOptions($this->job_category);
        $this->setupLookupOptions($this->aisle);
        $this->setupLookupOptions($this->user);
        $this->setupLookupOptions($this->status);

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
                        $this->terminate("jobcontrollist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "jobcontrollist") {
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

        // Check field name 'job_category' first before field var 'x_job_category'
        $val = $CurrentForm->hasValue("job_category") ? $CurrentForm->getValue("job_category") : $CurrentForm->getValue("x_job_category");
        if (!$this->job_category->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->job_category->Visible = false; // Disable update for API request
            } else {
                $this->job_category->setFormValue($val);
            }
        }

        // Check field name 'aisle' first before field var 'x_aisle'
        $val = $CurrentForm->hasValue("aisle") ? $CurrentForm->getValue("aisle") : $CurrentForm->getValue("x_aisle");
        if (!$this->aisle->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->aisle->Visible = false; // Disable update for API request
            } else {
                $this->aisle->setFormValue($val);
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

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
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
                $this->date_updated->setFormValue($val, true, $validate);
            }
            $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        }

        // Check field name 'test' first before field var 'x_test'
        $val = $CurrentForm->hasValue("test") ? $CurrentForm->getValue("test") : $CurrentForm->getValue("x_test");
        if (!$this->test->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test->Visible = false; // Disable update for API request
            } else {
                $this->test->setFormValue($val);
            }
        }

        // Check field name 'test2' first before field var 'x_test2'
        $val = $CurrentForm->hasValue("test2") ? $CurrentForm->getValue("test2") : $CurrentForm->getValue("x_test2");
        if (!$this->test2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test2->Visible = false; // Disable update for API request
            } else {
                $this->test2->setFormValue($val);
            }
        }

        // Check field name 'test3' first before field var 'x_test3'
        $val = $CurrentForm->hasValue("test3") ? $CurrentForm->getValue("test3") : $CurrentForm->getValue("x_test3");
        if (!$this->test3->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test3->Visible = false; // Disable update for API request
            } else {
                $this->test3->setFormValue($val);
            }
        }

        // Check field name 'test4' first before field var 'x_test4'
        $val = $CurrentForm->hasValue("test4") ? $CurrentForm->getValue("test4") : $CurrentForm->getValue("x_test4");
        if (!$this->test4->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test4->Visible = false; // Disable update for API request
            } else {
                $this->test4->setFormValue($val, true, $validate);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->job_category->CurrentValue = $this->job_category->FormValue;
        $this->aisle->CurrentValue = $this->aisle->FormValue;
        $this->user->CurrentValue = $this->user->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->date_created->CurrentValue = $this->date_created->FormValue;
        $this->date_created->CurrentValue = UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_updated->CurrentValue = $this->date_updated->FormValue;
        $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        $this->test->CurrentValue = $this->test->FormValue;
        $this->test2->CurrentValue = $this->test2->FormValue;
        $this->test3->CurrentValue = $this->test3->FormValue;
        $this->test4->CurrentValue = $this->test4->FormValue;
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
        $this->job_category->setDbValue($row['job_category']);
        $this->aisle->setDbValue($row['aisle']);
        $this->user->setDbValue($row['user']);
        $this->status->setDbValue($row['status']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->test->setDbValue($row['test']);
        $this->test2->setDbValue($row['test2']);
        $this->test3->setDbValue($row['test3']);
        $this->test4->setDbValue($row['test4']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['job_category'] = $this->job_category->DefaultValue;
        $row['aisle'] = $this->aisle->DefaultValue;
        $row['user'] = $this->user->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['date_created'] = $this->date_created->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
        $row['test'] = $this->test->DefaultValue;
        $row['test2'] = $this->test2->DefaultValue;
        $row['test3'] = $this->test3->DefaultValue;
        $row['test4'] = $this->test4->DefaultValue;
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

        // job_category
        $this->job_category->RowCssClass = "row";

        // aisle
        $this->aisle->RowCssClass = "row";

        // user
        $this->user->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // test
        $this->test->RowCssClass = "row";

        // test2
        $this->test2->RowCssClass = "row";

        // test3
        $this->test3->RowCssClass = "row";

        // test4
        $this->test4->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

            // job_category
            if (strval($this->job_category->CurrentValue) != "") {
                $this->job_category->ViewValue = $this->job_category->optionCaption($this->job_category->CurrentValue);
            } else {
                $this->job_category->ViewValue = null;
            }
            $this->job_category->ViewCustomAttributes = "";

            // aisle
            $curVal = strval($this->aisle->CurrentValue);
            if ($curVal != "") {
                $this->aisle->ViewValue = $this->aisle->lookupCacheOption($curVal);
                if ($this->aisle->ViewValue === null) { // Lookup from database
                    $arwrk = explode(",", $curVal);
                    $filterWrk = "";
                    foreach ($arwrk as $wrk) {
                        if ($filterWrk != "") {
                            $filterWrk .= " OR ";
                        }
                        $filterWrk .= "`source_location`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
                    }
                    $sqlWrk = $this->aisle->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $this->aisle->ViewValue = new OptionValues();
                        foreach ($rswrk as $row) {
                            $arwrk = $this->aisle->Lookup->renderViewRow($row);
                            $this->aisle->ViewValue->add($this->aisle->displayValue($arwrk));
                        }
                    } else {
                        $this->aisle->ViewValue = $this->aisle->CurrentValue;
                    }
                }
            } else {
                $this->aisle->ViewValue = null;
            }
            $this->aisle->ViewCustomAttributes = "";

            // user
            $curVal = strval($this->user->CurrentValue);
            if ($curVal != "") {
                $this->user->ViewValue = $this->user->lookupCacheOption($curVal);
                if ($this->user->ViewValue === null) { // Lookup from database
                    $filterWrk = "`username`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->user->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->user->Lookup->renderViewRow($rswrk[0]);
                        $this->user->ViewValue = $this->user->displayValue($arwrk);
                    } else {
                        $this->user->ViewValue = $this->user->CurrentValue;
                    }
                }
            } else {
                $this->user->ViewValue = null;
            }
            $this->user->ViewCustomAttributes = "";

            // status
            if (strval($this->status->CurrentValue) != "") {
                $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
            } else {
                $this->status->ViewValue = null;
            }
            $this->status->ViewCustomAttributes = "";

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
            $this->date_created->ViewCustomAttributes = "";

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
            $this->date_updated->ViewCustomAttributes = "";

            // test
            $this->test->ViewValue = $this->test->CurrentValue;
            $this->test->ViewCustomAttributes = "";

            // test2
            $this->test2->ViewValue = $this->test2->CurrentValue;
            $this->test2->ViewCustomAttributes = "";

            // test3
            $this->test3->ViewValue = $this->test3->CurrentValue;
            $this->test3->ViewCustomAttributes = "";

            // test4
            $this->test4->ViewValue = $this->test4->CurrentValue;
            $this->test4->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // job_category
            $this->job_category->LinkCustomAttributes = "";
            $this->job_category->HrefValue = "";

            // aisle
            $this->aisle->LinkCustomAttributes = "";
            $this->aisle->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";

            // test
            $this->test->LinkCustomAttributes = "";
            $this->test->HrefValue = "";

            // test2
            $this->test2->LinkCustomAttributes = "";
            $this->test2->HrefValue = "";

            // test3
            $this->test3->LinkCustomAttributes = "";
            $this->test3->HrefValue = "";

            // test4
            $this->test4->LinkCustomAttributes = "";
            $this->test4->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->EditValue = FormatNumber($this->id->EditValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

            // job_category
            $this->job_category->setupEditAttributes();
            $this->job_category->EditCustomAttributes = "";
            $this->job_category->EditValue = $this->job_category->options(true);
            $this->job_category->PlaceHolder = RemoveHtml($this->job_category->caption());

            // aisle
            $this->aisle->EditCustomAttributes = "";
            $curVal = trim(strval($this->aisle->CurrentValue));
            if ($curVal != "") {
                $this->aisle->ViewValue = $this->aisle->lookupCacheOption($curVal);
            } else {
                $this->aisle->ViewValue = $this->aisle->Lookup !== null && is_array($this->aisle->lookupOptions()) ? $curVal : null;
            }
            if ($this->aisle->ViewValue !== null) { // Load from cache
                $this->aisle->EditValue = array_values($this->aisle->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $arwrk = explode(",", $curVal);
                    $filterWrk = "";
                    foreach ($arwrk as $wrk) {
                        if ($filterWrk != "") {
                            $filterWrk .= " OR ";
                        }
                        $filterWrk .= "`source_location`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
                    }
                }
                $sqlWrk = $this->aisle->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->aisle->EditValue = $arwrk;
            }
            $this->aisle->PlaceHolder = RemoveHtml($this->aisle->caption());

            // user
            $this->user->setupEditAttributes();
            $this->user->EditCustomAttributes = "";
            $curVal = trim(strval($this->user->CurrentValue));
            if ($curVal != "") {
                $this->user->ViewValue = $this->user->lookupCacheOption($curVal);
            } else {
                $this->user->ViewValue = $this->user->Lookup !== null && is_array($this->user->lookupOptions()) ? $curVal : null;
            }
            if ($this->user->ViewValue !== null) { // Load from cache
                $this->user->EditValue = array_values($this->user->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`username`" . SearchString("=", $this->user->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->user->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->user->EditValue = $arwrk;
            }
            $this->user->PlaceHolder = RemoveHtml($this->user->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            $this->status->EditValue = $this->status->options(true);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // date_created
            $this->date_created->setupEditAttributes();
            $this->date_created->EditCustomAttributes = "";
            $this->date_created->EditValue = HtmlEncode(FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()));
            $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

            // date_updated
            $this->date_updated->setupEditAttributes();
            $this->date_updated->EditCustomAttributes = "";
            $this->date_updated->EditValue = HtmlEncode(FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()));
            $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

            // test
            $this->test->setupEditAttributes();
            $this->test->EditCustomAttributes = "";
            if (!$this->test->Raw) {
                $this->test->CurrentValue = HtmlDecode($this->test->CurrentValue);
            }
            $this->test->EditValue = HtmlEncode($this->test->CurrentValue);
            $this->test->PlaceHolder = RemoveHtml($this->test->caption());

            // test2
            $this->test2->setupEditAttributes();
            $this->test2->EditCustomAttributes = "";
            if (!$this->test2->Raw) {
                $this->test2->CurrentValue = HtmlDecode($this->test2->CurrentValue);
            }
            $this->test2->EditValue = HtmlEncode($this->test2->CurrentValue);
            $this->test2->PlaceHolder = RemoveHtml($this->test2->caption());

            // test3
            $this->test3->setupEditAttributes();
            $this->test3->EditCustomAttributes = "";
            if (!$this->test3->Raw) {
                $this->test3->CurrentValue = HtmlDecode($this->test3->CurrentValue);
            }
            $this->test3->EditValue = HtmlEncode($this->test3->CurrentValue);
            $this->test3->PlaceHolder = RemoveHtml($this->test3->caption());

            // test4
            $this->test4->setupEditAttributes();
            $this->test4->EditCustomAttributes = "";
            if (!$this->test4->Raw) {
                $this->test4->CurrentValue = HtmlDecode($this->test4->CurrentValue);
            }
            $this->test4->EditValue = HtmlEncode($this->test4->CurrentValue);
            $this->test4->PlaceHolder = RemoveHtml($this->test4->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // job_category
            $this->job_category->LinkCustomAttributes = "";
            $this->job_category->HrefValue = "";

            // aisle
            $this->aisle->LinkCustomAttributes = "";
            $this->aisle->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";

            // test
            $this->test->LinkCustomAttributes = "";
            $this->test->HrefValue = "";

            // test2
            $this->test2->LinkCustomAttributes = "";
            $this->test2->HrefValue = "";

            // test3
            $this->test3->LinkCustomAttributes = "";
            $this->test3->HrefValue = "";

            // test4
            $this->test4->LinkCustomAttributes = "";
            $this->test4->HrefValue = "";
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
        if ($this->job_category->Required) {
            if (!$this->job_category->IsDetailKey && EmptyValue($this->job_category->FormValue)) {
                $this->job_category->addErrorMessage(str_replace("%s", $this->job_category->caption(), $this->job_category->RequiredErrorMessage));
            }
        }
        if ($this->aisle->Required) {
            if ($this->aisle->FormValue == "") {
                $this->aisle->addErrorMessage(str_replace("%s", $this->aisle->caption(), $this->aisle->RequiredErrorMessage));
            }
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
        if (!CheckDate($this->date_updated->FormValue, $this->date_updated->formatPattern())) {
            $this->date_updated->addErrorMessage($this->date_updated->getErrorMessage(false));
        }
        if ($this->test->Required) {
            if (!$this->test->IsDetailKey && EmptyValue($this->test->FormValue)) {
                $this->test->addErrorMessage(str_replace("%s", $this->test->caption(), $this->test->RequiredErrorMessage));
            }
        }
        if ($this->test2->Required) {
            if (!$this->test2->IsDetailKey && EmptyValue($this->test2->FormValue)) {
                $this->test2->addErrorMessage(str_replace("%s", $this->test2->caption(), $this->test2->RequiredErrorMessage));
            }
        }
        if ($this->test3->Required) {
            if (!$this->test3->IsDetailKey && EmptyValue($this->test3->FormValue)) {
                $this->test3->addErrorMessage(str_replace("%s", $this->test3->caption(), $this->test3->RequiredErrorMessage));
            }
        }
        if ($this->test4->Required) {
            if (!$this->test4->IsDetailKey && EmptyValue($this->test4->FormValue)) {
                $this->test4->addErrorMessage(str_replace("%s", $this->test4->caption(), $this->test4->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->test4->FormValue)) {
            $this->test4->addErrorMessage($this->test4->getErrorMessage(false));
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

        // job_category
        $this->job_category->setDbValueDef($rsnew, $this->job_category->CurrentValue, null, $this->job_category->ReadOnly);

        // aisle
        $this->aisle->setDbValueDef($rsnew, $this->aisle->CurrentValue, null, $this->aisle->ReadOnly);

        // user
        $this->user->setDbValueDef($rsnew, $this->user->CurrentValue, null, $this->user->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

        // date_created
        $this->date_created->setDbValueDef($rsnew, UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()), null, $this->date_created->ReadOnly);

        // date_updated
        $this->date_updated->setDbValueDef($rsnew, UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()), null, $this->date_updated->ReadOnly);

        // test
        $this->test->setDbValueDef($rsnew, $this->test->CurrentValue, null, $this->test->ReadOnly);

        // test2
        $this->test2->setDbValueDef($rsnew, $this->test2->CurrentValue, null, $this->test2->ReadOnly);

        // test3
        $this->test3->setDbValueDef($rsnew, $this->test3->CurrentValue, null, $this->test3->ReadOnly);

        // test4
        $this->test4->setDbValueDef($rsnew, $this->test4->CurrentValue, null, $this->test4->ReadOnly);

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
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jobcontrollist"), "", $this->TableVar, true);
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
                case "x_job_category":
                    break;
                case "x_aisle":
                    break;
                case "x_user":
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

<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class AuditPickingOnlineEdit extends AuditPickingOnline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'audit_picking_online';

    // Page object name
    public $PageObjName = "AuditPickingOnlineEdit";

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

        // Table object (audit_picking_online)
        if (!isset($GLOBALS["audit_picking_online"]) || get_class($GLOBALS["audit_picking_online"]) == PROJECT_NAMESPACE . "audit_picking_online") {
            $GLOBALS["audit_picking_online"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'audit_picking_online');
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
                $tbl = Container("audit_picking_online");
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
                    if ($pageName == "auditpickingonlineview") {
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
        $this->box_code->setVisibility();
        $this->store_id->setVisibility();
        $this->store_name->setVisibility();
        $this->scan->Visible = false;
        $this->article->setVisibility();
        $this->picked_qty->setVisibility();
        $this->scan_qty->setVisibility();
        $this->checker->setVisibility();
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
        $this->setupLookupOptions($this->box_code);
        $this->setupLookupOptions($this->store_id);

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
                        $this->terminate("auditpickingonlinelist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "auditpickingonlinelist") {
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

        // Check field name 'box_code' first before field var 'x_box_code'
        $val = $CurrentForm->hasValue("box_code") ? $CurrentForm->getValue("box_code") : $CurrentForm->getValue("x_box_code");
        if (!$this->box_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->box_code->Visible = false; // Disable update for API request
            } else {
                $this->box_code->setFormValue($val);
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

        // Check field name 'picked_qty' first before field var 'x_picked_qty'
        $val = $CurrentForm->hasValue("picked_qty") ? $CurrentForm->getValue("picked_qty") : $CurrentForm->getValue("x_picked_qty");
        if (!$this->picked_qty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->picked_qty->Visible = false; // Disable update for API request
            } else {
                $this->picked_qty->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'scan_qty' first before field var 'x_scan_qty'
        $val = $CurrentForm->hasValue("scan_qty") ? $CurrentForm->getValue("scan_qty") : $CurrentForm->getValue("x_scan_qty");
        if (!$this->scan_qty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->scan_qty->Visible = false; // Disable update for API request
            } else {
                $this->scan_qty->setFormValue($val);
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
                $this->date_update->setFormValue($val, true, $validate);
            }
            $this->date_update->CurrentValue = UnFormatDateTime($this->date_update->CurrentValue, $this->date_update->formatPattern());
        }

        // Check field name 'time_update' first before field var 'x_time_update'
        $val = $CurrentForm->hasValue("time_update") ? $CurrentForm->getValue("time_update") : $CurrentForm->getValue("x_time_update");
        if (!$this->time_update->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->time_update->Visible = false; // Disable update for API request
            } else {
                $this->time_update->setFormValue($val, true, $validate);
            }
            $this->time_update->CurrentValue = UnFormatDateTime($this->time_update->CurrentValue, $this->time_update->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->box_code->CurrentValue = $this->box_code->FormValue;
        $this->store_id->CurrentValue = $this->store_id->FormValue;
        $this->store_name->CurrentValue = $this->store_name->FormValue;
        $this->article->CurrentValue = $this->article->FormValue;
        $this->picked_qty->CurrentValue = $this->picked_qty->FormValue;
        $this->scan_qty->CurrentValue = $this->scan_qty->FormValue;
        $this->checker->CurrentValue = $this->checker->FormValue;
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
        $this->box_code->setDbValue($row['box_code']);
        $this->store_id->setDbValue($row['store_id']);
        $this->store_name->setDbValue($row['store_name']);
        $this->scan->setDbValue($row['scan']);
        $this->article->setDbValue($row['article']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->scan_qty->setDbValue($row['scan_qty']);
        $this->checker->setDbValue($row['checker']);
        $this->status->setDbValue($row['status']);
        $this->date_update->setDbValue($row['date_update']);
        $this->time_update->setDbValue($row['time_update']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['box_code'] = $this->box_code->DefaultValue;
        $row['store_id'] = $this->store_id->DefaultValue;
        $row['store_name'] = $this->store_name->DefaultValue;
        $row['scan'] = $this->scan->DefaultValue;
        $row['article'] = $this->article->DefaultValue;
        $row['picked_qty'] = $this->picked_qty->DefaultValue;
        $row['scan_qty'] = $this->scan_qty->DefaultValue;
        $row['checker'] = $this->checker->DefaultValue;
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

        // box_code
        $this->box_code->RowCssClass = "row";

        // store_id
        $this->store_id->RowCssClass = "row";

        // store_name
        $this->store_name->RowCssClass = "row";

        // scan
        $this->scan->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // picked_qty
        $this->picked_qty->RowCssClass = "row";

        // scan_qty
        $this->scan_qty->RowCssClass = "row";

        // checker
        $this->checker->RowCssClass = "row";

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
            $this->id->ViewCustomAttributes = "";

            // box_code
            $curVal = strval($this->box_code->CurrentValue);
            if ($curVal != "") {
                $this->box_code->ViewValue = $this->box_code->lookupCacheOption($curVal);
                if ($this->box_code->ViewValue === null) { // Lookup from database
                    $filterWrk = "`box_code`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->box_code->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->box_code->Lookup->renderViewRow($rswrk[0]);
                        $this->box_code->ViewValue = $this->box_code->displayValue($arwrk);
                    } else {
                        $this->box_code->ViewValue = $this->box_code->CurrentValue;
                    }
                }
            } else {
                $this->box_code->ViewValue = null;
            }
            $this->box_code->ViewCustomAttributes = "";

            // store_id
            $curVal = strval($this->store_id->CurrentValue);
            if ($curVal != "") {
                $this->store_id->ViewValue = $this->store_id->lookupCacheOption($curVal);
                if ($this->store_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`store_id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->store_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->store_id->Lookup->renderViewRow($rswrk[0]);
                        $this->store_id->ViewValue = $this->store_id->displayValue($arwrk);
                    } else {
                        $this->store_id->ViewValue = $this->store_id->CurrentValue;
                    }
                }
            } else {
                $this->store_id->ViewValue = null;
            }
            $this->store_id->ViewCustomAttributes = "";

            // store_name
            $this->store_name->ViewValue = $this->store_name->CurrentValue;
            $this->store_name->ViewCustomAttributes = "";

            // article
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";

            // picked_qty
            $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
            $this->picked_qty->ViewValue = FormatNumber($this->picked_qty->ViewValue, $this->picked_qty->formatPattern());
            $this->picked_qty->ViewCustomAttributes = "";

            // scan_qty
            $this->scan_qty->ViewValue = $this->scan_qty->CurrentValue;
            $this->scan_qty->ViewCustomAttributes = "";

            // checker
            $this->checker->ViewValue = $this->checker->CurrentValue;
            $this->checker->ViewCustomAttributes = "";

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

            // box_code
            $this->box_code->LinkCustomAttributes = "";
            $this->box_code->HrefValue = "";

            // store_id
            $this->store_id->LinkCustomAttributes = "";
            $this->store_id->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";

            // scan_qty
            $this->scan_qty->LinkCustomAttributes = "";
            $this->scan_qty->HrefValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";

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
            $this->id->ViewCustomAttributes = "";

            // box_code
            $this->box_code->setupEditAttributes();
            $this->box_code->EditCustomAttributes = "";
            $curVal = trim(strval($this->box_code->CurrentValue));
            if ($curVal != "") {
                $this->box_code->ViewValue = $this->box_code->lookupCacheOption($curVal);
            } else {
                $this->box_code->ViewValue = $this->box_code->Lookup !== null && is_array($this->box_code->lookupOptions()) ? $curVal : null;
            }
            if ($this->box_code->ViewValue !== null) { // Load from cache
                $this->box_code->EditValue = array_values($this->box_code->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`box_code`" . SearchString("=", $this->box_code->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->box_code->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->box_code->EditValue = $arwrk;
            }
            $this->box_code->PlaceHolder = RemoveHtml($this->box_code->caption());

            // store_id
            $this->store_id->setupEditAttributes();
            $this->store_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->store_id->CurrentValue));
            if ($curVal != "") {
                $this->store_id->ViewValue = $this->store_id->lookupCacheOption($curVal);
            } else {
                $this->store_id->ViewValue = $this->store_id->Lookup !== null && is_array($this->store_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->store_id->ViewValue !== null) { // Load from cache
                $this->store_id->EditValue = array_values($this->store_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`store_id`" . SearchString("=", $this->store_id->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->store_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->store_id->EditValue = $arwrk;
            }
            $this->store_id->PlaceHolder = RemoveHtml($this->store_id->caption());

            // store_name
            $this->store_name->setupEditAttributes();
            $this->store_name->EditCustomAttributes = 'readonly';
            if (!$this->store_name->Raw) {
                $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
            }
            $this->store_name->EditValue = HtmlEncode($this->store_name->CurrentValue);
            $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

            // article
            $this->article->setupEditAttributes();
            $this->article->EditCustomAttributes = 'readonly';
            if (!$this->article->Raw) {
                $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
            }
            $this->article->EditValue = HtmlEncode($this->article->CurrentValue);
            $this->article->PlaceHolder = RemoveHtml($this->article->caption());

            // picked_qty
            $this->picked_qty->setupEditAttributes();
            $this->picked_qty->EditCustomAttributes = 'readonly';
            $this->picked_qty->EditValue = HtmlEncode($this->picked_qty->CurrentValue);
            $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());
            if (strval($this->picked_qty->EditValue) != "" && is_numeric($this->picked_qty->EditValue)) {
                $this->picked_qty->EditValue = FormatNumber($this->picked_qty->EditValue, null);
            }

            // scan_qty
            $this->scan_qty->setupEditAttributes();
            $this->scan_qty->EditCustomAttributes = "";
            if (!$this->scan_qty->Raw) {
                $this->scan_qty->CurrentValue = HtmlDecode($this->scan_qty->CurrentValue);
            }
            $this->scan_qty->EditValue = HtmlEncode($this->scan_qty->CurrentValue);
            $this->scan_qty->PlaceHolder = RemoveHtml($this->scan_qty->caption());

            // checker
            $this->checker->setupEditAttributes();
            $this->checker->EditCustomAttributes = 'readonly';
            if (!$this->checker->Raw) {
                $this->checker->CurrentValue = HtmlDecode($this->checker->CurrentValue);
            }
            $this->checker->EditValue = HtmlEncode($this->checker->CurrentValue);
            $this->checker->PlaceHolder = RemoveHtml($this->checker->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // date_update
            $this->date_update->setupEditAttributes();
            $this->date_update->EditCustomAttributes = 'readonly';
            $this->date_update->EditValue = HtmlEncode(FormatDateTime($this->date_update->CurrentValue, $this->date_update->formatPattern()));
            $this->date_update->PlaceHolder = RemoveHtml($this->date_update->caption());

            // time_update
            $this->time_update->setupEditAttributes();
            $this->time_update->EditCustomAttributes = 'readonly';
            $this->time_update->EditValue = HtmlEncode(FormatDateTime($this->time_update->CurrentValue, $this->time_update->formatPattern()));
            $this->time_update->PlaceHolder = RemoveHtml($this->time_update->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // box_code
            $this->box_code->LinkCustomAttributes = "";
            $this->box_code->HrefValue = "";

            // store_id
            $this->store_id->LinkCustomAttributes = "";
            $this->store_id->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";

            // scan_qty
            $this->scan_qty->LinkCustomAttributes = "";
            $this->scan_qty->HrefValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";

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
        if ($this->box_code->Required) {
            if (!$this->box_code->IsDetailKey && EmptyValue($this->box_code->FormValue)) {
                $this->box_code->addErrorMessage(str_replace("%s", $this->box_code->caption(), $this->box_code->RequiredErrorMessage));
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
        if ($this->picked_qty->Required) {
            if (!$this->picked_qty->IsDetailKey && EmptyValue($this->picked_qty->FormValue)) {
                $this->picked_qty->addErrorMessage(str_replace("%s", $this->picked_qty->caption(), $this->picked_qty->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->picked_qty->FormValue)) {
            $this->picked_qty->addErrorMessage($this->picked_qty->getErrorMessage(false));
        }
        if ($this->scan_qty->Required) {
            if (!$this->scan_qty->IsDetailKey && EmptyValue($this->scan_qty->FormValue)) {
                $this->scan_qty->addErrorMessage(str_replace("%s", $this->scan_qty->caption(), $this->scan_qty->RequiredErrorMessage));
            }
        }
        if ($this->checker->Required) {
            if (!$this->checker->IsDetailKey && EmptyValue($this->checker->FormValue)) {
                $this->checker->addErrorMessage(str_replace("%s", $this->checker->caption(), $this->checker->RequiredErrorMessage));
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
        if (!CheckDate($this->date_update->FormValue, $this->date_update->formatPattern())) {
            $this->date_update->addErrorMessage($this->date_update->getErrorMessage(false));
        }
        if ($this->time_update->Required) {
            if (!$this->time_update->IsDetailKey && EmptyValue($this->time_update->FormValue)) {
                $this->time_update->addErrorMessage(str_replace("%s", $this->time_update->caption(), $this->time_update->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->time_update->FormValue, $this->time_update->formatPattern())) {
            $this->time_update->addErrorMessage($this->time_update->getErrorMessage(false));
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

        // box_code
        $this->box_code->setDbValueDef($rsnew, $this->box_code->CurrentValue, "", $this->box_code->ReadOnly);

        // store_id
        $this->store_id->setDbValueDef($rsnew, $this->store_id->CurrentValue, "", $this->store_id->ReadOnly);

        // store_name
        $this->store_name->setDbValueDef($rsnew, $this->store_name->CurrentValue, "", $this->store_name->ReadOnly);

        // article
        $this->article->setDbValueDef($rsnew, $this->article->CurrentValue, "", $this->article->ReadOnly);

        // picked_qty
        $this->picked_qty->setDbValueDef($rsnew, $this->picked_qty->CurrentValue, 0, $this->picked_qty->ReadOnly);

        // scan_qty
        $this->scan_qty->setDbValueDef($rsnew, $this->scan_qty->CurrentValue, "", $this->scan_qty->ReadOnly);

        // checker
        $this->checker->setDbValueDef($rsnew, $this->checker->CurrentValue, "", $this->checker->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, "", $this->status->ReadOnly);

        // date_update
        $this->date_update->setDbValueDef($rsnew, UnFormatDateTime($this->date_update->CurrentValue, $this->date_update->formatPattern()), CurrentDate(), $this->date_update->ReadOnly);

        // time_update
        $this->time_update->setDbValueDef($rsnew, UnFormatDateTime($this->time_update->CurrentValue, $this->time_update->formatPattern()), CurrentDate(), $this->time_update->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("auditpickingonlinelist"), "", $this->TableVar, true);
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
                case "x_box_code":
                    break;
                case "x_store_id":
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

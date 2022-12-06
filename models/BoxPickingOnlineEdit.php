<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class BoxPickingOnlineEdit extends BoxPickingOnline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'box_picking_online';

    // Page object name
    public $PageObjName = "BoxPickingOnlineEdit";

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

        // Table object (box_picking_online)
        if (!isset($GLOBALS["box_picking_online"]) || get_class($GLOBALS["box_picking_online"]) == PROJECT_NAMESPACE . "box_picking_online") {
            $GLOBALS["box_picking_online"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'box_picking_online');
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
                $tbl = Container("box_picking_online");
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
                    if ($pageName == "boxpickingonlineview") {
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
            $key .= @$ar['box_id'];
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
        if ($this->isAddOrEdit()) {
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
        $this->box_id->setVisibility();
        $this->store_code->setVisibility();
        $this->store_name->setVisibility();
        $this->type->setVisibility();
        $this->concept->setVisibility();
        $this->picked_qty->setVisibility();
        $this->scan_qty->setVisibility();
        $this->status->setVisibility();
        $this->users->setVisibility();
        $this->picking_date->setVisibility();
        $this->line->setVisibility();
        $this->date_created->setVisibility();
        $this->date_delivery->setVisibility();
        $this->date_staging->setVisibility();
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
            if (($keyValue = Get("box_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->box_id->setQueryStringValue($keyValue);
                $this->box_id->setOldValue($this->box_id->QueryStringValue);
            } elseif (Post("box_id") !== null) {
                $this->box_id->setFormValue(Post("box_id"));
                $this->box_id->setOldValue($this->box_id->FormValue);
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
                if (($keyValue = Get("box_id") ?? Route("box_id")) !== null) {
                    $this->box_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->box_id->CurrentValue = null;
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
                        $this->terminate("boxpickingonlinelist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "boxpickingonlinelist") {
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

        // Check field name 'box_id' first before field var 'x_box_id'
        $val = $CurrentForm->hasValue("box_id") ? $CurrentForm->getValue("box_id") : $CurrentForm->getValue("x_box_id");
        if (!$this->box_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->box_id->Visible = false; // Disable update for API request
            } else {
                $this->box_id->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_box_id")) {
            $this->box_id->setOldValue($CurrentForm->getValue("o_box_id"));
        }

        // Check field name 'store_code' first before field var 'x_store_code'
        $val = $CurrentForm->hasValue("store_code") ? $CurrentForm->getValue("store_code") : $CurrentForm->getValue("x_store_code");
        if (!$this->store_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->store_code->Visible = false; // Disable update for API request
            } else {
                $this->store_code->setFormValue($val);
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

        // Check field name 'type' first before field var 'x_type'
        $val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
        if (!$this->type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->type->Visible = false; // Disable update for API request
            } else {
                $this->type->setFormValue($val);
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
                $this->scan_qty->setFormValue($val, true, $validate);
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

        // Check field name 'users' first before field var 'x_users'
        $val = $CurrentForm->hasValue("users") ? $CurrentForm->getValue("users") : $CurrentForm->getValue("x_users");
        if (!$this->users->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->users->Visible = false; // Disable update for API request
            } else {
                $this->users->setFormValue($val);
            }
        }

        // Check field name 'picking_date' first before field var 'x_picking_date'
        $val = $CurrentForm->hasValue("picking_date") ? $CurrentForm->getValue("picking_date") : $CurrentForm->getValue("x_picking_date");
        if (!$this->picking_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->picking_date->Visible = false; // Disable update for API request
            } else {
                $this->picking_date->setFormValue($val, true, $validate);
            }
            $this->picking_date->CurrentValue = UnFormatDateTime($this->picking_date->CurrentValue, $this->picking_date->formatPattern());
        }

        // Check field name 'line' first before field var 'x_line'
        $val = $CurrentForm->hasValue("line") ? $CurrentForm->getValue("line") : $CurrentForm->getValue("x_line");
        if (!$this->line->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->line->Visible = false; // Disable update for API request
            } else {
                $this->line->setFormValue($val);
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

        // Check field name 'date_delivery' first before field var 'x_date_delivery'
        $val = $CurrentForm->hasValue("date_delivery") ? $CurrentForm->getValue("date_delivery") : $CurrentForm->getValue("x_date_delivery");
        if (!$this->date_delivery->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_delivery->Visible = false; // Disable update for API request
            } else {
                $this->date_delivery->setFormValue($val, true, $validate);
            }
            $this->date_delivery->CurrentValue = UnFormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern());
        }

        // Check field name 'date_staging' first before field var 'x_date_staging'
        $val = $CurrentForm->hasValue("date_staging") ? $CurrentForm->getValue("date_staging") : $CurrentForm->getValue("x_date_staging");
        if (!$this->date_staging->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_staging->Visible = false; // Disable update for API request
            } else {
                $this->date_staging->setFormValue($val, true, $validate);
            }
            $this->date_staging->CurrentValue = UnFormatDateTime($this->date_staging->CurrentValue, $this->date_staging->formatPattern());
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->box_id->CurrentValue = $this->box_id->FormValue;
        $this->store_code->CurrentValue = $this->store_code->FormValue;
        $this->store_name->CurrentValue = $this->store_name->FormValue;
        $this->type->CurrentValue = $this->type->FormValue;
        $this->concept->CurrentValue = $this->concept->FormValue;
        $this->picked_qty->CurrentValue = $this->picked_qty->FormValue;
        $this->scan_qty->CurrentValue = $this->scan_qty->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->users->CurrentValue = $this->users->FormValue;
        $this->picking_date->CurrentValue = $this->picking_date->FormValue;
        $this->picking_date->CurrentValue = UnFormatDateTime($this->picking_date->CurrentValue, $this->picking_date->formatPattern());
        $this->line->CurrentValue = $this->line->FormValue;
        $this->date_created->CurrentValue = $this->date_created->FormValue;
        $this->date_created->CurrentValue = UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_delivery->CurrentValue = $this->date_delivery->FormValue;
        $this->date_delivery->CurrentValue = UnFormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern());
        $this->date_staging->CurrentValue = $this->date_staging->FormValue;
        $this->date_staging->CurrentValue = UnFormatDateTime($this->date_staging->CurrentValue, $this->date_staging->formatPattern());
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
        $this->box_id->setDbValue($row['box_id']);
        $this->store_code->setDbValue($row['store_code']);
        $this->store_name->setDbValue($row['store_name']);
        $this->type->setDbValue($row['type']);
        $this->concept->setDbValue($row['concept']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->scan_qty->setDbValue($row['scan_qty']);
        $this->status->setDbValue($row['status']);
        $this->users->setDbValue($row['users']);
        $this->picking_date->setDbValue($row['picking_date']);
        $this->line->setDbValue($row['line']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_delivery->setDbValue($row['date_delivery']);
        $this->date_staging->setDbValue($row['date_staging']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['box_id'] = $this->box_id->DefaultValue;
        $row['store_code'] = $this->store_code->DefaultValue;
        $row['store_name'] = $this->store_name->DefaultValue;
        $row['type'] = $this->type->DefaultValue;
        $row['concept'] = $this->concept->DefaultValue;
        $row['picked_qty'] = $this->picked_qty->DefaultValue;
        $row['scan_qty'] = $this->scan_qty->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['users'] = $this->users->DefaultValue;
        $row['picking_date'] = $this->picking_date->DefaultValue;
        $row['line'] = $this->line->DefaultValue;
        $row['date_created'] = $this->date_created->DefaultValue;
        $row['date_delivery'] = $this->date_delivery->DefaultValue;
        $row['date_staging'] = $this->date_staging->DefaultValue;
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

        // box_id
        $this->box_id->RowCssClass = "row";

        // store_code
        $this->store_code->RowCssClass = "row";

        // store_name
        $this->store_name->RowCssClass = "row";

        // type
        $this->type->RowCssClass = "row";

        // concept
        $this->concept->RowCssClass = "row";

        // picked_qty
        $this->picked_qty->RowCssClass = "row";

        // scan_qty
        $this->scan_qty->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // users
        $this->users->RowCssClass = "row";

        // picking_date
        $this->picking_date->RowCssClass = "row";

        // line
        $this->line->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_delivery
        $this->date_delivery->RowCssClass = "row";

        // date_staging
        $this->date_staging->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // box_id
            $this->box_id->ViewValue = $this->box_id->CurrentValue;
            $this->box_id->ViewCustomAttributes = "";

            // store_code
            $this->store_code->ViewValue = $this->store_code->CurrentValue;
            $this->store_code->ViewCustomAttributes = "";

            // store_name
            $this->store_name->ViewValue = $this->store_name->CurrentValue;
            $this->store_name->ViewCustomAttributes = "";

            // type
            $this->type->ViewValue = $this->type->CurrentValue;
            $this->type->ViewCustomAttributes = "";

            // concept
            $this->concept->ViewValue = $this->concept->CurrentValue;
            $this->concept->ViewCustomAttributes = "";

            // picked_qty
            $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
            $this->picked_qty->ViewValue = FormatNumber($this->picked_qty->ViewValue, $this->picked_qty->formatPattern());
            $this->picked_qty->ViewCustomAttributes = "";

            // scan_qty
            $this->scan_qty->ViewValue = $this->scan_qty->CurrentValue;
            $this->scan_qty->ViewValue = FormatNumber($this->scan_qty->ViewValue, $this->scan_qty->formatPattern());
            $this->scan_qty->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // users
            $this->users->ViewValue = $this->users->CurrentValue;
            $this->users->ViewCustomAttributes = "";

            // picking_date
            $this->picking_date->ViewValue = $this->picking_date->CurrentValue;
            $this->picking_date->ViewValue = FormatDateTime($this->picking_date->ViewValue, $this->picking_date->formatPattern());
            $this->picking_date->ViewCustomAttributes = "";

            // line
            $this->line->ViewValue = $this->line->CurrentValue;
            $this->line->ViewCustomAttributes = "";

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
            $this->date_created->ViewCustomAttributes = "";

            // date_delivery
            $this->date_delivery->ViewValue = $this->date_delivery->CurrentValue;
            $this->date_delivery->ViewValue = FormatDateTime($this->date_delivery->ViewValue, $this->date_delivery->formatPattern());
            $this->date_delivery->ViewCustomAttributes = "";

            // date_staging
            $this->date_staging->ViewValue = $this->date_staging->CurrentValue;
            $this->date_staging->ViewValue = FormatDateTime($this->date_staging->ViewValue, $this->date_staging->formatPattern());
            $this->date_staging->ViewCustomAttributes = "";

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
            $this->date_updated->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // box_id
            $this->box_id->LinkCustomAttributes = "";
            $this->box_id->HrefValue = "";

            // store_code
            $this->store_code->LinkCustomAttributes = "";
            $this->store_code->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";

            // scan_qty
            $this->scan_qty->LinkCustomAttributes = "";
            $this->scan_qty->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // users
            $this->users->LinkCustomAttributes = "";
            $this->users->HrefValue = "";

            // picking_date
            $this->picking_date->LinkCustomAttributes = "";
            $this->picking_date->HrefValue = "";

            // line
            $this->line->LinkCustomAttributes = "";
            $this->line->HrefValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";

            // date_delivery
            $this->date_delivery->LinkCustomAttributes = "";
            $this->date_delivery->HrefValue = "";

            // date_staging
            $this->date_staging->LinkCustomAttributes = "";
            $this->date_staging->HrefValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->CurrentValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());
            if (strval($this->id->EditValue) != "" && is_numeric($this->id->EditValue)) {
                $this->id->EditValue = $this->id->EditValue;
            }

            // box_id
            $this->box_id->setupEditAttributes();
            $this->box_id->EditCustomAttributes = "";
            if (!$this->box_id->Raw) {
                $this->box_id->CurrentValue = HtmlDecode($this->box_id->CurrentValue);
            }
            $this->box_id->EditValue = HtmlEncode($this->box_id->CurrentValue);
            $this->box_id->PlaceHolder = RemoveHtml($this->box_id->caption());

            // store_code
            $this->store_code->setupEditAttributes();
            $this->store_code->EditCustomAttributes = "";
            if (!$this->store_code->Raw) {
                $this->store_code->CurrentValue = HtmlDecode($this->store_code->CurrentValue);
            }
            $this->store_code->EditValue = HtmlEncode($this->store_code->CurrentValue);
            $this->store_code->PlaceHolder = RemoveHtml($this->store_code->caption());

            // store_name
            $this->store_name->setupEditAttributes();
            $this->store_name->EditCustomAttributes = "";
            if (!$this->store_name->Raw) {
                $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
            }
            $this->store_name->EditValue = HtmlEncode($this->store_name->CurrentValue);
            $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

            // type
            $this->type->setupEditAttributes();
            $this->type->EditCustomAttributes = "";
            if (!$this->type->Raw) {
                $this->type->CurrentValue = HtmlDecode($this->type->CurrentValue);
            }
            $this->type->EditValue = HtmlEncode($this->type->CurrentValue);
            $this->type->PlaceHolder = RemoveHtml($this->type->caption());

            // concept
            $this->concept->setupEditAttributes();
            $this->concept->EditCustomAttributes = "";
            if (!$this->concept->Raw) {
                $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
            }
            $this->concept->EditValue = HtmlEncode($this->concept->CurrentValue);
            $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

            // picked_qty
            $this->picked_qty->setupEditAttributes();
            $this->picked_qty->EditCustomAttributes = "";
            $this->picked_qty->EditValue = HtmlEncode($this->picked_qty->CurrentValue);
            $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());
            if (strval($this->picked_qty->EditValue) != "" && is_numeric($this->picked_qty->EditValue)) {
                $this->picked_qty->EditValue = FormatNumber($this->picked_qty->EditValue, null);
            }

            // scan_qty
            $this->scan_qty->setupEditAttributes();
            $this->scan_qty->EditCustomAttributes = "";
            $this->scan_qty->EditValue = HtmlEncode($this->scan_qty->CurrentValue);
            $this->scan_qty->PlaceHolder = RemoveHtml($this->scan_qty->caption());
            if (strval($this->scan_qty->EditValue) != "" && is_numeric($this->scan_qty->EditValue)) {
                $this->scan_qty->EditValue = FormatNumber($this->scan_qty->EditValue, null);
            }

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // users
            $this->users->setupEditAttributes();
            $this->users->EditCustomAttributes = "";
            if (!$this->users->Raw) {
                $this->users->CurrentValue = HtmlDecode($this->users->CurrentValue);
            }
            $this->users->EditValue = HtmlEncode($this->users->CurrentValue);
            $this->users->PlaceHolder = RemoveHtml($this->users->caption());

            // picking_date
            $this->picking_date->setupEditAttributes();
            $this->picking_date->EditCustomAttributes = "";
            $this->picking_date->EditValue = HtmlEncode(FormatDateTime($this->picking_date->CurrentValue, $this->picking_date->formatPattern()));
            $this->picking_date->PlaceHolder = RemoveHtml($this->picking_date->caption());

            // line
            $this->line->setupEditAttributes();
            $this->line->EditCustomAttributes = "";
            if (!$this->line->Raw) {
                $this->line->CurrentValue = HtmlDecode($this->line->CurrentValue);
            }
            $this->line->EditValue = HtmlEncode($this->line->CurrentValue);
            $this->line->PlaceHolder = RemoveHtml($this->line->caption());

            // date_created
            $this->date_created->setupEditAttributes();
            $this->date_created->EditCustomAttributes = "";
            $this->date_created->EditValue = HtmlEncode(FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()));
            $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

            // date_delivery
            $this->date_delivery->setupEditAttributes();
            $this->date_delivery->EditCustomAttributes = "";
            $this->date_delivery->EditValue = HtmlEncode(FormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern()));
            $this->date_delivery->PlaceHolder = RemoveHtml($this->date_delivery->caption());

            // date_staging
            $this->date_staging->setupEditAttributes();
            $this->date_staging->EditCustomAttributes = "";
            $this->date_staging->EditValue = HtmlEncode(FormatDateTime($this->date_staging->CurrentValue, $this->date_staging->formatPattern()));
            $this->date_staging->PlaceHolder = RemoveHtml($this->date_staging->caption());

            // date_updated
            $this->date_updated->setupEditAttributes();
            $this->date_updated->EditCustomAttributes = "";
            $this->date_updated->EditValue = HtmlEncode(FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()));
            $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // box_id
            $this->box_id->LinkCustomAttributes = "";
            $this->box_id->HrefValue = "";

            // store_code
            $this->store_code->LinkCustomAttributes = "";
            $this->store_code->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";

            // scan_qty
            $this->scan_qty->LinkCustomAttributes = "";
            $this->scan_qty->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // users
            $this->users->LinkCustomAttributes = "";
            $this->users->HrefValue = "";

            // picking_date
            $this->picking_date->LinkCustomAttributes = "";
            $this->picking_date->HrefValue = "";

            // line
            $this->line->LinkCustomAttributes = "";
            $this->line->HrefValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";

            // date_delivery
            $this->date_delivery->LinkCustomAttributes = "";
            $this->date_delivery->HrefValue = "";

            // date_staging
            $this->date_staging->LinkCustomAttributes = "";
            $this->date_staging->HrefValue = "";

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
        if ($this->box_id->Required) {
            if (!$this->box_id->IsDetailKey && EmptyValue($this->box_id->FormValue)) {
                $this->box_id->addErrorMessage(str_replace("%s", $this->box_id->caption(), $this->box_id->RequiredErrorMessage));
            }
        }
        if ($this->store_code->Required) {
            if (!$this->store_code->IsDetailKey && EmptyValue($this->store_code->FormValue)) {
                $this->store_code->addErrorMessage(str_replace("%s", $this->store_code->caption(), $this->store_code->RequiredErrorMessage));
            }
        }
        if ($this->store_name->Required) {
            if (!$this->store_name->IsDetailKey && EmptyValue($this->store_name->FormValue)) {
                $this->store_name->addErrorMessage(str_replace("%s", $this->store_name->caption(), $this->store_name->RequiredErrorMessage));
            }
        }
        if ($this->type->Required) {
            if (!$this->type->IsDetailKey && EmptyValue($this->type->FormValue)) {
                $this->type->addErrorMessage(str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
            }
        }
        if ($this->concept->Required) {
            if (!$this->concept->IsDetailKey && EmptyValue($this->concept->FormValue)) {
                $this->concept->addErrorMessage(str_replace("%s", $this->concept->caption(), $this->concept->RequiredErrorMessage));
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
        if (!CheckInteger($this->scan_qty->FormValue)) {
            $this->scan_qty->addErrorMessage($this->scan_qty->getErrorMessage(false));
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->users->Required) {
            if (!$this->users->IsDetailKey && EmptyValue($this->users->FormValue)) {
                $this->users->addErrorMessage(str_replace("%s", $this->users->caption(), $this->users->RequiredErrorMessage));
            }
        }
        if ($this->picking_date->Required) {
            if (!$this->picking_date->IsDetailKey && EmptyValue($this->picking_date->FormValue)) {
                $this->picking_date->addErrorMessage(str_replace("%s", $this->picking_date->caption(), $this->picking_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->picking_date->FormValue, $this->picking_date->formatPattern())) {
            $this->picking_date->addErrorMessage($this->picking_date->getErrorMessage(false));
        }
        if ($this->line->Required) {
            if (!$this->line->IsDetailKey && EmptyValue($this->line->FormValue)) {
                $this->line->addErrorMessage(str_replace("%s", $this->line->caption(), $this->line->RequiredErrorMessage));
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
        if ($this->date_delivery->Required) {
            if (!$this->date_delivery->IsDetailKey && EmptyValue($this->date_delivery->FormValue)) {
                $this->date_delivery->addErrorMessage(str_replace("%s", $this->date_delivery->caption(), $this->date_delivery->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_delivery->FormValue, $this->date_delivery->formatPattern())) {
            $this->date_delivery->addErrorMessage($this->date_delivery->getErrorMessage(false));
        }
        if ($this->date_staging->Required) {
            if (!$this->date_staging->IsDetailKey && EmptyValue($this->date_staging->FormValue)) {
                $this->date_staging->addErrorMessage(str_replace("%s", $this->date_staging->caption(), $this->date_staging->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_staging->FormValue, $this->date_staging->formatPattern())) {
            $this->date_staging->addErrorMessage($this->date_staging->getErrorMessage(false));
        }
        if ($this->date_updated->Required) {
            if (!$this->date_updated->IsDetailKey && EmptyValue($this->date_updated->FormValue)) {
                $this->date_updated->addErrorMessage(str_replace("%s", $this->date_updated->caption(), $this->date_updated->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_updated->FormValue, $this->date_updated->formatPattern())) {
            $this->date_updated->addErrorMessage($this->date_updated->getErrorMessage(false));
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

        // box_id
        $this->box_id->setDbValueDef($rsnew, $this->box_id->CurrentValue, null, $this->box_id->ReadOnly);

        // store_code
        $this->store_code->setDbValueDef($rsnew, $this->store_code->CurrentValue, null, $this->store_code->ReadOnly);

        // store_name
        $this->store_name->setDbValueDef($rsnew, $this->store_name->CurrentValue, null, $this->store_name->ReadOnly);

        // type
        $this->type->setDbValueDef($rsnew, $this->type->CurrentValue, null, $this->type->ReadOnly);

        // concept
        $this->concept->setDbValueDef($rsnew, $this->concept->CurrentValue, null, $this->concept->ReadOnly);

        // picked_qty
        $this->picked_qty->setDbValueDef($rsnew, $this->picked_qty->CurrentValue, null, $this->picked_qty->ReadOnly);

        // scan_qty
        $this->scan_qty->setDbValueDef($rsnew, $this->scan_qty->CurrentValue, null, $this->scan_qty->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

        // users
        $this->users->setDbValueDef($rsnew, $this->users->CurrentValue, null, $this->users->ReadOnly);

        // picking_date
        $this->picking_date->setDbValueDef($rsnew, UnFormatDateTime($this->picking_date->CurrentValue, $this->picking_date->formatPattern()), null, $this->picking_date->ReadOnly);

        // line
        $this->line->setDbValueDef($rsnew, $this->line->CurrentValue, null, $this->line->ReadOnly);

        // date_created
        $this->date_created->setDbValueDef($rsnew, UnFormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern()), null, $this->date_created->ReadOnly);

        // date_delivery
        $this->date_delivery->setDbValueDef($rsnew, UnFormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern()), null, $this->date_delivery->ReadOnly);

        // date_staging
        $this->date_staging->setDbValueDef($rsnew, UnFormatDateTime($this->date_staging->CurrentValue, $this->date_staging->formatPattern()), null, $this->date_staging->ReadOnly);

        // date_updated
        $this->date_updated->setDbValueDef($rsnew, UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()), null, $this->date_updated->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);

        // Check for duplicate key when key changed
        if ($updateRow) {
            $newKeyFilter = $this->getRecordFilter($rsnew);
            if ($newKeyFilter != $oldKeyFilter) {
                $rsChk = $this->loadRs($newKeyFilter)->fetch();
                if ($rsChk !== false) {
                    $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                    $this->setFailureMessage($keyErrMsg);
                    $updateRow = false;
                }
            }
        }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("boxpickingonlinelist"), "", $this->TableVar, true);
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

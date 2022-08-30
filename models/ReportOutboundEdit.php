<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ReportOutboundEdit extends ReportOutbound
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'report_outbound';

    // Page object name
    public $PageObjName = "ReportOutboundEdit";

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

        // Table object (report_outbound)
        if (!isset($GLOBALS["report_outbound"]) || get_class($GLOBALS["report_outbound"]) == PROJECT_NAMESPACE . "report_outbound") {
            $GLOBALS["report_outbound"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'report_outbound');
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
                $tbl = Container("report_outbound");
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
                    if ($pageName == "reportoutboundview") {
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
        $this->Week->setVisibility();
        $this->box_id->setVisibility();
        $this->date_delivery->setVisibility();
        $this->box_type->setVisibility();
        $this->check_by->setVisibility();
        $this->quantity->setVisibility();
        $this->concept->setVisibility();
        $this->store_code->setVisibility();
        $this->store_name->setVisibility();
        $this->remark->setVisibility();
        $this->no_delivery->setVisibility();
        $this->truck_type->setVisibility();
        $this->seal_no->setVisibility();
        $this->truck_plate->setVisibility();
        $this->transporter->setVisibility();
        $this->no_hp->setVisibility();
        $this->checker->setVisibility();
        $this->admin->setVisibility();
        $this->remarks_box->setVisibility();
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
                        $this->terminate("reportoutboundlist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "reportoutboundlist") {
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

        // Check field name 'Week' first before field var 'x_Week'
        $val = $CurrentForm->hasValue("Week") ? $CurrentForm->getValue("Week") : $CurrentForm->getValue("x_Week");
        if (!$this->Week->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Week->Visible = false; // Disable update for API request
            } else {
                $this->Week->setFormValue($val);
            }
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

        // Check field name 'box_type' first before field var 'x_box_type'
        $val = $CurrentForm->hasValue("box_type") ? $CurrentForm->getValue("box_type") : $CurrentForm->getValue("x_box_type");
        if (!$this->box_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->box_type->Visible = false; // Disable update for API request
            } else {
                $this->box_type->setFormValue($val);
            }
        }

        // Check field name 'check_by' first before field var 'x_check_by'
        $val = $CurrentForm->hasValue("check_by") ? $CurrentForm->getValue("check_by") : $CurrentForm->getValue("x_check_by");
        if (!$this->check_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->check_by->Visible = false; // Disable update for API request
            } else {
                $this->check_by->setFormValue($val);
            }
        }

        // Check field name 'quantity' first before field var 'x_quantity'
        $val = $CurrentForm->hasValue("quantity") ? $CurrentForm->getValue("quantity") : $CurrentForm->getValue("x_quantity");
        if (!$this->quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->quantity->Visible = false; // Disable update for API request
            } else {
                $this->quantity->setFormValue($val);
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

        // Check field name 'remark' first before field var 'x_remark'
        $val = $CurrentForm->hasValue("remark") ? $CurrentForm->getValue("remark") : $CurrentForm->getValue("x_remark");
        if (!$this->remark->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->remark->Visible = false; // Disable update for API request
            } else {
                $this->remark->setFormValue($val);
            }
        }

        // Check field name 'no_delivery' first before field var 'x_no_delivery'
        $val = $CurrentForm->hasValue("no_delivery") ? $CurrentForm->getValue("no_delivery") : $CurrentForm->getValue("x_no_delivery");
        if (!$this->no_delivery->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_delivery->Visible = false; // Disable update for API request
            } else {
                $this->no_delivery->setFormValue($val);
            }
        }

        // Check field name 'truck_type' first before field var 'x_truck_type'
        $val = $CurrentForm->hasValue("truck_type") ? $CurrentForm->getValue("truck_type") : $CurrentForm->getValue("x_truck_type");
        if (!$this->truck_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->truck_type->Visible = false; // Disable update for API request
            } else {
                $this->truck_type->setFormValue($val);
            }
        }

        // Check field name 'seal_no' first before field var 'x_seal_no'
        $val = $CurrentForm->hasValue("seal_no") ? $CurrentForm->getValue("seal_no") : $CurrentForm->getValue("x_seal_no");
        if (!$this->seal_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->seal_no->Visible = false; // Disable update for API request
            } else {
                $this->seal_no->setFormValue($val);
            }
        }

        // Check field name 'truck_plate' first before field var 'x_truck_plate'
        $val = $CurrentForm->hasValue("truck_plate") ? $CurrentForm->getValue("truck_plate") : $CurrentForm->getValue("x_truck_plate");
        if (!$this->truck_plate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->truck_plate->Visible = false; // Disable update for API request
            } else {
                $this->truck_plate->setFormValue($val);
            }
        }

        // Check field name 'transporter' first before field var 'x_transporter'
        $val = $CurrentForm->hasValue("transporter") ? $CurrentForm->getValue("transporter") : $CurrentForm->getValue("x_transporter");
        if (!$this->transporter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->transporter->Visible = false; // Disable update for API request
            } else {
                $this->transporter->setFormValue($val);
            }
        }

        // Check field name 'no_hp' first before field var 'x_no_hp'
        $val = $CurrentForm->hasValue("no_hp") ? $CurrentForm->getValue("no_hp") : $CurrentForm->getValue("x_no_hp");
        if (!$this->no_hp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_hp->Visible = false; // Disable update for API request
            } else {
                $this->no_hp->setFormValue($val);
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

        // Check field name 'admin' first before field var 'x_admin'
        $val = $CurrentForm->hasValue("admin") ? $CurrentForm->getValue("admin") : $CurrentForm->getValue("x_admin");
        if (!$this->admin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->admin->Visible = false; // Disable update for API request
            } else {
                $this->admin->setFormValue($val);
            }
        }

        // Check field name 'remarks_box' first before field var 'x_remarks_box'
        $val = $CurrentForm->hasValue("remarks_box") ? $CurrentForm->getValue("remarks_box") : $CurrentForm->getValue("x_remarks_box");
        if (!$this->remarks_box->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->remarks_box->Visible = false; // Disable update for API request
            } else {
                $this->remarks_box->setFormValue($val);
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
        $this->Week->CurrentValue = $this->Week->FormValue;
        $this->box_id->CurrentValue = $this->box_id->FormValue;
        $this->date_delivery->CurrentValue = $this->date_delivery->FormValue;
        $this->date_delivery->CurrentValue = UnFormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern());
        $this->box_type->CurrentValue = $this->box_type->FormValue;
        $this->check_by->CurrentValue = $this->check_by->FormValue;
        $this->quantity->CurrentValue = $this->quantity->FormValue;
        $this->concept->CurrentValue = $this->concept->FormValue;
        $this->store_code->CurrentValue = $this->store_code->FormValue;
        $this->store_name->CurrentValue = $this->store_name->FormValue;
        $this->remark->CurrentValue = $this->remark->FormValue;
        $this->no_delivery->CurrentValue = $this->no_delivery->FormValue;
        $this->truck_type->CurrentValue = $this->truck_type->FormValue;
        $this->seal_no->CurrentValue = $this->seal_no->FormValue;
        $this->truck_plate->CurrentValue = $this->truck_plate->FormValue;
        $this->transporter->CurrentValue = $this->transporter->FormValue;
        $this->no_hp->CurrentValue = $this->no_hp->FormValue;
        $this->checker->CurrentValue = $this->checker->FormValue;
        $this->admin->CurrentValue = $this->admin->FormValue;
        $this->remarks_box->CurrentValue = $this->remarks_box->FormValue;
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
        $this->Week->setDbValue($row['Week']);
        $this->box_id->setDbValue($row['box_id']);
        $this->date_delivery->setDbValue($row['date_delivery']);
        $this->box_type->setDbValue($row['box_type']);
        $this->check_by->setDbValue($row['check_by']);
        $this->quantity->setDbValue($row['quantity']);
        $this->concept->setDbValue($row['concept']);
        $this->store_code->setDbValue($row['store_code']);
        $this->store_name->setDbValue($row['store_name']);
        $this->remark->setDbValue($row['remark']);
        $this->no_delivery->setDbValue($row['no_delivery']);
        $this->truck_type->setDbValue($row['truck_type']);
        $this->seal_no->setDbValue($row['seal_no']);
        $this->truck_plate->setDbValue($row['truck_plate']);
        $this->transporter->setDbValue($row['transporter']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->checker->setDbValue($row['checker']);
        $this->admin->setDbValue($row['admin']);
        $this->remarks_box->setDbValue($row['remarks_box']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['Week'] = $this->Week->DefaultValue;
        $row['box_id'] = $this->box_id->DefaultValue;
        $row['date_delivery'] = $this->date_delivery->DefaultValue;
        $row['box_type'] = $this->box_type->DefaultValue;
        $row['check_by'] = $this->check_by->DefaultValue;
        $row['quantity'] = $this->quantity->DefaultValue;
        $row['concept'] = $this->concept->DefaultValue;
        $row['store_code'] = $this->store_code->DefaultValue;
        $row['store_name'] = $this->store_name->DefaultValue;
        $row['remark'] = $this->remark->DefaultValue;
        $row['no_delivery'] = $this->no_delivery->DefaultValue;
        $row['truck_type'] = $this->truck_type->DefaultValue;
        $row['seal_no'] = $this->seal_no->DefaultValue;
        $row['truck_plate'] = $this->truck_plate->DefaultValue;
        $row['transporter'] = $this->transporter->DefaultValue;
        $row['no_hp'] = $this->no_hp->DefaultValue;
        $row['checker'] = $this->checker->DefaultValue;
        $row['admin'] = $this->admin->DefaultValue;
        $row['remarks_box'] = $this->remarks_box->DefaultValue;
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

        // Week
        $this->Week->RowCssClass = "row";

        // box_id
        $this->box_id->RowCssClass = "row";

        // date_delivery
        $this->date_delivery->RowCssClass = "row";

        // box_type
        $this->box_type->RowCssClass = "row";

        // check_by
        $this->check_by->RowCssClass = "row";

        // quantity
        $this->quantity->RowCssClass = "row";

        // concept
        $this->concept->RowCssClass = "row";

        // store_code
        $this->store_code->RowCssClass = "row";

        // store_name
        $this->store_name->RowCssClass = "row";

        // remark
        $this->remark->RowCssClass = "row";

        // no_delivery
        $this->no_delivery->RowCssClass = "row";

        // truck_type
        $this->truck_type->RowCssClass = "row";

        // seal_no
        $this->seal_no->RowCssClass = "row";

        // truck_plate
        $this->truck_plate->RowCssClass = "row";

        // transporter
        $this->transporter->RowCssClass = "row";

        // no_hp
        $this->no_hp->RowCssClass = "row";

        // checker
        $this->checker->RowCssClass = "row";

        // admin
        $this->admin->RowCssClass = "row";

        // remarks_box
        $this->remarks_box->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // Week
            $this->Week->ViewValue = $this->Week->CurrentValue;
            $this->Week->ViewCustomAttributes = "";

            // box_id
            $this->box_id->ViewValue = $this->box_id->CurrentValue;
            $this->box_id->ViewCustomAttributes = "";

            // date_delivery
            $this->date_delivery->ViewValue = $this->date_delivery->CurrentValue;
            $this->date_delivery->ViewValue = FormatDateTime($this->date_delivery->ViewValue, $this->date_delivery->formatPattern());
            $this->date_delivery->ViewCustomAttributes = "";

            // box_type
            $this->box_type->ViewValue = $this->box_type->CurrentValue;
            $this->box_type->ViewCustomAttributes = "";

            // check_by
            $this->check_by->ViewValue = $this->check_by->CurrentValue;
            $this->check_by->ViewCustomAttributes = "";

            // quantity
            $this->quantity->ViewValue = $this->quantity->CurrentValue;
            $this->quantity->ViewCustomAttributes = "";

            // concept
            $this->concept->ViewValue = $this->concept->CurrentValue;
            $this->concept->ViewCustomAttributes = "";

            // store_code
            $this->store_code->ViewValue = $this->store_code->CurrentValue;
            $this->store_code->ViewCustomAttributes = "";

            // store_name
            $this->store_name->ViewValue = $this->store_name->CurrentValue;
            $this->store_name->ViewCustomAttributes = "";

            // remark
            $this->remark->ViewValue = $this->remark->CurrentValue;
            $this->remark->ViewCustomAttributes = "";

            // no_delivery
            $this->no_delivery->ViewValue = $this->no_delivery->CurrentValue;
            $this->no_delivery->ViewCustomAttributes = "";

            // truck_type
            $this->truck_type->ViewValue = $this->truck_type->CurrentValue;
            $this->truck_type->ViewCustomAttributes = "";

            // seal_no
            $this->seal_no->ViewValue = $this->seal_no->CurrentValue;
            $this->seal_no->ViewCustomAttributes = "";

            // truck_plate
            $this->truck_plate->ViewValue = $this->truck_plate->CurrentValue;
            $this->truck_plate->ViewCustomAttributes = "";

            // transporter
            $this->transporter->ViewValue = $this->transporter->CurrentValue;
            $this->transporter->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->ViewCustomAttributes = "";

            // checker
            $this->checker->ViewValue = $this->checker->CurrentValue;
            $this->checker->ViewCustomAttributes = "";

            // admin
            $this->admin->ViewValue = $this->admin->CurrentValue;
            $this->admin->ViewCustomAttributes = "";

            // remarks_box
            $this->remarks_box->ViewValue = $this->remarks_box->CurrentValue;
            $this->remarks_box->ViewCustomAttributes = "";

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

            // Week
            $this->Week->LinkCustomAttributes = "";
            $this->Week->HrefValue = "";

            // box_id
            $this->box_id->LinkCustomAttributes = "";
            $this->box_id->HrefValue = "";

            // date_delivery
            $this->date_delivery->LinkCustomAttributes = "";
            $this->date_delivery->HrefValue = "";

            // box_type
            $this->box_type->LinkCustomAttributes = "";
            $this->box_type->HrefValue = "";

            // check_by
            $this->check_by->LinkCustomAttributes = "";
            $this->check_by->HrefValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // store_code
            $this->store_code->LinkCustomAttributes = "";
            $this->store_code->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // remark
            $this->remark->LinkCustomAttributes = "";
            $this->remark->HrefValue = "";

            // no_delivery
            $this->no_delivery->LinkCustomAttributes = "";
            $this->no_delivery->HrefValue = "";

            // truck_type
            $this->truck_type->LinkCustomAttributes = "";
            $this->truck_type->HrefValue = "";

            // seal_no
            $this->seal_no->LinkCustomAttributes = "";
            $this->seal_no->HrefValue = "";

            // truck_plate
            $this->truck_plate->LinkCustomAttributes = "";
            $this->truck_plate->HrefValue = "";

            // transporter
            $this->transporter->LinkCustomAttributes = "";
            $this->transporter->HrefValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";

            // admin
            $this->admin->LinkCustomAttributes = "";
            $this->admin->HrefValue = "";

            // remarks_box
            $this->remarks_box->LinkCustomAttributes = "";
            $this->remarks_box->HrefValue = "";

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

            // Week
            $this->Week->setupEditAttributes();
            $this->Week->EditCustomAttributes = "";
            if (!$this->Week->Raw) {
                $this->Week->CurrentValue = HtmlDecode($this->Week->CurrentValue);
            }
            $this->Week->EditValue = HtmlEncode($this->Week->CurrentValue);
            $this->Week->PlaceHolder = RemoveHtml($this->Week->caption());

            // box_id
            $this->box_id->setupEditAttributes();
            $this->box_id->EditCustomAttributes = "";
            if (!$this->box_id->Raw) {
                $this->box_id->CurrentValue = HtmlDecode($this->box_id->CurrentValue);
            }
            $this->box_id->EditValue = HtmlEncode($this->box_id->CurrentValue);
            $this->box_id->PlaceHolder = RemoveHtml($this->box_id->caption());

            // date_delivery
            $this->date_delivery->setupEditAttributes();
            $this->date_delivery->EditCustomAttributes = "";
            $this->date_delivery->EditValue = HtmlEncode(FormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern()));
            $this->date_delivery->PlaceHolder = RemoveHtml($this->date_delivery->caption());

            // box_type
            $this->box_type->setupEditAttributes();
            $this->box_type->EditCustomAttributes = "";
            if (!$this->box_type->Raw) {
                $this->box_type->CurrentValue = HtmlDecode($this->box_type->CurrentValue);
            }
            $this->box_type->EditValue = HtmlEncode($this->box_type->CurrentValue);
            $this->box_type->PlaceHolder = RemoveHtml($this->box_type->caption());

            // check_by
            $this->check_by->setupEditAttributes();
            $this->check_by->EditCustomAttributes = "";
            if (!$this->check_by->Raw) {
                $this->check_by->CurrentValue = HtmlDecode($this->check_by->CurrentValue);
            }
            $this->check_by->EditValue = HtmlEncode($this->check_by->CurrentValue);
            $this->check_by->PlaceHolder = RemoveHtml($this->check_by->caption());

            // quantity
            $this->quantity->setupEditAttributes();
            $this->quantity->EditCustomAttributes = "";
            if (!$this->quantity->Raw) {
                $this->quantity->CurrentValue = HtmlDecode($this->quantity->CurrentValue);
            }
            $this->quantity->EditValue = HtmlEncode($this->quantity->CurrentValue);
            $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());

            // concept
            $this->concept->setupEditAttributes();
            $this->concept->EditCustomAttributes = "";
            if (!$this->concept->Raw) {
                $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
            }
            $this->concept->EditValue = HtmlEncode($this->concept->CurrentValue);
            $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

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

            // remark
            $this->remark->setupEditAttributes();
            $this->remark->EditCustomAttributes = "";
            if (!$this->remark->Raw) {
                $this->remark->CurrentValue = HtmlDecode($this->remark->CurrentValue);
            }
            $this->remark->EditValue = HtmlEncode($this->remark->CurrentValue);
            $this->remark->PlaceHolder = RemoveHtml($this->remark->caption());

            // no_delivery
            $this->no_delivery->setupEditAttributes();
            $this->no_delivery->EditCustomAttributes = "";
            if (!$this->no_delivery->Raw) {
                $this->no_delivery->CurrentValue = HtmlDecode($this->no_delivery->CurrentValue);
            }
            $this->no_delivery->EditValue = HtmlEncode($this->no_delivery->CurrentValue);
            $this->no_delivery->PlaceHolder = RemoveHtml($this->no_delivery->caption());

            // truck_type
            $this->truck_type->setupEditAttributes();
            $this->truck_type->EditCustomAttributes = "";
            if (!$this->truck_type->Raw) {
                $this->truck_type->CurrentValue = HtmlDecode($this->truck_type->CurrentValue);
            }
            $this->truck_type->EditValue = HtmlEncode($this->truck_type->CurrentValue);
            $this->truck_type->PlaceHolder = RemoveHtml($this->truck_type->caption());

            // seal_no
            $this->seal_no->setupEditAttributes();
            $this->seal_no->EditCustomAttributes = "";
            if (!$this->seal_no->Raw) {
                $this->seal_no->CurrentValue = HtmlDecode($this->seal_no->CurrentValue);
            }
            $this->seal_no->EditValue = HtmlEncode($this->seal_no->CurrentValue);
            $this->seal_no->PlaceHolder = RemoveHtml($this->seal_no->caption());

            // truck_plate
            $this->truck_plate->setupEditAttributes();
            $this->truck_plate->EditCustomAttributes = "";
            if (!$this->truck_plate->Raw) {
                $this->truck_plate->CurrentValue = HtmlDecode($this->truck_plate->CurrentValue);
            }
            $this->truck_plate->EditValue = HtmlEncode($this->truck_plate->CurrentValue);
            $this->truck_plate->PlaceHolder = RemoveHtml($this->truck_plate->caption());

            // transporter
            $this->transporter->setupEditAttributes();
            $this->transporter->EditCustomAttributes = "";
            if (!$this->transporter->Raw) {
                $this->transporter->CurrentValue = HtmlDecode($this->transporter->CurrentValue);
            }
            $this->transporter->EditValue = HtmlEncode($this->transporter->CurrentValue);
            $this->transporter->PlaceHolder = RemoveHtml($this->transporter->caption());

            // no_hp
            $this->no_hp->setupEditAttributes();
            $this->no_hp->EditCustomAttributes = "";
            if (!$this->no_hp->Raw) {
                $this->no_hp->CurrentValue = HtmlDecode($this->no_hp->CurrentValue);
            }
            $this->no_hp->EditValue = HtmlEncode($this->no_hp->CurrentValue);
            $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

            // checker
            $this->checker->setupEditAttributes();
            $this->checker->EditCustomAttributes = "";
            if (!$this->checker->Raw) {
                $this->checker->CurrentValue = HtmlDecode($this->checker->CurrentValue);
            }
            $this->checker->EditValue = HtmlEncode($this->checker->CurrentValue);
            $this->checker->PlaceHolder = RemoveHtml($this->checker->caption());

            // admin
            $this->admin->setupEditAttributes();
            $this->admin->EditCustomAttributes = "";
            if (!$this->admin->Raw) {
                $this->admin->CurrentValue = HtmlDecode($this->admin->CurrentValue);
            }
            $this->admin->EditValue = HtmlEncode($this->admin->CurrentValue);
            $this->admin->PlaceHolder = RemoveHtml($this->admin->caption());

            // remarks_box
            $this->remarks_box->setupEditAttributes();
            $this->remarks_box->EditCustomAttributes = "";
            if (!$this->remarks_box->Raw) {
                $this->remarks_box->CurrentValue = HtmlDecode($this->remarks_box->CurrentValue);
            }
            $this->remarks_box->EditValue = HtmlEncode($this->remarks_box->CurrentValue);
            $this->remarks_box->PlaceHolder = RemoveHtml($this->remarks_box->caption());

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

            // Week
            $this->Week->LinkCustomAttributes = "";
            $this->Week->HrefValue = "";

            // box_id
            $this->box_id->LinkCustomAttributes = "";
            $this->box_id->HrefValue = "";

            // date_delivery
            $this->date_delivery->LinkCustomAttributes = "";
            $this->date_delivery->HrefValue = "";

            // box_type
            $this->box_type->LinkCustomAttributes = "";
            $this->box_type->HrefValue = "";

            // check_by
            $this->check_by->LinkCustomAttributes = "";
            $this->check_by->HrefValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";

            // store_code
            $this->store_code->LinkCustomAttributes = "";
            $this->store_code->HrefValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";

            // remark
            $this->remark->LinkCustomAttributes = "";
            $this->remark->HrefValue = "";

            // no_delivery
            $this->no_delivery->LinkCustomAttributes = "";
            $this->no_delivery->HrefValue = "";

            // truck_type
            $this->truck_type->LinkCustomAttributes = "";
            $this->truck_type->HrefValue = "";

            // seal_no
            $this->seal_no->LinkCustomAttributes = "";
            $this->seal_no->HrefValue = "";

            // truck_plate
            $this->truck_plate->LinkCustomAttributes = "";
            $this->truck_plate->HrefValue = "";

            // transporter
            $this->transporter->LinkCustomAttributes = "";
            $this->transporter->HrefValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";

            // admin
            $this->admin->LinkCustomAttributes = "";
            $this->admin->HrefValue = "";

            // remarks_box
            $this->remarks_box->LinkCustomAttributes = "";
            $this->remarks_box->HrefValue = "";

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
        if ($this->Week->Required) {
            if (!$this->Week->IsDetailKey && EmptyValue($this->Week->FormValue)) {
                $this->Week->addErrorMessage(str_replace("%s", $this->Week->caption(), $this->Week->RequiredErrorMessage));
            }
        }
        if ($this->box_id->Required) {
            if (!$this->box_id->IsDetailKey && EmptyValue($this->box_id->FormValue)) {
                $this->box_id->addErrorMessage(str_replace("%s", $this->box_id->caption(), $this->box_id->RequiredErrorMessage));
            }
        }
        if ($this->date_delivery->Required) {
            if (!$this->date_delivery->IsDetailKey && EmptyValue($this->date_delivery->FormValue)) {
                $this->date_delivery->addErrorMessage(str_replace("%s", $this->date_delivery->caption(), $this->date_delivery->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_delivery->FormValue, $this->date_delivery->formatPattern())) {
            $this->date_delivery->addErrorMessage($this->date_delivery->getErrorMessage(false));
        }
        if ($this->box_type->Required) {
            if (!$this->box_type->IsDetailKey && EmptyValue($this->box_type->FormValue)) {
                $this->box_type->addErrorMessage(str_replace("%s", $this->box_type->caption(), $this->box_type->RequiredErrorMessage));
            }
        }
        if ($this->check_by->Required) {
            if (!$this->check_by->IsDetailKey && EmptyValue($this->check_by->FormValue)) {
                $this->check_by->addErrorMessage(str_replace("%s", $this->check_by->caption(), $this->check_by->RequiredErrorMessage));
            }
        }
        if ($this->quantity->Required) {
            if (!$this->quantity->IsDetailKey && EmptyValue($this->quantity->FormValue)) {
                $this->quantity->addErrorMessage(str_replace("%s", $this->quantity->caption(), $this->quantity->RequiredErrorMessage));
            }
        }
        if ($this->concept->Required) {
            if (!$this->concept->IsDetailKey && EmptyValue($this->concept->FormValue)) {
                $this->concept->addErrorMessage(str_replace("%s", $this->concept->caption(), $this->concept->RequiredErrorMessage));
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
        if ($this->remark->Required) {
            if (!$this->remark->IsDetailKey && EmptyValue($this->remark->FormValue)) {
                $this->remark->addErrorMessage(str_replace("%s", $this->remark->caption(), $this->remark->RequiredErrorMessage));
            }
        }
        if ($this->no_delivery->Required) {
            if (!$this->no_delivery->IsDetailKey && EmptyValue($this->no_delivery->FormValue)) {
                $this->no_delivery->addErrorMessage(str_replace("%s", $this->no_delivery->caption(), $this->no_delivery->RequiredErrorMessage));
            }
        }
        if ($this->truck_type->Required) {
            if (!$this->truck_type->IsDetailKey && EmptyValue($this->truck_type->FormValue)) {
                $this->truck_type->addErrorMessage(str_replace("%s", $this->truck_type->caption(), $this->truck_type->RequiredErrorMessage));
            }
        }
        if ($this->seal_no->Required) {
            if (!$this->seal_no->IsDetailKey && EmptyValue($this->seal_no->FormValue)) {
                $this->seal_no->addErrorMessage(str_replace("%s", $this->seal_no->caption(), $this->seal_no->RequiredErrorMessage));
            }
        }
        if ($this->truck_plate->Required) {
            if (!$this->truck_plate->IsDetailKey && EmptyValue($this->truck_plate->FormValue)) {
                $this->truck_plate->addErrorMessage(str_replace("%s", $this->truck_plate->caption(), $this->truck_plate->RequiredErrorMessage));
            }
        }
        if ($this->transporter->Required) {
            if (!$this->transporter->IsDetailKey && EmptyValue($this->transporter->FormValue)) {
                $this->transporter->addErrorMessage(str_replace("%s", $this->transporter->caption(), $this->transporter->RequiredErrorMessage));
            }
        }
        if ($this->no_hp->Required) {
            if (!$this->no_hp->IsDetailKey && EmptyValue($this->no_hp->FormValue)) {
                $this->no_hp->addErrorMessage(str_replace("%s", $this->no_hp->caption(), $this->no_hp->RequiredErrorMessage));
            }
        }
        if ($this->checker->Required) {
            if (!$this->checker->IsDetailKey && EmptyValue($this->checker->FormValue)) {
                $this->checker->addErrorMessage(str_replace("%s", $this->checker->caption(), $this->checker->RequiredErrorMessage));
            }
        }
        if ($this->admin->Required) {
            if (!$this->admin->IsDetailKey && EmptyValue($this->admin->FormValue)) {
                $this->admin->addErrorMessage(str_replace("%s", $this->admin->caption(), $this->admin->RequiredErrorMessage));
            }
        }
        if ($this->remarks_box->Required) {
            if (!$this->remarks_box->IsDetailKey && EmptyValue($this->remarks_box->FormValue)) {
                $this->remarks_box->addErrorMessage(str_replace("%s", $this->remarks_box->caption(), $this->remarks_box->RequiredErrorMessage));
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

        // Week
        $this->Week->setDbValueDef($rsnew, $this->Week->CurrentValue, null, $this->Week->ReadOnly);

        // box_id
        $this->box_id->setDbValueDef($rsnew, $this->box_id->CurrentValue, null, $this->box_id->ReadOnly);

        // date_delivery
        $this->date_delivery->setDbValueDef($rsnew, UnFormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern()), null, $this->date_delivery->ReadOnly);

        // box_type
        $this->box_type->setDbValueDef($rsnew, $this->box_type->CurrentValue, null, $this->box_type->ReadOnly);

        // check_by
        $this->check_by->setDbValueDef($rsnew, $this->check_by->CurrentValue, null, $this->check_by->ReadOnly);

        // quantity
        $this->quantity->setDbValueDef($rsnew, $this->quantity->CurrentValue, null, $this->quantity->ReadOnly);

        // concept
        $this->concept->setDbValueDef($rsnew, $this->concept->CurrentValue, null, $this->concept->ReadOnly);

        // store_code
        $this->store_code->setDbValueDef($rsnew, $this->store_code->CurrentValue, null, $this->store_code->ReadOnly);

        // store_name
        $this->store_name->setDbValueDef($rsnew, $this->store_name->CurrentValue, null, $this->store_name->ReadOnly);

        // remark
        $this->remark->setDbValueDef($rsnew, $this->remark->CurrentValue, null, $this->remark->ReadOnly);

        // no_delivery
        $this->no_delivery->setDbValueDef($rsnew, $this->no_delivery->CurrentValue, null, $this->no_delivery->ReadOnly);

        // truck_type
        $this->truck_type->setDbValueDef($rsnew, $this->truck_type->CurrentValue, null, $this->truck_type->ReadOnly);

        // seal_no
        $this->seal_no->setDbValueDef($rsnew, $this->seal_no->CurrentValue, null, $this->seal_no->ReadOnly);

        // truck_plate
        $this->truck_plate->setDbValueDef($rsnew, $this->truck_plate->CurrentValue, null, $this->truck_plate->ReadOnly);

        // transporter
        $this->transporter->setDbValueDef($rsnew, $this->transporter->CurrentValue, null, $this->transporter->ReadOnly);

        // no_hp
        $this->no_hp->setDbValueDef($rsnew, $this->no_hp->CurrentValue, null, $this->no_hp->ReadOnly);

        // checker
        $this->checker->setDbValueDef($rsnew, $this->checker->CurrentValue, null, $this->checker->ReadOnly);

        // admin
        $this->admin->setDbValueDef($rsnew, $this->admin->CurrentValue, null, $this->admin->ReadOnly);

        // remarks_box
        $this->remarks_box->setDbValueDef($rsnew, $this->remarks_box->CurrentValue, null, $this->remarks_box->ReadOnly);

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
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("reportoutboundlist"), "", $this->TableVar, true);
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

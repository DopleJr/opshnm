<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class CheckingVasList extends CheckingVas
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'checking_vas';

    // Page object name
    public $PageObjName = "CheckingVasList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fchecking_vaslist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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

        // Table object (checking_vas)
        if (!isset($GLOBALS["checking_vas"]) || get_class($GLOBALS["checking_vas"]) == PROJECT_NAMESPACE . "checking_vas") {
            $GLOBALS["checking_vas"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "checkingvasadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "checkingvasdelete";
        $this->MultiUpdateUrl = "checkingvasupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'checking_vas');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Import options
        $this->ImportOptions = new ListOptions(["TagClassName" => "ew-import-option"]);

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions([
            "TagClassName" => "ew-add-edit-option",
            "UseDropDownButton" => false,
            "DropDownButtonPhrase" => $Language->phrase("ButtonAddEdit"),
            "UseButtonGroup" => true
        ]);

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(["TagClassName" => "ew-detail-option"]);
        // Actions
        $this->OtherOptions["action"] = new ListOptions(["TagClassName" => "ew-action-option"]);

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions([
            "TableVar" => $this->TableVar,
            "TagClassName" => "ew-column-option",
            "ButtonGroupClass" => "ew-column-dropdown",
            "UseDropDownButton" => true,
            "DropDownButtonPhrase" => $Language->phrase("Columns"),
            "DropDownAutoClose" => "outside",
            "UseButtonGroup" => false
        ]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);

        // List actions
        $this->ListActions = new ListActions();
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
                $tbl = Container("checking_vas");
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
            SaveDebugMessage();
            Redirect(GetUrl($url));
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
        if ($this->isAddOrEdit()) {
            $this->user->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->date_update->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->time_update->Visible = false;
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,100"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();

        // Setup import options
        $this->setupImportOptions();
        $this->id->setVisibility();
        $this->filter_shipment->Visible = false;
        $this->order->setVisibility();
        $this->po->Visible = false;
        $this->sap_art->setVisibility();
        $this->sub_index->setVisibility();
        $this->concept->setVisibility();
        $this->ctn->Visible = false;
        $this->season2->setVisibility();
        $this->qty_oss->Visible = false;
        $this->shipment->Visible = false;
        $this->aju->Visible = false;
        $this->snow->setVisibility();
        $this->actual_price->setVisibility();
        $this->price_foto->Visible = false;
        $this->remarks->setVisibility();
        $this->date_upload->Visible = false;
        $this->user->setVisibility();
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

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->filter_shipment);
        $this->setupLookupOptions($this->order);
        $this->setupLookupOptions($this->sap_art);
        $this->setupLookupOptions($this->sub_index);
        $this->setupLookupOptions($this->concept);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd", ""));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Check QueryString parameters
            if (Get("action") !== null) {
                $this->CurrentAction = Get("action");
            } else {
                if (Post("action") !== null) {
                    $this->CurrentAction = Post("action"); // Get action

                    // Process import
                    if ($this->isImport()) {
                        $this->import(Post(Config("API_FILE_TOKEN_NAME")));
                        $this->terminate();
                        return;
                    }
                }
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));
            AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Get and validate search values for advanced search
            if (EmptyValue($this->UserAction)) { // Skip if user action
                $this->loadSearchValues();
            }

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }
            if (!$this->validateSearch()) {
                // Nothing to do
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }

            // Get search criteria for advanced search
            if (!$this->hasInvalidFields()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }

            // Load advanced search from default
            if ($this->loadAdvancedSearchDefault()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }

        // Export data only
        if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
            $this->exportData();
            $this->terminate();
            return;
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Set up list action columns
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Allow) {
                if ($listaction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listaction->Select == ACTION_SINGLE) { // Show list action column
                        $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->TableVar, $this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
        $filterList = Concat($filterList, $this->filter_shipment->AdvancedSearch->toJson(), ","); // Field filter_shipment
        $filterList = Concat($filterList, $this->order->AdvancedSearch->toJson(), ","); // Field order
        $filterList = Concat($filterList, $this->po->AdvancedSearch->toJson(), ","); // Field po
        $filterList = Concat($filterList, $this->sap_art->AdvancedSearch->toJson(), ","); // Field sap_art
        $filterList = Concat($filterList, $this->sub_index->AdvancedSearch->toJson(), ","); // Field sub_index
        $filterList = Concat($filterList, $this->concept->AdvancedSearch->toJson(), ","); // Field concept
        $filterList = Concat($filterList, $this->ctn->AdvancedSearch->toJson(), ","); // Field ctn
        $filterList = Concat($filterList, $this->season2->AdvancedSearch->toJson(), ","); // Field season2
        $filterList = Concat($filterList, $this->qty_oss->AdvancedSearch->toJson(), ","); // Field qty_oss
        $filterList = Concat($filterList, $this->shipment->AdvancedSearch->toJson(), ","); // Field shipment
        $filterList = Concat($filterList, $this->aju->AdvancedSearch->toJson(), ","); // Field aju
        $filterList = Concat($filterList, $this->snow->AdvancedSearch->toJson(), ","); // Field snow
        $filterList = Concat($filterList, $this->actual_price->AdvancedSearch->toJson(), ","); // Field actual_price
        $filterList = Concat($filterList, $this->price_foto->AdvancedSearch->toJson(), ","); // Field price_foto
        $filterList = Concat($filterList, $this->remarks->AdvancedSearch->toJson(), ","); // Field remarks
        $filterList = Concat($filterList, $this->date_upload->AdvancedSearch->toJson(), ","); // Field date_upload
        $filterList = Concat($filterList, $this->user->AdvancedSearch->toJson(), ","); // Field user
        $filterList = Concat($filterList, $this->status->AdvancedSearch->toJson(), ","); // Field status
        $filterList = Concat($filterList, $this->date_update->AdvancedSearch->toJson(), ","); // Field date_update
        $filterList = Concat($filterList, $this->time_update->AdvancedSearch->toJson(), ","); // Field time_update
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fchecking_vassrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field id
        $this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
        $this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
        $this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
        $this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
        $this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
        $this->id->AdvancedSearch->save();

        // Field filter_shipment
        $this->filter_shipment->AdvancedSearch->SearchValue = @$filter["x_filter_shipment"];
        $this->filter_shipment->AdvancedSearch->SearchOperator = @$filter["z_filter_shipment"];
        $this->filter_shipment->AdvancedSearch->SearchCondition = @$filter["v_filter_shipment"];
        $this->filter_shipment->AdvancedSearch->SearchValue2 = @$filter["y_filter_shipment"];
        $this->filter_shipment->AdvancedSearch->SearchOperator2 = @$filter["w_filter_shipment"];
        $this->filter_shipment->AdvancedSearch->save();

        // Field order
        $this->order->AdvancedSearch->SearchValue = @$filter["x_order"];
        $this->order->AdvancedSearch->SearchOperator = @$filter["z_order"];
        $this->order->AdvancedSearch->SearchCondition = @$filter["v_order"];
        $this->order->AdvancedSearch->SearchValue2 = @$filter["y_order"];
        $this->order->AdvancedSearch->SearchOperator2 = @$filter["w_order"];
        $this->order->AdvancedSearch->save();

        // Field po
        $this->po->AdvancedSearch->SearchValue = @$filter["x_po"];
        $this->po->AdvancedSearch->SearchOperator = @$filter["z_po"];
        $this->po->AdvancedSearch->SearchCondition = @$filter["v_po"];
        $this->po->AdvancedSearch->SearchValue2 = @$filter["y_po"];
        $this->po->AdvancedSearch->SearchOperator2 = @$filter["w_po"];
        $this->po->AdvancedSearch->save();

        // Field sap_art
        $this->sap_art->AdvancedSearch->SearchValue = @$filter["x_sap_art"];
        $this->sap_art->AdvancedSearch->SearchOperator = @$filter["z_sap_art"];
        $this->sap_art->AdvancedSearch->SearchCondition = @$filter["v_sap_art"];
        $this->sap_art->AdvancedSearch->SearchValue2 = @$filter["y_sap_art"];
        $this->sap_art->AdvancedSearch->SearchOperator2 = @$filter["w_sap_art"];
        $this->sap_art->AdvancedSearch->save();

        // Field sub_index
        $this->sub_index->AdvancedSearch->SearchValue = @$filter["x_sub_index"];
        $this->sub_index->AdvancedSearch->SearchOperator = @$filter["z_sub_index"];
        $this->sub_index->AdvancedSearch->SearchCondition = @$filter["v_sub_index"];
        $this->sub_index->AdvancedSearch->SearchValue2 = @$filter["y_sub_index"];
        $this->sub_index->AdvancedSearch->SearchOperator2 = @$filter["w_sub_index"];
        $this->sub_index->AdvancedSearch->save();

        // Field concept
        $this->concept->AdvancedSearch->SearchValue = @$filter["x_concept"];
        $this->concept->AdvancedSearch->SearchOperator = @$filter["z_concept"];
        $this->concept->AdvancedSearch->SearchCondition = @$filter["v_concept"];
        $this->concept->AdvancedSearch->SearchValue2 = @$filter["y_concept"];
        $this->concept->AdvancedSearch->SearchOperator2 = @$filter["w_concept"];
        $this->concept->AdvancedSearch->save();

        // Field ctn
        $this->ctn->AdvancedSearch->SearchValue = @$filter["x_ctn"];
        $this->ctn->AdvancedSearch->SearchOperator = @$filter["z_ctn"];
        $this->ctn->AdvancedSearch->SearchCondition = @$filter["v_ctn"];
        $this->ctn->AdvancedSearch->SearchValue2 = @$filter["y_ctn"];
        $this->ctn->AdvancedSearch->SearchOperator2 = @$filter["w_ctn"];
        $this->ctn->AdvancedSearch->save();

        // Field season2
        $this->season2->AdvancedSearch->SearchValue = @$filter["x_season2"];
        $this->season2->AdvancedSearch->SearchOperator = @$filter["z_season2"];
        $this->season2->AdvancedSearch->SearchCondition = @$filter["v_season2"];
        $this->season2->AdvancedSearch->SearchValue2 = @$filter["y_season2"];
        $this->season2->AdvancedSearch->SearchOperator2 = @$filter["w_season2"];
        $this->season2->AdvancedSearch->save();

        // Field qty_oss
        $this->qty_oss->AdvancedSearch->SearchValue = @$filter["x_qty_oss"];
        $this->qty_oss->AdvancedSearch->SearchOperator = @$filter["z_qty_oss"];
        $this->qty_oss->AdvancedSearch->SearchCondition = @$filter["v_qty_oss"];
        $this->qty_oss->AdvancedSearch->SearchValue2 = @$filter["y_qty_oss"];
        $this->qty_oss->AdvancedSearch->SearchOperator2 = @$filter["w_qty_oss"];
        $this->qty_oss->AdvancedSearch->save();

        // Field shipment
        $this->shipment->AdvancedSearch->SearchValue = @$filter["x_shipment"];
        $this->shipment->AdvancedSearch->SearchOperator = @$filter["z_shipment"];
        $this->shipment->AdvancedSearch->SearchCondition = @$filter["v_shipment"];
        $this->shipment->AdvancedSearch->SearchValue2 = @$filter["y_shipment"];
        $this->shipment->AdvancedSearch->SearchOperator2 = @$filter["w_shipment"];
        $this->shipment->AdvancedSearch->save();

        // Field aju
        $this->aju->AdvancedSearch->SearchValue = @$filter["x_aju"];
        $this->aju->AdvancedSearch->SearchOperator = @$filter["z_aju"];
        $this->aju->AdvancedSearch->SearchCondition = @$filter["v_aju"];
        $this->aju->AdvancedSearch->SearchValue2 = @$filter["y_aju"];
        $this->aju->AdvancedSearch->SearchOperator2 = @$filter["w_aju"];
        $this->aju->AdvancedSearch->save();

        // Field snow
        $this->snow->AdvancedSearch->SearchValue = @$filter["x_snow"];
        $this->snow->AdvancedSearch->SearchOperator = @$filter["z_snow"];
        $this->snow->AdvancedSearch->SearchCondition = @$filter["v_snow"];
        $this->snow->AdvancedSearch->SearchValue2 = @$filter["y_snow"];
        $this->snow->AdvancedSearch->SearchOperator2 = @$filter["w_snow"];
        $this->snow->AdvancedSearch->save();

        // Field actual_price
        $this->actual_price->AdvancedSearch->SearchValue = @$filter["x_actual_price"];
        $this->actual_price->AdvancedSearch->SearchOperator = @$filter["z_actual_price"];
        $this->actual_price->AdvancedSearch->SearchCondition = @$filter["v_actual_price"];
        $this->actual_price->AdvancedSearch->SearchValue2 = @$filter["y_actual_price"];
        $this->actual_price->AdvancedSearch->SearchOperator2 = @$filter["w_actual_price"];
        $this->actual_price->AdvancedSearch->save();

        // Field price_foto
        $this->price_foto->AdvancedSearch->SearchValue = @$filter["x_price_foto"];
        $this->price_foto->AdvancedSearch->SearchOperator = @$filter["z_price_foto"];
        $this->price_foto->AdvancedSearch->SearchCondition = @$filter["v_price_foto"];
        $this->price_foto->AdvancedSearch->SearchValue2 = @$filter["y_price_foto"];
        $this->price_foto->AdvancedSearch->SearchOperator2 = @$filter["w_price_foto"];
        $this->price_foto->AdvancedSearch->save();

        // Field remarks
        $this->remarks->AdvancedSearch->SearchValue = @$filter["x_remarks"];
        $this->remarks->AdvancedSearch->SearchOperator = @$filter["z_remarks"];
        $this->remarks->AdvancedSearch->SearchCondition = @$filter["v_remarks"];
        $this->remarks->AdvancedSearch->SearchValue2 = @$filter["y_remarks"];
        $this->remarks->AdvancedSearch->SearchOperator2 = @$filter["w_remarks"];
        $this->remarks->AdvancedSearch->save();

        // Field date_upload
        $this->date_upload->AdvancedSearch->SearchValue = @$filter["x_date_upload"];
        $this->date_upload->AdvancedSearch->SearchOperator = @$filter["z_date_upload"];
        $this->date_upload->AdvancedSearch->SearchCondition = @$filter["v_date_upload"];
        $this->date_upload->AdvancedSearch->SearchValue2 = @$filter["y_date_upload"];
        $this->date_upload->AdvancedSearch->SearchOperator2 = @$filter["w_date_upload"];
        $this->date_upload->AdvancedSearch->save();

        // Field user
        $this->user->AdvancedSearch->SearchValue = @$filter["x_user"];
        $this->user->AdvancedSearch->SearchOperator = @$filter["z_user"];
        $this->user->AdvancedSearch->SearchCondition = @$filter["v_user"];
        $this->user->AdvancedSearch->SearchValue2 = @$filter["y_user"];
        $this->user->AdvancedSearch->SearchOperator2 = @$filter["w_user"];
        $this->user->AdvancedSearch->save();

        // Field status
        $this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
        $this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
        $this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
        $this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
        $this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
        $this->status->AdvancedSearch->save();

        // Field date_update
        $this->date_update->AdvancedSearch->SearchValue = @$filter["x_date_update"];
        $this->date_update->AdvancedSearch->SearchOperator = @$filter["z_date_update"];
        $this->date_update->AdvancedSearch->SearchCondition = @$filter["v_date_update"];
        $this->date_update->AdvancedSearch->SearchValue2 = @$filter["y_date_update"];
        $this->date_update->AdvancedSearch->SearchOperator2 = @$filter["w_date_update"];
        $this->date_update->AdvancedSearch->save();

        // Field time_update
        $this->time_update->AdvancedSearch->SearchValue = @$filter["x_time_update"];
        $this->time_update->AdvancedSearch->SearchOperator = @$filter["z_time_update"];
        $this->time_update->AdvancedSearch->SearchCondition = @$filter["v_time_update"];
        $this->time_update->AdvancedSearch->SearchValue2 = @$filter["y_time_update"];
        $this->time_update->AdvancedSearch->SearchOperator2 = @$filter["w_time_update"];
        $this->time_update->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Advanced search WHERE clause based on QueryString
    protected function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $this->buildSearchSql($where, $this->id, $default, true); // id
        $this->buildSearchSql($where, $this->filter_shipment, $default, true); // filter_shipment
        $this->buildSearchSql($where, $this->order, $default, true); // order
        $this->buildSearchSql($where, $this->po, $default, false); // po
        $this->buildSearchSql($where, $this->sap_art, $default, true); // sap_art
        $this->buildSearchSql($where, $this->sub_index, $default, true); // sub_index
        $this->buildSearchSql($where, $this->concept, $default, true); // concept
        $this->buildSearchSql($where, $this->ctn, $default, false); // ctn
        $this->buildSearchSql($where, $this->season2, $default, true); // season2
        $this->buildSearchSql($where, $this->qty_oss, $default, false); // qty_oss
        $this->buildSearchSql($where, $this->shipment, $default, true); // shipment
        $this->buildSearchSql($where, $this->aju, $default, true); // aju
        $this->buildSearchSql($where, $this->snow, $default, true); // snow
        $this->buildSearchSql($where, $this->actual_price, $default, true); // actual_price
        $this->buildSearchSql($where, $this->price_foto, $default, false); // price_foto
        $this->buildSearchSql($where, $this->remarks, $default, true); // remarks
        $this->buildSearchSql($where, $this->date_upload, $default, false); // date_upload
        $this->buildSearchSql($where, $this->user, $default, true); // user
        $this->buildSearchSql($where, $this->status, $default, true); // status
        $this->buildSearchSql($where, $this->date_update, $default, true); // date_update
        $this->buildSearchSql($where, $this->time_update, $default, true); // time_update

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->id->AdvancedSearch->save(); // id
            $this->filter_shipment->AdvancedSearch->save(); // filter_shipment
            $this->order->AdvancedSearch->save(); // order
            $this->po->AdvancedSearch->save(); // po
            $this->sap_art->AdvancedSearch->save(); // sap_art
            $this->sub_index->AdvancedSearch->save(); // sub_index
            $this->concept->AdvancedSearch->save(); // concept
            $this->ctn->AdvancedSearch->save(); // ctn
            $this->season2->AdvancedSearch->save(); // season2
            $this->qty_oss->AdvancedSearch->save(); // qty_oss
            $this->shipment->AdvancedSearch->save(); // shipment
            $this->aju->AdvancedSearch->save(); // aju
            $this->snow->AdvancedSearch->save(); // snow
            $this->actual_price->AdvancedSearch->save(); // actual_price
            $this->price_foto->AdvancedSearch->save(); // price_foto
            $this->remarks->AdvancedSearch->save(); // remarks
            $this->date_upload->AdvancedSearch->save(); // date_upload
            $this->user->AdvancedSearch->save(); // user
            $this->status->AdvancedSearch->save(); // status
            $this->date_update->AdvancedSearch->save(); // date_update
            $this->time_update->AdvancedSearch->save(); // time_update
        }
        return $where;
    }

    // Build search SQL
    protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
    {
        $fldParm = $fld->Param;
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldCond = $default ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
        $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        $fldOpr2 = $default ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
        $wrk = "";
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr ?? ""));
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $fldOpr2 = strtoupper(trim($fldOpr2 ?? ""));
        if ($fldOpr2 == "") {
            $fldOpr2 = "=";
        }
        if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 && !$fld->UseFilter || !IsMultiSearchOperator($fldOpr)) {
            $multiValue = false;
        }
        if ($multiValue) {
            $wrk = $fldVal != "" ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
            $wrk2 = $fldVal2 != "" ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
            AddFilter($wrk, $wrk2, $fldCond);
        } else {
            $fldVal = $this->convertSearchValue($fld, $fldVal);
            $fldVal2 = $this->convertSearchValue($fld, $fldVal2);
            $wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
        }
        if ($this->SearchOption == "AUTO" && in_array($this->BasicSearch->getType(), ["AND", "OR"])) {
            $cond = $this->BasicSearch->getType();
        } else {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
        }
        AddFilter($where, $wrk, $cond);
    }

    // Convert search value
    protected function convertSearchValue(&$fld, $fldVal)
    {
        if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE")) {
            return $fldVal;
        }
        $value = $fldVal;
        if ($fld->isBoolean()) {
            if ($fldVal != "") {
                $value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
            }
        } elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
            if ($fldVal != "") {
                $value = UnFormatDateTime($fldVal, $fld->formatPattern());
            }
        }
        return $value;
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->order;
        $searchFlds[] = &$this->sap_art;
        $searchFlds[] = &$this->sub_index;
        $searchFlds[] = &$this->concept;
        $searchFlds[] = &$this->season2;
        $searchFlds[] = &$this->shipment;
        $searchFlds[] = &$this->aju;
        $searchFlds[] = &$this->snow;
        $searchFlds[] = &$this->actual_price;
        $searchFlds[] = &$this->remarks;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        if ($this->id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->filter_shipment->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->order->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->po->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sap_art->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sub_index->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->concept->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ctn->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->season2->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->qty_oss->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->shipment->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->aju->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->snow->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->actual_price->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->price_foto->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->remarks->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->date_upload->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->user->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->status->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->date_update->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->time_update->AdvancedSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
        $this->id->AdvancedSearch->unsetSession();
        $this->filter_shipment->AdvancedSearch->unsetSession();
        $this->order->AdvancedSearch->unsetSession();
        $this->po->AdvancedSearch->unsetSession();
        $this->sap_art->AdvancedSearch->unsetSession();
        $this->sub_index->AdvancedSearch->unsetSession();
        $this->concept->AdvancedSearch->unsetSession();
        $this->ctn->AdvancedSearch->unsetSession();
        $this->season2->AdvancedSearch->unsetSession();
        $this->qty_oss->AdvancedSearch->unsetSession();
        $this->shipment->AdvancedSearch->unsetSession();
        $this->aju->AdvancedSearch->unsetSession();
        $this->snow->AdvancedSearch->unsetSession();
        $this->actual_price->AdvancedSearch->unsetSession();
        $this->price_foto->AdvancedSearch->unsetSession();
        $this->remarks->AdvancedSearch->unsetSession();
        $this->date_upload->AdvancedSearch->unsetSession();
        $this->user->AdvancedSearch->unsetSession();
        $this->status->AdvancedSearch->unsetSession();
        $this->date_update->AdvancedSearch->unsetSession();
        $this->time_update->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
        $this->id->AdvancedSearch->load();
        $this->filter_shipment->AdvancedSearch->load();
        $this->order->AdvancedSearch->load();
        $this->po->AdvancedSearch->load();
        $this->sap_art->AdvancedSearch->load();
        $this->sub_index->AdvancedSearch->load();
        $this->concept->AdvancedSearch->load();
        $this->ctn->AdvancedSearch->load();
        $this->season2->AdvancedSearch->load();
        $this->qty_oss->AdvancedSearch->load();
        $this->shipment->AdvancedSearch->load();
        $this->aju->AdvancedSearch->load();
        $this->snow->AdvancedSearch->load();
        $this->actual_price->AdvancedSearch->load();
        $this->price_foto->AdvancedSearch->load();
        $this->remarks->AdvancedSearch->load();
        $this->date_upload->AdvancedSearch->load();
        $this->user->AdvancedSearch->load();
        $this->status->AdvancedSearch->load();
        $this->date_update->AdvancedSearch->load();
        $this->time_update->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Load default Sorting Order
        if ($this->Command != "json") {
            $defaultSort = ""; // Set up default sort
            if ($this->getSessionOrderBy() == "" && $defaultSort != "") {
                $this->setSessionOrderBy($defaultSort);
            }
        }

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->id); // id
            $this->updateSort($this->order); // order
            $this->updateSort($this->sap_art); // sap_art
            $this->updateSort($this->sub_index); // sub_index
            $this->updateSort($this->concept); // concept
            $this->updateSort($this->season2); // season2
            $this->updateSort($this->snow); // snow
            $this->updateSort($this->actual_price); // actual_price
            $this->updateSort($this->remarks); // remarks
            $this->updateSort($this->user); // user
            $this->updateSort($this->status); // status
            $this->updateSort($this->date_update); // date_update
            $this->updateSort($this->time_update); // time_update
            $this->setStartRecordNumber(1); // Reset start position
        }

        // Update field sort
        $this->updateFieldSort();
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->id->setSort("");
                $this->filter_shipment->setSort("");
                $this->order->setSort("");
                $this->po->setSort("");
                $this->sap_art->setSort("");
                $this->sub_index->setSort("");
                $this->concept->setSort("");
                $this->ctn->setSort("");
                $this->season2->setSort("");
                $this->qty_oss->setSort("");
                $this->shipment->setSort("");
                $this->aju->setSort("");
                $this->snow->setSort("");
                $this->actual_price->setSort("");
                $this->price_foto->setSort("");
                $this->remarks->setSort("");
                $this->date_upload->setSort("");
                $this->user->setSort("");
                $this->status->setSort("");
                $this->date_update->setSort("");
                $this->time_update->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = true;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
            // Set up list options (to be implemented by extensions)
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm, $UserProfile;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl(false);
        if ($this->CurrentMode == "view") { // Check view mode
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                $action = $listaction->Action;
                $allowed = $listaction->Allow;
                if ($listaction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fchecking_vaslist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fchecking_vaslist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"form-check\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"form-check-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" data-ew-action=\"select-key\"></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("id", $this->createColumnOption("id"));
            $option->add("order", $this->createColumnOption("order"));
            $option->add("sap_art", $this->createColumnOption("sap_art"));
            $option->add("sub_index", $this->createColumnOption("sub_index"));
            $option->add("concept", $this->createColumnOption("concept"));
            $option->add("season2", $this->createColumnOption("season2"));
            $option->add("snow", $this->createColumnOption("snow"));
            $option->add("actual_price", $this->createColumnOption("actual_price"));
            $option->add("remarks", $this->createColumnOption("remarks"));
            $option->add("user", $this->createColumnOption("user"));
            $option->add("status", $this->createColumnOption("status"));
            $option->add("date_update", $this->createColumnOption("date_update"));
            $option->add("time_update", $this->createColumnOption("time_update"));
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = false;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fchecking_vassrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fchecking_vassrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Create new column option
    public function createColumnOption($name)
    {
        $field = $this->Fields[$name] ?? false;
        if ($field && $field->Visible) {
            $item = new ListOption($field->Name);
            $item->Body = '<button class="dropdown-item">' .
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
            return $item;
        }
        return null;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fchecking_vaslist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            $this->UserAction = $userAction;
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($rs) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                    if ($this->getSuccessMessage() == "" && !ob_get_length() && !$Response->getBody()->getSize()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // id
        if ($this->id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id->AdvancedSearch->SearchValue != "" || $this->id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // filter_shipment
        if ($this->filter_shipment->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->filter_shipment->AdvancedSearch->SearchValue != "" || $this->filter_shipment->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        if (is_array($this->filter_shipment->AdvancedSearch->SearchValue)) {
            $this->filter_shipment->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->filter_shipment->AdvancedSearch->SearchValue);
        }
        if (is_array($this->filter_shipment->AdvancedSearch->SearchValue2)) {
            $this->filter_shipment->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->filter_shipment->AdvancedSearch->SearchValue2);
        }

        // order
        if ($this->order->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->order->AdvancedSearch->SearchValue != "" || $this->order->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        if (is_array($this->order->AdvancedSearch->SearchValue)) {
            $this->order->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->order->AdvancedSearch->SearchValue);
        }
        if (is_array($this->order->AdvancedSearch->SearchValue2)) {
            $this->order->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->order->AdvancedSearch->SearchValue2);
        }

        // po
        if ($this->po->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->po->AdvancedSearch->SearchValue != "" || $this->po->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sap_art
        if ($this->sap_art->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sap_art->AdvancedSearch->SearchValue != "" || $this->sap_art->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sub_index
        if ($this->sub_index->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sub_index->AdvancedSearch->SearchValue != "" || $this->sub_index->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // concept
        if ($this->concept->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->concept->AdvancedSearch->SearchValue != "" || $this->concept->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ctn
        if ($this->ctn->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ctn->AdvancedSearch->SearchValue != "" || $this->ctn->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // season2
        if ($this->season2->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->season2->AdvancedSearch->SearchValue != "" || $this->season2->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // qty_oss
        if ($this->qty_oss->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->qty_oss->AdvancedSearch->SearchValue != "" || $this->qty_oss->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // shipment
        if ($this->shipment->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->shipment->AdvancedSearch->SearchValue != "" || $this->shipment->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // aju
        if ($this->aju->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->aju->AdvancedSearch->SearchValue != "" || $this->aju->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // snow
        if ($this->snow->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->snow->AdvancedSearch->SearchValue != "" || $this->snow->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // actual_price
        if ($this->actual_price->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->actual_price->AdvancedSearch->SearchValue != "" || $this->actual_price->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // price_foto
        if ($this->price_foto->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->price_foto->AdvancedSearch->SearchValue != "" || $this->price_foto->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // remarks
        if ($this->remarks->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->remarks->AdvancedSearch->SearchValue != "" || $this->remarks->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // date_upload
        if ($this->date_upload->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->date_upload->AdvancedSearch->SearchValue != "" || $this->date_upload->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // user
        if ($this->user->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->user->AdvancedSearch->SearchValue != "" || $this->user->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // status
        if ($this->status->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->status->AdvancedSearch->SearchValue != "" || $this->status->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // date_update
        if ($this->date_update->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->date_update->AdvancedSearch->SearchValue != "" || $this->date_update->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // time_update
        if ($this->time_update->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->time_update->AdvancedSearch->SearchValue != "" || $this->time_update->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        return $hasValue;
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        $rs = new Recordset($result, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    // Load records as associative array
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        return $result->fetchAll(FetchMode::ASSOCIATIVE);
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
        $this->filter_shipment->setDbValue($row['filter_shipment']);
        $this->order->setDbValue($row['order']);
        $this->po->setDbValue($row['po']);
        $this->sap_art->setDbValue($row['sap_art']);
        $this->sub_index->setDbValue($row['sub_index']);
        $this->concept->setDbValue($row['concept']);
        $this->ctn->setDbValue($row['ctn']);
        $this->season2->setDbValue($row['season2']);
        $this->qty_oss->setDbValue($row['qty_oss']);
        $this->shipment->setDbValue($row['shipment']);
        $this->aju->setDbValue($row['aju']);
        $this->snow->setDbValue($row['snow']);
        $this->actual_price->setDbValue($row['actual_price']);
        $this->price_foto->Upload->DbValue = $row['price_foto'];
        $this->price_foto->setDbValue($this->price_foto->Upload->DbValue);
        $this->remarks->setDbValue($row['remarks']);
        $this->date_upload->setDbValue($row['date_upload']);
        $this->user->setDbValue($row['user']);
        $this->status->setDbValue($row['status']);
        $this->date_update->setDbValue($row['date_update']);
        $this->time_update->setDbValue($row['time_update']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['filter_shipment'] = $this->filter_shipment->DefaultValue;
        $row['order'] = $this->order->DefaultValue;
        $row['po'] = $this->po->DefaultValue;
        $row['sap_art'] = $this->sap_art->DefaultValue;
        $row['sub_index'] = $this->sub_index->DefaultValue;
        $row['concept'] = $this->concept->DefaultValue;
        $row['ctn'] = $this->ctn->DefaultValue;
        $row['season2'] = $this->season2->DefaultValue;
        $row['qty_oss'] = $this->qty_oss->DefaultValue;
        $row['shipment'] = $this->shipment->DefaultValue;
        $row['aju'] = $this->aju->DefaultValue;
        $row['snow'] = $this->snow->DefaultValue;
        $row['actual_price'] = $this->actual_price->DefaultValue;
        $row['price_foto'] = $this->price_foto->DefaultValue;
        $row['remarks'] = $this->remarks->DefaultValue;
        $row['date_upload'] = $this->date_upload->DefaultValue;
        $row['user'] = $this->user->DefaultValue;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // filter_shipment
        $this->filter_shipment->CellCssStyle = "white-space: nowrap;";

        // order
        $this->order->CellCssStyle = "white-space: nowrap;";

        // po
        $this->po->CellCssStyle = "white-space: nowrap;";

        // sap_art
        $this->sap_art->CellCssStyle = "white-space: nowrap;";

        // sub_index
        $this->sub_index->CellCssStyle = "white-space: nowrap;";

        // concept
        $this->concept->CellCssStyle = "white-space: nowrap;";

        // ctn
        $this->ctn->CellCssStyle = "white-space: nowrap;";

        // season2
        $this->season2->CellCssStyle = "white-space: nowrap;";

        // qty_oss
        $this->qty_oss->CellCssStyle = "white-space: nowrap;";

        // shipment
        $this->shipment->CellCssStyle = "white-space: nowrap;";

        // aju
        $this->aju->CellCssStyle = "white-space: nowrap;";

        // snow
        $this->snow->CellCssStyle = "white-space: nowrap;";

        // actual_price
        $this->actual_price->CellCssStyle = "white-space: nowrap;";

        // price_foto
        $this->price_foto->CellCssStyle = "white-space: nowrap;";

        // remarks
        $this->remarks->CellCssStyle = "white-space: nowrap;";

        // date_upload
        $this->date_upload->CellCssStyle = "white-space: nowrap;";

        // user
        $this->user->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // date_update
        $this->date_update->CellCssStyle = "white-space: nowrap;";

        // time_update
        $this->time_update->CellCssStyle = "white-space: nowrap;";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

            // order
            $curVal = strval($this->order->CurrentValue);
            if ($curVal != "") {
                $this->order->ViewValue = $this->order->lookupCacheOption($curVal);
                if ($this->order->ViewValue === null) { // Lookup from database
                    $arwrk = explode(",", $curVal);
                    $filterWrk = "";
                    foreach ($arwrk as $wrk) {
                        if ($filterWrk != "") {
                            $filterWrk .= " OR ";
                        }
                        $filterWrk .= "`order`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
                    }
                    $lookupFilter = function() {
                        return "`status` = 'Pending'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->order->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $this->order->ViewValue = new OptionValues();
                        foreach ($rswrk as $row) {
                            $arwrk = $this->order->Lookup->renderViewRow($row);
                            $this->order->ViewValue->add($this->order->displayValue($arwrk));
                        }
                    } else {
                        $this->order->ViewValue = $this->order->CurrentValue;
                    }
                }
            } else {
                $this->order->ViewValue = null;
            }
            $this->order->ViewCustomAttributes = "";

            // sap_art
            $this->sap_art->ViewValue = $this->sap_art->CurrentValue;
            $curVal = strval($this->sap_art->CurrentValue);
            if ($curVal != "") {
                $this->sap_art->ViewValue = $this->sap_art->lookupCacheOption($curVal);
                if ($this->sap_art->ViewValue === null) { // Lookup from database
                    $filterWrk = "`sap_art`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->sap_art->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->sap_art->Lookup->renderViewRow($rswrk[0]);
                        $this->sap_art->ViewValue = $this->sap_art->displayValue($arwrk);
                    } else {
                        $this->sap_art->ViewValue = $this->sap_art->CurrentValue;
                    }
                }
            } else {
                $this->sap_art->ViewValue = null;
            }
            $this->sap_art->ViewCustomAttributes = "";

            // sub_index
            $this->sub_index->ViewValue = $this->sub_index->CurrentValue;
            $curVal = strval($this->sub_index->CurrentValue);
            if ($curVal != "") {
                $this->sub_index->ViewValue = $this->sub_index->lookupCacheOption($curVal);
                if ($this->sub_index->ViewValue === null) { // Lookup from database
                    $filterWrk = "`sub_index`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->sub_index->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->sub_index->Lookup->renderViewRow($rswrk[0]);
                        $this->sub_index->ViewValue = $this->sub_index->displayValue($arwrk);
                    } else {
                        $this->sub_index->ViewValue = $this->sub_index->CurrentValue;
                    }
                }
            } else {
                $this->sub_index->ViewValue = null;
            }
            $this->sub_index->ViewCustomAttributes = "";

            // concept
            $this->concept->ViewValue = $this->concept->CurrentValue;
            $curVal = strval($this->concept->CurrentValue);
            if ($curVal != "") {
                $this->concept->ViewValue = $this->concept->lookupCacheOption($curVal);
                if ($this->concept->ViewValue === null) { // Lookup from database
                    $filterWrk = "`concept`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->concept->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->concept->Lookup->renderViewRow($rswrk[0]);
                        $this->concept->ViewValue = $this->concept->displayValue($arwrk);
                    } else {
                        $this->concept->ViewValue = $this->concept->CurrentValue;
                    }
                }
            } else {
                $this->concept->ViewValue = null;
            }
            $this->concept->ViewCustomAttributes = "";

            // season2
            $this->season2->ViewValue = $this->season2->CurrentValue;
            $this->season2->ViewCustomAttributes = "";

            // snow
            $this->snow->ViewValue = $this->snow->CurrentValue;
            $this->snow->ViewCustomAttributes = "";

            // actual_price
            $this->actual_price->ViewValue = $this->actual_price->CurrentValue;
            $this->actual_price->ViewCustomAttributes = "";

            // remarks
            $this->remarks->ViewValue = $this->remarks->CurrentValue;
            $this->remarks->ViewCustomAttributes = "";

            // user
            $this->user->ViewValue = $this->user->CurrentValue;
            $this->user->ViewCustomAttributes = "";

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
            $this->id->TooltipValue = "";

            // order
            $this->order->LinkCustomAttributes = "";
            $this->order->HrefValue = "";
            $this->order->TooltipValue = "";

            // sap_art
            $this->sap_art->LinkCustomAttributes = "";
            $this->sap_art->HrefValue = "";
            $this->sap_art->TooltipValue = "";

            // sub_index
            $this->sub_index->LinkCustomAttributes = "";
            $this->sub_index->HrefValue = "";
            $this->sub_index->TooltipValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";
            $this->concept->TooltipValue = "";

            // season2
            $this->season2->LinkCustomAttributes = "";
            $this->season2->HrefValue = "";
            $this->season2->TooltipValue = "";

            // snow
            $this->snow->LinkCustomAttributes = "";
            $this->snow->HrefValue = "";
            $this->snow->TooltipValue = "";

            // actual_price
            $this->actual_price->LinkCustomAttributes = "";
            $this->actual_price->HrefValue = "";
            $this->actual_price->TooltipValue = "";

            // remarks
            $this->remarks->LinkCustomAttributes = "";
            $this->remarks->HrefValue = "";
            $this->remarks->TooltipValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";
            $this->user->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // date_update
            $this->date_update->LinkCustomAttributes = "";
            $this->date_update->HrefValue = "";
            $this->date_update->TooltipValue = "";

            // time_update
            $this->time_update->LinkCustomAttributes = "";
            $this->time_update->HrefValue = "";
            $this->time_update->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // id
            if ($this->id->UseFilter && !EmptyValue($this->id->AdvancedSearch->SearchValue)) {
                if (is_array($this->id->AdvancedSearch->SearchValue)) {
                    $this->id->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->id->AdvancedSearch->SearchValue);
                }
                $this->id->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->id->AdvancedSearch->SearchValue);
            }

            // order
            if ($this->order->UseFilter && !EmptyValue($this->order->AdvancedSearch->SearchValue)) {
                if (is_array($this->order->AdvancedSearch->SearchValue)) {
                    $this->order->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->order->AdvancedSearch->SearchValue);
                }
                $this->order->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->order->AdvancedSearch->SearchValue);
            }

            // sap_art
            if ($this->sap_art->UseFilter && !EmptyValue($this->sap_art->AdvancedSearch->SearchValue)) {
                if (is_array($this->sap_art->AdvancedSearch->SearchValue)) {
                    $this->sap_art->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->sap_art->AdvancedSearch->SearchValue);
                }
                $this->sap_art->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->sap_art->AdvancedSearch->SearchValue);
            }

            // sub_index
            if ($this->sub_index->UseFilter && !EmptyValue($this->sub_index->AdvancedSearch->SearchValue)) {
                if (is_array($this->sub_index->AdvancedSearch->SearchValue)) {
                    $this->sub_index->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->sub_index->AdvancedSearch->SearchValue);
                }
                $this->sub_index->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->sub_index->AdvancedSearch->SearchValue);
            }

            // concept
            if ($this->concept->UseFilter && !EmptyValue($this->concept->AdvancedSearch->SearchValue)) {
                if (is_array($this->concept->AdvancedSearch->SearchValue)) {
                    $this->concept->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->concept->AdvancedSearch->SearchValue);
                }
                $this->concept->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->concept->AdvancedSearch->SearchValue);
            }

            // season2
            if ($this->season2->UseFilter && !EmptyValue($this->season2->AdvancedSearch->SearchValue)) {
                if (is_array($this->season2->AdvancedSearch->SearchValue)) {
                    $this->season2->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->season2->AdvancedSearch->SearchValue);
                }
                $this->season2->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->season2->AdvancedSearch->SearchValue);
            }

            // snow
            if ($this->snow->UseFilter && !EmptyValue($this->snow->AdvancedSearch->SearchValue)) {
                if (is_array($this->snow->AdvancedSearch->SearchValue)) {
                    $this->snow->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->snow->AdvancedSearch->SearchValue);
                }
                $this->snow->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->snow->AdvancedSearch->SearchValue);
            }

            // actual_price
            if ($this->actual_price->UseFilter && !EmptyValue($this->actual_price->AdvancedSearch->SearchValue)) {
                if (is_array($this->actual_price->AdvancedSearch->SearchValue)) {
                    $this->actual_price->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->actual_price->AdvancedSearch->SearchValue);
                }
                $this->actual_price->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->actual_price->AdvancedSearch->SearchValue);
            }

            // remarks
            if ($this->remarks->UseFilter && !EmptyValue($this->remarks->AdvancedSearch->SearchValue)) {
                if (is_array($this->remarks->AdvancedSearch->SearchValue)) {
                    $this->remarks->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remarks->AdvancedSearch->SearchValue);
                }
                $this->remarks->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remarks->AdvancedSearch->SearchValue);
            }

            // user
            if ($this->user->UseFilter && !EmptyValue($this->user->AdvancedSearch->SearchValue)) {
                if (is_array($this->user->AdvancedSearch->SearchValue)) {
                    $this->user->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->user->AdvancedSearch->SearchValue);
                }
                $this->user->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->user->AdvancedSearch->SearchValue);
            }

            // status
            if ($this->status->UseFilter && !EmptyValue($this->status->AdvancedSearch->SearchValue)) {
                if (is_array($this->status->AdvancedSearch->SearchValue)) {
                    $this->status->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->status->AdvancedSearch->SearchValue);
                }
                $this->status->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->status->AdvancedSearch->SearchValue);
            }

            // date_update
            if ($this->date_update->UseFilter && !EmptyValue($this->date_update->AdvancedSearch->SearchValue)) {
                if (is_array($this->date_update->AdvancedSearch->SearchValue)) {
                    $this->date_update->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_update->AdvancedSearch->SearchValue);
                }
                $this->date_update->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_update->AdvancedSearch->SearchValue);
            }

            // time_update
            if ($this->time_update->UseFilter && !EmptyValue($this->time_update->AdvancedSearch->SearchValue)) {
                if (is_array($this->time_update->AdvancedSearch->SearchValue)) {
                    $this->time_update->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->time_update->AdvancedSearch->SearchValue);
                }
                $this->time_update->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->time_update->AdvancedSearch->SearchValue);
            }
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    /**
     * Import file
     *
     * @param string $filetoken File token to locate the uploaded import file
     * @return bool
     */
    public function import($filetoken)
    {
        global $Security, $Language;
        if (!$Security->canImport()) {
            return false; // Import not allowed
        }

        // Check if valid token
        if (EmptyValue($filetoken)) {
            return false;
        }

        // Get uploaded files by token
        $files = GetUploadedFileNames($filetoken);
        $exts = explode(",", Config("IMPORT_FILE_ALLOWED_EXTENSIONS"));
        $totCnt = 0;
        $totSuccessCnt = 0;
        $totFailCnt = 0;
        $result = [Config("API_FILE_TOKEN_NAME") => $filetoken, "files" => [], "success" => false];

        // Import records
        foreach ($files as $file) {
            $res = [Config("API_FILE_TOKEN_NAME") => $filetoken, "file" => basename($file)];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            // Ignore log file
            if ($ext == "txt") {
                continue;
            }
            if (!in_array($ext, $exts)) {
                $res = array_merge($res, ["error" => str_replace("%e", $ext, $Language->phrase("ImportMessageInvalidFileExtension"))]);
                WriteJson($res);
                return false;
            }

            // Set up options for Page Importing event

            // Get optional data from $_POST first
            $ar = array_keys($_POST);
            $options = [];
            foreach ($ar as $key) {
                if (!in_array($key, ["action", "filetoken"])) {
                    $options[$key] = $_POST[$key];
                }
            }

            // Merge default options
            $options = array_merge(["maxExecutionTime" => $this->ImportMaxExecutionTime, "file" => $file, "activeSheet" => 0, "headerRowNumber" => 0, "headers" => [], "offset" => 0, "limit" => 0], $options);
            if ($ext == "csv") {
                $options = array_merge(["inputEncoding" => $this->ImportCsvEncoding, "delimiter" => $this->ImportCsvDelimiter, "enclosure" => $this->ImportCsvQuoteCharacter], $options);
            }
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($ext));

            // Call Page Importing server event
            if (!$this->pageImporting($reader, $options)) {
                WriteJson($res);
                return false;
            }

            // Set max execution time
            if ($options["maxExecutionTime"] > 0) {
                ini_set("max_execution_time", $options["maxExecutionTime"]);
            }
            try {
                if ($ext == "csv") {
                    if ($options["inputEncoding"] != '') {
                        $reader->setInputEncoding($options["inputEncoding"]);
                    }
                    if ($options["delimiter"] != '') {
                        $reader->setDelimiter($options["delimiter"]);
                    }
                    if ($options["enclosure"] != '') {
                        $reader->setEnclosure($options["enclosure"]);
                    }
                }
                $spreadsheet = @$reader->load($file);
            } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                $res = array_merge($res, ["error" => $e->getMessage()]);
                WriteJson($res);
                return false;
            }

            // Get active worksheet
            $spreadsheet->setActiveSheetIndex($options["activeSheet"]);
            $worksheet = $spreadsheet->getActiveSheet();

            // Get row and column indexes
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

            // Get column headers
            $headers = $options["headers"];
            $headerRow = 0;
            if (count($headers) == 0) { // Undetermined, load from header row
                $headerRow = $options["headerRowNumber"] + 1;
                $headers = $this->getImportHeaders($worksheet, $headerRow, $highestColumn);
            }
            if (count($headers) == 0) { // Unable to load header
                $res["error"] = $Language->phrase("ImportMessageNoHeaderRow");
                WriteJson($res);
                return false;
            }
            $checkValue = true; // Clear blank header values at end
            $headers = array_reverse(array_reduce(array_reverse($headers), function ($res, $name) use ($checkValue) {
                if (!EmptyValue($name) || !$checkValue) {
                    $res[] = $name;
                    $checkValue = false; // Skip further checking
                }
                return $res;
            }, []));
            foreach ($headers as $name) {
                if (!array_key_exists($name, $this->Fields)) { // Unidentified field, not header row
                    $res["error"] = str_replace('%f', $name, $Language->phrase("ImportMessageInvalidFieldName"));
                    WriteJson($res);
                    return false;
                }
            }
            $startRow = $headerRow + 1;
            $endRow = $highestRow;
            if ($options["offset"] > 0) {
                $startRow += $options["offset"];
            }
            if ($options["limit"] > 0) {
                $endRow = $startRow + $options["limit"] - 1;
                if ($endRow > $highestRow) {
                    $endRow = $highestRow;
                }
            }
            if ($endRow >= $startRow) {
                $records = $this->getImportRecords($worksheet, $startRow, $endRow, $highestColumn);
            } else {
                $records = [];
            }
            $recordCnt = count($records);
            $cnt = 0;
            $successCnt = 0;
            $failCnt = 0;
            $failList = [];
            $relLogFile = IncludeTrailingDelimiter(UploadPath(false) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $filetoken, false) . $filetoken . ".txt";
            $res = array_merge($res, ["totalCount" => $recordCnt, "count" => $cnt, "successCount" => $successCnt, "failCount" => 0]);

            // Begin transaction
            if ($this->ImportUseTransaction) {
                $conn = $this->getConnection();
                $conn->beginTransaction();
            }

            // Process records
            foreach ($records as $values) {
                $importSuccess = false;
                try {
                    if (count($values) > count($headers)) { // Make sure headers / values count matched
                        array_splice($values, count($headers));
                    }
                    $row = array_combine($headers, $values);
                    $cnt++;
                    $res["count"] = $cnt;
                    if ($this->importRow($row, $cnt)) {
                        $successCnt++;
                        $importSuccess = true;
                    } else {
                        $failCnt++;
                        $failList["row" . $cnt] = $this->getFailureMessage();
                        $this->clearFailureMessage(); // Clear error message
                    }
                } catch (\Throwable $e) {
                    $failCnt++;
                    if (@$failList["row" . $cnt] == "") {
                        $failList["row" . $cnt] = $e->getMessage();
                    }
                }

                // Reset count if import fail + use transaction
                if (!$importSuccess && $this->ImportUseTransaction) {
                    $successCnt = 0;
                    $failCnt = $cnt;
                }

                // Save progress to cache
                $res["successCount"] = $successCnt;
                $res["failCount"] = $failCnt;
                SetCache($filetoken, $res);

                // No need to process further if import fail + use transaction
                if (!$importSuccess && $this->ImportUseTransaction) {
                    break;
                }
            }
            $res["failList"] = $failList;

            // Commit/Rollback transaction
            if ($this->ImportUseTransaction) {
                $conn = $this->getConnection();
                if ($failCnt > 0) { // Rollback
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }
                } else { // Commit
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                }
            }
            $totCnt += $cnt;
            $totSuccessCnt += $successCnt;
            $totFailCnt += $failCnt;

            // Call Page Imported server event
            $this->pageImported($reader, $res);
            if ($totCnt > 0 && $totFailCnt == 0) { // Clean up if all records imported
                $res["success"] = true;
                $result["success"] = true;
            } else {
                $res["log"] = $relLogFile;
                $result["success"] = false;
            }
            $result["files"][] = $res;
        }
        if ($result["success"]) {
            CleanUploadTempPaths($filetoken);
        }
        WriteJson($result);
        return $result["success"];
    }

    /**
     * Get import header
     *
     * @param object $ws PhpSpreadsheet worksheet
     * @param int $rowIdx Row index for header row (1-based)
     * @param string $endColName End column Name (e.g. "F")
     * @return array
     */
    protected function getImportHeaders($ws, $rowIdx, $endColName)
    {
        $ar = $ws->rangeToArray("A" . $rowIdx . ":" . $endColName . $rowIdx);
        return $ar[0];
    }

    /**
     * Get import records
     *
     * @param object $ws PhpSpreadsheet worksheet
     * @param int $startRowIdx Start row index
     * @param int $endRowIdx End row index
     * @param string $endColName End column Name (e.g. "F")
     * @return array
     */
    protected function getImportRecords($ws, $startRowIdx, $endRowIdx, $endColName)
    {
        $ar = $ws->rangeToArray("A" . $startRowIdx . ":" . $endColName . $endRowIdx);
        return $ar;
    }

    /**
     * Import a row
     *
     * @param array $row
     * @param int $cnt
     * @return bool
     */
    protected function importRow($row, $cnt)
    {
        global $Language;

        // Call Row Import server event
        if (!$this->rowImport($row, $cnt)) {
            return false;
        }

        // Check field values
        foreach ($row as $name => $value) {
            $fld = $this->Fields[$name];
            if (!$this->checkValue($fld, $value)) {
                $this->setFailureMessage(str_replace(["%f", "%v"], [$fld->Name, $value], $Language->phrase("ImportMessageInvalidFieldValue")));
                return false;
            }
        }

        // Insert/Update to database
        $res = false;
        if (!$this->ImportInsertOnly && $oldrow = $this->load($row)) {
            if ($this->rowUpdating($oldrow, $row)) {
                if ($res = $this->update($row, "", $oldrow)) {
                    $this->rowUpdated($oldrow, $row);
                }
            }
        } else {
            if ($this->rowInserting(null, $row)) {
                if ($res = $this->insert($row)) {
                    $this->rowInserted(null, $row);
                }
            }
        }
        return $res;
    }

    /**
     * Check field value
     *
     * @param object $fld Field object
     * @param object $value
     * @return bool
     */
    protected function checkValue($fld, $value)
    {
        if ($fld->DataType == DATATYPE_NUMBER && !is_numeric($value)) {
            return false;
        } elseif ($fld->DataType == DATATYPE_DATE && !CheckDate($value, $fld->formatPattern())) {
            return false;
        }
        return true;
    }

    // Load row
    protected function load($row)
    {
        $filter = $this->getRecordFilter($row);
        if (!$filter) {
            return null;
        }
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        return $conn->fetchAssociative($sql);
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->id->AdvancedSearch->load();
        $this->filter_shipment->AdvancedSearch->load();
        $this->order->AdvancedSearch->load();
        $this->po->AdvancedSearch->load();
        $this->sap_art->AdvancedSearch->load();
        $this->sub_index->AdvancedSearch->load();
        $this->concept->AdvancedSearch->load();
        $this->ctn->AdvancedSearch->load();
        $this->season2->AdvancedSearch->load();
        $this->qty_oss->AdvancedSearch->load();
        $this->shipment->AdvancedSearch->load();
        $this->aju->AdvancedSearch->load();
        $this->snow->AdvancedSearch->load();
        $this->actual_price->AdvancedSearch->load();
        $this->price_foto->AdvancedSearch->load();
        $this->remarks->AdvancedSearch->load();
        $this->date_upload->AdvancedSearch->load();
        $this->user->AdvancedSearch->load();
        $this->status->AdvancedSearch->load();
        $this->date_update->AdvancedSearch->load();
        $this->time_update->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl(false);
        $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" form=\"fchecking_vaslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"excel\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToExcel") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" form=\"fchecking_vaslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"word\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToWord") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" form=\"fchecking_vaslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"pdf\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToPdf") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\">" . $Language->phrase("ExportToPdf") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ' data-url="' . $exportUrl . '"' : '';
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" form="fchecking_vaslist" data-ew-action="email" data-hdr="' . $Language->phrase("ExportToEmailText") . '" data-sel="false"' . $url . '>' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("ExportToPrintText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPrintText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to HTML
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to XML
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to CSV
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to PDF
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl(false);
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fchecking_vassrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    // Set up import options
    protected function setupImportOptions()
    {
        global $Security, $Language;

        // Import
        $item = &$this->ImportOptions->add("import");
        $item->Body = "<a class=\"ew-import-link ew-import\" role=\"button\" title=\"" . $Language->phrase("ImportText") . "\" data-caption=\"" . $Language->phrase("ImportText") . "\" data-ew-action=\"import\" data-hdr=\"" . $Language->phrase("ImportText") . "\">" . $Language->phrase("Import") . "</a>";
        $item->Visible = $Security->canImport();
        $this->ImportOptions->UseButtonGroup = true;
        $this->ImportOptions->UseDropDownButton = false;
        $this->ImportOptions->DropDownButtonPhrase = $Language->phrase("ButtonImport");

        // Add group option item
        $item = &$this->ImportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param bool $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($return = false)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        $this->TotalRecords = $this->listRecordCount();
        $this->StartRecord = 1;

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        $this->ExportDoc = GetExportDocument($this, "h");
        $doc = &$this->ExportDoc;
        if (!$doc) {
            $this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
        }
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $this->ExportDoc->ExportCustom = !$this->pageExporting();
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Close recordset
        $rs->close();

        // Call Page Exported server event
        $this->pageExported();

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Clean output buffer (without destroying output buffer)
        $buffer = ob_get_contents(); // Save the output buffer
        if (!Config("DEBUG") && $buffer) {
            ob_clean();
        }

        // Write debug message if enabled
        if (Config("DEBUG") && !$this->isExport("pdf")) {
            echo GetDebugMessage();
        }

        // Output data
        if ($this->isExport("email")) {
            // Export-to-email disabled
        } else {
            $doc->export();
            if ($return) {
                RemoveHeader("Content-Type"); // Remove header
                RemoveHeader("Content-Disposition");
                $content = ob_get_contents();
                if ($content) {
                    ob_clean();
                }
                if ($buffer) {
                    echo $buffer; // Resume the output buffer
                }
                return $content;
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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
                case "x_filter_shipment":
                    $lookupFilter = function () {
                        return "`status` = 'Pending'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_order":
                    $lookupFilter = function () {
                        return "`status` = 'Pending'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_sap_art":
                    break;
                case "x_sub_index":
                    break;
                case "x_concept":
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
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                $pageNo = ParseInteger($pageNo);
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}

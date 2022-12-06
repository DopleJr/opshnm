<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PickingList extends Picking
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'picking';

    // Page object name
    public $PageObjName = "PickingList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpickinglist";
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

        // Table object (picking)
        if (!isset($GLOBALS["picking"]) || get_class($GLOBALS["picking"]) == PROJECT_NAMESPACE . "picking") {
            $GLOBALS["picking"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "pickingadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "pickingdelete";
        $this->MultiUpdateUrl = "pickingupdate";

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
    public $SearchFieldsPerRow = 2; // For extended search
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
        $this->po_no->Visible = false;
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
        $this->job_id->Visible = false;
        $this->sequence->Visible = false;
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
        $this->setupLookupOptions($this->status);

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
        $filterList = Concat($filterList, $this->creation_date->AdvancedSearch->toJson(), ","); // Field creation_date
        $filterList = Concat($filterList, $this->confirmation_date->AdvancedSearch->toJson(), ","); // Field confirmation_date
        $filterList = Concat($filterList, $this->status->AdvancedSearch->toJson(), ","); // Field status
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fpickingsrch", $filters);
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

        // Field creation_date
        $this->creation_date->AdvancedSearch->SearchValue = @$filter["x_creation_date"];
        $this->creation_date->AdvancedSearch->SearchOperator = @$filter["z_creation_date"];
        $this->creation_date->AdvancedSearch->SearchCondition = @$filter["v_creation_date"];
        $this->creation_date->AdvancedSearch->SearchValue2 = @$filter["y_creation_date"];
        $this->creation_date->AdvancedSearch->SearchOperator2 = @$filter["w_creation_date"];
        $this->creation_date->AdvancedSearch->save();

        // Field confirmation_date
        $this->confirmation_date->AdvancedSearch->SearchValue = @$filter["x_confirmation_date"];
        $this->confirmation_date->AdvancedSearch->SearchOperator = @$filter["z_confirmation_date"];
        $this->confirmation_date->AdvancedSearch->SearchCondition = @$filter["v_confirmation_date"];
        $this->confirmation_date->AdvancedSearch->SearchValue2 = @$filter["y_confirmation_date"];
        $this->confirmation_date->AdvancedSearch->SearchOperator2 = @$filter["w_confirmation_date"];
        $this->confirmation_date->AdvancedSearch->save();

        // Field status
        $this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
        $this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
        $this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
        $this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
        $this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
        $this->status->AdvancedSearch->save();
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
        $this->buildSearchSql($where, $this->po_no, $default, true); // po_no
        $this->buildSearchSql($where, $this->to_no, $default, true); // to_no
        $this->buildSearchSql($where, $this->to_order_item, $default, true); // to_order_item
        $this->buildSearchSql($where, $this->to_priority, $default, true); // to_priority
        $this->buildSearchSql($where, $this->to_priority_code, $default, true); // to_priority_code
        $this->buildSearchSql($where, $this->source_storage_type, $default, true); // source_storage_type
        $this->buildSearchSql($where, $this->source_storage_bin, $default, true); // source_storage_bin
        $this->buildSearchSql($where, $this->carton_number, $default, true); // carton_number
        $this->buildSearchSql($where, $this->creation_date, $default, true); // creation_date
        $this->buildSearchSql($where, $this->gr_number, $default, true); // gr_number
        $this->buildSearchSql($where, $this->gr_date, $default, true); // gr_date
        $this->buildSearchSql($where, $this->delivery, $default, true); // delivery
        $this->buildSearchSql($where, $this->store_id, $default, true); // store_id
        $this->buildSearchSql($where, $this->store_name, $default, true); // store_name
        $this->buildSearchSql($where, $this->article, $default, true); // article
        $this->buildSearchSql($where, $this->size_code, $default, true); // size_code
        $this->buildSearchSql($where, $this->size_desc, $default, true); // size_desc
        $this->buildSearchSql($where, $this->color_code, $default, true); // color_code
        $this->buildSearchSql($where, $this->color_desc, $default, true); // color_desc
        $this->buildSearchSql($where, $this->concept, $default, true); // concept
        $this->buildSearchSql($where, $this->target_qty, $default, true); // target_qty
        $this->buildSearchSql($where, $this->picked_qty, $default, true); // picked_qty
        $this->buildSearchSql($where, $this->variance_qty, $default, true); // variance_qty
        $this->buildSearchSql($where, $this->confirmation_date, $default, true); // confirmation_date
        $this->buildSearchSql($where, $this->confirmation_time, $default, true); // confirmation_time
        $this->buildSearchSql($where, $this->box_code, $default, true); // box_code
        $this->buildSearchSql($where, $this->box_type, $default, true); // box_type
        $this->buildSearchSql($where, $this->picker, $default, true); // picker
        $this->buildSearchSql($where, $this->status, $default, true); // status
        $this->buildSearchSql($where, $this->remarks, $default, true); // remarks

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->creation_date->AdvancedSearch->save(); // creation_date
            $this->confirmation_date->AdvancedSearch->save(); // confirmation_date
            $this->status->AdvancedSearch->save(); // status
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
        $searchFlds[] = &$this->to_order_item;
        $searchFlds[] = &$this->to_priority;
        $searchFlds[] = &$this->to_priority_code;
        $searchFlds[] = &$this->source_storage_type;
        $searchFlds[] = &$this->source_storage_bin;
        $searchFlds[] = &$this->carton_number;
        $searchFlds[] = &$this->creation_date;
        $searchFlds[] = &$this->gr_number;
        $searchFlds[] = &$this->delivery;
        $searchFlds[] = &$this->store_id;
        $searchFlds[] = &$this->store_name;
        $searchFlds[] = &$this->article;
        $searchFlds[] = &$this->size_code;
        $searchFlds[] = &$this->size_desc;
        $searchFlds[] = &$this->color_code;
        $searchFlds[] = &$this->color_desc;
        $searchFlds[] = &$this->concept;
        $searchFlds[] = &$this->box_code;
        $searchFlds[] = &$this->box_type;
        $searchFlds[] = &$this->picker;
        $searchFlds[] = &$this->status;
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
        if ($this->po_no->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->to_no->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->to_order_item->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->to_priority->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->to_priority_code->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->source_storage_type->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->source_storage_bin->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->carton_number->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->creation_date->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->gr_number->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->gr_date->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->delivery->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->store_id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->store_name->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->article->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->size_code->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->size_desc->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->color_code->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->color_desc->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->concept->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->target_qty->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->picked_qty->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->variance_qty->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->confirmation_date->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->confirmation_time->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->box_code->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->box_type->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->picker->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->status->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->remarks->AdvancedSearch->issetSession()) {
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
        $this->po_no->AdvancedSearch->unsetSession();
        $this->to_no->AdvancedSearch->unsetSession();
        $this->to_order_item->AdvancedSearch->unsetSession();
        $this->to_priority->AdvancedSearch->unsetSession();
        $this->to_priority_code->AdvancedSearch->unsetSession();
        $this->source_storage_type->AdvancedSearch->unsetSession();
        $this->source_storage_bin->AdvancedSearch->unsetSession();
        $this->carton_number->AdvancedSearch->unsetSession();
        $this->creation_date->AdvancedSearch->unsetSession();
        $this->gr_number->AdvancedSearch->unsetSession();
        $this->gr_date->AdvancedSearch->unsetSession();
        $this->delivery->AdvancedSearch->unsetSession();
        $this->store_id->AdvancedSearch->unsetSession();
        $this->store_name->AdvancedSearch->unsetSession();
        $this->article->AdvancedSearch->unsetSession();
        $this->size_code->AdvancedSearch->unsetSession();
        $this->size_desc->AdvancedSearch->unsetSession();
        $this->color_code->AdvancedSearch->unsetSession();
        $this->color_desc->AdvancedSearch->unsetSession();
        $this->concept->AdvancedSearch->unsetSession();
        $this->target_qty->AdvancedSearch->unsetSession();
        $this->picked_qty->AdvancedSearch->unsetSession();
        $this->variance_qty->AdvancedSearch->unsetSession();
        $this->confirmation_date->AdvancedSearch->unsetSession();
        $this->confirmation_time->AdvancedSearch->unsetSession();
        $this->box_code->AdvancedSearch->unsetSession();
        $this->box_type->AdvancedSearch->unsetSession();
        $this->picker->AdvancedSearch->unsetSession();
        $this->status->AdvancedSearch->unsetSession();
        $this->remarks->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
        $this->id->AdvancedSearch->load();
        $this->po_no->AdvancedSearch->load();
        $this->to_no->AdvancedSearch->load();
        $this->to_order_item->AdvancedSearch->load();
        $this->to_priority->AdvancedSearch->load();
        $this->to_priority_code->AdvancedSearch->load();
        $this->source_storage_type->AdvancedSearch->load();
        $this->source_storage_bin->AdvancedSearch->load();
        $this->carton_number->AdvancedSearch->load();
        $this->creation_date->AdvancedSearch->load();
        $this->gr_number->AdvancedSearch->load();
        $this->gr_date->AdvancedSearch->load();
        $this->delivery->AdvancedSearch->load();
        $this->store_id->AdvancedSearch->load();
        $this->store_name->AdvancedSearch->load();
        $this->article->AdvancedSearch->load();
        $this->size_code->AdvancedSearch->load();
        $this->size_desc->AdvancedSearch->load();
        $this->color_code->AdvancedSearch->load();
        $this->color_desc->AdvancedSearch->load();
        $this->concept->AdvancedSearch->load();
        $this->target_qty->AdvancedSearch->load();
        $this->picked_qty->AdvancedSearch->load();
        $this->variance_qty->AdvancedSearch->load();
        $this->confirmation_date->AdvancedSearch->load();
        $this->confirmation_time->AdvancedSearch->load();
        $this->box_code->AdvancedSearch->load();
        $this->box_type->AdvancedSearch->load();
        $this->picker->AdvancedSearch->load();
        $this->status->AdvancedSearch->load();
        $this->remarks->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Load default Sorting Order
        if ($this->Command != "json") {
            $defaultSort = $this->confirmation_date->Expression . " ASC" . ", " . $this->confirmation_time->Expression . " ASC"; // Set up default sort
            if ($this->getSessionOrderBy() == "" && $defaultSort != "") {
                $this->setSessionOrderBy($defaultSort);
            }
        }

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->id); // id
            $this->updateSort($this->to_no); // to_no
            $this->updateSort($this->to_order_item); // to_order_item
            $this->updateSort($this->to_priority); // to_priority
            $this->updateSort($this->to_priority_code); // to_priority_code
            $this->updateSort($this->source_storage_type); // source_storage_type
            $this->updateSort($this->source_storage_bin); // source_storage_bin
            $this->updateSort($this->carton_number); // carton_number
            $this->updateSort($this->creation_date); // creation_date
            $this->updateSort($this->gr_number); // gr_number
            $this->updateSort($this->gr_date); // gr_date
            $this->updateSort($this->delivery); // delivery
            $this->updateSort($this->store_id); // store_id
            $this->updateSort($this->store_name); // store_name
            $this->updateSort($this->article); // article
            $this->updateSort($this->size_code); // size_code
            $this->updateSort($this->size_desc); // size_desc
            $this->updateSort($this->color_code); // color_code
            $this->updateSort($this->color_desc); // color_desc
            $this->updateSort($this->concept); // concept
            $this->updateSort($this->target_qty); // target_qty
            $this->updateSort($this->picked_qty); // picked_qty
            $this->updateSort($this->variance_qty); // variance_qty
            $this->updateSort($this->confirmation_date); // confirmation_date
            $this->updateSort($this->confirmation_time); // confirmation_time
            $this->updateSort($this->box_code); // box_code
            $this->updateSort($this->box_type); // box_type
            $this->updateSort($this->picker); // picker
            $this->updateSort($this->status); // status
            $this->updateSort($this->remarks); // remarks
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
                $this->po_no->setSort("");
                $this->to_no->setSort("");
                $this->to_order_item->setSort("");
                $this->to_priority->setSort("");
                $this->to_priority_code->setSort("");
                $this->source_storage_type->setSort("");
                $this->source_storage_bin->setSort("");
                $this->carton_number->setSort("");
                $this->creation_date->setSort("");
                $this->gr_number->setSort("");
                $this->gr_date->setSort("");
                $this->delivery->setSort("");
                $this->store_id->setSort("");
                $this->store_name->setSort("");
                $this->article->setSort("");
                $this->size_code->setSort("");
                $this->size_desc->setSort("");
                $this->color_code->setSort("");
                $this->color_desc->setSort("");
                $this->concept->setSort("");
                $this->target_qty->setSort("");
                $this->picked_qty->setSort("");
                $this->variance_qty->setSort("");
                $this->confirmation_date->setSort("");
                $this->confirmation_time->setSort("");
                $this->box_code->setSort("");
                $this->box_type->setSort("");
                $this->picker->setSort("");
                $this->status->setSort("");
                $this->remarks->setSort("");
                $this->aisle->setSort("");
                $this->area->setSort("");
                $this->aisle2->setSort("");
                $this->store_id2->setSort("");
                $this->close_totes->setSort("");
                $this->job_id->setSort("");
                $this->sequence->setSort("");
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

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = true;

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
        if ($this->CurrentMode == "view") {
            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }
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
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fpickinglist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fpickinglist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
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
            $option->add("to_no", $this->createColumnOption("to_no"));
            $option->add("to_order_item", $this->createColumnOption("to_order_item"));
            $option->add("to_priority", $this->createColumnOption("to_priority"));
            $option->add("to_priority_code", $this->createColumnOption("to_priority_code"));
            $option->add("source_storage_type", $this->createColumnOption("source_storage_type"));
            $option->add("source_storage_bin", $this->createColumnOption("source_storage_bin"));
            $option->add("carton_number", $this->createColumnOption("carton_number"));
            $option->add("creation_date", $this->createColumnOption("creation_date"));
            $option->add("gr_number", $this->createColumnOption("gr_number"));
            $option->add("gr_date", $this->createColumnOption("gr_date"));
            $option->add("delivery", $this->createColumnOption("delivery"));
            $option->add("store_id", $this->createColumnOption("store_id"));
            $option->add("store_name", $this->createColumnOption("store_name"));
            $option->add("article", $this->createColumnOption("article"));
            $option->add("size_code", $this->createColumnOption("size_code"));
            $option->add("size_desc", $this->createColumnOption("size_desc"));
            $option->add("color_code", $this->createColumnOption("color_code"));
            $option->add("color_desc", $this->createColumnOption("color_desc"));
            $option->add("concept", $this->createColumnOption("concept"));
            $option->add("target_qty", $this->createColumnOption("target_qty"));
            $option->add("picked_qty", $this->createColumnOption("picked_qty"));
            $option->add("variance_qty", $this->createColumnOption("variance_qty"));
            $option->add("confirmation_date", $this->createColumnOption("confirmation_date"));
            $option->add("confirmation_time", $this->createColumnOption("confirmation_time"));
            $option->add("box_code", $this->createColumnOption("box_code"));
            $option->add("box_type", $this->createColumnOption("box_type"));
            $option->add("picker", $this->createColumnOption("picker"));
            $option->add("status", $this->createColumnOption("status"));
            $option->add("remarks", $this->createColumnOption("remarks"));
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fpickingsrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpickingsrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fpickinglist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
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

        // po_no
        if ($this->po_no->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->po_no->AdvancedSearch->SearchValue != "" || $this->po_no->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // to_no
        if ($this->to_no->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->to_no->AdvancedSearch->SearchValue != "" || $this->to_no->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // to_order_item
        if ($this->to_order_item->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->to_order_item->AdvancedSearch->SearchValue != "" || $this->to_order_item->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // to_priority
        if ($this->to_priority->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->to_priority->AdvancedSearch->SearchValue != "" || $this->to_priority->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // to_priority_code
        if ($this->to_priority_code->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->to_priority_code->AdvancedSearch->SearchValue != "" || $this->to_priority_code->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // source_storage_type
        if ($this->source_storage_type->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->source_storage_type->AdvancedSearch->SearchValue != "" || $this->source_storage_type->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // source_storage_bin
        if ($this->source_storage_bin->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->source_storage_bin->AdvancedSearch->SearchValue != "" || $this->source_storage_bin->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // carton_number
        if ($this->carton_number->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->carton_number->AdvancedSearch->SearchValue != "" || $this->carton_number->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // creation_date
        if ($this->creation_date->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->creation_date->AdvancedSearch->SearchValue != "" || $this->creation_date->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // gr_number
        if ($this->gr_number->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->gr_number->AdvancedSearch->SearchValue != "" || $this->gr_number->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // gr_date
        if ($this->gr_date->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->gr_date->AdvancedSearch->SearchValue != "" || $this->gr_date->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // delivery
        if ($this->delivery->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->delivery->AdvancedSearch->SearchValue != "" || $this->delivery->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // store_id
        if ($this->store_id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->store_id->AdvancedSearch->SearchValue != "" || $this->store_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // store_name
        if ($this->store_name->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->store_name->AdvancedSearch->SearchValue != "" || $this->store_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // article
        if ($this->article->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->article->AdvancedSearch->SearchValue != "" || $this->article->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // size_code
        if ($this->size_code->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->size_code->AdvancedSearch->SearchValue != "" || $this->size_code->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // size_desc
        if ($this->size_desc->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->size_desc->AdvancedSearch->SearchValue != "" || $this->size_desc->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // color_code
        if ($this->color_code->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->color_code->AdvancedSearch->SearchValue != "" || $this->color_code->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // color_desc
        if ($this->color_desc->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->color_desc->AdvancedSearch->SearchValue != "" || $this->color_desc->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // target_qty
        if ($this->target_qty->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->target_qty->AdvancedSearch->SearchValue != "" || $this->target_qty->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // picked_qty
        if ($this->picked_qty->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->picked_qty->AdvancedSearch->SearchValue != "" || $this->picked_qty->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // variance_qty
        if ($this->variance_qty->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->variance_qty->AdvancedSearch->SearchValue != "" || $this->variance_qty->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // confirmation_date
        if ($this->confirmation_date->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->confirmation_date->AdvancedSearch->SearchValue != "" || $this->confirmation_date->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // confirmation_time
        if ($this->confirmation_time->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->confirmation_time->AdvancedSearch->SearchValue != "" || $this->confirmation_time->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // box_code
        if ($this->box_code->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->box_code->AdvancedSearch->SearchValue != "" || $this->box_code->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // box_type
        if ($this->box_type->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->box_type->AdvancedSearch->SearchValue != "" || $this->box_type->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // picker
        if ($this->picker->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->picker->AdvancedSearch->SearchValue != "" || $this->picker->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // remarks
        if ($this->remarks->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->remarks->AdvancedSearch->SearchValue != "" || $this->remarks->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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
        $this->job_id->setDbValue($row['job_id']);
        $this->sequence->setDbValue($row['sequence']);
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
        $row['job_id'] = $this->job_id->DefaultValue;
        $row['sequence'] = $this->sequence->DefaultValue;
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

        // po_no
        $this->po_no->CellCssStyle = "white-space: nowrap;";

        // to_no
        $this->to_no->CellCssStyle = "white-space: nowrap;";

        // to_order_item
        $this->to_order_item->CellCssStyle = "white-space: nowrap;";

        // to_priority
        $this->to_priority->CellCssStyle = "white-space: nowrap;";

        // to_priority_code
        $this->to_priority_code->CellCssStyle = "white-space: nowrap;";

        // source_storage_type
        $this->source_storage_type->CellCssStyle = "white-space: nowrap;";

        // source_storage_bin
        $this->source_storage_bin->CellCssStyle = "white-space: nowrap;";

        // carton_number
        $this->carton_number->CellCssStyle = "white-space: nowrap;";

        // creation_date
        $this->creation_date->CellCssStyle = "white-space: nowrap;";

        // gr_number
        $this->gr_number->CellCssStyle = "white-space: nowrap;";

        // gr_date
        $this->gr_date->CellCssStyle = "white-space: nowrap;";

        // delivery
        $this->delivery->CellCssStyle = "white-space: nowrap;";

        // store_id
        $this->store_id->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // article
        $this->article->CellCssStyle = "white-space: nowrap;";

        // size_code
        $this->size_code->CellCssStyle = "white-space: nowrap;";

        // size_desc
        $this->size_desc->CellCssStyle = "white-space: nowrap;";

        // color_code
        $this->color_code->CellCssStyle = "white-space: nowrap;";

        // color_desc
        $this->color_desc->CellCssStyle = "white-space: nowrap;";

        // concept
        $this->concept->CellCssStyle = "white-space: nowrap;";

        // target_qty
        $this->target_qty->CellCssStyle = "white-space: nowrap;";

        // picked_qty
        $this->picked_qty->CellCssStyle = "white-space: nowrap;";

        // variance_qty
        $this->variance_qty->CellCssStyle = "white-space: nowrap;";

        // confirmation_date
        $this->confirmation_date->CellCssStyle = "white-space: nowrap;";

        // confirmation_time
        $this->confirmation_time->CellCssStyle = "white-space: nowrap;";

        // box_code
        $this->box_code->CellCssStyle = "white-space: nowrap;";

        // box_type
        $this->box_type->CellCssStyle = "white-space: nowrap;";

        // picker
        $this->picker->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // remarks
        $this->remarks->CellCssStyle = "white-space: nowrap;";

        // aisle
        $this->aisle->CellCssStyle = "white-space: nowrap;";

        // area
        $this->area->CellCssStyle = "white-space: nowrap;";

        // aisle2
        $this->aisle2->CellCssStyle = "white-space: nowrap;";

        // store_id2
        $this->store_id2->CellCssStyle = "white-space: nowrap;";

        // close_totes
        $this->close_totes->CellCssStyle = "white-space: nowrap;";

        // job_id
        $this->job_id->CellCssStyle = "white-space: nowrap;";

        // sequence
        $this->sequence->CellCssStyle = "white-space: nowrap;";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

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
            if (strval($this->status->CurrentValue) != "") {
                $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
            } else {
                $this->status->ViewValue = null;
            }
            $this->status->ViewCustomAttributes = "";

            // remarks
            $this->remarks->ViewValue = $this->remarks->CurrentValue;
            $this->remarks->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // to_no
            $this->to_no->LinkCustomAttributes = "";
            $this->to_no->HrefValue = "";
            $this->to_no->TooltipValue = "";

            // to_order_item
            $this->to_order_item->LinkCustomAttributes = "";
            $this->to_order_item->HrefValue = "";
            $this->to_order_item->TooltipValue = "";

            // to_priority
            $this->to_priority->LinkCustomAttributes = "";
            $this->to_priority->HrefValue = "";
            $this->to_priority->TooltipValue = "";

            // to_priority_code
            $this->to_priority_code->LinkCustomAttributes = "";
            $this->to_priority_code->HrefValue = "";
            $this->to_priority_code->TooltipValue = "";

            // source_storage_type
            $this->source_storage_type->LinkCustomAttributes = "";
            $this->source_storage_type->HrefValue = "";
            $this->source_storage_type->TooltipValue = "";

            // source_storage_bin
            $this->source_storage_bin->LinkCustomAttributes = "";
            $this->source_storage_bin->HrefValue = "";
            $this->source_storage_bin->TooltipValue = "";

            // carton_number
            $this->carton_number->LinkCustomAttributes = "";
            $this->carton_number->HrefValue = "";
            $this->carton_number->TooltipValue = "";

            // creation_date
            $this->creation_date->LinkCustomAttributes = "";
            $this->creation_date->HrefValue = "";
            $this->creation_date->TooltipValue = "";

            // gr_number
            $this->gr_number->LinkCustomAttributes = "";
            $this->gr_number->HrefValue = "";
            $this->gr_number->TooltipValue = "";

            // gr_date
            $this->gr_date->LinkCustomAttributes = "";
            $this->gr_date->HrefValue = "";
            $this->gr_date->TooltipValue = "";

            // delivery
            $this->delivery->LinkCustomAttributes = "";
            $this->delivery->HrefValue = "";
            $this->delivery->TooltipValue = "";

            // store_id
            $this->store_id->LinkCustomAttributes = "";
            $this->store_id->HrefValue = "";
            $this->store_id->TooltipValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";
            $this->store_name->TooltipValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";
            $this->article->TooltipValue = "";

            // size_code
            $this->size_code->LinkCustomAttributes = "";
            $this->size_code->HrefValue = "";
            $this->size_code->TooltipValue = "";

            // size_desc
            $this->size_desc->LinkCustomAttributes = "";
            $this->size_desc->HrefValue = "";
            $this->size_desc->TooltipValue = "";

            // color_code
            $this->color_code->LinkCustomAttributes = "";
            $this->color_code->HrefValue = "";
            $this->color_code->TooltipValue = "";

            // color_desc
            $this->color_desc->LinkCustomAttributes = "";
            $this->color_desc->HrefValue = "";
            $this->color_desc->TooltipValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";
            $this->concept->TooltipValue = "";

            // target_qty
            $this->target_qty->LinkCustomAttributes = "";
            $this->target_qty->HrefValue = "";
            $this->target_qty->TooltipValue = "";

            // picked_qty
            $this->picked_qty->LinkCustomAttributes = "";
            $this->picked_qty->HrefValue = "";
            $this->picked_qty->TooltipValue = "";

            // variance_qty
            $this->variance_qty->LinkCustomAttributes = "";
            $this->variance_qty->HrefValue = "";
            $this->variance_qty->TooltipValue = "";

            // confirmation_date
            $this->confirmation_date->LinkCustomAttributes = "";
            $this->confirmation_date->HrefValue = "";
            $this->confirmation_date->TooltipValue = "";

            // confirmation_time
            $this->confirmation_time->LinkCustomAttributes = "";
            $this->confirmation_time->HrefValue = "";
            $this->confirmation_time->TooltipValue = "";

            // box_code
            $this->box_code->LinkCustomAttributes = "";
            $this->box_code->HrefValue = "";
            $this->box_code->TooltipValue = "";

            // box_type
            $this->box_type->LinkCustomAttributes = "";
            $this->box_type->HrefValue = "";
            $this->box_type->TooltipValue = "";

            // picker
            $this->picker->LinkCustomAttributes = "";
            $this->picker->HrefValue = "";
            $this->picker->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // remarks
            $this->remarks->LinkCustomAttributes = "";
            $this->remarks->HrefValue = "";
            $this->remarks->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // id
            if ($this->id->UseFilter && !EmptyValue($this->id->AdvancedSearch->SearchValue)) {
                if (is_array($this->id->AdvancedSearch->SearchValue)) {
                    $this->id->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->id->AdvancedSearch->SearchValue);
                }
                $this->id->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->id->AdvancedSearch->SearchValue);
            }

            // to_no
            if ($this->to_no->UseFilter && !EmptyValue($this->to_no->AdvancedSearch->SearchValue)) {
                if (is_array($this->to_no->AdvancedSearch->SearchValue)) {
                    $this->to_no->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_no->AdvancedSearch->SearchValue);
                }
                $this->to_no->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_no->AdvancedSearch->SearchValue);
            }

            // to_order_item
            if ($this->to_order_item->UseFilter && !EmptyValue($this->to_order_item->AdvancedSearch->SearchValue)) {
                if (is_array($this->to_order_item->AdvancedSearch->SearchValue)) {
                    $this->to_order_item->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_order_item->AdvancedSearch->SearchValue);
                }
                $this->to_order_item->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_order_item->AdvancedSearch->SearchValue);
            }

            // to_priority
            if ($this->to_priority->UseFilter && !EmptyValue($this->to_priority->AdvancedSearch->SearchValue)) {
                if (is_array($this->to_priority->AdvancedSearch->SearchValue)) {
                    $this->to_priority->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_priority->AdvancedSearch->SearchValue);
                }
                $this->to_priority->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_priority->AdvancedSearch->SearchValue);
            }

            // to_priority_code
            if ($this->to_priority_code->UseFilter && !EmptyValue($this->to_priority_code->AdvancedSearch->SearchValue)) {
                if (is_array($this->to_priority_code->AdvancedSearch->SearchValue)) {
                    $this->to_priority_code->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_priority_code->AdvancedSearch->SearchValue);
                }
                $this->to_priority_code->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->to_priority_code->AdvancedSearch->SearchValue);
            }

            // source_storage_type
            if ($this->source_storage_type->UseFilter && !EmptyValue($this->source_storage_type->AdvancedSearch->SearchValue)) {
                if (is_array($this->source_storage_type->AdvancedSearch->SearchValue)) {
                    $this->source_storage_type->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->source_storage_type->AdvancedSearch->SearchValue);
                }
                $this->source_storage_type->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->source_storage_type->AdvancedSearch->SearchValue);
            }

            // source_storage_bin
            if ($this->source_storage_bin->UseFilter && !EmptyValue($this->source_storage_bin->AdvancedSearch->SearchValue)) {
                if (is_array($this->source_storage_bin->AdvancedSearch->SearchValue)) {
                    $this->source_storage_bin->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->source_storage_bin->AdvancedSearch->SearchValue);
                }
                $this->source_storage_bin->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->source_storage_bin->AdvancedSearch->SearchValue);
            }

            // carton_number
            if ($this->carton_number->UseFilter && !EmptyValue($this->carton_number->AdvancedSearch->SearchValue)) {
                if (is_array($this->carton_number->AdvancedSearch->SearchValue)) {
                    $this->carton_number->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->carton_number->AdvancedSearch->SearchValue);
                }
                $this->carton_number->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->carton_number->AdvancedSearch->SearchValue);
            }

            // creation_date
            if ($this->creation_date->UseFilter && !EmptyValue($this->creation_date->AdvancedSearch->SearchValue)) {
                if (is_array($this->creation_date->AdvancedSearch->SearchValue)) {
                    $this->creation_date->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->creation_date->AdvancedSearch->SearchValue);
                }
                $this->creation_date->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->creation_date->AdvancedSearch->SearchValue);
            }
            $this->creation_date->setupEditAttributes();
            $this->creation_date->EditCustomAttributes = "";
            $this->creation_date->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->creation_date->AdvancedSearch->SearchValue2, $this->creation_date->formatPattern()), $this->creation_date->formatPattern()));
            $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

            // gr_number
            if ($this->gr_number->UseFilter && !EmptyValue($this->gr_number->AdvancedSearch->SearchValue)) {
                if (is_array($this->gr_number->AdvancedSearch->SearchValue)) {
                    $this->gr_number->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->gr_number->AdvancedSearch->SearchValue);
                }
                $this->gr_number->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->gr_number->AdvancedSearch->SearchValue);
            }

            // gr_date
            if ($this->gr_date->UseFilter && !EmptyValue($this->gr_date->AdvancedSearch->SearchValue)) {
                if (is_array($this->gr_date->AdvancedSearch->SearchValue)) {
                    $this->gr_date->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->gr_date->AdvancedSearch->SearchValue);
                }
                $this->gr_date->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->gr_date->AdvancedSearch->SearchValue);
            }

            // delivery
            if ($this->delivery->UseFilter && !EmptyValue($this->delivery->AdvancedSearch->SearchValue)) {
                if (is_array($this->delivery->AdvancedSearch->SearchValue)) {
                    $this->delivery->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->delivery->AdvancedSearch->SearchValue);
                }
                $this->delivery->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->delivery->AdvancedSearch->SearchValue);
            }

            // store_id
            if ($this->store_id->UseFilter && !EmptyValue($this->store_id->AdvancedSearch->SearchValue)) {
                if (is_array($this->store_id->AdvancedSearch->SearchValue)) {
                    $this->store_id->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->store_id->AdvancedSearch->SearchValue);
                }
                $this->store_id->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->store_id->AdvancedSearch->SearchValue);
            }

            // store_name
            if ($this->store_name->UseFilter && !EmptyValue($this->store_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->store_name->AdvancedSearch->SearchValue)) {
                    $this->store_name->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->store_name->AdvancedSearch->SearchValue);
                }
                $this->store_name->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->store_name->AdvancedSearch->SearchValue);
            }

            // article
            if ($this->article->UseFilter && !EmptyValue($this->article->AdvancedSearch->SearchValue)) {
                if (is_array($this->article->AdvancedSearch->SearchValue)) {
                    $this->article->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->article->AdvancedSearch->SearchValue);
                }
                $this->article->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->article->AdvancedSearch->SearchValue);
            }

            // size_code
            if ($this->size_code->UseFilter && !EmptyValue($this->size_code->AdvancedSearch->SearchValue)) {
                if (is_array($this->size_code->AdvancedSearch->SearchValue)) {
                    $this->size_code->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->size_code->AdvancedSearch->SearchValue);
                }
                $this->size_code->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->size_code->AdvancedSearch->SearchValue);
            }

            // size_desc
            if ($this->size_desc->UseFilter && !EmptyValue($this->size_desc->AdvancedSearch->SearchValue)) {
                if (is_array($this->size_desc->AdvancedSearch->SearchValue)) {
                    $this->size_desc->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->size_desc->AdvancedSearch->SearchValue);
                }
                $this->size_desc->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->size_desc->AdvancedSearch->SearchValue);
            }

            // color_code
            if ($this->color_code->UseFilter && !EmptyValue($this->color_code->AdvancedSearch->SearchValue)) {
                if (is_array($this->color_code->AdvancedSearch->SearchValue)) {
                    $this->color_code->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->color_code->AdvancedSearch->SearchValue);
                }
                $this->color_code->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->color_code->AdvancedSearch->SearchValue);
            }

            // color_desc
            if ($this->color_desc->UseFilter && !EmptyValue($this->color_desc->AdvancedSearch->SearchValue)) {
                if (is_array($this->color_desc->AdvancedSearch->SearchValue)) {
                    $this->color_desc->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->color_desc->AdvancedSearch->SearchValue);
                }
                $this->color_desc->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->color_desc->AdvancedSearch->SearchValue);
            }

            // concept
            if ($this->concept->UseFilter && !EmptyValue($this->concept->AdvancedSearch->SearchValue)) {
                if (is_array($this->concept->AdvancedSearch->SearchValue)) {
                    $this->concept->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->concept->AdvancedSearch->SearchValue);
                }
                $this->concept->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->concept->AdvancedSearch->SearchValue);
            }

            // target_qty
            if ($this->target_qty->UseFilter && !EmptyValue($this->target_qty->AdvancedSearch->SearchValue)) {
                if (is_array($this->target_qty->AdvancedSearch->SearchValue)) {
                    $this->target_qty->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->target_qty->AdvancedSearch->SearchValue);
                }
                $this->target_qty->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->target_qty->AdvancedSearch->SearchValue);
            }

            // picked_qty
            if ($this->picked_qty->UseFilter && !EmptyValue($this->picked_qty->AdvancedSearch->SearchValue)) {
                if (is_array($this->picked_qty->AdvancedSearch->SearchValue)) {
                    $this->picked_qty->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->picked_qty->AdvancedSearch->SearchValue);
                }
                $this->picked_qty->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->picked_qty->AdvancedSearch->SearchValue);
            }

            // variance_qty
            if ($this->variance_qty->UseFilter && !EmptyValue($this->variance_qty->AdvancedSearch->SearchValue)) {
                if (is_array($this->variance_qty->AdvancedSearch->SearchValue)) {
                    $this->variance_qty->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->variance_qty->AdvancedSearch->SearchValue);
                }
                $this->variance_qty->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->variance_qty->AdvancedSearch->SearchValue);
            }

            // confirmation_date
            if ($this->confirmation_date->UseFilter && !EmptyValue($this->confirmation_date->AdvancedSearch->SearchValue)) {
                if (is_array($this->confirmation_date->AdvancedSearch->SearchValue)) {
                    $this->confirmation_date->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->confirmation_date->AdvancedSearch->SearchValue);
                }
                $this->confirmation_date->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->confirmation_date->AdvancedSearch->SearchValue);
            }
            $this->confirmation_date->setupEditAttributes();
            $this->confirmation_date->EditCustomAttributes = "";
            $this->confirmation_date->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->confirmation_date->AdvancedSearch->SearchValue2, $this->confirmation_date->formatPattern()), $this->confirmation_date->formatPattern()));
            $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());

            // confirmation_time
            if ($this->confirmation_time->UseFilter && !EmptyValue($this->confirmation_time->AdvancedSearch->SearchValue)) {
                if (is_array($this->confirmation_time->AdvancedSearch->SearchValue)) {
                    $this->confirmation_time->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->confirmation_time->AdvancedSearch->SearchValue);
                }
                $this->confirmation_time->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->confirmation_time->AdvancedSearch->SearchValue);
            }

            // box_code
            if ($this->box_code->UseFilter && !EmptyValue($this->box_code->AdvancedSearch->SearchValue)) {
                if (is_array($this->box_code->AdvancedSearch->SearchValue)) {
                    $this->box_code->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_code->AdvancedSearch->SearchValue);
                }
                $this->box_code->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_code->AdvancedSearch->SearchValue);
            }

            // box_type
            if ($this->box_type->UseFilter && !EmptyValue($this->box_type->AdvancedSearch->SearchValue)) {
                if (is_array($this->box_type->AdvancedSearch->SearchValue)) {
                    $this->box_type->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_type->AdvancedSearch->SearchValue);
                }
                $this->box_type->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_type->AdvancedSearch->SearchValue);
            }

            // picker
            if ($this->picker->UseFilter && !EmptyValue($this->picker->AdvancedSearch->SearchValue)) {
                if (is_array($this->picker->AdvancedSearch->SearchValue)) {
                    $this->picker->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->picker->AdvancedSearch->SearchValue);
                }
                $this->picker->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->picker->AdvancedSearch->SearchValue);
            }

            // status
            if ($this->status->UseFilter && !EmptyValue($this->status->AdvancedSearch->SearchValue)) {
                if (is_array($this->status->AdvancedSearch->SearchValue)) {
                    $this->status->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->status->AdvancedSearch->SearchValue);
                }
                $this->status->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->status->AdvancedSearch->SearchValue);
            }

            // remarks
            if ($this->remarks->UseFilter && !EmptyValue($this->remarks->AdvancedSearch->SearchValue)) {
                if (is_array($this->remarks->AdvancedSearch->SearchValue)) {
                    $this->remarks->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remarks->AdvancedSearch->SearchValue);
                }
                $this->remarks->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remarks->AdvancedSearch->SearchValue);
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
        $this->creation_date->AdvancedSearch->load();
        $this->confirmation_date->AdvancedSearch->load();
        $this->status->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl(false);
        $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" form=\"fpickinglist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"excel\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToExcel") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" form=\"fpickinglist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"word\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToWord") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" form=\"fpickinglist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"pdf\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToPdf") . "</button>";
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
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" form="fpickinglist" data-ew-action="email" data-hdr="' . $Language->phrase("ExportToEmailText") . '" data-sel="false"' . $url . '>' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Visible = true;

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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fpickingsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Advanced search button
        $item = &$this->SearchOptions->add("advancedsearch");
        if (IsMobile()) {
            $item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"pickingsearch\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
        } else {
            $item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"picking\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" data-ew-action=\"modal\" data-url=\"pickingsearch\" data-btn=\"SearchBtn\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
        }
        $item->Visible = true;

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

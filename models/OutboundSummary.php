<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class OutboundSummary extends Outbound
{
    use MessagesTrait;

    // Page ID
    public $PageID = "summary";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'Outbound';

    // Page object name
    public $PageObjName = "OutboundSummary";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS
    public $ReportTableClass = "";
    public $ReportTableStyle = "";

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

        // Table object (Outbound)
        if (!isset($GLOBALS["Outbound"]) || get_class($GLOBALS["Outbound"]) == PROJECT_NAMESPACE . "Outbound") {
            $GLOBALS["Outbound"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Outbound');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);
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
        if ($this->isExport() && !$this->isExport("print")) {
            $class = PROJECT_NAMESPACE . Config("REPORT_EXPORT_CLASSES." . $this->Export);
            if (class_exists($class)) {
                $content = $this->getContents();
                $doc = new $class();
                $doc($this, $content);
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection if not in dashboard
        if (!$DashboardReport) {
            CloseConnections();
        }

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

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar])) {
            $lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
        }
        $lookup->RenderEditFunc = ""; // Set up edit renderer

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

    // Options
    public $HideOptions = false;
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $FilterOptions; // Filter options

    // Records
    public $GroupRecords = [];
    public $DetailRecords = [];
    public $DetailRecordCount = 0;

    // Paging variables
    public $RecordIndex = 0; // Record index
    public $RecordCount = 0; // Record count (start from 1 for each group)
    public $StartGroup = 0; // Start group
    public $StopGroup = 0; // Stop group
    public $TotalGroups = 0; // Total groups
    public $GroupCount = 0; // Group count
    public $GroupCounter = []; // Group counter
    public $DisplayGroups = 3; // Groups per page
    public $GroupRange = 10;
    public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
    public $PageFirstGroupFilter = "";
    public $UserIDFilter = "";
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = "";
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $DrillDownList = "";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $SearchCommand = false;
    public $ShowHeader;
    public $GroupColumnCount = 0;
    public $SubGroupColumnCount = 0;
    public $DetailColumnCount = 0;
    public $TotalCount;
    public $PageTotalCount;
    public $TopContentClass = "col-sm-12 ew-top";
    public $LeftContentClass = "ew-left";
    public $CenterContentClass = "col-sm-12 ew-center";
    public $RightContentClass = "ew-right";
    public $BottomContentClass = "col-sm-12 ew-bottom";

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
            $Security, $DrillDownInPanel, $Breadcrumb,
            $DashboardReport, $CustomExportType, $ReportExportType;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header
        $ReportExportType = $ExportType; // Report export type, used in header
        $this->CurrentAction = Param("action"); // Set up current action

        // Setup export options
        $this->setupExportOptions();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up table class
        if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf")) {
            $this->ReportTableClass = "ew-table table-bordered table-sm";
        } else {
            $this->ReportTableClass = "table ew-table table-bordered table-sm";
        }

        // Set field visibility for detail fields
        $this->id->setVisibility();
        $this->box_id->setVisibility();
        $this->date_delivery->setVisibility();
        $this->box_type->setVisibility();
        $this->check_by->setVisibility();
        $this->quantity->setVisibility();
        $this->concept->setVisibility();
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
        $this->Week->setVisibility();
        $this->store_code->setVisibility();

        // Set up groups per page dynamically
        $this->setupDisplayGroups();

        // Set up Breadcrumb
        if (!$this->isExport() && !$DashboardReport) {
            $this->setupBreadcrumb();
        }

        // Check if search command
        $this->SearchCommand = (Get("cmd", "") == "search");

        // Load custom filters
        $this->pageFilterLoad();

        // Extended filter
        $extendedFilter = "";

        // Restore filter list
        $this->restoreFilterList();

        // Build extended filter
        $extendedFilter = $this->getExtendedFilter();
        AddFilter($this->SearchWhere, $extendedFilter);

        // Call Page Selecting event
        $this->pageSelecting($this->SearchWhere);

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Get sort
        $this->Sort = $this->getSort();

        // Search options
        $this->setupSearchOptions();

        // Update filter
        AddFilter($this->Filter, $this->SearchWhere);

        // Get total count
        $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
        $this->TotalGroups = $this->getRecordCount($sql);
        if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) { // Display all groups
            $this->DisplayGroups = $this->TotalGroups;
        }
        $this->StartGroup = 1;

        // Show header
        $this->ShowHeader = ($this->TotalGroups > 0);

        // Set up start position if not export all
        if ($this->ExportAll && $this->isExport()) {
            $this->DisplayGroups = $this->TotalGroups;
        } else {
            $this->setupStartGroup();
        }

        // Set no record found message
        if ($this->TotalGroups == 0) {
            if ($Security->canList()) {
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            } else {
                $this->setWarningMessage(DeniedMessage());
            }
        }

        // Hide export options if export/dashboard report/hide options
        if ($this->isExport() || $DashboardReport || $this->HideOptions) {
            $this->ExportOptions->hideAllOptions();
        }

        // Hide search/filter options if export/drilldown/dashboard report/hide options
        if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }

        // Get current page records
        if ($this->TotalGroups > 0) {
            $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, $this->Sort);
            $rs = $sql->setFirstResult($this->StartGroup - 1)->setMaxResults($this->DisplayGroups)->execute();
            $this->DetailRecords = $rs->fetchAll(); // Get records
            $this->GroupCount = 1;
        }
        $this->setupFieldCount();

        // Set the last group to display if not export all
        if ($this->ExportAll && $this->isExport()) {
            $this->StopGroup = $this->TotalGroups;
        } else {
            $this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
        }

        // Stop group <= total number of groups
        if (intval($this->StopGroup) > intval($this->TotalGroups)) {
            $this->StopGroup = $this->TotalGroups;
        }
        $this->RecordCount = 0;
        $this->RecordIndex = 0;
        $this->setGroupCount($this->StopGroup - $this->StartGroup + 1, 1);

        // Set up pager
        $this->Pager = new PrevNextPager($this->TableVar, $this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Load row values
    public function loadRowValues($record)
    {
        $data = [];
        $data["id"] = $record['id'];
        $data["box_id"] = $record['box_id'];
        $data["date_delivery"] = $record['date_delivery'];
        $data["box_type"] = $record['box_type'];
        $data["check_by"] = $record['check_by'];
        $data["quantity"] = $record['quantity'];
        $data["concept"] = $record['concept'];
        $data["store_name"] = $record['store_name'];
        $data["remark"] = $record['remark'];
        $data["no_delivery"] = $record['no_delivery'];
        $data["truck_type"] = $record['truck_type'];
        $data["seal_no"] = $record['seal_no'];
        $data["truck_plate"] = $record['truck_plate'];
        $data["transporter"] = $record['transporter'];
        $data["no_hp"] = $record['no_hp'];
        $data["checker"] = $record['checker'];
        $data["admin"] = $record['admin'];
        $data["remarks_box"] = $record['remarks_box'];
        $data["date_created"] = $record['date_created'];
        $data["date_updated"] = $record['date_updated'];
        $data["Week"] = $record['Week'];
        $data["store_code"] = $record['store_code'];
        $this->Rows[] = $data;
        $this->id->setDbValue($record['id']);
        $this->box_id->setDbValue($record['box_id']);
        $this->date_delivery->setDbValue($record['date_delivery']);
        $this->box_type->setDbValue($record['box_type']);
        $this->check_by->setDbValue($record['check_by']);
        $this->quantity->setDbValue($record['quantity']);
        $this->concept->setDbValue($record['concept']);
        $this->store_name->setDbValue($record['store_name']);
        $this->remark->setDbValue($record['remark']);
        $this->no_delivery->setDbValue($record['no_delivery']);
        $this->truck_type->setDbValue($record['truck_type']);
        $this->seal_no->setDbValue($record['seal_no']);
        $this->truck_plate->setDbValue($record['truck_plate']);
        $this->transporter->setDbValue($record['transporter']);
        $this->no_hp->setDbValue($record['no_hp']);
        $this->checker->setDbValue($record['checker']);
        $this->admin->setDbValue($record['admin']);
        $this->remarks_box->setDbValue($record['remarks_box']);
        $this->date_created->setDbValue($record['date_created']);
        $this->date_updated->setDbValue($record['date_updated']);
        $this->Week->setDbValue($record['Week']);
        $this->store_code->setDbValue($record['store_code']);
    }

    // Render row
    public function renderRow()
    {
        global $Security, $Language, $Language;
        $conn = $this->getConnection();
        if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total
            $records = &$this->DetailRecords;
            $this->PageTotalCount = count($records);
        } elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
            $hasCount = false;
            $hasSummary = false;

            // Get total count from SQL directly
            $sql = $this->buildReportSql($this->getSqlSelectCount(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
            $rstot = $conn->executeQuery($sql);
            if ($rstot && $cnt = $rstot->fetchOne()) {
                $hasCount = true;
            } else {
                $cnt = 0;
            }
            $this->TotalCount = $cnt;
            $hasSummary = true;

            // Accumulate grand summary from detail records
            if (!$hasCount || !$hasSummary) {
                $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
                $rs = $sql->execute();
                $this->DetailRecords = $rs ? $rs->fetchAll() : [];
            }
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // box_id
        $this->box_id->CellCssStyle = "white-space: nowrap;";

        // date_delivery
        $this->date_delivery->CellCssStyle = "white-space: nowrap;";

        // box_type
        $this->box_type->CellCssStyle = "white-space: nowrap;";

        // check_by
        $this->check_by->CellCssStyle = "white-space: nowrap;";

        // quantity
        $this->quantity->CellCssStyle = "white-space: nowrap;";

        // concept
        $this->concept->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // remark
        $this->remark->CellCssStyle = "white-space: nowrap;";

        // no_delivery
        $this->no_delivery->CellCssStyle = "white-space: nowrap;";

        // truck_type
        $this->truck_type->CellCssStyle = "white-space: nowrap;";

        // seal_no
        $this->seal_no->CellCssStyle = "white-space: nowrap;";

        // truck_plate
        $this->truck_plate->CellCssStyle = "white-space: nowrap;";

        // transporter
        $this->transporter->CellCssStyle = "white-space: nowrap;";

        // no_hp
        $this->no_hp->CellCssStyle = "white-space: nowrap;";

        // checker
        $this->checker->CellCssStyle = "white-space: nowrap;";

        // admin
        $this->admin->CellCssStyle = "white-space: nowrap;";

        // remarks_box
        $this->remarks_box->CellCssStyle = "white-space: nowrap;";

        // date_created
        $this->date_created->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // Week

        // store_code
        if ($this->RowType == ROWTYPE_SEARCH) {
            // id
            if ($this->id->UseFilter && !EmptyValue($this->id->AdvancedSearch->SearchValue)) {
                if (is_array($this->id->AdvancedSearch->SearchValue)) {
                    $this->id->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->id->AdvancedSearch->SearchValue);
                }
                $this->id->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->id->AdvancedSearch->SearchValue);
            }

            // box_id
            if ($this->box_id->UseFilter && !EmptyValue($this->box_id->AdvancedSearch->SearchValue)) {
                if (is_array($this->box_id->AdvancedSearch->SearchValue)) {
                    $this->box_id->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_id->AdvancedSearch->SearchValue);
                }
                $this->box_id->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_id->AdvancedSearch->SearchValue);
            }

            // date_delivery
            if ($this->date_delivery->UseFilter && !EmptyValue($this->date_delivery->AdvancedSearch->SearchValue)) {
                if (is_array($this->date_delivery->AdvancedSearch->SearchValue)) {
                    $this->date_delivery->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_delivery->AdvancedSearch->SearchValue);
                }
                $this->date_delivery->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_delivery->AdvancedSearch->SearchValue);
            }
            $this->date_delivery->setupEditAttributes();
            $this->date_delivery->EditCustomAttributes = "";
            $this->date_delivery->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->date_delivery->AdvancedSearch->SearchValue2, $this->date_delivery->formatPattern()), $this->date_delivery->formatPattern()));
            $this->date_delivery->PlaceHolder = RemoveHtml($this->date_delivery->caption());

            // box_type
            if ($this->box_type->UseFilter && !EmptyValue($this->box_type->AdvancedSearch->SearchValue)) {
                if (is_array($this->box_type->AdvancedSearch->SearchValue)) {
                    $this->box_type->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_type->AdvancedSearch->SearchValue);
                }
                $this->box_type->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->box_type->AdvancedSearch->SearchValue);
            }

            // check_by
            if ($this->check_by->UseFilter && !EmptyValue($this->check_by->AdvancedSearch->SearchValue)) {
                if (is_array($this->check_by->AdvancedSearch->SearchValue)) {
                    $this->check_by->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->check_by->AdvancedSearch->SearchValue);
                }
                $this->check_by->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->check_by->AdvancedSearch->SearchValue);
            }

            // quantity
            if ($this->quantity->UseFilter && !EmptyValue($this->quantity->AdvancedSearch->SearchValue)) {
                if (is_array($this->quantity->AdvancedSearch->SearchValue)) {
                    $this->quantity->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->quantity->AdvancedSearch->SearchValue);
                }
                $this->quantity->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->quantity->AdvancedSearch->SearchValue);
            }

            // concept
            if ($this->concept->UseFilter && !EmptyValue($this->concept->AdvancedSearch->SearchValue)) {
                if (is_array($this->concept->AdvancedSearch->SearchValue)) {
                    $this->concept->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->concept->AdvancedSearch->SearchValue);
                }
                $this->concept->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->concept->AdvancedSearch->SearchValue);
            }

            // store_name
            if ($this->store_name->UseFilter && !EmptyValue($this->store_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->store_name->AdvancedSearch->SearchValue)) {
                    $this->store_name->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->store_name->AdvancedSearch->SearchValue);
                }
                $this->store_name->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->store_name->AdvancedSearch->SearchValue);
            }

            // remark
            if ($this->remark->UseFilter && !EmptyValue($this->remark->AdvancedSearch->SearchValue)) {
                if (is_array($this->remark->AdvancedSearch->SearchValue)) {
                    $this->remark->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remark->AdvancedSearch->SearchValue);
                }
                $this->remark->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remark->AdvancedSearch->SearchValue);
            }

            // no_delivery
            if ($this->no_delivery->UseFilter && !EmptyValue($this->no_delivery->AdvancedSearch->SearchValue)) {
                if (is_array($this->no_delivery->AdvancedSearch->SearchValue)) {
                    $this->no_delivery->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_delivery->AdvancedSearch->SearchValue);
                }
                $this->no_delivery->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_delivery->AdvancedSearch->SearchValue);
            }

            // truck_type
            if ($this->truck_type->UseFilter && !EmptyValue($this->truck_type->AdvancedSearch->SearchValue)) {
                if (is_array($this->truck_type->AdvancedSearch->SearchValue)) {
                    $this->truck_type->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->truck_type->AdvancedSearch->SearchValue);
                }
                $this->truck_type->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->truck_type->AdvancedSearch->SearchValue);
            }

            // seal_no
            if ($this->seal_no->UseFilter && !EmptyValue($this->seal_no->AdvancedSearch->SearchValue)) {
                if (is_array($this->seal_no->AdvancedSearch->SearchValue)) {
                    $this->seal_no->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->seal_no->AdvancedSearch->SearchValue);
                }
                $this->seal_no->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->seal_no->AdvancedSearch->SearchValue);
            }

            // truck_plate
            if ($this->truck_plate->UseFilter && !EmptyValue($this->truck_plate->AdvancedSearch->SearchValue)) {
                if (is_array($this->truck_plate->AdvancedSearch->SearchValue)) {
                    $this->truck_plate->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->truck_plate->AdvancedSearch->SearchValue);
                }
                $this->truck_plate->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->truck_plate->AdvancedSearch->SearchValue);
            }

            // transporter
            if ($this->transporter->UseFilter && !EmptyValue($this->transporter->AdvancedSearch->SearchValue)) {
                if (is_array($this->transporter->AdvancedSearch->SearchValue)) {
                    $this->transporter->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->transporter->AdvancedSearch->SearchValue);
                }
                $this->transporter->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->transporter->AdvancedSearch->SearchValue);
            }

            // no_hp
            if ($this->no_hp->UseFilter && !EmptyValue($this->no_hp->AdvancedSearch->SearchValue)) {
                if (is_array($this->no_hp->AdvancedSearch->SearchValue)) {
                    $this->no_hp->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_hp->AdvancedSearch->SearchValue);
                }
                $this->no_hp->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_hp->AdvancedSearch->SearchValue);
            }

            // checker
            if ($this->checker->UseFilter && !EmptyValue($this->checker->AdvancedSearch->SearchValue)) {
                if (is_array($this->checker->AdvancedSearch->SearchValue)) {
                    $this->checker->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->checker->AdvancedSearch->SearchValue);
                }
                $this->checker->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->checker->AdvancedSearch->SearchValue);
            }

            // admin
            if ($this->admin->UseFilter && !EmptyValue($this->admin->AdvancedSearch->SearchValue)) {
                if (is_array($this->admin->AdvancedSearch->SearchValue)) {
                    $this->admin->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->admin->AdvancedSearch->SearchValue);
                }
                $this->admin->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->admin->AdvancedSearch->SearchValue);
            }

            // remarks_box
            if ($this->remarks_box->UseFilter && !EmptyValue($this->remarks_box->AdvancedSearch->SearchValue)) {
                if (is_array($this->remarks_box->AdvancedSearch->SearchValue)) {
                    $this->remarks_box->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remarks_box->AdvancedSearch->SearchValue);
                }
                $this->remarks_box->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->remarks_box->AdvancedSearch->SearchValue);
            }

            // date_created
            if ($this->date_created->UseFilter && !EmptyValue($this->date_created->AdvancedSearch->SearchValue)) {
                if (is_array($this->date_created->AdvancedSearch->SearchValue)) {
                    $this->date_created->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_created->AdvancedSearch->SearchValue);
                }
                $this->date_created->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_created->AdvancedSearch->SearchValue);
            }

            // date_updated
            if ($this->date_updated->UseFilter && !EmptyValue($this->date_updated->AdvancedSearch->SearchValue)) {
                if (is_array($this->date_updated->AdvancedSearch->SearchValue)) {
                    $this->date_updated->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_updated->AdvancedSearch->SearchValue);
                }
                $this->date_updated->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->date_updated->AdvancedSearch->SearchValue);
            }
        } elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
            $this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class

            // id
            $this->id->HrefValue = "";

            // box_id
            $this->box_id->HrefValue = "";

            // date_delivery
            $this->date_delivery->HrefValue = "";

            // box_type
            $this->box_type->HrefValue = "";

            // check_by
            $this->check_by->HrefValue = "";

            // quantity
            $this->quantity->HrefValue = "";

            // concept
            $this->concept->HrefValue = "";

            // store_name
            $this->store_name->HrefValue = "";

            // remark
            $this->remark->HrefValue = "";

            // no_delivery
            $this->no_delivery->HrefValue = "";

            // truck_type
            $this->truck_type->HrefValue = "";

            // seal_no
            $this->seal_no->HrefValue = "";

            // truck_plate
            $this->truck_plate->HrefValue = "";

            // transporter
            $this->transporter->HrefValue = "";

            // no_hp
            $this->no_hp->HrefValue = "";

            // checker
            $this->checker->HrefValue = "";

            // admin
            $this->admin->HrefValue = "";

            // remarks_box
            $this->remarks_box->HrefValue = "";

            // date_created
            $this->date_created->HrefValue = "";

            // date_updated
            $this->date_updated->HrefValue = "";

            // Week
            $this->Week->HrefValue = "";

            // store_code
            $this->store_code->HrefValue = "";
        } else {
            if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
            } else {
            }

            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->id->ViewCustomAttributes = "";

            // box_id
            $this->box_id->ViewValue = $this->box_id->CurrentValue;
            $this->box_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->box_id->ViewCustomAttributes = "";

            // date_delivery
            $this->date_delivery->ViewValue = $this->date_delivery->CurrentValue;
            $this->date_delivery->ViewValue = FormatDateTime($this->date_delivery->ViewValue, $this->date_delivery->formatPattern());
            $this->date_delivery->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->date_delivery->ViewCustomAttributes = "";

            // box_type
            $this->box_type->ViewValue = $this->box_type->CurrentValue;
            $this->box_type->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->box_type->ViewCustomAttributes = "";

            // check_by
            $this->check_by->ViewValue = $this->check_by->CurrentValue;
            $this->check_by->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->check_by->ViewCustomAttributes = "";

            // quantity
            $this->quantity->ViewValue = $this->quantity->CurrentValue;
            $this->quantity->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->quantity->ViewCustomAttributes = "";

            // concept
            $this->concept->ViewValue = $this->concept->CurrentValue;
            $this->concept->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->concept->ViewCustomAttributes = "";

            // store_name
            $this->store_name->ViewValue = $this->store_name->CurrentValue;
            $this->store_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->store_name->ViewCustomAttributes = "";

            // remark
            $this->remark->ViewValue = $this->remark->CurrentValue;
            $this->remark->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->remark->ViewCustomAttributes = "";

            // no_delivery
            $this->no_delivery->ViewValue = $this->no_delivery->CurrentValue;
            $this->no_delivery->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->no_delivery->ViewCustomAttributes = "";

            // truck_type
            $this->truck_type->ViewValue = $this->truck_type->CurrentValue;
            $this->truck_type->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->truck_type->ViewCustomAttributes = "";

            // seal_no
            $this->seal_no->ViewValue = $this->seal_no->CurrentValue;
            $this->seal_no->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->seal_no->ViewCustomAttributes = "";

            // truck_plate
            $this->truck_plate->ViewValue = $this->truck_plate->CurrentValue;
            $this->truck_plate->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->truck_plate->ViewCustomAttributes = "";

            // transporter
            $this->transporter->ViewValue = $this->transporter->CurrentValue;
            $this->transporter->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->transporter->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->no_hp->ViewCustomAttributes = "";

            // checker
            $this->checker->ViewValue = $this->checker->CurrentValue;
            $this->checker->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->checker->ViewCustomAttributes = "";

            // admin
            $this->admin->ViewValue = $this->admin->CurrentValue;
            $this->admin->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->admin->ViewCustomAttributes = "";

            // remarks_box
            $this->remarks_box->ViewValue = $this->remarks_box->CurrentValue;
            $this->remarks_box->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->remarks_box->ViewCustomAttributes = "";

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
            $this->date_created->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->date_created->ViewCustomAttributes = "";

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
            $this->date_updated->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->date_updated->ViewCustomAttributes = "";

            // Week
            $this->Week->ViewValue = $this->Week->CurrentValue;
            $this->Week->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->Week->ViewCustomAttributes = "";

            // store_code
            $this->store_code->ViewValue = $this->store_code->CurrentValue;
            $this->store_code->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");
            $this->store_code->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // box_id
            $this->box_id->LinkCustomAttributes = "";
            $this->box_id->HrefValue = "";
            $this->box_id->TooltipValue = "";

            // date_delivery
            $this->date_delivery->LinkCustomAttributes = "";
            $this->date_delivery->HrefValue = "";
            $this->date_delivery->TooltipValue = "";

            // box_type
            $this->box_type->LinkCustomAttributes = "";
            $this->box_type->HrefValue = "";
            $this->box_type->TooltipValue = "";

            // check_by
            $this->check_by->LinkCustomAttributes = "";
            $this->check_by->HrefValue = "";
            $this->check_by->TooltipValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";
            $this->quantity->TooltipValue = "";

            // concept
            $this->concept->LinkCustomAttributes = "";
            $this->concept->HrefValue = "";
            $this->concept->TooltipValue = "";

            // store_name
            $this->store_name->LinkCustomAttributes = "";
            $this->store_name->HrefValue = "";
            $this->store_name->TooltipValue = "";

            // remark
            $this->remark->LinkCustomAttributes = "";
            $this->remark->HrefValue = "";
            $this->remark->TooltipValue = "";

            // no_delivery
            $this->no_delivery->LinkCustomAttributes = "";
            $this->no_delivery->HrefValue = "";
            $this->no_delivery->TooltipValue = "";

            // truck_type
            $this->truck_type->LinkCustomAttributes = "";
            $this->truck_type->HrefValue = "";
            $this->truck_type->TooltipValue = "";

            // seal_no
            $this->seal_no->LinkCustomAttributes = "";
            $this->seal_no->HrefValue = "";
            $this->seal_no->TooltipValue = "";

            // truck_plate
            $this->truck_plate->LinkCustomAttributes = "";
            $this->truck_plate->HrefValue = "";
            $this->truck_plate->TooltipValue = "";

            // transporter
            $this->transporter->LinkCustomAttributes = "";
            $this->transporter->HrefValue = "";
            $this->transporter->TooltipValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";
            $this->no_hp->TooltipValue = "";

            // checker
            $this->checker->LinkCustomAttributes = "";
            $this->checker->HrefValue = "";
            $this->checker->TooltipValue = "";

            // admin
            $this->admin->LinkCustomAttributes = "";
            $this->admin->HrefValue = "";
            $this->admin->TooltipValue = "";

            // remarks_box
            $this->remarks_box->LinkCustomAttributes = "";
            $this->remarks_box->HrefValue = "";
            $this->remarks_box->TooltipValue = "";

            // date_created
            $this->date_created->LinkCustomAttributes = "";
            $this->date_created->HrefValue = "";
            $this->date_created->TooltipValue = "";

            // date_updated
            $this->date_updated->LinkCustomAttributes = "";
            $this->date_updated->HrefValue = "";
            $this->date_updated->TooltipValue = "";

            // Week
            $this->Week->LinkCustomAttributes = "";
            $this->Week->HrefValue = "";
            $this->Week->TooltipValue = "";

            // store_code
            $this->store_code->LinkCustomAttributes = "";
            $this->store_code->HrefValue = "";
            $this->store_code->TooltipValue = "";
        }

        // Call Cell_Rendered event
        if ($this->RowType == ROWTYPE_TOTAL) { // Summary row
        } else {
            // id
            $currentValue = $this->id->CurrentValue;
            $viewValue = &$this->id->ViewValue;
            $viewAttrs = &$this->id->ViewAttrs;
            $cellAttrs = &$this->id->CellAttrs;
            $hrefValue = &$this->id->HrefValue;
            $linkAttrs = &$this->id->LinkAttrs;
            $this->cellRendered($this->id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // box_id
            $currentValue = $this->box_id->CurrentValue;
            $viewValue = &$this->box_id->ViewValue;
            $viewAttrs = &$this->box_id->ViewAttrs;
            $cellAttrs = &$this->box_id->CellAttrs;
            $hrefValue = &$this->box_id->HrefValue;
            $linkAttrs = &$this->box_id->LinkAttrs;
            $this->cellRendered($this->box_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // date_delivery
            $currentValue = $this->date_delivery->CurrentValue;
            $viewValue = &$this->date_delivery->ViewValue;
            $viewAttrs = &$this->date_delivery->ViewAttrs;
            $cellAttrs = &$this->date_delivery->CellAttrs;
            $hrefValue = &$this->date_delivery->HrefValue;
            $linkAttrs = &$this->date_delivery->LinkAttrs;
            $this->cellRendered($this->date_delivery, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // box_type
            $currentValue = $this->box_type->CurrentValue;
            $viewValue = &$this->box_type->ViewValue;
            $viewAttrs = &$this->box_type->ViewAttrs;
            $cellAttrs = &$this->box_type->CellAttrs;
            $hrefValue = &$this->box_type->HrefValue;
            $linkAttrs = &$this->box_type->LinkAttrs;
            $this->cellRendered($this->box_type, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // check_by
            $currentValue = $this->check_by->CurrentValue;
            $viewValue = &$this->check_by->ViewValue;
            $viewAttrs = &$this->check_by->ViewAttrs;
            $cellAttrs = &$this->check_by->CellAttrs;
            $hrefValue = &$this->check_by->HrefValue;
            $linkAttrs = &$this->check_by->LinkAttrs;
            $this->cellRendered($this->check_by, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // quantity
            $currentValue = $this->quantity->CurrentValue;
            $viewValue = &$this->quantity->ViewValue;
            $viewAttrs = &$this->quantity->ViewAttrs;
            $cellAttrs = &$this->quantity->CellAttrs;
            $hrefValue = &$this->quantity->HrefValue;
            $linkAttrs = &$this->quantity->LinkAttrs;
            $this->cellRendered($this->quantity, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // concept
            $currentValue = $this->concept->CurrentValue;
            $viewValue = &$this->concept->ViewValue;
            $viewAttrs = &$this->concept->ViewAttrs;
            $cellAttrs = &$this->concept->CellAttrs;
            $hrefValue = &$this->concept->HrefValue;
            $linkAttrs = &$this->concept->LinkAttrs;
            $this->cellRendered($this->concept, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // store_name
            $currentValue = $this->store_name->CurrentValue;
            $viewValue = &$this->store_name->ViewValue;
            $viewAttrs = &$this->store_name->ViewAttrs;
            $cellAttrs = &$this->store_name->CellAttrs;
            $hrefValue = &$this->store_name->HrefValue;
            $linkAttrs = &$this->store_name->LinkAttrs;
            $this->cellRendered($this->store_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // remark
            $currentValue = $this->remark->CurrentValue;
            $viewValue = &$this->remark->ViewValue;
            $viewAttrs = &$this->remark->ViewAttrs;
            $cellAttrs = &$this->remark->CellAttrs;
            $hrefValue = &$this->remark->HrefValue;
            $linkAttrs = &$this->remark->LinkAttrs;
            $this->cellRendered($this->remark, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // no_delivery
            $currentValue = $this->no_delivery->CurrentValue;
            $viewValue = &$this->no_delivery->ViewValue;
            $viewAttrs = &$this->no_delivery->ViewAttrs;
            $cellAttrs = &$this->no_delivery->CellAttrs;
            $hrefValue = &$this->no_delivery->HrefValue;
            $linkAttrs = &$this->no_delivery->LinkAttrs;
            $this->cellRendered($this->no_delivery, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // truck_type
            $currentValue = $this->truck_type->CurrentValue;
            $viewValue = &$this->truck_type->ViewValue;
            $viewAttrs = &$this->truck_type->ViewAttrs;
            $cellAttrs = &$this->truck_type->CellAttrs;
            $hrefValue = &$this->truck_type->HrefValue;
            $linkAttrs = &$this->truck_type->LinkAttrs;
            $this->cellRendered($this->truck_type, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // seal_no
            $currentValue = $this->seal_no->CurrentValue;
            $viewValue = &$this->seal_no->ViewValue;
            $viewAttrs = &$this->seal_no->ViewAttrs;
            $cellAttrs = &$this->seal_no->CellAttrs;
            $hrefValue = &$this->seal_no->HrefValue;
            $linkAttrs = &$this->seal_no->LinkAttrs;
            $this->cellRendered($this->seal_no, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // truck_plate
            $currentValue = $this->truck_plate->CurrentValue;
            $viewValue = &$this->truck_plate->ViewValue;
            $viewAttrs = &$this->truck_plate->ViewAttrs;
            $cellAttrs = &$this->truck_plate->CellAttrs;
            $hrefValue = &$this->truck_plate->HrefValue;
            $linkAttrs = &$this->truck_plate->LinkAttrs;
            $this->cellRendered($this->truck_plate, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // transporter
            $currentValue = $this->transporter->CurrentValue;
            $viewValue = &$this->transporter->ViewValue;
            $viewAttrs = &$this->transporter->ViewAttrs;
            $cellAttrs = &$this->transporter->CellAttrs;
            $hrefValue = &$this->transporter->HrefValue;
            $linkAttrs = &$this->transporter->LinkAttrs;
            $this->cellRendered($this->transporter, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // no_hp
            $currentValue = $this->no_hp->CurrentValue;
            $viewValue = &$this->no_hp->ViewValue;
            $viewAttrs = &$this->no_hp->ViewAttrs;
            $cellAttrs = &$this->no_hp->CellAttrs;
            $hrefValue = &$this->no_hp->HrefValue;
            $linkAttrs = &$this->no_hp->LinkAttrs;
            $this->cellRendered($this->no_hp, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // checker
            $currentValue = $this->checker->CurrentValue;
            $viewValue = &$this->checker->ViewValue;
            $viewAttrs = &$this->checker->ViewAttrs;
            $cellAttrs = &$this->checker->CellAttrs;
            $hrefValue = &$this->checker->HrefValue;
            $linkAttrs = &$this->checker->LinkAttrs;
            $this->cellRendered($this->checker, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // admin
            $currentValue = $this->admin->CurrentValue;
            $viewValue = &$this->admin->ViewValue;
            $viewAttrs = &$this->admin->ViewAttrs;
            $cellAttrs = &$this->admin->CellAttrs;
            $hrefValue = &$this->admin->HrefValue;
            $linkAttrs = &$this->admin->LinkAttrs;
            $this->cellRendered($this->admin, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // remarks_box
            $currentValue = $this->remarks_box->CurrentValue;
            $viewValue = &$this->remarks_box->ViewValue;
            $viewAttrs = &$this->remarks_box->ViewAttrs;
            $cellAttrs = &$this->remarks_box->CellAttrs;
            $hrefValue = &$this->remarks_box->HrefValue;
            $linkAttrs = &$this->remarks_box->LinkAttrs;
            $this->cellRendered($this->remarks_box, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // date_created
            $currentValue = $this->date_created->CurrentValue;
            $viewValue = &$this->date_created->ViewValue;
            $viewAttrs = &$this->date_created->ViewAttrs;
            $cellAttrs = &$this->date_created->CellAttrs;
            $hrefValue = &$this->date_created->HrefValue;
            $linkAttrs = &$this->date_created->LinkAttrs;
            $this->cellRendered($this->date_created, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // date_updated
            $currentValue = $this->date_updated->CurrentValue;
            $viewValue = &$this->date_updated->ViewValue;
            $viewAttrs = &$this->date_updated->ViewAttrs;
            $cellAttrs = &$this->date_updated->CellAttrs;
            $hrefValue = &$this->date_updated->HrefValue;
            $linkAttrs = &$this->date_updated->LinkAttrs;
            $this->cellRendered($this->date_updated, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // Week
            $currentValue = $this->Week->CurrentValue;
            $viewValue = &$this->Week->ViewValue;
            $viewAttrs = &$this->Week->ViewAttrs;
            $cellAttrs = &$this->Week->CellAttrs;
            $hrefValue = &$this->Week->HrefValue;
            $linkAttrs = &$this->Week->LinkAttrs;
            $this->cellRendered($this->Week, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // store_code
            $currentValue = $this->store_code->CurrentValue;
            $viewValue = &$this->store_code->ViewValue;
            $viewAttrs = &$this->store_code->ViewAttrs;
            $cellAttrs = &$this->store_code->CellAttrs;
            $hrefValue = &$this->store_code->HrefValue;
            $linkAttrs = &$this->store_code->LinkAttrs;
            $this->cellRendered($this->store_code, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
        }

        // Call Row_Rendered event
        $this->rowRendered();
        $this->setupFieldCount();
    }
    private $groupCounts = [];

    // Get group count
    public function getGroupCount(...$args)
    {
        $key = "";
        foreach ($args as $arg) {
            if ($key != "") {
                $key .= "_";
            }
            $key .= strval($arg);
        }
        if ($key == "") {
            return -1;
        } elseif ($key == "0") { // Number of first level groups
            $i = 1;
            while (isset($this->groupCounts[strval($i)])) {
                $i++;
            }
            return $i - 1;
        }
        return isset($this->groupCounts[$key]) ? $this->groupCounts[$key] : -1;
    }

    // Set group count
    public function setGroupCount($value, ...$args)
    {
        $key = "";
        foreach ($args as $arg) {
            if ($key != "") {
                $key .= "_";
            }
            $key .= strval($arg);
        }
        if ($key == "") {
            return;
        }
        $this->groupCounts[$key] = $value;
    }

    // Setup field count
    protected function setupFieldCount()
    {
        $this->GroupColumnCount = 0;
        $this->SubGroupColumnCount = 0;
        $this->DetailColumnCount = 0;
        if ($this->id->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->box_id->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->date_delivery->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->box_type->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->check_by->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->quantity->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->concept->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->store_name->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->remark->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->no_delivery->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->truck_type->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->seal_no->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->truck_plate->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->transporter->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->no_hp->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->checker->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->admin->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->remarks_box->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->date_created->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->date_updated->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->Week->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->store_code->Visible) {
            $this->DetailColumnCount += 1;
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl(false);
        $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        if (SameText($type, "excel")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", true)) . '" data-ew-action="export-charts" data-url="' . $exportUrl . '" data-exportid="' . session_id() . '">' . $Language->phrase("ExportToExcel") . '</button>';
        } elseif (SameText($type, "word")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", true)) . '" data-ew-action="export-charts" data-url="' . $exportUrl . '" data-exportid="' . session_id() . '">' . $Language->phrase("ExportToWord") . '</button>';
        } elseif (SameText($type, "pdf")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPdf", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPdf", true)) . '" data-ew-action="export-charts" data-url="' . $exportUrl . '" data-exportid="' . session_id() . '">' . $Language->phrase("ExportToPdf") . '</button>';
        } elseif (SameText($type, "email")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" data-ew-action="email" data-hdr="' . HtmlEncode($Language->phrase("ExportToEmailText")) . '" data-url="' . $exportUrl . '" data-exportid="' . session_id() . '">' . $Language->phrase("ExportToEmail") . '</button>';
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

        // Hide options for export
        if ($this->isExport()) {
            $this->ExportOptions->hideAllOptions();
        }
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl(false);
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

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
        return $this->id->Visible || $this->box_id->Visible || $this->date_delivery->Visible || $this->box_type->Visible || $this->check_by->Visible || $this->quantity->Visible || $this->concept->Visible || $this->store_name->Visible || $this->remark->Visible || $this->no_delivery->Visible || $this->truck_type->Visible || $this->seal_no->Visible || $this->truck_plate->Visible || $this->transporter->Visible || $this->no_hp->Visible || $this->checker->Visible || $this->admin->Visible || $this->remarks_box->Visible || $this->date_created->Visible || $this->date_updated->Visible;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, true);
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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fOutboundsrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fOutboundsrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up starting group
    protected function setupStartGroup()
    {
        // Exit if no groups
        if ($this->DisplayGroups == 0) {
            return;
        }
        $startGrp = Param(Config("TABLE_START_GROUP"));
        $pageNo = Param(Config("TABLE_PAGE_NO"));

        // Check for a 'start' parameter
        if ($startGrp !== null) {
            $this->StartGroup = $startGrp;
            $this->setStartGroup($this->StartGroup);
        } elseif ($pageNo !== null) {
            $pageNo = ParseInteger($pageNo);
            if (is_numeric($pageNo)) {
                $this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
                if ($this->StartGroup <= 0) {
                    $this->StartGroup = 1;
                } elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
                    $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
                }
                $this->setStartGroup($this->StartGroup);
            } else {
                $this->StartGroup = $this->getStartGroup();
            }
        } else {
            $this->StartGroup = $this->getStartGroup();
        }

        // Check if correct start group counter
        if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
            $this->StartGroup = 1; // Reset start group counter
            $this->setStartGroup($this->StartGroup);
        } elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
            $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
            $this->setStartGroup($this->StartGroup);
        } elseif (($this->StartGroup - 1) % $this->DisplayGroups != 0) {
            $this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
            $this->setStartGroup($this->StartGroup);
        }
    }

    // Reset pager
    protected function resetPager()
    {
        // Reset start position (reset command)
        $this->StartGroup = 1;
        $this->setStartGroup($this->StartGroup);
    }

    // Set up number of groups displayed per page
    protected function setupDisplayGroups()
    {
        if (Param(Config("TABLE_GROUP_PER_PAGE")) !== null) {
            $wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
            if (is_numeric($wrk)) {
                $this->DisplayGroups = intval($wrk);
            } else {
                if (strtoupper($wrk) == "ALL") { // Display all groups
                    $this->DisplayGroups = -1;
                } else {
                    $this->DisplayGroups = 3; // Non-numeric, load default
                }
            }
            $this->setGroupPerPage($this->DisplayGroups); // Save to session

            // Reset start position (reset command)
            $this->StartGroup = 1;
            $this->setStartGroup($this->StartGroup);
        } else {
            if ($this->getGroupPerPage() != "") {
                $this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
            } else {
                $this->DisplayGroups = 3; // Load default
            }
        }
    }

    // Get sort parameters based on sort links clicked
    protected function getSort()
    {
        if ($this->DrillDown) {
            return "`date_delivery` DESC,`box_id` ASC";
        }
        $resetSort = Param("cmd") === "resetsort";
        $orderBy = Param("order", "");
        $orderType = Param("ordertype", "");

        // Check for a resetsort command
        if ($resetSort) {
            $this->setOrderBy("");
            $this->setStartGroup(1);
            $this->id->setSort("");
            $this->box_id->setSort("");
            $this->date_delivery->setSort("");
            $this->box_type->setSort("");
            $this->check_by->setSort("");
            $this->quantity->setSort("");
            $this->concept->setSort("");
            $this->store_name->setSort("");
            $this->remark->setSort("");
            $this->no_delivery->setSort("");
            $this->truck_type->setSort("");
            $this->seal_no->setSort("");
            $this->truck_plate->setSort("");
            $this->transporter->setSort("");
            $this->no_hp->setSort("");
            $this->checker->setSort("");
            $this->admin->setSort("");
            $this->remarks_box->setSort("");
            $this->date_created->setSort("");
            $this->date_updated->setSort("");
            $this->Week->setSort("");
            $this->store_code->setSort("");

        // Check for an Order parameter
        } elseif ($orderBy != "") {
            $this->CurrentOrder = $orderBy;
            $this->CurrentOrderType = $orderType;
            $this->updateSort($this->id); // id
            $this->updateSort($this->box_id); // box_id
            $this->updateSort($this->date_delivery); // date_delivery
            $this->updateSort($this->box_type); // box_type
            $this->updateSort($this->check_by); // check_by
            $this->updateSort($this->quantity); // quantity
            $this->updateSort($this->concept); // concept
            $this->updateSort($this->store_name); // store_name
            $this->updateSort($this->remark); // remark
            $this->updateSort($this->no_delivery); // no_delivery
            $this->updateSort($this->truck_type); // truck_type
            $this->updateSort($this->seal_no); // seal_no
            $this->updateSort($this->truck_plate); // truck_plate
            $this->updateSort($this->transporter); // transporter
            $this->updateSort($this->no_hp); // no_hp
            $this->updateSort($this->checker); // checker
            $this->updateSort($this->admin); // admin
            $this->updateSort($this->remarks_box); // remarks_box
            $this->updateSort($this->date_created); // date_created
            $this->updateSort($this->date_updated); // date_updated
            $this->updateSort($this->Week); // Week
            $this->updateSort($this->store_code); // store_code
            $sortSql = $this->sortSql();
            $this->setOrderBy($sortSql);
            $this->setStartGroup(1);
        }

        // Set up default sort
        if ($this->getOrderBy() == "") {
            $useDefaultSort = true;
            if ($this->date_delivery->getSort() != "") {
                $useDefaultSort = false;
            }
            if ($this->box_id->getSort() != "") {
                $useDefaultSort = false;
            }
            if ($useDefaultSort) {
                $this->date_delivery->setSort("DESC");
                $this->box_id->setSort("ASC");
                $this->setOrderBy("`date_delivery` DESC,`box_id` ASC");
            }
        }
        return $this->getOrderBy();
    }

    // Return extended filter
    protected function getExtendedFilter()
    {
        $filter = "";
        if ($this->DrillDown) {
            return "";
        }
        $restoreSession = false;
        $restoreDefault = false;
        // Reset search command
        if (Get("cmd", "") == "reset") {
            // Set default values
            $this->id->AdvancedSearch->unsetSession();
            $this->box_id->AdvancedSearch->unsetSession();
            $this->date_delivery->AdvancedSearch->unsetSession();
            $this->box_type->AdvancedSearch->unsetSession();
            $this->check_by->AdvancedSearch->unsetSession();
            $this->quantity->AdvancedSearch->unsetSession();
            $this->concept->AdvancedSearch->unsetSession();
            $this->store_name->AdvancedSearch->unsetSession();
            $this->remark->AdvancedSearch->unsetSession();
            $this->no_delivery->AdvancedSearch->unsetSession();
            $this->truck_type->AdvancedSearch->unsetSession();
            $this->seal_no->AdvancedSearch->unsetSession();
            $this->truck_plate->AdvancedSearch->unsetSession();
            $this->transporter->AdvancedSearch->unsetSession();
            $this->no_hp->AdvancedSearch->unsetSession();
            $this->checker->AdvancedSearch->unsetSession();
            $this->admin->AdvancedSearch->unsetSession();
            $this->remarks_box->AdvancedSearch->unsetSession();
            $this->date_created->AdvancedSearch->unsetSession();
            $this->date_updated->AdvancedSearch->unsetSession();
            $restoreDefault = true;
        } else {
            $restoreSession = !$this->SearchCommand;

            // Field id
            $this->getDropDownValue($this->id);

            // Field box_id
            $this->getDropDownValue($this->box_id);

            // Field date_delivery
            $this->getDropDownValue($this->date_delivery);

            // Field box_type
            $this->getDropDownValue($this->box_type);

            // Field check_by
            $this->getDropDownValue($this->check_by);

            // Field quantity
            $this->getDropDownValue($this->quantity);

            // Field concept
            $this->getDropDownValue($this->concept);

            // Field store_name
            $this->getDropDownValue($this->store_name);

            // Field remark
            $this->getDropDownValue($this->remark);

            // Field no_delivery
            $this->getDropDownValue($this->no_delivery);

            // Field truck_type
            $this->getDropDownValue($this->truck_type);

            // Field seal_no
            $this->getDropDownValue($this->seal_no);

            // Field truck_plate
            $this->getDropDownValue($this->truck_plate);

            // Field transporter
            $this->getDropDownValue($this->transporter);

            // Field no_hp
            $this->getDropDownValue($this->no_hp);

            // Field checker
            $this->getDropDownValue($this->checker);

            // Field admin
            $this->getDropDownValue($this->admin);

            // Field remarks_box
            $this->getDropDownValue($this->remarks_box);

            // Field date_created
            $this->getDropDownValue($this->date_created);

            // Field date_updated
            $this->getDropDownValue($this->date_updated);
            if (!$this->validateForm()) {
                return $filter;
            }
        }

        // Restore session
        if ($restoreSession) {
            $restoreDefault = true;
            if ($this->id->AdvancedSearch->issetSession()) { // Field id
                $this->id->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->box_id->AdvancedSearch->issetSession()) { // Field box_id
                $this->box_id->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->date_delivery->AdvancedSearch->issetSession()) { // Field date_delivery
                $this->date_delivery->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->box_type->AdvancedSearch->issetSession()) { // Field box_type
                $this->box_type->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->check_by->AdvancedSearch->issetSession()) { // Field check_by
                $this->check_by->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->quantity->AdvancedSearch->issetSession()) { // Field quantity
                $this->quantity->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->concept->AdvancedSearch->issetSession()) { // Field concept
                $this->concept->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->store_name->AdvancedSearch->issetSession()) { // Field store_name
                $this->store_name->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->remark->AdvancedSearch->issetSession()) { // Field remark
                $this->remark->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->no_delivery->AdvancedSearch->issetSession()) { // Field no_delivery
                $this->no_delivery->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->truck_type->AdvancedSearch->issetSession()) { // Field truck_type
                $this->truck_type->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->seal_no->AdvancedSearch->issetSession()) { // Field seal_no
                $this->seal_no->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->truck_plate->AdvancedSearch->issetSession()) { // Field truck_plate
                $this->truck_plate->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->transporter->AdvancedSearch->issetSession()) { // Field transporter
                $this->transporter->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->no_hp->AdvancedSearch->issetSession()) { // Field no_hp
                $this->no_hp->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->checker->AdvancedSearch->issetSession()) { // Field checker
                $this->checker->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->admin->AdvancedSearch->issetSession()) { // Field admin
                $this->admin->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->remarks_box->AdvancedSearch->issetSession()) { // Field remarks_box
                $this->remarks_box->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->date_created->AdvancedSearch->issetSession()) { // Field date_created
                $this->date_created->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->date_updated->AdvancedSearch->issetSession()) { // Field date_updated
                $this->date_updated->AdvancedSearch->load();
                $restoreDefault = false;
            }
        }

        // Restore default
        if ($restoreDefault) {
            $this->loadDefaultFilters();
        }

        // Call page filter validated event
        $this->pageFilterValidated();

        // Build SQL and save to session
        $this->buildDropDownFilter($this->id, $filter, false, true); // Field id
        $this->id->AdvancedSearch->save();
        $this->buildDropDownFilter($this->box_id, $filter, false, true); // Field box_id
        $this->box_id->AdvancedSearch->save();
        $this->buildDropDownFilter($this->date_delivery, $filter, false, true); // Field date_delivery
        $this->date_delivery->AdvancedSearch->save();
        $this->buildDropDownFilter($this->box_type, $filter, false, true); // Field box_type
        $this->box_type->AdvancedSearch->save();
        $this->buildDropDownFilter($this->check_by, $filter, false, true); // Field check_by
        $this->check_by->AdvancedSearch->save();
        $this->buildDropDownFilter($this->quantity, $filter, false, true); // Field quantity
        $this->quantity->AdvancedSearch->save();
        $this->buildDropDownFilter($this->concept, $filter, false, true); // Field concept
        $this->concept->AdvancedSearch->save();
        $this->buildDropDownFilter($this->store_name, $filter, false, true); // Field store_name
        $this->store_name->AdvancedSearch->save();
        $this->buildDropDownFilter($this->remark, $filter, false, true); // Field remark
        $this->remark->AdvancedSearch->save();
        $this->buildDropDownFilter($this->no_delivery, $filter, false, true); // Field no_delivery
        $this->no_delivery->AdvancedSearch->save();
        $this->buildDropDownFilter($this->truck_type, $filter, false, true); // Field truck_type
        $this->truck_type->AdvancedSearch->save();
        $this->buildDropDownFilter($this->seal_no, $filter, false, true); // Field seal_no
        $this->seal_no->AdvancedSearch->save();
        $this->buildDropDownFilter($this->truck_plate, $filter, false, true); // Field truck_plate
        $this->truck_plate->AdvancedSearch->save();
        $this->buildDropDownFilter($this->transporter, $filter, false, true); // Field transporter
        $this->transporter->AdvancedSearch->save();
        $this->buildDropDownFilter($this->no_hp, $filter, false, true); // Field no_hp
        $this->no_hp->AdvancedSearch->save();
        $this->buildDropDownFilter($this->checker, $filter, false, true); // Field checker
        $this->checker->AdvancedSearch->save();
        $this->buildDropDownFilter($this->admin, $filter, false, true); // Field admin
        $this->admin->AdvancedSearch->save();
        $this->buildDropDownFilter($this->remarks_box, $filter, false, true); // Field remarks_box
        $this->remarks_box->AdvancedSearch->save();
        $this->buildDropDownFilter($this->date_created, $filter, false, true); // Field date_created
        $this->date_created->AdvancedSearch->save();
        $this->buildDropDownFilter($this->date_updated, $filter, false, true); // Field date_updated
        $this->date_updated->AdvancedSearch->save();
        return $filter;
    }

    // Build dropdown filter
    protected function buildDropDownFilter(&$fld, &$filterClause, $default = false, $saveFilter = false)
    {
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        if (!EmptyValue($fld->DateFilter)) {
            $fldOpr = $fld->DateFilter;
            $fldVal2 = "";
        } elseif ($fld->UseFilter) {
            $fldOpr = "";
            $fldVal2 = "";
        }
        $sql = "";
        if (is_array($fldVal)) {
            foreach ($fldVal as $val) {
                $wrk = $this->getDropDownFilter($fld, $val, $fldOpr);
                if ($wrk != "") {
                    if ($sql != "") {
                        $sql .= " OR " . $wrk;
                    } else {
                        $sql = $wrk;
                    }
                }
            }
        } else {
            $sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr, $fldVal2);
        }
        if ($sql != "") {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
            AddFilter($filterClause, $sql, $cond);
            if ($saveFilter) {
                $fld->CurrentFilter = $sql;
            }
        }
    }

    // Get dropdown filter
    protected function getDropDownFilter(&$fld, $fldVal, $fldOpr, $fldVal2 = "")
    {
        $fldName = $fld->Name;
        $fldExpression = $fld->Expression;
        $fldDataType = $fld->DataType;
        $isMultiple = $fld->HtmlTag == "CHECKBOX" || $fld->HtmlTag == "SELECT" && $fld->SelectMultiple || $fld->UseFilter;
        $fldVal = strval($fldVal);
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $wrk = "";
        if (SameString($fldVal, Config("NULL_VALUE"))) {
            $wrk = $fldExpression . " IS NULL";
        } elseif (SameString($fldVal, Config("NOT_NULL_VALUE"))) {
            $wrk = $fldExpression . " IS NOT NULL";
        } elseif (SameString($fldVal, Config("EMPTY_VALUE"))) {
            $wrk = $fldExpression . " = ''";
        } elseif (SameString($fldVal, Config("ALL_VALUE"))) {
            $wrk = "1 = 1";
        } else {
            if ($fld->GroupSql != "") { // Use grouping SQL for search if exists
                $fldExpression = str_replace("%s", $fldExpression, $fld->GroupSql);
            }
            if (StartsString("@@", $fldVal)) {
                $wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
            } elseif ($isMultiple && IsMultiSearchOperator($fldOpr) && trim($fldVal) != "" && $fldVal != Config("INIT_VALUE")) {
                $wrk = GetMultiSearchSql($fld, $fldOpr, trim($fldVal), $this->Dbid);
            } elseif ($fldOpr == "BETWEEN" && !EmptyValue($fldVal) && $fldVal != Config("INIT_VALUE") && !EmptyValue($fldVal2) && $fldVal2 != Config("INIT_VALUE")) {
                $wrk = $fldExpression ." " . $fldOpr . " " . QuotedValue($fldVal, $fldDataType, $this->Dbid) . " AND " . QuotedValue($fldVal2, $fldDataType, $this->Dbid);
            } else {
                if ($fldVal != "" && $fldVal != Config("INIT_VALUE")) {
                    if ($fldDataType == DATATYPE_DATE && $fldOpr != "") {
                        $wrk = GetDateFilterSql($fld->Expression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
                    } else {
                        $wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
                        if ($wrk != "") {
                            $wrk = $fldExpression . $wrk;
                        }
                    }
                }
            }
        }

        // Call Page Filtering event
        if (!StartsString("@@", $fldVal)) {
            $this->pageFiltering($fld, $wrk, "dropdown", $fldOpr, $fldVal, "", "", $fldVal2);
        }
        return $wrk;
    }

    // Get custom filter
    protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
    {
        $wrk = "";
        if (is_array($fld->AdvancedFilters)) {
            foreach ($fld->AdvancedFilters as $filter) {
                if ($filter->ID == $fldVal && $filter->Enabled) {
                    $fldExpr = $fld->Expression;
                    $fn = $filter->FunctionName;
                    $wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
                    $fn = $fn != "" && !function_exists($fn) ? PROJECT_NAMESPACE . $fn : $fn;
                    if (function_exists($fn)) {
                        $wrk = $fn($fldExpr, $dbid);
                    } else {
                        $wrk = "";
                    }
                    $this->pageFiltering($fld, $wrk, "custom", $wrkid);
                    break;
                }
            }
        }
        return $wrk;
    }

    // Build extended filter
    protected function buildExtendedFilter(&$fld, &$filterClause, $default = false, $saveFilter = false)
    {
        $wrk = GetExtendedFilter($fld, $default, $this->Dbid);
        if (!$default) {
            $this->pageFiltering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
        }
        if ($wrk != "") {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
            AddFilter($filterClause, $wrk, $cond);
            if ($saveFilter) {
                $fld->CurrentFilter = $wrk;
            }
        }
    }

    // Get drop down value from querystring
    protected function getDropDownValue(&$fld)
    {
        if (IsPost()) {
            return false; // Skip post back
        }
        $res = false;
        $parm = $fld->Param;
        $opr = Get("z_$parm");
        if ($opr !== null) {
            $fld->AdvancedSearch->SearchOperator = $opr;
        }
        $val = Get("x_$parm");
        if ($val !== null) {
            if (is_array($val)) {
                $val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val);
            }
            $fld->AdvancedSearch->setSearchValue($val);
            $res = true;
        }
        $val2 = Get("y_$parm");
        if ($val2 !== null) {
            if (is_array($val2)) {
                $val2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val2);
            }
            $fld->AdvancedSearch->setSearchValue2($val2);
            $res = true;
        }
        return $res;
    }

    // Dropdown filter exist
    protected function dropDownFilterExist(&$fld)
    {
        $wrk = "";
        $this->buildDropDownFilter($fld, $wrk);
        return ($wrk != "");
    }

    // Extended filter exist
    protected function extendedFilterExist(&$fld)
    {
        $extWrk = "";
        $this->buildExtendedFilter($fld, $extWrk);
        return ($extWrk != "");
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Load default value for filters
    protected function loadDefaultFilters()
    {
        // Set up default values for extended filters
    }

    // Show list of filters
    public function showFilterList()
    {
        global $Language;

        // Initialize
        $filterList = "";
        $captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
        $captionSuffix = $this->isExport("email") ? ": " : "";

        // Show Filters
        if ($filterList != "") {
            $message = "<div id=\"ew-filter-list\" class=\"alert alert-info d-table\"><div id=\"ew-current-filters\">" .
                $Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
            $this->messageShowing($message, "");
            Write($message);
        }
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";

        // Return filter list in json
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd", "") != "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter", ""), true);
        return $this->setupFilterList($filter);
    }

    // Setup list of filters
    protected function setupFilterList($filter)
    {
        if (!is_array($filter)) {
            return false;
        }
        return true;
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

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content
    }

    // Load Filters event
    public function pageFilterLoad()
    {
        // Enter your code here
        // Example: Register/Unregister Custom Extended Filter
        //RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
        //RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
        //UnregisterFilter($this-><Field>, 'StartsWithA');
    }

    // Page Selecting event
    public function pageSelecting(&$filter)
    {
        // Enter your code here
    }

    // Page Filter Validated event
    public function pageFilterValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Page Filtering event
    public function pageFiltering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "")
    {
        // Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
        //if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
        //    $filter = "..."; // Modify the filter
        //if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
        //    $filter = "..."; // Modify the filter
        //if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
        //    $filter = "..."; // Modify the filter
    }

    // Cell Rendered event
    public function cellRendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs)
    {
        //$ViewValue = "xxx";
        //$ViewAttrs["class"] = "xxx";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}

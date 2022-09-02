<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PickingPendingSearch extends PickingPending
{
    use MessagesTrait;

    // Page ID
    public $PageID = "search";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'picking_pending';

    // Page object name
    public $PageObjName = "PickingPendingSearch";

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

        // Table object (picking_pending)
        if (!isset($GLOBALS["picking_pending"]) || get_class($GLOBALS["picking_pending"]) == PROJECT_NAMESPACE . "picking_pending") {
            $GLOBALS["picking_pending"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'picking_pending');
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
                $tbl = Container("picking_pending");
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
                    if ($pageName == "pickingpendingview") {
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
    public $FormClassName = "ew-form ew-search-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;

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
        $this->po_no->setVisibility();
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
        $this->aisle->setVisibility();
        $this->area->setVisibility();
        $this->aisle2->setVisibility();
        $this->store_id2->setVisibility();
        $this->scan_article->setVisibility();
        $this->close_totes->setVisibility();
        $this->job_id->setVisibility();
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
        $this->setupLookupOptions($this->box_type);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        if ($this->isPageRequest()) {
            // Get action
            $this->CurrentAction = Post("action");
            if ($this->isSearch()) {
                // Build search string for advanced search, remove blank field
                $this->loadSearchValues(); // Get search values
                if ($this->validateSearch()) {
                    $srchStr = $this->buildAdvancedSearch();
                } else {
                    $srchStr = "";
                }
                if ($srchStr != "") {
                    $srchStr = $this->getUrlParm($srchStr);
                    $srchStr = "pickingpendinglist" . "?" . $srchStr;
                    $this->terminate($srchStr); // Go to list page
                    return;
                }
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Render row for search
        $this->RowType = ROWTYPE_SEARCH;
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

    // Build advanced search
    protected function buildAdvancedSearch()
    {
        $srchUrl = "";
        $this->buildSearchUrl($srchUrl, $this->id); // id
        $this->buildSearchUrl($srchUrl, $this->po_no); // po_no
        $this->buildSearchUrl($srchUrl, $this->to_no); // to_no
        $this->buildSearchUrl($srchUrl, $this->to_order_item); // to_order_item
        $this->buildSearchUrl($srchUrl, $this->to_priority); // to_priority
        $this->buildSearchUrl($srchUrl, $this->to_priority_code); // to_priority_code
        $this->buildSearchUrl($srchUrl, $this->source_storage_type); // source_storage_type
        $this->buildSearchUrl($srchUrl, $this->source_storage_bin); // source_storage_bin
        $this->buildSearchUrl($srchUrl, $this->carton_number); // carton_number
        $this->buildSearchUrl($srchUrl, $this->creation_date); // creation_date
        $this->buildSearchUrl($srchUrl, $this->gr_number); // gr_number
        $this->buildSearchUrl($srchUrl, $this->gr_date); // gr_date
        $this->buildSearchUrl($srchUrl, $this->delivery); // delivery
        $this->buildSearchUrl($srchUrl, $this->store_id); // store_id
        $this->buildSearchUrl($srchUrl, $this->store_name); // store_name
        $this->buildSearchUrl($srchUrl, $this->article); // article
        $this->buildSearchUrl($srchUrl, $this->size_code); // size_code
        $this->buildSearchUrl($srchUrl, $this->size_desc); // size_desc
        $this->buildSearchUrl($srchUrl, $this->color_code); // color_code
        $this->buildSearchUrl($srchUrl, $this->color_desc); // color_desc
        $this->buildSearchUrl($srchUrl, $this->concept); // concept
        $this->buildSearchUrl($srchUrl, $this->target_qty); // target_qty
        $this->buildSearchUrl($srchUrl, $this->picked_qty); // picked_qty
        $this->buildSearchUrl($srchUrl, $this->variance_qty); // variance_qty
        $this->buildSearchUrl($srchUrl, $this->confirmation_date); // confirmation_date
        $this->buildSearchUrl($srchUrl, $this->confirmation_time); // confirmation_time
        $this->buildSearchUrl($srchUrl, $this->box_code); // box_code
        $this->buildSearchUrl($srchUrl, $this->box_type); // box_type
        $this->buildSearchUrl($srchUrl, $this->picker); // picker
        $this->buildSearchUrl($srchUrl, $this->status); // status
        $this->buildSearchUrl($srchUrl, $this->remarks); // remarks
        $this->buildSearchUrl($srchUrl, $this->aisle); // aisle
        $this->buildSearchUrl($srchUrl, $this->area); // area
        $this->buildSearchUrl($srchUrl, $this->aisle2); // aisle2
        $this->buildSearchUrl($srchUrl, $this->store_id2); // store_id2
        $this->buildSearchUrl($srchUrl, $this->scan_article); // scan_article
        $this->buildSearchUrl($srchUrl, $this->close_totes); // close_totes
        $this->buildSearchUrl($srchUrl, $this->job_id); // job_id
        if ($srchUrl != "") {
            $srchUrl .= "&";
        }
        $srchUrl .= "cmd=search";
        return $srchUrl;
    }

    // Build search URL
    protected function buildSearchUrl(&$url, &$fld, $oprOnly = false)
    {
        global $CurrentForm;
        $wrk = "";
        $fldParm = $fld->Param;
        $fldVal = $CurrentForm->getValue("x_$fldParm");
        $fldOpr = $CurrentForm->getValue("z_$fldParm");
        $fldCond = $CurrentForm->getValue("v_$fldParm");
        $fldVal2 = $CurrentForm->getValue("y_$fldParm");
        $fldOpr2 = $CurrentForm->getValue("w_$fldParm");
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr ?? ""));
        $fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
        if ($fldOpr == "BETWEEN") {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            }
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
            if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            } elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
                $wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
            }
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&w_" . $fldParm . "=" . urlencode($fldOpr2);
            } elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
            }
        }
        if ($wrk != "") {
            if ($url != "") {
                $url .= "&";
            }
            $url .= $wrk;
        }
    }

    // Check if search value is numeric
    protected function searchValueIsNumeric($fld, $value)
    {
        if (IsFloatFormat($fld->Type)) {
            $value = ConvertToFloatString($value);
        }
        return is_numeric($value);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // id
        if ($this->id->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // po_no
        if ($this->po_no->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // to_no
        if ($this->to_no->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // to_order_item
        if ($this->to_order_item->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // to_priority
        if ($this->to_priority->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // to_priority_code
        if ($this->to_priority_code->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // source_storage_type
        if ($this->source_storage_type->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // source_storage_bin
        if ($this->source_storage_bin->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // carton_number
        if ($this->carton_number->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // creation_date
        if ($this->creation_date->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // gr_number
        if ($this->gr_number->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // gr_date
        if ($this->gr_date->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // delivery
        if ($this->delivery->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // store_id
        if ($this->store_id->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // store_name
        if ($this->store_name->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // article
        if ($this->article->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // size_code
        if ($this->size_code->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // size_desc
        if ($this->size_desc->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // color_code
        if ($this->color_code->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // color_desc
        if ($this->color_desc->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // concept
        if ($this->concept->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // target_qty
        if ($this->target_qty->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // picked_qty
        if ($this->picked_qty->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // variance_qty
        if ($this->variance_qty->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // confirmation_date
        if ($this->confirmation_date->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // confirmation_time
        if ($this->confirmation_time->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // box_code
        if ($this->box_code->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // box_type
        if ($this->box_type->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // picker
        if ($this->picker->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // status
        if ($this->status->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // remarks
        if ($this->remarks->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // aisle
        if ($this->aisle->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // area
        if ($this->area->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // aisle2
        if ($this->aisle2->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // store_id2
        if ($this->store_id2->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // scan_article
        if ($this->scan_article->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // close_totes
        if ($this->close_totes->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // job_id
        if ($this->job_id->AdvancedSearch->get()) {
            $hasValue = true;
        }
        return $hasValue;
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

        // po_no
        $this->po_no->RowCssClass = "row";

        // to_no
        $this->to_no->RowCssClass = "row";

        // to_order_item
        $this->to_order_item->RowCssClass = "row";

        // to_priority
        $this->to_priority->RowCssClass = "row";

        // to_priority_code
        $this->to_priority_code->RowCssClass = "row";

        // source_storage_type
        $this->source_storage_type->RowCssClass = "row";

        // source_storage_bin
        $this->source_storage_bin->RowCssClass = "row";

        // carton_number
        $this->carton_number->RowCssClass = "row";

        // creation_date
        $this->creation_date->RowCssClass = "row";

        // gr_number
        $this->gr_number->RowCssClass = "row";

        // gr_date
        $this->gr_date->RowCssClass = "row";

        // delivery
        $this->delivery->RowCssClass = "row";

        // store_id
        $this->store_id->RowCssClass = "row";

        // store_name
        $this->store_name->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // size_code
        $this->size_code->RowCssClass = "row";

        // size_desc
        $this->size_desc->RowCssClass = "row";

        // color_code
        $this->color_code->RowCssClass = "row";

        // color_desc
        $this->color_desc->RowCssClass = "row";

        // concept
        $this->concept->RowCssClass = "row";

        // target_qty
        $this->target_qty->RowCssClass = "row";

        // picked_qty
        $this->picked_qty->RowCssClass = "row";

        // variance_qty
        $this->variance_qty->RowCssClass = "row";

        // confirmation_date
        $this->confirmation_date->RowCssClass = "row";

        // confirmation_time
        $this->confirmation_time->RowCssClass = "row";

        // box_code
        $this->box_code->RowCssClass = "row";

        // box_type
        $this->box_type->RowCssClass = "row";

        // picker
        $this->picker->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // remarks
        $this->remarks->RowCssClass = "row";

        // aisle
        $this->aisle->RowCssClass = "row";

        // area
        $this->area->RowCssClass = "row";

        // aisle2
        $this->aisle2->RowCssClass = "row";

        // store_id2
        $this->store_id2->RowCssClass = "row";

        // scan_article
        $this->scan_article->RowCssClass = "row";

        // close_totes
        $this->close_totes->RowCssClass = "row";

        // job_id
        $this->job_id->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
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
            if (strval($this->box_type->CurrentValue) != "") {
                $this->box_type->ViewValue = $this->box_type->optionCaption($this->box_type->CurrentValue);
            } else {
                $this->box_type->ViewValue = null;
            }
            $this->box_type->ViewCustomAttributes = "";

            // picker
            $this->picker->ViewValue = $this->picker->CurrentValue;
            $this->picker->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // remarks
            $this->remarks->ViewValue = $this->remarks->CurrentValue;
            $this->remarks->ViewCustomAttributes = "";

            // aisle
            $this->aisle->ViewValue = $this->aisle->CurrentValue;
            $this->aisle->ViewCustomAttributes = "";

            // area
            $this->area->ViewValue = $this->area->CurrentValue;
            $this->area->ViewCustomAttributes = "";

            // aisle2
            $this->aisle2->ViewValue = $this->aisle2->CurrentValue;
            $this->aisle2->ViewCustomAttributes = "";

            // store_id2
            $this->store_id2->ViewValue = $this->store_id2->CurrentValue;
            $this->store_id2->ViewCustomAttributes = "";

            // scan_article
            $this->scan_article->ViewValue = $this->scan_article->CurrentValue;
            $this->scan_article->ViewCustomAttributes = "";

            // close_totes
            $this->close_totes->ViewValue = $this->close_totes->CurrentValue;
            $this->close_totes->ViewCustomAttributes = "";

            // job_id
            $this->job_id->ViewValue = $this->job_id->CurrentValue;
            $this->job_id->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // po_no
            $this->po_no->LinkCustomAttributes = "";
            $this->po_no->HrefValue = "";
            $this->po_no->TooltipValue = "";

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

            // aisle
            $this->aisle->LinkCustomAttributes = "";
            $this->aisle->HrefValue = "";
            $this->aisle->TooltipValue = "";

            // area
            $this->area->LinkCustomAttributes = "";
            $this->area->HrefValue = "";
            $this->area->TooltipValue = "";

            // aisle2
            $this->aisle2->LinkCustomAttributes = "";
            $this->aisle2->HrefValue = "";
            $this->aisle2->TooltipValue = "";

            // store_id2
            $this->store_id2->LinkCustomAttributes = "";
            $this->store_id2->HrefValue = "";
            $this->store_id2->TooltipValue = "";

            // scan_article
            $this->scan_article->LinkCustomAttributes = "";
            $this->scan_article->HrefValue = "";
            $this->scan_article->TooltipValue = "";

            // close_totes
            $this->close_totes->LinkCustomAttributes = "";
            $this->close_totes->HrefValue = "";
            $this->close_totes->TooltipValue = "";

            // job_id
            $this->job_id->LinkCustomAttributes = "";
            $this->job_id->HrefValue = "";
            $this->job_id->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());

            // po_no
            $this->po_no->setupEditAttributes();
            $this->po_no->EditCustomAttributes = "";
            if (!$this->po_no->Raw) {
                $this->po_no->AdvancedSearch->SearchValue = HtmlDecode($this->po_no->AdvancedSearch->SearchValue);
            }
            $this->po_no->EditValue = HtmlEncode($this->po_no->AdvancedSearch->SearchValue);
            $this->po_no->PlaceHolder = RemoveHtml($this->po_no->caption());

            // to_no
            $this->to_no->setupEditAttributes();
            $this->to_no->EditCustomAttributes = "";
            if (!$this->to_no->Raw) {
                $this->to_no->AdvancedSearch->SearchValue = HtmlDecode($this->to_no->AdvancedSearch->SearchValue);
            }
            $this->to_no->EditValue = HtmlEncode($this->to_no->AdvancedSearch->SearchValue);
            $this->to_no->PlaceHolder = RemoveHtml($this->to_no->caption());

            // to_order_item
            $this->to_order_item->setupEditAttributes();
            $this->to_order_item->EditCustomAttributes = "";
            if (!$this->to_order_item->Raw) {
                $this->to_order_item->AdvancedSearch->SearchValue = HtmlDecode($this->to_order_item->AdvancedSearch->SearchValue);
            }
            $this->to_order_item->EditValue = HtmlEncode($this->to_order_item->AdvancedSearch->SearchValue);
            $this->to_order_item->PlaceHolder = RemoveHtml($this->to_order_item->caption());

            // to_priority
            $this->to_priority->setupEditAttributes();
            $this->to_priority->EditCustomAttributes = "";
            if (!$this->to_priority->Raw) {
                $this->to_priority->AdvancedSearch->SearchValue = HtmlDecode($this->to_priority->AdvancedSearch->SearchValue);
            }
            $this->to_priority->EditValue = HtmlEncode($this->to_priority->AdvancedSearch->SearchValue);
            $this->to_priority->PlaceHolder = RemoveHtml($this->to_priority->caption());

            // to_priority_code
            $this->to_priority_code->setupEditAttributes();
            $this->to_priority_code->EditCustomAttributes = "";
            if (!$this->to_priority_code->Raw) {
                $this->to_priority_code->AdvancedSearch->SearchValue = HtmlDecode($this->to_priority_code->AdvancedSearch->SearchValue);
            }
            $this->to_priority_code->EditValue = HtmlEncode($this->to_priority_code->AdvancedSearch->SearchValue);
            $this->to_priority_code->PlaceHolder = RemoveHtml($this->to_priority_code->caption());

            // source_storage_type
            $this->source_storage_type->setupEditAttributes();
            $this->source_storage_type->EditCustomAttributes = "";
            if (!$this->source_storage_type->Raw) {
                $this->source_storage_type->AdvancedSearch->SearchValue = HtmlDecode($this->source_storage_type->AdvancedSearch->SearchValue);
            }
            $this->source_storage_type->EditValue = HtmlEncode($this->source_storage_type->AdvancedSearch->SearchValue);
            $this->source_storage_type->PlaceHolder = RemoveHtml($this->source_storage_type->caption());

            // source_storage_bin
            $this->source_storage_bin->setupEditAttributes();
            $this->source_storage_bin->EditCustomAttributes = 'readonly';
            if (!$this->source_storage_bin->Raw) {
                $this->source_storage_bin->AdvancedSearch->SearchValue = HtmlDecode($this->source_storage_bin->AdvancedSearch->SearchValue);
            }
            $this->source_storage_bin->EditValue = HtmlEncode($this->source_storage_bin->AdvancedSearch->SearchValue);
            $this->source_storage_bin->PlaceHolder = RemoveHtml($this->source_storage_bin->caption());

            // carton_number
            $this->carton_number->setupEditAttributes();
            $this->carton_number->EditCustomAttributes = 'readonly';
            if (!$this->carton_number->Raw) {
                $this->carton_number->AdvancedSearch->SearchValue = HtmlDecode($this->carton_number->AdvancedSearch->SearchValue);
            }
            $this->carton_number->EditValue = HtmlEncode($this->carton_number->AdvancedSearch->SearchValue);
            $this->carton_number->PlaceHolder = RemoveHtml($this->carton_number->caption());

            // creation_date
            $this->creation_date->setupEditAttributes();
            $this->creation_date->EditCustomAttributes = "";
            $this->creation_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->creation_date->AdvancedSearch->SearchValue, $this->creation_date->formatPattern()), $this->creation_date->formatPattern()));
            $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

            // gr_number
            $this->gr_number->setupEditAttributes();
            $this->gr_number->EditCustomAttributes = "";
            if (!$this->gr_number->Raw) {
                $this->gr_number->AdvancedSearch->SearchValue = HtmlDecode($this->gr_number->AdvancedSearch->SearchValue);
            }
            $this->gr_number->EditValue = HtmlEncode($this->gr_number->AdvancedSearch->SearchValue);
            $this->gr_number->PlaceHolder = RemoveHtml($this->gr_number->caption());

            // gr_date
            $this->gr_date->setupEditAttributes();
            $this->gr_date->EditCustomAttributes = "";
            $this->gr_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->gr_date->AdvancedSearch->SearchValue, $this->gr_date->formatPattern()), $this->gr_date->formatPattern()));
            $this->gr_date->PlaceHolder = RemoveHtml($this->gr_date->caption());

            // delivery
            $this->delivery->setupEditAttributes();
            $this->delivery->EditCustomAttributes = "";
            if (!$this->delivery->Raw) {
                $this->delivery->AdvancedSearch->SearchValue = HtmlDecode($this->delivery->AdvancedSearch->SearchValue);
            }
            $this->delivery->EditValue = HtmlEncode($this->delivery->AdvancedSearch->SearchValue);
            $this->delivery->PlaceHolder = RemoveHtml($this->delivery->caption());

            // store_id
            $this->store_id->setupEditAttributes();
            $this->store_id->EditCustomAttributes = "";
            if (!$this->store_id->Raw) {
                $this->store_id->AdvancedSearch->SearchValue = HtmlDecode($this->store_id->AdvancedSearch->SearchValue);
            }
            $this->store_id->EditValue = HtmlEncode($this->store_id->AdvancedSearch->SearchValue);
            $this->store_id->PlaceHolder = RemoveHtml($this->store_id->caption());

            // store_name
            $this->store_name->setupEditAttributes();
            $this->store_name->EditCustomAttributes = "";
            if (!$this->store_name->Raw) {
                $this->store_name->AdvancedSearch->SearchValue = HtmlDecode($this->store_name->AdvancedSearch->SearchValue);
            }
            $this->store_name->EditValue = HtmlEncode($this->store_name->AdvancedSearch->SearchValue);
            $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

            // article
            $this->article->setupEditAttributes();
            $this->article->EditCustomAttributes = 'readonly';
            if (!$this->article->Raw) {
                $this->article->AdvancedSearch->SearchValue = HtmlDecode($this->article->AdvancedSearch->SearchValue);
            }
            $this->article->EditValue = HtmlEncode($this->article->AdvancedSearch->SearchValue);
            $this->article->PlaceHolder = RemoveHtml($this->article->caption());

            // size_code
            $this->size_code->setupEditAttributes();
            $this->size_code->EditCustomAttributes = "";
            if (!$this->size_code->Raw) {
                $this->size_code->AdvancedSearch->SearchValue = HtmlDecode($this->size_code->AdvancedSearch->SearchValue);
            }
            $this->size_code->EditValue = HtmlEncode($this->size_code->AdvancedSearch->SearchValue);
            $this->size_code->PlaceHolder = RemoveHtml($this->size_code->caption());

            // size_desc
            $this->size_desc->setupEditAttributes();
            $this->size_desc->EditCustomAttributes = 'readonly';
            if (!$this->size_desc->Raw) {
                $this->size_desc->AdvancedSearch->SearchValue = HtmlDecode($this->size_desc->AdvancedSearch->SearchValue);
            }
            $this->size_desc->EditValue = HtmlEncode($this->size_desc->AdvancedSearch->SearchValue);
            $this->size_desc->PlaceHolder = RemoveHtml($this->size_desc->caption());

            // color_code
            $this->color_code->setupEditAttributes();
            $this->color_code->EditCustomAttributes = "";
            if (!$this->color_code->Raw) {
                $this->color_code->AdvancedSearch->SearchValue = HtmlDecode($this->color_code->AdvancedSearch->SearchValue);
            }
            $this->color_code->EditValue = HtmlEncode($this->color_code->AdvancedSearch->SearchValue);
            $this->color_code->PlaceHolder = RemoveHtml($this->color_code->caption());

            // color_desc
            $this->color_desc->setupEditAttributes();
            $this->color_desc->EditCustomAttributes = "";
            if (!$this->color_desc->Raw) {
                $this->color_desc->AdvancedSearch->SearchValue = HtmlDecode($this->color_desc->AdvancedSearch->SearchValue);
            }
            $this->color_desc->EditValue = HtmlEncode($this->color_desc->AdvancedSearch->SearchValue);
            $this->color_desc->PlaceHolder = RemoveHtml($this->color_desc->caption());

            // concept
            $this->concept->setupEditAttributes();
            $this->concept->EditCustomAttributes = "";
            if (!$this->concept->Raw) {
                $this->concept->AdvancedSearch->SearchValue = HtmlDecode($this->concept->AdvancedSearch->SearchValue);
            }
            $this->concept->EditValue = HtmlEncode($this->concept->AdvancedSearch->SearchValue);
            $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

            // target_qty
            $this->target_qty->setupEditAttributes();
            $this->target_qty->EditCustomAttributes = 'readonly';
            $this->target_qty->EditValue = HtmlEncode($this->target_qty->AdvancedSearch->SearchValue);
            $this->target_qty->PlaceHolder = RemoveHtml($this->target_qty->caption());

            // picked_qty
            $this->picked_qty->setupEditAttributes();
            $this->picked_qty->EditCustomAttributes = 'readonly';
            $this->picked_qty->EditValue = HtmlEncode($this->picked_qty->AdvancedSearch->SearchValue);
            $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());

            // variance_qty
            $this->variance_qty->setupEditAttributes();
            $this->variance_qty->EditCustomAttributes = 'readonly';
            $this->variance_qty->EditValue = HtmlEncode($this->variance_qty->AdvancedSearch->SearchValue);
            $this->variance_qty->PlaceHolder = RemoveHtml($this->variance_qty->caption());

            // confirmation_date
            $this->confirmation_date->setupEditAttributes();
            $this->confirmation_date->EditCustomAttributes = "";
            $this->confirmation_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->confirmation_date->AdvancedSearch->SearchValue, $this->confirmation_date->formatPattern()), $this->confirmation_date->formatPattern()));
            $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());

            // confirmation_time
            $this->confirmation_time->setupEditAttributes();
            $this->confirmation_time->EditCustomAttributes = "";
            $this->confirmation_time->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->confirmation_time->AdvancedSearch->SearchValue, $this->confirmation_time->formatPattern()), $this->confirmation_time->formatPattern()));
            $this->confirmation_time->PlaceHolder = RemoveHtml($this->confirmation_time->caption());

            // box_code
            $this->box_code->setupEditAttributes();
            $this->box_code->EditCustomAttributes = "";
            if (!$this->box_code->Raw) {
                $this->box_code->AdvancedSearch->SearchValue = HtmlDecode($this->box_code->AdvancedSearch->SearchValue);
            }
            $this->box_code->EditValue = HtmlEncode($this->box_code->AdvancedSearch->SearchValue);
            $this->box_code->PlaceHolder = RemoveHtml($this->box_code->caption());

            // box_type
            $this->box_type->EditCustomAttributes = "";
            $this->box_type->EditValue = $this->box_type->options(false);
            $this->box_type->PlaceHolder = RemoveHtml($this->box_type->caption());

            // picker
            $this->picker->setupEditAttributes();
            $this->picker->EditCustomAttributes = "";
            if (!$this->picker->Raw) {
                $this->picker->AdvancedSearch->SearchValue = HtmlDecode($this->picker->AdvancedSearch->SearchValue);
            }
            $this->picker->EditValue = HtmlEncode($this->picker->AdvancedSearch->SearchValue);
            $this->picker->PlaceHolder = RemoveHtml($this->picker->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->AdvancedSearch->SearchValue = HtmlDecode($this->status->AdvancedSearch->SearchValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->AdvancedSearch->SearchValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // remarks
            $this->remarks->setupEditAttributes();
            $this->remarks->EditCustomAttributes = "";
            if (!$this->remarks->Raw) {
                $this->remarks->AdvancedSearch->SearchValue = HtmlDecode($this->remarks->AdvancedSearch->SearchValue);
            }
            $this->remarks->EditValue = HtmlEncode($this->remarks->AdvancedSearch->SearchValue);
            $this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

            // aisle
            $this->aisle->setupEditAttributes();
            $this->aisle->EditCustomAttributes = "";
            if (!$this->aisle->Raw) {
                $this->aisle->AdvancedSearch->SearchValue = HtmlDecode($this->aisle->AdvancedSearch->SearchValue);
            }
            $this->aisle->EditValue = HtmlEncode($this->aisle->AdvancedSearch->SearchValue);
            $this->aisle->PlaceHolder = RemoveHtml($this->aisle->caption());

            // area
            $this->area->setupEditAttributes();
            $this->area->EditCustomAttributes = "";
            if (!$this->area->Raw) {
                $this->area->AdvancedSearch->SearchValue = HtmlDecode($this->area->AdvancedSearch->SearchValue);
            }
            $this->area->EditValue = HtmlEncode($this->area->AdvancedSearch->SearchValue);
            $this->area->PlaceHolder = RemoveHtml($this->area->caption());

            // aisle2
            $this->aisle2->setupEditAttributes();
            $this->aisle2->EditCustomAttributes = "";
            if (!$this->aisle2->Raw) {
                $this->aisle2->AdvancedSearch->SearchValue = HtmlDecode($this->aisle2->AdvancedSearch->SearchValue);
            }
            $this->aisle2->EditValue = HtmlEncode($this->aisle2->AdvancedSearch->SearchValue);
            $this->aisle2->PlaceHolder = RemoveHtml($this->aisle2->caption());

            // store_id2
            $this->store_id2->setupEditAttributes();
            $this->store_id2->EditCustomAttributes = "";
            if (!$this->store_id2->Raw) {
                $this->store_id2->AdvancedSearch->SearchValue = HtmlDecode($this->store_id2->AdvancedSearch->SearchValue);
            }
            $this->store_id2->EditValue = HtmlEncode($this->store_id2->AdvancedSearch->SearchValue);
            $this->store_id2->PlaceHolder = RemoveHtml($this->store_id2->caption());

            // scan_article
            $this->scan_article->setupEditAttributes();
            $this->scan_article->EditCustomAttributes = "";
            if (!$this->scan_article->Raw) {
                $this->scan_article->AdvancedSearch->SearchValue = HtmlDecode($this->scan_article->AdvancedSearch->SearchValue);
            }
            $this->scan_article->EditValue = HtmlEncode($this->scan_article->AdvancedSearch->SearchValue);
            $this->scan_article->PlaceHolder = RemoveHtml($this->scan_article->caption());

            // close_totes
            $this->close_totes->setupEditAttributes();
            $this->close_totes->EditCustomAttributes = "";
            if (!$this->close_totes->Raw) {
                $this->close_totes->AdvancedSearch->SearchValue = HtmlDecode($this->close_totes->AdvancedSearch->SearchValue);
            }
            $this->close_totes->EditValue = HtmlEncode($this->close_totes->AdvancedSearch->SearchValue);
            $this->close_totes->PlaceHolder = RemoveHtml($this->close_totes->caption());

            // job_id
            $this->job_id->setupEditAttributes();
            $this->job_id->EditCustomAttributes = "";
            if (!$this->job_id->Raw) {
                $this->job_id->AdvancedSearch->SearchValue = HtmlDecode($this->job_id->AdvancedSearch->SearchValue);
            }
            $this->job_id->EditValue = HtmlEncode($this->job_id->AdvancedSearch->SearchValue);
            $this->job_id->PlaceHolder = RemoveHtml($this->job_id->caption());
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
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
        if (!CheckInteger($this->id->AdvancedSearch->SearchValue)) {
            $this->id->addErrorMessage($this->id->getErrorMessage(false));
        }
        if (!CheckDate($this->creation_date->AdvancedSearch->SearchValue, $this->creation_date->formatPattern())) {
            $this->creation_date->addErrorMessage($this->creation_date->getErrorMessage(false));
        }
        if (!CheckDate($this->gr_date->AdvancedSearch->SearchValue, $this->gr_date->formatPattern())) {
            $this->gr_date->addErrorMessage($this->gr_date->getErrorMessage(false));
        }
        if (!CheckInteger($this->target_qty->AdvancedSearch->SearchValue)) {
            $this->target_qty->addErrorMessage($this->target_qty->getErrorMessage(false));
        }
        if (!CheckInteger($this->picked_qty->AdvancedSearch->SearchValue)) {
            $this->picked_qty->addErrorMessage($this->picked_qty->getErrorMessage(false));
        }
        if (!CheckInteger($this->variance_qty->AdvancedSearch->SearchValue)) {
            $this->variance_qty->addErrorMessage($this->variance_qty->getErrorMessage(false));
        }
        if (!CheckDate($this->confirmation_date->AdvancedSearch->SearchValue, $this->confirmation_date->formatPattern())) {
            $this->confirmation_date->addErrorMessage($this->confirmation_date->getErrorMessage(false));
        }
        if (!CheckTime($this->confirmation_time->AdvancedSearch->SearchValue, $this->confirmation_time->formatPattern())) {
            $this->confirmation_time->addErrorMessage($this->confirmation_time->getErrorMessage(false));
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

    // Load advanced search
    public function loadAdvancedSearch()
    {
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
        $this->aisle->AdvancedSearch->load();
        $this->area->AdvancedSearch->load();
        $this->aisle2->AdvancedSearch->load();
        $this->store_id2->AdvancedSearch->load();
        $this->scan_article->AdvancedSearch->load();
        $this->close_totes->AdvancedSearch->load();
        $this->job_id->AdvancedSearch->load();
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pickingpendinglist"), "", $this->TableVar, true);
        $pageId = "search";
        $Breadcrumb->add("search", $pageId, $url);
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
                case "x_box_type":
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

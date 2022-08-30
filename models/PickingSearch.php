<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PickingSearch extends Picking
{
    use MessagesTrait;

    // Page ID
    public $PageID = "search";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'picking';

    // Page object name
    public $PageObjName = "PickingSearch";

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

        // Table object (picking)
        if (!isset($GLOBALS["picking"]) || get_class($GLOBALS["picking"]) == PROJECT_NAMESPACE . "picking") {
            $GLOBALS["picking"] = &$this;
        }

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "pickingview") {
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
        $this->id->Visible = false;
        $this->po_no->Visible = false;
        $this->to_no->Visible = false;
        $this->to_order_item->Visible = false;
        $this->to_priority->Visible = false;
        $this->to_priority_code->Visible = false;
        $this->source_storage_type->Visible = false;
        $this->source_storage_bin->Visible = false;
        $this->carton_number->Visible = false;
        $this->creation_date->setVisibility();
        $this->gr_number->Visible = false;
        $this->gr_date->Visible = false;
        $this->delivery->Visible = false;
        $this->store_id->Visible = false;
        $this->store_name->Visible = false;
        $this->article->Visible = false;
        $this->size_code->Visible = false;
        $this->size_desc->Visible = false;
        $this->color_code->Visible = false;
        $this->color_desc->Visible = false;
        $this->concept->Visible = false;
        $this->target_qty->Visible = false;
        $this->picked_qty->Visible = false;
        $this->variance_qty->Visible = false;
        $this->confirmation_date->setVisibility();
        $this->confirmation_time->Visible = false;
        $this->box_code->Visible = false;
        $this->box_type->Visible = false;
        $this->picker->Visible = false;
        $this->status->Visible = false;
        $this->remarks->Visible = false;
        $this->aisle->Visible = false;
        $this->area->Visible = false;
        $this->aisle2->Visible = false;
        $this->store_id2->Visible = false;
        $this->close_totes->Visible = false;
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
                    $srchStr = "pickinglist" . "?" . $srchStr;
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
        $this->buildSearchUrl($srchUrl, $this->creation_date); // creation_date
        $this->buildSearchUrl($srchUrl, $this->confirmation_date); // confirmation_date
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

        // close_totes
        $this->close_totes->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
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
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // remarks
            $this->remarks->ViewValue = $this->remarks->CurrentValue;
            $this->remarks->ViewCustomAttributes = "";

            // creation_date
            $this->creation_date->LinkCustomAttributes = "";
            $this->creation_date->HrefValue = "";
            $this->creation_date->TooltipValue = "";

            // confirmation_date
            $this->confirmation_date->LinkCustomAttributes = "";
            $this->confirmation_date->HrefValue = "";
            $this->confirmation_date->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // creation_date
            $this->creation_date->setupEditAttributes();
            $this->creation_date->EditCustomAttributes = "";
            $this->creation_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->creation_date->AdvancedSearch->SearchValue, $this->creation_date->formatPattern()), $this->creation_date->formatPattern()));
            $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());
            $this->creation_date->setupEditAttributes();
            $this->creation_date->EditCustomAttributes = "";
            $this->creation_date->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->creation_date->AdvancedSearch->SearchValue2, $this->creation_date->formatPattern()), $this->creation_date->formatPattern()));
            $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

            // confirmation_date
            $this->confirmation_date->setupEditAttributes();
            $this->confirmation_date->EditCustomAttributes = "";
            $this->confirmation_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->confirmation_date->AdvancedSearch->SearchValue, $this->confirmation_date->formatPattern()), $this->confirmation_date->formatPattern()));
            $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());
            $this->confirmation_date->setupEditAttributes();
            $this->confirmation_date->EditCustomAttributes = "";
            $this->confirmation_date->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->confirmation_date->AdvancedSearch->SearchValue2, $this->confirmation_date->formatPattern()), $this->confirmation_date->formatPattern()));
            $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());
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
        if (!CheckDate($this->creation_date->AdvancedSearch->SearchValue, $this->creation_date->formatPattern())) {
            $this->creation_date->addErrorMessage($this->creation_date->getErrorMessage(false));
        }
        if (!CheckDate($this->creation_date->AdvancedSearch->SearchValue2, $this->creation_date->formatPattern())) {
            $this->creation_date->addErrorMessage($this->creation_date->getErrorMessage(false));
        }
        if (!CheckDate($this->confirmation_date->AdvancedSearch->SearchValue, $this->confirmation_date->formatPattern())) {
            $this->confirmation_date->addErrorMessage($this->confirmation_date->getErrorMessage(false));
        }
        if (!CheckDate($this->confirmation_date->AdvancedSearch->SearchValue2, $this->confirmation_date->formatPattern())) {
            $this->confirmation_date->addErrorMessage($this->confirmation_date->getErrorMessage(false));
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
        $this->creation_date->AdvancedSearch->load();
        $this->confirmation_date->AdvancedSearch->load();
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pickinglist"), "", $this->TableVar, true);
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

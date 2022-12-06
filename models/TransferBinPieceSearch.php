<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class TransferBinPieceSearch extends TransferBinPiece
{
    use MessagesTrait;

    // Page ID
    public $PageID = "search";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'transfer_bin_piece';

    // Page object name
    public $PageObjName = "TransferBinPieceSearch";

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

        // Table object (transfer_bin_piece)
        if (!isset($GLOBALS["transfer_bin_piece"]) || get_class($GLOBALS["transfer_bin_piece"]) == PROJECT_NAMESPACE . "transfer_bin_piece") {
            $GLOBALS["transfer_bin_piece"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'transfer_bin_piece');
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
                $tbl = Container("transfer_bin_piece");
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
                    if ($pageName == "transferbinpieceview") {
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
        $this->source_location->Visible = false;
        $this->article->Visible = false;
        $this->description->setVisibility();
        $this->destination_location->Visible = false;
        $this->su->Visible = false;
        $this->qty->setVisibility();
        $this->actual->setVisibility();
        $this->user->Visible = false;
        $this->status->setVisibility();
        $this->date_upload->setVisibility();
        $this->date_confirmation->setVisibility();
        $this->time_confirmation->setVisibility();
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
                    $srchStr = "transferbinpiecelist" . "?" . $srchStr;
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
        $this->buildSearchUrl($srchUrl, $this->description); // description
        $this->buildSearchUrl($srchUrl, $this->qty); // qty
        $this->buildSearchUrl($srchUrl, $this->actual); // actual
        $this->buildSearchUrl($srchUrl, $this->status); // status
        $this->buildSearchUrl($srchUrl, $this->date_upload); // date_upload
        $this->buildSearchUrl($srchUrl, $this->date_confirmation); // date_confirmation
        $this->buildSearchUrl($srchUrl, $this->time_confirmation); // time_confirmation
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

        // source_location
        if ($this->source_location->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // article
        if ($this->article->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // description
        if ($this->description->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // destination_location
        if ($this->destination_location->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // su
        if ($this->su->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // qty
        if ($this->qty->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // actual
        if ($this->actual->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // user
        if ($this->user->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // status
        if ($this->status->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // date_upload
        if ($this->date_upload->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // date_confirmation
        if ($this->date_confirmation->AdvancedSearch->get()) {
            $hasValue = true;
        }

        // time_confirmation
        if ($this->time_confirmation->AdvancedSearch->get()) {
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

        // source_location
        $this->source_location->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // description
        $this->description->RowCssClass = "row";

        // destination_location
        $this->destination_location->RowCssClass = "row";

        // su
        $this->su->RowCssClass = "row";

        // qty
        $this->qty->RowCssClass = "row";

        // actual
        $this->actual->RowCssClass = "row";

        // user
        $this->user->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // date_upload
        $this->date_upload->RowCssClass = "row";

        // date_confirmation
        $this->date_confirmation->RowCssClass = "row";

        // time_confirmation
        $this->time_confirmation->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
            $this->id->ViewCustomAttributes = "";

            // source_location
            $this->source_location->ViewValue = $this->source_location->CurrentValue;
            $this->source_location->ViewCustomAttributes = "";

            // article
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";

            // description
            $this->description->ViewValue = $this->description->CurrentValue;
            $this->description->ViewCustomAttributes = "";

            // destination_location
            $this->destination_location->ViewValue = $this->destination_location->CurrentValue;
            $this->destination_location->ViewCustomAttributes = "";

            // su
            $this->su->ViewValue = $this->su->CurrentValue;
            $this->su->ViewCustomAttributes = "";

            // qty
            $this->qty->ViewValue = $this->qty->CurrentValue;
            $this->qty->ViewValue = FormatNumber($this->qty->ViewValue, $this->qty->formatPattern());
            $this->qty->ViewCustomAttributes = "";

            // actual
            $this->actual->ViewValue = $this->actual->CurrentValue;
            $this->actual->ViewValue = FormatNumber($this->actual->ViewValue, $this->actual->formatPattern());
            $this->actual->ViewCustomAttributes = "";

            // user
            $this->user->ViewValue = $this->user->CurrentValue;
            $this->user->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // date_upload
            $this->date_upload->ViewValue = $this->date_upload->CurrentValue;
            $this->date_upload->ViewValue = FormatDateTime($this->date_upload->ViewValue, $this->date_upload->formatPattern());
            $this->date_upload->ViewCustomAttributes = "";

            // date_confirmation
            $this->date_confirmation->ViewValue = $this->date_confirmation->CurrentValue;
            $this->date_confirmation->ViewValue = FormatDateTime($this->date_confirmation->ViewValue, $this->date_confirmation->formatPattern());
            $this->date_confirmation->ViewCustomAttributes = "";

            // time_confirmation
            $this->time_confirmation->ViewValue = $this->time_confirmation->CurrentValue;
            $this->time_confirmation->ViewValue = FormatDateTime($this->time_confirmation->ViewValue, $this->time_confirmation->formatPattern());
            $this->time_confirmation->ViewCustomAttributes = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";
            $this->description->TooltipValue = "";

            // qty
            $this->qty->LinkCustomAttributes = "";
            $this->qty->HrefValue = "";
            $this->qty->TooltipValue = "";

            // actual
            $this->actual->LinkCustomAttributes = "";
            $this->actual->HrefValue = "";
            $this->actual->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // date_upload
            $this->date_upload->LinkCustomAttributes = "";
            $this->date_upload->HrefValue = "";
            $this->date_upload->TooltipValue = "";

            // date_confirmation
            $this->date_confirmation->LinkCustomAttributes = "";
            $this->date_confirmation->HrefValue = "";
            $this->date_confirmation->TooltipValue = "";

            // time_confirmation
            $this->time_confirmation->LinkCustomAttributes = "";
            $this->time_confirmation->HrefValue = "";
            $this->time_confirmation->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // description
            $this->description->setupEditAttributes();
            $this->description->EditCustomAttributes = "";
            if (!$this->description->Raw) {
                $this->description->AdvancedSearch->SearchValue = HtmlDecode($this->description->AdvancedSearch->SearchValue);
            }
            $this->description->EditValue = HtmlEncode($this->description->AdvancedSearch->SearchValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // qty
            $this->qty->setupEditAttributes();
            $this->qty->EditCustomAttributes = "";
            $this->qty->EditValue = HtmlEncode($this->qty->AdvancedSearch->SearchValue);
            $this->qty->PlaceHolder = RemoveHtml($this->qty->caption());

            // actual
            $this->actual->setupEditAttributes();
            $this->actual->EditCustomAttributes = "";
            $this->actual->EditValue = HtmlEncode($this->actual->AdvancedSearch->SearchValue);
            $this->actual->PlaceHolder = RemoveHtml($this->actual->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->AdvancedSearch->SearchValue = HtmlDecode($this->status->AdvancedSearch->SearchValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->AdvancedSearch->SearchValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // date_upload
            $this->date_upload->setupEditAttributes();
            $this->date_upload->EditCustomAttributes = "";
            $this->date_upload->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->date_upload->AdvancedSearch->SearchValue, $this->date_upload->formatPattern()), $this->date_upload->formatPattern()));
            $this->date_upload->PlaceHolder = RemoveHtml($this->date_upload->caption());
            $this->date_upload->setupEditAttributes();
            $this->date_upload->EditCustomAttributes = "";
            $this->date_upload->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->date_upload->AdvancedSearch->SearchValue2, $this->date_upload->formatPattern()), $this->date_upload->formatPattern()));
            $this->date_upload->PlaceHolder = RemoveHtml($this->date_upload->caption());

            // date_confirmation
            $this->date_confirmation->setupEditAttributes();
            $this->date_confirmation->EditCustomAttributes = "";
            $this->date_confirmation->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->date_confirmation->AdvancedSearch->SearchValue, $this->date_confirmation->formatPattern()), $this->date_confirmation->formatPattern()));
            $this->date_confirmation->PlaceHolder = RemoveHtml($this->date_confirmation->caption());
            $this->date_confirmation->setupEditAttributes();
            $this->date_confirmation->EditCustomAttributes = "";
            $this->date_confirmation->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->date_confirmation->AdvancedSearch->SearchValue2, $this->date_confirmation->formatPattern()), $this->date_confirmation->formatPattern()));
            $this->date_confirmation->PlaceHolder = RemoveHtml($this->date_confirmation->caption());

            // time_confirmation
            $this->time_confirmation->setupEditAttributes();
            $this->time_confirmation->EditCustomAttributes = "";
            $this->time_confirmation->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->time_confirmation->AdvancedSearch->SearchValue, $this->time_confirmation->formatPattern()), $this->time_confirmation->formatPattern()));
            $this->time_confirmation->PlaceHolder = RemoveHtml($this->time_confirmation->caption());
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
        if (!CheckInteger($this->qty->AdvancedSearch->SearchValue)) {
            $this->qty->addErrorMessage($this->qty->getErrorMessage(false));
        }
        if (!CheckInteger($this->actual->AdvancedSearch->SearchValue)) {
            $this->actual->addErrorMessage($this->actual->getErrorMessage(false));
        }
        if (!CheckDate($this->date_upload->AdvancedSearch->SearchValue, $this->date_upload->formatPattern())) {
            $this->date_upload->addErrorMessage($this->date_upload->getErrorMessage(false));
        }
        if (!CheckDate($this->date_upload->AdvancedSearch->SearchValue2, $this->date_upload->formatPattern())) {
            $this->date_upload->addErrorMessage($this->date_upload->getErrorMessage(false));
        }
        if (!CheckDate($this->date_confirmation->AdvancedSearch->SearchValue, $this->date_confirmation->formatPattern())) {
            $this->date_confirmation->addErrorMessage($this->date_confirmation->getErrorMessage(false));
        }
        if (!CheckDate($this->date_confirmation->AdvancedSearch->SearchValue2, $this->date_confirmation->formatPattern())) {
            $this->date_confirmation->addErrorMessage($this->date_confirmation->getErrorMessage(false));
        }
        if (!CheckTime($this->time_confirmation->AdvancedSearch->SearchValue, $this->time_confirmation->formatPattern())) {
            $this->time_confirmation->addErrorMessage($this->time_confirmation->getErrorMessage(false));
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
        $this->description->AdvancedSearch->load();
        $this->qty->AdvancedSearch->load();
        $this->actual->AdvancedSearch->load();
        $this->status->AdvancedSearch->load();
        $this->date_upload->AdvancedSearch->load();
        $this->date_confirmation->AdvancedSearch->load();
        $this->time_confirmation->AdvancedSearch->load();
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("transferbinpiecelist"), "", $this->TableVar, true);
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

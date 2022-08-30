<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PickingDelete extends Picking
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'picking';

    // Page object name
    public $PageObjName = "PickingDelete";

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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));
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

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("pickinglist"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("pickinglist"); // Return to list
                return;
            }
        }

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
        return $row;
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
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAllAssociative($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        if ($this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Clone old rows
        $rsold = $rows;
        $successKeys = [];
        $failKeys = [];
        foreach ($rsold as $row) {
            $thisKey = "";
            if ($thisKey != "") {
                $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
            }
            $thisKey .= $row['id'];

            // Call row deleting event
            $deleteRow = $this->rowDeleting($row);
            if ($deleteRow) { // Delete
                $deleteRow = $this->delete($row);
            }
            if ($deleteRow === false) {
                if ($this->UseTransaction) {
                    $successKeys = []; // Reset success keys
                    break;
                }
                $failKeys[] = $thisKey;
            } else {
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }

                // Call Row Deleted event
                $this->rowDeleted($row);
                $successKeys[] = $thisKey;
            }
        }

        // Any records deleted
        $deleteRows = count($successKeys) > 0;
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }
        if ($deleteRows) {
            if ($this->UseTransaction) { // Commit transaction
                $conn->commit();
            }

            // Set warning message if delete some records failed
            if (count($failKeys) > 0) {
                $this->setWarningMessage(str_replace("%k", explode(", ", $failKeys), $Language->phrase("DeleteSomeRecordsFailed")));
            }
        } else {
            if ($this->UseTransaction) { // Rollback transaction
                $conn->rollback();
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("/dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pickinglist"), "", $this->TableVar, true);
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}

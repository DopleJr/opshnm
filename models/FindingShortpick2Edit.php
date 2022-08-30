<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class FindingShortpick2Edit extends FindingShortpick2
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'finding_shortpick';

    // Page object name
    public $PageObjName = "FindingShortpick2Edit";

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

        // Table object (finding_shortpick2)
        if (!isset($GLOBALS["finding_shortpick2"]) || get_class($GLOBALS["finding_shortpick2"]) == PROJECT_NAMESPACE . "finding_shortpick2") {
            $GLOBALS["finding_shortpick2"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'finding_shortpick');
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
                $tbl = Container("finding_shortpick2");
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
                    if ($pageName == "findingshortpick2view") {
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
        $this->location->setVisibility();
        $this->ctn->setVisibility();
        $this->article->setVisibility();
        $this->description->setVisibility();
        $this->avaiable->setVisibility();
        $this->web->setVisibility();
        $this->target_quantity->setVisibility();
        $this->shortpick->setVisibility();
        $this->actual->setVisibility();
        $this->pick_quantity->setVisibility();
        $this->excess->setVisibility();
        $this->user->setVisibility();
        $this->area->setVisibility();
        $this->status->setVisibility();
        $this->date_shortpick->setVisibility();
        $this->date_upload->setVisibility();
        $this->date_picking->setVisibility();
        $this->time_picking->setVisibility();
        $this->total->Visible = false;
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

        // Load record by position
        $loadByPosition = false;
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
                if (!$loadByQuery || Get(Config("TABLE_START_REC")) !== null) {
                    $loadByPosition = true;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                if (!$this->IsModal) { // Normal edit page
                    $this->StartRecord = 1; // Initialize start position
                    if ($rs = $this->loadRecordset()) { // Load records
                        $this->TotalRecords = $rs->recordCount(); // Get record count
                    }
                    if ($this->TotalRecords <= 0) { // No record found
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("findingshortpick2list"); // Return to list page
                        return;
                    } elseif ($loadByPosition) { // Load record by position
                        $this->setupStartRecord(); // Set up start record position
                        // Point to current record
                        if ($this->StartRecord <= $this->TotalRecords) {
                            $rs->move($this->StartRecord - 1);
                            $loaded = true;
                        }
                    } else { // Match key values
                        if ($this->id->CurrentValue != null) {
                            while (!$rs->EOF) {
                                if (SameString($this->id->CurrentValue, $rs->fields['id'])) {
                                    $this->setStartRecordNumber($this->StartRecord); // Save record position
                                    $loaded = true;
                                    break;
                                } else {
                                    $this->StartRecord++;
                                    $rs->moveNext();
                                }
                            }
                        }
                    }

                    // Load current row values
                    if ($loaded) {
                        $this->loadRowValues($rs);
                    }
                } else {
                    // Load current record
                    $loaded = $this->loadRow();
                } // End modal checking
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
                if (!$this->IsModal) { // Normal edit page
                    if (!$loaded) {
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("findingshortpick2list"); // Return to list page
                        return;
                    } else {
                    }
                } else { // Modal edit page
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("findingshortpick2list"); // No matching record, return to list
                        return;
                    }
                } // End modal checking
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "findingshortpick2list") {
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
        if (!$this->IsModal) { // Normal view page
            $this->Pager = new PrevNextPager($this->TableVar, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager, false, false);
            $this->Pager->PageNumberName = Config("TABLE_START_REC"); // Same as start record
            $this->Pager->PagePhraseId = "Record"; // Show as record
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

        // Check field name 'location' first before field var 'x_location'
        $val = $CurrentForm->hasValue("location") ? $CurrentForm->getValue("location") : $CurrentForm->getValue("x_location");
        if (!$this->location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location->Visible = false; // Disable update for API request
            } else {
                $this->location->setFormValue($val);
            }
        }

        // Check field name 'ctn' first before field var 'x_ctn'
        $val = $CurrentForm->hasValue("ctn") ? $CurrentForm->getValue("ctn") : $CurrentForm->getValue("x_ctn");
        if (!$this->ctn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ctn->Visible = false; // Disable update for API request
            } else {
                $this->ctn->setFormValue($val);
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

        // Check field name 'description' first before field var 'x_description'
        $val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
        if (!$this->description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->description->Visible = false; // Disable update for API request
            } else {
                $this->description->setFormValue($val);
            }
        }

        // Check field name 'avaiable' first before field var 'x_avaiable'
        $val = $CurrentForm->hasValue("avaiable") ? $CurrentForm->getValue("avaiable") : $CurrentForm->getValue("x_avaiable");
        if (!$this->avaiable->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->avaiable->Visible = false; // Disable update for API request
            } else {
                $this->avaiable->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'web' first before field var 'x_web'
        $val = $CurrentForm->hasValue("web") ? $CurrentForm->getValue("web") : $CurrentForm->getValue("x_web");
        if (!$this->web->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->web->Visible = false; // Disable update for API request
            } else {
                $this->web->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'target_quantity' first before field var 'x_target_quantity'
        $val = $CurrentForm->hasValue("target_quantity") ? $CurrentForm->getValue("target_quantity") : $CurrentForm->getValue("x_target_quantity");
        if (!$this->target_quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->target_quantity->Visible = false; // Disable update for API request
            } else {
                $this->target_quantity->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'shortpick' first before field var 'x_shortpick'
        $val = $CurrentForm->hasValue("shortpick") ? $CurrentForm->getValue("shortpick") : $CurrentForm->getValue("x_shortpick");
        if (!$this->shortpick->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shortpick->Visible = false; // Disable update for API request
            } else {
                $this->shortpick->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'actual' first before field var 'x_actual'
        $val = $CurrentForm->hasValue("actual") ? $CurrentForm->getValue("actual") : $CurrentForm->getValue("x_actual");
        if (!$this->actual->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->actual->Visible = false; // Disable update for API request
            } else {
                $this->actual->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pick_quantity' first before field var 'x_pick_quantity'
        $val = $CurrentForm->hasValue("pick_quantity") ? $CurrentForm->getValue("pick_quantity") : $CurrentForm->getValue("x_pick_quantity");
        if (!$this->pick_quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pick_quantity->Visible = false; // Disable update for API request
            } else {
                $this->pick_quantity->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'excess' first before field var 'x_excess'
        $val = $CurrentForm->hasValue("excess") ? $CurrentForm->getValue("excess") : $CurrentForm->getValue("x_excess");
        if (!$this->excess->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->excess->Visible = false; // Disable update for API request
            } else {
                $this->excess->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'user' first before field var 'x_user'
        $val = $CurrentForm->hasValue("user") ? $CurrentForm->getValue("user") : $CurrentForm->getValue("x_user");
        if (!$this->user->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user->Visible = false; // Disable update for API request
            } else {
                $this->user->setFormValue($val);
            }
        }

        // Check field name 'area' first before field var 'x_area'
        $val = $CurrentForm->hasValue("area") ? $CurrentForm->getValue("area") : $CurrentForm->getValue("x_area");
        if (!$this->area->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->area->Visible = false; // Disable update for API request
            } else {
                $this->area->setFormValue($val);
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

        // Check field name 'date_shortpick' first before field var 'x_date_shortpick'
        $val = $CurrentForm->hasValue("date_shortpick") ? $CurrentForm->getValue("date_shortpick") : $CurrentForm->getValue("x_date_shortpick");
        if (!$this->date_shortpick->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_shortpick->Visible = false; // Disable update for API request
            } else {
                $this->date_shortpick->setFormValue($val, true, $validate);
            }
            $this->date_shortpick->CurrentValue = UnFormatDateTime($this->date_shortpick->CurrentValue, $this->date_shortpick->formatPattern());
        }

        // Check field name 'date_upload' first before field var 'x_date_upload'
        $val = $CurrentForm->hasValue("date_upload") ? $CurrentForm->getValue("date_upload") : $CurrentForm->getValue("x_date_upload");
        if (!$this->date_upload->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_upload->Visible = false; // Disable update for API request
            } else {
                $this->date_upload->setFormValue($val, true, $validate);
            }
            $this->date_upload->CurrentValue = UnFormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern());
        }

        // Check field name 'date_picking' first before field var 'x_date_picking'
        $val = $CurrentForm->hasValue("date_picking") ? $CurrentForm->getValue("date_picking") : $CurrentForm->getValue("x_date_picking");
        if (!$this->date_picking->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_picking->Visible = false; // Disable update for API request
            } else {
                $this->date_picking->setFormValue($val, true, $validate);
            }
            $this->date_picking->CurrentValue = UnFormatDateTime($this->date_picking->CurrentValue, $this->date_picking->formatPattern());
        }

        // Check field name 'time_picking' first before field var 'x_time_picking'
        $val = $CurrentForm->hasValue("time_picking") ? $CurrentForm->getValue("time_picking") : $CurrentForm->getValue("x_time_picking");
        if (!$this->time_picking->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->time_picking->Visible = false; // Disable update for API request
            } else {
                $this->time_picking->setFormValue($val, true, $validate);
            }
            $this->time_picking->CurrentValue = UnFormatDateTime($this->time_picking->CurrentValue, $this->time_picking->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->location->CurrentValue = $this->location->FormValue;
        $this->ctn->CurrentValue = $this->ctn->FormValue;
        $this->article->CurrentValue = $this->article->FormValue;
        $this->description->CurrentValue = $this->description->FormValue;
        $this->avaiable->CurrentValue = $this->avaiable->FormValue;
        $this->web->CurrentValue = $this->web->FormValue;
        $this->target_quantity->CurrentValue = $this->target_quantity->FormValue;
        $this->shortpick->CurrentValue = $this->shortpick->FormValue;
        $this->actual->CurrentValue = $this->actual->FormValue;
        $this->pick_quantity->CurrentValue = $this->pick_quantity->FormValue;
        $this->excess->CurrentValue = $this->excess->FormValue;
        $this->user->CurrentValue = $this->user->FormValue;
        $this->area->CurrentValue = $this->area->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->date_shortpick->CurrentValue = $this->date_shortpick->FormValue;
        $this->date_shortpick->CurrentValue = UnFormatDateTime($this->date_shortpick->CurrentValue, $this->date_shortpick->formatPattern());
        $this->date_upload->CurrentValue = $this->date_upload->FormValue;
        $this->date_upload->CurrentValue = UnFormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern());
        $this->date_picking->CurrentValue = $this->date_picking->FormValue;
        $this->date_picking->CurrentValue = UnFormatDateTime($this->date_picking->CurrentValue, $this->date_picking->formatPattern());
        $this->time_picking->CurrentValue = $this->time_picking->FormValue;
        $this->time_picking->CurrentValue = UnFormatDateTime($this->time_picking->CurrentValue, $this->time_picking->formatPattern());
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
        $this->location->setDbValue($row['location']);
        $this->ctn->setDbValue($row['ctn']);
        $this->article->setDbValue($row['article']);
        $this->description->setDbValue($row['description']);
        $this->avaiable->setDbValue($row['avaiable']);
        $this->web->setDbValue($row['web']);
        $this->target_quantity->setDbValue($row['target_quantity']);
        $this->shortpick->setDbValue($row['shortpick']);
        $this->actual->setDbValue($row['actual']);
        $this->pick_quantity->setDbValue($row['pick_quantity']);
        $this->excess->setDbValue($row['excess']);
        $this->user->setDbValue($row['user']);
        $this->area->setDbValue($row['area']);
        $this->status->setDbValue($row['status']);
        $this->date_shortpick->setDbValue($row['date_shortpick']);
        $this->date_upload->setDbValue($row['date_upload']);
        $this->date_picking->setDbValue($row['date_picking']);
        $this->time_picking->setDbValue($row['time_picking']);
        $this->total->setDbValue($row['total']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['location'] = $this->location->DefaultValue;
        $row['ctn'] = $this->ctn->DefaultValue;
        $row['article'] = $this->article->DefaultValue;
        $row['description'] = $this->description->DefaultValue;
        $row['avaiable'] = $this->avaiable->DefaultValue;
        $row['web'] = $this->web->DefaultValue;
        $row['target_quantity'] = $this->target_quantity->DefaultValue;
        $row['shortpick'] = $this->shortpick->DefaultValue;
        $row['actual'] = $this->actual->DefaultValue;
        $row['pick_quantity'] = $this->pick_quantity->DefaultValue;
        $row['excess'] = $this->excess->DefaultValue;
        $row['user'] = $this->user->DefaultValue;
        $row['area'] = $this->area->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['date_shortpick'] = $this->date_shortpick->DefaultValue;
        $row['date_upload'] = $this->date_upload->DefaultValue;
        $row['date_picking'] = $this->date_picking->DefaultValue;
        $row['time_picking'] = $this->time_picking->DefaultValue;
        $row['total'] = $this->total->DefaultValue;
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

        // location
        $this->location->RowCssClass = "row";

        // ctn
        $this->ctn->RowCssClass = "row";

        // article
        $this->article->RowCssClass = "row";

        // description
        $this->description->RowCssClass = "row";

        // avaiable
        $this->avaiable->RowCssClass = "row";

        // web
        $this->web->RowCssClass = "row";

        // target_quantity
        $this->target_quantity->RowCssClass = "row";

        // shortpick
        $this->shortpick->RowCssClass = "row";

        // actual
        $this->actual->RowCssClass = "row";

        // pick_quantity
        $this->pick_quantity->RowCssClass = "row";

        // excess
        $this->excess->RowCssClass = "row";

        // user
        $this->user->RowCssClass = "row";

        // area
        $this->area->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // date_shortpick
        $this->date_shortpick->RowCssClass = "row";

        // date_upload
        $this->date_upload->RowCssClass = "row";

        // date_picking
        $this->date_picking->RowCssClass = "row";

        // time_picking
        $this->time_picking->RowCssClass = "row";

        // total
        $this->total->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location
            $this->location->ViewValue = $this->location->CurrentValue;
            $this->location->ViewCustomAttributes = "";

            // ctn
            $this->ctn->ViewValue = $this->ctn->CurrentValue;
            $this->ctn->ViewCustomAttributes = "";

            // article
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";

            // description
            $this->description->ViewValue = $this->description->CurrentValue;
            $this->description->ViewCustomAttributes = "";

            // avaiable
            $this->avaiable->ViewValue = $this->avaiable->CurrentValue;
            $this->avaiable->ViewValue = FormatNumber($this->avaiable->ViewValue, $this->avaiable->formatPattern());
            $this->avaiable->ViewCustomAttributes = "";

            // web
            $this->web->ViewValue = $this->web->CurrentValue;
            $this->web->ViewValue = FormatNumber($this->web->ViewValue, $this->web->formatPattern());
            $this->web->ViewCustomAttributes = "";

            // target_quantity
            $this->target_quantity->ViewValue = $this->target_quantity->CurrentValue;
            $this->target_quantity->ViewValue = FormatNumber($this->target_quantity->ViewValue, $this->target_quantity->formatPattern());
            $this->target_quantity->ViewCustomAttributes = "";

            // shortpick
            $this->shortpick->ViewValue = $this->shortpick->CurrentValue;
            $this->shortpick->ViewValue = FormatNumber($this->shortpick->ViewValue, $this->shortpick->formatPattern());
            $this->shortpick->ViewCustomAttributes = "";

            // actual
            $this->actual->ViewValue = $this->actual->CurrentValue;
            $this->actual->ViewValue = FormatNumber($this->actual->ViewValue, $this->actual->formatPattern());
            $this->actual->ViewCustomAttributes = "";

            // pick_quantity
            $this->pick_quantity->ViewValue = $this->pick_quantity->CurrentValue;
            $this->pick_quantity->ViewValue = FormatNumber($this->pick_quantity->ViewValue, $this->pick_quantity->formatPattern());
            $this->pick_quantity->ViewCustomAttributes = "";

            // excess
            $this->excess->ViewValue = $this->excess->CurrentValue;
            $this->excess->ViewValue = FormatNumber($this->excess->ViewValue, $this->excess->formatPattern());
            $this->excess->ViewCustomAttributes = "";

            // user
            $this->user->ViewValue = $this->user->CurrentValue;
            $this->user->ViewCustomAttributes = "";

            // area
            $this->area->ViewValue = $this->area->CurrentValue;
            $this->area->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // date_shortpick
            $this->date_shortpick->ViewValue = $this->date_shortpick->CurrentValue;
            $this->date_shortpick->ViewValue = FormatDateTime($this->date_shortpick->ViewValue, $this->date_shortpick->formatPattern());
            $this->date_shortpick->ViewCustomAttributes = "";

            // date_upload
            $this->date_upload->ViewValue = $this->date_upload->CurrentValue;
            $this->date_upload->ViewValue = FormatDateTime($this->date_upload->ViewValue, $this->date_upload->formatPattern());
            $this->date_upload->ViewCustomAttributes = "";

            // date_picking
            $this->date_picking->ViewValue = $this->date_picking->CurrentValue;
            $this->date_picking->ViewValue = FormatDateTime($this->date_picking->ViewValue, $this->date_picking->formatPattern());
            $this->date_picking->ViewCustomAttributes = "";

            // time_picking
            $this->time_picking->ViewValue = $this->time_picking->CurrentValue;
            $this->time_picking->ViewValue = FormatDateTime($this->time_picking->ViewValue, $this->time_picking->formatPattern());
            $this->time_picking->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // ctn
            $this->ctn->LinkCustomAttributes = "";
            $this->ctn->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";

            // avaiable
            $this->avaiable->LinkCustomAttributes = "";
            $this->avaiable->HrefValue = "";

            // web
            $this->web->LinkCustomAttributes = "";
            $this->web->HrefValue = "";

            // target_quantity
            $this->target_quantity->LinkCustomAttributes = "";
            $this->target_quantity->HrefValue = "";

            // shortpick
            $this->shortpick->LinkCustomAttributes = "";
            $this->shortpick->HrefValue = "";

            // actual
            $this->actual->LinkCustomAttributes = "";
            $this->actual->HrefValue = "";

            // pick_quantity
            $this->pick_quantity->LinkCustomAttributes = "";
            $this->pick_quantity->HrefValue = "";

            // excess
            $this->excess->LinkCustomAttributes = "";
            $this->excess->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // area
            $this->area->LinkCustomAttributes = "";
            $this->area->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_shortpick
            $this->date_shortpick->LinkCustomAttributes = "";
            $this->date_shortpick->HrefValue = "";

            // date_upload
            $this->date_upload->LinkCustomAttributes = "";
            $this->date_upload->HrefValue = "";

            // date_picking
            $this->date_picking->LinkCustomAttributes = "";
            $this->date_picking->HrefValue = "";

            // time_picking
            $this->time_picking->LinkCustomAttributes = "";
            $this->time_picking->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location
            $this->location->setupEditAttributes();
            $this->location->EditCustomAttributes = "";
            if (!$this->location->Raw) {
                $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
            }
            $this->location->EditValue = HtmlEncode($this->location->CurrentValue);
            $this->location->PlaceHolder = RemoveHtml($this->location->caption());

            // ctn
            $this->ctn->setupEditAttributes();
            $this->ctn->EditCustomAttributes = "";
            if (!$this->ctn->Raw) {
                $this->ctn->CurrentValue = HtmlDecode($this->ctn->CurrentValue);
            }
            $this->ctn->EditValue = HtmlEncode($this->ctn->CurrentValue);
            $this->ctn->PlaceHolder = RemoveHtml($this->ctn->caption());

            // article
            $this->article->setupEditAttributes();
            $this->article->EditCustomAttributes = "";
            if (!$this->article->Raw) {
                $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
            }
            $this->article->EditValue = HtmlEncode($this->article->CurrentValue);
            $this->article->PlaceHolder = RemoveHtml($this->article->caption());

            // description
            $this->description->setupEditAttributes();
            $this->description->EditCustomAttributes = "";
            if (!$this->description->Raw) {
                $this->description->CurrentValue = HtmlDecode($this->description->CurrentValue);
            }
            $this->description->EditValue = HtmlEncode($this->description->CurrentValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // avaiable
            $this->avaiable->setupEditAttributes();
            $this->avaiable->EditCustomAttributes = "";
            $this->avaiable->EditValue = HtmlEncode($this->avaiable->CurrentValue);
            $this->avaiable->PlaceHolder = RemoveHtml($this->avaiable->caption());
            if (strval($this->avaiable->EditValue) != "" && is_numeric($this->avaiable->EditValue)) {
                $this->avaiable->EditValue = FormatNumber($this->avaiable->EditValue, null);
            }

            // web
            $this->web->setupEditAttributes();
            $this->web->EditCustomAttributes = "";
            $this->web->EditValue = HtmlEncode($this->web->CurrentValue);
            $this->web->PlaceHolder = RemoveHtml($this->web->caption());
            if (strval($this->web->EditValue) != "" && is_numeric($this->web->EditValue)) {
                $this->web->EditValue = FormatNumber($this->web->EditValue, null);
            }

            // target_quantity
            $this->target_quantity->setupEditAttributes();
            $this->target_quantity->EditCustomAttributes = "";
            $this->target_quantity->EditValue = HtmlEncode($this->target_quantity->CurrentValue);
            $this->target_quantity->PlaceHolder = RemoveHtml($this->target_quantity->caption());
            if (strval($this->target_quantity->EditValue) != "" && is_numeric($this->target_quantity->EditValue)) {
                $this->target_quantity->EditValue = FormatNumber($this->target_quantity->EditValue, null);
            }

            // shortpick
            $this->shortpick->setupEditAttributes();
            $this->shortpick->EditCustomAttributes = "";
            $this->shortpick->EditValue = HtmlEncode($this->shortpick->CurrentValue);
            $this->shortpick->PlaceHolder = RemoveHtml($this->shortpick->caption());
            if (strval($this->shortpick->EditValue) != "" && is_numeric($this->shortpick->EditValue)) {
                $this->shortpick->EditValue = FormatNumber($this->shortpick->EditValue, null);
            }

            // actual
            $this->actual->setupEditAttributes();
            $this->actual->EditCustomAttributes = "";
            $this->actual->EditValue = HtmlEncode($this->actual->CurrentValue);
            $this->actual->PlaceHolder = RemoveHtml($this->actual->caption());
            if (strval($this->actual->EditValue) != "" && is_numeric($this->actual->EditValue)) {
                $this->actual->EditValue = FormatNumber($this->actual->EditValue, null);
            }

            // pick_quantity
            $this->pick_quantity->setupEditAttributes();
            $this->pick_quantity->EditCustomAttributes = "";
            $this->pick_quantity->EditValue = HtmlEncode($this->pick_quantity->CurrentValue);
            $this->pick_quantity->PlaceHolder = RemoveHtml($this->pick_quantity->caption());
            if (strval($this->pick_quantity->EditValue) != "" && is_numeric($this->pick_quantity->EditValue)) {
                $this->pick_quantity->EditValue = FormatNumber($this->pick_quantity->EditValue, null);
            }

            // excess
            $this->excess->setupEditAttributes();
            $this->excess->EditCustomAttributes = "";
            $this->excess->EditValue = HtmlEncode($this->excess->CurrentValue);
            $this->excess->PlaceHolder = RemoveHtml($this->excess->caption());
            if (strval($this->excess->EditValue) != "" && is_numeric($this->excess->EditValue)) {
                $this->excess->EditValue = FormatNumber($this->excess->EditValue, null);
            }

            // user
            $this->user->setupEditAttributes();
            $this->user->EditCustomAttributes = "";
            if (!$this->user->Raw) {
                $this->user->CurrentValue = HtmlDecode($this->user->CurrentValue);
            }
            $this->user->EditValue = HtmlEncode($this->user->CurrentValue);
            $this->user->PlaceHolder = RemoveHtml($this->user->caption());

            // area
            $this->area->setupEditAttributes();
            $this->area->EditCustomAttributes = "";
            if (!$this->area->Raw) {
                $this->area->CurrentValue = HtmlDecode($this->area->CurrentValue);
            }
            $this->area->EditValue = HtmlEncode($this->area->CurrentValue);
            $this->area->PlaceHolder = RemoveHtml($this->area->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // date_shortpick
            $this->date_shortpick->setupEditAttributes();
            $this->date_shortpick->EditCustomAttributes = "";
            $this->date_shortpick->EditValue = HtmlEncode(FormatDateTime($this->date_shortpick->CurrentValue, $this->date_shortpick->formatPattern()));
            $this->date_shortpick->PlaceHolder = RemoveHtml($this->date_shortpick->caption());

            // date_upload
            $this->date_upload->setupEditAttributes();
            $this->date_upload->EditCustomAttributes = "";
            $this->date_upload->EditValue = HtmlEncode(FormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern()));
            $this->date_upload->PlaceHolder = RemoveHtml($this->date_upload->caption());

            // date_picking
            $this->date_picking->setupEditAttributes();
            $this->date_picking->EditCustomAttributes = "";
            $this->date_picking->EditValue = HtmlEncode(FormatDateTime($this->date_picking->CurrentValue, $this->date_picking->formatPattern()));
            $this->date_picking->PlaceHolder = RemoveHtml($this->date_picking->caption());

            // time_picking
            $this->time_picking->setupEditAttributes();
            $this->time_picking->EditCustomAttributes = "";
            $this->time_picking->EditValue = HtmlEncode(FormatDateTime($this->time_picking->CurrentValue, $this->time_picking->formatPattern()));
            $this->time_picking->PlaceHolder = RemoveHtml($this->time_picking->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // ctn
            $this->ctn->LinkCustomAttributes = "";
            $this->ctn->HrefValue = "";

            // article
            $this->article->LinkCustomAttributes = "";
            $this->article->HrefValue = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";

            // avaiable
            $this->avaiable->LinkCustomAttributes = "";
            $this->avaiable->HrefValue = "";

            // web
            $this->web->LinkCustomAttributes = "";
            $this->web->HrefValue = "";

            // target_quantity
            $this->target_quantity->LinkCustomAttributes = "";
            $this->target_quantity->HrefValue = "";

            // shortpick
            $this->shortpick->LinkCustomAttributes = "";
            $this->shortpick->HrefValue = "";

            // actual
            $this->actual->LinkCustomAttributes = "";
            $this->actual->HrefValue = "";

            // pick_quantity
            $this->pick_quantity->LinkCustomAttributes = "";
            $this->pick_quantity->HrefValue = "";

            // excess
            $this->excess->LinkCustomAttributes = "";
            $this->excess->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // area
            $this->area->LinkCustomAttributes = "";
            $this->area->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // date_shortpick
            $this->date_shortpick->LinkCustomAttributes = "";
            $this->date_shortpick->HrefValue = "";

            // date_upload
            $this->date_upload->LinkCustomAttributes = "";
            $this->date_upload->HrefValue = "";

            // date_picking
            $this->date_picking->LinkCustomAttributes = "";
            $this->date_picking->HrefValue = "";

            // time_picking
            $this->time_picking->LinkCustomAttributes = "";
            $this->time_picking->HrefValue = "";
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
        if ($this->location->Required) {
            if (!$this->location->IsDetailKey && EmptyValue($this->location->FormValue)) {
                $this->location->addErrorMessage(str_replace("%s", $this->location->caption(), $this->location->RequiredErrorMessage));
            }
        }
        if ($this->ctn->Required) {
            if (!$this->ctn->IsDetailKey && EmptyValue($this->ctn->FormValue)) {
                $this->ctn->addErrorMessage(str_replace("%s", $this->ctn->caption(), $this->ctn->RequiredErrorMessage));
            }
        }
        if ($this->article->Required) {
            if (!$this->article->IsDetailKey && EmptyValue($this->article->FormValue)) {
                $this->article->addErrorMessage(str_replace("%s", $this->article->caption(), $this->article->RequiredErrorMessage));
            }
        }
        if ($this->description->Required) {
            if (!$this->description->IsDetailKey && EmptyValue($this->description->FormValue)) {
                $this->description->addErrorMessage(str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
            }
        }
        if ($this->avaiable->Required) {
            if (!$this->avaiable->IsDetailKey && EmptyValue($this->avaiable->FormValue)) {
                $this->avaiable->addErrorMessage(str_replace("%s", $this->avaiable->caption(), $this->avaiable->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->avaiable->FormValue)) {
            $this->avaiable->addErrorMessage($this->avaiable->getErrorMessage(false));
        }
        if ($this->web->Required) {
            if (!$this->web->IsDetailKey && EmptyValue($this->web->FormValue)) {
                $this->web->addErrorMessage(str_replace("%s", $this->web->caption(), $this->web->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->web->FormValue)) {
            $this->web->addErrorMessage($this->web->getErrorMessage(false));
        }
        if ($this->target_quantity->Required) {
            if (!$this->target_quantity->IsDetailKey && EmptyValue($this->target_quantity->FormValue)) {
                $this->target_quantity->addErrorMessage(str_replace("%s", $this->target_quantity->caption(), $this->target_quantity->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->target_quantity->FormValue)) {
            $this->target_quantity->addErrorMessage($this->target_quantity->getErrorMessage(false));
        }
        if ($this->shortpick->Required) {
            if (!$this->shortpick->IsDetailKey && EmptyValue($this->shortpick->FormValue)) {
                $this->shortpick->addErrorMessage(str_replace("%s", $this->shortpick->caption(), $this->shortpick->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->shortpick->FormValue)) {
            $this->shortpick->addErrorMessage($this->shortpick->getErrorMessage(false));
        }
        if ($this->actual->Required) {
            if (!$this->actual->IsDetailKey && EmptyValue($this->actual->FormValue)) {
                $this->actual->addErrorMessage(str_replace("%s", $this->actual->caption(), $this->actual->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->actual->FormValue)) {
            $this->actual->addErrorMessage($this->actual->getErrorMessage(false));
        }
        if ($this->pick_quantity->Required) {
            if (!$this->pick_quantity->IsDetailKey && EmptyValue($this->pick_quantity->FormValue)) {
                $this->pick_quantity->addErrorMessage(str_replace("%s", $this->pick_quantity->caption(), $this->pick_quantity->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pick_quantity->FormValue)) {
            $this->pick_quantity->addErrorMessage($this->pick_quantity->getErrorMessage(false));
        }
        if ($this->excess->Required) {
            if (!$this->excess->IsDetailKey && EmptyValue($this->excess->FormValue)) {
                $this->excess->addErrorMessage(str_replace("%s", $this->excess->caption(), $this->excess->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->excess->FormValue)) {
            $this->excess->addErrorMessage($this->excess->getErrorMessage(false));
        }
        if ($this->user->Required) {
            if (!$this->user->IsDetailKey && EmptyValue($this->user->FormValue)) {
                $this->user->addErrorMessage(str_replace("%s", $this->user->caption(), $this->user->RequiredErrorMessage));
            }
        }
        if ($this->area->Required) {
            if (!$this->area->IsDetailKey && EmptyValue($this->area->FormValue)) {
                $this->area->addErrorMessage(str_replace("%s", $this->area->caption(), $this->area->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->date_shortpick->Required) {
            if (!$this->date_shortpick->IsDetailKey && EmptyValue($this->date_shortpick->FormValue)) {
                $this->date_shortpick->addErrorMessage(str_replace("%s", $this->date_shortpick->caption(), $this->date_shortpick->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_shortpick->FormValue, $this->date_shortpick->formatPattern())) {
            $this->date_shortpick->addErrorMessage($this->date_shortpick->getErrorMessage(false));
        }
        if ($this->date_upload->Required) {
            if (!$this->date_upload->IsDetailKey && EmptyValue($this->date_upload->FormValue)) {
                $this->date_upload->addErrorMessage(str_replace("%s", $this->date_upload->caption(), $this->date_upload->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_upload->FormValue, $this->date_upload->formatPattern())) {
            $this->date_upload->addErrorMessage($this->date_upload->getErrorMessage(false));
        }
        if ($this->date_picking->Required) {
            if (!$this->date_picking->IsDetailKey && EmptyValue($this->date_picking->FormValue)) {
                $this->date_picking->addErrorMessage(str_replace("%s", $this->date_picking->caption(), $this->date_picking->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_picking->FormValue, $this->date_picking->formatPattern())) {
            $this->date_picking->addErrorMessage($this->date_picking->getErrorMessage(false));
        }
        if ($this->time_picking->Required) {
            if (!$this->time_picking->IsDetailKey && EmptyValue($this->time_picking->FormValue)) {
                $this->time_picking->addErrorMessage(str_replace("%s", $this->time_picking->caption(), $this->time_picking->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->time_picking->FormValue, $this->time_picking->formatPattern())) {
            $this->time_picking->addErrorMessage($this->time_picking->getErrorMessage(false));
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

        // location
        $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, null, $this->location->ReadOnly);

        // ctn
        $this->ctn->setDbValueDef($rsnew, $this->ctn->CurrentValue, null, $this->ctn->ReadOnly);

        // article
        $this->article->setDbValueDef($rsnew, $this->article->CurrentValue, null, $this->article->ReadOnly);

        // description
        $this->description->setDbValueDef($rsnew, $this->description->CurrentValue, null, $this->description->ReadOnly);

        // avaiable
        $this->avaiable->setDbValueDef($rsnew, $this->avaiable->CurrentValue, null, $this->avaiable->ReadOnly);

        // web
        $this->web->setDbValueDef($rsnew, $this->web->CurrentValue, null, $this->web->ReadOnly);

        // target_quantity
        $this->target_quantity->setDbValueDef($rsnew, $this->target_quantity->CurrentValue, null, $this->target_quantity->ReadOnly);

        // shortpick
        $this->shortpick->setDbValueDef($rsnew, $this->shortpick->CurrentValue, null, $this->shortpick->ReadOnly);

        // actual
        $this->actual->setDbValueDef($rsnew, $this->actual->CurrentValue, null, $this->actual->ReadOnly);

        // pick_quantity
        $this->pick_quantity->setDbValueDef($rsnew, $this->pick_quantity->CurrentValue, null, $this->pick_quantity->ReadOnly);

        // excess
        $this->excess->setDbValueDef($rsnew, $this->excess->CurrentValue, null, $this->excess->ReadOnly);

        // user
        $this->user->setDbValueDef($rsnew, $this->user->CurrentValue, null, $this->user->ReadOnly);

        // area
        $this->area->setDbValueDef($rsnew, $this->area->CurrentValue, null, $this->area->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

        // date_shortpick
        $this->date_shortpick->setDbValueDef($rsnew, UnFormatDateTime($this->date_shortpick->CurrentValue, $this->date_shortpick->formatPattern()), null, $this->date_shortpick->ReadOnly);

        // date_upload
        $this->date_upload->setDbValueDef($rsnew, UnFormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern()), null, $this->date_upload->ReadOnly);

        // date_picking
        $this->date_picking->setDbValueDef($rsnew, UnFormatDateTime($this->date_picking->CurrentValue, $this->date_picking->formatPattern()), null, $this->date_picking->ReadOnly);

        // time_picking
        $this->time_picking->setDbValueDef($rsnew, UnFormatDateTime($this->time_picking->CurrentValue, $this->time_picking->formatPattern()), null, $this->time_picking->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("findingshortpick2list"), "", $this->TableVar, true);
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

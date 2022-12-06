<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for stock_count_monitor
 */
class StockCountMonitor extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $aisle;
    public $counted_location;
    public $counted_pcs;
    public $progress;
    public $total_stock;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'stock_count_monitor';
        $this->TableName = 'stock_count_monitor';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`stock_count_monitor`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // aisle
        $this->aisle = new DbField(
            'stock_count_monitor',
            'stock_count_monitor',
            'x_aisle',
            'aisle',
            '`aisle`',
            '`aisle`',
            200,
            2,
            -1,
            false,
            '`aisle`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->aisle->InputTextType = "text";
        $this->aisle->Sortable = false; // Allow sort
        $this->aisle->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->aisle->Lookup = new Lookup('aisle', 'stock_count_monitor', true, 'aisle', ["aisle","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->aisle->Lookup = new Lookup('aisle', 'stock_count_monitor', true, 'aisle', ["aisle","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['aisle'] = &$this->aisle;

        // counted_location
        $this->counted_location = new DbField(
            'stock_count_monitor',
            'stock_count_monitor',
            'x_counted_location',
            'counted_location',
            '`counted_location`',
            '`counted_location`',
            20,
            21,
            -1,
            false,
            '`counted_location`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->counted_location->InputTextType = "text";
        $this->counted_location->Nullable = false; // NOT NULL field
        $this->counted_location->Sortable = false; // Allow sort
        $this->counted_location->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->counted_location->Lookup = new Lookup('counted_location', 'stock_count_monitor', true, 'counted_location', ["counted_location","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->counted_location->Lookup = new Lookup('counted_location', 'stock_count_monitor', true, 'counted_location', ["counted_location","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->counted_location->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['counted_location'] = &$this->counted_location;

        // counted_pcs
        $this->counted_pcs = new DbField(
            'stock_count_monitor',
            'stock_count_monitor',
            'x_counted_pcs',
            'counted_pcs',
            '`counted_pcs`',
            '`counted_pcs`',
            20,
            21,
            -1,
            false,
            '`counted_pcs`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->counted_pcs->InputTextType = "text";
        $this->counted_pcs->Nullable = false; // NOT NULL field
        $this->counted_pcs->Sortable = false; // Allow sort
        $this->counted_pcs->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->counted_pcs->Lookup = new Lookup('counted_pcs', 'stock_count_monitor', true, 'counted_pcs', ["counted_pcs","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->counted_pcs->Lookup = new Lookup('counted_pcs', 'stock_count_monitor', true, 'counted_pcs', ["counted_pcs","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->counted_pcs->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['counted_pcs'] = &$this->counted_pcs;

        // progress
        $this->progress = new DbField(
            'stock_count_monitor',
            'stock_count_monitor',
            'x_progress',
            'progress',
            'counted_location*counted_pcs',
            'counted_location*counted_pcs',
            20,
            41,
            -1,
            false,
            'counted_location*counted_pcs',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->progress->InputTextType = "number";
        $this->progress->IsCustom = true; // Custom field
        $this->progress->Sortable = false; // Allow sort
        $this->progress->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['progress'] = &$this->progress;

        // total_stock
        $this->total_stock = new DbField(
            'stock_count_monitor',
            'stock_count_monitor',
            'x_total_stock',
            'total_stock',
            '\'\'',
            '\'\'',
            201,
            65530,
            -1,
            false,
            '\'\'',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->total_stock->InputTextType = "number";
        $this->total_stock->IsCustom = true; // Custom field
        $this->total_stock->Sortable = false; // Allow sort
        $this->Fields['total_stock'] = &$this->total_stock;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`stock_count_monitor`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, counted_location*counted_pcs AS `progress`, '' AS `total_stock`");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->aisle->DbValue = $row['aisle'];
        $this->counted_location->DbValue = $row['counted_location'];
        $this->counted_pcs->DbValue = $row['counted_pcs'];
        $this->progress->DbValue = $row['progress'];
        $this->total_stock->DbValue = $row['total_stock'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("stockcountmonitorlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "stockcountmonitorview") {
            return $Language->phrase("View");
        } elseif ($pageName == "stockcountmonitoredit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "stockcountmonitoradd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "StockCountMonitorView";
            case Config("API_ADD_ACTION"):
                return "StockCountMonitorAdd";
            case Config("API_EDIT_ACTION"):
                return "StockCountMonitorEdit";
            case Config("API_DELETE_ACTION"):
                return "StockCountMonitorDelete";
            case Config("API_LIST_ACTION"):
                return "StockCountMonitorList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "stockcountmonitorlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("stockcountmonitorview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("stockcountmonitorview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "stockcountmonitoradd?" . $this->getUrlParm($parm);
        } else {
            $url = "stockcountmonitoradd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("stockcountmonitoredit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("stockcountmonitoradd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("stockcountmonitordelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->aisle->setDbValue($row['aisle']);
        $this->counted_location->setDbValue($row['counted_location']);
        $this->counted_pcs->setDbValue($row['counted_pcs']);
        $this->progress->setDbValue($row['progress']);
        $this->total_stock->setDbValue($row['total_stock']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // aisle
        $this->aisle->CellCssStyle = "white-space: nowrap;";

        // counted_location
        $this->counted_location->CellCssStyle = "white-space: nowrap;";

        // counted_pcs
        $this->counted_pcs->CellCssStyle = "white-space: nowrap;";

        // progress
        $this->progress->CellCssStyle = "min-width: 10rem; white-space: nowrap;";

        // total_stock
        $this->total_stock->CellCssStyle = "white-space: nowrap;";

        // aisle
        $this->aisle->ViewValue = $this->aisle->CurrentValue;
        $this->aisle->ViewCustomAttributes = "";

        // counted_location
        $this->counted_location->ViewValue = $this->counted_location->CurrentValue;
        $this->counted_location->ViewValue = FormatNumber($this->counted_location->ViewValue, $this->counted_location->formatPattern());
        $this->counted_location->ViewCustomAttributes = "";

        // counted_pcs
        $this->counted_pcs->ViewValue = $this->counted_pcs->CurrentValue;
        $this->counted_pcs->ViewValue = FormatNumber($this->counted_pcs->ViewValue, $this->counted_pcs->formatPattern());
        $this->counted_pcs->ViewCustomAttributes = "";

        // progress
        $this->progress->ViewValue = $this->progress->CurrentValue;
        $this->progress->ViewValue = FormatNumber($this->progress->ViewValue, $this->progress->formatPattern());
        $this->progress->ViewCustomAttributes = "";

        // total_stock
        $this->total_stock->ViewValue = $this->total_stock->CurrentValue;
        $this->total_stock->ViewCustomAttributes = "";

        // aisle
        $this->aisle->LinkCustomAttributes = "";
        $this->aisle->HrefValue = "";
        $this->aisle->TooltipValue = "";

        // counted_location
        $this->counted_location->LinkCustomAttributes = "";
        $this->counted_location->HrefValue = "";
        $this->counted_location->TooltipValue = "";

        // counted_pcs
        $this->counted_pcs->LinkCustomAttributes = "";
        $this->counted_pcs->HrefValue = "";
        $this->counted_pcs->TooltipValue = "";

        // progress
        $this->progress->LinkCustomAttributes = "";
        $this->progress->HrefValue = "";
        $this->progress->TooltipValue = "";

        // total_stock
        $this->total_stock->LinkCustomAttributes = "";
        $this->total_stock->HrefValue = "";
        $this->total_stock->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // aisle
        $this->aisle->setupEditAttributes();
        $this->aisle->EditCustomAttributes = "";
        if (!$this->aisle->Raw) {
            $this->aisle->CurrentValue = HtmlDecode($this->aisle->CurrentValue);
        }
        $this->aisle->EditValue = $this->aisle->CurrentValue;
        $this->aisle->PlaceHolder = RemoveHtml($this->aisle->caption());

        // counted_location
        $this->counted_location->setupEditAttributes();
        $this->counted_location->EditCustomAttributes = "";
        $this->counted_location->EditValue = $this->counted_location->CurrentValue;
        $this->counted_location->PlaceHolder = RemoveHtml($this->counted_location->caption());
        if (strval($this->counted_location->EditValue) != "" && is_numeric($this->counted_location->EditValue)) {
            $this->counted_location->EditValue = FormatNumber($this->counted_location->EditValue, null);
        }

        // counted_pcs
        $this->counted_pcs->setupEditAttributes();
        $this->counted_pcs->EditCustomAttributes = "";
        $this->counted_pcs->EditValue = $this->counted_pcs->CurrentValue;
        $this->counted_pcs->PlaceHolder = RemoveHtml($this->counted_pcs->caption());
        if (strval($this->counted_pcs->EditValue) != "" && is_numeric($this->counted_pcs->EditValue)) {
            $this->counted_pcs->EditValue = FormatNumber($this->counted_pcs->EditValue, null);
        }

        // progress
        $this->progress->setupEditAttributes();
        $this->progress->EditCustomAttributes = "";
        $this->progress->EditValue = $this->progress->CurrentValue;
        $this->progress->PlaceHolder = RemoveHtml($this->progress->caption());
        if (strval($this->progress->EditValue) != "" && is_numeric($this->progress->EditValue)) {
            $this->progress->EditValue = FormatNumber($this->progress->EditValue, null);
        }

        // total_stock
        $this->total_stock->setupEditAttributes();
        $this->total_stock->EditCustomAttributes = "";
        if (!$this->total_stock->Raw) {
            $this->total_stock->CurrentValue = HtmlDecode($this->total_stock->CurrentValue);
        }
        $this->total_stock->EditValue = $this->total_stock->CurrentValue;
        $this->total_stock->PlaceHolder = RemoveHtml($this->total_stock->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->aisle);
                    $doc->exportCaption($this->counted_location);
                    $doc->exportCaption($this->counted_pcs);
                    $doc->exportCaption($this->progress);
                } else {
                    $doc->exportCaption($this->aisle);
                    $doc->exportCaption($this->counted_location);
                    $doc->exportCaption($this->counted_pcs);
                    $doc->exportCaption($this->progress);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->aisle);
                        $doc->exportField($this->counted_location);
                        $doc->exportField($this->counted_pcs);
                        $doc->exportField($this->progress);
                    } else {
                        $doc->exportField($this->aisle);
                        $doc->exportField($this->counted_location);
                        $doc->exportField($this->counted_pcs);
                        $doc->exportField($this->progress);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->ExportDoc = &$doc;
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
        		$currentDate = CurrentDate();
                $_aisle = $this->aisle->CurrentValue;

                //total stock
                    $total_stock = "SELECT active_bin FROM `active_stock` WHERE `aisle` = '$_aisle'  ";
                    $_total_stock = ExecuteScalar($total_stock);
                $total = 0;
                $total = @round(($this->counted_location->CurrentValue /$_total_stock) * 100,2);
                //Progress Bar Start
                $this->progress->ViewValue = "
                <div class='progress' style='overflow: hidden;background-color: #e9ecef;height: 1.5rem;box-shadow: inset 0 1.5px 3px rgb(0 0 0 / 8%);border-radius: 0.45rem'>
                <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='".$total." aria-valuemin='0' aria-valuemax='100' style='height: 1.5rem;font-size: 1rem;border-radius: 0.45rem;min-width: 2em; width: ".$total."%'>".$total."%
                </div></div></div>";
                //Progress Bar End
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

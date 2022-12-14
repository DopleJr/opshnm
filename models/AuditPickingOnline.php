<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for audit_picking_online
 */
class AuditPickingOnline extends DbTable
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
    public $id;
    public $scan;
    public $box_code;
    public $store_id;
    public $store_name;
    public $picked_qty;
    public $scan_qty;
    public $checker;
    public $status;
    public $article;
    public $date_update;
    public $time_update;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'audit_picking_online';
        $this->TableName = 'audit_picking_online';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`audit_picking_online`";
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

        // id
        $this->id = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            11,
            -1,
            false,
            '`id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = false; // Allow sort
        $this->id->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->id->Lookup = new Lookup('id', 'audit_picking_online', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'audit_picking_online', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // scan
        $this->scan = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_scan',
            'scan',
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
        $this->scan->InputTextType = "text";
        $this->scan->IsCustom = true; // Custom field
        $this->scan->Sortable = false; // Allow sort
        $this->scan->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->scan->Lookup = new Lookup('scan', 'check_box', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "`article`");
                break;
            default:
                $this->scan->Lookup = new Lookup('scan', 'check_box', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "`article`");
                break;
        }
        $this->Fields['scan'] = &$this->scan;

        // box_code
        $this->box_code = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_box_code',
            'box_code',
            '`box_code`',
            '`box_code`',
            200,
            255,
            -1,
            false,
            '`box_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->box_code->InputTextType = "text";
        $this->box_code->Nullable = false; // NOT NULL field
        $this->box_code->Required = true; // Required field
        $this->box_code->Sortable = false; // Allow sort
        $this->box_code->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->box_code->Lookup = new Lookup('box_code', 'box_picking_online', true, 'box_id', ["box_id","","",""], [], ["x_store_id"], [], [], [], [], '', '', "`box_id`");
                break;
            default:
                $this->box_code->Lookup = new Lookup('box_code', 'box_picking_online', true, 'box_id', ["box_id","","",""], [], ["x_store_id"], [], [], [], [], '', '', "`box_id`");
                break;
        }
        $this->Fields['box_code'] = &$this->box_code;

        // store_id
        $this->store_id = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_store_id',
            'store_id',
            '`store_id`',
            '`store_id`',
            200,
            4,
            -1,
            false,
            '`store_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->store_id->InputTextType = "text";
        $this->store_id->Nullable = false; // NOT NULL field
        $this->store_id->Required = true; // Required field
        $this->store_id->Sortable = false; // Allow sort
        $this->store_id->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->store_id->Lookup = new Lookup('store_id', 'box_picking_online', true, 'store_code', ["store_code","","",""], ["x_box_code"], [], ["box_id"], ["x_box_id"], ["store_name","picked_qty","scan_qty"], ["x_store_name","x_picked_qty","x_scan_qty"], '', '', "`store_code`");
                break;
            default:
                $this->store_id->Lookup = new Lookup('store_id', 'box_picking_online', true, 'store_code', ["store_code","","",""], ["x_box_code"], [], ["box_id"], ["x_box_id"], ["store_name","picked_qty","scan_qty"], ["x_store_name","x_picked_qty","x_scan_qty"], '', '', "`store_code`");
                break;
        }
        $this->Fields['store_id'] = &$this->store_id;

        // store_name
        $this->store_name = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_store_name',
            'store_name',
            '`store_name`',
            '`store_name`',
            200,
            50,
            -1,
            false,
            '`store_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->store_name->InputTextType = "text";
        $this->store_name->Nullable = false; // NOT NULL field
        $this->store_name->Required = true; // Required field
        $this->store_name->Sortable = false; // Allow sort
        $this->store_name->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->store_name->Lookup = new Lookup('store_name', 'box_picking_online', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "`store_name`");
                break;
            default:
                $this->store_name->Lookup = new Lookup('store_name', 'box_picking_online', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "`store_name`");
                break;
        }
        $this->Fields['store_name'] = &$this->store_name;

        // picked_qty
        $this->picked_qty = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_picked_qty',
            'picked_qty',
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
        $this->picked_qty->InputTextType = "text";
        $this->picked_qty->IsCustom = true; // Custom field
        $this->picked_qty->Sortable = false; // Allow sort
        $this->picked_qty->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->picked_qty->Lookup = new Lookup('picked_qty', 'box_picking_online', true, 'picked_qty', ["picked_qty","","",""], [], [], [], [], [], [], '', '', "`picked_qty`");
                break;
            default:
                $this->picked_qty->Lookup = new Lookup('picked_qty', 'box_picking_online', true, 'picked_qty', ["picked_qty","","",""], [], [], [], [], [], [], '', '', "`picked_qty`");
                break;
        }
        $this->Fields['picked_qty'] = &$this->picked_qty;

        // scan_qty
        $this->scan_qty = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_scan_qty',
            'scan_qty',
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
        $this->scan_qty->InputTextType = "text";
        $this->scan_qty->IsCustom = true; // Custom field
        $this->scan_qty->Sortable = false; // Allow sort
        $this->scan_qty->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->scan_qty->Lookup = new Lookup('scan_qty', 'box_picking_online', true, 'scan_qty', ["scan_qty","","",""], [], [], [], [], [], [], '', '', "`scan_qty`");
                break;
            default:
                $this->scan_qty->Lookup = new Lookup('scan_qty', 'box_picking_online', true, 'scan_qty', ["scan_qty","","",""], [], [], [], [], [], [], '', '', "`scan_qty`");
                break;
        }
        $this->Fields['scan_qty'] = &$this->scan_qty;

        // checker
        $this->checker = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_checker',
            'checker',
            '`checker`',
            '`checker`',
            200,
            50,
            -1,
            false,
            '`checker`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->checker->InputTextType = "text";
        $this->checker->Nullable = false; // NOT NULL field
        $this->checker->Required = true; // Required field
        $this->checker->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->checker->Lookup = new Lookup('checker', 'audit_picking_online', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->checker->Lookup = new Lookup('checker', 'audit_picking_online', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['checker'] = &$this->checker;

        // status
        $this->status = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_status',
            'status',
            '`status`',
            '`status`',
            200,
            20,
            -1,
            false,
            '`status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->status->InputTextType = "text";
        $this->status->Nullable = false; // NOT NULL field
        $this->status->Required = true; // Required field
        $this->status->Sortable = false; // Allow sort
        $this->status->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->status->Lookup = new Lookup('status', 'audit_picking_online', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'audit_picking_online', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['status'] = &$this->status;

        // article
        $this->article = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_article',
            'article',
            '`article`',
            '`article`',
            200,
            16,
            -1,
            false,
            '`article`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->article->InputTextType = "text";
        $this->article->Nullable = false; // NOT NULL field
        $this->article->Required = true; // Required field
        $this->article->Sortable = false; // Allow sort
        $this->article->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->article->Lookup = new Lookup('article', 'check_box', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "`article`");
                break;
            default:
                $this->article->Lookup = new Lookup('article', 'check_box', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "`article`");
                break;
        }
        $this->Fields['article'] = &$this->article;

        // date_update
        $this->date_update = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_date_update',
            'date_update',
            '`date_update`',
            CastDateFieldForLike("`date_update`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_update`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_update->InputTextType = "text";
        $this->date_update->Nullable = false; // NOT NULL field
        $this->date_update->Sortable = false; // Allow sort
        $this->date_update->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_update->Lookup = new Lookup('date_update', 'audit_picking_online', true, 'date_update', ["date_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_update->Lookup = new Lookup('date_update', 'audit_picking_online', true, 'date_update', ["date_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_update->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_update'] = &$this->date_update;

        // time_update
        $this->time_update = new DbField(
            'audit_picking_online',
            'audit_picking_online',
            'x_time_update',
            'time_update',
            '`time_update`',
            CastDateFieldForLike("`time_update`", 3, "DB"),
            134,
            10,
            3,
            false,
            '`time_update`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->time_update->InputTextType = "text";
        $this->time_update->Nullable = false; // NOT NULL field
        $this->time_update->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->time_update->Lookup = new Lookup('time_update', 'audit_picking_online', true, 'time_update', ["time_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->time_update->Lookup = new Lookup('time_update', 'audit_picking_online', true, 'time_update', ["time_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->time_update->DefaultErrorMessage = str_replace("%s", DateFormat(3), $Language->phrase("IncorrectDate"));
        $this->Fields['time_update'] = &$this->time_update;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`audit_picking_online`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, '' AS `scan`, '' AS `picked_qty`, '' AS `scan_qty`");
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
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
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
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
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
        $this->id->DbValue = $row['id'];
        $this->scan->DbValue = $row['scan'];
        $this->box_code->DbValue = $row['box_code'];
        $this->store_id->DbValue = $row['store_id'];
        $this->store_name->DbValue = $row['store_name'];
        $this->picked_qty->DbValue = $row['picked_qty'];
        $this->scan_qty->DbValue = $row['scan_qty'];
        $this->checker->DbValue = $row['checker'];
        $this->status->DbValue = $row['status'];
        $this->article->DbValue = $row['article'];
        $this->date_update->DbValue = $row['date_update'];
        $this->time_update->DbValue = $row['time_update'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("auditpickingonlinelist");
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
        if ($pageName == "auditpickingonlineview") {
            return $Language->phrase("View");
        } elseif ($pageName == "auditpickingonlineedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "auditpickingonlineadd") {
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
                return "AuditPickingOnlineView";
            case Config("API_ADD_ACTION"):
                return "AuditPickingOnlineAdd";
            case Config("API_EDIT_ACTION"):
                return "AuditPickingOnlineEdit";
            case Config("API_DELETE_ACTION"):
                return "AuditPickingOnlineDelete";
            case Config("API_LIST_ACTION"):
                return "AuditPickingOnlineList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "auditpickingonlinelist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("auditpickingonlineview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("auditpickingonlineview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "auditpickingonlineadd?" . $this->getUrlParm($parm);
        } else {
            $url = "auditpickingonlineadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("auditpickingonlineedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("auditpickingonlineadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("auditpickingonlinedelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
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
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
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
        $this->id->setDbValue($row['id']);
        $this->scan->setDbValue($row['scan']);
        $this->box_code->setDbValue($row['box_code']);
        $this->store_id->setDbValue($row['store_id']);
        $this->store_name->setDbValue($row['store_name']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->scan_qty->setDbValue($row['scan_qty']);
        $this->checker->setDbValue($row['checker']);
        $this->status->setDbValue($row['status']);
        $this->article->setDbValue($row['article']);
        $this->date_update->setDbValue($row['date_update']);
        $this->time_update->setDbValue($row['time_update']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // scan
        $this->scan->CellCssStyle = "white-space: nowrap;";

        // box_code
        $this->box_code->CellCssStyle = "white-space: nowrap;";

        // store_id
        $this->store_id->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // picked_qty
        $this->picked_qty->CellCssStyle = "white-space: nowrap;";

        // scan_qty
        $this->scan_qty->CellCssStyle = "white-space: nowrap;";

        // checker
        $this->checker->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // article
        $this->article->CellCssStyle = "white-space: nowrap;";

        // date_update
        $this->date_update->CellCssStyle = "white-space: nowrap;";

        // time_update

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // scan
        $this->scan->ViewValue = $this->scan->CurrentValue;
        $this->scan->ViewCustomAttributes = "";

        // box_code
        $this->box_code->ViewValue = $this->box_code->CurrentValue;
        $this->box_code->ViewCustomAttributes = "";

        // store_id
        $this->store_id->ViewValue = $this->store_id->CurrentValue;
        $this->store_id->ViewCustomAttributes = "";

        // store_name
        $this->store_name->ViewValue = $this->store_name->CurrentValue;
        $this->store_name->ViewCustomAttributes = "";

        // picked_qty
        $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->ViewCustomAttributes = "";

        // scan_qty
        $this->scan_qty->ViewValue = $this->scan_qty->CurrentValue;
        $this->scan_qty->ViewCustomAttributes = "";

        // checker
        $this->checker->ViewValue = $this->checker->CurrentValue;
        $this->checker->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // article
        $this->article->ViewValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

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

        // scan
        $this->scan->LinkCustomAttributes = "";
        $this->scan->HrefValue = "";
        $this->scan->TooltipValue = "";

        // box_code
        $this->box_code->LinkCustomAttributes = "";
        $this->box_code->HrefValue = "";
        $this->box_code->TooltipValue = "";

        // store_id
        $this->store_id->LinkCustomAttributes = "";
        $this->store_id->HrefValue = "";
        $this->store_id->TooltipValue = "";

        // store_name
        $this->store_name->LinkCustomAttributes = "";
        $this->store_name->HrefValue = "";
        $this->store_name->TooltipValue = "";

        // picked_qty
        $this->picked_qty->LinkCustomAttributes = "";
        $this->picked_qty->HrefValue = "";
        $this->picked_qty->TooltipValue = "";

        // scan_qty
        $this->scan_qty->LinkCustomAttributes = "";
        $this->scan_qty->HrefValue = "";
        $this->scan_qty->TooltipValue = "";

        // checker
        $this->checker->LinkCustomAttributes = "";
        $this->checker->HrefValue = "";
        $this->checker->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // article
        $this->article->LinkCustomAttributes = "";
        $this->article->HrefValue = "";
        $this->article->TooltipValue = "";

        // date_update
        $this->date_update->LinkCustomAttributes = "";
        $this->date_update->HrefValue = "";
        $this->date_update->TooltipValue = "";

        // time_update
        $this->time_update->LinkCustomAttributes = "";
        $this->time_update->HrefValue = "";
        $this->time_update->TooltipValue = "";

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

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // scan
        $this->scan->setupEditAttributes();
        $this->scan->EditCustomAttributes = 'autofocus';
        if (!$this->scan->Raw) {
            $this->scan->CurrentValue = HtmlDecode($this->scan->CurrentValue);
        }
        $this->scan->EditValue = $this->scan->CurrentValue;
        $this->scan->PlaceHolder = RemoveHtml($this->scan->caption());

        // box_code
        $this->box_code->setupEditAttributes();
        $this->box_code->EditCustomAttributes = "";
        if (!$this->box_code->Raw) {
            $this->box_code->CurrentValue = HtmlDecode($this->box_code->CurrentValue);
        }
        $this->box_code->EditValue = $this->box_code->CurrentValue;
        $this->box_code->PlaceHolder = RemoveHtml($this->box_code->caption());

        // store_id
        $this->store_id->setupEditAttributes();
        $this->store_id->EditCustomAttributes = 'readonly';
        if (!$this->store_id->Raw) {
            $this->store_id->CurrentValue = HtmlDecode($this->store_id->CurrentValue);
        }
        $this->store_id->EditValue = $this->store_id->CurrentValue;
        $this->store_id->PlaceHolder = RemoveHtml($this->store_id->caption());

        // store_name
        $this->store_name->setupEditAttributes();
        $this->store_name->EditCustomAttributes = 'readonly';
        if (!$this->store_name->Raw) {
            $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
        }
        $this->store_name->EditValue = $this->store_name->CurrentValue;
        $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

        // picked_qty
        $this->picked_qty->setupEditAttributes();
        $this->picked_qty->EditCustomAttributes = 'readonly';
        if (!$this->picked_qty->Raw) {
            $this->picked_qty->CurrentValue = HtmlDecode($this->picked_qty->CurrentValue);
        }
        $this->picked_qty->EditValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());

        // scan_qty
        $this->scan_qty->setupEditAttributes();
        $this->scan_qty->EditCustomAttributes = 'readonly';
        if (!$this->scan_qty->Raw) {
            $this->scan_qty->CurrentValue = HtmlDecode($this->scan_qty->CurrentValue);
        }
        $this->scan_qty->EditValue = $this->scan_qty->CurrentValue;
        $this->scan_qty->PlaceHolder = RemoveHtml($this->scan_qty->caption());

        // checker
        $this->checker->setupEditAttributes();
        $this->checker->EditCustomAttributes = 'readonly';
        if (!$this->checker->Raw) {
            $this->checker->CurrentValue = HtmlDecode($this->checker->CurrentValue);
        }
        $this->checker->EditValue = $this->checker->CurrentValue;
        $this->checker->PlaceHolder = RemoveHtml($this->checker->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // article
        $this->article->setupEditAttributes();
        $this->article->EditCustomAttributes = 'readonly';
        if (!$this->article->Raw) {
            $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
        }
        $this->article->EditValue = $this->article->CurrentValue;
        $this->article->PlaceHolder = RemoveHtml($this->article->caption());

        // date_update

        // time_update

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
            $this->article->Count++; // Increment count
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
            $this->article->CurrentValue = $this->article->Count;
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";
            $this->article->HrefValue = ""; // Clear href value

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->box_code);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->checker);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->date_update);
                    $doc->exportCaption($this->time_update);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->box_code);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->checker);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->date_update);
                    $doc->exportCaption($this->time_update);
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
                $this->aggregateListRowValues(); // Aggregate row values

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->box_code);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->checker);
                        $doc->exportField($this->status);
                        $doc->exportField($this->article);
                        $doc->exportField($this->date_update);
                        $doc->exportField($this->time_update);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->box_code);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->checker);
                        $doc->exportField($this->status);
                        $doc->exportField($this->article);
                        $doc->exportField($this->date_update);
                        $doc->exportField($this->time_update);
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

        // Export aggregates (horizontal format only)
        if ($doc->Horizontal) {
            $this->RowType = ROWTYPE_AGGREGATE;
            $this->resetAttributes();
            $this->aggregateListRow();
            if (!$doc->ExportCustom) {
                $doc->beginExportRow(-1);
                $doc->exportAggregate($this->id, '');
                $doc->exportAggregate($this->box_code, '');
                $doc->exportAggregate($this->store_id, '');
                $doc->exportAggregate($this->store_name, '');
                $doc->exportAggregate($this->checker, '');
                $doc->exportAggregate($this->status, '');
                $doc->exportAggregate($this->article, 'COUNT');
                $doc->exportAggregate($this->date_update, '');
                $doc->exportAggregate($this->time_update, '');
                $doc->endExportRow();
            }
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
        	$_box_code  	= $rsnew["box_code"];
            $_store_id  	= $rsnew["store_id"];
            $_article  		= $rsnew["article"];
            $currentDate2 = CurrentDate();
            $compare1 = "SELECT count(`article`) FROM `picking` WHERE `box_code` =  '$_box_code' AND `store_id` = '$_store_id' AND `article` = '$_article'  ";
            $_compare1 = ExecuteScalar($compare1);
            $compare_qty = "SELECT sum(`picked_qty`) FROM `picking` WHERE `box_code` =  '$_box_code' AND `store_id` = '$_store_id' AND `article` = '$_article'  ";
            $_compare_qty = ExecuteScalar($compare_qty);
            $compare_qty2 = "SELECT count(`article`) FROM `audit_picking_online` WHERE `box_code` =  '$_box_code' AND `store_id` = '$_store_id' AND `article` = '$_article'  ";
            $_compare_qty2 = ExecuteScalar($compare_qty2);
            if($_compare1 == 0 ){
            	//console.log('cek_dobel');
            	$this->setWarningMessage("Not Belong Article");
            	return false;
            }
            if($_compare_qty2 == $_compare_qty ){
            	//console.log('cek_dobel');
            	$this->setWarningMessage("Excess Article");
            	return false;
            }
            if($_compare_qty2 < $_compare_qty ) {
            	//$this->setWarningMessage("Excess Article");
            	//console.log('cek_dobel');
            	return true;
            }
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
        $currentDate = CurrentDate();
        $currentTime = CurrentTime();
        $currentUser = CurrentUsername();
        $_box 		= $rsnew["box_code"];
        $_store 	= $rsnew["store_id"];
        $_scan		= $rsnew["scan_qty"];
        $_status 	= $rsnew["status"];
        //after insert
        $update = "UPDATE `box_picking_online` SET `scan_qty` = '$_scan' ,`date_updated` = '$currentDate' WHERE `box_id` = '$_box' AND `store_code` = '$_store' ";
        $_update = ExecuteStatement($update);
        //---
        $qtybox = "SELECT `picked_qty` From `box_picking_online` WHERE `box_id` = '$_box' AND `store_code` = '$_store' ";
        $_qtybox = ExecuteScalar($qtybox);
        $qtyscan = "SELECT `scan_qty` From `box_picking_online` WHERE `box_id` = '$_box' AND `store_code` = '$_store' ";
        $_qtyscan = ExecuteScalar($qtyscan);
        //update status
        $update2 = "UPDATE `box_picking_online` SET `status` = 'Match' ,`date_updated` = '$currentDate' WHERE `box_id` = '$_box' AND `store_code` = '$_store' ";
        $update3 = "UPDATE `box_picking_online` SET `status` = 'Excess' ,`date_updated` = '$currentDate' WHERE `box_id` = '$_box' AND `store_code` = '$_store' ";
        if($_qtybox == $_qtyscan){
        	$_update2 = ExecuteStatement($update2);
        }
        if($_qtybox < $_qtyscan){
        	$_update3 = ExecuteStatement($update3);
        }
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
        	$currentDate = CurrentDate();
            $currentDateTime = CurrentDateTime();
            $_user = CurrentUserName();
            $_boxcode = $rs["box_code"];
            $_storeid = $rs["store_id"];
            $_storename = $rs["store_name"];
            $_scanqty = $rs["scan_qty"];
            //Delete Price Tag
            $compare1 = "SELECT count(`box_id`) FROM `box_picking_online` WHERE  `box_id` = '$_boxcode' AND `store_code` =  '$_storeid' AND `store_name` =  '$_storename' ";
            $_compare1 = ExecuteScalar($compare1);
            $result_true1 = "UPDATE box_picking_online SET `scan_qty` = ( `scan_qty` - '1'), `date_updated` = '$currentDate'  WHERE `box_id` = '$_boxcode' AND `store_code` =  '$_storeid' AND `store_name` =  '$_storename' ";
            //Delete QR
            $result_true2 = "UPDATE extra_stock SET `scan_qty` = ( `scan_qty` - '1'), `date_updated` = '$currentDate'  WHERE `box_id` = '$_boxcode' AND `store_code` =  '$_storeid' AND `store_name` =  '$_storename' ";
            //
            if($_compare1 == 0  ){
            $this->setWarningMessage("No Record");
            //console.log('statement1');
            }
            else{
            ExecuteStatement($result_true1);
            $this->setSuccessMessage("Record Updated");
            //console.log('statement2');
            }
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
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for monitor_staging_delivered
 */
class MonitorStagingDelivered extends DbTable
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
    public $week;
    public $aging;
    public $store_name;
    public $store_code;
    public $box_id;
    public $type;
    public $concept;
    public $quantity;
    public $picking_date;
    public $date_created;
    public $status;
    public $users;
    public $date_updated;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'monitor_staging_delivered';
        $this->TableName = 'monitor_staging_delivered';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`monitor_staging_delivered`";
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
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            10,
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // week
        $this->week = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_week',
            'week',
            'substring(yearweek(picking_date),5,6)',
            'substring(yearweek(picking_date),5,6)',
            200,
            2,
            -1,
            false,
            'substring(yearweek(picking_date),5,6)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->week->InputTextType = "text";
        $this->week->IsCustom = true; // Custom field
        $this->week->UseFilter = true; // Table header filter
        $this->week->Lookup = new Lookup('week', 'monitor_staging_delivered', true, 'week', ["week","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['week'] = &$this->week;

        // aging
        $this->aging = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_aging',
            'aging',
            'DATEDIFF( now(),picking_date)',
            'DATEDIFF( now(),picking_date)',
            20,
            7,
            -1,
            false,
            'DATEDIFF( now(),picking_date)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->aging->InputTextType = "text";
        $this->aging->IsCustom = true; // Custom field
        $this->aging->UseFilter = true; // Table header filter
        $this->aging->Lookup = new Lookup('aging', 'monitor_staging_delivered', true, 'aging', ["aging","","",""], [], [], [], [], [], [], '', '', "");
        $this->aging->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['aging'] = &$this->aging;

        // store_name
        $this->store_name = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_store_name',
            'store_name',
            '`store_name`',
            '`store_name`',
            200,
            255,
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
        $this->store_name->UseFilter = true; // Table header filter
        $this->store_name->Lookup = new Lookup('store_name', 'monitor_staging_delivered', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['store_name'] = &$this->store_name;

        // store_code
        $this->store_code = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_store_code',
            'store_code',
            '`store_code`',
            '`store_code`',
            200,
            255,
            -1,
            false,
            '`store_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->store_code->InputTextType = "text";
        $this->store_code->UseFilter = true; // Table header filter
        $this->store_code->Lookup = new Lookup('store_code', 'monitor_staging_delivered', true, 'store_code', ["store_code","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['store_code'] = &$this->store_code;

        // box_id
        $this->box_id = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_box_id',
            'box_id',
            '`box_id`',
            '`box_id`',
            200,
            255,
            -1,
            false,
            '`box_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->box_id->InputTextType = "text";
        $this->box_id->UseFilter = true; // Table header filter
        $this->box_id->Lookup = new Lookup('box_id', 'monitor_staging_delivered', true, 'box_id', ["box_id","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['box_id'] = &$this->box_id;

        // type
        $this->type = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_type',
            'type',
            '`type`',
            '`type`',
            200,
            255,
            -1,
            false,
            '`type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->type->InputTextType = "text";
        $this->type->UseFilter = true; // Table header filter
        $this->type->Lookup = new Lookup('type', 'monitor_staging_delivered', true, 'type', ["type","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['type'] = &$this->type;

        // concept
        $this->concept = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_concept',
            'concept',
            '`concept`',
            '`concept`',
            200,
            4,
            -1,
            false,
            '`concept`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->concept->InputTextType = "text";
        $this->concept->UseFilter = true; // Table header filter
        $this->concept->Lookup = new Lookup('concept', 'monitor_staging_delivered', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['concept'] = &$this->concept;

        // quantity
        $this->quantity = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_quantity',
            'quantity',
            '`quantity`',
            '`quantity`',
            3,
            4,
            -1,
            false,
            '`quantity`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->quantity->InputTextType = "text";
        $this->quantity->UseFilter = true; // Table header filter
        $this->quantity->Lookup = new Lookup('quantity', 'monitor_staging_delivered', true, 'quantity', ["quantity","","",""], [], [], [], [], [], [], '', '', "");
        $this->quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['quantity'] = &$this->quantity;

        // picking_date
        $this->picking_date = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_picking_date',
            'picking_date',
            '`picking_date`',
            CastDateFieldForLike("`picking_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`picking_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->picking_date->InputTextType = "text";
        $this->picking_date->UseFilter = true; // Table header filter
        $this->picking_date->Lookup = new Lookup('picking_date', 'monitor_staging_delivered', true, 'picking_date', ["picking_date","","",""], [], [], [], [], [], [], '', '', "");
        $this->picking_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['picking_date'] = &$this->picking_date;

        // date_created
        $this->date_created = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_date_created',
            'date_created',
            '`date_created`',
            CastDateFieldForLike("`date_created`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_created`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_created->InputTextType = "text";
        $this->date_created->UseFilter = true; // Table header filter
        $this->date_created->Lookup = new Lookup('date_created', 'monitor_staging_delivered', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_created'] = &$this->date_created;

        // status
        $this->status = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
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
        $this->status->UseFilter = true; // Table header filter
        $this->status->Lookup = new Lookup('status', 'monitor_staging_delivered', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['status'] = &$this->status;

        // users
        $this->users = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_users',
            'users',
            '`users`',
            '`users`',
            200,
            50,
            -1,
            false,
            '`users`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->users->InputTextType = "text";
        $this->users->UseFilter = true; // Table header filter
        $this->users->Lookup = new Lookup('users', 'monitor_staging_delivered', true, 'users', ["users","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['users'] = &$this->users;

        // date_updated
        $this->date_updated = new DbField(
            'monitor_staging_delivered',
            'monitor_staging_delivered',
            'x_date_updated',
            'date_updated',
            '`date_updated`',
            CastDateFieldForLike("`date_updated`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_updated`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_updated->InputTextType = "text";
        $this->date_updated->UseFilter = true; // Table header filter
        $this->date_updated->Lookup = new Lookup('date_updated', 'monitor_staging_delivered', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_updated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_updated'] = &$this->date_updated;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`monitor_staging_delivered`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, substring(yearweek(picking_date),5,6) AS `week`, DATEDIFF( now(),picking_date) AS `aging`");
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
        $this->week->DbValue = $row['week'];
        $this->aging->DbValue = $row['aging'];
        $this->store_name->DbValue = $row['store_name'];
        $this->store_code->DbValue = $row['store_code'];
        $this->box_id->DbValue = $row['box_id'];
        $this->type->DbValue = $row['type'];
        $this->concept->DbValue = $row['concept'];
        $this->quantity->DbValue = $row['quantity'];
        $this->picking_date->DbValue = $row['picking_date'];
        $this->date_created->DbValue = $row['date_created'];
        $this->status->DbValue = $row['status'];
        $this->users->DbValue = $row['users'];
        $this->date_updated->DbValue = $row['date_updated'];
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
        return $_SESSION[$name] ?? GetUrl("monitorstagingdeliveredlist");
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
        if ($pageName == "monitorstagingdeliveredview") {
            return $Language->phrase("View");
        } elseif ($pageName == "monitorstagingdeliverededit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "monitorstagingdeliveredadd") {
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
                return "MonitorStagingDeliveredView";
            case Config("API_ADD_ACTION"):
                return "MonitorStagingDeliveredAdd";
            case Config("API_EDIT_ACTION"):
                return "MonitorStagingDeliveredEdit";
            case Config("API_DELETE_ACTION"):
                return "MonitorStagingDeliveredDelete";
            case Config("API_LIST_ACTION"):
                return "MonitorStagingDeliveredList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "monitorstagingdeliveredlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("monitorstagingdeliveredview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("monitorstagingdeliveredview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "monitorstagingdeliveredadd?" . $this->getUrlParm($parm);
        } else {
            $url = "monitorstagingdeliveredadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("monitorstagingdeliverededit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("monitorstagingdeliveredadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("monitorstagingdelivereddelete", $this->getUrlParm());
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
        $this->week->setDbValue($row['week']);
        $this->aging->setDbValue($row['aging']);
        $this->store_name->setDbValue($row['store_name']);
        $this->store_code->setDbValue($row['store_code']);
        $this->box_id->setDbValue($row['box_id']);
        $this->type->setDbValue($row['type']);
        $this->concept->setDbValue($row['concept']);
        $this->quantity->setDbValue($row['quantity']);
        $this->picking_date->setDbValue($row['picking_date']);
        $this->date_created->setDbValue($row['date_created']);
        $this->status->setDbValue($row['status']);
        $this->users->setDbValue($row['users']);
        $this->date_updated->setDbValue($row['date_updated']);
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

        // week
        $this->week->CellCssStyle = "white-space: nowrap;";

        // aging
        $this->aging->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // store_code
        $this->store_code->CellCssStyle = "white-space: nowrap;";

        // box_id
        $this->box_id->CellCssStyle = "white-space: nowrap;";

        // type
        $this->type->CellCssStyle = "white-space: nowrap;";

        // concept
        $this->concept->CellCssStyle = "white-space: nowrap;";

        // quantity
        $this->quantity->CellCssStyle = "white-space: nowrap;";

        // picking_date
        $this->picking_date->CellCssStyle = "white-space: nowrap;";

        // date_created
        $this->date_created->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // users
        $this->users->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // week
        $this->week->ViewValue = $this->week->CurrentValue;
        $this->week->ViewCustomAttributes = "";

        // aging
        $this->aging->ViewValue = $this->aging->CurrentValue;
        $this->aging->ViewValue = FormatNumber($this->aging->ViewValue, $this->aging->formatPattern());
        $this->aging->ViewCustomAttributes = "";

        // store_name
        $this->store_name->ViewValue = $this->store_name->CurrentValue;
        $this->store_name->ViewCustomAttributes = "";

        // store_code
        $this->store_code->ViewValue = $this->store_code->CurrentValue;
        $this->store_code->ViewCustomAttributes = "";

        // box_id
        $this->box_id->ViewValue = $this->box_id->CurrentValue;
        $this->box_id->ViewCustomAttributes = "";

        // type
        $this->type->ViewValue = $this->type->CurrentValue;
        $this->type->ViewCustomAttributes = "";

        // concept
        $this->concept->ViewValue = $this->concept->CurrentValue;
        $this->concept->ViewCustomAttributes = "";

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());
        $this->quantity->ViewCustomAttributes = "";

        // picking_date
        $this->picking_date->ViewValue = $this->picking_date->CurrentValue;
        $this->picking_date->ViewValue = FormatDateTime($this->picking_date->ViewValue, $this->picking_date->formatPattern());
        $this->picking_date->ViewCustomAttributes = "";

        // date_created
        $this->date_created->ViewValue = $this->date_created->CurrentValue;
        $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
        $this->date_created->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // users
        $this->users->ViewValue = $this->users->CurrentValue;
        $this->users->ViewCustomAttributes = "";

        // date_updated
        $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
        $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
        $this->date_updated->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // week
        $this->week->LinkCustomAttributes = "";
        $this->week->HrefValue = "";
        $this->week->TooltipValue = "";

        // aging
        $this->aging->LinkCustomAttributes = "";
        $this->aging->HrefValue = "";
        $this->aging->TooltipValue = "";

        // store_name
        $this->store_name->LinkCustomAttributes = "";
        $this->store_name->HrefValue = "";
        $this->store_name->TooltipValue = "";

        // store_code
        $this->store_code->LinkCustomAttributes = "";
        $this->store_code->HrefValue = "";
        $this->store_code->TooltipValue = "";

        // box_id
        $this->box_id->LinkCustomAttributes = "";
        $this->box_id->HrefValue = "";
        $this->box_id->TooltipValue = "";

        // type
        $this->type->LinkCustomAttributes = "";
        $this->type->HrefValue = "";
        $this->type->TooltipValue = "";

        // concept
        $this->concept->LinkCustomAttributes = "";
        $this->concept->HrefValue = "";
        $this->concept->TooltipValue = "";

        // quantity
        $this->quantity->LinkCustomAttributes = "";
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

        // picking_date
        $this->picking_date->LinkCustomAttributes = "";
        $this->picking_date->HrefValue = "";
        $this->picking_date->TooltipValue = "";

        // date_created
        $this->date_created->LinkCustomAttributes = "";
        $this->date_created->HrefValue = "";
        $this->date_created->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // users
        $this->users->LinkCustomAttributes = "";
        $this->users->HrefValue = "";
        $this->users->TooltipValue = "";

        // date_updated
        $this->date_updated->LinkCustomAttributes = "";
        $this->date_updated->HrefValue = "";
        $this->date_updated->TooltipValue = "";

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

        // week
        $this->week->setupEditAttributes();
        $this->week->EditCustomAttributes = "";
        if (!$this->week->Raw) {
            $this->week->CurrentValue = HtmlDecode($this->week->CurrentValue);
        }
        $this->week->EditValue = $this->week->CurrentValue;
        $this->week->PlaceHolder = RemoveHtml($this->week->caption());

        // aging
        $this->aging->setupEditAttributes();
        $this->aging->EditCustomAttributes = "";
        $this->aging->EditValue = $this->aging->CurrentValue;
        $this->aging->PlaceHolder = RemoveHtml($this->aging->caption());
        if (strval($this->aging->EditValue) != "" && is_numeric($this->aging->EditValue)) {
            $this->aging->EditValue = FormatNumber($this->aging->EditValue, null);
        }

        // store_name
        $this->store_name->setupEditAttributes();
        $this->store_name->EditCustomAttributes = "";
        if (!$this->store_name->Raw) {
            $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
        }
        $this->store_name->EditValue = $this->store_name->CurrentValue;
        $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

        // store_code
        $this->store_code->setupEditAttributes();
        $this->store_code->EditCustomAttributes = "";
        if (!$this->store_code->Raw) {
            $this->store_code->CurrentValue = HtmlDecode($this->store_code->CurrentValue);
        }
        $this->store_code->EditValue = $this->store_code->CurrentValue;
        $this->store_code->PlaceHolder = RemoveHtml($this->store_code->caption());

        // box_id
        $this->box_id->setupEditAttributes();
        $this->box_id->EditCustomAttributes = "";
        if (!$this->box_id->Raw) {
            $this->box_id->CurrentValue = HtmlDecode($this->box_id->CurrentValue);
        }
        $this->box_id->EditValue = $this->box_id->CurrentValue;
        $this->box_id->PlaceHolder = RemoveHtml($this->box_id->caption());

        // type
        $this->type->setupEditAttributes();
        $this->type->EditCustomAttributes = "";
        if (!$this->type->Raw) {
            $this->type->CurrentValue = HtmlDecode($this->type->CurrentValue);
        }
        $this->type->EditValue = $this->type->CurrentValue;
        $this->type->PlaceHolder = RemoveHtml($this->type->caption());

        // concept
        $this->concept->setupEditAttributes();
        $this->concept->EditCustomAttributes = "";
        if (!$this->concept->Raw) {
            $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
        }
        $this->concept->EditValue = $this->concept->CurrentValue;
        $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditCustomAttributes = "";
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
        }

        // picking_date
        $this->picking_date->setupEditAttributes();
        $this->picking_date->EditCustomAttributes = "";
        $this->picking_date->EditValue = FormatDateTime($this->picking_date->CurrentValue, $this->picking_date->formatPattern());
        $this->picking_date->PlaceHolder = RemoveHtml($this->picking_date->caption());

        // date_created
        $this->date_created->setupEditAttributes();
        $this->date_created->EditCustomAttributes = "";
        $this->date_created->EditValue = FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // users

        // date_updated

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
                    $doc->exportCaption($this->week);
                    $doc->exportCaption($this->aging);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->store_code);
                    $doc->exportCaption($this->box_id);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->picking_date);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->users);
                    $doc->exportCaption($this->date_updated);
                } else {
                    $doc->exportCaption($this->week);
                    $doc->exportCaption($this->aging);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->store_code);
                    $doc->exportCaption($this->box_id);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->picking_date);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->users);
                    $doc->exportCaption($this->date_updated);
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
                        $doc->exportField($this->week);
                        $doc->exportField($this->aging);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->store_code);
                        $doc->exportField($this->box_id);
                        $doc->exportField($this->type);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->picking_date);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->status);
                        $doc->exportField($this->users);
                        $doc->exportField($this->date_updated);
                    } else {
                        $doc->exportField($this->week);
                        $doc->exportField($this->aging);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->store_code);
                        $doc->exportField($this->box_id);
                        $doc->exportField($this->type);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->picking_date);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->status);
                        $doc->exportField($this->users);
                        $doc->exportField($this->date_updated);
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
        if ($this->status->ViewValue == "Match"){ 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: green
                ";}
         elseif ($this->status->ViewValue == "Unmatch") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: grey
                ";}
         elseif ($this->status->ViewValue == "Quarantine") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: red
                ";}
         elseif ($this->status->ViewValue == "Delivered") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: orange
                ";}
         if ($this->Export <> "") {
         //$this->box_id->ViewValue = "'" .$this->box_id->ViewValue;
         $this->box_id->ViewValue = "=\"" . $this->box_id->ViewValue . "\"";
         }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

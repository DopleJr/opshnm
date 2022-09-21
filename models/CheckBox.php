<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for check_box
 */
class CheckBox extends DbTable
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
    public $creation_date;
    public $store_id;
    public $store_name;
    public $article;
    public $size_desc;
    public $color_code;
    public $picked_qty;
    public $variance_qty;
    public $confirmation_date;
    public $confirmation_time;
    public $box_code;
    public $picker;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'check_box';
        $this->TableName = 'check_box';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`check_box`";
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

        // creation_date
        $this->creation_date = new DbField(
            'check_box',
            'check_box',
            'x_creation_date',
            'creation_date',
            '`creation_date`',
            CastDateFieldForLike("`creation_date`", "MM/dd/yyyy", "DB"),
            133,
            10,
            0,
            false,
            '`creation_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->creation_date->InputTextType = "text";
        $this->creation_date->FormatPattern = "MM/dd/yyyy"; // Format pattern
        $this->creation_date->UseFilter = true; // Table header filter
        $this->creation_date->Lookup = new Lookup('creation_date', 'check_box', true, 'creation_date', ["creation_date","","",""], [], [], [], [], [], [], '', '', "");
        $this->creation_date->DefaultErrorMessage = str_replace("%s", "MM/dd/yyyy", $Language->phrase("IncorrectDate"));
        $this->Fields['creation_date'] = &$this->creation_date;

        // store_id
        $this->store_id = new DbField(
            'check_box',
            'check_box',
            'x_store_id',
            'store_id',
            '`store_id`',
            '`store_id`',
            200,
            255,
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
        $this->store_id->UseFilter = true; // Table header filter
        $this->store_id->Lookup = new Lookup('store_id', 'check_box', true, 'store_id', ["store_id","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['store_id'] = &$this->store_id;

        // store_name
        $this->store_name = new DbField(
            'check_box',
            'check_box',
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
        $this->store_name->Lookup = new Lookup('store_name', 'check_box', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['store_name'] = &$this->store_name;

        // article
        $this->article = new DbField(
            'check_box',
            'check_box',
            'x_article',
            'article',
            '`article`',
            '`article`',
            200,
            255,
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
        $this->article->UseFilter = true; // Table header filter
        $this->article->Lookup = new Lookup('article', 'check_box', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['article'] = &$this->article;

        // size_desc
        $this->size_desc = new DbField(
            'check_box',
            'check_box',
            'x_size_desc',
            'size_desc',
            '`size_desc`',
            '`size_desc`',
            200,
            255,
            -1,
            false,
            '`size_desc`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->size_desc->InputTextType = "text";
        $this->size_desc->UseFilter = true; // Table header filter
        $this->size_desc->Lookup = new Lookup('size_desc', 'check_box', true, 'size_desc', ["size_desc","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['size_desc'] = &$this->size_desc;

        // color_code
        $this->color_code = new DbField(
            'check_box',
            'check_box',
            'x_color_code',
            'color_code',
            '`color_code`',
            '`color_code`',
            200,
            255,
            -1,
            false,
            '`color_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->color_code->InputTextType = "text";
        $this->color_code->UseFilter = true; // Table header filter
        $this->color_code->Lookup = new Lookup('color_code', 'check_box', true, 'color_code', ["color_code","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['color_code'] = &$this->color_code;

        // picked_qty
        $this->picked_qty = new DbField(
            'check_box',
            'check_box',
            'x_picked_qty',
            'picked_qty',
            '`picked_qty`',
            '`picked_qty`',
            3,
            11,
            -1,
            false,
            '`picked_qty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->picked_qty->InputTextType = "text";
        $this->picked_qty->UseFilter = true; // Table header filter
        $this->picked_qty->Lookup = new Lookup('picked_qty', 'check_box', true, 'picked_qty', ["picked_qty","","",""], [], [], [], [], [], [], '', '', "");
        $this->picked_qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['picked_qty'] = &$this->picked_qty;

        // variance_qty
        $this->variance_qty = new DbField(
            'check_box',
            'check_box',
            'x_variance_qty',
            'variance_qty',
            '`variance_qty`',
            '`variance_qty`',
            3,
            11,
            -1,
            false,
            '`variance_qty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->variance_qty->InputTextType = "text";
        $this->variance_qty->UseFilter = true; // Table header filter
        $this->variance_qty->Lookup = new Lookup('variance_qty', 'check_box', true, 'variance_qty', ["variance_qty","","",""], [], [], [], [], [], [], '', '', "");
        $this->variance_qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['variance_qty'] = &$this->variance_qty;

        // confirmation_date
        $this->confirmation_date = new DbField(
            'check_box',
            'check_box',
            'x_confirmation_date',
            'confirmation_date',
            '`confirmation_date`',
            CastDateFieldForLike("`confirmation_date`", "yyyyMMdd", "DB"),
            133,
            10,
            0,
            false,
            '`confirmation_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->confirmation_date->InputTextType = "text";
        $this->confirmation_date->FormatPattern = "yyyyMMdd"; // Format pattern
        $this->confirmation_date->UseFilter = true; // Table header filter
        $this->confirmation_date->Lookup = new Lookup('confirmation_date', 'check_box', true, 'confirmation_date', ["confirmation_date","","",""], [], [], [], [], [], [], '', '', "");
        $this->confirmation_date->DefaultErrorMessage = str_replace("%s", "yyyyMMdd", $Language->phrase("IncorrectDate"));
        $this->Fields['confirmation_date'] = &$this->confirmation_date;

        // confirmation_time
        $this->confirmation_time = new DbField(
            'check_box',
            'check_box',
            'x_confirmation_time',
            'confirmation_time',
            '`confirmation_time`',
            CastDateFieldForLike("`confirmation_time`", 3, "DB"),
            134,
            10,
            3,
            false,
            '`confirmation_time`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->confirmation_time->InputTextType = "text";
        $this->confirmation_time->UseFilter = true; // Table header filter
        $this->confirmation_time->Lookup = new Lookup('confirmation_time', 'check_box', true, 'confirmation_time', ["confirmation_time","","",""], [], [], [], [], [], [], '', '', "");
        $this->confirmation_time->DefaultErrorMessage = str_replace("%s", DateFormat(3), $Language->phrase("IncorrectTime"));
        $this->Fields['confirmation_time'] = &$this->confirmation_time;

        // box_code
        $this->box_code = new DbField(
            'check_box',
            'check_box',
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
        $this->box_code->IsPrimaryKey = true; // Primary key field
        $this->box_code->UseFilter = true; // Table header filter
        $this->box_code->Lookup = new Lookup('box_code', 'check_box', true, 'box_code', ["box_code","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['box_code'] = &$this->box_code;

        // picker
        $this->picker = new DbField(
            'check_box',
            'check_box',
            'x_picker',
            'picker',
            '`picker`',
            '`picker`',
            200,
            255,
            -1,
            false,
            '`picker`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->picker->InputTextType = "text";
        $this->picker->UseFilter = true; // Table header filter
        $this->picker->Lookup = new Lookup('picker', 'check_box', true, 'picker', ["picker","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['picker'] = &$this->picker;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`check_box`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
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
            if (array_key_exists('box_code', $rs)) {
                AddFilter($where, QuotedName('box_code', $this->Dbid) . '=' . QuotedValue($rs['box_code'], $this->box_code->DataType, $this->Dbid));
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
        $this->creation_date->DbValue = $row['creation_date'];
        $this->store_id->DbValue = $row['store_id'];
        $this->store_name->DbValue = $row['store_name'];
        $this->article->DbValue = $row['article'];
        $this->size_desc->DbValue = $row['size_desc'];
        $this->color_code->DbValue = $row['color_code'];
        $this->picked_qty->DbValue = $row['picked_qty'];
        $this->variance_qty->DbValue = $row['variance_qty'];
        $this->confirmation_date->DbValue = $row['confirmation_date'];
        $this->confirmation_time->DbValue = $row['confirmation_time'];
        $this->box_code->DbValue = $row['box_code'];
        $this->picker->DbValue = $row['picker'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`box_code` = '@box_code@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->box_code->CurrentValue : $this->box_code->OldValue;
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
                $this->box_code->CurrentValue = $keys[0];
            } else {
                $this->box_code->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('box_code', $row) ? $row['box_code'] : null;
        } else {
            $val = $this->box_code->OldValue !== null ? $this->box_code->OldValue : $this->box_code->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@box_code@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("checkboxlist");
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
        if ($pageName == "checkboxview") {
            return $Language->phrase("View");
        } elseif ($pageName == "checkboxedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "checkboxadd") {
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
                return "CheckBoxView";
            case Config("API_ADD_ACTION"):
                return "CheckBoxAdd";
            case Config("API_EDIT_ACTION"):
                return "CheckBoxEdit";
            case Config("API_DELETE_ACTION"):
                return "CheckBoxDelete";
            case Config("API_LIST_ACTION"):
                return "CheckBoxList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "checkboxlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("checkboxview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("checkboxview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "checkboxadd?" . $this->getUrlParm($parm);
        } else {
            $url = "checkboxadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("checkboxedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("checkboxadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("checkboxdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"box_code\":" . JsonEncode($this->box_code->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->box_code->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->box_code->CurrentValue);
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
            if (($keyValue = Param("box_code") ?? Route("box_code")) !== null) {
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
                $this->box_code->CurrentValue = $key;
            } else {
                $this->box_code->OldValue = $key;
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
        $this->creation_date->setDbValue($row['creation_date']);
        $this->store_id->setDbValue($row['store_id']);
        $this->store_name->setDbValue($row['store_name']);
        $this->article->setDbValue($row['article']);
        $this->size_desc->setDbValue($row['size_desc']);
        $this->color_code->setDbValue($row['color_code']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->variance_qty->setDbValue($row['variance_qty']);
        $this->confirmation_date->setDbValue($row['confirmation_date']);
        $this->confirmation_time->setDbValue($row['confirmation_time']);
        $this->box_code->setDbValue($row['box_code']);
        $this->picker->setDbValue($row['picker']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // creation_date
        $this->creation_date->CellCssStyle = "white-space: nowrap;";

        // store_id
        $this->store_id->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // article
        $this->article->CellCssStyle = "white-space: nowrap;";

        // size_desc
        $this->size_desc->CellCssStyle = "white-space: nowrap;";

        // color_code
        $this->color_code->CellCssStyle = "white-space: nowrap;";

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

        // picker
        $this->picker->CellCssStyle = "white-space: nowrap;";

        // creation_date
        $this->creation_date->ViewValue = $this->creation_date->CurrentValue;
        $this->creation_date->ViewValue = FormatDateTime($this->creation_date->ViewValue, $this->creation_date->formatPattern());
        $this->creation_date->ViewCustomAttributes = "";

        // store_id
        $this->store_id->ViewValue = $this->store_id->CurrentValue;
        $this->store_id->ViewCustomAttributes = "";

        // store_name
        $this->store_name->ViewValue = $this->store_name->CurrentValue;
        $this->store_name->ViewCustomAttributes = "";

        // article
        $this->article->ViewValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

        // size_desc
        $this->size_desc->ViewValue = $this->size_desc->CurrentValue;
        $this->size_desc->ViewCustomAttributes = "";

        // color_code
        $this->color_code->ViewValue = $this->color_code->CurrentValue;
        $this->color_code->ViewCustomAttributes = "";

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

        // picker
        $this->picker->ViewValue = $this->picker->CurrentValue;
        $this->picker->ViewCustomAttributes = "";

        // creation_date
        $this->creation_date->LinkCustomAttributes = "";
        $this->creation_date->HrefValue = "";
        $this->creation_date->TooltipValue = "";

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

        // size_desc
        $this->size_desc->LinkCustomAttributes = "";
        $this->size_desc->HrefValue = "";
        $this->size_desc->TooltipValue = "";

        // color_code
        $this->color_code->LinkCustomAttributes = "";
        $this->color_code->HrefValue = "";
        $this->color_code->TooltipValue = "";

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

        // picker
        $this->picker->LinkCustomAttributes = "";
        $this->picker->HrefValue = "";
        $this->picker->TooltipValue = "";

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

        // creation_date
        $this->creation_date->setupEditAttributes();
        $this->creation_date->EditCustomAttributes = "";
        $this->creation_date->EditValue = FormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern());
        $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

        // store_id
        $this->store_id->setupEditAttributes();
        $this->store_id->EditCustomAttributes = "";
        if (!$this->store_id->Raw) {
            $this->store_id->CurrentValue = HtmlDecode($this->store_id->CurrentValue);
        }
        $this->store_id->EditValue = $this->store_id->CurrentValue;
        $this->store_id->PlaceHolder = RemoveHtml($this->store_id->caption());

        // store_name
        $this->store_name->setupEditAttributes();
        $this->store_name->EditCustomAttributes = "";
        if (!$this->store_name->Raw) {
            $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
        }
        $this->store_name->EditValue = $this->store_name->CurrentValue;
        $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

        // article
        $this->article->setupEditAttributes();
        $this->article->EditCustomAttributes = "";
        if (!$this->article->Raw) {
            $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
        }
        $this->article->EditValue = $this->article->CurrentValue;
        $this->article->PlaceHolder = RemoveHtml($this->article->caption());

        // size_desc
        $this->size_desc->setupEditAttributes();
        $this->size_desc->EditCustomAttributes = "";
        if (!$this->size_desc->Raw) {
            $this->size_desc->CurrentValue = HtmlDecode($this->size_desc->CurrentValue);
        }
        $this->size_desc->EditValue = $this->size_desc->CurrentValue;
        $this->size_desc->PlaceHolder = RemoveHtml($this->size_desc->caption());

        // color_code
        $this->color_code->setupEditAttributes();
        $this->color_code->EditCustomAttributes = "";
        if (!$this->color_code->Raw) {
            $this->color_code->CurrentValue = HtmlDecode($this->color_code->CurrentValue);
        }
        $this->color_code->EditValue = $this->color_code->CurrentValue;
        $this->color_code->PlaceHolder = RemoveHtml($this->color_code->caption());

        // picked_qty
        $this->picked_qty->setupEditAttributes();
        $this->picked_qty->EditCustomAttributes = "";
        $this->picked_qty->EditValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());
        if (strval($this->picked_qty->EditValue) != "" && is_numeric($this->picked_qty->EditValue)) {
            $this->picked_qty->EditValue = FormatNumber($this->picked_qty->EditValue, null);
        }

        // variance_qty
        $this->variance_qty->setupEditAttributes();
        $this->variance_qty->EditCustomAttributes = "";
        $this->variance_qty->EditValue = $this->variance_qty->CurrentValue;
        $this->variance_qty->PlaceHolder = RemoveHtml($this->variance_qty->caption());
        if (strval($this->variance_qty->EditValue) != "" && is_numeric($this->variance_qty->EditValue)) {
            $this->variance_qty->EditValue = FormatNumber($this->variance_qty->EditValue, null);
        }

        // confirmation_date
        $this->confirmation_date->setupEditAttributes();
        $this->confirmation_date->EditCustomAttributes = "";
        $this->confirmation_date->EditValue = FormatDateTime($this->confirmation_date->CurrentValue, $this->confirmation_date->formatPattern());
        $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());

        // confirmation_time
        $this->confirmation_time->setupEditAttributes();
        $this->confirmation_time->EditCustomAttributes = "";
        $this->confirmation_time->EditValue = FormatDateTime($this->confirmation_time->CurrentValue, $this->confirmation_time->formatPattern());
        $this->confirmation_time->PlaceHolder = RemoveHtml($this->confirmation_time->caption());

        // box_code
        $this->box_code->setupEditAttributes();
        $this->box_code->EditCustomAttributes = "";
        if (!$this->box_code->Raw) {
            $this->box_code->CurrentValue = HtmlDecode($this->box_code->CurrentValue);
        }
        $this->box_code->EditValue = $this->box_code->CurrentValue;
        $this->box_code->PlaceHolder = RemoveHtml($this->box_code->caption());

        // picker
        $this->picker->setupEditAttributes();
        $this->picker->EditCustomAttributes = "";
        if (!$this->picker->Raw) {
            $this->picker->CurrentValue = HtmlDecode($this->picker->CurrentValue);
        }
        $this->picker->EditValue = $this->picker->CurrentValue;
        $this->picker->PlaceHolder = RemoveHtml($this->picker->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
            $this->article->Count++; // Increment count
            if (is_numeric($this->picked_qty->CurrentValue)) {
                $this->picked_qty->Total += $this->picked_qty->CurrentValue; // Accumulate total
            }
            if (is_numeric($this->variance_qty->CurrentValue)) {
                $this->variance_qty->Total += $this->variance_qty->CurrentValue; // Accumulate total
            }
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
            $this->article->CurrentValue = $this->article->Count;
            $this->article->ViewValue = $this->article->CurrentValue;
            $this->article->ViewCustomAttributes = "";
            $this->article->HrefValue = ""; // Clear href value
            $this->picked_qty->CurrentValue = $this->picked_qty->Total;
            $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
            $this->picked_qty->ViewValue = FormatNumber($this->picked_qty->ViewValue, $this->picked_qty->formatPattern());
            $this->picked_qty->ViewCustomAttributes = "";
            $this->picked_qty->HrefValue = ""; // Clear href value
            $this->variance_qty->CurrentValue = $this->variance_qty->Total;
            $this->variance_qty->ViewValue = $this->variance_qty->CurrentValue;
            $this->variance_qty->ViewValue = FormatNumber($this->variance_qty->ViewValue, $this->variance_qty->formatPattern());
            $this->variance_qty->ViewCustomAttributes = "";
            $this->variance_qty->HrefValue = ""; // Clear href value

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
                    $doc->exportCaption($this->creation_date);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->picked_qty);
                    $doc->exportCaption($this->variance_qty);
                    $doc->exportCaption($this->confirmation_date);
                    $doc->exportCaption($this->confirmation_time);
                    $doc->exportCaption($this->box_code);
                    $doc->exportCaption($this->picker);
                } else {
                    $doc->exportCaption($this->creation_date);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->picked_qty);
                    $doc->exportCaption($this->variance_qty);
                    $doc->exportCaption($this->confirmation_date);
                    $doc->exportCaption($this->confirmation_time);
                    $doc->exportCaption($this->box_code);
                    $doc->exportCaption($this->picker);
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
                        $doc->exportField($this->creation_date);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->article);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->picked_qty);
                        $doc->exportField($this->variance_qty);
                        $doc->exportField($this->confirmation_date);
                        $doc->exportField($this->confirmation_time);
                        $doc->exportField($this->box_code);
                        $doc->exportField($this->picker);
                    } else {
                        $doc->exportField($this->creation_date);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->article);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->picked_qty);
                        $doc->exportField($this->variance_qty);
                        $doc->exportField($this->confirmation_date);
                        $doc->exportField($this->confirmation_time);
                        $doc->exportField($this->box_code);
                        $doc->exportField($this->picker);
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
                $doc->exportAggregate($this->creation_date, '');
                $doc->exportAggregate($this->store_id, '');
                $doc->exportAggregate($this->store_name, '');
                $doc->exportAggregate($this->article, 'COUNT');
                $doc->exportAggregate($this->size_desc, '');
                $doc->exportAggregate($this->color_code, '');
                $doc->exportAggregate($this->picked_qty, 'TOTAL');
                $doc->exportAggregate($this->variance_qty, 'TOTAL');
                $doc->exportAggregate($this->confirmation_date, '');
                $doc->exportAggregate($this->confirmation_time, '');
                $doc->exportAggregate($this->box_code, '');
                $doc->exportAggregate($this->picker, '');
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
        if ($this->Export <> "") {
           $this->box_code->ViewValue = "=\"" . $this->box_code->ViewValue . "\"";
           $this->article->ViewValue = "=\"" . $this->article->ViewValue . "\"";
         }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

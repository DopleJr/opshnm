<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for report_totes
 */
class ReportTotes extends DbTable
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
    public $store_id;
    public $store_name;
    public $out;
    public $in;
    public $diff;
    public $remarks;
    public $date_out;
    public $date_in;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'report_totes';
        $this->TableName = 'report_totes';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`report_totes`";
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
            'report_totes',
            'report_totes',
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
        $this->id->UseFilter = true; // Table header filter
        $this->id->Lookup = new Lookup('id', 'report_totes', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // store_id
        $this->store_id = new DbField(
            'report_totes',
            'report_totes',
            'x_store_id',
            'store_id',
            '`store_id`',
            '`store_id`',
            200,
            11,
            -1,
            false,
            '`store_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->store_id->InputTextType = "text";
        $this->store_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->store_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->store_id->UseFilter = true; // Table header filter
        $this->store_id->Lookup = new Lookup('store_id', 'store', true, 'store_code', ["store_code","","",""], [], ["x_store_name"], [], [], ["store_name"], ["x_store_name"], '`store_code` ASC', '', "`store_code`");
        $this->Fields['store_id'] = &$this->store_id;

        // store_name
        $this->store_name = new DbField(
            'report_totes',
            'report_totes',
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
            'SELECT'
        );
        $this->store_name->InputTextType = "text";
        $this->store_name->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->store_name->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->store_name->UseFilter = true; // Table header filter
        $this->store_name->Lookup = new Lookup('store_name', 'store', true, 'store_name', ["store_name","","",""], ["x_store_id"], [], ["store_code"], ["x_store_code"], [], [], '', '', "`store_name`");
        $this->Fields['store_name'] = &$this->store_name;

        // out
        $this->out = new DbField(
            'report_totes',
            'report_totes',
            'x_out',
            'out',
            '`out`',
            '`out`',
            3,
            11,
            -1,
            false,
            '`out`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->out->InputTextType = "text";
        $this->out->UseFilter = true; // Table header filter
        $this->out->Lookup = new Lookup('out', 'report_totes', true, 'out', ["out","","",""], [], [], [], [], [], [], '', '', "");
        $this->out->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['out'] = &$this->out;

        // in
        $this->in = new DbField(
            'report_totes',
            'report_totes',
            'x_in',
            'in',
            '`in`',
            '`in`',
            3,
            11,
            -1,
            false,
            '`in`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->in->InputTextType = "text";
        $this->in->UseFilter = true; // Table header filter
        $this->in->Lookup = new Lookup('in', 'report_totes', true, 'in', ["in","","",""], [], [], [], [], [], [], '', '', "");
        $this->in->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['in'] = &$this->in;

        // diff
        $this->diff = new DbField(
            'report_totes',
            'report_totes',
            'x_diff',
            'diff',
            '`diff`',
            '`diff`',
            3,
            11,
            -1,
            false,
            '`diff`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->diff->InputTextType = "text";
        $this->diff->UseFilter = true; // Table header filter
        $this->diff->Lookup = new Lookup('diff', 'report_totes', true, 'diff', ["diff","","",""], [], [], [], [], [], [], '', '', "");
        $this->diff->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['diff'] = &$this->diff;

        // remarks
        $this->remarks = new DbField(
            'report_totes',
            'report_totes',
            'x_remarks',
            'remarks',
            '`remarks`',
            '`remarks`',
            200,
            255,
            -1,
            false,
            '`remarks`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->remarks->InputTextType = "text";
        $this->remarks->UseFilter = true; // Table header filter
        $this->remarks->Lookup = new Lookup('remarks', 'report_totes', true, 'remarks', ["remarks","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['remarks'] = &$this->remarks;

        // date_out
        $this->date_out = new DbField(
            'report_totes',
            'report_totes',
            'x_date_out',
            'date_out',
            '`date_out`',
            CastDateFieldForLike("`date_out`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_out`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_out->InputTextType = "text";
        $this->date_out->UseFilter = true; // Table header filter
        $this->date_out->Lookup = new Lookup('date_out', 'report_totes', true, 'date_out', ["date_out","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_out->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_out'] = &$this->date_out;

        // date_in
        $this->date_in = new DbField(
            'report_totes',
            'report_totes',
            'x_date_in',
            'date_in',
            '`date_in`',
            CastDateFieldForLike("`date_in`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_in`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_in->InputTextType = "text";
        $this->date_in->UseFilter = true; // Table header filter
        $this->date_in->Lookup = new Lookup('date_in', 'report_totes', true, 'date_in', ["date_in","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_in->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_in'] = &$this->date_in;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`report_totes`";
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
        $this->store_id->DbValue = $row['store_id'];
        $this->store_name->DbValue = $row['store_name'];
        $this->out->DbValue = $row['out'];
        $this->in->DbValue = $row['in'];
        $this->diff->DbValue = $row['diff'];
        $this->remarks->DbValue = $row['remarks'];
        $this->date_out->DbValue = $row['date_out'];
        $this->date_in->DbValue = $row['date_in'];
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
        return $_SESSION[$name] ?? GetUrl("reporttoteslist");
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
        if ($pageName == "reporttotesview") {
            return $Language->phrase("View");
        } elseif ($pageName == "reporttotesedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "reporttotesadd") {
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
                return "ReportTotesView";
            case Config("API_ADD_ACTION"):
                return "ReportTotesAdd";
            case Config("API_EDIT_ACTION"):
                return "ReportTotesEdit";
            case Config("API_DELETE_ACTION"):
                return "ReportTotesDelete";
            case Config("API_LIST_ACTION"):
                return "ReportTotesList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "reporttoteslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("reporttotesview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("reporttotesview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "reporttotesadd?" . $this->getUrlParm($parm);
        } else {
            $url = "reporttotesadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("reporttotesedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("reporttotesadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("reporttotesdelete", $this->getUrlParm());
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
        $this->store_id->setDbValue($row['store_id']);
        $this->store_name->setDbValue($row['store_name']);
        $this->out->setDbValue($row['out']);
        $this->in->setDbValue($row['in']);
        $this->diff->setDbValue($row['diff']);
        $this->remarks->setDbValue($row['remarks']);
        $this->date_out->setDbValue($row['date_out']);
        $this->date_in->setDbValue($row['date_in']);
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

        // store_id
        $this->store_id->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // out
        $this->out->CellCssStyle = "white-space: nowrap;";

        // in
        $this->in->CellCssStyle = "white-space: nowrap;";

        // diff
        $this->diff->CellCssStyle = "white-space: nowrap;";

        // remarks
        $this->remarks->CellCssStyle = "white-space: nowrap;";

        // date_out
        $this->date_out->CellCssStyle = "white-space: nowrap;";

        // date_in
        $this->date_in->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
        $this->id->ViewCustomAttributes = "";

        // store_id
        $curVal = strval($this->store_id->CurrentValue);
        if ($curVal != "") {
            $this->store_id->ViewValue = $this->store_id->lookupCacheOption($curVal);
            if ($this->store_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`store_code`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`totes` = 'Yes'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->store_id->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->store_id->Lookup->renderViewRow($rswrk[0]);
                    $this->store_id->ViewValue = $this->store_id->displayValue($arwrk);
                } else {
                    $this->store_id->ViewValue = $this->store_id->CurrentValue;
                }
            }
        } else {
            $this->store_id->ViewValue = null;
        }
        $this->store_id->ViewCustomAttributes = "";

        // store_name
        $curVal = strval($this->store_name->CurrentValue);
        if ($curVal != "") {
            $this->store_name->ViewValue = $this->store_name->lookupCacheOption($curVal);
            if ($this->store_name->ViewValue === null) { // Lookup from database
                $filterWrk = "`store_name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->store_name->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->store_name->Lookup->renderViewRow($rswrk[0]);
                    $this->store_name->ViewValue = $this->store_name->displayValue($arwrk);
                } else {
                    $this->store_name->ViewValue = $this->store_name->CurrentValue;
                }
            }
        } else {
            $this->store_name->ViewValue = null;
        }
        $this->store_name->ViewCustomAttributes = "";

        // out
        $this->out->ViewValue = $this->out->CurrentValue;
        $this->out->ViewValue = FormatNumber($this->out->ViewValue, $this->out->formatPattern());
        $this->out->ViewCustomAttributes = "";

        // in
        $this->in->ViewValue = $this->in->CurrentValue;
        $this->in->ViewValue = FormatNumber($this->in->ViewValue, $this->in->formatPattern());
        $this->in->ViewCustomAttributes = "";

        // diff
        $this->diff->ViewValue = $this->diff->CurrentValue;
        $this->diff->ViewValue = FormatNumber($this->diff->ViewValue, $this->diff->formatPattern());
        $this->diff->ViewCustomAttributes = "";

        // remarks
        $this->remarks->ViewValue = $this->remarks->CurrentValue;
        $this->remarks->ViewCustomAttributes = "";

        // date_out
        $this->date_out->ViewValue = $this->date_out->CurrentValue;
        $this->date_out->ViewValue = FormatDateTime($this->date_out->ViewValue, $this->date_out->formatPattern());
        $this->date_out->ViewCustomAttributes = "";

        // date_in
        $this->date_in->ViewValue = $this->date_in->CurrentValue;
        $this->date_in->ViewValue = FormatDateTime($this->date_in->ViewValue, $this->date_in->formatPattern());
        $this->date_in->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // store_id
        $this->store_id->LinkCustomAttributes = "";
        $this->store_id->HrefValue = "";
        $this->store_id->TooltipValue = "";

        // store_name
        $this->store_name->LinkCustomAttributes = "";
        $this->store_name->HrefValue = "";
        $this->store_name->TooltipValue = "";

        // out
        $this->out->LinkCustomAttributes = "";
        $this->out->HrefValue = "";
        $this->out->TooltipValue = "";

        // in
        $this->in->LinkCustomAttributes = "";
        $this->in->HrefValue = "";
        $this->in->TooltipValue = "";

        // diff
        $this->diff->LinkCustomAttributes = "";
        $this->diff->HrefValue = "";
        $this->diff->TooltipValue = "";

        // remarks
        $this->remarks->LinkCustomAttributes = "";
        $this->remarks->HrefValue = "";
        $this->remarks->TooltipValue = "";

        // date_out
        $this->date_out->LinkCustomAttributes = "";
        $this->date_out->HrefValue = "";
        $this->date_out->TooltipValue = "";

        // date_in
        $this->date_in->LinkCustomAttributes = "";
        $this->date_in->HrefValue = "";
        $this->date_in->TooltipValue = "";

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
        $this->id->EditValue = FormatNumber($this->id->EditValue, $this->id->formatPattern());
        $this->id->ViewCustomAttributes = "";

        // store_id
        $this->store_id->setupEditAttributes();
        $this->store_id->EditCustomAttributes = "";
        $curVal = trim(strval($this->store_id->CurrentValue));
        if ($curVal != "") {
            $this->store_id->ViewValue = $this->store_id->lookupCacheOption($curVal);
        } else {
            $this->store_id->ViewValue = $this->store_id->Lookup !== null && is_array($this->store_id->lookupOptions()) ? $curVal : null;
        }
        if ($this->store_id->ViewValue !== null) { // Load from cache
            $this->store_id->EditValue = array_values($this->store_id->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $lookupFilter = function() {
                return "`totes` = 'Yes'";
            };
            $lookupFilter = $lookupFilter->bindTo($this);
            $sqlWrk = $this->store_id->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->store_id->EditValue = $arwrk;
        }
        $this->store_id->PlaceHolder = RemoveHtml($this->store_id->caption());

        // store_name
        $this->store_name->setupEditAttributes();
        $this->store_name->EditCustomAttributes = 'readonly';
        $curVal = trim(strval($this->store_name->CurrentValue));
        if ($curVal != "") {
            $this->store_name->ViewValue = $this->store_name->lookupCacheOption($curVal);
        } else {
            $this->store_name->ViewValue = $this->store_name->Lookup !== null && is_array($this->store_name->lookupOptions()) ? $curVal : null;
        }
        if ($this->store_name->ViewValue !== null) { // Load from cache
            $this->store_name->EditValue = array_values($this->store_name->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $sqlWrk = $this->store_name->Lookup->getSql(true, $filterWrk, '', $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->store_name->EditValue = $arwrk;
        }
        $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

        // out
        $this->out->setupEditAttributes();
        $this->out->EditCustomAttributes = "";
        $this->out->EditValue = $this->out->CurrentValue;
        $this->out->EditValue = FormatNumber($this->out->EditValue, $this->out->formatPattern());
        $this->out->ViewCustomAttributes = "";

        // in
        $this->in->setupEditAttributes();
        $this->in->EditCustomAttributes = "";
        $this->in->EditValue = $this->in->CurrentValue;
        $this->in->PlaceHolder = RemoveHtml($this->in->caption());
        if (strval($this->in->EditValue) != "" && is_numeric($this->in->EditValue)) {
            $this->in->EditValue = FormatNumber($this->in->EditValue, null);
        }

        // diff
        $this->diff->setupEditAttributes();
        $this->diff->EditCustomAttributes = "";
        $this->diff->EditValue = $this->diff->CurrentValue;
        $this->diff->PlaceHolder = RemoveHtml($this->diff->caption());
        if (strval($this->diff->EditValue) != "" && is_numeric($this->diff->EditValue)) {
            $this->diff->EditValue = FormatNumber($this->diff->EditValue, null);
        }

        // remarks
        $this->remarks->setupEditAttributes();
        $this->remarks->EditCustomAttributes = "";
        if (!$this->remarks->Raw) {
            $this->remarks->CurrentValue = HtmlDecode($this->remarks->CurrentValue);
        }
        $this->remarks->EditValue = $this->remarks->CurrentValue;
        $this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

        // date_out
        $this->date_out->setupEditAttributes();
        $this->date_out->EditCustomAttributes = "";
        $this->date_out->EditValue = FormatDateTime($this->date_out->CurrentValue, $this->date_out->formatPattern());
        $this->date_out->PlaceHolder = RemoveHtml($this->date_out->caption());

        // date_in
        $this->date_in->setupEditAttributes();
        $this->date_in->EditCustomAttributes = "";
        $this->date_in->EditValue = FormatDateTime($this->date_in->CurrentValue, $this->date_in->formatPattern());
        $this->date_in->PlaceHolder = RemoveHtml($this->date_in->caption());

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->out);
                    $doc->exportCaption($this->in);
                    $doc->exportCaption($this->diff);
                    $doc->exportCaption($this->remarks);
                    $doc->exportCaption($this->date_out);
                    $doc->exportCaption($this->date_in);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->out);
                    $doc->exportCaption($this->in);
                    $doc->exportCaption($this->diff);
                    $doc->exportCaption($this->remarks);
                    $doc->exportCaption($this->date_out);
                    $doc->exportCaption($this->date_in);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->out);
                        $doc->exportField($this->in);
                        $doc->exportField($this->diff);
                        $doc->exportField($this->remarks);
                        $doc->exportField($this->date_out);
                        $doc->exportField($this->date_in);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->out);
                        $doc->exportField($this->in);
                        $doc->exportField($this->diff);
                        $doc->exportField($this->remarks);
                        $doc->exportField($this->date_out);
                        $doc->exportField($this->date_in);
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
        $currentDate = CurrentDate();
        $_id = $rsnew["id"];
        $store = $rsnew["store_id"];
        $_in = '0';
        $_out = $rsnew["out"];
        $_diff = ( $_in - $_out );
        $update = "UPDATE report_totes SET `in` = '$_in', `diff` = '$_diff' WHERE `id` = '$_id' ";
        $result = ExecuteStatement($update);
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
        $currentDate = CurrentDate();
        $_id = $rsold["id"];
        $store = $rsnew["store_id"];
        $_in = $rsnew["in"];
        $_out = $rsold["out"];
        $_diff = ( $_in - $_out );
        $update = "UPDATE report_totes SET  `diff` = '$_diff' WHERE `id` = '$_id' ";
        $result = ExecuteStatement($update);
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
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

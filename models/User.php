<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for user
 */
class User extends DbTable
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
    public $_username;
    public $_password;
    public $_email;
    public $ip_loggedin;
    public $role;
    public $_userLevel;
    public $date_created;
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
        $this->TableVar = 'user';
        $this->TableName = 'user';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`user`";
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
            'user',
            'user',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->id->Lookup = new Lookup('id', 'user', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'user', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // username
        $this->_username = new DbField(
            'user',
            'user',
            'x__username',
            'username',
            '`username`',
            '`username`',
            200,
            255,
            -1,
            false,
            '`username`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_username->InputTextType = "text";
        $this->_username->Required = true; // Required field
        $this->_username->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->_username->Lookup = new Lookup('username', 'user', true, 'username', ["username","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->_username->Lookup = new Lookup('username', 'user', true, 'username', ["username","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['username'] = &$this->_username;

        // password
        $this->_password = new DbField(
            'user',
            'user',
            'x__password',
            'password',
            '`password`',
            '`password`',
            200,
            255,
            -1,
            false,
            '`password`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_password->InputTextType = "text";
        if (Config("ENCRYPTED_PASSWORD")) {
            $this->_password->Raw = true;
        }
        $this->_password->Required = true; // Required field
        $this->_password->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->_password->Lookup = new Lookup('password', 'user', true, 'password', ["password","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->_password->Lookup = new Lookup('password', 'user', true, 'password', ["password","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['password'] = &$this->_password;

        // email
        $this->_email = new DbField(
            'user',
            'user',
            'x__email',
            'email',
            '`email`',
            '`email`',
            200,
            255,
            -1,
            false,
            '`email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_email->InputTextType = "text";
        $this->_email->Nullable = false; // NOT NULL field
        $this->_email->Required = true; // Required field
        $this->_email->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->_email->Lookup = new Lookup('email', 'user', true, 'email', ["email","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->_email->Lookup = new Lookup('email', 'user', true, 'email', ["email","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['email'] = &$this->_email;

        // ip_loggedin
        $this->ip_loggedin = new DbField(
            'user',
            'user',
            'x_ip_loggedin',
            'ip_loggedin',
            '`ip_loggedin`',
            '`ip_loggedin`',
            200,
            255,
            -1,
            false,
            '`ip_loggedin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ip_loggedin->InputTextType = "text";
        $this->ip_loggedin->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->ip_loggedin->Lookup = new Lookup('ip_loggedin', 'user', true, 'ip_loggedin', ["ip_loggedin","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->ip_loggedin->Lookup = new Lookup('ip_loggedin', 'user', true, 'ip_loggedin', ["ip_loggedin","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['ip_loggedin'] = &$this->ip_loggedin;

        // role
        $this->role = new DbField(
            'user',
            'user',
            'x_role',
            'role',
            '`role`',
            '`role`',
            200,
            255,
            -1,
            false,
            '`role`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->role->InputTextType = "text";
        $this->role->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->role->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->role->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->role->Lookup = new Lookup('role', 'userlevels', true, 'userlevelname', ["userlevelname","","",""], [], ["x__userLevel"], [], [], ["userlevelid"], ["x__userLevel"], '', '', "`userlevelname`");
                break;
            default:
                $this->role->Lookup = new Lookup('role', 'userlevels', true, 'userlevelname', ["userlevelname","","",""], [], ["x__userLevel"], [], [], ["userlevelid"], ["x__userLevel"], '', '', "`userlevelname`");
                break;
        }
        $this->Fields['role'] = &$this->role;

        // userLevel
        $this->_userLevel = new DbField(
            'user',
            'user',
            'x__userLevel',
            'userLevel',
            '`userLevel`',
            '`userLevel`',
            3,
            11,
            -1,
            false,
            '`userLevel`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->_userLevel->InputTextType = "text";
        $this->_userLevel->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->_userLevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->_userLevel->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->_userLevel->Lookup = new Lookup('userLevel', 'userlevels', true, 'userlevelid', ["userlevelid","","",""], ["x_role"], [], ["userlevelname"], ["x_userlevelname"], ["userlevelname"], ["x_role"], '', '', "`userlevelid`");
                break;
            default:
                $this->_userLevel->Lookup = new Lookup('userLevel', 'userlevels', true, 'userlevelid', ["userlevelid","","",""], ["x_role"], [], ["userlevelname"], ["x_userlevelname"], ["userlevelname"], ["x_role"], '', '', "`userlevelid`");
                break;
        }
        $this->_userLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['userLevel'] = &$this->_userLevel;

        // date_created
        $this->date_created = new DbField(
            'user',
            'user',
            'x_date_created',
            'date_created',
            '`date_created`',
            CastDateFieldForLike("`date_created`", 0, "DB"),
            135,
            19,
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_created->Lookup = new Lookup('date_created', 'user', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_created->Lookup = new Lookup('date_created', 'user', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new DbField(
            'user',
            'user',
            'x_date_updated',
            'date_updated',
            '`date_updated`',
            CastDateFieldForLike("`date_updated`", 1, "DB"),
            135,
            19,
            1,
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_updated->Lookup = new Lookup('date_updated', 'user', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_updated->Lookup = new Lookup('date_updated', 'user', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_updated->DefaultErrorMessage = str_replace("%s", DateFormat(1), $Language->phrase("IncorrectDate"));
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`user`";
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
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter, $id);
        }
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                if ($value == $this->Fields[$name]->OldValue) { // No need to update hashed password if not changed
                    continue;
                }
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
        $this->_username->DbValue = $row['username'];
        $this->_password->DbValue = $row['password'];
        $this->_email->DbValue = $row['email'];
        $this->ip_loggedin->DbValue = $row['ip_loggedin'];
        $this->role->DbValue = $row['role'];
        $this->_userLevel->DbValue = $row['userLevel'];
        $this->date_created->DbValue = $row['date_created'];
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
        return $_SESSION[$name] ?? GetUrl("userlist");
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
        if ($pageName == "userview") {
            return $Language->phrase("View");
        } elseif ($pageName == "useredit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "useradd") {
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
                return "UserView";
            case Config("API_ADD_ACTION"):
                return "UserAdd";
            case Config("API_EDIT_ACTION"):
                return "UserEdit";
            case Config("API_DELETE_ACTION"):
                return "UserDelete";
            case Config("API_LIST_ACTION"):
                return "UserList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "userlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("userview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("userview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "useradd?" . $this->getUrlParm($parm);
        } else {
            $url = "useradd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("useredit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("useradd", $this->getUrlParm($parm));
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
        return $this->keyUrl("userdelete", $this->getUrlParm());
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
        $this->_username->setDbValue($row['username']);
        $this->_password->setDbValue($row['password']);
        $this->_email->setDbValue($row['email']);
        $this->ip_loggedin->setDbValue($row['ip_loggedin']);
        $this->role->setDbValue($row['role']);
        $this->_userLevel->setDbValue($row['userLevel']);
        $this->date_created->setDbValue($row['date_created']);
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

        // username
        $this->_username->CellCssStyle = "white-space: nowrap;";

        // password
        $this->_password->CellCssStyle = "white-space: nowrap;";

        // email
        $this->_email->CellCssStyle = "white-space: nowrap;";

        // ip_loggedin
        $this->ip_loggedin->CellCssStyle = "white-space: nowrap;";

        // role
        $this->role->CellCssStyle = "white-space: nowrap;";

        // userLevel
        $this->_userLevel->CellCssStyle = "white-space: nowrap;";

        // date_created
        $this->date_created->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // username
        $this->_username->ViewValue = $this->_username->CurrentValue;
        $this->_username->ViewCustomAttributes = "";

        // password
        $this->_password->ViewValue = $this->_password->CurrentValue;
        $this->_password->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // ip_loggedin
        $this->ip_loggedin->ViewValue = $this->ip_loggedin->CurrentValue;
        $this->ip_loggedin->ViewCustomAttributes = "";

        // role
        $curVal = strval($this->role->CurrentValue);
        if ($curVal != "") {
            $this->role->ViewValue = $this->role->lookupCacheOption($curVal);
            if ($this->role->ViewValue === null) { // Lookup from database
                $filterWrk = "`userlevelname`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`userlevelname` = 'User' ";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->role->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->role->Lookup->renderViewRow($rswrk[0]);
                    $this->role->ViewValue = $this->role->displayValue($arwrk);
                } else {
                    $this->role->ViewValue = $this->role->CurrentValue;
                }
            }
        } else {
            $this->role->ViewValue = null;
        }
        $this->role->ViewCustomAttributes = "";

        // userLevel
        if ($Security->canAdmin()) { // System admin
            $curVal = strval($this->_userLevel->CurrentValue);
            if ($curVal != "") {
                $this->_userLevel->ViewValue = $this->_userLevel->lookupCacheOption($curVal);
                if ($this->_userLevel->ViewValue === null) { // Lookup from database
                    $filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->_userLevel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->_userLevel->Lookup->renderViewRow($rswrk[0]);
                        $this->_userLevel->ViewValue = $this->_userLevel->displayValue($arwrk);
                    } else {
                        $this->_userLevel->ViewValue = FormatNumber($this->_userLevel->CurrentValue, $this->_userLevel->formatPattern());
                    }
                }
            } else {
                $this->_userLevel->ViewValue = null;
            }
        } else {
            $this->_userLevel->ViewValue = $Language->phrase("PasswordMask");
        }
        $this->_userLevel->ViewCustomAttributes = "";

        // date_created
        $this->date_created->ViewValue = $this->date_created->CurrentValue;
        $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
        $this->date_created->ViewCustomAttributes = "";

        // date_updated
        $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
        $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
        $this->date_updated->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // username
        $this->_username->LinkCustomAttributes = "";
        $this->_username->HrefValue = "";
        $this->_username->TooltipValue = "";

        // password
        $this->_password->LinkCustomAttributes = "";
        $this->_password->HrefValue = "";
        $this->_password->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // ip_loggedin
        $this->ip_loggedin->LinkCustomAttributes = "";
        $this->ip_loggedin->HrefValue = "";
        $this->ip_loggedin->TooltipValue = "";

        // role
        $this->role->LinkCustomAttributes = "";
        $this->role->HrefValue = "";
        $this->role->TooltipValue = "";

        // userLevel
        $this->_userLevel->LinkCustomAttributes = "";
        $this->_userLevel->HrefValue = "";
        $this->_userLevel->TooltipValue = "";

        // date_created
        $this->date_created->LinkCustomAttributes = "";
        $this->date_created->HrefValue = "";
        $this->date_created->TooltipValue = "";

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

        // username
        $this->_username->setupEditAttributes();
        $this->_username->EditCustomAttributes = "";
        if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("info")) { // Non system admin
            $this->_username->CurrentValue = CurrentUserID();
            $this->_username->EditValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";
        } else {
            if (!$this->_username->Raw) {
                $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
            }
            $this->_username->EditValue = $this->_username->CurrentValue;
            $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());
        }

        // password
        $this->_password->setupEditAttributes();
        $this->_password->EditCustomAttributes = "";
        if (!$this->_password->Raw) {
            $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
        }
        $this->_password->EditValue = $this->_password->CurrentValue;
        $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // ip_loggedin

        // role
        $this->role->setupEditAttributes();
        $this->role->EditCustomAttributes = "";
        $curVal = trim(strval($this->role->CurrentValue));
        if ($curVal != "") {
            $this->role->ViewValue = $this->role->lookupCacheOption($curVal);
        } else {
            $this->role->ViewValue = $this->role->Lookup !== null && is_array($this->role->lookupOptions()) ? $curVal : null;
        }
        if ($this->role->ViewValue !== null) { // Load from cache
            $this->role->EditValue = array_values($this->role->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $lookupFilter = function() {
                return "`userlevelname` = 'User' ";
            };
            $lookupFilter = $lookupFilter->bindTo($this);
            $sqlWrk = $this->role->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->role->EditValue = $arwrk;
        }
        $this->role->PlaceHolder = RemoveHtml($this->role->caption());

        // userLevel
        $this->_userLevel->setupEditAttributes();
        $this->_userLevel->EditCustomAttributes = "";
        if (!$Security->canAdmin()) { // System admin
            $this->_userLevel->EditValue = $Language->phrase("PasswordMask");
        } else {
            $curVal = trim(strval($this->_userLevel->CurrentValue));
            if ($curVal != "") {
                $this->_userLevel->ViewValue = $this->_userLevel->lookupCacheOption($curVal);
            } else {
                $this->_userLevel->ViewValue = $this->_userLevel->Lookup !== null && is_array($this->_userLevel->lookupOptions()) ? $curVal : null;
            }
            if ($this->_userLevel->ViewValue !== null) { // Load from cache
                $this->_userLevel->EditValue = array_values($this->_userLevel->lookupOptions());
            } else { // Lookup from database
                $filterWrk = "";
                $sqlWrk = $this->_userLevel->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                foreach ($arwrk as &$row) {
                    $row = $this->_userLevel->Lookup->renderViewRow($row);
                }
                $this->_userLevel->EditValue = $arwrk;
            }
            $this->_userLevel->PlaceHolder = RemoveHtml($this->_userLevel->caption());
        }

        // date_created
        $this->date_created->setupEditAttributes();
        $this->date_created->EditCustomAttributes = "";
        $this->date_created->EditValue = $this->date_created->CurrentValue;
        $this->date_created->EditValue = FormatDateTime($this->date_created->EditValue, $this->date_created->formatPattern());
        $this->date_created->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->ip_loggedin);
                    $doc->exportCaption($this->role);
                    $doc->exportCaption($this->_userLevel);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->date_updated);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->ip_loggedin);
                    $doc->exportCaption($this->role);
                    $doc->exportCaption($this->_userLevel);
                    $doc->exportCaption($this->date_created);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->ip_loggedin);
                        $doc->exportField($this->role);
                        $doc->exportField($this->_userLevel);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->date_updated);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->ip_loggedin);
                        $doc->exportField($this->role);
                        $doc->exportField($this->_userLevel);
                        $doc->exportField($this->date_created);
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

    // User ID filter
    public function getUserIDFilter($userId)
    {
        global $Security;
        $userIdFilter = '`username` = ' . QuotedValue($userId, DATATYPE_STRING, Config("USER_TABLE_DBID"));
        return $userIdFilter;
    }

    // Add User ID filter
    public function addUserIDFilter($filter = "", $id = "")
    {
        global $Security;
        $filterWrk = "";
        if ($id == "")
            $id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`username` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM `user`";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCacheImpl($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
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
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

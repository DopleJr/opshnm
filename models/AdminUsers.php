<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for admin_users
 */
class AdminUsers extends DbTable
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
    public $firstname;
    public $lastname;
    public $_username;
    public $_email;
    public $_password;
    public $reset_password_token;
    public $registration_token;
    public $is_active;
    public $blocked;
    public $prefered_language;
    public $created_at;
    public $updated_at;
    public $created_by_id;
    public $updated_by_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'admin_users';
        $this->TableName = 'admin_users';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`admin_users`";
        $this->Dbid = 'DB';
        $this->ExportAll = false;
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
            'admin_users',
            'admin_users',
            'x_id',
            'id',
            '`id`',
            '`id`',
            19,
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // firstname
        $this->firstname = new DbField(
            'admin_users',
            'admin_users',
            'x_firstname',
            'firstname',
            '`firstname`',
            '`firstname`',
            200,
            255,
            -1,
            false,
            '`firstname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->firstname->InputTextType = "text";
        $this->Fields['firstname'] = &$this->firstname;

        // lastname
        $this->lastname = new DbField(
            'admin_users',
            'admin_users',
            'x_lastname',
            'lastname',
            '`lastname`',
            '`lastname`',
            200,
            255,
            -1,
            false,
            '`lastname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->lastname->InputTextType = "text";
        $this->Fields['lastname'] = &$this->lastname;

        // username
        $this->_username = new DbField(
            'admin_users',
            'admin_users',
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
        $this->Fields['username'] = &$this->_username;

        // email
        $this->_email = new DbField(
            'admin_users',
            'admin_users',
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
        $this->Fields['email'] = &$this->_email;

        // password
        $this->_password = new DbField(
            'admin_users',
            'admin_users',
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
        $this->Fields['password'] = &$this->_password;

        // reset_password_token
        $this->reset_password_token = new DbField(
            'admin_users',
            'admin_users',
            'x_reset_password_token',
            'reset_password_token',
            '`reset_password_token`',
            '`reset_password_token`',
            200,
            255,
            -1,
            false,
            '`reset_password_token`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->reset_password_token->InputTextType = "text";
        $this->Fields['reset_password_token'] = &$this->reset_password_token;

        // registration_token
        $this->registration_token = new DbField(
            'admin_users',
            'admin_users',
            'x_registration_token',
            'registration_token',
            '`registration_token`',
            '`registration_token`',
            200,
            255,
            -1,
            false,
            '`registration_token`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->registration_token->InputTextType = "text";
        $this->Fields['registration_token'] = &$this->registration_token;

        // is_active
        $this->is_active = new DbField(
            'admin_users',
            'admin_users',
            'x_is_active',
            'is_active',
            '`is_active`',
            '`is_active`',
            16,
            1,
            -1,
            false,
            '`is_active`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->is_active->InputTextType = "text";
        $this->is_active->DataType = DATATYPE_BOOLEAN;
        $this->is_active->Lookup = new Lookup('is_active', 'admin_users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->is_active->OptionCount = 2;
        $this->is_active->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['is_active'] = &$this->is_active;

        // blocked
        $this->blocked = new DbField(
            'admin_users',
            'admin_users',
            'x_blocked',
            'blocked',
            '`blocked`',
            '`blocked`',
            16,
            1,
            -1,
            false,
            '`blocked`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->blocked->InputTextType = "text";
        $this->blocked->DataType = DATATYPE_BOOLEAN;
        $this->blocked->Lookup = new Lookup('blocked', 'admin_users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->blocked->OptionCount = 2;
        $this->blocked->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['blocked'] = &$this->blocked;

        // prefered_language
        $this->prefered_language = new DbField(
            'admin_users',
            'admin_users',
            'x_prefered_language',
            'prefered_language',
            '`prefered_language`',
            '`prefered_language`',
            200,
            255,
            -1,
            false,
            '`prefered_language`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->prefered_language->InputTextType = "text";
        $this->Fields['prefered_language'] = &$this->prefered_language;

        // created_at
        $this->created_at = new DbField(
            'admin_users',
            'admin_users',
            'x_created_at',
            'created_at',
            '`created_at`',
            CastDateFieldForLike("`created_at`", 0, "DB"),
            135,
            26,
            0,
            false,
            '`created_at`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->created_at->InputTextType = "text";
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created_at'] = &$this->created_at;

        // updated_at
        $this->updated_at = new DbField(
            'admin_users',
            'admin_users',
            'x_updated_at',
            'updated_at',
            '`updated_at`',
            CastDateFieldForLike("`updated_at`", 0, "DB"),
            135,
            26,
            0,
            false,
            '`updated_at`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->updated_at->InputTextType = "text";
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['updated_at'] = &$this->updated_at;

        // created_by_id
        $this->created_by_id = new DbField(
            'admin_users',
            'admin_users',
            'x_created_by_id',
            'created_by_id',
            '`created_by_id`',
            '`created_by_id`',
            19,
            10,
            -1,
            false,
            '`created_by_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->created_by_id->InputTextType = "text";
        $this->created_by_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['created_by_id'] = &$this->created_by_id;

        // updated_by_id
        $this->updated_by_id = new DbField(
            'admin_users',
            'admin_users',
            'x_updated_by_id',
            'updated_by_id',
            '`updated_by_id`',
            '`updated_by_id`',
            19,
            10,
            -1,
            false,
            '`updated_by_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->updated_by_id->InputTextType = "text";
        $this->updated_by_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['updated_by_id'] = &$this->updated_by_id;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`admin_users`";
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
        $this->firstname->DbValue = $row['firstname'];
        $this->lastname->DbValue = $row['lastname'];
        $this->_username->DbValue = $row['username'];
        $this->_email->DbValue = $row['email'];
        $this->_password->DbValue = $row['password'];
        $this->reset_password_token->DbValue = $row['reset_password_token'];
        $this->registration_token->DbValue = $row['registration_token'];
        $this->is_active->DbValue = $row['is_active'];
        $this->blocked->DbValue = $row['blocked'];
        $this->prefered_language->DbValue = $row['prefered_language'];
        $this->created_at->DbValue = $row['created_at'];
        $this->updated_at->DbValue = $row['updated_at'];
        $this->created_by_id->DbValue = $row['created_by_id'];
        $this->updated_by_id->DbValue = $row['updated_by_id'];
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
        return $_SESSION[$name] ?? GetUrl("adminuserslist");
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
        if ($pageName == "adminusersview") {
            return $Language->phrase("View");
        } elseif ($pageName == "adminusersedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "adminusersadd") {
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
                return "AdminUsersView";
            case Config("API_ADD_ACTION"):
                return "AdminUsersAdd";
            case Config("API_EDIT_ACTION"):
                return "AdminUsersEdit";
            case Config("API_DELETE_ACTION"):
                return "AdminUsersDelete";
            case Config("API_LIST_ACTION"):
                return "AdminUsersList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "adminuserslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("adminusersview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("adminusersview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "adminusersadd?" . $this->getUrlParm($parm);
        } else {
            $url = "adminusersadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("adminusersedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("adminusersadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("adminusersdelete", $this->getUrlParm());
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
        $this->firstname->setDbValue($row['firstname']);
        $this->lastname->setDbValue($row['lastname']);
        $this->_username->setDbValue($row['username']);
        $this->_email->setDbValue($row['email']);
        $this->_password->setDbValue($row['password']);
        $this->reset_password_token->setDbValue($row['reset_password_token']);
        $this->registration_token->setDbValue($row['registration_token']);
        $this->is_active->setDbValue($row['is_active']);
        $this->blocked->setDbValue($row['blocked']);
        $this->prefered_language->setDbValue($row['prefered_language']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->created_by_id->setDbValue($row['created_by_id']);
        $this->updated_by_id->setDbValue($row['updated_by_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // firstname

        // lastname

        // username

        // email

        // password

        // reset_password_token

        // registration_token

        // is_active

        // blocked

        // prefered_language

        // created_at

        // updated_at

        // created_by_id

        // updated_by_id

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // firstname
        $this->firstname->ViewValue = $this->firstname->CurrentValue;
        $this->firstname->ViewCustomAttributes = "";

        // lastname
        $this->lastname->ViewValue = $this->lastname->CurrentValue;
        $this->lastname->ViewCustomAttributes = "";

        // username
        $this->_username->ViewValue = $this->_username->CurrentValue;
        $this->_username->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // password
        $this->_password->ViewValue = $this->_password->CurrentValue;
        $this->_password->ViewCustomAttributes = "";

        // reset_password_token
        $this->reset_password_token->ViewValue = $this->reset_password_token->CurrentValue;
        $this->reset_password_token->ViewCustomAttributes = "";

        // registration_token
        $this->registration_token->ViewValue = $this->registration_token->CurrentValue;
        $this->registration_token->ViewCustomAttributes = "";

        // is_active
        if (ConvertToBool($this->is_active->CurrentValue)) {
            $this->is_active->ViewValue = $this->is_active->tagCaption(1) != "" ? $this->is_active->tagCaption(1) : "Yes";
        } else {
            $this->is_active->ViewValue = $this->is_active->tagCaption(2) != "" ? $this->is_active->tagCaption(2) : "No";
        }
        $this->is_active->ViewCustomAttributes = "";

        // blocked
        if (ConvertToBool($this->blocked->CurrentValue)) {
            $this->blocked->ViewValue = $this->blocked->tagCaption(1) != "" ? $this->blocked->tagCaption(1) : "Yes";
        } else {
            $this->blocked->ViewValue = $this->blocked->tagCaption(2) != "" ? $this->blocked->tagCaption(2) : "No";
        }
        $this->blocked->ViewCustomAttributes = "";

        // prefered_language
        $this->prefered_language->ViewValue = $this->prefered_language->CurrentValue;
        $this->prefered_language->ViewCustomAttributes = "";

        // created_at
        $this->created_at->ViewValue = $this->created_at->CurrentValue;
        $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());
        $this->created_at->ViewCustomAttributes = "";

        // updated_at
        $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
        $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());
        $this->updated_at->ViewCustomAttributes = "";

        // created_by_id
        $this->created_by_id->ViewValue = $this->created_by_id->CurrentValue;
        $this->created_by_id->ViewValue = FormatNumber($this->created_by_id->ViewValue, $this->created_by_id->formatPattern());
        $this->created_by_id->ViewCustomAttributes = "";

        // updated_by_id
        $this->updated_by_id->ViewValue = $this->updated_by_id->CurrentValue;
        $this->updated_by_id->ViewValue = FormatNumber($this->updated_by_id->ViewValue, $this->updated_by_id->formatPattern());
        $this->updated_by_id->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // firstname
        $this->firstname->LinkCustomAttributes = "";
        $this->firstname->HrefValue = "";
        $this->firstname->TooltipValue = "";

        // lastname
        $this->lastname->LinkCustomAttributes = "";
        $this->lastname->HrefValue = "";
        $this->lastname->TooltipValue = "";

        // username
        $this->_username->LinkCustomAttributes = "";
        $this->_username->HrefValue = "";
        $this->_username->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // password
        $this->_password->LinkCustomAttributes = "";
        $this->_password->HrefValue = "";
        $this->_password->TooltipValue = "";

        // reset_password_token
        $this->reset_password_token->LinkCustomAttributes = "";
        $this->reset_password_token->HrefValue = "";
        $this->reset_password_token->TooltipValue = "";

        // registration_token
        $this->registration_token->LinkCustomAttributes = "";
        $this->registration_token->HrefValue = "";
        $this->registration_token->TooltipValue = "";

        // is_active
        $this->is_active->LinkCustomAttributes = "";
        $this->is_active->HrefValue = "";
        $this->is_active->TooltipValue = "";

        // blocked
        $this->blocked->LinkCustomAttributes = "";
        $this->blocked->HrefValue = "";
        $this->blocked->TooltipValue = "";

        // prefered_language
        $this->prefered_language->LinkCustomAttributes = "";
        $this->prefered_language->HrefValue = "";
        $this->prefered_language->TooltipValue = "";

        // created_at
        $this->created_at->LinkCustomAttributes = "";
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // updated_at
        $this->updated_at->LinkCustomAttributes = "";
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

        // created_by_id
        $this->created_by_id->LinkCustomAttributes = "";
        $this->created_by_id->HrefValue = "";
        $this->created_by_id->TooltipValue = "";

        // updated_by_id
        $this->updated_by_id->LinkCustomAttributes = "";
        $this->updated_by_id->HrefValue = "";
        $this->updated_by_id->TooltipValue = "";

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

        // firstname
        $this->firstname->setupEditAttributes();
        $this->firstname->EditCustomAttributes = "";
        if (!$this->firstname->Raw) {
            $this->firstname->CurrentValue = HtmlDecode($this->firstname->CurrentValue);
        }
        $this->firstname->EditValue = $this->firstname->CurrentValue;
        $this->firstname->PlaceHolder = RemoveHtml($this->firstname->caption());

        // lastname
        $this->lastname->setupEditAttributes();
        $this->lastname->EditCustomAttributes = "";
        if (!$this->lastname->Raw) {
            $this->lastname->CurrentValue = HtmlDecode($this->lastname->CurrentValue);
        }
        $this->lastname->EditValue = $this->lastname->CurrentValue;
        $this->lastname->PlaceHolder = RemoveHtml($this->lastname->caption());

        // username
        $this->_username->setupEditAttributes();
        $this->_username->EditCustomAttributes = "";
        if (!$this->_username->Raw) {
            $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
        }
        $this->_username->EditValue = $this->_username->CurrentValue;
        $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // password
        $this->_password->setupEditAttributes();
        $this->_password->EditCustomAttributes = "";
        if (!$this->_password->Raw) {
            $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
        }
        $this->_password->EditValue = $this->_password->CurrentValue;
        $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

        // reset_password_token
        $this->reset_password_token->setupEditAttributes();
        $this->reset_password_token->EditCustomAttributes = "";
        if (!$this->reset_password_token->Raw) {
            $this->reset_password_token->CurrentValue = HtmlDecode($this->reset_password_token->CurrentValue);
        }
        $this->reset_password_token->EditValue = $this->reset_password_token->CurrentValue;
        $this->reset_password_token->PlaceHolder = RemoveHtml($this->reset_password_token->caption());

        // registration_token
        $this->registration_token->setupEditAttributes();
        $this->registration_token->EditCustomAttributes = "";
        if (!$this->registration_token->Raw) {
            $this->registration_token->CurrentValue = HtmlDecode($this->registration_token->CurrentValue);
        }
        $this->registration_token->EditValue = $this->registration_token->CurrentValue;
        $this->registration_token->PlaceHolder = RemoveHtml($this->registration_token->caption());

        // is_active
        $this->is_active->EditCustomAttributes = "";
        $this->is_active->EditValue = $this->is_active->options(false);
        $this->is_active->PlaceHolder = RemoveHtml($this->is_active->caption());

        // blocked
        $this->blocked->EditCustomAttributes = "";
        $this->blocked->EditValue = $this->blocked->options(false);
        $this->blocked->PlaceHolder = RemoveHtml($this->blocked->caption());

        // prefered_language
        $this->prefered_language->setupEditAttributes();
        $this->prefered_language->EditCustomAttributes = "";
        if (!$this->prefered_language->Raw) {
            $this->prefered_language->CurrentValue = HtmlDecode($this->prefered_language->CurrentValue);
        }
        $this->prefered_language->EditValue = $this->prefered_language->CurrentValue;
        $this->prefered_language->PlaceHolder = RemoveHtml($this->prefered_language->caption());

        // created_at
        $this->created_at->setupEditAttributes();
        $this->created_at->EditCustomAttributes = "";
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // updated_at
        $this->updated_at->setupEditAttributes();
        $this->updated_at->EditCustomAttributes = "";
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

        // created_by_id
        $this->created_by_id->setupEditAttributes();
        $this->created_by_id->EditCustomAttributes = "";
        $this->created_by_id->EditValue = $this->created_by_id->CurrentValue;
        $this->created_by_id->PlaceHolder = RemoveHtml($this->created_by_id->caption());
        if (strval($this->created_by_id->EditValue) != "" && is_numeric($this->created_by_id->EditValue)) {
            $this->created_by_id->EditValue = FormatNumber($this->created_by_id->EditValue, null);
        }

        // updated_by_id
        $this->updated_by_id->setupEditAttributes();
        $this->updated_by_id->EditCustomAttributes = "";
        $this->updated_by_id->EditValue = $this->updated_by_id->CurrentValue;
        $this->updated_by_id->PlaceHolder = RemoveHtml($this->updated_by_id->caption());
        if (strval($this->updated_by_id->EditValue) != "" && is_numeric($this->updated_by_id->EditValue)) {
            $this->updated_by_id->EditValue = FormatNumber($this->updated_by_id->EditValue, null);
        }

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
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->reset_password_token);
                    $doc->exportCaption($this->registration_token);
                    $doc->exportCaption($this->is_active);
                    $doc->exportCaption($this->blocked);
                    $doc->exportCaption($this->prefered_language);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->created_by_id);
                    $doc->exportCaption($this->updated_by_id);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->reset_password_token);
                    $doc->exportCaption($this->registration_token);
                    $doc->exportCaption($this->is_active);
                    $doc->exportCaption($this->blocked);
                    $doc->exportCaption($this->prefered_language);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->created_by_id);
                    $doc->exportCaption($this->updated_by_id);
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
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->reset_password_token);
                        $doc->exportField($this->registration_token);
                        $doc->exportField($this->is_active);
                        $doc->exportField($this->blocked);
                        $doc->exportField($this->prefered_language);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->created_by_id);
                        $doc->exportField($this->updated_by_id);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->reset_password_token);
                        $doc->exportField($this->registration_token);
                        $doc->exportField($this->is_active);
                        $doc->exportField($this->blocked);
                        $doc->exportField($this->prefered_language);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->created_by_id);
                        $doc->exportField($this->updated_by_id);
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
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

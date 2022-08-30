<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for master_article
 */
class MasterArticle extends DbTable
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
    public $article;
    public $description;
    public $gtin;
    public $color_code;
    public $color_desc;
    public $size_code;
    public $size_desc;
    public $season;
    public $price;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'master_article';
        $this->TableName = 'master_article';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`master_article`";
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
            'master_article',
            'master_article',
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
        $this->id->Lookup = new Lookup('id', 'master_article', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // article
        $this->article = new DbField(
            'master_article',
            'master_article',
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
        $this->article->UseFilter = true; // Table header filter
        $this->article->Lookup = new Lookup('article', 'master_article', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['article'] = &$this->article;

        // description
        $this->description = new DbField(
            'master_article',
            'master_article',
            'x_description',
            'description',
            '`description`',
            '`description`',
            200,
            255,
            -1,
            false,
            '`description`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->description->InputTextType = "text";
        $this->description->UseFilter = true; // Table header filter
        $this->description->Lookup = new Lookup('description', 'master_article', true, 'description', ["description","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['description'] = &$this->description;

        // gtin
        $this->gtin = new DbField(
            'master_article',
            'master_article',
            'x_gtin',
            'gtin',
            '`gtin`',
            '`gtin`',
            200,
            255,
            -1,
            false,
            '`gtin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->gtin->InputTextType = "text";
        $this->gtin->UseFilter = true; // Table header filter
        $this->gtin->Lookup = new Lookup('gtin', 'master_article', true, 'gtin', ["gtin","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['gtin'] = &$this->gtin;

        // color_code
        $this->color_code = new DbField(
            'master_article',
            'master_article',
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
        $this->color_code->Lookup = new Lookup('color_code', 'master_article', true, 'color_code', ["color_code","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['color_code'] = &$this->color_code;

        // color_desc
        $this->color_desc = new DbField(
            'master_article',
            'master_article',
            'x_color_desc',
            'color_desc',
            '`color_desc`',
            '`color_desc`',
            200,
            255,
            -1,
            false,
            '`color_desc`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->color_desc->InputTextType = "text";
        $this->color_desc->UseFilter = true; // Table header filter
        $this->color_desc->Lookup = new Lookup('color_desc', 'master_article', true, 'color_desc', ["color_desc","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['color_desc'] = &$this->color_desc;

        // size_code
        $this->size_code = new DbField(
            'master_article',
            'master_article',
            'x_size_code',
            'size_code',
            '`size_code`',
            '`size_code`',
            200,
            255,
            -1,
            false,
            '`size_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->size_code->InputTextType = "text";
        $this->size_code->UseFilter = true; // Table header filter
        $this->size_code->Lookup = new Lookup('size_code', 'master_article', true, 'size_code', ["size_code","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['size_code'] = &$this->size_code;

        // size_desc
        $this->size_desc = new DbField(
            'master_article',
            'master_article',
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
        $this->size_desc->Lookup = new Lookup('size_desc', 'master_article', true, 'size_desc', ["size_desc","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['size_desc'] = &$this->size_desc;

        // season
        $this->season = new DbField(
            'master_article',
            'master_article',
            'x_season',
            'season',
            '`season`',
            '`season`',
            200,
            255,
            -1,
            false,
            '`season`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->season->InputTextType = "text";
        $this->season->UseFilter = true; // Table header filter
        $this->season->Lookup = new Lookup('season', 'master_article', true, 'season', ["season","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['season'] = &$this->season;

        // price
        $this->price = new DbField(
            'master_article',
            'master_article',
            'x_price',
            'price',
            '`price`',
            '`price`',
            131,
            10,
            -1,
            false,
            '`price`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->price->InputTextType = "text";
        $this->price->UseFilter = true; // Table header filter
        $this->price->Lookup = new Lookup('price', 'master_article', true, 'price', ["price","","",""], [], [], [], [], [], [], '', '', "");
        $this->price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['price'] = &$this->price;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`master_article`";
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
        $this->article->DbValue = $row['article'];
        $this->description->DbValue = $row['description'];
        $this->gtin->DbValue = $row['gtin'];
        $this->color_code->DbValue = $row['color_code'];
        $this->color_desc->DbValue = $row['color_desc'];
        $this->size_code->DbValue = $row['size_code'];
        $this->size_desc->DbValue = $row['size_desc'];
        $this->season->DbValue = $row['season'];
        $this->price->DbValue = $row['price'];
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
        return $_SESSION[$name] ?? GetUrl("masterarticlelist");
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
        if ($pageName == "masterarticleview") {
            return $Language->phrase("View");
        } elseif ($pageName == "masterarticleedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "masterarticleadd") {
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
                return "MasterArticleView";
            case Config("API_ADD_ACTION"):
                return "MasterArticleAdd";
            case Config("API_EDIT_ACTION"):
                return "MasterArticleEdit";
            case Config("API_DELETE_ACTION"):
                return "MasterArticleDelete";
            case Config("API_LIST_ACTION"):
                return "MasterArticleList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "masterarticlelist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("masterarticleview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("masterarticleview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "masterarticleadd?" . $this->getUrlParm($parm);
        } else {
            $url = "masterarticleadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("masterarticleedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("masterarticleadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("masterarticledelete", $this->getUrlParm());
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
        $this->article->setDbValue($row['article']);
        $this->description->setDbValue($row['description']);
        $this->gtin->setDbValue($row['gtin']);
        $this->color_code->setDbValue($row['color_code']);
        $this->color_desc->setDbValue($row['color_desc']);
        $this->size_code->setDbValue($row['size_code']);
        $this->size_desc->setDbValue($row['size_desc']);
        $this->season->setDbValue($row['season']);
        $this->price->setDbValue($row['price']);
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

        // article
        $this->article->CellCssStyle = "white-space: nowrap;";

        // description
        $this->description->CellCssStyle = "white-space: nowrap;";

        // gtin
        $this->gtin->CellCssStyle = "white-space: nowrap;";

        // color_code
        $this->color_code->CellCssStyle = "white-space: nowrap;";

        // color_desc
        $this->color_desc->CellCssStyle = "white-space: nowrap;";

        // size_code
        $this->size_code->CellCssStyle = "white-space: nowrap;";

        // size_desc
        $this->size_desc->CellCssStyle = "white-space: nowrap;";

        // season
        $this->season->CellCssStyle = "white-space: nowrap;";

        // price
        $this->price->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // article
        $this->article->ViewValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

        // description
        $this->description->ViewValue = $this->description->CurrentValue;
        $this->description->ViewCustomAttributes = "";

        // gtin
        $this->gtin->ViewValue = $this->gtin->CurrentValue;
        $this->gtin->ViewCustomAttributes = "";

        // color_code
        $this->color_code->ViewValue = $this->color_code->CurrentValue;
        $this->color_code->ViewCustomAttributes = "";

        // color_desc
        $this->color_desc->ViewValue = $this->color_desc->CurrentValue;
        $this->color_desc->ViewCustomAttributes = "";

        // size_code
        $this->size_code->ViewValue = $this->size_code->CurrentValue;
        $this->size_code->ViewCustomAttributes = "";

        // size_desc
        $this->size_desc->ViewValue = $this->size_desc->CurrentValue;
        $this->size_desc->ViewCustomAttributes = "";

        // season
        $this->season->ViewValue = $this->season->CurrentValue;
        $this->season->ViewCustomAttributes = "";

        // price
        $this->price->ViewValue = $this->price->CurrentValue;
        $this->price->ViewValue = FormatNumber($this->price->ViewValue, $this->price->formatPattern());
        $this->price->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // article
        $this->article->LinkCustomAttributes = "";
        $this->article->HrefValue = "";
        $this->article->TooltipValue = "";

        // description
        $this->description->LinkCustomAttributes = "";
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // gtin
        $this->gtin->LinkCustomAttributes = "";
        $this->gtin->HrefValue = "";
        $this->gtin->TooltipValue = "";

        // color_code
        $this->color_code->LinkCustomAttributes = "";
        $this->color_code->HrefValue = "";
        $this->color_code->TooltipValue = "";

        // color_desc
        $this->color_desc->LinkCustomAttributes = "";
        $this->color_desc->HrefValue = "";
        $this->color_desc->TooltipValue = "";

        // size_code
        $this->size_code->LinkCustomAttributes = "";
        $this->size_code->HrefValue = "";
        $this->size_code->TooltipValue = "";

        // size_desc
        $this->size_desc->LinkCustomAttributes = "";
        $this->size_desc->HrefValue = "";
        $this->size_desc->TooltipValue = "";

        // season
        $this->season->LinkCustomAttributes = "";
        $this->season->HrefValue = "";
        $this->season->TooltipValue = "";

        // price
        $this->price->LinkCustomAttributes = "";
        $this->price->HrefValue = "";
        $this->price->TooltipValue = "";

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

        // article
        $this->article->setupEditAttributes();
        $this->article->EditCustomAttributes = "";
        if (!$this->article->Raw) {
            $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
        }
        $this->article->EditValue = $this->article->CurrentValue;
        $this->article->PlaceHolder = RemoveHtml($this->article->caption());

        // description
        $this->description->setupEditAttributes();
        $this->description->EditCustomAttributes = "";
        if (!$this->description->Raw) {
            $this->description->CurrentValue = HtmlDecode($this->description->CurrentValue);
        }
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // gtin
        $this->gtin->setupEditAttributes();
        $this->gtin->EditCustomAttributes = "";
        if (!$this->gtin->Raw) {
            $this->gtin->CurrentValue = HtmlDecode($this->gtin->CurrentValue);
        }
        $this->gtin->EditValue = $this->gtin->CurrentValue;
        $this->gtin->PlaceHolder = RemoveHtml($this->gtin->caption());

        // color_code
        $this->color_code->setupEditAttributes();
        $this->color_code->EditCustomAttributes = "";
        if (!$this->color_code->Raw) {
            $this->color_code->CurrentValue = HtmlDecode($this->color_code->CurrentValue);
        }
        $this->color_code->EditValue = $this->color_code->CurrentValue;
        $this->color_code->PlaceHolder = RemoveHtml($this->color_code->caption());

        // color_desc
        $this->color_desc->setupEditAttributes();
        $this->color_desc->EditCustomAttributes = "";
        if (!$this->color_desc->Raw) {
            $this->color_desc->CurrentValue = HtmlDecode($this->color_desc->CurrentValue);
        }
        $this->color_desc->EditValue = $this->color_desc->CurrentValue;
        $this->color_desc->PlaceHolder = RemoveHtml($this->color_desc->caption());

        // size_code
        $this->size_code->setupEditAttributes();
        $this->size_code->EditCustomAttributes = "";
        if (!$this->size_code->Raw) {
            $this->size_code->CurrentValue = HtmlDecode($this->size_code->CurrentValue);
        }
        $this->size_code->EditValue = $this->size_code->CurrentValue;
        $this->size_code->PlaceHolder = RemoveHtml($this->size_code->caption());

        // size_desc
        $this->size_desc->setupEditAttributes();
        $this->size_desc->EditCustomAttributes = "";
        if (!$this->size_desc->Raw) {
            $this->size_desc->CurrentValue = HtmlDecode($this->size_desc->CurrentValue);
        }
        $this->size_desc->EditValue = $this->size_desc->CurrentValue;
        $this->size_desc->PlaceHolder = RemoveHtml($this->size_desc->caption());

        // season
        $this->season->setupEditAttributes();
        $this->season->EditCustomAttributes = "";
        if (!$this->season->Raw) {
            $this->season->CurrentValue = HtmlDecode($this->season->CurrentValue);
        }
        $this->season->EditValue = $this->season->CurrentValue;
        $this->season->PlaceHolder = RemoveHtml($this->season->caption());

        // price
        $this->price->setupEditAttributes();
        $this->price->EditCustomAttributes = "";
        $this->price->EditValue = $this->price->CurrentValue;
        $this->price->PlaceHolder = RemoveHtml($this->price->caption());
        if (strval($this->price->EditValue) != "" && is_numeric($this->price->EditValue)) {
            $this->price->EditValue = FormatNumber($this->price->EditValue, null);
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
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->gtin);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->color_desc);
                    $doc->exportCaption($this->size_code);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->season);
                    $doc->exportCaption($this->price);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->gtin);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->color_desc);
                    $doc->exportCaption($this->size_code);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->season);
                    $doc->exportCaption($this->price);
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
                        $doc->exportField($this->article);
                        $doc->exportField($this->description);
                        $doc->exportField($this->gtin);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->color_desc);
                        $doc->exportField($this->size_code);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->season);
                        $doc->exportField($this->price);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->article);
                        $doc->exportField($this->description);
                        $doc->exportField($this->gtin);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->color_desc);
                        $doc->exportField($this->size_code);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->season);
                        $doc->exportField($this->price);
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

<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for files
 */
class Files extends DbTable
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
    public $name;
    public $alternative_text;
    public $caption;
    public $width;
    public $height;
    public $formats;
    public $hash;
    public $ext;
    public $mime;
    public $size;
    public $url;
    public $preview_url;
    public $provider;
    public $provider_metadata;
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
        $this->TableVar = 'files';
        $this->TableName = 'files';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`files`";
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
            'files',
            'files',
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

        // name
        $this->name = new DbField(
            'files',
            'files',
            'x_name',
            'name',
            '`name`',
            '`name`',
            200,
            255,
            -1,
            false,
            '`name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->name->InputTextType = "text";
        $this->Fields['name'] = &$this->name;

        // alternative_text
        $this->alternative_text = new DbField(
            'files',
            'files',
            'x_alternative_text',
            'alternative_text',
            '`alternative_text`',
            '`alternative_text`',
            200,
            255,
            -1,
            false,
            '`alternative_text`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->alternative_text->InputTextType = "text";
        $this->Fields['alternative_text'] = &$this->alternative_text;

        // caption
        $this->caption = new DbField(
            'files',
            'files',
            'x_caption',
            'caption',
            '`caption`',
            '`caption`',
            200,
            255,
            -1,
            false,
            '`caption`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->caption->InputTextType = "text";
        $this->Fields['caption'] = &$this->caption;

        // width
        $this->width = new DbField(
            'files',
            'files',
            'x_width',
            'width',
            '`width`',
            '`width`',
            3,
            11,
            -1,
            false,
            '`width`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->width->InputTextType = "text";
        $this->width->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['width'] = &$this->width;

        // height
        $this->height = new DbField(
            'files',
            'files',
            'x_height',
            'height',
            '`height`',
            '`height`',
            3,
            11,
            -1,
            false,
            '`height`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->height->InputTextType = "text";
        $this->height->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['height'] = &$this->height;

        // formats
        $this->formats = new DbField(
            'files',
            'files',
            'x_formats',
            'formats',
            '`formats`',
            '`formats`',
            201,
            0,
            -1,
            false,
            '`formats`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->formats->InputTextType = "text";
        $this->Fields['formats'] = &$this->formats;

        // hash
        $this->hash = new DbField(
            'files',
            'files',
            'x_hash',
            'hash',
            '`hash`',
            '`hash`',
            200,
            255,
            -1,
            false,
            '`hash`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->hash->InputTextType = "text";
        $this->Fields['hash'] = &$this->hash;

        // ext
        $this->ext = new DbField(
            'files',
            'files',
            'x_ext',
            'ext',
            '`ext`',
            '`ext`',
            200,
            255,
            -1,
            false,
            '`ext`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ext->InputTextType = "text";
        $this->Fields['ext'] = &$this->ext;

        // mime
        $this->mime = new DbField(
            'files',
            'files',
            'x_mime',
            'mime',
            '`mime`',
            '`mime`',
            200,
            255,
            -1,
            false,
            '`mime`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mime->InputTextType = "text";
        $this->Fields['mime'] = &$this->mime;

        // size
        $this->size = new DbField(
            'files',
            'files',
            'x_size',
            'size',
            '`size`',
            '`size`',
            131,
            10,
            -1,
            false,
            '`size`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->size->InputTextType = "text";
        $this->size->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['size'] = &$this->size;

        // url
        $this->url = new DbField(
            'files',
            'files',
            'x_url',
            'url',
            '`url`',
            '`url`',
            200,
            255,
            -1,
            false,
            '`url`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->url->InputTextType = "text";
        $this->Fields['url'] = &$this->url;

        // preview_url
        $this->preview_url = new DbField(
            'files',
            'files',
            'x_preview_url',
            'preview_url',
            '`preview_url`',
            '`preview_url`',
            200,
            255,
            -1,
            false,
            '`preview_url`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->preview_url->InputTextType = "text";
        $this->Fields['preview_url'] = &$this->preview_url;

        // provider
        $this->provider = new DbField(
            'files',
            'files',
            'x_provider',
            'provider',
            '`provider`',
            '`provider`',
            200,
            255,
            -1,
            false,
            '`provider`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->provider->InputTextType = "text";
        $this->Fields['provider'] = &$this->provider;

        // provider_metadata
        $this->provider_metadata = new DbField(
            'files',
            'files',
            'x_provider_metadata',
            'provider_metadata',
            '`provider_metadata`',
            '`provider_metadata`',
            201,
            0,
            -1,
            false,
            '`provider_metadata`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->provider_metadata->InputTextType = "text";
        $this->Fields['provider_metadata'] = &$this->provider_metadata;

        // created_at
        $this->created_at = new DbField(
            'files',
            'files',
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
            'files',
            'files',
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
            'files',
            'files',
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
            'files',
            'files',
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`files`";
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
        $this->name->DbValue = $row['name'];
        $this->alternative_text->DbValue = $row['alternative_text'];
        $this->caption->DbValue = $row['caption'];
        $this->width->DbValue = $row['width'];
        $this->height->DbValue = $row['height'];
        $this->formats->DbValue = $row['formats'];
        $this->hash->DbValue = $row['hash'];
        $this->ext->DbValue = $row['ext'];
        $this->mime->DbValue = $row['mime'];
        $this->size->DbValue = $row['size'];
        $this->url->DbValue = $row['url'];
        $this->preview_url->DbValue = $row['preview_url'];
        $this->provider->DbValue = $row['provider'];
        $this->provider_metadata->DbValue = $row['provider_metadata'];
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
        return $_SESSION[$name] ?? GetUrl("fileslist");
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
        if ($pageName == "filesview") {
            return $Language->phrase("View");
        } elseif ($pageName == "filesedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "filesadd") {
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
                return "FilesView";
            case Config("API_ADD_ACTION"):
                return "FilesAdd";
            case Config("API_EDIT_ACTION"):
                return "FilesEdit";
            case Config("API_DELETE_ACTION"):
                return "FilesDelete";
            case Config("API_LIST_ACTION"):
                return "FilesList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "fileslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("filesview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("filesview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "filesadd?" . $this->getUrlParm($parm);
        } else {
            $url = "filesadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("filesedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("filesadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("filesdelete", $this->getUrlParm());
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
        $this->name->setDbValue($row['name']);
        $this->alternative_text->setDbValue($row['alternative_text']);
        $this->caption->setDbValue($row['caption']);
        $this->width->setDbValue($row['width']);
        $this->height->setDbValue($row['height']);
        $this->formats->setDbValue($row['formats']);
        $this->hash->setDbValue($row['hash']);
        $this->ext->setDbValue($row['ext']);
        $this->mime->setDbValue($row['mime']);
        $this->size->setDbValue($row['size']);
        $this->url->setDbValue($row['url']);
        $this->preview_url->setDbValue($row['preview_url']);
        $this->provider->setDbValue($row['provider']);
        $this->provider_metadata->setDbValue($row['provider_metadata']);
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

        // name

        // alternative_text

        // caption

        // width

        // height

        // formats

        // hash

        // ext

        // mime

        // size

        // url

        // preview_url

        // provider

        // provider_metadata

        // created_at

        // updated_at

        // created_by_id

        // updated_by_id

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // name
        $this->name->ViewValue = $this->name->CurrentValue;
        $this->name->ViewCustomAttributes = "";

        // alternative_text
        $this->alternative_text->ViewValue = $this->alternative_text->CurrentValue;
        $this->alternative_text->ViewCustomAttributes = "";

        // caption
        $this->caption->ViewValue = $this->caption->CurrentValue;
        $this->caption->ViewCustomAttributes = "";

        // width
        $this->width->ViewValue = $this->width->CurrentValue;
        $this->width->ViewValue = FormatNumber($this->width->ViewValue, $this->width->formatPattern());
        $this->width->ViewCustomAttributes = "";

        // height
        $this->height->ViewValue = $this->height->CurrentValue;
        $this->height->ViewValue = FormatNumber($this->height->ViewValue, $this->height->formatPattern());
        $this->height->ViewCustomAttributes = "";

        // formats
        $this->formats->ViewValue = $this->formats->CurrentValue;
        $this->formats->ViewCustomAttributes = "";

        // hash
        $this->hash->ViewValue = $this->hash->CurrentValue;
        $this->hash->ViewCustomAttributes = "";

        // ext
        $this->ext->ViewValue = $this->ext->CurrentValue;
        $this->ext->ViewCustomAttributes = "";

        // mime
        $this->mime->ViewValue = $this->mime->CurrentValue;
        $this->mime->ViewCustomAttributes = "";

        // size
        $this->size->ViewValue = $this->size->CurrentValue;
        $this->size->ViewValue = FormatNumber($this->size->ViewValue, $this->size->formatPattern());
        $this->size->ViewCustomAttributes = "";

        // url
        $this->url->ViewValue = $this->url->CurrentValue;
        $this->url->ViewCustomAttributes = "";

        // preview_url
        $this->preview_url->ViewValue = $this->preview_url->CurrentValue;
        $this->preview_url->ViewCustomAttributes = "";

        // provider
        $this->provider->ViewValue = $this->provider->CurrentValue;
        $this->provider->ViewCustomAttributes = "";

        // provider_metadata
        $this->provider_metadata->ViewValue = $this->provider_metadata->CurrentValue;
        $this->provider_metadata->ViewCustomAttributes = "";

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

        // name
        $this->name->LinkCustomAttributes = "";
        $this->name->HrefValue = "";
        $this->name->TooltipValue = "";

        // alternative_text
        $this->alternative_text->LinkCustomAttributes = "";
        $this->alternative_text->HrefValue = "";
        $this->alternative_text->TooltipValue = "";

        // caption
        $this->caption->LinkCustomAttributes = "";
        $this->caption->HrefValue = "";
        $this->caption->TooltipValue = "";

        // width
        $this->width->LinkCustomAttributes = "";
        $this->width->HrefValue = "";
        $this->width->TooltipValue = "";

        // height
        $this->height->LinkCustomAttributes = "";
        $this->height->HrefValue = "";
        $this->height->TooltipValue = "";

        // formats
        $this->formats->LinkCustomAttributes = "";
        $this->formats->HrefValue = "";
        $this->formats->TooltipValue = "";

        // hash
        $this->hash->LinkCustomAttributes = "";
        $this->hash->HrefValue = "";
        $this->hash->TooltipValue = "";

        // ext
        $this->ext->LinkCustomAttributes = "";
        $this->ext->HrefValue = "";
        $this->ext->TooltipValue = "";

        // mime
        $this->mime->LinkCustomAttributes = "";
        $this->mime->HrefValue = "";
        $this->mime->TooltipValue = "";

        // size
        $this->size->LinkCustomAttributes = "";
        $this->size->HrefValue = "";
        $this->size->TooltipValue = "";

        // url
        $this->url->LinkCustomAttributes = "";
        $this->url->HrefValue = "";
        $this->url->TooltipValue = "";

        // preview_url
        $this->preview_url->LinkCustomAttributes = "";
        $this->preview_url->HrefValue = "";
        $this->preview_url->TooltipValue = "";

        // provider
        $this->provider->LinkCustomAttributes = "";
        $this->provider->HrefValue = "";
        $this->provider->TooltipValue = "";

        // provider_metadata
        $this->provider_metadata->LinkCustomAttributes = "";
        $this->provider_metadata->HrefValue = "";
        $this->provider_metadata->TooltipValue = "";

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

        // name
        $this->name->setupEditAttributes();
        $this->name->EditCustomAttributes = "";
        if (!$this->name->Raw) {
            $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
        }
        $this->name->EditValue = $this->name->CurrentValue;
        $this->name->PlaceHolder = RemoveHtml($this->name->caption());

        // alternative_text
        $this->alternative_text->setupEditAttributes();
        $this->alternative_text->EditCustomAttributes = "";
        if (!$this->alternative_text->Raw) {
            $this->alternative_text->CurrentValue = HtmlDecode($this->alternative_text->CurrentValue);
        }
        $this->alternative_text->EditValue = $this->alternative_text->CurrentValue;
        $this->alternative_text->PlaceHolder = RemoveHtml($this->alternative_text->caption());

        // caption
        $this->caption->setupEditAttributes();
        $this->caption->EditCustomAttributes = "";
        if (!$this->caption->Raw) {
            $this->caption->CurrentValue = HtmlDecode($this->caption->CurrentValue);
        }
        $this->caption->EditValue = $this->caption->CurrentValue;
        $this->caption->PlaceHolder = RemoveHtml($this->caption->caption());

        // width
        $this->width->setupEditAttributes();
        $this->width->EditCustomAttributes = "";
        $this->width->EditValue = $this->width->CurrentValue;
        $this->width->PlaceHolder = RemoveHtml($this->width->caption());
        if (strval($this->width->EditValue) != "" && is_numeric($this->width->EditValue)) {
            $this->width->EditValue = FormatNumber($this->width->EditValue, null);
        }

        // height
        $this->height->setupEditAttributes();
        $this->height->EditCustomAttributes = "";
        $this->height->EditValue = $this->height->CurrentValue;
        $this->height->PlaceHolder = RemoveHtml($this->height->caption());
        if (strval($this->height->EditValue) != "" && is_numeric($this->height->EditValue)) {
            $this->height->EditValue = FormatNumber($this->height->EditValue, null);
        }

        // formats
        $this->formats->setupEditAttributes();
        $this->formats->EditCustomAttributes = "";
        $this->formats->EditValue = $this->formats->CurrentValue;
        $this->formats->PlaceHolder = RemoveHtml($this->formats->caption());

        // hash
        $this->hash->setupEditAttributes();
        $this->hash->EditCustomAttributes = "";
        if (!$this->hash->Raw) {
            $this->hash->CurrentValue = HtmlDecode($this->hash->CurrentValue);
        }
        $this->hash->EditValue = $this->hash->CurrentValue;
        $this->hash->PlaceHolder = RemoveHtml($this->hash->caption());

        // ext
        $this->ext->setupEditAttributes();
        $this->ext->EditCustomAttributes = "";
        if (!$this->ext->Raw) {
            $this->ext->CurrentValue = HtmlDecode($this->ext->CurrentValue);
        }
        $this->ext->EditValue = $this->ext->CurrentValue;
        $this->ext->PlaceHolder = RemoveHtml($this->ext->caption());

        // mime
        $this->mime->setupEditAttributes();
        $this->mime->EditCustomAttributes = "";
        if (!$this->mime->Raw) {
            $this->mime->CurrentValue = HtmlDecode($this->mime->CurrentValue);
        }
        $this->mime->EditValue = $this->mime->CurrentValue;
        $this->mime->PlaceHolder = RemoveHtml($this->mime->caption());

        // size
        $this->size->setupEditAttributes();
        $this->size->EditCustomAttributes = "";
        $this->size->EditValue = $this->size->CurrentValue;
        $this->size->PlaceHolder = RemoveHtml($this->size->caption());
        if (strval($this->size->EditValue) != "" && is_numeric($this->size->EditValue)) {
            $this->size->EditValue = FormatNumber($this->size->EditValue, null);
        }

        // url
        $this->url->setupEditAttributes();
        $this->url->EditCustomAttributes = "";
        if (!$this->url->Raw) {
            $this->url->CurrentValue = HtmlDecode($this->url->CurrentValue);
        }
        $this->url->EditValue = $this->url->CurrentValue;
        $this->url->PlaceHolder = RemoveHtml($this->url->caption());

        // preview_url
        $this->preview_url->setupEditAttributes();
        $this->preview_url->EditCustomAttributes = "";
        if (!$this->preview_url->Raw) {
            $this->preview_url->CurrentValue = HtmlDecode($this->preview_url->CurrentValue);
        }
        $this->preview_url->EditValue = $this->preview_url->CurrentValue;
        $this->preview_url->PlaceHolder = RemoveHtml($this->preview_url->caption());

        // provider
        $this->provider->setupEditAttributes();
        $this->provider->EditCustomAttributes = "";
        if (!$this->provider->Raw) {
            $this->provider->CurrentValue = HtmlDecode($this->provider->CurrentValue);
        }
        $this->provider->EditValue = $this->provider->CurrentValue;
        $this->provider->PlaceHolder = RemoveHtml($this->provider->caption());

        // provider_metadata
        $this->provider_metadata->setupEditAttributes();
        $this->provider_metadata->EditCustomAttributes = "";
        $this->provider_metadata->EditValue = $this->provider_metadata->CurrentValue;
        $this->provider_metadata->PlaceHolder = RemoveHtml($this->provider_metadata->caption());

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
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->alternative_text);
                    $doc->exportCaption($this->caption);
                    $doc->exportCaption($this->width);
                    $doc->exportCaption($this->height);
                    $doc->exportCaption($this->formats);
                    $doc->exportCaption($this->hash);
                    $doc->exportCaption($this->ext);
                    $doc->exportCaption($this->mime);
                    $doc->exportCaption($this->size);
                    $doc->exportCaption($this->url);
                    $doc->exportCaption($this->preview_url);
                    $doc->exportCaption($this->provider);
                    $doc->exportCaption($this->provider_metadata);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->created_by_id);
                    $doc->exportCaption($this->updated_by_id);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->alternative_text);
                    $doc->exportCaption($this->caption);
                    $doc->exportCaption($this->width);
                    $doc->exportCaption($this->height);
                    $doc->exportCaption($this->hash);
                    $doc->exportCaption($this->ext);
                    $doc->exportCaption($this->mime);
                    $doc->exportCaption($this->size);
                    $doc->exportCaption($this->url);
                    $doc->exportCaption($this->preview_url);
                    $doc->exportCaption($this->provider);
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
                        $doc->exportField($this->name);
                        $doc->exportField($this->alternative_text);
                        $doc->exportField($this->caption);
                        $doc->exportField($this->width);
                        $doc->exportField($this->height);
                        $doc->exportField($this->formats);
                        $doc->exportField($this->hash);
                        $doc->exportField($this->ext);
                        $doc->exportField($this->mime);
                        $doc->exportField($this->size);
                        $doc->exportField($this->url);
                        $doc->exportField($this->preview_url);
                        $doc->exportField($this->provider);
                        $doc->exportField($this->provider_metadata);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->created_by_id);
                        $doc->exportField($this->updated_by_id);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->name);
                        $doc->exportField($this->alternative_text);
                        $doc->exportField($this->caption);
                        $doc->exportField($this->width);
                        $doc->exportField($this->height);
                        $doc->exportField($this->hash);
                        $doc->exportField($this->ext);
                        $doc->exportField($this->mime);
                        $doc->exportField($this->size);
                        $doc->exportField($this->url);
                        $doc->exportField($this->preview_url);
                        $doc->exportField($this->provider);
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

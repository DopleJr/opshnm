<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for job_control_copy1
 */
class JobControlCopy1 extends DbTable
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

    // Audit trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $creation_date;
    public $store_id;
    public $area;
    public $aisle;
    public $user;
    public $target_qty;
    public $picked_qty;
    public $status;
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
        $this->TableVar = 'job_control_copy1';
        $this->TableName = 'job_control_copy1';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`job_control_copy1`";
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
            'job_control_copy1',
            'job_control_copy1',
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
        $this->id->Lookup = new Lookup('id', 'job_control_copy1', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // creation_date
        $this->creation_date = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_creation_date',
            'creation_date',
            '`creation_date`',
            CastDateFieldForLike("`creation_date`", "yyyy-MM-dd", "DB"),
            133,
            10,
            0,
            false,
            '`creation_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->creation_date->InputTextType = "text";
        $this->creation_date->Required = true; // Required field
        $this->creation_date->FormatPattern = "yyyy-MM-dd"; // Format pattern
        $this->creation_date->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->creation_date->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->creation_date->UseFilter = true; // Table header filter
        $this->creation_date->Lookup = new Lookup('creation_date', 'picking_pending', true, 'creation_date', ["creation_date","","",""], [], ["x_store_id[]","x_area","x_aisle[]"], [], [], [], [], '`creation_date` ASC', '', "" . CastDateFieldForLike("`creation_date`", 0, "DB") . "");
        $this->creation_date->DefaultErrorMessage = str_replace("%s", "yyyy-MM-dd", $Language->phrase("IncorrectDate"));
        $this->Fields['creation_date'] = &$this->creation_date;

        // store_id
        $this->store_id = new DbField(
            'job_control_copy1',
            'job_control_copy1',
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
            'SELECT'
        );
        $this->store_id->InputTextType = "text";
        $this->store_id->Required = true; // Required field
        $this->store_id->SelectMultiple = true; // Multiple select
        $this->store_id->UseFilter = true; // Table header filter
        $this->store_id->Lookup = new Lookup('store_id', 'picking_pending', true, 'store_id2', ["store_id2","","",""], ["x_creation_date"], ["x_area","x_aisle[]"], ["creation_date"], ["x_creation_date"], [], [], '`store_id2` ASC', '', "`store_id2`");
        $this->Fields['store_id'] = &$this->store_id;

        // area
        $this->area = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_area',
            'area',
            '`area`',
            '`area`',
            200,
            255,
            -1,
            false,
            '`area`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->area->InputTextType = "text";
        $this->area->Required = true; // Required field
        $this->area->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->area->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->area->UseFilter = true; // Table header filter
        $this->area->Lookup = new Lookup('area', 'picking_pending', true, 'area', ["area","","",""], ["x_creation_date","x_store_id[]"], ["x_aisle[]"], ["creation_date","store_id2"], ["x_creation_date","x_store_id2"], ["aisle"], ["x_aisle[]"], '`area` ASC', '', "`area`");
        $this->Fields['area'] = &$this->area;

        // aisle
        $this->aisle = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_aisle',
            'aisle',
            '`aisle`',
            '`aisle`',
            200,
            255,
            -1,
            false,
            '`aisle`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->aisle->InputTextType = "text";
        $this->aisle->Required = true; // Required field
        $this->aisle->SelectMultiple = true; // Multiple select
        $this->aisle->UseFilter = true; // Table header filter
        $this->aisle->Lookup = new Lookup('aisle', 'picking_pending', true, 'aisle2', ["aisle","","",""], ["x_area","x_creation_date","x_store_id[]"], [], ["area","creation_date","store_id2"], ["x_area","x_creation_date","x_store_id2"], [], [], '`aisle2` ASC', '', "`aisle`");
        $this->Fields['aisle'] = &$this->aisle;

        // user
        $this->user = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_user',
            'user',
            '`user`',
            '`user`',
            200,
            255,
            -1,
            false,
            '`user`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->user->InputTextType = "text";
        $this->user->Required = true; // Required field
        $this->user->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->user->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->user->UseFilter = true; // Table header filter
        $this->user->Lookup = new Lookup('user', 'user', true, 'username', ["username","","",""], [], [], [], [], [], [], '`username` ASC', '', "`username`");
        $this->Fields['user'] = &$this->user;

        // target_qty
        $this->target_qty = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_target_qty',
            'target_qty',
            '`target_qty`',
            '`target_qty`',
            200,
            255,
            -1,
            false,
            '`target_qty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->target_qty->InputTextType = "text";
        $this->target_qty->UseFilter = true; // Table header filter
        $this->target_qty->Lookup = new Lookup('target_qty', 'job_control_copy1', true, 'target_qty', ["target_qty","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['target_qty'] = &$this->target_qty;

        // picked_qty
        $this->picked_qty = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_picked_qty',
            'picked_qty',
            '`picked_qty`',
            '`picked_qty`',
            200,
            255,
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
        $this->picked_qty->Lookup = new Lookup('picked_qty', 'job_control_copy1', true, 'picked_qty', ["picked_qty","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['picked_qty'] = &$this->picked_qty;

        // status
        $this->status = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_status',
            'status',
            '`status`',
            '`status`',
            200,
            255,
            -1,
            false,
            '`status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->status->InputTextType = "text";
        $this->status->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->status->UseFilter = true; // Table header filter
        $this->status->Lookup = new Lookup('status', 'job_control_copy1', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
        $this->status->OptionCount = 2;
        $this->Fields['status'] = &$this->status;

        // date_created
        $this->date_created = new DbField(
            'job_control_copy1',
            'job_control_copy1',
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
        $this->date_created->Lookup = new Lookup('date_created', 'job_control_copy1', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new DbField(
            'job_control_copy1',
            'job_control_copy1',
            'x_date_updated',
            'date_updated',
            '`date_updated`',
            CastDateFieldForLike("`date_updated`", 0, "DB"),
            135,
            19,
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
        $this->date_updated->Lookup = new Lookup('date_updated', 'job_control_copy1', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
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

    // Multiple column sort
    public function updateSort(&$fld, $ctrl)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($ctrl) {
                $orderBy = $this->getSessionOrderBy();
                $arOrderBy = !empty($orderBy) ? explode(", ", $orderBy) : [];
                if ($lastOrderBy != "" && in_array($lastOrderBy, $arOrderBy)) {
                    foreach ($arOrderBy as $key => $val) {
                        if ($val == $lastOrderBy) {
                            if ($curOrderBy == "") {
                                unset($arOrderBy[$key]);
                            } else {
                                $arOrderBy[$key] = $curOrderBy;
                            }
                        }
                    }
                } elseif ($curOrderBy != "") {
                    $arOrderBy[] = $curOrderBy;
                }
                $orderBy = implode(", ", $arOrderBy);
                $this->setSessionOrderBy($orderBy); // Save to Session
            } else {
                $this->setSessionOrderBy($curOrderBy); // Save to Session
            }
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`job_control_copy1`";
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
            if ($this->AuditTrailOnAdd) {
                $this->writeAuditTrailOnAdd($rs);
            }
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
        if ($success && $this->AuditTrailOnEdit && $rsold) {
            $rsaudit = $rs;
            $fldname = 'id';
            if (!array_key_exists($fldname, $rsaudit)) {
                $rsaudit[$fldname] = $rsold[$fldname];
            }
            $this->writeAuditTrailOnEdit($rsold, $rsaudit);
        }
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
        if ($success && $this->AuditTrailOnDelete) {
            $this->writeAuditTrailOnDelete($rs);
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
        $this->creation_date->DbValue = $row['creation_date'];
        $this->store_id->DbValue = $row['store_id'];
        $this->area->DbValue = $row['area'];
        $this->aisle->DbValue = $row['aisle'];
        $this->user->DbValue = $row['user'];
        $this->target_qty->DbValue = $row['target_qty'];
        $this->picked_qty->DbValue = $row['picked_qty'];
        $this->status->DbValue = $row['status'];
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
        return $_SESSION[$name] ?? GetUrl("jobcontrolcopy1list");
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
        if ($pageName == "jobcontrolcopy1view") {
            return $Language->phrase("View");
        } elseif ($pageName == "jobcontrolcopy1edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "jobcontrolcopy1add") {
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
                return "JobControlCopy1View";
            case Config("API_ADD_ACTION"):
                return "JobControlCopy1Add";
            case Config("API_EDIT_ACTION"):
                return "JobControlCopy1Edit";
            case Config("API_DELETE_ACTION"):
                return "JobControlCopy1Delete";
            case Config("API_LIST_ACTION"):
                return "JobControlCopy1List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "jobcontrolcopy1list";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("jobcontrolcopy1view", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("jobcontrolcopy1view", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "jobcontrolcopy1add?" . $this->getUrlParm($parm);
        } else {
            $url = "jobcontrolcopy1add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("jobcontrolcopy1edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("jobcontrolcopy1add", $this->getUrlParm($parm));
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
        return $this->keyUrl("jobcontrolcopy1delete", $this->getUrlParm());
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
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="2"';
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
        $this->creation_date->setDbValue($row['creation_date']);
        $this->store_id->setDbValue($row['store_id']);
        $this->area->setDbValue($row['area']);
        $this->aisle->setDbValue($row['aisle']);
        $this->user->setDbValue($row['user']);
        $this->target_qty->setDbValue($row['target_qty']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->status->setDbValue($row['status']);
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

        // creation_date
        $this->creation_date->CellCssStyle = "white-space: nowrap;";

        // store_id

        // area
        $this->area->CellCssStyle = "white-space: nowrap;";

        // aisle
        $this->aisle->CellCssStyle = "white-space: nowrap;";

        // user
        $this->user->CellCssStyle = "white-space: nowrap;";

        // target_qty
        $this->target_qty->CellCssStyle = "white-space: nowrap;";

        // picked_qty
        $this->picked_qty->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // date_created
        $this->date_created->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // creation_date
        $curVal = strval($this->creation_date->CurrentValue);
        if ($curVal != "") {
            $this->creation_date->ViewValue = $this->creation_date->lookupCacheOption($curVal);
            if ($this->creation_date->ViewValue === null) { // Lookup from database
                $filterWrk = "`creation_date`" . SearchString("=", $curVal, DATATYPE_DATE, "");
                $lookupFilter = function() {
                    return "`picker` is Null  ";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->creation_date->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->creation_date->Lookup->renderViewRow($rswrk[0]);
                    $this->creation_date->ViewValue = $this->creation_date->displayValue($arwrk);
                } else {
                    $this->creation_date->ViewValue = FormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern());
                }
            }
        } else {
            $this->creation_date->ViewValue = null;
        }
        $this->creation_date->ViewCustomAttributes = "";

        // store_id
        $curVal = strval($this->store_id->CurrentValue);
        if ($curVal != "") {
            $this->store_id->ViewValue = $this->store_id->lookupCacheOption($curVal);
            if ($this->store_id->ViewValue === null) { // Lookup from database
                $arwrk = explode(",", $curVal);
                $filterWrk = "";
                foreach ($arwrk as $wrk) {
                    if ($filterWrk != "") {
                        $filterWrk .= " OR ";
                    }
                    $filterWrk .= "`store_id2`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "`picker` is Null  ";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->store_id->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $this->store_id->ViewValue = new OptionValues();
                    foreach ($rswrk as $row) {
                        $arwrk = $this->store_id->Lookup->renderViewRow($row);
                        $this->store_id->ViewValue->add($this->store_id->displayValue($arwrk));
                    }
                } else {
                    $this->store_id->ViewValue = $this->store_id->CurrentValue;
                }
            }
        } else {
            $this->store_id->ViewValue = null;
        }
        $this->store_id->ViewCustomAttributes = "";

        // area
        $curVal = strval($this->area->CurrentValue);
        if ($curVal != "") {
            $this->area->ViewValue = $this->area->lookupCacheOption($curVal);
            if ($this->area->ViewValue === null) { // Lookup from database
                $filterWrk = "`area`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`picker` is Null  ";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->area->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->area->Lookup->renderViewRow($rswrk[0]);
                    $this->area->ViewValue = $this->area->displayValue($arwrk);
                } else {
                    $this->area->ViewValue = $this->area->CurrentValue;
                }
            }
        } else {
            $this->area->ViewValue = null;
        }
        $this->area->ViewCustomAttributes = "";

        // aisle
        $curVal = strval($this->aisle->CurrentValue);
        if ($curVal != "") {
            $this->aisle->ViewValue = $this->aisle->lookupCacheOption($curVal);
            if ($this->aisle->ViewValue === null) { // Lookup from database
                $arwrk = explode(",", $curVal);
                $filterWrk = "";
                foreach ($arwrk as $wrk) {
                    if ($filterWrk != "") {
                        $filterWrk .= " OR ";
                    }
                    $filterWrk .= "`aisle2`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "`picker` is Null  ";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->aisle->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $this->aisle->ViewValue = new OptionValues();
                    foreach ($rswrk as $row) {
                        $arwrk = $this->aisle->Lookup->renderViewRow($row);
                        $this->aisle->ViewValue->add($this->aisle->displayValue($arwrk));
                    }
                } else {
                    $this->aisle->ViewValue = $this->aisle->CurrentValue;
                }
            }
        } else {
            $this->aisle->ViewValue = null;
        }
        $this->aisle->ViewCustomAttributes = "";

        // user
        $curVal = strval($this->user->CurrentValue);
        if ($curVal != "") {
            $this->user->ViewValue = $this->user->lookupCacheOption($curVal);
            if ($this->user->ViewValue === null) { // Lookup from database
                $filterWrk = "`username`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->user->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->user->Lookup->renderViewRow($rswrk[0]);
                    $this->user->ViewValue = $this->user->displayValue($arwrk);
                } else {
                    $this->user->ViewValue = $this->user->CurrentValue;
                }
            }
        } else {
            $this->user->ViewValue = null;
        }
        $this->user->ViewCustomAttributes = "";

        // target_qty
        $this->target_qty->ViewValue = $this->target_qty->CurrentValue;
        $this->target_qty->ViewCustomAttributes = "";

        // picked_qty
        $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->ViewCustomAttributes = "";

        // status
        if (strval($this->status->CurrentValue) != "") {
            $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
        } else {
            $this->status->ViewValue = null;
        }
        $this->status->ViewCustomAttributes = "";

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

        // creation_date
        $this->creation_date->LinkCustomAttributes = "";
        $this->creation_date->HrefValue = "";
        $this->creation_date->TooltipValue = "";

        // store_id
        $this->store_id->LinkCustomAttributes = "";
        $this->store_id->HrefValue = "";
        $this->store_id->TooltipValue = "";

        // area
        $this->area->LinkCustomAttributes = "";
        $this->area->HrefValue = "";
        $this->area->TooltipValue = "";

        // aisle
        $this->aisle->LinkCustomAttributes = "";
        $this->aisle->HrefValue = "";
        $this->aisle->TooltipValue = "";

        // user
        $this->user->LinkCustomAttributes = "";
        $this->user->HrefValue = "";
        $this->user->TooltipValue = "";

        // target_qty
        $this->target_qty->LinkCustomAttributes = "";
        $this->target_qty->HrefValue = "";
        $this->target_qty->TooltipValue = "";

        // picked_qty
        $this->picked_qty->LinkCustomAttributes = "";
        $this->picked_qty->HrefValue = "";
        $this->picked_qty->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

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

        // creation_date
        $this->creation_date->setupEditAttributes();
        $this->creation_date->EditCustomAttributes = "";
        $curVal = trim(strval($this->creation_date->CurrentValue));
        if ($curVal != "") {
            $this->creation_date->ViewValue = $this->creation_date->lookupCacheOption($curVal);
        } else {
            $this->creation_date->ViewValue = $this->creation_date->Lookup !== null && is_array($this->creation_date->lookupOptions()) ? $curVal : null;
        }
        if ($this->creation_date->ViewValue !== null) { // Load from cache
            $this->creation_date->EditValue = array_values($this->creation_date->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $lookupFilter = function() {
                return "`picker` is Null  ";
            };
            $lookupFilter = $lookupFilter->bindTo($this);
            $sqlWrk = $this->creation_date->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            foreach ($arwrk as &$row) {
                $row = $this->creation_date->Lookup->renderViewRow($row);
            }
            $this->creation_date->EditValue = $arwrk;
        }
        $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

        // store_id
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
                return "`picker` is Null  ";
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

        // area
        $this->area->setupEditAttributes();
        $this->area->EditCustomAttributes = "";
        $curVal = trim(strval($this->area->CurrentValue));
        if ($curVal != "") {
            $this->area->ViewValue = $this->area->lookupCacheOption($curVal);
        } else {
            $this->area->ViewValue = $this->area->Lookup !== null && is_array($this->area->lookupOptions()) ? $curVal : null;
        }
        if ($this->area->ViewValue !== null) { // Load from cache
            $this->area->EditValue = array_values($this->area->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $lookupFilter = function() {
                return "`picker` is Null  ";
            };
            $lookupFilter = $lookupFilter->bindTo($this);
            $sqlWrk = $this->area->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->area->EditValue = $arwrk;
        }
        $this->area->PlaceHolder = RemoveHtml($this->area->caption());

        // aisle
        $this->aisle->EditCustomAttributes = "";
        $curVal = trim(strval($this->aisle->CurrentValue));
        if ($curVal != "") {
            $this->aisle->ViewValue = $this->aisle->lookupCacheOption($curVal);
        } else {
            $this->aisle->ViewValue = $this->aisle->Lookup !== null && is_array($this->aisle->lookupOptions()) ? $curVal : null;
        }
        if ($this->aisle->ViewValue !== null) { // Load from cache
            $this->aisle->EditValue = array_values($this->aisle->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $lookupFilter = function() {
                return "`picker` is Null  ";
            };
            $lookupFilter = $lookupFilter->bindTo($this);
            $sqlWrk = $this->aisle->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->aisle->EditValue = $arwrk;
        }
        $this->aisle->PlaceHolder = RemoveHtml($this->aisle->caption());

        // user
        $this->user->setupEditAttributes();
        $this->user->EditCustomAttributes = "";
        $curVal = trim(strval($this->user->CurrentValue));
        if ($curVal != "") {
            $this->user->ViewValue = $this->user->lookupCacheOption($curVal);
        } else {
            $this->user->ViewValue = $this->user->Lookup !== null && is_array($this->user->lookupOptions()) ? $curVal : null;
        }
        if ($this->user->ViewValue !== null) { // Load from cache
            $this->user->EditValue = array_values($this->user->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $sqlWrk = $this->user->Lookup->getSql(true, $filterWrk, '', $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->user->EditValue = $arwrk;
        }
        $this->user->PlaceHolder = RemoveHtml($this->user->caption());

        // target_qty
        $this->target_qty->setupEditAttributes();
        $this->target_qty->EditCustomAttributes = "";
        if (!$this->target_qty->Raw) {
            $this->target_qty->CurrentValue = HtmlDecode($this->target_qty->CurrentValue);
        }
        $this->target_qty->EditValue = $this->target_qty->CurrentValue;
        $this->target_qty->PlaceHolder = RemoveHtml($this->target_qty->caption());

        // picked_qty
        $this->picked_qty->setupEditAttributes();
        $this->picked_qty->EditCustomAttributes = "";
        if (!$this->picked_qty->Raw) {
            $this->picked_qty->CurrentValue = HtmlDecode($this->picked_qty->CurrentValue);
        }
        $this->picked_qty->EditValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        $this->status->EditValue = $this->status->options(true);
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // date_created
        $this->date_created->setupEditAttributes();
        $this->date_created->EditCustomAttributes = "";
        $this->date_created->EditValue = FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

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
                    $doc->exportCaption($this->creation_date);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->aisle);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->target_qty);
                    $doc->exportCaption($this->picked_qty);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->date_updated);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->creation_date);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->aisle);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->target_qty);
                    $doc->exportCaption($this->picked_qty);
                    $doc->exportCaption($this->status);
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
                        $doc->exportField($this->creation_date);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->area);
                        $doc->exportField($this->aisle);
                        $doc->exportField($this->user);
                        $doc->exportField($this->target_qty);
                        $doc->exportField($this->picked_qty);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->date_updated);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->creation_date);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->area);
                        $doc->exportField($this->aisle);
                        $doc->exportField($this->user);
                        $doc->exportField($this->target_qty);
                        $doc->exportField($this->picked_qty);
                        $doc->exportField($this->status);
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

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Write Audit Trail start/end for grid update
    public function writeAuditTrailDummy($typ)
    {
        $table = 'job_control_copy1';
        $usr = CurrentUserID();
        WriteAuditLog($usr, $typ, $table, "", "", "", "");
    }

    // Write Audit Trail (add page)
    public function writeAuditTrailOnAdd(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnAdd) {
            return;
        }
        $table = 'job_control_copy1';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['id'];

        // Write Audit Trail
        $usr = CurrentUserID();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") {
                    $newvalue = $Language->phrase("PasswordMask"); // Password Field
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) {
                    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                        $newvalue = $rs[$fldname];
                    } else {
                        $newvalue = "[MEMO]"; // Memo Field
                    }
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) {
                    $newvalue = "[XML]"; // XML Field
                } else {
                    $newvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "A", $table, $fldname, $key, "", $newvalue);
            }
        }
    }

    // Write Audit Trail (edit page)
    public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
    {
        global $Language;
        if (!$this->AuditTrailOnEdit) {
            return;
        }
        $table = 'job_control_copy1';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['id'];

        // Write Audit Trail
        $usr = CurrentUserID();
        foreach (array_keys($rsnew) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && array_key_exists($fldname, $rsold) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
                    $modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
                } else {
                    $modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
                }
                if ($modified) {
                    if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
                    } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
                        if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                            $oldvalue = $rsold[$fldname];
                            $newvalue = $rsnew[$fldname];
                        } else {
                            $oldvalue = "[MEMO]";
                            $newvalue = "[MEMO]";
                        }
                    } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) { // XML field
                        $oldvalue = "[XML]";
                        $newvalue = "[XML]";
                    } else {
                        $oldvalue = $rsold[$fldname];
                        $newvalue = $rsnew[$fldname];
                    }
                    WriteAuditLog($usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
                }
            }
        }
    }

    // Write Audit Trail (delete page)
    public function writeAuditTrailOnDelete(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnDelete) {
            return;
        }
        $table = 'job_control_copy1';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['id'];

        // Write Audit Trail
        $curUser = CurrentUserID();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") {
                    $oldvalue = $Language->phrase("PasswordMask"); // Password Field
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) {
                    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                        $oldvalue = $rs[$fldname];
                    } else {
                        $oldvalue = "[MEMO]"; // Memo field
                    }
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) {
                    $oldvalue = "[XML]"; // XML field
                } else {
                    $oldvalue = $rs[$fldname];
                }
                WriteAuditLog($curUser, "D", $table, $fldname, $key, $oldvalue, "");
            }
        }
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
            $_creation_date = $rsnew["creation_date"];
            $_store_id = $rsnew["store_id"];
            $_area = $rsnew["area"];
            $_aisle = $rsnew["aisle"];
            $_target = $rsnew["target_qty"];
            $_picked = $rsnew["picked_qty"];
            $_status = 'Done';
            $_id = $rsnew["id"];
            $_user = $rsnew["user"];
            //set JOB ID
            $result = "UPDATE picking_pending SET `picker` = '$_user',`job_id` = '$_id' WHERE `creation_date` in ('$_creation_date') AND `store_id` in (".$_store_id.") AND `area` in ('$_area') AND `aisle` in (".$_aisle.") ";
            $_result = ExecuteStatement($result);
            //target qty
                $target_qty = "SELECT sum(target_qty) FROM `picking_pending` WHERE `job_id` = '$_id' ";
                $_target_qty = ExecuteScalar($target_qty);
                $_target2 = $_target_qty;
            //picked
                $picked_qty = "SELECT sum(target_qty) FROM `picking` WHERE `job_id` = '$_id' AND `status` = '$_status' ";
                $_picked_qty = ExecuteScalar($picked_qty);
                $_picked2 = $_picked_qty;
            $result2 = "UPDATE job_control_copy1 SET `target_qty` = '$_target2' WHERE `id` = '".$rsnew["id"]."'";
            $_result2 = ExecuteStatement($result2);
            $result3 = "UPDATE job_control_copy1 SET `picked_qty` = '$_picked2' WHERE `id` = '".$rsnew["id"]."'";
            $_result3 = ExecuteStatement($result3);
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
            $_creation_date = $rs["creation_date"];
            $_store_id = $rs["store_id"];
            $_area = $rs["area"];
            $_aisle = $rs["aisle"];
            $_user = $rs["user"];
            $_user = $rs["user"];
            $_id = $rs["id"];
            $_status = "Pending";

            //Delete Job
            $result_true2 = "UPDATE picking SET `picker` = Null,`box_code` = Null ,`box_type` = Null,`close_totes` = Null WHERE `status` = ('$_status') AND `job_id` = '$_id' ";
            ExecuteStatement($result_true2);
            $this->setWarningMessage("Job Deleted");
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
                $_creation_date = $this->creation_date->CurrentValue;
                $_store_id = $this->store_id->CurrentValue;
                $_area = $this->area->CurrentValue;
                $_aisle = $this->aisle->CurrentValue;
                $_target = $this->target_qty->CurrentValue;
                $_picked = $this->picked_qty->CurrentValue;
                $_picked2 = $this->picked_qty->CurrentValue;
                $_status = "Done";
                $_status2 = "Pending";
                $_id = $this->id->CurrentValue;
                $_user = $this->user->CurrentValue;

                //target qty
                    $target_qty = "SELECT sum(target_qty) FROM `picking` WHERE `job_id` = '$_id'  ";
                    $_target_qty = ExecuteScalar($target_qty);
                    $_target2 = $_target_qty;
                //picked
                    $picked_qty = "SELECT sum(target_qty) FROM `picking` WHERE `job_id` = '$_id' AND `status` = '$_status' ";
                    $_picked_qty = ExecuteScalar($picked_qty);
                    $_picked2 = $_picked_qty;
                $result2 = "UPDATE job_control_copy1 SET `target_qty` = '$_target2' WHERE `id` = '$_id'";
                $_result2 = ExecuteStatement($result2);
                $result3 = "UPDATE job_control_copy1 SET `picked_qty` = '$_picked2' WHERE `id` = '$_id'";
                $_result3 = ExecuteStatement($result3);
                if ($_target == $_picked ) {
                	$result4 = "UPDATE job_control_copy1 SET `status` = '$_status' WHERE `id` = '$_id'";
                	$_result4 = ExecuteStatement($result4);
                }
                if ($this->status->ViewValue == "Done"){ 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: green
                ";}
                	elseif ($this->status->ViewValue == "Pending") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: grey
                ";}
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

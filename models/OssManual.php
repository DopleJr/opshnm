<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for oss_manual
 */
class OssManual extends DbTable
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
    public $date;
    public $sscc;
    public $scan;
    public $shipment;
    public $pallet_no;
    public $idw;
    public $order_no;
    public $item_in_ctn;
    public $no_of_ctn;
    public $ctn_no;
    public $checker;
    public $shift;
    public $status;
    public $date_updated;
    public $time_updated;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'oss_manual';
        $this->TableName = 'oss_manual';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`oss_manual`";
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
        $this->UseColumnVisibility = true;
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // date
        $this->date = new DbField(
            'oss_manual',
            'oss_manual',
            'x_date',
            'date',
            '`date`',
            CastDateFieldForLike("`date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date->InputTextType = "text";
        $this->date->Sortable = false; // Allow sort
        $this->date->UseFilter = true; // Table header filter
        $this->date->Lookup = new Lookup('date', 'oss_manual', true, 'date', ["date","","",""], [], [], [], [], [], [], '', '', "");
        $this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date'] = &$this->date;

        // sscc
        $this->sscc = new DbField(
            'oss_manual',
            'oss_manual',
            'x_sscc',
            'sscc',
            '`sscc`',
            '`sscc`',
            200,
            255,
            -1,
            false,
            '`sscc`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sscc->InputTextType = "text";
        $this->sscc->IsPrimaryKey = true; // Primary key field
        $this->sscc->Nullable = false; // NOT NULL field
        $this->sscc->Required = true; // Required field
        $this->sscc->Sortable = false; // Allow sort
        $this->sscc->UseFilter = true; // Table header filter
        $this->sscc->Lookup = new Lookup('sscc', 'oss_manual', true, 'sscc', ["sscc","","",""], [], [], [], [], ["date","shipment","pallet_no","idw","order_no","item_in_ctn","no_of_ctn","ctn_no"], ["x_date","x_shipment","x_pallet_no","x_idw","x_order_no","x_item_in_ctn","x_no_of_ctn","x_ctn_no"], '', '', "`sscc`");
        $this->sscc->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sscc'] = &$this->sscc;

        // scan
        $this->scan = new DbField(
            'oss_manual',
            'oss_manual',
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
        $this->scan->Lookup = new Lookup('scan', 'oss_manual', true, 'scan', ["scan","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['scan'] = &$this->scan;

        // shipment
        $this->shipment = new DbField(
            'oss_manual',
            'oss_manual',
            'x_shipment',
            'shipment',
            '`shipment`',
            '`shipment`',
            200,
            255,
            -1,
            false,
            '`shipment`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->shipment->InputTextType = "number";
        $this->shipment->Required = true; // Required field
        $this->shipment->Sortable = false; // Allow sort
        $this->shipment->UseFilter = true; // Table header filter
        $this->shipment->Lookup = new Lookup('shipment', 'oss_manual', true, 'shipment', ["shipment","","",""], [], [], [], [], [], [], '', '', "");
        $this->shipment->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['shipment'] = &$this->shipment;

        // pallet_no
        $this->pallet_no = new DbField(
            'oss_manual',
            'oss_manual',
            'x_pallet_no',
            'pallet_no',
            '`pallet_no`',
            '`pallet_no`',
            200,
            255,
            -1,
            false,
            '`pallet_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pallet_no->InputTextType = "text";
        $this->pallet_no->Required = true; // Required field
        $this->pallet_no->Sortable = false; // Allow sort
        $this->pallet_no->UseFilter = true; // Table header filter
        $this->pallet_no->Lookup = new Lookup('pallet_no', 'oss_manual', true, 'pallet_no', ["pallet_no","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['pallet_no'] = &$this->pallet_no;

        // idw
        $this->idw = new DbField(
            'oss_manual',
            'oss_manual',
            'x_idw',
            'idw',
            '`idw`',
            '`idw`',
            200,
            255,
            -1,
            false,
            '`idw`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->idw->InputTextType = "number";
        $this->idw->Required = true; // Required field
        $this->idw->Sortable = false; // Allow sort
        $this->idw->UseFilter = true; // Table header filter
        $this->idw->Lookup = new Lookup('idw', 'oss_manual', true, 'idw', ["idw","","",""], [], [], [], [], [], [], '', '', "");
        $this->idw->OptionCount = 2;
        $this->idw->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['idw'] = &$this->idw;

        // order_no
        $this->order_no = new DbField(
            'oss_manual',
            'oss_manual',
            'x_order_no',
            'order_no',
            '`order_no`',
            '`order_no`',
            3,
            11,
            -1,
            false,
            '`order_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->order_no->InputTextType = "number";
        $this->order_no->Required = true; // Required field
        $this->order_no->Sortable = false; // Allow sort
        $this->order_no->UseFilter = true; // Table header filter
        $this->order_no->Lookup = new Lookup('order_no', 'oss_manual', true, 'order_no', ["order_no","","",""], [], [], [], [], [], [], '', '', "");
        $this->order_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['order_no'] = &$this->order_no;

        // item_in_ctn
        $this->item_in_ctn = new DbField(
            'oss_manual',
            'oss_manual',
            'x_item_in_ctn',
            'item_in_ctn',
            '`item_in_ctn`',
            '`item_in_ctn`',
            3,
            11,
            -1,
            false,
            '`item_in_ctn`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->item_in_ctn->InputTextType = "number";
        $this->item_in_ctn->Required = true; // Required field
        $this->item_in_ctn->Sortable = false; // Allow sort
        $this->item_in_ctn->UseFilter = true; // Table header filter
        $this->item_in_ctn->Lookup = new Lookup('item_in_ctn', 'oss_manual', true, 'item_in_ctn', ["item_in_ctn","","",""], [], [], [], [], [], [], '', '', "");
        $this->item_in_ctn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['item_in_ctn'] = &$this->item_in_ctn;

        // no_of_ctn
        $this->no_of_ctn = new DbField(
            'oss_manual',
            'oss_manual',
            'x_no_of_ctn',
            'no_of_ctn',
            '`no_of_ctn`',
            '`no_of_ctn`',
            3,
            11,
            -1,
            false,
            '`no_of_ctn`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_of_ctn->InputTextType = "number";
        $this->no_of_ctn->Required = true; // Required field
        $this->no_of_ctn->Sortable = false; // Allow sort
        $this->no_of_ctn->UseFilter = true; // Table header filter
        $this->no_of_ctn->Lookup = new Lookup('no_of_ctn', 'oss_manual', true, 'no_of_ctn', ["no_of_ctn","","",""], [], [], [], [], [], [], '', '', "");
        $this->no_of_ctn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['no_of_ctn'] = &$this->no_of_ctn;

        // ctn_no
        $this->ctn_no = new DbField(
            'oss_manual',
            'oss_manual',
            'x_ctn_no',
            'ctn_no',
            '`ctn_no`',
            '`ctn_no`',
            3,
            11,
            -1,
            false,
            '`ctn_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ctn_no->InputTextType = "number";
        $this->ctn_no->Required = true; // Required field
        $this->ctn_no->Sortable = false; // Allow sort
        $this->ctn_no->UseFilter = true; // Table header filter
        $this->ctn_no->Lookup = new Lookup('ctn_no', 'oss_manual', true, 'ctn_no', ["ctn_no","","",""], [], [], [], [], [], [], '', '', "");
        $this->ctn_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['ctn_no'] = &$this->ctn_no;

        // checker
        $this->checker = new DbField(
            'oss_manual',
            'oss_manual',
            'x_checker',
            'checker',
            '`checker`',
            '`checker`',
            200,
            255,
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
        $this->checker->Required = true; // Required field
        $this->checker->Sortable = false; // Allow sort
        $this->checker->UseFilter = true; // Table header filter
        $this->checker->Lookup = new Lookup('checker', 'oss_manual', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['checker'] = &$this->checker;

        // shift
        $this->shift = new DbField(
            'oss_manual',
            'oss_manual',
            'x_shift',
            'shift',
            '`shift`',
            '`shift`',
            200,
            255,
            -1,
            false,
            '`shift`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->shift->InputTextType = "text";
        $this->shift->Sortable = false; // Allow sort
        $this->shift->UseFilter = true; // Table header filter
        $this->shift->Lookup = new Lookup('shift', 'oss_manual', true, 'shift', ["shift","","",""], [], [], [], [], [], [], '', '', "");
        $this->shift->OptionCount = 3;
        $this->Fields['shift'] = &$this->shift;

        // status
        $this->status = new DbField(
            'oss_manual',
            'oss_manual',
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
        $this->status->Sortable = false; // Allow sort
        $this->status->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->status->UseFilter = true; // Table header filter
        $this->status->Lookup = new Lookup('status', 'oss_manual', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
        $this->status->OptionCount = 2;
        $this->Fields['status'] = &$this->status;

        // date_updated
        $this->date_updated = new DbField(
            'oss_manual',
            'oss_manual',
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
        $this->date_updated->Sortable = false; // Allow sort
        $this->date_updated->UseFilter = true; // Table header filter
        $this->date_updated->Lookup = new Lookup('date_updated', 'oss_manual', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_updated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_updated'] = &$this->date_updated;

        // time_updated
        $this->time_updated = new DbField(
            'oss_manual',
            'oss_manual',
            'x_time_updated',
            'time_updated',
            '`time_updated`',
            CastDateFieldForLike("`time_updated`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`time_updated`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->time_updated->InputTextType = "text";
        $this->time_updated->Sortable = false; // Allow sort
        $this->time_updated->UseFilter = true; // Table header filter
        $this->time_updated->Lookup = new Lookup('time_updated', 'oss_manual', true, 'time_updated', ["time_updated","","",""], [], [], [], [], [], [], '', '', "");
        $this->time_updated->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['time_updated'] = &$this->time_updated;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`oss_manual`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, '' AS `scan`");
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
            if (array_key_exists('sscc', $rs)) {
                AddFilter($where, QuotedName('sscc', $this->Dbid) . '=' . QuotedValue($rs['sscc'], $this->sscc->DataType, $this->Dbid));
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
        $this->date->DbValue = $row['date'];
        $this->sscc->DbValue = $row['sscc'];
        $this->scan->DbValue = $row['scan'];
        $this->shipment->DbValue = $row['shipment'];
        $this->pallet_no->DbValue = $row['pallet_no'];
        $this->idw->DbValue = $row['idw'];
        $this->order_no->DbValue = $row['order_no'];
        $this->item_in_ctn->DbValue = $row['item_in_ctn'];
        $this->no_of_ctn->DbValue = $row['no_of_ctn'];
        $this->ctn_no->DbValue = $row['ctn_no'];
        $this->checker->DbValue = $row['checker'];
        $this->shift->DbValue = $row['shift'];
        $this->status->DbValue = $row['status'];
        $this->date_updated->DbValue = $row['date_updated'];
        $this->time_updated->DbValue = $row['time_updated'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`sscc` = '@sscc@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->sscc->CurrentValue : $this->sscc->OldValue;
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
                $this->sscc->CurrentValue = $keys[0];
            } else {
                $this->sscc->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('sscc', $row) ? $row['sscc'] : null;
        } else {
            $val = $this->sscc->OldValue !== null ? $this->sscc->OldValue : $this->sscc->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@sscc@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ossmanuallist");
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
        if ($pageName == "ossmanualview") {
            return $Language->phrase("View");
        } elseif ($pageName == "ossmanualedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ossmanualadd") {
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
                return "OssManualView";
            case Config("API_ADD_ACTION"):
                return "OssManualAdd";
            case Config("API_EDIT_ACTION"):
                return "OssManualEdit";
            case Config("API_DELETE_ACTION"):
                return "OssManualDelete";
            case Config("API_LIST_ACTION"):
                return "OssManualList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ossmanuallist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ossmanualview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ossmanualview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ossmanualadd?" . $this->getUrlParm($parm);
        } else {
            $url = "ossmanualadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ossmanualedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ossmanualadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ossmanualdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"sscc\":" . JsonEncode($this->sscc->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->sscc->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->sscc->CurrentValue);
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
            if (($keyValue = Param("sscc") ?? Route("sscc")) !== null) {
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
                $this->sscc->CurrentValue = $key;
            } else {
                $this->sscc->OldValue = $key;
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
        $this->date->setDbValue($row['date']);
        $this->sscc->setDbValue($row['sscc']);
        $this->scan->setDbValue($row['scan']);
        $this->shipment->setDbValue($row['shipment']);
        $this->pallet_no->setDbValue($row['pallet_no']);
        $this->idw->setDbValue($row['idw']);
        $this->order_no->setDbValue($row['order_no']);
        $this->item_in_ctn->setDbValue($row['item_in_ctn']);
        $this->no_of_ctn->setDbValue($row['no_of_ctn']);
        $this->ctn_no->setDbValue($row['ctn_no']);
        $this->checker->setDbValue($row['checker']);
        $this->shift->setDbValue($row['shift']);
        $this->status->setDbValue($row['status']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->time_updated->setDbValue($row['time_updated']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // date
        $this->date->CellCssStyle = "white-space: nowrap;";

        // sscc
        $this->sscc->CellCssStyle = "white-space: nowrap;";

        // scan
        $this->scan->CellCssStyle = "white-space: nowrap;";

        // shipment
        $this->shipment->CellCssStyle = "white-space: nowrap;";

        // pallet_no
        $this->pallet_no->CellCssStyle = "white-space: nowrap;";

        // idw
        $this->idw->CellCssStyle = "white-space: nowrap;";

        // order_no
        $this->order_no->CellCssStyle = "white-space: nowrap;";

        // item_in_ctn
        $this->item_in_ctn->CellCssStyle = "white-space: nowrap;";

        // no_of_ctn
        $this->no_of_ctn->CellCssStyle = "white-space: nowrap;";

        // ctn_no
        $this->ctn_no->CellCssStyle = "white-space: nowrap;";

        // checker
        $this->checker->CellCssStyle = "white-space: nowrap;";

        // shift
        $this->shift->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // time_updated
        $this->time_updated->CellCssStyle = "white-space: nowrap;";

        // date
        $this->date->ViewValue = $this->date->CurrentValue;
        $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());
        $this->date->ViewCustomAttributes = "";

        // sscc
        $this->sscc->ViewValue = $this->sscc->CurrentValue;
        $this->sscc->ViewCustomAttributes = "";

        // scan
        $this->scan->ViewValue = $this->scan->CurrentValue;
        $this->scan->ViewCustomAttributes = "";

        // shipment
        $this->shipment->ViewValue = $this->shipment->CurrentValue;
        $this->shipment->ViewCustomAttributes = "";

        // pallet_no
        $this->pallet_no->ViewValue = $this->pallet_no->CurrentValue;
        $this->pallet_no->ViewCustomAttributes = "";

        // idw
        if (strval($this->idw->CurrentValue) != "") {
            $this->idw->ViewValue = $this->idw->optionCaption($this->idw->CurrentValue);
        } else {
            $this->idw->ViewValue = null;
        }
        $this->idw->ViewCustomAttributes = "";

        // order_no
        $this->order_no->ViewValue = $this->order_no->CurrentValue;
        $this->order_no->ViewCustomAttributes = "";

        // item_in_ctn
        $this->item_in_ctn->ViewValue = $this->item_in_ctn->CurrentValue;
        $this->item_in_ctn->ViewValue = FormatNumber($this->item_in_ctn->ViewValue, $this->item_in_ctn->formatPattern());
        $this->item_in_ctn->ViewCustomAttributes = "";

        // no_of_ctn
        $this->no_of_ctn->ViewValue = $this->no_of_ctn->CurrentValue;
        $this->no_of_ctn->ViewValue = FormatNumber($this->no_of_ctn->ViewValue, $this->no_of_ctn->formatPattern());
        $this->no_of_ctn->ViewCustomAttributes = "";

        // ctn_no
        $this->ctn_no->ViewValue = $this->ctn_no->CurrentValue;
        $this->ctn_no->ViewValue = FormatNumber($this->ctn_no->ViewValue, $this->ctn_no->formatPattern());
        $this->ctn_no->ViewCustomAttributes = "";

        // checker
        $this->checker->ViewValue = $this->checker->CurrentValue;
        $this->checker->ViewCustomAttributes = "";

        // shift
        if (strval($this->shift->CurrentValue) != "") {
            $this->shift->ViewValue = $this->shift->optionCaption($this->shift->CurrentValue);
        } else {
            $this->shift->ViewValue = null;
        }
        $this->shift->ViewCustomAttributes = "";

        // status
        if (strval($this->status->CurrentValue) != "") {
            $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
        } else {
            $this->status->ViewValue = null;
        }
        $this->status->ViewCustomAttributes = "";

        // date_updated
        $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
        $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());
        $this->date_updated->ViewCustomAttributes = "";

        // time_updated
        $this->time_updated->ViewValue = $this->time_updated->CurrentValue;
        $this->time_updated->ViewValue = FormatDateTime($this->time_updated->ViewValue, $this->time_updated->formatPattern());
        $this->time_updated->ViewCustomAttributes = "";

        // date
        $this->date->LinkCustomAttributes = "";
        $this->date->HrefValue = "";
        $this->date->TooltipValue = "";

        // sscc
        $this->sscc->LinkCustomAttributes = "";
        $this->sscc->HrefValue = "";
        $this->sscc->TooltipValue = "";

        // scan
        $this->scan->LinkCustomAttributes = "";
        $this->scan->HrefValue = "";
        $this->scan->TooltipValue = "";

        // shipment
        $this->shipment->LinkCustomAttributes = "";
        $this->shipment->HrefValue = "";
        $this->shipment->TooltipValue = "";

        // pallet_no
        $this->pallet_no->LinkCustomAttributes = "";
        $this->pallet_no->HrefValue = "";
        $this->pallet_no->TooltipValue = "";

        // idw
        $this->idw->LinkCustomAttributes = "";
        $this->idw->HrefValue = "";
        $this->idw->TooltipValue = "";

        // order_no
        $this->order_no->LinkCustomAttributes = "";
        $this->order_no->HrefValue = "";
        $this->order_no->TooltipValue = "";

        // item_in_ctn
        $this->item_in_ctn->LinkCustomAttributes = "";
        $this->item_in_ctn->HrefValue = "";
        $this->item_in_ctn->TooltipValue = "";

        // no_of_ctn
        $this->no_of_ctn->LinkCustomAttributes = "";
        $this->no_of_ctn->HrefValue = "";
        $this->no_of_ctn->TooltipValue = "";

        // ctn_no
        $this->ctn_no->LinkCustomAttributes = "";
        $this->ctn_no->HrefValue = "";
        $this->ctn_no->TooltipValue = "";

        // checker
        $this->checker->LinkCustomAttributes = "";
        $this->checker->HrefValue = "";
        $this->checker->TooltipValue = "";

        // shift
        $this->shift->LinkCustomAttributes = "";
        $this->shift->HrefValue = "";
        $this->shift->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // date_updated
        $this->date_updated->LinkCustomAttributes = "";
        $this->date_updated->HrefValue = "";
        $this->date_updated->TooltipValue = "";

        // time_updated
        $this->time_updated->LinkCustomAttributes = "";
        $this->time_updated->HrefValue = "";
        $this->time_updated->TooltipValue = "";

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

        // date
        $this->date->setupEditAttributes();
        $this->date->EditCustomAttributes = 'disabled';
        $this->date->EditValue = FormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->date->PlaceHolder = RemoveHtml($this->date->caption());

        // sscc
        $this->sscc->setupEditAttributes();
        $this->sscc->EditCustomAttributes = "";
        if (!$this->sscc->Raw) {
            $this->sscc->CurrentValue = HtmlDecode($this->sscc->CurrentValue);
        }
        $this->sscc->EditValue = $this->sscc->CurrentValue;
        $this->sscc->PlaceHolder = RemoveHtml($this->sscc->caption());

        // scan
        $this->scan->setupEditAttributes();
        $this->scan->EditCustomAttributes = 'autofocus';
        if (!$this->scan->Raw) {
            $this->scan->CurrentValue = HtmlDecode($this->scan->CurrentValue);
        }
        $this->scan->EditValue = $this->scan->CurrentValue;
        $this->scan->PlaceHolder = RemoveHtml($this->scan->caption());

        // shipment
        $this->shipment->setupEditAttributes();
        $this->shipment->EditCustomAttributes = "";
        if (!$this->shipment->Raw) {
            $this->shipment->CurrentValue = HtmlDecode($this->shipment->CurrentValue);
        }
        $this->shipment->EditValue = $this->shipment->CurrentValue;
        $this->shipment->PlaceHolder = RemoveHtml($this->shipment->caption());

        // pallet_no
        $this->pallet_no->setupEditAttributes();
        $this->pallet_no->EditCustomAttributes = "";
        if (!$this->pallet_no->Raw) {
            $this->pallet_no->CurrentValue = HtmlDecode($this->pallet_no->CurrentValue);
        }
        $this->pallet_no->EditValue = $this->pallet_no->CurrentValue;
        $this->pallet_no->PlaceHolder = RemoveHtml($this->pallet_no->caption());

        // idw
        $this->idw->EditCustomAttributes = "";
        $this->idw->EditValue = $this->idw->options(false);
        $this->idw->PlaceHolder = RemoveHtml($this->idw->caption());

        // order_no
        $this->order_no->setupEditAttributes();
        $this->order_no->EditCustomAttributes = "";
        $this->order_no->EditValue = $this->order_no->CurrentValue;
        $this->order_no->PlaceHolder = RemoveHtml($this->order_no->caption());
        if (strval($this->order_no->EditValue) != "" && is_numeric($this->order_no->EditValue)) {
            $this->order_no->EditValue = $this->order_no->EditValue;
        }

        // item_in_ctn
        $this->item_in_ctn->setupEditAttributes();
        $this->item_in_ctn->EditCustomAttributes = "";
        $this->item_in_ctn->EditValue = $this->item_in_ctn->CurrentValue;
        $this->item_in_ctn->PlaceHolder = RemoveHtml($this->item_in_ctn->caption());
        if (strval($this->item_in_ctn->EditValue) != "" && is_numeric($this->item_in_ctn->EditValue)) {
            $this->item_in_ctn->EditValue = FormatNumber($this->item_in_ctn->EditValue, null);
        }

        // no_of_ctn
        $this->no_of_ctn->setupEditAttributes();
        $this->no_of_ctn->EditCustomAttributes = "";
        $this->no_of_ctn->EditValue = $this->no_of_ctn->CurrentValue;
        $this->no_of_ctn->PlaceHolder = RemoveHtml($this->no_of_ctn->caption());
        if (strval($this->no_of_ctn->EditValue) != "" && is_numeric($this->no_of_ctn->EditValue)) {
            $this->no_of_ctn->EditValue = FormatNumber($this->no_of_ctn->EditValue, null);
        }

        // ctn_no
        $this->ctn_no->setupEditAttributes();
        $this->ctn_no->EditCustomAttributes = "";
        $this->ctn_no->EditValue = $this->ctn_no->CurrentValue;
        $this->ctn_no->PlaceHolder = RemoveHtml($this->ctn_no->caption());
        if (strval($this->ctn_no->EditValue) != "" && is_numeric($this->ctn_no->EditValue)) {
            $this->ctn_no->EditValue = FormatNumber($this->ctn_no->EditValue, null);
        }

        // checker
        $this->checker->setupEditAttributes();
        $this->checker->EditCustomAttributes = "";
        if (!$this->checker->Raw) {
            $this->checker->CurrentValue = HtmlDecode($this->checker->CurrentValue);
        }
        $this->checker->EditValue = $this->checker->CurrentValue;
        $this->checker->PlaceHolder = RemoveHtml($this->checker->caption());

        // shift
        $this->shift->EditCustomAttributes = "";
        $this->shift->EditValue = $this->shift->options(false);
        $this->shift->PlaceHolder = RemoveHtml($this->shift->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        $this->status->EditValue = $this->status->options(true);
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // date_updated
        $this->date_updated->setupEditAttributes();
        $this->date_updated->EditCustomAttributes = "";
        $this->date_updated->EditValue = FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

        // time_updated
        $this->time_updated->setupEditAttributes();
        $this->time_updated->EditCustomAttributes = "";
        $this->time_updated->EditValue = FormatDateTime($this->time_updated->CurrentValue, $this->time_updated->formatPattern());
        $this->time_updated->PlaceHolder = RemoveHtml($this->time_updated->caption());

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
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->sscc);
                    $doc->exportCaption($this->scan);
                    $doc->exportCaption($this->shipment);
                    $doc->exportCaption($this->pallet_no);
                    $doc->exportCaption($this->idw);
                    $doc->exportCaption($this->order_no);
                    $doc->exportCaption($this->item_in_ctn);
                    $doc->exportCaption($this->no_of_ctn);
                    $doc->exportCaption($this->ctn_no);
                    $doc->exportCaption($this->checker);
                    $doc->exportCaption($this->shift);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_updated);
                    $doc->exportCaption($this->time_updated);
                } else {
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->sscc);
                    $doc->exportCaption($this->shipment);
                    $doc->exportCaption($this->pallet_no);
                    $doc->exportCaption($this->idw);
                    $doc->exportCaption($this->order_no);
                    $doc->exportCaption($this->item_in_ctn);
                    $doc->exportCaption($this->no_of_ctn);
                    $doc->exportCaption($this->ctn_no);
                    $doc->exportCaption($this->checker);
                    $doc->exportCaption($this->shift);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_updated);
                    $doc->exportCaption($this->time_updated);
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
                        $doc->exportField($this->date);
                        $doc->exportField($this->sscc);
                        $doc->exportField($this->scan);
                        $doc->exportField($this->shipment);
                        $doc->exportField($this->pallet_no);
                        $doc->exportField($this->idw);
                        $doc->exportField($this->order_no);
                        $doc->exportField($this->item_in_ctn);
                        $doc->exportField($this->no_of_ctn);
                        $doc->exportField($this->ctn_no);
                        $doc->exportField($this->checker);
                        $doc->exportField($this->shift);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_updated);
                        $doc->exportField($this->time_updated);
                    } else {
                        $doc->exportField($this->date);
                        $doc->exportField($this->sscc);
                        $doc->exportField($this->shipment);
                        $doc->exportField($this->pallet_no);
                        $doc->exportField($this->idw);
                        $doc->exportField($this->order_no);
                        $doc->exportField($this->item_in_ctn);
                        $doc->exportField($this->no_of_ctn);
                        $doc->exportField($this->ctn_no);
                        $doc->exportField($this->checker);
                        $doc->exportField($this->shift);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_updated);
                        $doc->exportField($this->time_updated);
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
        $currentTime = CurrentTime();
        $currentUser = CurrentUsername();
        $_sscc 		= $rsnew["sscc"];
        $_scan 		= $rsnew["scan"];
        $_shipment 	= $rsnew["shipment"];
        $_pallet_no = $rsnew["pallet_no"];
        $_idw 		= $rsnew["idw"];
        $_order_no 	= $rsnew["order_no"];
        $_in_ctn 	= $rsnew["item_in_ctn"];
        $_no_ctn 	= $rsnew["no_of_ctn"];
        $_ctn_no 	= $rsnew["ctn_no"];
        $_checker 	= $rsnew["checker"];
        $_shift 	= $rsnew["shift"];
        $_status 	= $rsnew["status"];
        $_dateupdate 	= $rsnew["date_updated"];
        $length = "SELECT LENGTH(`sscc`) FROM `oss_manual` WHERE `sscc` =  '$_sscc' ";
        $_length = ExecuteScalar($length);
        $remove = "DELETE  FROM `oss_manual` WHERE `sscc` =  '$_sscc' ";
        //$_remove = ExecuteScalar($remove);
        $update = "UPDATE oss_manual SET `shipment` = '$_shipment',`pallet_no` = '$_pallet_no',`order_no` = '$_order_no',`item_in_ctn` = '$_in_ctn' ,`no_of_ctn` = '$_no_ctn',`ctn_no` = '$_ctn_no' ,`status` = 'Done',`date_updated` = '$currentDate',`time_updated` = '$currentTime',`checker` = '$currentUser' WHERE `sscc` = '$_scan' ";
        //$_update = ExecuteStatement($update);
        $status2 = "UPDATE oss_manual SET `status` = 'Pending' WHERE `sscc` = '$_sscc' ";
        //$_status2 = ExecuteStatement($status2);
        if($_length == 22){
        	$_remove = ExecuteScalar($remove);
        	$_update = ExecuteStatement($update);
        }
        if($_length == 20 && $_status == ""){
        	$_status2 = ExecuteStatement($status2);
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
         $this->sscc->ViewValue = "=\"" . $this->sscc->ViewValue . "\"";
         }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

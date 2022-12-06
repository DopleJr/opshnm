<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for transfer_bin_piece
 */
class TransferBinPiece extends DbTable
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
    public $source_location;
    public $article;
    public $description;
    public $destination_location;
    public $su;
    public $qty;
    public $actual;
    public $user;
    public $status;
    public $date_upload;
    public $date_confirmation;
    public $time_confirmation;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'transfer_bin_piece';
        $this->TableName = 'transfer_bin_piece';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`transfer_bin_piece`";
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
            'transfer_bin_piece',
            'transfer_bin_piece',
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // source_location
        $this->source_location = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_source_location',
            'source_location',
            '`source_location`',
            '`source_location`',
            200,
            255,
            -1,
            false,
            '`source_location`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->source_location->InputTextType = "text";
        $this->source_location->Sortable = false; // Allow sort
        $this->source_location->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->source_location->Lookup = new Lookup('source_location', 'transfer_bin_piece', true, 'source_location', ["source_location","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->source_location->Lookup = new Lookup('source_location', 'transfer_bin_piece', true, 'source_location', ["source_location","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['source_location'] = &$this->source_location;

        // article
        $this->article = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
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
        $this->article->Sortable = false; // Allow sort
        $this->article->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->article->Lookup = new Lookup('article', 'transfer_bin_piece', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->article->Lookup = new Lookup('article', 'transfer_bin_piece', true, 'article', ["article","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['article'] = &$this->article;

        // description
        $this->description = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
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
        $this->description->Sortable = false; // Allow sort
        $this->description->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->description->Lookup = new Lookup('description', 'transfer_bin_piece', true, 'description', ["description","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->description->Lookup = new Lookup('description', 'transfer_bin_piece', true, 'description', ["description","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['description'] = &$this->description;

        // destination_location
        $this->destination_location = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_destination_location',
            'destination_location',
            '`destination_location`',
            '`destination_location`',
            200,
            255,
            -1,
            false,
            '`destination_location`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->destination_location->InputTextType = "text";
        $this->destination_location->Sortable = false; // Allow sort
        $this->destination_location->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->destination_location->Lookup = new Lookup('destination_location', 'transfer_bin_piece', true, 'destination_location', ["destination_location","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->destination_location->Lookup = new Lookup('destination_location', 'transfer_bin_piece', true, 'destination_location', ["destination_location","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['destination_location'] = &$this->destination_location;

        // su
        $this->su = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_su',
            'su',
            '`su`',
            '`su`',
            200,
            255,
            -1,
            false,
            '`su`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->su->InputTextType = "text";
        $this->su->Sortable = false; // Allow sort
        $this->su->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->su->Lookup = new Lookup('su', 'transfer_bin_piece', true, 'su', ["su","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->su->Lookup = new Lookup('su', 'transfer_bin_piece', true, 'su', ["su","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['su'] = &$this->su;

        // qty
        $this->qty = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_qty',
            'qty',
            '`qty`',
            '`qty`',
            3,
            11,
            -1,
            false,
            '`qty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->qty->InputTextType = "text";
        $this->qty->Sortable = false; // Allow sort
        $this->qty->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->qty->Lookup = new Lookup('qty', 'transfer_bin_piece', true, 'qty', ["qty","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->qty->Lookup = new Lookup('qty', 'transfer_bin_piece', true, 'qty', ["qty","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['qty'] = &$this->qty;

        // actual
        $this->actual = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_actual',
            'actual',
            '`actual`',
            '`actual`',
            3,
            11,
            -1,
            false,
            '`actual`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->actual->InputTextType = "text";
        $this->actual->Sortable = false; // Allow sort
        $this->actual->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->actual->Lookup = new Lookup('actual', 'transfer_bin_piece', true, 'actual', ["actual","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->actual->Lookup = new Lookup('actual', 'transfer_bin_piece', true, 'actual', ["actual","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->actual->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['actual'] = &$this->actual;

        // user
        $this->user = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
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
            'TEXT'
        );
        $this->user->InputTextType = "text";
        $this->user->Sortable = false; // Allow sort
        $this->user->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->user->Lookup = new Lookup('user', 'transfer_bin_piece', true, 'user', ["user","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->user->Lookup = new Lookup('user', 'transfer_bin_piece', true, 'user', ["user","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['user'] = &$this->user;

        // status
        $this->status = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
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
            'TEXT'
        );
        $this->status->InputTextType = "text";
        $this->status->Sortable = false; // Allow sort
        $this->status->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->status->Lookup = new Lookup('status', 'transfer_bin_piece', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'transfer_bin_piece', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['status'] = &$this->status;

        // date_upload
        $this->date_upload = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_date_upload',
            'date_upload',
            '`date_upload`',
            CastDateFieldForLike("`date_upload`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_upload`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_upload->InputTextType = "text";
        $this->date_upload->Sortable = false; // Allow sort
        $this->date_upload->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_upload->Lookup = new Lookup('date_upload', 'transfer_bin_piece', true, 'date_upload', ["date_upload","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_upload->Lookup = new Lookup('date_upload', 'transfer_bin_piece', true, 'date_upload', ["date_upload","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_upload->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_upload'] = &$this->date_upload;

        // date_confirmation
        $this->date_confirmation = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_date_confirmation',
            'date_confirmation',
            '`date_confirmation`',
            CastDateFieldForLike("`date_confirmation`", 2, "DB"),
            133,
            10,
            2,
            false,
            '`date_confirmation`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_confirmation->InputTextType = "text";
        $this->date_confirmation->Sortable = false; // Allow sort
        $this->date_confirmation->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_confirmation->Lookup = new Lookup('date_confirmation', 'transfer_bin_piece', true, 'date_confirmation', ["date_confirmation","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_confirmation->Lookup = new Lookup('date_confirmation', 'transfer_bin_piece', true, 'date_confirmation', ["date_confirmation","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_confirmation->DefaultErrorMessage = str_replace("%s", DateFormat(2), $Language->phrase("IncorrectDate"));
        $this->Fields['date_confirmation'] = &$this->date_confirmation;

        // time_confirmation
        $this->time_confirmation = new DbField(
            'transfer_bin_piece',
            'transfer_bin_piece',
            'x_time_confirmation',
            'time_confirmation',
            '`time_confirmation`',
            CastDateFieldForLike("`time_confirmation`", 3, "DB"),
            134,
            10,
            3,
            false,
            '`time_confirmation`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->time_confirmation->InputTextType = "text";
        $this->time_confirmation->Sortable = false; // Allow sort
        $this->time_confirmation->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->time_confirmation->Lookup = new Lookup('time_confirmation', 'transfer_bin_piece', true, 'time_confirmation', ["time_confirmation","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->time_confirmation->Lookup = new Lookup('time_confirmation', 'transfer_bin_piece', true, 'time_confirmation', ["time_confirmation","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->time_confirmation->DefaultErrorMessage = str_replace("%s", DateFormat(3), $Language->phrase("IncorrectTime"));
        $this->Fields['time_confirmation'] = &$this->time_confirmation;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`transfer_bin_piece`";
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
        $this->source_location->DbValue = $row['source_location'];
        $this->article->DbValue = $row['article'];
        $this->description->DbValue = $row['description'];
        $this->destination_location->DbValue = $row['destination_location'];
        $this->su->DbValue = $row['su'];
        $this->qty->DbValue = $row['qty'];
        $this->actual->DbValue = $row['actual'];
        $this->user->DbValue = $row['user'];
        $this->status->DbValue = $row['status'];
        $this->date_upload->DbValue = $row['date_upload'];
        $this->date_confirmation->DbValue = $row['date_confirmation'];
        $this->time_confirmation->DbValue = $row['time_confirmation'];
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
        return $_SESSION[$name] ?? GetUrl("transferbinpiecelist");
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
        if ($pageName == "transferbinpieceview") {
            return $Language->phrase("View");
        } elseif ($pageName == "transferbinpieceedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "transferbinpieceadd") {
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
                return "TransferBinPieceView";
            case Config("API_ADD_ACTION"):
                return "TransferBinPieceAdd";
            case Config("API_EDIT_ACTION"):
                return "TransferBinPieceEdit";
            case Config("API_DELETE_ACTION"):
                return "TransferBinPieceDelete";
            case Config("API_LIST_ACTION"):
                return "TransferBinPieceList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "transferbinpiecelist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("transferbinpieceview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("transferbinpieceview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "transferbinpieceadd?" . $this->getUrlParm($parm);
        } else {
            $url = "transferbinpieceadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("transferbinpieceedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("transferbinpieceadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("transferbinpiecedelete", $this->getUrlParm());
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
        $this->source_location->setDbValue($row['source_location']);
        $this->article->setDbValue($row['article']);
        $this->description->setDbValue($row['description']);
        $this->destination_location->setDbValue($row['destination_location']);
        $this->su->setDbValue($row['su']);
        $this->qty->setDbValue($row['qty']);
        $this->actual->setDbValue($row['actual']);
        $this->user->setDbValue($row['user']);
        $this->status->setDbValue($row['status']);
        $this->date_upload->setDbValue($row['date_upload']);
        $this->date_confirmation->setDbValue($row['date_confirmation']);
        $this->time_confirmation->setDbValue($row['time_confirmation']);
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

        // source_location
        $this->source_location->CellCssStyle = "white-space: nowrap;";

        // article
        $this->article->CellCssStyle = "white-space: nowrap;";

        // description
        $this->description->CellCssStyle = "white-space: nowrap;";

        // destination_location
        $this->destination_location->CellCssStyle = "white-space: nowrap;";

        // su
        $this->su->CellCssStyle = "white-space: nowrap;";

        // qty
        $this->qty->CellCssStyle = "white-space: nowrap;";

        // actual
        $this->actual->CellCssStyle = "white-space: nowrap;";

        // user
        $this->user->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // date_upload
        $this->date_upload->CellCssStyle = "white-space: nowrap;";

        // date_confirmation
        $this->date_confirmation->CellCssStyle = "white-space: nowrap;";

        // time_confirmation
        $this->time_confirmation->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
        $this->id->ViewCustomAttributes = "";

        // source_location
        $this->source_location->ViewValue = $this->source_location->CurrentValue;
        $this->source_location->ViewCustomAttributes = "";

        // article
        $this->article->ViewValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

        // description
        $this->description->ViewValue = $this->description->CurrentValue;
        $this->description->ViewCustomAttributes = "";

        // destination_location
        $this->destination_location->ViewValue = $this->destination_location->CurrentValue;
        $this->destination_location->ViewCustomAttributes = "";

        // su
        $this->su->ViewValue = $this->su->CurrentValue;
        $this->su->ViewCustomAttributes = "";

        // qty
        $this->qty->ViewValue = $this->qty->CurrentValue;
        $this->qty->ViewValue = FormatNumber($this->qty->ViewValue, $this->qty->formatPattern());
        $this->qty->ViewCustomAttributes = "";

        // actual
        $this->actual->ViewValue = $this->actual->CurrentValue;
        $this->actual->ViewValue = FormatNumber($this->actual->ViewValue, $this->actual->formatPattern());
        $this->actual->ViewCustomAttributes = "";

        // user
        $this->user->ViewValue = $this->user->CurrentValue;
        $this->user->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // date_upload
        $this->date_upload->ViewValue = $this->date_upload->CurrentValue;
        $this->date_upload->ViewValue = FormatDateTime($this->date_upload->ViewValue, $this->date_upload->formatPattern());
        $this->date_upload->ViewCustomAttributes = "";

        // date_confirmation
        $this->date_confirmation->ViewValue = $this->date_confirmation->CurrentValue;
        $this->date_confirmation->ViewValue = FormatDateTime($this->date_confirmation->ViewValue, $this->date_confirmation->formatPattern());
        $this->date_confirmation->ViewCustomAttributes = "";

        // time_confirmation
        $this->time_confirmation->ViewValue = $this->time_confirmation->CurrentValue;
        $this->time_confirmation->ViewValue = FormatDateTime($this->time_confirmation->ViewValue, $this->time_confirmation->formatPattern());
        $this->time_confirmation->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // source_location
        $this->source_location->LinkCustomAttributes = "";
        $this->source_location->HrefValue = "";
        $this->source_location->TooltipValue = "";

        // article
        $this->article->LinkCustomAttributes = "";
        $this->article->HrefValue = "";
        $this->article->TooltipValue = "";

        // description
        $this->description->LinkCustomAttributes = "";
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // destination_location
        $this->destination_location->LinkCustomAttributes = "";
        $this->destination_location->HrefValue = "";
        $this->destination_location->TooltipValue = "";

        // su
        $this->su->LinkCustomAttributes = "";
        $this->su->HrefValue = "";
        $this->su->TooltipValue = "";

        // qty
        $this->qty->LinkCustomAttributes = "";
        $this->qty->HrefValue = "";
        $this->qty->TooltipValue = "";

        // actual
        $this->actual->LinkCustomAttributes = "";
        $this->actual->HrefValue = "";
        $this->actual->TooltipValue = "";

        // user
        $this->user->LinkCustomAttributes = "";
        $this->user->HrefValue = "";
        $this->user->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // date_upload
        $this->date_upload->LinkCustomAttributes = "";
        $this->date_upload->HrefValue = "";
        $this->date_upload->TooltipValue = "";

        // date_confirmation
        $this->date_confirmation->LinkCustomAttributes = "";
        $this->date_confirmation->HrefValue = "";
        $this->date_confirmation->TooltipValue = "";

        // time_confirmation
        $this->time_confirmation->LinkCustomAttributes = "";
        $this->time_confirmation->HrefValue = "";
        $this->time_confirmation->TooltipValue = "";

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

        // source_location
        $this->source_location->setupEditAttributes();
        $this->source_location->EditCustomAttributes = "";
        if (!$this->source_location->Raw) {
            $this->source_location->CurrentValue = HtmlDecode($this->source_location->CurrentValue);
        }
        $this->source_location->EditValue = $this->source_location->CurrentValue;
        $this->source_location->PlaceHolder = RemoveHtml($this->source_location->caption());

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

        // destination_location
        $this->destination_location->setupEditAttributes();
        $this->destination_location->EditCustomAttributes = "";
        if (!$this->destination_location->Raw) {
            $this->destination_location->CurrentValue = HtmlDecode($this->destination_location->CurrentValue);
        }
        $this->destination_location->EditValue = $this->destination_location->CurrentValue;
        $this->destination_location->PlaceHolder = RemoveHtml($this->destination_location->caption());

        // su
        $this->su->setupEditAttributes();
        $this->su->EditCustomAttributes = "";
        if (!$this->su->Raw) {
            $this->su->CurrentValue = HtmlDecode($this->su->CurrentValue);
        }
        $this->su->EditValue = $this->su->CurrentValue;
        $this->su->PlaceHolder = RemoveHtml($this->su->caption());

        // qty
        $this->qty->setupEditAttributes();
        $this->qty->EditCustomAttributes = "";
        $this->qty->EditValue = $this->qty->CurrentValue;
        $this->qty->PlaceHolder = RemoveHtml($this->qty->caption());
        if (strval($this->qty->EditValue) != "" && is_numeric($this->qty->EditValue)) {
            $this->qty->EditValue = FormatNumber($this->qty->EditValue, null);
        }

        // actual
        $this->actual->setupEditAttributes();
        $this->actual->EditCustomAttributes = "";
        $this->actual->EditValue = $this->actual->CurrentValue;
        $this->actual->PlaceHolder = RemoveHtml($this->actual->caption());
        if (strval($this->actual->EditValue) != "" && is_numeric($this->actual->EditValue)) {
            $this->actual->EditValue = FormatNumber($this->actual->EditValue, null);
        }

        // user
        $this->user->setupEditAttributes();
        $this->user->EditCustomAttributes = "";
        if (!$this->user->Raw) {
            $this->user->CurrentValue = HtmlDecode($this->user->CurrentValue);
        }
        $this->user->EditValue = $this->user->CurrentValue;
        $this->user->PlaceHolder = RemoveHtml($this->user->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // date_upload
        $this->date_upload->setupEditAttributes();
        $this->date_upload->EditCustomAttributes = "";
        $this->date_upload->EditValue = FormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern());
        $this->date_upload->PlaceHolder = RemoveHtml($this->date_upload->caption());

        // date_confirmation
        $this->date_confirmation->setupEditAttributes();
        $this->date_confirmation->EditCustomAttributes = "";
        $this->date_confirmation->EditValue = FormatDateTime($this->date_confirmation->CurrentValue, $this->date_confirmation->formatPattern());
        $this->date_confirmation->PlaceHolder = RemoveHtml($this->date_confirmation->caption());

        // time_confirmation
        $this->time_confirmation->setupEditAttributes();
        $this->time_confirmation->EditCustomAttributes = "";
        $this->time_confirmation->EditValue = FormatDateTime($this->time_confirmation->CurrentValue, $this->time_confirmation->formatPattern());
        $this->time_confirmation->PlaceHolder = RemoveHtml($this->time_confirmation->caption());

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
                    $doc->exportCaption($this->source_location);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->destination_location);
                    $doc->exportCaption($this->su);
                    $doc->exportCaption($this->qty);
                    $doc->exportCaption($this->actual);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_upload);
                    $doc->exportCaption($this->date_confirmation);
                    $doc->exportCaption($this->time_confirmation);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->source_location);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->destination_location);
                    $doc->exportCaption($this->su);
                    $doc->exportCaption($this->qty);
                    $doc->exportCaption($this->actual);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_upload);
                    $doc->exportCaption($this->date_confirmation);
                    $doc->exportCaption($this->time_confirmation);
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
                        $doc->exportField($this->source_location);
                        $doc->exportField($this->article);
                        $doc->exportField($this->description);
                        $doc->exportField($this->destination_location);
                        $doc->exportField($this->su);
                        $doc->exportField($this->qty);
                        $doc->exportField($this->actual);
                        $doc->exportField($this->user);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_upload);
                        $doc->exportField($this->date_confirmation);
                        $doc->exportField($this->time_confirmation);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->source_location);
                        $doc->exportField($this->article);
                        $doc->exportField($this->description);
                        $doc->exportField($this->destination_location);
                        $doc->exportField($this->su);
                        $doc->exportField($this->qty);
                        $doc->exportField($this->actual);
                        $doc->exportField($this->user);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_upload);
                        $doc->exportField($this->date_confirmation);
                        $doc->exportField($this->time_confirmation);
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
        $_upload = $rsnew["date_upload"];
        $_status = "Progress"; 
        $sql4 = "UPDATE `transfer_bin_piece` SET `status` = '$_status',`date_upload` = '$currentDate' WHERE `id` = '$_id' ";
        $result = ExecuteStatement($sql4);
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
        if ($this->status->ViewValue == "Complete"){ 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: green
                ";}
         elseif ($this->status->ViewValue == "Progress") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: grey
                ";}
         elseif ($this->status->ViewValue == "Incomplete") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: orange
                ";}
         if ($this->Export <> "") {
         //$this->box_id->ViewValue = "'" .$this->box_id->ViewValue;
         $this->article->ViewValue = "=\"" . $this->article->ViewValue . "\"";
         }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

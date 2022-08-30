<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for extra_stock
 */
class ExtraStock extends DbTable
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
    public $art6;
    public $art9;
    public $art11;
    public $article;
    public $location;
    public $ctn;
    public $quantity;
    public $description;
    public $size_desc;
    public $color_code;
    public $color_desc;
    public $season;
    public $no_box;
    public $location_2nd;
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
        $this->TableVar = 'extra_stock';
        $this->TableName = 'extra_stock';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`extra_stock`";
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
            'extra_stock',
            'extra_stock',
            'x_id',
            'id',
            '`id`',
            '`id`',
            19,
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // week
        $this->week = new DbField(
            'extra_stock',
            'extra_stock',
            'x_week',
            'week',
            'substring(yearweek(date_created),5,6)',
            'substring(yearweek(date_created),5,6)',
            200,
            2,
            -1,
            false,
            'substring(yearweek(date_created),5,6)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->week->InputTextType = "text";
        $this->week->IsCustom = true; // Custom field
        $this->week->UseFilter = true; // Table header filter
        $this->week->Lookup = new Lookup('week', 'extra_stock', true, 'week', ["week","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['week'] = &$this->week;

        // art6
        $this->art6 = new DbField(
            'extra_stock',
            'extra_stock',
            'x_art6',
            'art6',
            'if(LENGTH(article)=15,substring(article,1,6),substring(article,1,7))',
            'if(LENGTH(article)=15,substring(article,1,6),substring(article,1,7))',
            200,
            7,
            -1,
            false,
            'if(LENGTH(article)=15,substring(article,1,6),substring(article,1,7))',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->art6->InputTextType = "text";
        $this->art6->IsCustom = true; // Custom field
        $this->art6->UseFilter = true; // Table header filter
        $this->art6->Lookup = new Lookup('art6', 'extra_stock', true, 'art6', ["art6","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['art6'] = &$this->art6;

        // art9
        $this->art9 = new DbField(
            'extra_stock',
            'extra_stock',
            'x_art9',
            'art9',
            'if(LENGTH(article)=15,substring(article,1,9),substring(article,1,10))',
            'if(LENGTH(article)=15,substring(article,1,9),substring(article,1,10))',
            200,
            10,
            -1,
            false,
            'if(LENGTH(article)=15,substring(article,1,9),substring(article,1,10))',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->art9->InputTextType = "text";
        $this->art9->IsCustom = true; // Custom field
        $this->art9->UseFilter = true; // Table header filter
        $this->art9->Lookup = new Lookup('art9', 'extra_stock', true, 'art9', ["art9","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['art9'] = &$this->art9;

        // art11
        $this->art11 = new DbField(
            'extra_stock',
            'extra_stock',
            'x_art11',
            'art11',
            'if(LENGTH(article)=15,substring(article,1,11),substring(article,1,12))',
            'if(LENGTH(article)=15,substring(article,1,11),substring(article,1,12))',
            200,
            12,
            -1,
            false,
            'if(LENGTH(article)=15,substring(article,1,11),substring(article,1,12))',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->art11->InputTextType = "text";
        $this->art11->IsCustom = true; // Custom field
        $this->art11->UseFilter = true; // Table header filter
        $this->art11->Lookup = new Lookup('art11', 'extra_stock', true, 'art11', ["art11","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['art11'] = &$this->art11;

        // article
        $this->article = new DbField(
            'extra_stock',
            'extra_stock',
            'x_article',
            'article',
            '`article`',
            '`article`',
            200,
            45,
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
        $this->article->Lookup = new Lookup('article', 'master_article', true, 'article', ["article","","",""], [], ["x_size_desc","x_color_desc","x_season"], [], [], ["season","size_desc","color_desc"], ["x_season","x_size_desc","x_color_desc"], '', '', "`article`");
        $this->Fields['article'] = &$this->article;

        // location
        $this->location = new DbField(
            'extra_stock',
            'extra_stock',
            'x_location',
            'location',
            '`location`',
            '`location`',
            200,
            45,
            -1,
            false,
            '`location`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->location->InputTextType = "text";
        $this->location->UseFilter = true; // Table header filter
        $this->location->Lookup = new Lookup('location', 'extra_stock', true, 'location', ["location","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['location'] = &$this->location;

        // ctn
        $this->ctn = new DbField(
            'extra_stock',
            'extra_stock',
            'x_ctn',
            'ctn',
            '`ctn`',
            '`ctn`',
            200,
            45,
            -1,
            false,
            '`ctn`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ctn->InputTextType = "text";
        $this->ctn->UseFilter = true; // Table header filter
        $this->ctn->Lookup = new Lookup('ctn', 'extra_stock', true, 'ctn', ["ctn","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['ctn'] = &$this->ctn;

        // quantity
        $this->quantity = new DbField(
            'extra_stock',
            'extra_stock',
            'x_quantity',
            'quantity',
            '`quantity`',
            '`quantity`',
            3,
            45,
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
        $this->quantity->Lookup = new Lookup('quantity', 'extra_stock', true, 'quantity', ["quantity","","",""], [], [], [], [], [], [], '', '', "");
        $this->quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['quantity'] = &$this->quantity;

        // description
        $this->description = new DbField(
            'extra_stock',
            'extra_stock',
            'x_description',
            'description',
            '`description`',
            '`description`',
            200,
            45,
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
        $this->description->Lookup = new Lookup('description', 'extra_stock', true, 'description', ["description","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['description'] = &$this->description;

        // size_desc
        $this->size_desc = new DbField(
            'extra_stock',
            'extra_stock',
            'x_size_desc',
            'size_desc',
            '`size_desc`',
            '`size_desc`',
            200,
            45,
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
        $this->size_desc->Lookup = new Lookup('size_desc', 'master_article', true, 'article', ["size_desc","","",""], ["x_article"], [], ["article"], ["x_article"], [], [], '', '', "`size_desc`");
        $this->Fields['size_desc'] = &$this->size_desc;

        // color_code
        $this->color_code = new DbField(
            'extra_stock',
            'extra_stock',
            'x_color_code',
            'color_code',
            '`color_code`',
            '`color_code`',
            200,
            45,
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
        $this->color_code->Lookup = new Lookup('color_code', 'extra_stock', true, 'color_code', ["color_code","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['color_code'] = &$this->color_code;

        // color_desc
        $this->color_desc = new DbField(
            'extra_stock',
            'extra_stock',
            'x_color_desc',
            'color_desc',
            '`color_desc`',
            '`color_desc`',
            200,
            45,
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
        $this->color_desc->Lookup = new Lookup('color_desc', 'master_article', true, 'article', ["color_desc","","",""], ["x_article"], [], ["article"], ["x_article"], [], [], '', '', "`color_desc`");
        $this->Fields['color_desc'] = &$this->color_desc;

        // season
        $this->season = new DbField(
            'extra_stock',
            'extra_stock',
            'x_season',
            'season',
            '`season`',
            '`season`',
            200,
            45,
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
        $this->season->Lookup = new Lookup('season', 'master_article', true, 'article', ["season","","",""], ["x_article"], [], ["article"], ["x_article"], [], [], '', '', "`season`");
        $this->Fields['season'] = &$this->season;

        // no_box
        $this->no_box = new DbField(
            'extra_stock',
            'extra_stock',
            'x_no_box',
            'no_box',
            '`no_box`',
            '`no_box`',
            200,
            45,
            -1,
            false,
            '`no_box`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_box->InputTextType = "text";
        $this->no_box->UseFilter = true; // Table header filter
        $this->no_box->Lookup = new Lookup('no_box', 'extra_stock', true, 'no_box', ["no_box","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['no_box'] = &$this->no_box;

        // location_2nd
        $this->location_2nd = new DbField(
            'extra_stock',
            'extra_stock',
            'x_location_2nd',
            'location_2nd',
            '`location_2nd`',
            '`location_2nd`',
            200,
            45,
            -1,
            false,
            '`location_2nd`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->location_2nd->InputTextType = "text";
        $this->location_2nd->UseFilter = true; // Table header filter
        $this->location_2nd->Lookup = new Lookup('location_2nd', 'extra_stock', true, 'location_2nd', ["location_2nd","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['location_2nd'] = &$this->location_2nd;

        // date_created
        $this->date_created = new DbField(
            'extra_stock',
            'extra_stock',
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
        $this->date_created->Lookup = new Lookup('date_created', 'extra_stock', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new DbField(
            'extra_stock',
            'extra_stock',
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
        $this->date_updated->Lookup = new Lookup('date_updated', 'extra_stock', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`extra_stock`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, substring(yearweek(date_created),5,6) AS `week`, if(LENGTH(article)=15,substring(article,1,6),substring(article,1,7)) AS `art6`, if(LENGTH(article)=15,substring(article,1,9),substring(article,1,10)) AS `art9`, if(LENGTH(article)=15,substring(article,1,11),substring(article,1,12)) AS `art11`");
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
        $this->DefaultFilter = "`quantity`!= '0'";
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
        $this->art6->DbValue = $row['art6'];
        $this->art9->DbValue = $row['art9'];
        $this->art11->DbValue = $row['art11'];
        $this->article->DbValue = $row['article'];
        $this->location->DbValue = $row['location'];
        $this->ctn->DbValue = $row['ctn'];
        $this->quantity->DbValue = $row['quantity'];
        $this->description->DbValue = $row['description'];
        $this->size_desc->DbValue = $row['size_desc'];
        $this->color_code->DbValue = $row['color_code'];
        $this->color_desc->DbValue = $row['color_desc'];
        $this->season->DbValue = $row['season'];
        $this->no_box->DbValue = $row['no_box'];
        $this->location_2nd->DbValue = $row['location_2nd'];
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
        return $_SESSION[$name] ?? GetUrl("extrastocklist");
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
        if ($pageName == "extrastockview") {
            return $Language->phrase("View");
        } elseif ($pageName == "extrastockedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "extrastockadd") {
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
                return "ExtraStockView";
            case Config("API_ADD_ACTION"):
                return "ExtraStockAdd";
            case Config("API_EDIT_ACTION"):
                return "ExtraStockEdit";
            case Config("API_DELETE_ACTION"):
                return "ExtraStockDelete";
            case Config("API_LIST_ACTION"):
                return "ExtraStockList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "extrastocklist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("extrastockview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("extrastockview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "extrastockadd?" . $this->getUrlParm($parm);
        } else {
            $url = "extrastockadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("extrastockedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("extrastockadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("extrastockdelete", $this->getUrlParm());
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
        $this->art6->setDbValue($row['art6']);
        $this->art9->setDbValue($row['art9']);
        $this->art11->setDbValue($row['art11']);
        $this->article->setDbValue($row['article']);
        $this->location->setDbValue($row['location']);
        $this->ctn->setDbValue($row['ctn']);
        $this->quantity->setDbValue($row['quantity']);
        $this->description->setDbValue($row['description']);
        $this->size_desc->setDbValue($row['size_desc']);
        $this->color_code->setDbValue($row['color_code']);
        $this->color_desc->setDbValue($row['color_desc']);
        $this->season->setDbValue($row['season']);
        $this->no_box->setDbValue($row['no_box']);
        $this->location_2nd->setDbValue($row['location_2nd']);
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

        // week
        $this->week->CellCssStyle = "white-space: nowrap;";

        // art6
        $this->art6->CellCssStyle = "white-space: nowrap;";

        // art9
        $this->art9->CellCssStyle = "white-space: nowrap;";

        // art11
        $this->art11->CellCssStyle = "white-space: nowrap;";

        // article
        $this->article->CellCssStyle = "white-space: nowrap;";

        // location
        $this->location->CellCssStyle = "white-space: nowrap;";

        // ctn
        $this->ctn->CellCssStyle = "white-space: nowrap;";

        // quantity
        $this->quantity->CellCssStyle = "white-space: nowrap;";

        // description
        $this->description->CellCssStyle = "white-space: nowrap;";

        // size_desc
        $this->size_desc->CellCssStyle = "white-space: nowrap;";

        // color_code
        $this->color_code->CellCssStyle = "white-space: nowrap;";

        // color_desc
        $this->color_desc->CellCssStyle = "white-space: nowrap;";

        // season
        $this->season->CellCssStyle = "white-space: nowrap;";

        // no_box
        $this->no_box->CellCssStyle = "white-space: nowrap;";

        // location_2nd
        $this->location_2nd->CellCssStyle = "white-space: nowrap;";

        // date_created
        $this->date_created->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // week
        $this->week->ViewValue = $this->week->CurrentValue;
        $this->week->ViewCustomAttributes = "";

        // art6
        $this->art6->ViewValue = $this->art6->CurrentValue;
        $this->art6->ViewCustomAttributes = "";

        // art9
        $this->art9->ViewValue = $this->art9->CurrentValue;
        $this->art9->ViewCustomAttributes = "";

        // art11
        $this->art11->ViewValue = $this->art11->CurrentValue;
        $this->art11->ViewCustomAttributes = "";

        // article
        $this->article->ViewValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

        // location
        $this->location->ViewValue = $this->location->CurrentValue;
        $this->location->ViewCustomAttributes = "";

        // ctn
        $this->ctn->ViewValue = $this->ctn->CurrentValue;
        $this->ctn->ViewCustomAttributes = "";

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());
        $this->quantity->ViewCustomAttributes = "";

        // description
        $this->description->ViewValue = $this->description->CurrentValue;
        $this->description->ViewCustomAttributes = "";

        // size_desc
        $this->size_desc->ViewValue = $this->size_desc->CurrentValue;
        $this->size_desc->ViewCustomAttributes = "";

        // color_code
        $this->color_code->ViewValue = $this->color_code->CurrentValue;
        $this->color_code->ViewCustomAttributes = "";

        // color_desc
        $this->color_desc->ViewValue = $this->color_desc->CurrentValue;
        $this->color_desc->ViewCustomAttributes = "";

        // season
        $this->season->ViewValue = $this->season->CurrentValue;
        $this->season->ViewCustomAttributes = "";

        // no_box
        $this->no_box->ViewValue = $this->no_box->CurrentValue;
        $this->no_box->ViewCustomAttributes = "";

        // location_2nd
        $this->location_2nd->ViewValue = $this->location_2nd->CurrentValue;
        $this->location_2nd->ViewCustomAttributes = "";

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

        // week
        $this->week->LinkCustomAttributes = "";
        $this->week->HrefValue = "";
        $this->week->TooltipValue = "";

        // art6
        $this->art6->LinkCustomAttributes = "";
        $this->art6->HrefValue = "";
        $this->art6->TooltipValue = "";

        // art9
        $this->art9->LinkCustomAttributes = "";
        $this->art9->HrefValue = "";
        $this->art9->TooltipValue = "";

        // art11
        $this->art11->LinkCustomAttributes = "";
        $this->art11->HrefValue = "";
        $this->art11->TooltipValue = "";

        // article
        $this->article->LinkCustomAttributes = "";
        $this->article->HrefValue = "";
        $this->article->TooltipValue = "";

        // location
        $this->location->LinkCustomAttributes = "";
        $this->location->HrefValue = "";
        $this->location->TooltipValue = "";

        // ctn
        $this->ctn->LinkCustomAttributes = "";
        $this->ctn->HrefValue = "";
        $this->ctn->TooltipValue = "";

        // quantity
        $this->quantity->LinkCustomAttributes = "";
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

        // description
        $this->description->LinkCustomAttributes = "";
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // size_desc
        $this->size_desc->LinkCustomAttributes = "";
        $this->size_desc->HrefValue = "";
        $this->size_desc->TooltipValue = "";

        // color_code
        $this->color_code->LinkCustomAttributes = "";
        $this->color_code->HrefValue = "";
        $this->color_code->TooltipValue = "";

        // color_desc
        $this->color_desc->LinkCustomAttributes = "";
        $this->color_desc->HrefValue = "";
        $this->color_desc->TooltipValue = "";

        // season
        $this->season->LinkCustomAttributes = "";
        $this->season->HrefValue = "";
        $this->season->TooltipValue = "";

        // no_box
        $this->no_box->LinkCustomAttributes = "";
        $this->no_box->HrefValue = "";
        $this->no_box->TooltipValue = "";

        // location_2nd
        $this->location_2nd->LinkCustomAttributes = "";
        $this->location_2nd->HrefValue = "";
        $this->location_2nd->TooltipValue = "";

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

        // week
        $this->week->setupEditAttributes();
        $this->week->EditCustomAttributes = "";
        if (!$this->week->Raw) {
            $this->week->CurrentValue = HtmlDecode($this->week->CurrentValue);
        }
        $this->week->EditValue = $this->week->CurrentValue;
        $this->week->PlaceHolder = RemoveHtml($this->week->caption());

        // art6
        $this->art6->setupEditAttributes();
        $this->art6->EditCustomAttributes = "";
        if (!$this->art6->Raw) {
            $this->art6->CurrentValue = HtmlDecode($this->art6->CurrentValue);
        }
        $this->art6->EditValue = $this->art6->CurrentValue;
        $this->art6->PlaceHolder = RemoveHtml($this->art6->caption());

        // art9
        $this->art9->setupEditAttributes();
        $this->art9->EditCustomAttributes = "";
        if (!$this->art9->Raw) {
            $this->art9->CurrentValue = HtmlDecode($this->art9->CurrentValue);
        }
        $this->art9->EditValue = $this->art9->CurrentValue;
        $this->art9->PlaceHolder = RemoveHtml($this->art9->caption());

        // art11
        $this->art11->setupEditAttributes();
        $this->art11->EditCustomAttributes = "";
        if (!$this->art11->Raw) {
            $this->art11->CurrentValue = HtmlDecode($this->art11->CurrentValue);
        }
        $this->art11->EditValue = $this->art11->CurrentValue;
        $this->art11->PlaceHolder = RemoveHtml($this->art11->caption());

        // article
        $this->article->setupEditAttributes();
        $this->article->EditCustomAttributes = "";
        if (!$this->article->Raw) {
            $this->article->CurrentValue = HtmlDecode($this->article->CurrentValue);
        }
        $this->article->EditValue = $this->article->CurrentValue;
        $this->article->PlaceHolder = RemoveHtml($this->article->caption());

        // location
        $this->location->setupEditAttributes();
        $this->location->EditCustomAttributes = "";
        if (!$this->location->Raw) {
            $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
        }
        $this->location->EditValue = $this->location->CurrentValue;
        $this->location->PlaceHolder = RemoveHtml($this->location->caption());

        // ctn
        $this->ctn->setupEditAttributes();
        $this->ctn->EditCustomAttributes = "";
        if (!$this->ctn->Raw) {
            $this->ctn->CurrentValue = HtmlDecode($this->ctn->CurrentValue);
        }
        $this->ctn->EditValue = $this->ctn->CurrentValue;
        $this->ctn->PlaceHolder = RemoveHtml($this->ctn->caption());

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditCustomAttributes = "";
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
        }

        // description
        $this->description->setupEditAttributes();
        $this->description->EditCustomAttributes = "";
        if (!$this->description->Raw) {
            $this->description->CurrentValue = HtmlDecode($this->description->CurrentValue);
        }
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // size_desc
        $this->size_desc->setupEditAttributes();
        $this->size_desc->EditCustomAttributes = 'readonly';
        $this->size_desc->EditValue = $this->size_desc->CurrentValue;
        $this->size_desc->ViewCustomAttributes = "";

        // color_code
        $this->color_code->setupEditAttributes();
        $this->color_code->EditCustomAttributes = 'readonly';
        $this->color_code->EditValue = $this->color_code->CurrentValue;
        $this->color_code->ViewCustomAttributes = "";

        // color_desc
        $this->color_desc->setupEditAttributes();
        $this->color_desc->EditCustomAttributes = 'readonly';
        $this->color_desc->EditValue = $this->color_desc->CurrentValue;
        $this->color_desc->ViewCustomAttributes = "";

        // season
        $this->season->setupEditAttributes();
        $this->season->EditCustomAttributes = 'readonly';
        $this->season->EditValue = $this->season->CurrentValue;
        $this->season->ViewCustomAttributes = "";

        // no_box
        $this->no_box->setupEditAttributes();
        $this->no_box->EditCustomAttributes = "";
        if (!$this->no_box->Raw) {
            $this->no_box->CurrentValue = HtmlDecode($this->no_box->CurrentValue);
        }
        $this->no_box->EditValue = $this->no_box->CurrentValue;
        $this->no_box->PlaceHolder = RemoveHtml($this->no_box->caption());

        // location_2nd
        $this->location_2nd->setupEditAttributes();
        $this->location_2nd->EditCustomAttributes = "";
        if (!$this->location_2nd->Raw) {
            $this->location_2nd->CurrentValue = HtmlDecode($this->location_2nd->CurrentValue);
        }
        $this->location_2nd->EditValue = $this->location_2nd->CurrentValue;
        $this->location_2nd->PlaceHolder = RemoveHtml($this->location_2nd->caption());

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
                    $doc->exportCaption($this->week);
                    $doc->exportCaption($this->art6);
                    $doc->exportCaption($this->art9);
                    $doc->exportCaption($this->art11);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->ctn);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->color_desc);
                    $doc->exportCaption($this->season);
                    $doc->exportCaption($this->no_box);
                    $doc->exportCaption($this->location_2nd);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->date_updated);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->week);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->ctn);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->color_desc);
                    $doc->exportCaption($this->season);
                    $doc->exportCaption($this->no_box);
                    $doc->exportCaption($this->location_2nd);
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
                        $doc->exportField($this->week);
                        $doc->exportField($this->art6);
                        $doc->exportField($this->art9);
                        $doc->exportField($this->art11);
                        $doc->exportField($this->article);
                        $doc->exportField($this->location);
                        $doc->exportField($this->ctn);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->description);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->color_desc);
                        $doc->exportField($this->season);
                        $doc->exportField($this->no_box);
                        $doc->exportField($this->location_2nd);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->date_updated);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->week);
                        $doc->exportField($this->article);
                        $doc->exportField($this->location);
                        $doc->exportField($this->ctn);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->description);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->color_desc);
                        $doc->exportField($this->season);
                        $doc->exportField($this->no_box);
                        $doc->exportField($this->location_2nd);
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

<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for vas_validation
 */
class VasValidation extends DbTable
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
    public $order;
    public $po;
    public $sap_art;
    public $sub_index;
    public $concept;
    public $ctn;
    public $season2;
    public $qty_oss;
    public $shipment;
    public $aju;
    public $actual_price;
    public $price_foto;
    public $snow;
    public $remarks;
    public $date_upload;
    public $user;
    public $status;
    public $date_update;
    public $time_update;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'vas_validation';
        $this->TableName = 'vas_validation';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`vas_validation`";
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
            'vas_validation',
            'vas_validation',
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // order
        $this->order = new DbField(
            'vas_validation',
            'vas_validation',
            'x_order',
            'order',
            '`order`',
            '`order`',
            200,
            6,
            -1,
            false,
            '`order`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->order->InputTextType = "text";
        $this->order->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->order->Lookup = new Lookup('order', 'vas_validation', true, 'order', ["order","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->order->Lookup = new Lookup('order', 'vas_validation', true, 'order', ["order","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['order'] = &$this->order;

        // po
        $this->po = new DbField(
            'vas_validation',
            'vas_validation',
            'x_po',
            'po',
            '`po`',
            '`po`',
            200,
            10,
            -1,
            false,
            '`po`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->po->InputTextType = "text";
        $this->po->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->po->Lookup = new Lookup('po', 'vas_validation', true, 'po', ["po","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->po->Lookup = new Lookup('po', 'vas_validation', true, 'po', ["po","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['po'] = &$this->po;

        // sap_art
        $this->sap_art = new DbField(
            'vas_validation',
            'vas_validation',
            'x_sap_art',
            'sap_art',
            '`sap_art`',
            '`sap_art`',
            200,
            16,
            -1,
            false,
            '`sap_art`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sap_art->InputTextType = "text";
        $this->sap_art->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->sap_art->Lookup = new Lookup('sap_art', 'vas_validation', true, 'sap_art', ["sap_art","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->sap_art->Lookup = new Lookup('sap_art', 'vas_validation', true, 'sap_art', ["sap_art","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['sap_art'] = &$this->sap_art;

        // sub_index
        $this->sub_index = new DbField(
            'vas_validation',
            'vas_validation',
            'x_sub_index',
            'sub_index',
            '`sub_index`',
            '`sub_index`',
            200,
            4,
            -1,
            false,
            '`sub_index`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sub_index->InputTextType = "text";
        $this->sub_index->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->sub_index->Lookup = new Lookup('sub_index', 'vas_validation', true, 'sub_index', ["sub_index","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->sub_index->Lookup = new Lookup('sub_index', 'vas_validation', true, 'sub_index', ["sub_index","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['sub_index'] = &$this->sub_index;

        // concept
        $this->concept = new DbField(
            'vas_validation',
            'vas_validation',
            'x_concept',
            'concept',
            '`concept`',
            '`concept`',
            200,
            2,
            -1,
            false,
            '`concept`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->concept->InputTextType = "text";
        $this->concept->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->concept->Lookup = new Lookup('concept', 'vas_validation', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->concept->Lookup = new Lookup('concept', 'vas_validation', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['concept'] = &$this->concept;

        // ctn
        $this->ctn = new DbField(
            'vas_validation',
            'vas_validation',
            'x_ctn',
            'ctn',
            '`ctn`',
            '`ctn`',
            3,
            4,
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->ctn->Lookup = new Lookup('ctn', 'vas_validation', true, 'ctn', ["ctn","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->ctn->Lookup = new Lookup('ctn', 'vas_validation', true, 'ctn', ["ctn","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->ctn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['ctn'] = &$this->ctn;

        // season2
        $this->season2 = new DbField(
            'vas_validation',
            'vas_validation',
            'x_season2',
            'season2',
            '`season2`',
            '`season2`',
            200,
            255,
            -1,
            false,
            '`season2`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->season2->InputTextType = "text";
        $this->season2->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->season2->Lookup = new Lookup('season2', 'vas_validation', true, 'season2', ["season2","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->season2->Lookup = new Lookup('season2', 'vas_validation', true, 'season2', ["season2","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['season2'] = &$this->season2;

        // qty_oss
        $this->qty_oss = new DbField(
            'vas_validation',
            'vas_validation',
            'x_qty_oss',
            'qty_oss',
            '`qty_oss`',
            '`qty_oss`',
            3,
            11,
            -1,
            false,
            '`qty_oss`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->qty_oss->InputTextType = "text";
        $this->qty_oss->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->qty_oss->Lookup = new Lookup('qty_oss', 'vas_validation', true, 'qty_oss', ["qty_oss","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->qty_oss->Lookup = new Lookup('qty_oss', 'vas_validation', true, 'qty_oss', ["qty_oss","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->qty_oss->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['qty_oss'] = &$this->qty_oss;

        // shipment
        $this->shipment = new DbField(
            'vas_validation',
            'vas_validation',
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
        $this->shipment->InputTextType = "text";
        $this->shipment->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->shipment->Lookup = new Lookup('shipment', 'vas_validation', true, 'shipment', ["shipment","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->shipment->Lookup = new Lookup('shipment', 'vas_validation', true, 'shipment', ["shipment","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['shipment'] = &$this->shipment;

        // aju
        $this->aju = new DbField(
            'vas_validation',
            'vas_validation',
            'x_aju',
            'aju',
            '`aju`',
            '`aju`',
            200,
            255,
            -1,
            false,
            '`aju`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->aju->InputTextType = "text";
        $this->aju->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->aju->Lookup = new Lookup('aju', 'vas_validation', true, 'aju', ["aju","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->aju->Lookup = new Lookup('aju', 'vas_validation', true, 'aju', ["aju","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['aju'] = &$this->aju;

        // actual_price
        $this->actual_price = new DbField(
            'vas_validation',
            'vas_validation',
            'x_actual_price',
            'actual_price',
            '`actual_price`',
            '`actual_price`',
            200,
            255,
            -1,
            false,
            '`actual_price`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->actual_price->InputTextType = "text";
        $this->actual_price->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->actual_price->Lookup = new Lookup('actual_price', 'vas_validation', true, 'actual_price', ["actual_price","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->actual_price->Lookup = new Lookup('actual_price', 'vas_validation', true, 'actual_price', ["actual_price","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['actual_price'] = &$this->actual_price;

        // price_foto
        $this->price_foto = new DbField(
            'vas_validation',
            'vas_validation',
            'x_price_foto',
            'price_foto',
            '`price_foto`',
            '`price_foto`',
            200,
            255,
            -1,
            true,
            '`price_foto`',
            false,
            false,
            false,
            'IMAGE',
            'FILE'
        );
        $this->price_foto->InputTextType = "text";
        $this->price_foto->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->price_foto->Lookup = new Lookup('price_foto', 'vas_validation', true, 'price_foto', ["price_foto","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->price_foto->Lookup = new Lookup('price_foto', 'vas_validation', true, 'price_foto', ["price_foto","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->price_foto->ImageResize = true;
        $this->price_foto->UploadAllowedFileExt = "jpg,png,jpeg,gif";
        $this->price_foto->UploadMaxFileSize = 100000000;
        $this->Fields['price_foto'] = &$this->price_foto;

        // snow
        $this->snow = new DbField(
            'vas_validation',
            'vas_validation',
            'x_snow',
            'snow',
            '`snow`',
            '`snow`',
            200,
            255,
            -1,
            false,
            '`snow`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->snow->InputTextType = "text";
        $this->snow->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->snow->Lookup = new Lookup('snow', 'vas_validation', true, 'snow', ["snow","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->snow->Lookup = new Lookup('snow', 'vas_validation', true, 'snow', ["snow","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['snow'] = &$this->snow;

        // remarks
        $this->remarks = new DbField(
            'vas_validation',
            'vas_validation',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->remarks->Lookup = new Lookup('remarks', 'vas_validation', true, 'remarks', ["remarks","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->remarks->Lookup = new Lookup('remarks', 'vas_validation', true, 'remarks', ["remarks","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['remarks'] = &$this->remarks;

        // date_upload
        $this->date_upload = new DbField(
            'vas_validation',
            'vas_validation',
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
        $this->date_upload->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_upload->Lookup = new Lookup('date_upload', 'vas_validation', true, 'date_upload', ["date_upload","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_upload->Lookup = new Lookup('date_upload', 'vas_validation', true, 'date_upload', ["date_upload","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_upload->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_upload'] = &$this->date_upload;

        // user
        $this->user = new DbField(
            'vas_validation',
            'vas_validation',
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
        $this->user->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->user->Lookup = new Lookup('user', 'vas_validation', true, 'user', ["user","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->user->Lookup = new Lookup('user', 'vas_validation', true, 'user', ["user","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['user'] = &$this->user;

        // status
        $this->status = new DbField(
            'vas_validation',
            'vas_validation',
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
        $this->status->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->status->Lookup = new Lookup('status', 'vas_validation', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'vas_validation', true, 'status', ["status","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['status'] = &$this->status;

        // date_update
        $this->date_update = new DbField(
            'vas_validation',
            'vas_validation',
            'x_date_update',
            'date_update',
            '`date_update`',
            CastDateFieldForLike("`date_update`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_update`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_update->InputTextType = "text";
        $this->date_update->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_update->Lookup = new Lookup('date_update', 'vas_validation', true, 'date_update', ["date_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_update->Lookup = new Lookup('date_update', 'vas_validation', true, 'date_update', ["date_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_update->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_update'] = &$this->date_update;

        // time_update
        $this->time_update = new DbField(
            'vas_validation',
            'vas_validation',
            'x_time_update',
            'time_update',
            '`time_update`',
            CastDateFieldForLike("`time_update`", 3, "DB"),
            134,
            10,
            3,
            false,
            '`time_update`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->time_update->InputTextType = "text";
        $this->time_update->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->time_update->Lookup = new Lookup('time_update', 'vas_validation', true, 'time_update', ["time_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->time_update->Lookup = new Lookup('time_update', 'vas_validation', true, 'time_update', ["time_update","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->time_update->DefaultErrorMessage = str_replace("%s", DateFormat(3), $Language->phrase("IncorrectTime"));
        $this->Fields['time_update'] = &$this->time_update;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`vas_validation`";
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
        $this->order->DbValue = $row['order'];
        $this->po->DbValue = $row['po'];
        $this->sap_art->DbValue = $row['sap_art'];
        $this->sub_index->DbValue = $row['sub_index'];
        $this->concept->DbValue = $row['concept'];
        $this->ctn->DbValue = $row['ctn'];
        $this->season2->DbValue = $row['season2'];
        $this->qty_oss->DbValue = $row['qty_oss'];
        $this->shipment->DbValue = $row['shipment'];
        $this->aju->DbValue = $row['aju'];
        $this->actual_price->DbValue = $row['actual_price'];
        $this->price_foto->Upload->DbValue = $row['price_foto'];
        $this->snow->DbValue = $row['snow'];
        $this->remarks->DbValue = $row['remarks'];
        $this->date_upload->DbValue = $row['date_upload'];
        $this->user->DbValue = $row['user'];
        $this->status->DbValue = $row['status'];
        $this->date_update->DbValue = $row['date_update'];
        $this->time_update->DbValue = $row['time_update'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['price_foto']) ? [] : [$row['price_foto']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->price_foto->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->price_foto->oldPhysicalUploadPath() . $oldFile);
            }
        }
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
        return $_SESSION[$name] ?? GetUrl("vasvalidationlist");
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
        if ($pageName == "vasvalidationview") {
            return $Language->phrase("View");
        } elseif ($pageName == "vasvalidationedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "vasvalidationadd") {
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
                return "VasValidationView";
            case Config("API_ADD_ACTION"):
                return "VasValidationAdd";
            case Config("API_EDIT_ACTION"):
                return "VasValidationEdit";
            case Config("API_DELETE_ACTION"):
                return "VasValidationDelete";
            case Config("API_LIST_ACTION"):
                return "VasValidationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "vasvalidationlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("vasvalidationview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("vasvalidationview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "vasvalidationadd?" . $this->getUrlParm($parm);
        } else {
            $url = "vasvalidationadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("vasvalidationedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("vasvalidationadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("vasvalidationdelete", $this->getUrlParm());
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
        $this->order->setDbValue($row['order']);
        $this->po->setDbValue($row['po']);
        $this->sap_art->setDbValue($row['sap_art']);
        $this->sub_index->setDbValue($row['sub_index']);
        $this->concept->setDbValue($row['concept']);
        $this->ctn->setDbValue($row['ctn']);
        $this->season2->setDbValue($row['season2']);
        $this->qty_oss->setDbValue($row['qty_oss']);
        $this->shipment->setDbValue($row['shipment']);
        $this->aju->setDbValue($row['aju']);
        $this->actual_price->setDbValue($row['actual_price']);
        $this->price_foto->Upload->DbValue = $row['price_foto'];
        $this->snow->setDbValue($row['snow']);
        $this->remarks->setDbValue($row['remarks']);
        $this->date_upload->setDbValue($row['date_upload']);
        $this->user->setDbValue($row['user']);
        $this->status->setDbValue($row['status']);
        $this->date_update->setDbValue($row['date_update']);
        $this->time_update->setDbValue($row['time_update']);
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

        // order
        $this->order->CellCssStyle = "white-space: nowrap;";

        // po
        $this->po->CellCssStyle = "white-space: nowrap;";

        // sap_art
        $this->sap_art->CellCssStyle = "white-space: nowrap;";

        // sub_index
        $this->sub_index->CellCssStyle = "white-space: nowrap;";

        // concept
        $this->concept->CellCssStyle = "white-space: nowrap;";

        // ctn
        $this->ctn->CellCssStyle = "white-space: nowrap;";

        // season2
        $this->season2->CellCssStyle = "white-space: nowrap;";

        // qty_oss
        $this->qty_oss->CellCssStyle = "white-space: nowrap;";

        // shipment
        $this->shipment->CellCssStyle = "white-space: nowrap;";

        // aju
        $this->aju->CellCssStyle = "white-space: nowrap;";

        // actual_price
        $this->actual_price->CellCssStyle = "white-space: nowrap;";

        // price_foto
        $this->price_foto->CellCssStyle = "white-space: nowrap;";

        // snow
        $this->snow->CellCssStyle = "white-space: nowrap;";

        // remarks
        $this->remarks->CellCssStyle = "white-space: nowrap;";

        // date_upload
        $this->date_upload->CellCssStyle = "white-space: nowrap;";

        // user
        $this->user->CellCssStyle = "white-space: nowrap;";

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // date_update
        $this->date_update->CellCssStyle = "white-space: nowrap;";

        // time_update
        $this->time_update->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
        $this->id->ViewCustomAttributes = "";

        // order
        $this->order->ViewValue = $this->order->CurrentValue;
        $this->order->ViewCustomAttributes = "";

        // po
        $this->po->ViewValue = $this->po->CurrentValue;
        $this->po->ViewCustomAttributes = "";

        // sap_art
        $this->sap_art->ViewValue = $this->sap_art->CurrentValue;
        $this->sap_art->ViewCustomAttributes = "";

        // sub_index
        $this->sub_index->ViewValue = $this->sub_index->CurrentValue;
        $this->sub_index->ViewCustomAttributes = "";

        // concept
        $this->concept->ViewValue = $this->concept->CurrentValue;
        $this->concept->ViewCustomAttributes = "";

        // ctn
        $this->ctn->ViewValue = $this->ctn->CurrentValue;
        $this->ctn->ViewValue = FormatNumber($this->ctn->ViewValue, $this->ctn->formatPattern());
        $this->ctn->ViewCustomAttributes = "";

        // season2
        $this->season2->ViewValue = $this->season2->CurrentValue;
        $this->season2->ViewCustomAttributes = "";

        // qty_oss
        $this->qty_oss->ViewValue = $this->qty_oss->CurrentValue;
        $this->qty_oss->ViewValue = FormatNumber($this->qty_oss->ViewValue, $this->qty_oss->formatPattern());
        $this->qty_oss->ViewCustomAttributes = "";

        // shipment
        $this->shipment->ViewValue = $this->shipment->CurrentValue;
        $this->shipment->ViewCustomAttributes = "";

        // aju
        $this->aju->ViewValue = $this->aju->CurrentValue;
        $this->aju->ViewCustomAttributes = "";

        // actual_price
        $this->actual_price->ViewValue = $this->actual_price->CurrentValue;
        $this->actual_price->ViewCustomAttributes = "";

        // price_foto
        if (!EmptyValue($this->price_foto->Upload->DbValue)) {
            $this->price_foto->ImageWidth = 100;
            $this->price_foto->ImageHeight = 100;
            $this->price_foto->ImageAlt = $this->price_foto->alt();
            $this->price_foto->ImageCssClass = "ew-image";
            $this->price_foto->ViewValue = $this->price_foto->Upload->DbValue;
        } else {
            $this->price_foto->ViewValue = "";
        }
        $this->price_foto->ViewCustomAttributes = "";

        // snow
        $this->snow->ViewValue = $this->snow->CurrentValue;
        $this->snow->ViewCustomAttributes = "";

        // remarks
        $this->remarks->ViewValue = $this->remarks->CurrentValue;
        $this->remarks->ViewCustomAttributes = "";

        // date_upload
        $this->date_upload->ViewValue = $this->date_upload->CurrentValue;
        $this->date_upload->ViewValue = FormatDateTime($this->date_upload->ViewValue, $this->date_upload->formatPattern());
        $this->date_upload->ViewCustomAttributes = "";

        // user
        $this->user->ViewValue = $this->user->CurrentValue;
        $this->user->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // date_update
        $this->date_update->ViewValue = $this->date_update->CurrentValue;
        $this->date_update->ViewValue = FormatDateTime($this->date_update->ViewValue, $this->date_update->formatPattern());
        $this->date_update->ViewCustomAttributes = "";

        // time_update
        $this->time_update->ViewValue = $this->time_update->CurrentValue;
        $this->time_update->ViewValue = FormatDateTime($this->time_update->ViewValue, $this->time_update->formatPattern());
        $this->time_update->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // order
        $this->order->LinkCustomAttributes = "";
        $this->order->HrefValue = "";
        $this->order->TooltipValue = "";

        // po
        $this->po->LinkCustomAttributes = "";
        $this->po->HrefValue = "";
        $this->po->TooltipValue = "";

        // sap_art
        $this->sap_art->LinkCustomAttributes = "";
        $this->sap_art->HrefValue = "";
        $this->sap_art->TooltipValue = "";

        // sub_index
        $this->sub_index->LinkCustomAttributes = "";
        $this->sub_index->HrefValue = "";
        $this->sub_index->TooltipValue = "";

        // concept
        $this->concept->LinkCustomAttributes = "";
        $this->concept->HrefValue = "";
        $this->concept->TooltipValue = "";

        // ctn
        $this->ctn->LinkCustomAttributes = "";
        $this->ctn->HrefValue = "";
        $this->ctn->TooltipValue = "";

        // season2
        $this->season2->LinkCustomAttributes = "";
        $this->season2->HrefValue = "";
        $this->season2->TooltipValue = "";

        // qty_oss
        $this->qty_oss->LinkCustomAttributes = "";
        $this->qty_oss->HrefValue = "";
        $this->qty_oss->TooltipValue = "";

        // shipment
        $this->shipment->LinkCustomAttributes = "";
        $this->shipment->HrefValue = "";
        $this->shipment->TooltipValue = "";

        // aju
        $this->aju->LinkCustomAttributes = "";
        $this->aju->HrefValue = "";
        $this->aju->TooltipValue = "";

        // actual_price
        $this->actual_price->LinkCustomAttributes = "";
        $this->actual_price->HrefValue = "";
        $this->actual_price->TooltipValue = "";

        // price_foto
        $this->price_foto->LinkCustomAttributes = "";
        if (!EmptyValue($this->price_foto->Upload->DbValue)) {
            $this->price_foto->HrefValue = GetFileUploadUrl($this->price_foto, $this->price_foto->htmlDecode($this->price_foto->Upload->DbValue)); // Add prefix/suffix
            $this->price_foto->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->price_foto->HrefValue = FullUrl($this->price_foto->HrefValue, "href");
            }
        } else {
            $this->price_foto->HrefValue = "";
        }
        $this->price_foto->ExportHrefValue = $this->price_foto->UploadPath . $this->price_foto->Upload->DbValue;
        $this->price_foto->TooltipValue = "";
        if ($this->price_foto->UseColorbox) {
            if (EmptyValue($this->price_foto->TooltipValue)) {
                $this->price_foto->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->price_foto->LinkAttrs["data-rel"] = "vas_validation_x_price_foto";
            $this->price_foto->LinkAttrs->appendClass("ew-lightbox");
        }

        // snow
        $this->snow->LinkCustomAttributes = "";
        $this->snow->HrefValue = "";
        $this->snow->TooltipValue = "";

        // remarks
        $this->remarks->LinkCustomAttributes = "";
        $this->remarks->HrefValue = "";
        $this->remarks->TooltipValue = "";

        // date_upload
        $this->date_upload->LinkCustomAttributes = "";
        $this->date_upload->HrefValue = "";
        $this->date_upload->TooltipValue = "";

        // user
        $this->user->LinkCustomAttributes = "";
        $this->user->HrefValue = "";
        $this->user->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // date_update
        $this->date_update->LinkCustomAttributes = "";
        $this->date_update->HrefValue = "";
        $this->date_update->TooltipValue = "";

        // time_update
        $this->time_update->LinkCustomAttributes = "";
        $this->time_update->HrefValue = "";
        $this->time_update->TooltipValue = "";

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

        // order
        $this->order->setupEditAttributes();
        $this->order->EditCustomAttributes = "";
        if (!$this->order->Raw) {
            $this->order->CurrentValue = HtmlDecode($this->order->CurrentValue);
        }
        $this->order->EditValue = $this->order->CurrentValue;
        $this->order->PlaceHolder = RemoveHtml($this->order->caption());

        // po
        $this->po->setupEditAttributes();
        $this->po->EditCustomAttributes = "";
        if (!$this->po->Raw) {
            $this->po->CurrentValue = HtmlDecode($this->po->CurrentValue);
        }
        $this->po->EditValue = $this->po->CurrentValue;
        $this->po->PlaceHolder = RemoveHtml($this->po->caption());

        // sap_art
        $this->sap_art->setupEditAttributes();
        $this->sap_art->EditCustomAttributes = "";
        if (!$this->sap_art->Raw) {
            $this->sap_art->CurrentValue = HtmlDecode($this->sap_art->CurrentValue);
        }
        $this->sap_art->EditValue = $this->sap_art->CurrentValue;
        $this->sap_art->PlaceHolder = RemoveHtml($this->sap_art->caption());

        // sub_index
        $this->sub_index->setupEditAttributes();
        $this->sub_index->EditCustomAttributes = "";
        if (!$this->sub_index->Raw) {
            $this->sub_index->CurrentValue = HtmlDecode($this->sub_index->CurrentValue);
        }
        $this->sub_index->EditValue = $this->sub_index->CurrentValue;
        $this->sub_index->PlaceHolder = RemoveHtml($this->sub_index->caption());

        // concept
        $this->concept->setupEditAttributes();
        $this->concept->EditCustomAttributes = "";
        if (!$this->concept->Raw) {
            $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
        }
        $this->concept->EditValue = $this->concept->CurrentValue;
        $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

        // ctn
        $this->ctn->setupEditAttributes();
        $this->ctn->EditCustomAttributes = "";
        $this->ctn->EditValue = $this->ctn->CurrentValue;
        $this->ctn->PlaceHolder = RemoveHtml($this->ctn->caption());
        if (strval($this->ctn->EditValue) != "" && is_numeric($this->ctn->EditValue)) {
            $this->ctn->EditValue = FormatNumber($this->ctn->EditValue, null);
        }

        // season2
        $this->season2->setupEditAttributes();
        $this->season2->EditCustomAttributes = "";
        if (!$this->season2->Raw) {
            $this->season2->CurrentValue = HtmlDecode($this->season2->CurrentValue);
        }
        $this->season2->EditValue = $this->season2->CurrentValue;
        $this->season2->PlaceHolder = RemoveHtml($this->season2->caption());

        // qty_oss
        $this->qty_oss->setupEditAttributes();
        $this->qty_oss->EditCustomAttributes = "";
        $this->qty_oss->EditValue = $this->qty_oss->CurrentValue;
        $this->qty_oss->PlaceHolder = RemoveHtml($this->qty_oss->caption());
        if (strval($this->qty_oss->EditValue) != "" && is_numeric($this->qty_oss->EditValue)) {
            $this->qty_oss->EditValue = FormatNumber($this->qty_oss->EditValue, null);
        }

        // shipment
        $this->shipment->setupEditAttributes();
        $this->shipment->EditCustomAttributes = "";
        if (!$this->shipment->Raw) {
            $this->shipment->CurrentValue = HtmlDecode($this->shipment->CurrentValue);
        }
        $this->shipment->EditValue = $this->shipment->CurrentValue;
        $this->shipment->PlaceHolder = RemoveHtml($this->shipment->caption());

        // aju
        $this->aju->setupEditAttributes();
        $this->aju->EditCustomAttributes = "";
        if (!$this->aju->Raw) {
            $this->aju->CurrentValue = HtmlDecode($this->aju->CurrentValue);
        }
        $this->aju->EditValue = $this->aju->CurrentValue;
        $this->aju->PlaceHolder = RemoveHtml($this->aju->caption());

        // actual_price
        $this->actual_price->setupEditAttributes();
        $this->actual_price->EditCustomAttributes = "";
        if (!$this->actual_price->Raw) {
            $this->actual_price->CurrentValue = HtmlDecode($this->actual_price->CurrentValue);
        }
        $this->actual_price->EditValue = $this->actual_price->CurrentValue;
        $this->actual_price->PlaceHolder = RemoveHtml($this->actual_price->caption());

        // price_foto
        $this->price_foto->setupEditAttributes();
        $this->price_foto->EditAttrs["capture"] = "environment";
        $this->price_foto->EditCustomAttributes = "";
        if (!EmptyValue($this->price_foto->Upload->DbValue)) {
            $this->price_foto->ImageWidth = 100;
            $this->price_foto->ImageHeight = 100;
            $this->price_foto->ImageAlt = $this->price_foto->alt();
            $this->price_foto->ImageCssClass = "ew-image";
            $this->price_foto->EditValue = $this->price_foto->Upload->DbValue;
        } else {
            $this->price_foto->EditValue = "";
        }
        if (!EmptyValue($this->price_foto->CurrentValue)) {
            $this->price_foto->Upload->FileName = $this->price_foto->CurrentValue;
        }

        // snow
        $this->snow->setupEditAttributes();
        $this->snow->EditCustomAttributes = "";
        if (!$this->snow->Raw) {
            $this->snow->CurrentValue = HtmlDecode($this->snow->CurrentValue);
        }
        $this->snow->EditValue = $this->snow->CurrentValue;
        $this->snow->PlaceHolder = RemoveHtml($this->snow->caption());

        // remarks
        $this->remarks->setupEditAttributes();
        $this->remarks->EditCustomAttributes = "";
        if (!$this->remarks->Raw) {
            $this->remarks->CurrentValue = HtmlDecode($this->remarks->CurrentValue);
        }
        $this->remarks->EditValue = $this->remarks->CurrentValue;
        $this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

        // date_upload
        $this->date_upload->setupEditAttributes();
        $this->date_upload->EditCustomAttributes = "";
        $this->date_upload->EditValue = FormatDateTime($this->date_upload->CurrentValue, $this->date_upload->formatPattern());
        $this->date_upload->PlaceHolder = RemoveHtml($this->date_upload->caption());

        // user

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // date_update

        // time_update

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
                    $doc->exportCaption($this->order);
                    $doc->exportCaption($this->po);
                    $doc->exportCaption($this->sap_art);
                    $doc->exportCaption($this->sub_index);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->ctn);
                    $doc->exportCaption($this->season2);
                    $doc->exportCaption($this->qty_oss);
                    $doc->exportCaption($this->shipment);
                    $doc->exportCaption($this->aju);
                    $doc->exportCaption($this->actual_price);
                    $doc->exportCaption($this->price_foto);
                    $doc->exportCaption($this->snow);
                    $doc->exportCaption($this->remarks);
                    $doc->exportCaption($this->date_upload);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_update);
                    $doc->exportCaption($this->time_update);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->order);
                    $doc->exportCaption($this->po);
                    $doc->exportCaption($this->sap_art);
                    $doc->exportCaption($this->sub_index);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->ctn);
                    $doc->exportCaption($this->season2);
                    $doc->exportCaption($this->qty_oss);
                    $doc->exportCaption($this->shipment);
                    $doc->exportCaption($this->aju);
                    $doc->exportCaption($this->actual_price);
                    $doc->exportCaption($this->price_foto);
                    $doc->exportCaption($this->snow);
                    $doc->exportCaption($this->remarks);
                    $doc->exportCaption($this->date_upload);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->date_update);
                    $doc->exportCaption($this->time_update);
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
                        $doc->exportField($this->order);
                        $doc->exportField($this->po);
                        $doc->exportField($this->sap_art);
                        $doc->exportField($this->sub_index);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->ctn);
                        $doc->exportField($this->season2);
                        $doc->exportField($this->qty_oss);
                        $doc->exportField($this->shipment);
                        $doc->exportField($this->aju);
                        $doc->exportField($this->actual_price);
                        $doc->exportField($this->price_foto);
                        $doc->exportField($this->snow);
                        $doc->exportField($this->remarks);
                        $doc->exportField($this->date_upload);
                        $doc->exportField($this->user);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_update);
                        $doc->exportField($this->time_update);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->order);
                        $doc->exportField($this->po);
                        $doc->exportField($this->sap_art);
                        $doc->exportField($this->sub_index);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->ctn);
                        $doc->exportField($this->season2);
                        $doc->exportField($this->qty_oss);
                        $doc->exportField($this->shipment);
                        $doc->exportField($this->aju);
                        $doc->exportField($this->actual_price);
                        $doc->exportField($this->price_foto);
                        $doc->exportField($this->snow);
                        $doc->exportField($this->remarks);
                        $doc->exportField($this->date_upload);
                        $doc->exportField($this->user);
                        $doc->exportField($this->status);
                        $doc->exportField($this->date_update);
                        $doc->exportField($this->time_update);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'price_foto') {
            $fldName = "price_foto";
            $fileNameFld = "price_foto";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
        $_status1 = 'Pending';
        $currentUserr = CurrentUserName();
        $price 		= $rsnew["sap_art"];
        $like = "%";
        $_short = $like. $price . $like;
        $result = "UPDATE `vas_validation` SET  `date_upload` = '$currentDate', `status` = '$_status1' , `user` = '$currentUserr' WHERE `id` = '".$rsnew["id"]."' ";
        $_result = ExecuteStatement($result);
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
         elseif ($this->status->ViewValue == "Scanned") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: orange
                ";}
         elseif ($this->status->ViewValue == "Staging") { 
                $this->status->ViewAttrs["style"] = "
                color: aliceblue;
                background-color: blue
                ";}
        if ($this->Export<>"excel"){
    		$this->price_foto->FldViewTag = "IMG";  // change the view tag to text
    	}
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

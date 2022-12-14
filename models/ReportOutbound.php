<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for report_outbound
 */
class ReportOutbound extends DbTable
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
    public $Week;
    public $box_id;
    public $date_delivery;
    public $box_type;
    public $check_by;
    public $quantity;
    public $concept;
    public $store_code;
    public $store_name;
    public $remark;
    public $no_delivery;
    public $truck_type;
    public $seal_no;
    public $truck_plate;
    public $transporter;
    public $no_hp;
    public $checker;
    public $admin;
    public $remarks_box;
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
        $this->TableVar = 'report_outbound';
        $this->TableName = 'report_outbound';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`report_outbound`";
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
            'report_outbound',
            'report_outbound',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            10,
            0,
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
                $this->id->Lookup = new Lookup('id', 'report_outbound', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'report_outbound', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // Week
        $this->Week = new DbField(
            'report_outbound',
            'report_outbound',
            'x_Week',
            'Week',
            'substring(yearweek(date_delivery),5,6)',
            'substring(yearweek(date_delivery),5,6)',
            200,
            2,
            -1,
            false,
            'substring(yearweek(date_delivery),5,6)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Week->InputTextType = "text";
        $this->Week->IsCustom = true; // Custom field
        $this->Week->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->Week->Lookup = new Lookup('Week', 'report_outbound', true, 'Week', ["Week","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->Week->Lookup = new Lookup('Week', 'report_outbound', true, 'Week', ["Week","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['Week'] = &$this->Week;

        // box_id
        $this->box_id = new DbField(
            'report_outbound',
            'report_outbound',
            'x_box_id',
            'box_id',
            '`box_id`',
            '`box_id`',
            200,
            255,
            -1,
            false,
            '`box_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->box_id->InputTextType = "text";
        $this->box_id->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->box_id->Lookup = new Lookup('box_id', 'report_outbound', true, 'box_id', ["box_id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->box_id->Lookup = new Lookup('box_id', 'report_outbound', true, 'box_id', ["box_id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['box_id'] = &$this->box_id;

        // date_delivery
        $this->date_delivery = new DbField(
            'report_outbound',
            'report_outbound',
            'x_date_delivery',
            'date_delivery',
            '`date_delivery`',
            CastDateFieldForLike("`date_delivery`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`date_delivery`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_delivery->InputTextType = "text";
        $this->date_delivery->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_delivery->Lookup = new Lookup('date_delivery', 'report_outbound', true, 'date_delivery', ["date_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_delivery->Lookup = new Lookup('date_delivery', 'report_outbound', true, 'date_delivery', ["date_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_delivery->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_delivery'] = &$this->date_delivery;

        // box_type
        $this->box_type = new DbField(
            'report_outbound',
            'report_outbound',
            'x_box_type',
            'box_type',
            '`box_type`',
            '`box_type`',
            200,
            50,
            -1,
            false,
            '`box_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->box_type->InputTextType = "text";
        $this->box_type->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->box_type->Lookup = new Lookup('box_type', 'report_outbound', true, 'box_type', ["box_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->box_type->Lookup = new Lookup('box_type', 'report_outbound', true, 'box_type', ["box_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['box_type'] = &$this->box_type;

        // check_by
        $this->check_by = new DbField(
            'report_outbound',
            'report_outbound',
            'x_check_by',
            'check_by',
            '`check_by`',
            '`check_by`',
            200,
            50,
            -1,
            false,
            '`check_by`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->check_by->InputTextType = "text";
        $this->check_by->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->check_by->Lookup = new Lookup('check_by', 'report_outbound', true, 'check_by', ["check_by","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->check_by->Lookup = new Lookup('check_by', 'report_outbound', true, 'check_by', ["check_by","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['check_by'] = &$this->check_by;

        // quantity
        $this->quantity = new DbField(
            'report_outbound',
            'report_outbound',
            'x_quantity',
            'quantity',
            '`quantity`',
            '`quantity`',
            200,
            255,
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->quantity->Lookup = new Lookup('quantity', 'report_outbound', true, 'quantity', ["quantity","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->quantity->Lookup = new Lookup('quantity', 'report_outbound', true, 'quantity', ["quantity","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['quantity'] = &$this->quantity;

        // concept
        $this->concept = new DbField(
            'report_outbound',
            'report_outbound',
            'x_concept',
            'concept',
            '`concept`',
            '`concept`',
            200,
            5,
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
                $this->concept->Lookup = new Lookup('concept', 'report_outbound', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->concept->Lookup = new Lookup('concept', 'report_outbound', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['concept'] = &$this->concept;

        // store_code
        $this->store_code = new DbField(
            'report_outbound',
            'report_outbound',
            'x_store_code',
            'store_code',
            '`store_code`',
            '`store_code`',
            200,
            4,
            -1,
            false,
            '`store_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->store_code->InputTextType = "text";
        $this->store_code->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->store_code->Lookup = new Lookup('store_code', 'report_outbound', true, 'store_code', ["store_code","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->store_code->Lookup = new Lookup('store_code', 'report_outbound', true, 'store_code', ["store_code","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['store_code'] = &$this->store_code;

        // store_name
        $this->store_name = new DbField(
            'report_outbound',
            'report_outbound',
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
            'TEXT'
        );
        $this->store_name->InputTextType = "text";
        $this->store_name->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->store_name->Lookup = new Lookup('store_name', 'report_outbound', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->store_name->Lookup = new Lookup('store_name', 'report_outbound', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['store_name'] = &$this->store_name;

        // remark
        $this->remark = new DbField(
            'report_outbound',
            'report_outbound',
            'x_remark',
            'remark',
            '`remark`',
            '`remark`',
            200,
            255,
            -1,
            false,
            '`remark`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->remark->InputTextType = "text";
        $this->remark->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->remark->Lookup = new Lookup('remark', 'report_outbound', true, 'remark', ["remark","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->remark->Lookup = new Lookup('remark', 'report_outbound', true, 'remark', ["remark","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['remark'] = &$this->remark;

        // no_delivery
        $this->no_delivery = new DbField(
            'report_outbound',
            'report_outbound',
            'x_no_delivery',
            'no_delivery',
            '`no_delivery`',
            '`no_delivery`',
            200,
            255,
            -1,
            false,
            '`no_delivery`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_delivery->InputTextType = "text";
        $this->no_delivery->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_delivery->Lookup = new Lookup('no_delivery', 'report_outbound', true, 'no_delivery', ["no_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_delivery->Lookup = new Lookup('no_delivery', 'report_outbound', true, 'no_delivery', ["no_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_delivery'] = &$this->no_delivery;

        // truck_type
        $this->truck_type = new DbField(
            'report_outbound',
            'report_outbound',
            'x_truck_type',
            'truck_type',
            '`truck_type`',
            '`truck_type`',
            200,
            255,
            -1,
            false,
            '`truck_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->truck_type->InputTextType = "text";
        $this->truck_type->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->truck_type->Lookup = new Lookup('truck_type', 'report_outbound', true, 'truck_type', ["truck_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->truck_type->Lookup = new Lookup('truck_type', 'report_outbound', true, 'truck_type', ["truck_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['truck_type'] = &$this->truck_type;

        // seal_no
        $this->seal_no = new DbField(
            'report_outbound',
            'report_outbound',
            'x_seal_no',
            'seal_no',
            '`seal_no`',
            '`seal_no`',
            200,
            255,
            -1,
            false,
            '`seal_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->seal_no->InputTextType = "text";
        $this->seal_no->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->seal_no->Lookup = new Lookup('seal_no', 'report_outbound', true, 'seal_no', ["seal_no","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->seal_no->Lookup = new Lookup('seal_no', 'report_outbound', true, 'seal_no', ["seal_no","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['seal_no'] = &$this->seal_no;

        // truck_plate
        $this->truck_plate = new DbField(
            'report_outbound',
            'report_outbound',
            'x_truck_plate',
            'truck_plate',
            '`truck_plate`',
            '`truck_plate`',
            200,
            255,
            -1,
            false,
            '`truck_plate`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->truck_plate->InputTextType = "text";
        $this->truck_plate->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->truck_plate->Lookup = new Lookup('truck_plate', 'report_outbound', true, 'truck_plate', ["truck_plate","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->truck_plate->Lookup = new Lookup('truck_plate', 'report_outbound', true, 'truck_plate', ["truck_plate","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['truck_plate'] = &$this->truck_plate;

        // transporter
        $this->transporter = new DbField(
            'report_outbound',
            'report_outbound',
            'x_transporter',
            'transporter',
            '`transporter`',
            '`transporter`',
            200,
            255,
            -1,
            false,
            '`transporter`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->transporter->InputTextType = "text";
        $this->transporter->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->transporter->Lookup = new Lookup('transporter', 'report_outbound', true, 'transporter', ["transporter","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->transporter->Lookup = new Lookup('transporter', 'report_outbound', true, 'transporter', ["transporter","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['transporter'] = &$this->transporter;

        // no_hp
        $this->no_hp = new DbField(
            'report_outbound',
            'report_outbound',
            'x_no_hp',
            'no_hp',
            '`no_hp`',
            '`no_hp`',
            200,
            255,
            -1,
            false,
            '`no_hp`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_hp->InputTextType = "text";
        $this->no_hp->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_hp->Lookup = new Lookup('no_hp', 'report_outbound', true, 'no_hp', ["no_hp","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_hp->Lookup = new Lookup('no_hp', 'report_outbound', true, 'no_hp', ["no_hp","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_hp'] = &$this->no_hp;

        // checker
        $this->checker = new DbField(
            'report_outbound',
            'report_outbound',
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
        $this->checker->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->checker->Lookup = new Lookup('checker', 'report_outbound', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->checker->Lookup = new Lookup('checker', 'report_outbound', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['checker'] = &$this->checker;

        // admin
        $this->admin = new DbField(
            'report_outbound',
            'report_outbound',
            'x_admin',
            'admin',
            '`admin`',
            '`admin`',
            200,
            255,
            -1,
            false,
            '`admin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->admin->InputTextType = "text";
        $this->admin->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->admin->Lookup = new Lookup('admin', 'report_outbound', true, 'admin', ["admin","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->admin->Lookup = new Lookup('admin', 'report_outbound', true, 'admin', ["admin","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['admin'] = &$this->admin;

        // remarks_box
        $this->remarks_box = new DbField(
            'report_outbound',
            'report_outbound',
            'x_remarks_box',
            'remarks_box',
            '`remarks_box`',
            '`remarks_box`',
            200,
            255,
            -1,
            false,
            '`remarks_box`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->remarks_box->InputTextType = "text";
        $this->remarks_box->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->remarks_box->Lookup = new Lookup('remarks_box', 'report_outbound', true, 'remarks_box', ["remarks_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->remarks_box->Lookup = new Lookup('remarks_box', 'report_outbound', true, 'remarks_box', ["remarks_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['remarks_box'] = &$this->remarks_box;

        // date_created
        $this->date_created = new DbField(
            'report_outbound',
            'report_outbound',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_created->Lookup = new Lookup('date_created', 'report_outbound', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_created->Lookup = new Lookup('date_created', 'report_outbound', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new DbField(
            'report_outbound',
            'report_outbound',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->date_updated->Lookup = new Lookup('date_updated', 'report_outbound', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_updated->Lookup = new Lookup('date_updated', 'report_outbound', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`report_outbound`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, substring(yearweek(date_delivery),5,6) AS `Week`");
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
        $this->Week->DbValue = $row['Week'];
        $this->box_id->DbValue = $row['box_id'];
        $this->date_delivery->DbValue = $row['date_delivery'];
        $this->box_type->DbValue = $row['box_type'];
        $this->check_by->DbValue = $row['check_by'];
        $this->quantity->DbValue = $row['quantity'];
        $this->concept->DbValue = $row['concept'];
        $this->store_code->DbValue = $row['store_code'];
        $this->store_name->DbValue = $row['store_name'];
        $this->remark->DbValue = $row['remark'];
        $this->no_delivery->DbValue = $row['no_delivery'];
        $this->truck_type->DbValue = $row['truck_type'];
        $this->seal_no->DbValue = $row['seal_no'];
        $this->truck_plate->DbValue = $row['truck_plate'];
        $this->transporter->DbValue = $row['transporter'];
        $this->no_hp->DbValue = $row['no_hp'];
        $this->checker->DbValue = $row['checker'];
        $this->admin->DbValue = $row['admin'];
        $this->remarks_box->DbValue = $row['remarks_box'];
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
        return $_SESSION[$name] ?? GetUrl("reportoutboundlist");
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
        if ($pageName == "reportoutboundview") {
            return $Language->phrase("View");
        } elseif ($pageName == "reportoutboundedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "reportoutboundadd") {
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
                return "ReportOutboundView";
            case Config("API_ADD_ACTION"):
                return "ReportOutboundAdd";
            case Config("API_EDIT_ACTION"):
                return "ReportOutboundEdit";
            case Config("API_DELETE_ACTION"):
                return "ReportOutboundDelete";
            case Config("API_LIST_ACTION"):
                return "ReportOutboundList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "reportoutboundlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("reportoutboundview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("reportoutboundview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "reportoutboundadd?" . $this->getUrlParm($parm);
        } else {
            $url = "reportoutboundadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("reportoutboundedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("reportoutboundadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("reportoutbounddelete", $this->getUrlParm());
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
        $this->Week->setDbValue($row['Week']);
        $this->box_id->setDbValue($row['box_id']);
        $this->date_delivery->setDbValue($row['date_delivery']);
        $this->box_type->setDbValue($row['box_type']);
        $this->check_by->setDbValue($row['check_by']);
        $this->quantity->setDbValue($row['quantity']);
        $this->concept->setDbValue($row['concept']);
        $this->store_code->setDbValue($row['store_code']);
        $this->store_name->setDbValue($row['store_name']);
        $this->remark->setDbValue($row['remark']);
        $this->no_delivery->setDbValue($row['no_delivery']);
        $this->truck_type->setDbValue($row['truck_type']);
        $this->seal_no->setDbValue($row['seal_no']);
        $this->truck_plate->setDbValue($row['truck_plate']);
        $this->transporter->setDbValue($row['transporter']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->checker->setDbValue($row['checker']);
        $this->admin->setDbValue($row['admin']);
        $this->remarks_box->setDbValue($row['remarks_box']);
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

        // Week
        $this->Week->CellCssStyle = "white-space: nowrap;";

        // box_id
        $this->box_id->CellCssStyle = "white-space: nowrap;";

        // date_delivery
        $this->date_delivery->CellCssStyle = "white-space: nowrap;";

        // box_type
        $this->box_type->CellCssStyle = "white-space: nowrap;";

        // check_by
        $this->check_by->CellCssStyle = "white-space: nowrap;";

        // quantity
        $this->quantity->CellCssStyle = "white-space: nowrap;";

        // concept
        $this->concept->CellCssStyle = "white-space: nowrap;";

        // store_code
        $this->store_code->CellCssStyle = "white-space: nowrap;";

        // store_name
        $this->store_name->CellCssStyle = "white-space: nowrap;";

        // remark
        $this->remark->CellCssStyle = "white-space: nowrap;";

        // no_delivery
        $this->no_delivery->CellCssStyle = "white-space: nowrap;";

        // truck_type
        $this->truck_type->CellCssStyle = "white-space: nowrap;";

        // seal_no
        $this->seal_no->CellCssStyle = "white-space: nowrap;";

        // truck_plate
        $this->truck_plate->CellCssStyle = "white-space: nowrap;";

        // transporter
        $this->transporter->CellCssStyle = "white-space: nowrap;";

        // no_hp
        $this->no_hp->CellCssStyle = "white-space: nowrap;";

        // checker
        $this->checker->CellCssStyle = "white-space: nowrap;";

        // admin
        $this->admin->CellCssStyle = "white-space: nowrap;";

        // remarks_box
        $this->remarks_box->CellCssStyle = "white-space: nowrap;";

        // date_created
        $this->date_created->CellCssStyle = "white-space: nowrap;";

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // Week
        $this->Week->ViewValue = $this->Week->CurrentValue;
        $this->Week->ViewCustomAttributes = "";

        // box_id
        $this->box_id->ViewValue = $this->box_id->CurrentValue;
        $this->box_id->ViewCustomAttributes = "";

        // date_delivery
        $this->date_delivery->ViewValue = $this->date_delivery->CurrentValue;
        $this->date_delivery->ViewValue = FormatDateTime($this->date_delivery->ViewValue, $this->date_delivery->formatPattern());
        $this->date_delivery->ViewCustomAttributes = "";

        // box_type
        $this->box_type->ViewValue = $this->box_type->CurrentValue;
        $this->box_type->ViewCustomAttributes = "";

        // check_by
        $this->check_by->ViewValue = $this->check_by->CurrentValue;
        $this->check_by->ViewCustomAttributes = "";

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewCustomAttributes = "";

        // concept
        $this->concept->ViewValue = $this->concept->CurrentValue;
        $this->concept->ViewCustomAttributes = "";

        // store_code
        $this->store_code->ViewValue = $this->store_code->CurrentValue;
        $this->store_code->ViewCustomAttributes = "";

        // store_name
        $this->store_name->ViewValue = $this->store_name->CurrentValue;
        $this->store_name->ViewCustomAttributes = "";

        // remark
        $this->remark->ViewValue = $this->remark->CurrentValue;
        $this->remark->ViewCustomAttributes = "";

        // no_delivery
        $this->no_delivery->ViewValue = $this->no_delivery->CurrentValue;
        $this->no_delivery->ViewCustomAttributes = "";

        // truck_type
        $this->truck_type->ViewValue = $this->truck_type->CurrentValue;
        $this->truck_type->ViewCustomAttributes = "";

        // seal_no
        $this->seal_no->ViewValue = $this->seal_no->CurrentValue;
        $this->seal_no->ViewCustomAttributes = "";

        // truck_plate
        $this->truck_plate->ViewValue = $this->truck_plate->CurrentValue;
        $this->truck_plate->ViewCustomAttributes = "";

        // transporter
        $this->transporter->ViewValue = $this->transporter->CurrentValue;
        $this->transporter->ViewCustomAttributes = "";

        // no_hp
        $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
        $this->no_hp->ViewCustomAttributes = "";

        // checker
        $this->checker->ViewValue = $this->checker->CurrentValue;
        $this->checker->ViewCustomAttributes = "";

        // admin
        $this->admin->ViewValue = $this->admin->CurrentValue;
        $this->admin->ViewCustomAttributes = "";

        // remarks_box
        $this->remarks_box->ViewValue = $this->remarks_box->CurrentValue;
        $this->remarks_box->ViewCustomAttributes = "";

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

        // Week
        $this->Week->LinkCustomAttributes = "";
        $this->Week->HrefValue = "";
        $this->Week->TooltipValue = "";

        // box_id
        $this->box_id->LinkCustomAttributes = "";
        $this->box_id->HrefValue = "";
        $this->box_id->TooltipValue = "";

        // date_delivery
        $this->date_delivery->LinkCustomAttributes = "";
        $this->date_delivery->HrefValue = "";
        $this->date_delivery->TooltipValue = "";

        // box_type
        $this->box_type->LinkCustomAttributes = "";
        $this->box_type->HrefValue = "";
        $this->box_type->TooltipValue = "";

        // check_by
        $this->check_by->LinkCustomAttributes = "";
        $this->check_by->HrefValue = "";
        $this->check_by->TooltipValue = "";

        // quantity
        $this->quantity->LinkCustomAttributes = "";
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

        // concept
        $this->concept->LinkCustomAttributes = "";
        $this->concept->HrefValue = "";
        $this->concept->TooltipValue = "";

        // store_code
        $this->store_code->LinkCustomAttributes = "";
        $this->store_code->HrefValue = "";
        $this->store_code->TooltipValue = "";

        // store_name
        $this->store_name->LinkCustomAttributes = "";
        $this->store_name->HrefValue = "";
        $this->store_name->TooltipValue = "";

        // remark
        $this->remark->LinkCustomAttributes = "";
        $this->remark->HrefValue = "";
        $this->remark->TooltipValue = "";

        // no_delivery
        $this->no_delivery->LinkCustomAttributes = "";
        $this->no_delivery->HrefValue = "";
        $this->no_delivery->TooltipValue = "";

        // truck_type
        $this->truck_type->LinkCustomAttributes = "";
        $this->truck_type->HrefValue = "";
        $this->truck_type->TooltipValue = "";

        // seal_no
        $this->seal_no->LinkCustomAttributes = "";
        $this->seal_no->HrefValue = "";
        $this->seal_no->TooltipValue = "";

        // truck_plate
        $this->truck_plate->LinkCustomAttributes = "";
        $this->truck_plate->HrefValue = "";
        $this->truck_plate->TooltipValue = "";

        // transporter
        $this->transporter->LinkCustomAttributes = "";
        $this->transporter->HrefValue = "";
        $this->transporter->TooltipValue = "";

        // no_hp
        $this->no_hp->LinkCustomAttributes = "";
        $this->no_hp->HrefValue = "";
        $this->no_hp->TooltipValue = "";

        // checker
        $this->checker->LinkCustomAttributes = "";
        $this->checker->HrefValue = "";
        $this->checker->TooltipValue = "";

        // admin
        $this->admin->LinkCustomAttributes = "";
        $this->admin->HrefValue = "";
        $this->admin->TooltipValue = "";

        // remarks_box
        $this->remarks_box->LinkCustomAttributes = "";
        $this->remarks_box->HrefValue = "";
        $this->remarks_box->TooltipValue = "";

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

        // Week
        $this->Week->setupEditAttributes();
        $this->Week->EditCustomAttributes = "";
        if (!$this->Week->Raw) {
            $this->Week->CurrentValue = HtmlDecode($this->Week->CurrentValue);
        }
        $this->Week->EditValue = $this->Week->CurrentValue;
        $this->Week->PlaceHolder = RemoveHtml($this->Week->caption());

        // box_id
        $this->box_id->setupEditAttributes();
        $this->box_id->EditCustomAttributes = "";
        if (!$this->box_id->Raw) {
            $this->box_id->CurrentValue = HtmlDecode($this->box_id->CurrentValue);
        }
        $this->box_id->EditValue = $this->box_id->CurrentValue;
        $this->box_id->PlaceHolder = RemoveHtml($this->box_id->caption());

        // date_delivery
        $this->date_delivery->setupEditAttributes();
        $this->date_delivery->EditCustomAttributes = "";
        $this->date_delivery->EditValue = FormatDateTime($this->date_delivery->CurrentValue, $this->date_delivery->formatPattern());
        $this->date_delivery->PlaceHolder = RemoveHtml($this->date_delivery->caption());

        // box_type
        $this->box_type->setupEditAttributes();
        $this->box_type->EditCustomAttributes = "";
        if (!$this->box_type->Raw) {
            $this->box_type->CurrentValue = HtmlDecode($this->box_type->CurrentValue);
        }
        $this->box_type->EditValue = $this->box_type->CurrentValue;
        $this->box_type->PlaceHolder = RemoveHtml($this->box_type->caption());

        // check_by
        $this->check_by->setupEditAttributes();
        $this->check_by->EditCustomAttributes = "";
        if (!$this->check_by->Raw) {
            $this->check_by->CurrentValue = HtmlDecode($this->check_by->CurrentValue);
        }
        $this->check_by->EditValue = $this->check_by->CurrentValue;
        $this->check_by->PlaceHolder = RemoveHtml($this->check_by->caption());

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditCustomAttributes = "";
        if (!$this->quantity->Raw) {
            $this->quantity->CurrentValue = HtmlDecode($this->quantity->CurrentValue);
        }
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());

        // concept
        $this->concept->setupEditAttributes();
        $this->concept->EditCustomAttributes = "";
        if (!$this->concept->Raw) {
            $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
        }
        $this->concept->EditValue = $this->concept->CurrentValue;
        $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

        // store_code
        $this->store_code->setupEditAttributes();
        $this->store_code->EditCustomAttributes = "";
        if (!$this->store_code->Raw) {
            $this->store_code->CurrentValue = HtmlDecode($this->store_code->CurrentValue);
        }
        $this->store_code->EditValue = $this->store_code->CurrentValue;
        $this->store_code->PlaceHolder = RemoveHtml($this->store_code->caption());

        // store_name
        $this->store_name->setupEditAttributes();
        $this->store_name->EditCustomAttributes = "";
        if (!$this->store_name->Raw) {
            $this->store_name->CurrentValue = HtmlDecode($this->store_name->CurrentValue);
        }
        $this->store_name->EditValue = $this->store_name->CurrentValue;
        $this->store_name->PlaceHolder = RemoveHtml($this->store_name->caption());

        // remark
        $this->remark->setupEditAttributes();
        $this->remark->EditCustomAttributes = "";
        if (!$this->remark->Raw) {
            $this->remark->CurrentValue = HtmlDecode($this->remark->CurrentValue);
        }
        $this->remark->EditValue = $this->remark->CurrentValue;
        $this->remark->PlaceHolder = RemoveHtml($this->remark->caption());

        // no_delivery
        $this->no_delivery->setupEditAttributes();
        $this->no_delivery->EditCustomAttributes = "";
        if (!$this->no_delivery->Raw) {
            $this->no_delivery->CurrentValue = HtmlDecode($this->no_delivery->CurrentValue);
        }
        $this->no_delivery->EditValue = $this->no_delivery->CurrentValue;
        $this->no_delivery->PlaceHolder = RemoveHtml($this->no_delivery->caption());

        // truck_type
        $this->truck_type->setupEditAttributes();
        $this->truck_type->EditCustomAttributes = "";
        if (!$this->truck_type->Raw) {
            $this->truck_type->CurrentValue = HtmlDecode($this->truck_type->CurrentValue);
        }
        $this->truck_type->EditValue = $this->truck_type->CurrentValue;
        $this->truck_type->PlaceHolder = RemoveHtml($this->truck_type->caption());

        // seal_no
        $this->seal_no->setupEditAttributes();
        $this->seal_no->EditCustomAttributes = "";
        if (!$this->seal_no->Raw) {
            $this->seal_no->CurrentValue = HtmlDecode($this->seal_no->CurrentValue);
        }
        $this->seal_no->EditValue = $this->seal_no->CurrentValue;
        $this->seal_no->PlaceHolder = RemoveHtml($this->seal_no->caption());

        // truck_plate
        $this->truck_plate->setupEditAttributes();
        $this->truck_plate->EditCustomAttributes = "";
        if (!$this->truck_plate->Raw) {
            $this->truck_plate->CurrentValue = HtmlDecode($this->truck_plate->CurrentValue);
        }
        $this->truck_plate->EditValue = $this->truck_plate->CurrentValue;
        $this->truck_plate->PlaceHolder = RemoveHtml($this->truck_plate->caption());

        // transporter
        $this->transporter->setupEditAttributes();
        $this->transporter->EditCustomAttributes = "";
        if (!$this->transporter->Raw) {
            $this->transporter->CurrentValue = HtmlDecode($this->transporter->CurrentValue);
        }
        $this->transporter->EditValue = $this->transporter->CurrentValue;
        $this->transporter->PlaceHolder = RemoveHtml($this->transporter->caption());

        // no_hp
        $this->no_hp->setupEditAttributes();
        $this->no_hp->EditCustomAttributes = "";
        if (!$this->no_hp->Raw) {
            $this->no_hp->CurrentValue = HtmlDecode($this->no_hp->CurrentValue);
        }
        $this->no_hp->EditValue = $this->no_hp->CurrentValue;
        $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

        // checker
        $this->checker->setupEditAttributes();
        $this->checker->EditCustomAttributes = "";
        if (!$this->checker->Raw) {
            $this->checker->CurrentValue = HtmlDecode($this->checker->CurrentValue);
        }
        $this->checker->EditValue = $this->checker->CurrentValue;
        $this->checker->PlaceHolder = RemoveHtml($this->checker->caption());

        // admin
        $this->admin->setupEditAttributes();
        $this->admin->EditCustomAttributes = "";
        if (!$this->admin->Raw) {
            $this->admin->CurrentValue = HtmlDecode($this->admin->CurrentValue);
        }
        $this->admin->EditValue = $this->admin->CurrentValue;
        $this->admin->PlaceHolder = RemoveHtml($this->admin->caption());

        // remarks_box
        $this->remarks_box->setupEditAttributes();
        $this->remarks_box->EditCustomAttributes = "";
        if (!$this->remarks_box->Raw) {
            $this->remarks_box->CurrentValue = HtmlDecode($this->remarks_box->CurrentValue);
        }
        $this->remarks_box->EditValue = $this->remarks_box->CurrentValue;
        $this->remarks_box->PlaceHolder = RemoveHtml($this->remarks_box->caption());

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
                    $doc->exportCaption($this->Week);
                    $doc->exportCaption($this->box_id);
                    $doc->exportCaption($this->date_delivery);
                    $doc->exportCaption($this->box_type);
                    $doc->exportCaption($this->check_by);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->store_code);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->remark);
                    $doc->exportCaption($this->no_delivery);
                    $doc->exportCaption($this->truck_type);
                    $doc->exportCaption($this->seal_no);
                    $doc->exportCaption($this->truck_plate);
                    $doc->exportCaption($this->transporter);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->checker);
                    $doc->exportCaption($this->admin);
                    $doc->exportCaption($this->remarks_box);
                    $doc->exportCaption($this->date_updated);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->Week);
                    $doc->exportCaption($this->box_id);
                    $doc->exportCaption($this->date_delivery);
                    $doc->exportCaption($this->box_type);
                    $doc->exportCaption($this->check_by);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->store_code);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->remark);
                    $doc->exportCaption($this->no_delivery);
                    $doc->exportCaption($this->truck_type);
                    $doc->exportCaption($this->seal_no);
                    $doc->exportCaption($this->truck_plate);
                    $doc->exportCaption($this->transporter);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->checker);
                    $doc->exportCaption($this->admin);
                    $doc->exportCaption($this->remarks_box);
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
                        $doc->exportField($this->Week);
                        $doc->exportField($this->box_id);
                        $doc->exportField($this->date_delivery);
                        $doc->exportField($this->box_type);
                        $doc->exportField($this->check_by);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->store_code);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->remark);
                        $doc->exportField($this->no_delivery);
                        $doc->exportField($this->truck_type);
                        $doc->exportField($this->seal_no);
                        $doc->exportField($this->truck_plate);
                        $doc->exportField($this->transporter);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->checker);
                        $doc->exportField($this->admin);
                        $doc->exportField($this->remarks_box);
                        $doc->exportField($this->date_updated);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->Week);
                        $doc->exportField($this->box_id);
                        $doc->exportField($this->date_delivery);
                        $doc->exportField($this->box_type);
                        $doc->exportField($this->check_by);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->store_code);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->remark);
                        $doc->exportField($this->no_delivery);
                        $doc->exportField($this->truck_type);
                        $doc->exportField($this->seal_no);
                        $doc->exportField($this->truck_plate);
                        $doc->exportField($this->transporter);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->checker);
                        $doc->exportField($this->admin);
                        $doc->exportField($this->remarks_box);
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
         $this->date_delivery->AdvancedSearch->SearchConditionDefault = "OR"; // Search value
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
        $_status = 'Match';
        $currentDate = CurrentDate();
        $sql3 = "UPDATE staging SET `status` = '$_status' ,`line` = Null , `date_created` = '$currentDate' , `date_updated` = '$currentDate',  `date_delivery` = '".$rsnew["date_delivery"]."' WHERE `box_id` = '".$rsnew["box_id"]."' AND `store_code` = '".$rsnew["store_code"]."' AND `concept` = '".$rsnew["concept"]."' ";
        $result = ExecuteStatement($sql3);
        $sql4 = "UPDATE report_outbound SET `date_created` = '$currentDate' , `date_updated` = '$currentDate' WHERE `id` = '".$rsnew["id"]."' ";
        $result = ExecuteStatement($sql4);
        $sql5 = "UPDATE box_picking SET `status` = '$_status' ,`line` = Null , `date_updated` = '$currentDate',  `date_delivery` = '".$rsnew["date_delivery"]."' WHERE `box_id` = '".$rsnew["box_id"]."' AND `store_code` = '".$rsnew["store_code"]."' AND `concept` = '".$rsnew["concept"]."' ";
        $result = ExecuteStatement($sql5);
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
        if ($this->Export <> "") {
         $this->box_id->ViewValue = "=\"" . $this->box_id->ViewValue . "\"";
         }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

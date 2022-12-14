<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for Outbound
 */
class Outbound extends ReportTable
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
    public $ShowGroupHeaderAsRow = false;
    public $ShowCompactSummaryFooter = true;

    // Export
    public $ExportDoc;
    public $DeliveryTypeOrder;

    // Fields
    public $id;
    public $box_id;
    public $date_delivery;
    public $box_type;
    public $check_by;
    public $quantity;
    public $concept;
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
    public $Week;
    public $store_code;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'Outbound';
        $this->TableName = 'Outbound';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "`report_outbound`";
        $this->ReportSourceTable = 'report_outbound'; // Report source table
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (report only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

        // id
        $this->id = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->id->Lookup = new Lookup('id', 'Outbound', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'Outbound', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SourceTableVar = 'report_outbound';
        $this->Fields['id'] = &$this->id;

        // box_id
        $this->box_id = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->box_id->Lookup = new Lookup('box_id', 'Outbound', true, 'box_id', ["box_id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->box_id->Lookup = new Lookup('box_id', 'Outbound', true, 'box_id', ["box_id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->box_id->SourceTableVar = 'report_outbound';
        $this->Fields['box_id'] = &$this->box_id;

        // date_delivery
        $this->date_delivery = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->date_delivery->Lookup = new Lookup('date_delivery', 'Outbound', true, 'date_delivery', ["date_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_delivery->Lookup = new Lookup('date_delivery', 'Outbound', true, 'date_delivery', ["date_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_delivery->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_delivery->SourceTableVar = 'report_outbound';
        $this->Fields['date_delivery'] = &$this->date_delivery;

        // box_type
        $this->box_type = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->box_type->Lookup = new Lookup('box_type', 'Outbound', true, 'box_type', ["box_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->box_type->Lookup = new Lookup('box_type', 'Outbound', true, 'box_type', ["box_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->box_type->SourceTableVar = 'report_outbound';
        $this->Fields['box_type'] = &$this->box_type;

        // check_by
        $this->check_by = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->check_by->Lookup = new Lookup('check_by', 'Outbound', true, 'check_by', ["check_by","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->check_by->Lookup = new Lookup('check_by', 'Outbound', true, 'check_by', ["check_by","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->check_by->SourceTableVar = 'report_outbound';
        $this->Fields['check_by'] = &$this->check_by;

        // quantity
        $this->quantity = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->quantity->Lookup = new Lookup('quantity', 'Outbound', true, 'quantity', ["quantity","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->quantity->Lookup = new Lookup('quantity', 'Outbound', true, 'quantity', ["quantity","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->quantity->SourceTableVar = 'report_outbound';
        $this->Fields['quantity'] = &$this->quantity;

        // concept
        $this->concept = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->concept->Lookup = new Lookup('concept', 'Outbound', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->concept->Lookup = new Lookup('concept', 'Outbound', true, 'concept', ["concept","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->concept->SourceTableVar = 'report_outbound';
        $this->Fields['concept'] = &$this->concept;

        // store_name
        $this->store_name = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->store_name->Lookup = new Lookup('store_name', 'Outbound', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->store_name->Lookup = new Lookup('store_name', 'Outbound', true, 'store_name', ["store_name","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->store_name->SourceTableVar = 'report_outbound';
        $this->Fields['store_name'] = &$this->store_name;

        // remark
        $this->remark = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->remark->Lookup = new Lookup('remark', 'Outbound', true, 'remark', ["remark","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->remark->Lookup = new Lookup('remark', 'Outbound', true, 'remark', ["remark","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->remark->SourceTableVar = 'report_outbound';
        $this->Fields['remark'] = &$this->remark;

        // no_delivery
        $this->no_delivery = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->no_delivery->Lookup = new Lookup('no_delivery', 'Outbound', true, 'no_delivery', ["no_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_delivery->Lookup = new Lookup('no_delivery', 'Outbound', true, 'no_delivery', ["no_delivery","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_delivery->SourceTableVar = 'report_outbound';
        $this->Fields['no_delivery'] = &$this->no_delivery;

        // truck_type
        $this->truck_type = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->truck_type->Lookup = new Lookup('truck_type', 'Outbound', true, 'truck_type', ["truck_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->truck_type->Lookup = new Lookup('truck_type', 'Outbound', true, 'truck_type', ["truck_type","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->truck_type->SourceTableVar = 'report_outbound';
        $this->Fields['truck_type'] = &$this->truck_type;

        // seal_no
        $this->seal_no = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->seal_no->Lookup = new Lookup('seal_no', 'Outbound', true, 'seal_no', ["seal_no","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->seal_no->Lookup = new Lookup('seal_no', 'Outbound', true, 'seal_no', ["seal_no","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->seal_no->SourceTableVar = 'report_outbound';
        $this->Fields['seal_no'] = &$this->seal_no;

        // truck_plate
        $this->truck_plate = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->truck_plate->Lookup = new Lookup('truck_plate', 'Outbound', true, 'truck_plate', ["truck_plate","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->truck_plate->Lookup = new Lookup('truck_plate', 'Outbound', true, 'truck_plate', ["truck_plate","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->truck_plate->SourceTableVar = 'report_outbound';
        $this->Fields['truck_plate'] = &$this->truck_plate;

        // transporter
        $this->transporter = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->transporter->Lookup = new Lookup('transporter', 'Outbound', true, 'transporter', ["transporter","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->transporter->Lookup = new Lookup('transporter', 'Outbound', true, 'transporter', ["transporter","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->transporter->SourceTableVar = 'report_outbound';
        $this->Fields['transporter'] = &$this->transporter;

        // no_hp
        $this->no_hp = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->no_hp->Lookup = new Lookup('no_hp', 'Outbound', true, 'no_hp', ["no_hp","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_hp->Lookup = new Lookup('no_hp', 'Outbound', true, 'no_hp', ["no_hp","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_hp->SourceTableVar = 'report_outbound';
        $this->Fields['no_hp'] = &$this->no_hp;

        // checker
        $this->checker = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->checker->Lookup = new Lookup('checker', 'Outbound', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->checker->Lookup = new Lookup('checker', 'Outbound', true, 'checker', ["checker","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->checker->SourceTableVar = 'report_outbound';
        $this->Fields['checker'] = &$this->checker;

        // admin
        $this->admin = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->admin->Lookup = new Lookup('admin', 'Outbound', true, 'admin', ["admin","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->admin->Lookup = new Lookup('admin', 'Outbound', true, 'admin', ["admin","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->admin->SourceTableVar = 'report_outbound';
        $this->Fields['admin'] = &$this->admin;

        // remarks_box
        $this->remarks_box = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->remarks_box->Lookup = new Lookup('remarks_box', 'Outbound', true, 'remarks_box', ["remarks_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->remarks_box->Lookup = new Lookup('remarks_box', 'Outbound', true, 'remarks_box', ["remarks_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->remarks_box->SourceTableVar = 'report_outbound';
        $this->Fields['remarks_box'] = &$this->remarks_box;

        // date_created
        $this->date_created = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->date_created->Lookup = new Lookup('date_created', 'Outbound', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_created->Lookup = new Lookup('date_created', 'Outbound', true, 'date_created', ["date_created","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_created->SourceTableVar = 'report_outbound';
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new ReportField(
            'Outbound',
            'Outbound',
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
                $this->date_updated->Lookup = new Lookup('date_updated', 'Outbound', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->date_updated->Lookup = new Lookup('date_updated', 'Outbound', true, 'date_updated', ["date_updated","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->date_updated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_updated->SourceTableVar = 'report_outbound';
        $this->Fields['date_updated'] = &$this->date_updated;

        // Week
        $this->Week = new ReportField(
            'Outbound',
            'Outbound',
            'x_Week',
            'Week',
            '`Week`',
            '`Week`',
            200,
            2,
            -1,
            false,
            '`Week`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Week->InputTextType = "text";
        $this->Week->SourceTableVar = 'report_outbound';
        $this->Fields['Week'] = &$this->Week;

        // store_code
        $this->store_code = new ReportField(
            'Outbound',
            'Outbound',
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
        $this->store_code->SourceTableVar = 'report_outbound';
        $this->Fields['store_code'] = &$this->store_code;

        // Delivery Type Order
        $this->DeliveryTypeOrder = new DbChart($this, 'DeliveryTypeOrder', 'Delivery Type Order', 'remark', 'quantity', 1006, '', 0, 'SUM', 600, 500);
        $this->DeliveryTypeOrder->YAxisFormat = [""];
        $this->DeliveryTypeOrder->YFieldFormat = [""];
        $this->DeliveryTypeOrder->SortType = 0;
        $this->DeliveryTypeOrder->SortSequence = "";
        $this->DeliveryTypeOrder->SqlSelect = $this->getQueryBuilder()->select("`remark`", "''", "SUM(`quantity`)");
        $this->DeliveryTypeOrder->SqlGroupBy = "`remark`";
        $this->DeliveryTypeOrder->SqlOrderBy = "";
        $this->DeliveryTypeOrder->SeriesDateType = "";
        $this->DeliveryTypeOrder->ID = "Outbound_DeliveryTypeOrder"; // Chart ID
        $this->DeliveryTypeOrder->setParameters([
            ["type", "1006"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->DeliveryTypeOrder->setParameters([
            ["caption", $this->DeliveryTypeOrder->caption()],
            ["xaxisname", $this->DeliveryTypeOrder->xAxisName()]
        ]); // Chart caption / X axis name
        $this->DeliveryTypeOrder->setParameter("yaxisname", $this->DeliveryTypeOrder->yAxisName()); // Y axis name
        $this->DeliveryTypeOrder->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->DeliveryTypeOrder->setParameter("alpha", "50"); // Chart alpha
        $this->DeliveryTypeOrder->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
        $this->DeliveryTypeOrder->setParameters([["options.plugins.legend.display",true],["options.plugins.legend.position","bottom"],["options.plugins.legend.align","center"],["options.plugins.legend.fullWidth",true],["options.plugins.legend.rtl",true],["options.plugins.legend.labels.usePointStyle",true],["options.plugins.title.display",true],["options.plugins.title.position","bottom"],["options.plugins.tooltip.enabled",true],["options.plugins.tooltip.intersect",true]]);

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

    // Single column sort
    protected function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($fld->GroupingFieldId == 0) {
                $this->setDetailOrderBy($curOrderBy); // Save to Session
            }
        } else {
            if ($fld->GroupingFieldId == 0) {
                $fld->setSort("");
            }
        }
    }

    // Get Sort SQL
    protected function sortSql()
    {
        $dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
        $argrps = [];
        foreach ($this->Fields as $fld) {
            if (in_array($fld->getSort(), ["ASC", "DESC"])) {
                $fldsql = $fld->Expression;
                if ($fld->GroupingFieldId > 0) {
                    if ($fld->GroupSql != "") {
                        $argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
                    } else {
                        $argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
                    }
                }
            }
        }
        $sortSql = "";
        foreach ($argrps as $grp) {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $grp;
        }
        if ($dtlSortSql != "") {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $dtlSortSql;
        }
        return $sortSql;
    }

    // Summary properties
    private $sqlSelectAggregate = null;
    private $sqlAggregatePrefix = "";
    private $sqlAggregateSuffix = "";
    private $sqlSelectCount = null;

    // Select Aggregate
    public function getSqlSelectAggregate()
    {
        return $this->sqlSelectAggregate ?? $this->getQueryBuilder()->select("*");
    }

    public function setSqlSelectAggregate($v)
    {
        $this->sqlSelectAggregate = $v;
    }

    // Aggregate Prefix
    public function getSqlAggregatePrefix()
    {
        return ($this->sqlAggregatePrefix != "") ? $this->sqlAggregatePrefix : "";
    }

    public function setSqlAggregatePrefix($v)
    {
        $this->sqlAggregatePrefix = $v;
    }

    // Aggregate Suffix
    public function getSqlAggregateSuffix()
    {
        return ($this->sqlAggregateSuffix != "") ? $this->sqlAggregateSuffix : "";
    }

    public function setSqlAggregateSuffix($v)
    {
        $this->sqlAggregateSuffix = $v;
    }

    // Select Count
    public function getSqlSelectCount()
    {
        return $this->sqlSelectCount ?? $this->getQueryBuilder()->select("COUNT(*)");
    }

    public function setSqlSelectCount($v)
    {
        $this->sqlSelectCount = $v;
    }

    // Render for lookup
    public function renderLookup()
    {
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
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
        if ($this->SqlSelect) {
            return $this->SqlSelect;
        }
        $select = $this->getQueryBuilder()->select("*, substring(yearweek(date_delivery),5,6) AS `Week`");
        return $select;
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
        return $_SESSION[$name] ?? GetUrl("");
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
        if ($pageName == "") {
            return $Language->phrase("View");
        } elseif ($pageName == "") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "") {
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
                return "";
            case Config("API_ADD_ACTION"):
                return "";
            case Config("API_EDIT_ACTION"):
                return "";
            case Config("API_DELETE_ACTION"):
                return "";
            case Config("API_LIST_ACTION"):
                return "";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "?" . $this->getUrlParm($parm);
        } else {
            $url = "";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        return $this->keyUrl("", $this->getUrlParm());
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
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            $this->DrillDown || $DashboardReport ||
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

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
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

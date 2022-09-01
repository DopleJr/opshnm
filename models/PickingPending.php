<?php

namespace PHPMaker2022\opsmezzanineupload;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for picking_pending
 */
class PickingPending extends DbTable
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
    public $po_no;
    public $to_no;
    public $to_order_item;
    public $to_priority;
    public $to_priority_code;
    public $source_storage_type;
    public $source_storage_bin;
    public $carton_number;
    public $creation_date;
    public $gr_number;
    public $gr_date;
    public $delivery;
    public $store_id;
    public $store_name;
    public $article;
    public $size_code;
    public $size_desc;
    public $color_code;
    public $color_desc;
    public $concept;
    public $target_qty;
    public $picked_qty;
    public $variance_qty;
    public $confirmation_date;
    public $confirmation_time;
    public $box_code;
    public $box_type;
    public $picker;
    public $status;
    public $remarks;
    public $aisle;
    public $area;
    public $aisle2;
    public $store_id2;
    public $scan_article;
    public $close_totes;
    public $job_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'picking_pending';
        $this->TableName = 'picking_pending';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`picking_pending`";
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
            'picking_pending',
            'picking_pending',
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

        // po_no
        $this->po_no = new DbField(
            'picking_pending',
            'picking_pending',
            'x_po_no',
            'po_no',
            '`po_no`',
            '`po_no`',
            200,
            45,
            -1,
            false,
            '`po_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->po_no->InputTextType = "text";
        $this->Fields['po_no'] = &$this->po_no;

        // to_no
        $this->to_no = new DbField(
            'picking_pending',
            'picking_pending',
            'x_to_no',
            'to_no',
            '`to_no`',
            '`to_no`',
            200,
            45,
            -1,
            false,
            '`to_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->to_no->InputTextType = "text";
        $this->Fields['to_no'] = &$this->to_no;

        // to_order_item
        $this->to_order_item = new DbField(
            'picking_pending',
            'picking_pending',
            'x_to_order_item',
            'to_order_item',
            '`to_order_item`',
            '`to_order_item`',
            200,
            11,
            -1,
            false,
            '`to_order_item`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->to_order_item->InputTextType = "text";
        $this->Fields['to_order_item'] = &$this->to_order_item;

        // to_priority
        $this->to_priority = new DbField(
            'picking_pending',
            'picking_pending',
            'x_to_priority',
            'to_priority',
            '`to_priority`',
            '`to_priority`',
            200,
            255,
            -1,
            false,
            '`to_priority`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->to_priority->InputTextType = "text";
        $this->Fields['to_priority'] = &$this->to_priority;

        // to_priority_code
        $this->to_priority_code = new DbField(
            'picking_pending',
            'picking_pending',
            'x_to_priority_code',
            'to_priority_code',
            '`to_priority_code`',
            '`to_priority_code`',
            200,
            255,
            -1,
            false,
            '`to_priority_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->to_priority_code->InputTextType = "text";
        $this->Fields['to_priority_code'] = &$this->to_priority_code;

        // source_storage_type
        $this->source_storage_type = new DbField(
            'picking_pending',
            'picking_pending',
            'x_source_storage_type',
            'source_storage_type',
            '`source_storage_type`',
            '`source_storage_type`',
            200,
            255,
            -1,
            false,
            '`source_storage_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->source_storage_type->InputTextType = "text";
        $this->Fields['source_storage_type'] = &$this->source_storage_type;

        // source_storage_bin
        $this->source_storage_bin = new DbField(
            'picking_pending',
            'picking_pending',
            'x_source_storage_bin',
            'source_storage_bin',
            '`source_storage_bin`',
            '`source_storage_bin`',
            200,
            255,
            -1,
            false,
            '`source_storage_bin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->source_storage_bin->InputTextType = "text";
        $this->Fields['source_storage_bin'] = &$this->source_storage_bin;

        // carton_number
        $this->carton_number = new DbField(
            'picking_pending',
            'picking_pending',
            'x_carton_number',
            'carton_number',
            '`carton_number`',
            '`carton_number`',
            200,
            255,
            -1,
            false,
            '`carton_number`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->carton_number->InputTextType = "text";
        $this->Fields['carton_number'] = &$this->carton_number;

        // creation_date
        $this->creation_date = new DbField(
            'picking_pending',
            'picking_pending',
            'x_creation_date',
            'creation_date',
            '`creation_date`',
            CastDateFieldForLike("`creation_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`creation_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->creation_date->InputTextType = "text";
        $this->creation_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['creation_date'] = &$this->creation_date;

        // gr_number
        $this->gr_number = new DbField(
            'picking_pending',
            'picking_pending',
            'x_gr_number',
            'gr_number',
            '`gr_number`',
            '`gr_number`',
            200,
            255,
            -1,
            false,
            '`gr_number`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->gr_number->InputTextType = "text";
        $this->Fields['gr_number'] = &$this->gr_number;

        // gr_date
        $this->gr_date = new DbField(
            'picking_pending',
            'picking_pending',
            'x_gr_date',
            'gr_date',
            '`gr_date`',
            CastDateFieldForLike("`gr_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`gr_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->gr_date->InputTextType = "text";
        $this->gr_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['gr_date'] = &$this->gr_date;

        // delivery
        $this->delivery = new DbField(
            'picking_pending',
            'picking_pending',
            'x_delivery',
            'delivery',
            '`delivery`',
            '`delivery`',
            200,
            255,
            -1,
            false,
            '`delivery`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->delivery->InputTextType = "text";
        $this->Fields['delivery'] = &$this->delivery;

        // store_id
        $this->store_id = new DbField(
            'picking_pending',
            'picking_pending',
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
            'TEXT'
        );
        $this->store_id->InputTextType = "text";
        $this->Fields['store_id'] = &$this->store_id;

        // store_name
        $this->store_name = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['store_name'] = &$this->store_name;

        // article
        $this->article = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['article'] = &$this->article;

        // size_code
        $this->size_code = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['size_code'] = &$this->size_code;

        // size_desc
        $this->size_desc = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['size_desc'] = &$this->size_desc;

        // color_code
        $this->color_code = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['color_code'] = &$this->color_code;

        // color_desc
        $this->color_desc = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['color_desc'] = &$this->color_desc;

        // concept
        $this->concept = new DbField(
            'picking_pending',
            'picking_pending',
            'x_concept',
            'concept',
            '`concept`',
            '`concept`',
            200,
            255,
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
        $this->Fields['concept'] = &$this->concept;

        // target_qty
        $this->target_qty = new DbField(
            'picking_pending',
            'picking_pending',
            'x_target_qty',
            'target_qty',
            '`target_qty`',
            '`target_qty`',
            3,
            11,
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
        $this->target_qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['target_qty'] = &$this->target_qty;

        // picked_qty
        $this->picked_qty = new DbField(
            'picking_pending',
            'picking_pending',
            'x_picked_qty',
            'picked_qty',
            '`picked_qty`',
            '`picked_qty`',
            3,
            11,
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
        $this->picked_qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['picked_qty'] = &$this->picked_qty;

        // variance_qty
        $this->variance_qty = new DbField(
            'picking_pending',
            'picking_pending',
            'x_variance_qty',
            'variance_qty',
            '`variance_qty`',
            '`variance_qty`',
            3,
            11,
            -1,
            false,
            '`variance_qty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->variance_qty->InputTextType = "text";
        $this->variance_qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['variance_qty'] = &$this->variance_qty;

        // confirmation_date
        $this->confirmation_date = new DbField(
            'picking_pending',
            'picking_pending',
            'x_confirmation_date',
            'confirmation_date',
            '`confirmation_date`',
            CastDateFieldForLike("`confirmation_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`confirmation_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->confirmation_date->InputTextType = "text";
        $this->confirmation_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['confirmation_date'] = &$this->confirmation_date;

        // confirmation_time
        $this->confirmation_time = new DbField(
            'picking_pending',
            'picking_pending',
            'x_confirmation_time',
            'confirmation_time',
            '`confirmation_time`',
            CastDateFieldForLike("`confirmation_time`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`confirmation_time`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->confirmation_time->InputTextType = "text";
        $this->confirmation_time->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['confirmation_time'] = &$this->confirmation_time;

        // box_code
        $this->box_code = new DbField(
            'picking_pending',
            'picking_pending',
            'x_box_code',
            'box_code',
            '`box_code`',
            '`box_code`',
            200,
            255,
            -1,
            false,
            '`box_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->box_code->InputTextType = "text";
        $this->box_code->Required = true; // Required field
        $this->Fields['box_code'] = &$this->box_code;

        // box_type
        $this->box_type = new DbField(
            'picking_pending',
            'picking_pending',
            'x_box_type',
            'box_type',
            '`box_type`',
            '`box_type`',
            200,
            255,
            -1,
            false,
            '`box_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->box_type->InputTextType = "text";
        $this->box_type->Required = true; // Required field
        $this->box_type->Lookup = new Lookup('box_type', 'picking_pending', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->box_type->OptionCount = 2;
        $this->Fields['box_type'] = &$this->box_type;

        // picker
        $this->picker = new DbField(
            'picking_pending',
            'picking_pending',
            'x_picker',
            'picker',
            '`picker`',
            '`picker`',
            200,
            255,
            -1,
            false,
            '`picker`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->picker->InputTextType = "text";
        $this->picker->UseFilter = true; // Table header filter
        $this->picker->Lookup = new Lookup('picker', 'picking_pending', true, 'picker', ["picker","","",""], [], [], [], [], [], [], '', '', "");
        $this->Fields['picker'] = &$this->picker;

        // status
        $this->status = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['status'] = &$this->status;

        // remarks
        $this->remarks = new DbField(
            'picking_pending',
            'picking_pending',
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
        $this->Fields['remarks'] = &$this->remarks;

        // aisle
        $this->aisle = new DbField(
            'picking_pending',
            'picking_pending',
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
            'TEXT'
        );
        $this->aisle->InputTextType = "text";
        $this->Fields['aisle'] = &$this->aisle;

        // area
        $this->area = new DbField(
            'picking_pending',
            'picking_pending',
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
            'TEXT'
        );
        $this->area->InputTextType = "text";
        $this->Fields['area'] = &$this->area;

        // aisle2
        $this->aisle2 = new DbField(
            'picking_pending',
            'picking_pending',
            'x_aisle2',
            'aisle2',
            '`aisle2`',
            '`aisle2`',
            200,
            255,
            -1,
            false,
            '`aisle2`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->aisle2->InputTextType = "text";
        $this->Fields['aisle2'] = &$this->aisle2;

        // store_id2
        $this->store_id2 = new DbField(
            'picking_pending',
            'picking_pending',
            'x_store_id2',
            'store_id2',
            '`store_id2`',
            '`store_id2`',
            200,
            255,
            -1,
            false,
            '`store_id2`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->store_id2->InputTextType = "text";
        $this->Fields['store_id2'] = &$this->store_id2;

        // scan_article
        $this->scan_article = new DbField(
            'picking_pending',
            'picking_pending',
            'x_scan_article',
            'scan_article',
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
        $this->scan_article->InputTextType = "text";
        $this->scan_article->IsCustom = true; // Custom field
        $this->Fields['scan_article'] = &$this->scan_article;

        // close_totes
        $this->close_totes = new DbField(
            'picking_pending',
            'picking_pending',
            'x_close_totes',
            'close_totes',
            '`close_totes`',
            '`close_totes`',
            200,
            255,
            -1,
            false,
            '`close_totes`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->close_totes->InputTextType = "text";
        $this->Fields['close_totes'] = &$this->close_totes;

        // job_id
        $this->job_id = new DbField(
            'picking_pending',
            'picking_pending',
            'x_job_id',
            'job_id',
            '`job_id`',
            '`job_id`',
            200,
            255,
            -1,
            false,
            '`job_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->job_id->InputTextType = "text";
        $this->Fields['job_id'] = &$this->job_id;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`picking_pending`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, '' AS `scan_article`");
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
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter, $id);
        }
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
        $this->po_no->DbValue = $row['po_no'];
        $this->to_no->DbValue = $row['to_no'];
        $this->to_order_item->DbValue = $row['to_order_item'];
        $this->to_priority->DbValue = $row['to_priority'];
        $this->to_priority_code->DbValue = $row['to_priority_code'];
        $this->source_storage_type->DbValue = $row['source_storage_type'];
        $this->source_storage_bin->DbValue = $row['source_storage_bin'];
        $this->carton_number->DbValue = $row['carton_number'];
        $this->creation_date->DbValue = $row['creation_date'];
        $this->gr_number->DbValue = $row['gr_number'];
        $this->gr_date->DbValue = $row['gr_date'];
        $this->delivery->DbValue = $row['delivery'];
        $this->store_id->DbValue = $row['store_id'];
        $this->store_name->DbValue = $row['store_name'];
        $this->article->DbValue = $row['article'];
        $this->size_code->DbValue = $row['size_code'];
        $this->size_desc->DbValue = $row['size_desc'];
        $this->color_code->DbValue = $row['color_code'];
        $this->color_desc->DbValue = $row['color_desc'];
        $this->concept->DbValue = $row['concept'];
        $this->target_qty->DbValue = $row['target_qty'];
        $this->picked_qty->DbValue = $row['picked_qty'];
        $this->variance_qty->DbValue = $row['variance_qty'];
        $this->confirmation_date->DbValue = $row['confirmation_date'];
        $this->confirmation_time->DbValue = $row['confirmation_time'];
        $this->box_code->DbValue = $row['box_code'];
        $this->box_type->DbValue = $row['box_type'];
        $this->picker->DbValue = $row['picker'];
        $this->status->DbValue = $row['status'];
        $this->remarks->DbValue = $row['remarks'];
        $this->aisle->DbValue = $row['aisle'];
        $this->area->DbValue = $row['area'];
        $this->aisle2->DbValue = $row['aisle2'];
        $this->store_id2->DbValue = $row['store_id2'];
        $this->scan_article->DbValue = $row['scan_article'];
        $this->close_totes->DbValue = $row['close_totes'];
        $this->job_id->DbValue = $row['job_id'];
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
        return $_SESSION[$name] ?? GetUrl("pickingpendinglist");
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
        if ($pageName == "pickingpendingview") {
            return $Language->phrase("View");
        } elseif ($pageName == "pickingpendingedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "pickingpendingadd") {
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
                return "PickingPendingView";
            case Config("API_ADD_ACTION"):
                return "PickingPendingAdd";
            case Config("API_EDIT_ACTION"):
                return "PickingPendingEdit";
            case Config("API_DELETE_ACTION"):
                return "PickingPendingDelete";
            case Config("API_LIST_ACTION"):
                return "PickingPendingList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "pickingpendinglist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("pickingpendingview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pickingpendingview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "pickingpendingadd?" . $this->getUrlParm($parm);
        } else {
            $url = "pickingpendingadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("pickingpendingedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("pickingpendingadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("pickingpendingdelete", $this->getUrlParm());
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
        $this->po_no->setDbValue($row['po_no']);
        $this->to_no->setDbValue($row['to_no']);
        $this->to_order_item->setDbValue($row['to_order_item']);
        $this->to_priority->setDbValue($row['to_priority']);
        $this->to_priority_code->setDbValue($row['to_priority_code']);
        $this->source_storage_type->setDbValue($row['source_storage_type']);
        $this->source_storage_bin->setDbValue($row['source_storage_bin']);
        $this->carton_number->setDbValue($row['carton_number']);
        $this->creation_date->setDbValue($row['creation_date']);
        $this->gr_number->setDbValue($row['gr_number']);
        $this->gr_date->setDbValue($row['gr_date']);
        $this->delivery->setDbValue($row['delivery']);
        $this->store_id->setDbValue($row['store_id']);
        $this->store_name->setDbValue($row['store_name']);
        $this->article->setDbValue($row['article']);
        $this->size_code->setDbValue($row['size_code']);
        $this->size_desc->setDbValue($row['size_desc']);
        $this->color_code->setDbValue($row['color_code']);
        $this->color_desc->setDbValue($row['color_desc']);
        $this->concept->setDbValue($row['concept']);
        $this->target_qty->setDbValue($row['target_qty']);
        $this->picked_qty->setDbValue($row['picked_qty']);
        $this->variance_qty->setDbValue($row['variance_qty']);
        $this->confirmation_date->setDbValue($row['confirmation_date']);
        $this->confirmation_time->setDbValue($row['confirmation_time']);
        $this->box_code->setDbValue($row['box_code']);
        $this->box_type->setDbValue($row['box_type']);
        $this->picker->setDbValue($row['picker']);
        $this->status->setDbValue($row['status']);
        $this->remarks->setDbValue($row['remarks']);
        $this->aisle->setDbValue($row['aisle']);
        $this->area->setDbValue($row['area']);
        $this->aisle2->setDbValue($row['aisle2']);
        $this->store_id2->setDbValue($row['store_id2']);
        $this->scan_article->setDbValue($row['scan_article']);
        $this->close_totes->setDbValue($row['close_totes']);
        $this->job_id->setDbValue($row['job_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // po_no

        // to_no

        // to_order_item

        // to_priority

        // to_priority_code

        // source_storage_type

        // source_storage_bin

        // carton_number

        // creation_date

        // gr_number

        // gr_date

        // delivery

        // store_id

        // store_name

        // article

        // size_code

        // size_desc

        // color_code

        // color_desc

        // concept

        // target_qty

        // picked_qty

        // variance_qty

        // confirmation_date

        // confirmation_time

        // box_code

        // box_type

        // picker

        // status

        // remarks

        // aisle

        // area

        // aisle2

        // store_id2

        // scan_article

        // close_totes

        // job_id

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // po_no
        $this->po_no->ViewValue = $this->po_no->CurrentValue;
        $this->po_no->ViewCustomAttributes = "";

        // to_no
        $this->to_no->ViewValue = $this->to_no->CurrentValue;
        $this->to_no->ViewCustomAttributes = "";

        // to_order_item
        $this->to_order_item->ViewValue = $this->to_order_item->CurrentValue;
        $this->to_order_item->ViewCustomAttributes = "";

        // to_priority
        $this->to_priority->ViewValue = $this->to_priority->CurrentValue;
        $this->to_priority->ViewCustomAttributes = "";

        // to_priority_code
        $this->to_priority_code->ViewValue = $this->to_priority_code->CurrentValue;
        $this->to_priority_code->ViewCustomAttributes = "";

        // source_storage_type
        $this->source_storage_type->ViewValue = $this->source_storage_type->CurrentValue;
        $this->source_storage_type->ViewCustomAttributes = "";

        // source_storage_bin
        $this->source_storage_bin->ViewValue = $this->source_storage_bin->CurrentValue;
        $this->source_storage_bin->ViewCustomAttributes = "";

        // carton_number
        $this->carton_number->ViewValue = $this->carton_number->CurrentValue;
        $this->carton_number->ViewCustomAttributes = "";

        // creation_date
        $this->creation_date->ViewValue = $this->creation_date->CurrentValue;
        $this->creation_date->ViewValue = FormatDateTime($this->creation_date->ViewValue, $this->creation_date->formatPattern());
        $this->creation_date->ViewCustomAttributes = "";

        // gr_number
        $this->gr_number->ViewValue = $this->gr_number->CurrentValue;
        $this->gr_number->ViewCustomAttributes = "";

        // gr_date
        $this->gr_date->ViewValue = $this->gr_date->CurrentValue;
        $this->gr_date->ViewValue = FormatDateTime($this->gr_date->ViewValue, $this->gr_date->formatPattern());
        $this->gr_date->ViewCustomAttributes = "";

        // delivery
        $this->delivery->ViewValue = $this->delivery->CurrentValue;
        $this->delivery->ViewCustomAttributes = "";

        // store_id
        $this->store_id->ViewValue = $this->store_id->CurrentValue;
        $this->store_id->ViewCustomAttributes = "";

        // store_name
        $this->store_name->ViewValue = $this->store_name->CurrentValue;
        $this->store_name->ViewCustomAttributes = "";

        // article
        $this->article->ViewValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

        // size_code
        $this->size_code->ViewValue = $this->size_code->CurrentValue;
        $this->size_code->ViewCustomAttributes = "";

        // size_desc
        $this->size_desc->ViewValue = $this->size_desc->CurrentValue;
        $this->size_desc->ViewCustomAttributes = "";

        // color_code
        $this->color_code->ViewValue = $this->color_code->CurrentValue;
        $this->color_code->ViewCustomAttributes = "";

        // color_desc
        $this->color_desc->ViewValue = $this->color_desc->CurrentValue;
        $this->color_desc->ViewCustomAttributes = "";

        // concept
        $this->concept->ViewValue = $this->concept->CurrentValue;
        $this->concept->ViewCustomAttributes = "";

        // target_qty
        $this->target_qty->ViewValue = $this->target_qty->CurrentValue;
        $this->target_qty->ViewValue = FormatNumber($this->target_qty->ViewValue, $this->target_qty->formatPattern());
        $this->target_qty->ViewCustomAttributes = "";

        // picked_qty
        $this->picked_qty->ViewValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->ViewValue = FormatNumber($this->picked_qty->ViewValue, $this->picked_qty->formatPattern());
        $this->picked_qty->ViewCustomAttributes = "";

        // variance_qty
        $this->variance_qty->ViewValue = $this->variance_qty->CurrentValue;
        $this->variance_qty->ViewValue = FormatNumber($this->variance_qty->ViewValue, $this->variance_qty->formatPattern());
        $this->variance_qty->ViewCustomAttributes = "";

        // confirmation_date
        $this->confirmation_date->ViewValue = $this->confirmation_date->CurrentValue;
        $this->confirmation_date->ViewValue = FormatDateTime($this->confirmation_date->ViewValue, $this->confirmation_date->formatPattern());
        $this->confirmation_date->ViewCustomAttributes = "";

        // confirmation_time
        $this->confirmation_time->ViewValue = $this->confirmation_time->CurrentValue;
        $this->confirmation_time->ViewValue = FormatDateTime($this->confirmation_time->ViewValue, $this->confirmation_time->formatPattern());
        $this->confirmation_time->ViewCustomAttributes = "";

        // box_code
        $this->box_code->ViewValue = $this->box_code->CurrentValue;
        $this->box_code->ViewCustomAttributes = "";

        // box_type
        if (strval($this->box_type->CurrentValue) != "") {
            $this->box_type->ViewValue = $this->box_type->optionCaption($this->box_type->CurrentValue);
        } else {
            $this->box_type->ViewValue = null;
        }
        $this->box_type->ViewCustomAttributes = "";

        // picker
        $this->picker->ViewValue = $this->picker->CurrentValue;
        $this->picker->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // remarks
        $this->remarks->ViewValue = $this->remarks->CurrentValue;
        $this->remarks->ViewCustomAttributes = "";

        // aisle
        $this->aisle->ViewValue = $this->aisle->CurrentValue;
        $this->aisle->ViewCustomAttributes = "";

        // area
        $this->area->ViewValue = $this->area->CurrentValue;
        $this->area->ViewCustomAttributes = "";

        // aisle2
        $this->aisle2->ViewValue = $this->aisle2->CurrentValue;
        $this->aisle2->ViewCustomAttributes = "";

        // store_id2
        $this->store_id2->ViewValue = $this->store_id2->CurrentValue;
        $this->store_id2->ViewCustomAttributes = "";

        // scan_article
        $this->scan_article->ViewValue = $this->scan_article->CurrentValue;
        $this->scan_article->ViewCustomAttributes = "";

        // close_totes
        $this->close_totes->ViewValue = $this->close_totes->CurrentValue;
        $this->close_totes->ViewCustomAttributes = "";

        // job_id
        $this->job_id->ViewValue = $this->job_id->CurrentValue;
        $this->job_id->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // po_no
        $this->po_no->LinkCustomAttributes = "";
        $this->po_no->HrefValue = "";
        $this->po_no->TooltipValue = "";

        // to_no
        $this->to_no->LinkCustomAttributes = "";
        $this->to_no->HrefValue = "";
        $this->to_no->TooltipValue = "";

        // to_order_item
        $this->to_order_item->LinkCustomAttributes = "";
        $this->to_order_item->HrefValue = "";
        $this->to_order_item->TooltipValue = "";

        // to_priority
        $this->to_priority->LinkCustomAttributes = "";
        $this->to_priority->HrefValue = "";
        $this->to_priority->TooltipValue = "";

        // to_priority_code
        $this->to_priority_code->LinkCustomAttributes = "";
        $this->to_priority_code->HrefValue = "";
        $this->to_priority_code->TooltipValue = "";

        // source_storage_type
        $this->source_storage_type->LinkCustomAttributes = "";
        $this->source_storage_type->HrefValue = "";
        $this->source_storage_type->TooltipValue = "";

        // source_storage_bin
        $this->source_storage_bin->LinkCustomAttributes = "";
        $this->source_storage_bin->HrefValue = "";
        $this->source_storage_bin->TooltipValue = "";

        // carton_number
        $this->carton_number->LinkCustomAttributes = "";
        $this->carton_number->HrefValue = "";
        $this->carton_number->TooltipValue = "";

        // creation_date
        $this->creation_date->LinkCustomAttributes = "";
        $this->creation_date->HrefValue = "";
        $this->creation_date->TooltipValue = "";

        // gr_number
        $this->gr_number->LinkCustomAttributes = "";
        $this->gr_number->HrefValue = "";
        $this->gr_number->TooltipValue = "";

        // gr_date
        $this->gr_date->LinkCustomAttributes = "";
        $this->gr_date->HrefValue = "";
        $this->gr_date->TooltipValue = "";

        // delivery
        $this->delivery->LinkCustomAttributes = "";
        $this->delivery->HrefValue = "";
        $this->delivery->TooltipValue = "";

        // store_id
        $this->store_id->LinkCustomAttributes = "";
        $this->store_id->HrefValue = "";
        $this->store_id->TooltipValue = "";

        // store_name
        $this->store_name->LinkCustomAttributes = "";
        $this->store_name->HrefValue = "";
        $this->store_name->TooltipValue = "";

        // article
        $this->article->LinkCustomAttributes = "";
        $this->article->HrefValue = "";
        $this->article->TooltipValue = "";

        // size_code
        $this->size_code->LinkCustomAttributes = "";
        $this->size_code->HrefValue = "";
        $this->size_code->TooltipValue = "";

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

        // concept
        $this->concept->LinkCustomAttributes = "";
        $this->concept->HrefValue = "";
        $this->concept->TooltipValue = "";

        // target_qty
        $this->target_qty->LinkCustomAttributes = "";
        $this->target_qty->HrefValue = "";
        $this->target_qty->TooltipValue = "";

        // picked_qty
        $this->picked_qty->LinkCustomAttributes = "";
        $this->picked_qty->HrefValue = "";
        $this->picked_qty->TooltipValue = "";

        // variance_qty
        $this->variance_qty->LinkCustomAttributes = "";
        $this->variance_qty->HrefValue = "";
        $this->variance_qty->TooltipValue = "";

        // confirmation_date
        $this->confirmation_date->LinkCustomAttributes = "";
        $this->confirmation_date->HrefValue = "";
        $this->confirmation_date->TooltipValue = "";

        // confirmation_time
        $this->confirmation_time->LinkCustomAttributes = "";
        $this->confirmation_time->HrefValue = "";
        $this->confirmation_time->TooltipValue = "";

        // box_code
        $this->box_code->LinkCustomAttributes = "";
        $this->box_code->HrefValue = "";
        $this->box_code->TooltipValue = "";

        // box_type
        $this->box_type->LinkCustomAttributes = "";
        $this->box_type->HrefValue = "";
        $this->box_type->TooltipValue = "";

        // picker
        $this->picker->LinkCustomAttributes = "";
        $this->picker->HrefValue = "";
        $this->picker->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // remarks
        $this->remarks->LinkCustomAttributes = "";
        $this->remarks->HrefValue = "";
        $this->remarks->TooltipValue = "";

        // aisle
        $this->aisle->LinkCustomAttributes = "";
        $this->aisle->HrefValue = "";
        $this->aisle->TooltipValue = "";

        // area
        $this->area->LinkCustomAttributes = "";
        $this->area->HrefValue = "";
        $this->area->TooltipValue = "";

        // aisle2
        $this->aisle2->LinkCustomAttributes = "";
        $this->aisle2->HrefValue = "";
        $this->aisle2->TooltipValue = "";

        // store_id2
        $this->store_id2->LinkCustomAttributes = "";
        $this->store_id2->HrefValue = "";
        $this->store_id2->TooltipValue = "";

        // scan_article
        $this->scan_article->LinkCustomAttributes = "";
        $this->scan_article->HrefValue = "";
        $this->scan_article->TooltipValue = "";

        // close_totes
        $this->close_totes->LinkCustomAttributes = "";
        $this->close_totes->HrefValue = "";
        $this->close_totes->TooltipValue = "";

        // job_id
        $this->job_id->LinkCustomAttributes = "";
        $this->job_id->HrefValue = "";
        $this->job_id->TooltipValue = "";

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

        // po_no
        $this->po_no->setupEditAttributes();
        $this->po_no->EditCustomAttributes = "";
        if (!$this->po_no->Raw) {
            $this->po_no->CurrentValue = HtmlDecode($this->po_no->CurrentValue);
        }
        $this->po_no->EditValue = $this->po_no->CurrentValue;
        $this->po_no->PlaceHolder = RemoveHtml($this->po_no->caption());

        // to_no
        $this->to_no->setupEditAttributes();
        $this->to_no->EditCustomAttributes = "";
        if (!$this->to_no->Raw) {
            $this->to_no->CurrentValue = HtmlDecode($this->to_no->CurrentValue);
        }
        $this->to_no->EditValue = $this->to_no->CurrentValue;
        $this->to_no->PlaceHolder = RemoveHtml($this->to_no->caption());

        // to_order_item
        $this->to_order_item->setupEditAttributes();
        $this->to_order_item->EditCustomAttributes = "";
        if (!$this->to_order_item->Raw) {
            $this->to_order_item->CurrentValue = HtmlDecode($this->to_order_item->CurrentValue);
        }
        $this->to_order_item->EditValue = $this->to_order_item->CurrentValue;
        $this->to_order_item->PlaceHolder = RemoveHtml($this->to_order_item->caption());

        // to_priority
        $this->to_priority->setupEditAttributes();
        $this->to_priority->EditCustomAttributes = "";
        if (!$this->to_priority->Raw) {
            $this->to_priority->CurrentValue = HtmlDecode($this->to_priority->CurrentValue);
        }
        $this->to_priority->EditValue = $this->to_priority->CurrentValue;
        $this->to_priority->PlaceHolder = RemoveHtml($this->to_priority->caption());

        // to_priority_code
        $this->to_priority_code->setupEditAttributes();
        $this->to_priority_code->EditCustomAttributes = "";
        if (!$this->to_priority_code->Raw) {
            $this->to_priority_code->CurrentValue = HtmlDecode($this->to_priority_code->CurrentValue);
        }
        $this->to_priority_code->EditValue = $this->to_priority_code->CurrentValue;
        $this->to_priority_code->PlaceHolder = RemoveHtml($this->to_priority_code->caption());

        // source_storage_type
        $this->source_storage_type->setupEditAttributes();
        $this->source_storage_type->EditCustomAttributes = "";
        if (!$this->source_storage_type->Raw) {
            $this->source_storage_type->CurrentValue = HtmlDecode($this->source_storage_type->CurrentValue);
        }
        $this->source_storage_type->EditValue = $this->source_storage_type->CurrentValue;
        $this->source_storage_type->PlaceHolder = RemoveHtml($this->source_storage_type->caption());

        // source_storage_bin
        $this->source_storage_bin->setupEditAttributes();
        $this->source_storage_bin->EditCustomAttributes = 'readonly';
        $this->source_storage_bin->EditValue = $this->source_storage_bin->CurrentValue;
        $this->source_storage_bin->ViewCustomAttributes = "";

        // carton_number
        $this->carton_number->setupEditAttributes();
        $this->carton_number->EditCustomAttributes = 'readonly';
        $this->carton_number->EditValue = $this->carton_number->CurrentValue;
        $this->carton_number->ViewCustomAttributes = "";

        // creation_date
        $this->creation_date->setupEditAttributes();
        $this->creation_date->EditCustomAttributes = "";
        $this->creation_date->EditValue = FormatDateTime($this->creation_date->CurrentValue, $this->creation_date->formatPattern());
        $this->creation_date->PlaceHolder = RemoveHtml($this->creation_date->caption());

        // gr_number
        $this->gr_number->setupEditAttributes();
        $this->gr_number->EditCustomAttributes = "";
        if (!$this->gr_number->Raw) {
            $this->gr_number->CurrentValue = HtmlDecode($this->gr_number->CurrentValue);
        }
        $this->gr_number->EditValue = $this->gr_number->CurrentValue;
        $this->gr_number->PlaceHolder = RemoveHtml($this->gr_number->caption());

        // gr_date
        $this->gr_date->setupEditAttributes();
        $this->gr_date->EditCustomAttributes = "";
        $this->gr_date->EditValue = FormatDateTime($this->gr_date->CurrentValue, $this->gr_date->formatPattern());
        $this->gr_date->PlaceHolder = RemoveHtml($this->gr_date->caption());

        // delivery
        $this->delivery->setupEditAttributes();
        $this->delivery->EditCustomAttributes = "";
        if (!$this->delivery->Raw) {
            $this->delivery->CurrentValue = HtmlDecode($this->delivery->CurrentValue);
        }
        $this->delivery->EditValue = $this->delivery->CurrentValue;
        $this->delivery->PlaceHolder = RemoveHtml($this->delivery->caption());

        // store_id
        $this->store_id->setupEditAttributes();
        $this->store_id->EditCustomAttributes = "";
        $this->store_id->EditValue = $this->store_id->CurrentValue;
        $this->store_id->ViewCustomAttributes = "";

        // store_name
        $this->store_name->setupEditAttributes();
        $this->store_name->EditCustomAttributes = "";
        $this->store_name->EditValue = $this->store_name->CurrentValue;
        $this->store_name->ViewCustomAttributes = "";

        // article
        $this->article->setupEditAttributes();
        $this->article->EditCustomAttributes = 'readonly';
        $this->article->EditValue = $this->article->CurrentValue;
        $this->article->ViewCustomAttributes = "";

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
        $this->size_desc->EditCustomAttributes = 'readonly';
        $this->size_desc->EditValue = $this->size_desc->CurrentValue;
        $this->size_desc->ViewCustomAttributes = "";

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
        $this->color_desc->EditValue = $this->color_desc->CurrentValue;
        $this->color_desc->ViewCustomAttributes = "";

        // concept
        $this->concept->setupEditAttributes();
        $this->concept->EditCustomAttributes = "";
        if (!$this->concept->Raw) {
            $this->concept->CurrentValue = HtmlDecode($this->concept->CurrentValue);
        }
        $this->concept->EditValue = $this->concept->CurrentValue;
        $this->concept->PlaceHolder = RemoveHtml($this->concept->caption());

        // target_qty
        $this->target_qty->setupEditAttributes();
        $this->target_qty->EditCustomAttributes = 'readonly';
        $this->target_qty->EditValue = $this->target_qty->CurrentValue;
        $this->target_qty->EditValue = FormatNumber($this->target_qty->EditValue, $this->target_qty->formatPattern());
        $this->target_qty->ViewCustomAttributes = "";

        // picked_qty
        $this->picked_qty->setupEditAttributes();
        $this->picked_qty->EditCustomAttributes = 'readonly';
        $this->picked_qty->EditValue = $this->picked_qty->CurrentValue;
        $this->picked_qty->PlaceHolder = RemoveHtml($this->picked_qty->caption());
        if (strval($this->picked_qty->EditValue) != "" && is_numeric($this->picked_qty->EditValue)) {
            $this->picked_qty->EditValue = FormatNumber($this->picked_qty->EditValue, null);
        }

        // variance_qty
        $this->variance_qty->setupEditAttributes();
        $this->variance_qty->EditCustomAttributes = 'readonly';
        $this->variance_qty->EditValue = $this->variance_qty->CurrentValue;
        $this->variance_qty->PlaceHolder = RemoveHtml($this->variance_qty->caption());
        if (strval($this->variance_qty->EditValue) != "" && is_numeric($this->variance_qty->EditValue)) {
            $this->variance_qty->EditValue = FormatNumber($this->variance_qty->EditValue, null);
        }

        // confirmation_date
        $this->confirmation_date->setupEditAttributes();
        $this->confirmation_date->EditCustomAttributes = "";
        $this->confirmation_date->EditValue = FormatDateTime($this->confirmation_date->CurrentValue, $this->confirmation_date->formatPattern());
        $this->confirmation_date->PlaceHolder = RemoveHtml($this->confirmation_date->caption());

        // confirmation_time
        $this->confirmation_time->setupEditAttributes();
        $this->confirmation_time->EditCustomAttributes = "";
        $this->confirmation_time->EditValue = FormatDateTime($this->confirmation_time->CurrentValue, $this->confirmation_time->formatPattern());
        $this->confirmation_time->PlaceHolder = RemoveHtml($this->confirmation_time->caption());

        // box_code
        $this->box_code->setupEditAttributes();
        $this->box_code->EditCustomAttributes = "";
        if (!$this->box_code->Raw) {
            $this->box_code->CurrentValue = HtmlDecode($this->box_code->CurrentValue);
        }
        $this->box_code->EditValue = $this->box_code->CurrentValue;
        $this->box_code->PlaceHolder = RemoveHtml($this->box_code->caption());

        // box_type
        $this->box_type->EditCustomAttributes = "";
        $this->box_type->EditValue = $this->box_type->options(false);
        $this->box_type->PlaceHolder = RemoveHtml($this->box_type->caption());

        // picker
        $this->picker->setupEditAttributes();
        $this->picker->EditCustomAttributes = "";
        if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("info")) { // Non system admin
            $this->picker->CurrentValue = CurrentUserID();
            $this->picker->EditValue = $this->picker->CurrentValue;
            $this->picker->ViewCustomAttributes = "";
        } else {
            if (!$this->picker->Raw) {
                $this->picker->CurrentValue = HtmlDecode($this->picker->CurrentValue);
            }
            $this->picker->EditValue = $this->picker->CurrentValue;
            $this->picker->PlaceHolder = RemoveHtml($this->picker->caption());
        }

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // remarks
        $this->remarks->setupEditAttributes();
        $this->remarks->EditCustomAttributes = "";
        if (!$this->remarks->Raw) {
            $this->remarks->CurrentValue = HtmlDecode($this->remarks->CurrentValue);
        }
        $this->remarks->EditValue = $this->remarks->CurrentValue;
        $this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

        // aisle
        $this->aisle->setupEditAttributes();
        $this->aisle->EditCustomAttributes = "";
        if (!$this->aisle->Raw) {
            $this->aisle->CurrentValue = HtmlDecode($this->aisle->CurrentValue);
        }
        $this->aisle->EditValue = $this->aisle->CurrentValue;
        $this->aisle->PlaceHolder = RemoveHtml($this->aisle->caption());

        // area
        $this->area->setupEditAttributes();
        $this->area->EditCustomAttributes = "";
        if (!$this->area->Raw) {
            $this->area->CurrentValue = HtmlDecode($this->area->CurrentValue);
        }
        $this->area->EditValue = $this->area->CurrentValue;
        $this->area->PlaceHolder = RemoveHtml($this->area->caption());

        // aisle2
        $this->aisle2->setupEditAttributes();
        $this->aisle2->EditCustomAttributes = "";
        if (!$this->aisle2->Raw) {
            $this->aisle2->CurrentValue = HtmlDecode($this->aisle2->CurrentValue);
        }
        $this->aisle2->EditValue = $this->aisle2->CurrentValue;
        $this->aisle2->PlaceHolder = RemoveHtml($this->aisle2->caption());

        // store_id2
        $this->store_id2->setupEditAttributes();
        $this->store_id2->EditCustomAttributes = "";
        if (!$this->store_id2->Raw) {
            $this->store_id2->CurrentValue = HtmlDecode($this->store_id2->CurrentValue);
        }
        $this->store_id2->EditValue = $this->store_id2->CurrentValue;
        $this->store_id2->PlaceHolder = RemoveHtml($this->store_id2->caption());

        // scan_article
        $this->scan_article->setupEditAttributes();
        $this->scan_article->EditCustomAttributes = "";
        if (!$this->scan_article->Raw) {
            $this->scan_article->CurrentValue = HtmlDecode($this->scan_article->CurrentValue);
        }
        $this->scan_article->EditValue = $this->scan_article->CurrentValue;
        $this->scan_article->PlaceHolder = RemoveHtml($this->scan_article->caption());

        // close_totes
        $this->close_totes->setupEditAttributes();
        $this->close_totes->EditCustomAttributes = "";
        if (!$this->close_totes->Raw) {
            $this->close_totes->CurrentValue = HtmlDecode($this->close_totes->CurrentValue);
        }
        $this->close_totes->EditValue = $this->close_totes->CurrentValue;
        $this->close_totes->PlaceHolder = RemoveHtml($this->close_totes->caption());

        // job_id
        $this->job_id->setupEditAttributes();
        $this->job_id->EditCustomAttributes = "";
        if (!$this->job_id->Raw) {
            $this->job_id->CurrentValue = HtmlDecode($this->job_id->CurrentValue);
        }
        $this->job_id->EditValue = $this->job_id->CurrentValue;
        $this->job_id->PlaceHolder = RemoveHtml($this->job_id->caption());

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
                    $doc->exportCaption($this->po_no);
                    $doc->exportCaption($this->to_no);
                    $doc->exportCaption($this->to_order_item);
                    $doc->exportCaption($this->to_priority);
                    $doc->exportCaption($this->to_priority_code);
                    $doc->exportCaption($this->source_storage_type);
                    $doc->exportCaption($this->source_storage_bin);
                    $doc->exportCaption($this->carton_number);
                    $doc->exportCaption($this->creation_date);
                    $doc->exportCaption($this->gr_number);
                    $doc->exportCaption($this->gr_date);
                    $doc->exportCaption($this->delivery);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->size_code);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->color_desc);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->target_qty);
                    $doc->exportCaption($this->picked_qty);
                    $doc->exportCaption($this->variance_qty);
                    $doc->exportCaption($this->confirmation_date);
                    $doc->exportCaption($this->confirmation_time);
                    $doc->exportCaption($this->box_code);
                    $doc->exportCaption($this->box_type);
                    $doc->exportCaption($this->picker);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->remarks);
                    $doc->exportCaption($this->aisle);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->aisle2);
                    $doc->exportCaption($this->store_id2);
                    $doc->exportCaption($this->scan_article);
                    $doc->exportCaption($this->close_totes);
                    $doc->exportCaption($this->job_id);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->po_no);
                    $doc->exportCaption($this->to_no);
                    $doc->exportCaption($this->to_order_item);
                    $doc->exportCaption($this->to_priority);
                    $doc->exportCaption($this->to_priority_code);
                    $doc->exportCaption($this->source_storage_type);
                    $doc->exportCaption($this->source_storage_bin);
                    $doc->exportCaption($this->carton_number);
                    $doc->exportCaption($this->creation_date);
                    $doc->exportCaption($this->gr_number);
                    $doc->exportCaption($this->gr_date);
                    $doc->exportCaption($this->delivery);
                    $doc->exportCaption($this->store_id);
                    $doc->exportCaption($this->store_name);
                    $doc->exportCaption($this->article);
                    $doc->exportCaption($this->size_code);
                    $doc->exportCaption($this->size_desc);
                    $doc->exportCaption($this->color_code);
                    $doc->exportCaption($this->color_desc);
                    $doc->exportCaption($this->concept);
                    $doc->exportCaption($this->target_qty);
                    $doc->exportCaption($this->picked_qty);
                    $doc->exportCaption($this->variance_qty);
                    $doc->exportCaption($this->confirmation_date);
                    $doc->exportCaption($this->confirmation_time);
                    $doc->exportCaption($this->box_code);
                    $doc->exportCaption($this->box_type);
                    $doc->exportCaption($this->picker);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->remarks);
                    $doc->exportCaption($this->aisle);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->aisle2);
                    $doc->exportCaption($this->store_id2);
                    $doc->exportCaption($this->close_totes);
                    $doc->exportCaption($this->job_id);
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
                        $doc->exportField($this->po_no);
                        $doc->exportField($this->to_no);
                        $doc->exportField($this->to_order_item);
                        $doc->exportField($this->to_priority);
                        $doc->exportField($this->to_priority_code);
                        $doc->exportField($this->source_storage_type);
                        $doc->exportField($this->source_storage_bin);
                        $doc->exportField($this->carton_number);
                        $doc->exportField($this->creation_date);
                        $doc->exportField($this->gr_number);
                        $doc->exportField($this->gr_date);
                        $doc->exportField($this->delivery);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->article);
                        $doc->exportField($this->size_code);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->color_desc);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->target_qty);
                        $doc->exportField($this->picked_qty);
                        $doc->exportField($this->variance_qty);
                        $doc->exportField($this->confirmation_date);
                        $doc->exportField($this->confirmation_time);
                        $doc->exportField($this->box_code);
                        $doc->exportField($this->box_type);
                        $doc->exportField($this->picker);
                        $doc->exportField($this->status);
                        $doc->exportField($this->remarks);
                        $doc->exportField($this->aisle);
                        $doc->exportField($this->area);
                        $doc->exportField($this->aisle2);
                        $doc->exportField($this->store_id2);
                        $doc->exportField($this->scan_article);
                        $doc->exportField($this->close_totes);
                        $doc->exportField($this->job_id);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->po_no);
                        $doc->exportField($this->to_no);
                        $doc->exportField($this->to_order_item);
                        $doc->exportField($this->to_priority);
                        $doc->exportField($this->to_priority_code);
                        $doc->exportField($this->source_storage_type);
                        $doc->exportField($this->source_storage_bin);
                        $doc->exportField($this->carton_number);
                        $doc->exportField($this->creation_date);
                        $doc->exportField($this->gr_number);
                        $doc->exportField($this->gr_date);
                        $doc->exportField($this->delivery);
                        $doc->exportField($this->store_id);
                        $doc->exportField($this->store_name);
                        $doc->exportField($this->article);
                        $doc->exportField($this->size_code);
                        $doc->exportField($this->size_desc);
                        $doc->exportField($this->color_code);
                        $doc->exportField($this->color_desc);
                        $doc->exportField($this->concept);
                        $doc->exportField($this->target_qty);
                        $doc->exportField($this->picked_qty);
                        $doc->exportField($this->variance_qty);
                        $doc->exportField($this->confirmation_date);
                        $doc->exportField($this->confirmation_time);
                        $doc->exportField($this->box_code);
                        $doc->exportField($this->box_type);
                        $doc->exportField($this->picker);
                        $doc->exportField($this->status);
                        $doc->exportField($this->remarks);
                        $doc->exportField($this->aisle);
                        $doc->exportField($this->area);
                        $doc->exportField($this->aisle2);
                        $doc->exportField($this->store_id2);
                        $doc->exportField($this->close_totes);
                        $doc->exportField($this->job_id);
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

    // Add User ID filter
    public function addUserIDFilter($filter = "", $id = "")
    {
        global $Security;
        $filterWrk = "";
        if ($id == "")
            $id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`picker` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM `picking_pending`";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCacheImpl($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
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
        AddFilter($filter, "picker = '".CurrentUserName()."'");
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
        $currentDate = CurrentDate();
        $currentTime = CurrentTime();
        $_id = $rsold["id"];
        $_status = "Done";
        $_shortpick = "M";
        $_user = CurrentUsername();
        $_status2 = "Pending";
        $status = $this->picked_qty->CurrentValue;
        //Compare
        $like = "%";
        $_picked = $this->picked_qty->CurrentValue;
        $_target = $this->target_qty->CurrentValue;
        $_variance = $this->variance_qty->CurrentValue;
        $_storecid = $this->store_id->CurrentValue;
        $_boxcode = $this->box_code->CurrentValue;
        $_boxtype = $this->box_type->CurrentValue;
        $_closetotes = $this->close_totes->CurrentValue;
        $_jobid = $this->job_id->CurrentValue;
        $hasil = $_picked - $_target;
        if($hasil !== 0 && $_closetotes == 1 ){    
        $sql3 = "UPDATE picking SET `confirmation_date` = '$currentDate',`confirmation_time` = '$currentTime',`status` = '$_status',`picker` = '$_user',`variance_qty` = '$_picked' - '$_target',`remarks` = '$_shortpick' WHERE `id` = '$_id' ";
        $_result3 = ExecuteStatement($sql3);
        $boxupdate3 = "UPDATE picking_pending SET `box_code` = '$_boxcode',`box_type` = '$_boxtype' WHERE `picker` = '$_user' AND `store_id` = '$_storecid' ORDER BY `to_no` LIMIT 1 ";
        $result3 = ExecuteStatement($boxupdate3);
        $this->setSuccessMessage("Confirmed");
        Log("No Close Totes 1");
        }
        if ($hasil !== 0 && $_closetotes == 2 ){
        	$sql4 = "UPDATE picking SET `confirmation_date` = '$currentDate',`confirmation_time` = '$currentTime',`status` = '$_status',`picker` = '$_user',`variance_qty` = '$_picked' - '$_target',`remarks` = '$_shortpick' WHERE `id` = '$_id' ";
        	$result4 = ExecuteStatement($sql4);
        	$qty = "SELECT SUM(`picked_qty`) FROM picking WHERE `box_code` = '$_boxcode'  ";
        	$_qty = ExecuteScalar($qty);
          $this -> setSuccessMessage("BOX CODE : ".$_boxcode. "Qty : ".$_qty);
        Log("Close Totes 1");
        	}
        if($hasil == 0 && $_closetotes == 1 ){    
        $sql6 = "UPDATE picking SET `confirmation_date` = '$currentDate',`confirmation_time` = '$currentTime',`status` = '$_status',`picker` = '$_user',`variance_qty` = '$_picked' - '$_target',`remarks` = Null  WHERE `id` = '$_id' ";
        $_result6 = ExecuteStatement($sql6);
        $boxupdate6 = "UPDATE picking_pending SET `box_code` = '$_boxcode',`box_type` = '$_boxtype' WHERE `picker` = '$_user' AND `store_id` = '$_storecid' ORDER BY `to_no` LIMIT 1 ";
        $result6 = ExecuteStatement($boxupdate6);
        $this->setSuccessMessage("Confirmed");
        Log("No Close Totes 2");
        }
        if ($hasil == 0 && $_closetotes == 2 ){
        	$sql7 = "UPDATE picking SET `confirmation_date` = '$currentDate',`confirmation_time` = '$currentTime',`status` = '$_status',`picker` = '$_user',`variance_qty` = '$_picked' - '$_target',`remarks` = Null  WHERE `id` = '$_id' ";
        	$result7 = ExecuteStatement($sql7);
        	$qty = "SELECT SUM(`picked_qty`) FROM picking WHERE `box_code` = '$_boxcode'  ";
        	$_qty = ExecuteScalar($qty);
        	$this->setSuccessMessage("BOX CODE : ".$_boxcode. "Qty : " .$_qty);
        	Log("Close Totes 2");
        	}
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

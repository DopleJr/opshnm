<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingPendingList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking_pending: currentTable } });
var currentForm, currentPageID;
var fpicking_pendinglist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpicking_pendinglist = new ew.Form("fpicking_pendinglist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpicking_pendinglist;
    fpicking_pendinglist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fpicking_pendinglist.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    fpicking_pendinglist.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    loadjs.done("fpicking_pendinglist");
});
var fpicking_pendingsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpicking_pendingsrch = new ew.Form("fpicking_pendingsrch", "list");
    currentSearchForm = fpicking_pendingsrch;

    // Add fields
    var fields = currentTable.fields;
    fpicking_pendingsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["po_no", [], fields.po_no.isInvalid],
        ["to_no", [], fields.to_no.isInvalid],
        ["to_order_item", [], fields.to_order_item.isInvalid],
        ["to_priority", [], fields.to_priority.isInvalid],
        ["to_priority_code", [], fields.to_priority_code.isInvalid],
        ["source_storage_type", [], fields.source_storage_type.isInvalid],
        ["source_storage_bin", [], fields.source_storage_bin.isInvalid],
        ["carton_number", [], fields.carton_number.isInvalid],
        ["creation_date", [], fields.creation_date.isInvalid],
        ["gr_number", [], fields.gr_number.isInvalid],
        ["gr_date", [], fields.gr_date.isInvalid],
        ["delivery", [], fields.delivery.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["size_code", [], fields.size_code.isInvalid],
        ["size_desc", [], fields.size_desc.isInvalid],
        ["color_code", [], fields.color_code.isInvalid],
        ["color_desc", [], fields.color_desc.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["target_qty", [], fields.target_qty.isInvalid],
        ["picked_qty", [], fields.picked_qty.isInvalid],
        ["variance_qty", [], fields.variance_qty.isInvalid],
        ["confirmation_date", [], fields.confirmation_date.isInvalid],
        ["confirmation_time", [], fields.confirmation_time.isInvalid],
        ["box_code", [], fields.box_code.isInvalid],
        ["box_type", [], fields.box_type.isInvalid],
        ["picker", [], fields.picker.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["remarks", [], fields.remarks.isInvalid],
        ["aisle", [], fields.aisle.isInvalid],
        ["area", [], fields.area.isInvalid],
        ["aisle2", [], fields.aisle2.isInvalid],
        ["store_id2", [], fields.store_id2.isInvalid],
        ["close_totes", [], fields.close_totes.isInvalid]
    ]);

    // Validate form
    fpicking_pendingsrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fpicking_pendingsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpicking_pendingsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpicking_pendingsrch.lists.picker = <?= $Page->picker->toClientList($Page) ?>;

    // Filters
    fpicking_pendingsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpicking_pendingsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fpicking_pendingsrch" id="fpicking_pendingsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpicking_pendingsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="picking_pending">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->picker->Visible) { // picker ?>
<?php
if (!$Page->picker->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picker" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picker->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picker"
            name="x_picker[]"
            class="form-control ew-select<?= $Page->picker->isInvalidClass() ?>"
            data-select2-id="fpicking_pendingsrch_x_picker"
            data-table="picking_pending"
            data-field="x_picker"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picker->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picker->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"
            <?= $Page->picker->editAttributes() ?>>
            <?= $Page->picker->selectOptionListHtml("x_picker", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picker->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpicking_pendingsrch", function() {
            var options = {
                name: "x_picker",
                selectId: "fpicking_pendingsrch_x_picker",
                ajax: { id: "x_picker", form: "fpicking_pendingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking_pending.fields.picker.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpicking_pendingsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpicking_pendingsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpicking_pendingsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpicking_pendingsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> picking_pending">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="fpicking_pendinglist" id="fpicking_pendinglist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking_pending">
<div id="gmp_picking_pending" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_picking_pendinglist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_picking_pending_id" class="picking_pending_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
        <th data-name="po_no" class="<?= $Page->po_no->headerCellClass() ?>"><div id="elh_picking_pending_po_no" class="picking_pending_po_no"><?= $Page->renderFieldHeader($Page->po_no) ?></div></th>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
        <th data-name="to_no" class="<?= $Page->to_no->headerCellClass() ?>"><div id="elh_picking_pending_to_no" class="picking_pending_to_no"><?= $Page->renderFieldHeader($Page->to_no) ?></div></th>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <th data-name="to_order_item" class="<?= $Page->to_order_item->headerCellClass() ?>"><div id="elh_picking_pending_to_order_item" class="picking_pending_to_order_item"><?= $Page->renderFieldHeader($Page->to_order_item) ?></div></th>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
        <th data-name="to_priority" class="<?= $Page->to_priority->headerCellClass() ?>"><div id="elh_picking_pending_to_priority" class="picking_pending_to_priority"><?= $Page->renderFieldHeader($Page->to_priority) ?></div></th>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <th data-name="to_priority_code" class="<?= $Page->to_priority_code->headerCellClass() ?>"><div id="elh_picking_pending_to_priority_code" class="picking_pending_to_priority_code"><?= $Page->renderFieldHeader($Page->to_priority_code) ?></div></th>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <th data-name="source_storage_type" class="<?= $Page->source_storage_type->headerCellClass() ?>"><div id="elh_picking_pending_source_storage_type" class="picking_pending_source_storage_type"><?= $Page->renderFieldHeader($Page->source_storage_type) ?></div></th>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <th data-name="source_storage_bin" class="<?= $Page->source_storage_bin->headerCellClass() ?>"><div id="elh_picking_pending_source_storage_bin" class="picking_pending_source_storage_bin"><?= $Page->renderFieldHeader($Page->source_storage_bin) ?></div></th>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
        <th data-name="carton_number" class="<?= $Page->carton_number->headerCellClass() ?>"><div id="elh_picking_pending_carton_number" class="picking_pending_carton_number"><?= $Page->renderFieldHeader($Page->carton_number) ?></div></th>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <th data-name="creation_date" class="<?= $Page->creation_date->headerCellClass() ?>"><div id="elh_picking_pending_creation_date" class="picking_pending_creation_date"><?= $Page->renderFieldHeader($Page->creation_date) ?></div></th>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
        <th data-name="gr_number" class="<?= $Page->gr_number->headerCellClass() ?>"><div id="elh_picking_pending_gr_number" class="picking_pending_gr_number"><?= $Page->renderFieldHeader($Page->gr_number) ?></div></th>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
        <th data-name="gr_date" class="<?= $Page->gr_date->headerCellClass() ?>"><div id="elh_picking_pending_gr_date" class="picking_pending_gr_date"><?= $Page->renderFieldHeader($Page->gr_date) ?></div></th>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
        <th data-name="delivery" class="<?= $Page->delivery->headerCellClass() ?>"><div id="elh_picking_pending_delivery" class="picking_pending_delivery"><?= $Page->renderFieldHeader($Page->delivery) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>"><div id="elh_picking_pending_store_id" class="picking_pending_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>"><div id="elh_picking_pending_store_name" class="picking_pending_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>"><div id="elh_picking_pending_article" class="picking_pending_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <th data-name="size_code" class="<?= $Page->size_code->headerCellClass() ?>"><div id="elh_picking_pending_size_code" class="picking_pending_size_code"><?= $Page->renderFieldHeader($Page->size_code) ?></div></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th data-name="size_desc" class="<?= $Page->size_desc->headerCellClass() ?>"><div id="elh_picking_pending_size_desc" class="picking_pending_size_desc"><?= $Page->renderFieldHeader($Page->size_desc) ?></div></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th data-name="color_code" class="<?= $Page->color_code->headerCellClass() ?>"><div id="elh_picking_pending_color_code" class="picking_pending_color_code"><?= $Page->renderFieldHeader($Page->color_code) ?></div></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th data-name="color_desc" class="<?= $Page->color_desc->headerCellClass() ?>"><div id="elh_picking_pending_color_desc" class="picking_pending_color_desc"><?= $Page->renderFieldHeader($Page->color_desc) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>"><div id="elh_picking_pending_concept" class="picking_pending_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
        <th data-name="target_qty" class="<?= $Page->target_qty->headerCellClass() ?>"><div id="elh_picking_pending_target_qty" class="picking_pending_target_qty"><?= $Page->renderFieldHeader($Page->target_qty) ?></div></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th data-name="picked_qty" class="<?= $Page->picked_qty->headerCellClass() ?>"><div id="elh_picking_pending_picked_qty" class="picking_pending_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div></th>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <th data-name="variance_qty" class="<?= $Page->variance_qty->headerCellClass() ?>"><div id="elh_picking_pending_variance_qty" class="picking_pending_variance_qty"><?= $Page->renderFieldHeader($Page->variance_qty) ?></div></th>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <th data-name="confirmation_date" class="<?= $Page->confirmation_date->headerCellClass() ?>"><div id="elh_picking_pending_confirmation_date" class="picking_pending_confirmation_date"><?= $Page->renderFieldHeader($Page->confirmation_date) ?></div></th>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <th data-name="confirmation_time" class="<?= $Page->confirmation_time->headerCellClass() ?>"><div id="elh_picking_pending_confirmation_time" class="picking_pending_confirmation_time"><?= $Page->renderFieldHeader($Page->confirmation_time) ?></div></th>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th data-name="box_code" class="<?= $Page->box_code->headerCellClass() ?>"><div id="elh_picking_pending_box_code" class="picking_pending_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div></th>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <th data-name="box_type" class="<?= $Page->box_type->headerCellClass() ?>"><div id="elh_picking_pending_box_type" class="picking_pending_box_type"><?= $Page->renderFieldHeader($Page->box_type) ?></div></th>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <th data-name="picker" class="<?= $Page->picker->headerCellClass() ?>"><div id="elh_picking_pending_picker" class="picking_pending_picker"><?= $Page->renderFieldHeader($Page->picker) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_picking_pending_status" class="picking_pending_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th data-name="remarks" class="<?= $Page->remarks->headerCellClass() ?>"><div id="elh_picking_pending_remarks" class="picking_pending_remarks"><?= $Page->renderFieldHeader($Page->remarks) ?></div></th>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th data-name="aisle" class="<?= $Page->aisle->headerCellClass() ?>"><div id="elh_picking_pending_aisle" class="picking_pending_aisle"><?= $Page->renderFieldHeader($Page->aisle) ?></div></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th data-name="area" class="<?= $Page->area->headerCellClass() ?>"><div id="elh_picking_pending_area" class="picking_pending_area"><?= $Page->renderFieldHeader($Page->area) ?></div></th>
<?php } ?>
<?php if ($Page->aisle2->Visible) { // aisle2 ?>
        <th data-name="aisle2" class="<?= $Page->aisle2->headerCellClass() ?>"><div id="elh_picking_pending_aisle2" class="picking_pending_aisle2"><?= $Page->renderFieldHeader($Page->aisle2) ?></div></th>
<?php } ?>
<?php if ($Page->store_id2->Visible) { // store_id2 ?>
        <th data-name="store_id2" class="<?= $Page->store_id2->headerCellClass() ?>"><div id="elh_picking_pending_store_id2" class="picking_pending_store_id2"><?= $Page->renderFieldHeader($Page->store_id2) ?></div></th>
<?php } ?>
<?php if ($Page->close_totes->Visible) { // close_totes ?>
        <th data-name="close_totes" class="<?= $Page->close_totes->headerCellClass() ?>"><div id="elh_picking_pending_close_totes" class="picking_pending_close_totes"><?= $Page->renderFieldHeader($Page->close_totes) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_picking_pending",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_id" class="el_picking_pending_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->po_no->Visible) { // po_no ?>
        <td data-name="po_no"<?= $Page->po_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_po_no" class="el_picking_pending_po_no">
<span<?= $Page->po_no->viewAttributes() ?>>
<?= $Page->po_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_no->Visible) { // to_no ?>
        <td data-name="to_no"<?= $Page->to_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_to_no" class="el_picking_pending_to_no">
<span<?= $Page->to_no->viewAttributes() ?>>
<?= $Page->to_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <td data-name="to_order_item"<?= $Page->to_order_item->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_to_order_item" class="el_picking_pending_to_order_item">
<span<?= $Page->to_order_item->viewAttributes() ?>>
<?= $Page->to_order_item->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_priority->Visible) { // to_priority ?>
        <td data-name="to_priority"<?= $Page->to_priority->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_to_priority" class="el_picking_pending_to_priority">
<span<?= $Page->to_priority->viewAttributes() ?>>
<?= $Page->to_priority->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <td data-name="to_priority_code"<?= $Page->to_priority_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_to_priority_code" class="el_picking_pending_to_priority_code">
<span<?= $Page->to_priority_code->viewAttributes() ?>>
<?= $Page->to_priority_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <td data-name="source_storage_type"<?= $Page->source_storage_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_source_storage_type" class="el_picking_pending_source_storage_type">
<span<?= $Page->source_storage_type->viewAttributes() ?>>
<?= $Page->source_storage_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <td data-name="source_storage_bin"<?= $Page->source_storage_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_source_storage_bin" class="el_picking_pending_source_storage_bin">
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<?= $Page->source_storage_bin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->carton_number->Visible) { // carton_number ?>
        <td data-name="carton_number"<?= $Page->carton_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_carton_number" class="el_picking_pending_carton_number">
<span<?= $Page->carton_number->viewAttributes() ?>>
<?= $Page->carton_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->creation_date->Visible) { // creation_date ?>
        <td data-name="creation_date"<?= $Page->creation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_creation_date" class="el_picking_pending_creation_date">
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gr_number->Visible) { // gr_number ?>
        <td data-name="gr_number"<?= $Page->gr_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_gr_number" class="el_picking_pending_gr_number">
<span<?= $Page->gr_number->viewAttributes() ?>>
<?= $Page->gr_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gr_date->Visible) { // gr_date ?>
        <td data-name="gr_date"<?= $Page->gr_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_gr_date" class="el_picking_pending_gr_date">
<span<?= $Page->gr_date->viewAttributes() ?>>
<?= $Page->gr_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delivery->Visible) { // delivery ?>
        <td data-name="delivery"<?= $Page->delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_delivery" class="el_picking_pending_delivery">
<span<?= $Page->delivery->viewAttributes() ?>>
<?= $Page->delivery->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_store_id" class="el_picking_pending_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_store_name" class="el_picking_pending_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_article" class="el_picking_pending_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_code->Visible) { // size_code ?>
        <td data-name="size_code"<?= $Page->size_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_size_code" class="el_picking_pending_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_size_desc" class="el_picking_pending_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_color_code" class="el_picking_pending_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_color_desc" class="el_picking_pending_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_concept" class="el_picking_pending_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->target_qty->Visible) { // target_qty ?>
        <td data-name="target_qty"<?= $Page->target_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_target_qty" class="el_picking_pending_target_qty">
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_picked_qty" class="el_picking_pending_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <td data-name="variance_qty"<?= $Page->variance_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_variance_qty" class="el_picking_pending_variance_qty">
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <td data-name="confirmation_date"<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_confirmation_date" class="el_picking_pending_confirmation_date">
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <td data-name="confirmation_time"<?= $Page->confirmation_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_confirmation_time" class="el_picking_pending_confirmation_time">
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_box_code" class="el_picking_pending_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_type->Visible) { // box_type ?>
        <td data-name="box_type"<?= $Page->box_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_box_type" class="el_picking_pending_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker"<?= $Page->picker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_picker" class="el_picking_pending_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_status" class="el_picking_pending_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remarks->Visible) { // remarks ?>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_remarks" class="el_picking_pending_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aisle->Visible) { // aisle ?>
        <td data-name="aisle"<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_aisle" class="el_picking_pending_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->area->Visible) { // area ?>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_area" class="el_picking_pending_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aisle2->Visible) { // aisle2 ?>
        <td data-name="aisle2"<?= $Page->aisle2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_aisle2" class="el_picking_pending_aisle2">
<span<?= $Page->aisle2->viewAttributes() ?>>
<?= $Page->aisle2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id2->Visible) { // store_id2 ?>
        <td data-name="store_id2"<?= $Page->store_id2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_store_id2" class="el_picking_pending_store_id2">
<span<?= $Page->store_id2->viewAttributes() ?>>
<?= $Page->store_id2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->close_totes->Visible) { // close_totes ?>
        <td data-name="close_totes"<?= $Page->close_totes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_pending_close_totes" class="el_picking_pending_close_totes">
<span<?= $Page->close_totes->viewAttributes() ?>>
<?= $Page->close_totes->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("picking_pending");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

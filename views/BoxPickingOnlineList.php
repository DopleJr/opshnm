<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BoxPickingOnlineList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { box_picking_online: currentTable } });
var currentForm, currentPageID;
var fbox_picking_onlinelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbox_picking_onlinelist = new ew.Form("fbox_picking_onlinelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fbox_picking_onlinelist;
    fbox_picking_onlinelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fbox_picking_onlinelist");
});
var fbox_picking_onlinesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fbox_picking_onlinesrch = new ew.Form("fbox_picking_onlinesrch", "list");
    currentSearchForm = fbox_picking_onlinesrch;

    // Dynamic selection lists

    // Filters
    fbox_picking_onlinesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbox_picking_onlinesrch");
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
<form name="fbox_picking_onlinesrch" id="fbox_picking_onlinesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbox_picking_onlinesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="box_picking_online">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbox_picking_onlinesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbox_picking_onlinesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbox_picking_onlinesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbox_picking_onlinesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> box_picking_online">
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
<form name="fbox_picking_onlinelist" id="fbox_picking_onlinelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_picking_online">
<div id="gmp_box_picking_online" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_box_picking_onlinelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_id" class="box_picking_online_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th data-name="box_id" class="<?= $Page->box_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_box_id" class="box_picking_online_box_id"><?= $Page->renderFieldHeader($Page->box_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th data-name="store_code" class="<?= $Page->store_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_store_code" class="box_picking_online_store_code"><?= $Page->renderFieldHeader($Page->store_code) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_store_name" class="box_picking_online_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_type" class="box_picking_online_type"><?= $Page->renderFieldHeader($Page->type) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_concept" class="box_picking_online_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th data-name="picked_qty" class="<?= $Page->picked_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_picked_qty" class="box_picking_online_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div></th>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
        <th data-name="scan_qty" class="<?= $Page->scan_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_scan_qty" class="box_picking_online_scan_qty"><?= $Page->renderFieldHeader($Page->scan_qty) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_status" class="box_picking_online_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th data-name="users" class="<?= $Page->users->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_users" class="box_picking_online_users"><?= $Page->renderFieldHeader($Page->users) ?></div></th>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <th data-name="picking_date" class="<?= $Page->picking_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_picking_date" class="box_picking_online_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></div></th>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
        <th data-name="line" class="<?= $Page->line->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_line" class="box_picking_online_line"><?= $Page->renderFieldHeader($Page->line) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_date_created" class="box_picking_online_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <th data-name="date_delivery" class="<?= $Page->date_delivery->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_date_delivery" class="box_picking_online_date_delivery"><?= $Page->renderFieldHeader($Page->date_delivery) ?></div></th>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
        <th data-name="date_staging" class="<?= $Page->date_staging->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_date_staging" class="box_picking_online_date_staging"><?= $Page->renderFieldHeader($Page->date_staging) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_online_date_updated" class="box_picking_online_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_box_picking_online",
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
<span id="el<?= $Page->RowCount ?>_box_picking_online_id" class="el_box_picking_online_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_id->Visible) { // box_id ?>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_box_id" class="el_box_picking_online_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_code->Visible) { // store_code ?>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_store_code" class="el_box_picking_online_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_store_name" class="el_box_picking_online_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_type" class="el_box_picking_online_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_concept" class="el_box_picking_online_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_picked_qty" class="el_box_picking_online_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->scan_qty->Visible) { // scan_qty ?>
        <td data-name="scan_qty"<?= $Page->scan_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_scan_qty" class="el_box_picking_online_scan_qty">
<span<?= $Page->scan_qty->viewAttributes() ?>>
<?= $Page->scan_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_status" class="el_box_picking_online_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->users->Visible) { // users ?>
        <td data-name="users"<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_users" class="el_box_picking_online_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td data-name="picking_date"<?= $Page->picking_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_picking_date" class="el_box_picking_online_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->line->Visible) { // line ?>
        <td data-name="line"<?= $Page->line->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_line" class="el_box_picking_online_line">
<span<?= $Page->line->viewAttributes() ?>>
<?= $Page->line->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_created" class="el_box_picking_online_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <td data-name="date_delivery"<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_delivery" class="el_box_picking_online_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_staging->Visible) { // date_staging ?>
        <td data-name="date_staging"<?= $Page->date_staging->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_staging" class="el_box_picking_online_date_staging">
<span<?= $Page->date_staging->viewAttributes() ?>>
<?= $Page->date_staging->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_updated" class="el_box_picking_online_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
    ew.addEventHandlers("box_picking_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

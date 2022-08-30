<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OssManualList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { oss_manual: currentTable } });
var currentForm, currentPageID;
var foss_manuallist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    foss_manuallist = new ew.Form("foss_manuallist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = foss_manuallist;
    foss_manuallist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("foss_manuallist");
});
var foss_manualsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    foss_manualsrch = new ew.Form("foss_manualsrch", "list");
    currentSearchForm = foss_manualsrch;

    // Dynamic selection lists

    // Filters
    foss_manualsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("foss_manualsrch");
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
<form name="foss_manualsrch" id="foss_manualsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="foss_manualsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="oss_manual">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> oss_manual">
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
<form name="foss_manuallist" id="foss_manuallist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="oss_manual">
<div id="gmp_oss_manual" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_oss_manuallist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_id" class="oss_manual_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_date" class="oss_manual_date"><?= $Page->renderFieldHeader($Page->date) ?></div></th>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <th data-name="shipment" class="<?= $Page->shipment->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_shipment" class="oss_manual_shipment"><?= $Page->renderFieldHeader($Page->shipment) ?></div></th>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <th data-name="pallet_no" class="<?= $Page->pallet_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_pallet_no" class="oss_manual_pallet_no"><?= $Page->renderFieldHeader($Page->pallet_no) ?></div></th>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
        <th data-name="sscc" class="<?= $Page->sscc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_sscc" class="oss_manual_sscc"><?= $Page->renderFieldHeader($Page->sscc) ?></div></th>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
        <th data-name="idw" class="<?= $Page->idw->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_idw" class="oss_manual_idw"><?= $Page->renderFieldHeader($Page->idw) ?></div></th>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
        <th data-name="order_no" class="<?= $Page->order_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_order_no" class="oss_manual_order_no"><?= $Page->renderFieldHeader($Page->order_no) ?></div></th>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <th data-name="item_in_ctn" class="<?= $Page->item_in_ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_item_in_ctn" class="oss_manual_item_in_ctn"><?= $Page->renderFieldHeader($Page->item_in_ctn) ?></div></th>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <th data-name="no_of_ctn" class="<?= $Page->no_of_ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_no_of_ctn" class="oss_manual_no_of_ctn"><?= $Page->renderFieldHeader($Page->no_of_ctn) ?></div></th>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <th data-name="ctn_no" class="<?= $Page->ctn_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_ctn_no" class="oss_manual_ctn_no"><?= $Page->renderFieldHeader($Page->ctn_no) ?></div></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th data-name="checker" class="<?= $Page->checker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_checker" class="oss_manual_checker"><?= $Page->renderFieldHeader($Page->checker) ?></div></th>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
        <th data-name="shift" class="<?= $Page->shift->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_shift" class="oss_manual_shift"><?= $Page->renderFieldHeader($Page->shift) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_oss_manual",
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
<span id="el<?= $Page->RowCount ?>_oss_manual_id" class="el_oss_manual_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date" class="el_oss_manual_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shipment->Visible) { // shipment ?>
        <td data-name="shipment"<?= $Page->shipment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_shipment" class="el_oss_manual_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <td data-name="pallet_no"<?= $Page->pallet_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_pallet_no" class="el_oss_manual_pallet_no">
<span<?= $Page->pallet_no->viewAttributes() ?>>
<?= $Page->pallet_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sscc->Visible) { // sscc ?>
        <td data-name="sscc"<?= $Page->sscc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_sscc" class="el_oss_manual_sscc">
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idw->Visible) { // idw ?>
        <td data-name="idw"<?= $Page->idw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_idw" class="el_oss_manual_idw">
<span<?= $Page->idw->viewAttributes() ?>>
<?= $Page->idw->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order_no->Visible) { // order_no ?>
        <td data-name="order_no"<?= $Page->order_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_order_no" class="el_oss_manual_order_no">
<span<?= $Page->order_no->viewAttributes() ?>>
<?= $Page->order_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <td data-name="item_in_ctn"<?= $Page->item_in_ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_item_in_ctn" class="el_oss_manual_item_in_ctn">
<span<?= $Page->item_in_ctn->viewAttributes() ?>>
<?= $Page->item_in_ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <td data-name="no_of_ctn"<?= $Page->no_of_ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_no_of_ctn" class="el_oss_manual_no_of_ctn">
<span<?= $Page->no_of_ctn->viewAttributes() ?>>
<?= $Page->no_of_ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <td data-name="ctn_no"<?= $Page->ctn_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_ctn_no" class="el_oss_manual_ctn_no">
<span<?= $Page->ctn_no->viewAttributes() ?>>
<?= $Page->ctn_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->checker->Visible) { // checker ?>
        <td data-name="checker"<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_checker" class="el_oss_manual_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shift->Visible) { // shift ?>
        <td data-name="shift"<?= $Page->shift->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_shift" class="el_oss_manual_shift">
<span<?= $Page->shift->viewAttributes() ?>>
<?= $Page->shift->getViewValue() ?></span>
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
    ew.addEventHandlers("oss_manual");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php
namespace PHPMaker2022\opsmezzanineupload;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
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
<form name="foss_manuallist" id="foss_manuallist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
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
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_date" class="oss_manual_date"><?= $Page->renderFieldHeader($Page->date) ?></div></th>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
        <th data-name="sscc" class="<?= $Page->sscc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_sscc" class="oss_manual_sscc"><?= $Page->renderFieldHeader($Page->sscc) ?></div></th>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <th data-name="shipment" class="<?= $Page->shipment->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_shipment" class="oss_manual_shipment"><?= $Page->renderFieldHeader($Page->shipment) ?></div></th>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <th data-name="pallet_no" class="<?= $Page->pallet_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_pallet_no" class="oss_manual_pallet_no"><?= $Page->renderFieldHeader($Page->pallet_no) ?></div></th>
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
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_date_updated" class="oss_manual_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <th data-name="time_updated" class="<?= $Page->time_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_time_updated" class="oss_manual_time_updated"><?= $Page->renderFieldHeader($Page->time_updated) ?></div></th>
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
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date" class="el_oss_manual_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
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
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date_updated" class="el_oss_manual_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_updated->Visible) { // time_updated ?>
        <td data-name="time_updated"<?= $Page->time_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_time_updated" class="el_oss_manual_time_updated">
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
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
</div><!-- /.ew-multi-column-grid -->

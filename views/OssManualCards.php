<?php
namespace PHPMaker2022\opsmezzanineupload;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<?php if (!$Page->isExport()) { ?>
<div>
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
<div class="<?= $Page->getMultiColumnRowClass() ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
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
<div class="<?= $Page->getMultiColumnColClass() ?>" <?= $Page->rowAttributes() ?>>
<div class="<?= $Page->MultiColumnCardClass ?>">
    <?php if (StartsText("top", $Page->MultiColumnListOptionsPosition)) { ?>
    <div class="card-header">
        <div class="ew-multi-column-list-option ew-<?= $Page->MultiColumnListOptionsPosition ?>">
<?php
// Render list options (body, bottom)
$Page->ListOptions->Tag = "div";
$Page->ListOptions->render("body", $Page->MultiColumnListOptionsPosition, $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
    </div>
    <?php } ?>
    <div class="card-body">
    <?php if ($Page->date->Visible) { // date ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_date">
            <div class="col col-sm-4 oss_manual_date" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->date) ?></div>
            <div class="col col-sm-8"><div<?= $Page->date->cellAttributes() ?>>
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_date">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->sscc->Visible) { // sscc ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_sscc">
            <div class="col col-sm-4 oss_manual_sscc" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->sscc) ?></div>
            <div class="col col-sm-8"><div<?= $Page->sscc->cellAttributes() ?>>
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_sscc">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->sscc->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sscc->cellAttributes() ?>>
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->shipment->Visible) { // shipment ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_shipment">
            <div class="col col-sm-4 oss_manual_shipment" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->shipment) ?></div>
            <div class="col col-sm-8"><div<?= $Page->shipment->cellAttributes() ?>>
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_shipment">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->shipment->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipment->cellAttributes() ?>>
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_pallet_no">
            <div class="col col-sm-4 oss_manual_pallet_no" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->pallet_no) ?></div>
            <div class="col col-sm-8"><div<?= $Page->pallet_no->cellAttributes() ?>>
<span<?= $Page->pallet_no->viewAttributes() ?>>
<?= $Page->pallet_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_pallet_no">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->pallet_no->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pallet_no->cellAttributes() ?>>
<span<?= $Page->pallet_no->viewAttributes() ?>>
<?= $Page->pallet_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->idw->Visible) { // idw ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_idw">
            <div class="col col-sm-4 oss_manual_idw" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->idw) ?></div>
            <div class="col col-sm-8"><div<?= $Page->idw->cellAttributes() ?>>
<span<?= $Page->idw->viewAttributes() ?>>
<?= $Page->idw->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_idw">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->idw->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idw->cellAttributes() ?>>
<span<?= $Page->idw->viewAttributes() ?>>
<?= $Page->idw->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->order_no->Visible) { // order_no ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_order_no">
            <div class="col col-sm-4 oss_manual_order_no" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->order_no) ?></div>
            <div class="col col-sm-8"><div<?= $Page->order_no->cellAttributes() ?>>
<span<?= $Page->order_no->viewAttributes() ?>>
<?= $Page->order_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_order_no">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_no->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_no->cellAttributes() ?>>
<span<?= $Page->order_no->viewAttributes() ?>>
<?= $Page->order_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_item_in_ctn">
            <div class="col col-sm-4 oss_manual_item_in_ctn" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->item_in_ctn) ?></div>
            <div class="col col-sm-8"><div<?= $Page->item_in_ctn->cellAttributes() ?>>
<span<?= $Page->item_in_ctn->viewAttributes() ?>>
<?= $Page->item_in_ctn->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_item_in_ctn">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_in_ctn->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_in_ctn->cellAttributes() ?>>
<span<?= $Page->item_in_ctn->viewAttributes() ?>>
<?= $Page->item_in_ctn->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_no_of_ctn">
            <div class="col col-sm-4 oss_manual_no_of_ctn" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->no_of_ctn) ?></div>
            <div class="col col-sm-8"><div<?= $Page->no_of_ctn->cellAttributes() ?>>
<span<?= $Page->no_of_ctn->viewAttributes() ?>>
<?= $Page->no_of_ctn->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_no_of_ctn">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_of_ctn->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_of_ctn->cellAttributes() ?>>
<span<?= $Page->no_of_ctn->viewAttributes() ?>>
<?= $Page->no_of_ctn->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_ctn_no">
            <div class="col col-sm-4 oss_manual_ctn_no" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->ctn_no) ?></div>
            <div class="col col-sm-8"><div<?= $Page->ctn_no->cellAttributes() ?>>
<span<?= $Page->ctn_no->viewAttributes() ?>>
<?= $Page->ctn_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_ctn_no">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn_no->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn_no->cellAttributes() ?>>
<span<?= $Page->ctn_no->viewAttributes() ?>>
<?= $Page->ctn_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->checker->Visible) { // checker ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_checker">
            <div class="col col-sm-4 oss_manual_checker" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->checker) ?></div>
            <div class="col col-sm-8"><div<?= $Page->checker->cellAttributes() ?>>
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_checker">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->checker->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->checker->cellAttributes() ?>>
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->shift->Visible) { // shift ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_shift">
            <div class="col col-sm-4 oss_manual_shift" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->shift) ?></div>
            <div class="col col-sm-8"><div<?= $Page->shift->cellAttributes() ?>>
<span<?= $Page->shift->viewAttributes() ?>>
<?= $Page->shift->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_shift">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->shift->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shift->cellAttributes() ?>>
<span<?= $Page->shift->viewAttributes() ?>>
<?= $Page->shift->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_status">
            <div class="col col-sm-4 oss_manual_status" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->status) ?></div>
            <div class="col col-sm-8"><div<?= $Page->status->cellAttributes() ?>>
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_status">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_date_updated">
            <div class="col col-sm-4 oss_manual_date_updated" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->date_updated) ?></div>
            <div class="col col-sm-8"><div<?= $Page->date_updated->cellAttributes() ?>>
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_date_updated">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->time_updated->Visible) { // time_updated ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row oss_manual_time_updated">
            <div class="col col-sm-4 oss_manual_time_updated" style="white-space: nowrap;"><?= $Page->renderFieldHeader($Page->time_updated) ?></div>
            <div class="col col-sm-8"><div<?= $Page->time_updated->cellAttributes() ?>>
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row oss_manual_time_updated">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_updated->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_updated->cellAttributes() ?>>
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    </div><!-- /.card-body -->
<?php if (!$Page->isExport()) { ?>
    <?php if (StartsText("bottom", $Page->MultiColumnListOptionsPosition)) { ?>
    <div class="card-footer">
        <div class="ew-multi-column-list-option ew-<?= $Page->MultiColumnListOptionsPosition ?>">
<?php
// Render list options (body, bottom)
$Page->ListOptions->Tag = "div";
$Page->ListOptions->render("body", $Page->MultiColumnListOptionsPosition, $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
    </div><!-- /.card-footer -->
    <?php } ?>
<?php } ?>
</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
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
</div><!-- /.ew-multi-column-grid -->

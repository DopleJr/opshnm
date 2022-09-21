<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OssManualDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { oss_manual: currentTable } });
var currentForm, currentPageID;
var foss_manualdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    foss_manualdelete = new ew.Form("foss_manualdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = foss_manualdelete;
    loadjs.done("foss_manualdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="foss_manualdelete" id="foss_manualdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="oss_manual">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_oss_manual_date" class="oss_manual_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
        <th class="<?= $Page->sscc->headerCellClass() ?>"><span id="elh_oss_manual_sscc" class="oss_manual_sscc"><?= $Page->sscc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <th class="<?= $Page->shipment->headerCellClass() ?>"><span id="elh_oss_manual_shipment" class="oss_manual_shipment"><?= $Page->shipment->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <th class="<?= $Page->pallet_no->headerCellClass() ?>"><span id="elh_oss_manual_pallet_no" class="oss_manual_pallet_no"><?= $Page->pallet_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
        <th class="<?= $Page->idw->headerCellClass() ?>"><span id="elh_oss_manual_idw" class="oss_manual_idw"><?= $Page->idw->caption() ?></span></th>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
        <th class="<?= $Page->order_no->headerCellClass() ?>"><span id="elh_oss_manual_order_no" class="oss_manual_order_no"><?= $Page->order_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <th class="<?= $Page->item_in_ctn->headerCellClass() ?>"><span id="elh_oss_manual_item_in_ctn" class="oss_manual_item_in_ctn"><?= $Page->item_in_ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <th class="<?= $Page->no_of_ctn->headerCellClass() ?>"><span id="elh_oss_manual_no_of_ctn" class="oss_manual_no_of_ctn"><?= $Page->no_of_ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <th class="<?= $Page->ctn_no->headerCellClass() ?>"><span id="elh_oss_manual_ctn_no" class="oss_manual_ctn_no"><?= $Page->ctn_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th class="<?= $Page->checker->headerCellClass() ?>"><span id="elh_oss_manual_checker" class="oss_manual_checker"><?= $Page->checker->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
        <th class="<?= $Page->shift->headerCellClass() ?>"><span id="elh_oss_manual_shift" class="oss_manual_shift"><?= $Page->shift->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_oss_manual_status" class="oss_manual_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_oss_manual_date_updated" class="oss_manual_date_updated"><?= $Page->date_updated->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <th class="<?= $Page->time_updated->headerCellClass() ?>"><span id="elh_oss_manual_time_updated" class="oss_manual_time_updated"><?= $Page->time_updated->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->date->Visible) { // date ?>
        <td<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date" class="el_oss_manual_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
        <td<?= $Page->sscc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_sscc" class="el_oss_manual_sscc">
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <td<?= $Page->shipment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_shipment" class="el_oss_manual_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <td<?= $Page->pallet_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_pallet_no" class="el_oss_manual_pallet_no">
<span<?= $Page->pallet_no->viewAttributes() ?>>
<?= $Page->pallet_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
        <td<?= $Page->idw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_idw" class="el_oss_manual_idw">
<span<?= $Page->idw->viewAttributes() ?>>
<?= $Page->idw->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
        <td<?= $Page->order_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_order_no" class="el_oss_manual_order_no">
<span<?= $Page->order_no->viewAttributes() ?>>
<?= $Page->order_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <td<?= $Page->item_in_ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_item_in_ctn" class="el_oss_manual_item_in_ctn">
<span<?= $Page->item_in_ctn->viewAttributes() ?>>
<?= $Page->item_in_ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <td<?= $Page->no_of_ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_no_of_ctn" class="el_oss_manual_no_of_ctn">
<span<?= $Page->no_of_ctn->viewAttributes() ?>>
<?= $Page->no_of_ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <td<?= $Page->ctn_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_ctn_no" class="el_oss_manual_ctn_no">
<span<?= $Page->ctn_no->viewAttributes() ?>>
<?= $Page->ctn_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <td<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_checker" class="el_oss_manual_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
        <td<?= $Page->shift->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_shift" class="el_oss_manual_shift">
<span<?= $Page->shift->viewAttributes() ?>>
<?= $Page->shift->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_status" class="el_oss_manual_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date_updated" class="el_oss_manual_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <td<?= $Page->time_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_time_updated" class="el_oss_manual_time_updated">
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>

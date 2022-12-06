<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$VasValidationDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vas_validation: currentTable } });
var currentForm, currentPageID;
var fvas_validationdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvas_validationdelete = new ew.Form("fvas_validationdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fvas_validationdelete;
    loadjs.done("fvas_validationdelete");
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
<form name="fvas_validationdelete" id="fvas_validationdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vas_validation">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_vas_validation_id" class="vas_validation_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
        <th class="<?= $Page->order->headerCellClass() ?>"><span id="elh_vas_validation_order" class="vas_validation_order"><?= $Page->order->caption() ?></span></th>
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
        <th class="<?= $Page->po->headerCellClass() ?>"><span id="elh_vas_validation_po" class="vas_validation_po"><?= $Page->po->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
        <th class="<?= $Page->sap_art->headerCellClass() ?>"><span id="elh_vas_validation_sap_art" class="vas_validation_sap_art"><?= $Page->sap_art->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
        <th class="<?= $Page->sub_index->headerCellClass() ?>"><span id="elh_vas_validation_sub_index" class="vas_validation_sub_index"><?= $Page->sub_index->caption() ?></span></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th class="<?= $Page->concept->headerCellClass() ?>"><span id="elh_vas_validation_concept" class="vas_validation_concept"><?= $Page->concept->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th class="<?= $Page->ctn->headerCellClass() ?>"><span id="elh_vas_validation_ctn" class="vas_validation_ctn"><?= $Page->ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
        <th class="<?= $Page->season2->headerCellClass() ?>"><span id="elh_vas_validation_season2" class="vas_validation_season2"><?= $Page->season2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
        <th class="<?= $Page->qty_oss->headerCellClass() ?>"><span id="elh_vas_validation_qty_oss" class="vas_validation_qty_oss"><?= $Page->qty_oss->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <th class="<?= $Page->shipment->headerCellClass() ?>"><span id="elh_vas_validation_shipment" class="vas_validation_shipment"><?= $Page->shipment->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
        <th class="<?= $Page->aju->headerCellClass() ?>"><span id="elh_vas_validation_aju" class="vas_validation_aju"><?= $Page->aju->caption() ?></span></th>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
        <th class="<?= $Page->actual_price->headerCellClass() ?>"><span id="elh_vas_validation_actual_price" class="vas_validation_actual_price"><?= $Page->actual_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
        <th class="<?= $Page->price_foto->headerCellClass() ?>"><span id="elh_vas_validation_price_foto" class="vas_validation_price_foto"><?= $Page->price_foto->caption() ?></span></th>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
        <th class="<?= $Page->snow->headerCellClass() ?>"><span id="elh_vas_validation_snow" class="vas_validation_snow"><?= $Page->snow->caption() ?></span></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th class="<?= $Page->remarks->headerCellClass() ?>"><span id="elh_vas_validation_remarks" class="vas_validation_remarks"><?= $Page->remarks->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th class="<?= $Page->date_upload->headerCellClass() ?>"><span id="elh_vas_validation_date_upload" class="vas_validation_date_upload"><?= $Page->date_upload->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_vas_validation_user" class="vas_validation_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_vas_validation_status" class="vas_validation_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th class="<?= $Page->date_update->headerCellClass() ?>"><span id="elh_vas_validation_date_update" class="vas_validation_date_update"><?= $Page->date_update->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th class="<?= $Page->time_update->headerCellClass() ?>"><span id="elh_vas_validation_time_update" class="vas_validation_time_update"><?= $Page->time_update->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_id" class="el_vas_validation_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
        <td<?= $Page->order->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_order" class="el_vas_validation_order">
<span<?= $Page->order->viewAttributes() ?>>
<?= $Page->order->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
        <td<?= $Page->po->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_po" class="el_vas_validation_po">
<span<?= $Page->po->viewAttributes() ?>>
<?= $Page->po->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
        <td<?= $Page->sap_art->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_sap_art" class="el_vas_validation_sap_art">
<span<?= $Page->sap_art->viewAttributes() ?>>
<?= $Page->sap_art->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
        <td<?= $Page->sub_index->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_sub_index" class="el_vas_validation_sub_index">
<span<?= $Page->sub_index->viewAttributes() ?>>
<?= $Page->sub_index->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <td<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_concept" class="el_vas_validation_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <td<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_ctn" class="el_vas_validation_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
        <td<?= $Page->season2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_season2" class="el_vas_validation_season2">
<span<?= $Page->season2->viewAttributes() ?>>
<?= $Page->season2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
        <td<?= $Page->qty_oss->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_qty_oss" class="el_vas_validation_qty_oss">
<span<?= $Page->qty_oss->viewAttributes() ?>>
<?= $Page->qty_oss->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <td<?= $Page->shipment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_shipment" class="el_vas_validation_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
        <td<?= $Page->aju->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_aju" class="el_vas_validation_aju">
<span<?= $Page->aju->viewAttributes() ?>>
<?= $Page->aju->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
        <td<?= $Page->actual_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_actual_price" class="el_vas_validation_actual_price">
<span<?= $Page->actual_price->viewAttributes() ?>>
<?= $Page->actual_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
        <td<?= $Page->price_foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_price_foto" class="el_vas_validation_price_foto">
<span>
<?= GetFileViewTag($Page->price_foto, $Page->price_foto->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
        <td<?= $Page->snow->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_snow" class="el_vas_validation_snow">
<span<?= $Page->snow->viewAttributes() ?>>
<?= $Page->snow->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <td<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_remarks" class="el_vas_validation_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_date_upload" class="el_vas_validation_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_user" class="el_vas_validation_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_status" class="el_vas_validation_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <td<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_date_update" class="el_vas_validation_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <td<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_time_update" class="el_vas_validation_time_update">
<span<?= $Page->time_update->viewAttributes() ?>>
<?= $Page->time_update->getViewValue() ?></span>
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

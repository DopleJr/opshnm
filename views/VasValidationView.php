<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$VasValidationView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vas_validation: currentTable } });
var currentForm, currentPageID;
var fvas_validationview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvas_validationview = new ew.Form("fvas_validationview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fvas_validationview;
    loadjs.done("fvas_validationview");
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
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fvas_validationview" id="fvas_validationview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vas_validation">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_vas_validation_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
    <tr id="r_order"<?= $Page->order->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_order"><?= $Page->order->caption() ?></span></td>
        <td data-name="order"<?= $Page->order->cellAttributes() ?>>
<span id="el_vas_validation_order">
<span<?= $Page->order->viewAttributes() ?>>
<?= $Page->order->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
    <tr id="r_po"<?= $Page->po->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_po"><?= $Page->po->caption() ?></span></td>
        <td data-name="po"<?= $Page->po->cellAttributes() ?>>
<span id="el_vas_validation_po">
<span<?= $Page->po->viewAttributes() ?>>
<?= $Page->po->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
    <tr id="r_sap_art"<?= $Page->sap_art->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_sap_art"><?= $Page->sap_art->caption() ?></span></td>
        <td data-name="sap_art"<?= $Page->sap_art->cellAttributes() ?>>
<span id="el_vas_validation_sap_art">
<span<?= $Page->sap_art->viewAttributes() ?>>
<?= $Page->sap_art->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
    <tr id="r_sub_index"<?= $Page->sub_index->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_sub_index"><?= $Page->sub_index->caption() ?></span></td>
        <td data-name="sub_index"<?= $Page->sub_index->cellAttributes() ?>>
<span id="el_vas_validation_sub_index">
<span<?= $Page->sub_index->viewAttributes() ?>>
<?= $Page->sub_index->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <tr id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_concept"><?= $Page->concept->caption() ?></span></td>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el_vas_validation_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <tr id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_ctn"><?= $Page->ctn->caption() ?></span></td>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el_vas_validation_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
    <tr id="r_season2"<?= $Page->season2->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_season2"><?= $Page->season2->caption() ?></span></td>
        <td data-name="season2"<?= $Page->season2->cellAttributes() ?>>
<span id="el_vas_validation_season2">
<span<?= $Page->season2->viewAttributes() ?>>
<?= $Page->season2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
    <tr id="r_qty_oss"<?= $Page->qty_oss->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_qty_oss"><?= $Page->qty_oss->caption() ?></span></td>
        <td data-name="qty_oss"<?= $Page->qty_oss->cellAttributes() ?>>
<span id="el_vas_validation_qty_oss">
<span<?= $Page->qty_oss->viewAttributes() ?>>
<?= $Page->qty_oss->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
    <tr id="r_shipment"<?= $Page->shipment->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_shipment"><?= $Page->shipment->caption() ?></span></td>
        <td data-name="shipment"<?= $Page->shipment->cellAttributes() ?>>
<span id="el_vas_validation_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
    <tr id="r_aju"<?= $Page->aju->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_aju"><?= $Page->aju->caption() ?></span></td>
        <td data-name="aju"<?= $Page->aju->cellAttributes() ?>>
<span id="el_vas_validation_aju">
<span<?= $Page->aju->viewAttributes() ?>>
<?= $Page->aju->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
    <tr id="r_actual_price"<?= $Page->actual_price->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_actual_price"><?= $Page->actual_price->caption() ?></span></td>
        <td data-name="actual_price"<?= $Page->actual_price->cellAttributes() ?>>
<span id="el_vas_validation_actual_price">
<span<?= $Page->actual_price->viewAttributes() ?>>
<?= $Page->actual_price->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
    <tr id="r_price_foto"<?= $Page->price_foto->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_price_foto"><?= $Page->price_foto->caption() ?></span></td>
        <td data-name="price_foto"<?= $Page->price_foto->cellAttributes() ?>>
<span id="el_vas_validation_price_foto">
<span>
<?= GetFileViewTag($Page->price_foto, $Page->price_foto->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
    <tr id="r_snow"<?= $Page->snow->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_snow"><?= $Page->snow->caption() ?></span></td>
        <td data-name="snow"<?= $Page->snow->cellAttributes() ?>>
<span id="el_vas_validation_snow">
<span<?= $Page->snow->viewAttributes() ?>>
<?= $Page->snow->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <tr id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_remarks"><?= $Page->remarks->caption() ?></span></td>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el_vas_validation_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <tr id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_date_upload"><?= $Page->date_upload->caption() ?></span></td>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_vas_validation_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user"<?= $Page->user->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el_vas_validation_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_vas_validation_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
    <tr id="r_date_update"<?= $Page->date_update->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_date_update"><?= $Page->date_update->caption() ?></span></td>
        <td data-name="date_update"<?= $Page->date_update->cellAttributes() ?>>
<span id="el_vas_validation_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
    <tr id="r_time_update"<?= $Page->time_update->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vas_validation_time_update"><?= $Page->time_update->caption() ?></span></td>
        <td data-name="time_update"<?= $Page->time_update->cellAttributes() ?>>
<span id="el_vas_validation_time_update">
<span<?= $Page->time_update->viewAttributes() ?>>
<?= $Page->time_update->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

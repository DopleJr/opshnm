<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OssManualView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { oss_manual: currentTable } });
var currentForm, currentPageID;
var foss_manualview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    foss_manualview = new ew.Form("foss_manualview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = foss_manualview;
    loadjs.done("foss_manualview");
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
<form name="foss_manualview" id="foss_manualview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="oss_manual">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_oss_manual_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date"<?= $Page->date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el_oss_manual_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
    <tr id="r_sscc"<?= $Page->sscc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_sscc"><?= $Page->sscc->caption() ?></span></td>
        <td data-name="sscc"<?= $Page->sscc->cellAttributes() ?>>
<span id="el_oss_manual_sscc">
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
    <tr id="r_shipment"<?= $Page->shipment->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_shipment"><?= $Page->shipment->caption() ?></span></td>
        <td data-name="shipment"<?= $Page->shipment->cellAttributes() ?>>
<span id="el_oss_manual_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
    <tr id="r_pallet_no"<?= $Page->pallet_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_pallet_no"><?= $Page->pallet_no->caption() ?></span></td>
        <td data-name="pallet_no"<?= $Page->pallet_no->cellAttributes() ?>>
<span id="el_oss_manual_pallet_no">
<span<?= $Page->pallet_no->viewAttributes() ?>>
<?= $Page->pallet_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
    <tr id="r_idw"<?= $Page->idw->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_idw"><?= $Page->idw->caption() ?></span></td>
        <td data-name="idw"<?= $Page->idw->cellAttributes() ?>>
<span id="el_oss_manual_idw">
<span<?= $Page->idw->viewAttributes() ?>>
<?= $Page->idw->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
    <tr id="r_order_no"<?= $Page->order_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_order_no"><?= $Page->order_no->caption() ?></span></td>
        <td data-name="order_no"<?= $Page->order_no->cellAttributes() ?>>
<span id="el_oss_manual_order_no">
<span<?= $Page->order_no->viewAttributes() ?>>
<?= $Page->order_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
    <tr id="r_item_in_ctn"<?= $Page->item_in_ctn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_item_in_ctn"><?= $Page->item_in_ctn->caption() ?></span></td>
        <td data-name="item_in_ctn"<?= $Page->item_in_ctn->cellAttributes() ?>>
<span id="el_oss_manual_item_in_ctn">
<span<?= $Page->item_in_ctn->viewAttributes() ?>>
<?= $Page->item_in_ctn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
    <tr id="r_no_of_ctn"<?= $Page->no_of_ctn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_no_of_ctn"><?= $Page->no_of_ctn->caption() ?></span></td>
        <td data-name="no_of_ctn"<?= $Page->no_of_ctn->cellAttributes() ?>>
<span id="el_oss_manual_no_of_ctn">
<span<?= $Page->no_of_ctn->viewAttributes() ?>>
<?= $Page->no_of_ctn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
    <tr id="r_ctn_no"<?= $Page->ctn_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_ctn_no"><?= $Page->ctn_no->caption() ?></span></td>
        <td data-name="ctn_no"<?= $Page->ctn_no->cellAttributes() ?>>
<span id="el_oss_manual_ctn_no">
<span<?= $Page->ctn_no->viewAttributes() ?>>
<?= $Page->ctn_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <tr id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_checker"><?= $Page->checker->caption() ?></span></td>
        <td data-name="checker"<?= $Page->checker->cellAttributes() ?>>
<span id="el_oss_manual_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
    <tr id="r_shift"<?= $Page->shift->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_oss_manual_shift"><?= $Page->shift->caption() ?></span></td>
        <td data-name="shift"<?= $Page->shift->cellAttributes() ?>>
<span id="el_oss_manual_shift">
<span<?= $Page->shift->viewAttributes() ?>>
<?= $Page->shift->getViewValue() ?></span>
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

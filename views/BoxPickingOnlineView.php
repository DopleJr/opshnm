<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BoxPickingOnlineView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { box_picking_online: currentTable } });
var currentForm, currentPageID;
var fbox_picking_onlineview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbox_picking_onlineview = new ew.Form("fbox_picking_onlineview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fbox_picking_onlineview;
    loadjs.done("fbox_picking_onlineview");
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
<form name="fbox_picking_onlineview" id="fbox_picking_onlineview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_picking_online">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_box_picking_online_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <tr id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_box_id"><?= $Page->box_id->caption() ?></span></td>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<span id="el_box_picking_online_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <tr id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_store_code"><?= $Page->store_code->caption() ?></span></td>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<span id="el_box_picking_online_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <tr id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_store_name"><?= $Page->store_name->caption() ?></span></td>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el_box_picking_online_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type"<?= $Page->type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el_box_picking_online_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <tr id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_concept"><?= $Page->concept->caption() ?></span></td>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el_box_picking_online_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <tr id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_picked_qty"><?= $Page->picked_qty->caption() ?></span></td>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el_box_picking_online_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
    <tr id="r_scan_qty"<?= $Page->scan_qty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_scan_qty"><?= $Page->scan_qty->caption() ?></span></td>
        <td data-name="scan_qty"<?= $Page->scan_qty->cellAttributes() ?>>
<span id="el_box_picking_online_scan_qty">
<span<?= $Page->scan_qty->viewAttributes() ?>>
<?= $Page->scan_qty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_box_picking_online_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
    <tr id="r_users"<?= $Page->users->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_users"><?= $Page->users->caption() ?></span></td>
        <td data-name="users"<?= $Page->users->cellAttributes() ?>>
<span id="el_box_picking_online_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
    <tr id="r_picking_date"<?= $Page->picking_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_picking_date"><?= $Page->picking_date->caption() ?></span></td>
        <td data-name="picking_date"<?= $Page->picking_date->cellAttributes() ?>>
<span id="el_box_picking_online_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
    <tr id="r_line"<?= $Page->line->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_line"><?= $Page->line->caption() ?></span></td>
        <td data-name="line"<?= $Page->line->cellAttributes() ?>>
<span id="el_box_picking_online_line">
<span<?= $Page->line->viewAttributes() ?>>
<?= $Page->line->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_box_picking_online_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
    <tr id="r_date_delivery"<?= $Page->date_delivery->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_date_delivery"><?= $Page->date_delivery->caption() ?></span></td>
        <td data-name="date_delivery"<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el_box_picking_online_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
    <tr id="r_date_staging"<?= $Page->date_staging->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_date_staging"><?= $Page->date_staging->caption() ?></span></td>
        <td data-name="date_staging"<?= $Page->date_staging->cellAttributes() ?>>
<span id="el_box_picking_online_date_staging">
<span<?= $Page->date_staging->viewAttributes() ?>>
<?= $Page->date_staging->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_picking_online_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_box_picking_online_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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

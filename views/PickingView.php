<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking: currentTable } });
var currentForm, currentPageID;
var fpickingview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpickingview = new ew.Form("fpickingview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpickingview;
    loadjs.done("fpickingview");
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
<form name="fpickingview" id="fpickingview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_picking_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
    <tr id="r_po_no"<?= $Page->po_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_po_no"><?= $Page->po_no->caption() ?></span></td>
        <td data-name="po_no"<?= $Page->po_no->cellAttributes() ?>>
<span id="el_picking_po_no">
<span<?= $Page->po_no->viewAttributes() ?>>
<?= $Page->po_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
    <tr id="r_to_no"<?= $Page->to_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_to_no"><?= $Page->to_no->caption() ?></span></td>
        <td data-name="to_no"<?= $Page->to_no->cellAttributes() ?>>
<span id="el_picking_to_no">
<span<?= $Page->to_no->viewAttributes() ?>>
<?= $Page->to_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
    <tr id="r_to_order_item"<?= $Page->to_order_item->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_to_order_item"><?= $Page->to_order_item->caption() ?></span></td>
        <td data-name="to_order_item"<?= $Page->to_order_item->cellAttributes() ?>>
<span id="el_picking_to_order_item">
<span<?= $Page->to_order_item->viewAttributes() ?>>
<?= $Page->to_order_item->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
    <tr id="r_to_priority"<?= $Page->to_priority->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_to_priority"><?= $Page->to_priority->caption() ?></span></td>
        <td data-name="to_priority"<?= $Page->to_priority->cellAttributes() ?>>
<span id="el_picking_to_priority">
<span<?= $Page->to_priority->viewAttributes() ?>>
<?= $Page->to_priority->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
    <tr id="r_to_priority_code"<?= $Page->to_priority_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_to_priority_code"><?= $Page->to_priority_code->caption() ?></span></td>
        <td data-name="to_priority_code"<?= $Page->to_priority_code->cellAttributes() ?>>
<span id="el_picking_to_priority_code">
<span<?= $Page->to_priority_code->viewAttributes() ?>>
<?= $Page->to_priority_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
    <tr id="r_source_storage_type"<?= $Page->source_storage_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_source_storage_type"><?= $Page->source_storage_type->caption() ?></span></td>
        <td data-name="source_storage_type"<?= $Page->source_storage_type->cellAttributes() ?>>
<span id="el_picking_source_storage_type">
<span<?= $Page->source_storage_type->viewAttributes() ?>>
<?= $Page->source_storage_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
    <tr id="r_source_storage_bin"<?= $Page->source_storage_bin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_source_storage_bin"><?= $Page->source_storage_bin->caption() ?></span></td>
        <td data-name="source_storage_bin"<?= $Page->source_storage_bin->cellAttributes() ?>>
<span id="el_picking_source_storage_bin">
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<?= $Page->source_storage_bin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
    <tr id="r_carton_number"<?= $Page->carton_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_carton_number"><?= $Page->carton_number->caption() ?></span></td>
        <td data-name="carton_number"<?= $Page->carton_number->cellAttributes() ?>>
<span id="el_picking_carton_number">
<span<?= $Page->carton_number->viewAttributes() ?>>
<?= $Page->carton_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <tr id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_creation_date"><?= $Page->creation_date->caption() ?></span></td>
        <td data-name="creation_date"<?= $Page->creation_date->cellAttributes() ?>>
<span id="el_picking_creation_date">
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
    <tr id="r_gr_number"<?= $Page->gr_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_gr_number"><?= $Page->gr_number->caption() ?></span></td>
        <td data-name="gr_number"<?= $Page->gr_number->cellAttributes() ?>>
<span id="el_picking_gr_number">
<span<?= $Page->gr_number->viewAttributes() ?>>
<?= $Page->gr_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
    <tr id="r_gr_date"<?= $Page->gr_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_gr_date"><?= $Page->gr_date->caption() ?></span></td>
        <td data-name="gr_date"<?= $Page->gr_date->cellAttributes() ?>>
<span id="el_picking_gr_date">
<span<?= $Page->gr_date->viewAttributes() ?>>
<?= $Page->gr_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
    <tr id="r_delivery"<?= $Page->delivery->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_delivery"><?= $Page->delivery->caption() ?></span></td>
        <td data-name="delivery"<?= $Page->delivery->cellAttributes() ?>>
<span id="el_picking_delivery">
<span<?= $Page->delivery->viewAttributes() ?>>
<?= $Page->delivery->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <tr id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_store_id"><?= $Page->store_id->caption() ?></span></td>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el_picking_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <tr id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_store_name"><?= $Page->store_name->caption() ?></span></td>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el_picking_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_picking_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <tr id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_size_code"><?= $Page->size_code->caption() ?></span></td>
        <td data-name="size_code"<?= $Page->size_code->cellAttributes() ?>>
<span id="el_picking_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <tr id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_size_desc"><?= $Page->size_desc->caption() ?></span></td>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_picking_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <tr id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_color_code"><?= $Page->color_code->caption() ?></span></td>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el_picking_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <tr id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_color_desc"><?= $Page->color_desc->caption() ?></span></td>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_picking_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <tr id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_concept"><?= $Page->concept->caption() ?></span></td>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el_picking_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
    <tr id="r_target_qty"<?= $Page->target_qty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_target_qty"><?= $Page->target_qty->caption() ?></span></td>
        <td data-name="target_qty"<?= $Page->target_qty->cellAttributes() ?>>
<span id="el_picking_target_qty">
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <tr id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_picked_qty"><?= $Page->picked_qty->caption() ?></span></td>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el_picking_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
    <tr id="r_variance_qty"<?= $Page->variance_qty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_variance_qty"><?= $Page->variance_qty->caption() ?></span></td>
        <td data-name="variance_qty"<?= $Page->variance_qty->cellAttributes() ?>>
<span id="el_picking_variance_qty">
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
    <tr id="r_confirmation_date"<?= $Page->confirmation_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_confirmation_date"><?= $Page->confirmation_date->caption() ?></span></td>
        <td data-name="confirmation_date"<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el_picking_confirmation_date">
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
    <tr id="r_confirmation_time"<?= $Page->confirmation_time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_confirmation_time"><?= $Page->confirmation_time->caption() ?></span></td>
        <td data-name="confirmation_time"<?= $Page->confirmation_time->cellAttributes() ?>>
<span id="el_picking_confirmation_time">
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
    <tr id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_box_code"><?= $Page->box_code->caption() ?></span></td>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el_picking_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
    <tr id="r_box_type"<?= $Page->box_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_box_type"><?= $Page->box_type->caption() ?></span></td>
        <td data-name="box_type"<?= $Page->box_type->cellAttributes() ?>>
<span id="el_picking_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
    <tr id="r_picker"<?= $Page->picker->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_picker"><?= $Page->picker->caption() ?></span></td>
        <td data-name="picker"<?= $Page->picker->cellAttributes() ?>>
<span id="el_picking_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_picking_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <tr id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_picking_remarks"><?= $Page->remarks->caption() ?></span></td>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el_picking_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
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

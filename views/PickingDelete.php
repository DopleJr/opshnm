<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking: currentTable } });
var currentForm, currentPageID;
var fpickingdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpickingdelete = new ew.Form("fpickingdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpickingdelete;
    loadjs.done("fpickingdelete");
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
<form name="fpickingdelete" id="fpickingdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_picking_id" class="picking_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
        <th class="<?= $Page->po_no->headerCellClass() ?>"><span id="elh_picking_po_no" class="picking_po_no"><?= $Page->po_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
        <th class="<?= $Page->to_no->headerCellClass() ?>"><span id="elh_picking_to_no" class="picking_to_no"><?= $Page->to_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <th class="<?= $Page->to_order_item->headerCellClass() ?>"><span id="elh_picking_to_order_item" class="picking_to_order_item"><?= $Page->to_order_item->caption() ?></span></th>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
        <th class="<?= $Page->to_priority->headerCellClass() ?>"><span id="elh_picking_to_priority" class="picking_to_priority"><?= $Page->to_priority->caption() ?></span></th>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <th class="<?= $Page->to_priority_code->headerCellClass() ?>"><span id="elh_picking_to_priority_code" class="picking_to_priority_code"><?= $Page->to_priority_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <th class="<?= $Page->source_storage_type->headerCellClass() ?>"><span id="elh_picking_source_storage_type" class="picking_source_storage_type"><?= $Page->source_storage_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <th class="<?= $Page->source_storage_bin->headerCellClass() ?>"><span id="elh_picking_source_storage_bin" class="picking_source_storage_bin"><?= $Page->source_storage_bin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
        <th class="<?= $Page->carton_number->headerCellClass() ?>"><span id="elh_picking_carton_number" class="picking_carton_number"><?= $Page->carton_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <th class="<?= $Page->creation_date->headerCellClass() ?>"><span id="elh_picking_creation_date" class="picking_creation_date"><?= $Page->creation_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
        <th class="<?= $Page->gr_number->headerCellClass() ?>"><span id="elh_picking_gr_number" class="picking_gr_number"><?= $Page->gr_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
        <th class="<?= $Page->gr_date->headerCellClass() ?>"><span id="elh_picking_gr_date" class="picking_gr_date"><?= $Page->gr_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
        <th class="<?= $Page->delivery->headerCellClass() ?>"><span id="elh_picking_delivery" class="picking_delivery"><?= $Page->delivery->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th class="<?= $Page->store_id->headerCellClass() ?>"><span id="elh_picking_store_id" class="picking_store_id"><?= $Page->store_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th class="<?= $Page->store_name->headerCellClass() ?>"><span id="elh_picking_store_name" class="picking_store_name"><?= $Page->store_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_picking_article" class="picking_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <th class="<?= $Page->size_code->headerCellClass() ?>"><span id="elh_picking_size_code" class="picking_size_code"><?= $Page->size_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th class="<?= $Page->size_desc->headerCellClass() ?>"><span id="elh_picking_size_desc" class="picking_size_desc"><?= $Page->size_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th class="<?= $Page->color_code->headerCellClass() ?>"><span id="elh_picking_color_code" class="picking_color_code"><?= $Page->color_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th class="<?= $Page->color_desc->headerCellClass() ?>"><span id="elh_picking_color_desc" class="picking_color_desc"><?= $Page->color_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th class="<?= $Page->concept->headerCellClass() ?>"><span id="elh_picking_concept" class="picking_concept"><?= $Page->concept->caption() ?></span></th>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
        <th class="<?= $Page->target_qty->headerCellClass() ?>"><span id="elh_picking_target_qty" class="picking_target_qty"><?= $Page->target_qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th class="<?= $Page->picked_qty->headerCellClass() ?>"><span id="elh_picking_picked_qty" class="picking_picked_qty"><?= $Page->picked_qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <th class="<?= $Page->variance_qty->headerCellClass() ?>"><span id="elh_picking_variance_qty" class="picking_variance_qty"><?= $Page->variance_qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <th class="<?= $Page->confirmation_date->headerCellClass() ?>"><span id="elh_picking_confirmation_date" class="picking_confirmation_date"><?= $Page->confirmation_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <th class="<?= $Page->confirmation_time->headerCellClass() ?>"><span id="elh_picking_confirmation_time" class="picking_confirmation_time"><?= $Page->confirmation_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th class="<?= $Page->box_code->headerCellClass() ?>"><span id="elh_picking_box_code" class="picking_box_code"><?= $Page->box_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <th class="<?= $Page->box_type->headerCellClass() ?>"><span id="elh_picking_box_type" class="picking_box_type"><?= $Page->box_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <th class="<?= $Page->picker->headerCellClass() ?>"><span id="elh_picking_picker" class="picking_picker"><?= $Page->picker->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_picking_status" class="picking_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th class="<?= $Page->remarks->headerCellClass() ?>"><span id="elh_picking_remarks" class="picking_remarks"><?= $Page->remarks->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_picking_id" class="el_picking_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
        <td<?= $Page->po_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_po_no" class="el_picking_po_no">
<span<?= $Page->po_no->viewAttributes() ?>>
<?= $Page->po_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
        <td<?= $Page->to_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_no" class="el_picking_to_no">
<span<?= $Page->to_no->viewAttributes() ?>>
<?= $Page->to_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <td<?= $Page->to_order_item->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_order_item" class="el_picking_to_order_item">
<span<?= $Page->to_order_item->viewAttributes() ?>>
<?= $Page->to_order_item->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
        <td<?= $Page->to_priority->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_priority" class="el_picking_to_priority">
<span<?= $Page->to_priority->viewAttributes() ?>>
<?= $Page->to_priority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <td<?= $Page->to_priority_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_priority_code" class="el_picking_to_priority_code">
<span<?= $Page->to_priority_code->viewAttributes() ?>>
<?= $Page->to_priority_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <td<?= $Page->source_storage_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_source_storage_type" class="el_picking_source_storage_type">
<span<?= $Page->source_storage_type->viewAttributes() ?>>
<?= $Page->source_storage_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <td<?= $Page->source_storage_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_source_storage_bin" class="el_picking_source_storage_bin">
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<?= $Page->source_storage_bin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
        <td<?= $Page->carton_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_carton_number" class="el_picking_carton_number">
<span<?= $Page->carton_number->viewAttributes() ?>>
<?= $Page->carton_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <td<?= $Page->creation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_creation_date" class="el_picking_creation_date">
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
        <td<?= $Page->gr_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_gr_number" class="el_picking_gr_number">
<span<?= $Page->gr_number->viewAttributes() ?>>
<?= $Page->gr_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
        <td<?= $Page->gr_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_gr_date" class="el_picking_gr_date">
<span<?= $Page->gr_date->viewAttributes() ?>>
<?= $Page->gr_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
        <td<?= $Page->delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_delivery" class="el_picking_delivery">
<span<?= $Page->delivery->viewAttributes() ?>>
<?= $Page->delivery->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <td<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_store_id" class="el_picking_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <td<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_store_name" class="el_picking_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_article" class="el_picking_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <td<?= $Page->size_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_size_code" class="el_picking_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_size_desc" class="el_picking_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <td<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_color_code" class="el_picking_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_color_desc" class="el_picking_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <td<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_concept" class="el_picking_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
        <td<?= $Page->target_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_target_qty" class="el_picking_target_qty">
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_picked_qty" class="el_picking_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <td<?= $Page->variance_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_variance_qty" class="el_picking_variance_qty">
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <td<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_confirmation_date" class="el_picking_confirmation_date">
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <td<?= $Page->confirmation_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_confirmation_time" class="el_picking_confirmation_time">
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <td<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_box_code" class="el_picking_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <td<?= $Page->box_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_box_type" class="el_picking_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <td<?= $Page->picker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_picker" class="el_picking_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_status" class="el_picking_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <td<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_remarks" class="el_picking_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
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

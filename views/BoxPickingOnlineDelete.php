<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BoxPickingOnlineDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { box_picking_online: currentTable } });
var currentForm, currentPageID;
var fbox_picking_onlinedelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbox_picking_onlinedelete = new ew.Form("fbox_picking_onlinedelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fbox_picking_onlinedelete;
    loadjs.done("fbox_picking_onlinedelete");
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
<form name="fbox_picking_onlinedelete" id="fbox_picking_onlinedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_picking_online">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_box_picking_online_id" class="box_picking_online_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th class="<?= $Page->box_id->headerCellClass() ?>"><span id="elh_box_picking_online_box_id" class="box_picking_online_box_id"><?= $Page->box_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th class="<?= $Page->store_code->headerCellClass() ?>"><span id="elh_box_picking_online_store_code" class="box_picking_online_store_code"><?= $Page->store_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th class="<?= $Page->store_name->headerCellClass() ?>"><span id="elh_box_picking_online_store_name" class="box_picking_online_store_name"><?= $Page->store_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_box_picking_online_type" class="box_picking_online_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th class="<?= $Page->concept->headerCellClass() ?>"><span id="elh_box_picking_online_concept" class="box_picking_online_concept"><?= $Page->concept->caption() ?></span></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th class="<?= $Page->picked_qty->headerCellClass() ?>"><span id="elh_box_picking_online_picked_qty" class="box_picking_online_picked_qty"><?= $Page->picked_qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
        <th class="<?= $Page->scan_qty->headerCellClass() ?>"><span id="elh_box_picking_online_scan_qty" class="box_picking_online_scan_qty"><?= $Page->scan_qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_box_picking_online_status" class="box_picking_online_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th class="<?= $Page->users->headerCellClass() ?>"><span id="elh_box_picking_online_users" class="box_picking_online_users"><?= $Page->users->caption() ?></span></th>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <th class="<?= $Page->picking_date->headerCellClass() ?>"><span id="elh_box_picking_online_picking_date" class="box_picking_online_picking_date"><?= $Page->picking_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
        <th class="<?= $Page->line->headerCellClass() ?>"><span id="elh_box_picking_online_line" class="box_picking_online_line"><?= $Page->line->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_box_picking_online_date_created" class="box_picking_online_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <th class="<?= $Page->date_delivery->headerCellClass() ?>"><span id="elh_box_picking_online_date_delivery" class="box_picking_online_date_delivery"><?= $Page->date_delivery->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
        <th class="<?= $Page->date_staging->headerCellClass() ?>"><span id="elh_box_picking_online_date_staging" class="box_picking_online_date_staging"><?= $Page->date_staging->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_box_picking_online_date_updated" class="box_picking_online_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_box_picking_online_id" class="el_box_picking_online_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <td<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_box_id" class="el_box_picking_online_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <td<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_store_code" class="el_box_picking_online_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <td<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_store_name" class="el_box_picking_online_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_type" class="el_box_picking_online_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <td<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_concept" class="el_box_picking_online_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_picked_qty" class="el_box_picking_online_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
        <td<?= $Page->scan_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_scan_qty" class="el_box_picking_online_scan_qty">
<span<?= $Page->scan_qty->viewAttributes() ?>>
<?= $Page->scan_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_status" class="el_box_picking_online_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <td<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_users" class="el_box_picking_online_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td<?= $Page->picking_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_picking_date" class="el_box_picking_online_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
        <td<?= $Page->line->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_line" class="el_box_picking_online_line">
<span<?= $Page->line->viewAttributes() ?>>
<?= $Page->line->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_created" class="el_box_picking_online_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <td<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_delivery" class="el_box_picking_online_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
        <td<?= $Page->date_staging->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_staging" class="el_box_picking_online_date_staging">
<span<?= $Page->date_staging->viewAttributes() ?>>
<?= $Page->date_staging->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_online_date_updated" class="el_box_picking_online_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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

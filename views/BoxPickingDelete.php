<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BoxPickingDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { box_picking: currentTable } });
var currentForm, currentPageID;
var fbox_pickingdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbox_pickingdelete = new ew.Form("fbox_pickingdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fbox_pickingdelete;
    loadjs.done("fbox_pickingdelete");
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
<form name="fbox_pickingdelete" id="fbox_pickingdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_picking">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_box_picking_id" class="box_picking_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th class="<?= $Page->store_name->headerCellClass() ?>"><span id="elh_box_picking_store_name" class="box_picking_store_name"><?= $Page->store_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th class="<?= $Page->store_code->headerCellClass() ?>"><span id="elh_box_picking_store_code" class="box_picking_store_code"><?= $Page->store_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th class="<?= $Page->box_id->headerCellClass() ?>"><span id="elh_box_picking_box_id" class="box_picking_box_id"><?= $Page->box_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_box_picking_type" class="box_picking_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th class="<?= $Page->concept->headerCellClass() ?>"><span id="elh_box_picking_concept" class="box_picking_concept"><?= $Page->concept->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_box_picking_quantity" class="box_picking_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_box_picking_status" class="box_picking_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th class="<?= $Page->users->headerCellClass() ?>"><span id="elh_box_picking_users" class="box_picking_users"><?= $Page->users->caption() ?></span></th>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <th class="<?= $Page->picking_date->headerCellClass() ?>"><span id="elh_box_picking_picking_date" class="box_picking_picking_date"><?= $Page->picking_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_box_picking_date_created" class="box_picking_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <th class="<?= $Page->date_delivery->headerCellClass() ?>"><span id="elh_box_picking_date_delivery" class="box_picking_date_delivery"><?= $Page->date_delivery->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_box_picking_date_updated" class="box_picking_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_box_picking_id" class="el_box_picking_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <td<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_store_name" class="el_box_picking_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <td<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_store_code" class="el_box_picking_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <td<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_box_id" class="el_box_picking_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_type" class="el_box_picking_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <td<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_concept" class="el_box_picking_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_quantity" class="el_box_picking_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_status" class="el_box_picking_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <td<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_users" class="el_box_picking_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td<?= $Page->picking_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_picking_date" class="el_box_picking_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_created" class="el_box_picking_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <td<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_delivery" class="el_box_picking_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_updated" class="el_box_picking_date_updated">
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

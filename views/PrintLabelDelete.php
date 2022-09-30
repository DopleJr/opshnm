<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PrintLabelDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { print_label: currentTable } });
var currentForm, currentPageID;
var fprint_labeldelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fprint_labeldelete = new ew.Form("fprint_labeldelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fprint_labeldelete;
    loadjs.done("fprint_labeldelete");
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
<form name="fprint_labeldelete" id="fprint_labeldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="print_label">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_print_label_id" class="print_label_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th class="<?= $Page->box_id->headerCellClass() ?>"><span id="elh_print_label_box_id" class="print_label_box_id"><?= $Page->box_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th class="<?= $Page->priority->headerCellClass() ?>"><span id="elh_print_label_priority" class="print_label_priority"><?= $Page->priority->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th class="<?= $Page->store_code->headerCellClass() ?>"><span id="elh_print_label_store_code" class="print_label_store_code"><?= $Page->store_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_print_label_user" class="print_label_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_print_label_date_created" class="print_label_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
        <th class="<?= $Page->time_created->headerCellClass() ?>"><span id="elh_print_label_time_created" class="print_label_time_created"><?= $Page->time_created->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_print_label_id" class="el_print_label_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <td<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_label_box_id" class="el_print_label_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <td<?= $Page->priority->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_label_priority" class="el_print_label_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <td<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_label_store_code" class="el_print_label_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_label_user" class="el_print_label_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_label_date_created" class="el_print_label_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
        <td<?= $Page->time_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_label_time_created" class="el_print_label_time_created">
<span<?= $Page->time_created->viewAttributes() ?>>
<?= $Page->time_created->getViewValue() ?></span>
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

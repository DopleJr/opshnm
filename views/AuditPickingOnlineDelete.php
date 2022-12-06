<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$AuditPickingOnlineDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { audit_picking_online: currentTable } });
var currentForm, currentPageID;
var faudit_picking_onlinedelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faudit_picking_onlinedelete = new ew.Form("faudit_picking_onlinedelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = faudit_picking_onlinedelete;
    loadjs.done("faudit_picking_onlinedelete");
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
<form name="faudit_picking_onlinedelete" id="faudit_picking_onlinedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="audit_picking_online">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_audit_picking_online_id" class="audit_picking_online_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th class="<?= $Page->box_code->headerCellClass() ?>"><span id="elh_audit_picking_online_box_code" class="audit_picking_online_box_code"><?= $Page->box_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th class="<?= $Page->store_id->headerCellClass() ?>"><span id="elh_audit_picking_online_store_id" class="audit_picking_online_store_id"><?= $Page->store_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th class="<?= $Page->store_name->headerCellClass() ?>"><span id="elh_audit_picking_online_store_name" class="audit_picking_online_store_name"><?= $Page->store_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th class="<?= $Page->checker->headerCellClass() ?>"><span id="elh_audit_picking_online_checker" class="audit_picking_online_checker"><?= $Page->checker->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_audit_picking_online_status" class="audit_picking_online_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_audit_picking_online_article" class="audit_picking_online_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th class="<?= $Page->date_update->headerCellClass() ?>"><span id="elh_audit_picking_online_date_update" class="audit_picking_online_date_update"><?= $Page->date_update->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th class="<?= $Page->time_update->headerCellClass() ?>"><span id="elh_audit_picking_online_time_update" class="audit_picking_online_time_update"><?= $Page->time_update->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_audit_picking_online_id" class="el_audit_picking_online_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <td<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_box_code" class="el_audit_picking_online_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <td<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_store_id" class="el_audit_picking_online_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <td<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_store_name" class="el_audit_picking_online_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <td<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_checker" class="el_audit_picking_online_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_status" class="el_audit_picking_online_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_article" class="el_audit_picking_online_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <td<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_date_update" class="el_audit_picking_online_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <td<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_time_update" class="el_audit_picking_online_time_update">
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

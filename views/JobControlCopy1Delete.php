<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlCopy1Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control_copy1: currentTable } });
var currentForm, currentPageID;
var fjob_control_copy1delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_control_copy1delete = new ew.Form("fjob_control_copy1delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fjob_control_copy1delete;
    loadjs.done("fjob_control_copy1delete");
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
<form name="fjob_control_copy1delete" id="fjob_control_copy1delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control_copy1">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_job_control_copy1_id" class="job_control_copy1_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <th class="<?= $Page->creation_date->headerCellClass() ?>"><span id="elh_job_control_copy1_creation_date" class="job_control_copy1_creation_date"><?= $Page->creation_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th class="<?= $Page->store_id->headerCellClass() ?>"><span id="elh_job_control_copy1_store_id" class="job_control_copy1_store_id"><?= $Page->store_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th class="<?= $Page->area->headerCellClass() ?>"><span id="elh_job_control_copy1_area" class="job_control_copy1_area"><?= $Page->area->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th class="<?= $Page->aisle->headerCellClass() ?>"><span id="elh_job_control_copy1_aisle" class="job_control_copy1_aisle"><?= $Page->aisle->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_job_control_copy1_user" class="job_control_copy1_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_job_control_copy1_status" class="job_control_copy1_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_job_control_copy1_date_created" class="job_control_copy1_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_job_control_copy1_date_updated" class="job_control_copy1_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_job_control_copy1_id" class="el_job_control_copy1_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <td<?= $Page->creation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_creation_date" class="el_job_control_copy1_creation_date">
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <td<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_store_id" class="el_job_control_copy1_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <td<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_area" class="el_job_control_copy1_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <td<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_aisle" class="el_job_control_copy1_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_user" class="el_job_control_copy1_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_status" class="el_job_control_copy1_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_date_created" class="el_job_control_copy1_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_date_updated" class="el_job_control_copy1_date_updated">
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

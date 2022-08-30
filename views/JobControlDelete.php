<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control: currentTable } });
var currentForm, currentPageID;
var fjob_controldelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_controldelete = new ew.Form("fjob_controldelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fjob_controldelete;
    loadjs.done("fjob_controldelete");
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
<form name="fjob_controldelete" id="fjob_controldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_job_control_id" class="job_control_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->job_category->Visible) { // job_category ?>
        <th class="<?= $Page->job_category->headerCellClass() ?>"><span id="elh_job_control_job_category" class="job_control_job_category"><?= $Page->job_category->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th class="<?= $Page->aisle->headerCellClass() ?>"><span id="elh_job_control_aisle" class="job_control_aisle"><?= $Page->aisle->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_job_control_user" class="job_control_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_job_control_status" class="job_control_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_job_control_date_created" class="job_control_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_job_control_date_updated" class="job_control_date_updated"><?= $Page->date_updated->caption() ?></span></th>
<?php } ?>
<?php if ($Page->test->Visible) { // test ?>
        <th class="<?= $Page->test->headerCellClass() ?>"><span id="elh_job_control_test" class="job_control_test"><?= $Page->test->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_job_control_id" class="el_job_control_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->job_category->Visible) { // job_category ?>
        <td<?= $Page->job_category->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_job_category" class="el_job_control_job_category">
<span<?= $Page->job_category->viewAttributes() ?>>
<?= $Page->job_category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <td<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_aisle" class="el_job_control_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_user" class="el_job_control_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_status" class="el_job_control_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_date_created" class="el_job_control_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_date_updated" class="el_job_control_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->test->Visible) { // test ?>
        <td<?= $Page->test->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_test" class="el_job_control_test">
<span<?= $Page->test->viewAttributes() ?>>
<?= $Page->test->getViewValue() ?></span>
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

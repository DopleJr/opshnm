<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferbinDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transferbin: currentTable } });
var currentForm, currentPageID;
var ftransferbindelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransferbindelete = new ew.Form("ftransferbindelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftransferbindelete;
    loadjs.done("ftransferbindelete");
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
<form name="ftransferbindelete" id="ftransferbindelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transferbin">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_transferbin_id" class="transferbin_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->from_bin->Visible) { // from_bin ?>
        <th class="<?= $Page->from_bin->headerCellClass() ?>"><span id="elh_transferbin_from_bin" class="transferbin_from_bin"><?= $Page->from_bin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th class="<?= $Page->ctn->headerCellClass() ?>"><span id="elh_transferbin_ctn" class="transferbin_ctn"><?= $Page->ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->to_bin->Visible) { // to_bin ?>
        <th class="<?= $Page->to_bin->headerCellClass() ?>"><span id="elh_transferbin_to_bin" class="transferbin_to_bin"><?= $Page->to_bin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_transferbin_user" class="transferbin_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_transferbin_date_created" class="transferbin_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_transferbin_date_updated" class="transferbin_date_updated"><?= $Page->date_updated->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <th class="<?= $Page->time_updated->headerCellClass() ?>"><span id="elh_transferbin_time_updated" class="transferbin_time_updated"><?= $Page->time_updated->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_transferbin_id" class="el_transferbin_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->from_bin->Visible) { // from_bin ?>
        <td<?= $Page->from_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_from_bin" class="el_transferbin_from_bin">
<span<?= $Page->from_bin->viewAttributes() ?>>
<?= $Page->from_bin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <td<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_ctn" class="el_transferbin_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->to_bin->Visible) { // to_bin ?>
        <td<?= $Page->to_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_to_bin" class="el_transferbin_to_bin">
<span<?= $Page->to_bin->viewAttributes() ?>>
<?= $Page->to_bin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_user" class="el_transferbin_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_date_created" class="el_transferbin_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_date_updated" class="el_transferbin_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <td<?= $Page->time_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transferbin_time_updated" class="el_transferbin_time_updated">
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
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

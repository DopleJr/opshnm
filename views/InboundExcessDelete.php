<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$InboundExcessDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { inbound_excess: currentTable } });
var currentForm, currentPageID;
var finbound_excessdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    finbound_excessdelete = new ew.Form("finbound_excessdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = finbound_excessdelete;
    loadjs.done("finbound_excessdelete");
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
<form name="finbound_excessdelete" id="finbound_excessdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="inbound_excess">
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
<?php if ($Page->sscc->Visible) { // sscc ?>
        <th class="<?= $Page->sscc->headerCellClass() ?>"><span id="elh_inbound_excess_sscc" class="inbound_excess_sscc"><?= $Page->sscc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pallet_id->Visible) { // pallet_id ?>
        <th class="<?= $Page->pallet_id->headerCellClass() ?>"><span id="elh_inbound_excess_pallet_id" class="inbound_excess_pallet_id"><?= $Page->pallet_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th class="<?= $Page->users->headerCellClass() ?>"><span id="elh_inbound_excess_users" class="inbound_excess_users"><?= $Page->users->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th class="<?= $Page->date_update->headerCellClass() ?>"><span id="elh_inbound_excess_date_update" class="inbound_excess_date_update"><?= $Page->date_update->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th class="<?= $Page->time_update->headerCellClass() ?>"><span id="elh_inbound_excess_time_update" class="inbound_excess_time_update"><?= $Page->time_update->caption() ?></span></th>
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
<?php if ($Page->sscc->Visible) { // sscc ?>
        <td<?= $Page->sscc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_sscc" class="el_inbound_excess_sscc">
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pallet_id->Visible) { // pallet_id ?>
        <td<?= $Page->pallet_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_pallet_id" class="el_inbound_excess_pallet_id">
<span<?= $Page->pallet_id->viewAttributes() ?>>
<?= $Page->pallet_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <td<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_users" class="el_inbound_excess_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <td<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_date_update" class="el_inbound_excess_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <td<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_time_update" class="el_inbound_excess_time_update">
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

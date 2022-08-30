<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$DispositionLocationDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { disposition_location: currentTable } });
var currentForm, currentPageID;
var fdisposition_locationdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdisposition_locationdelete = new ew.Form("fdisposition_locationdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fdisposition_locationdelete;
    loadjs.done("fdisposition_locationdelete");
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
<form name="fdisposition_locationdelete" id="fdisposition_locationdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="disposition_location">
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
<?php if ($Page->photo_before->Visible) { // photo_before ?>
        <th class="<?= $Page->photo_before->headerCellClass() ?>"><span id="elh_disposition_location_photo_before" class="disposition_location_photo_before"><?= $Page->photo_before->caption() ?></span></th>
<?php } ?>
<?php if ($Page->photo_after->Visible) { // photo_after ?>
        <th class="<?= $Page->photo_after->headerCellClass() ?>"><span id="elh_disposition_location_photo_after" class="disposition_location_photo_after"><?= $Page->photo_after->caption() ?></span></th>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <th class="<?= $Page->divisi->headerCellClass() ?>"><span id="elh_disposition_location_divisi" class="disposition_location_divisi"><?= $Page->divisi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_disposition_location_status" class="disposition_location_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_disposition_location_date_created" class="disposition_location_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_disposition_location_date_updated" class="disposition_location_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->photo_before->Visible) { // photo_before ?>
        <td<?= $Page->photo_before->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_photo_before" class="el_disposition_location_photo_before">
<span>
<?= GetFileViewTag($Page->photo_before, $Page->photo_before->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->photo_after->Visible) { // photo_after ?>
        <td<?= $Page->photo_after->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_photo_after" class="el_disposition_location_photo_after">
<span>
<?= GetFileViewTag($Page->photo_after, $Page->photo_after->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <td<?= $Page->divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_divisi" class="el_disposition_location_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_status" class="el_disposition_location_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_date_created" class="el_disposition_location_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_date_updated" class="el_disposition_location_date_updated">
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

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$Mb51Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { mb51: currentTable } });
var currentForm, currentPageID;
var fmb51delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmb51delete = new ew.Form("fmb51delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmb51delete;
    loadjs.done("fmb51delete");
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
<form name="fmb51delete" id="fmb51delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mb51">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_mb51_id" class="mb51_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_mb51_article" class="mb51_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <th class="<?= $Page->reference->headerCellClass() ?>"><span id="elh_mb51_reference" class="mb51_reference"><?= $Page->reference->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rcvsite->Visible) { // rcvsite ?>
        <th class="<?= $Page->rcvsite->headerCellClass() ?>"><span id="elh_mb51_rcvsite" class="mb51_rcvsite"><?= $Page->rcvsite->caption() ?></span></th>
<?php } ?>
<?php if ($Page->do_type->Visible) { // do_type ?>
        <th class="<?= $Page->do_type->headerCellClass() ?>"><span id="elh_mb51_do_type" class="mb51_do_type"><?= $Page->do_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th class="<?= $Page->concept->headerCellClass() ?>"><span id="elh_mb51_concept" class="mb51_concept"><?= $Page->concept->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_mb51_id" class="el_mb51_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_article" class="el_mb51_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <td<?= $Page->reference->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_reference" class="el_mb51_reference">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rcvsite->Visible) { // rcvsite ?>
        <td<?= $Page->rcvsite->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_rcvsite" class="el_mb51_rcvsite">
<span<?= $Page->rcvsite->viewAttributes() ?>>
<?= $Page->rcvsite->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->do_type->Visible) { // do_type ?>
        <td<?= $Page->do_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_do_type" class="el_mb51_do_type">
<span<?= $Page->do_type->viewAttributes() ?>>
<?= $Page->do_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <td<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_concept" class="el_mb51_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
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

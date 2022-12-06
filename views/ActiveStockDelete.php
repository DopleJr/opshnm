<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ActiveStockDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { active_stock: currentTable } });
var currentForm, currentPageID;
var factive_stockdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    factive_stockdelete = new ew.Form("factive_stockdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = factive_stockdelete;
    loadjs.done("factive_stockdelete");
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
<form name="factive_stockdelete" id="factive_stockdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="active_stock">
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
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th class="<?= $Page->aisle->headerCellClass() ?>"><span id="elh_active_stock_aisle" class="active_stock_aisle"><?= $Page->aisle->caption() ?></span></th>
<?php } ?>
<?php if ($Page->active_bin->Visible) { // active_bin ?>
        <th class="<?= $Page->active_bin->headerCellClass() ?>"><span id="elh_active_stock_active_bin" class="active_stock_active_bin"><?= $Page->active_bin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->active_stock->Visible) { // active_stock ?>
        <th class="<?= $Page->active_stock->headerCellClass() ?>"><span id="elh_active_stock_active_stock" class="active_stock_active_stock"><?= $Page->active_stock->caption() ?></span></th>
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
<?php if ($Page->aisle->Visible) { // aisle ?>
        <td<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_active_stock_aisle" class="el_active_stock_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->active_bin->Visible) { // active_bin ?>
        <td<?= $Page->active_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_active_stock_active_bin" class="el_active_stock_active_bin">
<span<?= $Page->active_bin->viewAttributes() ?>>
<?= $Page->active_bin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->active_stock->Visible) { // active_stock ?>
        <td<?= $Page->active_stock->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_active_stock_active_stock" class="el_active_stock_active_stock">
<span<?= $Page->active_stock->viewAttributes() ?>>
<?= $Page->active_stock->getViewValue() ?></span>
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

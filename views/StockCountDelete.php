<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StockCountDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock_count: currentTable } });
var currentForm, currentPageID;
var fstock_countdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstock_countdelete = new ew.Form("fstock_countdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fstock_countdelete;
    loadjs.done("fstock_countdelete");
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
<form name="fstock_countdelete" id="fstock_countdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stock_count">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_stock_count_id" class="stock_count_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_stock_count_location" class="stock_count_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_stock_count_article" class="stock_count_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_stock_count_user" class="stock_count_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <th class="<?= $Page->divisi->headerCellClass() ?>"><span id="elh_stock_count_divisi" class="stock_count_divisi"><?= $Page->divisi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_stock_count_date_created" class="stock_count_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
        <th class="<?= $Page->time_created->headerCellClass() ?>"><span id="elh_stock_count_time_created" class="stock_count_time_created"><?= $Page->time_created->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_stock_count_id" class="el_stock_count_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_location" class="el_stock_count_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_article" class="el_stock_count_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_user" class="el_stock_count_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <td<?= $Page->divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_divisi" class="el_stock_count_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_date_created" class="el_stock_count_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
        <td<?= $Page->time_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_time_created" class="el_stock_count_time_created">
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

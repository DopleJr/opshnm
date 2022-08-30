<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MasterArticleDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { master_article: currentTable } });
var currentForm, currentPageID;
var fmaster_articledelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmaster_articledelete = new ew.Form("fmaster_articledelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmaster_articledelete;
    loadjs.done("fmaster_articledelete");
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
<form name="fmaster_articledelete" id="fmaster_articledelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_article">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_master_article_id" class="master_article_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_master_article_article" class="master_article_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_master_article_description" class="master_article_description"><?= $Page->description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gtin->Visible) { // gtin ?>
        <th class="<?= $Page->gtin->headerCellClass() ?>"><span id="elh_master_article_gtin" class="master_article_gtin"><?= $Page->gtin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th class="<?= $Page->color_code->headerCellClass() ?>"><span id="elh_master_article_color_code" class="master_article_color_code"><?= $Page->color_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th class="<?= $Page->color_desc->headerCellClass() ?>"><span id="elh_master_article_color_desc" class="master_article_color_desc"><?= $Page->color_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <th class="<?= $Page->size_code->headerCellClass() ?>"><span id="elh_master_article_size_code" class="master_article_size_code"><?= $Page->size_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th class="<?= $Page->size_desc->headerCellClass() ?>"><span id="elh_master_article_size_desc" class="master_article_size_desc"><?= $Page->size_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <th class="<?= $Page->season->headerCellClass() ?>"><span id="elh_master_article_season" class="master_article_season"><?= $Page->season->caption() ?></span></th>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
        <th class="<?= $Page->price->headerCellClass() ?>"><span id="elh_master_article_price" class="master_article_price"><?= $Page->price->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_master_article_id" class="el_master_article_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_article" class="el_master_article_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_description" class="el_master_article_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gtin->Visible) { // gtin ?>
        <td<?= $Page->gtin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_gtin" class="el_master_article_gtin">
<span<?= $Page->gtin->viewAttributes() ?>>
<?= $Page->gtin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <td<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_color_code" class="el_master_article_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_color_desc" class="el_master_article_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <td<?= $Page->size_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_size_code" class="el_master_article_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_size_desc" class="el_master_article_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <td<?= $Page->season->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_season" class="el_master_article_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
        <td<?= $Page->price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_article_price" class="el_master_article_price">
<span<?= $Page->price->viewAttributes() ?>>
<?= $Page->price->getViewValue() ?></span>
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

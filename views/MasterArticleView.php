<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MasterArticleView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { master_article: currentTable } });
var currentForm, currentPageID;
var fmaster_articleview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmaster_articleview = new ew.Form("fmaster_articleview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmaster_articleview;
    loadjs.done("fmaster_articleview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmaster_articleview" id="fmaster_articleview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_article">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_master_article_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_master_article_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_master_article_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gtin->Visible) { // gtin ?>
    <tr id="r_gtin"<?= $Page->gtin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_gtin"><?= $Page->gtin->caption() ?></span></td>
        <td data-name="gtin"<?= $Page->gtin->cellAttributes() ?>>
<span id="el_master_article_gtin">
<span<?= $Page->gtin->viewAttributes() ?>>
<?= $Page->gtin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <tr id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_color_code"><?= $Page->color_code->caption() ?></span></td>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el_master_article_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <tr id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_color_desc"><?= $Page->color_desc->caption() ?></span></td>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_master_article_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <tr id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_size_code"><?= $Page->size_code->caption() ?></span></td>
        <td data-name="size_code"<?= $Page->size_code->cellAttributes() ?>>
<span id="el_master_article_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <tr id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_size_desc"><?= $Page->size_desc->caption() ?></span></td>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_master_article_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
    <tr id="r_season"<?= $Page->season->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_season"><?= $Page->season->caption() ?></span></td>
        <td data-name="season"<?= $Page->season->cellAttributes() ?>>
<span id="el_master_article_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
    <tr id="r_price"<?= $Page->price->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_article_price"><?= $Page->price->caption() ?></span></td>
        <td data-name="price"<?= $Page->price->cellAttributes() ?>>
<span id="el_master_article_price">
<span<?= $Page->price->viewAttributes() ?>>
<?= $Page->price->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

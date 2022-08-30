<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ExtraStockView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { extra_stock: currentTable } });
var currentForm, currentPageID;
var fextra_stockview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fextra_stockview = new ew.Form("fextra_stockview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fextra_stockview;
    loadjs.done("fextra_stockview");
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
<form name="fextra_stockview" id="fextra_stockview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="extra_stock">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_extra_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->week->Visible) { // week ?>
    <tr id="r_week"<?= $Page->week->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_week"><?= $Page->week->caption() ?></span></td>
        <td data-name="week"<?= $Page->week->cellAttributes() ?>>
<span id="el_extra_stock_week">
<span<?= $Page->week->viewAttributes() ?>>
<?= $Page->week->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->art6->Visible) { // art6 ?>
    <tr id="r_art6"<?= $Page->art6->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_art6"><?= $Page->art6->caption() ?></span></td>
        <td data-name="art6"<?= $Page->art6->cellAttributes() ?>>
<span id="el_extra_stock_art6">
<span<?= $Page->art6->viewAttributes() ?>>
<?= $Page->art6->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->art9->Visible) { // art9 ?>
    <tr id="r_art9"<?= $Page->art9->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_art9"><?= $Page->art9->caption() ?></span></td>
        <td data-name="art9"<?= $Page->art9->cellAttributes() ?>>
<span id="el_extra_stock_art9">
<span<?= $Page->art9->viewAttributes() ?>>
<?= $Page->art9->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->art11->Visible) { // art11 ?>
    <tr id="r_art11"<?= $Page->art11->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_art11"><?= $Page->art11->caption() ?></span></td>
        <td data-name="art11"<?= $Page->art11->cellAttributes() ?>>
<span id="el_extra_stock_art11">
<span<?= $Page->art11->viewAttributes() ?>>
<?= $Page->art11->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_extra_stock_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <tr id="r_location"<?= $Page->location->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_location"><?= $Page->location->caption() ?></span></td>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el_extra_stock_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <tr id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_ctn"><?= $Page->ctn->caption() ?></span></td>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el_extra_stock_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_extra_stock_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_extra_stock_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <tr id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_size_desc"><?= $Page->size_desc->caption() ?></span></td>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_extra_stock_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <tr id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_color_code"><?= $Page->color_code->caption() ?></span></td>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el_extra_stock_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <tr id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_color_desc"><?= $Page->color_desc->caption() ?></span></td>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_extra_stock_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
    <tr id="r_season"<?= $Page->season->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_season"><?= $Page->season->caption() ?></span></td>
        <td data-name="season"<?= $Page->season->cellAttributes() ?>>
<span id="el_extra_stock_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
    <tr id="r_no_box"<?= $Page->no_box->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_no_box"><?= $Page->no_box->caption() ?></span></td>
        <td data-name="no_box"<?= $Page->no_box->cellAttributes() ?>>
<span id="el_extra_stock_no_box">
<span<?= $Page->no_box->viewAttributes() ?>>
<?= $Page->no_box->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_2nd->Visible) { // location_2nd ?>
    <tr id="r_location_2nd"<?= $Page->location_2nd->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_location_2nd"><?= $Page->location_2nd->caption() ?></span></td>
        <td data-name="location_2nd"<?= $Page->location_2nd->cellAttributes() ?>>
<span id="el_extra_stock_location_2nd">
<span<?= $Page->location_2nd->viewAttributes() ?>>
<?= $Page->location_2nd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_extra_stock_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_extra_stock_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_extra_stock_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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

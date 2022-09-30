<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StockCountView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock_count: currentTable } });
var currentForm, currentPageID;
var fstock_countview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstock_countview = new ew.Form("fstock_countview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fstock_countview;
    loadjs.done("fstock_countview");
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
<form name="fstock_countview" id="fstock_countview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stock_count">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_stock_count_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <tr id="r_location"<?= $Page->location->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_location"><?= $Page->location->caption() ?></span></td>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el_stock_count_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
    <tr id="r_scan"<?= $Page->scan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_scan"><?= $Page->scan->caption() ?></span></td>
        <td data-name="scan"<?= $Page->scan->cellAttributes() ?>>
<span id="el_stock_count_scan">
<span<?= $Page->scan->viewAttributes() ?>>
<?= $Page->scan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_stock_count_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user"<?= $Page->user->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el_stock_count_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
    <tr id="r_divisi"<?= $Page->divisi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_divisi"><?= $Page->divisi->caption() ?></span></td>
        <td data-name="divisi"<?= $Page->divisi->cellAttributes() ?>>
<span id="el_stock_count_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_stock_count_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
    <tr id="r_time_created"<?= $Page->time_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_time_created"><?= $Page->time_created->caption() ?></span></td>
        <td data-name="time_created"<?= $Page->time_created->cellAttributes() ?>>
<span id="el_stock_count_time_created">
<span<?= $Page->time_created->viewAttributes() ?>>
<?= $Page->time_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->get_total->Visible) { // get_total ?>
    <tr id="r_get_total"<?= $Page->get_total->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_count_get_total"><?= $Page->get_total->caption() ?></span></td>
        <td data-name="get_total"<?= $Page->get_total->cellAttributes() ?>>
<span id="el_stock_count_get_total">
<span<?= $Page->get_total->viewAttributes() ?>>
<?= $Page->get_total->getViewValue() ?></span>
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

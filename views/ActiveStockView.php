<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ActiveStockView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { active_stock: currentTable } });
var currentForm, currentPageID;
var factive_stockview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    factive_stockview = new ew.Form("factive_stockview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = factive_stockview;
    loadjs.done("factive_stockview");
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
<form name="factive_stockview" id="factive_stockview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="active_stock">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->aisle->Visible) { // aisle ?>
    <tr id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_active_stock_aisle"><?= $Page->aisle->caption() ?></span></td>
        <td data-name="aisle"<?= $Page->aisle->cellAttributes() ?>>
<span id="el_active_stock_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->active_bin->Visible) { // active_bin ?>
    <tr id="r_active_bin"<?= $Page->active_bin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_active_stock_active_bin"><?= $Page->active_bin->caption() ?></span></td>
        <td data-name="active_bin"<?= $Page->active_bin->cellAttributes() ?>>
<span id="el_active_stock_active_bin">
<span<?= $Page->active_bin->viewAttributes() ?>>
<?= $Page->active_bin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_stock->Visible) { // total_stock ?>
    <tr id="r_total_stock"<?= $Page->total_stock->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_active_stock_total_stock"><?= $Page->total_stock->caption() ?></span></td>
        <td data-name="total_stock"<?= $Page->total_stock->cellAttributes() ?>>
<span id="el_active_stock_total_stock">
<span<?= $Page->total_stock->viewAttributes() ?>>
<?= $Page->total_stock->getViewValue() ?></span>
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

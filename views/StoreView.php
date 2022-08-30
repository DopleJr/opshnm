<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StoreView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { store: currentTable } });
var currentForm, currentPageID;
var fstoreview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstoreview = new ew.Form("fstoreview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fstoreview;
    loadjs.done("fstoreview");
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
<form name="fstoreview" id="fstoreview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="store">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_store_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_store_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <tr id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_store_store_code"><?= $Page->store_code->caption() ?></span></td>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<span id="el_store_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <tr id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_store_store_name"><?= $Page->store_name->caption() ?></span></td>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el_store_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->totes->Visible) { // totes ?>
    <tr id="r_totes"<?= $Page->totes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_store_totes"><?= $Page->totes->caption() ?></span></td>
        <td data-name="totes"<?= $Page->totes->cellAttributes() ?>>
<span id="el_store_totes">
<span<?= $Page->totes->viewAttributes() ?>>
<?= $Page->totes->getViewValue() ?></span>
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

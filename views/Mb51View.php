<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$Mb51View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { mb51: currentTable } });
var currentForm, currentPageID;
var fmb51view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmb51view = new ew.Form("fmb51view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmb51view;
    loadjs.done("fmb51view");
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
<form name="fmb51view" id="fmb51view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mb51">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_mb51_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_mb51_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_mb51_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
    <tr id="r_reference"<?= $Page->reference->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_reference"><?= $Page->reference->caption() ?></span></td>
        <td data-name="reference"<?= $Page->reference->cellAttributes() ?>>
<span id="el_mb51_reference">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rcvsite->Visible) { // rcvsite ?>
    <tr id="r_rcvsite"<?= $Page->rcvsite->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_rcvsite"><?= $Page->rcvsite->caption() ?></span></td>
        <td data-name="rcvsite"<?= $Page->rcvsite->cellAttributes() ?>>
<span id="el_mb51_rcvsite">
<span<?= $Page->rcvsite->viewAttributes() ?>>
<?= $Page->rcvsite->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->do_type->Visible) { // do_type ?>
    <tr id="r_do_type"<?= $Page->do_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_do_type"><?= $Page->do_type->caption() ?></span></td>
        <td data-name="do_type"<?= $Page->do_type->cellAttributes() ?>>
<span id="el_mb51_do_type">
<span<?= $Page->do_type->viewAttributes() ?>>
<?= $Page->do_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <tr id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mb51_concept"><?= $Page->concept->caption() ?></span></td>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el_mb51_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
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

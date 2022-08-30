<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpickView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpickview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffinding_shortpickview = new ew.Form("ffinding_shortpickview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ffinding_shortpickview;
    loadjs.done("ffinding_shortpickview");
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
<form name="ffinding_shortpickview" id="ffinding_shortpickview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_finding_shortpick_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <tr id="r_location"<?= $Page->location->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_location"><?= $Page->location->caption() ?></span></td>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el_finding_shortpick_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_finding_shortpick_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_finding_shortpick_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
    <tr id="r_target_quantity"<?= $Page->target_quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_target_quantity"><?= $Page->target_quantity->caption() ?></span></td>
        <td data-name="target_quantity"<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick_target_quantity">
<span<?= $Page->target_quantity->viewAttributes() ?>>
<?= $Page->target_quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
    <tr id="r_pick_quantity"<?= $Page->pick_quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_pick_quantity"><?= $Page->pick_quantity->caption() ?></span></td>
        <td data-name="pick_quantity"<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick_pick_quantity">
<span<?= $Page->pick_quantity->viewAttributes() ?>>
<?= $Page->pick_quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
    <tr id="r_shortpick"<?= $Page->shortpick->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_shortpick"><?= $Page->shortpick->caption() ?></span></td>
        <td data-name="shortpick"<?= $Page->shortpick->cellAttributes() ?>>
<span id="el_finding_shortpick_shortpick">
<span<?= $Page->shortpick->viewAttributes() ?>>
<?= $Page->shortpick->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user"<?= $Page->user->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el_finding_shortpick_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <tr id="r_area"<?= $Page->area->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_area"><?= $Page->area->caption() ?></span></td>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el_finding_shortpick_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_finding_shortpick_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <tr id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_date_upload"><?= $Page->date_upload->caption() ?></span></td>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_finding_shortpick_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
    <tr id="r_date_picking"<?= $Page->date_picking->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick_date_picking"><?= $Page->date_picking->caption() ?></span></td>
        <td data-name="date_picking"<?= $Page->date_picking->cellAttributes() ?>>
<span id="el_finding_shortpick_date_picking">
<span<?= $Page->date_picking->viewAttributes() ?>>
<?= $Page->date_picking->getViewValue() ?></span>
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

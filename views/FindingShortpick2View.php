<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpick2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick2: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpick2view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffinding_shortpick2view = new ew.Form("ffinding_shortpick2view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ffinding_shortpick2view;
    loadjs.done("ffinding_shortpick2view");
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
<form name="ffinding_shortpick2view" id="ffinding_shortpick2view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_finding_shortpick2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <tr id="r_location"<?= $Page->location->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_location"><?= $Page->location->caption() ?></span></td>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el_finding_shortpick2_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <tr id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_ctn"><?= $Page->ctn->caption() ?></span></td>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el_finding_shortpick2_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_finding_shortpick2_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_finding_shortpick2_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->avaiable->Visible) { // avaiable ?>
    <tr id="r_avaiable"<?= $Page->avaiable->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_avaiable"><?= $Page->avaiable->caption() ?></span></td>
        <td data-name="avaiable"<?= $Page->avaiable->cellAttributes() ?>>
<span id="el_finding_shortpick2_avaiable">
<span<?= $Page->avaiable->viewAttributes() ?>>
<?= $Page->avaiable->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
    <tr id="r_web"<?= $Page->web->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_web"><?= $Page->web->caption() ?></span></td>
        <td data-name="web"<?= $Page->web->cellAttributes() ?>>
<span id="el_finding_shortpick2_web">
<span<?= $Page->web->viewAttributes() ?>>
<?= $Page->web->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
    <tr id="r_target_quantity"<?= $Page->target_quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_target_quantity"><?= $Page->target_quantity->caption() ?></span></td>
        <td data-name="target_quantity"<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick2_target_quantity">
<span<?= $Page->target_quantity->viewAttributes() ?>>
<?= $Page->target_quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
    <tr id="r_shortpick"<?= $Page->shortpick->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_shortpick"><?= $Page->shortpick->caption() ?></span></td>
        <td data-name="shortpick"<?= $Page->shortpick->cellAttributes() ?>>
<span id="el_finding_shortpick2_shortpick">
<span<?= $Page->shortpick->viewAttributes() ?>>
<?= $Page->shortpick->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
    <tr id="r_actual"<?= $Page->actual->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_actual"><?= $Page->actual->caption() ?></span></td>
        <td data-name="actual"<?= $Page->actual->cellAttributes() ?>>
<span id="el_finding_shortpick2_actual">
<span<?= $Page->actual->viewAttributes() ?>>
<?= $Page->actual->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
    <tr id="r_pick_quantity"<?= $Page->pick_quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_pick_quantity"><?= $Page->pick_quantity->caption() ?></span></td>
        <td data-name="pick_quantity"<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick2_pick_quantity">
<span<?= $Page->pick_quantity->viewAttributes() ?>>
<?= $Page->pick_quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
    <tr id="r_excess"<?= $Page->excess->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_excess"><?= $Page->excess->caption() ?></span></td>
        <td data-name="excess"<?= $Page->excess->cellAttributes() ?>>
<span id="el_finding_shortpick2_excess">
<span<?= $Page->excess->viewAttributes() ?>>
<?= $Page->excess->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user"<?= $Page->user->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el_finding_shortpick2_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <tr id="r_area"<?= $Page->area->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_area"><?= $Page->area->caption() ?></span></td>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el_finding_shortpick2_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_finding_shortpick2_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
    <tr id="r_date_shortpick"<?= $Page->date_shortpick->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_date_shortpick"><?= $Page->date_shortpick->caption() ?></span></td>
        <td data-name="date_shortpick"<?= $Page->date_shortpick->cellAttributes() ?>>
<span id="el_finding_shortpick2_date_shortpick">
<span<?= $Page->date_shortpick->viewAttributes() ?>>
<?= $Page->date_shortpick->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <tr id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_date_upload"><?= $Page->date_upload->caption() ?></span></td>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_finding_shortpick2_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
    <tr id="r_date_picking"<?= $Page->date_picking->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_date_picking"><?= $Page->date_picking->caption() ?></span></td>
        <td data-name="date_picking"<?= $Page->date_picking->cellAttributes() ?>>
<span id="el_finding_shortpick2_date_picking">
<span<?= $Page->date_picking->viewAttributes() ?>>
<?= $Page->date_picking->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time_picking->Visible) { // time_picking ?>
    <tr id="r_time_picking"<?= $Page->time_picking->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_finding_shortpick2_time_picking"><?= $Page->time_picking->caption() ?></span></td>
        <td data-name="time_picking"<?= $Page->time_picking->cellAttributes() ?>>
<span id="el_finding_shortpick2_time_picking">
<span<?= $Page->time_picking->viewAttributes() ?>>
<?= $Page->time_picking->getViewValue() ?></span>
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

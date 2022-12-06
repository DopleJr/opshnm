<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferbinView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transferbin: currentTable } });
var currentForm, currentPageID;
var ftransferbinview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransferbinview = new ew.Form("ftransferbinview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ftransferbinview;
    loadjs.done("ftransferbinview");
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
<form name="ftransferbinview" id="ftransferbinview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transferbin">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_transferbin_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->from_bin->Visible) { // from_bin ?>
    <tr id="r_from_bin"<?= $Page->from_bin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_from_bin"><?= $Page->from_bin->caption() ?></span></td>
        <td data-name="from_bin"<?= $Page->from_bin->cellAttributes() ?>>
<span id="el_transferbin_from_bin">
<span<?= $Page->from_bin->viewAttributes() ?>>
<?= $Page->from_bin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <tr id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_ctn"><?= $Page->ctn->caption() ?></span></td>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el_transferbin_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->to_bin->Visible) { // to_bin ?>
    <tr id="r_to_bin"<?= $Page->to_bin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_to_bin"><?= $Page->to_bin->caption() ?></span></td>
        <td data-name="to_bin"<?= $Page->to_bin->cellAttributes() ?>>
<span id="el_transferbin_to_bin">
<span<?= $Page->to_bin->viewAttributes() ?>>
<?= $Page->to_bin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user"<?= $Page->user->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el_transferbin_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_transferbin_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_transferbin_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
    <tr id="r_time_updated"<?= $Page->time_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transferbin_time_updated"><?= $Page->time_updated->caption() ?></span></td>
        <td data-name="time_updated"<?= $Page->time_updated->cellAttributes() ?>>
<span id="el_transferbin_time_updated">
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
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

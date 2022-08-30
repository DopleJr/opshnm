<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferBinPieceView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transfer_bin_piece: currentTable } });
var currentForm, currentPageID;
var ftransfer_bin_pieceview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransfer_bin_pieceview = new ew.Form("ftransfer_bin_pieceview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ftransfer_bin_pieceview;
    loadjs.done("ftransfer_bin_pieceview");
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
<form name="ftransfer_bin_pieceview" id="ftransfer_bin_pieceview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transfer_bin_piece">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_transfer_bin_piece_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->source_location->Visible) { // source_location ?>
    <tr id="r_source_location"<?= $Page->source_location->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_source_location"><?= $Page->source_location->caption() ?></span></td>
        <td data-name="source_location"<?= $Page->source_location->cellAttributes() ?>>
<span id="el_transfer_bin_piece_source_location">
<span<?= $Page->source_location->viewAttributes() ?>>
<?= $Page->source_location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <tr id="r_article"<?= $Page->article->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_article"><?= $Page->article->caption() ?></span></td>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el_transfer_bin_piece_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
    <tr id="r_destination_location"<?= $Page->destination_location->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_destination_location"><?= $Page->destination_location->caption() ?></span></td>
        <td data-name="destination_location"<?= $Page->destination_location->cellAttributes() ?>>
<span id="el_transfer_bin_piece_destination_location">
<span<?= $Page->destination_location->viewAttributes() ?>>
<?= $Page->destination_location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
    <tr id="r_su"<?= $Page->su->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_su"><?= $Page->su->caption() ?></span></td>
        <td data-name="su"<?= $Page->su->cellAttributes() ?>>
<span id="el_transfer_bin_piece_su">
<span<?= $Page->su->viewAttributes() ?>>
<?= $Page->su->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user"<?= $Page->user->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el_transfer_bin_piece_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <tr id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_date_upload"><?= $Page->date_upload->caption() ?></span></td>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_transfer_bin_piece_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
    <tr id="r_date_confirmation"<?= $Page->date_confirmation->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transfer_bin_piece_date_confirmation"><?= $Page->date_confirmation->caption() ?></span></td>
        <td data-name="date_confirmation"<?= $Page->date_confirmation->cellAttributes() ?>>
<span id="el_transfer_bin_piece_date_confirmation">
<span<?= $Page->date_confirmation->viewAttributes() ?>>
<?= $Page->date_confirmation->getViewValue() ?></span>
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

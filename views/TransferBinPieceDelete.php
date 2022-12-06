<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferBinPieceDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transfer_bin_piece: currentTable } });
var currentForm, currentPageID;
var ftransfer_bin_piecedelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransfer_bin_piecedelete = new ew.Form("ftransfer_bin_piecedelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftransfer_bin_piecedelete;
    loadjs.done("ftransfer_bin_piecedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftransfer_bin_piecedelete" id="ftransfer_bin_piecedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transfer_bin_piece">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_transfer_bin_piece_id" class="transfer_bin_piece_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->source_location->Visible) { // source_location ?>
        <th class="<?= $Page->source_location->headerCellClass() ?>"><span id="elh_transfer_bin_piece_source_location" class="transfer_bin_piece_source_location"><?= $Page->source_location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_transfer_bin_piece_article" class="transfer_bin_piece_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_transfer_bin_piece_description" class="transfer_bin_piece_description"><?= $Page->description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
        <th class="<?= $Page->destination_location->headerCellClass() ?>"><span id="elh_transfer_bin_piece_destination_location" class="transfer_bin_piece_destination_location"><?= $Page->destination_location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
        <th class="<?= $Page->su->headerCellClass() ?>"><span id="elh_transfer_bin_piece_su" class="transfer_bin_piece_su"><?= $Page->su->caption() ?></span></th>
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
        <th class="<?= $Page->qty->headerCellClass() ?>"><span id="elh_transfer_bin_piece_qty" class="transfer_bin_piece_qty"><?= $Page->qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <th class="<?= $Page->actual->headerCellClass() ?>"><span id="elh_transfer_bin_piece_actual" class="transfer_bin_piece_actual"><?= $Page->actual->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_transfer_bin_piece_user" class="transfer_bin_piece_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_transfer_bin_piece_status" class="transfer_bin_piece_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th class="<?= $Page->date_upload->headerCellClass() ?>"><span id="elh_transfer_bin_piece_date_upload" class="transfer_bin_piece_date_upload"><?= $Page->date_upload->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
        <th class="<?= $Page->date_confirmation->headerCellClass() ?>"><span id="elh_transfer_bin_piece_date_confirmation" class="transfer_bin_piece_date_confirmation"><?= $Page->date_confirmation->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
        <th class="<?= $Page->time_confirmation->headerCellClass() ?>"><span id="elh_transfer_bin_piece_time_confirmation" class="transfer_bin_piece_time_confirmation"><?= $Page->time_confirmation->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_id" class="el_transfer_bin_piece_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->source_location->Visible) { // source_location ?>
        <td<?= $Page->source_location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_source_location" class="el_transfer_bin_piece_source_location">
<span<?= $Page->source_location->viewAttributes() ?>>
<?= $Page->source_location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_article" class="el_transfer_bin_piece_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_description" class="el_transfer_bin_piece_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
        <td<?= $Page->destination_location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_destination_location" class="el_transfer_bin_piece_destination_location">
<span<?= $Page->destination_location->viewAttributes() ?>>
<?= $Page->destination_location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
        <td<?= $Page->su->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_su" class="el_transfer_bin_piece_su">
<span<?= $Page->su->viewAttributes() ?>>
<?= $Page->su->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
        <td<?= $Page->qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_qty" class="el_transfer_bin_piece_qty">
<span<?= $Page->qty->viewAttributes() ?>>
<?= $Page->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <td<?= $Page->actual->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_actual" class="el_transfer_bin_piece_actual">
<span<?= $Page->actual->viewAttributes() ?>>
<?= $Page->actual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_user" class="el_transfer_bin_piece_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_status" class="el_transfer_bin_piece_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_date_upload" class="el_transfer_bin_piece_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
        <td<?= $Page->date_confirmation->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_date_confirmation" class="el_transfer_bin_piece_date_confirmation">
<span<?= $Page->date_confirmation->viewAttributes() ?>>
<?= $Page->date_confirmation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
        <td<?= $Page->time_confirmation->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_time_confirmation" class="el_transfer_bin_piece_time_confirmation">
<span<?= $Page->time_confirmation->viewAttributes() ?>>
<?= $Page->time_confirmation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>

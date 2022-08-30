<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpick2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick2: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpick2delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffinding_shortpick2delete = new ew.Form("ffinding_shortpick2delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ffinding_shortpick2delete;
    loadjs.done("ffinding_shortpick2delete");
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
<form name="ffinding_shortpick2delete" id="ffinding_shortpick2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick2">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_finding_shortpick2_id" class="finding_shortpick2_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_finding_shortpick2_location" class="finding_shortpick2_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th class="<?= $Page->ctn->headerCellClass() ?>"><span id="elh_finding_shortpick2_ctn" class="finding_shortpick2_ctn"><?= $Page->ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_finding_shortpick2_article" class="finding_shortpick2_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_finding_shortpick2_description" class="finding_shortpick2_description"><?= $Page->description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->avaiable->Visible) { // avaiable ?>
        <th class="<?= $Page->avaiable->headerCellClass() ?>"><span id="elh_finding_shortpick2_avaiable" class="finding_shortpick2_avaiable"><?= $Page->avaiable->caption() ?></span></th>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
        <th class="<?= $Page->web->headerCellClass() ?>"><span id="elh_finding_shortpick2_web" class="finding_shortpick2_web"><?= $Page->web->caption() ?></span></th>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
        <th class="<?= $Page->target_quantity->headerCellClass() ?>"><span id="elh_finding_shortpick2_target_quantity" class="finding_shortpick2_target_quantity"><?= $Page->target_quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
        <th class="<?= $Page->shortpick->headerCellClass() ?>"><span id="elh_finding_shortpick2_shortpick" class="finding_shortpick2_shortpick"><?= $Page->shortpick->caption() ?></span></th>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <th class="<?= $Page->actual->headerCellClass() ?>"><span id="elh_finding_shortpick2_actual" class="finding_shortpick2_actual"><?= $Page->actual->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
        <th class="<?= $Page->pick_quantity->headerCellClass() ?>"><span id="elh_finding_shortpick2_pick_quantity" class="finding_shortpick2_pick_quantity"><?= $Page->pick_quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
        <th class="<?= $Page->excess->headerCellClass() ?>"><span id="elh_finding_shortpick2_excess" class="finding_shortpick2_excess"><?= $Page->excess->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_finding_shortpick2_user" class="finding_shortpick2_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th class="<?= $Page->area->headerCellClass() ?>"><span id="elh_finding_shortpick2_area" class="finding_shortpick2_area"><?= $Page->area->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_finding_shortpick2_status" class="finding_shortpick2_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
        <th class="<?= $Page->date_shortpick->headerCellClass() ?>"><span id="elh_finding_shortpick2_date_shortpick" class="finding_shortpick2_date_shortpick"><?= $Page->date_shortpick->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th class="<?= $Page->date_upload->headerCellClass() ?>"><span id="elh_finding_shortpick2_date_upload" class="finding_shortpick2_date_upload"><?= $Page->date_upload->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
        <th class="<?= $Page->date_picking->headerCellClass() ?>"><span id="elh_finding_shortpick2_date_picking" class="finding_shortpick2_date_picking"><?= $Page->date_picking->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_picking->Visible) { // time_picking ?>
        <th class="<?= $Page->time_picking->headerCellClass() ?>"><span id="elh_finding_shortpick2_time_picking" class="finding_shortpick2_time_picking"><?= $Page->time_picking->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_id" class="el_finding_shortpick2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_location" class="el_finding_shortpick2_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <td<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_ctn" class="el_finding_shortpick2_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_article" class="el_finding_shortpick2_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_description" class="el_finding_shortpick2_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->avaiable->Visible) { // avaiable ?>
        <td<?= $Page->avaiable->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_avaiable" class="el_finding_shortpick2_avaiable">
<span<?= $Page->avaiable->viewAttributes() ?>>
<?= $Page->avaiable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
        <td<?= $Page->web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_web" class="el_finding_shortpick2_web">
<span<?= $Page->web->viewAttributes() ?>>
<?= $Page->web->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
        <td<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_target_quantity" class="el_finding_shortpick2_target_quantity">
<span<?= $Page->target_quantity->viewAttributes() ?>>
<?= $Page->target_quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
        <td<?= $Page->shortpick->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_shortpick" class="el_finding_shortpick2_shortpick">
<span<?= $Page->shortpick->viewAttributes() ?>>
<?= $Page->shortpick->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <td<?= $Page->actual->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_actual" class="el_finding_shortpick2_actual">
<span<?= $Page->actual->viewAttributes() ?>>
<?= $Page->actual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
        <td<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_pick_quantity" class="el_finding_shortpick2_pick_quantity">
<span<?= $Page->pick_quantity->viewAttributes() ?>>
<?= $Page->pick_quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
        <td<?= $Page->excess->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_excess" class="el_finding_shortpick2_excess">
<span<?= $Page->excess->viewAttributes() ?>>
<?= $Page->excess->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_user" class="el_finding_shortpick2_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <td<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_area" class="el_finding_shortpick2_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_status" class="el_finding_shortpick2_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
        <td<?= $Page->date_shortpick->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_date_shortpick" class="el_finding_shortpick2_date_shortpick">
<span<?= $Page->date_shortpick->viewAttributes() ?>>
<?= $Page->date_shortpick->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_date_upload" class="el_finding_shortpick2_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
        <td<?= $Page->date_picking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_date_picking" class="el_finding_shortpick2_date_picking">
<span<?= $Page->date_picking->viewAttributes() ?>>
<?= $Page->date_picking->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_picking->Visible) { // time_picking ?>
        <td<?= $Page->time_picking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_time_picking" class="el_finding_shortpick2_time_picking">
<span<?= $Page->time_picking->viewAttributes() ?>>
<?= $Page->time_picking->getViewValue() ?></span>
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

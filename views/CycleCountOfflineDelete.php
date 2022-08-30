<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CycleCountOfflineDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cycle_count_offline: currentTable } });
var currentForm, currentPageID;
var fcycle_count_offlinedelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcycle_count_offlinedelete = new ew.Form("fcycle_count_offlinedelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcycle_count_offlinedelete;
    loadjs.done("fcycle_count_offlinedelete");
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
<form name="fcycle_count_offlinedelete" id="fcycle_count_offlinedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cycle_count_offline">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_cycle_count_offline_id" class="cycle_count_offline_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_cycle_count_offline_location" class="cycle_count_offline_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
        <th class="<?= $Page->su->headerCellClass() ?>"><span id="elh_cycle_count_offline_su" class="cycle_count_offline_su"><?= $Page->su->caption() ?></span></th>
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
        <th class="<?= $Page->scan->headerCellClass() ?>"><span id="elh_cycle_count_offline_scan" class="cycle_count_offline_scan"><?= $Page->scan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_cycle_count_offline_article" class="cycle_count_offline_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_cycle_count_offline_user" class="cycle_count_offline_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_cycle_count_offline_date_created" class="cycle_count_offline_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_cycle_count_offline_date_updated" class="cycle_count_offline_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_id" class="el_cycle_count_offline_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_location" class="el_cycle_count_offline_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
        <td<?= $Page->su->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_su" class="el_cycle_count_offline_su">
<span<?= $Page->su->viewAttributes() ?>>
<?= $Page->su->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
        <td<?= $Page->scan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_scan" class="el_cycle_count_offline_scan">
<span<?= $Page->scan->viewAttributes() ?>>
<?= $Page->scan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_article" class="el_cycle_count_offline_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_user" class="el_cycle_count_offline_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_date_created" class="el_cycle_count_offline_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cycle_count_offline_date_updated" class="el_cycle_count_offline_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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

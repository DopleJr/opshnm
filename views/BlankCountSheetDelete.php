<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BlankCountSheetDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { blank_count_sheet: currentTable } });
var currentForm, currentPageID;
var fblank_count_sheetdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fblank_count_sheetdelete = new ew.Form("fblank_count_sheetdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fblank_count_sheetdelete;
    loadjs.done("fblank_count_sheetdelete");
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
<form name="fblank_count_sheetdelete" id="fblank_count_sheetdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="blank_count_sheet">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_blank_count_sheet_id" class="blank_count_sheet_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_blank_count_sheet_location" class="blank_count_sheet_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th class="<?= $Page->ctn->headerCellClass() ?>"><span id="elh_blank_count_sheet_ctn" class="blank_count_sheet_ctn"><?= $Page->ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_blank_count_sheet_article" class="blank_count_sheet_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_blank_count_sheet_description" class="blank_count_sheet_description"><?= $Page->description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th class="<?= $Page->size_desc->headerCellClass() ?>"><span id="elh_blank_count_sheet_size_desc" class="blank_count_sheet_size_desc"><?= $Page->size_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th class="<?= $Page->color_code->headerCellClass() ?>"><span id="elh_blank_count_sheet_color_code" class="blank_count_sheet_color_code"><?= $Page->color_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th class="<?= $Page->color_desc->headerCellClass() ?>"><span id="elh_blank_count_sheet_color_desc" class="blank_count_sheet_color_desc"><?= $Page->color_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <th class="<?= $Page->season->headerCellClass() ?>"><span id="elh_blank_count_sheet_season" class="blank_count_sheet_season"><?= $Page->season->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_blank_count_sheet_quantity" class="blank_count_sheet_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_blank_count_sheet_user" class="blank_count_sheet_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_blank_count_sheet_date_created" class="blank_count_sheet_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_blank_count_sheet_date_updated" class="blank_count_sheet_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_id" class="el_blank_count_sheet_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_location" class="el_blank_count_sheet_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <td<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_ctn" class="el_blank_count_sheet_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_article" class="el_blank_count_sheet_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_description" class="el_blank_count_sheet_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_size_desc" class="el_blank_count_sheet_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <td<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_color_code" class="el_blank_count_sheet_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_color_desc" class="el_blank_count_sheet_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <td<?= $Page->season->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_season" class="el_blank_count_sheet_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_quantity" class="el_blank_count_sheet_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_user" class="el_blank_count_sheet_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_date_created" class="el_blank_count_sheet_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_blank_count_sheet_date_updated" class="el_blank_count_sheet_date_updated">
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

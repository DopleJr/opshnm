<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ExtraStockDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { extra_stock: currentTable } });
var currentForm, currentPageID;
var fextra_stockdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fextra_stockdelete = new ew.Form("fextra_stockdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fextra_stockdelete;
    loadjs.done("fextra_stockdelete");
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
<form name="fextra_stockdelete" id="fextra_stockdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="extra_stock">
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
<?php if ($Page->week->Visible) { // week ?>
        <th class="<?= $Page->week->headerCellClass() ?>"><span id="elh_extra_stock_week" class="extra_stock_week"><?= $Page->week->caption() ?></span></th>
<?php } ?>
<?php if ($Page->art6->Visible) { // art6 ?>
        <th class="<?= $Page->art6->headerCellClass() ?>"><span id="elh_extra_stock_art6" class="extra_stock_art6"><?= $Page->art6->caption() ?></span></th>
<?php } ?>
<?php if ($Page->art9->Visible) { // art9 ?>
        <th class="<?= $Page->art9->headerCellClass() ?>"><span id="elh_extra_stock_art9" class="extra_stock_art9"><?= $Page->art9->caption() ?></span></th>
<?php } ?>
<?php if ($Page->art11->Visible) { // art11 ?>
        <th class="<?= $Page->art11->headerCellClass() ?>"><span id="elh_extra_stock_art11" class="extra_stock_art11"><?= $Page->art11->caption() ?></span></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th class="<?= $Page->article->headerCellClass() ?>"><span id="elh_extra_stock_article" class="extra_stock_article"><?= $Page->article->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_extra_stock_location" class="extra_stock_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th class="<?= $Page->ctn->headerCellClass() ?>"><span id="elh_extra_stock_ctn" class="extra_stock_ctn"><?= $Page->ctn->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_extra_stock_quantity" class="extra_stock_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th class="<?= $Page->size_desc->headerCellClass() ?>"><span id="elh_extra_stock_size_desc" class="extra_stock_size_desc"><?= $Page->size_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th class="<?= $Page->color_desc->headerCellClass() ?>"><span id="elh_extra_stock_color_desc" class="extra_stock_color_desc"><?= $Page->color_desc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <th class="<?= $Page->size_code->headerCellClass() ?>"><span id="elh_extra_stock_size_code" class="extra_stock_size_code"><?= $Page->size_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <th class="<?= $Page->season->headerCellClass() ?>"><span id="elh_extra_stock_season" class="extra_stock_season"><?= $Page->season->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
        <th class="<?= $Page->no_box->headerCellClass() ?>"><span id="elh_extra_stock_no_box" class="extra_stock_no_box"><?= $Page->no_box->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location_2nd->Visible) { // location_2nd ?>
        <th class="<?= $Page->location_2nd->headerCellClass() ?>"><span id="elh_extra_stock_location_2nd" class="extra_stock_location_2nd"><?= $Page->location_2nd->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_extra_stock_date_created" class="extra_stock_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_extra_stock_date_updated" class="extra_stock_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->week->Visible) { // week ?>
        <td<?= $Page->week->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_week" class="el_extra_stock_week">
<span<?= $Page->week->viewAttributes() ?>>
<?= $Page->week->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->art6->Visible) { // art6 ?>
        <td<?= $Page->art6->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_art6" class="el_extra_stock_art6">
<span<?= $Page->art6->viewAttributes() ?>>
<?= $Page->art6->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->art9->Visible) { // art9 ?>
        <td<?= $Page->art9->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_art9" class="el_extra_stock_art9">
<span<?= $Page->art9->viewAttributes() ?>>
<?= $Page->art9->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->art11->Visible) { // art11 ?>
        <td<?= $Page->art11->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_art11" class="el_extra_stock_art11">
<span<?= $Page->art11->viewAttributes() ?>>
<?= $Page->art11->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <td<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_article" class="el_extra_stock_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_location" class="el_extra_stock_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <td<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_ctn" class="el_extra_stock_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_quantity" class="el_extra_stock_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_size_desc" class="el_extra_stock_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_color_desc" class="el_extra_stock_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <td<?= $Page->size_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_size_code" class="el_extra_stock_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <td<?= $Page->season->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_season" class="el_extra_stock_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
        <td<?= $Page->no_box->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_no_box" class="el_extra_stock_no_box">
<span<?= $Page->no_box->viewAttributes() ?>>
<?= $Page->no_box->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location_2nd->Visible) { // location_2nd ?>
        <td<?= $Page->location_2nd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_location_2nd" class="el_extra_stock_location_2nd">
<span<?= $Page->location_2nd->viewAttributes() ?>>
<?= $Page->location_2nd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_date_created" class="el_extra_stock_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_date_updated" class="el_extra_stock_date_updated">
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

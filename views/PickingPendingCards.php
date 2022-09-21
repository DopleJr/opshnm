<?php
namespace PHPMaker2022\opsmezzanineupload;
?>
<div class="ew-multi-column-grid">
<?php $Page->LayoutOptions->render("body") ?>
<?php if (!$Page->isExport()) { ?>
<div>
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="fpicking_pendinglist" id="fpicking_pendinglist" class="ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking_pending">
<div class="<?= $Page->getMultiColumnRowClass() ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_picking_pending",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
<div class="<?= $Page->getMultiColumnColClass() ?>" <?= $Page->rowAttributes() ?>>
<div class="<?= $Page->MultiColumnCardClass ?>">
    <?php if (StartsText("top", $Page->MultiColumnListOptionsPosition)) { ?>
    <div class="card-header">
        <div class="ew-multi-column-list-option ew-<?= $Page->MultiColumnListOptionsPosition ?>">
<?php
// Render list options (body, bottom)
$Page->ListOptions->Tag = "div";
$Page->ListOptions->render("body", $Page->MultiColumnListOptionsPosition, $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
    </div>
    <?php } ?>
    <div class="card-body">
    <?php if ($Page->id->Visible) { // id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_id">
            <div class="col col-sm-4 picking_pending_id"><?= $Page->renderFieldHeader($Page->id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->id->cellAttributes() ?>>
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->po_no->Visible) { // po_no ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_po_no">
            <div class="col col-sm-4 picking_pending_po_no"><?= $Page->renderFieldHeader($Page->po_no) ?></div>
            <div class="col col-sm-8"><div<?= $Page->po_no->cellAttributes() ?>>
<span<?= $Page->po_no->viewAttributes() ?>>
<?= $Page->po_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_po_no">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->po_no->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->po_no->cellAttributes() ?>>
<span<?= $Page->po_no->viewAttributes() ?>>
<?= $Page->po_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->to_no->Visible) { // to_no ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_to_no">
            <div class="col col-sm-4 picking_pending_to_no"><?= $Page->renderFieldHeader($Page->to_no) ?></div>
            <div class="col col-sm-8"><div<?= $Page->to_no->cellAttributes() ?>>
<span<?= $Page->to_no->viewAttributes() ?>>
<?= $Page->to_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_to_no">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_no->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_no->cellAttributes() ?>>
<span<?= $Page->to_no->viewAttributes() ?>>
<?= $Page->to_no->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_to_order_item">
            <div class="col col-sm-4 picking_pending_to_order_item"><?= $Page->renderFieldHeader($Page->to_order_item) ?></div>
            <div class="col col-sm-8"><div<?= $Page->to_order_item->cellAttributes() ?>>
<span<?= $Page->to_order_item->viewAttributes() ?>>
<?= $Page->to_order_item->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_to_order_item">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_order_item->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_order_item->cellAttributes() ?>>
<span<?= $Page->to_order_item->viewAttributes() ?>>
<?= $Page->to_order_item->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->to_priority->Visible) { // to_priority ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_to_priority">
            <div class="col col-sm-4 picking_pending_to_priority"><?= $Page->renderFieldHeader($Page->to_priority) ?></div>
            <div class="col col-sm-8"><div<?= $Page->to_priority->cellAttributes() ?>>
<span<?= $Page->to_priority->viewAttributes() ?>>
<?= $Page->to_priority->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_to_priority">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_priority->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_priority->cellAttributes() ?>>
<span<?= $Page->to_priority->viewAttributes() ?>>
<?= $Page->to_priority->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_to_priority_code">
            <div class="col col-sm-4 picking_pending_to_priority_code"><?= $Page->renderFieldHeader($Page->to_priority_code) ?></div>
            <div class="col col-sm-8"><div<?= $Page->to_priority_code->cellAttributes() ?>>
<span<?= $Page->to_priority_code->viewAttributes() ?>>
<?= $Page->to_priority_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_to_priority_code">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_priority_code->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_priority_code->cellAttributes() ?>>
<span<?= $Page->to_priority_code->viewAttributes() ?>>
<?= $Page->to_priority_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_source_storage_type">
            <div class="col col-sm-4 picking_pending_source_storage_type"><?= $Page->renderFieldHeader($Page->source_storage_type) ?></div>
            <div class="col col-sm-8"><div<?= $Page->source_storage_type->cellAttributes() ?>>
<span<?= $Page->source_storage_type->viewAttributes() ?>>
<?= $Page->source_storage_type->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_source_storage_type">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->source_storage_type->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_storage_type->cellAttributes() ?>>
<span<?= $Page->source_storage_type->viewAttributes() ?>>
<?= $Page->source_storage_type->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_source_storage_bin">
            <div class="col col-sm-4 picking_pending_source_storage_bin"><?= $Page->renderFieldHeader($Page->source_storage_bin) ?></div>
            <div class="col col-sm-8"><div<?= $Page->source_storage_bin->cellAttributes() ?>>
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<?= $Page->source_storage_bin->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_source_storage_bin">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->source_storage_bin->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_storage_bin->cellAttributes() ?>>
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<?= $Page->source_storage_bin->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->carton_number->Visible) { // carton_number ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_carton_number">
            <div class="col col-sm-4 picking_pending_carton_number"><?= $Page->renderFieldHeader($Page->carton_number) ?></div>
            <div class="col col-sm-8"><div<?= $Page->carton_number->cellAttributes() ?>>
<span<?= $Page->carton_number->viewAttributes() ?>>
<?= $Page->carton_number->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_carton_number">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->carton_number->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->carton_number->cellAttributes() ?>>
<span<?= $Page->carton_number->viewAttributes() ?>>
<?= $Page->carton_number->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->creation_date->Visible) { // creation_date ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_creation_date">
            <div class="col col-sm-4 picking_pending_creation_date"><?= $Page->renderFieldHeader($Page->creation_date) ?></div>
            <div class="col col-sm-8"><div<?= $Page->creation_date->cellAttributes() ?>>
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_creation_date">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->creation_date->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->creation_date->cellAttributes() ?>>
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->gr_number->Visible) { // gr_number ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_gr_number">
            <div class="col col-sm-4 picking_pending_gr_number"><?= $Page->renderFieldHeader($Page->gr_number) ?></div>
            <div class="col col-sm-8"><div<?= $Page->gr_number->cellAttributes() ?>>
<span<?= $Page->gr_number->viewAttributes() ?>>
<?= $Page->gr_number->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_gr_number">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->gr_number->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gr_number->cellAttributes() ?>>
<span<?= $Page->gr_number->viewAttributes() ?>>
<?= $Page->gr_number->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->gr_date->Visible) { // gr_date ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_gr_date">
            <div class="col col-sm-4 picking_pending_gr_date"><?= $Page->renderFieldHeader($Page->gr_date) ?></div>
            <div class="col col-sm-8"><div<?= $Page->gr_date->cellAttributes() ?>>
<span<?= $Page->gr_date->viewAttributes() ?>>
<?= $Page->gr_date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_gr_date">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->gr_date->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gr_date->cellAttributes() ?>>
<span<?= $Page->gr_date->viewAttributes() ?>>
<?= $Page->gr_date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->delivery->Visible) { // delivery ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_delivery">
            <div class="col col-sm-4 picking_pending_delivery"><?= $Page->renderFieldHeader($Page->delivery) ?></div>
            <div class="col col-sm-8"><div<?= $Page->delivery->cellAttributes() ?>>
<span<?= $Page->delivery->viewAttributes() ?>>
<?= $Page->delivery->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_delivery">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->delivery->cellAttributes() ?>>
<span<?= $Page->delivery->viewAttributes() ?>>
<?= $Page->delivery->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_store_id">
            <div class="col col-sm-4 picking_pending_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->store_id->cellAttributes() ?>>
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_store_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_store_name">
            <div class="col col-sm-4 picking_pending_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div>
            <div class="col col-sm-8"><div<?= $Page->store_name->cellAttributes() ?>>
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_store_name">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_article">
            <div class="col col-sm-4 picking_pending_article"><?= $Page->renderFieldHeader($Page->article) ?></div>
            <div class="col col-sm-8"><div<?= $Page->article->cellAttributes() ?>>
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_article">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->size_code->Visible) { // size_code ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_size_code">
            <div class="col col-sm-4 picking_pending_size_code"><?= $Page->renderFieldHeader($Page->size_code) ?></div>
            <div class="col col-sm-8"><div<?= $Page->size_code->cellAttributes() ?>>
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_size_code">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_code->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_code->cellAttributes() ?>>
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_size_desc">
            <div class="col col-sm-4 picking_pending_size_desc"><?= $Page->renderFieldHeader($Page->size_desc) ?></div>
            <div class="col col-sm-8"><div<?= $Page->size_desc->cellAttributes() ?>>
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_size_desc">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_desc->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_desc->cellAttributes() ?>>
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_color_code">
            <div class="col col-sm-4 picking_pending_color_code"><?= $Page->renderFieldHeader($Page->color_code) ?></div>
            <div class="col col-sm-8"><div<?= $Page->color_code->cellAttributes() ?>>
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_color_code">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_code->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_code->cellAttributes() ?>>
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->color_desc->Visible) { // color_desc ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_color_desc">
            <div class="col col-sm-4 picking_pending_color_desc"><?= $Page->renderFieldHeader($Page->color_desc) ?></div>
            <div class="col col-sm-8"><div<?= $Page->color_desc->cellAttributes() ?>>
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_color_desc">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_desc->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_desc->cellAttributes() ?>>
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_concept">
            <div class="col col-sm-4 picking_pending_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div>
            <div class="col col-sm-8"><div<?= $Page->concept->cellAttributes() ?>>
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_concept">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->concept->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->target_qty->Visible) { // target_qty ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_target_qty">
            <div class="col col-sm-4 picking_pending_target_qty"><?= $Page->renderFieldHeader($Page->target_qty) ?></div>
            <div class="col col-sm-8"><div<?= $Page->target_qty->cellAttributes() ?>>
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_target_qty">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_qty->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_qty->cellAttributes() ?>>
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_picked_qty">
            <div class="col col-sm-4 picking_pending_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div>
            <div class="col col-sm-8"><div<?= $Page->picked_qty->cellAttributes() ?>>
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_picked_qty">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->picked_qty->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_variance_qty">
            <div class="col col-sm-4 picking_pending_variance_qty"><?= $Page->renderFieldHeader($Page->variance_qty) ?></div>
            <div class="col col-sm-8"><div<?= $Page->variance_qty->cellAttributes() ?>>
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_variance_qty">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->variance_qty->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->variance_qty->cellAttributes() ?>>
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_confirmation_date">
            <div class="col col-sm-4 picking_pending_confirmation_date"><?= $Page->renderFieldHeader($Page->confirmation_date) ?></div>
            <div class="col col-sm-8"><div<?= $Page->confirmation_date->cellAttributes() ?>>
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_confirmation_date">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->confirmation_date->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->confirmation_date->cellAttributes() ?>>
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_confirmation_time">
            <div class="col col-sm-4 picking_pending_confirmation_time"><?= $Page->renderFieldHeader($Page->confirmation_time) ?></div>
            <div class="col col-sm-8"><div<?= $Page->confirmation_time->cellAttributes() ?>>
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_confirmation_time">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->confirmation_time->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->confirmation_time->cellAttributes() ?>>
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_box_code">
            <div class="col col-sm-4 picking_pending_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div>
            <div class="col col-sm-8"><div<?= $Page->box_code->cellAttributes() ?>>
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_box_code">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_code->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_code->cellAttributes() ?>>
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->box_type->Visible) { // box_type ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_box_type">
            <div class="col col-sm-4 picking_pending_box_type"><?= $Page->renderFieldHeader($Page->box_type) ?></div>
            <div class="col col-sm-8"><div<?= $Page->box_type->cellAttributes() ?>>
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_box_type">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_type->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_type->cellAttributes() ?>>
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_picker">
            <div class="col col-sm-4 picking_pending_picker"><?= $Page->renderFieldHeader($Page->picker) ?></div>
            <div class="col col-sm-8"><div<?= $Page->picker->cellAttributes() ?>>
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_picker">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->picker->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picker->cellAttributes() ?>>
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_status">
            <div class="col col-sm-4 picking_pending_status"><?= $Page->renderFieldHeader($Page->status) ?></div>
            <div class="col col-sm-8"><div<?= $Page->status->cellAttributes() ?>>
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_status">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->remarks->Visible) { // remarks ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_remarks">
            <div class="col col-sm-4 picking_pending_remarks"><?= $Page->renderFieldHeader($Page->remarks) ?></div>
            <div class="col col-sm-8"><div<?= $Page->remarks->cellAttributes() ?>>
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_remarks">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->remarks->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks->cellAttributes() ?>>
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->aisle->Visible) { // aisle ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_aisle">
            <div class="col col-sm-4 picking_pending_aisle"><?= $Page->renderFieldHeader($Page->aisle) ?></div>
            <div class="col col-sm-8"><div<?= $Page->aisle->cellAttributes() ?>>
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_aisle">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->aisle->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle->cellAttributes() ?>>
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->area->Visible) { // area ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_area">
            <div class="col col-sm-4 picking_pending_area"><?= $Page->renderFieldHeader($Page->area) ?></div>
            <div class="col col-sm-8"><div<?= $Page->area->cellAttributes() ?>>
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_area">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->area->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->aisle2->Visible) { // aisle2 ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_aisle2">
            <div class="col col-sm-4 picking_pending_aisle2"><?= $Page->renderFieldHeader($Page->aisle2) ?></div>
            <div class="col col-sm-8"><div<?= $Page->aisle2->cellAttributes() ?>>
<span<?= $Page->aisle2->viewAttributes() ?>>
<?= $Page->aisle2->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_aisle2">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->aisle2->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle2->cellAttributes() ?>>
<span<?= $Page->aisle2->viewAttributes() ?>>
<?= $Page->aisle2->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->store_id2->Visible) { // store_id2 ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_store_id2">
            <div class="col col-sm-4 picking_pending_store_id2"><?= $Page->renderFieldHeader($Page->store_id2) ?></div>
            <div class="col col-sm-8"><div<?= $Page->store_id2->cellAttributes() ?>>
<span<?= $Page->store_id2->viewAttributes() ?>>
<?= $Page->store_id2->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_store_id2">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_id2->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id2->cellAttributes() ?>>
<span<?= $Page->store_id2->viewAttributes() ?>>
<?= $Page->store_id2->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->close_totes->Visible) { // close_totes ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_close_totes">
            <div class="col col-sm-4 picking_pending_close_totes"><?= $Page->renderFieldHeader($Page->close_totes) ?></div>
            <div class="col col-sm-8"><div<?= $Page->close_totes->cellAttributes() ?>>
<span<?= $Page->close_totes->viewAttributes() ?>>
<?= $Page->close_totes->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_close_totes">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->close_totes->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->close_totes->cellAttributes() ?>>
<span<?= $Page->close_totes->viewAttributes() ?>>
<?= $Page->close_totes->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->job_id->Visible) { // job_id ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_job_id">
            <div class="col col-sm-4 picking_pending_job_id"><?= $Page->renderFieldHeader($Page->job_id) ?></div>
            <div class="col col-sm-8"><div<?= $Page->job_id->cellAttributes() ?>>
<span<?= $Page->job_id->viewAttributes() ?>>
<?= $Page->job_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_job_id">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_id->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_id->cellAttributes() ?>>
<span<?= $Page->job_id->viewAttributes() ?>>
<?= $Page->job_id->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->sequence->Visible) { // sequence ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <div class="row picking_pending_sequence">
            <div class="col col-sm-4 picking_pending_sequence"><?= $Page->renderFieldHeader($Page->sequence) ?></div>
            <div class="col col-sm-8"><div<?= $Page->sequence->cellAttributes() ?>>
<span<?= $Page->sequence->viewAttributes() ?>>
<?= $Page->sequence->getViewValue() ?></span>
</div></div>
        </div>
        <?php } else { // Add/edit record ?>
        <div class="row picking_pending_sequence">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->sequence->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sequence->cellAttributes() ?>>
<span<?= $Page->sequence->viewAttributes() ?>>
<?= $Page->sequence->getViewValue() ?></span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    </div><!-- /.card-body -->
<?php if (!$Page->isExport()) { ?>
    <?php if (StartsText("bottom", $Page->MultiColumnListOptionsPosition)) { ?>
    <div class="card-footer">
        <div class="ew-multi-column-list-option ew-<?= $Page->MultiColumnListOptionsPosition ?>">
<?php
// Render list options (body, bottom)
$Page->ListOptions->Tag = "div";
$Page->ListOptions->render("body", $Page->MultiColumnListOptionsPosition, $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
    </div><!-- /.card-footer -->
    <?php } ?>
<?php } ?>
</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
</div><!-- /.ew-multi-column-grid -->

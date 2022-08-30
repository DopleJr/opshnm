<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking: currentTable } });
var currentForm, currentPageID;
var fpickinglist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpickinglist = new ew.Form("fpickinglist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpickinglist;
    fpickinglist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fpickinglist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fpickinglist.lists.to_no = <?= $Page->to_no->toClientList($Page) ?>;
    fpickinglist.lists.to_order_item = <?= $Page->to_order_item->toClientList($Page) ?>;
    fpickinglist.lists.to_priority = <?= $Page->to_priority->toClientList($Page) ?>;
    fpickinglist.lists.to_priority_code = <?= $Page->to_priority_code->toClientList($Page) ?>;
    fpickinglist.lists.source_storage_type = <?= $Page->source_storage_type->toClientList($Page) ?>;
    fpickinglist.lists.source_storage_bin = <?= $Page->source_storage_bin->toClientList($Page) ?>;
    fpickinglist.lists.carton_number = <?= $Page->carton_number->toClientList($Page) ?>;
    fpickinglist.lists.creation_date = <?= $Page->creation_date->toClientList($Page) ?>;
    fpickinglist.lists.gr_number = <?= $Page->gr_number->toClientList($Page) ?>;
    fpickinglist.lists.gr_date = <?= $Page->gr_date->toClientList($Page) ?>;
    fpickinglist.lists.delivery = <?= $Page->delivery->toClientList($Page) ?>;
    fpickinglist.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fpickinglist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fpickinglist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fpickinglist.lists.size_code = <?= $Page->size_code->toClientList($Page) ?>;
    fpickinglist.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    fpickinglist.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    fpickinglist.lists.color_desc = <?= $Page->color_desc->toClientList($Page) ?>;
    fpickinglist.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fpickinglist.lists.target_qty = <?= $Page->target_qty->toClientList($Page) ?>;
    fpickinglist.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fpickinglist.lists.variance_qty = <?= $Page->variance_qty->toClientList($Page) ?>;
    fpickinglist.lists.confirmation_date = <?= $Page->confirmation_date->toClientList($Page) ?>;
    fpickinglist.lists.confirmation_time = <?= $Page->confirmation_time->toClientList($Page) ?>;
    fpickinglist.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fpickinglist.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    fpickinglist.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    fpickinglist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fpickinglist.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    loadjs.done("fpickinglist");
});
var fpickingsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpickingsrch = new ew.Form("fpickingsrch", "list");
    currentSearchForm = fpickingsrch;

    // Add fields
    var fields = currentTable.fields;
    fpickingsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["to_no", [], fields.to_no.isInvalid],
        ["to_order_item", [], fields.to_order_item.isInvalid],
        ["to_priority", [], fields.to_priority.isInvalid],
        ["to_priority_code", [], fields.to_priority_code.isInvalid],
        ["source_storage_type", [], fields.source_storage_type.isInvalid],
        ["source_storage_bin", [], fields.source_storage_bin.isInvalid],
        ["carton_number", [], fields.carton_number.isInvalid],
        ["creation_date", [], fields.creation_date.isInvalid],
        ["y_creation_date", [ew.Validators.between], false],
        ["gr_number", [], fields.gr_number.isInvalid],
        ["gr_date", [], fields.gr_date.isInvalid],
        ["delivery", [], fields.delivery.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["size_code", [], fields.size_code.isInvalid],
        ["size_desc", [], fields.size_desc.isInvalid],
        ["color_code", [], fields.color_code.isInvalid],
        ["color_desc", [], fields.color_desc.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["target_qty", [], fields.target_qty.isInvalid],
        ["picked_qty", [], fields.picked_qty.isInvalid],
        ["variance_qty", [], fields.variance_qty.isInvalid],
        ["confirmation_date", [], fields.confirmation_date.isInvalid],
        ["y_confirmation_date", [ew.Validators.between], false],
        ["confirmation_time", [], fields.confirmation_time.isInvalid],
        ["box_code", [], fields.box_code.isInvalid],
        ["box_type", [], fields.box_type.isInvalid],
        ["picker", [], fields.picker.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["remarks", [], fields.remarks.isInvalid]
    ]);

    // Validate form
    fpickingsrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fpickingsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpickingsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpickingsrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fpickingsrch.lists.po_no = <?= $Page->po_no->toClientList($Page) ?>;
    fpickingsrch.lists.to_no = <?= $Page->to_no->toClientList($Page) ?>;
    fpickingsrch.lists.to_order_item = <?= $Page->to_order_item->toClientList($Page) ?>;
    fpickingsrch.lists.to_priority = <?= $Page->to_priority->toClientList($Page) ?>;
    fpickingsrch.lists.to_priority_code = <?= $Page->to_priority_code->toClientList($Page) ?>;
    fpickingsrch.lists.source_storage_type = <?= $Page->source_storage_type->toClientList($Page) ?>;
    fpickingsrch.lists.source_storage_bin = <?= $Page->source_storage_bin->toClientList($Page) ?>;
    fpickingsrch.lists.carton_number = <?= $Page->carton_number->toClientList($Page) ?>;
    fpickingsrch.lists.creation_date = <?= $Page->creation_date->toClientList($Page) ?>;
    fpickingsrch.lists.gr_number = <?= $Page->gr_number->toClientList($Page) ?>;
    fpickingsrch.lists.gr_date = <?= $Page->gr_date->toClientList($Page) ?>;
    fpickingsrch.lists.delivery = <?= $Page->delivery->toClientList($Page) ?>;
    fpickingsrch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fpickingsrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fpickingsrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fpickingsrch.lists.size_code = <?= $Page->size_code->toClientList($Page) ?>;
    fpickingsrch.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    fpickingsrch.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    fpickingsrch.lists.color_desc = <?= $Page->color_desc->toClientList($Page) ?>;
    fpickingsrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fpickingsrch.lists.target_qty = <?= $Page->target_qty->toClientList($Page) ?>;
    fpickingsrch.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fpickingsrch.lists.variance_qty = <?= $Page->variance_qty->toClientList($Page) ?>;
    fpickingsrch.lists.confirmation_date = <?= $Page->confirmation_date->toClientList($Page) ?>;
    fpickingsrch.lists.confirmation_time = <?= $Page->confirmation_time->toClientList($Page) ?>;
    fpickingsrch.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fpickingsrch.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    fpickingsrch.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    fpickingsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fpickingsrch.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;

    // Filters
    fpickingsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpickingsrch");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fpickingsrch" id="fpickingsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpickingsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="picking">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->id->Visible) { // id ?>
<?php
if (!$Page->id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_id"
            name="x_id[]"
            class="form-control ew-select<?= $Page->id->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_id"
            data-table="picking"
            data-field="x_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"
            <?= $Page->id->editAttributes() ?>>
            <?= $Page->id->selectOptionListHtml("x_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_id",
                selectId: "fpickingsrch_x_id",
                ajax: { id: "x_id", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
<?php
if (!$Page->po_no->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_po_no" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->po_no->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_po_no"
            name="x_po_no[]"
            class="form-control ew-select<?= $Page->po_no->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_po_no"
            data-table="picking"
            data-field="x_po_no"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->po_no->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->po_no->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->po_no->getPlaceHolder()) ?>"
            <?= $Page->po_no->editAttributes() ?>>
            <?= $Page->po_no->selectOptionListHtml("x_po_no", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->po_no->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_po_no",
                selectId: "fpickingsrch_x_po_no",
                ajax: { id: "x_po_no", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.po_no.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
<?php
if (!$Page->to_no->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_to_no" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->to_no->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_to_no"
            name="x_to_no[]"
            class="form-control ew-select<?= $Page->to_no->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_to_no"
            data-table="picking"
            data-field="x_to_no"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->to_no->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->to_no->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->to_no->getPlaceHolder()) ?>"
            <?= $Page->to_no->editAttributes() ?>>
            <?= $Page->to_no->selectOptionListHtml("x_to_no", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->to_no->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_to_no",
                selectId: "fpickingsrch_x_to_no",
                ajax: { id: "x_to_no", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.to_no.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
<?php
if (!$Page->to_order_item->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_to_order_item" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->to_order_item->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_to_order_item"
            name="x_to_order_item[]"
            class="form-control ew-select<?= $Page->to_order_item->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_to_order_item"
            data-table="picking"
            data-field="x_to_order_item"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->to_order_item->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->to_order_item->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->to_order_item->getPlaceHolder()) ?>"
            <?= $Page->to_order_item->editAttributes() ?>>
            <?= $Page->to_order_item->selectOptionListHtml("x_to_order_item", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->to_order_item->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_to_order_item",
                selectId: "fpickingsrch_x_to_order_item",
                ajax: { id: "x_to_order_item", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.to_order_item.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
<?php
if (!$Page->to_priority->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_to_priority" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->to_priority->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_to_priority"
            name="x_to_priority[]"
            class="form-control ew-select<?= $Page->to_priority->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_to_priority"
            data-table="picking"
            data-field="x_to_priority"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->to_priority->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->to_priority->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->to_priority->getPlaceHolder()) ?>"
            <?= $Page->to_priority->editAttributes() ?>>
            <?= $Page->to_priority->selectOptionListHtml("x_to_priority", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->to_priority->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_to_priority",
                selectId: "fpickingsrch_x_to_priority",
                ajax: { id: "x_to_priority", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.to_priority.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
<?php
if (!$Page->to_priority_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_to_priority_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->to_priority_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_to_priority_code"
            name="x_to_priority_code[]"
            class="form-control ew-select<?= $Page->to_priority_code->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_to_priority_code"
            data-table="picking"
            data-field="x_to_priority_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->to_priority_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->to_priority_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->to_priority_code->getPlaceHolder()) ?>"
            <?= $Page->to_priority_code->editAttributes() ?>>
            <?= $Page->to_priority_code->selectOptionListHtml("x_to_priority_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->to_priority_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_to_priority_code",
                selectId: "fpickingsrch_x_to_priority_code",
                ajax: { id: "x_to_priority_code", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.to_priority_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
<?php
if (!$Page->source_storage_type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_source_storage_type" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->source_storage_type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_source_storage_type"
            name="x_source_storage_type[]"
            class="form-control ew-select<?= $Page->source_storage_type->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_source_storage_type"
            data-table="picking"
            data-field="x_source_storage_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->source_storage_type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->source_storage_type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->source_storage_type->getPlaceHolder()) ?>"
            <?= $Page->source_storage_type->editAttributes() ?>>
            <?= $Page->source_storage_type->selectOptionListHtml("x_source_storage_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->source_storage_type->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_source_storage_type",
                selectId: "fpickingsrch_x_source_storage_type",
                ajax: { id: "x_source_storage_type", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.source_storage_type.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
<?php
if (!$Page->source_storage_bin->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_source_storage_bin" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->source_storage_bin->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_source_storage_bin"
            name="x_source_storage_bin[]"
            class="form-control ew-select<?= $Page->source_storage_bin->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_source_storage_bin"
            data-table="picking"
            data-field="x_source_storage_bin"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->source_storage_bin->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->source_storage_bin->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->source_storage_bin->getPlaceHolder()) ?>"
            <?= $Page->source_storage_bin->editAttributes() ?>>
            <?= $Page->source_storage_bin->selectOptionListHtml("x_source_storage_bin", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->source_storage_bin->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_source_storage_bin",
                selectId: "fpickingsrch_x_source_storage_bin",
                ajax: { id: "x_source_storage_bin", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.source_storage_bin.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
<?php
if (!$Page->carton_number->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_carton_number" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->carton_number->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_carton_number"
            name="x_carton_number[]"
            class="form-control ew-select<?= $Page->carton_number->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_carton_number"
            data-table="picking"
            data-field="x_carton_number"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->carton_number->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->carton_number->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->carton_number->getPlaceHolder()) ?>"
            <?= $Page->carton_number->editAttributes() ?>>
            <?= $Page->carton_number->selectOptionListHtml("x_carton_number", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->carton_number->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_carton_number",
                selectId: "fpickingsrch_x_carton_number",
                ajax: { id: "x_carton_number", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.carton_number.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
<?php
if (!$Page->creation_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_creation_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->creation_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_creation_date"
            name="x_creation_date[]"
            class="form-control ew-select<?= $Page->creation_date->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_creation_date"
            data-table="picking"
            data-field="x_creation_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->creation_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->creation_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"
            <?= $Page->creation_date->editAttributes() ?>>
            <?= $Page->creation_date->selectOptionListHtml("x_creation_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_creation_date",
                selectId: "fpickingsrch_x_creation_date",
                ajax: { id: "x_creation_date", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.creation_date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
<?php
if (!$Page->gr_number->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_gr_number" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->gr_number->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_gr_number"
            name="x_gr_number[]"
            class="form-control ew-select<?= $Page->gr_number->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_gr_number"
            data-table="picking"
            data-field="x_gr_number"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->gr_number->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->gr_number->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->gr_number->getPlaceHolder()) ?>"
            <?= $Page->gr_number->editAttributes() ?>>
            <?= $Page->gr_number->selectOptionListHtml("x_gr_number", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->gr_number->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_gr_number",
                selectId: "fpickingsrch_x_gr_number",
                ajax: { id: "x_gr_number", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.gr_number.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
<?php
if (!$Page->gr_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_gr_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->gr_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_gr_date"
            name="x_gr_date[]"
            class="form-control ew-select<?= $Page->gr_date->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_gr_date"
            data-table="picking"
            data-field="x_gr_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->gr_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->gr_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->gr_date->getPlaceHolder()) ?>"
            <?= $Page->gr_date->editAttributes() ?>>
            <?= $Page->gr_date->selectOptionListHtml("x_gr_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->gr_date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_gr_date",
                selectId: "fpickingsrch_x_gr_date",
                ajax: { id: "x_gr_date", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.gr_date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
<?php
if (!$Page->delivery->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_delivery" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->delivery->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_delivery"
            name="x_delivery[]"
            class="form-control ew-select<?= $Page->delivery->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_delivery"
            data-table="picking"
            data-field="x_delivery"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->delivery->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->delivery->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->delivery->getPlaceHolder()) ?>"
            <?= $Page->delivery->editAttributes() ?>>
            <?= $Page->delivery->selectOptionListHtml("x_delivery", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->delivery->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_delivery",
                selectId: "fpickingsrch_x_delivery",
                ajax: { id: "x_delivery", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.delivery.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
<?php
if (!$Page->store_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_store_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->store_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_store_id"
            name="x_store_id[]"
            class="form-control ew-select<?= $Page->store_id->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_store_id"
            data-table="picking"
            data-field="x_store_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->store_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->store_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"
            <?= $Page->store_id->editAttributes() ?>>
            <?= $Page->store_id->selectOptionListHtml("x_store_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->store_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_store_id",
                selectId: "fpickingsrch_x_store_id",
                ajax: { id: "x_store_id", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.store_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
<?php
if (!$Page->store_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_store_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->store_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_store_name"
            name="x_store_name[]"
            class="form-control ew-select<?= $Page->store_name->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_store_name"
            data-table="picking"
            data-field="x_store_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->store_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->store_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"
            <?= $Page->store_name->editAttributes() ?>>
            <?= $Page->store_name->selectOptionListHtml("x_store_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->store_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "fpickingsrch_x_store_name",
                ajax: { id: "x_store_name", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.store_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
<?php
if (!$Page->article->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_article" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->article->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_article"
            name="x_article[]"
            class="form-control ew-select<?= $Page->article->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_article"
            data-table="picking"
            data-field="x_article"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->article->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->article->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"
            <?= $Page->article->editAttributes() ?>>
            <?= $Page->article->selectOptionListHtml("x_article", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->article->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_article",
                selectId: "fpickingsrch_x_article",
                ajax: { id: "x_article", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.article.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
<?php
if (!$Page->size_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_size_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->size_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_size_code"
            name="x_size_code[]"
            class="form-control ew-select<?= $Page->size_code->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_size_code"
            data-table="picking"
            data-field="x_size_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->size_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->size_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->size_code->getPlaceHolder()) ?>"
            <?= $Page->size_code->editAttributes() ?>>
            <?= $Page->size_code->selectOptionListHtml("x_size_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->size_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_size_code",
                selectId: "fpickingsrch_x_size_code",
                ajax: { id: "x_size_code", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.size_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
<?php
if (!$Page->size_desc->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_size_desc" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->size_desc->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_size_desc"
            name="x_size_desc[]"
            class="form-control ew-select<?= $Page->size_desc->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_size_desc"
            data-table="picking"
            data-field="x_size_desc"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->size_desc->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->size_desc->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->size_desc->getPlaceHolder()) ?>"
            <?= $Page->size_desc->editAttributes() ?>>
            <?= $Page->size_desc->selectOptionListHtml("x_size_desc", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->size_desc->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_size_desc",
                selectId: "fpickingsrch_x_size_desc",
                ajax: { id: "x_size_desc", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.size_desc.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
<?php
if (!$Page->color_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_color_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->color_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_color_code"
            name="x_color_code[]"
            class="form-control ew-select<?= $Page->color_code->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_color_code"
            data-table="picking"
            data-field="x_color_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->color_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->color_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"
            <?= $Page->color_code->editAttributes() ?>>
            <?= $Page->color_code->selectOptionListHtml("x_color_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->color_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_color_code",
                selectId: "fpickingsrch_x_color_code",
                ajax: { id: "x_color_code", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.color_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
<?php
if (!$Page->color_desc->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_color_desc" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->color_desc->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_color_desc"
            name="x_color_desc[]"
            class="form-control ew-select<?= $Page->color_desc->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_color_desc"
            data-table="picking"
            data-field="x_color_desc"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->color_desc->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->color_desc->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->color_desc->getPlaceHolder()) ?>"
            <?= $Page->color_desc->editAttributes() ?>>
            <?= $Page->color_desc->selectOptionListHtml("x_color_desc", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->color_desc->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_color_desc",
                selectId: "fpickingsrch_x_color_desc",
                ajax: { id: "x_color_desc", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.color_desc.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
<?php
if (!$Page->concept->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_concept" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->concept->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_concept"
            name="x_concept[]"
            class="form-control ew-select<?= $Page->concept->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_concept"
            data-table="picking"
            data-field="x_concept"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->concept->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->concept->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"
            <?= $Page->concept->editAttributes() ?>>
            <?= $Page->concept->selectOptionListHtml("x_concept", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->concept->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_concept",
                selectId: "fpickingsrch_x_concept",
                ajax: { id: "x_concept", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.concept.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
<?php
if (!$Page->target_qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_target_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->target_qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_target_qty"
            name="x_target_qty[]"
            class="form-control ew-select<?= $Page->target_qty->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_target_qty"
            data-table="picking"
            data-field="x_target_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->target_qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->target_qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->target_qty->getPlaceHolder()) ?>"
            <?= $Page->target_qty->editAttributes() ?>>
            <?= $Page->target_qty->selectOptionListHtml("x_target_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->target_qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_target_qty",
                selectId: "fpickingsrch_x_target_qty",
                ajax: { id: "x_target_qty", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.target_qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
<?php
if (!$Page->picked_qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picked_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picked_qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picked_qty"
            name="x_picked_qty[]"
            class="form-control ew-select<?= $Page->picked_qty->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_picked_qty"
            data-table="picking"
            data-field="x_picked_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picked_qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picked_qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"
            <?= $Page->picked_qty->editAttributes() ?>>
            <?= $Page->picked_qty->selectOptionListHtml("x_picked_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_picked_qty",
                selectId: "fpickingsrch_x_picked_qty",
                ajax: { id: "x_picked_qty", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.picked_qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
<?php
if (!$Page->variance_qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_variance_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->variance_qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_variance_qty"
            name="x_variance_qty[]"
            class="form-control ew-select<?= $Page->variance_qty->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_variance_qty"
            data-table="picking"
            data-field="x_variance_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->variance_qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->variance_qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->variance_qty->getPlaceHolder()) ?>"
            <?= $Page->variance_qty->editAttributes() ?>>
            <?= $Page->variance_qty->selectOptionListHtml("x_variance_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->variance_qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_variance_qty",
                selectId: "fpickingsrch_x_variance_qty",
                ajax: { id: "x_variance_qty", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.variance_qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
<?php
if (!$Page->confirmation_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_confirmation_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->confirmation_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_confirmation_date"
            name="x_confirmation_date[]"
            class="form-control ew-select<?= $Page->confirmation_date->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_confirmation_date"
            data-table="picking"
            data-field="x_confirmation_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->confirmation_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->confirmation_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"
            <?= $Page->confirmation_date->editAttributes() ?>>
            <?= $Page->confirmation_date->selectOptionListHtml("x_confirmation_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_confirmation_date",
                selectId: "fpickingsrch_x_confirmation_date",
                ajax: { id: "x_confirmation_date", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.confirmation_date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
<?php
if (!$Page->confirmation_time->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_confirmation_time" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->confirmation_time->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_confirmation_time"
            name="x_confirmation_time[]"
            class="form-control ew-select<?= $Page->confirmation_time->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_confirmation_time"
            data-table="picking"
            data-field="x_confirmation_time"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->confirmation_time->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->confirmation_time->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->confirmation_time->getPlaceHolder()) ?>"
            <?= $Page->confirmation_time->editAttributes() ?>>
            <?= $Page->confirmation_time->selectOptionListHtml("x_confirmation_time", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->confirmation_time->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_confirmation_time",
                selectId: "fpickingsrch_x_confirmation_time",
                ajax: { id: "x_confirmation_time", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.confirmation_time.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
<?php
if (!$Page->box_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_box_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->box_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_box_code"
            name="x_box_code[]"
            class="form-control ew-select<?= $Page->box_code->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_box_code"
            data-table="picking"
            data-field="x_box_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->box_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->box_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"
            <?= $Page->box_code->editAttributes() ?>>
            <?= $Page->box_code->selectOptionListHtml("x_box_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->box_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_box_code",
                selectId: "fpickingsrch_x_box_code",
                ajax: { id: "x_box_code", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.box_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
<?php
if (!$Page->box_type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_box_type" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->box_type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_box_type"
            name="x_box_type[]"
            class="form-control ew-select<?= $Page->box_type->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_box_type"
            data-table="picking"
            data-field="x_box_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->box_type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->box_type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->box_type->getPlaceHolder()) ?>"
            <?= $Page->box_type->editAttributes() ?>>
            <?= $Page->box_type->selectOptionListHtml("x_box_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->box_type->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_box_type",
                selectId: "fpickingsrch_x_box_type",
                ajax: { id: "x_box_type", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.box_type.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
<?php
if (!$Page->picker->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picker" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picker->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picker"
            name="x_picker[]"
            class="form-control ew-select<?= $Page->picker->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_picker"
            data-table="picking"
            data-field="x_picker"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picker->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picker->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"
            <?= $Page->picker->editAttributes() ?>>
            <?= $Page->picker->selectOptionListHtml("x_picker", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picker->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_picker",
                selectId: "fpickingsrch_x_picker",
                ajax: { id: "x_picker", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.picker.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
<?php
if (!$Page->status->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_status" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->status->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_status"
            name="x_status[]"
            class="form-control ew-select<?= $Page->status->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_status"
            data-table="picking"
            data-field="x_status"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->status->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
            <?= $Page->status->editAttributes() ?>>
            <?= $Page->status->selectOptionListHtml("x_status", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fpickingsrch_x_status",
                ajax: { id: "x_status", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
<?php
if (!$Page->remarks->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_remarks" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->remarks->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_remarks"
            name="x_remarks[]"
            class="form-control ew-select<?= $Page->remarks->isInvalidClass() ?>"
            data-select2-id="fpickingsrch_x_remarks"
            data-table="picking"
            data-field="x_remarks"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->remarks->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->remarks->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"
            <?= $Page->remarks->editAttributes() ?>>
            <?= $Page->remarks->selectOptionListHtml("x_remarks", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->remarks->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fpickingsrch", function() {
            var options = {
                name: "x_remarks",
                selectId: "fpickingsrch_x_remarks",
                ajax: { id: "x_remarks", form: "fpickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.picking.fields.remarks.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpickingsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpickingsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpickingsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpickingsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> picking">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
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
<form name="fpickinglist" id="fpickinglist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking">
<div id="gmp_picking" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pickinglist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_id" class="picking_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
        <th data-name="to_no" class="<?= $Page->to_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_to_no" class="picking_to_no"><?= $Page->renderFieldHeader($Page->to_no) ?></div></th>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <th data-name="to_order_item" class="<?= $Page->to_order_item->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_to_order_item" class="picking_to_order_item"><?= $Page->renderFieldHeader($Page->to_order_item) ?></div></th>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
        <th data-name="to_priority" class="<?= $Page->to_priority->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_to_priority" class="picking_to_priority"><?= $Page->renderFieldHeader($Page->to_priority) ?></div></th>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <th data-name="to_priority_code" class="<?= $Page->to_priority_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_to_priority_code" class="picking_to_priority_code"><?= $Page->renderFieldHeader($Page->to_priority_code) ?></div></th>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <th data-name="source_storage_type" class="<?= $Page->source_storage_type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_source_storage_type" class="picking_source_storage_type"><?= $Page->renderFieldHeader($Page->source_storage_type) ?></div></th>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <th data-name="source_storage_bin" class="<?= $Page->source_storage_bin->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_source_storage_bin" class="picking_source_storage_bin"><?= $Page->renderFieldHeader($Page->source_storage_bin) ?></div></th>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
        <th data-name="carton_number" class="<?= $Page->carton_number->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_carton_number" class="picking_carton_number"><?= $Page->renderFieldHeader($Page->carton_number) ?></div></th>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <th data-name="creation_date" class="<?= $Page->creation_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_creation_date" class="picking_creation_date"><?= $Page->renderFieldHeader($Page->creation_date) ?></div></th>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
        <th data-name="gr_number" class="<?= $Page->gr_number->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_gr_number" class="picking_gr_number"><?= $Page->renderFieldHeader($Page->gr_number) ?></div></th>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
        <th data-name="gr_date" class="<?= $Page->gr_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_gr_date" class="picking_gr_date"><?= $Page->renderFieldHeader($Page->gr_date) ?></div></th>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
        <th data-name="delivery" class="<?= $Page->delivery->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_delivery" class="picking_delivery"><?= $Page->renderFieldHeader($Page->delivery) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_store_id" class="picking_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_store_name" class="picking_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_article" class="picking_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <th data-name="size_code" class="<?= $Page->size_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_size_code" class="picking_size_code"><?= $Page->renderFieldHeader($Page->size_code) ?></div></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th data-name="size_desc" class="<?= $Page->size_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_size_desc" class="picking_size_desc"><?= $Page->renderFieldHeader($Page->size_desc) ?></div></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th data-name="color_code" class="<?= $Page->color_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_color_code" class="picking_color_code"><?= $Page->renderFieldHeader($Page->color_code) ?></div></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th data-name="color_desc" class="<?= $Page->color_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_color_desc" class="picking_color_desc"><?= $Page->renderFieldHeader($Page->color_desc) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_concept" class="picking_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
        <th data-name="target_qty" class="<?= $Page->target_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_target_qty" class="picking_target_qty"><?= $Page->renderFieldHeader($Page->target_qty) ?></div></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th data-name="picked_qty" class="<?= $Page->picked_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_picked_qty" class="picking_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div></th>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <th data-name="variance_qty" class="<?= $Page->variance_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_variance_qty" class="picking_variance_qty"><?= $Page->renderFieldHeader($Page->variance_qty) ?></div></th>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <th data-name="confirmation_date" class="<?= $Page->confirmation_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_confirmation_date" class="picking_confirmation_date"><?= $Page->renderFieldHeader($Page->confirmation_date) ?></div></th>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <th data-name="confirmation_time" class="<?= $Page->confirmation_time->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_confirmation_time" class="picking_confirmation_time"><?= $Page->renderFieldHeader($Page->confirmation_time) ?></div></th>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th data-name="box_code" class="<?= $Page->box_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_box_code" class="picking_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div></th>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <th data-name="box_type" class="<?= $Page->box_type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_box_type" class="picking_box_type"><?= $Page->renderFieldHeader($Page->box_type) ?></div></th>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <th data-name="picker" class="<?= $Page->picker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_picker" class="picking_picker"><?= $Page->renderFieldHeader($Page->picker) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_status" class="picking_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th data-name="remarks" class="<?= $Page->remarks->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_picking_remarks" class="picking_remarks"><?= $Page->renderFieldHeader($Page->remarks) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
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

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
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
            "id" => "r" . $Page->RowCount . "_picking",
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
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_id" class="el_picking_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_no->Visible) { // to_no ?>
        <td data-name="to_no"<?= $Page->to_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_no" class="el_picking_to_no">
<span<?= $Page->to_no->viewAttributes() ?>>
<?= $Page->to_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_order_item->Visible) { // to_order_item ?>
        <td data-name="to_order_item"<?= $Page->to_order_item->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_order_item" class="el_picking_to_order_item">
<span<?= $Page->to_order_item->viewAttributes() ?>>
<?= $Page->to_order_item->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_priority->Visible) { // to_priority ?>
        <td data-name="to_priority"<?= $Page->to_priority->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_priority" class="el_picking_to_priority">
<span<?= $Page->to_priority->viewAttributes() ?>>
<?= $Page->to_priority->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
        <td data-name="to_priority_code"<?= $Page->to_priority_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_to_priority_code" class="el_picking_to_priority_code">
<span<?= $Page->to_priority_code->viewAttributes() ?>>
<?= $Page->to_priority_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
        <td data-name="source_storage_type"<?= $Page->source_storage_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_source_storage_type" class="el_picking_source_storage_type">
<span<?= $Page->source_storage_type->viewAttributes() ?>>
<?= $Page->source_storage_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
        <td data-name="source_storage_bin"<?= $Page->source_storage_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_source_storage_bin" class="el_picking_source_storage_bin">
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<?= $Page->source_storage_bin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->carton_number->Visible) { // carton_number ?>
        <td data-name="carton_number"<?= $Page->carton_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_carton_number" class="el_picking_carton_number">
<span<?= $Page->carton_number->viewAttributes() ?>>
<?= $Page->carton_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->creation_date->Visible) { // creation_date ?>
        <td data-name="creation_date"<?= $Page->creation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_creation_date" class="el_picking_creation_date">
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gr_number->Visible) { // gr_number ?>
        <td data-name="gr_number"<?= $Page->gr_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_gr_number" class="el_picking_gr_number">
<span<?= $Page->gr_number->viewAttributes() ?>>
<?= $Page->gr_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gr_date->Visible) { // gr_date ?>
        <td data-name="gr_date"<?= $Page->gr_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_gr_date" class="el_picking_gr_date">
<span<?= $Page->gr_date->viewAttributes() ?>>
<?= $Page->gr_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delivery->Visible) { // delivery ?>
        <td data-name="delivery"<?= $Page->delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_delivery" class="el_picking_delivery">
<span<?= $Page->delivery->viewAttributes() ?>>
<?= $Page->delivery->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_store_id" class="el_picking_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_store_name" class="el_picking_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_article" class="el_picking_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_code->Visible) { // size_code ?>
        <td data-name="size_code"<?= $Page->size_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_size_code" class="el_picking_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_size_desc" class="el_picking_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_color_code" class="el_picking_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_color_desc" class="el_picking_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_concept" class="el_picking_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->target_qty->Visible) { // target_qty ?>
        <td data-name="target_qty"<?= $Page->target_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_target_qty" class="el_picking_target_qty">
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_picked_qty" class="el_picking_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <td data-name="variance_qty"<?= $Page->variance_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_variance_qty" class="el_picking_variance_qty">
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <td data-name="confirmation_date"<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_confirmation_date" class="el_picking_confirmation_date">
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <td data-name="confirmation_time"<?= $Page->confirmation_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_confirmation_time" class="el_picking_confirmation_time">
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_box_code" class="el_picking_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_type->Visible) { // box_type ?>
        <td data-name="box_type"<?= $Page->box_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_box_type" class="el_picking_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker"<?= $Page->picker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_picker" class="el_picking_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_status" class="el_picking_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remarks->Visible) { // remarks ?>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_picking_remarks" class="el_picking_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
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
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("picking");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

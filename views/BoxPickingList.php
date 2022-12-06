<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BoxPickingList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { box_picking: currentTable } });
var currentForm, currentPageID;
var fbox_pickinglist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbox_pickinglist = new ew.Form("fbox_pickinglist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fbox_pickinglist;
    fbox_pickinglist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fbox_pickinglist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fbox_pickinglist.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    fbox_pickinglist.lists.box_id = <?= $Page->box_id->toClientList($Page) ?>;
    fbox_pickinglist.lists.type = <?= $Page->type->toClientList($Page) ?>;
    fbox_pickinglist.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fbox_pickinglist.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fbox_pickinglist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fbox_pickinglist.lists.users = <?= $Page->users->toClientList($Page) ?>;
    fbox_pickinglist.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fbox_pickinglist.lists.line = <?= $Page->line->toClientList($Page) ?>;
    fbox_pickinglist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fbox_pickinglist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    fbox_pickinglist.lists.date_staging = <?= $Page->date_staging->toClientList($Page) ?>;
    fbox_pickinglist.lists.date_delivery = <?= $Page->date_delivery->toClientList($Page) ?>;
    loadjs.done("fbox_pickinglist");
});
var fbox_pickingsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fbox_pickingsrch = new ew.Form("fbox_pickingsrch", "list");
    currentSearchForm = fbox_pickingsrch;

    // Add fields
    var fields = currentTable.fields;
    fbox_pickingsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["store_code", [], fields.store_code.isInvalid],
        ["box_id", [], fields.box_id.isInvalid],
        ["type", [], fields.type.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["quantity", [], fields.quantity.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["users", [], fields.users.isInvalid],
        ["picking_date", [], fields.picking_date.isInvalid],
        ["y_picking_date", [ew.Validators.between], false],
        ["line", [], fields.line.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid],
        ["date_staging", [], fields.date_staging.isInvalid],
        ["date_delivery", [], fields.date_delivery.isInvalid]
    ]);

    // Validate form
    fbox_pickingsrch.validate = function () {
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
    fbox_pickingsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbox_pickingsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fbox_pickingsrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fbox_pickingsrch.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    fbox_pickingsrch.lists.box_id = <?= $Page->box_id->toClientList($Page) ?>;
    fbox_pickingsrch.lists.type = <?= $Page->type->toClientList($Page) ?>;
    fbox_pickingsrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fbox_pickingsrch.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fbox_pickingsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fbox_pickingsrch.lists.users = <?= $Page->users->toClientList($Page) ?>;
    fbox_pickingsrch.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fbox_pickingsrch.lists.line = <?= $Page->line->toClientList($Page) ?>;
    fbox_pickingsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fbox_pickingsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    fbox_pickingsrch.lists.date_staging = <?= $Page->date_staging->toClientList($Page) ?>;
    fbox_pickingsrch.lists.date_delivery = <?= $Page->date_delivery->toClientList($Page) ?>;

    // Filters
    fbox_pickingsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbox_pickingsrch");
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
<form name="fbox_pickingsrch" id="fbox_pickingsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbox_pickingsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="box_picking">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
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
            data-select2-id="fbox_pickingsrch_x_store_name"
            data-table="box_picking"
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
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "fbox_pickingsrch_x_store_name",
                ajax: { id: "x_store_name", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.store_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
<?php
if (!$Page->store_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_store_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->store_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_store_code"
            name="x_store_code[]"
            class="form-control ew-select<?= $Page->store_code->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_store_code"
            data-table="box_picking"
            data-field="x_store_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->store_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->store_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->store_code->getPlaceHolder()) ?>"
            <?= $Page->store_code->editAttributes() ?>>
            <?= $Page->store_code->selectOptionListHtml("x_store_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->store_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_store_code",
                selectId: "fbox_pickingsrch_x_store_code",
                ajax: { id: "x_store_code", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.store_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
<?php
if (!$Page->box_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_box_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->box_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_box_id"
            name="x_box_id[]"
            class="form-control ew-select<?= $Page->box_id->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_box_id"
            data-table="box_picking"
            data-field="x_box_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->box_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->box_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"
            <?= $Page->box_id->editAttributes() ?>>
            <?= $Page->box_id->selectOptionListHtml("x_box_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->box_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_box_id",
                selectId: "fbox_pickingsrch_x_box_id",
                ajax: { id: "x_box_id", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.box_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
<?php
if (!$Page->type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_type" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_type"
            name="x_type[]"
            class="form-control ew-select<?= $Page->type->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_type"
            data-table="box_picking"
            data-field="x_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>"
            <?= $Page->type->editAttributes() ?>>
            <?= $Page->type->selectOptionListHtml("x_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->type->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_type",
                selectId: "fbox_pickingsrch_x_type",
                ajax: { id: "x_type", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.type.filterOptions);
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
            data-select2-id="fbox_pickingsrch_x_concept"
            data-table="box_picking"
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
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_concept",
                selectId: "fbox_pickingsrch_x_concept",
                ajax: { id: "x_concept", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.concept.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
<?php
if (!$Page->quantity->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_quantity" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->quantity->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_quantity"
            name="x_quantity[]"
            class="form-control ew-select<?= $Page->quantity->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_quantity"
            data-table="box_picking"
            data-field="x_quantity"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->quantity->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->quantity->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"
            <?= $Page->quantity->editAttributes() ?>>
            <?= $Page->quantity->selectOptionListHtml("x_quantity", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->quantity->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_quantity",
                selectId: "fbox_pickingsrch_x_quantity",
                ajax: { id: "x_quantity", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.quantity.filterOptions);
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
            data-select2-id="fbox_pickingsrch_x_status"
            data-table="box_picking"
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
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fbox_pickingsrch_x_status",
                ajax: { id: "x_status", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
<?php
if (!$Page->users->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_users" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->users->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_users"
            name="x_users[]"
            class="form-control ew-select<?= $Page->users->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_users"
            data-table="box_picking"
            data-field="x_users"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->users->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->users->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->users->getPlaceHolder()) ?>"
            <?= $Page->users->editAttributes() ?>>
            <?= $Page->users->selectOptionListHtml("x_users", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->users->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_users",
                selectId: "fbox_pickingsrch_x_users",
                ajax: { id: "x_users", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.users.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
<?php
if (!$Page->picking_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picking_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picking_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picking_date"
            name="x_picking_date[]"
            class="form-control ew-select<?= $Page->picking_date->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_picking_date"
            data-table="box_picking"
            data-field="x_picking_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picking_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picking_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picking_date->getPlaceHolder()) ?>"
            <?= $Page->picking_date->editAttributes() ?>>
            <?= $Page->picking_date->selectOptionListHtml("x_picking_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picking_date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_picking_date",
                selectId: "fbox_pickingsrch_x_picking_date",
                ajax: { id: "x_picking_date", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.picking_date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
<?php
if (!$Page->line->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_line" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->line->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_line"
            name="x_line[]"
            class="form-control ew-select<?= $Page->line->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_line"
            data-table="box_picking"
            data-field="x_line"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->line->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->line->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->line->getPlaceHolder()) ?>"
            <?= $Page->line->editAttributes() ?>>
            <?= $Page->line->selectOptionListHtml("x_line", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->line->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_line",
                selectId: "fbox_pickingsrch_x_line",
                ajax: { id: "x_line", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.line.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
<?php
if (!$Page->date_created->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_created" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_created->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_created"
            name="x_date_created[]"
            class="form-control ew-select<?= $Page->date_created->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_date_created"
            data-table="box_picking"
            data-field="x_date_created"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_created->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_created->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"
            <?= $Page->date_created->editAttributes() ?>>
            <?= $Page->date_created->selectOptionListHtml("x_date_created", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_created->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fbox_pickingsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.date_created.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
<?php
if (!$Page->date_updated->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_updated" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_updated->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_updated"
            name="x_date_updated[]"
            class="form-control ew-select<?= $Page->date_updated->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_date_updated"
            data-table="box_picking"
            data-field="x_date_updated"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_updated->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_updated->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>"
            <?= $Page->date_updated->editAttributes() ?>>
            <?= $Page->date_updated->selectOptionListHtml("x_date_updated", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fbox_pickingsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.date_updated.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
<?php
if (!$Page->date_staging->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_staging" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_staging->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_staging"
            name="x_date_staging[]"
            class="form-control ew-select<?= $Page->date_staging->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_date_staging"
            data-table="box_picking"
            data-field="x_date_staging"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_staging->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_staging->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_staging->getPlaceHolder()) ?>"
            <?= $Page->date_staging->editAttributes() ?>>
            <?= $Page->date_staging->selectOptionListHtml("x_date_staging", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_staging->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_date_staging",
                selectId: "fbox_pickingsrch_x_date_staging",
                ajax: { id: "x_date_staging", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.date_staging.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
<?php
if (!$Page->date_delivery->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_delivery" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_delivery->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_delivery"
            name="x_date_delivery[]"
            class="form-control ew-select<?= $Page->date_delivery->isInvalidClass() ?>"
            data-select2-id="fbox_pickingsrch_x_date_delivery"
            data-table="box_picking"
            data-field="x_date_delivery"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_delivery->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_delivery->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_delivery->getPlaceHolder()) ?>"
            <?= $Page->date_delivery->editAttributes() ?>>
            <?= $Page->date_delivery->selectOptionListHtml("x_date_delivery", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_delivery->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_pickingsrch", function() {
            var options = {
                name: "x_date_delivery",
                selectId: "fbox_pickingsrch_x_date_delivery",
                ajax: { id: "x_date_delivery", form: "fbox_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_picking.fields.date_delivery.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbox_pickingsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbox_pickingsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbox_pickingsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbox_pickingsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> box_picking">
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
<form name="fbox_pickinglist" id="fbox_pickinglist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_picking">
<div id="gmp_box_picking" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_box_pickinglist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_id" class="box_picking_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_store_name" class="box_picking_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th data-name="store_code" class="<?= $Page->store_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_store_code" class="box_picking_store_code"><?= $Page->renderFieldHeader($Page->store_code) ?></div></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th data-name="box_id" class="<?= $Page->box_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_box_id" class="box_picking_box_id"><?= $Page->renderFieldHeader($Page->box_id) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_type" class="box_picking_type"><?= $Page->renderFieldHeader($Page->type) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_concept" class="box_picking_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_quantity" class="box_picking_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_status" class="box_picking_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th data-name="users" class="<?= $Page->users->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_users" class="box_picking_users"><?= $Page->renderFieldHeader($Page->users) ?></div></th>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <th data-name="picking_date" class="<?= $Page->picking_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_picking_date" class="box_picking_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></div></th>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
        <th data-name="line" class="<?= $Page->line->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_line" class="box_picking_line"><?= $Page->renderFieldHeader($Page->line) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_date_created" class="box_picking_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_date_updated" class="box_picking_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
        <th data-name="date_staging" class="<?= $Page->date_staging->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_date_staging" class="box_picking_date_staging"><?= $Page->renderFieldHeader($Page->date_staging) ?></div></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <th data-name="date_delivery" class="<?= $Page->date_delivery->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_box_picking_date_delivery" class="box_picking_date_delivery"><?= $Page->renderFieldHeader($Page->date_delivery) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_box_picking",
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
<span id="el<?= $Page->RowCount ?>_box_picking_id" class="el_box_picking_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_store_name" class="el_box_picking_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_code->Visible) { // store_code ?>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_store_code" class="el_box_picking_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_id->Visible) { // box_id ?>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_box_id" class="el_box_picking_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_type" class="el_box_picking_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_concept" class="el_box_picking_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_quantity" class="el_box_picking_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_status" class="el_box_picking_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->users->Visible) { // users ?>
        <td data-name="users"<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_users" class="el_box_picking_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td data-name="picking_date"<?= $Page->picking_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_picking_date" class="el_box_picking_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->line->Visible) { // line ?>
        <td data-name="line"<?= $Page->line->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_line" class="el_box_picking_line">
<span<?= $Page->line->viewAttributes() ?>>
<?= $Page->line->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_created" class="el_box_picking_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_updated" class="el_box_picking_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_staging->Visible) { // date_staging ?>
        <td data-name="date_staging"<?= $Page->date_staging->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_staging" class="el_box_picking_date_staging">
<span<?= $Page->date_staging->viewAttributes() ?>>
<?= $Page->date_staging->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <td data-name="date_delivery"<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_picking_date_delivery" class="el_box_picking_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
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
    ew.addEventHandlers("box_picking");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

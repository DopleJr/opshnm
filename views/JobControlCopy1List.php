<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlCopy1List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control_copy1: currentTable } });
var currentForm, currentPageID;
var fjob_control_copy1list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_control_copy1list = new ew.Form("fjob_control_copy1list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fjob_control_copy1list;
    fjob_control_copy1list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fjob_control_copy1list.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fjob_control_copy1list.lists.creation_date = <?= $Page->creation_date->toClientList($Page) ?>;
    fjob_control_copy1list.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fjob_control_copy1list.lists.area = <?= $Page->area->toClientList($Page) ?>;
    fjob_control_copy1list.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_control_copy1list.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_control_copy1list.lists.target_qty = <?= $Page->target_qty->toClientList($Page) ?>;
    fjob_control_copy1list.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fjob_control_copy1list.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fjob_control_copy1list.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fjob_control_copy1list.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("fjob_control_copy1list");
});
var fjob_control_copy1srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fjob_control_copy1srch = new ew.Form("fjob_control_copy1srch", "list");
    currentSearchForm = fjob_control_copy1srch;

    // Add fields
    var fields = currentTable.fields;
    fjob_control_copy1srch.addFields([
        ["id", [], fields.id.isInvalid],
        ["creation_date", [], fields.creation_date.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["area", [], fields.area.isInvalid],
        ["aisle", [], fields.aisle.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["target_qty", [], fields.target_qty.isInvalid],
        ["picked_qty", [], fields.picked_qty.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    fjob_control_copy1srch.validate = function () {
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
    fjob_control_copy1srch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjob_control_copy1srch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjob_control_copy1srch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.creation_date = <?= $Page->creation_date->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.area = <?= $Page->area->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.target_qty = <?= $Page->target_qty->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fjob_control_copy1srch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fjob_control_copy1srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fjob_control_copy1srch");
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
<form name="fjob_control_copy1srch" id="fjob_control_copy1srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fjob_control_copy1srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="job_control_copy1">
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
            data-select2-id="fjob_control_copy1srch_x_id"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_id",
                selectId: "fjob_control_copy1srch_x_id",
                ajax: { id: "x_id", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.id.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_creation_date"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_creation_date",
                selectId: "fjob_control_copy1srch_x_creation_date",
                ajax: { id: "x_creation_date", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.creation_date.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_store_id"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_store_id",
                selectId: "fjob_control_copy1srch_x_store_id",
                ajax: { id: "x_store_id", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.store_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
<?php
if (!$Page->area->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_area" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->area->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_area"
            name="x_area[]"
            class="form-control ew-select<?= $Page->area->isInvalidClass() ?>"
            data-select2-id="fjob_control_copy1srch_x_area"
            data-table="job_control_copy1"
            data-field="x_area"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->area->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->area->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"
            <?= $Page->area->editAttributes() ?>>
            <?= $Page->area->selectOptionListHtml("x_area", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->area->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_area",
                selectId: "fjob_control_copy1srch_x_area",
                ajax: { id: "x_area", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.area.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
<?php
if (!$Page->aisle->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_aisle" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->aisle->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_aisle"
            name="x_aisle[]"
            class="form-control ew-select<?= $Page->aisle->isInvalidClass() ?>"
            data-select2-id="fjob_control_copy1srch_x_aisle"
            data-table="job_control_copy1"
            data-field="x_aisle"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->aisle->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->aisle->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->aisle->getPlaceHolder()) ?>"
            <?= $Page->aisle->editAttributes() ?>>
            <?= $Page->aisle->selectOptionListHtml("x_aisle", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->aisle->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_aisle",
                selectId: "fjob_control_copy1srch_x_aisle",
                ajax: { id: "x_aisle", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.aisle.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
<?php
if (!$Page->user->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_user" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->user->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_user"
            name="x_user[]"
            class="form-control ew-select<?= $Page->user->isInvalidClass() ?>"
            data-select2-id="fjob_control_copy1srch_x_user"
            data-table="job_control_copy1"
            data-field="x_user"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->user->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->user->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"
            <?= $Page->user->editAttributes() ?>>
            <?= $Page->user->selectOptionListHtml("x_user", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->user->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_user",
                selectId: "fjob_control_copy1srch_x_user",
                ajax: { id: "x_user", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.user.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_target_qty"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_target_qty",
                selectId: "fjob_control_copy1srch_x_target_qty",
                ajax: { id: "x_target_qty", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.target_qty.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_picked_qty"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_picked_qty",
                selectId: "fjob_control_copy1srch_x_picked_qty",
                ajax: { id: "x_picked_qty", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.picked_qty.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_status"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_status",
                selectId: "fjob_control_copy1srch_x_status",
                ajax: { id: "x_status", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.status.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_date_created"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fjob_control_copy1srch_x_date_created",
                ajax: { id: "x_date_created", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.date_created.filterOptions);
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
            data-select2-id="fjob_control_copy1srch_x_date_updated"
            data-table="job_control_copy1"
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
        loadjs.ready("fjob_control_copy1srch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fjob_control_copy1srch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fjob_control_copy1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control_copy1.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjob_control_copy1srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjob_control_copy1srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjob_control_copy1srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjob_control_copy1srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> job_control_copy1">
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
<form name="fjob_control_copy1list" id="fjob_control_copy1list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control_copy1">
<div id="gmp_job_control_copy1" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_job_control_copy1list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_job_control_copy1_id" class="job_control_copy1_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
        <th data-name="creation_date" class="<?= $Page->creation_date->headerCellClass() ?>"><div id="elh_job_control_copy1_creation_date" class="job_control_copy1_creation_date"><?= $Page->renderFieldHeader($Page->creation_date) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>"><div id="elh_job_control_copy1_store_id" class="job_control_copy1_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th data-name="area" class="<?= $Page->area->headerCellClass() ?>"><div id="elh_job_control_copy1_area" class="job_control_copy1_area"><?= $Page->renderFieldHeader($Page->area) ?></div></th>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th data-name="aisle" class="<?= $Page->aisle->headerCellClass() ?>"><div id="elh_job_control_copy1_aisle" class="job_control_copy1_aisle"><?= $Page->renderFieldHeader($Page->aisle) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>"><div id="elh_job_control_copy1_user" class="job_control_copy1_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
        <th data-name="target_qty" class="<?= $Page->target_qty->headerCellClass() ?>"><div id="elh_job_control_copy1_target_qty" class="job_control_copy1_target_qty"><?= $Page->renderFieldHeader($Page->target_qty) ?></div></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th data-name="picked_qty" class="<?= $Page->picked_qty->headerCellClass() ?>"><div id="elh_job_control_copy1_picked_qty" class="job_control_copy1_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_job_control_copy1_status" class="job_control_copy1_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_job_control_copy1_date_created" class="job_control_copy1_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_job_control_copy1_date_updated" class="job_control_copy1_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_job_control_copy1",
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
<span id="el<?= $Page->RowCount ?>_job_control_copy1_id" class="el_job_control_copy1_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->creation_date->Visible) { // creation_date ?>
        <td data-name="creation_date"<?= $Page->creation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_creation_date" class="el_job_control_copy1_creation_date">
<span<?= $Page->creation_date->viewAttributes() ?>>
<?= $Page->creation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_store_id" class="el_job_control_copy1_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->area->Visible) { // area ?>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_area" class="el_job_control_copy1_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aisle->Visible) { // aisle ?>
        <td data-name="aisle"<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_aisle" class="el_job_control_copy1_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_user" class="el_job_control_copy1_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->target_qty->Visible) { // target_qty ?>
        <td data-name="target_qty"<?= $Page->target_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_target_qty" class="el_job_control_copy1_target_qty">
<span<?= $Page->target_qty->viewAttributes() ?>>
<?= $Page->target_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_picked_qty" class="el_job_control_copy1_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_status" class="el_job_control_copy1_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_date_created" class="el_job_control_copy1_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_copy1_date_updated" class="el_job_control_copy1_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
    ew.addEventHandlers("job_control_copy1");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

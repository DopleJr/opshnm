<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CheckBoxList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { check_box: currentTable } });
var currentForm, currentPageID;
var fcheck_boxlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcheck_boxlist = new ew.Form("fcheck_boxlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fcheck_boxlist;
    fcheck_boxlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fcheck_boxlist.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fcheck_boxlist.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fcheck_boxlist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fcheck_boxlist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fcheck_boxlist.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    fcheck_boxlist.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    fcheck_boxlist.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fcheck_boxlist.lists.variance_qty = <?= $Page->variance_qty->toClientList($Page) ?>;
    fcheck_boxlist.lists.confirmation_date = <?= $Page->confirmation_date->toClientList($Page) ?>;
    fcheck_boxlist.lists.confirmation_time = <?= $Page->confirmation_time->toClientList($Page) ?>;
    fcheck_boxlist.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    loadjs.done("fcheck_boxlist");
});
var fcheck_boxsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcheck_boxsrch = new ew.Form("fcheck_boxsrch", "list");
    currentSearchForm = fcheck_boxsrch;

    // Add fields
    var fields = currentTable.fields;
    fcheck_boxsrch.addFields([
        ["box_code", [], fields.box_code.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["size_desc", [], fields.size_desc.isInvalid],
        ["color_code", [], fields.color_code.isInvalid],
        ["picked_qty", [], fields.picked_qty.isInvalid],
        ["variance_qty", [], fields.variance_qty.isInvalid],
        ["confirmation_date", [], fields.confirmation_date.isInvalid],
        ["y_confirmation_date", [ew.Validators.between], false],
        ["confirmation_time", [], fields.confirmation_time.isInvalid],
        ["picker", [], fields.picker.isInvalid]
    ]);

    // Validate form
    fcheck_boxsrch.validate = function () {
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
    fcheck_boxsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcheck_boxsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcheck_boxsrch.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fcheck_boxsrch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fcheck_boxsrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fcheck_boxsrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fcheck_boxsrch.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    fcheck_boxsrch.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    fcheck_boxsrch.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fcheck_boxsrch.lists.variance_qty = <?= $Page->variance_qty->toClientList($Page) ?>;
    fcheck_boxsrch.lists.confirmation_date = <?= $Page->confirmation_date->toClientList($Page) ?>;
    fcheck_boxsrch.lists.confirmation_time = <?= $Page->confirmation_time->toClientList($Page) ?>;
    fcheck_boxsrch.lists.picker = <?= $Page->picker->toClientList($Page) ?>;

    // Filters
    fcheck_boxsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcheck_boxsrch");
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
<form name="fcheck_boxsrch" id="fcheck_boxsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fcheck_boxsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="check_box">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
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
            data-select2-id="fcheck_boxsrch_x_box_code"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_box_code",
                selectId: "fcheck_boxsrch_x_box_code",
                ajax: { id: "x_box_code", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.box_code.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_store_id"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_store_id",
                selectId: "fcheck_boxsrch_x_store_id",
                ajax: { id: "x_store_id", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.store_id.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_store_name"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "fcheck_boxsrch_x_store_name",
                ajax: { id: "x_store_name", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.store_name.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_article"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_article",
                selectId: "fcheck_boxsrch_x_article",
                ajax: { id: "x_article", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.article.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_size_desc"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_size_desc",
                selectId: "fcheck_boxsrch_x_size_desc",
                ajax: { id: "x_size_desc", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.size_desc.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_color_code"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_color_code",
                selectId: "fcheck_boxsrch_x_color_code",
                ajax: { id: "x_color_code", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.color_code.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_picked_qty"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_picked_qty",
                selectId: "fcheck_boxsrch_x_picked_qty",
                ajax: { id: "x_picked_qty", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.picked_qty.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_variance_qty"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_variance_qty",
                selectId: "fcheck_boxsrch_x_variance_qty",
                ajax: { id: "x_variance_qty", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.variance_qty.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_confirmation_date"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_confirmation_date",
                selectId: "fcheck_boxsrch_x_confirmation_date",
                ajax: { id: "x_confirmation_date", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.confirmation_date.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_confirmation_time"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_confirmation_time",
                selectId: "fcheck_boxsrch_x_confirmation_time",
                ajax: { id: "x_confirmation_time", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.confirmation_time.filterOptions);
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
            data-select2-id="fcheck_boxsrch_x_picker"
            data-table="check_box"
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
        loadjs.ready("fcheck_boxsrch", function() {
            var options = {
                name: "x_picker",
                selectId: "fcheck_boxsrch_x_picker",
                ajax: { id: "x_picker", form: "fcheck_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.check_box.fields.picker.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fcheck_boxsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fcheck_boxsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fcheck_boxsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fcheck_boxsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> check_box">
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
<form name="fcheck_boxlist" id="fcheck_boxlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="check_box">
<div id="gmp_check_box" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_check_boxlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th data-name="box_code" class="<?= $Page->box_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_box_code" class="check_box_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_store_id" class="check_box_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_store_name" class="check_box_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_article" class="check_box_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th data-name="size_desc" class="<?= $Page->size_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_size_desc" class="check_box_size_desc"><?= $Page->renderFieldHeader($Page->size_desc) ?></div></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th data-name="color_code" class="<?= $Page->color_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_color_code" class="check_box_color_code"><?= $Page->renderFieldHeader($Page->color_code) ?></div></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th data-name="picked_qty" class="<?= $Page->picked_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_picked_qty" class="check_box_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div></th>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <th data-name="variance_qty" class="<?= $Page->variance_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_variance_qty" class="check_box_variance_qty"><?= $Page->renderFieldHeader($Page->variance_qty) ?></div></th>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <th data-name="confirmation_date" class="<?= $Page->confirmation_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_confirmation_date" class="check_box_confirmation_date"><?= $Page->renderFieldHeader($Page->confirmation_date) ?></div></th>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <th data-name="confirmation_time" class="<?= $Page->confirmation_time->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_confirmation_time" class="check_box_confirmation_time"><?= $Page->renderFieldHeader($Page->confirmation_time) ?></div></th>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <th data-name="picker" class="<?= $Page->picker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_check_box_picker" class="check_box_picker"><?= $Page->renderFieldHeader($Page->picker) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_check_box",
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
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_box_code" class="el_check_box_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_store_id" class="el_check_box_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_store_name" class="el_check_box_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_article" class="el_check_box_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_size_desc" class="el_check_box_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_color_code" class="el_check_box_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_picked_qty" class="el_check_box_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <td data-name="variance_qty"<?= $Page->variance_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_variance_qty" class="el_check_box_variance_qty">
<span<?= $Page->variance_qty->viewAttributes() ?>>
<?= $Page->variance_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <td data-name="confirmation_date"<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_confirmation_date" class="el_check_box_confirmation_date">
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <td data-name="confirmation_time"<?= $Page->confirmation_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_confirmation_time" class="el_check_box_confirmation_time">
<span<?= $Page->confirmation_time->viewAttributes() ?>>
<?= $Page->confirmation_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker"<?= $Page->picker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_check_box_picker" class="el_check_box_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
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
<?php
// Render aggregate row
$Page->RowType = ROWTYPE_AGGREGATE;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->TotalRecords > 0 && !$Page->isGridAdd() && !$Page->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (footer, left)
$Page->ListOptions->render("footer", "left");
?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code" class="<?= $Page->box_code->footerCellClass() ?>"><span id="elf_check_box_box_code" class="check_box_box_code">
        </span></td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id" class="<?= $Page->store_id->footerCellClass() ?>"><span id="elf_check_box_store_id" class="check_box_store_id">
        </span></td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name" class="<?= $Page->store_name->footerCellClass() ?>"><span id="elf_check_box_store_name" class="check_box_store_name">
        </span></td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article" class="<?= $Page->article->footerCellClass() ?>"><span id="elf_check_box_article" class="check_box_article">
        <span class="ew-aggregate"><?= $Language->phrase("COUNT") ?></span><span class="ew-aggregate-value">
        <?= $Page->article->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td data-name="size_desc" class="<?= $Page->size_desc->footerCellClass() ?>"><span id="elf_check_box_size_desc" class="check_box_size_desc">
        </span></td>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <td data-name="color_code" class="<?= $Page->color_code->footerCellClass() ?>"><span id="elf_check_box_color_code" class="check_box_color_code">
        </span></td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty" class="<?= $Page->picked_qty->footerCellClass() ?>"><span id="elf_check_box_picked_qty" class="check_box_picked_qty">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->picked_qty->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->variance_qty->Visible) { // variance_qty ?>
        <td data-name="variance_qty" class="<?= $Page->variance_qty->footerCellClass() ?>"><span id="elf_check_box_variance_qty" class="check_box_variance_qty">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->variance_qty->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <td data-name="confirmation_date" class="<?= $Page->confirmation_date->footerCellClass() ?>"><span id="elf_check_box_confirmation_date" class="check_box_confirmation_date">
        </span></td>
    <?php } ?>
    <?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
        <td data-name="confirmation_time" class="<?= $Page->confirmation_time->footerCellClass() ?>"><span id="elf_check_box_confirmation_time" class="check_box_confirmation_time">
        </span></td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker" class="<?= $Page->picker->footerCellClass() ?>"><span id="elf_check_box_picker" class="check_box_picker">
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Page->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
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
    ew.addEventHandlers("check_box");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    $(document).on('focus','input[type=search]',function(){
        		this.select();
        		$(".ew-basic-search").focus();
        		});
});
</script>
<?php } ?>

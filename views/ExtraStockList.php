<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ExtraStockList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { extra_stock: currentTable } });
var currentForm, currentPageID;
var fextra_stocklist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fextra_stocklist = new ew.Form("fextra_stocklist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fextra_stocklist;
    fextra_stocklist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fextra_stocklist.lists.week = <?= $Page->week->toClientList($Page) ?>;
    fextra_stocklist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fextra_stocklist.lists.location = <?= $Page->location->toClientList($Page) ?>;
    fextra_stocklist.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    fextra_stocklist.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fextra_stocklist.lists.description = <?= $Page->description->toClientList($Page) ?>;
    fextra_stocklist.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    fextra_stocklist.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    fextra_stocklist.lists.color_desc = <?= $Page->color_desc->toClientList($Page) ?>;
    fextra_stocklist.lists.season = <?= $Page->season->toClientList($Page) ?>;
    fextra_stocklist.lists.no_box = <?= $Page->no_box->toClientList($Page) ?>;
    fextra_stocklist.lists.location_2nd = <?= $Page->location_2nd->toClientList($Page) ?>;
    fextra_stocklist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fextra_stocklist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("fextra_stocklist");
});
var fextra_stocksrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fextra_stocksrch = new ew.Form("fextra_stocksrch", "list");
    currentSearchForm = fextra_stocksrch;

    // Add fields
    var fields = currentTable.fields;
    fextra_stocksrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["week", [], fields.week.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["location", [], fields.location.isInvalid],
        ["ctn", [], fields.ctn.isInvalid],
        ["quantity", [], fields.quantity.isInvalid],
        ["description", [], fields.description.isInvalid],
        ["size_desc", [], fields.size_desc.isInvalid],
        ["color_code", [], fields.color_code.isInvalid],
        ["color_desc", [], fields.color_desc.isInvalid],
        ["season", [], fields.season.isInvalid],
        ["no_box", [], fields.no_box.isInvalid],
        ["location_2nd", [], fields.location_2nd.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    fextra_stocksrch.validate = function () {
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
    fextra_stocksrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fextra_stocksrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fextra_stocksrch.lists.week = <?= $Page->week->toClientList($Page) ?>;
    fextra_stocksrch.lists.art6 = <?= $Page->art6->toClientList($Page) ?>;
    fextra_stocksrch.lists.art9 = <?= $Page->art9->toClientList($Page) ?>;
    fextra_stocksrch.lists.art11 = <?= $Page->art11->toClientList($Page) ?>;
    fextra_stocksrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fextra_stocksrch.lists.location = <?= $Page->location->toClientList($Page) ?>;
    fextra_stocksrch.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    fextra_stocksrch.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fextra_stocksrch.lists.description = <?= $Page->description->toClientList($Page) ?>;
    fextra_stocksrch.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    fextra_stocksrch.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    fextra_stocksrch.lists.color_desc = <?= $Page->color_desc->toClientList($Page) ?>;
    fextra_stocksrch.lists.season = <?= $Page->season->toClientList($Page) ?>;
    fextra_stocksrch.lists.no_box = <?= $Page->no_box->toClientList($Page) ?>;
    fextra_stocksrch.lists.location_2nd = <?= $Page->location_2nd->toClientList($Page) ?>;
    fextra_stocksrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fextra_stocksrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fextra_stocksrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fextra_stocksrch");
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
<form name="fextra_stocksrch" id="fextra_stocksrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fextra_stocksrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="extra_stock">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->week->Visible) { // week ?>
<?php
if (!$Page->week->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_week" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->week->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_week"
            name="x_week[]"
            class="form-control ew-select<?= $Page->week->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_week"
            data-table="extra_stock"
            data-field="x_week"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->week->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->week->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->week->getPlaceHolder()) ?>"
            <?= $Page->week->editAttributes() ?>>
            <?= $Page->week->selectOptionListHtml("x_week", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->week->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_week",
                selectId: "fextra_stocksrch_x_week",
                ajax: { id: "x_week", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.week.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->art6->Visible) { // art6 ?>
<?php
if (!$Page->art6->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_art6" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->art6->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_art6"
            name="x_art6[]"
            class="form-control ew-select<?= $Page->art6->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_art6"
            data-table="extra_stock"
            data-field="x_art6"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->art6->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->art6->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->art6->getPlaceHolder()) ?>"
            <?= $Page->art6->editAttributes() ?>>
            <?= $Page->art6->selectOptionListHtml("x_art6", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->art6->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_art6",
                selectId: "fextra_stocksrch_x_art6",
                ajax: { id: "x_art6", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.art6.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->art9->Visible) { // art9 ?>
<?php
if (!$Page->art9->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_art9" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->art9->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_art9"
            name="x_art9[]"
            class="form-control ew-select<?= $Page->art9->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_art9"
            data-table="extra_stock"
            data-field="x_art9"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->art9->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->art9->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->art9->getPlaceHolder()) ?>"
            <?= $Page->art9->editAttributes() ?>>
            <?= $Page->art9->selectOptionListHtml("x_art9", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->art9->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_art9",
                selectId: "fextra_stocksrch_x_art9",
                ajax: { id: "x_art9", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.art9.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->art11->Visible) { // art11 ?>
<?php
if (!$Page->art11->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_art11" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->art11->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_art11"
            name="x_art11[]"
            class="form-control ew-select<?= $Page->art11->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_art11"
            data-table="extra_stock"
            data-field="x_art11"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->art11->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->art11->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->art11->getPlaceHolder()) ?>"
            <?= $Page->art11->editAttributes() ?>>
            <?= $Page->art11->selectOptionListHtml("x_art11", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->art11->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_art11",
                selectId: "fextra_stocksrch_x_art11",
                ajax: { id: "x_art11", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.art11.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_article"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_article",
                selectId: "fextra_stocksrch_x_article",
                ajax: { id: "x_article", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.article.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
<?php
if (!$Page->location->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_location" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->location->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_location"
            name="x_location[]"
            class="form-control ew-select<?= $Page->location->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_location"
            data-table="extra_stock"
            data-field="x_location"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->location->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->location->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"
            <?= $Page->location->editAttributes() ?>>
            <?= $Page->location->selectOptionListHtml("x_location", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->location->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_location",
                selectId: "fextra_stocksrch_x_location",
                ajax: { id: "x_location", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.location.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
<?php
if (!$Page->ctn->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ctn" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->ctn->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ctn"
            name="x_ctn[]"
            class="form-control ew-select<?= $Page->ctn->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_ctn"
            data-table="extra_stock"
            data-field="x_ctn"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ctn->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ctn->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"
            <?= $Page->ctn->editAttributes() ?>>
            <?= $Page->ctn->selectOptionListHtml("x_ctn", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ctn->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_ctn",
                selectId: "fextra_stocksrch_x_ctn",
                ajax: { id: "x_ctn", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.ctn.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_quantity"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_quantity",
                selectId: "fextra_stocksrch_x_quantity",
                ajax: { id: "x_quantity", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.quantity.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
<?php
if (!$Page->description->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_description" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->description->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_description"
            name="x_description[]"
            class="form-control ew-select<?= $Page->description->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_description"
            data-table="extra_stock"
            data-field="x_description"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->description->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->description->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"
            <?= $Page->description->editAttributes() ?>>
            <?= $Page->description->selectOptionListHtml("x_description", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->description->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_description",
                selectId: "fextra_stocksrch_x_description",
                ajax: { id: "x_description", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.description.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_size_desc"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_size_desc",
                selectId: "fextra_stocksrch_x_size_desc",
                ajax: { id: "x_size_desc", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.size_desc.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_color_code"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_color_code",
                selectId: "fextra_stocksrch_x_color_code",
                ajax: { id: "x_color_code", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.color_code.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_color_desc"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_color_desc",
                selectId: "fextra_stocksrch_x_color_desc",
                ajax: { id: "x_color_desc", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.color_desc.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
<?php
if (!$Page->season->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_season" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->season->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_season"
            name="x_season[]"
            class="form-control ew-select<?= $Page->season->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_season"
            data-table="extra_stock"
            data-field="x_season"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->season->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->season->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->season->getPlaceHolder()) ?>"
            <?= $Page->season->editAttributes() ?>>
            <?= $Page->season->selectOptionListHtml("x_season", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->season->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_season",
                selectId: "fextra_stocksrch_x_season",
                ajax: { id: "x_season", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.season.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
<?php
if (!$Page->no_box->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_box" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_box->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_box"
            name="x_no_box[]"
            class="form-control ew-select<?= $Page->no_box->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_no_box"
            data-table="extra_stock"
            data-field="x_no_box"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_box->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_box->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_box->getPlaceHolder()) ?>"
            <?= $Page->no_box->editAttributes() ?>>
            <?= $Page->no_box->selectOptionListHtml("x_no_box", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_box->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_no_box",
                selectId: "fextra_stocksrch_x_no_box",
                ajax: { id: "x_no_box", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.no_box.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->location_2nd->Visible) { // location_2nd ?>
<?php
if (!$Page->location_2nd->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_location_2nd" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->location_2nd->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_location_2nd"
            name="x_location_2nd[]"
            class="form-control ew-select<?= $Page->location_2nd->isInvalidClass() ?>"
            data-select2-id="fextra_stocksrch_x_location_2nd"
            data-table="extra_stock"
            data-field="x_location_2nd"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->location_2nd->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->location_2nd->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->location_2nd->getPlaceHolder()) ?>"
            <?= $Page->location_2nd->editAttributes() ?>>
            <?= $Page->location_2nd->selectOptionListHtml("x_location_2nd", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->location_2nd->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_location_2nd",
                selectId: "fextra_stocksrch_x_location_2nd",
                ajax: { id: "x_location_2nd", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.location_2nd.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_date_created"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fextra_stocksrch_x_date_created",
                ajax: { id: "x_date_created", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.date_created.filterOptions);
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
            data-select2-id="fextra_stocksrch_x_date_updated"
            data-table="extra_stock"
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
        loadjs.ready("fextra_stocksrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fextra_stocksrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fextra_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.extra_stock.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fextra_stocksrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fextra_stocksrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fextra_stocksrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fextra_stocksrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> extra_stock">
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
<form name="fextra_stocklist" id="fextra_stocklist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="extra_stock">
<div id="gmp_extra_stock" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_extra_stocklist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_id" class="extra_stock_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->week->Visible) { // week ?>
        <th data-name="week" class="<?= $Page->week->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_week" class="extra_stock_week"><?= $Page->renderFieldHeader($Page->week) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_article" class="extra_stock_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_location" class="extra_stock_location"><?= $Page->renderFieldHeader($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th data-name="ctn" class="<?= $Page->ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_ctn" class="extra_stock_ctn"><?= $Page->renderFieldHeader($Page->ctn) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_quantity" class="extra_stock_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Page->description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_description" class="extra_stock_description"><?= $Page->renderFieldHeader($Page->description) ?></div></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th data-name="size_desc" class="<?= $Page->size_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_size_desc" class="extra_stock_size_desc"><?= $Page->renderFieldHeader($Page->size_desc) ?></div></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th data-name="color_code" class="<?= $Page->color_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_color_code" class="extra_stock_color_code"><?= $Page->renderFieldHeader($Page->color_code) ?></div></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th data-name="color_desc" class="<?= $Page->color_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_color_desc" class="extra_stock_color_desc"><?= $Page->renderFieldHeader($Page->color_desc) ?></div></th>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <th data-name="season" class="<?= $Page->season->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_season" class="extra_stock_season"><?= $Page->renderFieldHeader($Page->season) ?></div></th>
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
        <th data-name="no_box" class="<?= $Page->no_box->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_no_box" class="extra_stock_no_box"><?= $Page->renderFieldHeader($Page->no_box) ?></div></th>
<?php } ?>
<?php if ($Page->location_2nd->Visible) { // location_2nd ?>
        <th data-name="location_2nd" class="<?= $Page->location_2nd->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_location_2nd" class="extra_stock_location_2nd"><?= $Page->renderFieldHeader($Page->location_2nd) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_date_created" class="extra_stock_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_extra_stock_date_updated" class="extra_stock_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_extra_stock",
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
<span id="el<?= $Page->RowCount ?>_extra_stock_id" class="el_extra_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->week->Visible) { // week ?>
        <td data-name="week"<?= $Page->week->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_week" class="el_extra_stock_week">
<span<?= $Page->week->viewAttributes() ?>>
<?= $Page->week->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_article" class="el_extra_stock_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_location" class="el_extra_stock_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ctn->Visible) { // ctn ?>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_ctn" class="el_extra_stock_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_quantity" class="el_extra_stock_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_description" class="el_extra_stock_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_size_desc" class="el_extra_stock_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_color_code" class="el_extra_stock_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_color_desc" class="el_extra_stock_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->season->Visible) { // season ?>
        <td data-name="season"<?= $Page->season->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_season" class="el_extra_stock_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_box->Visible) { // no_box ?>
        <td data-name="no_box"<?= $Page->no_box->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_no_box" class="el_extra_stock_no_box">
<span<?= $Page->no_box->viewAttributes() ?>>
<?= $Page->no_box->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location_2nd->Visible) { // location_2nd ?>
        <td data-name="location_2nd"<?= $Page->location_2nd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_location_2nd" class="el_extra_stock_location_2nd">
<span<?= $Page->location_2nd->viewAttributes() ?>>
<?= $Page->location_2nd->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_date_created" class="el_extra_stock_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_extra_stock_date_updated" class="el_extra_stock_date_updated">
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
    ew.addEventHandlers("extra_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

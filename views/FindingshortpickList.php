<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingshortpickList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { findingshortpick: currentTable } });
var currentForm, currentPageID;
var ffindingshortpicklist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffindingshortpicklist = new ew.Form("ffindingshortpicklist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ffindingshortpicklist;
    ffindingshortpicklist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    ffindingshortpicklist.lists.location = <?= $Page->location->toClientList($Page) ?>;
    ffindingshortpicklist.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    ffindingshortpicklist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    ffindingshortpicklist.lists.description = <?= $Page->description->toClientList($Page) ?>;
    ffindingshortpicklist.lists.actual = <?= $Page->actual->toClientList($Page) ?>;
    ffindingshortpicklist.lists.target_quantity = <?= $Page->target_quantity->toClientList($Page) ?>;
    ffindingshortpicklist.lists.pick_quantity = <?= $Page->pick_quantity->toClientList($Page) ?>;
    ffindingshortpicklist.lists.shortpick = <?= $Page->shortpick->toClientList($Page) ?>;
    ffindingshortpicklist.lists.user = <?= $Page->user->toClientList($Page) ?>;
    ffindingshortpicklist.lists.area = <?= $Page->area->toClientList($Page) ?>;
    ffindingshortpicklist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    ffindingshortpicklist.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    ffindingshortpicklist.lists.date_picking = <?= $Page->date_picking->toClientList($Page) ?>;
    loadjs.done("ffindingshortpicklist");
});
var ffindingshortpicksrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ffindingshortpicksrch = new ew.Form("ffindingshortpicksrch", "list");
    currentSearchForm = ffindingshortpicksrch;

    // Add fields
    var fields = currentTable.fields;
    ffindingshortpicksrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["location", [], fields.location.isInvalid],
        ["ctn", [], fields.ctn.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["description", [], fields.description.isInvalid],
        ["actual", [], fields.actual.isInvalid],
        ["target_quantity", [], fields.target_quantity.isInvalid],
        ["pick_quantity", [], fields.pick_quantity.isInvalid],
        ["shortpick", [], fields.shortpick.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["area", [], fields.area.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_upload", [], fields.date_upload.isInvalid],
        ["date_picking", [], fields.date_picking.isInvalid],
        ["short_article", [], fields.short_article.isInvalid],
        ["total", [], fields.total.isInvalid],
        ["excess", [], fields.excess.isInvalid]
    ]);

    // Validate form
    ffindingshortpicksrch.validate = function () {
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
    ffindingshortpicksrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffindingshortpicksrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ffindingshortpicksrch.lists.location = <?= $Page->location->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.description = <?= $Page->description->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.actual = <?= $Page->actual->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.target_quantity = <?= $Page->target_quantity->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.pick_quantity = <?= $Page->pick_quantity->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.shortpick = <?= $Page->shortpick->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.area = <?= $Page->area->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    ffindingshortpicksrch.lists.date_picking = <?= $Page->date_picking->toClientList($Page) ?>;

    // Filters
    ffindingshortpicksrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ffindingshortpicksrch");
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
<form name="ffindingshortpicksrch" id="ffindingshortpicksrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ffindingshortpicksrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="findingshortpick">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
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
            data-select2-id="ffindingshortpicksrch_x_location"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_location",
                selectId: "ffindingshortpicksrch_x_location",
                ajax: { id: "x_location", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.location.filterOptions);
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
            data-select2-id="ffindingshortpicksrch_x_ctn"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_ctn",
                selectId: "ffindingshortpicksrch_x_ctn",
                ajax: { id: "x_ctn", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.ctn.filterOptions);
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
            data-select2-id="ffindingshortpicksrch_x_article"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_article",
                selectId: "ffindingshortpicksrch_x_article",
                ajax: { id: "x_article", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.article.filterOptions);
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
            data-select2-id="ffindingshortpicksrch_x_description"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_description",
                selectId: "ffindingshortpicksrch_x_description",
                ajax: { id: "x_description", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.description.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
<?php
if (!$Page->actual->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_actual" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->actual->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_actual"
            name="x_actual[]"
            class="form-control ew-select<?= $Page->actual->isInvalidClass() ?>"
            data-select2-id="ffindingshortpicksrch_x_actual"
            data-table="findingshortpick"
            data-field="x_actual"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->actual->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->actual->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"
            <?= $Page->actual->editAttributes() ?>>
            <?= $Page->actual->selectOptionListHtml("x_actual", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->actual->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_actual",
                selectId: "ffindingshortpicksrch_x_actual",
                ajax: { id: "x_actual", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.actual.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
<?php
if (!$Page->target_quantity->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_target_quantity" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->target_quantity->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_target_quantity"
            name="x_target_quantity[]"
            class="form-control ew-select<?= $Page->target_quantity->isInvalidClass() ?>"
            data-select2-id="ffindingshortpicksrch_x_target_quantity"
            data-table="findingshortpick"
            data-field="x_target_quantity"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->target_quantity->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->target_quantity->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->target_quantity->getPlaceHolder()) ?>"
            <?= $Page->target_quantity->editAttributes() ?>>
            <?= $Page->target_quantity->selectOptionListHtml("x_target_quantity", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->target_quantity->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_target_quantity",
                selectId: "ffindingshortpicksrch_x_target_quantity",
                ajax: { id: "x_target_quantity", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.target_quantity.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
<?php
if (!$Page->pick_quantity->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_pick_quantity" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->pick_quantity->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_pick_quantity"
            name="x_pick_quantity[]"
            class="form-control ew-select<?= $Page->pick_quantity->isInvalidClass() ?>"
            data-select2-id="ffindingshortpicksrch_x_pick_quantity"
            data-table="findingshortpick"
            data-field="x_pick_quantity"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->pick_quantity->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->pick_quantity->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->pick_quantity->getPlaceHolder()) ?>"
            <?= $Page->pick_quantity->editAttributes() ?>>
            <?= $Page->pick_quantity->selectOptionListHtml("x_pick_quantity", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->pick_quantity->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_pick_quantity",
                selectId: "ffindingshortpicksrch_x_pick_quantity",
                ajax: { id: "x_pick_quantity", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.pick_quantity.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
<?php
if (!$Page->shortpick->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_shortpick" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->shortpick->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_shortpick"
            name="x_shortpick[]"
            class="form-control ew-select<?= $Page->shortpick->isInvalidClass() ?>"
            data-select2-id="ffindingshortpicksrch_x_shortpick"
            data-table="findingshortpick"
            data-field="x_shortpick"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->shortpick->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->shortpick->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->shortpick->getPlaceHolder()) ?>"
            <?= $Page->shortpick->editAttributes() ?>>
            <?= $Page->shortpick->selectOptionListHtml("x_shortpick", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->shortpick->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_shortpick",
                selectId: "ffindingshortpicksrch_x_shortpick",
                ajax: { id: "x_shortpick", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.shortpick.filterOptions);
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
            data-select2-id="ffindingshortpicksrch_x_user"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_user",
                selectId: "ffindingshortpicksrch_x_user",
                ajax: { id: "x_user", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.user.filterOptions);
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
            data-select2-id="ffindingshortpicksrch_x_area"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_area",
                selectId: "ffindingshortpicksrch_x_area",
                ajax: { id: "x_area", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.area.filterOptions);
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
            data-select2-id="ffindingshortpicksrch_x_status"
            data-table="findingshortpick"
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
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_status",
                selectId: "ffindingshortpicksrch_x_status",
                ajax: { id: "x_status", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
<?php
if (!$Page->date_upload->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_upload" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_upload->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_upload"
            name="x_date_upload[]"
            class="form-control ew-select<?= $Page->date_upload->isInvalidClass() ?>"
            data-select2-id="ffindingshortpicksrch_x_date_upload"
            data-table="findingshortpick"
            data-field="x_date_upload"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_upload->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_upload->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"
            <?= $Page->date_upload->editAttributes() ?>>
            <?= $Page->date_upload->selectOptionListHtml("x_date_upload", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_date_upload",
                selectId: "ffindingshortpicksrch_x_date_upload",
                ajax: { id: "x_date_upload", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.date_upload.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
<?php
if (!$Page->date_picking->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_picking" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_picking->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_picking"
            name="x_date_picking[]"
            class="form-control ew-select<?= $Page->date_picking->isInvalidClass() ?>"
            data-select2-id="ffindingshortpicksrch_x_date_picking"
            data-table="findingshortpick"
            data-field="x_date_picking"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_picking->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_picking->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_picking->getPlaceHolder()) ?>"
            <?= $Page->date_picking->editAttributes() ?>>
            <?= $Page->date_picking->selectOptionListHtml("x_date_picking", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_picking->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffindingshortpicksrch", function() {
            var options = {
                name: "x_date_picking",
                selectId: "ffindingshortpicksrch_x_date_picking",
                ajax: { id: "x_date_picking", form: "ffindingshortpicksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.findingshortpick.fields.date_picking.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ffindingshortpicksrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ffindingshortpicksrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ffindingshortpicksrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ffindingshortpicksrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> findingshortpick">
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
<form name="ffindingshortpicklist" id="ffindingshortpicklist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="findingshortpick">
<div id="gmp_findingshortpick" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_findingshortpicklist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_id" class="findingshortpick_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_location" class="findingshortpick_location"><?= $Page->renderFieldHeader($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th data-name="ctn" class="<?= $Page->ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_ctn" class="findingshortpick_ctn"><?= $Page->renderFieldHeader($Page->ctn) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_article" class="findingshortpick_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Page->description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_description" class="findingshortpick_description"><?= $Page->renderFieldHeader($Page->description) ?></div></th>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <th data-name="actual" class="<?= $Page->actual->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_actual" class="findingshortpick_actual"><?= $Page->renderFieldHeader($Page->actual) ?></div></th>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
        <th data-name="target_quantity" class="<?= $Page->target_quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_target_quantity" class="findingshortpick_target_quantity"><?= $Page->renderFieldHeader($Page->target_quantity) ?></div></th>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
        <th data-name="pick_quantity" class="<?= $Page->pick_quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_pick_quantity" class="findingshortpick_pick_quantity"><?= $Page->renderFieldHeader($Page->pick_quantity) ?></div></th>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
        <th data-name="shortpick" class="<?= $Page->shortpick->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_shortpick" class="findingshortpick_shortpick"><?= $Page->renderFieldHeader($Page->shortpick) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_user" class="findingshortpick_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th data-name="area" class="<?= $Page->area->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_area" class="findingshortpick_area"><?= $Page->renderFieldHeader($Page->area) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_status" class="findingshortpick_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th data-name="date_upload" class="<?= $Page->date_upload->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_date_upload" class="findingshortpick_date_upload"><?= $Page->renderFieldHeader($Page->date_upload) ?></div></th>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
        <th data-name="date_picking" class="<?= $Page->date_picking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_findingshortpick_date_picking" class="findingshortpick_date_picking"><?= $Page->renderFieldHeader($Page->date_picking) ?></div></th>
<?php } ?>
<?php if ($Page->short_article->Visible) { // short_article ?>
        <th data-name="short_article" class="<?= $Page->short_article->headerCellClass() ?>"><div id="elh_findingshortpick_short_article" class="findingshortpick_short_article"><?= $Page->renderFieldHeader($Page->short_article) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_findingshortpick_total" class="findingshortpick_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
        <th data-name="excess" class="<?= $Page->excess->headerCellClass() ?>"><div id="elh_findingshortpick_excess" class="findingshortpick_excess"><?= $Page->renderFieldHeader($Page->excess) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_findingshortpick",
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
<span id="el<?= $Page->RowCount ?>_findingshortpick_id" class="el_findingshortpick_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_location" class="el_findingshortpick_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ctn->Visible) { // ctn ?>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_ctn" class="el_findingshortpick_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_article" class="el_findingshortpick_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_description" class="el_findingshortpick_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->actual->Visible) { // actual ?>
        <td data-name="actual"<?= $Page->actual->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_actual" class="el_findingshortpick_actual">
<span<?= $Page->actual->viewAttributes() ?>>
<?= $Page->actual->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->target_quantity->Visible) { // target_quantity ?>
        <td data-name="target_quantity"<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_target_quantity" class="el_findingshortpick_target_quantity">
<span<?= $Page->target_quantity->viewAttributes() ?>>
<?= $Page->target_quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
        <td data-name="pick_quantity"<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_pick_quantity" class="el_findingshortpick_pick_quantity">
<span<?= $Page->pick_quantity->viewAttributes() ?>>
<?= $Page->pick_quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shortpick->Visible) { // shortpick ?>
        <td data-name="shortpick"<?= $Page->shortpick->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_shortpick" class="el_findingshortpick_shortpick">
<span<?= $Page->shortpick->viewAttributes() ?>>
<?= $Page->shortpick->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_user" class="el_findingshortpick_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->area->Visible) { // area ?>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_area" class="el_findingshortpick_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_status" class="el_findingshortpick_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_date_upload" class="el_findingshortpick_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_picking->Visible) { // date_picking ?>
        <td data-name="date_picking"<?= $Page->date_picking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_date_picking" class="el_findingshortpick_date_picking">
<span<?= $Page->date_picking->viewAttributes() ?>>
<?= $Page->date_picking->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->short_article->Visible) { // short_article ?>
        <td data-name="short_article"<?= $Page->short_article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_short_article" class="el_findingshortpick_short_article">
<span<?= $Page->short_article->viewAttributes() ?>>
<?= $Page->short_article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_total" class="el_findingshortpick_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->excess->Visible) { // excess ?>
        <td data-name="excess"<?= $Page->excess->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_findingshortpick_excess" class="el_findingshortpick_excess">
<span<?= $Page->excess->viewAttributes() ?>>
<?= $Page->excess->getViewValue() ?></span>
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
    ew.addEventHandlers("findingshortpick");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

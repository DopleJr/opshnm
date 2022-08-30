<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpick2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick2: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpick2list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffinding_shortpick2list = new ew.Form("ffinding_shortpick2list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ffinding_shortpick2list;
    ffinding_shortpick2list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    ffinding_shortpick2list.lists.location = <?= $Page->location->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.article = <?= $Page->article->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.description = <?= $Page->description->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.avaiable = <?= $Page->avaiable->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.web = <?= $Page->web->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.target_quantity = <?= $Page->target_quantity->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.shortpick = <?= $Page->shortpick->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.actual = <?= $Page->actual->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.pick_quantity = <?= $Page->pick_quantity->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.excess = <?= $Page->excess->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.user = <?= $Page->user->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.area = <?= $Page->area->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.status = <?= $Page->status->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.date_shortpick = <?= $Page->date_shortpick->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.date_picking = <?= $Page->date_picking->toClientList($Page) ?>;
    ffinding_shortpick2list.lists.time_picking = <?= $Page->time_picking->toClientList($Page) ?>;
    loadjs.done("ffinding_shortpick2list");
});
var ffinding_shortpick2srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ffinding_shortpick2srch = new ew.Form("ffinding_shortpick2srch", "list");
    currentSearchForm = ffinding_shortpick2srch;

    // Add fields
    var fields = currentTable.fields;
    ffinding_shortpick2srch.addFields([
        ["id", [], fields.id.isInvalid],
        ["location", [], fields.location.isInvalid],
        ["ctn", [], fields.ctn.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["description", [], fields.description.isInvalid],
        ["avaiable", [], fields.avaiable.isInvalid],
        ["web", [], fields.web.isInvalid],
        ["target_quantity", [], fields.target_quantity.isInvalid],
        ["shortpick", [], fields.shortpick.isInvalid],
        ["actual", [], fields.actual.isInvalid],
        ["pick_quantity", [], fields.pick_quantity.isInvalid],
        ["excess", [], fields.excess.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["area", [], fields.area.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_shortpick", [], fields.date_shortpick.isInvalid],
        ["date_upload", [], fields.date_upload.isInvalid],
        ["y_date_upload", [ew.Validators.between], false],
        ["date_picking", [], fields.date_picking.isInvalid],
        ["y_date_picking", [ew.Validators.between], false],
        ["time_picking", [], fields.time_picking.isInvalid]
    ]);

    // Validate form
    ffinding_shortpick2srch.validate = function () {
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
    ffinding_shortpick2srch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffinding_shortpick2srch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ffinding_shortpick2srch.lists.location = <?= $Page->location->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.description = <?= $Page->description->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.avaiable = <?= $Page->avaiable->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.web = <?= $Page->web->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.target_quantity = <?= $Page->target_quantity->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.shortpick = <?= $Page->shortpick->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.actual = <?= $Page->actual->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.pick_quantity = <?= $Page->pick_quantity->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.excess = <?= $Page->excess->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.area = <?= $Page->area->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.date_shortpick = <?= $Page->date_shortpick->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.date_picking = <?= $Page->date_picking->toClientList($Page) ?>;
    ffinding_shortpick2srch.lists.time_picking = <?= $Page->time_picking->toClientList($Page) ?>;

    // Filters
    ffinding_shortpick2srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ffinding_shortpick2srch");
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
<form name="ffinding_shortpick2srch" id="ffinding_shortpick2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ffinding_shortpick2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="finding_shortpick2">
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
            data-select2-id="ffinding_shortpick2srch_x_location"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_location",
                selectId: "ffinding_shortpick2srch_x_location",
                ajax: { id: "x_location", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.location.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_ctn"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_ctn",
                selectId: "ffinding_shortpick2srch_x_ctn",
                ajax: { id: "x_ctn", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.ctn.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_article"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_article",
                selectId: "ffinding_shortpick2srch_x_article",
                ajax: { id: "x_article", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.article.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_description"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_description",
                selectId: "ffinding_shortpick2srch_x_description",
                ajax: { id: "x_description", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.description.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->avaiable->Visible) { // avaiable ?>
<?php
if (!$Page->avaiable->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_avaiable" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->avaiable->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_avaiable"
            name="x_avaiable[]"
            class="form-control ew-select<?= $Page->avaiable->isInvalidClass() ?>"
            data-select2-id="ffinding_shortpick2srch_x_avaiable"
            data-table="finding_shortpick2"
            data-field="x_avaiable"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->avaiable->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->avaiable->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->avaiable->getPlaceHolder()) ?>"
            <?= $Page->avaiable->editAttributes() ?>>
            <?= $Page->avaiable->selectOptionListHtml("x_avaiable", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->avaiable->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_avaiable",
                selectId: "ffinding_shortpick2srch_x_avaiable",
                ajax: { id: "x_avaiable", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.avaiable.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
<?php
if (!$Page->web->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_web" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->web->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_web"
            name="x_web[]"
            class="form-control ew-select<?= $Page->web->isInvalidClass() ?>"
            data-select2-id="ffinding_shortpick2srch_x_web"
            data-table="finding_shortpick2"
            data-field="x_web"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->web->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->web->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->web->getPlaceHolder()) ?>"
            <?= $Page->web->editAttributes() ?>>
            <?= $Page->web->selectOptionListHtml("x_web", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->web->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_web",
                selectId: "ffinding_shortpick2srch_x_web",
                ajax: { id: "x_web", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.web.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_target_quantity"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_target_quantity",
                selectId: "ffinding_shortpick2srch_x_target_quantity",
                ajax: { id: "x_target_quantity", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.target_quantity.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_shortpick"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_shortpick",
                selectId: "ffinding_shortpick2srch_x_shortpick",
                ajax: { id: "x_shortpick", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.shortpick.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_actual"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_actual",
                selectId: "ffinding_shortpick2srch_x_actual",
                ajax: { id: "x_actual", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.actual.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_pick_quantity"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_pick_quantity",
                selectId: "ffinding_shortpick2srch_x_pick_quantity",
                ajax: { id: "x_pick_quantity", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.pick_quantity.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
<?php
if (!$Page->excess->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_excess" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->excess->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_excess"
            name="x_excess[]"
            class="form-control ew-select<?= $Page->excess->isInvalidClass() ?>"
            data-select2-id="ffinding_shortpick2srch_x_excess"
            data-table="finding_shortpick2"
            data-field="x_excess"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->excess->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->excess->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->excess->getPlaceHolder()) ?>"
            <?= $Page->excess->editAttributes() ?>>
            <?= $Page->excess->selectOptionListHtml("x_excess", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->excess->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_excess",
                selectId: "ffinding_shortpick2srch_x_excess",
                ajax: { id: "x_excess", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.excess.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_user"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_user",
                selectId: "ffinding_shortpick2srch_x_user",
                ajax: { id: "x_user", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.user.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_area"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_area",
                selectId: "ffinding_shortpick2srch_x_area",
                ajax: { id: "x_area", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.area.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_status"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_status",
                selectId: "ffinding_shortpick2srch_x_status",
                ajax: { id: "x_status", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
<?php
if (!$Page->date_shortpick->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_shortpick" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_shortpick->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_shortpick"
            name="x_date_shortpick[]"
            class="form-control ew-select<?= $Page->date_shortpick->isInvalidClass() ?>"
            data-select2-id="ffinding_shortpick2srch_x_date_shortpick"
            data-table="finding_shortpick2"
            data-field="x_date_shortpick"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_shortpick->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_shortpick->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_shortpick->getPlaceHolder()) ?>"
            <?= $Page->date_shortpick->editAttributes() ?>>
            <?= $Page->date_shortpick->selectOptionListHtml("x_date_shortpick", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_shortpick->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_date_shortpick",
                selectId: "ffinding_shortpick2srch_x_date_shortpick",
                ajax: { id: "x_date_shortpick", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.date_shortpick.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_date_upload"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_date_upload",
                selectId: "ffinding_shortpick2srch_x_date_upload",
                ajax: { id: "x_date_upload", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.date_upload.filterOptions);
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
            data-select2-id="ffinding_shortpick2srch_x_date_picking"
            data-table="finding_shortpick2"
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
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_date_picking",
                selectId: "ffinding_shortpick2srch_x_date_picking",
                ajax: { id: "x_date_picking", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.date_picking.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->time_picking->Visible) { // time_picking ?>
<?php
if (!$Page->time_picking->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_time_picking" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->time_picking->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_time_picking"
            name="x_time_picking[]"
            class="form-control ew-select<?= $Page->time_picking->isInvalidClass() ?>"
            data-select2-id="ffinding_shortpick2srch_x_time_picking"
            data-table="finding_shortpick2"
            data-field="x_time_picking"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->time_picking->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->time_picking->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->time_picking->getPlaceHolder()) ?>"
            <?= $Page->time_picking->editAttributes() ?>>
            <?= $Page->time_picking->selectOptionListHtml("x_time_picking", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->time_picking->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ffinding_shortpick2srch", function() {
            var options = {
                name: "x_time_picking",
                selectId: "ffinding_shortpick2srch_x_time_picking",
                ajax: { id: "x_time_picking", form: "ffinding_shortpick2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.finding_shortpick2.fields.time_picking.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ffinding_shortpick2srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ffinding_shortpick2srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ffinding_shortpick2srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ffinding_shortpick2srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> finding_shortpick2">
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
<form name="ffinding_shortpick2list" id="ffinding_shortpick2list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick2">
<div id="gmp_finding_shortpick2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_finding_shortpick2list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_id" class="finding_shortpick2_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_location" class="finding_shortpick2_location"><?= $Page->renderFieldHeader($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th data-name="ctn" class="<?= $Page->ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_ctn" class="finding_shortpick2_ctn"><?= $Page->renderFieldHeader($Page->ctn) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_article" class="finding_shortpick2_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Page->description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_description" class="finding_shortpick2_description"><?= $Page->renderFieldHeader($Page->description) ?></div></th>
<?php } ?>
<?php if ($Page->avaiable->Visible) { // avaiable ?>
        <th data-name="avaiable" class="<?= $Page->avaiable->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_avaiable" class="finding_shortpick2_avaiable"><?= $Page->renderFieldHeader($Page->avaiable) ?></div></th>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
        <th data-name="web" class="<?= $Page->web->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_web" class="finding_shortpick2_web"><?= $Page->renderFieldHeader($Page->web) ?></div></th>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
        <th data-name="target_quantity" class="<?= $Page->target_quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_target_quantity" class="finding_shortpick2_target_quantity"><?= $Page->renderFieldHeader($Page->target_quantity) ?></div></th>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
        <th data-name="shortpick" class="<?= $Page->shortpick->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_shortpick" class="finding_shortpick2_shortpick"><?= $Page->renderFieldHeader($Page->shortpick) ?></div></th>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <th data-name="actual" class="<?= $Page->actual->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_actual" class="finding_shortpick2_actual"><?= $Page->renderFieldHeader($Page->actual) ?></div></th>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
        <th data-name="pick_quantity" class="<?= $Page->pick_quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_pick_quantity" class="finding_shortpick2_pick_quantity"><?= $Page->renderFieldHeader($Page->pick_quantity) ?></div></th>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
        <th data-name="excess" class="<?= $Page->excess->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_excess" class="finding_shortpick2_excess"><?= $Page->renderFieldHeader($Page->excess) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_user" class="finding_shortpick2_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th data-name="area" class="<?= $Page->area->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_area" class="finding_shortpick2_area"><?= $Page->renderFieldHeader($Page->area) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_status" class="finding_shortpick2_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
        <th data-name="date_shortpick" class="<?= $Page->date_shortpick->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_date_shortpick" class="finding_shortpick2_date_shortpick"><?= $Page->renderFieldHeader($Page->date_shortpick) ?></div></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th data-name="date_upload" class="<?= $Page->date_upload->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_date_upload" class="finding_shortpick2_date_upload"><?= $Page->renderFieldHeader($Page->date_upload) ?></div></th>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
        <th data-name="date_picking" class="<?= $Page->date_picking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_date_picking" class="finding_shortpick2_date_picking"><?= $Page->renderFieldHeader($Page->date_picking) ?></div></th>
<?php } ?>
<?php if ($Page->time_picking->Visible) { // time_picking ?>
        <th data-name="time_picking" class="<?= $Page->time_picking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_finding_shortpick2_time_picking" class="finding_shortpick2_time_picking"><?= $Page->renderFieldHeader($Page->time_picking) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_finding_shortpick2",
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
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_id" class="el_finding_shortpick2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_location" class="el_finding_shortpick2_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ctn->Visible) { // ctn ?>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_ctn" class="el_finding_shortpick2_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_article" class="el_finding_shortpick2_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_description" class="el_finding_shortpick2_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->avaiable->Visible) { // avaiable ?>
        <td data-name="avaiable"<?= $Page->avaiable->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_avaiable" class="el_finding_shortpick2_avaiable">
<span<?= $Page->avaiable->viewAttributes() ?>>
<?= $Page->avaiable->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->web->Visible) { // web ?>
        <td data-name="web"<?= $Page->web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_web" class="el_finding_shortpick2_web">
<span<?= $Page->web->viewAttributes() ?>>
<?= $Page->web->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->target_quantity->Visible) { // target_quantity ?>
        <td data-name="target_quantity"<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_target_quantity" class="el_finding_shortpick2_target_quantity">
<span<?= $Page->target_quantity->viewAttributes() ?>>
<?= $Page->target_quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shortpick->Visible) { // shortpick ?>
        <td data-name="shortpick"<?= $Page->shortpick->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_shortpick" class="el_finding_shortpick2_shortpick">
<span<?= $Page->shortpick->viewAttributes() ?>>
<?= $Page->shortpick->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->actual->Visible) { // actual ?>
        <td data-name="actual"<?= $Page->actual->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_actual" class="el_finding_shortpick2_actual">
<span<?= $Page->actual->viewAttributes() ?>>
<?= $Page->actual->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
        <td data-name="pick_quantity"<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_pick_quantity" class="el_finding_shortpick2_pick_quantity">
<span<?= $Page->pick_quantity->viewAttributes() ?>>
<?= $Page->pick_quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->excess->Visible) { // excess ?>
        <td data-name="excess"<?= $Page->excess->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_excess" class="el_finding_shortpick2_excess">
<span<?= $Page->excess->viewAttributes() ?>>
<?= $Page->excess->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_user" class="el_finding_shortpick2_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->area->Visible) { // area ?>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_area" class="el_finding_shortpick2_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_status" class="el_finding_shortpick2_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
        <td data-name="date_shortpick"<?= $Page->date_shortpick->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_date_shortpick" class="el_finding_shortpick2_date_shortpick">
<span<?= $Page->date_shortpick->viewAttributes() ?>>
<?= $Page->date_shortpick->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_date_upload" class="el_finding_shortpick2_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_picking->Visible) { // date_picking ?>
        <td data-name="date_picking"<?= $Page->date_picking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_date_picking" class="el_finding_shortpick2_date_picking">
<span<?= $Page->date_picking->viewAttributes() ?>>
<?= $Page->date_picking->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_picking->Visible) { // time_picking ?>
        <td data-name="time_picking"<?= $Page->time_picking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_finding_shortpick2_time_picking" class="el_finding_shortpick2_time_picking">
<span<?= $Page->time_picking->viewAttributes() ?>>
<?= $Page->time_picking->getViewValue() ?></span>
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
    ew.addEventHandlers("finding_shortpick2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$AuditPickingOnlineList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { audit_picking_online: currentTable } });
var currentForm, currentPageID;
var faudit_picking_onlinelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faudit_picking_onlinelist = new ew.Form("faudit_picking_onlinelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = faudit_picking_onlinelist;
    faudit_picking_onlinelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    faudit_picking_onlinelist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    faudit_picking_onlinelist.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;
    loadjs.done("faudit_picking_onlinelist");
});
var faudit_picking_onlinesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    faudit_picking_onlinesrch = new ew.Form("faudit_picking_onlinesrch", "list");
    currentSearchForm = faudit_picking_onlinesrch;

    // Add fields
    var fields = currentTable.fields;
    faudit_picking_onlinesrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["box_code", [], fields.box_code.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["checker", [], fields.checker.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["date_update", [], fields.date_update.isInvalid],
        ["time_update", [], fields.time_update.isInvalid]
    ]);

    // Validate form
    faudit_picking_onlinesrch.validate = function () {
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
    faudit_picking_onlinesrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faudit_picking_onlinesrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    faudit_picking_onlinesrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.scan = <?= $Page->scan->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.scan_qty = <?= $Page->scan_qty->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    faudit_picking_onlinesrch.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;

    // Filters
    faudit_picking_onlinesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("faudit_picking_onlinesrch");
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
<form name="faudit_picking_onlinesrch" id="faudit_picking_onlinesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="faudit_picking_onlinesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="audit_picking_online">
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
            data-select2-id="faudit_picking_onlinesrch_x_id"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_id",
                selectId: "faudit_picking_onlinesrch_x_id",
                ajax: { id: "x_id", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
<?php
if (!$Page->scan->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_scan" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->scan->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_scan"
            name="x_scan[]"
            class="form-control ew-select<?= $Page->scan->isInvalidClass() ?>"
            data-select2-id="faudit_picking_onlinesrch_x_scan"
            data-table="audit_picking_online"
            data-field="x_scan"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->scan->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->scan->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->scan->getPlaceHolder()) ?>"
            <?= $Page->scan->editAttributes() ?>>
            <?= $Page->scan->selectOptionListHtml("x_scan", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->scan->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_scan",
                selectId: "faudit_picking_onlinesrch_x_scan",
                ajax: { id: "x_scan", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.scan.filterOptions);
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
            data-select2-id="faudit_picking_onlinesrch_x_box_code"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_box_code",
                selectId: "faudit_picking_onlinesrch_x_box_code",
                ajax: { id: "x_box_code", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.box_code.filterOptions);
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
            data-select2-id="faudit_picking_onlinesrch_x_store_id"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_store_id",
                selectId: "faudit_picking_onlinesrch_x_store_id",
                ajax: { id: "x_store_id", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.store_id.filterOptions);
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
            data-select2-id="faudit_picking_onlinesrch_x_store_name"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "faudit_picking_onlinesrch_x_store_name",
                ajax: { id: "x_store_name", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.store_name.filterOptions);
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
            data-select2-id="faudit_picking_onlinesrch_x_picked_qty"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_picked_qty",
                selectId: "faudit_picking_onlinesrch_x_picked_qty",
                ajax: { id: "x_picked_qty", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.picked_qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
<?php
if (!$Page->scan_qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_scan_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->scan_qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_scan_qty"
            name="x_scan_qty[]"
            class="form-control ew-select<?= $Page->scan_qty->isInvalidClass() ?>"
            data-select2-id="faudit_picking_onlinesrch_x_scan_qty"
            data-table="audit_picking_online"
            data-field="x_scan_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->scan_qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->scan_qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->scan_qty->getPlaceHolder()) ?>"
            <?= $Page->scan_qty->editAttributes() ?>>
            <?= $Page->scan_qty->selectOptionListHtml("x_scan_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->scan_qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_scan_qty",
                selectId: "faudit_picking_onlinesrch_x_scan_qty",
                ajax: { id: "x_scan_qty", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.scan_qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
<?php
if (!$Page->checker->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_checker" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->checker->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_checker"
            name="x_checker[]"
            class="form-control ew-select<?= $Page->checker->isInvalidClass() ?>"
            data-select2-id="faudit_picking_onlinesrch_x_checker"
            data-table="audit_picking_online"
            data-field="x_checker"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->checker->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->checker->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->checker->getPlaceHolder()) ?>"
            <?= $Page->checker->editAttributes() ?>>
            <?= $Page->checker->selectOptionListHtml("x_checker", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->checker->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_checker",
                selectId: "faudit_picking_onlinesrch_x_checker",
                ajax: { id: "x_checker", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.checker.filterOptions);
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
            data-select2-id="faudit_picking_onlinesrch_x_status"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_status",
                selectId: "faudit_picking_onlinesrch_x_status",
                ajax: { id: "x_status", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.status.filterOptions);
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
            data-select2-id="faudit_picking_onlinesrch_x_article"
            data-table="audit_picking_online"
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
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_article",
                selectId: "faudit_picking_onlinesrch_x_article",
                ajax: { id: "x_article", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.article.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
<?php
if (!$Page->date_update->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_update" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_update->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_update"
            name="x_date_update[]"
            class="form-control ew-select<?= $Page->date_update->isInvalidClass() ?>"
            data-select2-id="faudit_picking_onlinesrch_x_date_update"
            data-table="audit_picking_online"
            data-field="x_date_update"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_update->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_update->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_update->getPlaceHolder()) ?>"
            <?= $Page->date_update->editAttributes() ?>>
            <?= $Page->date_update->selectOptionListHtml("x_date_update", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_update->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_date_update",
                selectId: "faudit_picking_onlinesrch_x_date_update",
                ajax: { id: "x_date_update", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.date_update.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
<?php
if (!$Page->time_update->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_time_update" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->time_update->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_time_update"
            name="x_time_update[]"
            class="form-control ew-select<?= $Page->time_update->isInvalidClass() ?>"
            data-select2-id="faudit_picking_onlinesrch_x_time_update"
            data-table="audit_picking_online"
            data-field="x_time_update"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->time_update->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->time_update->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->time_update->getPlaceHolder()) ?>"
            <?= $Page->time_update->editAttributes() ?>>
            <?= $Page->time_update->selectOptionListHtml("x_time_update", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->time_update->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("faudit_picking_onlinesrch", function() {
            var options = {
                name: "x_time_update",
                selectId: "faudit_picking_onlinesrch_x_time_update",
                ajax: { id: "x_time_update", form: "faudit_picking_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.audit_picking_online.fields.time_update.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="faudit_picking_onlinesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="faudit_picking_onlinesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="faudit_picking_onlinesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="faudit_picking_onlinesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> audit_picking_online">
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
<form name="faudit_picking_onlinelist" id="faudit_picking_onlinelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="audit_picking_online">
<div id="gmp_audit_picking_online" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_audit_picking_onlinelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_id" class="audit_picking_online_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th data-name="box_code" class="<?= $Page->box_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_box_code" class="audit_picking_online_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_store_id" class="audit_picking_online_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_store_name" class="audit_picking_online_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th data-name="checker" class="<?= $Page->checker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_checker" class="audit_picking_online_checker"><?= $Page->renderFieldHeader($Page->checker) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_status" class="audit_picking_online_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_article" class="audit_picking_online_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th data-name="date_update" class="<?= $Page->date_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_audit_picking_online_date_update" class="audit_picking_online_date_update"><?= $Page->renderFieldHeader($Page->date_update) ?></div></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th data-name="time_update" class="<?= $Page->time_update->headerCellClass() ?>"><div id="elh_audit_picking_online_time_update" class="audit_picking_online_time_update"><?= $Page->renderFieldHeader($Page->time_update) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_audit_picking_online",
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
<span id="el<?= $Page->RowCount ?>_audit_picking_online_id" class="el_audit_picking_online_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_box_code" class="el_audit_picking_online_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_store_id" class="el_audit_picking_online_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_store_name" class="el_audit_picking_online_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->checker->Visible) { // checker ?>
        <td data-name="checker"<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_checker" class="el_audit_picking_online_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_status" class="el_audit_picking_online_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_article" class="el_audit_picking_online_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_update->Visible) { // date_update ?>
        <td data-name="date_update"<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_date_update" class="el_audit_picking_online_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_update->Visible) { // time_update ?>
        <td data-name="time_update"<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_audit_picking_online_time_update" class="el_audit_picking_online_time_update">
<span<?= $Page->time_update->viewAttributes() ?>>
<?= $Page->time_update->getViewValue() ?></span>
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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" class="<?= $Page->id->footerCellClass() ?>"><span id="elf_audit_picking_online_id" class="audit_picking_online_id">
        </span></td>
    <?php } ?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code" class="<?= $Page->box_code->footerCellClass() ?>"><span id="elf_audit_picking_online_box_code" class="audit_picking_online_box_code">
        </span></td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id" class="<?= $Page->store_id->footerCellClass() ?>"><span id="elf_audit_picking_online_store_id" class="audit_picking_online_store_id">
        </span></td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name" class="<?= $Page->store_name->footerCellClass() ?>"><span id="elf_audit_picking_online_store_name" class="audit_picking_online_store_name">
        </span></td>
    <?php } ?>
    <?php if ($Page->checker->Visible) { // checker ?>
        <td data-name="checker" class="<?= $Page->checker->footerCellClass() ?>"><span id="elf_audit_picking_online_checker" class="audit_picking_online_checker">
        </span></td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" class="<?= $Page->status->footerCellClass() ?>"><span id="elf_audit_picking_online_status" class="audit_picking_online_status">
        </span></td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article" class="<?= $Page->article->footerCellClass() ?>"><span id="elf_audit_picking_online_article" class="audit_picking_online_article">
        <span class="ew-aggregate"><?= $Language->phrase("COUNT") ?></span><span class="ew-aggregate-value">
        <?= $Page->article->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->date_update->Visible) { // date_update ?>
        <td data-name="date_update" class="<?= $Page->date_update->footerCellClass() ?>"><span id="elf_audit_picking_online_date_update" class="audit_picking_online_date_update">
        </span></td>
    <?php } ?>
    <?php if ($Page->time_update->Visible) { // time_update ?>
        <td data-name="time_update" class="<?= $Page->time_update->footerCellClass() ?>"><span id="elf_audit_picking_online_time_update" class="audit_picking_online_time_update">
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
    ew.addEventHandlers("audit_picking_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

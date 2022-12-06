<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OnStagingSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { OnStaging: currentTable } });
var currentForm, currentPageID;
var fOnStagingsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fOnStagingsrch = new ew.Form("fOnStagingsrch", "summary");
    currentSearchForm = fOnStagingsrch;
    currentPageID = ew.PAGE_ID = "summary";

    // Add fields
    var fields = currentTable.fields;
    fOnStagingsrch.addFields([
        ["quantity", [], fields.quantity.isInvalid],
        ["picking_date", [], fields.picking_date.isInvalid],
        ["y_picking_date", [ew.Validators.between], false],
        ["line", [], fields.line.isInvalid]
    ]);

    // Validate form
    fOnStagingsrch.validate = function () {
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
    fOnStagingsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fOnStagingsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fOnStagingsrch.lists.week = <?= $Page->week->toClientList($Page) ?>;
    fOnStagingsrch.lists.aging = <?= $Page->aging->toClientList($Page) ?>;
    fOnStagingsrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fOnStagingsrch.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    fOnStagingsrch.lists.box_id = <?= $Page->box_id->toClientList($Page) ?>;
    fOnStagingsrch.lists.type = <?= $Page->type->toClientList($Page) ?>;
    fOnStagingsrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fOnStagingsrch.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fOnStagingsrch.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fOnStagingsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fOnStagingsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fOnStagingsrch.lists.users = <?= $Page->users->toClientList($Page) ?>;
    fOnStagingsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fOnStagingsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fOnStagingsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Top Container -->
<div class="row">
    <div id="ew-top" class="<?= $Page->TopContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up page break
    if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
        // Page_Breaking server event
        $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

        // Set up chart page break
        $Page->OnStaging->PageBreakType = "after"; // Page break type
        $Page->OnStaging->PageBreak = $Page->ExportChartPageBreak;
        $Page->OnStaging->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->OnStaging->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->OnStaging->render("ew-chart-top");
}
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    </div>
</div>
<!-- /#ew-top -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?= $Page->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fOnStagingsrch" id="fOnStagingsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fOnStagingsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="OnStaging">
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
            data-select2-id="fOnStagingsrch_x_week"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->week->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_week",
                selectId: "fOnStagingsrch_x_week",
                ajax: { id: "x_week", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.week.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->aging->Visible) { // aging ?>
<?php
if (!$Page->aging->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_aging" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->aging->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_aging"
            name="x_aging[]"
            class="form-control ew-select<?= $Page->aging->isInvalidClass() ?>"
            data-select2-id="fOnStagingsrch_x_aging"
            data-table="OnStaging"
            data-field="x_aging"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->aging->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->aging->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->aging->getPlaceHolder()) ?>"
            <?= $Page->aging->editAttributes() ?>>
            <?= $Page->aging->selectOptionListHtml("x_aging", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->aging->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_aging",
                selectId: "fOnStagingsrch_x_aging",
                ajax: { id: "x_aging", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.aging.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_store_name"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "fOnStagingsrch_x_store_name",
                ajax: { id: "x_store_name", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.store_name.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_store_code"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->store_code->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_store_code",
                selectId: "fOnStagingsrch_x_store_code",
                ajax: { id: "x_store_code", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.store_code.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_box_id"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_box_id",
                selectId: "fOnStagingsrch_x_box_id",
                ajax: { id: "x_box_id", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.box_id.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_type"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_type",
                selectId: "fOnStagingsrch_x_type",
                ajax: { id: "x_type", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.type.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_concept"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_concept",
                selectId: "fOnStagingsrch_x_concept",
                ajax: { id: "x_concept", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.concept.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_quantity"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_quantity",
                selectId: "fOnStagingsrch_x_quantity",
                ajax: { id: "x_quantity", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.quantity.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_picking_date"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->picking_date->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_picking_date",
                selectId: "fOnStagingsrch_x_picking_date",
                ajax: { id: "x_picking_date", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.picking_date.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_date_created"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fOnStagingsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.date_created.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_status"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fOnStagingsrch_x_status",
                ajax: { id: "x_status", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.status.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_users"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->users->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_users",
                selectId: "fOnStagingsrch_x_users",
                ajax: { id: "x_users", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.users.filterOptions);
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
            data-select2-id="fOnStagingsrch_x_date_updated"
            data-table="OnStaging"
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
        <div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOnStagingsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fOnStagingsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fOnStagingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OnStaging.fields.date_updated.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Page->GroupCount <= count($Page->GroupRecords) && $Page->GroupCount <= $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<?php if ($Page->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?= $Page->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_OnStaging" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->picking_date->Visible) { ?>
    <?php if ($Page->picking_date->ShowGroupHeaderAsRow) { ?>
    <th data-name="picking_date">&nbsp;</th>
    <?php } else { ?>
    <th data-name="picking_date" class="<?= $Page->picking_date->headerCellClass() ?>" style="white-space: nowrap;"><div class="OnStaging_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
    <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div class="OnStaging_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->line->Visible) { ?>
    <th data-name="line" class="<?= $Page->line->headerCellClass() ?>"><div class="OnStaging_line"><?= $Page->renderFieldHeader($Page->line) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php

    // Build detail SQL
    $where = DetailFilterSql($Page->picking_date, $Page->getSqlFirstGroupField(), $Page->picking_date->groupValue(), $Page->Dbid);
    if ($Page->PageFirstGroupFilter != "") {
        $Page->PageFirstGroupFilter .= " OR ";
    }
    $Page->PageFirstGroupFilter .= $where;
    if ($Page->Filter != "") {
        $where = "($Page->Filter) AND ($where)";
    }
    $sql = $Page->buildReportSql($Page->getSqlSelect(), $Page->getSqlFrom(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $where, $Page->Sort);
    $rs = $sql->execute();
    $Page->DetailRecords = $rs ? $rs->fetchAll() : [];
    $Page->DetailRecordCount = count($Page->DetailRecords);
    $Page->setGroupCount($Page->DetailRecordCount, $Page->GroupCount);

    // Load detail records
    $Page->picking_date->Records = &$Page->DetailRecords;
    $Page->picking_date->LevelBreak = true; // Set field level break
        $Page->GroupCounter[1] = $Page->GroupCount;
        $Page->picking_date->getCnt($Page->picking_date->Records); // Get record count
        $Page->setGroupCount($Page->picking_date->Count, $Page->GroupCounter[1]);
?>
<?php if ($Page->picking_date->Visible && $Page->picking_date->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_TOTAL;
        $Page->RowTotalType = ROWTOTAL_GROUP;
        $Page->RowTotalSubType = ROWTOTAL_HEADER;
        $Page->RowGroupLevel = 1;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->picking_date->Visible) { ?>
        <?php $Page->picking_date->CellAttrs->appendClass("ew-rpt-grp-caret"); ?>
        <td data-field="picking_date"<?= $Page->picking_date->cellAttributes(); ?>><i class="ew-group-toggle fas fa-caret-down"></i></td>
        <?php $Page->picking_date->CellAttrs->removeClass("ew-rpt-grp-caret"); ?>
<?php } ?>
        <td data-field="picking_date" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?= $Page->picking_date->cellAttributes() ?>>
            <span class="ew-summary-caption OnStaging_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->picking_date->viewAttributes() ?>><?= $Page->picking_date->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->picking_date->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
        $Page->RecordCount = 0; // Reset record count
        foreach ($Page->picking_date->Records as $record) {
            $Page->RecordCount++;
            $Page->RecordIndex++;
            $Page->loadRowValues($record);
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->picking_date->Visible) { ?>
    <?php if ($Page->picking_date->ShowGroupHeaderAsRow) { ?>
        <td data-field="picking_date"<?= $Page->picking_date->cellAttributes() ?>></td>
    <?php } else { ?>
        <td data-field="picking_date"<?= $Page->picking_date->cellAttributes() ?>><span<?= $Page->picking_date->viewAttributes() ?>><?= $Page->picking_date->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
        <td data-field="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->line->Visible) { ?>
        <td data-field="line"<?= $Page->line->cellAttributes() ?>>
<span<?= $Page->line->viewAttributes() ?>>
<?= $Page->line->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
    }
?>
<?php

    // Next group
    $Page->loadGroupRowValues();

    // Show header if page break
    if ($Page->isExport()) {
        $Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? false : ($Page->GroupCount % $Page->ExportPageBreakCount == 0);
    }

    // Page_Breaking server event
    if ($Page->ShowHeader) {
        $Page->pageBreaking($Page->ShowHeader, $Page->PageBreakContent);
    }
    $Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

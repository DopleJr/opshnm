<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OutboundReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { OutboundReport: currentTable } });
var currentForm, currentPageID;
var fOutboundReportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fOutboundReportsrch = new ew.Form("fOutboundReportsrch", "summary");
    currentSearchForm = fOutboundReportsrch;
    currentPageID = ew.PAGE_ID = "summary";

    // Add fields
    var fields = currentTable.fields;
    fOutboundReportsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["box_id", [], fields.box_id.isInvalid],
        ["date_delivery", [], fields.date_delivery.isInvalid],
        ["y_date_delivery", [ew.Validators.between], false],
        ["box_type", [], fields.box_type.isInvalid],
        ["check_by", [], fields.check_by.isInvalid],
        ["quantity", [], fields.quantity.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["remark", [], fields.remark.isInvalid],
        ["no_delivery", [], fields.no_delivery.isInvalid],
        ["truck_type", [], fields.truck_type.isInvalid],
        ["seal_no", [], fields.seal_no.isInvalid],
        ["truck_plate", [], fields.truck_plate.isInvalid],
        ["transporter", [], fields.transporter.isInvalid],
        ["no_hp", [], fields.no_hp.isInvalid],
        ["checker", [], fields.checker.isInvalid],
        ["admin", [], fields.admin.isInvalid],
        ["remarks_box", [], fields.remarks_box.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    fOutboundReportsrch.validate = function () {
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
    fOutboundReportsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fOutboundReportsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fOutboundReportsrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fOutboundReportsrch.lists.Week = <?= $Page->Week->toClientList($Page) ?>;
    fOutboundReportsrch.lists.box_id = <?= $Page->box_id->toClientList($Page) ?>;
    fOutboundReportsrch.lists.date_delivery = <?= $Page->date_delivery->toClientList($Page) ?>;
    fOutboundReportsrch.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    fOutboundReportsrch.lists.check_by = <?= $Page->check_by->toClientList($Page) ?>;
    fOutboundReportsrch.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fOutboundReportsrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fOutboundReportsrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fOutboundReportsrch.lists.remark = <?= $Page->remark->toClientList($Page) ?>;
    fOutboundReportsrch.lists.no_delivery = <?= $Page->no_delivery->toClientList($Page) ?>;
    fOutboundReportsrch.lists.truck_type = <?= $Page->truck_type->toClientList($Page) ?>;
    fOutboundReportsrch.lists.seal_no = <?= $Page->seal_no->toClientList($Page) ?>;
    fOutboundReportsrch.lists.truck_plate = <?= $Page->truck_plate->toClientList($Page) ?>;
    fOutboundReportsrch.lists.transporter = <?= $Page->transporter->toClientList($Page) ?>;
    fOutboundReportsrch.lists.no_hp = <?= $Page->no_hp->toClientList($Page) ?>;
    fOutboundReportsrch.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    fOutboundReportsrch.lists.admin = <?= $Page->admin->toClientList($Page) ?>;
    fOutboundReportsrch.lists.remarks_box = <?= $Page->remarks_box->toClientList($Page) ?>;
    fOutboundReportsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fOutboundReportsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fOutboundReportsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fOutboundReportsrch");
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
<form name="fOutboundReportsrch" id="fOutboundReportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fOutboundReportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="OutboundReport">
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
            data-select2-id="fOutboundReportsrch_x_id"
            data-table="OutboundReport"
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
        <div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_id",
                selectId: "fOutboundReportsrch_x_id",
                ajax: { id: "x_id", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Week->Visible) { // Week ?>
<?php
if (!$Page->Week->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Week" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Week->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Week"
            name="x_Week[]"
            class="form-control ew-select<?= $Page->Week->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_Week"
            data-table="OutboundReport"
            data-field="x_Week"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Week->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Week->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Week->getPlaceHolder()) ?>"
            <?= $Page->Week->editAttributes() ?>>
            <?= $Page->Week->selectOptionListHtml("x_Week", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Week->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_Week",
                selectId: "fOutboundReportsrch_x_Week",
                ajax: { id: "x_Week", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.Week.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_box_id"
            data-table="OutboundReport"
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
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_box_id",
                selectId: "fOutboundReportsrch_x_box_id",
                ajax: { id: "x_box_id", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.box_id.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_date_delivery"
            data-table="OutboundReport"
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
        <div class="invalid-feedback"><?= $Page->date_delivery->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_date_delivery",
                selectId: "fOutboundReportsrch_x_date_delivery",
                ajax: { id: "x_date_delivery", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.date_delivery.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_box_type"
            data-table="OutboundReport"
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
        <div class="invalid-feedback"><?= $Page->box_type->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_box_type",
                selectId: "fOutboundReportsrch_x_box_type",
                ajax: { id: "x_box_type", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.box_type.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->check_by->Visible) { // check_by ?>
<?php
if (!$Page->check_by->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_check_by" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->check_by->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_check_by"
            name="x_check_by[]"
            class="form-control ew-select<?= $Page->check_by->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_check_by"
            data-table="OutboundReport"
            data-field="x_check_by"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->check_by->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->check_by->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->check_by->getPlaceHolder()) ?>"
            <?= $Page->check_by->editAttributes() ?>>
            <?= $Page->check_by->selectOptionListHtml("x_check_by", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->check_by->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_check_by",
                selectId: "fOutboundReportsrch_x_check_by",
                ajax: { id: "x_check_by", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.check_by.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_quantity"
            data-table="OutboundReport"
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
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_quantity",
                selectId: "fOutboundReportsrch_x_quantity",
                ajax: { id: "x_quantity", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.quantity.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_concept"
            data-table="OutboundReport"
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
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_concept",
                selectId: "fOutboundReportsrch_x_concept",
                ajax: { id: "x_concept", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.concept.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_store_name"
            data-table="OutboundReport"
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
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "fOutboundReportsrch_x_store_name",
                ajax: { id: "x_store_name", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.store_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->remark->Visible) { // remark ?>
<?php
if (!$Page->remark->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_remark" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->remark->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_remark"
            name="x_remark[]"
            class="form-control ew-select<?= $Page->remark->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_remark"
            data-table="OutboundReport"
            data-field="x_remark"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->remark->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->remark->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->remark->getPlaceHolder()) ?>"
            <?= $Page->remark->editAttributes() ?>>
            <?= $Page->remark->selectOptionListHtml("x_remark", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->remark->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_remark",
                selectId: "fOutboundReportsrch_x_remark",
                ajax: { id: "x_remark", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.remark.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_delivery->Visible) { // no_delivery ?>
<?php
if (!$Page->no_delivery->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_delivery" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_delivery->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_delivery"
            name="x_no_delivery[]"
            class="form-control ew-select<?= $Page->no_delivery->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_no_delivery"
            data-table="OutboundReport"
            data-field="x_no_delivery"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_delivery->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_delivery->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_delivery->getPlaceHolder()) ?>"
            <?= $Page->no_delivery->editAttributes() ?>>
            <?= $Page->no_delivery->selectOptionListHtml("x_no_delivery", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_delivery->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_no_delivery",
                selectId: "fOutboundReportsrch_x_no_delivery",
                ajax: { id: "x_no_delivery", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.no_delivery.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->truck_type->Visible) { // truck_type ?>
<?php
if (!$Page->truck_type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_truck_type" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->truck_type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_truck_type"
            name="x_truck_type[]"
            class="form-control ew-select<?= $Page->truck_type->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_truck_type"
            data-table="OutboundReport"
            data-field="x_truck_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->truck_type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->truck_type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->truck_type->getPlaceHolder()) ?>"
            <?= $Page->truck_type->editAttributes() ?>>
            <?= $Page->truck_type->selectOptionListHtml("x_truck_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->truck_type->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_truck_type",
                selectId: "fOutboundReportsrch_x_truck_type",
                ajax: { id: "x_truck_type", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.truck_type.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->seal_no->Visible) { // seal_no ?>
<?php
if (!$Page->seal_no->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_seal_no" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->seal_no->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_seal_no"
            name="x_seal_no[]"
            class="form-control ew-select<?= $Page->seal_no->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_seal_no"
            data-table="OutboundReport"
            data-field="x_seal_no"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->seal_no->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->seal_no->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->seal_no->getPlaceHolder()) ?>"
            <?= $Page->seal_no->editAttributes() ?>>
            <?= $Page->seal_no->selectOptionListHtml("x_seal_no", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->seal_no->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_seal_no",
                selectId: "fOutboundReportsrch_x_seal_no",
                ajax: { id: "x_seal_no", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.seal_no.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->truck_plate->Visible) { // truck_plate ?>
<?php
if (!$Page->truck_plate->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_truck_plate" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->truck_plate->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_truck_plate"
            name="x_truck_plate[]"
            class="form-control ew-select<?= $Page->truck_plate->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_truck_plate"
            data-table="OutboundReport"
            data-field="x_truck_plate"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->truck_plate->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->truck_plate->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->truck_plate->getPlaceHolder()) ?>"
            <?= $Page->truck_plate->editAttributes() ?>>
            <?= $Page->truck_plate->selectOptionListHtml("x_truck_plate", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->truck_plate->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_truck_plate",
                selectId: "fOutboundReportsrch_x_truck_plate",
                ajax: { id: "x_truck_plate", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.truck_plate.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->transporter->Visible) { // transporter ?>
<?php
if (!$Page->transporter->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_transporter" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->transporter->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_transporter"
            name="x_transporter[]"
            class="form-control ew-select<?= $Page->transporter->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_transporter"
            data-table="OutboundReport"
            data-field="x_transporter"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->transporter->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->transporter->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->transporter->getPlaceHolder()) ?>"
            <?= $Page->transporter->editAttributes() ?>>
            <?= $Page->transporter->selectOptionListHtml("x_transporter", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->transporter->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_transporter",
                selectId: "fOutboundReportsrch_x_transporter",
                ajax: { id: "x_transporter", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.transporter.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
<?php
if (!$Page->no_hp->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_hp" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_hp->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_hp"
            name="x_no_hp[]"
            class="form-control ew-select<?= $Page->no_hp->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_no_hp"
            data-table="OutboundReport"
            data-field="x_no_hp"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_hp->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_hp->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_hp->getPlaceHolder()) ?>"
            <?= $Page->no_hp->editAttributes() ?>>
            <?= $Page->no_hp->selectOptionListHtml("x_no_hp", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_no_hp",
                selectId: "fOutboundReportsrch_x_no_hp",
                ajax: { id: "x_no_hp", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.no_hp.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_checker"
            data-table="OutboundReport"
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
        <div class="invalid-feedback"><?= $Page->checker->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_checker",
                selectId: "fOutboundReportsrch_x_checker",
                ajax: { id: "x_checker", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.checker.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->admin->Visible) { // admin ?>
<?php
if (!$Page->admin->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_admin" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->admin->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_admin"
            name="x_admin[]"
            class="form-control ew-select<?= $Page->admin->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_admin"
            data-table="OutboundReport"
            data-field="x_admin"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->admin->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->admin->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->admin->getPlaceHolder()) ?>"
            <?= $Page->admin->editAttributes() ?>>
            <?= $Page->admin->selectOptionListHtml("x_admin", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->admin->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_admin",
                selectId: "fOutboundReportsrch_x_admin",
                ajax: { id: "x_admin", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.admin.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->remarks_box->Visible) { // remarks_box ?>
<?php
if (!$Page->remarks_box->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_remarks_box" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->remarks_box->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_remarks_box"
            name="x_remarks_box[]"
            class="form-control ew-select<?= $Page->remarks_box->isInvalidClass() ?>"
            data-select2-id="fOutboundReportsrch_x_remarks_box"
            data-table="OutboundReport"
            data-field="x_remarks_box"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->remarks_box->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->remarks_box->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->remarks_box->getPlaceHolder()) ?>"
            <?= $Page->remarks_box->editAttributes() ?>>
            <?= $Page->remarks_box->selectOptionListHtml("x_remarks_box", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->remarks_box->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_remarks_box",
                selectId: "fOutboundReportsrch_x_remarks_box",
                ajax: { id: "x_remarks_box", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.remarks_box.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_date_created"
            data-table="OutboundReport"
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
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fOutboundReportsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.date_created.filterOptions);
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
            data-select2-id="fOutboundReportsrch_x_date_updated"
            data-table="OutboundReport"
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
        loadjs.ready("fOutboundReportsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fOutboundReportsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fOutboundReportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.OutboundReport.fields.date_updated.filterOptions);
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
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
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
<div id="gmp_OutboundReport" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { ?>
    <th data-name="box_id" class="<?= $Page->box_id->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_box_id"><?= $Page->renderFieldHeader($Page->box_id) ?></div></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { ?>
    <th data-name="date_delivery" class="<?= $Page->date_delivery->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_date_delivery"><?= $Page->renderFieldHeader($Page->date_delivery) ?></div></th>
<?php } ?>
<?php if ($Page->box_type->Visible) { ?>
    <th data-name="box_type" class="<?= $Page->box_type->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_box_type"><?= $Page->renderFieldHeader($Page->box_type) ?></div></th>
<?php } ?>
<?php if ($Page->check_by->Visible) { ?>
    <th data-name="check_by" class="<?= $Page->check_by->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_check_by"><?= $Page->renderFieldHeader($Page->check_by) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
    <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { ?>
    <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { ?>
    <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->remark->Visible) { ?>
    <th data-name="remark" class="<?= $Page->remark->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_remark"><?= $Page->renderFieldHeader($Page->remark) ?></div></th>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { ?>
    <th data-name="no_delivery" class="<?= $Page->no_delivery->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_no_delivery"><?= $Page->renderFieldHeader($Page->no_delivery) ?></div></th>
<?php } ?>
<?php if ($Page->truck_type->Visible) { ?>
    <th data-name="truck_type" class="<?= $Page->truck_type->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_truck_type"><?= $Page->renderFieldHeader($Page->truck_type) ?></div></th>
<?php } ?>
<?php if ($Page->seal_no->Visible) { ?>
    <th data-name="seal_no" class="<?= $Page->seal_no->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_seal_no"><?= $Page->renderFieldHeader($Page->seal_no) ?></div></th>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { ?>
    <th data-name="truck_plate" class="<?= $Page->truck_plate->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_truck_plate"><?= $Page->renderFieldHeader($Page->truck_plate) ?></div></th>
<?php } ?>
<?php if ($Page->transporter->Visible) { ?>
    <th data-name="transporter" class="<?= $Page->transporter->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_transporter"><?= $Page->renderFieldHeader($Page->transporter) ?></div></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { ?>
    <th data-name="no_hp" class="<?= $Page->no_hp->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_no_hp"><?= $Page->renderFieldHeader($Page->no_hp) ?></div></th>
<?php } ?>
<?php if ($Page->checker->Visible) { ?>
    <th data-name="checker" class="<?= $Page->checker->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_checker"><?= $Page->renderFieldHeader($Page->checker) ?></div></th>
<?php } ?>
<?php if ($Page->admin->Visible) { ?>
    <th data-name="admin" class="<?= $Page->admin->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_admin"><?= $Page->renderFieldHeader($Page->admin) ?></div></th>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { ?>
    <th data-name="remarks_box" class="<?= $Page->remarks_box->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_remarks_box"><?= $Page->renderFieldHeader($Page->remarks_box) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
    <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div class="OutboundReport_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->id->Visible) { ?>
        <td data-field="id"<?= $Page->id->cellAttributes() ?>>
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->box_id->Visible) { ?>
        <td data-field="box_id"<?= $Page->box_id->cellAttributes() ?>>
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { ?>
        <td data-field="date_delivery"<?= $Page->date_delivery->cellAttributes() ?>>
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->box_type->Visible) { ?>
        <td data-field="box_type"<?= $Page->box_type->cellAttributes() ?>>
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->check_by->Visible) { ?>
        <td data-field="check_by"<?= $Page->check_by->cellAttributes() ?>>
<span<?= $Page->check_by->viewAttributes() ?>>
<?= $Page->check_by->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
        <td data-field="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { ?>
        <td data-field="concept"<?= $Page->concept->cellAttributes() ?>>
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->store_name->Visible) { ?>
        <td data-field="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->remark->Visible) { ?>
        <td data-field="remark"<?= $Page->remark->cellAttributes() ?>>
<span<?= $Page->remark->viewAttributes() ?>>
<?= $Page->remark->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { ?>
        <td data-field="no_delivery"<?= $Page->no_delivery->cellAttributes() ?>>
<span<?= $Page->no_delivery->viewAttributes() ?>>
<?= $Page->no_delivery->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->truck_type->Visible) { ?>
        <td data-field="truck_type"<?= $Page->truck_type->cellAttributes() ?>>
<span<?= $Page->truck_type->viewAttributes() ?>>
<?= $Page->truck_type->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->seal_no->Visible) { ?>
        <td data-field="seal_no"<?= $Page->seal_no->cellAttributes() ?>>
<span<?= $Page->seal_no->viewAttributes() ?>>
<?= $Page->seal_no->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { ?>
        <td data-field="truck_plate"<?= $Page->truck_plate->cellAttributes() ?>>
<span<?= $Page->truck_plate->viewAttributes() ?>>
<?= $Page->truck_plate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->transporter->Visible) { ?>
        <td data-field="transporter"<?= $Page->transporter->cellAttributes() ?>>
<span<?= $Page->transporter->viewAttributes() ?>>
<?= $Page->transporter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->no_hp->Visible) { ?>
        <td data-field="no_hp"<?= $Page->no_hp->cellAttributes() ?>>
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->checker->Visible) { ?>
        <td data-field="checker"<?= $Page->checker->cellAttributes() ?>>
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->admin->Visible) { ?>
        <td data-field="admin"<?= $Page->admin->cellAttributes() ?>>
<span<?= $Page->admin->viewAttributes() ?>>
<?= $Page->admin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { ?>
        <td data-field="remarks_box"<?= $Page->remarks_box->cellAttributes() ?>>
<span<?= $Page->remarks_box->viewAttributes() ?>>
<?= $Page->remarks_box->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
        <td data-field="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
        <td data-field="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
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
<!-- Bottom Container -->
<div class="row">
    <div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up page break
    if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
        // Page_Breaking server event
        $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

        // Set up chart page break
        $Page->OutboundReport->PageBreakType = "before"; // Page break type
        $Page->OutboundReport->PageBreak = $Page->ExportChartPageBreak;
        $Page->OutboundReport->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->OutboundReport->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->OutboundReport->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->OutboundReport->hasData()) { ?>
<?php if (!$Page->isExport()) { ?>
<div class="mb-3"><a class="ew-top-link" data-ew-action="scroll-top"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    </div>
</div>
<!-- /#ew-bottom -->
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

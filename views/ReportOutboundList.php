<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportOutboundList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_outbound: currentTable } });
var currentForm, currentPageID;
var freport_outboundlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_outboundlist = new ew.Form("freport_outboundlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = freport_outboundlist;
    freport_outboundlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    freport_outboundlist.lists.Week = <?= $Page->Week->toClientList($Page) ?>;
    freport_outboundlist.lists.box_id = <?= $Page->box_id->toClientList($Page) ?>;
    freport_outboundlist.lists.date_delivery = <?= $Page->date_delivery->toClientList($Page) ?>;
    freport_outboundlist.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    freport_outboundlist.lists.check_by = <?= $Page->check_by->toClientList($Page) ?>;
    freport_outboundlist.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    freport_outboundlist.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    freport_outboundlist.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    freport_outboundlist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    freport_outboundlist.lists.remark = <?= $Page->remark->toClientList($Page) ?>;
    freport_outboundlist.lists.no_delivery = <?= $Page->no_delivery->toClientList($Page) ?>;
    freport_outboundlist.lists.truck_type = <?= $Page->truck_type->toClientList($Page) ?>;
    freport_outboundlist.lists.seal_no = <?= $Page->seal_no->toClientList($Page) ?>;
    freport_outboundlist.lists.truck_plate = <?= $Page->truck_plate->toClientList($Page) ?>;
    freport_outboundlist.lists.transporter = <?= $Page->transporter->toClientList($Page) ?>;
    freport_outboundlist.lists.no_hp = <?= $Page->no_hp->toClientList($Page) ?>;
    freport_outboundlist.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    freport_outboundlist.lists.admin = <?= $Page->admin->toClientList($Page) ?>;
    freport_outboundlist.lists.remarks_box = <?= $Page->remarks_box->toClientList($Page) ?>;
    freport_outboundlist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    freport_outboundlist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("freport_outboundlist");
});
var freport_outboundsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    freport_outboundsrch = new ew.Form("freport_outboundsrch", "list");
    currentSearchForm = freport_outboundsrch;

    // Add fields
    var fields = currentTable.fields;
    freport_outboundsrch.addFields([
        ["Week", [], fields.Week.isInvalid],
        ["box_id", [], fields.box_id.isInvalid],
        ["date_delivery", [], fields.date_delivery.isInvalid],
        ["y_date_delivery", [ew.Validators.between], false],
        ["box_type", [], fields.box_type.isInvalid],
        ["check_by", [], fields.check_by.isInvalid],
        ["quantity", [], fields.quantity.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["store_code", [], fields.store_code.isInvalid],
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
        ["y_date_created", [ew.Validators.between], false],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    freport_outboundsrch.validate = function () {
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
    freport_outboundsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freport_outboundsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    freport_outboundsrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    freport_outboundsrch.lists.Week = <?= $Page->Week->toClientList($Page) ?>;
    freport_outboundsrch.lists.box_id = <?= $Page->box_id->toClientList($Page) ?>;
    freport_outboundsrch.lists.date_delivery = <?= $Page->date_delivery->toClientList($Page) ?>;
    freport_outboundsrch.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    freport_outboundsrch.lists.check_by = <?= $Page->check_by->toClientList($Page) ?>;
    freport_outboundsrch.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    freport_outboundsrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    freport_outboundsrch.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    freport_outboundsrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    freport_outboundsrch.lists.remark = <?= $Page->remark->toClientList($Page) ?>;
    freport_outboundsrch.lists.no_delivery = <?= $Page->no_delivery->toClientList($Page) ?>;
    freport_outboundsrch.lists.truck_type = <?= $Page->truck_type->toClientList($Page) ?>;
    freport_outboundsrch.lists.seal_no = <?= $Page->seal_no->toClientList($Page) ?>;
    freport_outboundsrch.lists.truck_plate = <?= $Page->truck_plate->toClientList($Page) ?>;
    freport_outboundsrch.lists.transporter = <?= $Page->transporter->toClientList($Page) ?>;
    freport_outboundsrch.lists.no_hp = <?= $Page->no_hp->toClientList($Page) ?>;
    freport_outboundsrch.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    freport_outboundsrch.lists.admin = <?= $Page->admin->toClientList($Page) ?>;
    freport_outboundsrch.lists.remarks_box = <?= $Page->remarks_box->toClientList($Page) ?>;
    freport_outboundsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    freport_outboundsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    freport_outboundsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("freport_outboundsrch");
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
<form name="freport_outboundsrch" id="freport_outboundsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="freport_outboundsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="report_outbound">
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
            data-select2-id="freport_outboundsrch_x_id"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_id",
                selectId: "freport_outboundsrch_x_id",
                ajax: { id: "x_id", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.id.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_Week"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->Week->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_Week",
                selectId: "freport_outboundsrch_x_Week",
                ajax: { id: "x_Week", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.Week.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_box_id"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_box_id",
                selectId: "freport_outboundsrch_x_box_id",
                ajax: { id: "x_box_id", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.box_id.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_date_delivery"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_date_delivery",
                selectId: "freport_outboundsrch_x_date_delivery",
                ajax: { id: "x_date_delivery", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.date_delivery.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_box_type"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_box_type",
                selectId: "freport_outboundsrch_x_box_type",
                ajax: { id: "x_box_type", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.box_type.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_check_by"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->check_by->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_check_by",
                selectId: "freport_outboundsrch_x_check_by",
                ajax: { id: "x_check_by", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.check_by.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_quantity"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_quantity",
                selectId: "freport_outboundsrch_x_quantity",
                ajax: { id: "x_quantity", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.quantity.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_concept"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_concept",
                selectId: "freport_outboundsrch_x_concept",
                ajax: { id: "x_concept", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.concept.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_store_code"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_store_code",
                selectId: "freport_outboundsrch_x_store_code",
                ajax: { id: "x_store_code", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.store_code.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_store_name"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "freport_outboundsrch_x_store_name",
                ajax: { id: "x_store_name", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.store_name.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_remark"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->remark->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_remark",
                selectId: "freport_outboundsrch_x_remark",
                ajax: { id: "x_remark", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.remark.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_no_delivery"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->no_delivery->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_no_delivery",
                selectId: "freport_outboundsrch_x_no_delivery",
                ajax: { id: "x_no_delivery", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.no_delivery.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_truck_type"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->truck_type->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_truck_type",
                selectId: "freport_outboundsrch_x_truck_type",
                ajax: { id: "x_truck_type", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.truck_type.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_seal_no"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->seal_no->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_seal_no",
                selectId: "freport_outboundsrch_x_seal_no",
                ajax: { id: "x_seal_no", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.seal_no.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_truck_plate"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->truck_plate->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_truck_plate",
                selectId: "freport_outboundsrch_x_truck_plate",
                ajax: { id: "x_truck_plate", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.truck_plate.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_transporter"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->transporter->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_transporter",
                selectId: "freport_outboundsrch_x_transporter",
                ajax: { id: "x_transporter", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.transporter.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_no_hp"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_no_hp",
                selectId: "freport_outboundsrch_x_no_hp",
                ajax: { id: "x_no_hp", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.no_hp.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_checker"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_checker",
                selectId: "freport_outboundsrch_x_checker",
                ajax: { id: "x_checker", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.checker.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_admin"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->admin->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_admin",
                selectId: "freport_outboundsrch_x_admin",
                ajax: { id: "x_admin", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.admin.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_remarks_box"
            data-table="report_outbound"
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
        <div class="invalid-feedback"><?= $Page->remarks_box->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_remarks_box",
                selectId: "freport_outboundsrch_x_remarks_box",
                ajax: { id: "x_remarks_box", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.remarks_box.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_date_created"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "freport_outboundsrch_x_date_created",
                ajax: { id: "x_date_created", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.date_created.filterOptions);
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
            data-select2-id="freport_outboundsrch_x_date_updated"
            data-table="report_outbound"
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
        loadjs.ready("freport_outboundsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "freport_outboundsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "freport_outboundsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_outbound.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="freport_outboundsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="freport_outboundsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="freport_outboundsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="freport_outboundsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> report_outbound">
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
<form name="freport_outboundlist" id="freport_outboundlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_outbound">
<div id="gmp_report_outbound" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_report_outboundlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->Week->Visible) { // Week ?>
        <th data-name="Week" class="<?= $Page->Week->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_Week" class="report_outbound_Week"><?= $Page->renderFieldHeader($Page->Week) ?></div></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th data-name="box_id" class="<?= $Page->box_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_box_id" class="report_outbound_box_id"><?= $Page->renderFieldHeader($Page->box_id) ?></div></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <th data-name="date_delivery" class="<?= $Page->date_delivery->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_date_delivery" class="report_outbound_date_delivery"><?= $Page->renderFieldHeader($Page->date_delivery) ?></div></th>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <th data-name="box_type" class="<?= $Page->box_type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_box_type" class="report_outbound_box_type"><?= $Page->renderFieldHeader($Page->box_type) ?></div></th>
<?php } ?>
<?php if ($Page->check_by->Visible) { // check_by ?>
        <th data-name="check_by" class="<?= $Page->check_by->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_check_by" class="report_outbound_check_by"><?= $Page->renderFieldHeader($Page->check_by) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_quantity" class="report_outbound_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_concept" class="report_outbound_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th data-name="store_code" class="<?= $Page->store_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_store_code" class="report_outbound_store_code"><?= $Page->renderFieldHeader($Page->store_code) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_store_name" class="report_outbound_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->remark->Visible) { // remark ?>
        <th data-name="remark" class="<?= $Page->remark->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_remark" class="report_outbound_remark"><?= $Page->renderFieldHeader($Page->remark) ?></div></th>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { // no_delivery ?>
        <th data-name="no_delivery" class="<?= $Page->no_delivery->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_no_delivery" class="report_outbound_no_delivery"><?= $Page->renderFieldHeader($Page->no_delivery) ?></div></th>
<?php } ?>
<?php if ($Page->truck_type->Visible) { // truck_type ?>
        <th data-name="truck_type" class="<?= $Page->truck_type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_truck_type" class="report_outbound_truck_type"><?= $Page->renderFieldHeader($Page->truck_type) ?></div></th>
<?php } ?>
<?php if ($Page->seal_no->Visible) { // seal_no ?>
        <th data-name="seal_no" class="<?= $Page->seal_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_seal_no" class="report_outbound_seal_no"><?= $Page->renderFieldHeader($Page->seal_no) ?></div></th>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { // truck_plate ?>
        <th data-name="truck_plate" class="<?= $Page->truck_plate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_truck_plate" class="report_outbound_truck_plate"><?= $Page->renderFieldHeader($Page->truck_plate) ?></div></th>
<?php } ?>
<?php if ($Page->transporter->Visible) { // transporter ?>
        <th data-name="transporter" class="<?= $Page->transporter->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_transporter" class="report_outbound_transporter"><?= $Page->renderFieldHeader($Page->transporter) ?></div></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th data-name="no_hp" class="<?= $Page->no_hp->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_no_hp" class="report_outbound_no_hp"><?= $Page->renderFieldHeader($Page->no_hp) ?></div></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th data-name="checker" class="<?= $Page->checker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_checker" class="report_outbound_checker"><?= $Page->renderFieldHeader($Page->checker) ?></div></th>
<?php } ?>
<?php if ($Page->admin->Visible) { // admin ?>
        <th data-name="admin" class="<?= $Page->admin->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_admin" class="report_outbound_admin"><?= $Page->renderFieldHeader($Page->admin) ?></div></th>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { // remarks_box ?>
        <th data-name="remarks_box" class="<?= $Page->remarks_box->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_remarks_box" class="report_outbound_remarks_box"><?= $Page->renderFieldHeader($Page->remarks_box) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_date_created" class="report_outbound_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_outbound_date_updated" class="report_outbound_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_report_outbound",
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
    <?php if ($Page->Week->Visible) { // Week ?>
        <td data-name="Week"<?= $Page->Week->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_Week" class="el_report_outbound_Week">
<span<?= $Page->Week->viewAttributes() ?>>
<?= $Page->Week->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_id->Visible) { // box_id ?>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_box_id" class="el_report_outbound_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <td data-name="date_delivery"<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_date_delivery" class="el_report_outbound_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_type->Visible) { // box_type ?>
        <td data-name="box_type"<?= $Page->box_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_box_type" class="el_report_outbound_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_by->Visible) { // check_by ?>
        <td data-name="check_by"<?= $Page->check_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_check_by" class="el_report_outbound_check_by">
<span<?= $Page->check_by->viewAttributes() ?>>
<?= $Page->check_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_quantity" class="el_report_outbound_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_concept" class="el_report_outbound_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_code->Visible) { // store_code ?>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_store_code" class="el_report_outbound_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_store_name" class="el_report_outbound_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remark->Visible) { // remark ?>
        <td data-name="remark"<?= $Page->remark->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_remark" class="el_report_outbound_remark">
<span<?= $Page->remark->viewAttributes() ?>>
<?= $Page->remark->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_delivery->Visible) { // no_delivery ?>
        <td data-name="no_delivery"<?= $Page->no_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_no_delivery" class="el_report_outbound_no_delivery">
<span<?= $Page->no_delivery->viewAttributes() ?>>
<?= $Page->no_delivery->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->truck_type->Visible) { // truck_type ?>
        <td data-name="truck_type"<?= $Page->truck_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_truck_type" class="el_report_outbound_truck_type">
<span<?= $Page->truck_type->viewAttributes() ?>>
<?= $Page->truck_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->seal_no->Visible) { // seal_no ?>
        <td data-name="seal_no"<?= $Page->seal_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_seal_no" class="el_report_outbound_seal_no">
<span<?= $Page->seal_no->viewAttributes() ?>>
<?= $Page->seal_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->truck_plate->Visible) { // truck_plate ?>
        <td data-name="truck_plate"<?= $Page->truck_plate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_truck_plate" class="el_report_outbound_truck_plate">
<span<?= $Page->truck_plate->viewAttributes() ?>>
<?= $Page->truck_plate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->transporter->Visible) { // transporter ?>
        <td data-name="transporter"<?= $Page->transporter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_transporter" class="el_report_outbound_transporter">
<span<?= $Page->transporter->viewAttributes() ?>>
<?= $Page->transporter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp"<?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_no_hp" class="el_report_outbound_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->checker->Visible) { // checker ?>
        <td data-name="checker"<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_checker" class="el_report_outbound_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->admin->Visible) { // admin ?>
        <td data-name="admin"<?= $Page->admin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_admin" class="el_report_outbound_admin">
<span<?= $Page->admin->viewAttributes() ?>>
<?= $Page->admin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remarks_box->Visible) { // remarks_box ?>
        <td data-name="remarks_box"<?= $Page->remarks_box->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_remarks_box" class="el_report_outbound_remarks_box">
<span<?= $Page->remarks_box->viewAttributes() ?>>
<?= $Page->remarks_box->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_date_created" class="el_report_outbound_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_date_updated" class="el_report_outbound_date_updated">
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
    ew.addEventHandlers("report_outbound");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OssManualList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { oss_manual: currentTable } });
var currentForm, currentPageID;
var foss_manuallist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    foss_manuallist = new ew.Form("foss_manuallist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = foss_manuallist;
    foss_manuallist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    foss_manuallist.lists.date = <?= $Page->date->toClientList($Page) ?>;
    foss_manuallist.lists.sscc = <?= $Page->sscc->toClientList($Page) ?>;
    foss_manuallist.lists.shipment = <?= $Page->shipment->toClientList($Page) ?>;
    foss_manuallist.lists.pallet_no = <?= $Page->pallet_no->toClientList($Page) ?>;
    foss_manuallist.lists.idw = <?= $Page->idw->toClientList($Page) ?>;
    foss_manuallist.lists.order_no = <?= $Page->order_no->toClientList($Page) ?>;
    foss_manuallist.lists.item_in_ctn = <?= $Page->item_in_ctn->toClientList($Page) ?>;
    foss_manuallist.lists.no_of_ctn = <?= $Page->no_of_ctn->toClientList($Page) ?>;
    foss_manuallist.lists.ctn_no = <?= $Page->ctn_no->toClientList($Page) ?>;
    foss_manuallist.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    foss_manuallist.lists.shift = <?= $Page->shift->toClientList($Page) ?>;
    foss_manuallist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    foss_manuallist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    foss_manuallist.lists.time_updated = <?= $Page->time_updated->toClientList($Page) ?>;
    loadjs.done("foss_manuallist");
});
var foss_manualsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    foss_manualsrch = new ew.Form("foss_manualsrch", "list");
    currentSearchForm = foss_manualsrch;

    // Add fields
    var fields = currentTable.fields;
    foss_manualsrch.addFields([
        ["date", [], fields.date.isInvalid],
        ["y_date", [ew.Validators.between], false],
        ["sscc", [], fields.sscc.isInvalid],
        ["shipment", [], fields.shipment.isInvalid],
        ["pallet_no", [], fields.pallet_no.isInvalid],
        ["idw", [], fields.idw.isInvalid],
        ["order_no", [], fields.order_no.isInvalid],
        ["item_in_ctn", [], fields.item_in_ctn.isInvalid],
        ["no_of_ctn", [], fields.no_of_ctn.isInvalid],
        ["ctn_no", [], fields.ctn_no.isInvalid],
        ["checker", [], fields.checker.isInvalid],
        ["shift", [], fields.shift.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid],
        ["time_updated", [], fields.time_updated.isInvalid]
    ]);

    // Validate form
    foss_manualsrch.validate = function () {
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
    foss_manualsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    foss_manualsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    foss_manualsrch.lists.date = <?= $Page->date->toClientList($Page) ?>;
    foss_manualsrch.lists.sscc = <?= $Page->sscc->toClientList($Page) ?>;
    foss_manualsrch.lists.scan = <?= $Page->scan->toClientList($Page) ?>;
    foss_manualsrch.lists.shipment = <?= $Page->shipment->toClientList($Page) ?>;
    foss_manualsrch.lists.pallet_no = <?= $Page->pallet_no->toClientList($Page) ?>;
    foss_manualsrch.lists.idw = <?= $Page->idw->toClientList($Page) ?>;
    foss_manualsrch.lists.order_no = <?= $Page->order_no->toClientList($Page) ?>;
    foss_manualsrch.lists.item_in_ctn = <?= $Page->item_in_ctn->toClientList($Page) ?>;
    foss_manualsrch.lists.no_of_ctn = <?= $Page->no_of_ctn->toClientList($Page) ?>;
    foss_manualsrch.lists.ctn_no = <?= $Page->ctn_no->toClientList($Page) ?>;
    foss_manualsrch.lists.checker = <?= $Page->checker->toClientList($Page) ?>;
    foss_manualsrch.lists.shift = <?= $Page->shift->toClientList($Page) ?>;
    foss_manualsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    foss_manualsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    foss_manualsrch.lists.time_updated = <?= $Page->time_updated->toClientList($Page) ?>;

    // Filters
    foss_manualsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("foss_manualsrch");
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
<form name="foss_manualsrch" id="foss_manualsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="foss_manualsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="oss_manual">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->date->Visible) { // date ?>
<?php
if (!$Page->date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date"
            name="x_date[]"
            class="form-control ew-select<?= $Page->date->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_date"
            data-table="oss_manual"
            data-field="x_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"
            <?= $Page->date->editAttributes() ?>>
            <?= $Page->date->selectOptionListHtml("x_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_date",
                selectId: "foss_manualsrch_x_date",
                ajax: { id: "x_date", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
<?php
if (!$Page->sscc->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_sscc" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->sscc->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_sscc"
            name="x_sscc[]"
            class="form-control ew-select<?= $Page->sscc->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_sscc"
            data-table="oss_manual"
            data-field="x_sscc"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->sscc->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->sscc->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->sscc->getPlaceHolder()) ?>"
            <?= $Page->sscc->editAttributes() ?>>
            <?= $Page->sscc->selectOptionListHtml("x_sscc", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->sscc->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_sscc",
                selectId: "foss_manualsrch_x_sscc",
                ajax: { id: "x_sscc", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.sscc.filterOptions);
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
            data-select2-id="foss_manualsrch_x_scan"
            data-table="oss_manual"
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
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_scan",
                selectId: "foss_manualsrch_x_scan",
                ajax: { id: "x_scan", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.scan.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
<?php
if (!$Page->shipment->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_shipment" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->shipment->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_shipment"
            name="x_shipment[]"
            class="form-control ew-select<?= $Page->shipment->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_shipment"
            data-table="oss_manual"
            data-field="x_shipment"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->shipment->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->shipment->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->shipment->getPlaceHolder()) ?>"
            <?= $Page->shipment->editAttributes() ?>>
            <?= $Page->shipment->selectOptionListHtml("x_shipment", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->shipment->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_shipment",
                selectId: "foss_manualsrch_x_shipment",
                ajax: { id: "x_shipment", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.shipment.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
<?php
if (!$Page->pallet_no->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_pallet_no" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->pallet_no->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_pallet_no"
            name="x_pallet_no[]"
            class="form-control ew-select<?= $Page->pallet_no->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_pallet_no"
            data-table="oss_manual"
            data-field="x_pallet_no"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->pallet_no->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->pallet_no->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->pallet_no->getPlaceHolder()) ?>"
            <?= $Page->pallet_no->editAttributes() ?>>
            <?= $Page->pallet_no->selectOptionListHtml("x_pallet_no", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->pallet_no->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_pallet_no",
                selectId: "foss_manualsrch_x_pallet_no",
                ajax: { id: "x_pallet_no", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.pallet_no.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
<?php
if (!$Page->idw->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_idw" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->idw->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_idw"
            name="x_idw[]"
            class="form-control ew-select<?= $Page->idw->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_idw"
            data-table="oss_manual"
            data-field="x_idw"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->idw->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->idw->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->idw->getPlaceHolder()) ?>"
            <?= $Page->idw->editAttributes() ?>>
            <?= $Page->idw->selectOptionListHtml("x_idw", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->idw->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_idw",
                selectId: "foss_manualsrch_x_idw",
                ajax: { id: "x_idw", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.idw.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
<?php
if (!$Page->order_no->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_order_no" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->order_no->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_order_no"
            name="x_order_no[]"
            class="form-control ew-select<?= $Page->order_no->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_order_no"
            data-table="oss_manual"
            data-field="x_order_no"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->order_no->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->order_no->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->order_no->getPlaceHolder()) ?>"
            <?= $Page->order_no->editAttributes() ?>>
            <?= $Page->order_no->selectOptionListHtml("x_order_no", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->order_no->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_order_no",
                selectId: "foss_manualsrch_x_order_no",
                ajax: { id: "x_order_no", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.order_no.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
<?php
if (!$Page->item_in_ctn->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_item_in_ctn" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->item_in_ctn->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_item_in_ctn"
            name="x_item_in_ctn[]"
            class="form-control ew-select<?= $Page->item_in_ctn->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_item_in_ctn"
            data-table="oss_manual"
            data-field="x_item_in_ctn"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->item_in_ctn->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->item_in_ctn->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->item_in_ctn->getPlaceHolder()) ?>"
            <?= $Page->item_in_ctn->editAttributes() ?>>
            <?= $Page->item_in_ctn->selectOptionListHtml("x_item_in_ctn", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->item_in_ctn->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_item_in_ctn",
                selectId: "foss_manualsrch_x_item_in_ctn",
                ajax: { id: "x_item_in_ctn", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.item_in_ctn.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
<?php
if (!$Page->no_of_ctn->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_of_ctn" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_of_ctn->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_of_ctn"
            name="x_no_of_ctn[]"
            class="form-control ew-select<?= $Page->no_of_ctn->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_no_of_ctn"
            data-table="oss_manual"
            data-field="x_no_of_ctn"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_of_ctn->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_of_ctn->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_of_ctn->getPlaceHolder()) ?>"
            <?= $Page->no_of_ctn->editAttributes() ?>>
            <?= $Page->no_of_ctn->selectOptionListHtml("x_no_of_ctn", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_of_ctn->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_no_of_ctn",
                selectId: "foss_manualsrch_x_no_of_ctn",
                ajax: { id: "x_no_of_ctn", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.no_of_ctn.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
<?php
if (!$Page->ctn_no->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ctn_no" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->ctn_no->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ctn_no"
            name="x_ctn_no[]"
            class="form-control ew-select<?= $Page->ctn_no->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_ctn_no"
            data-table="oss_manual"
            data-field="x_ctn_no"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ctn_no->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ctn_no->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ctn_no->getPlaceHolder()) ?>"
            <?= $Page->ctn_no->editAttributes() ?>>
            <?= $Page->ctn_no->selectOptionListHtml("x_ctn_no", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ctn_no->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_ctn_no",
                selectId: "foss_manualsrch_x_ctn_no",
                ajax: { id: "x_ctn_no", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.ctn_no.filterOptions);
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
            data-select2-id="foss_manualsrch_x_checker"
            data-table="oss_manual"
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
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_checker",
                selectId: "foss_manualsrch_x_checker",
                ajax: { id: "x_checker", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.checker.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
<?php
if (!$Page->shift->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_shift" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->shift->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_shift"
            name="x_shift[]"
            class="form-control ew-select<?= $Page->shift->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_shift"
            data-table="oss_manual"
            data-field="x_shift"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->shift->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->shift->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->shift->getPlaceHolder()) ?>"
            <?= $Page->shift->editAttributes() ?>>
            <?= $Page->shift->selectOptionListHtml("x_shift", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->shift->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_shift",
                selectId: "foss_manualsrch_x_shift",
                ajax: { id: "x_shift", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.shift.filterOptions);
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
            data-select2-id="foss_manualsrch_x_status"
            data-table="oss_manual"
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
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_status",
                selectId: "foss_manualsrch_x_status",
                ajax: { id: "x_status", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.status.filterOptions);
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
            data-select2-id="foss_manualsrch_x_date_updated"
            data-table="oss_manual"
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
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "foss_manualsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.date_updated.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
<?php
if (!$Page->time_updated->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_time_updated" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->time_updated->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_time_updated"
            name="x_time_updated[]"
            class="form-control ew-select<?= $Page->time_updated->isInvalidClass() ?>"
            data-select2-id="foss_manualsrch_x_time_updated"
            data-table="oss_manual"
            data-field="x_time_updated"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->time_updated->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->time_updated->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->time_updated->getPlaceHolder()) ?>"
            <?= $Page->time_updated->editAttributes() ?>>
            <?= $Page->time_updated->selectOptionListHtml("x_time_updated", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->time_updated->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("foss_manualsrch", function() {
            var options = {
                name: "x_time_updated",
                selectId: "foss_manualsrch_x_time_updated",
                ajax: { id: "x_time_updated", form: "foss_manualsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.oss_manual.fields.time_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="foss_manualsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> oss_manual">
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
<form name="foss_manuallist" id="foss_manuallist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="oss_manual">
<div id="gmp_oss_manual" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_oss_manuallist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_date" class="oss_manual_date"><?= $Page->renderFieldHeader($Page->date) ?></div></th>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
        <th data-name="sscc" class="<?= $Page->sscc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_sscc" class="oss_manual_sscc"><?= $Page->renderFieldHeader($Page->sscc) ?></div></th>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <th data-name="shipment" class="<?= $Page->shipment->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_shipment" class="oss_manual_shipment"><?= $Page->renderFieldHeader($Page->shipment) ?></div></th>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <th data-name="pallet_no" class="<?= $Page->pallet_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_pallet_no" class="oss_manual_pallet_no"><?= $Page->renderFieldHeader($Page->pallet_no) ?></div></th>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
        <th data-name="idw" class="<?= $Page->idw->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_idw" class="oss_manual_idw"><?= $Page->renderFieldHeader($Page->idw) ?></div></th>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
        <th data-name="order_no" class="<?= $Page->order_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_order_no" class="oss_manual_order_no"><?= $Page->renderFieldHeader($Page->order_no) ?></div></th>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <th data-name="item_in_ctn" class="<?= $Page->item_in_ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_item_in_ctn" class="oss_manual_item_in_ctn"><?= $Page->renderFieldHeader($Page->item_in_ctn) ?></div></th>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <th data-name="no_of_ctn" class="<?= $Page->no_of_ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_no_of_ctn" class="oss_manual_no_of_ctn"><?= $Page->renderFieldHeader($Page->no_of_ctn) ?></div></th>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <th data-name="ctn_no" class="<?= $Page->ctn_no->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_ctn_no" class="oss_manual_ctn_no"><?= $Page->renderFieldHeader($Page->ctn_no) ?></div></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th data-name="checker" class="<?= $Page->checker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_checker" class="oss_manual_checker"><?= $Page->renderFieldHeader($Page->checker) ?></div></th>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
        <th data-name="shift" class="<?= $Page->shift->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_shift" class="oss_manual_shift"><?= $Page->renderFieldHeader($Page->shift) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_status" class="oss_manual_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_date_updated" class="oss_manual_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <th data-name="time_updated" class="<?= $Page->time_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_oss_manual_time_updated" class="oss_manual_time_updated"><?= $Page->renderFieldHeader($Page->time_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_oss_manual",
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
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date" class="el_oss_manual_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sscc->Visible) { // sscc ?>
        <td data-name="sscc"<?= $Page->sscc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_sscc" class="el_oss_manual_sscc">
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shipment->Visible) { // shipment ?>
        <td data-name="shipment"<?= $Page->shipment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_shipment" class="el_oss_manual_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pallet_no->Visible) { // pallet_no ?>
        <td data-name="pallet_no"<?= $Page->pallet_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_pallet_no" class="el_oss_manual_pallet_no">
<span<?= $Page->pallet_no->viewAttributes() ?>>
<?= $Page->pallet_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idw->Visible) { // idw ?>
        <td data-name="idw"<?= $Page->idw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_idw" class="el_oss_manual_idw">
<span<?= $Page->idw->viewAttributes() ?>>
<?= $Page->idw->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order_no->Visible) { // order_no ?>
        <td data-name="order_no"<?= $Page->order_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_order_no" class="el_oss_manual_order_no">
<span<?= $Page->order_no->viewAttributes() ?>>
<?= $Page->order_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
        <td data-name="item_in_ctn"<?= $Page->item_in_ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_item_in_ctn" class="el_oss_manual_item_in_ctn">
<span<?= $Page->item_in_ctn->viewAttributes() ?>>
<?= $Page->item_in_ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
        <td data-name="no_of_ctn"<?= $Page->no_of_ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_no_of_ctn" class="el_oss_manual_no_of_ctn">
<span<?= $Page->no_of_ctn->viewAttributes() ?>>
<?= $Page->no_of_ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ctn_no->Visible) { // ctn_no ?>
        <td data-name="ctn_no"<?= $Page->ctn_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_ctn_no" class="el_oss_manual_ctn_no">
<span<?= $Page->ctn_no->viewAttributes() ?>>
<?= $Page->ctn_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->checker->Visible) { // checker ?>
        <td data-name="checker"<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_checker" class="el_oss_manual_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shift->Visible) { // shift ?>
        <td data-name="shift"<?= $Page->shift->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_shift" class="el_oss_manual_shift">
<span<?= $Page->shift->viewAttributes() ?>>
<?= $Page->shift->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_status" class="el_oss_manual_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_date_updated" class="el_oss_manual_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_updated->Visible) { // time_updated ?>
        <td data-name="time_updated"<?= $Page->time_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_oss_manual_time_updated" class="el_oss_manual_time_updated">
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
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
    ew.addEventHandlers("oss_manual");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

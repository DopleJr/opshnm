<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$VasValidationList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vas_validation: currentTable } });
var currentForm, currentPageID;
var fvas_validationlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvas_validationlist = new ew.Form("fvas_validationlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fvas_validationlist;
    fvas_validationlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fvas_validationlist.lists.order = <?= $Page->order->toClientList($Page) ?>;
    fvas_validationlist.lists.po = <?= $Page->po->toClientList($Page) ?>;
    fvas_validationlist.lists.sap_art = <?= $Page->sap_art->toClientList($Page) ?>;
    fvas_validationlist.lists.sub_index = <?= $Page->sub_index->toClientList($Page) ?>;
    fvas_validationlist.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fvas_validationlist.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    fvas_validationlist.lists.season2 = <?= $Page->season2->toClientList($Page) ?>;
    fvas_validationlist.lists.qty_oss = <?= $Page->qty_oss->toClientList($Page) ?>;
    fvas_validationlist.lists.shipment = <?= $Page->shipment->toClientList($Page) ?>;
    fvas_validationlist.lists.aju = <?= $Page->aju->toClientList($Page) ?>;
    fvas_validationlist.lists.actual_price = <?= $Page->actual_price->toClientList($Page) ?>;
    fvas_validationlist.lists.price_foto = <?= $Page->price_foto->toClientList($Page) ?>;
    fvas_validationlist.lists.snow = <?= $Page->snow->toClientList($Page) ?>;
    fvas_validationlist.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    fvas_validationlist.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    fvas_validationlist.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fvas_validationlist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fvas_validationlist.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    fvas_validationlist.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;
    loadjs.done("fvas_validationlist");
});
var fvas_validationsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fvas_validationsrch = new ew.Form("fvas_validationsrch", "list");
    currentSearchForm = fvas_validationsrch;

    // Add fields
    var fields = currentTable.fields;
    fvas_validationsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["order", [], fields.order.isInvalid],
        ["po", [], fields.po.isInvalid],
        ["sap_art", [], fields.sap_art.isInvalid],
        ["sub_index", [], fields.sub_index.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["ctn", [], fields.ctn.isInvalid],
        ["season2", [], fields.season2.isInvalid],
        ["qty_oss", [], fields.qty_oss.isInvalid],
        ["shipment", [], fields.shipment.isInvalid],
        ["aju", [], fields.aju.isInvalid],
        ["actual_price", [], fields.actual_price.isInvalid],
        ["price_foto", [], fields.price_foto.isInvalid],
        ["snow", [], fields.snow.isInvalid],
        ["remarks", [], fields.remarks.isInvalid],
        ["date_upload", [], fields.date_upload.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_update", [], fields.date_update.isInvalid],
        ["time_update", [], fields.time_update.isInvalid]
    ]);

    // Validate form
    fvas_validationsrch.validate = function () {
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
    fvas_validationsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvas_validationsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fvas_validationsrch.lists.order = <?= $Page->order->toClientList($Page) ?>;
    fvas_validationsrch.lists.po = <?= $Page->po->toClientList($Page) ?>;
    fvas_validationsrch.lists.sap_art = <?= $Page->sap_art->toClientList($Page) ?>;
    fvas_validationsrch.lists.sub_index = <?= $Page->sub_index->toClientList($Page) ?>;
    fvas_validationsrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fvas_validationsrch.lists.ctn = <?= $Page->ctn->toClientList($Page) ?>;
    fvas_validationsrch.lists.season2 = <?= $Page->season2->toClientList($Page) ?>;
    fvas_validationsrch.lists.qty_oss = <?= $Page->qty_oss->toClientList($Page) ?>;
    fvas_validationsrch.lists.shipment = <?= $Page->shipment->toClientList($Page) ?>;
    fvas_validationsrch.lists.aju = <?= $Page->aju->toClientList($Page) ?>;
    fvas_validationsrch.lists.actual_price = <?= $Page->actual_price->toClientList($Page) ?>;
    fvas_validationsrch.lists.price_foto = <?= $Page->price_foto->toClientList($Page) ?>;
    fvas_validationsrch.lists.snow = <?= $Page->snow->toClientList($Page) ?>;
    fvas_validationsrch.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    fvas_validationsrch.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    fvas_validationsrch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fvas_validationsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fvas_validationsrch.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    fvas_validationsrch.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;

    // Filters
    fvas_validationsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fvas_validationsrch");
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
<form name="fvas_validationsrch" id="fvas_validationsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fvas_validationsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vas_validation">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->order->Visible) { // order ?>
<?php
if (!$Page->order->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_order" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->order->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_order"
            name="x_order[]"
            class="form-control ew-select<?= $Page->order->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_order"
            data-table="vas_validation"
            data-field="x_order"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->order->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->order->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->order->getPlaceHolder()) ?>"
            <?= $Page->order->editAttributes() ?>>
            <?= $Page->order->selectOptionListHtml("x_order", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->order->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_order",
                selectId: "fvas_validationsrch_x_order",
                ajax: { id: "x_order", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.order.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
<?php
if (!$Page->po->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_po" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->po->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_po"
            name="x_po[]"
            class="form-control ew-select<?= $Page->po->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_po"
            data-table="vas_validation"
            data-field="x_po"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->po->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->po->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->po->getPlaceHolder()) ?>"
            <?= $Page->po->editAttributes() ?>>
            <?= $Page->po->selectOptionListHtml("x_po", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->po->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_po",
                selectId: "fvas_validationsrch_x_po",
                ajax: { id: "x_po", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.po.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
<?php
if (!$Page->sap_art->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_sap_art" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->sap_art->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_sap_art"
            name="x_sap_art[]"
            class="form-control ew-select<?= $Page->sap_art->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_sap_art"
            data-table="vas_validation"
            data-field="x_sap_art"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->sap_art->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->sap_art->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->sap_art->getPlaceHolder()) ?>"
            <?= $Page->sap_art->editAttributes() ?>>
            <?= $Page->sap_art->selectOptionListHtml("x_sap_art", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->sap_art->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_sap_art",
                selectId: "fvas_validationsrch_x_sap_art",
                ajax: { id: "x_sap_art", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.sap_art.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
<?php
if (!$Page->sub_index->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_sub_index" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->sub_index->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_sub_index"
            name="x_sub_index[]"
            class="form-control ew-select<?= $Page->sub_index->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_sub_index"
            data-table="vas_validation"
            data-field="x_sub_index"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->sub_index->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->sub_index->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->sub_index->getPlaceHolder()) ?>"
            <?= $Page->sub_index->editAttributes() ?>>
            <?= $Page->sub_index->selectOptionListHtml("x_sub_index", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->sub_index->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_sub_index",
                selectId: "fvas_validationsrch_x_sub_index",
                ajax: { id: "x_sub_index", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.sub_index.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_concept"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_concept",
                selectId: "fvas_validationsrch_x_concept",
                ajax: { id: "x_concept", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.concept.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_ctn"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_ctn",
                selectId: "fvas_validationsrch_x_ctn",
                ajax: { id: "x_ctn", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.ctn.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
<?php
if (!$Page->season2->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_season2" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->season2->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_season2"
            name="x_season2[]"
            class="form-control ew-select<?= $Page->season2->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_season2"
            data-table="vas_validation"
            data-field="x_season2"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->season2->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->season2->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->season2->getPlaceHolder()) ?>"
            <?= $Page->season2->editAttributes() ?>>
            <?= $Page->season2->selectOptionListHtml("x_season2", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->season2->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_season2",
                selectId: "fvas_validationsrch_x_season2",
                ajax: { id: "x_season2", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.season2.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
<?php
if (!$Page->qty_oss->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_qty_oss" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->qty_oss->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_qty_oss"
            name="x_qty_oss[]"
            class="form-control ew-select<?= $Page->qty_oss->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_qty_oss"
            data-table="vas_validation"
            data-field="x_qty_oss"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->qty_oss->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->qty_oss->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->qty_oss->getPlaceHolder()) ?>"
            <?= $Page->qty_oss->editAttributes() ?>>
            <?= $Page->qty_oss->selectOptionListHtml("x_qty_oss", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->qty_oss->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_qty_oss",
                selectId: "fvas_validationsrch_x_qty_oss",
                ajax: { id: "x_qty_oss", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.qty_oss.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_shipment"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_shipment",
                selectId: "fvas_validationsrch_x_shipment",
                ajax: { id: "x_shipment", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.shipment.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
<?php
if (!$Page->aju->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_aju" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->aju->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_aju"
            name="x_aju[]"
            class="form-control ew-select<?= $Page->aju->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_aju"
            data-table="vas_validation"
            data-field="x_aju"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->aju->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->aju->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->aju->getPlaceHolder()) ?>"
            <?= $Page->aju->editAttributes() ?>>
            <?= $Page->aju->selectOptionListHtml("x_aju", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->aju->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_aju",
                selectId: "fvas_validationsrch_x_aju",
                ajax: { id: "x_aju", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.aju.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
<?php
if (!$Page->actual_price->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_actual_price" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->actual_price->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_actual_price"
            name="x_actual_price[]"
            class="form-control ew-select<?= $Page->actual_price->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_actual_price"
            data-table="vas_validation"
            data-field="x_actual_price"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->actual_price->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->actual_price->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->actual_price->getPlaceHolder()) ?>"
            <?= $Page->actual_price->editAttributes() ?>>
            <?= $Page->actual_price->selectOptionListHtml("x_actual_price", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->actual_price->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_actual_price",
                selectId: "fvas_validationsrch_x_actual_price",
                ajax: { id: "x_actual_price", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.actual_price.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
<?php
if (!$Page->price_foto->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_price_foto" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->price_foto->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_price_foto"
            name="x_price_foto[]"
            class="form-control ew-select<?= $Page->price_foto->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_price_foto"
            data-table="vas_validation"
            data-field="x_price_foto"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->price_foto->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->price_foto->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->price_foto->getPlaceHolder()) ?>"
            <?= $Page->price_foto->editAttributes() ?>>
            <?= $Page->price_foto->selectOptionListHtml("x_price_foto", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->price_foto->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_price_foto",
                selectId: "fvas_validationsrch_x_price_foto",
                ajax: { id: "x_price_foto", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.price_foto.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
<?php
if (!$Page->snow->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_snow" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->snow->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_snow"
            name="x_snow[]"
            class="form-control ew-select<?= $Page->snow->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_snow"
            data-table="vas_validation"
            data-field="x_snow"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->snow->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->snow->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->snow->getPlaceHolder()) ?>"
            <?= $Page->snow->editAttributes() ?>>
            <?= $Page->snow->selectOptionListHtml("x_snow", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->snow->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_snow",
                selectId: "fvas_validationsrch_x_snow",
                ajax: { id: "x_snow", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.snow.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
<?php
if (!$Page->remarks->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_remarks" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->remarks->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_remarks"
            name="x_remarks[]"
            class="form-control ew-select<?= $Page->remarks->isInvalidClass() ?>"
            data-select2-id="fvas_validationsrch_x_remarks"
            data-table="vas_validation"
            data-field="x_remarks"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->remarks->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->remarks->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"
            <?= $Page->remarks->editAttributes() ?>>
            <?= $Page->remarks->selectOptionListHtml("x_remarks", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->remarks->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_remarks",
                selectId: "fvas_validationsrch_x_remarks",
                ajax: { id: "x_remarks", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.remarks.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_date_upload"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_date_upload",
                selectId: "fvas_validationsrch_x_date_upload",
                ajax: { id: "x_date_upload", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.date_upload.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_user"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_user",
                selectId: "fvas_validationsrch_x_user",
                ajax: { id: "x_user", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.user.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_status"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fvas_validationsrch_x_status",
                ajax: { id: "x_status", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.status.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_date_update"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_date_update",
                selectId: "fvas_validationsrch_x_date_update",
                ajax: { id: "x_date_update", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.date_update.filterOptions);
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
            data-select2-id="fvas_validationsrch_x_time_update"
            data-table="vas_validation"
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
        loadjs.ready("fvas_validationsrch", function() {
            var options = {
                name: "x_time_update",
                selectId: "fvas_validationsrch_x_time_update",
                ajax: { id: "x_time_update", form: "fvas_validationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.vas_validation.fields.time_update.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fvas_validationsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fvas_validationsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fvas_validationsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fvas_validationsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vas_validation">
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
<form name="fvas_validationlist" id="fvas_validationlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vas_validation">
<div id="gmp_vas_validation" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_vas_validationlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_id" class="vas_validation_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
        <th data-name="order" class="<?= $Page->order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_order" class="vas_validation_order"><?= $Page->renderFieldHeader($Page->order) ?></div></th>
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
        <th data-name="po" class="<?= $Page->po->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_po" class="vas_validation_po"><?= $Page->renderFieldHeader($Page->po) ?></div></th>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
        <th data-name="sap_art" class="<?= $Page->sap_art->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_sap_art" class="vas_validation_sap_art"><?= $Page->renderFieldHeader($Page->sap_art) ?></div></th>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
        <th data-name="sub_index" class="<?= $Page->sub_index->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_sub_index" class="vas_validation_sub_index"><?= $Page->renderFieldHeader($Page->sub_index) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_concept" class="vas_validation_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th data-name="ctn" class="<?= $Page->ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_ctn" class="vas_validation_ctn"><?= $Page->renderFieldHeader($Page->ctn) ?></div></th>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
        <th data-name="season2" class="<?= $Page->season2->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_season2" class="vas_validation_season2"><?= $Page->renderFieldHeader($Page->season2) ?></div></th>
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
        <th data-name="qty_oss" class="<?= $Page->qty_oss->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_qty_oss" class="vas_validation_qty_oss"><?= $Page->renderFieldHeader($Page->qty_oss) ?></div></th>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
        <th data-name="shipment" class="<?= $Page->shipment->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_shipment" class="vas_validation_shipment"><?= $Page->renderFieldHeader($Page->shipment) ?></div></th>
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
        <th data-name="aju" class="<?= $Page->aju->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_aju" class="vas_validation_aju"><?= $Page->renderFieldHeader($Page->aju) ?></div></th>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
        <th data-name="actual_price" class="<?= $Page->actual_price->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_actual_price" class="vas_validation_actual_price"><?= $Page->renderFieldHeader($Page->actual_price) ?></div></th>
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
        <th data-name="price_foto" class="<?= $Page->price_foto->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_price_foto" class="vas_validation_price_foto"><?= $Page->renderFieldHeader($Page->price_foto) ?></div></th>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
        <th data-name="snow" class="<?= $Page->snow->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_snow" class="vas_validation_snow"><?= $Page->renderFieldHeader($Page->snow) ?></div></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th data-name="remarks" class="<?= $Page->remarks->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_remarks" class="vas_validation_remarks"><?= $Page->renderFieldHeader($Page->remarks) ?></div></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th data-name="date_upload" class="<?= $Page->date_upload->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_date_upload" class="vas_validation_date_upload"><?= $Page->renderFieldHeader($Page->date_upload) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_user" class="vas_validation_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_status" class="vas_validation_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th data-name="date_update" class="<?= $Page->date_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_date_update" class="vas_validation_date_update"><?= $Page->renderFieldHeader($Page->date_update) ?></div></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th data-name="time_update" class="<?= $Page->time_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vas_validation_time_update" class="vas_validation_time_update"><?= $Page->renderFieldHeader($Page->time_update) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_vas_validation",
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
<span id="el<?= $Page->RowCount ?>_vas_validation_id" class="el_vas_validation_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order->Visible) { // order ?>
        <td data-name="order"<?= $Page->order->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_order" class="el_vas_validation_order">
<span<?= $Page->order->viewAttributes() ?>>
<?= $Page->order->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->po->Visible) { // po ?>
        <td data-name="po"<?= $Page->po->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_po" class="el_vas_validation_po">
<span<?= $Page->po->viewAttributes() ?>>
<?= $Page->po->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sap_art->Visible) { // sap_art ?>
        <td data-name="sap_art"<?= $Page->sap_art->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_sap_art" class="el_vas_validation_sap_art">
<span<?= $Page->sap_art->viewAttributes() ?>>
<?= $Page->sap_art->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sub_index->Visible) { // sub_index ?>
        <td data-name="sub_index"<?= $Page->sub_index->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_sub_index" class="el_vas_validation_sub_index">
<span<?= $Page->sub_index->viewAttributes() ?>>
<?= $Page->sub_index->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_concept" class="el_vas_validation_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ctn->Visible) { // ctn ?>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_ctn" class="el_vas_validation_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->season2->Visible) { // season2 ?>
        <td data-name="season2"<?= $Page->season2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_season2" class="el_vas_validation_season2">
<span<?= $Page->season2->viewAttributes() ?>>
<?= $Page->season2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->qty_oss->Visible) { // qty_oss ?>
        <td data-name="qty_oss"<?= $Page->qty_oss->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_qty_oss" class="el_vas_validation_qty_oss">
<span<?= $Page->qty_oss->viewAttributes() ?>>
<?= $Page->qty_oss->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shipment->Visible) { // shipment ?>
        <td data-name="shipment"<?= $Page->shipment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_shipment" class="el_vas_validation_shipment">
<span<?= $Page->shipment->viewAttributes() ?>>
<?= $Page->shipment->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aju->Visible) { // aju ?>
        <td data-name="aju"<?= $Page->aju->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_aju" class="el_vas_validation_aju">
<span<?= $Page->aju->viewAttributes() ?>>
<?= $Page->aju->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->actual_price->Visible) { // actual_price ?>
        <td data-name="actual_price"<?= $Page->actual_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_actual_price" class="el_vas_validation_actual_price">
<span<?= $Page->actual_price->viewAttributes() ?>>
<?= $Page->actual_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->price_foto->Visible) { // price_foto ?>
        <td data-name="price_foto"<?= $Page->price_foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_price_foto" class="el_vas_validation_price_foto">
<span>
<?= GetFileViewTag($Page->price_foto, $Page->price_foto->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->snow->Visible) { // snow ?>
        <td data-name="snow"<?= $Page->snow->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_snow" class="el_vas_validation_snow">
<span<?= $Page->snow->viewAttributes() ?>>
<?= $Page->snow->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remarks->Visible) { // remarks ?>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_remarks" class="el_vas_validation_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_date_upload" class="el_vas_validation_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_user" class="el_vas_validation_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_status" class="el_vas_validation_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_update->Visible) { // date_update ?>
        <td data-name="date_update"<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_date_update" class="el_vas_validation_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_update->Visible) { // time_update ?>
        <td data-name="time_update"<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vas_validation_time_update" class="el_vas_validation_time_update">
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
    ew.addEventHandlers("vas_validation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

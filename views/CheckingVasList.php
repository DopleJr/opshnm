<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CheckingVasList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { checking_vas: currentTable } });
var currentForm, currentPageID;
var fchecking_vaslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fchecking_vaslist = new ew.Form("fchecking_vaslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fchecking_vaslist;
    fchecking_vaslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fchecking_vaslist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fchecking_vaslist.lists.order = <?= $Page->order->toClientList($Page) ?>;
    fchecking_vaslist.lists.sap_art = <?= $Page->sap_art->toClientList($Page) ?>;
    fchecking_vaslist.lists.sub_index = <?= $Page->sub_index->toClientList($Page) ?>;
    fchecking_vaslist.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fchecking_vaslist.lists.season2 = <?= $Page->season2->toClientList($Page) ?>;
    fchecking_vaslist.lists.snow = <?= $Page->snow->toClientList($Page) ?>;
    fchecking_vaslist.lists.actual_price = <?= $Page->actual_price->toClientList($Page) ?>;
    fchecking_vaslist.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    fchecking_vaslist.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fchecking_vaslist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fchecking_vaslist.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    fchecking_vaslist.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;
    loadjs.done("fchecking_vaslist");
});
var fchecking_vassrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fchecking_vassrch = new ew.Form("fchecking_vassrch", "list");
    currentSearchForm = fchecking_vassrch;

    // Add fields
    var fields = currentTable.fields;
    fchecking_vassrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["order", [], fields.order.isInvalid],
        ["sap_art", [], fields.sap_art.isInvalid],
        ["sub_index", [], fields.sub_index.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["season2", [], fields.season2.isInvalid],
        ["snow", [], fields.snow.isInvalid],
        ["actual_price", [], fields.actual_price.isInvalid],
        ["remarks", [], fields.remarks.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_update", [], fields.date_update.isInvalid],
        ["time_update", [], fields.time_update.isInvalid]
    ]);

    // Validate form
    fchecking_vassrch.validate = function () {
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
    fchecking_vassrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fchecking_vassrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fchecking_vassrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fchecking_vassrch.lists.order = <?= $Page->order->toClientList($Page) ?>;
    fchecking_vassrch.lists.sap_art = <?= $Page->sap_art->toClientList($Page) ?>;
    fchecking_vassrch.lists.sub_index = <?= $Page->sub_index->toClientList($Page) ?>;
    fchecking_vassrch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    fchecking_vassrch.lists.season2 = <?= $Page->season2->toClientList($Page) ?>;
    fchecking_vassrch.lists.shipment = <?= $Page->shipment->toClientList($Page) ?>;
    fchecking_vassrch.lists.aju = <?= $Page->aju->toClientList($Page) ?>;
    fchecking_vassrch.lists.snow = <?= $Page->snow->toClientList($Page) ?>;
    fchecking_vassrch.lists.actual_price = <?= $Page->actual_price->toClientList($Page) ?>;
    fchecking_vassrch.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    fchecking_vassrch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fchecking_vassrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fchecking_vassrch.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    fchecking_vassrch.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;

    // Filters
    fchecking_vassrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fchecking_vassrch");
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
<form name="fchecking_vassrch" id="fchecking_vassrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fchecking_vassrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="checking_vas">
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
            data-select2-id="fchecking_vassrch_x_id"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_id",
                selectId: "fchecking_vassrch_x_id",
                ajax: { id: "x_id", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
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
            data-select2-id="fchecking_vassrch_x_order"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_order",
                selectId: "fchecking_vassrch_x_order",
                ajax: { id: "x_order", form: "fchecking_vassrch", limit: 1000, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.order.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_sap_art"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_sap_art",
                selectId: "fchecking_vassrch_x_sap_art",
                ajax: { id: "x_sap_art", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.sap_art.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_sub_index"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_sub_index",
                selectId: "fchecking_vassrch_x_sub_index",
                ajax: { id: "x_sub_index", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.sub_index.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_concept"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_concept",
                selectId: "fchecking_vassrch_x_concept",
                ajax: { id: "x_concept", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.concept.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_season2"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_season2",
                selectId: "fchecking_vassrch_x_season2",
                ajax: { id: "x_season2", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.season2.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_shipment"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_shipment",
                selectId: "fchecking_vassrch_x_shipment",
                ajax: { id: "x_shipment", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.shipment.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_aju"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_aju",
                selectId: "fchecking_vassrch_x_aju",
                ajax: { id: "x_aju", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.aju.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_snow"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_snow",
                selectId: "fchecking_vassrch_x_snow",
                ajax: { id: "x_snow", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.snow.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_actual_price"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_actual_price",
                selectId: "fchecking_vassrch_x_actual_price",
                ajax: { id: "x_actual_price", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.actual_price.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_remarks"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_remarks",
                selectId: "fchecking_vassrch_x_remarks",
                ajax: { id: "x_remarks", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.remarks.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_user"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_user",
                selectId: "fchecking_vassrch_x_user",
                ajax: { id: "x_user", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.user.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_status"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_status",
                selectId: "fchecking_vassrch_x_status",
                ajax: { id: "x_status", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.status.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_date_update"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_date_update",
                selectId: "fchecking_vassrch_x_date_update",
                ajax: { id: "x_date_update", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.date_update.filterOptions);
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
            data-select2-id="fchecking_vassrch_x_time_update"
            data-table="checking_vas"
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
        loadjs.ready("fchecking_vassrch", function() {
            var options = {
                name: "x_time_update",
                selectId: "fchecking_vassrch_x_time_update",
                ajax: { id: "x_time_update", form: "fchecking_vassrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.checking_vas.fields.time_update.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fchecking_vassrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fchecking_vassrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fchecking_vassrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fchecking_vassrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> checking_vas">
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
<form name="fchecking_vaslist" id="fchecking_vaslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="checking_vas">
<div id="gmp_checking_vas" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_checking_vaslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_id" class="checking_vas_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
        <th data-name="order" class="<?= $Page->order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_order" class="checking_vas_order"><?= $Page->renderFieldHeader($Page->order) ?></div></th>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
        <th data-name="sap_art" class="<?= $Page->sap_art->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_sap_art" class="checking_vas_sap_art"><?= $Page->renderFieldHeader($Page->sap_art) ?></div></th>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
        <th data-name="sub_index" class="<?= $Page->sub_index->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_sub_index" class="checking_vas_sub_index"><?= $Page->renderFieldHeader($Page->sub_index) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_concept" class="checking_vas_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
        <th data-name="season2" class="<?= $Page->season2->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_season2" class="checking_vas_season2"><?= $Page->renderFieldHeader($Page->season2) ?></div></th>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
        <th data-name="snow" class="<?= $Page->snow->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_snow" class="checking_vas_snow"><?= $Page->renderFieldHeader($Page->snow) ?></div></th>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
        <th data-name="actual_price" class="<?= $Page->actual_price->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_actual_price" class="checking_vas_actual_price"><?= $Page->renderFieldHeader($Page->actual_price) ?></div></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th data-name="remarks" class="<?= $Page->remarks->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_remarks" class="checking_vas_remarks"><?= $Page->renderFieldHeader($Page->remarks) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_user" class="checking_vas_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_status" class="checking_vas_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th data-name="date_update" class="<?= $Page->date_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_date_update" class="checking_vas_date_update"><?= $Page->renderFieldHeader($Page->date_update) ?></div></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th data-name="time_update" class="<?= $Page->time_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_checking_vas_time_update" class="checking_vas_time_update"><?= $Page->renderFieldHeader($Page->time_update) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_checking_vas",
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
<span id="el<?= $Page->RowCount ?>_checking_vas_id" class="el_checking_vas_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order->Visible) { // order ?>
        <td data-name="order"<?= $Page->order->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_order" class="el_checking_vas_order">
<span<?= $Page->order->viewAttributes() ?>>
<?= $Page->order->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sap_art->Visible) { // sap_art ?>
        <td data-name="sap_art"<?= $Page->sap_art->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_sap_art" class="el_checking_vas_sap_art">
<span<?= $Page->sap_art->viewAttributes() ?>>
<?= $Page->sap_art->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sub_index->Visible) { // sub_index ?>
        <td data-name="sub_index"<?= $Page->sub_index->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_sub_index" class="el_checking_vas_sub_index">
<span<?= $Page->sub_index->viewAttributes() ?>>
<?= $Page->sub_index->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_concept" class="el_checking_vas_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->season2->Visible) { // season2 ?>
        <td data-name="season2"<?= $Page->season2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_season2" class="el_checking_vas_season2">
<span<?= $Page->season2->viewAttributes() ?>>
<?= $Page->season2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->snow->Visible) { // snow ?>
        <td data-name="snow"<?= $Page->snow->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_snow" class="el_checking_vas_snow">
<span<?= $Page->snow->viewAttributes() ?>>
<?= $Page->snow->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->actual_price->Visible) { // actual_price ?>
        <td data-name="actual_price"<?= $Page->actual_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_actual_price" class="el_checking_vas_actual_price">
<span<?= $Page->actual_price->viewAttributes() ?>>
<?= $Page->actual_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remarks->Visible) { // remarks ?>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_remarks" class="el_checking_vas_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_user" class="el_checking_vas_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_status" class="el_checking_vas_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_update->Visible) { // date_update ?>
        <td data-name="date_update"<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_date_update" class="el_checking_vas_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_update->Visible) { // time_update ?>
        <td data-name="time_update"<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_checking_vas_time_update" class="el_checking_vas_time_update">
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
    ew.addEventHandlers("checking_vas");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportTotesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_totes: currentTable } });
var currentForm, currentPageID;
var freport_toteslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_toteslist = new ew.Form("freport_toteslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = freport_toteslist;
    freport_toteslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    freport_toteslist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    freport_toteslist.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    freport_toteslist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    freport_toteslist.lists.out = <?= $Page->out->toClientList($Page) ?>;
    freport_toteslist.lists.in = <?= $Page->in->toClientList($Page) ?>;
    freport_toteslist.lists.diff = <?= $Page->diff->toClientList($Page) ?>;
    freport_toteslist.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    freport_toteslist.lists.date_out = <?= $Page->date_out->toClientList($Page) ?>;
    freport_toteslist.lists.date_in = <?= $Page->date_in->toClientList($Page) ?>;
    loadjs.done("freport_toteslist");
});
var freport_totessrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    freport_totessrch = new ew.Form("freport_totessrch", "list");
    currentSearchForm = freport_totessrch;

    // Add fields
    var fields = currentTable.fields;
    freport_totessrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["out", [], fields.out.isInvalid],
        ["in", [], fields.in.isInvalid],
        ["diff", [], fields.diff.isInvalid],
        ["remarks", [], fields.remarks.isInvalid],
        ["date_out", [], fields.date_out.isInvalid],
        ["date_in", [], fields.date_in.isInvalid]
    ]);

    // Validate form
    freport_totessrch.validate = function () {
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
    freport_totessrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freport_totessrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    freport_totessrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    freport_totessrch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    freport_totessrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    freport_totessrch.lists.out = <?= $Page->out->toClientList($Page) ?>;
    freport_totessrch.lists.in = <?= $Page->in->toClientList($Page) ?>;
    freport_totessrch.lists.diff = <?= $Page->diff->toClientList($Page) ?>;
    freport_totessrch.lists.remarks = <?= $Page->remarks->toClientList($Page) ?>;
    freport_totessrch.lists.date_out = <?= $Page->date_out->toClientList($Page) ?>;
    freport_totessrch.lists.date_in = <?= $Page->date_in->toClientList($Page) ?>;

    // Filters
    freport_totessrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("freport_totessrch");
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
<form name="freport_totessrch" id="freport_totessrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="freport_totessrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="report_totes">
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
            data-select2-id="freport_totessrch_x_id"
            data-table="report_totes"
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
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_id",
                selectId: "freport_totessrch_x_id",
                ajax: { id: "x_id", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.id.filterOptions);
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
            data-select2-id="freport_totessrch_x_store_id"
            data-table="report_totes"
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
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_store_id",
                selectId: "freport_totessrch_x_store_id",
                ajax: { id: "x_store_id", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.store_id.filterOptions);
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
            data-select2-id="freport_totessrch_x_store_name"
            data-table="report_totes"
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
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "freport_totessrch_x_store_name",
                ajax: { id: "x_store_name", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.store_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->out->Visible) { // out ?>
<?php
if (!$Page->out->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_out" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->out->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_out"
            name="x_out[]"
            class="form-control ew-select<?= $Page->out->isInvalidClass() ?>"
            data-select2-id="freport_totessrch_x_out"
            data-table="report_totes"
            data-field="x_out"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->out->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->out->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->out->getPlaceHolder()) ?>"
            <?= $Page->out->editAttributes() ?>>
            <?= $Page->out->selectOptionListHtml("x_out", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->out->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_out",
                selectId: "freport_totessrch_x_out",
                ajax: { id: "x_out", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.out.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->in->Visible) { // in ?>
<?php
if (!$Page->in->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_in" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->in->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_in"
            name="x_in[]"
            class="form-control ew-select<?= $Page->in->isInvalidClass() ?>"
            data-select2-id="freport_totessrch_x_in"
            data-table="report_totes"
            data-field="x_in"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->in->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->in->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->in->getPlaceHolder()) ?>"
            <?= $Page->in->editAttributes() ?>>
            <?= $Page->in->selectOptionListHtml("x_in", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->in->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_in",
                selectId: "freport_totessrch_x_in",
                ajax: { id: "x_in", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.in.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->diff->Visible) { // diff ?>
<?php
if (!$Page->diff->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_diff" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->diff->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_diff"
            name="x_diff[]"
            class="form-control ew-select<?= $Page->diff->isInvalidClass() ?>"
            data-select2-id="freport_totessrch_x_diff"
            data-table="report_totes"
            data-field="x_diff"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->diff->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->diff->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->diff->getPlaceHolder()) ?>"
            <?= $Page->diff->editAttributes() ?>>
            <?= $Page->diff->selectOptionListHtml("x_diff", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->diff->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_diff",
                selectId: "freport_totessrch_x_diff",
                ajax: { id: "x_diff", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.diff.filterOptions);
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
            data-select2-id="freport_totessrch_x_remarks"
            data-table="report_totes"
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
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_remarks",
                selectId: "freport_totessrch_x_remarks",
                ajax: { id: "x_remarks", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.remarks.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_out->Visible) { // date_out ?>
<?php
if (!$Page->date_out->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_out" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_out->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_out"
            name="x_date_out[]"
            class="form-control ew-select<?= $Page->date_out->isInvalidClass() ?>"
            data-select2-id="freport_totessrch_x_date_out"
            data-table="report_totes"
            data-field="x_date_out"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_out->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_out->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_out->getPlaceHolder()) ?>"
            <?= $Page->date_out->editAttributes() ?>>
            <?= $Page->date_out->selectOptionListHtml("x_date_out", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_out->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_date_out",
                selectId: "freport_totessrch_x_date_out",
                ajax: { id: "x_date_out", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.date_out.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_in->Visible) { // date_in ?>
<?php
if (!$Page->date_in->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_in" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_in->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_in"
            name="x_date_in[]"
            class="form-control ew-select<?= $Page->date_in->isInvalidClass() ?>"
            data-select2-id="freport_totessrch_x_date_in"
            data-table="report_totes"
            data-field="x_date_in"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_in->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_in->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_in->getPlaceHolder()) ?>"
            <?= $Page->date_in->editAttributes() ?>>
            <?= $Page->date_in->selectOptionListHtml("x_date_in", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_in->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("freport_totessrch", function() {
            var options = {
                name: "x_date_in",
                selectId: "freport_totessrch_x_date_in",
                ajax: { id: "x_date_in", form: "freport_totessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.report_totes.fields.date_in.filterOptions);
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> report_totes">
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
<form name="freport_toteslist" id="freport_toteslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_totes">
<div id="gmp_report_totes" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_report_toteslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_id" class="report_totes_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_store_id" class="report_totes_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_store_name" class="report_totes_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->out->Visible) { // out ?>
        <th data-name="out" class="<?= $Page->out->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_out" class="report_totes_out"><?= $Page->renderFieldHeader($Page->out) ?></div></th>
<?php } ?>
<?php if ($Page->in->Visible) { // in ?>
        <th data-name="in" class="<?= $Page->in->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_in" class="report_totes_in"><?= $Page->renderFieldHeader($Page->in) ?></div></th>
<?php } ?>
<?php if ($Page->diff->Visible) { // diff ?>
        <th data-name="diff" class="<?= $Page->diff->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_diff" class="report_totes_diff"><?= $Page->renderFieldHeader($Page->diff) ?></div></th>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
        <th data-name="remarks" class="<?= $Page->remarks->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_remarks" class="report_totes_remarks"><?= $Page->renderFieldHeader($Page->remarks) ?></div></th>
<?php } ?>
<?php if ($Page->date_out->Visible) { // date_out ?>
        <th data-name="date_out" class="<?= $Page->date_out->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_date_out" class="report_totes_date_out"><?= $Page->renderFieldHeader($Page->date_out) ?></div></th>
<?php } ?>
<?php if ($Page->date_in->Visible) { // date_in ?>
        <th data-name="date_in" class="<?= $Page->date_in->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_report_totes_date_in" class="report_totes_date_in"><?= $Page->renderFieldHeader($Page->date_in) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_report_totes",
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
<span id="el<?= $Page->RowCount ?>_report_totes_id" class="el_report_totes_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_store_id" class="el_report_totes_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_store_name" class="el_report_totes_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->out->Visible) { // out ?>
        <td data-name="out"<?= $Page->out->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_out" class="el_report_totes_out">
<span<?= $Page->out->viewAttributes() ?>>
<?= $Page->out->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->in->Visible) { // in ?>
        <td data-name="in"<?= $Page->in->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_in" class="el_report_totes_in">
<span<?= $Page->in->viewAttributes() ?>>
<?= $Page->in->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->diff->Visible) { // diff ?>
        <td data-name="diff"<?= $Page->diff->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_diff" class="el_report_totes_diff">
<span<?= $Page->diff->viewAttributes() ?>>
<?= $Page->diff->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->remarks->Visible) { // remarks ?>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_remarks" class="el_report_totes_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_out->Visible) { // date_out ?>
        <td data-name="date_out"<?= $Page->date_out->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_date_out" class="el_report_totes_date_out">
<span<?= $Page->date_out->viewAttributes() ?>>
<?= $Page->date_out->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_in->Visible) { // date_in ?>
        <td data-name="date_in"<?= $Page->date_in->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_totes_date_in" class="el_report_totes_date_in">
<span<?= $Page->date_in->viewAttributes() ?>>
<?= $Page->date_in->getViewValue() ?></span>
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
    ew.addEventHandlers("report_totes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control: currentTable } });
var currentForm, currentPageID;
var fjob_controllist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_controllist = new ew.Form("fjob_controllist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fjob_controllist;
    fjob_controllist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fjob_controllist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fjob_controllist.lists.job_category = <?= $Page->job_category->toClientList($Page) ?>;
    fjob_controllist.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_controllist.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_controllist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fjob_controllist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fjob_controllist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("fjob_controllist");
});
var fjob_controlsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fjob_controlsrch = new ew.Form("fjob_controlsrch", "list");
    currentSearchForm = fjob_controlsrch;

    // Add fields
    var fields = currentTable.fields;
    fjob_controlsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["job_category", [], fields.job_category.isInvalid],
        ["aisle", [], fields.aisle.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid],
        ["test", [], fields.test.isInvalid],
        ["test2", [], fields.test2.isInvalid],
        ["test3", [], fields.test3.isInvalid],
        ["test4", [], fields.test4.isInvalid]
    ]);

    // Validate form
    fjob_controlsrch.validate = function () {
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
    fjob_controlsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjob_controlsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjob_controlsrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fjob_controlsrch.lists.job_category = <?= $Page->job_category->toClientList($Page) ?>;
    fjob_controlsrch.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_controlsrch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_controlsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fjob_controlsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fjob_controlsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fjob_controlsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fjob_controlsrch");
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
<form name="fjob_controlsrch" id="fjob_controlsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fjob_controlsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="job_control">
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
            data-select2-id="fjob_controlsrch_x_id"
            data-table="job_control"
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
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_id",
                selectId: "fjob_controlsrch_x_id",
                ajax: { id: "x_id", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->job_category->Visible) { // job_category ?>
<?php
if (!$Page->job_category->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_job_category" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->job_category->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_job_category"
            name="x_job_category[]"
            class="form-control ew-select<?= $Page->job_category->isInvalidClass() ?>"
            data-select2-id="fjob_controlsrch_x_job_category"
            data-table="job_control"
            data-field="x_job_category"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->job_category->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->job_category->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->job_category->getPlaceHolder()) ?>"
            <?= $Page->job_category->editAttributes() ?>>
            <?= $Page->job_category->selectOptionListHtml("x_job_category", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->job_category->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_job_category",
                selectId: "fjob_controlsrch_x_job_category",
                ajax: { id: "x_job_category", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.job_category.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
<?php
if (!$Page->aisle->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_aisle" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->aisle->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_aisle"
            name="x_aisle[]"
            class="form-control ew-select<?= $Page->aisle->isInvalidClass() ?>"
            data-select2-id="fjob_controlsrch_x_aisle"
            data-table="job_control"
            data-field="x_aisle"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->aisle->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->aisle->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->aisle->getPlaceHolder()) ?>"
            <?= $Page->aisle->editAttributes() ?>>
            <?= $Page->aisle->selectOptionListHtml("x_aisle", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->aisle->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_aisle",
                selectId: "fjob_controlsrch_x_aisle",
                ajax: { id: "x_aisle", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.aisle.filterOptions);
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
            data-select2-id="fjob_controlsrch_x_user"
            data-table="job_control"
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
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_user",
                selectId: "fjob_controlsrch_x_user",
                ajax: { id: "x_user", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.user.filterOptions);
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
            data-select2-id="fjob_controlsrch_x_status"
            data-table="job_control"
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
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fjob_controlsrch_x_status",
                ajax: { id: "x_status", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.status.filterOptions);
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
            data-select2-id="fjob_controlsrch_x_date_created"
            data-table="job_control"
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
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fjob_controlsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.date_created.filterOptions);
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
            data-select2-id="fjob_controlsrch_x_date_updated"
            data-table="job_control"
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
        loadjs.ready("fjob_controlsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fjob_controlsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fjob_controlsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_control.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjob_controlsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjob_controlsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjob_controlsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjob_controlsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> job_control">
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
<form name="fjob_controllist" id="fjob_controllist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control">
<div id="gmp_job_control" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_job_controllist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_job_control_id" class="job_control_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->job_category->Visible) { // job_category ?>
        <th data-name="job_category" class="<?= $Page->job_category->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_job_control_job_category" class="job_control_job_category"><?= $Page->renderFieldHeader($Page->job_category) ?></div></th>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th data-name="aisle" class="<?= $Page->aisle->headerCellClass() ?>"><div id="elh_job_control_aisle" class="job_control_aisle"><?= $Page->renderFieldHeader($Page->aisle) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_job_control_user" class="job_control_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_job_control_status" class="job_control_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_job_control_date_created" class="job_control_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_job_control_date_updated" class="job_control_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->test->Visible) { // test ?>
        <th data-name="test" class="<?= $Page->test->headerCellClass() ?>"><div id="elh_job_control_test" class="job_control_test"><?= $Page->renderFieldHeader($Page->test) ?></div></th>
<?php } ?>
<?php if ($Page->test2->Visible) { // test2 ?>
        <th data-name="test2" class="<?= $Page->test2->headerCellClass() ?>"><div id="elh_job_control_test2" class="job_control_test2"><?= $Page->renderFieldHeader($Page->test2) ?></div></th>
<?php } ?>
<?php if ($Page->test3->Visible) { // test3 ?>
        <th data-name="test3" class="<?= $Page->test3->headerCellClass() ?>"><div id="elh_job_control_test3" class="job_control_test3"><?= $Page->renderFieldHeader($Page->test3) ?></div></th>
<?php } ?>
<?php if ($Page->test4->Visible) { // test4 ?>
        <th data-name="test4" class="<?= $Page->test4->headerCellClass() ?>"><div id="elh_job_control_test4" class="job_control_test4"><?= $Page->renderFieldHeader($Page->test4) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_job_control",
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
<span id="el<?= $Page->RowCount ?>_job_control_id" class="el_job_control_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->job_category->Visible) { // job_category ?>
        <td data-name="job_category"<?= $Page->job_category->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_job_category" class="el_job_control_job_category">
<span<?= $Page->job_category->viewAttributes() ?>>
<?= $Page->job_category->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aisle->Visible) { // aisle ?>
        <td data-name="aisle"<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_aisle" class="el_job_control_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_user" class="el_job_control_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_status" class="el_job_control_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_date_created" class="el_job_control_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_date_updated" class="el_job_control_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test->Visible) { // test ?>
        <td data-name="test"<?= $Page->test->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_test" class="el_job_control_test">
<span<?= $Page->test->viewAttributes() ?>>
<?= $Page->test->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test2->Visible) { // test2 ?>
        <td data-name="test2"<?= $Page->test2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_test2" class="el_job_control_test2">
<span<?= $Page->test2->viewAttributes() ?>>
<?= $Page->test2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test3->Visible) { // test3 ?>
        <td data-name="test3"<?= $Page->test3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_test3" class="el_job_control_test3">
<span<?= $Page->test3->viewAttributes() ?>>
<?= $Page->test3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test4->Visible) { // test4 ?>
        <td data-name="test4"<?= $Page->test4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_control_test4" class="el_job_control_test4">
<span<?= $Page->test4->viewAttributes() ?>>
<?php if (!EmptyString($Page->test4->TooltipValue) && $Page->test4->linkAttributes() != "") { ?>
<a<?= $Page->test4->linkAttributes() ?>><?= $Page->test4->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->test4->getViewValue() ?>
<?php } ?>
<span id="tt_job_control_x<?= $Page->RowCount ?>_test4" class="d-none">
<?= $Page->test4->TooltipValue ?>
</span></span>
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
    ew.addEventHandlers("job_control");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

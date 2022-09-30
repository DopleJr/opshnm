<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StockCountList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock_count: currentTable } });
var currentForm, currentPageID;
var fstock_countlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstock_countlist = new ew.Form("fstock_countlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fstock_countlist;
    fstock_countlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fstock_countlist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fstock_countlist.lists.location = <?= $Page->location->toClientList($Page) ?>;
    fstock_countlist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fstock_countlist.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fstock_countlist.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    fstock_countlist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fstock_countlist.lists.time_created = <?= $Page->time_created->toClientList($Page) ?>;
    loadjs.done("fstock_countlist");
});
var fstock_countsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fstock_countsrch = new ew.Form("fstock_countsrch", "list");
    currentSearchForm = fstock_countsrch;

    // Add fields
    var fields = currentTable.fields;
    fstock_countsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["location", [], fields.location.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["divisi", [], fields.divisi.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["y_date_created", [ew.Validators.between], false],
        ["time_created", [], fields.time_created.isInvalid]
    ]);

    // Validate form
    fstock_countsrch.validate = function () {
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
    fstock_countsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstock_countsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fstock_countsrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fstock_countsrch.lists.location = <?= $Page->location->toClientList($Page) ?>;
    fstock_countsrch.lists.scan = <?= $Page->scan->toClientList($Page) ?>;
    fstock_countsrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fstock_countsrch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fstock_countsrch.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    fstock_countsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fstock_countsrch.lists.time_created = <?= $Page->time_created->toClientList($Page) ?>;

    // Filters
    fstock_countsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fstock_countsrch");
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
<form name="fstock_countsrch" id="fstock_countsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fstock_countsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="stock_count">
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
            data-select2-id="fstock_countsrch_x_id"
            data-table="stock_count"
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
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_id",
                selectId: "fstock_countsrch_x_id",
                ajax: { id: "x_id", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
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
            data-select2-id="fstock_countsrch_x_location"
            data-table="stock_count"
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
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_location",
                selectId: "fstock_countsrch_x_location",
                ajax: { id: "x_location", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.location.filterOptions);
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
            data-select2-id="fstock_countsrch_x_scan"
            data-table="stock_count"
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
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_scan",
                selectId: "fstock_countsrch_x_scan",
                ajax: { id: "x_scan", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.scan.filterOptions);
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
            data-select2-id="fstock_countsrch_x_article"
            data-table="stock_count"
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
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_article",
                selectId: "fstock_countsrch_x_article",
                ajax: { id: "x_article", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.article.filterOptions);
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
            data-select2-id="fstock_countsrch_x_user"
            data-table="stock_count"
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
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_user",
                selectId: "fstock_countsrch_x_user",
                ajax: { id: "x_user", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.user.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
<?php
if (!$Page->divisi->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_divisi" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->divisi->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_divisi"
            name="x_divisi[]"
            class="form-control ew-select<?= $Page->divisi->isInvalidClass() ?>"
            data-select2-id="fstock_countsrch_x_divisi"
            data-table="stock_count"
            data-field="x_divisi"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->divisi->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->divisi->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->divisi->getPlaceHolder()) ?>"
            <?= $Page->divisi->editAttributes() ?>>
            <?= $Page->divisi->selectOptionListHtml("x_divisi", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->divisi->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_divisi",
                selectId: "fstock_countsrch_x_divisi",
                ajax: { id: "x_divisi", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.divisi.filterOptions);
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
            data-select2-id="fstock_countsrch_x_date_created"
            data-table="stock_count"
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
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fstock_countsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.date_created.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
<?php
if (!$Page->time_created->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_time_created" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->time_created->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_time_created"
            name="x_time_created[]"
            class="form-control ew-select<?= $Page->time_created->isInvalidClass() ?>"
            data-select2-id="fstock_countsrch_x_time_created"
            data-table="stock_count"
            data-field="x_time_created"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->time_created->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->time_created->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->time_created->getPlaceHolder()) ?>"
            <?= $Page->time_created->editAttributes() ?>>
            <?= $Page->time_created->selectOptionListHtml("x_time_created", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->time_created->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fstock_countsrch", function() {
            var options = {
                name: "x_time_created",
                selectId: "fstock_countsrch_x_time_created",
                ajax: { id: "x_time_created", form: "fstock_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count.fields.time_created.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fstock_countsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fstock_countsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fstock_countsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fstock_countsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> stock_count">
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
<form name="fstock_countlist" id="fstock_countlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stock_count">
<div id="gmp_stock_count" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_stock_countlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_id" class="stock_count_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_location" class="stock_count_location"><?= $Page->renderFieldHeader($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_article" class="stock_count_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_user" class="stock_count_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <th data-name="divisi" class="<?= $Page->divisi->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_divisi" class="stock_count_divisi"><?= $Page->renderFieldHeader($Page->divisi) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_date_created" class="stock_count_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
        <th data-name="time_created" class="<?= $Page->time_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_time_created" class="stock_count_time_created"><?= $Page->renderFieldHeader($Page->time_created) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_stock_count",
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
<span id="el<?= $Page->RowCount ?>_stock_count_id" class="el_stock_count_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_location" class="el_stock_count_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_article" class="el_stock_count_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_user" class="el_stock_count_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->divisi->Visible) { // divisi ?>
        <td data-name="divisi"<?= $Page->divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_divisi" class="el_stock_count_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_date_created" class="el_stock_count_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_created->Visible) { // time_created ?>
        <td data-name="time_created"<?= $Page->time_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_time_created" class="el_stock_count_time_created">
<span<?= $Page->time_created->viewAttributes() ?>>
<?= $Page->time_created->getViewValue() ?></span>
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
    ew.addEventHandlers("stock_count");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

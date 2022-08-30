<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ArticleDescriptionList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { article_description: currentTable } });
var currentForm, currentPageID;
var farticle_descriptionlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    farticle_descriptionlist = new ew.Form("farticle_descriptionlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = farticle_descriptionlist;
    farticle_descriptionlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    farticle_descriptionlist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    farticle_descriptionlist.lists.description = <?= $Page->description->toClientList($Page) ?>;
    farticle_descriptionlist.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    farticle_descriptionlist.lists.color_desc = <?= $Page->color_desc->toClientList($Page) ?>;
    farticle_descriptionlist.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    farticle_descriptionlist.lists.size_code = <?= $Page->size_code->toClientList($Page) ?>;
    farticle_descriptionlist.lists.season = <?= $Page->season->toClientList($Page) ?>;
    loadjs.done("farticle_descriptionlist");
});
var farticle_descriptionsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    farticle_descriptionsrch = new ew.Form("farticle_descriptionsrch", "list");
    currentSearchForm = farticle_descriptionsrch;

    // Add fields
    var fields = currentTable.fields;
    farticle_descriptionsrch.addFields([
        ["article", [], fields.article.isInvalid],
        ["description", [], fields.description.isInvalid],
        ["color_code", [], fields.color_code.isInvalid],
        ["color_desc", [], fields.color_desc.isInvalid],
        ["size_desc", [], fields.size_desc.isInvalid],
        ["size_code", [], fields.size_code.isInvalid],
        ["season", [], fields.season.isInvalid]
    ]);

    // Validate form
    farticle_descriptionsrch.validate = function () {
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
    farticle_descriptionsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    farticle_descriptionsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    farticle_descriptionsrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    farticle_descriptionsrch.lists.description = <?= $Page->description->toClientList($Page) ?>;
    farticle_descriptionsrch.lists.color_code = <?= $Page->color_code->toClientList($Page) ?>;
    farticle_descriptionsrch.lists.color_desc = <?= $Page->color_desc->toClientList($Page) ?>;
    farticle_descriptionsrch.lists.size_desc = <?= $Page->size_desc->toClientList($Page) ?>;
    farticle_descriptionsrch.lists.size_code = <?= $Page->size_code->toClientList($Page) ?>;
    farticle_descriptionsrch.lists.season = <?= $Page->season->toClientList($Page) ?>;

    // Filters
    farticle_descriptionsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("farticle_descriptionsrch");
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
<form name="farticle_descriptionsrch" id="farticle_descriptionsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="farticle_descriptionsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="article_description">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
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
            data-select2-id="farticle_descriptionsrch_x_article"
            data-table="article_description"
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
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_article",
                selectId: "farticle_descriptionsrch_x_article",
                ajax: { id: "x_article", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.article.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
<?php
if (!$Page->description->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_description" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->description->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_description"
            name="x_description[]"
            class="form-control ew-select<?= $Page->description->isInvalidClass() ?>"
            data-select2-id="farticle_descriptionsrch_x_description"
            data-table="article_description"
            data-field="x_description"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->description->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->description->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"
            <?= $Page->description->editAttributes() ?>>
            <?= $Page->description->selectOptionListHtml("x_description", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->description->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_description",
                selectId: "farticle_descriptionsrch_x_description",
                ajax: { id: "x_description", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.description.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
<?php
if (!$Page->color_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_color_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->color_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_color_code"
            name="x_color_code[]"
            class="form-control ew-select<?= $Page->color_code->isInvalidClass() ?>"
            data-select2-id="farticle_descriptionsrch_x_color_code"
            data-table="article_description"
            data-field="x_color_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->color_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->color_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"
            <?= $Page->color_code->editAttributes() ?>>
            <?= $Page->color_code->selectOptionListHtml("x_color_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->color_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_color_code",
                selectId: "farticle_descriptionsrch_x_color_code",
                ajax: { id: "x_color_code", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.color_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
<?php
if (!$Page->color_desc->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_color_desc" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->color_desc->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_color_desc"
            name="x_color_desc[]"
            class="form-control ew-select<?= $Page->color_desc->isInvalidClass() ?>"
            data-select2-id="farticle_descriptionsrch_x_color_desc"
            data-table="article_description"
            data-field="x_color_desc"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->color_desc->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->color_desc->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->color_desc->getPlaceHolder()) ?>"
            <?= $Page->color_desc->editAttributes() ?>>
            <?= $Page->color_desc->selectOptionListHtml("x_color_desc", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->color_desc->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_color_desc",
                selectId: "farticle_descriptionsrch_x_color_desc",
                ajax: { id: "x_color_desc", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.color_desc.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
<?php
if (!$Page->size_desc->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_size_desc" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->size_desc->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_size_desc"
            name="x_size_desc[]"
            class="form-control ew-select<?= $Page->size_desc->isInvalidClass() ?>"
            data-select2-id="farticle_descriptionsrch_x_size_desc"
            data-table="article_description"
            data-field="x_size_desc"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->size_desc->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->size_desc->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->size_desc->getPlaceHolder()) ?>"
            <?= $Page->size_desc->editAttributes() ?>>
            <?= $Page->size_desc->selectOptionListHtml("x_size_desc", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->size_desc->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_size_desc",
                selectId: "farticle_descriptionsrch_x_size_desc",
                ajax: { id: "x_size_desc", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.size_desc.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
<?php
if (!$Page->size_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_size_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->size_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_size_code"
            name="x_size_code[]"
            class="form-control ew-select<?= $Page->size_code->isInvalidClass() ?>"
            data-select2-id="farticle_descriptionsrch_x_size_code"
            data-table="article_description"
            data-field="x_size_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->size_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->size_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->size_code->getPlaceHolder()) ?>"
            <?= $Page->size_code->editAttributes() ?>>
            <?= $Page->size_code->selectOptionListHtml("x_size_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->size_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_size_code",
                selectId: "farticle_descriptionsrch_x_size_code",
                ajax: { id: "x_size_code", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.size_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
<?php
if (!$Page->season->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_season" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->season->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_season"
            name="x_season[]"
            class="form-control ew-select<?= $Page->season->isInvalidClass() ?>"
            data-select2-id="farticle_descriptionsrch_x_season"
            data-table="article_description"
            data-field="x_season"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->season->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->season->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->season->getPlaceHolder()) ?>"
            <?= $Page->season->editAttributes() ?>>
            <?= $Page->season->selectOptionListHtml("x_season", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->season->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("farticle_descriptionsrch", function() {
            var options = {
                name: "x_season",
                selectId: "farticle_descriptionsrch_x_season",
                ajax: { id: "x_season", form: "farticle_descriptionsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.article_description.fields.season.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="farticle_descriptionsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="farticle_descriptionsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="farticle_descriptionsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="farticle_descriptionsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> article_description">
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
<form name="farticle_descriptionlist" id="farticle_descriptionlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="article_description">
<div id="gmp_article_description" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_article_descriptionlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_article" class="article_description_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Page->description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_description" class="article_description_description"><?= $Page->renderFieldHeader($Page->description) ?></div></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th data-name="color_code" class="<?= $Page->color_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_color_code" class="article_description_color_code"><?= $Page->renderFieldHeader($Page->color_code) ?></div></th>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
        <th data-name="color_desc" class="<?= $Page->color_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_color_desc" class="article_description_color_desc"><?= $Page->renderFieldHeader($Page->color_desc) ?></div></th>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
        <th data-name="size_desc" class="<?= $Page->size_desc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_size_desc" class="article_description_size_desc"><?= $Page->renderFieldHeader($Page->size_desc) ?></div></th>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
        <th data-name="size_code" class="<?= $Page->size_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_size_code" class="article_description_size_code"><?= $Page->renderFieldHeader($Page->size_code) ?></div></th>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
        <th data-name="season" class="<?= $Page->season->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_article_description_season" class="article_description_season"><?= $Page->renderFieldHeader($Page->season) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_article_description",
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
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_article" class="el_article_description_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_description" class="el_article_description_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_code->Visible) { // color_code ?>
        <td data-name="color_code"<?= $Page->color_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_color_code" class="el_article_description_color_code">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->color_desc->Visible) { // color_desc ?>
        <td data-name="color_desc"<?= $Page->color_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_color_desc" class="el_article_description_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<?= $Page->color_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_desc->Visible) { // size_desc ?>
        <td data-name="size_desc"<?= $Page->size_desc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_size_desc" class="el_article_description_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<?= $Page->size_desc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->size_code->Visible) { // size_code ?>
        <td data-name="size_code"<?= $Page->size_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_size_code" class="el_article_description_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<?= $Page->size_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->season->Visible) { // season ?>
        <td data-name="season"<?= $Page->season->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_description_season" class="el_article_description_season">
<span<?= $Page->season->viewAttributes() ?>>
<?= $Page->season->getViewValue() ?></span>
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
    ew.addEventHandlers("article_description");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

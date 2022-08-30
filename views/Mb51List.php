<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$Mb51List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { mb51: currentTable } });
var currentForm, currentPageID;
var fmb51list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmb51list = new ew.Form("fmb51list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmb51list;
    fmb51list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fmb51list.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fmb51list.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fmb51list.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fmb51list.lists.reference = <?= $Page->reference->toClientList($Page) ?>;
    fmb51list.lists.rcvsite = <?= $Page->rcvsite->toClientList($Page) ?>;
    fmb51list.lists.do_type = <?= $Page->do_type->toClientList($Page) ?>;
    fmb51list.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    loadjs.done("fmb51list");
});
var fmb51srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmb51srch = new ew.Form("fmb51srch", "list");
    currentSearchForm = fmb51srch;

    // Add fields
    var fields = currentTable.fields;
    fmb51srch.addFields([
        ["id", [], fields.id.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["quantity", [], fields.quantity.isInvalid],
        ["reference", [], fields.reference.isInvalid],
        ["rcvsite", [], fields.rcvsite.isInvalid],
        ["do_type", [], fields.do_type.isInvalid],
        ["concept", [], fields.concept.isInvalid]
    ]);

    // Validate form
    fmb51srch.validate = function () {
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
    fmb51srch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmb51srch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmb51srch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fmb51srch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    fmb51srch.lists.quantity = <?= $Page->quantity->toClientList($Page) ?>;
    fmb51srch.lists.reference = <?= $Page->reference->toClientList($Page) ?>;
    fmb51srch.lists.rcvsite = <?= $Page->rcvsite->toClientList($Page) ?>;
    fmb51srch.lists.do_type = <?= $Page->do_type->toClientList($Page) ?>;
    fmb51srch.lists.concept = <?= $Page->concept->toClientList($Page) ?>;

    // Filters
    fmb51srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmb51srch");
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
<form name="fmb51srch" id="fmb51srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmb51srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mb51">
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
            data-select2-id="fmb51srch_x_id"
            data-table="mb51"
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
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_id",
                selectId: "fmb51srch_x_id",
                ajax: { id: "x_id", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.id.filterOptions);
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
            data-select2-id="fmb51srch_x_article"
            data-table="mb51"
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
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_article",
                selectId: "fmb51srch_x_article",
                ajax: { id: "x_article", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.article.filterOptions);
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
            data-select2-id="fmb51srch_x_quantity"
            data-table="mb51"
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
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_quantity",
                selectId: "fmb51srch_x_quantity",
                ajax: { id: "x_quantity", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.quantity.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
<?php
if (!$Page->reference->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_reference" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->reference->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_reference"
            name="x_reference[]"
            class="form-control ew-select<?= $Page->reference->isInvalidClass() ?>"
            data-select2-id="fmb51srch_x_reference"
            data-table="mb51"
            data-field="x_reference"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->reference->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->reference->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->reference->getPlaceHolder()) ?>"
            <?= $Page->reference->editAttributes() ?>>
            <?= $Page->reference->selectOptionListHtml("x_reference", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->reference->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_reference",
                selectId: "fmb51srch_x_reference",
                ajax: { id: "x_reference", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.reference.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->rcvsite->Visible) { // rcvsite ?>
<?php
if (!$Page->rcvsite->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_rcvsite" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->rcvsite->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_rcvsite"
            name="x_rcvsite[]"
            class="form-control ew-select<?= $Page->rcvsite->isInvalidClass() ?>"
            data-select2-id="fmb51srch_x_rcvsite"
            data-table="mb51"
            data-field="x_rcvsite"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->rcvsite->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->rcvsite->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->rcvsite->getPlaceHolder()) ?>"
            <?= $Page->rcvsite->editAttributes() ?>>
            <?= $Page->rcvsite->selectOptionListHtml("x_rcvsite", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->rcvsite->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_rcvsite",
                selectId: "fmb51srch_x_rcvsite",
                ajax: { id: "x_rcvsite", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.rcvsite.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->do_type->Visible) { // do_type ?>
<?php
if (!$Page->do_type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_do_type" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->do_type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_do_type"
            name="x_do_type[]"
            class="form-control ew-select<?= $Page->do_type->isInvalidClass() ?>"
            data-select2-id="fmb51srch_x_do_type"
            data-table="mb51"
            data-field="x_do_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->do_type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->do_type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->do_type->getPlaceHolder()) ?>"
            <?= $Page->do_type->editAttributes() ?>>
            <?= $Page->do_type->selectOptionListHtml("x_do_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->do_type->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_do_type",
                selectId: "fmb51srch_x_do_type",
                ajax: { id: "x_do_type", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.do_type.filterOptions);
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
            data-select2-id="fmb51srch_x_concept"
            data-table="mb51"
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
        loadjs.ready("fmb51srch", function() {
            var options = {
                name: "x_concept",
                selectId: "fmb51srch_x_concept",
                ajax: { id: "x_concept", form: "fmb51srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.mb51.fields.concept.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmb51srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmb51srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmb51srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmb51srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mb51">
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
<form name="fmb51list" id="fmb51list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mb51">
<div id="gmp_mb51" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_mb51list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_id" class="mb51_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_article" class="mb51_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_quantity" class="mb51_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <th data-name="reference" class="<?= $Page->reference->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_reference" class="mb51_reference"><?= $Page->renderFieldHeader($Page->reference) ?></div></th>
<?php } ?>
<?php if ($Page->rcvsite->Visible) { // rcvsite ?>
        <th data-name="rcvsite" class="<?= $Page->rcvsite->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_rcvsite" class="mb51_rcvsite"><?= $Page->renderFieldHeader($Page->rcvsite) ?></div></th>
<?php } ?>
<?php if ($Page->do_type->Visible) { // do_type ?>
        <th data-name="do_type" class="<?= $Page->do_type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_do_type" class="mb51_do_type"><?= $Page->renderFieldHeader($Page->do_type) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mb51_concept" class="mb51_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_mb51",
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
<span id="el<?= $Page->RowCount ?>_mb51_id" class="el_mb51_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_article" class="el_mb51_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_quantity" class="el_mb51_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->reference->Visible) { // reference ?>
        <td data-name="reference"<?= $Page->reference->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_reference" class="el_mb51_reference">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rcvsite->Visible) { // rcvsite ?>
        <td data-name="rcvsite"<?= $Page->rcvsite->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_rcvsite" class="el_mb51_rcvsite">
<span<?= $Page->rcvsite->viewAttributes() ?>>
<?= $Page->rcvsite->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->do_type->Visible) { // do_type ?>
        <td data-name="do_type"<?= $Page->do_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_do_type" class="el_mb51_do_type">
<span<?= $Page->do_type->viewAttributes() ?>>
<?= $Page->do_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mb51_concept" class="el_mb51_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
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
    ew.addEventHandlers("mb51");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

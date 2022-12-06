<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$SummaryBoxOnlineList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { summary_box_online: currentTable } });
var currentForm, currentPageID;
var fsummary_box_onlinelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsummary_box_onlinelist = new ew.Form("fsummary_box_onlinelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fsummary_box_onlinelist;
    fsummary_box_onlinelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fsummary_box_onlinelist.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fsummary_box_onlinelist.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fsummary_box_onlinelist.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fsummary_box_onlinelist.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fsummary_box_onlinelist.lists.scan_qty = <?= $Page->scan_qty->toClientList($Page) ?>;
    loadjs.done("fsummary_box_onlinelist");
});
var fsummary_box_onlinesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fsummary_box_onlinesrch = new ew.Form("fsummary_box_onlinesrch", "list");
    currentSearchForm = fsummary_box_onlinesrch;

    // Add fields
    var fields = currentTable.fields;
    fsummary_box_onlinesrch.addFields([
        ["box_code", [], fields.box_code.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["picked_qty", [], fields.picked_qty.isInvalid],
        ["scan_qty", [], fields.scan_qty.isInvalid],
        ["result", [], fields.result.isInvalid]
    ]);

    // Validate form
    fsummary_box_onlinesrch.validate = function () {
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
    fsummary_box_onlinesrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsummary_box_onlinesrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fsummary_box_onlinesrch.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fsummary_box_onlinesrch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fsummary_box_onlinesrch.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    fsummary_box_onlinesrch.lists.picked_qty = <?= $Page->picked_qty->toClientList($Page) ?>;
    fsummary_box_onlinesrch.lists.scan_qty = <?= $Page->scan_qty->toClientList($Page) ?>;

    // Filters
    fsummary_box_onlinesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fsummary_box_onlinesrch");
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
<form name="fsummary_box_onlinesrch" id="fsummary_box_onlinesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fsummary_box_onlinesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="summary_box_online">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->box_code->Visible) { // box_code ?>
<?php
if (!$Page->box_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_box_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->box_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_box_code"
            name="x_box_code[]"
            class="form-control ew-select<?= $Page->box_code->isInvalidClass() ?>"
            data-select2-id="fsummary_box_onlinesrch_x_box_code"
            data-table="summary_box_online"
            data-field="x_box_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->box_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->box_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"
            <?= $Page->box_code->editAttributes() ?>>
            <?= $Page->box_code->selectOptionListHtml("x_box_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->box_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fsummary_box_onlinesrch", function() {
            var options = {
                name: "x_box_code",
                selectId: "fsummary_box_onlinesrch_x_box_code",
                ajax: { id: "x_box_code", form: "fsummary_box_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.summary_box_online.fields.box_code.filterOptions);
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
            data-select2-id="fsummary_box_onlinesrch_x_store_id"
            data-table="summary_box_online"
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
        loadjs.ready("fsummary_box_onlinesrch", function() {
            var options = {
                name: "x_store_id",
                selectId: "fsummary_box_onlinesrch_x_store_id",
                ajax: { id: "x_store_id", form: "fsummary_box_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.summary_box_online.fields.store_id.filterOptions);
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
            data-select2-id="fsummary_box_onlinesrch_x_store_name"
            data-table="summary_box_online"
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
        loadjs.ready("fsummary_box_onlinesrch", function() {
            var options = {
                name: "x_store_name",
                selectId: "fsummary_box_onlinesrch_x_store_name",
                ajax: { id: "x_store_name", form: "fsummary_box_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.summary_box_online.fields.store_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
<?php
if (!$Page->picked_qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picked_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picked_qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picked_qty"
            name="x_picked_qty[]"
            class="form-control ew-select<?= $Page->picked_qty->isInvalidClass() ?>"
            data-select2-id="fsummary_box_onlinesrch_x_picked_qty"
            data-table="summary_box_online"
            data-field="x_picked_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picked_qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picked_qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"
            <?= $Page->picked_qty->editAttributes() ?>>
            <?= $Page->picked_qty->selectOptionListHtml("x_picked_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fsummary_box_onlinesrch", function() {
            var options = {
                name: "x_picked_qty",
                selectId: "fsummary_box_onlinesrch_x_picked_qty",
                ajax: { id: "x_picked_qty", form: "fsummary_box_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.summary_box_online.fields.picked_qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
<?php
if (!$Page->scan_qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_scan_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->scan_qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_scan_qty"
            name="x_scan_qty[]"
            class="form-control ew-select<?= $Page->scan_qty->isInvalidClass() ?>"
            data-select2-id="fsummary_box_onlinesrch_x_scan_qty"
            data-table="summary_box_online"
            data-field="x_scan_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->scan_qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->scan_qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->scan_qty->getPlaceHolder()) ?>"
            <?= $Page->scan_qty->editAttributes() ?>>
            <?= $Page->scan_qty->selectOptionListHtml("x_scan_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->scan_qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fsummary_box_onlinesrch", function() {
            var options = {
                name: "x_scan_qty",
                selectId: "fsummary_box_onlinesrch_x_scan_qty",
                ajax: { id: "x_scan_qty", form: "fsummary_box_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.summary_box_online.fields.scan_qty.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fsummary_box_onlinesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fsummary_box_onlinesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fsummary_box_onlinesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fsummary_box_onlinesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> summary_box_online">
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
<form name="fsummary_box_onlinelist" id="fsummary_box_onlinelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="summary_box_online">
<div id="gmp_summary_box_online" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_summary_box_onlinelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th data-name="box_code" class="<?= $Page->box_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_summary_box_online_box_code" class="summary_box_online_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_summary_box_online_store_id" class="summary_box_online_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_summary_box_online_store_name" class="summary_box_online_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <th data-name="picked_qty" class="<?= $Page->picked_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_summary_box_online_picked_qty" class="summary_box_online_picked_qty"><?= $Page->renderFieldHeader($Page->picked_qty) ?></div></th>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
        <th data-name="scan_qty" class="<?= $Page->scan_qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_summary_box_online_scan_qty" class="summary_box_online_scan_qty"><?= $Page->renderFieldHeader($Page->scan_qty) ?></div></th>
<?php } ?>
<?php if ($Page->result->Visible) { // result ?>
        <th data-name="result" class="<?= $Page->result->headerCellClass() ?>"><div id="elh_summary_box_online_result" class="summary_box_online_result"><?= $Page->renderFieldHeader($Page->result) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_summary_box_online",
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
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_summary_box_online_box_code" class="el_summary_box_online_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_summary_box_online_store_id" class="el_summary_box_online_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_summary_box_online_store_name" class="el_summary_box_online_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked_qty->Visible) { // picked_qty ?>
        <td data-name="picked_qty"<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_summary_box_online_picked_qty" class="el_summary_box_online_picked_qty">
<span<?= $Page->picked_qty->viewAttributes() ?>>
<?= $Page->picked_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->scan_qty->Visible) { // scan_qty ?>
        <td data-name="scan_qty"<?= $Page->scan_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_summary_box_online_scan_qty" class="el_summary_box_online_scan_qty">
<span<?= $Page->scan_qty->viewAttributes() ?>>
<?= $Page->scan_qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->result->Visible) { // result ?>
        <td data-name="result"<?= $Page->result->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_summary_box_online_result" class="el_summary_box_online_result">
<span<?= $Page->result->viewAttributes() ?>>
<?= $Page->result->getViewValue() ?></span>
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
    ew.addEventHandlers("summary_box_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ProductivityOnlineList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { productivity_online: currentTable } });
var currentForm, currentPageID;
var fproductivity_onlinelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproductivity_onlinelist = new ew.Form("fproductivity_onlinelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fproductivity_onlinelist;
    fproductivity_onlinelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fproductivity_onlinelist.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fproductivity_onlinelist.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    fproductivity_onlinelist.lists.total_bin = <?= $Page->total_bin->toClientList($Page) ?>;
    fproductivity_onlinelist.lists.total = <?= $Page->total->toClientList($Page) ?>;
    fproductivity_onlinelist.lists.picked = <?= $Page->picked->toClientList($Page) ?>;
    fproductivity_onlinelist.lists.variance = <?= $Page->variance->toClientList($Page) ?>;
    loadjs.done("fproductivity_onlinelist");
});
var fproductivity_onlinesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fproductivity_onlinesrch = new ew.Form("fproductivity_onlinesrch", "list");
    currentSearchForm = fproductivity_onlinesrch;

    // Add fields
    var fields = currentTable.fields;
    fproductivity_onlinesrch.addFields([
        ["picking_date", [], fields.picking_date.isInvalid],
        ["y_picking_date", [ew.Validators.between], false],
        ["picker", [], fields.picker.isInvalid],
        ["total_bin", [], fields.total_bin.isInvalid],
        ["total", [], fields.total.isInvalid],
        ["picked", [], fields.picked.isInvalid],
        ["variance", [], fields.variance.isInvalid]
    ]);

    // Validate form
    fproductivity_onlinesrch.validate = function () {
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
    fproductivity_onlinesrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproductivity_onlinesrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fproductivity_onlinesrch.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fproductivity_onlinesrch.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    fproductivity_onlinesrch.lists.total_bin = <?= $Page->total_bin->toClientList($Page) ?>;
    fproductivity_onlinesrch.lists.total = <?= $Page->total->toClientList($Page) ?>;
    fproductivity_onlinesrch.lists.picked = <?= $Page->picked->toClientList($Page) ?>;
    fproductivity_onlinesrch.lists.variance = <?= $Page->variance->toClientList($Page) ?>;

    // Filters
    fproductivity_onlinesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fproductivity_onlinesrch");
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
<form name="fproductivity_onlinesrch" id="fproductivity_onlinesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fproductivity_onlinesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="productivity_online">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
<?php
if (!$Page->picking_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picking_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picking_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picking_date"
            name="x_picking_date[]"
            class="form-control ew-select<?= $Page->picking_date->isInvalidClass() ?>"
            data-select2-id="fproductivity_onlinesrch_x_picking_date"
            data-table="productivity_online"
            data-field="x_picking_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picking_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picking_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picking_date->getPlaceHolder()) ?>"
            <?= $Page->picking_date->editAttributes() ?>>
            <?= $Page->picking_date->selectOptionListHtml("x_picking_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picking_date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fproductivity_onlinesrch", function() {
            var options = {
                name: "x_picking_date",
                selectId: "fproductivity_onlinesrch_x_picking_date",
                ajax: { id: "x_picking_date", form: "fproductivity_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.productivity_online.fields.picking_date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
<?php
if (!$Page->picker->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picker" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picker->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picker"
            name="x_picker[]"
            class="form-control ew-select<?= $Page->picker->isInvalidClass() ?>"
            data-select2-id="fproductivity_onlinesrch_x_picker"
            data-table="productivity_online"
            data-field="x_picker"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picker->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picker->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"
            <?= $Page->picker->editAttributes() ?>>
            <?= $Page->picker->selectOptionListHtml("x_picker", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picker->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fproductivity_onlinesrch", function() {
            var options = {
                name: "x_picker",
                selectId: "fproductivity_onlinesrch_x_picker",
                ajax: { id: "x_picker", form: "fproductivity_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.productivity_online.fields.picker.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->total_bin->Visible) { // total_bin ?>
<?php
if (!$Page->total_bin->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_total_bin" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->total_bin->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_total_bin"
            name="x_total_bin[]"
            class="form-control ew-select<?= $Page->total_bin->isInvalidClass() ?>"
            data-select2-id="fproductivity_onlinesrch_x_total_bin"
            data-table="productivity_online"
            data-field="x_total_bin"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->total_bin->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->total_bin->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->total_bin->getPlaceHolder()) ?>"
            <?= $Page->total_bin->editAttributes() ?>>
            <?= $Page->total_bin->selectOptionListHtml("x_total_bin", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->total_bin->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fproductivity_onlinesrch", function() {
            var options = {
                name: "x_total_bin",
                selectId: "fproductivity_onlinesrch_x_total_bin",
                ajax: { id: "x_total_bin", form: "fproductivity_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.productivity_online.fields.total_bin.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
<?php
if (!$Page->total->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_total" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->total->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_total"
            name="x_total[]"
            class="form-control ew-select<?= $Page->total->isInvalidClass() ?>"
            data-select2-id="fproductivity_onlinesrch_x_total"
            data-table="productivity_online"
            data-field="x_total"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->total->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->total->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>"
            <?= $Page->total->editAttributes() ?>>
            <?= $Page->total->selectOptionListHtml("x_total", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->total->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fproductivity_onlinesrch", function() {
            var options = {
                name: "x_total",
                selectId: "fproductivity_onlinesrch_x_total",
                ajax: { id: "x_total", form: "fproductivity_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.productivity_online.fields.total.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picked->Visible) { // picked ?>
<?php
if (!$Page->picked->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picked" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picked->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picked"
            name="x_picked[]"
            class="form-control ew-select<?= $Page->picked->isInvalidClass() ?>"
            data-select2-id="fproductivity_onlinesrch_x_picked"
            data-table="productivity_online"
            data-field="x_picked"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picked->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picked->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picked->getPlaceHolder()) ?>"
            <?= $Page->picked->editAttributes() ?>>
            <?= $Page->picked->selectOptionListHtml("x_picked", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picked->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fproductivity_onlinesrch", function() {
            var options = {
                name: "x_picked",
                selectId: "fproductivity_onlinesrch_x_picked",
                ajax: { id: "x_picked", form: "fproductivity_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.productivity_online.fields.picked.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->variance->Visible) { // variance ?>
<?php
if (!$Page->variance->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_variance" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->variance->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_variance"
            name="x_variance[]"
            class="form-control ew-select<?= $Page->variance->isInvalidClass() ?>"
            data-select2-id="fproductivity_onlinesrch_x_variance"
            data-table="productivity_online"
            data-field="x_variance"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->variance->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->variance->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->variance->getPlaceHolder()) ?>"
            <?= $Page->variance->editAttributes() ?>>
            <?= $Page->variance->selectOptionListHtml("x_variance", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->variance->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fproductivity_onlinesrch", function() {
            var options = {
                name: "x_variance",
                selectId: "fproductivity_onlinesrch_x_variance",
                ajax: { id: "x_variance", form: "fproductivity_onlinesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.productivity_online.fields.variance.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fproductivity_onlinesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fproductivity_onlinesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fproductivity_onlinesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fproductivity_onlinesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> productivity_online">
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
<form name="fproductivity_onlinelist" id="fproductivity_onlinelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="productivity_online">
<div id="gmp_productivity_online" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_productivity_onlinelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <th data-name="picking_date" class="<?= $Page->picking_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_productivity_online_picking_date" class="productivity_online_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></div></th>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <th data-name="picker" class="<?= $Page->picker->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_productivity_online_picker" class="productivity_online_picker"><?= $Page->renderFieldHeader($Page->picker) ?></div></th>
<?php } ?>
<?php if ($Page->total_bin->Visible) { // total_bin ?>
        <th data-name="total_bin" class="<?= $Page->total_bin->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_productivity_online_total_bin" class="productivity_online_total_bin"><?= $Page->renderFieldHeader($Page->total_bin) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_productivity_online_total" class="productivity_online_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
<?php } ?>
<?php if ($Page->picked->Visible) { // picked ?>
        <th data-name="picked" class="<?= $Page->picked->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_productivity_online_picked" class="productivity_online_picked"><?= $Page->renderFieldHeader($Page->picked) ?></div></th>
<?php } ?>
<?php if ($Page->variance->Visible) { // variance ?>
        <th data-name="variance" class="<?= $Page->variance->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_productivity_online_variance" class="productivity_online_variance"><?= $Page->renderFieldHeader($Page->variance) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_productivity_online",
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
    <?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td data-name="picking_date"<?= $Page->picking_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_productivity_online_picking_date" class="el_productivity_online_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker"<?= $Page->picker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_productivity_online_picker" class="el_productivity_online_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_bin->Visible) { // total_bin ?>
        <td data-name="total_bin"<?= $Page->total_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_productivity_online_total_bin" class="el_productivity_online_total_bin">
<span<?= $Page->total_bin->viewAttributes() ?>>
<?= $Page->total_bin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_productivity_online_total" class="el_productivity_online_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picked->Visible) { // picked ?>
        <td data-name="picked"<?= $Page->picked->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_productivity_online_picked" class="el_productivity_online_picked">
<span<?= $Page->picked->viewAttributes() ?>>
<?= $Page->picked->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variance->Visible) { // variance ?>
        <td data-name="variance"<?= $Page->variance->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_productivity_online_variance" class="el_productivity_online_variance">
<span<?= $Page->variance->viewAttributes() ?>>
<?= $Page->variance->getViewValue() ?></span>
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
<?php
// Render aggregate row
$Page->RowType = ROWTYPE_AGGREGATE;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->TotalRecords > 0 && !$Page->isGridAdd() && !$Page->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (footer, left)
$Page->ListOptions->render("footer", "left");
?>
    <?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td data-name="picking_date" class="<?= $Page->picking_date->footerCellClass() ?>"><span id="elf_productivity_online_picking_date" class="productivity_online_picking_date">
        </span></td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker" class="<?= $Page->picker->footerCellClass() ?>"><span id="elf_productivity_online_picker" class="productivity_online_picker">
        <span class="ew-aggregate"><?= $Language->phrase("COUNT") ?></span><span class="ew-aggregate-value">
        <?= $Page->picker->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->total_bin->Visible) { // total_bin ?>
        <td data-name="total_bin" class="<?= $Page->total_bin->footerCellClass() ?>"><span id="elf_productivity_online_total_bin" class="productivity_online_total_bin">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->total_bin->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total" class="<?= $Page->total->footerCellClass() ?>"><span id="elf_productivity_online_total" class="productivity_online_total">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->total->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->picked->Visible) { // picked ?>
        <td data-name="picked" class="<?= $Page->picked->footerCellClass() ?>"><span id="elf_productivity_online_picked" class="productivity_online_picked">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->picked->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->variance->Visible) { // variance ?>
        <td data-name="variance" class="<?= $Page->variance->footerCellClass() ?>"><span id="elf_productivity_online_variance" class="productivity_online_variance">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->variance->ViewValue ?></span>
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Page->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
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
    ew.addEventHandlers("productivity_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StockCountMonitorList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock_count_monitor: currentTable } });
var currentForm, currentPageID;
var fstock_count_monitorlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstock_count_monitorlist = new ew.Form("fstock_count_monitorlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fstock_count_monitorlist;
    fstock_count_monitorlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fstock_count_monitorlist.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fstock_count_monitorlist.lists.counted_location = <?= $Page->counted_location->toClientList($Page) ?>;
    fstock_count_monitorlist.lists.counted_pcs = <?= $Page->counted_pcs->toClientList($Page) ?>;
    loadjs.done("fstock_count_monitorlist");
});
var fstock_count_monitorsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fstock_count_monitorsrch = new ew.Form("fstock_count_monitorsrch", "list");
    currentSearchForm = fstock_count_monitorsrch;

    // Add fields
    var fields = currentTable.fields;
    fstock_count_monitorsrch.addFields([
        ["aisle", [], fields.aisle.isInvalid],
        ["counted_location", [], fields.counted_location.isInvalid],
        ["counted_pcs", [], fields.counted_pcs.isInvalid],
        ["progress", [], fields.progress.isInvalid]
    ]);

    // Validate form
    fstock_count_monitorsrch.validate = function () {
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
    fstock_count_monitorsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstock_count_monitorsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fstock_count_monitorsrch.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fstock_count_monitorsrch.lists.counted_location = <?= $Page->counted_location->toClientList($Page) ?>;
    fstock_count_monitorsrch.lists.counted_pcs = <?= $Page->counted_pcs->toClientList($Page) ?>;

    // Filters
    fstock_count_monitorsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fstock_count_monitorsrch");
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
<form name="fstock_count_monitorsrch" id="fstock_count_monitorsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fstock_count_monitorsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="stock_count_monitor">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
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
            data-select2-id="fstock_count_monitorsrch_x_aisle"
            data-table="stock_count_monitor"
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
        loadjs.ready("fstock_count_monitorsrch", function() {
            var options = {
                name: "x_aisle",
                selectId: "fstock_count_monitorsrch_x_aisle",
                ajax: { id: "x_aisle", form: "fstock_count_monitorsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count_monitor.fields.aisle.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->counted_location->Visible) { // counted_location ?>
<?php
if (!$Page->counted_location->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_counted_location" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->counted_location->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_counted_location"
            name="x_counted_location[]"
            class="form-control ew-select<?= $Page->counted_location->isInvalidClass() ?>"
            data-select2-id="fstock_count_monitorsrch_x_counted_location"
            data-table="stock_count_monitor"
            data-field="x_counted_location"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->counted_location->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->counted_location->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->counted_location->getPlaceHolder()) ?>"
            <?= $Page->counted_location->editAttributes() ?>>
            <?= $Page->counted_location->selectOptionListHtml("x_counted_location", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->counted_location->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fstock_count_monitorsrch", function() {
            var options = {
                name: "x_counted_location",
                selectId: "fstock_count_monitorsrch_x_counted_location",
                ajax: { id: "x_counted_location", form: "fstock_count_monitorsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count_monitor.fields.counted_location.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->counted_pcs->Visible) { // counted_pcs ?>
<?php
if (!$Page->counted_pcs->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_counted_pcs" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->counted_pcs->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_counted_pcs"
            name="x_counted_pcs[]"
            class="form-control ew-select<?= $Page->counted_pcs->isInvalidClass() ?>"
            data-select2-id="fstock_count_monitorsrch_x_counted_pcs"
            data-table="stock_count_monitor"
            data-field="x_counted_pcs"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->counted_pcs->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->counted_pcs->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->counted_pcs->getPlaceHolder()) ?>"
            <?= $Page->counted_pcs->editAttributes() ?>>
            <?= $Page->counted_pcs->selectOptionListHtml("x_counted_pcs", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->counted_pcs->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fstock_count_monitorsrch", function() {
            var options = {
                name: "x_counted_pcs",
                selectId: "fstock_count_monitorsrch_x_counted_pcs",
                ajax: { id: "x_counted_pcs", form: "fstock_count_monitorsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.stock_count_monitor.fields.counted_pcs.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fstock_count_monitorsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fstock_count_monitorsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fstock_count_monitorsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fstock_count_monitorsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> stock_count_monitor">
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
<form name="fstock_count_monitorlist" id="fstock_count_monitorlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stock_count_monitor">
<div id="gmp_stock_count_monitor" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_stock_count_monitorlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->aisle->Visible) { // aisle ?>
        <th data-name="aisle" class="<?= $Page->aisle->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_monitor_aisle" class="stock_count_monitor_aisle"><?= $Page->renderFieldHeader($Page->aisle) ?></div></th>
<?php } ?>
<?php if ($Page->counted_location->Visible) { // counted_location ?>
        <th data-name="counted_location" class="<?= $Page->counted_location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_monitor_counted_location" class="stock_count_monitor_counted_location"><?= $Page->renderFieldHeader($Page->counted_location) ?></div></th>
<?php } ?>
<?php if ($Page->counted_pcs->Visible) { // counted_pcs ?>
        <th data-name="counted_pcs" class="<?= $Page->counted_pcs->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_stock_count_monitor_counted_pcs" class="stock_count_monitor_counted_pcs"><?= $Page->renderFieldHeader($Page->counted_pcs) ?></div></th>
<?php } ?>
<?php if ($Page->progress->Visible) { // progress ?>
        <th data-name="progress" class="<?= $Page->progress->headerCellClass() ?>" style="min-width: 10rem; white-space: nowrap;"><div id="elh_stock_count_monitor_progress" class="stock_count_monitor_progress"><?= $Page->renderFieldHeader($Page->progress) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_stock_count_monitor",
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
    <?php if ($Page->aisle->Visible) { // aisle ?>
        <td data-name="aisle"<?= $Page->aisle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_monitor_aisle" class="el_stock_count_monitor_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->counted_location->Visible) { // counted_location ?>
        <td data-name="counted_location"<?= $Page->counted_location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_monitor_counted_location" class="el_stock_count_monitor_counted_location">
<span<?= $Page->counted_location->viewAttributes() ?>>
<?= $Page->counted_location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->counted_pcs->Visible) { // counted_pcs ?>
        <td data-name="counted_pcs"<?= $Page->counted_pcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_monitor_counted_pcs" class="el_stock_count_monitor_counted_pcs">
<span<?= $Page->counted_pcs->viewAttributes() ?>>
<?= $Page->counted_pcs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->progress->Visible) { // progress ?>
        <td data-name="progress"<?= $Page->progress->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stock_count_monitor_progress" class="el_stock_count_monitor_progress">
<span<?= $Page->progress->viewAttributes() ?>>
<?= $Page->progress->getViewValue() ?></span>
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
    ew.addEventHandlers("stock_count_monitor");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

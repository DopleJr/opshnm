<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ActiveStockList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { active_stock: currentTable } });
var currentForm, currentPageID;
var factive_stocklist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    factive_stocklist = new ew.Form("factive_stocklist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = factive_stocklist;
    factive_stocklist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    factive_stocklist.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    factive_stocklist.lists.active_bin = <?= $Page->active_bin->toClientList($Page) ?>;
    factive_stocklist.lists.total_stock = <?= $Page->total_stock->toClientList($Page) ?>;
    loadjs.done("factive_stocklist");
});
var factive_stocksrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    factive_stocksrch = new ew.Form("factive_stocksrch", "list");
    currentSearchForm = factive_stocksrch;

    // Add fields
    var fields = currentTable.fields;
    factive_stocksrch.addFields([
        ["aisle", [], fields.aisle.isInvalid],
        ["active_bin", [], fields.active_bin.isInvalid],
        ["total_stock", [], fields.total_stock.isInvalid]
    ]);

    // Validate form
    factive_stocksrch.validate = function () {
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
    factive_stocksrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    factive_stocksrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    factive_stocksrch.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    factive_stocksrch.lists.active_bin = <?= $Page->active_bin->toClientList($Page) ?>;
    factive_stocksrch.lists.total_stock = <?= $Page->total_stock->toClientList($Page) ?>;

    // Filters
    factive_stocksrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("factive_stocksrch");
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
<form name="factive_stocksrch" id="factive_stocksrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="factive_stocksrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="active_stock">
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
            data-select2-id="factive_stocksrch_x_aisle"
            data-table="active_stock"
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
        loadjs.ready("factive_stocksrch", function() {
            var options = {
                name: "x_aisle",
                selectId: "factive_stocksrch_x_aisle",
                ajax: { id: "x_aisle", form: "factive_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.active_stock.fields.aisle.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->active_bin->Visible) { // active_bin ?>
<?php
if (!$Page->active_bin->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_active_bin" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->active_bin->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_active_bin"
            name="x_active_bin[]"
            class="form-control ew-select<?= $Page->active_bin->isInvalidClass() ?>"
            data-select2-id="factive_stocksrch_x_active_bin"
            data-table="active_stock"
            data-field="x_active_bin"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->active_bin->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->active_bin->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->active_bin->getPlaceHolder()) ?>"
            <?= $Page->active_bin->editAttributes() ?>>
            <?= $Page->active_bin->selectOptionListHtml("x_active_bin", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->active_bin->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("factive_stocksrch", function() {
            var options = {
                name: "x_active_bin",
                selectId: "factive_stocksrch_x_active_bin",
                ajax: { id: "x_active_bin", form: "factive_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.active_stock.fields.active_bin.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->total_stock->Visible) { // total_stock ?>
<?php
if (!$Page->total_stock->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_total_stock" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->total_stock->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_total_stock"
            name="x_total_stock[]"
            class="form-control ew-select<?= $Page->total_stock->isInvalidClass() ?>"
            data-select2-id="factive_stocksrch_x_total_stock"
            data-table="active_stock"
            data-field="x_total_stock"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->total_stock->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->total_stock->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->total_stock->getPlaceHolder()) ?>"
            <?= $Page->total_stock->editAttributes() ?>>
            <?= $Page->total_stock->selectOptionListHtml("x_total_stock", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->total_stock->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("factive_stocksrch", function() {
            var options = {
                name: "x_total_stock",
                selectId: "factive_stocksrch_x_total_stock",
                ajax: { id: "x_total_stock", form: "factive_stocksrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.active_stock.fields.total_stock.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="factive_stocksrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="factive_stocksrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="factive_stocksrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="factive_stocksrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> active_stock">
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
<form name="factive_stocklist" id="factive_stocklist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="active_stock">
<div id="gmp_active_stock" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_active_stocklist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="aisle" class="<?= $Page->aisle->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_active_stock_aisle" class="active_stock_aisle"><?= $Page->renderFieldHeader($Page->aisle) ?></div></th>
<?php } ?>
<?php if ($Page->active_bin->Visible) { // active_bin ?>
        <th data-name="active_bin" class="<?= $Page->active_bin->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_active_stock_active_bin" class="active_stock_active_bin"><?= $Page->renderFieldHeader($Page->active_bin) ?></div></th>
<?php } ?>
<?php if ($Page->total_stock->Visible) { // total_stock ?>
        <th data-name="total_stock" class="<?= $Page->total_stock->headerCellClass() ?>"><div id="elh_active_stock_total_stock" class="active_stock_total_stock"><?= $Page->renderFieldHeader($Page->total_stock) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_active_stock",
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
<span id="el<?= $Page->RowCount ?>_active_stock_aisle" class="el_active_stock_aisle">
<span<?= $Page->aisle->viewAttributes() ?>>
<?= $Page->aisle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->active_bin->Visible) { // active_bin ?>
        <td data-name="active_bin"<?= $Page->active_bin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_active_stock_active_bin" class="el_active_stock_active_bin">
<span<?= $Page->active_bin->viewAttributes() ?>>
<?= $Page->active_bin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_stock->Visible) { // total_stock ?>
        <td data-name="total_stock"<?= $Page->total_stock->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_active_stock_total_stock" class="el_active_stock_total_stock">
<span<?= $Page->total_stock->viewAttributes() ?>>
<?= $Page->total_stock->getViewValue() ?></span>
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
    <?php if ($Page->aisle->Visible) { // aisle ?>
        <td data-name="aisle" class="<?= $Page->aisle->footerCellClass() ?>"><span id="elf_active_stock_aisle" class="active_stock_aisle">
        </span></td>
    <?php } ?>
    <?php if ($Page->active_bin->Visible) { // active_bin ?>
        <td data-name="active_bin" class="<?= $Page->active_bin->footerCellClass() ?>"><span id="elf_active_stock_active_bin" class="active_stock_active_bin">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->active_bin->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Page->total_stock->Visible) { // total_stock ?>
        <td data-name="total_stock" class="<?= $Page->total_stock->footerCellClass() ?>"><span id="elf_active_stock_total_stock" class="active_stock_total_stock">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->total_stock->ViewValue ?></span>
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
    ew.addEventHandlers("active_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

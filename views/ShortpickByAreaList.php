<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ShortpickByAreaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { shortpick_by_area: currentTable } });
var currentForm, currentPageID;
var fshortpick_by_arealist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fshortpick_by_arealist = new ew.Form("fshortpick_by_arealist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fshortpick_by_arealist;
    fshortpick_by_arealist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fshortpick_by_arealist.lists.area = <?= $Page->area->toClientList($Page) ?>;
    fshortpick_by_arealist.lists.total_shortpick = <?= $Page->total_shortpick->toClientList($Page) ?>;
    loadjs.done("fshortpick_by_arealist");
});
var fshortpick_by_areasrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fshortpick_by_areasrch = new ew.Form("fshortpick_by_areasrch", "list");
    currentSearchForm = fshortpick_by_areasrch;

    // Add fields
    var fields = currentTable.fields;
    fshortpick_by_areasrch.addFields([
        ["area", [], fields.area.isInvalid],
        ["total_shortpick", [], fields.total_shortpick.isInvalid]
    ]);

    // Validate form
    fshortpick_by_areasrch.validate = function () {
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
    fshortpick_by_areasrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fshortpick_by_areasrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fshortpick_by_areasrch.lists.area = <?= $Page->area->toClientList($Page) ?>;
    fshortpick_by_areasrch.lists.total_shortpick = <?= $Page->total_shortpick->toClientList($Page) ?>;

    // Filters
    fshortpick_by_areasrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fshortpick_by_areasrch");
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
<form name="fshortpick_by_areasrch" id="fshortpick_by_areasrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fshortpick_by_areasrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="shortpick_by_area">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->area->Visible) { // area ?>
<?php
if (!$Page->area->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_area" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->area->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_area"
            name="x_area[]"
            class="form-control ew-select<?= $Page->area->isInvalidClass() ?>"
            data-select2-id="fshortpick_by_areasrch_x_area"
            data-table="shortpick_by_area"
            data-field="x_area"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->area->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->area->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"
            <?= $Page->area->editAttributes() ?>>
            <?= $Page->area->selectOptionListHtml("x_area", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->area->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fshortpick_by_areasrch", function() {
            var options = {
                name: "x_area",
                selectId: "fshortpick_by_areasrch_x_area",
                ajax: { id: "x_area", form: "fshortpick_by_areasrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.shortpick_by_area.fields.area.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->total_shortpick->Visible) { // total_shortpick ?>
<?php
if (!$Page->total_shortpick->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_total_shortpick" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->total_shortpick->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_total_shortpick"
            name="x_total_shortpick[]"
            class="form-control ew-select<?= $Page->total_shortpick->isInvalidClass() ?>"
            data-select2-id="fshortpick_by_areasrch_x_total_shortpick"
            data-table="shortpick_by_area"
            data-field="x_total_shortpick"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->total_shortpick->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->total_shortpick->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->total_shortpick->getPlaceHolder()) ?>"
            <?= $Page->total_shortpick->editAttributes() ?>>
            <?= $Page->total_shortpick->selectOptionListHtml("x_total_shortpick", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->total_shortpick->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fshortpick_by_areasrch", function() {
            var options = {
                name: "x_total_shortpick",
                selectId: "fshortpick_by_areasrch_x_total_shortpick",
                ajax: { id: "x_total_shortpick", form: "fshortpick_by_areasrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.shortpick_by_area.fields.total_shortpick.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fshortpick_by_areasrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fshortpick_by_areasrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fshortpick_by_areasrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fshortpick_by_areasrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> shortpick_by_area">
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
<form name="fshortpick_by_arealist" id="fshortpick_by_arealist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="shortpick_by_area">
<div id="gmp_shortpick_by_area" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_shortpick_by_arealist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->area->Visible) { // area ?>
        <th data-name="area" class="<?= $Page->area->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_shortpick_by_area_area" class="shortpick_by_area_area"><?= $Page->renderFieldHeader($Page->area) ?></div></th>
<?php } ?>
<?php if ($Page->total_shortpick->Visible) { // total_shortpick ?>
        <th data-name="total_shortpick" class="<?= $Page->total_shortpick->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_shortpick_by_area_total_shortpick" class="shortpick_by_area_total_shortpick"><?= $Page->renderFieldHeader($Page->total_shortpick) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_shortpick_by_area",
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
    <?php if ($Page->area->Visible) { // area ?>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_shortpick_by_area_area" class="el_shortpick_by_area_area">
<span<?= $Page->area->viewAttributes() ?>>
<?php if (!EmptyString($Page->area->getViewValue()) && $Page->area->linkAttributes() != "") { ?>
<a<?= $Page->area->linkAttributes() ?>><?= $Page->area->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->area->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_shortpick->Visible) { // total_shortpick ?>
        <td data-name="total_shortpick"<?= $Page->total_shortpick->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_shortpick_by_area_total_shortpick" class="el_shortpick_by_area_total_shortpick">
<span<?= $Page->total_shortpick->viewAttributes() ?>>
<?= $Page->total_shortpick->getViewValue() ?></span>
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
    ew.addEventHandlers("shortpick_by_area");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

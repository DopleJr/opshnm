<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$LocationsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { locations: currentTable } });
var currentForm, currentPageID;
var flocationslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flocationslist = new ew.Form("flocationslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = flocationslist;
    flocationslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    flocationslist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    flocationslist.lists.location = <?= $Page->location->toClientList($Page) ?>;
    flocationslist.lists.area = <?= $Page->area->toClientList($Page) ?>;
    flocationslist.lists.sequence = <?= $Page->sequence->toClientList($Page) ?>;
    flocationslist.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    loadjs.done("flocationslist");
});
var flocationssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    flocationssrch = new ew.Form("flocationssrch", "list");
    currentSearchForm = flocationssrch;

    // Add fields
    var fields = currentTable.fields;
    flocationssrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["location", [], fields.location.isInvalid],
        ["area", [], fields.area.isInvalid],
        ["sequence", [], fields.sequence.isInvalid],
        ["divisi", [], fields.divisi.isInvalid]
    ]);

    // Validate form
    flocationssrch.validate = function () {
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
    flocationssrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    flocationssrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    flocationssrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    flocationssrch.lists.location = <?= $Page->location->toClientList($Page) ?>;
    flocationssrch.lists.area = <?= $Page->area->toClientList($Page) ?>;
    flocationssrch.lists.sequence = <?= $Page->sequence->toClientList($Page) ?>;
    flocationssrch.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;

    // Filters
    flocationssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("flocationssrch");
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
<form name="flocationssrch" id="flocationssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="flocationssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="locations">
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
            data-select2-id="flocationssrch_x_id"
            data-table="locations"
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
        loadjs.ready("flocationssrch", function() {
            var options = {
                name: "x_id",
                selectId: "flocationssrch_x_id",
                ajax: { id: "x_id", form: "flocationssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.locations.fields.id.filterOptions);
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
            data-select2-id="flocationssrch_x_location"
            data-table="locations"
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
        loadjs.ready("flocationssrch", function() {
            var options = {
                name: "x_location",
                selectId: "flocationssrch_x_location",
                ajax: { id: "x_location", form: "flocationssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.locations.fields.location.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
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
            data-select2-id="flocationssrch_x_area"
            data-table="locations"
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
        loadjs.ready("flocationssrch", function() {
            var options = {
                name: "x_area",
                selectId: "flocationssrch_x_area",
                ajax: { id: "x_area", form: "flocationssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.locations.fields.area.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->sequence->Visible) { // sequence ?>
<?php
if (!$Page->sequence->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_sequence" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->sequence->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_sequence"
            name="x_sequence[]"
            class="form-control ew-select<?= $Page->sequence->isInvalidClass() ?>"
            data-select2-id="flocationssrch_x_sequence"
            data-table="locations"
            data-field="x_sequence"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->sequence->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->sequence->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->sequence->getPlaceHolder()) ?>"
            <?= $Page->sequence->editAttributes() ?>>
            <?= $Page->sequence->selectOptionListHtml("x_sequence", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->sequence->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("flocationssrch", function() {
            var options = {
                name: "x_sequence",
                selectId: "flocationssrch_x_sequence",
                ajax: { id: "x_sequence", form: "flocationssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.locations.fields.sequence.filterOptions);
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
            data-select2-id="flocationssrch_x_divisi"
            data-table="locations"
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
        loadjs.ready("flocationssrch", function() {
            var options = {
                name: "x_divisi",
                selectId: "flocationssrch_x_divisi",
                ajax: { id: "x_divisi", form: "flocationssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.locations.fields.divisi.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="flocationssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="flocationssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="flocationssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="flocationssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> locations">
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
<form name="flocationslist" id="flocationslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="locations">
<div id="gmp_locations" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_locationslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_locations_id" class="locations_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_locations_location" class="locations_location"><?= $Page->renderFieldHeader($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
        <th data-name="area" class="<?= $Page->area->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_locations_area" class="locations_area"><?= $Page->renderFieldHeader($Page->area) ?></div></th>
<?php } ?>
<?php if ($Page->sequence->Visible) { // sequence ?>
        <th data-name="sequence" class="<?= $Page->sequence->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_locations_sequence" class="locations_sequence"><?= $Page->renderFieldHeader($Page->sequence) ?></div></th>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <th data-name="divisi" class="<?= $Page->divisi->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_locations_divisi" class="locations_divisi"><?= $Page->renderFieldHeader($Page->divisi) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_locations",
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
<span id="el<?= $Page->RowCount ?>_locations_id" class="el_locations_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_locations_location" class="el_locations_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->area->Visible) { // area ?>
        <td data-name="area"<?= $Page->area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_locations_area" class="el_locations_area">
<span<?= $Page->area->viewAttributes() ?>>
<?= $Page->area->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sequence->Visible) { // sequence ?>
        <td data-name="sequence"<?= $Page->sequence->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_locations_sequence" class="el_locations_sequence">
<span<?= $Page->sequence->viewAttributes() ?>>
<?= $Page->sequence->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->divisi->Visible) { // divisi ?>
        <td data-name="divisi"<?= $Page->divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_locations_divisi" class="el_locations_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
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
    ew.addEventHandlers("locations");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$DispositionLocationList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { disposition_location: currentTable } });
var currentForm, currentPageID;
var fdisposition_locationlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdisposition_locationlist = new ew.Form("fdisposition_locationlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fdisposition_locationlist;
    fdisposition_locationlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fdisposition_locationlist.lists.photo_before = <?= $Page->photo_before->toClientList($Page) ?>;
    fdisposition_locationlist.lists.photo_after = <?= $Page->photo_after->toClientList($Page) ?>;
    fdisposition_locationlist.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    fdisposition_locationlist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fdisposition_locationlist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fdisposition_locationlist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("fdisposition_locationlist");
});
var fdisposition_locationsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fdisposition_locationsrch = new ew.Form("fdisposition_locationsrch", "list");
    currentSearchForm = fdisposition_locationsrch;

    // Add fields
    var fields = currentTable.fields;
    fdisposition_locationsrch.addFields([
        ["photo_before", [], fields.photo_before.isInvalid],
        ["photo_after", [], fields.photo_after.isInvalid],
        ["divisi", [], fields.divisi.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    fdisposition_locationsrch.validate = function () {
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
    fdisposition_locationsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdisposition_locationsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdisposition_locationsrch.lists.photo_before = <?= $Page->photo_before->toClientList($Page) ?>;
    fdisposition_locationsrch.lists.photo_after = <?= $Page->photo_after->toClientList($Page) ?>;
    fdisposition_locationsrch.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    fdisposition_locationsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fdisposition_locationsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fdisposition_locationsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fdisposition_locationsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fdisposition_locationsrch");
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
<form name="fdisposition_locationsrch" id="fdisposition_locationsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fdisposition_locationsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="disposition_location">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->photo_before->Visible) { // photo_before ?>
<?php
if (!$Page->photo_before->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_photo_before" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->photo_before->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_photo_before"
            name="x_photo_before[]"
            class="form-control ew-select<?= $Page->photo_before->isInvalidClass() ?>"
            data-select2-id="fdisposition_locationsrch_x_photo_before"
            data-table="disposition_location"
            data-field="x_photo_before"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->photo_before->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->photo_before->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->photo_before->getPlaceHolder()) ?>"
            <?= $Page->photo_before->editAttributes() ?>>
            <?= $Page->photo_before->selectOptionListHtml("x_photo_before", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->photo_before->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fdisposition_locationsrch", function() {
            var options = {
                name: "x_photo_before",
                selectId: "fdisposition_locationsrch_x_photo_before",
                ajax: { id: "x_photo_before", form: "fdisposition_locationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.disposition_location.fields.photo_before.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->photo_after->Visible) { // photo_after ?>
<?php
if (!$Page->photo_after->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_photo_after" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->photo_after->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_photo_after"
            name="x_photo_after[]"
            class="form-control ew-select<?= $Page->photo_after->isInvalidClass() ?>"
            data-select2-id="fdisposition_locationsrch_x_photo_after"
            data-table="disposition_location"
            data-field="x_photo_after"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->photo_after->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->photo_after->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->photo_after->getPlaceHolder()) ?>"
            <?= $Page->photo_after->editAttributes() ?>>
            <?= $Page->photo_after->selectOptionListHtml("x_photo_after", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->photo_after->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fdisposition_locationsrch", function() {
            var options = {
                name: "x_photo_after",
                selectId: "fdisposition_locationsrch_x_photo_after",
                ajax: { id: "x_photo_after", form: "fdisposition_locationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.disposition_location.fields.photo_after.filterOptions);
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
            data-select2-id="fdisposition_locationsrch_x_divisi"
            data-table="disposition_location"
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
        loadjs.ready("fdisposition_locationsrch", function() {
            var options = {
                name: "x_divisi",
                selectId: "fdisposition_locationsrch_x_divisi",
                ajax: { id: "x_divisi", form: "fdisposition_locationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.disposition_location.fields.divisi.filterOptions);
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
            data-select2-id="fdisposition_locationsrch_x_status"
            data-table="disposition_location"
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
        loadjs.ready("fdisposition_locationsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fdisposition_locationsrch_x_status",
                ajax: { id: "x_status", form: "fdisposition_locationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.disposition_location.fields.status.filterOptions);
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
            data-select2-id="fdisposition_locationsrch_x_date_created"
            data-table="disposition_location"
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
        loadjs.ready("fdisposition_locationsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fdisposition_locationsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fdisposition_locationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.disposition_location.fields.date_created.filterOptions);
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
            data-select2-id="fdisposition_locationsrch_x_date_updated"
            data-table="disposition_location"
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
        loadjs.ready("fdisposition_locationsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fdisposition_locationsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fdisposition_locationsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.disposition_location.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fdisposition_locationsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fdisposition_locationsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fdisposition_locationsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fdisposition_locationsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> disposition_location">
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
<form name="fdisposition_locationlist" id="fdisposition_locationlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="disposition_location">
<div id="gmp_disposition_location" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_disposition_locationlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->photo_before->Visible) { // photo_before ?>
        <th data-name="photo_before" class="<?= $Page->photo_before->headerCellClass() ?>"><div id="elh_disposition_location_photo_before" class="disposition_location_photo_before"><?= $Page->renderFieldHeader($Page->photo_before) ?></div></th>
<?php } ?>
<?php if ($Page->photo_after->Visible) { // photo_after ?>
        <th data-name="photo_after" class="<?= $Page->photo_after->headerCellClass() ?>"><div id="elh_disposition_location_photo_after" class="disposition_location_photo_after"><?= $Page->renderFieldHeader($Page->photo_after) ?></div></th>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <th data-name="divisi" class="<?= $Page->divisi->headerCellClass() ?>"><div id="elh_disposition_location_divisi" class="disposition_location_divisi"><?= $Page->renderFieldHeader($Page->divisi) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_disposition_location_status" class="disposition_location_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_disposition_location_date_created" class="disposition_location_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_disposition_location_date_updated" class="disposition_location_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_disposition_location",
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
    <?php if ($Page->photo_before->Visible) { // photo_before ?>
        <td data-name="photo_before"<?= $Page->photo_before->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_photo_before" class="el_disposition_location_photo_before">
<span>
<?= GetFileViewTag($Page->photo_before, $Page->photo_before->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->photo_after->Visible) { // photo_after ?>
        <td data-name="photo_after"<?= $Page->photo_after->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_photo_after" class="el_disposition_location_photo_after">
<span>
<?= GetFileViewTag($Page->photo_after, $Page->photo_after->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->divisi->Visible) { // divisi ?>
        <td data-name="divisi"<?= $Page->divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_divisi" class="el_disposition_location_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_status" class="el_disposition_location_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_date_created" class="el_disposition_location_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_disposition_location_date_updated" class="el_disposition_location_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
    ew.addEventHandlers("disposition_location");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

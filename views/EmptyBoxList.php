<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$EmptyBoxList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { empty_box: currentTable } });
var currentForm, currentPageID;
var fempty_boxlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fempty_boxlist = new ew.Form("fempty_boxlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fempty_boxlist;
    fempty_boxlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fempty_boxlist.lists.photo_before = <?= $Page->photo_before->toClientList($Page) ?>;
    fempty_boxlist.lists.photo_after = <?= $Page->photo_after->toClientList($Page) ?>;
    fempty_boxlist.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    fempty_boxlist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fempty_boxlist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fempty_boxlist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("fempty_boxlist");
});
var fempty_boxsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fempty_boxsrch = new ew.Form("fempty_boxsrch", "list");
    currentSearchForm = fempty_boxsrch;

    // Add fields
    var fields = currentTable.fields;
    fempty_boxsrch.addFields([
        ["photo_before", [], fields.photo_before.isInvalid],
        ["photo_after", [], fields.photo_after.isInvalid],
        ["divisi", [], fields.divisi.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    fempty_boxsrch.validate = function () {
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
    fempty_boxsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fempty_boxsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fempty_boxsrch.lists.photo_before = <?= $Page->photo_before->toClientList($Page) ?>;
    fempty_boxsrch.lists.photo_after = <?= $Page->photo_after->toClientList($Page) ?>;
    fempty_boxsrch.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    fempty_boxsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fempty_boxsrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fempty_boxsrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fempty_boxsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fempty_boxsrch");
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
<form name="fempty_boxsrch" id="fempty_boxsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fempty_boxsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="empty_box">
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
            data-select2-id="fempty_boxsrch_x_photo_before"
            data-table="empty_box"
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
        loadjs.ready("fempty_boxsrch", function() {
            var options = {
                name: "x_photo_before",
                selectId: "fempty_boxsrch_x_photo_before",
                ajax: { id: "x_photo_before", form: "fempty_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.empty_box.fields.photo_before.filterOptions);
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
            data-select2-id="fempty_boxsrch_x_photo_after"
            data-table="empty_box"
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
        loadjs.ready("fempty_boxsrch", function() {
            var options = {
                name: "x_photo_after",
                selectId: "fempty_boxsrch_x_photo_after",
                ajax: { id: "x_photo_after", form: "fempty_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.empty_box.fields.photo_after.filterOptions);
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
            data-select2-id="fempty_boxsrch_x_divisi"
            data-table="empty_box"
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
        loadjs.ready("fempty_boxsrch", function() {
            var options = {
                name: "x_divisi",
                selectId: "fempty_boxsrch_x_divisi",
                ajax: { id: "x_divisi", form: "fempty_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.empty_box.fields.divisi.filterOptions);
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
            data-select2-id="fempty_boxsrch_x_status"
            data-table="empty_box"
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
        loadjs.ready("fempty_boxsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fempty_boxsrch_x_status",
                ajax: { id: "x_status", form: "fempty_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.empty_box.fields.status.filterOptions);
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
            data-select2-id="fempty_boxsrch_x_date_created"
            data-table="empty_box"
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
        loadjs.ready("fempty_boxsrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fempty_boxsrch_x_date_created",
                ajax: { id: "x_date_created", form: "fempty_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.empty_box.fields.date_created.filterOptions);
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
            data-select2-id="fempty_boxsrch_x_date_updated"
            data-table="empty_box"
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
        loadjs.ready("fempty_boxsrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fempty_boxsrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fempty_boxsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.empty_box.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fempty_boxsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fempty_boxsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fempty_boxsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fempty_boxsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> empty_box">
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
<form name="fempty_boxlist" id="fempty_boxlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="empty_box">
<div id="gmp_empty_box" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_empty_boxlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="photo_before" class="<?= $Page->photo_before->headerCellClass() ?>"><div id="elh_empty_box_photo_before" class="empty_box_photo_before"><?= $Page->renderFieldHeader($Page->photo_before) ?></div></th>
<?php } ?>
<?php if ($Page->photo_after->Visible) { // photo_after ?>
        <th data-name="photo_after" class="<?= $Page->photo_after->headerCellClass() ?>"><div id="elh_empty_box_photo_after" class="empty_box_photo_after"><?= $Page->renderFieldHeader($Page->photo_after) ?></div></th>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
        <th data-name="divisi" class="<?= $Page->divisi->headerCellClass() ?>"><div id="elh_empty_box_divisi" class="empty_box_divisi"><?= $Page->renderFieldHeader($Page->divisi) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_empty_box_status" class="empty_box_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_empty_box_date_created" class="empty_box_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_empty_box_date_updated" class="empty_box_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_empty_box",
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
<span id="el<?= $Page->RowCount ?>_empty_box_photo_before" class="el_empty_box_photo_before">
<span>
<?= GetFileViewTag($Page->photo_before, $Page->photo_before->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->photo_after->Visible) { // photo_after ?>
        <td data-name="photo_after"<?= $Page->photo_after->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_empty_box_photo_after" class="el_empty_box_photo_after">
<span>
<?= GetFileViewTag($Page->photo_after, $Page->photo_after->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->divisi->Visible) { // divisi ?>
        <td data-name="divisi"<?= $Page->divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_empty_box_divisi" class="el_empty_box_divisi">
<span<?= $Page->divisi->viewAttributes() ?>>
<?= $Page->divisi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_empty_box_status" class="el_empty_box_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_empty_box_date_created" class="el_empty_box_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_empty_box_date_updated" class="el_empty_box_date_updated">
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
    ew.addEventHandlers("empty_box");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$InboundExcessList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { inbound_excess: currentTable } });
var currentForm, currentPageID;
var finbound_excesslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    finbound_excesslist = new ew.Form("finbound_excesslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = finbound_excesslist;
    finbound_excesslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    finbound_excesslist.lists.sscc = <?= $Page->sscc->toClientList($Page) ?>;
    finbound_excesslist.lists.pallet_id = <?= $Page->pallet_id->toClientList($Page) ?>;
    finbound_excesslist.lists.users = <?= $Page->users->toClientList($Page) ?>;
    finbound_excesslist.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    finbound_excesslist.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;
    loadjs.done("finbound_excesslist");
});
var finbound_excesssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    finbound_excesssrch = new ew.Form("finbound_excesssrch", "list");
    currentSearchForm = finbound_excesssrch;

    // Add fields
    var fields = currentTable.fields;
    finbound_excesssrch.addFields([
        ["sscc", [], fields.sscc.isInvalid],
        ["pallet_id", [], fields.pallet_id.isInvalid],
        ["users", [], fields.users.isInvalid],
        ["date_update", [], fields.date_update.isInvalid],
        ["time_update", [], fields.time_update.isInvalid]
    ]);

    // Validate form
    finbound_excesssrch.validate = function () {
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
    finbound_excesssrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    finbound_excesssrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    finbound_excesssrch.lists.sscc = <?= $Page->sscc->toClientList($Page) ?>;
    finbound_excesssrch.lists.pallet_id = <?= $Page->pallet_id->toClientList($Page) ?>;
    finbound_excesssrch.lists.users = <?= $Page->users->toClientList($Page) ?>;
    finbound_excesssrch.lists.date_update = <?= $Page->date_update->toClientList($Page) ?>;
    finbound_excesssrch.lists.time_update = <?= $Page->time_update->toClientList($Page) ?>;

    // Filters
    finbound_excesssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("finbound_excesssrch");
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
<form name="finbound_excesssrch" id="finbound_excesssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="finbound_excesssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inbound_excess">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->sscc->Visible) { // sscc ?>
<?php
if (!$Page->sscc->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_sscc" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->sscc->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_sscc"
            name="x_sscc[]"
            class="form-control ew-select<?= $Page->sscc->isInvalidClass() ?>"
            data-select2-id="finbound_excesssrch_x_sscc"
            data-table="inbound_excess"
            data-field="x_sscc"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->sscc->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->sscc->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->sscc->getPlaceHolder()) ?>"
            <?= $Page->sscc->editAttributes() ?>>
            <?= $Page->sscc->selectOptionListHtml("x_sscc", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->sscc->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("finbound_excesssrch", function() {
            var options = {
                name: "x_sscc",
                selectId: "finbound_excesssrch_x_sscc",
                ajax: { id: "x_sscc", form: "finbound_excesssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.inbound_excess.fields.sscc.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->pallet_id->Visible) { // pallet_id ?>
<?php
if (!$Page->pallet_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_pallet_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->pallet_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_pallet_id"
            name="x_pallet_id[]"
            class="form-control ew-select<?= $Page->pallet_id->isInvalidClass() ?>"
            data-select2-id="finbound_excesssrch_x_pallet_id"
            data-table="inbound_excess"
            data-field="x_pallet_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->pallet_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->pallet_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->pallet_id->getPlaceHolder()) ?>"
            <?= $Page->pallet_id->editAttributes() ?>>
            <?= $Page->pallet_id->selectOptionListHtml("x_pallet_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->pallet_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("finbound_excesssrch", function() {
            var options = {
                name: "x_pallet_id",
                selectId: "finbound_excesssrch_x_pallet_id",
                ajax: { id: "x_pallet_id", form: "finbound_excesssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.inbound_excess.fields.pallet_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
<?php
if (!$Page->users->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_users" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->users->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_users"
            name="x_users[]"
            class="form-control ew-select<?= $Page->users->isInvalidClass() ?>"
            data-select2-id="finbound_excesssrch_x_users"
            data-table="inbound_excess"
            data-field="x_users"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->users->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->users->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->users->getPlaceHolder()) ?>"
            <?= $Page->users->editAttributes() ?>>
            <?= $Page->users->selectOptionListHtml("x_users", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->users->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("finbound_excesssrch", function() {
            var options = {
                name: "x_users",
                selectId: "finbound_excesssrch_x_users",
                ajax: { id: "x_users", form: "finbound_excesssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.inbound_excess.fields.users.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
<?php
if (!$Page->date_update->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_update" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_update->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_update"
            name="x_date_update[]"
            class="form-control ew-select<?= $Page->date_update->isInvalidClass() ?>"
            data-select2-id="finbound_excesssrch_x_date_update"
            data-table="inbound_excess"
            data-field="x_date_update"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_update->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_update->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_update->getPlaceHolder()) ?>"
            <?= $Page->date_update->editAttributes() ?>>
            <?= $Page->date_update->selectOptionListHtml("x_date_update", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_update->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("finbound_excesssrch", function() {
            var options = {
                name: "x_date_update",
                selectId: "finbound_excesssrch_x_date_update",
                ajax: { id: "x_date_update", form: "finbound_excesssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.inbound_excess.fields.date_update.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
<?php
if (!$Page->time_update->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_time_update" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->time_update->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_time_update"
            name="x_time_update[]"
            class="form-control ew-select<?= $Page->time_update->isInvalidClass() ?>"
            data-select2-id="finbound_excesssrch_x_time_update"
            data-table="inbound_excess"
            data-field="x_time_update"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->time_update->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->time_update->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->time_update->getPlaceHolder()) ?>"
            <?= $Page->time_update->editAttributes() ?>>
            <?= $Page->time_update->selectOptionListHtml("x_time_update", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->time_update->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("finbound_excesssrch", function() {
            var options = {
                name: "x_time_update",
                selectId: "finbound_excesssrch_x_time_update",
                ajax: { id: "x_time_update", form: "finbound_excesssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.inbound_excess.fields.time_update.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="finbound_excesssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="finbound_excesssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="finbound_excesssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="finbound_excesssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inbound_excess">
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
<form name="finbound_excesslist" id="finbound_excesslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="inbound_excess">
<div id="gmp_inbound_excess" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_inbound_excesslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->sscc->Visible) { // sscc ?>
        <th data-name="sscc" class="<?= $Page->sscc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inbound_excess_sscc" class="inbound_excess_sscc"><?= $Page->renderFieldHeader($Page->sscc) ?></div></th>
<?php } ?>
<?php if ($Page->pallet_id->Visible) { // pallet_id ?>
        <th data-name="pallet_id" class="<?= $Page->pallet_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inbound_excess_pallet_id" class="inbound_excess_pallet_id"><?= $Page->renderFieldHeader($Page->pallet_id) ?></div></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th data-name="users" class="<?= $Page->users->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inbound_excess_users" class="inbound_excess_users"><?= $Page->renderFieldHeader($Page->users) ?></div></th>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
        <th data-name="date_update" class="<?= $Page->date_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inbound_excess_date_update" class="inbound_excess_date_update"><?= $Page->renderFieldHeader($Page->date_update) ?></div></th>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
        <th data-name="time_update" class="<?= $Page->time_update->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inbound_excess_time_update" class="inbound_excess_time_update"><?= $Page->renderFieldHeader($Page->time_update) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_inbound_excess",
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
    <?php if ($Page->sscc->Visible) { // sscc ?>
        <td data-name="sscc"<?= $Page->sscc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_sscc" class="el_inbound_excess_sscc">
<span<?= $Page->sscc->viewAttributes() ?>>
<?= $Page->sscc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pallet_id->Visible) { // pallet_id ?>
        <td data-name="pallet_id"<?= $Page->pallet_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_pallet_id" class="el_inbound_excess_pallet_id">
<span<?= $Page->pallet_id->viewAttributes() ?>>
<?= $Page->pallet_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->users->Visible) { // users ?>
        <td data-name="users"<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_users" class="el_inbound_excess_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_update->Visible) { // date_update ?>
        <td data-name="date_update"<?= $Page->date_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_date_update" class="el_inbound_excess_date_update">
<span<?= $Page->date_update->viewAttributes() ?>>
<?= $Page->date_update->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_update->Visible) { // time_update ?>
        <td data-name="time_update"<?= $Page->time_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_inbound_excess_time_update" class="el_inbound_excess_time_update">
<span<?= $Page->time_update->viewAttributes() ?>>
<?= $Page->time_update->getViewValue() ?></span>
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
    ew.addEventHandlers("inbound_excess");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MonitorCycleCountList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { monitor_cycle_count: currentTable } });
var currentForm, currentPageID;
var fmonitor_cycle_countlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmonitor_cycle_countlist = new ew.Form("fmonitor_cycle_countlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmonitor_cycle_countlist;
    fmonitor_cycle_countlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fmonitor_cycle_countlist.lists.Location = <?= $Page->Location->toClientList($Page) ?>;
    fmonitor_cycle_countlist.lists.ShortArticle = <?= $Page->ShortArticle->toClientList($Page) ?>;
    fmonitor_cycle_countlist.lists.Total = <?= $Page->Total->toClientList($Page) ?>;
    fmonitor_cycle_countlist.lists.User = <?= $Page->User->toClientList($Page) ?>;
    fmonitor_cycle_countlist.lists.DateCreated = <?= $Page->DateCreated->toClientList($Page) ?>;
    loadjs.done("fmonitor_cycle_countlist");
});
var fmonitor_cycle_countsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmonitor_cycle_countsrch = new ew.Form("fmonitor_cycle_countsrch", "list");
    currentSearchForm = fmonitor_cycle_countsrch;

    // Add fields
    var fields = currentTable.fields;
    fmonitor_cycle_countsrch.addFields([
        ["Location", [], fields.Location.isInvalid],
        ["ShortArticle", [], fields.ShortArticle.isInvalid],
        ["Total", [], fields.Total.isInvalid],
        ["User", [], fields.User.isInvalid],
        ["DateCreated", [], fields.DateCreated.isInvalid],
        ["y_DateCreated", [ew.Validators.between], false]
    ]);

    // Validate form
    fmonitor_cycle_countsrch.validate = function () {
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
    fmonitor_cycle_countsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmonitor_cycle_countsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmonitor_cycle_countsrch.lists.Location = <?= $Page->Location->toClientList($Page) ?>;
    fmonitor_cycle_countsrch.lists.ShortArticle = <?= $Page->ShortArticle->toClientList($Page) ?>;
    fmonitor_cycle_countsrch.lists.Total = <?= $Page->Total->toClientList($Page) ?>;
    fmonitor_cycle_countsrch.lists.User = <?= $Page->User->toClientList($Page) ?>;
    fmonitor_cycle_countsrch.lists.DateCreated = <?= $Page->DateCreated->toClientList($Page) ?>;

    // Filters
    fmonitor_cycle_countsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmonitor_cycle_countsrch");
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
<form name="fmonitor_cycle_countsrch" id="fmonitor_cycle_countsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmonitor_cycle_countsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="monitor_cycle_count">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->Location->Visible) { // Location ?>
<?php
if (!$Page->Location->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Location" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Location->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Location"
            name="x_Location[]"
            class="form-control ew-select<?= $Page->Location->isInvalidClass() ?>"
            data-select2-id="fmonitor_cycle_countsrch_x_Location"
            data-table="monitor_cycle_count"
            data-field="x_Location"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Location->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Location->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Location->getPlaceHolder()) ?>"
            <?= $Page->Location->editAttributes() ?>>
            <?= $Page->Location->selectOptionListHtml("x_Location", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Location->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_cycle_countsrch", function() {
            var options = {
                name: "x_Location",
                selectId: "fmonitor_cycle_countsrch_x_Location",
                ajax: { id: "x_Location", form: "fmonitor_cycle_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_cycle_count.fields.Location.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ShortArticle->Visible) { // Short Article ?>
<?php
if (!$Page->ShortArticle->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ShortArticle" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->ShortArticle->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ShortArticle"
            name="x_ShortArticle[]"
            class="form-control ew-select<?= $Page->ShortArticle->isInvalidClass() ?>"
            data-select2-id="fmonitor_cycle_countsrch_x_ShortArticle"
            data-table="monitor_cycle_count"
            data-field="x_ShortArticle"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ShortArticle->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ShortArticle->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ShortArticle->getPlaceHolder()) ?>"
            <?= $Page->ShortArticle->editAttributes() ?>>
            <?= $Page->ShortArticle->selectOptionListHtml("x_ShortArticle", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ShortArticle->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_cycle_countsrch", function() {
            var options = {
                name: "x_ShortArticle",
                selectId: "fmonitor_cycle_countsrch_x_ShortArticle",
                ajax: { id: "x_ShortArticle", form: "fmonitor_cycle_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_cycle_count.fields.ShortArticle.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Total->Visible) { // Total ?>
<?php
if (!$Page->Total->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Total" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Total->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Total"
            name="x_Total[]"
            class="form-control ew-select<?= $Page->Total->isInvalidClass() ?>"
            data-select2-id="fmonitor_cycle_countsrch_x_Total"
            data-table="monitor_cycle_count"
            data-field="x_Total"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Total->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Total->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Total->getPlaceHolder()) ?>"
            <?= $Page->Total->editAttributes() ?>>
            <?= $Page->Total->selectOptionListHtml("x_Total", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Total->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_cycle_countsrch", function() {
            var options = {
                name: "x_Total",
                selectId: "fmonitor_cycle_countsrch_x_Total",
                ajax: { id: "x_Total", form: "fmonitor_cycle_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_cycle_count.fields.Total.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
<?php
if (!$Page->User->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_User" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->User->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_User"
            name="x_User[]"
            class="form-control ew-select<?= $Page->User->isInvalidClass() ?>"
            data-select2-id="fmonitor_cycle_countsrch_x_User"
            data-table="monitor_cycle_count"
            data-field="x_User"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->User->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->User->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->User->getPlaceHolder()) ?>"
            <?= $Page->User->editAttributes() ?>>
            <?= $Page->User->selectOptionListHtml("x_User", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->User->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_cycle_countsrch", function() {
            var options = {
                name: "x_User",
                selectId: "fmonitor_cycle_countsrch_x_User",
                ajax: { id: "x_User", form: "fmonitor_cycle_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_cycle_count.fields.User.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->DateCreated->Visible) { // Date Created ?>
<?php
if (!$Page->DateCreated->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_DateCreated" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->DateCreated->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_DateCreated"
            name="x_DateCreated[]"
            class="form-control ew-select<?= $Page->DateCreated->isInvalidClass() ?>"
            data-select2-id="fmonitor_cycle_countsrch_x_DateCreated"
            data-table="monitor_cycle_count"
            data-field="x_DateCreated"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->DateCreated->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->DateCreated->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->DateCreated->getPlaceHolder()) ?>"
            <?= $Page->DateCreated->editAttributes() ?>>
            <?= $Page->DateCreated->selectOptionListHtml("x_DateCreated", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->DateCreated->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_cycle_countsrch", function() {
            var options = {
                name: "x_DateCreated",
                selectId: "fmonitor_cycle_countsrch_x_DateCreated",
                ajax: { id: "x_DateCreated", form: "fmonitor_cycle_countsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_cycle_count.fields.DateCreated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmonitor_cycle_countsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmonitor_cycle_countsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmonitor_cycle_countsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmonitor_cycle_countsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monitor_cycle_count">
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
<form name="fmonitor_cycle_countlist" id="fmonitor_cycle_countlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="monitor_cycle_count">
<div id="gmp_monitor_cycle_count" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_monitor_cycle_countlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->Location->Visible) { // Location ?>
        <th data-name="Location" class="<?= $Page->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_cycle_count_Location" class="monitor_cycle_count_Location"><?= $Page->renderFieldHeader($Page->Location) ?></div></th>
<?php } ?>
<?php if ($Page->ShortArticle->Visible) { // Short Article ?>
        <th data-name="ShortArticle" class="<?= $Page->ShortArticle->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_cycle_count_ShortArticle" class="monitor_cycle_count_ShortArticle"><?= $Page->renderFieldHeader($Page->ShortArticle) ?></div></th>
<?php } ?>
<?php if ($Page->Total->Visible) { // Total ?>
        <th data-name="Total" class="<?= $Page->Total->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_cycle_count_Total" class="monitor_cycle_count_Total"><?= $Page->renderFieldHeader($Page->Total) ?></div></th>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
        <th data-name="User" class="<?= $Page->User->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_cycle_count_User" class="monitor_cycle_count_User"><?= $Page->renderFieldHeader($Page->User) ?></div></th>
<?php } ?>
<?php if ($Page->DateCreated->Visible) { // Date Created ?>
        <th data-name="DateCreated" class="<?= $Page->DateCreated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_cycle_count_DateCreated" class="monitor_cycle_count_DateCreated"><?= $Page->renderFieldHeader($Page->DateCreated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_monitor_cycle_count",
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
    <?php if ($Page->Location->Visible) { // Location ?>
        <td data-name="Location"<?= $Page->Location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_cycle_count_Location" class="el_monitor_cycle_count_Location">
<span<?= $Page->Location->viewAttributes() ?>>
<?= $Page->Location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ShortArticle->Visible) { // Short Article ?>
        <td data-name="ShortArticle"<?= $Page->ShortArticle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_cycle_count_ShortArticle" class="el_monitor_cycle_count_ShortArticle">
<span<?= $Page->ShortArticle->viewAttributes() ?>>
<?= $Page->ShortArticle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Total->Visible) { // Total ?>
        <td data-name="Total"<?= $Page->Total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_cycle_count_Total" class="el_monitor_cycle_count_Total">
<span<?= $Page->Total->viewAttributes() ?>>
<?= $Page->Total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->User->Visible) { // User ?>
        <td data-name="User"<?= $Page->User->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_cycle_count_User" class="el_monitor_cycle_count_User">
<span<?= $Page->User->viewAttributes() ?>>
<?= $Page->User->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DateCreated->Visible) { // Date Created ?>
        <td data-name="DateCreated"<?= $Page->DateCreated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_cycle_count_DateCreated" class="el_monitor_cycle_count_DateCreated">
<span<?= $Page->DateCreated->viewAttributes() ?>>
<?= $Page->DateCreated->getViewValue() ?></span>
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
    ew.addEventHandlers("monitor_cycle_count");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

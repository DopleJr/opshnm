<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MonitorAuditPickingList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { monitor_audit_picking: currentTable } });
var currentForm, currentPageID;
var fmonitor_audit_pickinglist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmonitor_audit_pickinglist = new ew.Form("fmonitor_audit_pickinglist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmonitor_audit_pickinglist;
    fmonitor_audit_pickinglist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fmonitor_audit_pickinglist.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fmonitor_audit_pickinglist.lists.users = <?= $Page->users->toClientList($Page) ?>;
    fmonitor_audit_pickinglist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fmonitor_audit_pickinglist");
});
var fmonitor_audit_pickingsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmonitor_audit_pickingsrch = new ew.Form("fmonitor_audit_pickingsrch", "list");
    currentSearchForm = fmonitor_audit_pickingsrch;

    // Add fields
    var fields = currentTable.fields;
    fmonitor_audit_pickingsrch.addFields([
        ["picking_date", [], fields.picking_date.isInvalid],
        ["y_picking_date", [ew.Validators.between], false],
        ["users", [], fields.users.isInvalid],
        ["Pending", [], fields.Pending.isInvalid],
        ["Done", [], fields.Done.isInvalid],
        ["total", [], fields.total.isInvalid],
        ["status", [], fields.status.isInvalid]
    ]);

    // Validate form
    fmonitor_audit_pickingsrch.validate = function () {
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
    fmonitor_audit_pickingsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmonitor_audit_pickingsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmonitor_audit_pickingsrch.lists.picking_date = <?= $Page->picking_date->toClientList($Page) ?>;
    fmonitor_audit_pickingsrch.lists.users = <?= $Page->users->toClientList($Page) ?>;
    fmonitor_audit_pickingsrch.lists.status = <?= $Page->status->toClientList($Page) ?>;

    // Filters
    fmonitor_audit_pickingsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmonitor_audit_pickingsrch");
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
<form name="fmonitor_audit_pickingsrch" id="fmonitor_audit_pickingsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmonitor_audit_pickingsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="monitor_audit_picking">
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
            data-select2-id="fmonitor_audit_pickingsrch_x_picking_date"
            data-table="monitor_audit_picking"
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
        loadjs.ready("fmonitor_audit_pickingsrch", function() {
            var options = {
                name: "x_picking_date",
                selectId: "fmonitor_audit_pickingsrch_x_picking_date",
                ajax: { id: "x_picking_date", form: "fmonitor_audit_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_audit_picking.fields.picking_date.filterOptions);
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
            data-select2-id="fmonitor_audit_pickingsrch_x_users"
            data-table="monitor_audit_picking"
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
        loadjs.ready("fmonitor_audit_pickingsrch", function() {
            var options = {
                name: "x_users",
                selectId: "fmonitor_audit_pickingsrch_x_users",
                ajax: { id: "x_users", form: "fmonitor_audit_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_audit_picking.fields.users.filterOptions);
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
            data-select2-id="fmonitor_audit_pickingsrch_x_status"
            data-table="monitor_audit_picking"
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
        loadjs.ready("fmonitor_audit_pickingsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fmonitor_audit_pickingsrch_x_status",
                ajax: { id: "x_status", form: "fmonitor_audit_pickingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_audit_picking.fields.status.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmonitor_audit_pickingsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmonitor_audit_pickingsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmonitor_audit_pickingsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmonitor_audit_pickingsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monitor_audit_picking">
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
<form name="fmonitor_audit_pickinglist" id="fmonitor_audit_pickinglist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="monitor_audit_picking">
<div id="gmp_monitor_audit_picking" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_monitor_audit_pickinglist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="picking_date" class="<?= $Page->picking_date->headerCellClass() ?>"><div id="elh_monitor_audit_picking_picking_date" class="monitor_audit_picking_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></div></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th data-name="users" class="<?= $Page->users->headerCellClass() ?>"><div id="elh_monitor_audit_picking_users" class="monitor_audit_picking_users"><?= $Page->renderFieldHeader($Page->users) ?></div></th>
<?php } ?>
<?php if ($Page->Pending->Visible) { // Pending ?>
        <th data-name="Pending" class="<?= $Page->Pending->headerCellClass() ?>"><div id="elh_monitor_audit_picking_Pending" class="monitor_audit_picking_Pending"><?= $Page->renderFieldHeader($Page->Pending) ?></div></th>
<?php } ?>
<?php if ($Page->Done->Visible) { // Done ?>
        <th data-name="Done" class="<?= $Page->Done->headerCellClass() ?>"><div id="elh_monitor_audit_picking_Done" class="monitor_audit_picking_Done"><?= $Page->renderFieldHeader($Page->Done) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_monitor_audit_picking_total" class="monitor_audit_picking_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_monitor_audit_picking_status" class="monitor_audit_picking_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_monitor_audit_picking",
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
<span id="el<?= $Page->RowCount ?>_monitor_audit_picking_picking_date" class="el_monitor_audit_picking_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->users->Visible) { // users ?>
        <td data-name="users"<?= $Page->users->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_audit_picking_users" class="el_monitor_audit_picking_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Pending->Visible) { // Pending ?>
        <td data-name="Pending"<?= $Page->Pending->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_audit_picking_Pending" class="el_monitor_audit_picking_Pending">
<span<?= $Page->Pending->viewAttributes() ?>>
<?= $Page->Pending->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Done->Visible) { // Done ?>
        <td data-name="Done"<?= $Page->Done->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_audit_picking_Done" class="el_monitor_audit_picking_Done">
<span<?= $Page->Done->viewAttributes() ?>>
<?= $Page->Done->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_audit_picking_total" class="el_monitor_audit_picking_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_audit_picking_status" class="el_monitor_audit_picking_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
    ew.addEventHandlers("monitor_audit_picking");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

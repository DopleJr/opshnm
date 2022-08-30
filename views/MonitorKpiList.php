<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MonitorKpiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { monitor_kpi: currentTable } });
var currentForm, currentPageID;
var fmonitor_kpilist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmonitor_kpilist = new ew.Form("fmonitor_kpilist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmonitor_kpilist;
    fmonitor_kpilist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fmonitor_kpilist.lists.Date = <?= $Page->Date->toClientList($Page) ?>;
    fmonitor_kpilist.lists.Subject = <?= $Page->Subject->toClientList($Page) ?>;
    fmonitor_kpilist.lists.Divisi = <?= $Page->Divisi->toClientList($Page) ?>;
    fmonitor_kpilist.lists.Pending = <?= $Page->Pending->toClientList($Page) ?>;
    fmonitor_kpilist.lists.Done = <?= $Page->Done->toClientList($Page) ?>;
    loadjs.done("fmonitor_kpilist");
});
var fmonitor_kpisrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmonitor_kpisrch = new ew.Form("fmonitor_kpisrch", "list");
    currentSearchForm = fmonitor_kpisrch;

    // Add fields
    var fields = currentTable.fields;
    fmonitor_kpisrch.addFields([
        ["Date", [], fields.Date.isInvalid],
        ["Subject", [], fields.Subject.isInvalid],
        ["Divisi", [], fields.Divisi.isInvalid],
        ["Pending", [], fields.Pending.isInvalid],
        ["Done", [], fields.Done.isInvalid],
        ["Total", [], fields.Total.isInvalid]
    ]);

    // Validate form
    fmonitor_kpisrch.validate = function () {
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
    fmonitor_kpisrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmonitor_kpisrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmonitor_kpisrch.lists.Date = <?= $Page->Date->toClientList($Page) ?>;
    fmonitor_kpisrch.lists.Subject = <?= $Page->Subject->toClientList($Page) ?>;
    fmonitor_kpisrch.lists.Divisi = <?= $Page->Divisi->toClientList($Page) ?>;
    fmonitor_kpisrch.lists.Pending = <?= $Page->Pending->toClientList($Page) ?>;
    fmonitor_kpisrch.lists.Done = <?= $Page->Done->toClientList($Page) ?>;

    // Filters
    fmonitor_kpisrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmonitor_kpisrch");
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
<form name="fmonitor_kpisrch" id="fmonitor_kpisrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmonitor_kpisrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="monitor_kpi">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->Date->Visible) { // Date ?>
<?php
if (!$Page->Date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Date"
            name="x_Date[]"
            class="form-control ew-select<?= $Page->Date->isInvalidClass() ?>"
            data-select2-id="fmonitor_kpisrch_x_Date"
            data-table="monitor_kpi"
            data-field="x_Date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Date->getPlaceHolder()) ?>"
            <?= $Page->Date->editAttributes() ?>>
            <?= $Page->Date->selectOptionListHtml("x_Date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_kpisrch", function() {
            var options = {
                name: "x_Date",
                selectId: "fmonitor_kpisrch_x_Date",
                ajax: { id: "x_Date", form: "fmonitor_kpisrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_kpi.fields.Date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Subject->Visible) { // Subject ?>
<?php
if (!$Page->Subject->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Subject" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Subject->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Subject"
            name="x_Subject[]"
            class="form-control ew-select<?= $Page->Subject->isInvalidClass() ?>"
            data-select2-id="fmonitor_kpisrch_x_Subject"
            data-table="monitor_kpi"
            data-field="x_Subject"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Subject->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Subject->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Subject->getPlaceHolder()) ?>"
            <?= $Page->Subject->editAttributes() ?>>
            <?= $Page->Subject->selectOptionListHtml("x_Subject", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Subject->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_kpisrch", function() {
            var options = {
                name: "x_Subject",
                selectId: "fmonitor_kpisrch_x_Subject",
                ajax: { id: "x_Subject", form: "fmonitor_kpisrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_kpi.fields.Subject.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Divisi->Visible) { // Divisi ?>
<?php
if (!$Page->Divisi->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Divisi" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Divisi->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Divisi"
            name="x_Divisi[]"
            class="form-control ew-select<?= $Page->Divisi->isInvalidClass() ?>"
            data-select2-id="fmonitor_kpisrch_x_Divisi"
            data-table="monitor_kpi"
            data-field="x_Divisi"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Divisi->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Divisi->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Divisi->getPlaceHolder()) ?>"
            <?= $Page->Divisi->editAttributes() ?>>
            <?= $Page->Divisi->selectOptionListHtml("x_Divisi", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Divisi->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_kpisrch", function() {
            var options = {
                name: "x_Divisi",
                selectId: "fmonitor_kpisrch_x_Divisi",
                ajax: { id: "x_Divisi", form: "fmonitor_kpisrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_kpi.fields.Divisi.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Pending->Visible) { // Pending ?>
<?php
if (!$Page->Pending->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Pending" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Pending->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Pending"
            name="x_Pending[]"
            class="form-control ew-select<?= $Page->Pending->isInvalidClass() ?>"
            data-select2-id="fmonitor_kpisrch_x_Pending"
            data-table="monitor_kpi"
            data-field="x_Pending"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Pending->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Pending->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Pending->getPlaceHolder()) ?>"
            <?= $Page->Pending->editAttributes() ?>>
            <?= $Page->Pending->selectOptionListHtml("x_Pending", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Pending->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_kpisrch", function() {
            var options = {
                name: "x_Pending",
                selectId: "fmonitor_kpisrch_x_Pending",
                ajax: { id: "x_Pending", form: "fmonitor_kpisrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_kpi.fields.Pending.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Done->Visible) { // Done ?>
<?php
if (!$Page->Done->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Done" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->Done->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Done"
            name="x_Done[]"
            class="form-control ew-select<?= $Page->Done->isInvalidClass() ?>"
            data-select2-id="fmonitor_kpisrch_x_Done"
            data-table="monitor_kpi"
            data-field="x_Done"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Done->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Done->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Done->getPlaceHolder()) ?>"
            <?= $Page->Done->editAttributes() ?>>
            <?= $Page->Done->selectOptionListHtml("x_Done", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Done->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmonitor_kpisrch", function() {
            var options = {
                name: "x_Done",
                selectId: "fmonitor_kpisrch_x_Done",
                ajax: { id: "x_Done", form: "fmonitor_kpisrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.monitor_kpi.fields.Done.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmonitor_kpisrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmonitor_kpisrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmonitor_kpisrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmonitor_kpisrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monitor_kpi">
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
<form name="fmonitor_kpilist" id="fmonitor_kpilist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="monitor_kpi">
<div id="gmp_monitor_kpi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_monitor_kpilist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->Date->Visible) { // Date ?>
        <th data-name="Date" class="<?= $Page->Date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_kpi_Date" class="monitor_kpi_Date"><?= $Page->renderFieldHeader($Page->Date) ?></div></th>
<?php } ?>
<?php if ($Page->Subject->Visible) { // Subject ?>
        <th data-name="Subject" class="<?= $Page->Subject->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_kpi_Subject" class="monitor_kpi_Subject"><?= $Page->renderFieldHeader($Page->Subject) ?></div></th>
<?php } ?>
<?php if ($Page->Divisi->Visible) { // Divisi ?>
        <th data-name="Divisi" class="<?= $Page->Divisi->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_kpi_Divisi" class="monitor_kpi_Divisi"><?= $Page->renderFieldHeader($Page->Divisi) ?></div></th>
<?php } ?>
<?php if ($Page->Pending->Visible) { // Pending ?>
        <th data-name="Pending" class="<?= $Page->Pending->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_kpi_Pending" class="monitor_kpi_Pending"><?= $Page->renderFieldHeader($Page->Pending) ?></div></th>
<?php } ?>
<?php if ($Page->Done->Visible) { // Done ?>
        <th data-name="Done" class="<?= $Page->Done->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_kpi_Done" class="monitor_kpi_Done"><?= $Page->renderFieldHeader($Page->Done) ?></div></th>
<?php } ?>
<?php if ($Page->Total->Visible) { // Total ?>
        <th data-name="Total" class="<?= $Page->Total->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_monitor_kpi_Total" class="monitor_kpi_Total"><?= $Page->renderFieldHeader($Page->Total) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_monitor_kpi",
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
    <?php if ($Page->Date->Visible) { // Date ?>
        <td data-name="Date"<?= $Page->Date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_kpi_Date" class="el_monitor_kpi_Date">
<span<?= $Page->Date->viewAttributes() ?>>
<?= $Page->Date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Subject->Visible) { // Subject ?>
        <td data-name="Subject"<?= $Page->Subject->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_kpi_Subject" class="el_monitor_kpi_Subject">
<span<?= $Page->Subject->viewAttributes() ?>>
<?= $Page->Subject->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Divisi->Visible) { // Divisi ?>
        <td data-name="Divisi"<?= $Page->Divisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_kpi_Divisi" class="el_monitor_kpi_Divisi">
<span<?= $Page->Divisi->viewAttributes() ?>>
<?= $Page->Divisi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Pending->Visible) { // Pending ?>
        <td data-name="Pending"<?= $Page->Pending->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_kpi_Pending" class="el_monitor_kpi_Pending">
<span<?= $Page->Pending->viewAttributes() ?>>
<?= $Page->Pending->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Done->Visible) { // Done ?>
        <td data-name="Done"<?= $Page->Done->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_kpi_Done" class="el_monitor_kpi_Done">
<span<?= $Page->Done->viewAttributes() ?>>
<?= $Page->Done->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Total->Visible) { // Total ?>
        <td data-name="Total"<?= $Page->Total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_monitor_kpi_Total" class="el_monitor_kpi_Total">
<span<?= $Page->Total->viewAttributes() ?>>
<?= $Page->Total->getViewValue() ?></span>
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
    ew.addEventHandlers("monitor_kpi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

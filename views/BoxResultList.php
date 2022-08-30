<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BoxResultList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { box_result: currentTable } });
var currentForm, currentPageID;
var fbox_resultlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbox_resultlist = new ew.Form("fbox_resultlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fbox_resultlist;
    fbox_resultlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fbox_resultlist.lists.confirmation_date = <?= $Page->confirmation_date->toClientList($Page) ?>;
    fbox_resultlist.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fbox_resultlist.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fbox_resultlist.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    fbox_resultlist.lists.total = <?= $Page->total->toClientList($Page) ?>;
    loadjs.done("fbox_resultlist");
});
var fbox_resultsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fbox_resultsrch = new ew.Form("fbox_resultsrch", "list");
    currentSearchForm = fbox_resultsrch;

    // Add fields
    var fields = currentTable.fields;
    fbox_resultsrch.addFields([
        ["confirmation_date", [], fields.confirmation_date.isInvalid],
        ["box_code", [], fields.box_code.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["picker", [], fields.picker.isInvalid],
        ["total", [], fields.total.isInvalid]
    ]);

    // Validate form
    fbox_resultsrch.validate = function () {
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
    fbox_resultsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbox_resultsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fbox_resultsrch.lists.confirmation_date = <?= $Page->confirmation_date->toClientList($Page) ?>;
    fbox_resultsrch.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    fbox_resultsrch.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fbox_resultsrch.lists.picker = <?= $Page->picker->toClientList($Page) ?>;
    fbox_resultsrch.lists.total = <?= $Page->total->toClientList($Page) ?>;

    // Filters
    fbox_resultsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbox_resultsrch");
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
<form name="fbox_resultsrch" id="fbox_resultsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbox_resultsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="box_result">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
<?php
if (!$Page->confirmation_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_confirmation_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->confirmation_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_confirmation_date"
            name="x_confirmation_date[]"
            class="form-control ew-select<?= $Page->confirmation_date->isInvalidClass() ?>"
            data-select2-id="fbox_resultsrch_x_confirmation_date"
            data-table="box_result"
            data-field="x_confirmation_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->confirmation_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->confirmation_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"
            <?= $Page->confirmation_date->editAttributes() ?>>
            <?= $Page->confirmation_date->selectOptionListHtml("x_confirmation_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_resultsrch", function() {
            var options = {
                name: "x_confirmation_date",
                selectId: "fbox_resultsrch_x_confirmation_date",
                ajax: { id: "x_confirmation_date", form: "fbox_resultsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_result.fields.confirmation_date.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
<?php
if (!$Page->box_code->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_box_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->box_code->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_box_code"
            name="x_box_code[]"
            class="form-control ew-select<?= $Page->box_code->isInvalidClass() ?>"
            data-select2-id="fbox_resultsrch_x_box_code"
            data-table="box_result"
            data-field="x_box_code"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->box_code->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->box_code->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"
            <?= $Page->box_code->editAttributes() ?>>
            <?= $Page->box_code->selectOptionListHtml("x_box_code", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->box_code->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_resultsrch", function() {
            var options = {
                name: "x_box_code",
                selectId: "fbox_resultsrch_x_box_code",
                ajax: { id: "x_box_code", form: "fbox_resultsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_result.fields.box_code.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
<?php
if (!$Page->store_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_store_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->store_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_store_id"
            name="x_store_id[]"
            class="form-control ew-select<?= $Page->store_id->isInvalidClass() ?>"
            data-select2-id="fbox_resultsrch_x_store_id"
            data-table="box_result"
            data-field="x_store_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->store_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->store_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"
            <?= $Page->store_id->editAttributes() ?>>
            <?= $Page->store_id->selectOptionListHtml("x_store_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->store_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_resultsrch", function() {
            var options = {
                name: "x_store_id",
                selectId: "fbox_resultsrch_x_store_id",
                ajax: { id: "x_store_id", form: "fbox_resultsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_result.fields.store_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
<?php
if (!$Page->picker->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_picker" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->picker->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_picker"
            name="x_picker[]"
            class="form-control ew-select<?= $Page->picker->isInvalidClass() ?>"
            data-select2-id="fbox_resultsrch_x_picker"
            data-table="box_result"
            data-field="x_picker"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->picker->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->picker->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"
            <?= $Page->picker->editAttributes() ?>>
            <?= $Page->picker->selectOptionListHtml("x_picker", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->picker->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_resultsrch", function() {
            var options = {
                name: "x_picker",
                selectId: "fbox_resultsrch_x_picker",
                ajax: { id: "x_picker", form: "fbox_resultsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_result.fields.picker.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
<?php
if (!$Page->total->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_total" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->total->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_total"
            name="x_total[]"
            class="form-control ew-select<?= $Page->total->isInvalidClass() ?>"
            data-select2-id="fbox_resultsrch_x_total"
            data-table="box_result"
            data-field="x_total"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->total->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->total->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>"
            <?= $Page->total->editAttributes() ?>>
            <?= $Page->total->selectOptionListHtml("x_total", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->total->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbox_resultsrch", function() {
            var options = {
                name: "x_total",
                selectId: "fbox_resultsrch_x_total",
                ajax: { id: "x_total", form: "fbox_resultsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.box_result.fields.total.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbox_resultsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbox_resultsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbox_resultsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbox_resultsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> box_result">
<form name="fbox_resultlist" id="fbox_resultlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_result">
<div id="gmp_box_result" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_box_resultlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <th data-name="confirmation_date" class="<?= $Page->confirmation_date->headerCellClass() ?>"><div id="elh_box_result_confirmation_date" class="box_result_confirmation_date"><?= $Page->renderFieldHeader($Page->confirmation_date) ?></div></th>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
        <th data-name="box_code" class="<?= $Page->box_code->headerCellClass() ?>"><div id="elh_box_result_box_code" class="box_result_box_code"><?= $Page->renderFieldHeader($Page->box_code) ?></div></th>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
        <th data-name="store_id" class="<?= $Page->store_id->headerCellClass() ?>"><div id="elh_box_result_store_id" class="box_result_store_id"><?= $Page->renderFieldHeader($Page->store_id) ?></div></th>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
        <th data-name="picker" class="<?= $Page->picker->headerCellClass() ?>"><div id="elh_box_result_picker" class="box_result_picker"><?= $Page->renderFieldHeader($Page->picker) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_box_result_total" class="box_result_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_box_result",
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
    <?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
        <td data-name="confirmation_date"<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_result_confirmation_date" class="el_box_result_confirmation_date">
<span<?= $Page->confirmation_date->viewAttributes() ?>>
<?= $Page->confirmation_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->box_code->Visible) { // box_code ?>
        <td data-name="box_code"<?= $Page->box_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_result_box_code" class="el_box_result_box_code">
<span<?= $Page->box_code->viewAttributes() ?>>
<?= $Page->box_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->store_id->Visible) { // store_id ?>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_result_store_id" class="el_box_result_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->picker->Visible) { // picker ?>
        <td data-name="picker"<?= $Page->picker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_result_picker" class="el_box_result_picker">
<span<?= $Page->picker->viewAttributes() ?>>
<?= $Page->picker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_result_total" class="el_box_result_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
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
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
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
    ew.addEventHandlers("box_result");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$UserlevelpermissionsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { userlevelpermissions: currentTable } });
var currentForm, currentPageID;
var fuserlevelpermissionslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuserlevelpermissionslist = new ew.Form("fuserlevelpermissionslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fuserlevelpermissionslist;
    fuserlevelpermissionslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fuserlevelpermissionslist.lists.userlevelid = <?= $Page->userlevelid->toClientList($Page) ?>;
    fuserlevelpermissionslist.lists._tablename = <?= $Page->_tablename->toClientList($Page) ?>;
    fuserlevelpermissionslist.lists._permission = <?= $Page->_permission->toClientList($Page) ?>;
    loadjs.done("fuserlevelpermissionslist");
});
var fuserlevelpermissionssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fuserlevelpermissionssrch = new ew.Form("fuserlevelpermissionssrch", "list");
    currentSearchForm = fuserlevelpermissionssrch;

    // Add fields
    var fields = currentTable.fields;
    fuserlevelpermissionssrch.addFields([
        ["userlevelid", [], fields.userlevelid.isInvalid],
        ["_tablename", [], fields._tablename.isInvalid],
        ["_permission", [], fields._permission.isInvalid]
    ]);

    // Validate form
    fuserlevelpermissionssrch.validate = function () {
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
    fuserlevelpermissionssrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuserlevelpermissionssrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fuserlevelpermissionssrch.lists.userlevelid = <?= $Page->userlevelid->toClientList($Page) ?>;
    fuserlevelpermissionssrch.lists._tablename = <?= $Page->_tablename->toClientList($Page) ?>;
    fuserlevelpermissionssrch.lists._permission = <?= $Page->_permission->toClientList($Page) ?>;

    // Filters
    fuserlevelpermissionssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fuserlevelpermissionssrch");
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
<form name="fuserlevelpermissionssrch" id="fuserlevelpermissionssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fuserlevelpermissionssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="userlevelpermissions">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->userlevelid->Visible) { // userlevelid ?>
<?php
if (!$Page->userlevelid->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_userlevelid" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->userlevelid->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_userlevelid"
            name="x_userlevelid[]"
            class="form-control ew-select<?= $Page->userlevelid->isInvalidClass() ?>"
            data-select2-id="fuserlevelpermissionssrch_x_userlevelid"
            data-table="userlevelpermissions"
            data-field="x_userlevelid"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->userlevelid->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->userlevelid->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->userlevelid->getPlaceHolder()) ?>"
            <?= $Page->userlevelid->editAttributes() ?>>
            <?= $Page->userlevelid->selectOptionListHtml("x_userlevelid", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->userlevelid->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fuserlevelpermissionssrch", function() {
            var options = {
                name: "x_userlevelid",
                selectId: "fuserlevelpermissionssrch_x_userlevelid",
                ajax: { id: "x_userlevelid", form: "fuserlevelpermissionssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.userlevelpermissions.fields.userlevelid.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
<?php
if (!$Page->_tablename->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs__tablename" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_tablename->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x__tablename"
            name="x__tablename[]"
            class="form-control ew-select<?= $Page->_tablename->isInvalidClass() ?>"
            data-select2-id="fuserlevelpermissionssrch_x__tablename"
            data-table="userlevelpermissions"
            data-field="x__tablename"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->_tablename->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->_tablename->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->_tablename->getPlaceHolder()) ?>"
            <?= $Page->_tablename->editAttributes() ?>>
            <?= $Page->_tablename->selectOptionListHtml("x__tablename", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->_tablename->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fuserlevelpermissionssrch", function() {
            var options = {
                name: "x__tablename",
                selectId: "fuserlevelpermissionssrch_x__tablename",
                ajax: { id: "x__tablename", form: "fuserlevelpermissionssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.userlevelpermissions.fields._tablename.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
<?php
if (!$Page->_permission->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs__permission" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_permission->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x__permission"
            name="x__permission[]"
            class="form-control ew-select<?= $Page->_permission->isInvalidClass() ?>"
            data-select2-id="fuserlevelpermissionssrch_x__permission"
            data-table="userlevelpermissions"
            data-field="x__permission"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->_permission->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->_permission->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->_permission->getPlaceHolder()) ?>"
            <?= $Page->_permission->editAttributes() ?>>
            <?= $Page->_permission->selectOptionListHtml("x__permission", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->_permission->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fuserlevelpermissionssrch", function() {
            var options = {
                name: "x__permission",
                selectId: "fuserlevelpermissionssrch_x__permission",
                ajax: { id: "x__permission", form: "fuserlevelpermissionssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.userlevelpermissions.fields._permission.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fuserlevelpermissionssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fuserlevelpermissionssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fuserlevelpermissionssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fuserlevelpermissionssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> userlevelpermissions">
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
<form name="fuserlevelpermissionslist" id="fuserlevelpermissionslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<div id="gmp_userlevelpermissions" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_userlevelpermissionslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->userlevelid->Visible) { // userlevelid ?>
        <th data-name="userlevelid" class="<?= $Page->userlevelid->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_userlevelpermissions_userlevelid" class="userlevelpermissions_userlevelid"><?= $Page->renderFieldHeader($Page->userlevelid) ?></div></th>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
        <th data-name="_tablename" class="<?= $Page->_tablename->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_userlevelpermissions__tablename" class="userlevelpermissions__tablename"><?= $Page->renderFieldHeader($Page->_tablename) ?></div></th>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
        <th data-name="_permission" class="<?= $Page->_permission->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_userlevelpermissions__permission" class="userlevelpermissions__permission"><?= $Page->renderFieldHeader($Page->_permission) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_userlevelpermissions",
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
    <?php if ($Page->userlevelid->Visible) { // userlevelid ?>
        <td data-name="userlevelid"<?= $Page->userlevelid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlevelpermissions_userlevelid" class="el_userlevelpermissions_userlevelid">
<span<?= $Page->userlevelid->viewAttributes() ?>>
<?= $Page->userlevelid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_tablename->Visible) { // tablename ?>
        <td data-name="_tablename"<?= $Page->_tablename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlevelpermissions__tablename" class="el_userlevelpermissions__tablename">
<span<?= $Page->_tablename->viewAttributes() ?>>
<?= $Page->_tablename->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_permission->Visible) { // permission ?>
        <td data-name="_permission"<?= $Page->_permission->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlevelpermissions__permission" class="el_userlevelpermissions__permission">
<span<?= $Page->_permission->viewAttributes() ?>>
<?= $Page->_permission->getViewValue() ?></span>
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
    ew.addEventHandlers("userlevelpermissions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

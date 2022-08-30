<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$UserList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { user: currentTable } });
var currentForm, currentPageID;
var fuserlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuserlist = new ew.Form("fuserlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fuserlist;
    fuserlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    fuserlist.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fuserlist.lists._username = <?= $Page->_username->toClientList($Page) ?>;
    fuserlist.lists._password = <?= $Page->_password->toClientList($Page) ?>;
    fuserlist.lists._email = <?= $Page->_email->toClientList($Page) ?>;
    fuserlist.lists.ip_loggedin = <?= $Page->ip_loggedin->toClientList($Page) ?>;
    fuserlist.lists.role = <?= $Page->role->toClientList($Page) ?>;
    fuserlist.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fuserlist.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;
    loadjs.done("fuserlist");
});
var fusersrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fusersrch = new ew.Form("fusersrch", "list");
    currentSearchForm = fusersrch;

    // Add fields
    var fields = currentTable.fields;
    fusersrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["_username", [], fields._username.isInvalid],
        ["_password", [], fields._password.isInvalid],
        ["_email", [], fields._email.isInvalid],
        ["ip_loggedin", [], fields.ip_loggedin.isInvalid],
        ["role", [], fields.role.isInvalid],
        ["date_created", [], fields.date_created.isInvalid],
        ["date_updated", [], fields.date_updated.isInvalid]
    ]);

    // Validate form
    fusersrch.validate = function () {
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
    fusersrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fusersrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fusersrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fusersrch.lists._username = <?= $Page->_username->toClientList($Page) ?>;
    fusersrch.lists._password = <?= $Page->_password->toClientList($Page) ?>;
    fusersrch.lists._email = <?= $Page->_email->toClientList($Page) ?>;
    fusersrch.lists.ip_loggedin = <?= $Page->ip_loggedin->toClientList($Page) ?>;
    fusersrch.lists.role = <?= $Page->role->toClientList($Page) ?>;
    fusersrch.lists.date_created = <?= $Page->date_created->toClientList($Page) ?>;
    fusersrch.lists.date_updated = <?= $Page->date_updated->toClientList($Page) ?>;

    // Filters
    fusersrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fusersrch");
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
<form name="fusersrch" id="fusersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fusersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="user">
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
            data-select2-id="fusersrch_x_id"
            data-table="user"
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
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x_id",
                selectId: "fusersrch_x_id",
                ajax: { id: "x_id", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
<?php
if (!$Page->_username->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs__username" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_username->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x__username"
            name="x__username[]"
            class="form-control ew-select<?= $Page->_username->isInvalidClass() ?>"
            data-select2-id="fusersrch_x__username"
            data-table="user"
            data-field="x__username"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->_username->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->_username->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>"
            <?= $Page->_username->editAttributes() ?>>
            <?= $Page->_username->selectOptionListHtml("x__username", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->_username->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x__username",
                selectId: "fusersrch_x__username",
                ajax: { id: "x__username", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields._username.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
<?php
if (!$Page->_password->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs__password" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_password->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x__password"
            name="x__password[]"
            class="form-control ew-select<?= $Page->_password->isInvalidClass() ?>"
            data-select2-id="fusersrch_x__password"
            data-table="user"
            data-field="x__password"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->_password->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->_password->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"
            <?= $Page->_password->editAttributes() ?>>
            <?= $Page->_password->selectOptionListHtml("x__password", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->_password->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x__password",
                selectId: "fusersrch_x__password",
                ajax: { id: "x__password", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields._password.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
<?php
if (!$Page->_email->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs__email" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_email->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x__email"
            name="x__email[]"
            class="form-control ew-select<?= $Page->_email->isInvalidClass() ?>"
            data-select2-id="fusersrch_x__email"
            data-table="user"
            data-field="x__email"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->_email->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->_email->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"
            <?= $Page->_email->editAttributes() ?>>
            <?= $Page->_email->selectOptionListHtml("x__email", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->_email->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x__email",
                selectId: "fusersrch_x__email",
                ajax: { id: "x__email", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields._email.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ip_loggedin->Visible) { // ip_loggedin ?>
<?php
if (!$Page->ip_loggedin->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ip_loggedin" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->ip_loggedin->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ip_loggedin"
            name="x_ip_loggedin[]"
            class="form-control ew-select<?= $Page->ip_loggedin->isInvalidClass() ?>"
            data-select2-id="fusersrch_x_ip_loggedin"
            data-table="user"
            data-field="x_ip_loggedin"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ip_loggedin->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ip_loggedin->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ip_loggedin->getPlaceHolder()) ?>"
            <?= $Page->ip_loggedin->editAttributes() ?>>
            <?= $Page->ip_loggedin->selectOptionListHtml("x_ip_loggedin", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ip_loggedin->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x_ip_loggedin",
                selectId: "fusersrch_x_ip_loggedin",
                ajax: { id: "x_ip_loggedin", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.ip_loggedin.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
<?php
if (!$Page->role->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_role" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->role->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_role"
            name="x_role[]"
            class="form-control ew-select<?= $Page->role->isInvalidClass() ?>"
            data-select2-id="fusersrch_x_role"
            data-table="user"
            data-field="x_role"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->role->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->role->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->role->getPlaceHolder()) ?>"
            <?= $Page->role->editAttributes() ?>>
            <?= $Page->role->selectOptionListHtml("x_role", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->role->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x_role",
                selectId: "fusersrch_x_role",
                ajax: { id: "x_role", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.role.filterOptions);
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
            data-select2-id="fusersrch_x_date_created"
            data-table="user"
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
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x_date_created",
                selectId: "fusersrch_x_date_created",
                ajax: { id: "x_date_created", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.date_created.filterOptions);
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
            data-select2-id="fusersrch_x_date_updated"
            data-table="user"
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
        loadjs.ready("fusersrch", function() {
            var options = {
                name: "x_date_updated",
                selectId: "fusersrch_x_date_updated",
                ajax: { id: "x_date_updated", form: "fusersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.date_updated.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user">
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
<form name="fuserlist" id="fuserlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user">
<div id="gmp_user" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_userlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_user_id" class="user_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th data-name="_username" class="<?= $Page->_username->headerCellClass() ?>"><div id="elh_user__username" class="user__username"><?= $Page->renderFieldHeader($Page->_username) ?></div></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th data-name="_password" class="<?= $Page->_password->headerCellClass() ?>"><div id="elh_user__password" class="user__password"><?= $Page->renderFieldHeader($Page->_password) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_user__email" class="user__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->ip_loggedin->Visible) { // ip_loggedin ?>
        <th data-name="ip_loggedin" class="<?= $Page->ip_loggedin->headerCellClass() ?>"><div id="elh_user_ip_loggedin" class="user_ip_loggedin"><?= $Page->renderFieldHeader($Page->ip_loggedin) ?></div></th>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
        <th data-name="role" class="<?= $Page->role->headerCellClass() ?>"><div id="elh_user_role" class="user_role"><?= $Page->renderFieldHeader($Page->role) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_user_date_created" class="user_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_user_date_updated" class="user_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_user",
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
<span id="el<?= $Page->RowCount ?>_user_id" class="el_user_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_username->Visible) { // username ?>
        <td data-name="_username"<?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user__username" class="el_user__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_password->Visible) { // password ?>
        <td data-name="_password"<?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user__password" class="el_user__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user__email" class="el_user__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ip_loggedin->Visible) { // ip_loggedin ?>
        <td data-name="ip_loggedin"<?= $Page->ip_loggedin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user_ip_loggedin" class="el_user_ip_loggedin">
<span<?= $Page->ip_loggedin->viewAttributes() ?>>
<?= $Page->ip_loggedin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->role->Visible) { // role ?>
        <td data-name="role"<?= $Page->role->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user_role" class="el_user_role">
<span<?= $Page->role->viewAttributes() ?>>
<?= $Page->role->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user_date_created" class="el_user_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user_date_updated" class="el_user_date_updated">
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
    ew.addEventHandlers("user");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

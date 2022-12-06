<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferBinPieceList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transfer_bin_piece: currentTable } });
var currentForm, currentPageID;
var ftransfer_bin_piecelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransfer_bin_piecelist = new ew.Form("ftransfer_bin_piecelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ftransfer_bin_piecelist;
    ftransfer_bin_piecelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Dynamic selection lists
    ftransfer_bin_piecelist.lists.source_location = <?= $Page->source_location->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.article = <?= $Page->article->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.description = <?= $Page->description->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.destination_location = <?= $Page->destination_location->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.su = <?= $Page->su->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.qty = <?= $Page->qty->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.actual = <?= $Page->actual->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.user = <?= $Page->user->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.status = <?= $Page->status->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.date_confirmation = <?= $Page->date_confirmation->toClientList($Page) ?>;
    ftransfer_bin_piecelist.lists.time_confirmation = <?= $Page->time_confirmation->toClientList($Page) ?>;
    loadjs.done("ftransfer_bin_piecelist");
});
var ftransfer_bin_piecesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ftransfer_bin_piecesrch = new ew.Form("ftransfer_bin_piecesrch", "list");
    currentSearchForm = ftransfer_bin_piecesrch;

    // Add fields
    var fields = currentTable.fields;
    ftransfer_bin_piecesrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["source_location", [], fields.source_location.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["description", [], fields.description.isInvalid],
        ["destination_location", [], fields.destination_location.isInvalid],
        ["su", [], fields.su.isInvalid],
        ["qty", [], fields.qty.isInvalid],
        ["actual", [], fields.actual.isInvalid],
        ["user", [], fields.user.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_upload", [], fields.date_upload.isInvalid],
        ["y_date_upload", [ew.Validators.between], false],
        ["date_confirmation", [], fields.date_confirmation.isInvalid],
        ["y_date_confirmation", [ew.Validators.between], false],
        ["time_confirmation", [], fields.time_confirmation.isInvalid]
    ]);

    // Validate form
    ftransfer_bin_piecesrch.validate = function () {
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
    ftransfer_bin_piecesrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransfer_bin_piecesrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ftransfer_bin_piecesrch.lists.source_location = <?= $Page->source_location->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.article = <?= $Page->article->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.description = <?= $Page->description->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.destination_location = <?= $Page->destination_location->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.su = <?= $Page->su->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.qty = <?= $Page->qty->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.actual = <?= $Page->actual->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.user = <?= $Page->user->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.date_upload = <?= $Page->date_upload->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.date_confirmation = <?= $Page->date_confirmation->toClientList($Page) ?>;
    ftransfer_bin_piecesrch.lists.time_confirmation = <?= $Page->time_confirmation->toClientList($Page) ?>;

    // Filters
    ftransfer_bin_piecesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ftransfer_bin_piecesrch");
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
<form name="ftransfer_bin_piecesrch" id="ftransfer_bin_piecesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ftransfer_bin_piecesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="transfer_bin_piece">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->source_location->Visible) { // source_location ?>
<?php
if (!$Page->source_location->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_source_location" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->source_location->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_source_location"
            name="x_source_location[]"
            class="form-control ew-select<?= $Page->source_location->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_source_location"
            data-table="transfer_bin_piece"
            data-field="x_source_location"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->source_location->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->source_location->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->source_location->getPlaceHolder()) ?>"
            <?= $Page->source_location->editAttributes() ?>>
            <?= $Page->source_location->selectOptionListHtml("x_source_location", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->source_location->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_source_location",
                selectId: "ftransfer_bin_piecesrch_x_source_location",
                ajax: { id: "x_source_location", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.source_location.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
<?php
if (!$Page->article->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_article" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->article->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_article"
            name="x_article[]"
            class="form-control ew-select<?= $Page->article->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_article"
            data-table="transfer_bin_piece"
            data-field="x_article"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->article->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->article->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"
            <?= $Page->article->editAttributes() ?>>
            <?= $Page->article->selectOptionListHtml("x_article", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->article->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_article",
                selectId: "ftransfer_bin_piecesrch_x_article",
                ajax: { id: "x_article", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.article.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
<?php
if (!$Page->description->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_description" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->description->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_description"
            name="x_description[]"
            class="form-control ew-select<?= $Page->description->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_description"
            data-table="transfer_bin_piece"
            data-field="x_description"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->description->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->description->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"
            <?= $Page->description->editAttributes() ?>>
            <?= $Page->description->selectOptionListHtml("x_description", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->description->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_description",
                selectId: "ftransfer_bin_piecesrch_x_description",
                ajax: { id: "x_description", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.description.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
<?php
if (!$Page->destination_location->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_destination_location" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->destination_location->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_destination_location"
            name="x_destination_location[]"
            class="form-control ew-select<?= $Page->destination_location->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_destination_location"
            data-table="transfer_bin_piece"
            data-field="x_destination_location"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->destination_location->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->destination_location->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->destination_location->getPlaceHolder()) ?>"
            <?= $Page->destination_location->editAttributes() ?>>
            <?= $Page->destination_location->selectOptionListHtml("x_destination_location", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->destination_location->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_destination_location",
                selectId: "ftransfer_bin_piecesrch_x_destination_location",
                ajax: { id: "x_destination_location", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.destination_location.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
<?php
if (!$Page->su->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_su" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->su->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_su"
            name="x_su[]"
            class="form-control ew-select<?= $Page->su->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_su"
            data-table="transfer_bin_piece"
            data-field="x_su"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->su->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->su->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->su->getPlaceHolder()) ?>"
            <?= $Page->su->editAttributes() ?>>
            <?= $Page->su->selectOptionListHtml("x_su", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->su->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_su",
                selectId: "ftransfer_bin_piecesrch_x_su",
                ajax: { id: "x_su", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.su.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
<?php
if (!$Page->qty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_qty" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->qty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_qty"
            name="x_qty[]"
            class="form-control ew-select<?= $Page->qty->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_qty"
            data-table="transfer_bin_piece"
            data-field="x_qty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->qty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->qty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->qty->getPlaceHolder()) ?>"
            <?= $Page->qty->editAttributes() ?>>
            <?= $Page->qty->selectOptionListHtml("x_qty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->qty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_qty",
                selectId: "ftransfer_bin_piecesrch_x_qty",
                ajax: { id: "x_qty", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.qty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
<?php
if (!$Page->actual->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_actual" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->actual->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_actual"
            name="x_actual[]"
            class="form-control ew-select<?= $Page->actual->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_actual"
            data-table="transfer_bin_piece"
            data-field="x_actual"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->actual->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->actual->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"
            <?= $Page->actual->editAttributes() ?>>
            <?= $Page->actual->selectOptionListHtml("x_actual", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->actual->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_actual",
                selectId: "ftransfer_bin_piecesrch_x_actual",
                ajax: { id: "x_actual", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.actual.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
<?php
if (!$Page->user->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_user" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->user->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_user"
            name="x_user[]"
            class="form-control ew-select<?= $Page->user->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_user"
            data-table="transfer_bin_piece"
            data-field="x_user"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->user->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->user->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"
            <?= $Page->user->editAttributes() ?>>
            <?= $Page->user->selectOptionListHtml("x_user", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->user->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_user",
                selectId: "ftransfer_bin_piecesrch_x_user",
                ajax: { id: "x_user", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.user.filterOptions);
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
            data-select2-id="ftransfer_bin_piecesrch_x_status"
            data-table="transfer_bin_piece"
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
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_status",
                selectId: "ftransfer_bin_piecesrch_x_status",
                ajax: { id: "x_status", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
<?php
if (!$Page->date_upload->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_upload" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_upload->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_upload"
            name="x_date_upload[]"
            class="form-control ew-select<?= $Page->date_upload->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_date_upload"
            data-table="transfer_bin_piece"
            data-field="x_date_upload"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_upload->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_upload->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"
            <?= $Page->date_upload->editAttributes() ?>>
            <?= $Page->date_upload->selectOptionListHtml("x_date_upload", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_date_upload",
                selectId: "ftransfer_bin_piecesrch_x_date_upload",
                ajax: { id: "x_date_upload", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.date_upload.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
<?php
if (!$Page->date_confirmation->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_date_confirmation" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->date_confirmation->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_date_confirmation"
            name="x_date_confirmation[]"
            class="form-control ew-select<?= $Page->date_confirmation->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_date_confirmation"
            data-table="transfer_bin_piece"
            data-field="x_date_confirmation"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->date_confirmation->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->date_confirmation->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->date_confirmation->getPlaceHolder()) ?>"
            <?= $Page->date_confirmation->editAttributes() ?>>
            <?= $Page->date_confirmation->selectOptionListHtml("x_date_confirmation", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->date_confirmation->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_date_confirmation",
                selectId: "ftransfer_bin_piecesrch_x_date_confirmation",
                ajax: { id: "x_date_confirmation", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.date_confirmation.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
<?php
if (!$Page->time_confirmation->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_time_confirmation" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->time_confirmation->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_time_confirmation"
            name="x_time_confirmation[]"
            class="form-control ew-select<?= $Page->time_confirmation->isInvalidClass() ?>"
            data-select2-id="ftransfer_bin_piecesrch_x_time_confirmation"
            data-table="transfer_bin_piece"
            data-field="x_time_confirmation"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->time_confirmation->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->time_confirmation->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->time_confirmation->getPlaceHolder()) ?>"
            <?= $Page->time_confirmation->editAttributes() ?>>
            <?= $Page->time_confirmation->selectOptionListHtml("x_time_confirmation", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->time_confirmation->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("ftransfer_bin_piecesrch", function() {
            var options = {
                name: "x_time_confirmation",
                selectId: "ftransfer_bin_piecesrch_x_time_confirmation",
                ajax: { id: "x_time_confirmation", form: "ftransfer_bin_piecesrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.transfer_bin_piece.fields.time_confirmation.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ftransfer_bin_piecesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ftransfer_bin_piecesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ftransfer_bin_piecesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ftransfer_bin_piecesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> transfer_bin_piece">
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
<form name="ftransfer_bin_piecelist" id="ftransfer_bin_piecelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transfer_bin_piece">
<div id="gmp_transfer_bin_piece" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_transfer_bin_piecelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_id" class="transfer_bin_piece_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->source_location->Visible) { // source_location ?>
        <th data-name="source_location" class="<?= $Page->source_location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_source_location" class="transfer_bin_piece_source_location"><?= $Page->renderFieldHeader($Page->source_location) ?></div></th>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
        <th data-name="article" class="<?= $Page->article->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_article" class="transfer_bin_piece_article"><?= $Page->renderFieldHeader($Page->article) ?></div></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Page->description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_description" class="transfer_bin_piece_description"><?= $Page->renderFieldHeader($Page->description) ?></div></th>
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
        <th data-name="destination_location" class="<?= $Page->destination_location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_destination_location" class="transfer_bin_piece_destination_location"><?= $Page->renderFieldHeader($Page->destination_location) ?></div></th>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
        <th data-name="su" class="<?= $Page->su->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_su" class="transfer_bin_piece_su"><?= $Page->renderFieldHeader($Page->su) ?></div></th>
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
        <th data-name="qty" class="<?= $Page->qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_qty" class="transfer_bin_piece_qty"><?= $Page->renderFieldHeader($Page->qty) ?></div></th>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
        <th data-name="actual" class="<?= $Page->actual->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_actual" class="transfer_bin_piece_actual"><?= $Page->renderFieldHeader($Page->actual) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_user" class="transfer_bin_piece_user"><?= $Page->renderFieldHeader($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_status" class="transfer_bin_piece_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
        <th data-name="date_upload" class="<?= $Page->date_upload->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_date_upload" class="transfer_bin_piece_date_upload"><?= $Page->renderFieldHeader($Page->date_upload) ?></div></th>
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
        <th data-name="date_confirmation" class="<?= $Page->date_confirmation->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_date_confirmation" class="transfer_bin_piece_date_confirmation"><?= $Page->renderFieldHeader($Page->date_confirmation) ?></div></th>
<?php } ?>
<?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
        <th data-name="time_confirmation" class="<?= $Page->time_confirmation->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_transfer_bin_piece_time_confirmation" class="transfer_bin_piece_time_confirmation"><?= $Page->renderFieldHeader($Page->time_confirmation) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_transfer_bin_piece",
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
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_id" class="el_transfer_bin_piece_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->source_location->Visible) { // source_location ?>
        <td data-name="source_location"<?= $Page->source_location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_source_location" class="el_transfer_bin_piece_source_location">
<span<?= $Page->source_location->viewAttributes() ?>>
<?= $Page->source_location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->article->Visible) { // article ?>
        <td data-name="article"<?= $Page->article->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_article" class="el_transfer_bin_piece_article">
<span<?= $Page->article->viewAttributes() ?>>
<?= $Page->article->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_description" class="el_transfer_bin_piece_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->destination_location->Visible) { // destination_location ?>
        <td data-name="destination_location"<?= $Page->destination_location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_destination_location" class="el_transfer_bin_piece_destination_location">
<span<?= $Page->destination_location->viewAttributes() ?>>
<?= $Page->destination_location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->su->Visible) { // su ?>
        <td data-name="su"<?= $Page->su->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_su" class="el_transfer_bin_piece_su">
<span<?= $Page->su->viewAttributes() ?>>
<?= $Page->su->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->qty->Visible) { // qty ?>
        <td data-name="qty"<?= $Page->qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_qty" class="el_transfer_bin_piece_qty">
<span<?= $Page->qty->viewAttributes() ?>>
<?= $Page->qty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->actual->Visible) { // actual ?>
        <td data-name="actual"<?= $Page->actual->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_actual" class="el_transfer_bin_piece_actual">
<span<?= $Page->actual->viewAttributes() ?>>
<?= $Page->actual->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user"<?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_user" class="el_transfer_bin_piece_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_status" class="el_transfer_bin_piece_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_upload->Visible) { // date_upload ?>
        <td data-name="date_upload"<?= $Page->date_upload->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_date_upload" class="el_transfer_bin_piece_date_upload">
<span<?= $Page->date_upload->viewAttributes() ?>>
<?= $Page->date_upload->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
        <td data-name="date_confirmation"<?= $Page->date_confirmation->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_date_confirmation" class="el_transfer_bin_piece_date_confirmation">
<span<?= $Page->date_confirmation->viewAttributes() ?>>
<?= $Page->date_confirmation->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
        <td data-name="time_confirmation"<?= $Page->time_confirmation->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transfer_bin_piece_time_confirmation" class="el_transfer_bin_piece_time_confirmation">
<span<?= $Page->time_confirmation->viewAttributes() ?>>
<?= $Page->time_confirmation->getViewValue() ?></span>
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
    ew.addEventHandlers("transfer_bin_piece");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PutawayStaging4List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { putaway_staging4: currentTable } });
var currentForm, currentPageID;
var fputaway_staging4list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fputaway_staging4list = new ew.Form("fputaway_staging4list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fputaway_staging4list;
    fputaway_staging4list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fputaway_staging4list");
});
var fputaway_staging4srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fputaway_staging4srch = new ew.Form("fputaway_staging4srch", "list");
    currentSearchForm = fputaway_staging4srch;

    // Dynamic selection lists

    // Filters
    fputaway_staging4srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fputaway_staging4srch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    // Write your table-specific client script here, no need to add script tags.
    	$(document).ready(function() {
    		$(".ew-toolbar").hide();
    		$(".ewShowAll").hide();
    		$(".ew-pager").hide();
    		$(".ew-basic-search-type").hide();
    		$(".ew-dropdown-toggle-split").hide();
    		$(document).on('focus','input[type=search]',function(){
    			this.select();
    			this.val("");
    			});
    		});
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
<form name="fputaway_staging4srch" id="fputaway_staging4srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fputaway_staging4srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="putaway_staging4">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fputaway_staging4srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fputaway_staging4srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fputaway_staging4srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fputaway_staging4srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> putaway_staging4">
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
<form name="fputaway_staging4list" id="fputaway_staging4list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="putaway_staging4">
<div id="gmp_putaway_staging4" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_putaway_staging4list" class="table table-bordered table-hover table-sm ew-table d-none"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left", "", "block", $Page->TableVar, "putaway_staging4list");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_id" class="putaway_staging4_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th data-name="store_name" class="<?= $Page->store_name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_store_name" class="putaway_staging4_store_name"><?= $Page->renderFieldHeader($Page->store_name) ?></div></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th data-name="store_code" class="<?= $Page->store_code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_store_code" class="putaway_staging4_store_code"><?= $Page->renderFieldHeader($Page->store_code) ?></div></th>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
        <th data-name="line" class="<?= $Page->line->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_line" class="putaway_staging4_line"><?= $Page->renderFieldHeader($Page->line) ?></div></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th data-name="box_id" class="<?= $Page->box_id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_box_id" class="putaway_staging4_box_id"><?= $Page->renderFieldHeader($Page->box_id) ?></div></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th data-name="concept" class="<?= $Page->concept->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_concept" class="putaway_staging4_concept"><?= $Page->renderFieldHeader($Page->concept) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_type" class="putaway_staging4_type"><?= $Page->renderFieldHeader($Page->type) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_quantity" class="putaway_staging4_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_status" class="putaway_staging4_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
        <th data-name="users" class="<?= $Page->users->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_users" class="putaway_staging4_users"><?= $Page->renderFieldHeader($Page->users) ?></div></th>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
        <th data-name="picking_date" class="<?= $Page->picking_date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_putaway_staging4_picking_date" class="putaway_staging4_picking_date"><?= $Page->renderFieldHeader($Page->picking_date) ?></div></th>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
        <th data-name="date_staging" class="<?= $Page->date_staging->headerCellClass() ?>"><div id="elh_putaway_staging4_date_staging" class="putaway_staging4_date_staging"><?= $Page->renderFieldHeader($Page->date_staging) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right", "", "block", $Page->TableVar, "putaway_staging4list");
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
            "id" => "r" . $Page->RowCount . "_putaway_staging4",
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

        // Save row and cell attributes
        $Page->Attrs[$Page->RowCount] = ["row_attrs" => $Page->rowAttributes(), "cell_attrs" => []];
        $Page->Attrs[$Page->RowCount]["cell_attrs"] = $Page->fieldCellAttributes();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount, "block", $Page->TableVar, "putaway_staging4list");
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_id"><span id="el<?= $Page->RowCount ?>_putaway_staging4_id" class="el_putaway_staging4_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->store_name->Visible) { // store_name ?>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_store_name"><span id="el<?= $Page->RowCount ?>_putaway_staging4_store_name" class="el_putaway_staging4_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->store_code->Visible) { // store_code ?>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_store_code"><span id="el<?= $Page->RowCount ?>_putaway_staging4_store_code" class="el_putaway_staging4_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->line->Visible) { // line ?>
        <td data-name="line"<?= $Page->line->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_line"><span id="el<?= $Page->RowCount ?>_putaway_staging4_line" class="el_putaway_staging4_line">
<span<?= $Page->line->viewAttributes() ?>>
<?= $Page->line->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->box_id->Visible) { // box_id ?>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_box_id"><span id="el<?= $Page->RowCount ?>_putaway_staging4_box_id" class="el_putaway_staging4_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->concept->Visible) { // concept ?>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_concept"><span id="el<?= $Page->RowCount ?>_putaway_staging4_concept" class="el_putaway_staging4_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_type"><span id="el<?= $Page->RowCount ?>_putaway_staging4_type" class="el_putaway_staging4_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_quantity"><span id="el<?= $Page->RowCount ?>_putaway_staging4_quantity" class="el_putaway_staging4_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_status"><span id="el<?= $Page->RowCount ?>_putaway_staging4_status" class="el_putaway_staging4_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->users->Visible) { // users ?>
        <td data-name="users"<?= $Page->users->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_users"><span id="el<?= $Page->RowCount ?>_putaway_staging4_users" class="el_putaway_staging4_users">
<span<?= $Page->users->viewAttributes() ?>>
<?= $Page->users->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->picking_date->Visible) { // picking_date ?>
        <td data-name="picking_date"<?= $Page->picking_date->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_picking_date"><span id="el<?= $Page->RowCount ?>_putaway_staging4_picking_date" class="el_putaway_staging4_picking_date">
<span<?= $Page->picking_date->viewAttributes() ?>>
<?= $Page->picking_date->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->date_staging->Visible) { // date_staging ?>
        <td data-name="date_staging"<?= $Page->date_staging->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_putaway_staging4_date_staging"><span id="el<?= $Page->RowCount ?>_putaway_staging4_date_staging" class="el_putaway_staging4_date_staging">
<span<?= $Page->date_staging->viewAttributes() ?>>
<?= $Page->date_staging->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount, "block", $Page->TableVar, "putaway_staging4list");
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
<div id="tpd_putaway_staging4list" class="ew-custom-template"></div>
<template id="tpm_putaway_staging4list">
<div id="ct_PutawayStaging4List"><?php if ($Page->RowCount > 0) { ?>
<?php for ($i = $Page->StartRowCount; $i <= $Page->RowCount; $i++) { ?>
<style>
    .main-frame {
        display: flex ;
        justify-content: center;
        align-items: left;
        box-sizing: border-box;
    }
    .main-form {
        border: solid 2px !important;
        padding: 15px !important;
        width: 380px !important;
        height: 150px !important;
        border-radius: 10px !important;
        margin: 20px 20px 20px !important;
    }
    .main-form2 {
        border: solid 2px !important;
        padding: 15px !important;
        width: 380px !important;
        height: 195px !important;
        border-radius: 10px !important;
        margin: 20px 20px 20px !important;
    }
    .formbuilder-item {
        margin-bottom: 10px;
    }
    input {
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    .card-body {
        -ms-flex: 1 1 auto !important;
        flex: 1 1 auto !important;
        padding: 8px;
        position: relative !important;
        box-sizing: border-box !important;
        justify-content: center !important;
    }
    .card {
        position: relative !important;
        display: -ms-flexbox !important;
        display: flex;
        -ms-flex-direction: column !important;
        flex-direction: column !important;
        min-width: 0 !important;
        word-wrap: break-word !important;
        background-color: rgb(253, 254, 255) !important;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125) !important;
        border-radius: .25rem !important;
        margin-bottom: 15px !important;
    }
    .text-value{
        font-size: 2.5rem;
        width:100% !important;
        text-align:center !important;
    }
    .text-value2{
        font-size: 1.4rem;
    }
    #card-body-color1 {
        background-color: cyan;
    }
     #card-body-color2 {
        background-color: yellow;
    }
    button {
        display: flex;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
</style>
    <div class="main-frame">
        <form id="rendered-form" class="main-form">
            <div class="rendered-form">
                <div class="card card-bg-warning">
                    <div class="card-body" id ="card-body-color1">
                        <div class="formbuilder-item">
                            <h2 class="Location" id="control-225011">No Box : </h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value" id="control-225011"><slot class="ew-slot" name="tpx<?= $i ?>_putaway_staging4_box_id"></slot></h2>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="main-frame">
        <form id="rendered-form" class="main-form2">
            <div class="rendered-form">
                <div class="card card-bg-warning">
                    <div class="card-body" id ="card-body-color2">
                        <div class="formbuilder-item">
                            <h2 class="Location" id="control-225011">Detail : </h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value2" id="control-225011">Type&nbsp;&nbsp;&nbsp;:<slot class="ew-slot" name="tpx<?= $i ?>_putaway_staging4_type"></slot></h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value2" id="control-225011">Store&nbsp;&nbsp;:<slot class="ew-slot" name="tpx<?= $i ?>_putaway_staging4_store_code"></slot></h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value2" id="control-225011">Qty&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<slot class="ew-slot" name="tpx<?= $i ?>_putaway_staging4_quantity"></slot></h2>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php } ?>
<?php } ?>
</div>
</template>
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
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_putaway_staging4list", "tpm_putaway_staging4list", "putaway_staging4list", "<?= $Page->CustomExport ?>", ew.templateData);
    loadjs.done("customtemplate");
});
</script>
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
    ew.addEventHandlers("putaway_staging4");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function() {
    	$(document).on('focus','input[type=search]',function(){
    		this.select();
    		this.val("");
    		this.focus();
    		});
    	});
});
</script>
<?php } ?>

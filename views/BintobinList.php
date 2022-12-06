<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BinToBinList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bin_to_bin: currentTable } });
var currentForm, currentPageID;
var fbin_to_binlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbin_to_binlist = new ew.Form("fbin_to_binlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fbin_to_binlist;
    fbin_to_binlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fbin_to_binlist");
});
var fbin_to_binsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fbin_to_binsrch = new ew.Form("fbin_to_binsrch", "list");
    currentSearchForm = fbin_to_binsrch;

    // Dynamic selection lists

    // Filters
    fbin_to_binsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbin_to_binsrch");
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
    		$(document).on('focus','input[type=search]',function(){ this.select(); });
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
<form name="fbin_to_binsrch" id="fbin_to_binsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbin_to_binsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bin_to_bin">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbin_to_binsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbin_to_binsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbin_to_binsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbin_to_binsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bin_to_bin">
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
<form name="fbin_to_binlist" id="fbin_to_binlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bin_to_bin">
<div id="gmp_bin_to_bin" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_bin_to_binlist" class="table table-bordered table-hover table-sm ew-table d-none"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left", "", "block", $Page->TableVar, "bin_to_binlist");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_id" class="bin_to_bin_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->from_bin->Visible) { // from_bin ?>
        <th data-name="from_bin" class="<?= $Page->from_bin->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_from_bin" class="bin_to_bin_from_bin"><?= $Page->renderFieldHeader($Page->from_bin) ?></div></th>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
        <th data-name="ctn" class="<?= $Page->ctn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_ctn" class="bin_to_bin_ctn"><?= $Page->renderFieldHeader($Page->ctn) ?></div></th>
<?php } ?>
<?php if ($Page->to_bin->Visible) { // to_bin ?>
        <th data-name="to_bin" class="<?= $Page->to_bin->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_to_bin" class="bin_to_bin_to_bin"><?= $Page->renderFieldHeader($Page->to_bin) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_date_created" class="bin_to_bin_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_date_updated" class="bin_to_bin_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->time_updated->Visible) { // time_updated ?>
        <th data-name="time_updated" class="<?= $Page->time_updated->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_bin_to_bin_time_updated" class="bin_to_bin_time_updated"><?= $Page->renderFieldHeader($Page->time_updated) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right", "", "block", $Page->TableVar, "bin_to_binlist");
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
            "id" => "r" . $Page->RowCount . "_bin_to_bin",
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
$Page->ListOptions->render("body", "left", $Page->RowCount, "block", $Page->TableVar, "bin_to_binlist");
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_id"><span id="el<?= $Page->RowCount ?>_bin_to_bin_id" class="el_bin_to_bin_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->from_bin->Visible) { // from_bin ?>
        <td data-name="from_bin"<?= $Page->from_bin->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_from_bin"><span id="el<?= $Page->RowCount ?>_bin_to_bin_from_bin" class="el_bin_to_bin_from_bin">
<span<?= $Page->from_bin->viewAttributes() ?>>
<?= $Page->from_bin->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->ctn->Visible) { // ctn ?>
        <td data-name="ctn"<?= $Page->ctn->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_ctn"><span id="el<?= $Page->RowCount ?>_bin_to_bin_ctn" class="el_bin_to_bin_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<?= $Page->ctn->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->to_bin->Visible) { // to_bin ?>
        <td data-name="to_bin"<?= $Page->to_bin->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_to_bin"><span id="el<?= $Page->RowCount ?>_bin_to_bin_to_bin" class="el_bin_to_bin_to_bin">
<span<?= $Page->to_bin->viewAttributes() ?>>
<?= $Page->to_bin->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_date_created"><span id="el<?= $Page->RowCount ?>_bin_to_bin_date_created" class="el_bin_to_bin_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_date_updated"><span id="el<?= $Page->RowCount ?>_bin_to_bin_date_updated" class="el_bin_to_bin_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->time_updated->Visible) { // time_updated ?>
        <td data-name="time_updated"<?= $Page->time_updated->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bin_to_bin_time_updated"><span id="el<?= $Page->RowCount ?>_bin_to_bin_time_updated" class="el_bin_to_bin_time_updated">
<span<?= $Page->time_updated->viewAttributes() ?>>
<?= $Page->time_updated->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount, "block", $Page->TableVar, "bin_to_binlist");
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
<div id="tpd_bin_to_binlist" class="ew-custom-template"></div>
<template id="tpm_bin_to_binlist">
<div id="ct_BinToBinList"><?php if ($Page->RowCount > 0) { ?>
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
        height: 190px !important;
        border-radius: 10px !important;
        margin: 20px 20px 20px !important;
    }
    .main-form2 {
        border: solid 2px !important;
        padding: 15px !important;
        width: 380px !important;
        height: 145px !important;
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
        font-size: 1.8rem;
        width:100% !important;
    }
    .text-value2{
        font-size: 1.8rem;
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
                            <h2 class="Location" id="control-225011">From : </h2>
                        </div>
                        <div class="formbuilder-item" hidden>
                            <h2 class="text-value" id="control-225011"><slot class="ew-slot" name="tpx<?= $i ?>_bin_to_bin_id"></slot></h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value" id="control-225011">Loc : <slot class="ew-slot" name="tpx<?= $i ?>_bin_to_bin_from_bin"></slot></h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value" id="control-225011">Ctn : <slot class="ew-slot" name="tpx<?= $i ?>_bin_to_bin_ctn"></slot></h2>
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
                            <h2 class="Location" id="control-225011">To : </h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value2" id="control-225011">Loc :<slot class="ew-slot" name="tpx<?= $i ?>_bin_to_bin_to_bin"></slot></h2>
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
    ew.applyTemplate("tpd_bin_to_binlist", "tpm_bin_to_binlist", "bin_to_binlist", "<?= $Page->CustomExport ?>", ew.templateData);
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
    ew.addEventHandlers("bin_to_bin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function() {
    	$(document).on('focus','input[type=search]',function(){
    		this.select();
    		this.focus();
    		});
    	});
});
</script>
<?php } ?>

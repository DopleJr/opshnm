<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BintobinList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bintobin: currentTable } });
var currentForm, currentPageID;
var fbintobinlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbintobinlist = new ew.Form("fbintobinlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fbintobinlist;
    fbintobinlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fbintobinlist");
});
var fbintobinsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fbintobinsrch = new ew.Form("fbintobinsrch", "list");
    currentSearchForm = fbintobinsrch;

    // Dynamic selection lists

    // Filters
    fbintobinsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbintobinsrch");
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
    	});
        $(function(){
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
<form name="fbintobinsrch" id="fbintobinsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbintobinsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bintobin">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbintobinsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbintobinsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbintobinsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbintobinsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bintobin">
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
<form name="fbintobinlist" id="fbintobinlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bintobin">
<div id="gmp_bintobin" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_bintobinlist" class="table table-bordered table-hover table-sm ew-table d-none"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left", "", "block", $Page->TableVar, "bintobinlist");
?>
<?php if ($Page->FromBin->Visible) { // From Bin ?>
        <th data-name="FromBin" class="<?= $Page->FromBin->headerCellClass() ?>"><div id="elh_bintobin_FromBin" class="bintobin_FromBin"><?= $Page->renderFieldHeader($Page->FromBin) ?></div></th>
<?php } ?>
<?php if ($Page->ToBin->Visible) { // To Bin ?>
        <th data-name="ToBin" class="<?= $Page->ToBin->headerCellClass() ?>"><div id="elh_bintobin_ToBin" class="bintobin_ToBin"><?= $Page->renderFieldHeader($Page->ToBin) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right", "", "block", $Page->TableVar, "bintobinlist");
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
            "id" => "r" . $Page->RowCount . "_bintobin",
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
$Page->ListOptions->render("body", "left", $Page->RowCount, "block", $Page->TableVar, "bintobinlist");
?>
    <?php if ($Page->FromBin->Visible) { // From Bin ?>
        <td data-name="FromBin"<?= $Page->FromBin->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bintobin_FromBin"><span id="el<?= $Page->RowCount ?>_bintobin_FromBin" class="el_bintobin_FromBin">
<span<?= $Page->FromBin->viewAttributes() ?>>
<?= $Page->FromBin->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
    <?php if ($Page->ToBin->Visible) { // To Bin ?>
        <td data-name="ToBin"<?= $Page->ToBin->cellAttributes() ?>>
<template id="tpx<?= $Page->RowCount ?>_bintobin_ToBin"><span id="el<?= $Page->RowCount ?>_bintobin_ToBin" class="el_bintobin_ToBin">
<span<?= $Page->ToBin->viewAttributes() ?>>
<?= $Page->ToBin->getViewValue() ?></span>
</span></template>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount, "block", $Page->TableVar, "bintobinlist");
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
<div id="tpd_bintobinlist" class="ew-custom-template"></div>
<template id="tpm_bintobinlist">
<div id="ct_BintobinList"><?php if ($Page->RowCount > 0) { ?>
<?php for ($i = $Page->StartRowCount; $i <= $Page->RowCount; $i++) { ?>
<style>
    .main-frame {
        display: flex ;
        justify-content: center;
        align-items: upper;
        box-sizing: border-box;
    }
    .main-form {
        border: solid 2px;
        padding: 15px;
        width: 350px;
        height: 170px;
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
        font-size: 2.8rem;
    }
    #card-body-color1 {
        background-color: cyan;
    }
     #card-body-color2 {
        background-color: yellow;
    }
    button {
        display: block;
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
                        <div class="formbuilder-item">
                            <h2 class="text-value" id="control-225011"><slot class="ew-slot" name="tpx<?= $i ?>_bintobin_FromBin"></slot></h2>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="main-frame">
        <form id="rendered-form" class="main-form">
            <div class="rendered-form">
                <div class="card card-bg-warning">
                    <div class="card-body" id ="card-body-color2">
                        <div class="formbuilder-item">
                            <h2 class="Location" id="control-225011">To : </h2>
                        </div>
                        <div class="formbuilder-item">
                            <h2 class="text-value" id="control-225011"><slot class="ew-slot" name="tpx<?= $i ?>_bintobin_ToBin"></slot></h2>
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
    ew.applyTemplate("tpd_bintobinlist", "tpm_bintobinlist", "bintobinlist", "<?= $Page->CustomExport ?>", ew.templateData);
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
    ew.addEventHandlers("bintobin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CheckingVasAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { checking_vas: currentTable } });
var currentForm, currentPageID;
var fchecking_vasadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fchecking_vasadd = new ew.Form("fchecking_vasadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fchecking_vasadd;

    // Add fields
    var fields = currentTable.fields;
    fchecking_vasadd.addFields([
        ["filter_shipment", [fields.filter_shipment.visible && fields.filter_shipment.required ? ew.Validators.required(fields.filter_shipment.caption) : null], fields.filter_shipment.isInvalid],
        ["order", [fields.order.visible && fields.order.required ? ew.Validators.required(fields.order.caption) : null], fields.order.isInvalid],
        ["po", [fields.po.visible && fields.po.required ? ew.Validators.required(fields.po.caption) : null], fields.po.isInvalid],
        ["sap_art", [fields.sap_art.visible && fields.sap_art.required ? ew.Validators.required(fields.sap_art.caption) : null], fields.sap_art.isInvalid],
        ["sub_index", [fields.sub_index.visible && fields.sub_index.required ? ew.Validators.required(fields.sub_index.caption) : null], fields.sub_index.isInvalid],
        ["concept", [fields.concept.visible && fields.concept.required ? ew.Validators.required(fields.concept.caption) : null], fields.concept.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null, ew.Validators.integer], fields.ctn.isInvalid],
        ["season2", [fields.season2.visible && fields.season2.required ? ew.Validators.required(fields.season2.caption) : null], fields.season2.isInvalid],
        ["qty_oss", [fields.qty_oss.visible && fields.qty_oss.required ? ew.Validators.required(fields.qty_oss.caption) : null, ew.Validators.integer], fields.qty_oss.isInvalid],
        ["shipment", [fields.shipment.visible && fields.shipment.required ? ew.Validators.required(fields.shipment.caption) : null], fields.shipment.isInvalid],
        ["aju", [fields.aju.visible && fields.aju.required ? ew.Validators.required(fields.aju.caption) : null], fields.aju.isInvalid],
        ["snow", [fields.snow.visible && fields.snow.required ? ew.Validators.required(fields.snow.caption) : null], fields.snow.isInvalid],
        ["actual_price", [fields.actual_price.visible && fields.actual_price.required ? ew.Validators.required(fields.actual_price.caption) : null], fields.actual_price.isInvalid],
        ["price_foto", [fields.price_foto.visible && fields.price_foto.required ? ew.Validators.fileRequired(fields.price_foto.caption) : null], fields.price_foto.isInvalid],
        ["remarks", [fields.remarks.visible && fields.remarks.required ? ew.Validators.required(fields.remarks.caption) : null], fields.remarks.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["date_update", [fields.date_update.visible && fields.date_update.required ? ew.Validators.required(fields.date_update.caption) : null], fields.date_update.isInvalid],
        ["time_update", [fields.time_update.visible && fields.time_update.required ? ew.Validators.required(fields.time_update.caption) : null], fields.time_update.isInvalid]
    ]);

    // Form_CustomValidate
    fchecking_vasadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fchecking_vasadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fchecking_vasadd.lists.filter_shipment = <?= $Page->filter_shipment->toClientList($Page) ?>;
    fchecking_vasadd.lists.order = <?= $Page->order->toClientList($Page) ?>;
    fchecking_vasadd.lists.sap_art = <?= $Page->sap_art->toClientList($Page) ?>;
    fchecking_vasadd.lists.sub_index = <?= $Page->sub_index->toClientList($Page) ?>;
    fchecking_vasadd.lists.concept = <?= $Page->concept->toClientList($Page) ?>;
    loadjs.done("fchecking_vasadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fchecking_vasadd" id="fchecking_vasadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="checking_vas">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->filter_shipment->Visible) { // filter_shipment ?>
    <div id="r_filter_shipment"<?= $Page->filter_shipment->rowAttributes() ?>>
        <label id="elh_checking_vas_filter_shipment" for="x_filter_shipment" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_filter_shipment"><?= $Page->filter_shipment->caption() ?><?= $Page->filter_shipment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->filter_shipment->cellAttributes() ?>>
<template id="tpx_checking_vas_filter_shipment"><span id="el_checking_vas_filter_shipment">
<?php $Page->filter_shipment->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_filter_shipment[]"
        name="x_filter_shipment[]"
        class="form-select ew-select<?= $Page->filter_shipment->isInvalidClass() ?>"
        data-select2-id="fchecking_vasadd_x_filter_shipment[]"
        data-table="checking_vas"
        data-field="x_filter_shipment"
        multiple
        size="1"
        data-value-separator="<?= $Page->filter_shipment->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->filter_shipment->getPlaceHolder()) ?>"
        <?= $Page->filter_shipment->editAttributes() ?>>
        <?= $Page->filter_shipment->selectOptionListHtml("x_filter_shipment[]") ?>
    </select>
    <?= $Page->filter_shipment->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->filter_shipment->getErrorMessage() ?></div>
<?= $Page->filter_shipment->Lookup->getParamTag($Page, "p_x_filter_shipment") ?>
<script>
loadjs.ready("fchecking_vasadd", function() {
    var options = { name: "x_filter_shipment[]", selectId: "fchecking_vasadd_x_filter_shipment[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fchecking_vasadd.lists.filter_shipment.lookupOptions.length) {
        options.data = { id: "x_filter_shipment[]", form: "fchecking_vasadd" };
    } else {
        options.ajax = { id: "x_filter_shipment[]", form: "fchecking_vasadd", limit: 1000 };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.checking_vas.fields.filter_shipment.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
    <div id="r_order"<?= $Page->order->rowAttributes() ?>>
        <label id="elh_checking_vas_order" for="x_order" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_order"><?= $Page->order->caption() ?><?= $Page->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order->cellAttributes() ?>>
<template id="tpx_checking_vas_order"><span id="el_checking_vas_order">
<?php $Page->order->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_order[]"
        name="x_order[]"
        class="form-select ew-select<?= $Page->order->isInvalidClass() ?>"
        data-select2-id="fchecking_vasadd_x_order[]"
        data-table="checking_vas"
        data-field="x_order"
        multiple
        size="1"
        data-value-separator="<?= $Page->order->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->order->getPlaceHolder()) ?>"
        <?= $Page->order->editAttributes() ?>>
        <?= $Page->order->selectOptionListHtml("x_order[]") ?>
    </select>
    <?= $Page->order->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->order->getErrorMessage() ?></div>
<?= $Page->order->Lookup->getParamTag($Page, "p_x_order") ?>
<script>
loadjs.ready("fchecking_vasadd", function() {
    var options = { name: "x_order[]", selectId: "fchecking_vasadd_x_order[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fchecking_vasadd.lists.order.lookupOptions.length) {
        options.data = { id: "x_order[]", form: "fchecking_vasadd" };
    } else {
        options.ajax = { id: "x_order[]", form: "fchecking_vasadd", limit: 1000 };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.checking_vas.fields.order.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
    <div id="r_po"<?= $Page->po->rowAttributes() ?>>
        <label id="elh_checking_vas_po" for="x_po" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_po"><?= $Page->po->caption() ?><?= $Page->po->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->po->cellAttributes() ?>>
<template id="tpx_checking_vas_po"><span id="el_checking_vas_po">
<input type="<?= $Page->po->getInputTextType() ?>" name="x_po" id="x_po" data-table="checking_vas" data-field="x_po" value="<?= $Page->po->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->po->getPlaceHolder()) ?>"<?= $Page->po->editAttributes() ?> aria-describedby="x_po_help">
<?= $Page->po->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->po->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
    <div id="r_sap_art"<?= $Page->sap_art->rowAttributes() ?>>
        <label id="elh_checking_vas_sap_art" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_sap_art"><?= $Page->sap_art->caption() ?><?= $Page->sap_art->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sap_art->cellAttributes() ?>>
<template id="tpx_checking_vas_sap_art"><span id="el_checking_vas_sap_art">
<?php
$onchange = $Page->sap_art->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->sap_art->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->sap_art->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_sap_art" class="ew-auto-suggest">
    <input type="<?= $Page->sap_art->getInputTextType() ?>" class="form-control" name="sv_x_sap_art" id="sv_x_sap_art" value="<?= RemoveHtml($Page->sap_art->EditValue) ?>" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->sap_art->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->sap_art->getPlaceHolder()) ?>"<?= $Page->sap_art->editAttributes() ?> aria-describedby="x_sap_art_help">
</span>
<selection-list hidden class="form-control" data-table="checking_vas" data-field="x_sap_art" data-input="sv_x_sap_art" data-value-separator="<?= $Page->sap_art->displayValueSeparatorAttribute() ?>" name="x_sap_art" id="x_sap_art" value="<?= HtmlEncode($Page->sap_art->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->sap_art->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sap_art->getErrorMessage() ?></div>
<script>
loadjs.ready("fchecking_vasadd", function() {
    fchecking_vasadd.createAutoSuggest(Object.assign({"id":"x_sap_art","forceSelect":true}, ew.vars.tables.checking_vas.fields.sap_art.autoSuggestOptions));
});
</script>
<?= $Page->sap_art->Lookup->getParamTag($Page, "p_x_sap_art") ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
    <div id="r_sub_index"<?= $Page->sub_index->rowAttributes() ?>>
        <label id="elh_checking_vas_sub_index" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_sub_index"><?= $Page->sub_index->caption() ?><?= $Page->sub_index->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sub_index->cellAttributes() ?>>
<template id="tpx_checking_vas_sub_index"><span id="el_checking_vas_sub_index">
<?php
$onchange = $Page->sub_index->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->sub_index->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->sub_index->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_sub_index" class="ew-auto-suggest">
    <input type="<?= $Page->sub_index->getInputTextType() ?>" class="form-control" name="sv_x_sub_index" id="sv_x_sub_index" value="<?= RemoveHtml($Page->sub_index->EditValue) ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->sub_index->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->sub_index->getPlaceHolder()) ?>"<?= $Page->sub_index->editAttributes() ?> aria-describedby="x_sub_index_help">
</span>
<selection-list hidden class="form-control" data-table="checking_vas" data-field="x_sub_index" data-input="sv_x_sub_index" data-value-separator="<?= $Page->sub_index->displayValueSeparatorAttribute() ?>" name="x_sub_index" id="x_sub_index" value="<?= HtmlEncode($Page->sub_index->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->sub_index->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sub_index->getErrorMessage() ?></div>
<script>
loadjs.ready("fchecking_vasadd", function() {
    fchecking_vasadd.createAutoSuggest(Object.assign({"id":"x_sub_index","forceSelect":false}, ew.vars.tables.checking_vas.fields.sub_index.autoSuggestOptions));
});
</script>
<?= $Page->sub_index->Lookup->getParamTag($Page, "p_x_sub_index") ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_checking_vas_concept" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_concept"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<template id="tpx_checking_vas_concept"><span id="el_checking_vas_concept">
<?php
$onchange = $Page->concept->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->concept->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->concept->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_concept" class="ew-auto-suggest">
    <input type="<?= $Page->concept->getInputTextType() ?>" class="form-control" name="sv_x_concept" id="sv_x_concept" value="<?= RemoveHtml($Page->concept->EditValue) ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
</span>
<selection-list hidden class="form-control" data-table="checking_vas" data-field="x_concept" data-input="sv_x_concept" data-value-separator="<?= $Page->concept->displayValueSeparatorAttribute() ?>" name="x_concept" id="x_concept" value="<?= HtmlEncode($Page->concept->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
<script>
loadjs.ready("fchecking_vasadd", function() {
    fchecking_vasadd.createAutoSuggest(Object.assign({"id":"x_concept","forceSelect":false}, ew.vars.tables.checking_vas.fields.concept.autoSuggestOptions));
});
</script>
<?= $Page->concept->Lookup->getParamTag($Page, "p_x_concept") ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_checking_vas_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_ctn"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<template id="tpx_checking_vas_ctn"><span id="el_checking_vas_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="checking_vas" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
    <div id="r_season2"<?= $Page->season2->rowAttributes() ?>>
        <label id="elh_checking_vas_season2" for="x_season2" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_season2"><?= $Page->season2->caption() ?><?= $Page->season2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->season2->cellAttributes() ?>>
<template id="tpx_checking_vas_season2"><span id="el_checking_vas_season2">
<input type="<?= $Page->season2->getInputTextType() ?>" name="x_season2" id="x_season2" data-table="checking_vas" data-field="x_season2" value="<?= $Page->season2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->season2->getPlaceHolder()) ?>"<?= $Page->season2->editAttributes() ?> aria-describedby="x_season2_help">
<?= $Page->season2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->season2->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
    <div id="r_qty_oss"<?= $Page->qty_oss->rowAttributes() ?>>
        <label id="elh_checking_vas_qty_oss" for="x_qty_oss" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_qty_oss"><?= $Page->qty_oss->caption() ?><?= $Page->qty_oss->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->qty_oss->cellAttributes() ?>>
<template id="tpx_checking_vas_qty_oss"><span id="el_checking_vas_qty_oss">
<input type="<?= $Page->qty_oss->getInputTextType() ?>" name="x_qty_oss" id="x_qty_oss" data-table="checking_vas" data-field="x_qty_oss" value="<?= $Page->qty_oss->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->qty_oss->getPlaceHolder()) ?>"<?= $Page->qty_oss->editAttributes() ?> aria-describedby="x_qty_oss_help">
<?= $Page->qty_oss->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->qty_oss->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
    <div id="r_shipment"<?= $Page->shipment->rowAttributes() ?>>
        <label id="elh_checking_vas_shipment" for="x_shipment" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_shipment"><?= $Page->shipment->caption() ?><?= $Page->shipment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipment->cellAttributes() ?>>
<template id="tpx_checking_vas_shipment"><span id="el_checking_vas_shipment">
<input type="<?= $Page->shipment->getInputTextType() ?>" name="x_shipment" id="x_shipment" data-table="checking_vas" data-field="x_shipment" value="<?= $Page->shipment->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->shipment->getPlaceHolder()) ?>"<?= $Page->shipment->editAttributes() ?> aria-describedby="x_shipment_help">
<?= $Page->shipment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shipment->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
    <div id="r_aju"<?= $Page->aju->rowAttributes() ?>>
        <label id="elh_checking_vas_aju" for="x_aju" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_aju"><?= $Page->aju->caption() ?><?= $Page->aju->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aju->cellAttributes() ?>>
<template id="tpx_checking_vas_aju"><span id="el_checking_vas_aju">
<input type="<?= $Page->aju->getInputTextType() ?>" name="x_aju" id="x_aju" data-table="checking_vas" data-field="x_aju" value="<?= $Page->aju->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aju->getPlaceHolder()) ?>"<?= $Page->aju->editAttributes() ?> aria-describedby="x_aju_help">
<?= $Page->aju->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aju->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
    <div id="r_snow"<?= $Page->snow->rowAttributes() ?>>
        <label id="elh_checking_vas_snow" for="x_snow" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_snow"><?= $Page->snow->caption() ?><?= $Page->snow->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->snow->cellAttributes() ?>>
<template id="tpx_checking_vas_snow"><span id="el_checking_vas_snow">
<input type="<?= $Page->snow->getInputTextType() ?>" name="x_snow" id="x_snow" data-table="checking_vas" data-field="x_snow" value="<?= $Page->snow->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->snow->getPlaceHolder()) ?>"<?= $Page->snow->editAttributes() ?> aria-describedby="x_snow_help">
<?= $Page->snow->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->snow->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
    <div id="r_actual_price"<?= $Page->actual_price->rowAttributes() ?>>
        <label id="elh_checking_vas_actual_price" for="x_actual_price" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_actual_price"><?= $Page->actual_price->caption() ?><?= $Page->actual_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->actual_price->cellAttributes() ?>>
<template id="tpx_checking_vas_actual_price"><span id="el_checking_vas_actual_price">
<input type="<?= $Page->actual_price->getInputTextType() ?>" name="x_actual_price" id="x_actual_price" data-table="checking_vas" data-field="x_actual_price" value="<?= $Page->actual_price->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->actual_price->getPlaceHolder()) ?>"<?= $Page->actual_price->editAttributes() ?> aria-describedby="x_actual_price_help">
<?= $Page->actual_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->actual_price->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
    <div id="r_price_foto"<?= $Page->price_foto->rowAttributes() ?>>
        <label id="elh_checking_vas_price_foto" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_price_foto"><?= $Page->price_foto->caption() ?><?= $Page->price_foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->price_foto->cellAttributes() ?>>
<template id="tpx_checking_vas_price_foto"><span id="el_checking_vas_price_foto">
<div id="fd_x_price_foto" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->price_foto->title() ?>" data-table="checking_vas" data-field="x_price_foto" name="x_price_foto" id="x_price_foto" lang="<?= CurrentLanguageID() ?>"<?= $Page->price_foto->editAttributes() ?> aria-describedby="x_price_foto_help"<?= ($Page->price_foto->ReadOnly || $Page->price_foto->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->price_foto->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->price_foto->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_price_foto" id= "fn_x_price_foto" value="<?= $Page->price_foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_price_foto" id= "fa_x_price_foto" value="0">
<input type="hidden" name="fs_x_price_foto" id= "fs_x_price_foto" value="255">
<input type="hidden" name="fx_x_price_foto" id= "fx_x_price_foto" value="<?= $Page->price_foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_price_foto" id= "fm_x_price_foto" value="<?= $Page->price_foto->UploadMaxFileSize ?>">
<table id="ft_x_price_foto" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <div id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <label id="elh_checking_vas_remarks" for="x_remarks" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_remarks"><?= $Page->remarks->caption() ?><?= $Page->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks->cellAttributes() ?>>
<template id="tpx_checking_vas_remarks"><span id="el_checking_vas_remarks">
<input type="<?= $Page->remarks->getInputTextType() ?>" name="x_remarks" id="x_remarks" data-table="checking_vas" data-field="x_remarks" value="<?= $Page->remarks->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"<?= $Page->remarks->editAttributes() ?> aria-describedby="x_remarks_help">
<?= $Page->remarks->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remarks->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_checking_vas_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_checking_vas_date_upload"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<template id="tpx_checking_vas_date_upload"><span id="el_checking_vas_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="checking_vas" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fchecking_vasadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fchecking_vasadd", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_checking_vasadd" class="ew-custom-template"></div>
<template id="tpm_checking_vasadd">
<div id="ct_CheckingVasAdd">	<div id="r_filter_shipment" class="mb-3 row">
        <label for="x_filter_shipment" class="col-sm-2 col-form-label"><?= $Page->filter_shipment->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_filter_shipment"></slot></div>
    </div>
    <div id="r_order" class="mb-3 row">
        <label for="x_order" class="col-sm-2 col-form-label"><?= $Page->order->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_order"></slot></div>
    </div>
    <div id="r_po" class="mb-3 row" hidden>
        <label for="x_po" class="col-sm-2 col-form-label"><?= $Page->po->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_po"></slot></div>
    </div>
    <div id="r_sap_art" class="mb-3 row">
        <label for="x_sap_art" class="col-sm-2 col-form-label"><?= $Page->sap_art->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_sap_art"></slot></div>
    </div>
    <div id="r_sub_index" class="mb-3 row">
        <label for="x_sub_index" class="col-sm-2 col-form-label"><?= $Page->sub_index->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_sub_index"></slot></div>
    </div>
    <div id="r_concept" class="mb-3 row">
        <label for="x_concept" class="col-sm-2 col-form-label"><?= $Page->concept->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_concept"></slot></div>
    </div>
    <div id="r_ctn" class="mb-3 row" hidden>
        <label for="x_ctn" class="col-sm-2 col-form-label"><?= $Page->ctn->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_ctn"></slot></div>
    </div>
    <div id="r_qty_oss" class="mb-3 row" hidden>
        <label for="x_qty_oss" class="col-sm-2 col-form-label"><?= $Page->qty_oss->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_qty_oss"></slot></div>
    </div>
    <div id="r_shipment" class="mb-3 row" hidden>
        <label for="x_shipment" class="col-sm-2 col-form-label"><?= $Page->shipment->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_shipment"></slot></div>
    </div>
    <div id="r_aju" class="mb-3 row" hidden>
        <label for="x_aju" class="col-sm-2 col-form-label"><?= $Page->aju->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_aju"></slot></div>
    </div>
    <div id="r_season2" class="mb-3 row" >
        <label for="x_season2" class="col-sm-2 col-form-label"><?= $Page->season2->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_season2"></slot></div>
    </div>
    <div id="r_snow" class="mb-3 row">
        <label for="x_snow" class="col-sm-2 col-form-label"><?= $Page->snow->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_snow"></slot></div>
    </div>
    <div id="r_actual_price" class="mb-3 row">
        <label for="x_actual_price" class="col-sm-2 col-form-label"><?= $Page->actual_price->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_actual_price"></slot></div>
    </div>
    <div id="r_price_foto" class="mb-3 row" hidden>
        <label for="x_price_foto" class="col-sm-2 col-form-label"><?= $Page->price_foto->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_price_foto"></slot></div>
    </div>
    <div id="r_remarks" class="mb-3 row" hidden>
        <label for="x_remarks" class="col-sm-2 col-form-label"><?= $Page->remarks->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_remarks"></slot></div>
    </div>
    <div id="r_date_upload" class="mb-3 row" hidden>
        <label for="x_date_upload" class="col-sm-2 col-form-label"><?= $Page->date_upload->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_checking_vas_date_upload"></slot></div>
    </div>
</div>
</template>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_checking_vasadd", "tpm_checking_vasadd", "checking_vasadd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
    loadjs.done("customtemplate");
});
</script>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("checking_vas");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>

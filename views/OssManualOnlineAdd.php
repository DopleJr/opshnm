<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OssManualOnlineAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { oss_manual_online: currentTable } });
var currentForm, currentPageID;
var foss_manual_onlineadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    foss_manual_onlineadd = new ew.Form("foss_manual_onlineadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = foss_manual_onlineadd;

    // Add fields
    var fields = currentTable.fields;
    foss_manual_onlineadd.addFields([
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["sscc", [fields.sscc.visible && fields.sscc.required ? ew.Validators.required(fields.sscc.caption) : null], fields.sscc.isInvalid],
        ["order_no", [fields.order_no.visible && fields.order_no.required ? ew.Validators.required(fields.order_no.caption) : null, ew.Validators.integer], fields.order_no.isInvalid],
        ["shipment", [fields.shipment.visible && fields.shipment.required ? ew.Validators.required(fields.shipment.caption) : null], fields.shipment.isInvalid],
        ["pallet_no", [fields.pallet_no.visible && fields.pallet_no.required ? ew.Validators.required(fields.pallet_no.caption) : null], fields.pallet_no.isInvalid],
        ["idw", [fields.idw.visible && fields.idw.required ? ew.Validators.required(fields.idw.caption) : null, ew.Validators.integer], fields.idw.isInvalid],
        ["item_in_ctn", [fields.item_in_ctn.visible && fields.item_in_ctn.required ? ew.Validators.required(fields.item_in_ctn.caption) : null, ew.Validators.integer], fields.item_in_ctn.isInvalid],
        ["no_of_ctn", [fields.no_of_ctn.visible && fields.no_of_ctn.required ? ew.Validators.required(fields.no_of_ctn.caption) : null, ew.Validators.integer], fields.no_of_ctn.isInvalid],
        ["ctn_no", [fields.ctn_no.visible && fields.ctn_no.required ? ew.Validators.required(fields.ctn_no.caption) : null, ew.Validators.integer], fields.ctn_no.isInvalid],
        ["checker", [fields.checker.visible && fields.checker.required ? ew.Validators.required(fields.checker.caption) : null], fields.checker.isInvalid],
        ["shift", [fields.shift.visible && fields.shift.required ? ew.Validators.required(fields.shift.caption) : null], fields.shift.isInvalid]
    ]);

    // Form_CustomValidate
    foss_manual_onlineadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    foss_manual_onlineadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    foss_manual_onlineadd.lists.shift = <?= $Page->shift->toClientList($Page) ?>;
    loadjs.done("foss_manual_onlineadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    // Write your table-specific client script here, no need to add script tags.
    $(document).ready(function() {
    $(".input-group").hide();
    $(".text-muted").hide();
    $(".ew-breadcrumbs").hide();// atribut text
    $("#x_order_no").focus();
    $("#x_checker").attr('readonly', true);
    $("#x_shipment").attr('readonly', true);
    $("#x_pallet_no").attr('readonly', true);
    $("#x_idw").attr('readonly', true);
    $("#x_checker").attr('readonly', true);
    });
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="foss_manual_onlineadd" id="foss_manual_onlineadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="oss_manual_online">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_oss_manual_online_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_date"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<template id="tpx_oss_manual_online_date"><span id="el_oss_manual_online_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="oss_manual_online" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
    <div id="r_sscc"<?= $Page->sscc->rowAttributes() ?>>
        <label id="elh_oss_manual_online_sscc" for="x_sscc" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_sscc"><?= $Page->sscc->caption() ?><?= $Page->sscc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sscc->cellAttributes() ?>>
<template id="tpx_oss_manual_online_sscc"><span id="el_oss_manual_online_sscc">
<input type="<?= $Page->sscc->getInputTextType() ?>" name="x_sscc" id="x_sscc" data-table="oss_manual_online" data-field="x_sscc" value="<?= $Page->sscc->EditValue ?>" size="50" maxlength="255" placeholder="<?= HtmlEncode($Page->sscc->getPlaceHolder()) ?>"<?= $Page->sscc->editAttributes() ?> aria-describedby="x_sscc_help">
<?= $Page->sscc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sscc->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
    <div id="r_order_no"<?= $Page->order_no->rowAttributes() ?>>
        <label id="elh_oss_manual_online_order_no" for="x_order_no" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_order_no"><?= $Page->order_no->caption() ?><?= $Page->order_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_no->cellAttributes() ?>>
<template id="tpx_oss_manual_online_order_no"><span id="el_oss_manual_online_order_no">
<input type="<?= $Page->order_no->getInputTextType() ?>" name="x_order_no" id="x_order_no" data-table="oss_manual_online" data-field="x_order_no" value="<?= $Page->order_no->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->order_no->getPlaceHolder()) ?>"<?= $Page->order_no->editAttributes() ?> aria-describedby="x_order_no_help">
<?= $Page->order_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_no->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
    <div id="r_shipment"<?= $Page->shipment->rowAttributes() ?>>
        <label id="elh_oss_manual_online_shipment" for="x_shipment" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_shipment"><?= $Page->shipment->caption() ?><?= $Page->shipment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipment->cellAttributes() ?>>
<template id="tpx_oss_manual_online_shipment"><span id="el_oss_manual_online_shipment">
<input type="<?= $Page->shipment->getInputTextType() ?>" name="x_shipment" id="x_shipment" data-table="oss_manual_online" data-field="x_shipment" value="<?= $Page->shipment->EditValue ?>" size="20" maxlength="255" placeholder="<?= HtmlEncode($Page->shipment->getPlaceHolder()) ?>"<?= $Page->shipment->editAttributes() ?> aria-describedby="x_shipment_help">
<?= $Page->shipment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shipment->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
    <div id="r_pallet_no"<?= $Page->pallet_no->rowAttributes() ?>>
        <label id="elh_oss_manual_online_pallet_no" for="x_pallet_no" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_pallet_no"><?= $Page->pallet_no->caption() ?><?= $Page->pallet_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pallet_no->cellAttributes() ?>>
<template id="tpx_oss_manual_online_pallet_no"><span id="el_oss_manual_online_pallet_no">
<input type="<?= $Page->pallet_no->getInputTextType() ?>" name="x_pallet_no" id="x_pallet_no" data-table="oss_manual_online" data-field="x_pallet_no" value="<?= $Page->pallet_no->EditValue ?>" size="20" maxlength="255" placeholder="<?= HtmlEncode($Page->pallet_no->getPlaceHolder()) ?>"<?= $Page->pallet_no->editAttributes() ?> aria-describedby="x_pallet_no_help">
<?= $Page->pallet_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pallet_no->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
    <div id="r_idw"<?= $Page->idw->rowAttributes() ?>>
        <label id="elh_oss_manual_online_idw" for="x_idw" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_idw"><?= $Page->idw->caption() ?><?= $Page->idw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idw->cellAttributes() ?>>
<template id="tpx_oss_manual_online_idw"><span id="el_oss_manual_online_idw">
<input type="<?= $Page->idw->getInputTextType() ?>" name="x_idw" id="x_idw" data-table="oss_manual_online" data-field="x_idw" value="<?= $Page->idw->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->idw->getPlaceHolder()) ?>"<?= $Page->idw->editAttributes() ?> aria-describedby="x_idw_help">
<?= $Page->idw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idw->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
    <div id="r_item_in_ctn"<?= $Page->item_in_ctn->rowAttributes() ?>>
        <label id="elh_oss_manual_online_item_in_ctn" for="x_item_in_ctn" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_item_in_ctn"><?= $Page->item_in_ctn->caption() ?><?= $Page->item_in_ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_in_ctn->cellAttributes() ?>>
<template id="tpx_oss_manual_online_item_in_ctn"><span id="el_oss_manual_online_item_in_ctn">
<input type="<?= $Page->item_in_ctn->getInputTextType() ?>" name="x_item_in_ctn" id="x_item_in_ctn" data-table="oss_manual_online" data-field="x_item_in_ctn" value="<?= $Page->item_in_ctn->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->item_in_ctn->getPlaceHolder()) ?>"<?= $Page->item_in_ctn->editAttributes() ?> aria-describedby="x_item_in_ctn_help">
<?= $Page->item_in_ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->item_in_ctn->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
    <div id="r_no_of_ctn"<?= $Page->no_of_ctn->rowAttributes() ?>>
        <label id="elh_oss_manual_online_no_of_ctn" for="x_no_of_ctn" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_no_of_ctn"><?= $Page->no_of_ctn->caption() ?><?= $Page->no_of_ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_of_ctn->cellAttributes() ?>>
<template id="tpx_oss_manual_online_no_of_ctn"><span id="el_oss_manual_online_no_of_ctn">
<input type="<?= $Page->no_of_ctn->getInputTextType() ?>" name="x_no_of_ctn" id="x_no_of_ctn" data-table="oss_manual_online" data-field="x_no_of_ctn" value="<?= $Page->no_of_ctn->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_of_ctn->getPlaceHolder()) ?>"<?= $Page->no_of_ctn->editAttributes() ?> aria-describedby="x_no_of_ctn_help">
<?= $Page->no_of_ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_of_ctn->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
    <div id="r_ctn_no"<?= $Page->ctn_no->rowAttributes() ?>>
        <label id="elh_oss_manual_online_ctn_no" for="x_ctn_no" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_ctn_no"><?= $Page->ctn_no->caption() ?><?= $Page->ctn_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn_no->cellAttributes() ?>>
<template id="tpx_oss_manual_online_ctn_no"><span id="el_oss_manual_online_ctn_no">
<input type="<?= $Page->ctn_no->getInputTextType() ?>" name="x_ctn_no" id="x_ctn_no" data-table="oss_manual_online" data-field="x_ctn_no" value="<?= $Page->ctn_no->EditValue ?>" size="4" maxlength="4" placeholder="<?= HtmlEncode($Page->ctn_no->getPlaceHolder()) ?>"<?= $Page->ctn_no->editAttributes() ?> aria-describedby="x_ctn_no_help">
<?= $Page->ctn_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn_no->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <div id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <label id="elh_oss_manual_online_checker" for="x_checker" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_checker"><?= $Page->checker->caption() ?><?= $Page->checker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->checker->cellAttributes() ?>>
<template id="tpx_oss_manual_online_checker"><span id="el_oss_manual_online_checker">
<input type="<?= $Page->checker->getInputTextType() ?>" name="x_checker" id="x_checker" data-table="oss_manual_online" data-field="x_checker" value="<?= $Page->checker->EditValue ?>" size="20" maxlength="255" placeholder="<?= HtmlEncode($Page->checker->getPlaceHolder()) ?>"<?= $Page->checker->editAttributes() ?> aria-describedby="x_checker_help">
<?= $Page->checker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->checker->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
    <div id="r_shift"<?= $Page->shift->rowAttributes() ?>>
        <label id="elh_oss_manual_online_shift" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_oss_manual_online_shift"><?= $Page->shift->caption() ?><?= $Page->shift->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shift->cellAttributes() ?>>
<template id="tpx_oss_manual_online_shift"><span id="el_oss_manual_online_shift">
    <select
        id="x_shift"
        name="x_shift"
        class="form-select ew-select<?= $Page->shift->isInvalidClass() ?>"
        data-select2-id="foss_manual_onlineadd_x_shift"
        data-table="oss_manual_online"
        data-field="x_shift"
        data-dropdown
        data-value-separator="<?= $Page->shift->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->shift->getPlaceHolder()) ?>"
        <?= $Page->shift->editAttributes() ?>>
        <?= $Page->shift->selectOptionListHtml("x_shift") ?>
    </select>
    <?= $Page->shift->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->shift->getErrorMessage() ?></div>
<script>
loadjs.ready("foss_manual_onlineadd", function() {
    var options = { name: "x_shift", selectId: "foss_manual_onlineadd_x_shift" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.columns = el.dataset.repeatcolumn || 5;
    options.dropdown = !ew.IS_MOBILE && options.columns > 0; // Use custom dropdown
    el.dataset.dropdown = options.dropdown;
    if (options.dropdown) {
        options.dropdownAutoWidth = true;
        options.dropdownCssClass = "ew-select-dropdown ew-select-one oss_manual_online-x_shift-dropdown";
        if (options.columns > 1)
            options.dropdownCssClass += " ew-repeat-column";
    }
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (foss_manual_onlineadd.lists.shift.lookupOptions.length) {
        options.data = { id: "x_shift", form: "foss_manual_onlineadd" };
    } else {
        options.ajax = { id: "x_shift", form: "foss_manual_onlineadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.oss_manual_online.fields.shift.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_oss_manual_onlineadd" class="ew-custom-template"></div>
<template id="tpm_oss_manual_onlineadd">
<div id="ct_OssManualOnlineAdd"><script type="text/javascript">

		function reset_shipment() {
			$("#x_shipment").val("");
			$("#x_pallet_no").val("");
			$("#x_order_no").val("");
			$("#x_shipment").focus();
			$("#x_shipment").attr('readonly', false);
			$("#x_pallet_no").attr('readonly', false);
			$("#x_order_no").attr('readonly', false);
		};

		function reset_pallet() {
			$("#x_pallet_no").val("");
			$("#x_order_no").val("");
			$("#x_pallet_no").attr('readonly', false);
			$("#x_order_no").attr('readonly', false);
			$("#x_pallet_no").focus();
		};

		function reset_on() {
			$("#x_order_no").val("");
			$("#x_order_no").attr('readonly', false);
			$("#x_order_no").focus();
		};
		$('body').on('keydown', 'input, select', function(e) { // ganti enter jadi tab di setiap input
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,a,select,textarea,button').filter(":input:not([readonly])");
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit(function (){
                    return false;
                });
                }
                return false;
            }
        });
       $(document).ready(function () {
         $("#x_scan").on("change", function () {
           $("#btn-action").focus();
         });
       });
       $(document).ready(function() {
         $("#btn-action").on('focus', function() {
         	$("#x_date").attr('disabled', false);
            this.form.submit();
             });
         });
</script>
<style>
	input {
        display: flex;
        width: 100%;
        box-sizing: border-box;
    }
     button {
        display: inline-block !important;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
    .col {
    	-ms-flex: 1 0 0%;
    	flex: 1 0 0%;
    	width: 250px !important;
    }
}
</style>
<div id="r_id" class="mb-3 row" hidden>
    <label for="x_id" class="col-sm-3 col-form-label"><slot class="ew-slot" name="tpcaption_id"></slot></label>
    <div class="col-sm-10"><slot class="ew-slot" name="tpx_id"></slot></div>
</div>
<div id="r_date" class="mb-3 row">
    <label for="x_date" class="col-sm-3 col-form-label"><?= $Page->date->caption() ?></label>
    <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_date"></slot></div>
</div>
<div class="container-fluid">
	<div class="row justify-content-start">
        <div id="r_sscc" class="col">
            <label for="x_sscc" class="col-sm-5 col-form-label"><?= $Page->sscc->caption() ?></label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_sscc"></slot></div>
        </div>
    </div>
    <div class="row justify-content-start">
        <div id="r_shipment" class="col">
            <label for="x_shipment" class="col-sm-5 col-form-label"><?= $Page->shipment->caption() ?></label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_shipment"></slot></div>
        </div>
        <div id="r_pallet_no" class="col">
            <label for="x_pallet_no" class="col-sm-5 col-form-label"><?= $Page->pallet_no->caption() ?></label>
            <div class="col-sm-10"><slot class="ew-slot" name="tpx_oss_manual_online_pallet_no"></slot></div>
        </div>
    </div>
    <div class="row justify-content-start">
        <div id="r_idw" class="col">
            <label for="x_idw" class="col-sm-2 col-form-label"><?= $Page->idw->caption() ?></label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_idw"></slot></div>
        </div>
        <div id="r_order_no" class="col">
            <label for="x_order_no" class="col-sm-2 col-form-label"><?= $Page->order_no->caption() ?></label>
            <div class="col-sm-10"><slot class="ew-slot" name="tpx_oss_manual_online_order_no"></slot></div>
        </div>
    </div>
    <div class="row justify-content-start">
        <div id="r_item_in_ctn" class="col">
            <label for="x_item_in_ctn" class="col-sm-2 col-form-label">In Ctn</label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_item_in_ctn"></slot></div>
        </div>
        <div id="r_no_of_ctn" class="col">
            <label for="x_no_of_ctn" class="col-sm-2 col-form-label">Of Ctn</label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_no_of_ctn"></slot></div>
        </div>
        <div id="r_ctn_no" class="col">
            <label for="x_ctn_no" class="col-sm-2 col-form-label"><?= $Page->ctn_no->caption() ?></label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_ctn_no"></slot></div>
        </div>
    </div>
    <div class="row justify-content-start">
        <div id="r_checker" class="col">
            <label for="x_checker" class="col-sm-2 col-form-label"><?= $Page->checker->caption() ?></label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_checker"></slot></div>
        </div>
        <div id="r_shift" class="col">
            <label for="x_shift" class="col-sm-2 col-form-label"><?= $Page->shift->caption() ?></label>
            <div class="col-sm-5"><slot class="ew-slot" name="tpx_oss_manual_online_shift"></slot></div>
        </div>
    </div>
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
    ew.applyTemplate("tpd_oss_manual_onlineadd", "tpm_oss_manual_onlineadd", "oss_manual_onlineadd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("oss_manual_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function () {
        $("#btn-action").after(
        	'<button class="btn btn-danger ew-btn" name="btn-action" id="btn-action" type="button" onclick="reset_shipment()">Reset Shipment</button>'
        	);
        $("#btn-action").after(
        	'<button class="btn btn-danger ew-btn" name="btn-action" id="btn-action" type="button" onclick="reset_pallet()">Reset Pallet</button>'
        	);
    	$("#btn-action").after(
        	'<button class="btn btn-danger ew-btn" name="btn-action" id="btn-action" type="button" onclick="reset_on()">Reset On</button>'
        	);
      $(document).on("focus", "input[type=text]", function () {
        this.select();
      });
      $("#x_sscc").focus();
      $("#x_sscc").change(function () {
        $("#x_shipment").focus();
      });
      $("#x_shipment").change(function () {
        $("#x_pallet_no").focus();
        $("#x_shipment").attr('readonly', true);
      });
      $("#x_pallet_no").change(function () {
        $("#x_order_no").focus();
        $("#x_pallet_no").attr('readonly', true);
      });
      $("#x_order_no").change(function () {
        $("#x_item_in_ctn").focus();
      });
      $("#x_item_in_ctn").change(function () {
        $("#x_no_of_ctn").focus();
      });
      $("#x_no_of_ctn").change(function () {
        $("#x_ctn_no").focus();
      });
      $("#x_ctn_no").change(function () {
        $("#btn-action").focus();
      });
    });
});
</script>

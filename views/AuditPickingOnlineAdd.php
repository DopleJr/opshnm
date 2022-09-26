<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$AuditPickingOnlineAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { audit_picking_online: currentTable } });
var currentForm, currentPageID;
var faudit_picking_onlineadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faudit_picking_onlineadd = new ew.Form("faudit_picking_onlineadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = faudit_picking_onlineadd;

    // Add fields
    var fields = currentTable.fields;
    faudit_picking_onlineadd.addFields([
        ["box_code", [fields.box_code.visible && fields.box_code.required ? ew.Validators.required(fields.box_code.caption) : null], fields.box_code.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["scan", [fields.scan.visible && fields.scan.required ? ew.Validators.required(fields.scan.caption) : null], fields.scan.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["picked_qty", [fields.picked_qty.visible && fields.picked_qty.required ? ew.Validators.required(fields.picked_qty.caption) : null, ew.Validators.integer], fields.picked_qty.isInvalid],
        ["scan_qty", [fields.scan_qty.visible && fields.scan_qty.required ? ew.Validators.required(fields.scan_qty.caption) : null], fields.scan_qty.isInvalid],
        ["checker", [fields.checker.visible && fields.checker.required ? ew.Validators.required(fields.checker.caption) : null], fields.checker.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_update", [fields.date_update.visible && fields.date_update.required ? ew.Validators.required(fields.date_update.caption) : null, ew.Validators.datetime(fields.date_update.clientFormatPattern)], fields.date_update.isInvalid],
        ["time_update", [fields.time_update.visible && fields.time_update.required ? ew.Validators.required(fields.time_update.caption) : null, ew.Validators.datetime(fields.time_update.clientFormatPattern)], fields.time_update.isInvalid]
    ]);

    // Form_CustomValidate
    faudit_picking_onlineadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faudit_picking_onlineadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    faudit_picking_onlineadd.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    faudit_picking_onlineadd.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    loadjs.done("faudit_picking_onlineadd");
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
<form name="faudit_picking_onlineadd" id="faudit_picking_onlineadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="audit_picking_online">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label id="elh_audit_picking_online_box_code" for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_box_code"><?= $Page->box_code->caption() ?><?= $Page->box_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_code->cellAttributes() ?>>
<template id="tpx_audit_picking_online_box_code"><span id="el_audit_picking_online_box_code">
<?php $Page->box_code->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_box_code"
        name="x_box_code"
        class="form-select ew-select<?= $Page->box_code->isInvalidClass() ?>"
        data-select2-id="faudit_picking_onlineadd_x_box_code"
        data-table="audit_picking_online"
        data-field="x_box_code"
        data-value-separator="<?= $Page->box_code->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"
        <?= $Page->box_code->editAttributes() ?>>
        <?= $Page->box_code->selectOptionListHtml("x_box_code") ?>
    </select>
    <?= $Page->box_code->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->box_code->getErrorMessage() ?></div>
<?= $Page->box_code->Lookup->getParamTag($Page, "p_x_box_code") ?>
<script>
loadjs.ready("faudit_picking_onlineadd", function() {
    var options = { name: "x_box_code", selectId: "faudit_picking_onlineadd_x_box_code" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (faudit_picking_onlineadd.lists.box_code.lookupOptions.length) {
        options.data = { id: "x_box_code", form: "faudit_picking_onlineadd" };
    } else {
        options.ajax = { id: "x_box_code", form: "faudit_picking_onlineadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.audit_picking_online.fields.box_code.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_audit_picking_online_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_store_id"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<template id="tpx_audit_picking_online_store_id"><span id="el_audit_picking_online_store_id">
<?php $Page->store_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_store_id"
        name="x_store_id"
        class="form-select ew-select<?= $Page->store_id->isInvalidClass() ?>"
        data-select2-id="faudit_picking_onlineadd_x_store_id"
        data-table="audit_picking_online"
        data-field="x_store_id"
        data-value-separator="<?= $Page->store_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"
        <?= $Page->store_id->editAttributes() ?>>
        <?= $Page->store_id->selectOptionListHtml("x_store_id") ?>
    </select>
    <?= $Page->store_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->store_id->getErrorMessage() ?></div>
<?= $Page->store_id->Lookup->getParamTag($Page, "p_x_store_id") ?>
<script>
loadjs.ready("faudit_picking_onlineadd", function() {
    var options = { name: "x_store_id", selectId: "faudit_picking_onlineadd_x_store_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (faudit_picking_onlineadd.lists.store_id.lookupOptions.length) {
        options.data = { id: "x_store_id", form: "faudit_picking_onlineadd" };
    } else {
        options.ajax = { id: "x_store_id", form: "faudit_picking_onlineadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.audit_picking_online.fields.store_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_audit_picking_online_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_store_name"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<template id="tpx_audit_picking_online_store_name"><span id="el_audit_picking_online_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="audit_picking_online" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
    <div id="r_scan"<?= $Page->scan->rowAttributes() ?>>
        <label id="elh_audit_picking_online_scan" for="x_scan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_scan"><?= $Page->scan->caption() ?><?= $Page->scan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan->cellAttributes() ?>>
<template id="tpx_audit_picking_online_scan"><span id="el_audit_picking_online_scan">
<input type="<?= $Page->scan->getInputTextType() ?>" name="x_scan" id="x_scan" data-table="audit_picking_online" data-field="x_scan" value="<?= $Page->scan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->scan->getPlaceHolder()) ?>"<?= $Page->scan->editAttributes() ?> aria-describedby="x_scan_help">
<?= $Page->scan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_audit_picking_online_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_article"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<template id="tpx_audit_picking_online_article"><span id="el_audit_picking_online_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="audit_picking_online" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label id="elh_audit_picking_online_picked_qty" for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_picked_qty"><?= $Page->picked_qty->caption() ?><?= $Page->picked_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<template id="tpx_audit_picking_online_picked_qty"><span id="el_audit_picking_online_picked_qty">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="audit_picking_online" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?> aria-describedby="x_picked_qty_help">
<?= $Page->picked_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
    <div id="r_scan_qty"<?= $Page->scan_qty->rowAttributes() ?>>
        <label id="elh_audit_picking_online_scan_qty" for="x_scan_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_scan_qty"><?= $Page->scan_qty->caption() ?><?= $Page->scan_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan_qty->cellAttributes() ?>>
<template id="tpx_audit_picking_online_scan_qty"><span id="el_audit_picking_online_scan_qty">
<input type="<?= $Page->scan_qty->getInputTextType() ?>" name="x_scan_qty" id="x_scan_qty" data-table="audit_picking_online" data-field="x_scan_qty" value="<?= $Page->scan_qty->EditValue ?>" placeholder="<?= HtmlEncode($Page->scan_qty->getPlaceHolder()) ?>"<?= $Page->scan_qty->editAttributes() ?> aria-describedby="x_scan_qty_help">
<?= $Page->scan_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan_qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <div id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <label id="elh_audit_picking_online_checker" for="x_checker" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_checker"><?= $Page->checker->caption() ?><?= $Page->checker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->checker->cellAttributes() ?>>
<template id="tpx_audit_picking_online_checker"><span id="el_audit_picking_online_checker">
<input type="<?= $Page->checker->getInputTextType() ?>" name="x_checker" id="x_checker" data-table="audit_picking_online" data-field="x_checker" value="<?= $Page->checker->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->checker->getPlaceHolder()) ?>"<?= $Page->checker->editAttributes() ?> aria-describedby="x_checker_help">
<?= $Page->checker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->checker->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_audit_picking_online_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_status"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<template id="tpx_audit_picking_online_status"><span id="el_audit_picking_online_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="audit_picking_online" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
    <div id="r_date_update"<?= $Page->date_update->rowAttributes() ?>>
        <label id="elh_audit_picking_online_date_update" for="x_date_update" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_date_update"><?= $Page->date_update->caption() ?><?= $Page->date_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_update->cellAttributes() ?>>
<template id="tpx_audit_picking_online_date_update"><span id="el_audit_picking_online_date_update">
<input type="<?= $Page->date_update->getInputTextType() ?>" name="x_date_update" id="x_date_update" data-table="audit_picking_online" data-field="x_date_update" value="<?= $Page->date_update->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_update->getPlaceHolder()) ?>"<?= $Page->date_update->editAttributes() ?> aria-describedby="x_date_update_help">
<?= $Page->date_update->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_update->getErrorMessage() ?></div>
<?php if (!$Page->date_update->ReadOnly && !$Page->date_update->Disabled && !isset($Page->date_update->EditAttrs["readonly"]) && !isset($Page->date_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faudit_picking_onlineadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("faudit_picking_onlineadd", "x_date_update", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
    <div id="r_time_update"<?= $Page->time_update->rowAttributes() ?>>
        <label id="elh_audit_picking_online_time_update" for="x_time_update" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_time_update"><?= $Page->time_update->caption() ?><?= $Page->time_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_update->cellAttributes() ?>>
<template id="tpx_audit_picking_online_time_update"><span id="el_audit_picking_online_time_update">
<input type="<?= $Page->time_update->getInputTextType() ?>" name="x_time_update" id="x_time_update" data-table="audit_picking_online" data-field="x_time_update" value="<?= $Page->time_update->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_update->getPlaceHolder()) ?>"<?= $Page->time_update->editAttributes() ?> aria-describedby="x_time_update_help">
<?= $Page->time_update->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_update->getErrorMessage() ?></div>
<?php if (!$Page->time_update->ReadOnly && !$Page->time_update->Disabled && !isset($Page->time_update->EditAttrs["readonly"]) && !isset($Page->time_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faudit_picking_onlineadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("faudit_picking_onlineadd", "x_time_update", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_audit_picking_onlineadd" class="ew-custom-template"></div>
<template id="tpm_audit_picking_onlineadd">
<div id="ct_AuditPickingOnlineAdd"><script type="text/javascript">
$("body").on("keydown", "input, select", function (e) {
  // ganti enter jadi tab di setiap input
  if (e.key === "Enter") {
    var self = $(this),
      form = self.parents("form:eq(0)"),
      focusable,
      next;
    focusable = form
      .find("input,a,select,textarea,button")
      .filter(":input:not([readonly])");
    next = focusable.eq(focusable.index(this) + 1);
    if (next.length) {
      next.focus();
    } else {
      form.submit(function () {
        //window.location = 'http://localhost/opsvaliram/pickingappsedit?start=1';
        return false;
      });
    }
    return false;
  }
});
// FLow Start Load
$(document).ready(function () {
  $("#x_box_code").change(function () {
  $("#x_store_id").focus();
  $("#x_box_code").attr("readonly", true);
});
$("#x_store_id").change(function () {
  $("#x_scan").focus();
  $("#x_store_id").attr("readonly", true);
});
  $("#btn-action").on("focus", function () {
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
</style>
    <div id="r_scan_qty" class="mb-3 row" >
        <label for="x_scan_qty" class="col-sm-2 col-form-label"><?= $Page->scan_qty->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_scan_qty"></slot></div>
    </div>
    <div id="r_picked_qty" class="mb-3 row">
        <label for="x_picked_qty" class="col-sm-2 col-form-label"><?= $Page->picked_qty->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_picked_qty"></slot></div>
    </div>
    <div id="r_box_code" class="mb-3 row">
        <label for="x_box_code" class="col-sm-2 col-form-label"><?= $Page->box_code->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_box_code"></slot></div>
    </div>
    <div id="r_store_id" class="mb-3 row">
        <label for="x_store_id" class="col-sm-2 col-form-label"><?= $Page->store_id->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_store_id"></slot></div>
    </div>
    <div id="r_store_name" class="mb-3 row" >
        <label for="x_store_name" class="col-sm-2 col-form-label"><?= $Page->store_name->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_store_name"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row">
        <label for="x_scan" class="col-sm-2 col-form-label"><?= $Page->scan->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_scan"></slot></div>
    </div>
    <div id="r_article" class="mb-3 row">
        <label for="x_article" class="col-sm-2 col-form-label"><?= $Page->article->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_article"></slot></div>
    </div>
    <div id="r_checker" class="mb-3 row" hidden>
        <label for="x_checker" class="col-sm-2 col-form-label"><?= $Page->checker->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_checker"></slot></div>
    </div>
    <div id="r_date_update" class="mb-3 row" hidden>
        <label for="x_date_update" class="col-sm-2 col-form-label"><?= $Page->date_update->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_date_update"></slot></div>
    </div>
    <div id="r_time_update" class="mb-3 row" hidden>
        <label for="x_time_update" class="col-sm-2 col-form-label"><?= $Page->time_update->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_time_update"></slot></div>
    </div>
    <div id="r_status" class="mb-3 row" hidden>
        <label for="x_status" class="col-sm-2 col-form-label"><?= $Page->status->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_status"></slot></div>
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
    ew.applyTemplate("tpd_audit_picking_onlineadd", "tpm_audit_picking_onlineadd", "audit_picking_onlineadd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("audit_picking_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function () {
      $(document).on("focus", "input[type=text]", function () {
        this.select();
      });
      $("#btn-action").after(
        '<button class="btn btn-danger ew-btn" name="btn-action" id="btn-reset" type="button" onclick="clearForm3()">Reset</button>'
      );
      $("#x_scan").keypress(function (event) {
        if ((event.keyCode || event.which) == 13) {
          event.preventDefault();
          return false;
        }
      });
      $(document).on("input", "#x_scan", function () {
      var scan = $("#x_scan_qty").val();
      var picked = $("#x_picked_qty").val();
      var actual = 1;
      var result = parseInt(scan) + parseInt(actual);
      if ($("#x_scan").val().length == 30) {
        scan1 = $("#x_scan").val().substring(4, 14);
        scan2 = $("#x_scan").val().substring(18, 21);
        scan3 = $("#x_scan").val().substring(12, 17);
        $("#x_scan").val(scan1 + scan2 + scan3);
        $("#x_scan").css({ color: "green" }); // warna text
        $("#x_scan").focus();
        $("#x_scan_qty").val(result);
        //Check Qty picked & Actual
        if (picked == result) {
          $("#x_scan").attr("readonly", true);
          $("#x_status").val("Scanned");
        }
        if (picked < result) {
          alert("Excess!");
        }
        //end alert("type 1");
        //alert("type 1");
      }
      if (
        $("#x_scan").val().length == 29 &&
        $("#x_scan").val().substring(2, 3) == 1
      ) {
        scan4 = $("#x_scan").val().substring(2, 3);
        scan5 = $("#x_scan").val().substring(3, 12);
        scan6 = $("#x_scan").val().substring(17, 19);
        scan7 = $("#x_scan").val().substring(1, 2);
        scan8 = $("#x_scan").val().substring(12, 15);
        $("#x_scan").val(scan4 + scan5 + scan6 + scan7 + scan8);
        $("#x_scan").css({ color: "green" }); // warna text
        $("#x_scan").focus();
        $("#x_scan_qty").val(result);
        //Check Qty picked & Actual
        if (picked == result) {
          $("#x_scan").attr("readonly", true);
          $("#x_status").val("Scanned");
        }
        if (picked < result) {
          alert("Excess!");
        }
        //end
        //alert("type 2");
      } else if (
        $("#x_scan").val().length == 29 &&
        $("#x_scan").val().substring(2, 3) !== 1
      ) {
        scan9 = $("#x_scan").val().substring(3, 12);
        scan10 = $("#x_scan").val().substring(17, 19);
        scan11 = $("#x_scan").val().substring(1, 2);
        scan12 = $("#x_scan").val().substring(12, 15);
        $("#x_scan").val(scan9 + scan10 + scan11 + scan12);
        $("#x_scan").css({ color: "green" }); // warna text
        $("#x_scan").focus();
        $("#x_scan_qty").val(result);
        //Check Qty picked & Actual
        if (picked == result) {
          $("#x_scan").attr("readonly", true);
          $("#x_status").val("Scanned");
        }
        if (picked < result) {
          alert("Excess!");
        }
        //end
        //alert("type 3");
      } else if ($("#x_scan").val().length <= 29) {
        $("#x_scan").css({ color: "green" }); // warna text
        $("#x_scan").focus();
        $("#x_scan_qty").val(result);
        //Check Qty picked & Actual
        if (picked == result) {
          $("#x_scan").attr("readonly", true);
          $("#x_status").val("Scanned");
        }
        if (picked < result) {
          alert("Excess!");
        }
        if (picked > result) {
          $("#x_status").val("Scanned");
        }
        //end
        //alert("type 4");
      }
    });
    });
});
</script>

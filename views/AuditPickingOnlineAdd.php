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
        ["scan", [fields.scan.visible && fields.scan.required ? ew.Validators.required(fields.scan.caption) : null], fields.scan.isInvalid],
        ["box_code", [fields.box_code.visible && fields.box_code.required ? ew.Validators.required(fields.box_code.caption) : null], fields.box_code.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["picked_qty", [fields.picked_qty.visible && fields.picked_qty.required ? ew.Validators.required(fields.picked_qty.caption) : null], fields.picked_qty.isInvalid],
        ["scan_qty", [fields.scan_qty.visible && fields.scan_qty.required ? ew.Validators.required(fields.scan_qty.caption) : null], fields.scan_qty.isInvalid],
        ["checker", [fields.checker.visible && fields.checker.required ? ew.Validators.required(fields.checker.caption) : null], fields.checker.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["date_update", [fields.date_update.visible && fields.date_update.required ? ew.Validators.required(fields.date_update.caption) : null], fields.date_update.isInvalid],
        ["time_update", [fields.time_update.visible && fields.time_update.required ? ew.Validators.required(fields.time_update.caption) : null], fields.time_update.isInvalid]
    ]);

    // Form_CustomValidate
    faudit_picking_onlineadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faudit_picking_onlineadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("faudit_picking_onlineadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    // Write your table-specific client script here, no need to add script tags.
    $(document).on("focus", "input[type=text]", function () {
        this.select();
        //$(document).on('select2:open', () => {
        //    document.querySelector('.select2-search__field').focus();
        //  });
      });
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
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label id="elh_audit_picking_online_box_code" for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_box_code"><?= $Page->box_code->caption() ?><?= $Page->box_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_code->cellAttributes() ?>>
<template id="tpx_audit_picking_online_box_code"><span id="el_audit_picking_online_box_code">
<input type="<?= $Page->box_code->getInputTextType() ?>" name="x_box_code" id="x_box_code" data-table="audit_picking_online" data-field="x_box_code" value="<?= $Page->box_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"<?= $Page->box_code->editAttributes() ?> aria-describedby="x_box_code_help">
<?= $Page->box_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_code->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_audit_picking_online_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_store_id"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<template id="tpx_audit_picking_online_store_id"><span id="el_audit_picking_online_store_id">
<input type="<?= $Page->store_id->getInputTextType() ?>" name="x_store_id" id="x_store_id" data-table="audit_picking_online" data-field="x_store_id" value="<?= $Page->store_id->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"<?= $Page->store_id->editAttributes() ?> aria-describedby="x_store_id_help">
<?= $Page->store_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_id->getErrorMessage() ?></div>
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
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label id="elh_audit_picking_online_picked_qty" for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_online_picked_qty"><?= $Page->picked_qty->caption() ?><?= $Page->picked_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<template id="tpx_audit_picking_online_picked_qty"><span id="el_audit_picking_online_picked_qty">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="audit_picking_online" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?> aria-describedby="x_picked_qty_help">
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
//Load Pervious Data
$(document).ready(function () {
  //Old Record
  var LastBoxCode = ew.vars.LastBoxCode;
  var LastStoreID = ew.vars.LastStoreID;
  var LastStoreName = ew.vars.LastStoreName;
  var QtyBox = ew.vars.QtyBox;
  var QtyScan = ew.vars.QtyScan;
  // focus your element
  $("#x_box_code").val(LastBoxCode);
  $("#x_store_id").val(LastStoreID);
  $("#x_store_name").val(LastStoreName);
  $("#x_picked_qty").val(QtyBox);
  $("#x_scan_qty").val(QtyScan);

  // FLow Start Load
  $(document).ready(function () {
    $("#x_box_code").on("change", function () {
      var object = "box_picking_online",
        key = encodeURIComponent($(this).val());
      $.get("/api/view/" + object + "/" + key, function (res) {
        // Get response from View page API
        if (res && res.success) {
          var row = res[object];
          var store_code = row["store_code"];
          var store_name = row["store_name"];
          var picked_qty = row["picked_qty"];
          var scan_qty = row["scan_qty"];
          //update record
          $("#x_store_id").val(store_code);
          $("#x_store_name").val(store_name);
          $("#x_picked_qty").val(picked_qty);
          $("#x_scan_qty").val(scan_qty);
          $("#x_scan").focus();
        } else {
          Swal.fire({
            title: "New Box !",
            text: "New Box has no record",
            icon: "warning",
            width: 200,
            height: 180,
            didClose: (e) => {
              $("#x_box_code").focus();
            },
          });
        }
      });
    });
    $("#btn-action").on("focus", function () {
      this.form.submit();
    });
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
    <div id="r_picked_qty" class="mb-3 row" readonly>
        <label for="x_picked_qty" class="col-sm-2 col-form-label"><?= $Page->picked_qty->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_picked_qty"></slot></div>
    </div>
    <div id="r_scan_qty" class="mb-3 row" readonly>
        <label for="x_scan_qty" class="col-sm-2 col-form-label"><?= $Page->scan_qty->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_scan_qty"></slot></div>
    </div>
    <div id="r_box_code" class="mb-3 row">
        <label for="x_box_code" class="col-sm-2 col-form-label"><?= $Page->box_code->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_box_code"></slot></div>
    </div>
    <div id="r_store_id" class="mb-3 row" readonly>
        <label for="x_store_id" class="col-sm-2 col-form-label"><?= $Page->store_id->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_store_id"></slot></div>
    </div>
    <div id="r_store_name" class="mb-3 row" readonly>
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
    <div id="r_checker" class="mb-3 row" >
        <label for="x_checker" class="col-sm-2 col-form-label"><?= $Page->checker->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_online_checker"></slot></div>
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
      $("#x_scan").keypress(function (event) {
        if ((event.keyCode || event.which) == 13) {
        $("#btn-action").focus();
          //event.preventDefault();
          //return false;
        }
      });
    $(document).on("input", "#x_scan", function () {
      var scan = $("#x_scan_qty").val();
      var picked = $("#x_picked_qty").val();
      var actual = 1;
      var result = parseInt(scan) + parseInt(actual);
      var excess = parseInt(result) - parseInt(picked);
      if ($("#x_scan").val().length == 30) {
        scan1 = $("#x_scan").val().substring(4, 14);
        scan2 = $("#x_scan").val().substring(18, 21);
        scan3 = $("#x_scan").val().substring(12, 17);

        //Check Qty picked & Actual
        if (picked >= result) {
          $("#x_article").val(scan1 + scan2 + scan3);
          $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
        }
        if (picked < result) {
          $("#x_article").val(scan1 + scan2 + scan3);
          $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
          alert("Excess!" + "+" + excess);
        }

        //end
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

        //Check Qty picked & Actual
        if (picked >= result) {
         $("#x_article").val(scan4 + scan5 + scan6 + scan7 + scan8);
         $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
        }
        if (picked < result) {
          $("#x_article").val(scan4 + scan5 + scan6 + scan7 + scan8);
          $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
          alert("Excess!" + "+" + excess);
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

        //Check Qty picked & Actual
        if (picked >= result) {
        $("#x_article").val(scan9 + scan10 + scan11 + scan12);
        $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
        }
        if (picked < result) {
          $("#x_article").val(scan9 + scan10 + scan11 + scan12);
          $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
          alert("Excess!" + "+" + excess);
        }
        //end
        //alert("type 3");
      }
      if ($("#x_scan").val().length < 29) {
        //Check Qty picked & Actual
        if (picked >= result) {
          $("#x_article").val($("#x_scan").val());
          $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
        }
        if (picked < result) {
          $("#x_article").val($("#x_scan").val());
          $("#x_scan").css({ color: "green" }); // warna text
          $("#x_scan_qty").val(result);
          $("#x_status").val("Scanned");
          $("#btn-action").focus();
          alert("Excess!" + "+" + excess);
        }
        //end
        //alert("type 4");
      }
    });
    });
});
</script>

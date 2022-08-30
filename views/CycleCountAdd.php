<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CycleCountAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cycle_count: currentTable } });
var currentForm, currentPageID;
var fcycle_countadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcycle_countadd = new ew.Form("fcycle_countadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcycle_countadd;

    // Add fields
    var fields = currentTable.fields;
    fcycle_countadd.addFields([
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["scan", [fields.scan.visible && fields.scan.required ? ew.Validators.required(fields.scan.caption) : null], fields.scan.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid],
        ["get_total", [fields.get_total.visible && fields.get_total.required ? ew.Validators.required(fields.get_total.caption) : null], fields.get_total.isInvalid]
    ]);

    // Form_CustomValidate
    fcycle_countadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcycle_countadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fcycle_countadd");
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
<form name="fcycle_countadd" id="fcycle_countadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cycle_count">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_cycle_count_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_cycle_count_location"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<template id="tpx_cycle_count_location"><span id="el_cycle_count_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="cycle_count" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
    <div id="r_scan"<?= $Page->scan->rowAttributes() ?>>
        <label id="elh_cycle_count_scan" for="x_scan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_cycle_count_scan"><?= $Page->scan->caption() ?><?= $Page->scan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan->cellAttributes() ?>>
<template id="tpx_cycle_count_scan"><span id="el_cycle_count_scan">
<input type="<?= $Page->scan->getInputTextType() ?>" name="x_scan" id="x_scan" data-table="cycle_count" data-field="x_scan" value="<?= $Page->scan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->scan->getPlaceHolder()) ?>"<?= $Page->scan->editAttributes() ?> aria-describedby="x_scan_help">
<?= $Page->scan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_cycle_count_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_cycle_count_article"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<template id="tpx_cycle_count_article"><span id="el_cycle_count_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="cycle_count" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->get_total->Visible) { // get_total ?>
    <div id="r_get_total"<?= $Page->get_total->rowAttributes() ?>>
        <label id="elh_cycle_count_get_total" for="x_get_total" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_cycle_count_get_total"><?= $Page->get_total->caption() ?><?= $Page->get_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->get_total->cellAttributes() ?>>
<template id="tpx_cycle_count_get_total"><span id="el_cycle_count_get_total">
<input type="<?= $Page->get_total->getInputTextType() ?>" name="x_get_total" id="x_get_total" data-table="cycle_count" data-field="x_get_total" value="<?= $Page->get_total->EditValue ?>" placeholder="<?= HtmlEncode($Page->get_total->getPlaceHolder()) ?>"<?= $Page->get_total->editAttributes() ?> aria-describedby="x_get_total_help">
<?= $Page->get_total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->get_total->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_cycle_countadd" class="ew-custom-template"></div>
<template id="tpm_cycle_countadd">
<div id="ct_CycleCountAdd"><script type="text/javascript">
		$('body').on('keydown', 'input, select', function(e) { // ganti enter jadi tab di setiap input
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,a,select,textarea,button').filter(":input:not([readonly])");
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit(function (){
                    //window.location = 'http://localhost/opsvaliram/pickingappsedit?start=1';
                    return false;
                });
                }
                return false;
            }
        });
        $("#x_location").change(function (i) {
            if(i.keyCode === "Enter" && $("#x_location").val().length >= 8) {
            $("#x_su").focus(); // pindah focus
            }
            if(i.keyCode === "Enter" && $("#x_location").val().length <= 8) {
            alert('Lokasi Salah!!!');
            $("#x_location").focus(); // fokus
            }
        });
        $("#x_su").change(function () {
            if(i.keyCode === "Enter" && $("#x_su").val().length == 10) {
            $("#x_scan").focus(); // pindah focus
            }
            if(i.keyCode === "Enter" && $("#x_su").val().length <= 9) {
            alert('Lokasi Salah!!!');
            $("#x_su").focus(); // fokus
            }
        });
       $(document).ready(function () {
         $("#x_scan").on("change", function () {
           $("#btn-action").focus();
         });
       });
       $(document).ready(function() {
         $("#btn-action").on('focus', function() {
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
	<div id="r_get_total" class="mb-3 row">
        <label for="x_get_total" class="col-sm-2 col-form-label">Total Article</label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_cycle_count_get_total"></slot></div>
    </div>
    <div id="r_location" class="mb-3 row">
        <label for="x_location" class="col-sm-2 col-form-label"><?= $Page->location->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_cycle_count_location"></slot></div>
    </div>
    <div id="r_su" class="mb-3 row" hidden>
        <label for="x_su" class="col-sm-2 col-form-label"><?= $Page->su->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_cycle_count_su"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row">
        <label for="x_scan" class="col-sm-2 col-form-label"><?= $Page->scan->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_cycle_count_scan"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row" hidden>
        <label for="x_gtin" class="col-sm-2 col-form-label"><slot class="ew-slot" name="tpcaption_gtin"></slot></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_gtin"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row" hidden>
        <label for="x_gtin2" class="col-sm-2 col-form-label"><slot class="ew-slot" name="tpcaption_gtin2"></slot></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_gtin2"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row" hidden>
        <label for="x_gtin3" class="col-sm-2 col-form-label"><slot class="ew-slot" name="tpcaption_gtin3"></slot></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_gtin3"></slot></div>
    </div>
    <div id="r_article" class="mb-3 row">
        <label for="x_article" class="col-sm-2 col-form-label"><?= $Page->article->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_cycle_count_article"></slot></div>
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
    ew.applyTemplate("tpd_cycle_countadd", "tpm_cycle_countadd", "cycle_countadd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("cycle_count");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
       $(document).ready(function() {
        		$("#x_location").attr('disabled', true);
        		$("#x_su").attr('disabled', true);
        		$(document).on('focus','input[type=text]',function(){ this.select(); });
        		$("#x_scan").focus();
        		$("#btn-action").after('<button class="btn btn-danger ew-btn" name="btn-action" id="btn-reset" type="button" onclick="clearForm()">Reset</button>');
        	$("#x_scan").change(function () {
                    if ($("#x_location").val() !== "")
                    {
                    	$("#x_location").attr('disabled', false);
                    	$("#x_su").attr('disabled', false);
                    	if ($("#x_scan").val().length == 30)
                    	{
                    		scan1 = $("#x_scan").val().substring(4,14);
                    		scan2 = $("#x_scan").val().substring(18,21);
                    		scan3 = $("#x_scan").val().substring(12,17);
                    		$("#x_article").val(scan1+scan2+scan3);
                            //alert('helloworld'.substring(5, 7));
                            //alert('type 1');
                    	}
                        if ($("#x_scan").val().length == 29 && $("#x_scan").val().substring(2,3) == 1)
                    	{
                    		scan4 = $("#x_scan").val().substring(2,3);
                    		scan5 = $("#x_scan").val().substring(3,12);
                    		scan6 = $("#x_scan").val().substring(17,19);
                            scan7 = $("#x_scan").val().substring(1,2);
                            scan8 = $("#x_scan").val().substring(12,15);
                    		$("#x_article").val(scan4+scan5+scan6+scan7+scan8);
                            //alert('type 2');
                    	}
                        else if ($("#x_scan").val().length == 29 && $("#x_scan").val().substring(2,3) !== 1)
                    	{
                    		scan9 = $("#x_scan").val().substring(3,12);
                    		scan10 = $("#x_scan").val().substring(17,19);
                    		scan11 = $("#x_scan").val().substring(1,2);
                            scan12 = $("#x_scan").val().substring(12,15);
                    		$("#x_article").val(scan9+scan10+scan11+scan12);
                            //alert('type 3');
                    	}
                    }
                    else
                    {
                    $("#x_scan").val("")
                    }
                });
        });
});
</script>

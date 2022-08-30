<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ExtraStockEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { extra_stock: currentTable } });
var currentForm, currentPageID;
var fextra_stockedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fextra_stockedit = new ew.Form("fextra_stockedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fextra_stockedit;

    // Add fields
    var fields = currentTable.fields;
    fextra_stockedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["week", [fields.week.visible && fields.week.required ? ew.Validators.required(fields.week.caption) : null], fields.week.isInvalid],
        ["art6", [fields.art6.visible && fields.art6.required ? ew.Validators.required(fields.art6.caption) : null], fields.art6.isInvalid],
        ["art9", [fields.art9.visible && fields.art9.required ? ew.Validators.required(fields.art9.caption) : null], fields.art9.isInvalid],
        ["art11", [fields.art11.visible && fields.art11.required ? ew.Validators.required(fields.art11.caption) : null], fields.art11.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null], fields.ctn.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
        ["size_desc", [fields.size_desc.visible && fields.size_desc.required ? ew.Validators.required(fields.size_desc.caption) : null], fields.size_desc.isInvalid],
        ["color_desc", [fields.color_desc.visible && fields.color_desc.required ? ew.Validators.required(fields.color_desc.caption) : null], fields.color_desc.isInvalid],
        ["size_code", [fields.size_code.visible && fields.size_code.required ? ew.Validators.required(fields.size_code.caption) : null], fields.size_code.isInvalid],
        ["season", [fields.season.visible && fields.season.required ? ew.Validators.required(fields.season.caption) : null], fields.season.isInvalid],
        ["no_box", [fields.no_box.visible && fields.no_box.required ? ew.Validators.required(fields.no_box.caption) : null], fields.no_box.isInvalid],
        ["location_2nd", [fields.location_2nd.visible && fields.location_2nd.required ? ew.Validators.required(fields.location_2nd.caption) : null], fields.location_2nd.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    fextra_stockedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fextra_stockedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fextra_stockedit.lists.article = <?= $Page->article->toClientList($Page) ?>;
    loadjs.done("fextra_stockedit");
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
<form name="fextra_stockedit" id="fextra_stockedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="extra_stock">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_extra_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_extra_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="extra_stock" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->week->Visible) { // week ?>
    <div id="r_week"<?= $Page->week->rowAttributes() ?>>
        <label id="elh_extra_stock_week" for="x_week" class="<?= $Page->LeftColumnClass ?>"><?= $Page->week->caption() ?><?= $Page->week->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->week->cellAttributes() ?>>
<span id="el_extra_stock_week">
<input type="<?= $Page->week->getInputTextType() ?>" name="x_week" id="x_week" data-table="extra_stock" data-field="x_week" value="<?= $Page->week->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->week->getPlaceHolder()) ?>"<?= $Page->week->editAttributes() ?> aria-describedby="x_week_help">
<?= $Page->week->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->week->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->art6->Visible) { // art6 ?>
    <div id="r_art6"<?= $Page->art6->rowAttributes() ?>>
        <label id="elh_extra_stock_art6" for="x_art6" class="<?= $Page->LeftColumnClass ?>"><?= $Page->art6->caption() ?><?= $Page->art6->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->art6->cellAttributes() ?>>
<span id="el_extra_stock_art6">
<input type="<?= $Page->art6->getInputTextType() ?>" name="x_art6" id="x_art6" data-table="extra_stock" data-field="x_art6" value="<?= $Page->art6->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->art6->getPlaceHolder()) ?>"<?= $Page->art6->editAttributes() ?> aria-describedby="x_art6_help">
<?= $Page->art6->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->art6->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->art9->Visible) { // art9 ?>
    <div id="r_art9"<?= $Page->art9->rowAttributes() ?>>
        <label id="elh_extra_stock_art9" for="x_art9" class="<?= $Page->LeftColumnClass ?>"><?= $Page->art9->caption() ?><?= $Page->art9->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->art9->cellAttributes() ?>>
<span id="el_extra_stock_art9">
<input type="<?= $Page->art9->getInputTextType() ?>" name="x_art9" id="x_art9" data-table="extra_stock" data-field="x_art9" value="<?= $Page->art9->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->art9->getPlaceHolder()) ?>"<?= $Page->art9->editAttributes() ?> aria-describedby="x_art9_help">
<?= $Page->art9->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->art9->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->art11->Visible) { // art11 ?>
    <div id="r_art11"<?= $Page->art11->rowAttributes() ?>>
        <label id="elh_extra_stock_art11" for="x_art11" class="<?= $Page->LeftColumnClass ?>"><?= $Page->art11->caption() ?><?= $Page->art11->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->art11->cellAttributes() ?>>
<span id="el_extra_stock_art11">
<input type="<?= $Page->art11->getInputTextType() ?>" name="x_art11" id="x_art11" data-table="extra_stock" data-field="x_art11" value="<?= $Page->art11->EditValue ?>" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->art11->getPlaceHolder()) ?>"<?= $Page->art11->editAttributes() ?> aria-describedby="x_art11_help">
<?= $Page->art11->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->art11->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_extra_stock_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_extra_stock_article">
<?php
$onchange = $Page->article->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->article->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->article->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_article" class="ew-auto-suggest">
    <input type="<?= $Page->article->getInputTextType() ?>" class="form-control" name="sv_x_article" id="sv_x_article" value="<?= RemoveHtml($Page->article->EditValue) ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
</span>
<selection-list hidden class="form-control" data-table="extra_stock" data-field="x_article" data-input="sv_x_article" data-value-separator="<?= $Page->article->displayValueSeparatorAttribute() ?>" name="x_article" id="x_article" value="<?= HtmlEncode($Page->article->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
<script>
loadjs.ready("fextra_stockedit", function() {
    fextra_stockedit.createAutoSuggest(Object.assign({"id":"x_article","forceSelect":true}, ew.vars.tables.extra_stock.fields.article.autoSuggestOptions));
});
</script>
<?= $Page->article->Lookup->getParamTag($Page, "p_x_article") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_extra_stock_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<span id="el_extra_stock_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="extra_stock" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_extra_stock_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<span id="el_extra_stock_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="extra_stock" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_extra_stock_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_extra_stock_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="extra_stock" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <div id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <label id="elh_extra_stock_size_desc" for="x_size_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_desc->caption() ?><?= $Page->size_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_extra_stock_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->size_desc->getDisplayValue($Page->size_desc->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="extra_stock" data-field="x_size_desc" data-hidden="1" name="x_size_desc" id="x_size_desc" value="<?= HtmlEncode($Page->size_desc->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <div id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <label id="elh_extra_stock_color_desc" for="x_color_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_desc->caption() ?><?= $Page->color_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_extra_stock_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->color_desc->getDisplayValue($Page->color_desc->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="extra_stock" data-field="x_color_desc" data-hidden="1" name="x_color_desc" id="x_color_desc" value="<?= HtmlEncode($Page->color_desc->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <div id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <label id="elh_extra_stock_size_code" for="x_size_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_code->caption() ?><?= $Page->size_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_code->cellAttributes() ?>>
<span id="el_extra_stock_size_code">
<span<?= $Page->size_code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->size_code->getDisplayValue($Page->size_code->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="extra_stock" data-field="x_size_code" data-hidden="1" name="x_size_code" id="x_size_code" value="<?= HtmlEncode($Page->size_code->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
    <div id="r_season"<?= $Page->season->rowAttributes() ?>>
        <label id="elh_extra_stock_season" for="x_season" class="<?= $Page->LeftColumnClass ?>"><?= $Page->season->caption() ?><?= $Page->season->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->season->cellAttributes() ?>>
<span id="el_extra_stock_season">
<span<?= $Page->season->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->season->getDisplayValue($Page->season->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="extra_stock" data-field="x_season" data-hidden="1" name="x_season" id="x_season" value="<?= HtmlEncode($Page->season->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
    <div id="r_no_box"<?= $Page->no_box->rowAttributes() ?>>
        <label id="elh_extra_stock_no_box" for="x_no_box" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_box->caption() ?><?= $Page->no_box->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_box->cellAttributes() ?>>
<span id="el_extra_stock_no_box">
<input type="<?= $Page->no_box->getInputTextType() ?>" name="x_no_box" id="x_no_box" data-table="extra_stock" data-field="x_no_box" value="<?= $Page->no_box->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->no_box->getPlaceHolder()) ?>"<?= $Page->no_box->editAttributes() ?> aria-describedby="x_no_box_help">
<?= $Page->no_box->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_box->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location_2nd->Visible) { // location_2nd ?>
    <div id="r_location_2nd"<?= $Page->location_2nd->rowAttributes() ?>>
        <label id="elh_extra_stock_location_2nd" for="x_location_2nd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_2nd->caption() ?><?= $Page->location_2nd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location_2nd->cellAttributes() ?>>
<span id="el_extra_stock_location_2nd">
<input type="<?= $Page->location_2nd->getInputTextType() ?>" name="x_location_2nd" id="x_location_2nd" data-table="extra_stock" data-field="x_location_2nd" value="<?= $Page->location_2nd->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->location_2nd->getPlaceHolder()) ?>"<?= $Page->location_2nd->editAttributes() ?> aria-describedby="x_location_2nd_help">
<?= $Page->location_2nd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_2nd->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_extra_stock_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_extra_stock_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="extra_stock" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" maxlength="45" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fextra_stockedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fextra_stockedit", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("extra_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>

<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$UserEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { user: currentTable } });
var currentForm, currentPageID;
var fuseredit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuseredit = new ew.Form("fuseredit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fuseredit;

    // Add fields
    var fields = currentTable.fields;
    fuseredit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["ip_loggedin", [fields.ip_loggedin.visible && fields.ip_loggedin.required ? ew.Validators.required(fields.ip_loggedin.caption) : null], fields.ip_loggedin.isInvalid],
        ["role", [fields.role.visible && fields.role.required ? ew.Validators.required(fields.role.caption) : null], fields.role.isInvalid],
        ["_userLevel", [fields._userLevel.visible && fields._userLevel.required ? ew.Validators.required(fields._userLevel.caption) : null], fields._userLevel.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    fuseredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuseredit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fuseredit.lists.role = <?= $Page->role->toClientList($Page) ?>;
    fuseredit.lists._userLevel = <?= $Page->_userLevel->toClientList($Page) ?>;
    loadjs.done("fuseredit");
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
<form name="fuseredit" id="fuseredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_user_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="user" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username"<?= $Page->_username->rowAttributes() ?>>
        <label id="elh_user__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_username->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("edit")) { // Non system admin ?>
<span<?= $Page->_username->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->_username->getDisplayValue($Page->_username->EditValue))) ?>"></span>
<input type="hidden" data-table="user" data-field="x__username" data-hidden="1" name="x__username" id="x__username" value="<?= HtmlEncode($Page->_username->CurrentValue) ?>">
<?php } else { ?>
<span id="el_user__username">
<input type="<?= $Page->_username->getInputTextType() ?>" name="x__username" id="x__username" data-table="user" data-field="x__username" value="<?= $Page->_username->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_user__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_user__password">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="user" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_user__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_user__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="user" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
    <div id="r_role"<?= $Page->role->rowAttributes() ?>>
        <label id="elh_user_role" for="x_role" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role->caption() ?><?= $Page->role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role->cellAttributes() ?>>
<span id="el_user_role">
<?php $Page->role->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_role"
        name="x_role"
        class="form-select ew-select<?= $Page->role->isInvalidClass() ?>"
        data-select2-id="fuseredit_x_role"
        data-table="user"
        data-field="x_role"
        data-value-separator="<?= $Page->role->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->role->getPlaceHolder()) ?>"
        <?= $Page->role->editAttributes() ?>>
        <?= $Page->role->selectOptionListHtml("x_role") ?>
    </select>
    <?= $Page->role->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->role->getErrorMessage() ?></div>
<?= $Page->role->Lookup->getParamTag($Page, "p_x_role") ?>
<script>
loadjs.ready("fuseredit", function() {
    var options = { name: "x_role", selectId: "fuseredit_x_role" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fuseredit.lists.role.lookupOptions.length) {
        options.data = { id: "x_role", form: "fuseredit" };
    } else {
        options.ajax = { id: "x_role", form: "fuseredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.user.fields.role.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_userLevel->Visible) { // userLevel ?>
    <div id="r__userLevel"<?= $Page->_userLevel->rowAttributes() ?>>
        <label id="elh_user__userLevel" for="x__userLevel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_userLevel->caption() ?><?= $Page->_userLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_userLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user__userLevel">
<span class="form-control-plaintext"><?= $Page->_userLevel->getDisplayValue($Page->_userLevel->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_user__userLevel">
    <select
        id="x__userLevel"
        name="x__userLevel"
        class="form-select ew-select<?= $Page->_userLevel->isInvalidClass() ?>"
        data-select2-id="fuseredit_x__userLevel"
        data-table="user"
        data-field="x__userLevel"
        data-value-separator="<?= $Page->_userLevel->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->_userLevel->getPlaceHolder()) ?>"
        <?= $Page->_userLevel->editAttributes() ?>>
        <?= $Page->_userLevel->selectOptionListHtml("x__userLevel") ?>
    </select>
    <?= $Page->_userLevel->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->_userLevel->getErrorMessage() ?></div>
<?= $Page->_userLevel->Lookup->getParamTag($Page, "p_x__userLevel") ?>
<script>
loadjs.ready("fuseredit", function() {
    var options = { name: "x__userLevel", selectId: "fuseredit_x__userLevel" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fuseredit.lists._userLevel.lookupOptions.length) {
        options.data = { id: "x__userLevel", form: "fuseredit" };
    } else {
        options.ajax = { id: "x__userLevel", form: "fuseredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.user.fields._userLevel.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
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
    ew.addEventHandlers("user");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>

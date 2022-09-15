<?php
namespace PHPMaker2020\sismed911;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$cie10dx_edit = new cie10dx_edit();

// Run the page
$cie10dx_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cie10dx_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcie10dxedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcie10dxedit = currentForm = new ew.Form("fcie10dxedit", "edit");

	// Validate form
	fcie10dxedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($cie10dx_edit->codcie10->Required) { ?>
				elm = this.getElements("x" + infix + "_codcie10");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->codcie10->caption(), $cie10dx_edit->codcie10->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cie10dx_edit->dx_es->Required) { ?>
				elm = this.getElements("x" + infix + "_dx_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->dx_es->caption(), $cie10dx_edit->dx_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cie10dx_edit->dx_en->Required) { ?>
				elm = this.getElements("x" + infix + "_dx_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->dx_en->caption(), $cie10dx_edit->dx_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cie10dx_edit->dx_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_dx_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->dx_pr->caption(), $cie10dx_edit->dx_pr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cie10dx_edit->dx_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_dx_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->dx_fr->caption(), $cie10dx_edit->dx_fr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cie10dx_edit->dxsoat->Required) { ?>
				elm = this.getElements("x" + infix + "_dxsoat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->dxsoat->caption(), $cie10dx_edit->dxsoat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cie10dx_edit->iddx->Required) { ?>
				elm = this.getElements("x" + infix + "_iddx");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cie10dx_edit->iddx->caption(), $cie10dx_edit->iddx->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcie10dxedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcie10dxedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcie10dxedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cie10dx_edit->showPageHeader(); ?>
<?php
$cie10dx_edit->showMessage();
?>
<form name="fcie10dxedit" id="fcie10dxedit" class="<?php echo $cie10dx_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cie10dx">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cie10dx_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cie10dx_edit->codcie10->Visible) { // codcie10 ?>
	<div id="r_codcie10" class="form-group row">
		<label id="elh_cie10dx_codcie10" for="x_codcie10" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->codcie10->caption() ?><?php echo $cie10dx_edit->codcie10->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->codcie10->cellAttributes() ?>>
<span id="el_cie10dx_codcie10">
<input type="text" data-table="cie10dx" data-field="x_codcie10" name="x_codcie10" id="x_codcie10" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($cie10dx_edit->codcie10->getPlaceHolder()) ?>" value="<?php echo $cie10dx_edit->codcie10->EditValue ?>"<?php echo $cie10dx_edit->codcie10->editAttributes() ?>>
</span>
<?php echo $cie10dx_edit->codcie10->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cie10dx_edit->dx_es->Visible) { // dx_es ?>
	<div id="r_dx_es" class="form-group row">
		<label id="elh_cie10dx_dx_es" for="x_dx_es" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->dx_es->caption() ?><?php echo $cie10dx_edit->dx_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->dx_es->cellAttributes() ?>>
<span id="el_cie10dx_dx_es">
<textarea data-table="cie10dx" data-field="x_dx_es" name="x_dx_es" id="x_dx_es" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cie10dx_edit->dx_es->getPlaceHolder()) ?>"<?php echo $cie10dx_edit->dx_es->editAttributes() ?>><?php echo $cie10dx_edit->dx_es->EditValue ?></textarea>
</span>
<?php echo $cie10dx_edit->dx_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cie10dx_edit->dx_en->Visible) { // dx_en ?>
	<div id="r_dx_en" class="form-group row">
		<label id="elh_cie10dx_dx_en" for="x_dx_en" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->dx_en->caption() ?><?php echo $cie10dx_edit->dx_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->dx_en->cellAttributes() ?>>
<span id="el_cie10dx_dx_en">
<textarea data-table="cie10dx" data-field="x_dx_en" name="x_dx_en" id="x_dx_en" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cie10dx_edit->dx_en->getPlaceHolder()) ?>"<?php echo $cie10dx_edit->dx_en->editAttributes() ?>><?php echo $cie10dx_edit->dx_en->EditValue ?></textarea>
</span>
<?php echo $cie10dx_edit->dx_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cie10dx_edit->dx_pr->Visible) { // dx_pr ?>
	<div id="r_dx_pr" class="form-group row">
		<label id="elh_cie10dx_dx_pr" for="x_dx_pr" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->dx_pr->caption() ?><?php echo $cie10dx_edit->dx_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->dx_pr->cellAttributes() ?>>
<span id="el_cie10dx_dx_pr">
<textarea data-table="cie10dx" data-field="x_dx_pr" name="x_dx_pr" id="x_dx_pr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cie10dx_edit->dx_pr->getPlaceHolder()) ?>"<?php echo $cie10dx_edit->dx_pr->editAttributes() ?>><?php echo $cie10dx_edit->dx_pr->EditValue ?></textarea>
</span>
<?php echo $cie10dx_edit->dx_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cie10dx_edit->dx_fr->Visible) { // dx_fr ?>
	<div id="r_dx_fr" class="form-group row">
		<label id="elh_cie10dx_dx_fr" for="x_dx_fr" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->dx_fr->caption() ?><?php echo $cie10dx_edit->dx_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->dx_fr->cellAttributes() ?>>
<span id="el_cie10dx_dx_fr">
<textarea data-table="cie10dx" data-field="x_dx_fr" name="x_dx_fr" id="x_dx_fr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cie10dx_edit->dx_fr->getPlaceHolder()) ?>"<?php echo $cie10dx_edit->dx_fr->editAttributes() ?>><?php echo $cie10dx_edit->dx_fr->EditValue ?></textarea>
</span>
<?php echo $cie10dx_edit->dx_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cie10dx_edit->dxsoat->Visible) { // dxsoat ?>
	<div id="r_dxsoat" class="form-group row">
		<label id="elh_cie10dx_dxsoat" for="x_dxsoat" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->dxsoat->caption() ?><?php echo $cie10dx_edit->dxsoat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->dxsoat->cellAttributes() ?>>
<span id="el_cie10dx_dxsoat">
<textarea data-table="cie10dx" data-field="x_dxsoat" name="x_dxsoat" id="x_dxsoat" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cie10dx_edit->dxsoat->getPlaceHolder()) ?>"<?php echo $cie10dx_edit->dxsoat->editAttributes() ?>><?php echo $cie10dx_edit->dxsoat->EditValue ?></textarea>
</span>
<?php echo $cie10dx_edit->dxsoat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cie10dx_edit->iddx->Visible) { // iddx ?>
	<div id="r_iddx" class="form-group row">
		<label id="elh_cie10dx_iddx" class="<?php echo $cie10dx_edit->LeftColumnClass ?>"><?php echo $cie10dx_edit->iddx->caption() ?><?php echo $cie10dx_edit->iddx->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cie10dx_edit->RightColumnClass ?>"><div <?php echo $cie10dx_edit->iddx->cellAttributes() ?>>
<span id="el_cie10dx_iddx">
<span<?php echo $cie10dx_edit->iddx->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cie10dx_edit->iddx->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cie10dx" data-field="x_iddx" name="x_iddx" id="x_iddx" value="<?php echo HtmlEncode($cie10dx_edit->iddx->CurrentValue) ?>">
<?php echo $cie10dx_edit->iddx->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cie10dx_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cie10dx_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cie10dx_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cie10dx_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$cie10dx_edit->terminate();
?>
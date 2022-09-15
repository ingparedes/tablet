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
$terminos_edit = new terminos_edit();

// Run the page
$terminos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terminos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterminosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fterminosedit = currentForm = new ew.Form("fterminosedit", "edit");

	// Validate form
	fterminosedit.validate = function() {
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
			<?php if ($terminos_edit->id_terminos->Required) { ?>
				elm = this.getElements("x" + infix + "_id_terminos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_edit->id_terminos->caption(), $terminos_edit->id_terminos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_edit->texto_terminos_es->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_edit->texto_terminos_es->caption(), $terminos_edit->texto_terminos_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_edit->texto_terminos_en->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_edit->texto_terminos_en->caption(), $terminos_edit->texto_terminos_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_edit->texto_terminos_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_edit->texto_terminos_fr->caption(), $terminos_edit->texto_terminos_fr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_edit->texto_terminos_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_edit->texto_terminos_pr->caption(), $terminos_edit->texto_terminos_pr->RequiredErrorMessage)) ?>");
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
	fterminosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fterminosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fterminosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terminos_edit->showPageHeader(); ?>
<?php
$terminos_edit->showMessage();
?>
<form name="fterminosedit" id="fterminosedit" class="<?php echo $terminos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terminos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$terminos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($terminos_edit->id_terminos->Visible) { // id_terminos ?>
	<div id="r_id_terminos" class="form-group row">
		<label id="elh_terminos_id_terminos" class="<?php echo $terminos_edit->LeftColumnClass ?>"><?php echo $terminos_edit->id_terminos->caption() ?><?php echo $terminos_edit->id_terminos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_edit->RightColumnClass ?>"><div <?php echo $terminos_edit->id_terminos->cellAttributes() ?>>
<span id="el_terminos_id_terminos">
<span<?php echo $terminos_edit->id_terminos->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($terminos_edit->id_terminos->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="terminos" data-field="x_id_terminos" name="x_id_terminos" id="x_id_terminos" value="<?php echo HtmlEncode($terminos_edit->id_terminos->CurrentValue) ?>">
<?php echo $terminos_edit->id_terminos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_edit->texto_terminos_es->Visible) { // texto_terminos_es ?>
	<div id="r_texto_terminos_es" class="form-group row">
		<label id="elh_terminos_texto_terminos_es" class="<?php echo $terminos_edit->LeftColumnClass ?>"><?php echo $terminos_edit->texto_terminos_es->caption() ?><?php echo $terminos_edit->texto_terminos_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_edit->RightColumnClass ?>"><div <?php echo $terminos_edit->texto_terminos_es->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_es">
<?php $terminos_edit->texto_terminos_es->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_es" name="x_texto_terminos_es" id="x_texto_terminos_es" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_edit->texto_terminos_es->getPlaceHolder()) ?>"<?php echo $terminos_edit->texto_terminos_es->editAttributes() ?>><?php echo $terminos_edit->texto_terminos_es->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosedit", "editor"], function() {
	ew.createEditor("fterminosedit", "x_texto_terminos_es", 35, 4, <?php echo $terminos_edit->texto_terminos_es->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_edit->texto_terminos_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_edit->texto_terminos_en->Visible) { // texto_terminos_en ?>
	<div id="r_texto_terminos_en" class="form-group row">
		<label id="elh_terminos_texto_terminos_en" class="<?php echo $terminos_edit->LeftColumnClass ?>"><?php echo $terminos_edit->texto_terminos_en->caption() ?><?php echo $terminos_edit->texto_terminos_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_edit->RightColumnClass ?>"><div <?php echo $terminos_edit->texto_terminos_en->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_en">
<?php $terminos_edit->texto_terminos_en->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_en" name="x_texto_terminos_en" id="x_texto_terminos_en" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_edit->texto_terminos_en->getPlaceHolder()) ?>"<?php echo $terminos_edit->texto_terminos_en->editAttributes() ?>><?php echo $terminos_edit->texto_terminos_en->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosedit", "editor"], function() {
	ew.createEditor("fterminosedit", "x_texto_terminos_en", 35, 4, <?php echo $terminos_edit->texto_terminos_en->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_edit->texto_terminos_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_edit->texto_terminos_fr->Visible) { // texto_terminos_fr ?>
	<div id="r_texto_terminos_fr" class="form-group row">
		<label id="elh_terminos_texto_terminos_fr" class="<?php echo $terminos_edit->LeftColumnClass ?>"><?php echo $terminos_edit->texto_terminos_fr->caption() ?><?php echo $terminos_edit->texto_terminos_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_edit->RightColumnClass ?>"><div <?php echo $terminos_edit->texto_terminos_fr->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_fr">
<?php $terminos_edit->texto_terminos_fr->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_fr" name="x_texto_terminos_fr" id="x_texto_terminos_fr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_edit->texto_terminos_fr->getPlaceHolder()) ?>"<?php echo $terminos_edit->texto_terminos_fr->editAttributes() ?>><?php echo $terminos_edit->texto_terminos_fr->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosedit", "editor"], function() {
	ew.createEditor("fterminosedit", "x_texto_terminos_fr", 35, 4, <?php echo $terminos_edit->texto_terminos_fr->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_edit->texto_terminos_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_edit->texto_terminos_pr->Visible) { // texto_terminos_pr ?>
	<div id="r_texto_terminos_pr" class="form-group row">
		<label id="elh_terminos_texto_terminos_pr" class="<?php echo $terminos_edit->LeftColumnClass ?>"><?php echo $terminos_edit->texto_terminos_pr->caption() ?><?php echo $terminos_edit->texto_terminos_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_edit->RightColumnClass ?>"><div <?php echo $terminos_edit->texto_terminos_pr->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_pr">
<?php $terminos_edit->texto_terminos_pr->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_pr" name="x_texto_terminos_pr" id="x_texto_terminos_pr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_edit->texto_terminos_pr->getPlaceHolder()) ?>"<?php echo $terminos_edit->texto_terminos_pr->editAttributes() ?>><?php echo $terminos_edit->texto_terminos_pr->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosedit", "editor"], function() {
	ew.createEditor("fterminosedit", "x_texto_terminos_pr", 35, 4, <?php echo $terminos_edit->texto_terminos_pr->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_edit->texto_terminos_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$terminos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terminos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terminos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$terminos_edit->showPageFooter();
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
$terminos_edit->terminate();
?>
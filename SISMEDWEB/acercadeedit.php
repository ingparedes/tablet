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
$acercade_edit = new acercade_edit();

// Run the page
$acercade_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acercade_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facercadeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	facercadeedit = currentForm = new ew.Form("facercadeedit", "edit");

	// Validate form
	facercadeedit.validate = function() {
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
			<?php if ($acercade_edit->id_acerca->Required) { ?>
				elm = this.getElements("x" + infix + "_id_acerca");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acercade_edit->id_acerca->caption(), $acercade_edit->id_acerca->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acercade_edit->texto_es->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acercade_edit->texto_es->caption(), $acercade_edit->texto_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acercade_edit->texto_en->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acercade_edit->texto_en->caption(), $acercade_edit->texto_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acercade_edit->texto_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acercade_edit->texto_fr->caption(), $acercade_edit->texto_fr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acercade_edit->texto_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acercade_edit->texto_pr->caption(), $acercade_edit->texto_pr->RequiredErrorMessage)) ?>");
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
	facercadeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facercadeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facercadeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acercade_edit->showPageHeader(); ?>
<?php
$acercade_edit->showMessage();
?>
<form name="facercadeedit" id="facercadeedit" class="<?php echo $acercade_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acercade">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$acercade_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($acercade_edit->id_acerca->Visible) { // id_acerca ?>
	<div id="r_id_acerca" class="form-group row">
		<label id="elh_acercade_id_acerca" class="<?php echo $acercade_edit->LeftColumnClass ?>"><?php echo $acercade_edit->id_acerca->caption() ?><?php echo $acercade_edit->id_acerca->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acercade_edit->RightColumnClass ?>"><div <?php echo $acercade_edit->id_acerca->cellAttributes() ?>>
<span id="el_acercade_id_acerca">
<span<?php echo $acercade_edit->id_acerca->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($acercade_edit->id_acerca->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="acercade" data-field="x_id_acerca" name="x_id_acerca" id="x_id_acerca" value="<?php echo HtmlEncode($acercade_edit->id_acerca->CurrentValue) ?>">
<?php echo $acercade_edit->id_acerca->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acercade_edit->texto_es->Visible) { // texto_es ?>
	<div id="r_texto_es" class="form-group row">
		<label id="elh_acercade_texto_es" class="<?php echo $acercade_edit->LeftColumnClass ?>"><?php echo $acercade_edit->texto_es->caption() ?><?php echo $acercade_edit->texto_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acercade_edit->RightColumnClass ?>"><div <?php echo $acercade_edit->texto_es->cellAttributes() ?>>
<span id="el_acercade_texto_es">
<?php $acercade_edit->texto_es->EditAttrs->appendClass("editor"); ?>
<textarea data-table="acercade" data-field="x_texto_es" name="x_texto_es" id="x_texto_es" cols="35" rows="4" placeholder="<?php echo HtmlEncode($acercade_edit->texto_es->getPlaceHolder()) ?>"<?php echo $acercade_edit->texto_es->editAttributes() ?>><?php echo $acercade_edit->texto_es->EditValue ?></textarea>
<script>
loadjs.ready(["facercadeedit", "editor"], function() {
	ew.createEditor("facercadeedit", "x_texto_es", 35, 4, <?php echo $acercade_edit->texto_es->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $acercade_edit->texto_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acercade_edit->texto_en->Visible) { // texto_en ?>
	<div id="r_texto_en" class="form-group row">
		<label id="elh_acercade_texto_en" class="<?php echo $acercade_edit->LeftColumnClass ?>"><?php echo $acercade_edit->texto_en->caption() ?><?php echo $acercade_edit->texto_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acercade_edit->RightColumnClass ?>"><div <?php echo $acercade_edit->texto_en->cellAttributes() ?>>
<span id="el_acercade_texto_en">
<?php $acercade_edit->texto_en->EditAttrs->appendClass("editor"); ?>
<textarea data-table="acercade" data-field="x_texto_en" name="x_texto_en" id="x_texto_en" cols="35" rows="4" placeholder="<?php echo HtmlEncode($acercade_edit->texto_en->getPlaceHolder()) ?>"<?php echo $acercade_edit->texto_en->editAttributes() ?>><?php echo $acercade_edit->texto_en->EditValue ?></textarea>
<script>
loadjs.ready(["facercadeedit", "editor"], function() {
	ew.createEditor("facercadeedit", "x_texto_en", 35, 4, <?php echo $acercade_edit->texto_en->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $acercade_edit->texto_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acercade_edit->texto_fr->Visible) { // texto_fr ?>
	<div id="r_texto_fr" class="form-group row">
		<label id="elh_acercade_texto_fr" class="<?php echo $acercade_edit->LeftColumnClass ?>"><?php echo $acercade_edit->texto_fr->caption() ?><?php echo $acercade_edit->texto_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acercade_edit->RightColumnClass ?>"><div <?php echo $acercade_edit->texto_fr->cellAttributes() ?>>
<span id="el_acercade_texto_fr">
<?php $acercade_edit->texto_fr->EditAttrs->appendClass("editor"); ?>
<textarea data-table="acercade" data-field="x_texto_fr" name="x_texto_fr" id="x_texto_fr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($acercade_edit->texto_fr->getPlaceHolder()) ?>"<?php echo $acercade_edit->texto_fr->editAttributes() ?>><?php echo $acercade_edit->texto_fr->EditValue ?></textarea>
<script>
loadjs.ready(["facercadeedit", "editor"], function() {
	ew.createEditor("facercadeedit", "x_texto_fr", 35, 4, <?php echo $acercade_edit->texto_fr->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $acercade_edit->texto_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acercade_edit->texto_pr->Visible) { // texto_pr ?>
	<div id="r_texto_pr" class="form-group row">
		<label id="elh_acercade_texto_pr" class="<?php echo $acercade_edit->LeftColumnClass ?>"><?php echo $acercade_edit->texto_pr->caption() ?><?php echo $acercade_edit->texto_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acercade_edit->RightColumnClass ?>"><div <?php echo $acercade_edit->texto_pr->cellAttributes() ?>>
<span id="el_acercade_texto_pr">
<?php $acercade_edit->texto_pr->EditAttrs->appendClass("editor"); ?>
<textarea data-table="acercade" data-field="x_texto_pr" name="x_texto_pr" id="x_texto_pr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($acercade_edit->texto_pr->getPlaceHolder()) ?>"<?php echo $acercade_edit->texto_pr->editAttributes() ?>><?php echo $acercade_edit->texto_pr->EditValue ?></textarea>
<script>
loadjs.ready(["facercadeedit", "editor"], function() {
	ew.createEditor("facercadeedit", "x_texto_pr", 35, 4, <?php echo $acercade_edit->texto_pr->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $acercade_edit->texto_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acercade_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acercade_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acercade_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$acercade_edit->showPageFooter();
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
$acercade_edit->terminate();
?>
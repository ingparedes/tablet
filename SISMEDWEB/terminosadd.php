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
$terminos_add = new terminos_add();

// Run the page
$terminos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terminos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterminosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fterminosadd = currentForm = new ew.Form("fterminosadd", "add");

	// Validate form
	fterminosadd.validate = function() {
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
			<?php if ($terminos_add->texto_terminos_es->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_add->texto_terminos_es->caption(), $terminos_add->texto_terminos_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_add->texto_terminos_en->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_add->texto_terminos_en->caption(), $terminos_add->texto_terminos_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_add->texto_terminos_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_add->texto_terminos_fr->caption(), $terminos_add->texto_terminos_fr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terminos_add->texto_terminos_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_texto_terminos_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terminos_add->texto_terminos_pr->caption(), $terminos_add->texto_terminos_pr->RequiredErrorMessage)) ?>");
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
	fterminosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fterminosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fterminosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terminos_add->showPageHeader(); ?>
<?php
$terminos_add->showMessage();
?>
<form name="fterminosadd" id="fterminosadd" class="<?php echo $terminos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terminos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$terminos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($terminos_add->texto_terminos_es->Visible) { // texto_terminos_es ?>
	<div id="r_texto_terminos_es" class="form-group row">
		<label id="elh_terminos_texto_terminos_es" class="<?php echo $terminos_add->LeftColumnClass ?>"><?php echo $terminos_add->texto_terminos_es->caption() ?><?php echo $terminos_add->texto_terminos_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_add->RightColumnClass ?>"><div <?php echo $terminos_add->texto_terminos_es->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_es">
<?php $terminos_add->texto_terminos_es->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_es" name="x_texto_terminos_es" id="x_texto_terminos_es" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_add->texto_terminos_es->getPlaceHolder()) ?>"<?php echo $terminos_add->texto_terminos_es->editAttributes() ?>><?php echo $terminos_add->texto_terminos_es->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosadd", "editor"], function() {
	ew.createEditor("fterminosadd", "x_texto_terminos_es", 35, 4, <?php echo $terminos_add->texto_terminos_es->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_add->texto_terminos_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_add->texto_terminos_en->Visible) { // texto_terminos_en ?>
	<div id="r_texto_terminos_en" class="form-group row">
		<label id="elh_terminos_texto_terminos_en" class="<?php echo $terminos_add->LeftColumnClass ?>"><?php echo $terminos_add->texto_terminos_en->caption() ?><?php echo $terminos_add->texto_terminos_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_add->RightColumnClass ?>"><div <?php echo $terminos_add->texto_terminos_en->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_en">
<?php $terminos_add->texto_terminos_en->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_en" name="x_texto_terminos_en" id="x_texto_terminos_en" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_add->texto_terminos_en->getPlaceHolder()) ?>"<?php echo $terminos_add->texto_terminos_en->editAttributes() ?>><?php echo $terminos_add->texto_terminos_en->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosadd", "editor"], function() {
	ew.createEditor("fterminosadd", "x_texto_terminos_en", 35, 4, <?php echo $terminos_add->texto_terminos_en->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_add->texto_terminos_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_add->texto_terminos_fr->Visible) { // texto_terminos_fr ?>
	<div id="r_texto_terminos_fr" class="form-group row">
		<label id="elh_terminos_texto_terminos_fr" class="<?php echo $terminos_add->LeftColumnClass ?>"><?php echo $terminos_add->texto_terminos_fr->caption() ?><?php echo $terminos_add->texto_terminos_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_add->RightColumnClass ?>"><div <?php echo $terminos_add->texto_terminos_fr->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_fr">
<?php $terminos_add->texto_terminos_fr->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_fr" name="x_texto_terminos_fr" id="x_texto_terminos_fr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_add->texto_terminos_fr->getPlaceHolder()) ?>"<?php echo $terminos_add->texto_terminos_fr->editAttributes() ?>><?php echo $terminos_add->texto_terminos_fr->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosadd", "editor"], function() {
	ew.createEditor("fterminosadd", "x_texto_terminos_fr", 35, 4, <?php echo $terminos_add->texto_terminos_fr->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_add->texto_terminos_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terminos_add->texto_terminos_pr->Visible) { // texto_terminos_pr ?>
	<div id="r_texto_terminos_pr" class="form-group row">
		<label id="elh_terminos_texto_terminos_pr" class="<?php echo $terminos_add->LeftColumnClass ?>"><?php echo $terminos_add->texto_terminos_pr->caption() ?><?php echo $terminos_add->texto_terminos_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terminos_add->RightColumnClass ?>"><div <?php echo $terminos_add->texto_terminos_pr->cellAttributes() ?>>
<span id="el_terminos_texto_terminos_pr">
<?php $terminos_add->texto_terminos_pr->EditAttrs->appendClass("editor"); ?>
<textarea data-table="terminos" data-field="x_texto_terminos_pr" name="x_texto_terminos_pr" id="x_texto_terminos_pr" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terminos_add->texto_terminos_pr->getPlaceHolder()) ?>"<?php echo $terminos_add->texto_terminos_pr->editAttributes() ?>><?php echo $terminos_add->texto_terminos_pr->EditValue ?></textarea>
<script>
loadjs.ready(["fterminosadd", "editor"], function() {
	ew.createEditor("fterminosadd", "x_texto_terminos_pr", 35, 4, <?php echo $terminos_add->texto_terminos_pr->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $terminos_add->texto_terminos_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$terminos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terminos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terminos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$terminos_add->showPageFooter();
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
$terminos_add->terminate();
?>
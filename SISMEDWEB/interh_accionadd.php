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
$interh_accion_add = new interh_accion_add();

// Run the page
$interh_accion_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$interh_accion_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finterh_accionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	finterh_accionadd = currentForm = new ew.Form("finterh_accionadd", "add");

	// Validate form
	finterh_accionadd.validate = function() {
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
			<?php if ($interh_accion_add->nombre_accion_es->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_accion_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $interh_accion_add->nombre_accion_es->caption(), $interh_accion_add->nombre_accion_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($interh_accion_add->nombre_accion_en->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_accion_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $interh_accion_add->nombre_accion_en->caption(), $interh_accion_add->nombre_accion_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($interh_accion_add->nombre_accion_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_accion_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $interh_accion_add->nombre_accion_fr->caption(), $interh_accion_add->nombre_accion_fr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($interh_accion_add->nombre_accion_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_accion_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $interh_accion_add->nombre_accion_pr->caption(), $interh_accion_add->nombre_accion_pr->RequiredErrorMessage)) ?>");
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
	finterh_accionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finterh_accionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("finterh_accionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $interh_accion_add->showPageHeader(); ?>
<?php
$interh_accion_add->showMessage();
?>
<form name="finterh_accionadd" id="finterh_accionadd" class="<?php echo $interh_accion_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="interh_accion">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$interh_accion_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($interh_accion_add->nombre_accion_es->Visible) { // nombre_accion_es ?>
	<div id="r_nombre_accion_es" class="form-group row">
		<label id="elh_interh_accion_nombre_accion_es" for="x_nombre_accion_es" class="<?php echo $interh_accion_add->LeftColumnClass ?>"><?php echo $interh_accion_add->nombre_accion_es->caption() ?><?php echo $interh_accion_add->nombre_accion_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $interh_accion_add->RightColumnClass ?>"><div <?php echo $interh_accion_add->nombre_accion_es->cellAttributes() ?>>
<span id="el_interh_accion_nombre_accion_es">
<input type="text" data-table="interh_accion" data-field="x_nombre_accion_es" name="x_nombre_accion_es" id="x_nombre_accion_es" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($interh_accion_add->nombre_accion_es->getPlaceHolder()) ?>" value="<?php echo $interh_accion_add->nombre_accion_es->EditValue ?>"<?php echo $interh_accion_add->nombre_accion_es->editAttributes() ?>>
</span>
<?php echo $interh_accion_add->nombre_accion_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($interh_accion_add->nombre_accion_en->Visible) { // nombre_accion_en ?>
	<div id="r_nombre_accion_en" class="form-group row">
		<label id="elh_interh_accion_nombre_accion_en" for="x_nombre_accion_en" class="<?php echo $interh_accion_add->LeftColumnClass ?>"><?php echo $interh_accion_add->nombre_accion_en->caption() ?><?php echo $interh_accion_add->nombre_accion_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $interh_accion_add->RightColumnClass ?>"><div <?php echo $interh_accion_add->nombre_accion_en->cellAttributes() ?>>
<span id="el_interh_accion_nombre_accion_en">
<input type="text" data-table="interh_accion" data-field="x_nombre_accion_en" name="x_nombre_accion_en" id="x_nombre_accion_en" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($interh_accion_add->nombre_accion_en->getPlaceHolder()) ?>" value="<?php echo $interh_accion_add->nombre_accion_en->EditValue ?>"<?php echo $interh_accion_add->nombre_accion_en->editAttributes() ?>>
</span>
<?php echo $interh_accion_add->nombre_accion_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($interh_accion_add->nombre_accion_fr->Visible) { // nombre_accion_fr ?>
	<div id="r_nombre_accion_fr" class="form-group row">
		<label id="elh_interh_accion_nombre_accion_fr" for="x_nombre_accion_fr" class="<?php echo $interh_accion_add->LeftColumnClass ?>"><?php echo $interh_accion_add->nombre_accion_fr->caption() ?><?php echo $interh_accion_add->nombre_accion_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $interh_accion_add->RightColumnClass ?>"><div <?php echo $interh_accion_add->nombre_accion_fr->cellAttributes() ?>>
<span id="el_interh_accion_nombre_accion_fr">
<input type="text" data-table="interh_accion" data-field="x_nombre_accion_fr" name="x_nombre_accion_fr" id="x_nombre_accion_fr" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($interh_accion_add->nombre_accion_fr->getPlaceHolder()) ?>" value="<?php echo $interh_accion_add->nombre_accion_fr->EditValue ?>"<?php echo $interh_accion_add->nombre_accion_fr->editAttributes() ?>>
</span>
<?php echo $interh_accion_add->nombre_accion_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($interh_accion_add->nombre_accion_pr->Visible) { // nombre_accion_pr ?>
	<div id="r_nombre_accion_pr" class="form-group row">
		<label id="elh_interh_accion_nombre_accion_pr" for="x_nombre_accion_pr" class="<?php echo $interh_accion_add->LeftColumnClass ?>"><?php echo $interh_accion_add->nombre_accion_pr->caption() ?><?php echo $interh_accion_add->nombre_accion_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $interh_accion_add->RightColumnClass ?>"><div <?php echo $interh_accion_add->nombre_accion_pr->cellAttributes() ?>>
<span id="el_interh_accion_nombre_accion_pr">
<input type="text" data-table="interh_accion" data-field="x_nombre_accion_pr" name="x_nombre_accion_pr" id="x_nombre_accion_pr" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($interh_accion_add->nombre_accion_pr->getPlaceHolder()) ?>" value="<?php echo $interh_accion_add->nombre_accion_pr->EditValue ?>"<?php echo $interh_accion_add->nombre_accion_pr->editAttributes() ?>>
</span>
<?php echo $interh_accion_add->nombre_accion_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$interh_accion_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $interh_accion_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $interh_accion_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$interh_accion_add->showPageFooter();
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
$interh_accion_add->terminate();
?>
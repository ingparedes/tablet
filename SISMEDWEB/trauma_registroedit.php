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
$trauma_registro_edit = new trauma_registro_edit();

// Run the page
$trauma_registro_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trauma_registro_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftrauma_registroedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftrauma_registroedit = currentForm = new ew.Form("ftrauma_registroedit", "edit");

	// Validate form
	ftrauma_registroedit.validate = function() {
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
			<?php if ($trauma_registro_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trauma_registro_edit->id->caption(), $trauma_registro_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($trauma_registro_edit->cod_casopreh->Required) { ?>
				elm = this.getElements("x" + infix + "_cod_casopreh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trauma_registro_edit->cod_casopreh->caption(), $trauma_registro_edit->cod_casopreh->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cod_casopreh");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($trauma_registro_edit->cod_casopreh->errorMessage()) ?>");
			<?php if ($trauma_registro_edit->causa_trauma_registro->Required) { ?>
				elm = this.getElements("x" + infix + "_causa_trauma_registro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trauma_registro_edit->causa_trauma_registro->caption(), $trauma_registro_edit->causa_trauma_registro->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_causa_trauma_registro");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($trauma_registro_edit->causa_trauma_registro->errorMessage()) ?>");

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
	ftrauma_registroedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftrauma_registroedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftrauma_registroedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $trauma_registro_edit->showPageHeader(); ?>
<?php
$trauma_registro_edit->showMessage();
?>
<form name="ftrauma_registroedit" id="ftrauma_registroedit" class="<?php echo $trauma_registro_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trauma_registro">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$trauma_registro_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($trauma_registro_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_trauma_registro_id" class="<?php echo $trauma_registro_edit->LeftColumnClass ?>"><?php echo $trauma_registro_edit->id->caption() ?><?php echo $trauma_registro_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trauma_registro_edit->RightColumnClass ?>"><div <?php echo $trauma_registro_edit->id->cellAttributes() ?>>
<span id="el_trauma_registro_id">
<span<?php echo $trauma_registro_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($trauma_registro_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="trauma_registro" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($trauma_registro_edit->id->CurrentValue) ?>">
<?php echo $trauma_registro_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trauma_registro_edit->cod_casopreh->Visible) { // cod_casopreh ?>
	<div id="r_cod_casopreh" class="form-group row">
		<label id="elh_trauma_registro_cod_casopreh" for="x_cod_casopreh" class="<?php echo $trauma_registro_edit->LeftColumnClass ?>"><?php echo $trauma_registro_edit->cod_casopreh->caption() ?><?php echo $trauma_registro_edit->cod_casopreh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trauma_registro_edit->RightColumnClass ?>"><div <?php echo $trauma_registro_edit->cod_casopreh->cellAttributes() ?>>
<span id="el_trauma_registro_cod_casopreh">
<input type="text" data-table="trauma_registro" data-field="x_cod_casopreh" name="x_cod_casopreh" id="x_cod_casopreh" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($trauma_registro_edit->cod_casopreh->getPlaceHolder()) ?>" value="<?php echo $trauma_registro_edit->cod_casopreh->EditValue ?>"<?php echo $trauma_registro_edit->cod_casopreh->editAttributes() ?>>
</span>
<?php echo $trauma_registro_edit->cod_casopreh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trauma_registro_edit->causa_trauma_registro->Visible) { // causa_trauma_registro ?>
	<div id="r_causa_trauma_registro" class="form-group row">
		<label id="elh_trauma_registro_causa_trauma_registro" for="x_causa_trauma_registro" class="<?php echo $trauma_registro_edit->LeftColumnClass ?>"><?php echo $trauma_registro_edit->causa_trauma_registro->caption() ?><?php echo $trauma_registro_edit->causa_trauma_registro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trauma_registro_edit->RightColumnClass ?>"><div <?php echo $trauma_registro_edit->causa_trauma_registro->cellAttributes() ?>>
<span id="el_trauma_registro_causa_trauma_registro">
<input type="text" data-table="trauma_registro" data-field="x_causa_trauma_registro" name="x_causa_trauma_registro" id="x_causa_trauma_registro" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($trauma_registro_edit->causa_trauma_registro->getPlaceHolder()) ?>" value="<?php echo $trauma_registro_edit->causa_trauma_registro->EditValue ?>"<?php echo $trauma_registro_edit->causa_trauma_registro->editAttributes() ?>>
</span>
<?php echo $trauma_registro_edit->causa_trauma_registro->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$trauma_registro_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trauma_registro_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trauma_registro_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trauma_registro_edit->showPageFooter();
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
$trauma_registro_edit->terminate();
?>
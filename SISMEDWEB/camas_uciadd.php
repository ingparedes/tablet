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
$camas_uci_add = new camas_uci_add();

// Run the page
$camas_uci_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$camas_uci_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcamas_uciadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcamas_uciadd = currentForm = new ew.Form("fcamas_uciadd", "add");

	// Validate form
	fcamas_uciadd.validate = function() {
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
			<?php if ($camas_uci_add->ocupadas->Required) { ?>
				elm = this.getElements("x" + infix + "_ocupadas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $camas_uci_add->ocupadas->caption(), $camas_uci_add->ocupadas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ocupadas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($camas_uci_add->ocupadas->errorMessage()) ?>");
			<?php if ($camas_uci_add->sin_servicio->Required) { ?>
				elm = this.getElements("x" + infix + "_sin_servicio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $camas_uci_add->sin_servicio->caption(), $camas_uci_add->sin_servicio->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sin_servicio");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($camas_uci_add->sin_servicio->errorMessage()) ?>");
			<?php if ($camas_uci_add->libres->Required) { ?>
				elm = this.getElements("x" + infix + "_libres");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $camas_uci_add->libres->caption(), $camas_uci_add->libres->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_libres");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($camas_uci_add->libres->errorMessage()) ?>");
			<?php if ($camas_uci_add->id_camas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_camas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $camas_uci_add->id_camas->caption(), $camas_uci_add->id_camas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_camas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($camas_uci_add->id_camas->errorMessage()) ?>");

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
	fcamas_uciadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcamas_uciadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcamas_uciadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $camas_uci_add->showPageHeader(); ?>
<?php
$camas_uci_add->showMessage();
?>
<form name="fcamas_uciadd" id="fcamas_uciadd" class="<?php echo $camas_uci_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="camas_uci">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$camas_uci_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($camas_uci_add->ocupadas->Visible) { // ocupadas ?>
	<div id="r_ocupadas" class="form-group row">
		<label id="elh_camas_uci_ocupadas" for="x_ocupadas" class="<?php echo $camas_uci_add->LeftColumnClass ?>"><?php echo $camas_uci_add->ocupadas->caption() ?><?php echo $camas_uci_add->ocupadas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $camas_uci_add->RightColumnClass ?>"><div <?php echo $camas_uci_add->ocupadas->cellAttributes() ?>>
<span id="el_camas_uci_ocupadas">
<input type="text" data-table="camas_uci" data-field="x_ocupadas" name="x_ocupadas" id="x_ocupadas" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($camas_uci_add->ocupadas->getPlaceHolder()) ?>" value="<?php echo $camas_uci_add->ocupadas->EditValue ?>"<?php echo $camas_uci_add->ocupadas->editAttributes() ?>>
</span>
<?php echo $camas_uci_add->ocupadas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($camas_uci_add->sin_servicio->Visible) { // sin_servicio ?>
	<div id="r_sin_servicio" class="form-group row">
		<label id="elh_camas_uci_sin_servicio" for="x_sin_servicio" class="<?php echo $camas_uci_add->LeftColumnClass ?>"><?php echo $camas_uci_add->sin_servicio->caption() ?><?php echo $camas_uci_add->sin_servicio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $camas_uci_add->RightColumnClass ?>"><div <?php echo $camas_uci_add->sin_servicio->cellAttributes() ?>>
<span id="el_camas_uci_sin_servicio">
<input type="text" data-table="camas_uci" data-field="x_sin_servicio" name="x_sin_servicio" id="x_sin_servicio" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($camas_uci_add->sin_servicio->getPlaceHolder()) ?>" value="<?php echo $camas_uci_add->sin_servicio->EditValue ?>"<?php echo $camas_uci_add->sin_servicio->editAttributes() ?>>
</span>
<?php echo $camas_uci_add->sin_servicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($camas_uci_add->libres->Visible) { // libres ?>
	<div id="r_libres" class="form-group row">
		<label id="elh_camas_uci_libres" for="x_libres" class="<?php echo $camas_uci_add->LeftColumnClass ?>"><?php echo $camas_uci_add->libres->caption() ?><?php echo $camas_uci_add->libres->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $camas_uci_add->RightColumnClass ?>"><div <?php echo $camas_uci_add->libres->cellAttributes() ?>>
<span id="el_camas_uci_libres">
<input type="text" data-table="camas_uci" data-field="x_libres" name="x_libres" id="x_libres" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($camas_uci_add->libres->getPlaceHolder()) ?>" value="<?php echo $camas_uci_add->libres->EditValue ?>"<?php echo $camas_uci_add->libres->editAttributes() ?>>
</span>
<?php echo $camas_uci_add->libres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($camas_uci_add->id_camas->Visible) { // id_camas ?>
	<div id="r_id_camas" class="form-group row">
		<label id="elh_camas_uci_id_camas" for="x_id_camas" class="<?php echo $camas_uci_add->LeftColumnClass ?>"><?php echo $camas_uci_add->id_camas->caption() ?><?php echo $camas_uci_add->id_camas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $camas_uci_add->RightColumnClass ?>"><div <?php echo $camas_uci_add->id_camas->cellAttributes() ?>>
<span id="el_camas_uci_id_camas">
<input type="text" data-table="camas_uci" data-field="x_id_camas" name="x_id_camas" id="x_id_camas" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($camas_uci_add->id_camas->getPlaceHolder()) ?>" value="<?php echo $camas_uci_add->id_camas->EditValue ?>"<?php echo $camas_uci_add->id_camas->editAttributes() ?>>
</span>
<?php echo $camas_uci_add->id_camas->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$camas_uci_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $camas_uci_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $camas_uci_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$camas_uci_add->showPageFooter();
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
$camas_uci_add->terminate();
?>
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
$ambulancia_taller_add = new ambulancia_taller_add();

// Run the page
$ambulancia_taller_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ambulancia_taller_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fambulancia_talleradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fambulancia_talleradd = currentForm = new ew.Form("fambulancia_talleradd", "add");

	// Validate form
	fambulancia_talleradd.validate = function() {
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
			<?php if ($ambulancia_taller_add->nombre_taller->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_taller");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ambulancia_taller_add->nombre_taller->caption(), $ambulancia_taller_add->nombre_taller->RequiredErrorMessage)) ?>");
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
	fambulancia_talleradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fambulancia_talleradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fambulancia_talleradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ambulancia_taller_add->showPageHeader(); ?>
<?php
$ambulancia_taller_add->showMessage();
?>
<form name="fambulancia_talleradd" id="fambulancia_talleradd" class="<?php echo $ambulancia_taller_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ambulancia_taller">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ambulancia_taller_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ambulancia_taller_add->nombre_taller->Visible) { // nombre_taller ?>
	<div id="r_nombre_taller" class="form-group row">
		<label id="elh_ambulancia_taller_nombre_taller" for="x_nombre_taller" class="<?php echo $ambulancia_taller_add->LeftColumnClass ?>"><?php echo $ambulancia_taller_add->nombre_taller->caption() ?><?php echo $ambulancia_taller_add->nombre_taller->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ambulancia_taller_add->RightColumnClass ?>"><div <?php echo $ambulancia_taller_add->nombre_taller->cellAttributes() ?>>
<span id="el_ambulancia_taller_nombre_taller">
<input type="text" data-table="ambulancia_taller" data-field="x_nombre_taller" name="x_nombre_taller" id="x_nombre_taller" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($ambulancia_taller_add->nombre_taller->getPlaceHolder()) ?>" value="<?php echo $ambulancia_taller_add->nombre_taller->EditValue ?>"<?php echo $ambulancia_taller_add->nombre_taller->editAttributes() ?>>
</span>
<?php echo $ambulancia_taller_add->nombre_taller->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ambulancia_taller_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ambulancia_taller_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ambulancia_taller_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ambulancia_taller_add->showPageFooter();
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
$ambulancia_taller_add->terminate();
?>
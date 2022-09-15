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
$sector_hospital_edit = new sector_hospital_edit();

// Run the page
$sector_hospital_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sector_hospital_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsector_hospitaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsector_hospitaledit = currentForm = new ew.Form("fsector_hospitaledit", "edit");

	// Validate form
	fsector_hospitaledit.validate = function() {
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
			<?php if ($sector_hospital_edit->id_sector->Required) { ?>
				elm = this.getElements("x" + infix + "_id_sector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sector_hospital_edit->id_sector->caption(), $sector_hospital_edit->id_sector->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sector_hospital_edit->nombre_sector->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_sector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sector_hospital_edit->nombre_sector->caption(), $sector_hospital_edit->nombre_sector->RequiredErrorMessage)) ?>");
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
	fsector_hospitaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsector_hospitaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsector_hospitaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sector_hospital_edit->showPageHeader(); ?>
<?php
$sector_hospital_edit->showMessage();
?>
<form name="fsector_hospitaledit" id="fsector_hospitaledit" class="<?php echo $sector_hospital_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sector_hospital">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$sector_hospital_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($sector_hospital_edit->id_sector->Visible) { // id_sector ?>
	<div id="r_id_sector" class="form-group row">
		<label id="elh_sector_hospital_id_sector" class="<?php echo $sector_hospital_edit->LeftColumnClass ?>"><?php echo $sector_hospital_edit->id_sector->caption() ?><?php echo $sector_hospital_edit->id_sector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sector_hospital_edit->RightColumnClass ?>"><div <?php echo $sector_hospital_edit->id_sector->cellAttributes() ?>>
<span id="el_sector_hospital_id_sector">
<span<?php echo $sector_hospital_edit->id_sector->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($sector_hospital_edit->id_sector->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="sector_hospital" data-field="x_id_sector" name="x_id_sector" id="x_id_sector" value="<?php echo HtmlEncode($sector_hospital_edit->id_sector->CurrentValue) ?>">
<?php echo $sector_hospital_edit->id_sector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sector_hospital_edit->nombre_sector->Visible) { // nombre_sector ?>
	<div id="r_nombre_sector" class="form-group row">
		<label id="elh_sector_hospital_nombre_sector" for="x_nombre_sector" class="<?php echo $sector_hospital_edit->LeftColumnClass ?>"><?php echo $sector_hospital_edit->nombre_sector->caption() ?><?php echo $sector_hospital_edit->nombre_sector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sector_hospital_edit->RightColumnClass ?>"><div <?php echo $sector_hospital_edit->nombre_sector->cellAttributes() ?>>
<span id="el_sector_hospital_nombre_sector">
<input type="text" data-table="sector_hospital" data-field="x_nombre_sector" name="x_nombre_sector" id="x_nombre_sector" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($sector_hospital_edit->nombre_sector->getPlaceHolder()) ?>" value="<?php echo $sector_hospital_edit->nombre_sector->EditValue ?>"<?php echo $sector_hospital_edit->nombre_sector->editAttributes() ?>>
</span>
<?php echo $sector_hospital_edit->nombre_sector->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sector_hospital_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sector_hospital_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sector_hospital_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sector_hospital_edit->showPageFooter();
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
$sector_hospital_edit->terminate();
?>
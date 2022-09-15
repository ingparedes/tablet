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
$causa_trauma_categoria_edit = new causa_trauma_categoria_edit();

// Run the page
$causa_trauma_categoria_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$causa_trauma_categoria_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcausa_trauma_categoriaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcausa_trauma_categoriaedit = currentForm = new ew.Form("fcausa_trauma_categoriaedit", "edit");

	// Validate form
	fcausa_trauma_categoriaedit.validate = function() {
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
			<?php if ($causa_trauma_categoria_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $causa_trauma_categoria_edit->id->caption(), $causa_trauma_categoria_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($causa_trauma_categoria_edit->causa_trauma->Required) { ?>
				elm = this.getElements("x" + infix + "_causa_trauma");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $causa_trauma_categoria_edit->causa_trauma->caption(), $causa_trauma_categoria_edit->causa_trauma->RequiredErrorMessage)) ?>");
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
	fcausa_trauma_categoriaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcausa_trauma_categoriaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcausa_trauma_categoriaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $causa_trauma_categoria_edit->showPageHeader(); ?>
<?php
$causa_trauma_categoria_edit->showMessage();
?>
<form name="fcausa_trauma_categoriaedit" id="fcausa_trauma_categoriaedit" class="<?php echo $causa_trauma_categoria_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="causa_trauma_categoria">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$causa_trauma_categoria_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($causa_trauma_categoria_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_causa_trauma_categoria_id" class="<?php echo $causa_trauma_categoria_edit->LeftColumnClass ?>"><?php echo $causa_trauma_categoria_edit->id->caption() ?><?php echo $causa_trauma_categoria_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $causa_trauma_categoria_edit->RightColumnClass ?>"><div <?php echo $causa_trauma_categoria_edit->id->cellAttributes() ?>>
<span id="el_causa_trauma_categoria_id">
<span<?php echo $causa_trauma_categoria_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($causa_trauma_categoria_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="causa_trauma_categoria" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($causa_trauma_categoria_edit->id->CurrentValue) ?>">
<?php echo $causa_trauma_categoria_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($causa_trauma_categoria_edit->causa_trauma->Visible) { // causa_trauma ?>
	<div id="r_causa_trauma" class="form-group row">
		<label id="elh_causa_trauma_categoria_causa_trauma" for="x_causa_trauma" class="<?php echo $causa_trauma_categoria_edit->LeftColumnClass ?>"><?php echo $causa_trauma_categoria_edit->causa_trauma->caption() ?><?php echo $causa_trauma_categoria_edit->causa_trauma->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $causa_trauma_categoria_edit->RightColumnClass ?>"><div <?php echo $causa_trauma_categoria_edit->causa_trauma->cellAttributes() ?>>
<span id="el_causa_trauma_categoria_causa_trauma">
<input type="text" data-table="causa_trauma_categoria" data-field="x_causa_trauma" name="x_causa_trauma" id="x_causa_trauma" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($causa_trauma_categoria_edit->causa_trauma->getPlaceHolder()) ?>" value="<?php echo $causa_trauma_categoria_edit->causa_trauma->EditValue ?>"<?php echo $causa_trauma_categoria_edit->causa_trauma->editAttributes() ?>>
</span>
<?php echo $causa_trauma_categoria_edit->causa_trauma->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$causa_trauma_categoria_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $causa_trauma_categoria_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $causa_trauma_categoria_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$causa_trauma_categoria_edit->showPageFooter();
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
$causa_trauma_categoria_edit->terminate();
?>
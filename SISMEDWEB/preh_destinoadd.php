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
$preh_destino_add = new preh_destino_add();

// Run the page
$preh_destino_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$preh_destino_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpreh_destinoadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpreh_destinoadd = currentForm = new ew.Form("fpreh_destinoadd", "add");

	// Validate form
	fpreh_destinoadd.validate = function() {
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
			<?php if ($preh_destino_add->cod_casopreh->Required) { ?>
				elm = this.getElements("x" + infix + "_cod_casopreh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preh_destino_add->cod_casopreh->caption(), $preh_destino_add->cod_casopreh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($preh_destino_add->cod_hospitaldestino->Required) { ?>
				elm = this.getElements("x" + infix + "_cod_hospitaldestino");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preh_destino_add->cod_hospitaldestino->caption(), $preh_destino_add->cod_hospitaldestino->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($preh_destino_add->nom_medicorecibe->Required) { ?>
				elm = this.getElements("x" + infix + "_nom_medicorecibe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preh_destino_add->nom_medicorecibe->caption(), $preh_destino_add->nom_medicorecibe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($preh_destino_add->telefono_medico->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono_medico");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preh_destino_add->telefono_medico->caption(), $preh_destino_add->telefono_medico->RequiredErrorMessage)) ?>");
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
	fpreh_destinoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpreh_destinoadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpreh_destinoadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $preh_destino_add->showPageHeader(); ?>
<?php
$preh_destino_add->showMessage();
?>
<form name="fpreh_destinoadd" id="fpreh_destinoadd" class="<?php echo $preh_destino_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="preh_destino">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$preh_destino_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($preh_destino_add->cod_casopreh->Visible) { // cod_casopreh ?>
	<div id="r_cod_casopreh" class="form-group row">
		<label id="elh_preh_destino_cod_casopreh" for="x_cod_casopreh" class="<?php echo $preh_destino_add->LeftColumnClass ?>"><?php echo $preh_destino_add->cod_casopreh->caption() ?><?php echo $preh_destino_add->cod_casopreh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preh_destino_add->RightColumnClass ?>"><div <?php echo $preh_destino_add->cod_casopreh->cellAttributes() ?>>
<span id="el_preh_destino_cod_casopreh">
<input type="text" data-table="preh_destino" data-field="x_cod_casopreh" name="x_cod_casopreh" id="x_cod_casopreh" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($preh_destino_add->cod_casopreh->getPlaceHolder()) ?>" value="<?php echo $preh_destino_add->cod_casopreh->EditValue ?>"<?php echo $preh_destino_add->cod_casopreh->editAttributes() ?>>
</span>
<?php echo $preh_destino_add->cod_casopreh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preh_destino_add->cod_hospitaldestino->Visible) { // cod_hospitaldestino ?>
	<div id="r_cod_hospitaldestino" class="form-group row">
		<label id="elh_preh_destino_cod_hospitaldestino" for="x_cod_hospitaldestino" class="<?php echo $preh_destino_add->LeftColumnClass ?>"><?php echo $preh_destino_add->cod_hospitaldestino->caption() ?><?php echo $preh_destino_add->cod_hospitaldestino->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preh_destino_add->RightColumnClass ?>"><div <?php echo $preh_destino_add->cod_hospitaldestino->cellAttributes() ?>>
<span id="el_preh_destino_cod_hospitaldestino">
<input type="text" data-table="preh_destino" data-field="x_cod_hospitaldestino" name="x_cod_hospitaldestino" id="x_cod_hospitaldestino" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($preh_destino_add->cod_hospitaldestino->getPlaceHolder()) ?>" value="<?php echo $preh_destino_add->cod_hospitaldestino->EditValue ?>"<?php echo $preh_destino_add->cod_hospitaldestino->editAttributes() ?>>
</span>
<?php echo $preh_destino_add->cod_hospitaldestino->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preh_destino_add->nom_medicorecibe->Visible) { // nom_medicorecibe ?>
	<div id="r_nom_medicorecibe" class="form-group row">
		<label id="elh_preh_destino_nom_medicorecibe" for="x_nom_medicorecibe" class="<?php echo $preh_destino_add->LeftColumnClass ?>"><?php echo $preh_destino_add->nom_medicorecibe->caption() ?><?php echo $preh_destino_add->nom_medicorecibe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preh_destino_add->RightColumnClass ?>"><div <?php echo $preh_destino_add->nom_medicorecibe->cellAttributes() ?>>
<span id="el_preh_destino_nom_medicorecibe">
<input type="text" data-table="preh_destino" data-field="x_nom_medicorecibe" name="x_nom_medicorecibe" id="x_nom_medicorecibe" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($preh_destino_add->nom_medicorecibe->getPlaceHolder()) ?>" value="<?php echo $preh_destino_add->nom_medicorecibe->EditValue ?>"<?php echo $preh_destino_add->nom_medicorecibe->editAttributes() ?>>
</span>
<?php echo $preh_destino_add->nom_medicorecibe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preh_destino_add->telefono_medico->Visible) { // telefono_medico ?>
	<div id="r_telefono_medico" class="form-group row">
		<label id="elh_preh_destino_telefono_medico" for="x_telefono_medico" class="<?php echo $preh_destino_add->LeftColumnClass ?>"><?php echo $preh_destino_add->telefono_medico->caption() ?><?php echo $preh_destino_add->telefono_medico->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preh_destino_add->RightColumnClass ?>"><div <?php echo $preh_destino_add->telefono_medico->cellAttributes() ?>>
<span id="el_preh_destino_telefono_medico">
<input type="text" data-table="preh_destino" data-field="x_telefono_medico" name="x_telefono_medico" id="x_telefono_medico" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($preh_destino_add->telefono_medico->getPlaceHolder()) ?>" value="<?php echo $preh_destino_add->telefono_medico->EditValue ?>"<?php echo $preh_destino_add->telefono_medico->editAttributes() ?>>
</span>
<?php echo $preh_destino_add->telefono_medico->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$preh_destino_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $preh_destino_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $preh_destino_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$preh_destino_add->showPageFooter();
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
$preh_destino_add->terminate();
?>
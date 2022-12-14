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
$asigna_ambulancia_add = new asigna_ambulancia_add();

// Run the page
$asigna_ambulancia_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asigna_ambulancia_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fasigna_ambulanciaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fasigna_ambulanciaadd = currentForm = new ew.Form("fasigna_ambulanciaadd", "add");

	// Validate form
	fasigna_ambulanciaadd.validate = function() {
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
			<?php if ($asigna_ambulancia_add->id_ambulancias->Required) { ?>
				elm = this.getElements("x" + infix + "_id_ambulancias");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->id_ambulancias->caption(), $asigna_ambulancia_add->id_ambulancias->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_ambulancias");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->id_ambulancias->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->cod_ambulancias->Required) { ?>
				elm = this.getElements("x" + infix + "_cod_ambulancias");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->cod_ambulancias->caption(), $asigna_ambulancia_add->cod_ambulancias->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->placas->Required) { ?>
				elm = this.getElements("x" + infix + "_placas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->placas->caption(), $asigna_ambulancia_add->placas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->chasis->Required) { ?>
				elm = this.getElements("x" + infix + "_chasis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->chasis->caption(), $asigna_ambulancia_add->chasis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->marca->Required) { ?>
				elm = this.getElements("x" + infix + "_marca");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->marca->caption(), $asigna_ambulancia_add->marca->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->modelo->Required) { ?>
				elm = this.getElements("x" + infix + "_modelo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->modelo->caption(), $asigna_ambulancia_add->modelo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->tipo_translado->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_translado");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->tipo_translado->caption(), $asigna_ambulancia_add->tipo_translado->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tipo_translado");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->tipo_translado->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->tipo_conbustible->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_conbustible");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->tipo_conbustible->caption(), $asigna_ambulancia_add->tipo_conbustible->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->modalidad->Required) { ?>
				elm = this.getElements("x" + infix + "_modalidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->modalidad->caption(), $asigna_ambulancia_add->modalidad->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_modalidad");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->modalidad->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->estado->Required) { ?>
				elm = this.getElements("x" + infix + "_estado");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->estado->caption(), $asigna_ambulancia_add->estado->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_estado");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->estado->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->ubicacion->Required) { ?>
				elm = this.getElements("x" + infix + "_ubicacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->ubicacion->caption(), $asigna_ambulancia_add->ubicacion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->disponible->Required) { ?>
				elm = this.getElements("x" + infix + "_disponible");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->disponible->caption(), $asigna_ambulancia_add->disponible->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->fecha_iniseguro->Required) { ?>
				elm = this.getElements("x" + infix + "_fecha_iniseguro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->fecha_iniseguro->caption(), $asigna_ambulancia_add->fecha_iniseguro->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fecha_iniseguro");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->fecha_iniseguro->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->fecha_finseguro->Required) { ?>
				elm = this.getElements("x" + infix + "_fecha_finseguro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->fecha_finseguro->caption(), $asigna_ambulancia_add->fecha_finseguro->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fecha_finseguro");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->fecha_finseguro->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->entidad->Required) { ?>
				elm = this.getElements("x" + infix + "_entidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->entidad->caption(), $asigna_ambulancia_add->entidad->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->observacion->Required) { ?>
				elm = this.getElements("x" + infix + "_observacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->observacion->caption(), $asigna_ambulancia_add->observacion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->asiganda->Required) { ?>
				elm = this.getElements("x" + infix + "_asiganda");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->asiganda->caption(), $asigna_ambulancia_add->asiganda->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->config_manteni->Required) { ?>
				elm = this.getElements("x" + infix + "_config_manteni");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->config_manteni->caption(), $asigna_ambulancia_add->config_manteni->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->fecha_creacion->Required) { ?>
				elm = this.getElements("x" + infix + "_fecha_creacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->fecha_creacion->caption(), $asigna_ambulancia_add->fecha_creacion->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fecha_creacion");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->fecha_creacion->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->longitudambulancia->Required) { ?>
				elm = this.getElements("x" + infix + "_longitudambulancia");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->longitudambulancia->caption(), $asigna_ambulancia_add->longitudambulancia->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->latituambulancia->Required) { ?>
				elm = this.getElements("x" + infix + "_latituambulancia");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->latituambulancia->caption(), $asigna_ambulancia_add->latituambulancia->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->especial->Required) { ?>
				elm = this.getElements("x" + infix + "_especial");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->especial->caption(), $asigna_ambulancia_add->especial->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_especial");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->especial->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->id_tipotransport->Required) { ?>
				elm = this.getElements("x" + infix + "_id_tipotransport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->id_tipotransport->caption(), $asigna_ambulancia_add->id_tipotransport->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_tipotransport");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->id_tipotransport->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->tipo_amb_es->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_amb_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->tipo_amb_es->caption(), $asigna_ambulancia_add->tipo_amb_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->tipo_amb_en->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_amb_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->tipo_amb_en->caption(), $asigna_ambulancia_add->tipo_amb_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->tipo_amb_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_amb_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->tipo_amb_pr->caption(), $asigna_ambulancia_add->tipo_amb_pr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->tipo_amb_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_amb_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->tipo_amb_fr->caption(), $asigna_ambulancia_add->tipo_amb_fr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->codigo->Required) { ?>
				elm = this.getElements("x" + infix + "_codigo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->codigo->caption(), $asigna_ambulancia_add->codigo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->id_especialambulancia->Required) { ?>
				elm = this.getElements("x" + infix + "_id_especialambulancia");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->id_especialambulancia->caption(), $asigna_ambulancia_add->id_especialambulancia->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_especialambulancia");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asigna_ambulancia_add->id_especialambulancia->errorMessage()) ?>");
			<?php if ($asigna_ambulancia_add->especial_es->Required) { ?>
				elm = this.getElements("x" + infix + "_especial_es");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->especial_es->caption(), $asigna_ambulancia_add->especial_es->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->especial_en->Required) { ?>
				elm = this.getElements("x" + infix + "_especial_en");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->especial_en->caption(), $asigna_ambulancia_add->especial_en->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->especial_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_especial_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->especial_pr->caption(), $asigna_ambulancia_add->especial_pr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asigna_ambulancia_add->especial_fr->Required) { ?>
				elm = this.getElements("x" + infix + "_especial_fr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asigna_ambulancia_add->especial_fr->caption(), $asigna_ambulancia_add->especial_fr->RequiredErrorMessage)) ?>");
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
	fasigna_ambulanciaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fasigna_ambulanciaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fasigna_ambulanciaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asigna_ambulancia_add->showPageHeader(); ?>
<?php
$asigna_ambulancia_add->showMessage();
?>
<form name="fasigna_ambulanciaadd" id="fasigna_ambulanciaadd" class="<?php echo $asigna_ambulancia_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asigna_ambulancia">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$asigna_ambulancia_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($asigna_ambulancia_add->id_ambulancias->Visible) { // id_ambulancias ?>
	<div id="r_id_ambulancias" class="form-group row">
		<label id="elh_asigna_ambulancia_id_ambulancias" for="x_id_ambulancias" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->id_ambulancias->caption() ?><?php echo $asigna_ambulancia_add->id_ambulancias->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->id_ambulancias->cellAttributes() ?>>
<span id="el_asigna_ambulancia_id_ambulancias">
<input type="text" data-table="asigna_ambulancia" data-field="x_id_ambulancias" name="x_id_ambulancias" id="x_id_ambulancias" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->id_ambulancias->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->id_ambulancias->EditValue ?>"<?php echo $asigna_ambulancia_add->id_ambulancias->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->id_ambulancias->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->cod_ambulancias->Visible) { // cod_ambulancias ?>
	<div id="r_cod_ambulancias" class="form-group row">
		<label id="elh_asigna_ambulancia_cod_ambulancias" for="x_cod_ambulancias" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->cod_ambulancias->caption() ?><?php echo $asigna_ambulancia_add->cod_ambulancias->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->cod_ambulancias->cellAttributes() ?>>
<span id="el_asigna_ambulancia_cod_ambulancias">
<input type="text" data-table="asigna_ambulancia" data-field="x_cod_ambulancias" name="x_cod_ambulancias" id="x_cod_ambulancias" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->cod_ambulancias->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->cod_ambulancias->EditValue ?>"<?php echo $asigna_ambulancia_add->cod_ambulancias->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->cod_ambulancias->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->placas->Visible) { // placas ?>
	<div id="r_placas" class="form-group row">
		<label id="elh_asigna_ambulancia_placas" for="x_placas" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->placas->caption() ?><?php echo $asigna_ambulancia_add->placas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->placas->cellAttributes() ?>>
<span id="el_asigna_ambulancia_placas">
<input type="text" data-table="asigna_ambulancia" data-field="x_placas" name="x_placas" id="x_placas" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->placas->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->placas->EditValue ?>"<?php echo $asigna_ambulancia_add->placas->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->placas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->chasis->Visible) { // chasis ?>
	<div id="r_chasis" class="form-group row">
		<label id="elh_asigna_ambulancia_chasis" for="x_chasis" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->chasis->caption() ?><?php echo $asigna_ambulancia_add->chasis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->chasis->cellAttributes() ?>>
<span id="el_asigna_ambulancia_chasis">
<input type="text" data-table="asigna_ambulancia" data-field="x_chasis" name="x_chasis" id="x_chasis" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->chasis->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->chasis->EditValue ?>"<?php echo $asigna_ambulancia_add->chasis->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->chasis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->marca->Visible) { // marca ?>
	<div id="r_marca" class="form-group row">
		<label id="elh_asigna_ambulancia_marca" for="x_marca" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->marca->caption() ?><?php echo $asigna_ambulancia_add->marca->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->marca->cellAttributes() ?>>
<span id="el_asigna_ambulancia_marca">
<input type="text" data-table="asigna_ambulancia" data-field="x_marca" name="x_marca" id="x_marca" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->marca->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->marca->EditValue ?>"<?php echo $asigna_ambulancia_add->marca->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->marca->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->modelo->Visible) { // modelo ?>
	<div id="r_modelo" class="form-group row">
		<label id="elh_asigna_ambulancia_modelo" for="x_modelo" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->modelo->caption() ?><?php echo $asigna_ambulancia_add->modelo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->modelo->cellAttributes() ?>>
<span id="el_asigna_ambulancia_modelo">
<input type="text" data-table="asigna_ambulancia" data-field="x_modelo" name="x_modelo" id="x_modelo" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->modelo->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->modelo->EditValue ?>"<?php echo $asigna_ambulancia_add->modelo->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->modelo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->tipo_translado->Visible) { // tipo_translado ?>
	<div id="r_tipo_translado" class="form-group row">
		<label id="elh_asigna_ambulancia_tipo_translado" for="x_tipo_translado" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->tipo_translado->caption() ?><?php echo $asigna_ambulancia_add->tipo_translado->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->tipo_translado->cellAttributes() ?>>
<span id="el_asigna_ambulancia_tipo_translado">
<input type="text" data-table="asigna_ambulancia" data-field="x_tipo_translado" name="x_tipo_translado" id="x_tipo_translado" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->tipo_translado->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->tipo_translado->EditValue ?>"<?php echo $asigna_ambulancia_add->tipo_translado->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->tipo_translado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->tipo_conbustible->Visible) { // tipo_conbustible ?>
	<div id="r_tipo_conbustible" class="form-group row">
		<label id="elh_asigna_ambulancia_tipo_conbustible" for="x_tipo_conbustible" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->tipo_conbustible->caption() ?><?php echo $asigna_ambulancia_add->tipo_conbustible->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->tipo_conbustible->cellAttributes() ?>>
<span id="el_asigna_ambulancia_tipo_conbustible">
<input type="text" data-table="asigna_ambulancia" data-field="x_tipo_conbustible" name="x_tipo_conbustible" id="x_tipo_conbustible" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->tipo_conbustible->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->tipo_conbustible->EditValue ?>"<?php echo $asigna_ambulancia_add->tipo_conbustible->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->tipo_conbustible->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->modalidad->Visible) { // modalidad ?>
	<div id="r_modalidad" class="form-group row">
		<label id="elh_asigna_ambulancia_modalidad" for="x_modalidad" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->modalidad->caption() ?><?php echo $asigna_ambulancia_add->modalidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->modalidad->cellAttributes() ?>>
<span id="el_asigna_ambulancia_modalidad">
<input type="text" data-table="asigna_ambulancia" data-field="x_modalidad" name="x_modalidad" id="x_modalidad" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->modalidad->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->modalidad->EditValue ?>"<?php echo $asigna_ambulancia_add->modalidad->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->modalidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->estado->Visible) { // estado ?>
	<div id="r_estado" class="form-group row">
		<label id="elh_asigna_ambulancia_estado" for="x_estado" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->estado->caption() ?><?php echo $asigna_ambulancia_add->estado->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->estado->cellAttributes() ?>>
<span id="el_asigna_ambulancia_estado">
<input type="text" data-table="asigna_ambulancia" data-field="x_estado" name="x_estado" id="x_estado" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->estado->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->estado->EditValue ?>"<?php echo $asigna_ambulancia_add->estado->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->ubicacion->Visible) { // ubicacion ?>
	<div id="r_ubicacion" class="form-group row">
		<label id="elh_asigna_ambulancia_ubicacion" for="x_ubicacion" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->ubicacion->caption() ?><?php echo $asigna_ambulancia_add->ubicacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->ubicacion->cellAttributes() ?>>
<span id="el_asigna_ambulancia_ubicacion">
<input type="text" data-table="asigna_ambulancia" data-field="x_ubicacion" name="x_ubicacion" id="x_ubicacion" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->ubicacion->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->ubicacion->EditValue ?>"<?php echo $asigna_ambulancia_add->ubicacion->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->ubicacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->disponible->Visible) { // disponible ?>
	<div id="r_disponible" class="form-group row">
		<label id="elh_asigna_ambulancia_disponible" for="x_disponible" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->disponible->caption() ?><?php echo $asigna_ambulancia_add->disponible->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->disponible->cellAttributes() ?>>
<span id="el_asigna_ambulancia_disponible">
<input type="text" data-table="asigna_ambulancia" data-field="x_disponible" name="x_disponible" id="x_disponible" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->disponible->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->disponible->EditValue ?>"<?php echo $asigna_ambulancia_add->disponible->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->disponible->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->fecha_iniseguro->Visible) { // fecha_iniseguro ?>
	<div id="r_fecha_iniseguro" class="form-group row">
		<label id="elh_asigna_ambulancia_fecha_iniseguro" for="x_fecha_iniseguro" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->fecha_iniseguro->caption() ?><?php echo $asigna_ambulancia_add->fecha_iniseguro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->fecha_iniseguro->cellAttributes() ?>>
<span id="el_asigna_ambulancia_fecha_iniseguro">
<input type="text" data-table="asigna_ambulancia" data-field="x_fecha_iniseguro" name="x_fecha_iniseguro" id="x_fecha_iniseguro" maxlength="8" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->fecha_iniseguro->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->fecha_iniseguro->EditValue ?>"<?php echo $asigna_ambulancia_add->fecha_iniseguro->editAttributes() ?>>
<?php if (!$asigna_ambulancia_add->fecha_iniseguro->ReadOnly && !$asigna_ambulancia_add->fecha_iniseguro->Disabled && !isset($asigna_ambulancia_add->fecha_iniseguro->EditAttrs["readonly"]) && !isset($asigna_ambulancia_add->fecha_iniseguro->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fasigna_ambulanciaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fasigna_ambulanciaadd", "x_fecha_iniseguro", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asigna_ambulancia_add->fecha_iniseguro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->fecha_finseguro->Visible) { // fecha_finseguro ?>
	<div id="r_fecha_finseguro" class="form-group row">
		<label id="elh_asigna_ambulancia_fecha_finseguro" for="x_fecha_finseguro" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->fecha_finseguro->caption() ?><?php echo $asigna_ambulancia_add->fecha_finseguro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->fecha_finseguro->cellAttributes() ?>>
<span id="el_asigna_ambulancia_fecha_finseguro">
<input type="text" data-table="asigna_ambulancia" data-field="x_fecha_finseguro" name="x_fecha_finseguro" id="x_fecha_finseguro" maxlength="8" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->fecha_finseguro->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->fecha_finseguro->EditValue ?>"<?php echo $asigna_ambulancia_add->fecha_finseguro->editAttributes() ?>>
<?php if (!$asigna_ambulancia_add->fecha_finseguro->ReadOnly && !$asigna_ambulancia_add->fecha_finseguro->Disabled && !isset($asigna_ambulancia_add->fecha_finseguro->EditAttrs["readonly"]) && !isset($asigna_ambulancia_add->fecha_finseguro->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fasigna_ambulanciaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fasigna_ambulanciaadd", "x_fecha_finseguro", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asigna_ambulancia_add->fecha_finseguro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->entidad->Visible) { // entidad ?>
	<div id="r_entidad" class="form-group row">
		<label id="elh_asigna_ambulancia_entidad" for="x_entidad" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->entidad->caption() ?><?php echo $asigna_ambulancia_add->entidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->entidad->cellAttributes() ?>>
<span id="el_asigna_ambulancia_entidad">
<input type="text" data-table="asigna_ambulancia" data-field="x_entidad" name="x_entidad" id="x_entidad" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->entidad->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->entidad->EditValue ?>"<?php echo $asigna_ambulancia_add->entidad->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->entidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->observacion->Visible) { // observacion ?>
	<div id="r_observacion" class="form-group row">
		<label id="elh_asigna_ambulancia_observacion" for="x_observacion" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->observacion->caption() ?><?php echo $asigna_ambulancia_add->observacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->observacion->cellAttributes() ?>>
<span id="el_asigna_ambulancia_observacion">
<input type="text" data-table="asigna_ambulancia" data-field="x_observacion" name="x_observacion" id="x_observacion" size="20" maxlength="100" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->observacion->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->observacion->EditValue ?>"<?php echo $asigna_ambulancia_add->observacion->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->observacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->asiganda->Visible) { // asiganda ?>
	<div id="r_asiganda" class="form-group row">
		<label id="elh_asigna_ambulancia_asiganda" for="x_asiganda" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->asiganda->caption() ?><?php echo $asigna_ambulancia_add->asiganda->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->asiganda->cellAttributes() ?>>
<span id="el_asigna_ambulancia_asiganda">
<input type="text" data-table="asigna_ambulancia" data-field="x_asiganda" name="x_asiganda" id="x_asiganda" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->asiganda->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->asiganda->EditValue ?>"<?php echo $asigna_ambulancia_add->asiganda->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->asiganda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->config_manteni->Visible) { // config_manteni ?>
	<div id="r_config_manteni" class="form-group row">
		<label id="elh_asigna_ambulancia_config_manteni" for="x_config_manteni" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->config_manteni->caption() ?><?php echo $asigna_ambulancia_add->config_manteni->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->config_manteni->cellAttributes() ?>>
<span id="el_asigna_ambulancia_config_manteni">
<input type="text" data-table="asigna_ambulancia" data-field="x_config_manteni" name="x_config_manteni" id="x_config_manteni" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->config_manteni->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->config_manteni->EditValue ?>"<?php echo $asigna_ambulancia_add->config_manteni->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->config_manteni->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->fecha_creacion->Visible) { // fecha_creacion ?>
	<div id="r_fecha_creacion" class="form-group row">
		<label id="elh_asigna_ambulancia_fecha_creacion" for="x_fecha_creacion" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->fecha_creacion->caption() ?><?php echo $asigna_ambulancia_add->fecha_creacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->fecha_creacion->cellAttributes() ?>>
<span id="el_asigna_ambulancia_fecha_creacion">
<input type="text" data-table="asigna_ambulancia" data-field="x_fecha_creacion" name="x_fecha_creacion" id="x_fecha_creacion" maxlength="8" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->fecha_creacion->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->fecha_creacion->EditValue ?>"<?php echo $asigna_ambulancia_add->fecha_creacion->editAttributes() ?>>
<?php if (!$asigna_ambulancia_add->fecha_creacion->ReadOnly && !$asigna_ambulancia_add->fecha_creacion->Disabled && !isset($asigna_ambulancia_add->fecha_creacion->EditAttrs["readonly"]) && !isset($asigna_ambulancia_add->fecha_creacion->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fasigna_ambulanciaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fasigna_ambulanciaadd", "x_fecha_creacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asigna_ambulancia_add->fecha_creacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->longitudambulancia->Visible) { // longitudambulancia ?>
	<div id="r_longitudambulancia" class="form-group row">
		<label id="elh_asigna_ambulancia_longitudambulancia" for="x_longitudambulancia" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->longitudambulancia->caption() ?><?php echo $asigna_ambulancia_add->longitudambulancia->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->longitudambulancia->cellAttributes() ?>>
<span id="el_asigna_ambulancia_longitudambulancia">
<input type="text" data-table="asigna_ambulancia" data-field="x_longitudambulancia" name="x_longitudambulancia" id="x_longitudambulancia" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->longitudambulancia->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->longitudambulancia->EditValue ?>"<?php echo $asigna_ambulancia_add->longitudambulancia->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->longitudambulancia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->latituambulancia->Visible) { // latituambulancia ?>
	<div id="r_latituambulancia" class="form-group row">
		<label id="elh_asigna_ambulancia_latituambulancia" for="x_latituambulancia" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->latituambulancia->caption() ?><?php echo $asigna_ambulancia_add->latituambulancia->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->latituambulancia->cellAttributes() ?>>
<span id="el_asigna_ambulancia_latituambulancia">
<input type="text" data-table="asigna_ambulancia" data-field="x_latituambulancia" name="x_latituambulancia" id="x_latituambulancia" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->latituambulancia->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->latituambulancia->EditValue ?>"<?php echo $asigna_ambulancia_add->latituambulancia->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->latituambulancia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->especial->Visible) { // especial ?>
	<div id="r_especial" class="form-group row">
		<label id="elh_asigna_ambulancia_especial" for="x_especial" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->especial->caption() ?><?php echo $asigna_ambulancia_add->especial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->especial->cellAttributes() ?>>
<span id="el_asigna_ambulancia_especial">
<input type="text" data-table="asigna_ambulancia" data-field="x_especial" name="x_especial" id="x_especial" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->especial->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->especial->EditValue ?>"<?php echo $asigna_ambulancia_add->especial->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->especial->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->id_tipotransport->Visible) { // id_tipotransport ?>
	<div id="r_id_tipotransport" class="form-group row">
		<label id="elh_asigna_ambulancia_id_tipotransport" for="x_id_tipotransport" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->id_tipotransport->caption() ?><?php echo $asigna_ambulancia_add->id_tipotransport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->id_tipotransport->cellAttributes() ?>>
<span id="el_asigna_ambulancia_id_tipotransport">
<input type="text" data-table="asigna_ambulancia" data-field="x_id_tipotransport" name="x_id_tipotransport" id="x_id_tipotransport" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->id_tipotransport->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->id_tipotransport->EditValue ?>"<?php echo $asigna_ambulancia_add->id_tipotransport->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->id_tipotransport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->tipo_amb_es->Visible) { // tipo_amb_es ?>
	<div id="r_tipo_amb_es" class="form-group row">
		<label id="elh_asigna_ambulancia_tipo_amb_es" for="x_tipo_amb_es" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->tipo_amb_es->caption() ?><?php echo $asigna_ambulancia_add->tipo_amb_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->tipo_amb_es->cellAttributes() ?>>
<span id="el_asigna_ambulancia_tipo_amb_es">
<input type="text" data-table="asigna_ambulancia" data-field="x_tipo_amb_es" name="x_tipo_amb_es" id="x_tipo_amb_es" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->tipo_amb_es->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->tipo_amb_es->EditValue ?>"<?php echo $asigna_ambulancia_add->tipo_amb_es->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->tipo_amb_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->tipo_amb_en->Visible) { // tipo_amb_en ?>
	<div id="r_tipo_amb_en" class="form-group row">
		<label id="elh_asigna_ambulancia_tipo_amb_en" for="x_tipo_amb_en" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->tipo_amb_en->caption() ?><?php echo $asigna_ambulancia_add->tipo_amb_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->tipo_amb_en->cellAttributes() ?>>
<span id="el_asigna_ambulancia_tipo_amb_en">
<input type="text" data-table="asigna_ambulancia" data-field="x_tipo_amb_en" name="x_tipo_amb_en" id="x_tipo_amb_en" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->tipo_amb_en->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->tipo_amb_en->EditValue ?>"<?php echo $asigna_ambulancia_add->tipo_amb_en->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->tipo_amb_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->tipo_amb_pr->Visible) { // tipo_amb_pr ?>
	<div id="r_tipo_amb_pr" class="form-group row">
		<label id="elh_asigna_ambulancia_tipo_amb_pr" for="x_tipo_amb_pr" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->tipo_amb_pr->caption() ?><?php echo $asigna_ambulancia_add->tipo_amb_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->tipo_amb_pr->cellAttributes() ?>>
<span id="el_asigna_ambulancia_tipo_amb_pr">
<input type="text" data-table="asigna_ambulancia" data-field="x_tipo_amb_pr" name="x_tipo_amb_pr" id="x_tipo_amb_pr" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->tipo_amb_pr->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->tipo_amb_pr->EditValue ?>"<?php echo $asigna_ambulancia_add->tipo_amb_pr->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->tipo_amb_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->tipo_amb_fr->Visible) { // tipo_amb_fr ?>
	<div id="r_tipo_amb_fr" class="form-group row">
		<label id="elh_asigna_ambulancia_tipo_amb_fr" for="x_tipo_amb_fr" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->tipo_amb_fr->caption() ?><?php echo $asigna_ambulancia_add->tipo_amb_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->tipo_amb_fr->cellAttributes() ?>>
<span id="el_asigna_ambulancia_tipo_amb_fr">
<input type="text" data-table="asigna_ambulancia" data-field="x_tipo_amb_fr" name="x_tipo_amb_fr" id="x_tipo_amb_fr" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->tipo_amb_fr->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->tipo_amb_fr->EditValue ?>"<?php echo $asigna_ambulancia_add->tipo_amb_fr->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->tipo_amb_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->codigo->Visible) { // codigo ?>
	<div id="r_codigo" class="form-group row">
		<label id="elh_asigna_ambulancia_codigo" for="x_codigo" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->codigo->caption() ?><?php echo $asigna_ambulancia_add->codigo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->codigo->cellAttributes() ?>>
<span id="el_asigna_ambulancia_codigo">
<input type="text" data-table="asigna_ambulancia" data-field="x_codigo" name="x_codigo" id="x_codigo" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->codigo->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->codigo->EditValue ?>"<?php echo $asigna_ambulancia_add->codigo->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->codigo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->id_especialambulancia->Visible) { // id_especialambulancia ?>
	<div id="r_id_especialambulancia" class="form-group row">
		<label id="elh_asigna_ambulancia_id_especialambulancia" for="x_id_especialambulancia" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->id_especialambulancia->caption() ?><?php echo $asigna_ambulancia_add->id_especialambulancia->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->id_especialambulancia->cellAttributes() ?>>
<span id="el_asigna_ambulancia_id_especialambulancia">
<input type="text" data-table="asigna_ambulancia" data-field="x_id_especialambulancia" name="x_id_especialambulancia" id="x_id_especialambulancia" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->id_especialambulancia->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->id_especialambulancia->EditValue ?>"<?php echo $asigna_ambulancia_add->id_especialambulancia->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->id_especialambulancia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->especial_es->Visible) { // especial_es ?>
	<div id="r_especial_es" class="form-group row">
		<label id="elh_asigna_ambulancia_especial_es" for="x_especial_es" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->especial_es->caption() ?><?php echo $asigna_ambulancia_add->especial_es->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->especial_es->cellAttributes() ?>>
<span id="el_asigna_ambulancia_especial_es">
<input type="text" data-table="asigna_ambulancia" data-field="x_especial_es" name="x_especial_es" id="x_especial_es" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->especial_es->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->especial_es->EditValue ?>"<?php echo $asigna_ambulancia_add->especial_es->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->especial_es->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->especial_en->Visible) { // especial_en ?>
	<div id="r_especial_en" class="form-group row">
		<label id="elh_asigna_ambulancia_especial_en" for="x_especial_en" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->especial_en->caption() ?><?php echo $asigna_ambulancia_add->especial_en->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->especial_en->cellAttributes() ?>>
<span id="el_asigna_ambulancia_especial_en">
<input type="text" data-table="asigna_ambulancia" data-field="x_especial_en" name="x_especial_en" id="x_especial_en" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->especial_en->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->especial_en->EditValue ?>"<?php echo $asigna_ambulancia_add->especial_en->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->especial_en->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->especial_pr->Visible) { // especial_pr ?>
	<div id="r_especial_pr" class="form-group row">
		<label id="elh_asigna_ambulancia_especial_pr" for="x_especial_pr" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->especial_pr->caption() ?><?php echo $asigna_ambulancia_add->especial_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->especial_pr->cellAttributes() ?>>
<span id="el_asigna_ambulancia_especial_pr">
<input type="text" data-table="asigna_ambulancia" data-field="x_especial_pr" name="x_especial_pr" id="x_especial_pr" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->especial_pr->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->especial_pr->EditValue ?>"<?php echo $asigna_ambulancia_add->especial_pr->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->especial_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asigna_ambulancia_add->especial_fr->Visible) { // especial_fr ?>
	<div id="r_especial_fr" class="form-group row">
		<label id="elh_asigna_ambulancia_especial_fr" for="x_especial_fr" class="<?php echo $asigna_ambulancia_add->LeftColumnClass ?>"><?php echo $asigna_ambulancia_add->especial_fr->caption() ?><?php echo $asigna_ambulancia_add->especial_fr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asigna_ambulancia_add->RightColumnClass ?>"><div <?php echo $asigna_ambulancia_add->especial_fr->cellAttributes() ?>>
<span id="el_asigna_ambulancia_especial_fr">
<input type="text" data-table="asigna_ambulancia" data-field="x_especial_fr" name="x_especial_fr" id="x_especial_fr" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($asigna_ambulancia_add->especial_fr->getPlaceHolder()) ?>" value="<?php echo $asigna_ambulancia_add->especial_fr->EditValue ?>"<?php echo $asigna_ambulancia_add->especial_fr->editAttributes() ?>>
</span>
<?php echo $asigna_ambulancia_add->especial_fr->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asigna_ambulancia_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asigna_ambulancia_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asigna_ambulancia_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$asigna_ambulancia_add->showPageFooter();
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
$asigna_ambulancia_add->terminate();
?>
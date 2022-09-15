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
$terminos_view = new terminos_view();

// Run the page
$terminos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terminos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terminos_view->isExport()) { ?>
<script>
var fterminosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fterminosview = currentForm = new ew.Form("fterminosview", "view");
	loadjs.done("fterminosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$terminos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $terminos_view->ExportOptions->render("body") ?>
<?php $terminos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $terminos_view->showPageHeader(); ?>
<?php
$terminos_view->showMessage();
?>
<form name="fterminosview" id="fterminosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terminos">
<input type="hidden" name="modal" value="<?php echo (int)$terminos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table d-none">
<?php if ($terminos_view->id_terminos->Visible) { // id_terminos ?>
	<tr id="r_id_terminos">
		<td class="<?php echo $terminos_view->TableLeftColumnClass ?>"><span id="elh_terminos_id_terminos"><script id="tpc_terminos_id_terminos" type="text/html"><?php echo $terminos_view->id_terminos->caption() ?></script></span></td>
		<td data-name="id_terminos" <?php echo $terminos_view->id_terminos->cellAttributes() ?>>
<script id="tpx_terminos_id_terminos" type="text/html"><span id="el_terminos_id_terminos">
<span<?php echo $terminos_view->id_terminos->viewAttributes() ?>><?php echo $terminos_view->id_terminos->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($terminos_view->texto_terminos_es->Visible) { // texto_terminos_es ?>
	<tr id="r_texto_terminos_es">
		<td class="<?php echo $terminos_view->TableLeftColumnClass ?>"><span id="elh_terminos_texto_terminos_es"><script id="tpc_terminos_texto_terminos_es" type="text/html"><?php echo $terminos_view->texto_terminos_es->caption() ?></script></span></td>
		<td data-name="texto_terminos_es" <?php echo $terminos_view->texto_terminos_es->cellAttributes() ?>>
<script id="tpx_terminos_texto_terminos_es" type="text/html"><span id="el_terminos_texto_terminos_es">
<span<?php echo $terminos_view->texto_terminos_es->viewAttributes() ?>><?php echo $terminos_view->texto_terminos_es->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($terminos_view->texto_terminos_en->Visible) { // texto_terminos_en ?>
	<tr id="r_texto_terminos_en">
		<td class="<?php echo $terminos_view->TableLeftColumnClass ?>"><span id="elh_terminos_texto_terminos_en"><script id="tpc_terminos_texto_terminos_en" type="text/html"><?php echo $terminos_view->texto_terminos_en->caption() ?></script></span></td>
		<td data-name="texto_terminos_en" <?php echo $terminos_view->texto_terminos_en->cellAttributes() ?>>
<script id="tpx_terminos_texto_terminos_en" type="text/html"><span id="el_terminos_texto_terminos_en">
<span<?php echo $terminos_view->texto_terminos_en->viewAttributes() ?>><?php echo $terminos_view->texto_terminos_en->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($terminos_view->texto_terminos_fr->Visible) { // texto_terminos_fr ?>
	<tr id="r_texto_terminos_fr">
		<td class="<?php echo $terminos_view->TableLeftColumnClass ?>"><span id="elh_terminos_texto_terminos_fr"><script id="tpc_terminos_texto_terminos_fr" type="text/html"><?php echo $terminos_view->texto_terminos_fr->caption() ?></script></span></td>
		<td data-name="texto_terminos_fr" <?php echo $terminos_view->texto_terminos_fr->cellAttributes() ?>>
<script id="tpx_terminos_texto_terminos_fr" type="text/html"><span id="el_terminos_texto_terminos_fr">
<span<?php echo $terminos_view->texto_terminos_fr->viewAttributes() ?>><?php echo $terminos_view->texto_terminos_fr->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($terminos_view->texto_terminos_pr->Visible) { // texto_terminos_pr ?>
	<tr id="r_texto_terminos_pr">
		<td class="<?php echo $terminos_view->TableLeftColumnClass ?>"><span id="elh_terminos_texto_terminos_pr"><script id="tpc_terminos_texto_terminos_pr" type="text/html"><?php echo $terminos_view->texto_terminos_pr->caption() ?></script></span></td>
		<td data-name="texto_terminos_pr" <?php echo $terminos_view->texto_terminos_pr->cellAttributes() ?>>
<script id="tpx_terminos_texto_terminos_pr" type="text/html"><span id="el_terminos_texto_terminos_pr">
<span<?php echo $terminos_view->texto_terminos_pr->viewAttributes() ?>><?php echo $terminos_view->texto_terminos_pr->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
</table>
<div id="tpd_terminosview" class="ew-custom-template"></div>
<script id="tpm_terminosview" type="text/html">
<div id="ct_terminos_view"><?php
$langid = CurrentLanguageID();
if ($langid =='es')
{
?>
{{include tmpl=~getTemplate("#tpx_terminos_texto_terminos_es")/}}
<?php } ?>
<?php
if ($langid =='en')
{
?>
{{include tmpl=~getTemplate("#tpx_terminos_texto_terminos_en")/}}
<?php } ?>
</div>
</script>

</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($terminos->Rows) ?> };
	ew.applyTemplate("tpd_terminosview", "tpm_terminosview", "terminosview", "<?php echo $terminos->CustomExport ?>", ew.templateData.rows[0]);
	$("script.terminosview_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$terminos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terminos_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$terminos_view->terminate();
?>
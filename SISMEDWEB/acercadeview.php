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
$acercade_view = new acercade_view();

// Run the page
$acercade_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acercade_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acercade_view->isExport()) { ?>
<script>
var facercadeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facercadeview = currentForm = new ew.Form("facercadeview", "view");
	loadjs.done("facercadeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acercade_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acercade_view->ExportOptions->render("body") ?>
<?php $acercade_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acercade_view->showPageHeader(); ?>
<?php
$acercade_view->showMessage();
?>
<form name="facercadeview" id="facercadeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acercade">
<input type="hidden" name="modal" value="<?php echo (int)$acercade_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table d-none">
<?php if ($acercade_view->id_acerca->Visible) { // id_acerca ?>
	<tr id="r_id_acerca">
		<td class="<?php echo $acercade_view->TableLeftColumnClass ?>"><span id="elh_acercade_id_acerca"><script id="tpc_acercade_id_acerca" type="text/html"><?php echo $acercade_view->id_acerca->caption() ?></script></span></td>
		<td data-name="id_acerca" <?php echo $acercade_view->id_acerca->cellAttributes() ?>>
<script id="tpx_acercade_id_acerca" type="text/html"><span id="el_acercade_id_acerca">
<span<?php echo $acercade_view->id_acerca->viewAttributes() ?>><?php echo $acercade_view->id_acerca->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($acercade_view->texto_es->Visible) { // texto_es ?>
	<tr id="r_texto_es">
		<td class="<?php echo $acercade_view->TableLeftColumnClass ?>"><span id="elh_acercade_texto_es"><script id="tpc_acercade_texto_es" type="text/html"><?php echo $acercade_view->texto_es->caption() ?></script></span></td>
		<td data-name="texto_es" <?php echo $acercade_view->texto_es->cellAttributes() ?>>
<script id="tpx_acercade_texto_es" type="text/html"><span id="el_acercade_texto_es">
<span<?php echo $acercade_view->texto_es->viewAttributes() ?>><?php echo $acercade_view->texto_es->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($acercade_view->texto_en->Visible) { // texto_en ?>
	<tr id="r_texto_en">
		<td class="<?php echo $acercade_view->TableLeftColumnClass ?>"><span id="elh_acercade_texto_en"><script id="tpc_acercade_texto_en" type="text/html"><?php echo $acercade_view->texto_en->caption() ?></script></span></td>
		<td data-name="texto_en" <?php echo $acercade_view->texto_en->cellAttributes() ?>>
<script id="tpx_acercade_texto_en" type="text/html"><span id="el_acercade_texto_en">
<span<?php echo $acercade_view->texto_en->viewAttributes() ?>><?php echo $acercade_view->texto_en->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($acercade_view->texto_fr->Visible) { // texto_fr ?>
	<tr id="r_texto_fr">
		<td class="<?php echo $acercade_view->TableLeftColumnClass ?>"><span id="elh_acercade_texto_fr"><script id="tpc_acercade_texto_fr" type="text/html"><?php echo $acercade_view->texto_fr->caption() ?></script></span></td>
		<td data-name="texto_fr" <?php echo $acercade_view->texto_fr->cellAttributes() ?>>
<script id="tpx_acercade_texto_fr" type="text/html"><span id="el_acercade_texto_fr">
<span<?php echo $acercade_view->texto_fr->viewAttributes() ?>><?php echo $acercade_view->texto_fr->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
<?php if ($acercade_view->texto_pr->Visible) { // texto_pr ?>
	<tr id="r_texto_pr">
		<td class="<?php echo $acercade_view->TableLeftColumnClass ?>"><span id="elh_acercade_texto_pr"><script id="tpc_acercade_texto_pr" type="text/html"><?php echo $acercade_view->texto_pr->caption() ?></script></span></td>
		<td data-name="texto_pr" <?php echo $acercade_view->texto_pr->cellAttributes() ?>>
<script id="tpx_acercade_texto_pr" type="text/html"><span id="el_acercade_texto_pr">
<span<?php echo $acercade_view->texto_pr->viewAttributes() ?>><?php echo $acercade_view->texto_pr->getViewValue() ?></span>
</span></script>
</td>
	</tr>
<?php } ?>
</table>
<div id="tpd_acercadeview" class="ew-custom-template"></div>
<script id="tpm_acercadeview" type="text/html">
<div id="ct_acercade_view"><?php
$langid = CurrentLanguageID();
if ($langid =='es')
{
?>
{{include tmpl=~getTemplate("#tpx_acercade_texto_es")/}}
<?php } ?>
<?php
if ($langid =='en')
{
?>
{{include tmpl=~getTemplate("#tpx_acercade_texto_en")/}}
<?php } ?>
</div>
</script>

</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($acercade->Rows) ?> };
	ew.applyTemplate("tpd_acercadeview", "tpm_acercadeview", "acercadeview", "<?php echo $acercade->CustomExport ?>", ew.templateData.rows[0]);
	$("script.acercadeview_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$acercade_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acercade_view->isExport()) { ?>
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
$acercade_view->terminate();
?>
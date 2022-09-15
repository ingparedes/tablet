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
$distrito_reniec_view = new distrito_reniec_view();

// Run the page
$distrito_reniec_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$distrito_reniec_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$distrito_reniec_view->isExport()) { ?>
<script>
var fdistrito_reniecview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdistrito_reniecview = currentForm = new ew.Form("fdistrito_reniecview", "view");
	loadjs.done("fdistrito_reniecview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$distrito_reniec_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $distrito_reniec_view->ExportOptions->render("body") ?>
<?php $distrito_reniec_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $distrito_reniec_view->showPageHeader(); ?>
<?php
$distrito_reniec_view->showMessage();
?>
<form name="fdistrito_reniecview" id="fdistrito_reniecview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="distrito_reniec">
<input type="hidden" name="modal" value="<?php echo (int)$distrito_reniec_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($distrito_reniec_view->cod_dpto->Visible) { // cod_dpto ?>
	<tr id="r_cod_dpto">
		<td class="<?php echo $distrito_reniec_view->TableLeftColumnClass ?>"><span id="elh_distrito_reniec_cod_dpto"><?php echo $distrito_reniec_view->cod_dpto->caption() ?></span></td>
		<td data-name="cod_dpto" <?php echo $distrito_reniec_view->cod_dpto->cellAttributes() ?>>
<span id="el_distrito_reniec_cod_dpto">
<span<?php echo $distrito_reniec_view->cod_dpto->viewAttributes() ?>><?php echo $distrito_reniec_view->cod_dpto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($distrito_reniec_view->cod_provincia->Visible) { // cod_provincia ?>
	<tr id="r_cod_provincia">
		<td class="<?php echo $distrito_reniec_view->TableLeftColumnClass ?>"><span id="elh_distrito_reniec_cod_provincia"><?php echo $distrito_reniec_view->cod_provincia->caption() ?></span></td>
		<td data-name="cod_provincia" <?php echo $distrito_reniec_view->cod_provincia->cellAttributes() ?>>
<span id="el_distrito_reniec_cod_provincia">
<span<?php echo $distrito_reniec_view->cod_provincia->viewAttributes() ?>><?php echo $distrito_reniec_view->cod_provincia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($distrito_reniec_view->cod_distrito->Visible) { // cod_distrito ?>
	<tr id="r_cod_distrito">
		<td class="<?php echo $distrito_reniec_view->TableLeftColumnClass ?>"><span id="elh_distrito_reniec_cod_distrito"><?php echo $distrito_reniec_view->cod_distrito->caption() ?></span></td>
		<td data-name="cod_distrito" <?php echo $distrito_reniec_view->cod_distrito->cellAttributes() ?>>
<span id="el_distrito_reniec_cod_distrito">
<span<?php echo $distrito_reniec_view->cod_distrito->viewAttributes() ?>><?php echo $distrito_reniec_view->cod_distrito->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($distrito_reniec_view->nombre_distrito->Visible) { // nombre_distrito ?>
	<tr id="r_nombre_distrito">
		<td class="<?php echo $distrito_reniec_view->TableLeftColumnClass ?>"><span id="elh_distrito_reniec_nombre_distrito"><?php echo $distrito_reniec_view->nombre_distrito->caption() ?></span></td>
		<td data-name="nombre_distrito" <?php echo $distrito_reniec_view->nombre_distrito->cellAttributes() ?>>
<span id="el_distrito_reniec_nombre_distrito">
<span<?php echo $distrito_reniec_view->nombre_distrito->viewAttributes() ?>><?php echo $distrito_reniec_view->nombre_distrito->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$distrito_reniec_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$distrito_reniec_view->isExport()) { ?>
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
$distrito_reniec_view->terminate();
?>
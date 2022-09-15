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
$acercade_delete = new acercade_delete();

// Run the page
$acercade_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acercade_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facercadedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facercadedelete = currentForm = new ew.Form("facercadedelete", "delete");
	loadjs.done("facercadedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acercade_delete->showPageHeader(); ?>
<?php
$acercade_delete->showMessage();
?>
<form name="facercadedelete" id="facercadedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acercade">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acercade_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acercade_delete->id_acerca->Visible) { // id_acerca ?>
		<th class="<?php echo $acercade_delete->id_acerca->headerCellClass() ?>"><span id="elh_acercade_id_acerca" class="acercade_id_acerca"><?php echo $acercade_delete->id_acerca->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acercade_delete->RecordCount = 0;
$i = 0;
while (!$acercade_delete->Recordset->EOF) {
	$acercade_delete->RecordCount++;
	$acercade_delete->RowCount++;

	// Set row properties
	$acercade->resetAttributes();
	$acercade->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acercade_delete->loadRowValues($acercade_delete->Recordset);

	// Render row
	$acercade_delete->renderRow();
?>
	<tr <?php echo $acercade->rowAttributes() ?>>
<?php if ($acercade_delete->id_acerca->Visible) { // id_acerca ?>
		<td <?php echo $acercade_delete->id_acerca->cellAttributes() ?>>
<span id="el<?php echo $acercade_delete->RowCount ?>_acercade_id_acerca" class="acercade_id_acerca">
<span<?php echo $acercade_delete->id_acerca->viewAttributes() ?>><?php echo $acercade_delete->id_acerca->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acercade_delete->Recordset->moveNext();
}
$acercade_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acercade_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acercade_delete->showPageFooter();
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
$acercade_delete->terminate();
?>
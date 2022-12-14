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
$camas_pedtria_list = new camas_pedtria_list();

// Run the page
$camas_pedtria_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$camas_pedtria_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$camas_pedtria_list->isExport()) { ?>
<script>
var fcamas_pedtrialist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcamas_pedtrialist = currentForm = new ew.Form("fcamas_pedtrialist", "list");
	fcamas_pedtrialist.formKeyCountName = '<?php echo $camas_pedtria_list->FormKeyCountName ?>';
	loadjs.done("fcamas_pedtrialist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$camas_pedtria_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($camas_pedtria_list->TotalRecords > 0 && $camas_pedtria_list->ExportOptions->visible()) { ?>
<?php $camas_pedtria_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($camas_pedtria_list->ImportOptions->visible()) { ?>
<?php $camas_pedtria_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$camas_pedtria_list->renderOtherOptions();
?>
<?php $camas_pedtria_list->showPageHeader(); ?>
<?php
$camas_pedtria_list->showMessage();
?>
<?php if ($camas_pedtria_list->TotalRecords > 0 || $camas_pedtria->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($camas_pedtria_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> camas_pedtria">
<form name="fcamas_pedtrialist" id="fcamas_pedtrialist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="camas_pedtria">
<div id="gmp_camas_pedtria" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($camas_pedtria_list->TotalRecords > 0 || $camas_pedtria_list->isGridEdit()) { ?>
<table id="tbl_camas_pedtrialist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$camas_pedtria->RowType = ROWTYPE_HEADER;

// Render list options
$camas_pedtria_list->renderListOptions();

// Render list options (header, left)
$camas_pedtria_list->ListOptions->render("header", "left");
?>
<?php if ($camas_pedtria_list->id->Visible) { // id ?>
	<?php if ($camas_pedtria_list->SortUrl($camas_pedtria_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $camas_pedtria_list->id->headerCellClass() ?>"><div id="elh_camas_pedtria_id" class="camas_pedtria_id"><div class="ew-table-header-caption"><?php echo $camas_pedtria_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $camas_pedtria_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $camas_pedtria_list->SortUrl($camas_pedtria_list->id) ?>', 1);"><div id="elh_camas_pedtria_id" class="camas_pedtria_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $camas_pedtria_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($camas_pedtria_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($camas_pedtria_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($camas_pedtria_list->ocupadas->Visible) { // ocupadas ?>
	<?php if ($camas_pedtria_list->SortUrl($camas_pedtria_list->ocupadas) == "") { ?>
		<th data-name="ocupadas" class="<?php echo $camas_pedtria_list->ocupadas->headerCellClass() ?>"><div id="elh_camas_pedtria_ocupadas" class="camas_pedtria_ocupadas"><div class="ew-table-header-caption"><?php echo $camas_pedtria_list->ocupadas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ocupadas" class="<?php echo $camas_pedtria_list->ocupadas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $camas_pedtria_list->SortUrl($camas_pedtria_list->ocupadas) ?>', 1);"><div id="elh_camas_pedtria_ocupadas" class="camas_pedtria_ocupadas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $camas_pedtria_list->ocupadas->caption() ?></span><span class="ew-table-header-sort"><?php if ($camas_pedtria_list->ocupadas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($camas_pedtria_list->ocupadas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($camas_pedtria_list->sin_servicio->Visible) { // sin_servicio ?>
	<?php if ($camas_pedtria_list->SortUrl($camas_pedtria_list->sin_servicio) == "") { ?>
		<th data-name="sin_servicio" class="<?php echo $camas_pedtria_list->sin_servicio->headerCellClass() ?>"><div id="elh_camas_pedtria_sin_servicio" class="camas_pedtria_sin_servicio"><div class="ew-table-header-caption"><?php echo $camas_pedtria_list->sin_servicio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sin_servicio" class="<?php echo $camas_pedtria_list->sin_servicio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $camas_pedtria_list->SortUrl($camas_pedtria_list->sin_servicio) ?>', 1);"><div id="elh_camas_pedtria_sin_servicio" class="camas_pedtria_sin_servicio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $camas_pedtria_list->sin_servicio->caption() ?></span><span class="ew-table-header-sort"><?php if ($camas_pedtria_list->sin_servicio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($camas_pedtria_list->sin_servicio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($camas_pedtria_list->libres->Visible) { // libres ?>
	<?php if ($camas_pedtria_list->SortUrl($camas_pedtria_list->libres) == "") { ?>
		<th data-name="libres" class="<?php echo $camas_pedtria_list->libres->headerCellClass() ?>"><div id="elh_camas_pedtria_libres" class="camas_pedtria_libres"><div class="ew-table-header-caption"><?php echo $camas_pedtria_list->libres->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="libres" class="<?php echo $camas_pedtria_list->libres->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $camas_pedtria_list->SortUrl($camas_pedtria_list->libres) ?>', 1);"><div id="elh_camas_pedtria_libres" class="camas_pedtria_libres">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $camas_pedtria_list->libres->caption() ?></span><span class="ew-table-header-sort"><?php if ($camas_pedtria_list->libres->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($camas_pedtria_list->libres->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($camas_pedtria_list->id_camas->Visible) { // id_camas ?>
	<?php if ($camas_pedtria_list->SortUrl($camas_pedtria_list->id_camas) == "") { ?>
		<th data-name="id_camas" class="<?php echo $camas_pedtria_list->id_camas->headerCellClass() ?>"><div id="elh_camas_pedtria_id_camas" class="camas_pedtria_id_camas"><div class="ew-table-header-caption"><?php echo $camas_pedtria_list->id_camas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_camas" class="<?php echo $camas_pedtria_list->id_camas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $camas_pedtria_list->SortUrl($camas_pedtria_list->id_camas) ?>', 1);"><div id="elh_camas_pedtria_id_camas" class="camas_pedtria_id_camas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $camas_pedtria_list->id_camas->caption() ?></span><span class="ew-table-header-sort"><?php if ($camas_pedtria_list->id_camas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($camas_pedtria_list->id_camas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$camas_pedtria_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($camas_pedtria_list->ExportAll && $camas_pedtria_list->isExport()) {
	$camas_pedtria_list->StopRecord = $camas_pedtria_list->TotalRecords;
} else {

	// Set the last record to display
	if ($camas_pedtria_list->TotalRecords > $camas_pedtria_list->StartRecord + $camas_pedtria_list->DisplayRecords - 1)
		$camas_pedtria_list->StopRecord = $camas_pedtria_list->StartRecord + $camas_pedtria_list->DisplayRecords - 1;
	else
		$camas_pedtria_list->StopRecord = $camas_pedtria_list->TotalRecords;
}
$camas_pedtria_list->RecordCount = $camas_pedtria_list->StartRecord - 1;
if ($camas_pedtria_list->Recordset && !$camas_pedtria_list->Recordset->EOF) {
	$camas_pedtria_list->Recordset->moveFirst();
	$selectLimit = $camas_pedtria_list->UseSelectLimit;
	if (!$selectLimit && $camas_pedtria_list->StartRecord > 1)
		$camas_pedtria_list->Recordset->move($camas_pedtria_list->StartRecord - 1);
} elseif (!$camas_pedtria->AllowAddDeleteRow && $camas_pedtria_list->StopRecord == 0) {
	$camas_pedtria_list->StopRecord = $camas_pedtria->GridAddRowCount;
}

// Initialize aggregate
$camas_pedtria->RowType = ROWTYPE_AGGREGATEINIT;
$camas_pedtria->resetAttributes();
$camas_pedtria_list->renderRow();
while ($camas_pedtria_list->RecordCount < $camas_pedtria_list->StopRecord) {
	$camas_pedtria_list->RecordCount++;
	if ($camas_pedtria_list->RecordCount >= $camas_pedtria_list->StartRecord) {
		$camas_pedtria_list->RowCount++;

		// Set up key count
		$camas_pedtria_list->KeyCount = $camas_pedtria_list->RowIndex;

		// Init row class and style
		$camas_pedtria->resetAttributes();
		$camas_pedtria->CssClass = "";
		if ($camas_pedtria_list->isGridAdd()) {
		} else {
			$camas_pedtria_list->loadRowValues($camas_pedtria_list->Recordset); // Load row values
		}
		$camas_pedtria->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$camas_pedtria->RowAttrs->merge(["data-rowindex" => $camas_pedtria_list->RowCount, "id" => "r" . $camas_pedtria_list->RowCount . "_camas_pedtria", "data-rowtype" => $camas_pedtria->RowType]);

		// Render row
		$camas_pedtria_list->renderRow();

		// Render list options
		$camas_pedtria_list->renderListOptions();
?>
	<tr <?php echo $camas_pedtria->rowAttributes() ?>>
<?php

// Render list options (body, left)
$camas_pedtria_list->ListOptions->render("body", "left", $camas_pedtria_list->RowCount);
?>
	<?php if ($camas_pedtria_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $camas_pedtria_list->id->cellAttributes() ?>>
<span id="el<?php echo $camas_pedtria_list->RowCount ?>_camas_pedtria_id">
<span<?php echo $camas_pedtria_list->id->viewAttributes() ?>><?php echo $camas_pedtria_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($camas_pedtria_list->ocupadas->Visible) { // ocupadas ?>
		<td data-name="ocupadas" <?php echo $camas_pedtria_list->ocupadas->cellAttributes() ?>>
<span id="el<?php echo $camas_pedtria_list->RowCount ?>_camas_pedtria_ocupadas">
<span<?php echo $camas_pedtria_list->ocupadas->viewAttributes() ?>><?php echo $camas_pedtria_list->ocupadas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($camas_pedtria_list->sin_servicio->Visible) { // sin_servicio ?>
		<td data-name="sin_servicio" <?php echo $camas_pedtria_list->sin_servicio->cellAttributes() ?>>
<span id="el<?php echo $camas_pedtria_list->RowCount ?>_camas_pedtria_sin_servicio">
<span<?php echo $camas_pedtria_list->sin_servicio->viewAttributes() ?>><?php echo $camas_pedtria_list->sin_servicio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($camas_pedtria_list->libres->Visible) { // libres ?>
		<td data-name="libres" <?php echo $camas_pedtria_list->libres->cellAttributes() ?>>
<span id="el<?php echo $camas_pedtria_list->RowCount ?>_camas_pedtria_libres">
<span<?php echo $camas_pedtria_list->libres->viewAttributes() ?>><?php echo $camas_pedtria_list->libres->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($camas_pedtria_list->id_camas->Visible) { // id_camas ?>
		<td data-name="id_camas" <?php echo $camas_pedtria_list->id_camas->cellAttributes() ?>>
<span id="el<?php echo $camas_pedtria_list->RowCount ?>_camas_pedtria_id_camas">
<span<?php echo $camas_pedtria_list->id_camas->viewAttributes() ?>><?php echo $camas_pedtria_list->id_camas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$camas_pedtria_list->ListOptions->render("body", "right", $camas_pedtria_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$camas_pedtria_list->isGridAdd())
		$camas_pedtria_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$camas_pedtria->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($camas_pedtria_list->Recordset)
	$camas_pedtria_list->Recordset->Close();
?>
<?php if (!$camas_pedtria_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$camas_pedtria_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $camas_pedtria_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $camas_pedtria_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($camas_pedtria_list->TotalRecords == 0 && !$camas_pedtria->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $camas_pedtria_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$camas_pedtria_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$camas_pedtria_list->isExport()) { ?>
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
$camas_pedtria_list->terminate();
?>
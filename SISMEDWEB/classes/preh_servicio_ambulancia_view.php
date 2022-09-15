<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class preh_servicio_ambulancia_view extends preh_servicio_ambulancia
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'preh_servicio_ambulancia';

	// Page object name
	public $PageObjName = "preh_servicio_ambulancia_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = TRUE;
	public $ExportWordCustom = TRUE;
	public $ExportPdfCustom = TRUE;
	public $ExportEmailCustom = TRUE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (preh_servicio_ambulancia)
		if (!isset($GLOBALS["preh_servicio_ambulancia"]) || get_class($GLOBALS["preh_servicio_ambulancia"]) == PROJECT_NAMESPACE . "preh_servicio_ambulancia") {
			$GLOBALS["preh_servicio_ambulancia"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["preh_servicio_ambulancia"];
		}
		$keyUrl = "";
		if (Get("cod_casopreh") !== NULL) {
			$this->RecKey["cod_casopreh"] = Get("cod_casopreh");
			$keyUrl .= "&amp;cod_casopreh=" . urlencode($this->RecKey["cod_casopreh"]);
		}
		if (Get("cod_ambulancia") !== NULL) {
			$this->RecKey["cod_ambulancia"] = Get("cod_ambulancia");
			$keyUrl .= "&amp;cod_ambulancia=" . urlencode($this->RecKey["cod_ambulancia"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'preh_servicio_ambulancia');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (usuarios)
		$UserTable = $UserTable ?: new usuarios();

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;
		global $OldSkipHeaderFooter, $SkipHeaderFooter;
		$SkipHeaderFooter = $OldSkipHeaderFooter;
		if (Post("customexport") === NULL) {

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		}

		// Export
		global $preh_servicio_ambulancia;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
			if (is_array(@$_SESSION[SESSION_TEMP_IMAGES])) // Restore temp images
				$TempImages = @$_SESSION[SESSION_TEMP_IMAGES];
			if (Post("data") !== NULL)
				$content = Post("data");
			$ExportFileName = Post("filename", "");
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($preh_servicio_ambulancia);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
	if ($this->CustomExport) { // Save temp images array for custom export
		if (is_array($TempImages))
			$_SESSION[SESSION_TEMP_IMAGES] = $TempImages;
	}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "preh_servicio_ambulanciaview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['cod_casopreh'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['cod_ambulancia'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("preh_servicio_ambulancialist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		global $OldSkipHeaderFooter, $SkipHeaderFooter;
		$OldSkipHeaderFooter = $SkipHeaderFooter;
		$SkipHeaderFooter = TRUE;
		$this->id_servcioambulacia->setVisibility();
		$this->cod_casopreh->setVisibility();
		$this->cod_ambulancia->setVisibility();
		$this->hora_confirma->setVisibility();
		$this->hora_asigna->setVisibility();
		$this->hora_llegada->setVisibility();
		$this->hora_inicio->setVisibility();
		$this->hora_destino->setVisibility();
		$this->hora_preposicion->setVisibility();
		$this->observaciones->setVisibility();
		$this->tipo_traslado->setVisibility();
		$this->traslado_fallido->setVisibility();
		$this->estado_paciente->setVisibility();
		$this->k_final->setVisibility();
		$this->k_inical->setVisibility();
		$this->tipo_serviciosistema->setVisibility();
		$this->preposicion->setVisibility();
		$this->conductor->setVisibility();
		$this->medico->setVisibility();
		$this->paramedico->setVisibility();
		$this->dx_aph->setVisibility();
		$this->dx_soat->setVisibility();
		$this->estado_pacientefinal->setVisibility();
		$this->cuando_murio->setVisibility();
		$this->accidente_vehiculo->setVisibility();
		$this->atropellado->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->traslado_fallido);
		$this->setupLookupOptions($this->dx_aph);
		$this->setupLookupOptions($this->dx_soat);

		// Check permission
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("preh_servicio_ambulancialist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("cod_casopreh") !== NULL) {
				$this->cod_casopreh->setQueryStringValue(Get("cod_casopreh"));
				$this->RecKey["cod_casopreh"] = $this->cod_casopreh->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->cod_casopreh->setQueryStringValue(Key(0));
				$this->RecKey["cod_casopreh"] = $this->cod_casopreh->QueryStringValue;
			} elseif (Post("cod_casopreh") !== NULL) {
				$this->cod_casopreh->setFormValue(Post("cod_casopreh"));
				$this->RecKey["cod_casopreh"] = $this->cod_casopreh->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->cod_casopreh->setFormValue(Route(2));
				$this->RecKey["cod_casopreh"] = $this->cod_casopreh->FormValue;
			} else {
				$returnUrl = "preh_servicio_ambulancialist.php"; // Return to list
			}
			if (Get("cod_ambulancia") !== NULL) {
				$this->cod_ambulancia->setQueryStringValue(Get("cod_ambulancia"));
				$this->RecKey["cod_ambulancia"] = $this->cod_ambulancia->QueryStringValue;
			} elseif (IsApi() && Key(1) !== NULL) {
				$this->cod_ambulancia->setQueryStringValue(Key(1));
				$this->RecKey["cod_ambulancia"] = $this->cod_ambulancia->QueryStringValue;
			} elseif (Post("cod_ambulancia") !== NULL) {
				$this->cod_ambulancia->setFormValue(Post("cod_ambulancia"));
				$this->RecKey["cod_ambulancia"] = $this->cod_ambulancia->FormValue;
			} elseif (IsApi() && Route(3) !== NULL) {
				$this->cod_ambulancia->setFormValue(Route(3));
				$this->RecKey["cod_ambulancia"] = $this->cod_ambulancia->FormValue;
			} else {
				$returnUrl = "preh_servicio_ambulancialist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = $this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "preh_servicio_ambulancialist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "preh_servicio_ambulancialist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id_servcioambulacia->setDbValue($row['id_servcioambulacia']);
		$this->cod_casopreh->setDbValue($row['cod_casopreh']);
		$this->cod_ambulancia->setDbValue($row['cod_ambulancia']);
		$this->hora_confirma->setDbValue($row['hora_confirma']);
		$this->hora_asigna->setDbValue($row['hora_asigna']);
		$this->hora_llegada->setDbValue($row['hora_llegada']);
		$this->hora_inicio->setDbValue($row['hora_inicio']);
		$this->hora_destino->setDbValue($row['hora_destino']);
		$this->hora_preposicion->setDbValue($row['hora_preposicion']);
		$this->observaciones->setDbValue($row['observaciones']);
		$this->tipo_traslado->setDbValue($row['tipo_traslado']);
		$this->traslado_fallido->setDbValue($row['traslado_fallido']);
		$this->estado_paciente->setDbValue($row['estado_paciente']);
		$this->k_final->setDbValue($row['k_final']);
		$this->k_inical->setDbValue($row['k_inical']);
		$this->tipo_serviciosistema->setDbValue($row['tipo_serviciosistema']);
		$this->preposicion->setDbValue($row['preposicion']);
		$this->conductor->setDbValue($row['conductor']);
		$this->medico->setDbValue($row['medico']);
		$this->paramedico->setDbValue($row['paramedico']);
		$this->dx_aph->setDbValue($row['dx_aph']);
		$this->dx_soat->setDbValue($row['dx_soat']);
		$this->estado_pacientefinal->setDbValue($row['estado_pacientefinal']);
		$this->cuando_murio->setDbValue($row['cuando_murio']);
		$this->accidente_vehiculo->setDbValue($row['accidente_vehiculo']);
		$this->atropellado->setDbValue($row['atropellado']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_servcioambulacia'] = NULL;
		$row['cod_casopreh'] = NULL;
		$row['cod_ambulancia'] = NULL;
		$row['hora_confirma'] = NULL;
		$row['hora_asigna'] = NULL;
		$row['hora_llegada'] = NULL;
		$row['hora_inicio'] = NULL;
		$row['hora_destino'] = NULL;
		$row['hora_preposicion'] = NULL;
		$row['observaciones'] = NULL;
		$row['tipo_traslado'] = NULL;
		$row['traslado_fallido'] = NULL;
		$row['estado_paciente'] = NULL;
		$row['k_final'] = NULL;
		$row['k_inical'] = NULL;
		$row['tipo_serviciosistema'] = NULL;
		$row['preposicion'] = NULL;
		$row['conductor'] = NULL;
		$row['medico'] = NULL;
		$row['paramedico'] = NULL;
		$row['dx_aph'] = NULL;
		$row['dx_soat'] = NULL;
		$row['estado_pacientefinal'] = NULL;
		$row['cuando_murio'] = NULL;
		$row['accidente_vehiculo'] = NULL;
		$row['atropellado'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_servcioambulacia
		// cod_casopreh
		// cod_ambulancia
		// hora_confirma
		// hora_asigna
		// hora_llegada
		// hora_inicio
		// hora_destino
		// hora_preposicion
		// observaciones
		// tipo_traslado
		// traslado_fallido
		// estado_paciente
		// k_final
		// k_inical
		// tipo_serviciosistema
		// preposicion
		// conductor
		// medico
		// paramedico
		// dx_aph
		// dx_soat
		// estado_pacientefinal
		// cuando_murio
		// accidente_vehiculo
		// atropellado

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_servcioambulacia
			$this->id_servcioambulacia->ViewValue = $this->id_servcioambulacia->CurrentValue;
			$this->id_servcioambulacia->ViewCustomAttributes = "";

			// cod_casopreh
			$this->cod_casopreh->ViewValue = $this->cod_casopreh->CurrentValue;
			$this->cod_casopreh->ViewValue = FormatNumber($this->cod_casopreh->ViewValue, 0, -2, -2, -2);
			$this->cod_casopreh->ViewCustomAttributes = "";

			// cod_ambulancia
			$this->cod_ambulancia->ViewValue = $this->cod_ambulancia->CurrentValue;
			$this->cod_ambulancia->ViewCustomAttributes = "";

			// hora_confirma
			$this->hora_confirma->ViewValue = $this->hora_confirma->CurrentValue;
			$this->hora_confirma->ViewValue = FormatDateTime($this->hora_confirma->ViewValue, 0);
			$this->hora_confirma->ViewCustomAttributes = "";

			// hora_asigna
			$this->hora_asigna->ViewValue = $this->hora_asigna->CurrentValue;
			$this->hora_asigna->ViewValue = FormatDateTime($this->hora_asigna->ViewValue, 0);
			$this->hora_asigna->ViewCustomAttributes = "";

			// hora_llegada
			$this->hora_llegada->ViewValue = $this->hora_llegada->CurrentValue;
			$this->hora_llegada->ViewValue = FormatDateTime($this->hora_llegada->ViewValue, 0);
			$this->hora_llegada->ViewCustomAttributes = "";

			// hora_inicio
			$this->hora_inicio->ViewValue = $this->hora_inicio->CurrentValue;
			$this->hora_inicio->ViewValue = FormatDateTime($this->hora_inicio->ViewValue, 0);
			$this->hora_inicio->ViewCustomAttributes = "";

			// hora_destino
			$this->hora_destino->ViewValue = $this->hora_destino->CurrentValue;
			$this->hora_destino->ViewValue = FormatDateTime($this->hora_destino->ViewValue, 0);
			$this->hora_destino->ViewCustomAttributes = "";

			// hora_preposicion
			$this->hora_preposicion->ViewValue = $this->hora_preposicion->CurrentValue;
			$this->hora_preposicion->ViewValue = FormatDateTime($this->hora_preposicion->ViewValue, 0);
			$this->hora_preposicion->ViewCustomAttributes = "";

			// observaciones
			$this->observaciones->ViewValue = $this->observaciones->CurrentValue;
			$this->observaciones->ViewCustomAttributes = "";

			// tipo_traslado
			$this->tipo_traslado->ViewValue = $this->tipo_traslado->CurrentValue;
			$this->tipo_traslado->ViewCustomAttributes = "";

			// traslado_fallido
			$curVal = strval($this->traslado_fallido->CurrentValue);
			if ($curVal != "") {
				$this->traslado_fallido->ViewValue = $this->traslado_fallido->lookupCacheOption($curVal);
				if ($this->traslado_fallido->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"id_tranlado_fallido\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->traslado_fallido->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->traslado_fallido->ViewValue = $this->traslado_fallido->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->traslado_fallido->ViewValue = $this->traslado_fallido->CurrentValue;
					}
				}
			} else {
				$this->traslado_fallido->ViewValue = NULL;
			}
			$this->traslado_fallido->ViewCustomAttributes = "";

			// estado_paciente
			$this->estado_paciente->ViewValue = $this->estado_paciente->CurrentValue;
			$this->estado_paciente->ViewCustomAttributes = "";

			// k_final
			$this->k_final->ViewValue = $this->k_final->CurrentValue;
			$this->k_final->ViewCustomAttributes = "";

			// k_inical
			$this->k_inical->ViewValue = $this->k_inical->CurrentValue;
			$this->k_inical->ViewCustomAttributes = "";

			// tipo_serviciosistema
			$this->tipo_serviciosistema->ViewValue = $this->tipo_serviciosistema->CurrentValue;
			$this->tipo_serviciosistema->ViewCustomAttributes = "";

			// preposicion
			$this->preposicion->ViewValue = $this->preposicion->CurrentValue;
			$this->preposicion->ViewCustomAttributes = "";

			// conductor
			$this->conductor->ViewValue = $this->conductor->CurrentValue;
			$this->conductor->ViewCustomAttributes = "";

			// medico
			$this->medico->ViewValue = $this->medico->CurrentValue;
			$this->medico->ViewCustomAttributes = "";

			// paramedico
			$this->paramedico->ViewValue = $this->paramedico->CurrentValue;
			$this->paramedico->ViewCustomAttributes = "";

			// dx_aph
			$curVal = strval($this->dx_aph->CurrentValue);
			if ($curVal != "") {
				$this->dx_aph->ViewValue = $this->dx_aph->lookupCacheOption($curVal);
				if ($this->dx_aph->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "\"codigo_cie\"" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->dx_aph->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->dx_aph->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->dx_aph->ViewValue->add($this->dx_aph->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->dx_aph->ViewValue = $this->dx_aph->CurrentValue;
					}
				}
			} else {
				$this->dx_aph->ViewValue = NULL;
			}
			$this->dx_aph->ViewCustomAttributes = "";

			// dx_soat
			$curVal = strval($this->dx_soat->CurrentValue);
			if ($curVal != "") {
				$this->dx_soat->ViewValue = $this->dx_soat->lookupCacheOption($curVal);
				if ($this->dx_soat->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "\"codigo_cie\"" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->dx_soat->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->dx_soat->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->dx_soat->ViewValue->add($this->dx_soat->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->dx_soat->ViewValue = $this->dx_soat->CurrentValue;
					}
				}
			} else {
				$this->dx_soat->ViewValue = NULL;
			}
			$this->dx_soat->ViewCustomAttributes = "";

			// estado_pacientefinal
			if (strval($this->estado_pacientefinal->CurrentValue) != "") {
				$this->estado_pacientefinal->ViewValue = $this->estado_pacientefinal->optionCaption($this->estado_pacientefinal->CurrentValue);
			} else {
				$this->estado_pacientefinal->ViewValue = NULL;
			}
			$this->estado_pacientefinal->ViewCustomAttributes = "";

			// cuando_murio
			$this->cuando_murio->ViewValue = $this->cuando_murio->CurrentValue;
			$this->cuando_murio->ViewValue = FormatNumber($this->cuando_murio->ViewValue, 0, -2, -2, -2);
			$this->cuando_murio->ViewCustomAttributes = "";

			// accidente_vehiculo
			if (strval($this->accidente_vehiculo->CurrentValue) != "") {
				$this->accidente_vehiculo->ViewValue = $this->accidente_vehiculo->optionCaption($this->accidente_vehiculo->CurrentValue);
			} else {
				$this->accidente_vehiculo->ViewValue = NULL;
			}
			$this->accidente_vehiculo->ViewCustomAttributes = "";

			// atropellado
			if (strval($this->atropellado->CurrentValue) != "") {
				$this->atropellado->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->atropellado->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->atropellado->ViewValue->add($this->atropellado->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->atropellado->ViewValue = NULL;
			}
			$this->atropellado->ViewCustomAttributes = "";

			// id_servcioambulacia
			$this->id_servcioambulacia->LinkCustomAttributes = "";
			$this->id_servcioambulacia->HrefValue = "";
			$this->id_servcioambulacia->TooltipValue = "";

			// cod_casopreh
			$this->cod_casopreh->LinkCustomAttributes = "";
			$this->cod_casopreh->HrefValue = "";
			$this->cod_casopreh->TooltipValue = "";

			// cod_ambulancia
			$this->cod_ambulancia->LinkCustomAttributes = "";
			$this->cod_ambulancia->HrefValue = "";
			$this->cod_ambulancia->TooltipValue = "";

			// hora_confirma
			$this->hora_confirma->LinkCustomAttributes = "";
			$this->hora_confirma->HrefValue = "";
			$this->hora_confirma->TooltipValue = "";

			// hora_asigna
			$this->hora_asigna->LinkCustomAttributes = "";
			$this->hora_asigna->HrefValue = "";
			$this->hora_asigna->TooltipValue = "";

			// hora_llegada
			$this->hora_llegada->LinkCustomAttributes = "";
			$this->hora_llegada->HrefValue = "";
			$this->hora_llegada->TooltipValue = "";

			// hora_inicio
			$this->hora_inicio->LinkCustomAttributes = "";
			$this->hora_inicio->HrefValue = "";
			$this->hora_inicio->TooltipValue = "";

			// hora_destino
			$this->hora_destino->LinkCustomAttributes = "";
			$this->hora_destino->HrefValue = "";
			$this->hora_destino->TooltipValue = "";

			// hora_preposicion
			$this->hora_preposicion->LinkCustomAttributes = "";
			$this->hora_preposicion->HrefValue = "";
			$this->hora_preposicion->TooltipValue = "";

			// observaciones
			$this->observaciones->LinkCustomAttributes = "";
			$this->observaciones->HrefValue = "";
			$this->observaciones->TooltipValue = "";

			// tipo_traslado
			$this->tipo_traslado->LinkCustomAttributes = "";
			$this->tipo_traslado->HrefValue = "";
			$this->tipo_traslado->TooltipValue = "";

			// traslado_fallido
			$this->traslado_fallido->LinkCustomAttributes = "";
			$this->traslado_fallido->HrefValue = "";
			$this->traslado_fallido->TooltipValue = "";

			// estado_paciente
			$this->estado_paciente->LinkCustomAttributes = "";
			$this->estado_paciente->HrefValue = "";
			$this->estado_paciente->TooltipValue = "";

			// k_final
			$this->k_final->LinkCustomAttributes = "";
			$this->k_final->HrefValue = "";
			$this->k_final->TooltipValue = "";

			// k_inical
			$this->k_inical->LinkCustomAttributes = "";
			$this->k_inical->HrefValue = "";
			$this->k_inical->TooltipValue = "";

			// tipo_serviciosistema
			$this->tipo_serviciosistema->LinkCustomAttributes = "";
			$this->tipo_serviciosistema->HrefValue = "";
			$this->tipo_serviciosistema->TooltipValue = "";

			// preposicion
			$this->preposicion->LinkCustomAttributes = "";
			$this->preposicion->HrefValue = "";
			$this->preposicion->TooltipValue = "";

			// conductor
			$this->conductor->LinkCustomAttributes = "";
			$this->conductor->HrefValue = "";
			$this->conductor->TooltipValue = "";

			// medico
			$this->medico->LinkCustomAttributes = "";
			$this->medico->HrefValue = "";
			$this->medico->TooltipValue = "";

			// paramedico
			$this->paramedico->LinkCustomAttributes = "";
			$this->paramedico->HrefValue = "";
			$this->paramedico->TooltipValue = "";

			// dx_aph
			$this->dx_aph->LinkCustomAttributes = "";
			$this->dx_aph->HrefValue = "";
			$this->dx_aph->TooltipValue = "";

			// dx_soat
			$this->dx_soat->LinkCustomAttributes = "";
			$this->dx_soat->HrefValue = "";
			$this->dx_soat->TooltipValue = "";

			// estado_pacientefinal
			$this->estado_pacientefinal->LinkCustomAttributes = "";
			$this->estado_pacientefinal->HrefValue = "";
			$this->estado_pacientefinal->TooltipValue = "";

			// cuando_murio
			$this->cuando_murio->LinkCustomAttributes = "";
			$this->cuando_murio->HrefValue = "";
			$this->cuando_murio->TooltipValue = "";

			// accidente_vehiculo
			$this->accidente_vehiculo->LinkCustomAttributes = "";
			$this->accidente_vehiculo->HrefValue = "";
			$this->accidente_vehiculo->TooltipValue = "";

			// atropellado
			$this->atropellado->LinkCustomAttributes = "";
			$this->atropellado->HrefValue = "";
			$this->atropellado->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();

		// Save data for Custom Template
		if ($this->RowType == ROWTYPE_VIEW || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_ADD)
			$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("preh_servicio_ambulancialist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_traslado_fallido":
					break;
				case "x_dx_aph":
					break;
				case "x_dx_soat":
					break;
				case "x_estado_pacientefinal":
					break;
				case "x_accidente_vehiculo":
					break;
				case "x_atropellado":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_traslado_fallido":
							break;
						case "x_dx_aph":
							break;
						case "x_dx_soat":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>
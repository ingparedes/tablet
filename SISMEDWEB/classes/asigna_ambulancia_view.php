<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class asigna_ambulancia_view extends asigna_ambulancia
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'asigna_ambulancia';

	// Page object name
	public $PageObjName = "asigna_ambulancia_view";

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
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

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

		// Table object (asigna_ambulancia)
		if (!isset($GLOBALS["asigna_ambulancia"]) || get_class($GLOBALS["asigna_ambulancia"]) == PROJECT_NAMESPACE . "asigna_ambulancia") {
			$GLOBALS["asigna_ambulancia"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["asigna_ambulancia"];
		}
		$keyUrl = "";
		if (Get("id_ambulancias") !== NULL) {
			$this->RecKey["id_ambulancias"] = Get("id_ambulancias");
			$keyUrl .= "&amp;id_ambulancias=" . urlencode($this->RecKey["id_ambulancias"]);
		}
		if (Get("cod_ambulancias") !== NULL) {
			$this->RecKey["cod_ambulancias"] = Get("cod_ambulancias");
			$keyUrl .= "&amp;cod_ambulancias=" . urlencode($this->RecKey["cod_ambulancias"]);
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'asigna_ambulancia');

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

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $asigna_ambulancia;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($asigna_ambulancia);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
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
					if ($pageName == "asigna_ambulanciaview.php")
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
			$key .= @$ar['id_ambulancias'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['cod_ambulancias'];
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
					$this->terminate(GetUrl("asigna_ambulancialist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		global $OldSkipHeaderFooter, $SkipHeaderFooter;
		$OldSkipHeaderFooter = $SkipHeaderFooter;
		$SkipHeaderFooter = TRUE;
		$this->id_ambulancias->setVisibility();
		$this->cod_ambulancias->setVisibility();
		$this->placas->setVisibility();
		$this->chasis->setVisibility();
		$this->marca->setVisibility();
		$this->modelo->setVisibility();
		$this->tipo_translado->setVisibility();
		$this->tipo_conbustible->setVisibility();
		$this->modalidad->setVisibility();
		$this->estado->setVisibility();
		$this->ubicacion->setVisibility();
		$this->disponible->setVisibility();
		$this->fecha_iniseguro->setVisibility();
		$this->fecha_finseguro->setVisibility();
		$this->entidad->setVisibility();
		$this->observacion->setVisibility();
		$this->asiganda->setVisibility();
		$this->config_manteni->setVisibility();
		$this->fecha_creacion->setVisibility();
		$this->longitudambulancia->setVisibility();
		$this->latituambulancia->setVisibility();
		$this->especial->setVisibility();
		$this->id_tipotransport->setVisibility();
		$this->tipo_amb_es->setVisibility();
		$this->tipo_amb_en->setVisibility();
		$this->tipo_amb_pr->setVisibility();
		$this->tipo_amb_fr->setVisibility();
		$this->codigo->setVisibility();
		$this->id_especialambulancia->setVisibility();
		$this->especial_es->setVisibility();
		$this->especial_en->setVisibility();
		$this->especial_pr->setVisibility();
		$this->especial_fr->setVisibility();
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
		// Check permission

		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("asigna_ambulancialist.php");
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
			if (Get("id_ambulancias") !== NULL) {
				$this->id_ambulancias->setQueryStringValue(Get("id_ambulancias"));
				$this->RecKey["id_ambulancias"] = $this->id_ambulancias->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->id_ambulancias->setQueryStringValue(Key(0));
				$this->RecKey["id_ambulancias"] = $this->id_ambulancias->QueryStringValue;
			} elseif (Post("id_ambulancias") !== NULL) {
				$this->id_ambulancias->setFormValue(Post("id_ambulancias"));
				$this->RecKey["id_ambulancias"] = $this->id_ambulancias->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->id_ambulancias->setFormValue(Route(2));
				$this->RecKey["id_ambulancias"] = $this->id_ambulancias->FormValue;
			} else {
				$returnUrl = "asigna_ambulancialist.php"; // Return to list
			}
			if (Get("cod_ambulancias") !== NULL) {
				$this->cod_ambulancias->setQueryStringValue(Get("cod_ambulancias"));
				$this->RecKey["cod_ambulancias"] = $this->cod_ambulancias->QueryStringValue;
			} elseif (IsApi() && Key(1) !== NULL) {
				$this->cod_ambulancias->setQueryStringValue(Key(1));
				$this->RecKey["cod_ambulancias"] = $this->cod_ambulancias->QueryStringValue;
			} elseif (Post("cod_ambulancias") !== NULL) {
				$this->cod_ambulancias->setFormValue(Post("cod_ambulancias"));
				$this->RecKey["cod_ambulancias"] = $this->cod_ambulancias->FormValue;
			} elseif (IsApi() && Route(3) !== NULL) {
				$this->cod_ambulancias->setFormValue(Route(3));
				$this->RecKey["cod_ambulancias"] = $this->cod_ambulancias->FormValue;
			} else {
				$returnUrl = "asigna_ambulancialist.php"; // Return to list
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
						$returnUrl = "asigna_ambulancialist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "asigna_ambulancialist.php"; // Not page request, return to list
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
		$this->id_ambulancias->setDbValue($row['id_ambulancias']);
		$this->cod_ambulancias->setDbValue($row['cod_ambulancias']);
		$this->placas->setDbValue($row['placas']);
		$this->chasis->setDbValue($row['chasis']);
		$this->marca->setDbValue($row['marca']);
		$this->modelo->setDbValue($row['modelo']);
		$this->tipo_translado->setDbValue($row['tipo_translado']);
		$this->tipo_conbustible->setDbValue($row['tipo_conbustible']);
		$this->modalidad->setDbValue($row['modalidad']);
		$this->estado->setDbValue($row['estado']);
		$this->ubicacion->setDbValue($row['ubicacion']);
		$this->disponible->setDbValue($row['disponible']);
		$this->fecha_iniseguro->setDbValue($row['fecha_iniseguro']);
		$this->fecha_finseguro->setDbValue($row['fecha_finseguro']);
		$this->entidad->setDbValue($row['entidad']);
		$this->observacion->setDbValue($row['observacion']);
		$this->asiganda->setDbValue($row['asiganda']);
		$this->config_manteni->setDbValue($row['config_manteni']);
		$this->fecha_creacion->setDbValue($row['fecha_creacion']);
		$this->longitudambulancia->setDbValue($row['longitudambulancia']);
		$this->latituambulancia->setDbValue($row['latituambulancia']);
		$this->especial->setDbValue($row['especial']);
		$this->id_tipotransport->setDbValue($row['id_tipotransport']);
		$this->tipo_amb_es->setDbValue($row['tipo_amb_es']);
		$this->tipo_amb_en->setDbValue($row['tipo_amb_en']);
		$this->tipo_amb_pr->setDbValue($row['tipo_amb_pr']);
		$this->tipo_amb_fr->setDbValue($row['tipo_amb_fr']);
		$this->codigo->setDbValue($row['codigo']);
		$this->id_especialambulancia->setDbValue($row['id_especialambulancia']);
		$this->especial_es->setDbValue($row['especial_es']);
		$this->especial_en->setDbValue($row['especial_en']);
		$this->especial_pr->setDbValue($row['especial_pr']);
		$this->especial_fr->setDbValue($row['especial_fr']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_ambulancias'] = NULL;
		$row['cod_ambulancias'] = NULL;
		$row['placas'] = NULL;
		$row['chasis'] = NULL;
		$row['marca'] = NULL;
		$row['modelo'] = NULL;
		$row['tipo_translado'] = NULL;
		$row['tipo_conbustible'] = NULL;
		$row['modalidad'] = NULL;
		$row['estado'] = NULL;
		$row['ubicacion'] = NULL;
		$row['disponible'] = NULL;
		$row['fecha_iniseguro'] = NULL;
		$row['fecha_finseguro'] = NULL;
		$row['entidad'] = NULL;
		$row['observacion'] = NULL;
		$row['asiganda'] = NULL;
		$row['config_manteni'] = NULL;
		$row['fecha_creacion'] = NULL;
		$row['longitudambulancia'] = NULL;
		$row['latituambulancia'] = NULL;
		$row['especial'] = NULL;
		$row['id_tipotransport'] = NULL;
		$row['tipo_amb_es'] = NULL;
		$row['tipo_amb_en'] = NULL;
		$row['tipo_amb_pr'] = NULL;
		$row['tipo_amb_fr'] = NULL;
		$row['codigo'] = NULL;
		$row['id_especialambulancia'] = NULL;
		$row['especial_es'] = NULL;
		$row['especial_en'] = NULL;
		$row['especial_pr'] = NULL;
		$row['especial_fr'] = NULL;
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
		// id_ambulancias
		// cod_ambulancias
		// placas
		// chasis
		// marca
		// modelo
		// tipo_translado
		// tipo_conbustible
		// modalidad
		// estado
		// ubicacion
		// disponible
		// fecha_iniseguro
		// fecha_finseguro
		// entidad
		// observacion
		// asiganda
		// config_manteni
		// fecha_creacion
		// longitudambulancia
		// latituambulancia
		// especial
		// id_tipotransport
		// tipo_amb_es
		// tipo_amb_en
		// tipo_amb_pr
		// tipo_amb_fr
		// codigo
		// id_especialambulancia
		// especial_es
		// especial_en
		// especial_pr
		// especial_fr

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_ambulancias
			$this->id_ambulancias->ViewValue = $this->id_ambulancias->CurrentValue;
			$this->id_ambulancias->ViewValue = FormatNumber($this->id_ambulancias->ViewValue, 0, -2, -2, -2);
			$this->id_ambulancias->ViewCustomAttributes = "";

			// cod_ambulancias
			$this->cod_ambulancias->ViewValue = $this->cod_ambulancias->CurrentValue;
			$this->cod_ambulancias->ViewCustomAttributes = "";

			// placas
			$this->placas->ViewValue = $this->placas->CurrentValue;
			$this->placas->ViewCustomAttributes = "";

			// chasis
			$this->chasis->ViewValue = $this->chasis->CurrentValue;
			$this->chasis->ViewCustomAttributes = "";

			// marca
			$this->marca->ViewValue = $this->marca->CurrentValue;
			$this->marca->ViewCustomAttributes = "";

			// modelo
			$this->modelo->ViewValue = $this->modelo->CurrentValue;
			$this->modelo->ViewCustomAttributes = "";

			// tipo_translado
			$this->tipo_translado->ViewValue = $this->tipo_translado->CurrentValue;
			$this->tipo_translado->ViewValue = FormatNumber($this->tipo_translado->ViewValue, 0, -2, -2, -2);
			$this->tipo_translado->ViewCustomAttributes = "";

			// tipo_conbustible
			$this->tipo_conbustible->ViewValue = $this->tipo_conbustible->CurrentValue;
			$this->tipo_conbustible->ViewCustomAttributes = "";

			// modalidad
			$this->modalidad->ViewValue = $this->modalidad->CurrentValue;
			$this->modalidad->ViewValue = FormatNumber($this->modalidad->ViewValue, 0, -2, -2, -2);
			$this->modalidad->ViewCustomAttributes = "";

			// estado
			$this->estado->ViewValue = $this->estado->CurrentValue;
			$this->estado->ViewValue = FormatNumber($this->estado->ViewValue, 0, -2, -2, -2);
			$this->estado->ViewCustomAttributes = "";

			// ubicacion
			$this->ubicacion->ViewValue = $this->ubicacion->CurrentValue;
			$this->ubicacion->ViewCustomAttributes = "";

			// disponible
			$this->disponible->ViewValue = $this->disponible->CurrentValue;
			$this->disponible->ViewCustomAttributes = "";

			// fecha_iniseguro
			$this->fecha_iniseguro->ViewValue = $this->fecha_iniseguro->CurrentValue;
			$this->fecha_iniseguro->ViewValue = FormatDateTime($this->fecha_iniseguro->ViewValue, 0);
			$this->fecha_iniseguro->ViewCustomAttributes = "";

			// fecha_finseguro
			$this->fecha_finseguro->ViewValue = $this->fecha_finseguro->CurrentValue;
			$this->fecha_finseguro->ViewValue = FormatDateTime($this->fecha_finseguro->ViewValue, 0);
			$this->fecha_finseguro->ViewCustomAttributes = "";

			// entidad
			$this->entidad->ViewValue = $this->entidad->CurrentValue;
			$this->entidad->ViewCustomAttributes = "";

			// observacion
			$this->observacion->ViewValue = $this->observacion->CurrentValue;
			$this->observacion->ViewCustomAttributes = "";

			// asiganda
			$this->asiganda->ViewValue = $this->asiganda->CurrentValue;
			$this->asiganda->ViewCustomAttributes = "";

			// config_manteni
			$this->config_manteni->ViewValue = $this->config_manteni->CurrentValue;
			$this->config_manteni->ViewCustomAttributes = "";

			// fecha_creacion
			$this->fecha_creacion->ViewValue = $this->fecha_creacion->CurrentValue;
			$this->fecha_creacion->ViewValue = FormatDateTime($this->fecha_creacion->ViewValue, 0);
			$this->fecha_creacion->ViewCustomAttributes = "";

			// longitudambulancia
			$this->longitudambulancia->ViewValue = $this->longitudambulancia->CurrentValue;
			$this->longitudambulancia->ViewCustomAttributes = "";

			// latituambulancia
			$this->latituambulancia->ViewValue = $this->latituambulancia->CurrentValue;
			$this->latituambulancia->ViewCustomAttributes = "";

			// especial
			$this->especial->ViewValue = $this->especial->CurrentValue;
			$this->especial->ViewValue = FormatNumber($this->especial->ViewValue, 0, -2, -2, -2);
			$this->especial->ViewCustomAttributes = "";

			// id_tipotransport
			$this->id_tipotransport->ViewValue = $this->id_tipotransport->CurrentValue;
			$this->id_tipotransport->ViewValue = FormatNumber($this->id_tipotransport->ViewValue, 0, -2, -2, -2);
			$this->id_tipotransport->ViewCustomAttributes = "";

			// tipo_amb_es
			$this->tipo_amb_es->ViewValue = $this->tipo_amb_es->CurrentValue;
			$this->tipo_amb_es->ViewCustomAttributes = "";

			// tipo_amb_en
			$this->tipo_amb_en->ViewValue = $this->tipo_amb_en->CurrentValue;
			$this->tipo_amb_en->ViewCustomAttributes = "";

			// tipo_amb_pr
			$this->tipo_amb_pr->ViewValue = $this->tipo_amb_pr->CurrentValue;
			$this->tipo_amb_pr->ViewCustomAttributes = "";

			// tipo_amb_fr
			$this->tipo_amb_fr->ViewValue = $this->tipo_amb_fr->CurrentValue;
			$this->tipo_amb_fr->ViewCustomAttributes = "";

			// codigo
			$this->codigo->ViewValue = $this->codigo->CurrentValue;
			$this->codigo->ViewCustomAttributes = "";

			// id_especialambulancia
			$this->id_especialambulancia->ViewValue = $this->id_especialambulancia->CurrentValue;
			$this->id_especialambulancia->ViewValue = FormatNumber($this->id_especialambulancia->ViewValue, 0, -2, -2, -2);
			$this->id_especialambulancia->ViewCustomAttributes = "";

			// especial_es
			$this->especial_es->ViewValue = $this->especial_es->CurrentValue;
			$this->especial_es->ViewCustomAttributes = "";

			// especial_en
			$this->especial_en->ViewValue = $this->especial_en->CurrentValue;
			$this->especial_en->ViewCustomAttributes = "";

			// especial_pr
			$this->especial_pr->ViewValue = $this->especial_pr->CurrentValue;
			$this->especial_pr->ViewCustomAttributes = "";

			// especial_fr
			$this->especial_fr->ViewValue = $this->especial_fr->CurrentValue;
			$this->especial_fr->ViewCustomAttributes = "";

			// id_ambulancias
			$this->id_ambulancias->LinkCustomAttributes = "";
			$this->id_ambulancias->HrefValue = "";
			$this->id_ambulancias->TooltipValue = "";

			// cod_ambulancias
			$this->cod_ambulancias->LinkCustomAttributes = "";
			$this->cod_ambulancias->HrefValue = "";
			$this->cod_ambulancias->TooltipValue = "";

			// placas
			$this->placas->LinkCustomAttributes = "";
			$this->placas->HrefValue = "";
			$this->placas->TooltipValue = "";

			// chasis
			$this->chasis->LinkCustomAttributes = "";
			$this->chasis->HrefValue = "";
			$this->chasis->TooltipValue = "";

			// marca
			$this->marca->LinkCustomAttributes = "";
			$this->marca->HrefValue = "";
			$this->marca->TooltipValue = "";

			// modelo
			$this->modelo->LinkCustomAttributes = "";
			$this->modelo->HrefValue = "";
			$this->modelo->TooltipValue = "";

			// tipo_translado
			$this->tipo_translado->LinkCustomAttributes = "";
			$this->tipo_translado->HrefValue = "";
			$this->tipo_translado->TooltipValue = "";

			// tipo_conbustible
			$this->tipo_conbustible->LinkCustomAttributes = "";
			$this->tipo_conbustible->HrefValue = "";
			$this->tipo_conbustible->TooltipValue = "";

			// modalidad
			$this->modalidad->LinkCustomAttributes = "";
			$this->modalidad->HrefValue = "";
			$this->modalidad->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// ubicacion
			$this->ubicacion->LinkCustomAttributes = "";
			$this->ubicacion->HrefValue = "";
			$this->ubicacion->TooltipValue = "";

			// disponible
			$this->disponible->LinkCustomAttributes = "";
			$this->disponible->HrefValue = "";
			$this->disponible->TooltipValue = "";

			// fecha_iniseguro
			$this->fecha_iniseguro->LinkCustomAttributes = "";
			$this->fecha_iniseguro->HrefValue = "";
			$this->fecha_iniseguro->TooltipValue = "";

			// fecha_finseguro
			$this->fecha_finseguro->LinkCustomAttributes = "";
			$this->fecha_finseguro->HrefValue = "";
			$this->fecha_finseguro->TooltipValue = "";

			// entidad
			$this->entidad->LinkCustomAttributes = "";
			$this->entidad->HrefValue = "";
			$this->entidad->TooltipValue = "";

			// observacion
			$this->observacion->LinkCustomAttributes = "";
			$this->observacion->HrefValue = "";
			$this->observacion->TooltipValue = "";

			// asiganda
			$this->asiganda->LinkCustomAttributes = "";
			$this->asiganda->HrefValue = "";
			$this->asiganda->TooltipValue = "";

			// config_manteni
			$this->config_manteni->LinkCustomAttributes = "";
			$this->config_manteni->HrefValue = "";
			$this->config_manteni->TooltipValue = "";

			// fecha_creacion
			$this->fecha_creacion->LinkCustomAttributes = "";
			$this->fecha_creacion->HrefValue = "";
			$this->fecha_creacion->TooltipValue = "";

			// longitudambulancia
			$this->longitudambulancia->LinkCustomAttributes = "";
			$this->longitudambulancia->HrefValue = "";
			$this->longitudambulancia->TooltipValue = "";

			// latituambulancia
			$this->latituambulancia->LinkCustomAttributes = "";
			$this->latituambulancia->HrefValue = "";
			$this->latituambulancia->TooltipValue = "";

			// especial
			$this->especial->LinkCustomAttributes = "";
			$this->especial->HrefValue = "";
			$this->especial->TooltipValue = "";

			// id_tipotransport
			$this->id_tipotransport->LinkCustomAttributes = "";
			$this->id_tipotransport->HrefValue = "";
			$this->id_tipotransport->TooltipValue = "";

			// tipo_amb_es
			$this->tipo_amb_es->LinkCustomAttributes = "";
			$this->tipo_amb_es->HrefValue = "";
			$this->tipo_amb_es->TooltipValue = "";

			// tipo_amb_en
			$this->tipo_amb_en->LinkCustomAttributes = "";
			$this->tipo_amb_en->HrefValue = "";
			$this->tipo_amb_en->TooltipValue = "";

			// tipo_amb_pr
			$this->tipo_amb_pr->LinkCustomAttributes = "";
			$this->tipo_amb_pr->HrefValue = "";
			$this->tipo_amb_pr->TooltipValue = "";

			// tipo_amb_fr
			$this->tipo_amb_fr->LinkCustomAttributes = "";
			$this->tipo_amb_fr->HrefValue = "";
			$this->tipo_amb_fr->TooltipValue = "";

			// codigo
			$this->codigo->LinkCustomAttributes = "";
			$this->codigo->HrefValue = "";
			$this->codigo->TooltipValue = "";

			// id_especialambulancia
			$this->id_especialambulancia->LinkCustomAttributes = "";
			$this->id_especialambulancia->HrefValue = "";
			$this->id_especialambulancia->TooltipValue = "";

			// especial_es
			$this->especial_es->LinkCustomAttributes = "";
			$this->especial_es->HrefValue = "";
			$this->especial_es->TooltipValue = "";

			// especial_en
			$this->especial_en->LinkCustomAttributes = "";
			$this->especial_en->HrefValue = "";
			$this->especial_en->TooltipValue = "";

			// especial_pr
			$this->especial_pr->LinkCustomAttributes = "";
			$this->especial_pr->HrefValue = "";
			$this->especial_pr->TooltipValue = "";

			// especial_fr
			$this->especial_fr->LinkCustomAttributes = "";
			$this->especial_fr->HrefValue = "";
			$this->especial_fr->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("asigna_ambulancialist.php"), "", $this->TableVar, TRUE);
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
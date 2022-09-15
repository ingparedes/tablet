<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class asigna_ambulancia_add extends asigna_ambulancia
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'asigna_ambulancia';

	// Page object name
	public $PageObjName = "asigna_ambulancia_add";

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

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("asigna_ambulancialist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
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

		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("asigna_ambulancialist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id_ambulancias") !== NULL) {
				$this->id_ambulancias->setQueryStringValue(Get("id_ambulancias"));
				$this->setKey("id_ambulancias", $this->id_ambulancias->CurrentValue); // Set up key
			} else {
				$this->setKey("id_ambulancias", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("cod_ambulancias") !== NULL) {
				$this->cod_ambulancias->setQueryStringValue(Get("cod_ambulancias"));
				$this->setKey("cod_ambulancias", $this->cod_ambulancias->CurrentValue); // Set up key
			} else {
				$this->setKey("cod_ambulancias", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("asigna_ambulancialist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetAddUrl();
					if (GetPageName($returnUrl) == "asigna_ambulancialist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "asigna_ambulanciaview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_ambulancias->CurrentValue = NULL;
		$this->id_ambulancias->OldValue = $this->id_ambulancias->CurrentValue;
		$this->cod_ambulancias->CurrentValue = NULL;
		$this->cod_ambulancias->OldValue = $this->cod_ambulancias->CurrentValue;
		$this->placas->CurrentValue = NULL;
		$this->placas->OldValue = $this->placas->CurrentValue;
		$this->chasis->CurrentValue = NULL;
		$this->chasis->OldValue = $this->chasis->CurrentValue;
		$this->marca->CurrentValue = NULL;
		$this->marca->OldValue = $this->marca->CurrentValue;
		$this->modelo->CurrentValue = NULL;
		$this->modelo->OldValue = $this->modelo->CurrentValue;
		$this->tipo_translado->CurrentValue = NULL;
		$this->tipo_translado->OldValue = $this->tipo_translado->CurrentValue;
		$this->tipo_conbustible->CurrentValue = NULL;
		$this->tipo_conbustible->OldValue = $this->tipo_conbustible->CurrentValue;
		$this->modalidad->CurrentValue = NULL;
		$this->modalidad->OldValue = $this->modalidad->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->ubicacion->CurrentValue = NULL;
		$this->ubicacion->OldValue = $this->ubicacion->CurrentValue;
		$this->disponible->CurrentValue = NULL;
		$this->disponible->OldValue = $this->disponible->CurrentValue;
		$this->fecha_iniseguro->CurrentValue = NULL;
		$this->fecha_iniseguro->OldValue = $this->fecha_iniseguro->CurrentValue;
		$this->fecha_finseguro->CurrentValue = NULL;
		$this->fecha_finseguro->OldValue = $this->fecha_finseguro->CurrentValue;
		$this->entidad->CurrentValue = NULL;
		$this->entidad->OldValue = $this->entidad->CurrentValue;
		$this->observacion->CurrentValue = NULL;
		$this->observacion->OldValue = $this->observacion->CurrentValue;
		$this->asiganda->CurrentValue = NULL;
		$this->asiganda->OldValue = $this->asiganda->CurrentValue;
		$this->config_manteni->CurrentValue = NULL;
		$this->config_manteni->OldValue = $this->config_manteni->CurrentValue;
		$this->fecha_creacion->CurrentValue = NULL;
		$this->fecha_creacion->OldValue = $this->fecha_creacion->CurrentValue;
		$this->longitudambulancia->CurrentValue = NULL;
		$this->longitudambulancia->OldValue = $this->longitudambulancia->CurrentValue;
		$this->latituambulancia->CurrentValue = NULL;
		$this->latituambulancia->OldValue = $this->latituambulancia->CurrentValue;
		$this->especial->CurrentValue = NULL;
		$this->especial->OldValue = $this->especial->CurrentValue;
		$this->id_tipotransport->CurrentValue = NULL;
		$this->id_tipotransport->OldValue = $this->id_tipotransport->CurrentValue;
		$this->tipo_amb_es->CurrentValue = NULL;
		$this->tipo_amb_es->OldValue = $this->tipo_amb_es->CurrentValue;
		$this->tipo_amb_en->CurrentValue = NULL;
		$this->tipo_amb_en->OldValue = $this->tipo_amb_en->CurrentValue;
		$this->tipo_amb_pr->CurrentValue = NULL;
		$this->tipo_amb_pr->OldValue = $this->tipo_amb_pr->CurrentValue;
		$this->tipo_amb_fr->CurrentValue = NULL;
		$this->tipo_amb_fr->OldValue = $this->tipo_amb_fr->CurrentValue;
		$this->codigo->CurrentValue = NULL;
		$this->codigo->OldValue = $this->codigo->CurrentValue;
		$this->id_especialambulancia->CurrentValue = NULL;
		$this->id_especialambulancia->OldValue = $this->id_especialambulancia->CurrentValue;
		$this->especial_es->CurrentValue = NULL;
		$this->especial_es->OldValue = $this->especial_es->CurrentValue;
		$this->especial_en->CurrentValue = NULL;
		$this->especial_en->OldValue = $this->especial_en->CurrentValue;
		$this->especial_pr->CurrentValue = NULL;
		$this->especial_pr->OldValue = $this->especial_pr->CurrentValue;
		$this->especial_fr->CurrentValue = NULL;
		$this->especial_fr->OldValue = $this->especial_fr->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_ambulancias' first before field var 'x_id_ambulancias'
		$val = $CurrentForm->hasValue("id_ambulancias") ? $CurrentForm->getValue("id_ambulancias") : $CurrentForm->getValue("x_id_ambulancias");
		if (!$this->id_ambulancias->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_ambulancias->Visible = FALSE; // Disable update for API request
			else
				$this->id_ambulancias->setFormValue($val);
		}

		// Check field name 'cod_ambulancias' first before field var 'x_cod_ambulancias'
		$val = $CurrentForm->hasValue("cod_ambulancias") ? $CurrentForm->getValue("cod_ambulancias") : $CurrentForm->getValue("x_cod_ambulancias");
		if (!$this->cod_ambulancias->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cod_ambulancias->Visible = FALSE; // Disable update for API request
			else
				$this->cod_ambulancias->setFormValue($val);
		}

		// Check field name 'placas' first before field var 'x_placas'
		$val = $CurrentForm->hasValue("placas") ? $CurrentForm->getValue("placas") : $CurrentForm->getValue("x_placas");
		if (!$this->placas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->placas->Visible = FALSE; // Disable update for API request
			else
				$this->placas->setFormValue($val);
		}

		// Check field name 'chasis' first before field var 'x_chasis'
		$val = $CurrentForm->hasValue("chasis") ? $CurrentForm->getValue("chasis") : $CurrentForm->getValue("x_chasis");
		if (!$this->chasis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->chasis->Visible = FALSE; // Disable update for API request
			else
				$this->chasis->setFormValue($val);
		}

		// Check field name 'marca' first before field var 'x_marca'
		$val = $CurrentForm->hasValue("marca") ? $CurrentForm->getValue("marca") : $CurrentForm->getValue("x_marca");
		if (!$this->marca->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->marca->Visible = FALSE; // Disable update for API request
			else
				$this->marca->setFormValue($val);
		}

		// Check field name 'modelo' first before field var 'x_modelo'
		$val = $CurrentForm->hasValue("modelo") ? $CurrentForm->getValue("modelo") : $CurrentForm->getValue("x_modelo");
		if (!$this->modelo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->modelo->Visible = FALSE; // Disable update for API request
			else
				$this->modelo->setFormValue($val);
		}

		// Check field name 'tipo_translado' first before field var 'x_tipo_translado'
		$val = $CurrentForm->hasValue("tipo_translado") ? $CurrentForm->getValue("tipo_translado") : $CurrentForm->getValue("x_tipo_translado");
		if (!$this->tipo_translado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo_translado->Visible = FALSE; // Disable update for API request
			else
				$this->tipo_translado->setFormValue($val);
		}

		// Check field name 'tipo_conbustible' first before field var 'x_tipo_conbustible'
		$val = $CurrentForm->hasValue("tipo_conbustible") ? $CurrentForm->getValue("tipo_conbustible") : $CurrentForm->getValue("x_tipo_conbustible");
		if (!$this->tipo_conbustible->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo_conbustible->Visible = FALSE; // Disable update for API request
			else
				$this->tipo_conbustible->setFormValue($val);
		}

		// Check field name 'modalidad' first before field var 'x_modalidad'
		$val = $CurrentForm->hasValue("modalidad") ? $CurrentForm->getValue("modalidad") : $CurrentForm->getValue("x_modalidad");
		if (!$this->modalidad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->modalidad->Visible = FALSE; // Disable update for API request
			else
				$this->modalidad->setFormValue($val);
		}

		// Check field name 'estado' first before field var 'x_estado'
		$val = $CurrentForm->hasValue("estado") ? $CurrentForm->getValue("estado") : $CurrentForm->getValue("x_estado");
		if (!$this->estado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->estado->Visible = FALSE; // Disable update for API request
			else
				$this->estado->setFormValue($val);
		}

		// Check field name 'ubicacion' first before field var 'x_ubicacion'
		$val = $CurrentForm->hasValue("ubicacion") ? $CurrentForm->getValue("ubicacion") : $CurrentForm->getValue("x_ubicacion");
		if (!$this->ubicacion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ubicacion->Visible = FALSE; // Disable update for API request
			else
				$this->ubicacion->setFormValue($val);
		}

		// Check field name 'disponible' first before field var 'x_disponible'
		$val = $CurrentForm->hasValue("disponible") ? $CurrentForm->getValue("disponible") : $CurrentForm->getValue("x_disponible");
		if (!$this->disponible->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disponible->Visible = FALSE; // Disable update for API request
			else
				$this->disponible->setFormValue($val);
		}

		// Check field name 'fecha_iniseguro' first before field var 'x_fecha_iniseguro'
		$val = $CurrentForm->hasValue("fecha_iniseguro") ? $CurrentForm->getValue("fecha_iniseguro") : $CurrentForm->getValue("x_fecha_iniseguro");
		if (!$this->fecha_iniseguro->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha_iniseguro->Visible = FALSE; // Disable update for API request
			else
				$this->fecha_iniseguro->setFormValue($val);
			$this->fecha_iniseguro->CurrentValue = UnFormatDateTime($this->fecha_iniseguro->CurrentValue, 0);
		}

		// Check field name 'fecha_finseguro' first before field var 'x_fecha_finseguro'
		$val = $CurrentForm->hasValue("fecha_finseguro") ? $CurrentForm->getValue("fecha_finseguro") : $CurrentForm->getValue("x_fecha_finseguro");
		if (!$this->fecha_finseguro->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha_finseguro->Visible = FALSE; // Disable update for API request
			else
				$this->fecha_finseguro->setFormValue($val);
			$this->fecha_finseguro->CurrentValue = UnFormatDateTime($this->fecha_finseguro->CurrentValue, 0);
		}

		// Check field name 'entidad' first before field var 'x_entidad'
		$val = $CurrentForm->hasValue("entidad") ? $CurrentForm->getValue("entidad") : $CurrentForm->getValue("x_entidad");
		if (!$this->entidad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->entidad->Visible = FALSE; // Disable update for API request
			else
				$this->entidad->setFormValue($val);
		}

		// Check field name 'observacion' first before field var 'x_observacion'
		$val = $CurrentForm->hasValue("observacion") ? $CurrentForm->getValue("observacion") : $CurrentForm->getValue("x_observacion");
		if (!$this->observacion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->observacion->Visible = FALSE; // Disable update for API request
			else
				$this->observacion->setFormValue($val);
		}

		// Check field name 'asiganda' first before field var 'x_asiganda'
		$val = $CurrentForm->hasValue("asiganda") ? $CurrentForm->getValue("asiganda") : $CurrentForm->getValue("x_asiganda");
		if (!$this->asiganda->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->asiganda->Visible = FALSE; // Disable update for API request
			else
				$this->asiganda->setFormValue($val);
		}

		// Check field name 'config_manteni' first before field var 'x_config_manteni'
		$val = $CurrentForm->hasValue("config_manteni") ? $CurrentForm->getValue("config_manteni") : $CurrentForm->getValue("x_config_manteni");
		if (!$this->config_manteni->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->config_manteni->Visible = FALSE; // Disable update for API request
			else
				$this->config_manteni->setFormValue($val);
		}

		// Check field name 'fecha_creacion' first before field var 'x_fecha_creacion'
		$val = $CurrentForm->hasValue("fecha_creacion") ? $CurrentForm->getValue("fecha_creacion") : $CurrentForm->getValue("x_fecha_creacion");
		if (!$this->fecha_creacion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha_creacion->Visible = FALSE; // Disable update for API request
			else
				$this->fecha_creacion->setFormValue($val);
			$this->fecha_creacion->CurrentValue = UnFormatDateTime($this->fecha_creacion->CurrentValue, 0);
		}

		// Check field name 'longitudambulancia' first before field var 'x_longitudambulancia'
		$val = $CurrentForm->hasValue("longitudambulancia") ? $CurrentForm->getValue("longitudambulancia") : $CurrentForm->getValue("x_longitudambulancia");
		if (!$this->longitudambulancia->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->longitudambulancia->Visible = FALSE; // Disable update for API request
			else
				$this->longitudambulancia->setFormValue($val);
		}

		// Check field name 'latituambulancia' first before field var 'x_latituambulancia'
		$val = $CurrentForm->hasValue("latituambulancia") ? $CurrentForm->getValue("latituambulancia") : $CurrentForm->getValue("x_latituambulancia");
		if (!$this->latituambulancia->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->latituambulancia->Visible = FALSE; // Disable update for API request
			else
				$this->latituambulancia->setFormValue($val);
		}

		// Check field name 'especial' first before field var 'x_especial'
		$val = $CurrentForm->hasValue("especial") ? $CurrentForm->getValue("especial") : $CurrentForm->getValue("x_especial");
		if (!$this->especial->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->especial->Visible = FALSE; // Disable update for API request
			else
				$this->especial->setFormValue($val);
		}

		// Check field name 'id_tipotransport' first before field var 'x_id_tipotransport'
		$val = $CurrentForm->hasValue("id_tipotransport") ? $CurrentForm->getValue("id_tipotransport") : $CurrentForm->getValue("x_id_tipotransport");
		if (!$this->id_tipotransport->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_tipotransport->Visible = FALSE; // Disable update for API request
			else
				$this->id_tipotransport->setFormValue($val);
		}

		// Check field name 'tipo_amb_es' first before field var 'x_tipo_amb_es'
		$val = $CurrentForm->hasValue("tipo_amb_es") ? $CurrentForm->getValue("tipo_amb_es") : $CurrentForm->getValue("x_tipo_amb_es");
		if (!$this->tipo_amb_es->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo_amb_es->Visible = FALSE; // Disable update for API request
			else
				$this->tipo_amb_es->setFormValue($val);
		}

		// Check field name 'tipo_amb_en' first before field var 'x_tipo_amb_en'
		$val = $CurrentForm->hasValue("tipo_amb_en") ? $CurrentForm->getValue("tipo_amb_en") : $CurrentForm->getValue("x_tipo_amb_en");
		if (!$this->tipo_amb_en->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo_amb_en->Visible = FALSE; // Disable update for API request
			else
				$this->tipo_amb_en->setFormValue($val);
		}

		// Check field name 'tipo_amb_pr' first before field var 'x_tipo_amb_pr'
		$val = $CurrentForm->hasValue("tipo_amb_pr") ? $CurrentForm->getValue("tipo_amb_pr") : $CurrentForm->getValue("x_tipo_amb_pr");
		if (!$this->tipo_amb_pr->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo_amb_pr->Visible = FALSE; // Disable update for API request
			else
				$this->tipo_amb_pr->setFormValue($val);
		}

		// Check field name 'tipo_amb_fr' first before field var 'x_tipo_amb_fr'
		$val = $CurrentForm->hasValue("tipo_amb_fr") ? $CurrentForm->getValue("tipo_amb_fr") : $CurrentForm->getValue("x_tipo_amb_fr");
		if (!$this->tipo_amb_fr->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipo_amb_fr->Visible = FALSE; // Disable update for API request
			else
				$this->tipo_amb_fr->setFormValue($val);
		}

		// Check field name 'codigo' first before field var 'x_codigo'
		$val = $CurrentForm->hasValue("codigo") ? $CurrentForm->getValue("codigo") : $CurrentForm->getValue("x_codigo");
		if (!$this->codigo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->codigo->Visible = FALSE; // Disable update for API request
			else
				$this->codigo->setFormValue($val);
		}

		// Check field name 'id_especialambulancia' first before field var 'x_id_especialambulancia'
		$val = $CurrentForm->hasValue("id_especialambulancia") ? $CurrentForm->getValue("id_especialambulancia") : $CurrentForm->getValue("x_id_especialambulancia");
		if (!$this->id_especialambulancia->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_especialambulancia->Visible = FALSE; // Disable update for API request
			else
				$this->id_especialambulancia->setFormValue($val);
		}

		// Check field name 'especial_es' first before field var 'x_especial_es'
		$val = $CurrentForm->hasValue("especial_es") ? $CurrentForm->getValue("especial_es") : $CurrentForm->getValue("x_especial_es");
		if (!$this->especial_es->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->especial_es->Visible = FALSE; // Disable update for API request
			else
				$this->especial_es->setFormValue($val);
		}

		// Check field name 'especial_en' first before field var 'x_especial_en'
		$val = $CurrentForm->hasValue("especial_en") ? $CurrentForm->getValue("especial_en") : $CurrentForm->getValue("x_especial_en");
		if (!$this->especial_en->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->especial_en->Visible = FALSE; // Disable update for API request
			else
				$this->especial_en->setFormValue($val);
		}

		// Check field name 'especial_pr' first before field var 'x_especial_pr'
		$val = $CurrentForm->hasValue("especial_pr") ? $CurrentForm->getValue("especial_pr") : $CurrentForm->getValue("x_especial_pr");
		if (!$this->especial_pr->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->especial_pr->Visible = FALSE; // Disable update for API request
			else
				$this->especial_pr->setFormValue($val);
		}

		// Check field name 'especial_fr' first before field var 'x_especial_fr'
		$val = $CurrentForm->hasValue("especial_fr") ? $CurrentForm->getValue("especial_fr") : $CurrentForm->getValue("x_especial_fr");
		if (!$this->especial_fr->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->especial_fr->Visible = FALSE; // Disable update for API request
			else
				$this->especial_fr->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_ambulancias->CurrentValue = $this->id_ambulancias->FormValue;
		$this->cod_ambulancias->CurrentValue = $this->cod_ambulancias->FormValue;
		$this->placas->CurrentValue = $this->placas->FormValue;
		$this->chasis->CurrentValue = $this->chasis->FormValue;
		$this->marca->CurrentValue = $this->marca->FormValue;
		$this->modelo->CurrentValue = $this->modelo->FormValue;
		$this->tipo_translado->CurrentValue = $this->tipo_translado->FormValue;
		$this->tipo_conbustible->CurrentValue = $this->tipo_conbustible->FormValue;
		$this->modalidad->CurrentValue = $this->modalidad->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->ubicacion->CurrentValue = $this->ubicacion->FormValue;
		$this->disponible->CurrentValue = $this->disponible->FormValue;
		$this->fecha_iniseguro->CurrentValue = $this->fecha_iniseguro->FormValue;
		$this->fecha_iniseguro->CurrentValue = UnFormatDateTime($this->fecha_iniseguro->CurrentValue, 0);
		$this->fecha_finseguro->CurrentValue = $this->fecha_finseguro->FormValue;
		$this->fecha_finseguro->CurrentValue = UnFormatDateTime($this->fecha_finseguro->CurrentValue, 0);
		$this->entidad->CurrentValue = $this->entidad->FormValue;
		$this->observacion->CurrentValue = $this->observacion->FormValue;
		$this->asiganda->CurrentValue = $this->asiganda->FormValue;
		$this->config_manteni->CurrentValue = $this->config_manteni->FormValue;
		$this->fecha_creacion->CurrentValue = $this->fecha_creacion->FormValue;
		$this->fecha_creacion->CurrentValue = UnFormatDateTime($this->fecha_creacion->CurrentValue, 0);
		$this->longitudambulancia->CurrentValue = $this->longitudambulancia->FormValue;
		$this->latituambulancia->CurrentValue = $this->latituambulancia->FormValue;
		$this->especial->CurrentValue = $this->especial->FormValue;
		$this->id_tipotransport->CurrentValue = $this->id_tipotransport->FormValue;
		$this->tipo_amb_es->CurrentValue = $this->tipo_amb_es->FormValue;
		$this->tipo_amb_en->CurrentValue = $this->tipo_amb_en->FormValue;
		$this->tipo_amb_pr->CurrentValue = $this->tipo_amb_pr->FormValue;
		$this->tipo_amb_fr->CurrentValue = $this->tipo_amb_fr->FormValue;
		$this->codigo->CurrentValue = $this->codigo->FormValue;
		$this->id_especialambulancia->CurrentValue = $this->id_especialambulancia->FormValue;
		$this->especial_es->CurrentValue = $this->especial_es->FormValue;
		$this->especial_en->CurrentValue = $this->especial_en->FormValue;
		$this->especial_pr->CurrentValue = $this->especial_pr->FormValue;
		$this->especial_fr->CurrentValue = $this->especial_fr->FormValue;
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
		$this->loadDefaultValues();
		$row = [];
		$row['id_ambulancias'] = $this->id_ambulancias->CurrentValue;
		$row['cod_ambulancias'] = $this->cod_ambulancias->CurrentValue;
		$row['placas'] = $this->placas->CurrentValue;
		$row['chasis'] = $this->chasis->CurrentValue;
		$row['marca'] = $this->marca->CurrentValue;
		$row['modelo'] = $this->modelo->CurrentValue;
		$row['tipo_translado'] = $this->tipo_translado->CurrentValue;
		$row['tipo_conbustible'] = $this->tipo_conbustible->CurrentValue;
		$row['modalidad'] = $this->modalidad->CurrentValue;
		$row['estado'] = $this->estado->CurrentValue;
		$row['ubicacion'] = $this->ubicacion->CurrentValue;
		$row['disponible'] = $this->disponible->CurrentValue;
		$row['fecha_iniseguro'] = $this->fecha_iniseguro->CurrentValue;
		$row['fecha_finseguro'] = $this->fecha_finseguro->CurrentValue;
		$row['entidad'] = $this->entidad->CurrentValue;
		$row['observacion'] = $this->observacion->CurrentValue;
		$row['asiganda'] = $this->asiganda->CurrentValue;
		$row['config_manteni'] = $this->config_manteni->CurrentValue;
		$row['fecha_creacion'] = $this->fecha_creacion->CurrentValue;
		$row['longitudambulancia'] = $this->longitudambulancia->CurrentValue;
		$row['latituambulancia'] = $this->latituambulancia->CurrentValue;
		$row['especial'] = $this->especial->CurrentValue;
		$row['id_tipotransport'] = $this->id_tipotransport->CurrentValue;
		$row['tipo_amb_es'] = $this->tipo_amb_es->CurrentValue;
		$row['tipo_amb_en'] = $this->tipo_amb_en->CurrentValue;
		$row['tipo_amb_pr'] = $this->tipo_amb_pr->CurrentValue;
		$row['tipo_amb_fr'] = $this->tipo_amb_fr->CurrentValue;
		$row['codigo'] = $this->codigo->CurrentValue;
		$row['id_especialambulancia'] = $this->id_especialambulancia->CurrentValue;
		$row['especial_es'] = $this->especial_es->CurrentValue;
		$row['especial_en'] = $this->especial_en->CurrentValue;
		$row['especial_pr'] = $this->especial_pr->CurrentValue;
		$row['especial_fr'] = $this->especial_fr->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_ambulancias")) != "")
			$this->id_ambulancias->OldValue = $this->getKey("id_ambulancias"); // id_ambulancias
		else
			$validKey = FALSE;
		if (strval($this->getKey("cod_ambulancias")) != "")
			$this->cod_ambulancias->OldValue = $this->getKey("cod_ambulancias"); // cod_ambulancias
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_ambulancias
			$this->id_ambulancias->EditAttrs["class"] = "form-control";
			$this->id_ambulancias->EditCustomAttributes = "";
			$this->id_ambulancias->EditValue = HtmlEncode($this->id_ambulancias->CurrentValue);
			$this->id_ambulancias->PlaceHolder = RemoveHtml($this->id_ambulancias->caption());

			// cod_ambulancias
			$this->cod_ambulancias->EditAttrs["class"] = "form-control";
			$this->cod_ambulancias->EditCustomAttributes = "";
			if (!$this->cod_ambulancias->Raw)
				$this->cod_ambulancias->CurrentValue = HtmlDecode($this->cod_ambulancias->CurrentValue);
			$this->cod_ambulancias->EditValue = HtmlEncode($this->cod_ambulancias->CurrentValue);
			$this->cod_ambulancias->PlaceHolder = RemoveHtml($this->cod_ambulancias->caption());

			// placas
			$this->placas->EditAttrs["class"] = "form-control";
			$this->placas->EditCustomAttributes = "";
			if (!$this->placas->Raw)
				$this->placas->CurrentValue = HtmlDecode($this->placas->CurrentValue);
			$this->placas->EditValue = HtmlEncode($this->placas->CurrentValue);
			$this->placas->PlaceHolder = RemoveHtml($this->placas->caption());

			// chasis
			$this->chasis->EditAttrs["class"] = "form-control";
			$this->chasis->EditCustomAttributes = "";
			if (!$this->chasis->Raw)
				$this->chasis->CurrentValue = HtmlDecode($this->chasis->CurrentValue);
			$this->chasis->EditValue = HtmlEncode($this->chasis->CurrentValue);
			$this->chasis->PlaceHolder = RemoveHtml($this->chasis->caption());

			// marca
			$this->marca->EditAttrs["class"] = "form-control";
			$this->marca->EditCustomAttributes = "";
			if (!$this->marca->Raw)
				$this->marca->CurrentValue = HtmlDecode($this->marca->CurrentValue);
			$this->marca->EditValue = HtmlEncode($this->marca->CurrentValue);
			$this->marca->PlaceHolder = RemoveHtml($this->marca->caption());

			// modelo
			$this->modelo->EditAttrs["class"] = "form-control";
			$this->modelo->EditCustomAttributes = "";
			if (!$this->modelo->Raw)
				$this->modelo->CurrentValue = HtmlDecode($this->modelo->CurrentValue);
			$this->modelo->EditValue = HtmlEncode($this->modelo->CurrentValue);
			$this->modelo->PlaceHolder = RemoveHtml($this->modelo->caption());

			// tipo_translado
			$this->tipo_translado->EditAttrs["class"] = "form-control";
			$this->tipo_translado->EditCustomAttributes = "";
			$this->tipo_translado->EditValue = HtmlEncode($this->tipo_translado->CurrentValue);
			$this->tipo_translado->PlaceHolder = RemoveHtml($this->tipo_translado->caption());

			// tipo_conbustible
			$this->tipo_conbustible->EditAttrs["class"] = "form-control";
			$this->tipo_conbustible->EditCustomAttributes = "";
			if (!$this->tipo_conbustible->Raw)
				$this->tipo_conbustible->CurrentValue = HtmlDecode($this->tipo_conbustible->CurrentValue);
			$this->tipo_conbustible->EditValue = HtmlEncode($this->tipo_conbustible->CurrentValue);
			$this->tipo_conbustible->PlaceHolder = RemoveHtml($this->tipo_conbustible->caption());

			// modalidad
			$this->modalidad->EditAttrs["class"] = "form-control";
			$this->modalidad->EditCustomAttributes = "";
			$this->modalidad->EditValue = HtmlEncode($this->modalidad->CurrentValue);
			$this->modalidad->PlaceHolder = RemoveHtml($this->modalidad->caption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = RemoveHtml($this->estado->caption());

			// ubicacion
			$this->ubicacion->EditAttrs["class"] = "form-control";
			$this->ubicacion->EditCustomAttributes = "";
			if (!$this->ubicacion->Raw)
				$this->ubicacion->CurrentValue = HtmlDecode($this->ubicacion->CurrentValue);
			$this->ubicacion->EditValue = HtmlEncode($this->ubicacion->CurrentValue);
			$this->ubicacion->PlaceHolder = RemoveHtml($this->ubicacion->caption());

			// disponible
			$this->disponible->EditAttrs["class"] = "form-control";
			$this->disponible->EditCustomAttributes = "";
			if (!$this->disponible->Raw)
				$this->disponible->CurrentValue = HtmlDecode($this->disponible->CurrentValue);
			$this->disponible->EditValue = HtmlEncode($this->disponible->CurrentValue);
			$this->disponible->PlaceHolder = RemoveHtml($this->disponible->caption());

			// fecha_iniseguro
			$this->fecha_iniseguro->EditAttrs["class"] = "form-control";
			$this->fecha_iniseguro->EditCustomAttributes = "";
			$this->fecha_iniseguro->EditValue = HtmlEncode(FormatDateTime($this->fecha_iniseguro->CurrentValue, 8));
			$this->fecha_iniseguro->PlaceHolder = RemoveHtml($this->fecha_iniseguro->caption());

			// fecha_finseguro
			$this->fecha_finseguro->EditAttrs["class"] = "form-control";
			$this->fecha_finseguro->EditCustomAttributes = "";
			$this->fecha_finseguro->EditValue = HtmlEncode(FormatDateTime($this->fecha_finseguro->CurrentValue, 8));
			$this->fecha_finseguro->PlaceHolder = RemoveHtml($this->fecha_finseguro->caption());

			// entidad
			$this->entidad->EditAttrs["class"] = "form-control";
			$this->entidad->EditCustomAttributes = "";
			if (!$this->entidad->Raw)
				$this->entidad->CurrentValue = HtmlDecode($this->entidad->CurrentValue);
			$this->entidad->EditValue = HtmlEncode($this->entidad->CurrentValue);
			$this->entidad->PlaceHolder = RemoveHtml($this->entidad->caption());

			// observacion
			$this->observacion->EditAttrs["class"] = "form-control";
			$this->observacion->EditCustomAttributes = "";
			if (!$this->observacion->Raw)
				$this->observacion->CurrentValue = HtmlDecode($this->observacion->CurrentValue);
			$this->observacion->EditValue = HtmlEncode($this->observacion->CurrentValue);
			$this->observacion->PlaceHolder = RemoveHtml($this->observacion->caption());

			// asiganda
			$this->asiganda->EditAttrs["class"] = "form-control";
			$this->asiganda->EditCustomAttributes = "";
			if (!$this->asiganda->Raw)
				$this->asiganda->CurrentValue = HtmlDecode($this->asiganda->CurrentValue);
			$this->asiganda->EditValue = HtmlEncode($this->asiganda->CurrentValue);
			$this->asiganda->PlaceHolder = RemoveHtml($this->asiganda->caption());

			// config_manteni
			$this->config_manteni->EditAttrs["class"] = "form-control";
			$this->config_manteni->EditCustomAttributes = "";
			if (!$this->config_manteni->Raw)
				$this->config_manteni->CurrentValue = HtmlDecode($this->config_manteni->CurrentValue);
			$this->config_manteni->EditValue = HtmlEncode($this->config_manteni->CurrentValue);
			$this->config_manteni->PlaceHolder = RemoveHtml($this->config_manteni->caption());

			// fecha_creacion
			$this->fecha_creacion->EditAttrs["class"] = "form-control";
			$this->fecha_creacion->EditCustomAttributes = "";
			$this->fecha_creacion->EditValue = HtmlEncode(FormatDateTime($this->fecha_creacion->CurrentValue, 8));
			$this->fecha_creacion->PlaceHolder = RemoveHtml($this->fecha_creacion->caption());

			// longitudambulancia
			$this->longitudambulancia->EditAttrs["class"] = "form-control";
			$this->longitudambulancia->EditCustomAttributes = "";
			if (!$this->longitudambulancia->Raw)
				$this->longitudambulancia->CurrentValue = HtmlDecode($this->longitudambulancia->CurrentValue);
			$this->longitudambulancia->EditValue = HtmlEncode($this->longitudambulancia->CurrentValue);
			$this->longitudambulancia->PlaceHolder = RemoveHtml($this->longitudambulancia->caption());

			// latituambulancia
			$this->latituambulancia->EditAttrs["class"] = "form-control";
			$this->latituambulancia->EditCustomAttributes = "";
			if (!$this->latituambulancia->Raw)
				$this->latituambulancia->CurrentValue = HtmlDecode($this->latituambulancia->CurrentValue);
			$this->latituambulancia->EditValue = HtmlEncode($this->latituambulancia->CurrentValue);
			$this->latituambulancia->PlaceHolder = RemoveHtml($this->latituambulancia->caption());

			// especial
			$this->especial->EditAttrs["class"] = "form-control";
			$this->especial->EditCustomAttributes = "";
			$this->especial->EditValue = HtmlEncode($this->especial->CurrentValue);
			$this->especial->PlaceHolder = RemoveHtml($this->especial->caption());

			// id_tipotransport
			$this->id_tipotransport->EditAttrs["class"] = "form-control";
			$this->id_tipotransport->EditCustomAttributes = "";
			$this->id_tipotransport->EditValue = HtmlEncode($this->id_tipotransport->CurrentValue);
			$this->id_tipotransport->PlaceHolder = RemoveHtml($this->id_tipotransport->caption());

			// tipo_amb_es
			$this->tipo_amb_es->EditAttrs["class"] = "form-control";
			$this->tipo_amb_es->EditCustomAttributes = "";
			if (!$this->tipo_amb_es->Raw)
				$this->tipo_amb_es->CurrentValue = HtmlDecode($this->tipo_amb_es->CurrentValue);
			$this->tipo_amb_es->EditValue = HtmlEncode($this->tipo_amb_es->CurrentValue);
			$this->tipo_amb_es->PlaceHolder = RemoveHtml($this->tipo_amb_es->caption());

			// tipo_amb_en
			$this->tipo_amb_en->EditAttrs["class"] = "form-control";
			$this->tipo_amb_en->EditCustomAttributes = "";
			if (!$this->tipo_amb_en->Raw)
				$this->tipo_amb_en->CurrentValue = HtmlDecode($this->tipo_amb_en->CurrentValue);
			$this->tipo_amb_en->EditValue = HtmlEncode($this->tipo_amb_en->CurrentValue);
			$this->tipo_amb_en->PlaceHolder = RemoveHtml($this->tipo_amb_en->caption());

			// tipo_amb_pr
			$this->tipo_amb_pr->EditAttrs["class"] = "form-control";
			$this->tipo_amb_pr->EditCustomAttributes = "";
			if (!$this->tipo_amb_pr->Raw)
				$this->tipo_amb_pr->CurrentValue = HtmlDecode($this->tipo_amb_pr->CurrentValue);
			$this->tipo_amb_pr->EditValue = HtmlEncode($this->tipo_amb_pr->CurrentValue);
			$this->tipo_amb_pr->PlaceHolder = RemoveHtml($this->tipo_amb_pr->caption());

			// tipo_amb_fr
			$this->tipo_amb_fr->EditAttrs["class"] = "form-control";
			$this->tipo_amb_fr->EditCustomAttributes = "";
			if (!$this->tipo_amb_fr->Raw)
				$this->tipo_amb_fr->CurrentValue = HtmlDecode($this->tipo_amb_fr->CurrentValue);
			$this->tipo_amb_fr->EditValue = HtmlEncode($this->tipo_amb_fr->CurrentValue);
			$this->tipo_amb_fr->PlaceHolder = RemoveHtml($this->tipo_amb_fr->caption());

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			if (!$this->codigo->Raw)
				$this->codigo->CurrentValue = HtmlDecode($this->codigo->CurrentValue);
			$this->codigo->EditValue = HtmlEncode($this->codigo->CurrentValue);
			$this->codigo->PlaceHolder = RemoveHtml($this->codigo->caption());

			// id_especialambulancia
			$this->id_especialambulancia->EditAttrs["class"] = "form-control";
			$this->id_especialambulancia->EditCustomAttributes = "";
			$this->id_especialambulancia->EditValue = HtmlEncode($this->id_especialambulancia->CurrentValue);
			$this->id_especialambulancia->PlaceHolder = RemoveHtml($this->id_especialambulancia->caption());

			// especial_es
			$this->especial_es->EditAttrs["class"] = "form-control";
			$this->especial_es->EditCustomAttributes = "";
			if (!$this->especial_es->Raw)
				$this->especial_es->CurrentValue = HtmlDecode($this->especial_es->CurrentValue);
			$this->especial_es->EditValue = HtmlEncode($this->especial_es->CurrentValue);
			$this->especial_es->PlaceHolder = RemoveHtml($this->especial_es->caption());

			// especial_en
			$this->especial_en->EditAttrs["class"] = "form-control";
			$this->especial_en->EditCustomAttributes = "";
			if (!$this->especial_en->Raw)
				$this->especial_en->CurrentValue = HtmlDecode($this->especial_en->CurrentValue);
			$this->especial_en->EditValue = HtmlEncode($this->especial_en->CurrentValue);
			$this->especial_en->PlaceHolder = RemoveHtml($this->especial_en->caption());

			// especial_pr
			$this->especial_pr->EditAttrs["class"] = "form-control";
			$this->especial_pr->EditCustomAttributes = "";
			if (!$this->especial_pr->Raw)
				$this->especial_pr->CurrentValue = HtmlDecode($this->especial_pr->CurrentValue);
			$this->especial_pr->EditValue = HtmlEncode($this->especial_pr->CurrentValue);
			$this->especial_pr->PlaceHolder = RemoveHtml($this->especial_pr->caption());

			// especial_fr
			$this->especial_fr->EditAttrs["class"] = "form-control";
			$this->especial_fr->EditCustomAttributes = "";
			if (!$this->especial_fr->Raw)
				$this->especial_fr->CurrentValue = HtmlDecode($this->especial_fr->CurrentValue);
			$this->especial_fr->EditValue = HtmlEncode($this->especial_fr->CurrentValue);
			$this->especial_fr->PlaceHolder = RemoveHtml($this->especial_fr->caption());

			// Add refer script
			// id_ambulancias

			$this->id_ambulancias->LinkCustomAttributes = "";
			$this->id_ambulancias->HrefValue = "";

			// cod_ambulancias
			$this->cod_ambulancias->LinkCustomAttributes = "";
			$this->cod_ambulancias->HrefValue = "";

			// placas
			$this->placas->LinkCustomAttributes = "";
			$this->placas->HrefValue = "";

			// chasis
			$this->chasis->LinkCustomAttributes = "";
			$this->chasis->HrefValue = "";

			// marca
			$this->marca->LinkCustomAttributes = "";
			$this->marca->HrefValue = "";

			// modelo
			$this->modelo->LinkCustomAttributes = "";
			$this->modelo->HrefValue = "";

			// tipo_translado
			$this->tipo_translado->LinkCustomAttributes = "";
			$this->tipo_translado->HrefValue = "";

			// tipo_conbustible
			$this->tipo_conbustible->LinkCustomAttributes = "";
			$this->tipo_conbustible->HrefValue = "";

			// modalidad
			$this->modalidad->LinkCustomAttributes = "";
			$this->modalidad->HrefValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";

			// ubicacion
			$this->ubicacion->LinkCustomAttributes = "";
			$this->ubicacion->HrefValue = "";

			// disponible
			$this->disponible->LinkCustomAttributes = "";
			$this->disponible->HrefValue = "";

			// fecha_iniseguro
			$this->fecha_iniseguro->LinkCustomAttributes = "";
			$this->fecha_iniseguro->HrefValue = "";

			// fecha_finseguro
			$this->fecha_finseguro->LinkCustomAttributes = "";
			$this->fecha_finseguro->HrefValue = "";

			// entidad
			$this->entidad->LinkCustomAttributes = "";
			$this->entidad->HrefValue = "";

			// observacion
			$this->observacion->LinkCustomAttributes = "";
			$this->observacion->HrefValue = "";

			// asiganda
			$this->asiganda->LinkCustomAttributes = "";
			$this->asiganda->HrefValue = "";

			// config_manteni
			$this->config_manteni->LinkCustomAttributes = "";
			$this->config_manteni->HrefValue = "";

			// fecha_creacion
			$this->fecha_creacion->LinkCustomAttributes = "";
			$this->fecha_creacion->HrefValue = "";

			// longitudambulancia
			$this->longitudambulancia->LinkCustomAttributes = "";
			$this->longitudambulancia->HrefValue = "";

			// latituambulancia
			$this->latituambulancia->LinkCustomAttributes = "";
			$this->latituambulancia->HrefValue = "";

			// especial
			$this->especial->LinkCustomAttributes = "";
			$this->especial->HrefValue = "";

			// id_tipotransport
			$this->id_tipotransport->LinkCustomAttributes = "";
			$this->id_tipotransport->HrefValue = "";

			// tipo_amb_es
			$this->tipo_amb_es->LinkCustomAttributes = "";
			$this->tipo_amb_es->HrefValue = "";

			// tipo_amb_en
			$this->tipo_amb_en->LinkCustomAttributes = "";
			$this->tipo_amb_en->HrefValue = "";

			// tipo_amb_pr
			$this->tipo_amb_pr->LinkCustomAttributes = "";
			$this->tipo_amb_pr->HrefValue = "";

			// tipo_amb_fr
			$this->tipo_amb_fr->LinkCustomAttributes = "";
			$this->tipo_amb_fr->HrefValue = "";

			// codigo
			$this->codigo->LinkCustomAttributes = "";
			$this->codigo->HrefValue = "";

			// id_especialambulancia
			$this->id_especialambulancia->LinkCustomAttributes = "";
			$this->id_especialambulancia->HrefValue = "";

			// especial_es
			$this->especial_es->LinkCustomAttributes = "";
			$this->especial_es->HrefValue = "";

			// especial_en
			$this->especial_en->LinkCustomAttributes = "";
			$this->especial_en->HrefValue = "";

			// especial_pr
			$this->especial_pr->LinkCustomAttributes = "";
			$this->especial_pr->HrefValue = "";

			// especial_fr
			$this->especial_fr->LinkCustomAttributes = "";
			$this->especial_fr->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id_ambulancias->Required) {
			if (!$this->id_ambulancias->IsDetailKey && $this->id_ambulancias->FormValue != NULL && $this->id_ambulancias->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_ambulancias->caption(), $this->id_ambulancias->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_ambulancias->FormValue)) {
			AddMessage($FormError, $this->id_ambulancias->errorMessage());
		}
		if ($this->cod_ambulancias->Required) {
			if (!$this->cod_ambulancias->IsDetailKey && $this->cod_ambulancias->FormValue != NULL && $this->cod_ambulancias->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cod_ambulancias->caption(), $this->cod_ambulancias->RequiredErrorMessage));
			}
		}
		if ($this->placas->Required) {
			if (!$this->placas->IsDetailKey && $this->placas->FormValue != NULL && $this->placas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->placas->caption(), $this->placas->RequiredErrorMessage));
			}
		}
		if ($this->chasis->Required) {
			if (!$this->chasis->IsDetailKey && $this->chasis->FormValue != NULL && $this->chasis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->chasis->caption(), $this->chasis->RequiredErrorMessage));
			}
		}
		if ($this->marca->Required) {
			if (!$this->marca->IsDetailKey && $this->marca->FormValue != NULL && $this->marca->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->marca->caption(), $this->marca->RequiredErrorMessage));
			}
		}
		if ($this->modelo->Required) {
			if (!$this->modelo->IsDetailKey && $this->modelo->FormValue != NULL && $this->modelo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->modelo->caption(), $this->modelo->RequiredErrorMessage));
			}
		}
		if ($this->tipo_translado->Required) {
			if (!$this->tipo_translado->IsDetailKey && $this->tipo_translado->FormValue != NULL && $this->tipo_translado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_translado->caption(), $this->tipo_translado->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tipo_translado->FormValue)) {
			AddMessage($FormError, $this->tipo_translado->errorMessage());
		}
		if ($this->tipo_conbustible->Required) {
			if (!$this->tipo_conbustible->IsDetailKey && $this->tipo_conbustible->FormValue != NULL && $this->tipo_conbustible->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_conbustible->caption(), $this->tipo_conbustible->RequiredErrorMessage));
			}
		}
		if ($this->modalidad->Required) {
			if (!$this->modalidad->IsDetailKey && $this->modalidad->FormValue != NULL && $this->modalidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->modalidad->caption(), $this->modalidad->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->modalidad->FormValue)) {
			AddMessage($FormError, $this->modalidad->errorMessage());
		}
		if ($this->estado->Required) {
			if (!$this->estado->IsDetailKey && $this->estado->FormValue != NULL && $this->estado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->estado->caption(), $this->estado->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->estado->FormValue)) {
			AddMessage($FormError, $this->estado->errorMessage());
		}
		if ($this->ubicacion->Required) {
			if (!$this->ubicacion->IsDetailKey && $this->ubicacion->FormValue != NULL && $this->ubicacion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ubicacion->caption(), $this->ubicacion->RequiredErrorMessage));
			}
		}
		if ($this->disponible->Required) {
			if (!$this->disponible->IsDetailKey && $this->disponible->FormValue != NULL && $this->disponible->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disponible->caption(), $this->disponible->RequiredErrorMessage));
			}
		}
		if ($this->fecha_iniseguro->Required) {
			if (!$this->fecha_iniseguro->IsDetailKey && $this->fecha_iniseguro->FormValue != NULL && $this->fecha_iniseguro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha_iniseguro->caption(), $this->fecha_iniseguro->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha_iniseguro->FormValue)) {
			AddMessage($FormError, $this->fecha_iniseguro->errorMessage());
		}
		if ($this->fecha_finseguro->Required) {
			if (!$this->fecha_finseguro->IsDetailKey && $this->fecha_finseguro->FormValue != NULL && $this->fecha_finseguro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha_finseguro->caption(), $this->fecha_finseguro->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha_finseguro->FormValue)) {
			AddMessage($FormError, $this->fecha_finseguro->errorMessage());
		}
		if ($this->entidad->Required) {
			if (!$this->entidad->IsDetailKey && $this->entidad->FormValue != NULL && $this->entidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->entidad->caption(), $this->entidad->RequiredErrorMessage));
			}
		}
		if ($this->observacion->Required) {
			if (!$this->observacion->IsDetailKey && $this->observacion->FormValue != NULL && $this->observacion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->observacion->caption(), $this->observacion->RequiredErrorMessage));
			}
		}
		if ($this->asiganda->Required) {
			if (!$this->asiganda->IsDetailKey && $this->asiganda->FormValue != NULL && $this->asiganda->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->asiganda->caption(), $this->asiganda->RequiredErrorMessage));
			}
		}
		if ($this->config_manteni->Required) {
			if (!$this->config_manteni->IsDetailKey && $this->config_manteni->FormValue != NULL && $this->config_manteni->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->config_manteni->caption(), $this->config_manteni->RequiredErrorMessage));
			}
		}
		if ($this->fecha_creacion->Required) {
			if (!$this->fecha_creacion->IsDetailKey && $this->fecha_creacion->FormValue != NULL && $this->fecha_creacion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha_creacion->caption(), $this->fecha_creacion->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha_creacion->FormValue)) {
			AddMessage($FormError, $this->fecha_creacion->errorMessage());
		}
		if ($this->longitudambulancia->Required) {
			if (!$this->longitudambulancia->IsDetailKey && $this->longitudambulancia->FormValue != NULL && $this->longitudambulancia->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->longitudambulancia->caption(), $this->longitudambulancia->RequiredErrorMessage));
			}
		}
		if ($this->latituambulancia->Required) {
			if (!$this->latituambulancia->IsDetailKey && $this->latituambulancia->FormValue != NULL && $this->latituambulancia->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->latituambulancia->caption(), $this->latituambulancia->RequiredErrorMessage));
			}
		}
		if ($this->especial->Required) {
			if (!$this->especial->IsDetailKey && $this->especial->FormValue != NULL && $this->especial->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->especial->caption(), $this->especial->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->especial->FormValue)) {
			AddMessage($FormError, $this->especial->errorMessage());
		}
		if ($this->id_tipotransport->Required) {
			if (!$this->id_tipotransport->IsDetailKey && $this->id_tipotransport->FormValue != NULL && $this->id_tipotransport->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_tipotransport->caption(), $this->id_tipotransport->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_tipotransport->FormValue)) {
			AddMessage($FormError, $this->id_tipotransport->errorMessage());
		}
		if ($this->tipo_amb_es->Required) {
			if (!$this->tipo_amb_es->IsDetailKey && $this->tipo_amb_es->FormValue != NULL && $this->tipo_amb_es->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_amb_es->caption(), $this->tipo_amb_es->RequiredErrorMessage));
			}
		}
		if ($this->tipo_amb_en->Required) {
			if (!$this->tipo_amb_en->IsDetailKey && $this->tipo_amb_en->FormValue != NULL && $this->tipo_amb_en->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_amb_en->caption(), $this->tipo_amb_en->RequiredErrorMessage));
			}
		}
		if ($this->tipo_amb_pr->Required) {
			if (!$this->tipo_amb_pr->IsDetailKey && $this->tipo_amb_pr->FormValue != NULL && $this->tipo_amb_pr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_amb_pr->caption(), $this->tipo_amb_pr->RequiredErrorMessage));
			}
		}
		if ($this->tipo_amb_fr->Required) {
			if (!$this->tipo_amb_fr->IsDetailKey && $this->tipo_amb_fr->FormValue != NULL && $this->tipo_amb_fr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_amb_fr->caption(), $this->tipo_amb_fr->RequiredErrorMessage));
			}
		}
		if ($this->codigo->Required) {
			if (!$this->codigo->IsDetailKey && $this->codigo->FormValue != NULL && $this->codigo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->codigo->caption(), $this->codigo->RequiredErrorMessage));
			}
		}
		if ($this->id_especialambulancia->Required) {
			if (!$this->id_especialambulancia->IsDetailKey && $this->id_especialambulancia->FormValue != NULL && $this->id_especialambulancia->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_especialambulancia->caption(), $this->id_especialambulancia->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_especialambulancia->FormValue)) {
			AddMessage($FormError, $this->id_especialambulancia->errorMessage());
		}
		if ($this->especial_es->Required) {
			if (!$this->especial_es->IsDetailKey && $this->especial_es->FormValue != NULL && $this->especial_es->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->especial_es->caption(), $this->especial_es->RequiredErrorMessage));
			}
		}
		if ($this->especial_en->Required) {
			if (!$this->especial_en->IsDetailKey && $this->especial_en->FormValue != NULL && $this->especial_en->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->especial_en->caption(), $this->especial_en->RequiredErrorMessage));
			}
		}
		if ($this->especial_pr->Required) {
			if (!$this->especial_pr->IsDetailKey && $this->especial_pr->FormValue != NULL && $this->especial_pr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->especial_pr->caption(), $this->especial_pr->RequiredErrorMessage));
			}
		}
		if ($this->especial_fr->Required) {
			if (!$this->especial_fr->IsDetailKey && $this->especial_fr->FormValue != NULL && $this->especial_fr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->especial_fr->caption(), $this->especial_fr->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// id_ambulancias
		$this->id_ambulancias->setDbValueDef($rsnew, $this->id_ambulancias->CurrentValue, NULL, FALSE);

		// cod_ambulancias
		$this->cod_ambulancias->setDbValueDef($rsnew, $this->cod_ambulancias->CurrentValue, NULL, FALSE);

		// placas
		$this->placas->setDbValueDef($rsnew, $this->placas->CurrentValue, NULL, FALSE);

		// chasis
		$this->chasis->setDbValueDef($rsnew, $this->chasis->CurrentValue, NULL, FALSE);

		// marca
		$this->marca->setDbValueDef($rsnew, $this->marca->CurrentValue, NULL, FALSE);

		// modelo
		$this->modelo->setDbValueDef($rsnew, $this->modelo->CurrentValue, NULL, FALSE);

		// tipo_translado
		$this->tipo_translado->setDbValueDef($rsnew, $this->tipo_translado->CurrentValue, NULL, FALSE);

		// tipo_conbustible
		$this->tipo_conbustible->setDbValueDef($rsnew, $this->tipo_conbustible->CurrentValue, NULL, FALSE);

		// modalidad
		$this->modalidad->setDbValueDef($rsnew, $this->modalidad->CurrentValue, NULL, FALSE);

		// estado
		$this->estado->setDbValueDef($rsnew, $this->estado->CurrentValue, NULL, FALSE);

		// ubicacion
		$this->ubicacion->setDbValueDef($rsnew, $this->ubicacion->CurrentValue, NULL, FALSE);

		// disponible
		$this->disponible->setDbValueDef($rsnew, $this->disponible->CurrentValue, NULL, FALSE);

		// fecha_iniseguro
		$this->fecha_iniseguro->setDbValueDef($rsnew, UnFormatDateTime($this->fecha_iniseguro->CurrentValue, 0), NULL, FALSE);

		// fecha_finseguro
		$this->fecha_finseguro->setDbValueDef($rsnew, UnFormatDateTime($this->fecha_finseguro->CurrentValue, 0), NULL, FALSE);

		// entidad
		$this->entidad->setDbValueDef($rsnew, $this->entidad->CurrentValue, NULL, FALSE);

		// observacion
		$this->observacion->setDbValueDef($rsnew, $this->observacion->CurrentValue, NULL, FALSE);

		// asiganda
		$this->asiganda->setDbValueDef($rsnew, $this->asiganda->CurrentValue, NULL, FALSE);

		// config_manteni
		$this->config_manteni->setDbValueDef($rsnew, $this->config_manteni->CurrentValue, NULL, FALSE);

		// fecha_creacion
		$this->fecha_creacion->setDbValueDef($rsnew, UnFormatDateTime($this->fecha_creacion->CurrentValue, 0), NULL, FALSE);

		// longitudambulancia
		$this->longitudambulancia->setDbValueDef($rsnew, $this->longitudambulancia->CurrentValue, NULL, FALSE);

		// latituambulancia
		$this->latituambulancia->setDbValueDef($rsnew, $this->latituambulancia->CurrentValue, NULL, FALSE);

		// especial
		$this->especial->setDbValueDef($rsnew, $this->especial->CurrentValue, NULL, FALSE);

		// id_tipotransport
		$this->id_tipotransport->setDbValueDef($rsnew, $this->id_tipotransport->CurrentValue, NULL, FALSE);

		// tipo_amb_es
		$this->tipo_amb_es->setDbValueDef($rsnew, $this->tipo_amb_es->CurrentValue, NULL, FALSE);

		// tipo_amb_en
		$this->tipo_amb_en->setDbValueDef($rsnew, $this->tipo_amb_en->CurrentValue, NULL, FALSE);

		// tipo_amb_pr
		$this->tipo_amb_pr->setDbValueDef($rsnew, $this->tipo_amb_pr->CurrentValue, NULL, FALSE);

		// tipo_amb_fr
		$this->tipo_amb_fr->setDbValueDef($rsnew, $this->tipo_amb_fr->CurrentValue, NULL, FALSE);

		// codigo
		$this->codigo->setDbValueDef($rsnew, $this->codigo->CurrentValue, NULL, FALSE);

		// id_especialambulancia
		$this->id_especialambulancia->setDbValueDef($rsnew, $this->id_especialambulancia->CurrentValue, NULL, FALSE);

		// especial_es
		$this->especial_es->setDbValueDef($rsnew, $this->especial_es->CurrentValue, NULL, FALSE);

		// especial_en
		$this->especial_en->setDbValueDef($rsnew, $this->especial_en->CurrentValue, NULL, FALSE);

		// especial_pr
		$this->especial_pr->setDbValueDef($rsnew, $this->especial_pr->CurrentValue, NULL, FALSE);

		// especial_fr
		$this->especial_fr->setDbValueDef($rsnew, $this->especial_fr->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['id_ambulancias']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['cod_ambulancias']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("asigna_ambulancialist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
		$this->id_maestrointerh->EditValue = htmlspecialchars($_GET["id_maestrointerh"]);
		$this->cod_ambulancia->EditValue = htmlspecialchars($_GET["cod_ambulancia"]);
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

			$row = ExecuteScalar("SELECT cod_ambulancia FROM servicio_ambulancia WHERE id_maestrointerh = '".Get('cod_casointerh')."'"); //Consulta quien tiene servicio de ambulancia
			$cierre = ExecuteScalar("SELECT cierreinterh FROM interh_maestro WHERE cod_casointerh = '".Get('cod_casointerh')."'"); //Consulta quien tiene caso sin cerrar
		$cierre_caso = "";
		$paciente= "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"Paciente\" data-table=\"interh_seguimiento\" data-caption=\"<img src='images/icon/028-head.png' width='40' height='45'></br>Paciente\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'pacientegeneraledit.php?cod_pacienteinterh=".Get('cod_pacienteinterh')."&cod_casointerh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"Agregar Paciente\"><img src='images/icon/028-head.png' width='25' height='27'></a>";
		$evaluacion= "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"Evaluacion Clinica\" data-table=\"interh_seguimiento\" data-caption=\"<img src='images/icon/029-heart.png' width='40' height='45'></br>Evaluación Clinica\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'interh_evaluacionclinicaadd.php?showmaster=interh_maestro&cod_casointerh=".Get('cod_pacienteinterh')."&cod_pacienteinterh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"Agregar Seguimiento\"><img src='images/icon/029-heart.png' width='25' height='27'></a>";
		if ($row == ""){
		$ambulancia= "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"Ambulancia\" data-table=\"servicio_ambulancia\" data-caption=\"<img src='images/icon/001-ambulance.png' width='40' height='45'></br>Servicio de Ambulancia\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'asigna_ambulancialist.php?cod_pacienteinterh=".Get('cod_pacienteinterh')."&id_maestrointerh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"Servicio de Ambulancia\"><img src='images/icon/001-ambulance.png' width='25' height='27'></a>";
			if ($cierre=='0'){			
				$cierre_caso= "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"Cerrar Caso\" data-table=\"cerrar caso\" data-caption=\"<img src='images/icon/cancelar(1).png' width='40' height='45'></br>Cerrar Caso\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'interh_cierreadd.php?cod_pacienteinterh=".Get('cod_pacienteinterh')."&cod_casointerh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"Cerrar Caso\"><img src='images/icon/001-canceldoc.png' width='25' height='27'></a>";
			}else {
				$cierre_caso = "";
			} //if cierre  
		}else{
			$ambulancia = "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"Ambulancia\" data-table=\"servicio_ambulancia\" data-caption=\"<img src='images/icon/001-ambulance_red.png' width='40' height='45'></br>-Servicio de Ambulancia\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'servicio_ambulanciaedit.php?cod_pacienteinterh=".Get('cod_pacienteinterh')."&cod_ambulancia=".$row."&id_maestrointerh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"-Servicio de Ambulancia\"><img src='images/icon/001-ambulance_red.png' width='25' height='27'></a>";
		}
		$hospital ="<a class=\"btn btn-default ew-add-edit ew-add\" title=\" Hospital Destino\" data-table=\"servicio_ambulancia\" data-caption=\"<img src='images/icon/033-hospital.png' width='40' height='45'></br>Hospital de Destino\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'interh_maestroedit.php?cod_casointerh=".Get('cod_pacienteinterh')."&cod_pacienteinterh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"Servicio de Ambulancia\"><img src='images/icon/033-hospital.png' width='25' height='27'></a>";
		$notas ="<a class=\"btn btn-default ew-add-edit ew-add\" title=\"Notas\" data-table=\"servicio_ambulancia\" data-caption=\"<img src='images/icon/025-folder.png' width='40' height='45'></br>Notas\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'interh_seguimientoadd.php?cod_casointerh=".Get('cod_pacienteinterh')."&cod_pacienteinterh=".Get('cod_pacienteinterh')."'});\" data-original-title=\"Notas\"><img src='images/icon/025-folder.png' width='25' height='27'></a>";
		$header = $paciente.$evaluacion.$hospital.$notas.$cierre_caso;
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>
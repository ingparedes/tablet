<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class hospitalesgeneral_addopt extends hospitalesgeneral
{

	// Page ID
	public $PageID = "addopt";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'hospitalesgeneral';

	// Page object name
	public $PageObjName = "hospitalesgeneral_addopt";

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
		$hidden = FALSE;
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

		// Table object (hospitalesgeneral)
		if (!isset($GLOBALS["hospitalesgeneral"]) || get_class($GLOBALS["hospitalesgeneral"]) == PROJECT_NAMESPACE . "hospitalesgeneral") {
			$GLOBALS["hospitalesgeneral"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["hospitalesgeneral"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'addopt');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'hospitalesgeneral');

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

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $hospitalesgeneral;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($hospitalesgeneral);
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
			$key .= @$ar['id_hospital'];
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

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
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
					$this->terminate(GetUrl("hospitalesgenerallist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_hospital->setVisibility();
		$this->nombre_hospital->setVisibility();
		$this->depto_hospital->setVisibility();
		$this->provincia_hospital->setVisibility();
		$this->municipio_hospital->setVisibility();
		$this->nivel_hospital->setVisibility();
		$this->redservicions_hospital->setVisibility();
		$this->sector_hospital->setVisibility();
		$this->tipo_hospital->setVisibility();
		$this->camashab_cali->setVisibility();
		$this->especialidad->setVisibility();
		$this->latitud_hospital->setVisibility();
		$this->longitud_hospital->setVisibility();
		$this->icon_hospital->setVisibility();
		$this->codpolitico->setVisibility();
		$this->direccion->setVisibility();
		$this->telefono->setVisibility();
		$this->nombre_responsable->setVisibility();
		$this->estado->setVisibility();
		$this->emt->setVisibility();
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
		$this->setupLookupOptions($this->depto_hospital);
		$this->setupLookupOptions($this->provincia_hospital);
		$this->setupLookupOptions($this->municipio_hospital);
		$this->setupLookupOptions($this->especialidad);
		set_error_handler(PROJECT_NAMESPACE . "ErrorHandler");

		// Set up Breadcrumb
		//$this->setupBreadcrumb(); // Not used

		$this->loadRowValues(); // Load default values

		// Render row
		$this->RowType = ROWTYPE_ADD; // Render add type
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->icon_hospital->Upload->Index = $CurrentForm->Index;
		$this->icon_hospital->Upload->uploadFile();
		$this->icon_hospital->CurrentValue = $this->icon_hospital->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_hospital->CurrentValue = NULL;
		$this->id_hospital->OldValue = $this->id_hospital->CurrentValue;
		$this->nombre_hospital->CurrentValue = NULL;
		$this->nombre_hospital->OldValue = $this->nombre_hospital->CurrentValue;
		$this->depto_hospital->CurrentValue = NULL;
		$this->depto_hospital->OldValue = $this->depto_hospital->CurrentValue;
		$this->provincia_hospital->CurrentValue = NULL;
		$this->provincia_hospital->OldValue = $this->provincia_hospital->CurrentValue;
		$this->municipio_hospital->CurrentValue = NULL;
		$this->municipio_hospital->OldValue = $this->municipio_hospital->CurrentValue;
		$this->nivel_hospital->CurrentValue = NULL;
		$this->nivel_hospital->OldValue = $this->nivel_hospital->CurrentValue;
		$this->redservicions_hospital->CurrentValue = NULL;
		$this->redservicions_hospital->OldValue = $this->redservicions_hospital->CurrentValue;
		$this->sector_hospital->CurrentValue = NULL;
		$this->sector_hospital->OldValue = $this->sector_hospital->CurrentValue;
		$this->tipo_hospital->CurrentValue = NULL;
		$this->tipo_hospital->OldValue = $this->tipo_hospital->CurrentValue;
		$this->camashab_cali->CurrentValue = NULL;
		$this->camashab_cali->OldValue = $this->camashab_cali->CurrentValue;
		$this->especialidad->CurrentValue = NULL;
		$this->especialidad->OldValue = $this->especialidad->CurrentValue;
		$this->latitud_hospital->CurrentValue = NULL;
		$this->latitud_hospital->OldValue = $this->latitud_hospital->CurrentValue;
		$this->longitud_hospital->CurrentValue = NULL;
		$this->longitud_hospital->OldValue = $this->longitud_hospital->CurrentValue;
		$this->icon_hospital->Upload->DbValue = NULL;
		$this->icon_hospital->OldValue = $this->icon_hospital->Upload->DbValue;
		$this->icon_hospital->CurrentValue = NULL; // Clear file related field
		$this->codpolitico->CurrentValue = NULL;
		$this->codpolitico->OldValue = $this->codpolitico->CurrentValue;
		$this->direccion->CurrentValue = NULL;
		$this->direccion->OldValue = $this->direccion->CurrentValue;
		$this->telefono->CurrentValue = NULL;
		$this->telefono->OldValue = $this->telefono->CurrentValue;
		$this->nombre_responsable->CurrentValue = NULL;
		$this->nombre_responsable->OldValue = $this->nombre_responsable->CurrentValue;
		$this->estado->CurrentValue = false;
		$this->emt->CurrentValue = false;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'id_hospital' first before field var 'x_id_hospital'
		$val = $CurrentForm->hasValue("id_hospital") ? $CurrentForm->getValue("id_hospital") : $CurrentForm->getValue("x_id_hospital");
		if (!$this->id_hospital->IsDetailKey) {
			$this->id_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'nombre_hospital' first before field var 'x_nombre_hospital'
		$val = $CurrentForm->hasValue("nombre_hospital") ? $CurrentForm->getValue("nombre_hospital") : $CurrentForm->getValue("x_nombre_hospital");
		if (!$this->nombre_hospital->IsDetailKey) {
			$this->nombre_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'depto_hospital' first before field var 'x_depto_hospital'
		$val = $CurrentForm->hasValue("depto_hospital") ? $CurrentForm->getValue("depto_hospital") : $CurrentForm->getValue("x_depto_hospital");
		if (!$this->depto_hospital->IsDetailKey) {
			$this->depto_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'provincia_hospital' first before field var 'x_provincia_hospital'
		$val = $CurrentForm->hasValue("provincia_hospital") ? $CurrentForm->getValue("provincia_hospital") : $CurrentForm->getValue("x_provincia_hospital");
		if (!$this->provincia_hospital->IsDetailKey) {
			$this->provincia_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'municipio_hospital' first before field var 'x_municipio_hospital'
		$val = $CurrentForm->hasValue("municipio_hospital") ? $CurrentForm->getValue("municipio_hospital") : $CurrentForm->getValue("x_municipio_hospital");
		if (!$this->municipio_hospital->IsDetailKey) {
			$this->municipio_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'nivel_hospital' first before field var 'x_nivel_hospital'
		$val = $CurrentForm->hasValue("nivel_hospital") ? $CurrentForm->getValue("nivel_hospital") : $CurrentForm->getValue("x_nivel_hospital");
		if (!$this->nivel_hospital->IsDetailKey) {
			$this->nivel_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'redservicions_hospital' first before field var 'x_redservicions_hospital'
		$val = $CurrentForm->hasValue("redservicions_hospital") ? $CurrentForm->getValue("redservicions_hospital") : $CurrentForm->getValue("x_redservicions_hospital");
		if (!$this->redservicions_hospital->IsDetailKey) {
			$this->redservicions_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'sector_hospital' first before field var 'x_sector_hospital'
		$val = $CurrentForm->hasValue("sector_hospital") ? $CurrentForm->getValue("sector_hospital") : $CurrentForm->getValue("x_sector_hospital");
		if (!$this->sector_hospital->IsDetailKey) {
			$this->sector_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'tipo_hospital' first before field var 'x_tipo_hospital'
		$val = $CurrentForm->hasValue("tipo_hospital") ? $CurrentForm->getValue("tipo_hospital") : $CurrentForm->getValue("x_tipo_hospital");
		if (!$this->tipo_hospital->IsDetailKey) {
			$this->tipo_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'camashab_cali' first before field var 'x_camashab_cali'
		$val = $CurrentForm->hasValue("camashab_cali") ? $CurrentForm->getValue("camashab_cali") : $CurrentForm->getValue("x_camashab_cali");
		if (!$this->camashab_cali->IsDetailKey) {
			$this->camashab_cali->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'especialidad' first before field var 'x_especialidad'
		$val = $CurrentForm->hasValue("especialidad") ? $CurrentForm->getValue("especialidad") : $CurrentForm->getValue("x_especialidad");
		if (!$this->especialidad->IsDetailKey) {
			$this->especialidad->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'latitud_hospital' first before field var 'x_latitud_hospital'
		$val = $CurrentForm->hasValue("latitud_hospital") ? $CurrentForm->getValue("latitud_hospital") : $CurrentForm->getValue("x_latitud_hospital");
		if (!$this->latitud_hospital->IsDetailKey) {
			$this->latitud_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'longitud_hospital' first before field var 'x_longitud_hospital'
		$val = $CurrentForm->hasValue("longitud_hospital") ? $CurrentForm->getValue("longitud_hospital") : $CurrentForm->getValue("x_longitud_hospital");
		if (!$this->longitud_hospital->IsDetailKey) {
			$this->longitud_hospital->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'codpolitico' first before field var 'x_codpolitico'
		$val = $CurrentForm->hasValue("codpolitico") ? $CurrentForm->getValue("codpolitico") : $CurrentForm->getValue("x_codpolitico");
		if (!$this->codpolitico->IsDetailKey) {
			$this->codpolitico->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'direccion' first before field var 'x_direccion'
		$val = $CurrentForm->hasValue("direccion") ? $CurrentForm->getValue("direccion") : $CurrentForm->getValue("x_direccion");
		if (!$this->direccion->IsDetailKey) {
			$this->direccion->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'telefono' first before field var 'x_telefono'
		$val = $CurrentForm->hasValue("telefono") ? $CurrentForm->getValue("telefono") : $CurrentForm->getValue("x_telefono");
		if (!$this->telefono->IsDetailKey) {
			$this->telefono->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'nombre_responsable' first before field var 'x_nombre_responsable'
		$val = $CurrentForm->hasValue("nombre_responsable") ? $CurrentForm->getValue("nombre_responsable") : $CurrentForm->getValue("x_nombre_responsable");
		if (!$this->nombre_responsable->IsDetailKey) {
			$this->nombre_responsable->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'estado' first before field var 'x_estado'
		$val = $CurrentForm->hasValue("estado") ? $CurrentForm->getValue("estado") : $CurrentForm->getValue("x_estado");
		if (!$this->estado->IsDetailKey) {
			$this->estado->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'emt' first before field var 'x_emt'
		$val = $CurrentForm->hasValue("emt") ? $CurrentForm->getValue("emt") : $CurrentForm->getValue("x_emt");
		if (!$this->emt->IsDetailKey) {
			$this->emt->setFormValue(ConvertFromUtf8($val));
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_hospital->CurrentValue = ConvertToUtf8($this->id_hospital->FormValue);
		$this->nombre_hospital->CurrentValue = ConvertToUtf8($this->nombre_hospital->FormValue);
		$this->depto_hospital->CurrentValue = ConvertToUtf8($this->depto_hospital->FormValue);
		$this->provincia_hospital->CurrentValue = ConvertToUtf8($this->provincia_hospital->FormValue);
		$this->municipio_hospital->CurrentValue = ConvertToUtf8($this->municipio_hospital->FormValue);
		$this->nivel_hospital->CurrentValue = ConvertToUtf8($this->nivel_hospital->FormValue);
		$this->redservicions_hospital->CurrentValue = ConvertToUtf8($this->redservicions_hospital->FormValue);
		$this->sector_hospital->CurrentValue = ConvertToUtf8($this->sector_hospital->FormValue);
		$this->tipo_hospital->CurrentValue = ConvertToUtf8($this->tipo_hospital->FormValue);
		$this->camashab_cali->CurrentValue = ConvertToUtf8($this->camashab_cali->FormValue);
		$this->especialidad->CurrentValue = ConvertToUtf8($this->especialidad->FormValue);
		$this->latitud_hospital->CurrentValue = ConvertToUtf8($this->latitud_hospital->FormValue);
		$this->longitud_hospital->CurrentValue = ConvertToUtf8($this->longitud_hospital->FormValue);
		$this->codpolitico->CurrentValue = ConvertToUtf8($this->codpolitico->FormValue);
		$this->direccion->CurrentValue = ConvertToUtf8($this->direccion->FormValue);
		$this->telefono->CurrentValue = ConvertToUtf8($this->telefono->FormValue);
		$this->nombre_responsable->CurrentValue = ConvertToUtf8($this->nombre_responsable->FormValue);
		$this->estado->CurrentValue = ConvertToUtf8($this->estado->FormValue);
		$this->emt->CurrentValue = ConvertToUtf8($this->emt->FormValue);
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
		$this->id_hospital->setDbValue($row['id_hospital']);
		$this->nombre_hospital->setDbValue($row['nombre_hospital']);
		$this->depto_hospital->setDbValue($row['depto_hospital']);
		$this->provincia_hospital->setDbValue($row['provincia_hospital']);
		$this->municipio_hospital->setDbValue($row['municipio_hospital']);
		$this->nivel_hospital->setDbValue($row['nivel_hospital']);
		$this->redservicions_hospital->setDbValue($row['redservicions_hospital']);
		$this->sector_hospital->setDbValue($row['sector_hospital']);
		$this->tipo_hospital->setDbValue($row['tipo_hospital']);
		$this->camashab_cali->setDbValue($row['camashab_cali']);
		$this->especialidad->setDbValue($row['especialidad']);
		$this->latitud_hospital->setDbValue($row['latitud_hospital']);
		$this->longitud_hospital->setDbValue($row['longitud_hospital']);
		$this->icon_hospital->Upload->DbValue = $row['icon_hospital'];
		$this->icon_hospital->setDbValue($this->icon_hospital->Upload->DbValue);
		$this->codpolitico->setDbValue($row['codpolitico']);
		$this->direccion->setDbValue($row['direccion']);
		$this->telefono->setDbValue($row['telefono']);
		$this->nombre_responsable->setDbValue($row['nombre_responsable']);
		$this->estado->setDbValue((ConvertToBool($row['estado']) ? "1" : "0"));
		$this->emt->setDbValue((ConvertToBool($row['emt']) ? "1" : "0"));
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_hospital'] = $this->id_hospital->CurrentValue;
		$row['nombre_hospital'] = $this->nombre_hospital->CurrentValue;
		$row['depto_hospital'] = $this->depto_hospital->CurrentValue;
		$row['provincia_hospital'] = $this->provincia_hospital->CurrentValue;
		$row['municipio_hospital'] = $this->municipio_hospital->CurrentValue;
		$row['nivel_hospital'] = $this->nivel_hospital->CurrentValue;
		$row['redservicions_hospital'] = $this->redservicions_hospital->CurrentValue;
		$row['sector_hospital'] = $this->sector_hospital->CurrentValue;
		$row['tipo_hospital'] = $this->tipo_hospital->CurrentValue;
		$row['camashab_cali'] = $this->camashab_cali->CurrentValue;
		$row['especialidad'] = $this->especialidad->CurrentValue;
		$row['latitud_hospital'] = $this->latitud_hospital->CurrentValue;
		$row['longitud_hospital'] = $this->longitud_hospital->CurrentValue;
		$row['icon_hospital'] = $this->icon_hospital->Upload->DbValue;
		$row['codpolitico'] = $this->codpolitico->CurrentValue;
		$row['direccion'] = $this->direccion->CurrentValue;
		$row['telefono'] = $this->telefono->CurrentValue;
		$row['nombre_responsable'] = $this->nombre_responsable->CurrentValue;
		$row['estado'] = $this->estado->CurrentValue;
		$row['emt'] = $this->emt->CurrentValue;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id_hospital
		// nombre_hospital
		// depto_hospital
		// provincia_hospital
		// municipio_hospital
		// nivel_hospital
		// redservicions_hospital
		// sector_hospital
		// tipo_hospital
		// camashab_cali
		// especialidad
		// latitud_hospital
		// longitud_hospital
		// icon_hospital
		// codpolitico
		// direccion
		// telefono
		// nombre_responsable
		// estado
		// emt

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_hospital
			$this->id_hospital->ViewValue = $this->id_hospital->CurrentValue;
			$this->id_hospital->ViewCustomAttributes = "";

			// nombre_hospital
			$this->nombre_hospital->ViewValue = $this->nombre_hospital->CurrentValue;
			$this->nombre_hospital->ViewCustomAttributes = "";

			// depto_hospital
			$curVal = strval($this->depto_hospital->CurrentValue);
			if ($curVal != "") {
				$this->depto_hospital->ViewValue = $this->depto_hospital->lookupCacheOption($curVal);
				if ($this->depto_hospital->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"cod_dpto\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->depto_hospital->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->depto_hospital->ViewValue = $this->depto_hospital->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->depto_hospital->ViewValue = $this->depto_hospital->CurrentValue;
					}
				}
			} else {
				$this->depto_hospital->ViewValue = NULL;
			}
			$this->depto_hospital->ViewCustomAttributes = "";

			// provincia_hospital
			$curVal = strval($this->provincia_hospital->CurrentValue);
			if ($curVal != "") {
				$this->provincia_hospital->ViewValue = $this->provincia_hospital->lookupCacheOption($curVal);
				if ($this->provincia_hospital->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"cod_provincia\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->provincia_hospital->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->provincia_hospital->ViewValue = $this->provincia_hospital->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->provincia_hospital->ViewValue = $this->provincia_hospital->CurrentValue;
					}
				}
			} else {
				$this->provincia_hospital->ViewValue = NULL;
			}
			$this->provincia_hospital->ViewCustomAttributes = "";

			// municipio_hospital
			$curVal = strval($this->municipio_hospital->CurrentValue);
			if ($curVal != "") {
				$this->municipio_hospital->ViewValue = $this->municipio_hospital->lookupCacheOption($curVal);
				if ($this->municipio_hospital->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"cod_distrito\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->municipio_hospital->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->municipio_hospital->ViewValue = $this->municipio_hospital->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->municipio_hospital->ViewValue = $this->municipio_hospital->CurrentValue;
					}
				}
			} else {
				$this->municipio_hospital->ViewValue = NULL;
			}
			$this->municipio_hospital->ViewCustomAttributes = "";

			// nivel_hospital
			$this->nivel_hospital->ViewValue = $this->nivel_hospital->CurrentValue;
			$this->nivel_hospital->ViewCustomAttributes = "";

			// redservicions_hospital
			$this->redservicions_hospital->ViewValue = $this->redservicions_hospital->CurrentValue;
			$this->redservicions_hospital->ViewCustomAttributes = "";

			// sector_hospital
			$this->sector_hospital->ViewValue = $this->sector_hospital->CurrentValue;
			$this->sector_hospital->ViewCustomAttributes = "";

			// tipo_hospital
			$this->tipo_hospital->ViewValue = $this->tipo_hospital->CurrentValue;
			$this->tipo_hospital->ViewCustomAttributes = "";

			// camashab_cali
			$this->camashab_cali->ViewValue = $this->camashab_cali->CurrentValue;
			$this->camashab_cali->ViewCustomAttributes = "";

			// especialidad
			$curVal = strval($this->especialidad->CurrentValue);
			if ($curVal != "") {
				$this->especialidad->ViewValue = $this->especialidad->lookupCacheOption($curVal);
				if ($this->especialidad->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"id_especialidad\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->especialidad->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->especialidad->ViewValue = $this->especialidad->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->especialidad->ViewValue = $this->especialidad->CurrentValue;
					}
				}
			} else {
				$this->especialidad->ViewValue = NULL;
			}
			$this->especialidad->ViewCustomAttributes = "";

			// latitud_hospital
			$this->latitud_hospital->ViewValue = $this->latitud_hospital->CurrentValue;
			$this->latitud_hospital->ViewCustomAttributes = "";

			// longitud_hospital
			$this->longitud_hospital->ViewValue = $this->longitud_hospital->CurrentValue;
			$this->longitud_hospital->ViewCustomAttributes = "";

			// icon_hospital
			if (!EmptyValue($this->icon_hospital->Upload->DbValue)) {
				$this->icon_hospital->ViewValue = $this->icon_hospital->Upload->DbValue;
			} else {
				$this->icon_hospital->ViewValue = "";
			}
			$this->icon_hospital->ViewCustomAttributes = "";

			// codpolitico
			$this->codpolitico->ViewValue = $this->codpolitico->CurrentValue;
			$this->codpolitico->ViewCustomAttributes = "";

			// direccion
			$this->direccion->ViewValue = $this->direccion->CurrentValue;
			$this->direccion->ViewCustomAttributes = "";

			// telefono
			$this->telefono->ViewValue = $this->telefono->CurrentValue;
			$this->telefono->ViewCustomAttributes = "";

			// nombre_responsable
			$this->nombre_responsable->ViewValue = $this->nombre_responsable->CurrentValue;
			$this->nombre_responsable->ViewCustomAttributes = "";

			// estado
			if (ConvertToBool($this->estado->CurrentValue)) {
				$this->estado->ViewValue = $this->estado->tagCaption(1) != "" ? $this->estado->tagCaption(1) : "Yes";
			} else {
				$this->estado->ViewValue = $this->estado->tagCaption(2) != "" ? $this->estado->tagCaption(2) : "No";
			}
			$this->estado->ViewCustomAttributes = "";

			// emt
			if (ConvertToBool($this->emt->CurrentValue)) {
				$this->emt->ViewValue = $this->emt->tagCaption(1) != "" ? $this->emt->tagCaption(1) : "Yes";
			} else {
				$this->emt->ViewValue = $this->emt->tagCaption(2) != "" ? $this->emt->tagCaption(2) : "No";
			}
			$this->emt->ViewCustomAttributes = "";

			// id_hospital
			$this->id_hospital->LinkCustomAttributes = "";
			$this->id_hospital->HrefValue = "";
			$this->id_hospital->TooltipValue = "";

			// nombre_hospital
			$this->nombre_hospital->LinkCustomAttributes = "";
			$this->nombre_hospital->HrefValue = "";
			$this->nombre_hospital->TooltipValue = "";

			// depto_hospital
			$this->depto_hospital->LinkCustomAttributes = "";
			$this->depto_hospital->HrefValue = "";
			$this->depto_hospital->TooltipValue = "";

			// provincia_hospital
			$this->provincia_hospital->LinkCustomAttributes = "";
			$this->provincia_hospital->HrefValue = "";
			$this->provincia_hospital->TooltipValue = "";

			// municipio_hospital
			$this->municipio_hospital->LinkCustomAttributes = "";
			$this->municipio_hospital->HrefValue = "";
			$this->municipio_hospital->TooltipValue = "";

			// nivel_hospital
			$this->nivel_hospital->LinkCustomAttributes = "";
			$this->nivel_hospital->HrefValue = "";
			$this->nivel_hospital->TooltipValue = "";

			// redservicions_hospital
			$this->redservicions_hospital->LinkCustomAttributes = "";
			$this->redservicions_hospital->HrefValue = "";
			$this->redservicions_hospital->TooltipValue = "";

			// sector_hospital
			$this->sector_hospital->LinkCustomAttributes = "";
			$this->sector_hospital->HrefValue = "";
			$this->sector_hospital->TooltipValue = "";

			// tipo_hospital
			$this->tipo_hospital->LinkCustomAttributes = "";
			$this->tipo_hospital->HrefValue = "";
			$this->tipo_hospital->TooltipValue = "";

			// camashab_cali
			$this->camashab_cali->LinkCustomAttributes = "";
			$this->camashab_cali->HrefValue = "";
			$this->camashab_cali->TooltipValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";
			$this->especialidad->TooltipValue = "";

			// latitud_hospital
			$this->latitud_hospital->LinkCustomAttributes = "";
			$this->latitud_hospital->HrefValue = "";
			$this->latitud_hospital->TooltipValue = "";

			// longitud_hospital
			$this->longitud_hospital->LinkCustomAttributes = "";
			$this->longitud_hospital->HrefValue = "";
			$this->longitud_hospital->TooltipValue = "";

			// icon_hospital
			$this->icon_hospital->LinkCustomAttributes = "";
			$this->icon_hospital->HrefValue = "";
			$this->icon_hospital->ExportHrefValue = $this->icon_hospital->UploadPath . $this->icon_hospital->Upload->DbValue;
			$this->icon_hospital->TooltipValue = "";

			// codpolitico
			$this->codpolitico->LinkCustomAttributes = "";
			$this->codpolitico->HrefValue = "";
			$this->codpolitico->TooltipValue = "";

			// direccion
			$this->direccion->LinkCustomAttributes = "";
			$this->direccion->HrefValue = "";
			$this->direccion->TooltipValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";
			$this->telefono->TooltipValue = "";

			// nombre_responsable
			$this->nombre_responsable->LinkCustomAttributes = "";
			$this->nombre_responsable->HrefValue = "";
			$this->nombre_responsable->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// emt
			$this->emt->LinkCustomAttributes = "";
			$this->emt->HrefValue = "";
			$this->emt->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_hospital
			$this->id_hospital->EditAttrs["class"] = "form-control";
			$this->id_hospital->EditCustomAttributes = "";
			if (!$this->id_hospital->Raw)
				$this->id_hospital->CurrentValue = HtmlDecode($this->id_hospital->CurrentValue);
			$this->id_hospital->EditValue = HtmlEncode($this->id_hospital->CurrentValue);
			$this->id_hospital->PlaceHolder = RemoveHtml($this->id_hospital->caption());

			// nombre_hospital
			$this->nombre_hospital->EditAttrs["class"] = "form-control";
			$this->nombre_hospital->EditCustomAttributes = "";
			if (!$this->nombre_hospital->Raw)
				$this->nombre_hospital->CurrentValue = HtmlDecode($this->nombre_hospital->CurrentValue);
			$this->nombre_hospital->EditValue = HtmlEncode($this->nombre_hospital->CurrentValue);
			$this->nombre_hospital->PlaceHolder = RemoveHtml($this->nombre_hospital->caption());

			// depto_hospital
			$this->depto_hospital->EditAttrs["class"] = "form-control";
			$this->depto_hospital->EditCustomAttributes = "";
			$curVal = trim(strval($this->depto_hospital->CurrentValue));
			if ($curVal != "")
				$this->depto_hospital->ViewValue = $this->depto_hospital->lookupCacheOption($curVal);
			else
				$this->depto_hospital->ViewValue = $this->depto_hospital->Lookup !== NULL && is_array($this->depto_hospital->Lookup->Options) ? $curVal : NULL;
			if ($this->depto_hospital->ViewValue !== NULL) { // Load from cache
				$this->depto_hospital->EditValue = array_values($this->depto_hospital->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"cod_dpto\"" . SearchString("=", $this->depto_hospital->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->depto_hospital->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->depto_hospital->EditValue = $arwrk;
			}

			// provincia_hospital
			$this->provincia_hospital->EditAttrs["class"] = "form-control";
			$this->provincia_hospital->EditCustomAttributes = "";
			$curVal = trim(strval($this->provincia_hospital->CurrentValue));
			if ($curVal != "")
				$this->provincia_hospital->ViewValue = $this->provincia_hospital->lookupCacheOption($curVal);
			else
				$this->provincia_hospital->ViewValue = $this->provincia_hospital->Lookup !== NULL && is_array($this->provincia_hospital->Lookup->Options) ? $curVal : NULL;
			if ($this->provincia_hospital->ViewValue !== NULL) { // Load from cache
				$this->provincia_hospital->EditValue = array_values($this->provincia_hospital->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"cod_provincia\"" . SearchString("=", $this->provincia_hospital->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->provincia_hospital->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->provincia_hospital->EditValue = $arwrk;
			}

			// municipio_hospital
			$this->municipio_hospital->EditAttrs["class"] = "form-control";
			$this->municipio_hospital->EditCustomAttributes = "";
			$curVal = trim(strval($this->municipio_hospital->CurrentValue));
			if ($curVal != "")
				$this->municipio_hospital->ViewValue = $this->municipio_hospital->lookupCacheOption($curVal);
			else
				$this->municipio_hospital->ViewValue = $this->municipio_hospital->Lookup !== NULL && is_array($this->municipio_hospital->Lookup->Options) ? $curVal : NULL;
			if ($this->municipio_hospital->ViewValue !== NULL) { // Load from cache
				$this->municipio_hospital->EditValue = array_values($this->municipio_hospital->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"cod_distrito\"" . SearchString("=", $this->municipio_hospital->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->municipio_hospital->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->municipio_hospital->EditValue = $arwrk;
			}

			// nivel_hospital
			$this->nivel_hospital->EditAttrs["class"] = "form-control";
			$this->nivel_hospital->EditCustomAttributes = "";
			if (!$this->nivel_hospital->Raw)
				$this->nivel_hospital->CurrentValue = HtmlDecode($this->nivel_hospital->CurrentValue);
			$this->nivel_hospital->EditValue = HtmlEncode($this->nivel_hospital->CurrentValue);
			$this->nivel_hospital->PlaceHolder = RemoveHtml($this->nivel_hospital->caption());

			// redservicions_hospital
			$this->redservicions_hospital->EditAttrs["class"] = "form-control";
			$this->redservicions_hospital->EditCustomAttributes = "";
			if (!$this->redservicions_hospital->Raw)
				$this->redservicions_hospital->CurrentValue = HtmlDecode($this->redservicions_hospital->CurrentValue);
			$this->redservicions_hospital->EditValue = HtmlEncode($this->redservicions_hospital->CurrentValue);
			$this->redservicions_hospital->PlaceHolder = RemoveHtml($this->redservicions_hospital->caption());

			// sector_hospital
			$this->sector_hospital->EditAttrs["class"] = "form-control";
			$this->sector_hospital->EditCustomAttributes = "";
			if (!$this->sector_hospital->Raw)
				$this->sector_hospital->CurrentValue = HtmlDecode($this->sector_hospital->CurrentValue);
			$this->sector_hospital->EditValue = HtmlEncode($this->sector_hospital->CurrentValue);
			$this->sector_hospital->PlaceHolder = RemoveHtml($this->sector_hospital->caption());

			// tipo_hospital
			$this->tipo_hospital->EditAttrs["class"] = "form-control";
			$this->tipo_hospital->EditCustomAttributes = "";
			if (!$this->tipo_hospital->Raw)
				$this->tipo_hospital->CurrentValue = HtmlDecode($this->tipo_hospital->CurrentValue);
			$this->tipo_hospital->EditValue = HtmlEncode($this->tipo_hospital->CurrentValue);
			$this->tipo_hospital->PlaceHolder = RemoveHtml($this->tipo_hospital->caption());

			// camashab_cali
			$this->camashab_cali->EditAttrs["class"] = "form-control";
			$this->camashab_cali->EditCustomAttributes = "";
			if (!$this->camashab_cali->Raw)
				$this->camashab_cali->CurrentValue = HtmlDecode($this->camashab_cali->CurrentValue);
			$this->camashab_cali->EditValue = HtmlEncode($this->camashab_cali->CurrentValue);
			$this->camashab_cali->PlaceHolder = RemoveHtml($this->camashab_cali->caption());

			// especialidad
			$this->especialidad->EditAttrs["class"] = "form-control";
			$this->especialidad->EditCustomAttributes = "";
			$curVal = trim(strval($this->especialidad->CurrentValue));
			if ($curVal != "")
				$this->especialidad->ViewValue = $this->especialidad->lookupCacheOption($curVal);
			else
				$this->especialidad->ViewValue = $this->especialidad->Lookup !== NULL && is_array($this->especialidad->Lookup->Options) ? $curVal : NULL;
			if ($this->especialidad->ViewValue !== NULL) { // Load from cache
				$this->especialidad->EditValue = array_values($this->especialidad->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"id_especialidad\"" . SearchString("=", $this->especialidad->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->especialidad->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->especialidad->EditValue = $arwrk;
			}

			// latitud_hospital
			$this->latitud_hospital->EditAttrs["class"] = "form-control";
			$this->latitud_hospital->EditCustomAttributes = "";
			if (!$this->latitud_hospital->Raw)
				$this->latitud_hospital->CurrentValue = HtmlDecode($this->latitud_hospital->CurrentValue);
			$this->latitud_hospital->EditValue = HtmlEncode($this->latitud_hospital->CurrentValue);
			$this->latitud_hospital->PlaceHolder = RemoveHtml($this->latitud_hospital->caption());

			// longitud_hospital
			$this->longitud_hospital->EditAttrs["class"] = "form-control";
			$this->longitud_hospital->EditCustomAttributes = "";
			if (!$this->longitud_hospital->Raw)
				$this->longitud_hospital->CurrentValue = HtmlDecode($this->longitud_hospital->CurrentValue);
			$this->longitud_hospital->EditValue = HtmlEncode($this->longitud_hospital->CurrentValue);
			$this->longitud_hospital->PlaceHolder = RemoveHtml($this->longitud_hospital->caption());

			// icon_hospital
			$this->icon_hospital->EditAttrs["class"] = "form-control";
			$this->icon_hospital->EditCustomAttributes = "";
			if (!EmptyValue($this->icon_hospital->Upload->DbValue)) {
				$this->icon_hospital->EditValue = $this->icon_hospital->Upload->DbValue;
			} else {
				$this->icon_hospital->EditValue = "";
			}
			if (!EmptyValue($this->icon_hospital->CurrentValue))
					$this->icon_hospital->Upload->FileName = $this->icon_hospital->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->icon_hospital);

			// codpolitico
			$this->codpolitico->EditAttrs["class"] = "form-control";
			$this->codpolitico->EditCustomAttributes = "";
			if (!$this->codpolitico->Raw)
				$this->codpolitico->CurrentValue = HtmlDecode($this->codpolitico->CurrentValue);
			$this->codpolitico->EditValue = HtmlEncode($this->codpolitico->CurrentValue);
			$this->codpolitico->PlaceHolder = RemoveHtml($this->codpolitico->caption());

			// direccion
			$this->direccion->EditAttrs["class"] = "form-control";
			$this->direccion->EditCustomAttributes = "";
			$this->direccion->EditValue = HtmlEncode($this->direccion->CurrentValue);
			$this->direccion->PlaceHolder = RemoveHtml($this->direccion->caption());

			// telefono
			$this->telefono->EditAttrs["class"] = "form-control";
			$this->telefono->EditCustomAttributes = "";
			if (!$this->telefono->Raw)
				$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
			$this->telefono->EditValue = HtmlEncode($this->telefono->CurrentValue);
			$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

			// nombre_responsable
			$this->nombre_responsable->EditAttrs["class"] = "form-control";
			$this->nombre_responsable->EditCustomAttributes = "";
			if (!$this->nombre_responsable->Raw)
				$this->nombre_responsable->CurrentValue = HtmlDecode($this->nombre_responsable->CurrentValue);
			$this->nombre_responsable->EditValue = HtmlEncode($this->nombre_responsable->CurrentValue);
			$this->nombre_responsable->PlaceHolder = RemoveHtml($this->nombre_responsable->caption());

			// estado
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = $this->estado->options(FALSE);

			// emt
			$this->emt->EditCustomAttributes = "";
			$this->emt->EditValue = $this->emt->options(FALSE);

			// Add refer script
			// id_hospital

			$this->id_hospital->LinkCustomAttributes = "";
			$this->id_hospital->HrefValue = "";

			// nombre_hospital
			$this->nombre_hospital->LinkCustomAttributes = "";
			$this->nombre_hospital->HrefValue = "";

			// depto_hospital
			$this->depto_hospital->LinkCustomAttributes = "";
			$this->depto_hospital->HrefValue = "";

			// provincia_hospital
			$this->provincia_hospital->LinkCustomAttributes = "";
			$this->provincia_hospital->HrefValue = "";

			// municipio_hospital
			$this->municipio_hospital->LinkCustomAttributes = "";
			$this->municipio_hospital->HrefValue = "";

			// nivel_hospital
			$this->nivel_hospital->LinkCustomAttributes = "";
			$this->nivel_hospital->HrefValue = "";

			// redservicions_hospital
			$this->redservicions_hospital->LinkCustomAttributes = "";
			$this->redservicions_hospital->HrefValue = "";

			// sector_hospital
			$this->sector_hospital->LinkCustomAttributes = "";
			$this->sector_hospital->HrefValue = "";

			// tipo_hospital
			$this->tipo_hospital->LinkCustomAttributes = "";
			$this->tipo_hospital->HrefValue = "";

			// camashab_cali
			$this->camashab_cali->LinkCustomAttributes = "";
			$this->camashab_cali->HrefValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";

			// latitud_hospital
			$this->latitud_hospital->LinkCustomAttributes = "";
			$this->latitud_hospital->HrefValue = "";

			// longitud_hospital
			$this->longitud_hospital->LinkCustomAttributes = "";
			$this->longitud_hospital->HrefValue = "";

			// icon_hospital
			$this->icon_hospital->LinkCustomAttributes = "";
			$this->icon_hospital->HrefValue = "";
			$this->icon_hospital->ExportHrefValue = $this->icon_hospital->UploadPath . $this->icon_hospital->Upload->DbValue;

			// codpolitico
			$this->codpolitico->LinkCustomAttributes = "";
			$this->codpolitico->HrefValue = "";

			// direccion
			$this->direccion->LinkCustomAttributes = "";
			$this->direccion->HrefValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";

			// nombre_responsable
			$this->nombre_responsable->LinkCustomAttributes = "";
			$this->nombre_responsable->HrefValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";

			// emt
			$this->emt->LinkCustomAttributes = "";
			$this->emt->HrefValue = "";
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
		if ($this->id_hospital->Required) {
			if (!$this->id_hospital->IsDetailKey && $this->id_hospital->FormValue != NULL && $this->id_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_hospital->caption(), $this->id_hospital->RequiredErrorMessage));
			}
		}
		if ($this->nombre_hospital->Required) {
			if (!$this->nombre_hospital->IsDetailKey && $this->nombre_hospital->FormValue != NULL && $this->nombre_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_hospital->caption(), $this->nombre_hospital->RequiredErrorMessage));
			}
		}
		if ($this->depto_hospital->Required) {
			if (!$this->depto_hospital->IsDetailKey && $this->depto_hospital->FormValue != NULL && $this->depto_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->depto_hospital->caption(), $this->depto_hospital->RequiredErrorMessage));
			}
		}
		if ($this->provincia_hospital->Required) {
			if (!$this->provincia_hospital->IsDetailKey && $this->provincia_hospital->FormValue != NULL && $this->provincia_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->provincia_hospital->caption(), $this->provincia_hospital->RequiredErrorMessage));
			}
		}
		if ($this->municipio_hospital->Required) {
			if (!$this->municipio_hospital->IsDetailKey && $this->municipio_hospital->FormValue != NULL && $this->municipio_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->municipio_hospital->caption(), $this->municipio_hospital->RequiredErrorMessage));
			}
		}
		if ($this->nivel_hospital->Required) {
			if (!$this->nivel_hospital->IsDetailKey && $this->nivel_hospital->FormValue != NULL && $this->nivel_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nivel_hospital->caption(), $this->nivel_hospital->RequiredErrorMessage));
			}
		}
		if ($this->redservicions_hospital->Required) {
			if (!$this->redservicions_hospital->IsDetailKey && $this->redservicions_hospital->FormValue != NULL && $this->redservicions_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->redservicions_hospital->caption(), $this->redservicions_hospital->RequiredErrorMessage));
			}
		}
		if ($this->sector_hospital->Required) {
			if (!$this->sector_hospital->IsDetailKey && $this->sector_hospital->FormValue != NULL && $this->sector_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sector_hospital->caption(), $this->sector_hospital->RequiredErrorMessage));
			}
		}
		if ($this->tipo_hospital->Required) {
			if (!$this->tipo_hospital->IsDetailKey && $this->tipo_hospital->FormValue != NULL && $this->tipo_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipo_hospital->caption(), $this->tipo_hospital->RequiredErrorMessage));
			}
		}
		if ($this->camashab_cali->Required) {
			if (!$this->camashab_cali->IsDetailKey && $this->camashab_cali->FormValue != NULL && $this->camashab_cali->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->camashab_cali->caption(), $this->camashab_cali->RequiredErrorMessage));
			}
		}
		if ($this->especialidad->Required) {
			if (!$this->especialidad->IsDetailKey && $this->especialidad->FormValue != NULL && $this->especialidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->especialidad->caption(), $this->especialidad->RequiredErrorMessage));
			}
		}
		if ($this->latitud_hospital->Required) {
			if (!$this->latitud_hospital->IsDetailKey && $this->latitud_hospital->FormValue != NULL && $this->latitud_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->latitud_hospital->caption(), $this->latitud_hospital->RequiredErrorMessage));
			}
		}
		if ($this->longitud_hospital->Required) {
			if (!$this->longitud_hospital->IsDetailKey && $this->longitud_hospital->FormValue != NULL && $this->longitud_hospital->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->longitud_hospital->caption(), $this->longitud_hospital->RequiredErrorMessage));
			}
		}
		if ($this->icon_hospital->Required) {
			if ($this->icon_hospital->Upload->FileName == "" && !$this->icon_hospital->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->icon_hospital->caption(), $this->icon_hospital->RequiredErrorMessage));
			}
		}
		if ($this->codpolitico->Required) {
			if (!$this->codpolitico->IsDetailKey && $this->codpolitico->FormValue != NULL && $this->codpolitico->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->codpolitico->caption(), $this->codpolitico->RequiredErrorMessage));
			}
		}
		if ($this->direccion->Required) {
			if (!$this->direccion->IsDetailKey && $this->direccion->FormValue != NULL && $this->direccion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direccion->caption(), $this->direccion->RequiredErrorMessage));
			}
		}
		if ($this->telefono->Required) {
			if (!$this->telefono->IsDetailKey && $this->telefono->FormValue != NULL && $this->telefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefono->caption(), $this->telefono->RequiredErrorMessage));
			}
		}
		if ($this->nombre_responsable->Required) {
			if (!$this->nombre_responsable->IsDetailKey && $this->nombre_responsable->FormValue != NULL && $this->nombre_responsable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_responsable->caption(), $this->nombre_responsable->RequiredErrorMessage));
			}
		}
		if ($this->estado->Required) {
			if ($this->estado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->estado->caption(), $this->estado->RequiredErrorMessage));
			}
		}
		if ($this->emt->Required) {
			if ($this->emt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emt->caption(), $this->emt->RequiredErrorMessage));
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
		if ($this->id_hospital->CurrentValue != "") { // Check field with unique index
			$filter = "(\"id_hospital\" = '" . AdjustSql($this->id_hospital->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->id_hospital->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->id_hospital->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// id_hospital
		$this->id_hospital->setDbValueDef($rsnew, $this->id_hospital->CurrentValue, "", FALSE);

		// nombre_hospital
		$this->nombre_hospital->setDbValueDef($rsnew, $this->nombre_hospital->CurrentValue, NULL, FALSE);

		// depto_hospital
		$this->depto_hospital->setDbValueDef($rsnew, $this->depto_hospital->CurrentValue, NULL, FALSE);

		// provincia_hospital
		$this->provincia_hospital->setDbValueDef($rsnew, $this->provincia_hospital->CurrentValue, NULL, FALSE);

		// municipio_hospital
		$this->municipio_hospital->setDbValueDef($rsnew, $this->municipio_hospital->CurrentValue, NULL, FALSE);

		// nivel_hospital
		$this->nivel_hospital->setDbValueDef($rsnew, $this->nivel_hospital->CurrentValue, NULL, FALSE);

		// redservicions_hospital
		$this->redservicions_hospital->setDbValueDef($rsnew, $this->redservicions_hospital->CurrentValue, NULL, FALSE);

		// sector_hospital
		$this->sector_hospital->setDbValueDef($rsnew, $this->sector_hospital->CurrentValue, NULL, FALSE);

		// tipo_hospital
		$this->tipo_hospital->setDbValueDef($rsnew, $this->tipo_hospital->CurrentValue, NULL, FALSE);

		// camashab_cali
		$this->camashab_cali->setDbValueDef($rsnew, $this->camashab_cali->CurrentValue, NULL, FALSE);

		// especialidad
		$this->especialidad->setDbValueDef($rsnew, $this->especialidad->CurrentValue, NULL, FALSE);

		// latitud_hospital
		$this->latitud_hospital->setDbValueDef($rsnew, $this->latitud_hospital->CurrentValue, NULL, FALSE);

		// longitud_hospital
		$this->longitud_hospital->setDbValueDef($rsnew, $this->longitud_hospital->CurrentValue, NULL, FALSE);

		// icon_hospital
		if ($this->icon_hospital->Visible && !$this->icon_hospital->Upload->KeepFile) {
			$this->icon_hospital->Upload->DbValue = ""; // No need to delete old file
			if ($this->icon_hospital->Upload->FileName == "") {
				$rsnew['icon_hospital'] = NULL;
			} else {
				$rsnew['icon_hospital'] = $this->icon_hospital->Upload->FileName;
			}
		}

		// codpolitico
		$this->codpolitico->setDbValueDef($rsnew, $this->codpolitico->CurrentValue, NULL, FALSE);

		// direccion
		$this->direccion->setDbValueDef($rsnew, $this->direccion->CurrentValue, NULL, FALSE);

		// telefono
		$this->telefono->setDbValueDef($rsnew, $this->telefono->CurrentValue, NULL, FALSE);

		// nombre_responsable
		$this->nombre_responsable->setDbValueDef($rsnew, $this->nombre_responsable->CurrentValue, NULL, FALSE);

		// estado
		$tmpBool = $this->estado->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->estado->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->estado->CurrentValue) == "");

		// emt
		$tmpBool = $this->emt->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->emt->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->emt->CurrentValue) == "");
		if ($this->icon_hospital->Visible && !$this->icon_hospital->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->icon_hospital->Upload->DbValue) ? [] : [$this->icon_hospital->htmlDecode($this->icon_hospital->Upload->DbValue)];
			if (!EmptyValue($this->icon_hospital->Upload->FileName)) {
				$newFiles = [$this->icon_hospital->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->icon_hospital, $this->icon_hospital->Upload->Index);
						if (file_exists($tempPath . $file)) {
							if (Config("DELETE_UPLOADED_FILES")) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										array_splice($oldFiles, $j, 1);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->icon_hospital->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->icon_hospital->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->icon_hospital->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->icon_hospital->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->icon_hospital->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->icon_hospital->setDbValueDef($rsnew, $this->icon_hospital->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['id_hospital']) == "") {
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
				if ($this->icon_hospital->Visible && !$this->icon_hospital->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->icon_hospital->Upload->DbValue) ? [] : [$this->icon_hospital->htmlDecode($this->icon_hospital->Upload->DbValue)];
					if (!EmptyValue($this->icon_hospital->Upload->FileName)) {
						$newFiles = [$this->icon_hospital->Upload->FileName];
						$newFiles2 = [$this->icon_hospital->htmlDecode($rsnew['icon_hospital'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->icon_hospital, $this->icon_hospital->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->icon_hospital->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = [];
					}
					if (Config("DELETE_UPLOADED_FILES")) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile != "" && !in_array($oldFile, $newFiles))
								@unlink($this->icon_hospital->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

			// icon_hospital
			CleanUploadTempPath($this->icon_hospital, $this->icon_hospital->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("hospitalesgenerallist.php"), "", $this->TableVar, TRUE);
		$pageId = "addopt";
		$Breadcrumb->add("addopt", $pageId, $url);
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
				case "x_depto_hospital":
					break;
				case "x_provincia_hospital":
					break;
				case "x_municipio_hospital":
					break;
				case "x_especialidad":
					break;
				case "x_estado":
					break;
				case "x_emt":
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
						case "x_depto_hospital":
							break;
						case "x_provincia_hospital":
							break;
						case "x_municipio_hospital":
							break;
						case "x_especialidad":
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
} // End class
?>
<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class sala_admision_add extends sala_admision
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'sala_admision';

	// Page object name
	public $PageObjName = "sala_admision_add";

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

		// Table object (sala_admision)
		if (!isset($GLOBALS["sala_admision"]) || get_class($GLOBALS["sala_admision"]) == PROJECT_NAMESPACE . "sala_admision") {
			$GLOBALS["sala_admision"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["sala_admision"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'sala_admision');

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
		global $sala_admision;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($sala_admision);
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
					if ($pageName == "sala_admisionview.php")
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
			$key .= @$ar['cod_casopreh'];
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
					$this->terminate(GetUrl("sala_admisionlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->cod_casopreh->setVisibility();
		$this->fecha->setVisibility();
		$this->prioridad->setVisibility();
		$this->nombre_es->setVisibility();
		$this->hospital_destino->setVisibility();
		$this->nombre_confirma->setVisibility();
		$this->paciente->setVisibility();
		$this->genero->setVisibility();
		$this->edad->setVisibility();
		$this->cod_ambulancia->setVisibility();
		$this->cuando_murio->setVisibility();
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
			$this->terminate("sala_admisionlist.php");
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
			if (Get("cod_casopreh") !== NULL) {
				$this->cod_casopreh->setQueryStringValue(Get("cod_casopreh"));
				$this->setKey("cod_casopreh", $this->cod_casopreh->CurrentValue); // Set up key
			} else {
				$this->setKey("cod_casopreh", ""); // Clear key
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
					$this->terminate("sala_admisionlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "sala_admisionlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "sala_admisionview.php")
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
		$this->cod_casopreh->CurrentValue = NULL;
		$this->cod_casopreh->OldValue = $this->cod_casopreh->CurrentValue;
		$this->fecha->CurrentValue = NULL;
		$this->fecha->OldValue = $this->fecha->CurrentValue;
		$this->prioridad->CurrentValue = NULL;
		$this->prioridad->OldValue = $this->prioridad->CurrentValue;
		$this->nombre_es->CurrentValue = NULL;
		$this->nombre_es->OldValue = $this->nombre_es->CurrentValue;
		$this->hospital_destino->CurrentValue = NULL;
		$this->hospital_destino->OldValue = $this->hospital_destino->CurrentValue;
		$this->nombre_confirma->CurrentValue = NULL;
		$this->nombre_confirma->OldValue = $this->nombre_confirma->CurrentValue;
		$this->paciente->CurrentValue = NULL;
		$this->paciente->OldValue = $this->paciente->CurrentValue;
		$this->genero->CurrentValue = NULL;
		$this->genero->OldValue = $this->genero->CurrentValue;
		$this->edad->CurrentValue = NULL;
		$this->edad->OldValue = $this->edad->CurrentValue;
		$this->cod_ambulancia->CurrentValue = NULL;
		$this->cod_ambulancia->OldValue = $this->cod_ambulancia->CurrentValue;
		$this->cuando_murio->CurrentValue = NULL;
		$this->cuando_murio->OldValue = $this->cuando_murio->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'cod_casopreh' first before field var 'x_cod_casopreh'
		$val = $CurrentForm->hasValue("cod_casopreh") ? $CurrentForm->getValue("cod_casopreh") : $CurrentForm->getValue("x_cod_casopreh");
		if (!$this->cod_casopreh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cod_casopreh->Visible = FALSE; // Disable update for API request
			else
				$this->cod_casopreh->setFormValue($val);
		}

		// Check field name 'fecha' first before field var 'x_fecha'
		$val = $CurrentForm->hasValue("fecha") ? $CurrentForm->getValue("fecha") : $CurrentForm->getValue("x_fecha");
		if (!$this->fecha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha->Visible = FALSE; // Disable update for API request
			else
				$this->fecha->setFormValue($val);
			$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 0);
		}

		// Check field name 'prioridad' first before field var 'x_prioridad'
		$val = $CurrentForm->hasValue("prioridad") ? $CurrentForm->getValue("prioridad") : $CurrentForm->getValue("x_prioridad");
		if (!$this->prioridad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->prioridad->Visible = FALSE; // Disable update for API request
			else
				$this->prioridad->setFormValue($val);
		}

		// Check field name 'nombre_es' first before field var 'x_nombre_es'
		$val = $CurrentForm->hasValue("nombre_es") ? $CurrentForm->getValue("nombre_es") : $CurrentForm->getValue("x_nombre_es");
		if (!$this->nombre_es->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nombre_es->Visible = FALSE; // Disable update for API request
			else
				$this->nombre_es->setFormValue($val);
		}

		// Check field name 'hospital_destino' first before field var 'x_hospital_destino'
		$val = $CurrentForm->hasValue("hospital_destino") ? $CurrentForm->getValue("hospital_destino") : $CurrentForm->getValue("x_hospital_destino");
		if (!$this->hospital_destino->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hospital_destino->Visible = FALSE; // Disable update for API request
			else
				$this->hospital_destino->setFormValue($val);
		}

		// Check field name 'nombre_confirma' first before field var 'x_nombre_confirma'
		$val = $CurrentForm->hasValue("nombre_confirma") ? $CurrentForm->getValue("nombre_confirma") : $CurrentForm->getValue("x_nombre_confirma");
		if (!$this->nombre_confirma->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nombre_confirma->Visible = FALSE; // Disable update for API request
			else
				$this->nombre_confirma->setFormValue($val);
		}

		// Check field name 'paciente' first before field var 'x_paciente'
		$val = $CurrentForm->hasValue("paciente") ? $CurrentForm->getValue("paciente") : $CurrentForm->getValue("x_paciente");
		if (!$this->paciente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->paciente->Visible = FALSE; // Disable update for API request
			else
				$this->paciente->setFormValue($val);
		}

		// Check field name 'genero' first before field var 'x_genero'
		$val = $CurrentForm->hasValue("genero") ? $CurrentForm->getValue("genero") : $CurrentForm->getValue("x_genero");
		if (!$this->genero->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->genero->Visible = FALSE; // Disable update for API request
			else
				$this->genero->setFormValue($val);
		}

		// Check field name 'edad' first before field var 'x_edad'
		$val = $CurrentForm->hasValue("edad") ? $CurrentForm->getValue("edad") : $CurrentForm->getValue("x_edad");
		if (!$this->edad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->edad->Visible = FALSE; // Disable update for API request
			else
				$this->edad->setFormValue($val);
		}

		// Check field name 'cod_ambulancia' first before field var 'x_cod_ambulancia'
		$val = $CurrentForm->hasValue("cod_ambulancia") ? $CurrentForm->getValue("cod_ambulancia") : $CurrentForm->getValue("x_cod_ambulancia");
		if (!$this->cod_ambulancia->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cod_ambulancia->Visible = FALSE; // Disable update for API request
			else
				$this->cod_ambulancia->setFormValue($val);
		}

		// Check field name 'cuando_murio' first before field var 'x_cuando_murio'
		$val = $CurrentForm->hasValue("cuando_murio") ? $CurrentForm->getValue("cuando_murio") : $CurrentForm->getValue("x_cuando_murio");
		if (!$this->cuando_murio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cuando_murio->Visible = FALSE; // Disable update for API request
			else
				$this->cuando_murio->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->cod_casopreh->CurrentValue = $this->cod_casopreh->FormValue;
		$this->fecha->CurrentValue = $this->fecha->FormValue;
		$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 0);
		$this->prioridad->CurrentValue = $this->prioridad->FormValue;
		$this->nombre_es->CurrentValue = $this->nombre_es->FormValue;
		$this->hospital_destino->CurrentValue = $this->hospital_destino->FormValue;
		$this->nombre_confirma->CurrentValue = $this->nombre_confirma->FormValue;
		$this->paciente->CurrentValue = $this->paciente->FormValue;
		$this->genero->CurrentValue = $this->genero->FormValue;
		$this->edad->CurrentValue = $this->edad->FormValue;
		$this->cod_ambulancia->CurrentValue = $this->cod_ambulancia->FormValue;
		$this->cuando_murio->CurrentValue = $this->cuando_murio->FormValue;
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
		$this->cod_casopreh->setDbValue($row['cod_casopreh']);
		$this->fecha->setDbValue($row['fecha']);
		$this->prioridad->setDbValue($row['prioridad']);
		$this->nombre_es->setDbValue($row['nombre_es']);
		$this->hospital_destino->setDbValue($row['hospital_destino']);
		$this->nombre_confirma->setDbValue($row['nombre_confirma']);
		$this->paciente->setDbValue($row['paciente']);
		$this->genero->setDbValue($row['genero']);
		$this->edad->setDbValue($row['edad']);
		$this->cod_ambulancia->setDbValue($row['cod_ambulancia']);
		$this->cuando_murio->setDbValue($row['cuando_murio']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['cod_casopreh'] = $this->cod_casopreh->CurrentValue;
		$row['fecha'] = $this->fecha->CurrentValue;
		$row['prioridad'] = $this->prioridad->CurrentValue;
		$row['nombre_es'] = $this->nombre_es->CurrentValue;
		$row['hospital_destino'] = $this->hospital_destino->CurrentValue;
		$row['nombre_confirma'] = $this->nombre_confirma->CurrentValue;
		$row['paciente'] = $this->paciente->CurrentValue;
		$row['genero'] = $this->genero->CurrentValue;
		$row['edad'] = $this->edad->CurrentValue;
		$row['cod_ambulancia'] = $this->cod_ambulancia->CurrentValue;
		$row['cuando_murio'] = $this->cuando_murio->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("cod_casopreh")) != "")
			$this->cod_casopreh->OldValue = $this->getKey("cod_casopreh"); // cod_casopreh
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
		// cod_casopreh
		// fecha
		// prioridad
		// nombre_es
		// hospital_destino
		// nombre_confirma
		// paciente
		// genero
		// edad
		// cod_ambulancia
		// cuando_murio

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// cod_casopreh
			$this->cod_casopreh->ViewValue = $this->cod_casopreh->CurrentValue;
			$this->cod_casopreh->ViewValue = FormatNumber($this->cod_casopreh->ViewValue, 0, -2, -2, -2);
			$this->cod_casopreh->ViewCustomAttributes = "";

			// fecha
			$this->fecha->ViewValue = $this->fecha->CurrentValue;
			$this->fecha->ViewValue = FormatDateTime($this->fecha->ViewValue, 0);
			$this->fecha->ViewCustomAttributes = "";

			// prioridad
			$this->prioridad->ViewValue = $this->prioridad->CurrentValue;
			$this->prioridad->ViewValue = FormatNumber($this->prioridad->ViewValue, 0, -2, -2, -2);
			$this->prioridad->ViewCustomAttributes = "";

			// nombre_es
			$this->nombre_es->ViewValue = $this->nombre_es->CurrentValue;
			$this->nombre_es->ViewCustomAttributes = "";

			// hospital_destino
			$this->hospital_destino->ViewValue = $this->hospital_destino->CurrentValue;
			$this->hospital_destino->ViewCustomAttributes = "";

			// nombre_confirma
			$this->nombre_confirma->ViewValue = $this->nombre_confirma->CurrentValue;
			$this->nombre_confirma->ViewCustomAttributes = "";

			// paciente
			$this->paciente->ViewValue = $this->paciente->CurrentValue;
			$this->paciente->ViewCustomAttributes = "";

			// genero
			$this->genero->ViewValue = $this->genero->CurrentValue;
			$this->genero->ViewValue = FormatNumber($this->genero->ViewValue, 0, -2, -2, -2);
			$this->genero->ViewCustomAttributes = "";

			// edad
			$this->edad->ViewValue = $this->edad->CurrentValue;
			$this->edad->ViewValue = FormatNumber($this->edad->ViewValue, 0, -2, -2, -2);
			$this->edad->ViewCustomAttributes = "";

			// cod_ambulancia
			$this->cod_ambulancia->ViewValue = $this->cod_ambulancia->CurrentValue;
			$this->cod_ambulancia->ViewCustomAttributes = "";

			// cuando_murio
			$this->cuando_murio->ViewValue = $this->cuando_murio->CurrentValue;
			$this->cuando_murio->ViewValue = FormatNumber($this->cuando_murio->ViewValue, 0, -2, -2, -2);
			$this->cuando_murio->ViewCustomAttributes = "";

			// cod_casopreh
			$this->cod_casopreh->LinkCustomAttributes = "";
			$this->cod_casopreh->HrefValue = "";
			$this->cod_casopreh->TooltipValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";
			$this->fecha->TooltipValue = "";

			// prioridad
			$this->prioridad->LinkCustomAttributes = "";
			$this->prioridad->HrefValue = "";
			$this->prioridad->TooltipValue = "";

			// nombre_es
			$this->nombre_es->LinkCustomAttributes = "";
			$this->nombre_es->HrefValue = "";
			$this->nombre_es->TooltipValue = "";

			// hospital_destino
			$this->hospital_destino->LinkCustomAttributes = "";
			$this->hospital_destino->HrefValue = "";
			$this->hospital_destino->TooltipValue = "";

			// nombre_confirma
			$this->nombre_confirma->LinkCustomAttributes = "";
			$this->nombre_confirma->HrefValue = "";
			$this->nombre_confirma->TooltipValue = "";

			// paciente
			$this->paciente->LinkCustomAttributes = "";
			$this->paciente->HrefValue = "";
			$this->paciente->TooltipValue = "";

			// genero
			$this->genero->LinkCustomAttributes = "";
			$this->genero->HrefValue = "";
			$this->genero->TooltipValue = "";

			// edad
			$this->edad->LinkCustomAttributes = "";
			$this->edad->HrefValue = "";
			$this->edad->TooltipValue = "";

			// cod_ambulancia
			$this->cod_ambulancia->LinkCustomAttributes = "";
			$this->cod_ambulancia->HrefValue = "";
			$this->cod_ambulancia->TooltipValue = "";

			// cuando_murio
			$this->cuando_murio->LinkCustomAttributes = "";
			$this->cuando_murio->HrefValue = "";
			$this->cuando_murio->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// cod_casopreh
			$this->cod_casopreh->EditAttrs["class"] = "form-control";
			$this->cod_casopreh->EditCustomAttributes = "";
			$this->cod_casopreh->EditValue = HtmlEncode($this->cod_casopreh->CurrentValue);
			$this->cod_casopreh->PlaceHolder = RemoveHtml($this->cod_casopreh->caption());

			// fecha
			$this->fecha->EditAttrs["class"] = "form-control";
			$this->fecha->EditCustomAttributes = "";
			$this->fecha->EditValue = HtmlEncode(FormatDateTime($this->fecha->CurrentValue, 8));
			$this->fecha->PlaceHolder = RemoveHtml($this->fecha->caption());

			// prioridad
			$this->prioridad->EditAttrs["class"] = "form-control";
			$this->prioridad->EditCustomAttributes = "";
			$this->prioridad->EditValue = HtmlEncode($this->prioridad->CurrentValue);
			$this->prioridad->PlaceHolder = RemoveHtml($this->prioridad->caption());

			// nombre_es
			$this->nombre_es->EditAttrs["class"] = "form-control";
			$this->nombre_es->EditCustomAttributes = "";
			if (!$this->nombre_es->Raw)
				$this->nombre_es->CurrentValue = HtmlDecode($this->nombre_es->CurrentValue);
			$this->nombre_es->EditValue = HtmlEncode($this->nombre_es->CurrentValue);
			$this->nombre_es->PlaceHolder = RemoveHtml($this->nombre_es->caption());

			// hospital_destino
			$this->hospital_destino->EditAttrs["class"] = "form-control";
			$this->hospital_destino->EditCustomAttributes = "";
			if (!$this->hospital_destino->Raw)
				$this->hospital_destino->CurrentValue = HtmlDecode($this->hospital_destino->CurrentValue);
			$this->hospital_destino->EditValue = HtmlEncode($this->hospital_destino->CurrentValue);
			$this->hospital_destino->PlaceHolder = RemoveHtml($this->hospital_destino->caption());

			// nombre_confirma
			$this->nombre_confirma->EditAttrs["class"] = "form-control";
			$this->nombre_confirma->EditCustomAttributes = "";
			if (!$this->nombre_confirma->Raw)
				$this->nombre_confirma->CurrentValue = HtmlDecode($this->nombre_confirma->CurrentValue);
			$this->nombre_confirma->EditValue = HtmlEncode($this->nombre_confirma->CurrentValue);
			$this->nombre_confirma->PlaceHolder = RemoveHtml($this->nombre_confirma->caption());

			// paciente
			$this->paciente->EditAttrs["class"] = "form-control";
			$this->paciente->EditCustomAttributes = "";
			$this->paciente->EditValue = HtmlEncode($this->paciente->CurrentValue);
			$this->paciente->PlaceHolder = RemoveHtml($this->paciente->caption());

			// genero
			$this->genero->EditAttrs["class"] = "form-control";
			$this->genero->EditCustomAttributes = "";
			$this->genero->EditValue = HtmlEncode($this->genero->CurrentValue);
			$this->genero->PlaceHolder = RemoveHtml($this->genero->caption());

			// edad
			$this->edad->EditAttrs["class"] = "form-control";
			$this->edad->EditCustomAttributes = "";
			$this->edad->EditValue = HtmlEncode($this->edad->CurrentValue);
			$this->edad->PlaceHolder = RemoveHtml($this->edad->caption());

			// cod_ambulancia
			$this->cod_ambulancia->EditAttrs["class"] = "form-control";
			$this->cod_ambulancia->EditCustomAttributes = "";
			if (!$this->cod_ambulancia->Raw)
				$this->cod_ambulancia->CurrentValue = HtmlDecode($this->cod_ambulancia->CurrentValue);
			$this->cod_ambulancia->EditValue = HtmlEncode($this->cod_ambulancia->CurrentValue);
			$this->cod_ambulancia->PlaceHolder = RemoveHtml($this->cod_ambulancia->caption());

			// cuando_murio
			$this->cuando_murio->EditAttrs["class"] = "form-control";
			$this->cuando_murio->EditCustomAttributes = "";
			$this->cuando_murio->EditValue = HtmlEncode($this->cuando_murio->CurrentValue);
			$this->cuando_murio->PlaceHolder = RemoveHtml($this->cuando_murio->caption());

			// Add refer script
			// cod_casopreh

			$this->cod_casopreh->LinkCustomAttributes = "";
			$this->cod_casopreh->HrefValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";

			// prioridad
			$this->prioridad->LinkCustomAttributes = "";
			$this->prioridad->HrefValue = "";

			// nombre_es
			$this->nombre_es->LinkCustomAttributes = "";
			$this->nombre_es->HrefValue = "";

			// hospital_destino
			$this->hospital_destino->LinkCustomAttributes = "";
			$this->hospital_destino->HrefValue = "";

			// nombre_confirma
			$this->nombre_confirma->LinkCustomAttributes = "";
			$this->nombre_confirma->HrefValue = "";

			// paciente
			$this->paciente->LinkCustomAttributes = "";
			$this->paciente->HrefValue = "";

			// genero
			$this->genero->LinkCustomAttributes = "";
			$this->genero->HrefValue = "";

			// edad
			$this->edad->LinkCustomAttributes = "";
			$this->edad->HrefValue = "";

			// cod_ambulancia
			$this->cod_ambulancia->LinkCustomAttributes = "";
			$this->cod_ambulancia->HrefValue = "";

			// cuando_murio
			$this->cuando_murio->LinkCustomAttributes = "";
			$this->cuando_murio->HrefValue = "";
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
		if ($this->cod_casopreh->Required) {
			if (!$this->cod_casopreh->IsDetailKey && $this->cod_casopreh->FormValue != NULL && $this->cod_casopreh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cod_casopreh->caption(), $this->cod_casopreh->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cod_casopreh->FormValue)) {
			AddMessage($FormError, $this->cod_casopreh->errorMessage());
		}
		if ($this->fecha->Required) {
			if (!$this->fecha->IsDetailKey && $this->fecha->FormValue != NULL && $this->fecha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha->caption(), $this->fecha->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha->FormValue)) {
			AddMessage($FormError, $this->fecha->errorMessage());
		}
		if ($this->prioridad->Required) {
			if (!$this->prioridad->IsDetailKey && $this->prioridad->FormValue != NULL && $this->prioridad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->prioridad->caption(), $this->prioridad->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->prioridad->FormValue)) {
			AddMessage($FormError, $this->prioridad->errorMessage());
		}
		if ($this->nombre_es->Required) {
			if (!$this->nombre_es->IsDetailKey && $this->nombre_es->FormValue != NULL && $this->nombre_es->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_es->caption(), $this->nombre_es->RequiredErrorMessage));
			}
		}
		if ($this->hospital_destino->Required) {
			if (!$this->hospital_destino->IsDetailKey && $this->hospital_destino->FormValue != NULL && $this->hospital_destino->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hospital_destino->caption(), $this->hospital_destino->RequiredErrorMessage));
			}
		}
		if ($this->nombre_confirma->Required) {
			if (!$this->nombre_confirma->IsDetailKey && $this->nombre_confirma->FormValue != NULL && $this->nombre_confirma->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_confirma->caption(), $this->nombre_confirma->RequiredErrorMessage));
			}
		}
		if ($this->paciente->Required) {
			if (!$this->paciente->IsDetailKey && $this->paciente->FormValue != NULL && $this->paciente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->paciente->caption(), $this->paciente->RequiredErrorMessage));
			}
		}
		if ($this->genero->Required) {
			if (!$this->genero->IsDetailKey && $this->genero->FormValue != NULL && $this->genero->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->genero->caption(), $this->genero->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->genero->FormValue)) {
			AddMessage($FormError, $this->genero->errorMessage());
		}
		if ($this->edad->Required) {
			if (!$this->edad->IsDetailKey && $this->edad->FormValue != NULL && $this->edad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->edad->caption(), $this->edad->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->edad->FormValue)) {
			AddMessage($FormError, $this->edad->errorMessage());
		}
		if ($this->cod_ambulancia->Required) {
			if (!$this->cod_ambulancia->IsDetailKey && $this->cod_ambulancia->FormValue != NULL && $this->cod_ambulancia->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cod_ambulancia->caption(), $this->cod_ambulancia->RequiredErrorMessage));
			}
		}
		if ($this->cuando_murio->Required) {
			if (!$this->cuando_murio->IsDetailKey && $this->cuando_murio->FormValue != NULL && $this->cuando_murio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cuando_murio->caption(), $this->cuando_murio->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cuando_murio->FormValue)) {
			AddMessage($FormError, $this->cuando_murio->errorMessage());
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

		// cod_casopreh
		$this->cod_casopreh->setDbValueDef($rsnew, $this->cod_casopreh->CurrentValue, NULL, FALSE);

		// fecha
		$this->fecha->setDbValueDef($rsnew, UnFormatDateTime($this->fecha->CurrentValue, 0), NULL, FALSE);

		// prioridad
		$this->prioridad->setDbValueDef($rsnew, $this->prioridad->CurrentValue, NULL, FALSE);

		// nombre_es
		$this->nombre_es->setDbValueDef($rsnew, $this->nombre_es->CurrentValue, NULL, FALSE);

		// hospital_destino
		$this->hospital_destino->setDbValueDef($rsnew, $this->hospital_destino->CurrentValue, NULL, FALSE);

		// nombre_confirma
		$this->nombre_confirma->setDbValueDef($rsnew, $this->nombre_confirma->CurrentValue, NULL, FALSE);

		// paciente
		$this->paciente->setDbValueDef($rsnew, $this->paciente->CurrentValue, NULL, FALSE);

		// genero
		$this->genero->setDbValueDef($rsnew, $this->genero->CurrentValue, NULL, FALSE);

		// edad
		$this->edad->setDbValueDef($rsnew, $this->edad->CurrentValue, NULL, FALSE);

		// cod_ambulancia
		$this->cod_ambulancia->setDbValueDef($rsnew, $this->cod_ambulancia->CurrentValue, NULL, FALSE);

		// cuando_murio
		$this->cuando_murio->setDbValueDef($rsnew, $this->cuando_murio->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['cod_casopreh']) == "") {
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("sala_admisionlist.php"), "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>
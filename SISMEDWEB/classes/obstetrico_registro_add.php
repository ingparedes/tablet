<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class obstetrico_registro_add extends obstetrico_registro
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'obstetrico_registro';

	// Page object name
	public $PageObjName = "obstetrico_registro_add";

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

		// Table object (obstetrico_registro)
		if (!isset($GLOBALS["obstetrico_registro"]) || get_class($GLOBALS["obstetrico_registro"]) == PROJECT_NAMESPACE . "obstetrico_registro") {
			$GLOBALS["obstetrico_registro"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["obstetrico_registro"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'obstetrico_registro');

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
		global $obstetrico_registro;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($obstetrico_registro);
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
					if ($pageName == "obstetrico_registroview.php")
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
			$key .= @$ar['id'];
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
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
					$this->terminate(GetUrl("obstetrico_registrolist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->cod_casopreh->setVisibility();
		$this->trabajoparto->setVisibility();
		$this->sangradovaginal->setVisibility();
		$this->g->setVisibility();
		$this->p->setVisibility();
		$this->a->setVisibility();
		$this->n->setVisibility();
		$this->c->setVisibility();
		$this->fuente->setVisibility();
		$this->tiempo->setVisibility();
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
			$this->terminate("obstetrico_registrolist.php");
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
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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
					$this->terminate("obstetrico_registrolist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "obstetrico_registrolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "obstetrico_registroview.php")
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
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->cod_casopreh->CurrentValue = NULL;
		$this->cod_casopreh->OldValue = $this->cod_casopreh->CurrentValue;
		$this->trabajoparto->CurrentValue = NULL;
		$this->trabajoparto->OldValue = $this->trabajoparto->CurrentValue;
		$this->sangradovaginal->CurrentValue = NULL;
		$this->sangradovaginal->OldValue = $this->sangradovaginal->CurrentValue;
		$this->g->CurrentValue = NULL;
		$this->g->OldValue = $this->g->CurrentValue;
		$this->p->CurrentValue = NULL;
		$this->p->OldValue = $this->p->CurrentValue;
		$this->a->CurrentValue = NULL;
		$this->a->OldValue = $this->a->CurrentValue;
		$this->n->CurrentValue = NULL;
		$this->n->OldValue = $this->n->CurrentValue;
		$this->c->CurrentValue = NULL;
		$this->c->OldValue = $this->c->CurrentValue;
		$this->fuente->CurrentValue = NULL;
		$this->fuente->OldValue = $this->fuente->CurrentValue;
		$this->tiempo->CurrentValue = NULL;
		$this->tiempo->OldValue = $this->tiempo->CurrentValue;
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

		// Check field name 'trabajoparto' first before field var 'x_trabajoparto'
		$val = $CurrentForm->hasValue("trabajoparto") ? $CurrentForm->getValue("trabajoparto") : $CurrentForm->getValue("x_trabajoparto");
		if (!$this->trabajoparto->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->trabajoparto->Visible = FALSE; // Disable update for API request
			else
				$this->trabajoparto->setFormValue($val);
		}

		// Check field name 'sangradovaginal' first before field var 'x_sangradovaginal'
		$val = $CurrentForm->hasValue("sangradovaginal") ? $CurrentForm->getValue("sangradovaginal") : $CurrentForm->getValue("x_sangradovaginal");
		if (!$this->sangradovaginal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sangradovaginal->Visible = FALSE; // Disable update for API request
			else
				$this->sangradovaginal->setFormValue($val);
		}

		// Check field name 'g' first before field var 'x_g'
		$val = $CurrentForm->hasValue("g") ? $CurrentForm->getValue("g") : $CurrentForm->getValue("x_g");
		if (!$this->g->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->g->Visible = FALSE; // Disable update for API request
			else
				$this->g->setFormValue($val);
		}

		// Check field name 'p' first before field var 'x_p'
		$val = $CurrentForm->hasValue("p") ? $CurrentForm->getValue("p") : $CurrentForm->getValue("x_p");
		if (!$this->p->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->p->Visible = FALSE; // Disable update for API request
			else
				$this->p->setFormValue($val);
		}

		// Check field name 'a' first before field var 'x_a'
		$val = $CurrentForm->hasValue("a") ? $CurrentForm->getValue("a") : $CurrentForm->getValue("x_a");
		if (!$this->a->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->a->Visible = FALSE; // Disable update for API request
			else
				$this->a->setFormValue($val);
		}

		// Check field name 'n' first before field var 'x_n'
		$val = $CurrentForm->hasValue("n") ? $CurrentForm->getValue("n") : $CurrentForm->getValue("x_n");
		if (!$this->n->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->n->Visible = FALSE; // Disable update for API request
			else
				$this->n->setFormValue($val);
		}

		// Check field name 'c' first before field var 'x_c'
		$val = $CurrentForm->hasValue("c") ? $CurrentForm->getValue("c") : $CurrentForm->getValue("x_c");
		if (!$this->c->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->c->Visible = FALSE; // Disable update for API request
			else
				$this->c->setFormValue($val);
		}

		// Check field name 'fuente' first before field var 'x_fuente'
		$val = $CurrentForm->hasValue("fuente") ? $CurrentForm->getValue("fuente") : $CurrentForm->getValue("x_fuente");
		if (!$this->fuente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fuente->Visible = FALSE; // Disable update for API request
			else
				$this->fuente->setFormValue($val);
		}

		// Check field name 'tiempo' first before field var 'x_tiempo'
		$val = $CurrentForm->hasValue("tiempo") ? $CurrentForm->getValue("tiempo") : $CurrentForm->getValue("x_tiempo");
		if (!$this->tiempo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tiempo->Visible = FALSE; // Disable update for API request
			else
				$this->tiempo->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->cod_casopreh->CurrentValue = $this->cod_casopreh->FormValue;
		$this->trabajoparto->CurrentValue = $this->trabajoparto->FormValue;
		$this->sangradovaginal->CurrentValue = $this->sangradovaginal->FormValue;
		$this->g->CurrentValue = $this->g->FormValue;
		$this->p->CurrentValue = $this->p->FormValue;
		$this->a->CurrentValue = $this->a->FormValue;
		$this->n->CurrentValue = $this->n->FormValue;
		$this->c->CurrentValue = $this->c->FormValue;
		$this->fuente->CurrentValue = $this->fuente->FormValue;
		$this->tiempo->CurrentValue = $this->tiempo->FormValue;
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
		$this->id->setDbValue($row['id']);
		$this->cod_casopreh->setDbValue($row['cod_casopreh']);
		$this->trabajoparto->setDbValue($row['trabajoparto']);
		$this->sangradovaginal->setDbValue($row['sangradovaginal']);
		$this->g->setDbValue($row['g']);
		$this->p->setDbValue($row['p']);
		$this->a->setDbValue($row['a']);
		$this->n->setDbValue($row['n']);
		$this->c->setDbValue($row['c']);
		$this->fuente->setDbValue($row['fuente']);
		$this->tiempo->setDbValue($row['tiempo']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['cod_casopreh'] = $this->cod_casopreh->CurrentValue;
		$row['trabajoparto'] = $this->trabajoparto->CurrentValue;
		$row['sangradovaginal'] = $this->sangradovaginal->CurrentValue;
		$row['g'] = $this->g->CurrentValue;
		$row['p'] = $this->p->CurrentValue;
		$row['a'] = $this->a->CurrentValue;
		$row['n'] = $this->n->CurrentValue;
		$row['c'] = $this->c->CurrentValue;
		$row['fuente'] = $this->fuente->CurrentValue;
		$row['tiempo'] = $this->tiempo->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
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
		// id
		// cod_casopreh
		// trabajoparto
		// sangradovaginal
		// g
		// p
		// a
		// n
		// c
		// fuente
		// tiempo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// cod_casopreh
			$this->cod_casopreh->ViewValue = $this->cod_casopreh->CurrentValue;
			$this->cod_casopreh->ViewValue = FormatNumber($this->cod_casopreh->ViewValue, 0, -2, -2, -2);
			$this->cod_casopreh->ViewCustomAttributes = "";

			// trabajoparto
			$this->trabajoparto->ViewValue = $this->trabajoparto->CurrentValue;
			$this->trabajoparto->ViewCustomAttributes = "";

			// sangradovaginal
			$this->sangradovaginal->ViewValue = $this->sangradovaginal->CurrentValue;
			$this->sangradovaginal->ViewCustomAttributes = "";

			// g
			$this->g->ViewValue = $this->g->CurrentValue;
			$this->g->ViewCustomAttributes = "";

			// p
			$this->p->ViewValue = $this->p->CurrentValue;
			$this->p->ViewCustomAttributes = "";

			// a
			$this->a->ViewValue = $this->a->CurrentValue;
			$this->a->ViewCustomAttributes = "";

			// n
			$this->n->ViewValue = $this->n->CurrentValue;
			$this->n->ViewCustomAttributes = "";

			// c
			$this->c->ViewValue = $this->c->CurrentValue;
			$this->c->ViewCustomAttributes = "";

			// fuente
			$this->fuente->ViewValue = $this->fuente->CurrentValue;
			$this->fuente->ViewCustomAttributes = "";

			// tiempo
			$this->tiempo->ViewValue = $this->tiempo->CurrentValue;
			$this->tiempo->ViewCustomAttributes = "";

			// cod_casopreh
			$this->cod_casopreh->LinkCustomAttributes = "";
			$this->cod_casopreh->HrefValue = "";
			$this->cod_casopreh->TooltipValue = "";

			// trabajoparto
			$this->trabajoparto->LinkCustomAttributes = "";
			$this->trabajoparto->HrefValue = "";
			$this->trabajoparto->TooltipValue = "";

			// sangradovaginal
			$this->sangradovaginal->LinkCustomAttributes = "";
			$this->sangradovaginal->HrefValue = "";
			$this->sangradovaginal->TooltipValue = "";

			// g
			$this->g->LinkCustomAttributes = "";
			$this->g->HrefValue = "";
			$this->g->TooltipValue = "";

			// p
			$this->p->LinkCustomAttributes = "";
			$this->p->HrefValue = "";
			$this->p->TooltipValue = "";

			// a
			$this->a->LinkCustomAttributes = "";
			$this->a->HrefValue = "";
			$this->a->TooltipValue = "";

			// n
			$this->n->LinkCustomAttributes = "";
			$this->n->HrefValue = "";
			$this->n->TooltipValue = "";

			// c
			$this->c->LinkCustomAttributes = "";
			$this->c->HrefValue = "";
			$this->c->TooltipValue = "";

			// fuente
			$this->fuente->LinkCustomAttributes = "";
			$this->fuente->HrefValue = "";
			$this->fuente->TooltipValue = "";

			// tiempo
			$this->tiempo->LinkCustomAttributes = "";
			$this->tiempo->HrefValue = "";
			$this->tiempo->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// cod_casopreh
			$this->cod_casopreh->EditAttrs["class"] = "form-control";
			$this->cod_casopreh->EditCustomAttributes = "";
			$this->cod_casopreh->EditValue = HtmlEncode($this->cod_casopreh->CurrentValue);
			$this->cod_casopreh->PlaceHolder = RemoveHtml($this->cod_casopreh->caption());

			// trabajoparto
			$this->trabajoparto->EditAttrs["class"] = "form-control";
			$this->trabajoparto->EditCustomAttributes = "";
			if (!$this->trabajoparto->Raw)
				$this->trabajoparto->CurrentValue = HtmlDecode($this->trabajoparto->CurrentValue);
			$this->trabajoparto->EditValue = HtmlEncode($this->trabajoparto->CurrentValue);
			$this->trabajoparto->PlaceHolder = RemoveHtml($this->trabajoparto->caption());

			// sangradovaginal
			$this->sangradovaginal->EditAttrs["class"] = "form-control";
			$this->sangradovaginal->EditCustomAttributes = "";
			if (!$this->sangradovaginal->Raw)
				$this->sangradovaginal->CurrentValue = HtmlDecode($this->sangradovaginal->CurrentValue);
			$this->sangradovaginal->EditValue = HtmlEncode($this->sangradovaginal->CurrentValue);
			$this->sangradovaginal->PlaceHolder = RemoveHtml($this->sangradovaginal->caption());

			// g
			$this->g->EditAttrs["class"] = "form-control";
			$this->g->EditCustomAttributes = "";
			if (!$this->g->Raw)
				$this->g->CurrentValue = HtmlDecode($this->g->CurrentValue);
			$this->g->EditValue = HtmlEncode($this->g->CurrentValue);
			$this->g->PlaceHolder = RemoveHtml($this->g->caption());

			// p
			$this->p->EditAttrs["class"] = "form-control";
			$this->p->EditCustomAttributes = "";
			if (!$this->p->Raw)
				$this->p->CurrentValue = HtmlDecode($this->p->CurrentValue);
			$this->p->EditValue = HtmlEncode($this->p->CurrentValue);
			$this->p->PlaceHolder = RemoveHtml($this->p->caption());

			// a
			$this->a->EditAttrs["class"] = "form-control";
			$this->a->EditCustomAttributes = "";
			if (!$this->a->Raw)
				$this->a->CurrentValue = HtmlDecode($this->a->CurrentValue);
			$this->a->EditValue = HtmlEncode($this->a->CurrentValue);
			$this->a->PlaceHolder = RemoveHtml($this->a->caption());

			// n
			$this->n->EditAttrs["class"] = "form-control";
			$this->n->EditCustomAttributes = "";
			if (!$this->n->Raw)
				$this->n->CurrentValue = HtmlDecode($this->n->CurrentValue);
			$this->n->EditValue = HtmlEncode($this->n->CurrentValue);
			$this->n->PlaceHolder = RemoveHtml($this->n->caption());

			// c
			$this->c->EditAttrs["class"] = "form-control";
			$this->c->EditCustomAttributes = "";
			if (!$this->c->Raw)
				$this->c->CurrentValue = HtmlDecode($this->c->CurrentValue);
			$this->c->EditValue = HtmlEncode($this->c->CurrentValue);
			$this->c->PlaceHolder = RemoveHtml($this->c->caption());

			// fuente
			$this->fuente->EditAttrs["class"] = "form-control";
			$this->fuente->EditCustomAttributes = "";
			if (!$this->fuente->Raw)
				$this->fuente->CurrentValue = HtmlDecode($this->fuente->CurrentValue);
			$this->fuente->EditValue = HtmlEncode($this->fuente->CurrentValue);
			$this->fuente->PlaceHolder = RemoveHtml($this->fuente->caption());

			// tiempo
			$this->tiempo->EditAttrs["class"] = "form-control";
			$this->tiempo->EditCustomAttributes = "";
			if (!$this->tiempo->Raw)
				$this->tiempo->CurrentValue = HtmlDecode($this->tiempo->CurrentValue);
			$this->tiempo->EditValue = HtmlEncode($this->tiempo->CurrentValue);
			$this->tiempo->PlaceHolder = RemoveHtml($this->tiempo->caption());

			// Add refer script
			// cod_casopreh

			$this->cod_casopreh->LinkCustomAttributes = "";
			$this->cod_casopreh->HrefValue = "";

			// trabajoparto
			$this->trabajoparto->LinkCustomAttributes = "";
			$this->trabajoparto->HrefValue = "";

			// sangradovaginal
			$this->sangradovaginal->LinkCustomAttributes = "";
			$this->sangradovaginal->HrefValue = "";

			// g
			$this->g->LinkCustomAttributes = "";
			$this->g->HrefValue = "";

			// p
			$this->p->LinkCustomAttributes = "";
			$this->p->HrefValue = "";

			// a
			$this->a->LinkCustomAttributes = "";
			$this->a->HrefValue = "";

			// n
			$this->n->LinkCustomAttributes = "";
			$this->n->HrefValue = "";

			// c
			$this->c->LinkCustomAttributes = "";
			$this->c->HrefValue = "";

			// fuente
			$this->fuente->LinkCustomAttributes = "";
			$this->fuente->HrefValue = "";

			// tiempo
			$this->tiempo->LinkCustomAttributes = "";
			$this->tiempo->HrefValue = "";
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
		if ($this->trabajoparto->Required) {
			if (!$this->trabajoparto->IsDetailKey && $this->trabajoparto->FormValue != NULL && $this->trabajoparto->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->trabajoparto->caption(), $this->trabajoparto->RequiredErrorMessage));
			}
		}
		if ($this->sangradovaginal->Required) {
			if (!$this->sangradovaginal->IsDetailKey && $this->sangradovaginal->FormValue != NULL && $this->sangradovaginal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sangradovaginal->caption(), $this->sangradovaginal->RequiredErrorMessage));
			}
		}
		if ($this->g->Required) {
			if (!$this->g->IsDetailKey && $this->g->FormValue != NULL && $this->g->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->g->caption(), $this->g->RequiredErrorMessage));
			}
		}
		if ($this->p->Required) {
			if (!$this->p->IsDetailKey && $this->p->FormValue != NULL && $this->p->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->p->caption(), $this->p->RequiredErrorMessage));
			}
		}
		if ($this->a->Required) {
			if (!$this->a->IsDetailKey && $this->a->FormValue != NULL && $this->a->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->a->caption(), $this->a->RequiredErrorMessage));
			}
		}
		if ($this->n->Required) {
			if (!$this->n->IsDetailKey && $this->n->FormValue != NULL && $this->n->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->n->caption(), $this->n->RequiredErrorMessage));
			}
		}
		if ($this->c->Required) {
			if (!$this->c->IsDetailKey && $this->c->FormValue != NULL && $this->c->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->c->caption(), $this->c->RequiredErrorMessage));
			}
		}
		if ($this->fuente->Required) {
			if (!$this->fuente->IsDetailKey && $this->fuente->FormValue != NULL && $this->fuente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fuente->caption(), $this->fuente->RequiredErrorMessage));
			}
		}
		if ($this->tiempo->Required) {
			if (!$this->tiempo->IsDetailKey && $this->tiempo->FormValue != NULL && $this->tiempo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tiempo->caption(), $this->tiempo->RequiredErrorMessage));
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

		// cod_casopreh
		$this->cod_casopreh->setDbValueDef($rsnew, $this->cod_casopreh->CurrentValue, NULL, FALSE);

		// trabajoparto
		$this->trabajoparto->setDbValueDef($rsnew, $this->trabajoparto->CurrentValue, NULL, FALSE);

		// sangradovaginal
		$this->sangradovaginal->setDbValueDef($rsnew, $this->sangradovaginal->CurrentValue, NULL, FALSE);

		// g
		$this->g->setDbValueDef($rsnew, $this->g->CurrentValue, NULL, FALSE);

		// p
		$this->p->setDbValueDef($rsnew, $this->p->CurrentValue, NULL, FALSE);

		// a
		$this->a->setDbValueDef($rsnew, $this->a->CurrentValue, NULL, FALSE);

		// n
		$this->n->setDbValueDef($rsnew, $this->n->CurrentValue, NULL, FALSE);

		// c
		$this->c->setDbValueDef($rsnew, $this->c->CurrentValue, NULL, FALSE);

		// fuente
		$this->fuente->setDbValueDef($rsnew, $this->fuente->CurrentValue, NULL, FALSE);

		// tiempo
		$this->tiempo->setDbValueDef($rsnew, $this->tiempo->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("obstetrico_registrolist.php"), "", $this->TableVar, TRUE);
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
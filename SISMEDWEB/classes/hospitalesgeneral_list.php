<?php
namespace PHPMaker2020\sismed911;

/**
 * Page class
 */
class hospitalesgeneral_list extends hospitalesgeneral
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{17BEB368-DB80-46DC-8EC5-730EB11B94E5}";

	// Table name
	public $TableName = 'hospitalesgeneral';

	// Page object name
	public $PageObjName = "hospitalesgeneral_list";

	// Grid form hidden field names
	public $FormName = "fhospitalesgenerallist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

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

		// Table object (hospitalesgeneral)
		if (!isset($GLOBALS["hospitalesgeneral"]) || get_class($GLOBALS["hospitalesgeneral"]) == PROJECT_NAMESPACE . "hospitalesgeneral") {
			$GLOBALS["hospitalesgeneral"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["hospitalesgeneral"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "hospitalesgeneraladd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "hospitalesgeneraldelete.php";
		$this->MultiUpdateUrl = "hospitalesgeneralupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fhospitalesgenerallistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canList()) {
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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup import options
		$this->setupImportOptions();
		$this->id_hospital->Visible = FALSE;
		$this->nombre_hospital->setVisibility();
		$this->depto_hospital->setVisibility();
		$this->provincia_hospital->setVisibility();
		$this->municipio_hospital->setVisibility();
		$this->nivel_hospital->setVisibility();
		$this->redservicions_hospital->Visible = FALSE;
		$this->sector_hospital->Visible = FALSE;
		$this->tipo_hospital->setVisibility();
		$this->camashab_cali->Visible = FALSE;
		$this->especialidad->setVisibility();
		$this->latitud_hospital->Visible = FALSE;
		$this->longitud_hospital->Visible = FALSE;
		$this->icon_hospital->Visible = FALSE;
		$this->codpolitico->setVisibility();
		$this->direccion->Visible = FALSE;
		$this->telefono->setVisibility();
		$this->nombre_responsable->setVisibility();
		$this->estado->Visible = FALSE;
		$this->emt->Visible = FALSE;
		$this->hideFieldsForAddEdit();

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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->depto_hospital);
		$this->setupLookupOptions($this->provincia_hospital);
		$this->setupLookupOptions($this->municipio_hospital);
		$this->setupLookupOptions($this->especialidad);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Process import
					if ($this->isImport()) {
						$this->import(Post(Config("API_FILE_TOKEN_NAME")));
						$this->terminate();
					}
				}
			}

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id_hospital->setOldValue($arKeyFlds[0]);
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->id_hospital->AdvancedSearch->toJson(), ","); // Field id_hospital
		$filterList = Concat($filterList, $this->nombre_hospital->AdvancedSearch->toJson(), ","); // Field nombre_hospital
		$filterList = Concat($filterList, $this->depto_hospital->AdvancedSearch->toJson(), ","); // Field depto_hospital
		$filterList = Concat($filterList, $this->provincia_hospital->AdvancedSearch->toJson(), ","); // Field provincia_hospital
		$filterList = Concat($filterList, $this->municipio_hospital->AdvancedSearch->toJson(), ","); // Field municipio_hospital
		$filterList = Concat($filterList, $this->nivel_hospital->AdvancedSearch->toJson(), ","); // Field nivel_hospital
		$filterList = Concat($filterList, $this->redservicions_hospital->AdvancedSearch->toJson(), ","); // Field redservicions_hospital
		$filterList = Concat($filterList, $this->sector_hospital->AdvancedSearch->toJson(), ","); // Field sector_hospital
		$filterList = Concat($filterList, $this->tipo_hospital->AdvancedSearch->toJson(), ","); // Field tipo_hospital
		$filterList = Concat($filterList, $this->camashab_cali->AdvancedSearch->toJson(), ","); // Field camashab_cali
		$filterList = Concat($filterList, $this->especialidad->AdvancedSearch->toJson(), ","); // Field especialidad
		$filterList = Concat($filterList, $this->latitud_hospital->AdvancedSearch->toJson(), ","); // Field latitud_hospital
		$filterList = Concat($filterList, $this->longitud_hospital->AdvancedSearch->toJson(), ","); // Field longitud_hospital
		$filterList = Concat($filterList, $this->icon_hospital->AdvancedSearch->toJson(), ","); // Field icon_hospital
		$filterList = Concat($filterList, $this->codpolitico->AdvancedSearch->toJson(), ","); // Field codpolitico
		$filterList = Concat($filterList, $this->direccion->AdvancedSearch->toJson(), ","); // Field direccion
		$filterList = Concat($filterList, $this->telefono->AdvancedSearch->toJson(), ","); // Field telefono
		$filterList = Concat($filterList, $this->nombre_responsable->AdvancedSearch->toJson(), ","); // Field nombre_responsable
		$filterList = Concat($filterList, $this->estado->AdvancedSearch->toJson(), ","); // Field estado
		$filterList = Concat($filterList, $this->emt->AdvancedSearch->toJson(), ","); // Field emt
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fhospitalesgenerallistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field id_hospital
		$this->id_hospital->AdvancedSearch->SearchValue = @$filter["x_id_hospital"];
		$this->id_hospital->AdvancedSearch->SearchOperator = @$filter["z_id_hospital"];
		$this->id_hospital->AdvancedSearch->SearchCondition = @$filter["v_id_hospital"];
		$this->id_hospital->AdvancedSearch->SearchValue2 = @$filter["y_id_hospital"];
		$this->id_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_id_hospital"];
		$this->id_hospital->AdvancedSearch->save();

		// Field nombre_hospital
		$this->nombre_hospital->AdvancedSearch->SearchValue = @$filter["x_nombre_hospital"];
		$this->nombre_hospital->AdvancedSearch->SearchOperator = @$filter["z_nombre_hospital"];
		$this->nombre_hospital->AdvancedSearch->SearchCondition = @$filter["v_nombre_hospital"];
		$this->nombre_hospital->AdvancedSearch->SearchValue2 = @$filter["y_nombre_hospital"];
		$this->nombre_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_nombre_hospital"];
		$this->nombre_hospital->AdvancedSearch->save();

		// Field depto_hospital
		$this->depto_hospital->AdvancedSearch->SearchValue = @$filter["x_depto_hospital"];
		$this->depto_hospital->AdvancedSearch->SearchOperator = @$filter["z_depto_hospital"];
		$this->depto_hospital->AdvancedSearch->SearchCondition = @$filter["v_depto_hospital"];
		$this->depto_hospital->AdvancedSearch->SearchValue2 = @$filter["y_depto_hospital"];
		$this->depto_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_depto_hospital"];
		$this->depto_hospital->AdvancedSearch->save();

		// Field provincia_hospital
		$this->provincia_hospital->AdvancedSearch->SearchValue = @$filter["x_provincia_hospital"];
		$this->provincia_hospital->AdvancedSearch->SearchOperator = @$filter["z_provincia_hospital"];
		$this->provincia_hospital->AdvancedSearch->SearchCondition = @$filter["v_provincia_hospital"];
		$this->provincia_hospital->AdvancedSearch->SearchValue2 = @$filter["y_provincia_hospital"];
		$this->provincia_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_provincia_hospital"];
		$this->provincia_hospital->AdvancedSearch->save();

		// Field municipio_hospital
		$this->municipio_hospital->AdvancedSearch->SearchValue = @$filter["x_municipio_hospital"];
		$this->municipio_hospital->AdvancedSearch->SearchOperator = @$filter["z_municipio_hospital"];
		$this->municipio_hospital->AdvancedSearch->SearchCondition = @$filter["v_municipio_hospital"];
		$this->municipio_hospital->AdvancedSearch->SearchValue2 = @$filter["y_municipio_hospital"];
		$this->municipio_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_municipio_hospital"];
		$this->municipio_hospital->AdvancedSearch->save();

		// Field nivel_hospital
		$this->nivel_hospital->AdvancedSearch->SearchValue = @$filter["x_nivel_hospital"];
		$this->nivel_hospital->AdvancedSearch->SearchOperator = @$filter["z_nivel_hospital"];
		$this->nivel_hospital->AdvancedSearch->SearchCondition = @$filter["v_nivel_hospital"];
		$this->nivel_hospital->AdvancedSearch->SearchValue2 = @$filter["y_nivel_hospital"];
		$this->nivel_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_nivel_hospital"];
		$this->nivel_hospital->AdvancedSearch->save();

		// Field redservicions_hospital
		$this->redservicions_hospital->AdvancedSearch->SearchValue = @$filter["x_redservicions_hospital"];
		$this->redservicions_hospital->AdvancedSearch->SearchOperator = @$filter["z_redservicions_hospital"];
		$this->redservicions_hospital->AdvancedSearch->SearchCondition = @$filter["v_redservicions_hospital"];
		$this->redservicions_hospital->AdvancedSearch->SearchValue2 = @$filter["y_redservicions_hospital"];
		$this->redservicions_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_redservicions_hospital"];
		$this->redservicions_hospital->AdvancedSearch->save();

		// Field sector_hospital
		$this->sector_hospital->AdvancedSearch->SearchValue = @$filter["x_sector_hospital"];
		$this->sector_hospital->AdvancedSearch->SearchOperator = @$filter["z_sector_hospital"];
		$this->sector_hospital->AdvancedSearch->SearchCondition = @$filter["v_sector_hospital"];
		$this->sector_hospital->AdvancedSearch->SearchValue2 = @$filter["y_sector_hospital"];
		$this->sector_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_sector_hospital"];
		$this->sector_hospital->AdvancedSearch->save();

		// Field tipo_hospital
		$this->tipo_hospital->AdvancedSearch->SearchValue = @$filter["x_tipo_hospital"];
		$this->tipo_hospital->AdvancedSearch->SearchOperator = @$filter["z_tipo_hospital"];
		$this->tipo_hospital->AdvancedSearch->SearchCondition = @$filter["v_tipo_hospital"];
		$this->tipo_hospital->AdvancedSearch->SearchValue2 = @$filter["y_tipo_hospital"];
		$this->tipo_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_tipo_hospital"];
		$this->tipo_hospital->AdvancedSearch->save();

		// Field camashab_cali
		$this->camashab_cali->AdvancedSearch->SearchValue = @$filter["x_camashab_cali"];
		$this->camashab_cali->AdvancedSearch->SearchOperator = @$filter["z_camashab_cali"];
		$this->camashab_cali->AdvancedSearch->SearchCondition = @$filter["v_camashab_cali"];
		$this->camashab_cali->AdvancedSearch->SearchValue2 = @$filter["y_camashab_cali"];
		$this->camashab_cali->AdvancedSearch->SearchOperator2 = @$filter["w_camashab_cali"];
		$this->camashab_cali->AdvancedSearch->save();

		// Field especialidad
		$this->especialidad->AdvancedSearch->SearchValue = @$filter["x_especialidad"];
		$this->especialidad->AdvancedSearch->SearchOperator = @$filter["z_especialidad"];
		$this->especialidad->AdvancedSearch->SearchCondition = @$filter["v_especialidad"];
		$this->especialidad->AdvancedSearch->SearchValue2 = @$filter["y_especialidad"];
		$this->especialidad->AdvancedSearch->SearchOperator2 = @$filter["w_especialidad"];
		$this->especialidad->AdvancedSearch->save();

		// Field latitud_hospital
		$this->latitud_hospital->AdvancedSearch->SearchValue = @$filter["x_latitud_hospital"];
		$this->latitud_hospital->AdvancedSearch->SearchOperator = @$filter["z_latitud_hospital"];
		$this->latitud_hospital->AdvancedSearch->SearchCondition = @$filter["v_latitud_hospital"];
		$this->latitud_hospital->AdvancedSearch->SearchValue2 = @$filter["y_latitud_hospital"];
		$this->latitud_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_latitud_hospital"];
		$this->latitud_hospital->AdvancedSearch->save();

		// Field longitud_hospital
		$this->longitud_hospital->AdvancedSearch->SearchValue = @$filter["x_longitud_hospital"];
		$this->longitud_hospital->AdvancedSearch->SearchOperator = @$filter["z_longitud_hospital"];
		$this->longitud_hospital->AdvancedSearch->SearchCondition = @$filter["v_longitud_hospital"];
		$this->longitud_hospital->AdvancedSearch->SearchValue2 = @$filter["y_longitud_hospital"];
		$this->longitud_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_longitud_hospital"];
		$this->longitud_hospital->AdvancedSearch->save();

		// Field icon_hospital
		$this->icon_hospital->AdvancedSearch->SearchValue = @$filter["x_icon_hospital"];
		$this->icon_hospital->AdvancedSearch->SearchOperator = @$filter["z_icon_hospital"];
		$this->icon_hospital->AdvancedSearch->SearchCondition = @$filter["v_icon_hospital"];
		$this->icon_hospital->AdvancedSearch->SearchValue2 = @$filter["y_icon_hospital"];
		$this->icon_hospital->AdvancedSearch->SearchOperator2 = @$filter["w_icon_hospital"];
		$this->icon_hospital->AdvancedSearch->save();

		// Field codpolitico
		$this->codpolitico->AdvancedSearch->SearchValue = @$filter["x_codpolitico"];
		$this->codpolitico->AdvancedSearch->SearchOperator = @$filter["z_codpolitico"];
		$this->codpolitico->AdvancedSearch->SearchCondition = @$filter["v_codpolitico"];
		$this->codpolitico->AdvancedSearch->SearchValue2 = @$filter["y_codpolitico"];
		$this->codpolitico->AdvancedSearch->SearchOperator2 = @$filter["w_codpolitico"];
		$this->codpolitico->AdvancedSearch->save();

		// Field direccion
		$this->direccion->AdvancedSearch->SearchValue = @$filter["x_direccion"];
		$this->direccion->AdvancedSearch->SearchOperator = @$filter["z_direccion"];
		$this->direccion->AdvancedSearch->SearchCondition = @$filter["v_direccion"];
		$this->direccion->AdvancedSearch->SearchValue2 = @$filter["y_direccion"];
		$this->direccion->AdvancedSearch->SearchOperator2 = @$filter["w_direccion"];
		$this->direccion->AdvancedSearch->save();

		// Field telefono
		$this->telefono->AdvancedSearch->SearchValue = @$filter["x_telefono"];
		$this->telefono->AdvancedSearch->SearchOperator = @$filter["z_telefono"];
		$this->telefono->AdvancedSearch->SearchCondition = @$filter["v_telefono"];
		$this->telefono->AdvancedSearch->SearchValue2 = @$filter["y_telefono"];
		$this->telefono->AdvancedSearch->SearchOperator2 = @$filter["w_telefono"];
		$this->telefono->AdvancedSearch->save();

		// Field nombre_responsable
		$this->nombre_responsable->AdvancedSearch->SearchValue = @$filter["x_nombre_responsable"];
		$this->nombre_responsable->AdvancedSearch->SearchOperator = @$filter["z_nombre_responsable"];
		$this->nombre_responsable->AdvancedSearch->SearchCondition = @$filter["v_nombre_responsable"];
		$this->nombre_responsable->AdvancedSearch->SearchValue2 = @$filter["y_nombre_responsable"];
		$this->nombre_responsable->AdvancedSearch->SearchOperator2 = @$filter["w_nombre_responsable"];
		$this->nombre_responsable->AdvancedSearch->save();

		// Field estado
		$this->estado->AdvancedSearch->SearchValue = @$filter["x_estado"];
		$this->estado->AdvancedSearch->SearchOperator = @$filter["z_estado"];
		$this->estado->AdvancedSearch->SearchCondition = @$filter["v_estado"];
		$this->estado->AdvancedSearch->SearchValue2 = @$filter["y_estado"];
		$this->estado->AdvancedSearch->SearchOperator2 = @$filter["w_estado"];
		$this->estado->AdvancedSearch->save();

		// Field emt
		$this->emt->AdvancedSearch->SearchValue = @$filter["x_emt"];
		$this->emt->AdvancedSearch->SearchOperator = @$filter["z_emt"];
		$this->emt->AdvancedSearch->SearchCondition = @$filter["v_emt"];
		$this->emt->AdvancedSearch->SearchValue2 = @$filter["y_emt"];
		$this->emt->AdvancedSearch->SearchOperator2 = @$filter["w_emt"];
		$this->emt->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->id_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nombre_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->depto_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->provincia_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->municipio_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nivel_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->redservicions_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->sector_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->tipo_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->camashab_cali, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->latitud_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->longitud_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->icon_hospital, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->codpolitico, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direccion, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->telefono, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nombre_responsable, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->nombre_hospital); // nombre_hospital
			$this->updateSort($this->depto_hospital); // depto_hospital
			$this->updateSort($this->provincia_hospital); // provincia_hospital
			$this->updateSort($this->municipio_hospital); // municipio_hospital
			$this->updateSort($this->nivel_hospital); // nivel_hospital
			$this->updateSort($this->tipo_hospital); // tipo_hospital
			$this->updateSort($this->especialidad); // especialidad
			$this->updateSort($this->codpolitico); // codpolitico
			$this->updateSort($this->telefono); // telefono
			$this->updateSort($this->nombre_responsable); // nombre_responsable
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->nombre_hospital->setSort("");
				$this->depto_hospital->setSort("");
				$this->provincia_hospital->setSort("");
				$this->municipio_hospital->setSort("");
				$this->nivel_hospital->setSort("");
				$this->tipo_hospital->setSort("");
				$this->especialidad->setSort("");
				$this->codpolitico->setSort("");
				$this->telefono->setSort("");
				$this->nombre_responsable->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = FALSE;

		// "detail_camas_hospital"
		$item = &$this->ListOptions->add("detail_camas_hospital");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'camas_hospital') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["camas_hospital_grid"]))
			$GLOBALS["camas_hospital_grid"] = new camas_hospital_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = FALSE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("camas_hospital");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"hospitalesgeneral\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_camas_hospital"
		$opt = $this->ListOptions["detail_camas_hospital"];
		if ($Security->allowList(CurrentProjectID() . 'camas_hospital')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("camas_hospital", "TblCaption");
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("camas_hospitallist.php?" . Config("TABLE_SHOW_MASTER") . "=hospitalesgeneral&fk_id_hospital=" . urlencode(strval($this->id_hospital->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["camas_hospital_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'hospitalesgeneral')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=camas_hospital");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "camas_hospital";
			}
			if ($GLOBALS["camas_hospital_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'hospitalesgeneral')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=camas_hospital");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "camas_hospital";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = $this->ListOptions["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id_hospital->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		if (IsMobile())
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"hospitalesgeneral\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_camas_hospital");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=camas_hospital");
		if (!isset($GLOBALS["camas_hospital"]))
			$GLOBALS["camas_hospital"] = new camas_hospital();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["camas_hospital"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["camas_hospital"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'hospitalesgeneral') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "camas_hospital";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = $detailTableLink != "" && $Security->canAdd();

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = $option["detailadd_" . $ar[$i]])
					$item->Visible = FALSE;
			}
		}
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fhospitalesgenerallistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fhospitalesgenerallistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fhospitalesgenerallist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$row = [];
		$row['id_hospital'] = NULL;
		$row['nombre_hospital'] = NULL;
		$row['depto_hospital'] = NULL;
		$row['provincia_hospital'] = NULL;
		$row['municipio_hospital'] = NULL;
		$row['nivel_hospital'] = NULL;
		$row['redservicions_hospital'] = NULL;
		$row['sector_hospital'] = NULL;
		$row['tipo_hospital'] = NULL;
		$row['camashab_cali'] = NULL;
		$row['especialidad'] = NULL;
		$row['latitud_hospital'] = NULL;
		$row['longitud_hospital'] = NULL;
		$row['icon_hospital'] = NULL;
		$row['codpolitico'] = NULL;
		$row['direccion'] = NULL;
		$row['telefono'] = NULL;
		$row['nombre_responsable'] = NULL;
		$row['estado'] = NULL;
		$row['emt'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_hospital")) != "")
			$this->id_hospital->OldValue = $this->getKey("id_hospital"); // id_hospital
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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

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

			// tipo_hospital
			$this->tipo_hospital->LinkCustomAttributes = "";
			$this->tipo_hospital->HrefValue = "";
			$this->tipo_hospital->TooltipValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";
			$this->especialidad->TooltipValue = "";

			// codpolitico
			$this->codpolitico->LinkCustomAttributes = "";
			$this->codpolitico->HrefValue = "";
			$this->codpolitico->TooltipValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";
			$this->telefono->TooltipValue = "";

			// nombre_responsable
			$this->nombre_responsable->LinkCustomAttributes = "";
			$this->nombre_responsable->HrefValue = "";
			$this->nombre_responsable->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	/**
	 * Import file
	 *
	 * @param string $filetoken File token to locate the uploaded import file
	 * @return boolean
	 */
	public function import($filetoken)
	{
		global $Security, $Language;
		if (!$Security->canImport())
			return FALSE; // Import not allowed

		// Check if valid token
		if (EmptyValue($filetoken))
			return FALSE;

		// Get uploaded files by token
		$upload = new HttpUpload();
		$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $upload->getUploadedFileName($filetoken, TRUE));
		$exts = explode(",", Config("IMPORT_FILE_ALLOWED_EXT"));
		$totCnt = 0;
		$totSuccessCnt = 0;
		$totFailCnt = 0;
		$result = [Config("API_FILE_TOKEN_NAME") => $filetoken, "files" => [], "success" => FALSE];

		// Import records
		foreach ($files as $file) {
			$res = [Config("API_FILE_TOKEN_NAME") => $filetoken, "file" => basename($file)];
			$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

			// Ignore log file
			if ($ext == "txt")
				continue;
			if (!in_array($ext, $exts)) {
				$res = array_merge($res, ["error" => str_replace("%e", $ext, $Language->phrase("ImportMessageInvalidFileExtension"))]);
				WriteJson($res);
				return FALSE;
			}

			// Set up options for Page Importing event
			// Get optional data from $_POST first

			$ar = array_keys($_POST);
			$options = [];
			foreach ($ar as $key) {
				if (!in_array($key, ["action", Config("TOKEN_NAME"), "filetoken"]))
					$options[$key] = $_POST[$key];
			}

			// Merge default options
			$options = array_merge(["maxExecutionTime" => $this->ImportMaxExecutionTime, "file" => $file, "activeSheet" => 0, "headerRowNumber" => 0, "headers" => [], "offset" => 0, "limit" => 0], $options);
			if ($ext == "csv")
				$options = array_merge(["inputEncoding" => $this->ImportCsvEncoding, "delimiter" => $this->ImportCsvDelimiter, "enclosure" => $this->ImportCsvQuoteCharacter], $options);
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($ext));

			// Call Page Importing server event
			if (!$this->Page_Importing($reader, $options)) {
				WriteJson($res);
				return FALSE;
			}

			// Set max execution time
			if ($options["maxExecutionTime"] > 0)
				ini_set("max_execution_time", $options["maxExecutionTime"]);
			try {
				if ($ext == "csv") {
					if ($options["inputEncoding"] != '')
						$reader->setInputEncoding($options["inputEncoding"]);
					if ($options["delimiter"] != '')
						$reader->setDelimiter($options["delimiter"]);
					if ($options["enclosure"] != '')
						$reader->setEnclosure($options["enclosure"]);
				}
				$spreadsheet = @$reader->load($file);
			} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
				$res = array_merge($res, ["error" => $e->getMessage()]);
				WriteJson($res);
				return FALSE;
			}

			// Get active worksheet
			$spreadsheet->setActiveSheetIndex($options["activeSheet"]);
			$worksheet = $spreadsheet->getActiveSheet();

			// Get row and column indexes
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

			// Get column headers
			$headers = $options["headers"];
			$headerRow = 0;
			if (count($headers) == 0) { // Undetermined, load from header row
				$headerRow = $options["headerRowNumber"] + 1;
				$headers = $this->getImportHeaders($worksheet, $headerRow, $highestColumn);
			}
			if (count($headers) == 0) { // Unable to load header
				$res["error"] = $Language->phrase("ImportMessageNoHeaderRow");
				WriteJson($res);
				return FALSE;
			}
			foreach ($headers as $name) {
				if (!array_key_exists($name, $this->fields)) { // Unidentified field, not header row
					$res["error"] = str_replace('%f', $name, $Language->phrase("ImportMessageInvalidFieldName"));
					WriteJson($res);
					return FALSE;
				}
			}
			$startRow = $headerRow + 1;
			$endRow = $highestRow;
			if ($options["offset"] > 0)
				$startRow += $options["offset"];
			if ($options["limit"] > 0) {
				$endRow = $startRow + $options["limit"] - 1;
				if ($endRow > $highestRow)
					$endRow = $highestRow;
			}
			if ($endRow >= $startRow)
				$records = $this->getImportRecords($worksheet, $startRow, $endRow, $highestColumn);
			else
				$records = [];
			$recordCnt = count($records);
			$cnt = 0;
			$successCnt = 0;
			$failCnt = 0;
			$failList = [];
			$relLogFile = IncludeTrailingDelimiter(UploadPath(FALSE) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $filetoken, FALSE) . $filetoken . ".txt";
			$res = array_merge($res, ["totalCount" => $recordCnt, "count" => $cnt, "successCount" => $successCnt, "failCount" => 0]);

			// Begin transaction
			if ($this->ImportUseTransaction) {
				$conn = $this->getConnection();
				$conn->beginTrans();
			}

			// Process records
			foreach ($records as $values) {
				$importSuccess = FALSE;
				try {
					$row = array_combine($headers, $values);
					$cnt++;
					$res["count"] = $cnt;
					if ($this->importRow($row, $cnt)) {
						$successCnt++;
						$importSuccess = TRUE;
					} else {
						$failCnt++;
						$failList["row" . $cnt] = $this->getFailureMessage();
						$this->clearFailureMessage(); // Clear error message
					}
				} catch (Exception $e) {
					$failCnt++;
					if ($failList["row" . $cnt] == "")
						$failList["row" . $cnt] = $e->getMessage();
				}

				// Reset count if import fail + use transaction
				if (!$importSuccess && $this->ImportUseTransaction) {
					$successCnt = 0;
					$failCnt = $cnt;
				}

				// Save progress to cache
				$res["successCount"] = $successCnt;
				$res["failCount"] = $failCnt;
				SetCache($filetoken, $res);

				// No need to process further if import fail + use transaction
				if (!$importSuccess && $this->ImportUseTransaction)
					break;
			}
			$res["failList"] = $failList;

			// Commit/Rollback transaction
			if ($this->ImportUseTransaction) {
				$conn = $this->getConnection();
				if ($failCnt > 0) // Rollback
					$conn->rollbackTrans();
				else // Commit
					$conn->commitTrans();
			}
			$totCnt += $cnt;
			$totSuccessCnt += $successCnt;
			$totFailCnt += $failCnt;

			// Call Page Imported server event
			$this->Page_Imported($reader, $res);
			if ($totCnt > 0 && $totFailCnt == 0) { // Clean up if all records imported
				$res["success"] = TRUE;
				$result["success"] = TRUE;
			} else {
				$res["log"] = $relLogFile;
				$result["success"] = FALSE;
			}
			$result["files"][] = $res;
		}
		if ($result["success"])
			CleanUploadTempPaths($filetoken);
		WriteJson($result);
		return $result["success"];
	}

	/**
	 * Get import header
	 *
	 * @param object $ws PhpSpreadsheet worksheet
	 * @param integer $rowIdx Row index for header row (1-based)
	 * @param string $endColName End column Name (e.g. "F")
	 * @return array
	 */
	protected function getImportHeaders($ws, $rowIdx, $endColName) {
		$ar = $ws->rangeToArray("A" . $rowIdx . ":" . $endColName . $rowIdx);
		return $ar[0];
	}

	/**
	 * Get import records
	 *
	 * @param object $ws PhpSpreadsheet worksheet
	 * @param integer $startRowIdx Start row index
	 * @param integer $endRowIdx End row index
	 * @param string $endColName End column Name (e.g. "F")
	 * @return array
	 */
	protected function getImportRecords($ws, $startRowIdx, $endRowIdx, $endColName) {
		$ar = $ws->rangeToArray("A" . $startRowIdx . ":" . $endColName . $endRowIdx);
		return $ar;
	}

	/**
	 * Import a row
	 *
	 * @param array $row
	 * @param integer $cnt
	 * @return boolean
	 */
	protected function importRow($row, $cnt)
	{
		global $Language;

		// Call Row Import server event
		if (!$this->Row_Import($row, $cnt))
			return FALSE;

		// Check field values
		foreach ($row as $name => $value) {
			$fld = $this->fields[$name];
			if (!$this->checkValue($fld, $value)) {
				$this->setFailureMessage(str_replace(["%f", "%v"], [$fld->Name, $value], $Language->phrase("ImportMessageInvalidFieldValue")));
				return FALSE;
			}
		}

		// Insert/Update to database
		if (!$this->ImportInsertOnly && $oldrow = $this->load($row)) {
			$res = $this->update($row, "", $oldrow);
		} else {
			$res = $this->insert($row);
		}
		return $res;
	}

	/**
	 * Check field value
	 *
	 * @param object $fld Field object
	 * @param object $value
	 * @return boolean
	 */
	protected function checkValue($fld, $value)
	{
		if ($fld->DataType == DATATYPE_NUMBER && !is_numeric($value))
			return FALSE;
		elseif ($fld->DataType == DATATYPE_DATE && !CheckDate($value))
			return FALSE;
		return TRUE;
	}

	// Load row
	protected function load($row)
	{
		$filter = $this->getRecordFilter($row);
		if (!$filter)
			return NULL;
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF)
			return $rs->fields;
		else
			return NULL;
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fhospitalesgenerallistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	// Set up import options
	protected function setupImportOptions()
	{
		global $Security, $Language;

		// Import
		$item = &$this->ImportOptions->add("import");
		$item->Body = "<a class=\"ew-import-link ew-import\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("ImportText") . "\" data-caption=\"" . $Language->phrase("ImportText") . "\" onclick=\"return ew.importDialogShow({lnk:this,hdr:ew.language.phrase('ImportText')});\">" . $Language->phrase("Import") . "</a>";
		$item->Visible = $Security->canImport();
		$this->ImportOptions->UseButtonGroup = TRUE;
		$this->ImportOptions->UseDropDownButton = FALSE;
		$this->ImportOptions->DropDownButtonPhrase = $Language->phrase("ButtonImport");

		// Add group option item
		$item = &$this->ImportOptions->add($this->ImportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {
		$camasRep = "Reported Beds";
		$camasAdd = "Add Beds";

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

		$this->ListOptions->Items["detail_camas_hospital"]->Visible = FALSE;
		$camas = ExecuteScalar("SELECT count(*) FROM camas_hospital where id_hospital = '".$this->id_hospital->CurrentValue."';");
		if ($camas <> 0){

			// si tiene camas asignada
			$this->ListOptions->Items["delete"]->Body = "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"".$camasRep."\" data-table=\"interh_seguimiento\" data-caption=\"<img src='images/icon/028-head.png' width='40' height='45'></br>".$camasRep."\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'camas_hospitaledit.php?id_hospital=".$this->id_hospital->CurrentValue."&showmaster=hospitalesgeneral&fk_id_hospital=".$this->id_hospital->CurrentValue."'});\" data-original-title=\"".$camasRep."\"><img src=\"images/icon/hospitalidad.png\" width=\"25\" height=\"27\"></a>";
		}else{ 

			//si no tiene camas asignadas:
	$this->ListOptions->Items["delete"]->Body = "<a class=\"btn btn-default ew-add-edit ew-add\" title=\"".$camasAdd."\" data-table=\"interh_seguimiento\" data-caption=\"<img src='images/icon/bed_red.png' width='40' height='45'></br>".$camasAdd."\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'camas_hospitaladd.php?showmaster=hospitalesgeneral&fk_id_hospital=".$this->id_hospital->CurrentValue."'});\" data-original-title=\"".$camasAdd."\"><img src=\"images/icon/hospitalidadred.png\" width=\"25\" height=\"27\"></a>";
		} //if
	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>
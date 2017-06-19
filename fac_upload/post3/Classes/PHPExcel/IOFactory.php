<?php
if (!defined('PHPEXCEL_ROOT')) {
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../');
	require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

class PHPExcel_IOFactory
{
	private static $_searchLocations = array(
		array( 'type' => 'IWriter', 'path' => 'PHPExcel/Writer/{0}.php', 'class' => 'PHPExcel_Writer_{0}' ),
		array( 'type' => 'IReader', 'path' => 'PHPExcel/Reader/{0}.php', 'class' => 'PHPExcel_Reader_{0}' )
	);
	private static $_autoResolveClasses = array(
		'Excel2007',
		'Excel5',
		'Excel2003XML',
		'OOCalc',
		'SYLK',
		'Gnumeric',
		'HTML',
		'CSV',
	);

    private function __construct() { }

	public static function getSearchLocations() {
		return self::$_searchLocations;
	}	//	function getSearchLocations()
	public static function setSearchLocations($value) {
		if (is_array($value)) {
			self::$_searchLocations = $value;
		} else {
			throw new PHPExcel_Reader_Exception('Invalid parameter passed.');
		}
	}	//	function setSearchLocations()

	public static function addSearchLocation($type = '', $location = '', $classname = '') {
		self::$_searchLocations[] = array( 'type' => $type, 'path' => $location, 'class' => $classname );
	}	//	function addSearchLocation()

	public static function createWriter(PHPExcel $phpExcel, $writerType = '') {
		$searchType = 'IWriter';

		foreach (self::$_searchLocations as $searchLocation) {
			if ($searchLocation['type'] == $searchType) {
				$className = str_replace('{0}', $writerType, $searchLocation['class']);

				$instance = new $className($phpExcel);
				if ($instance !== NULL) {
					return $instance;
				}
			}
		}

		// Nothing found...
		throw new PHPExcel_Reader_Exception("No $searchType found for type $writerType");
	}	//	function createWriter()
	public static function createReader($readerType = '') {
		// Search type
		$searchType = 'IReader';

		// Include class
		foreach (self::$_searchLocations as $searchLocation) {
			if ($searchLocation['type'] == $searchType) {
				$className = str_replace('{0}', $readerType, $searchLocation['class']);

				$instance = new $className();
				if ($instance !== NULL) {
					return $instance;
				}
			}
		}

		// Nothing found...
		throw new PHPExcel_Reader_Exception("No $searchType found for type $readerType");
	}	//	function createReader()
	public static function load($pFilename) {
		$reader = self::createReaderForFile($pFilename);
		return $reader->load($pFilename);
	}	//	function load()
	public static function identify($pFilename) {
		$reader = self::createReaderForFile($pFilename);
		$className = get_class($reader);
		$classType = explode('_',$className);
		unset($reader);
		return array_pop($classType);
	}	//	function identify()
	public static function createReaderForFile($pFilename) {

		// First, lucky guess by inspecting file extension
		$pathinfo = pathinfo($pFilename);

		$extensionType = NULL;
		if (isset($pathinfo['extension'])) {
			switch (strtolower($pathinfo['extension'])) {
				case 'xlsx':			//	Excel (OfficeOpenXML) Spreadsheet
				case 'xlsm':			//	Excel (OfficeOpenXML) Macro Spreadsheet (macros will be discarded)
				case 'xltx':			//	Excel (OfficeOpenXML) Template
				case 'xltm':			//	Excel (OfficeOpenXML) Macro Template (macros will be discarded)
					$extensionType = 'Excel2007';
					break;
				case 'xls':				//	Excel (BIFF) Spreadsheet
				case 'xlt':				//	Excel (BIFF) Template
					$extensionType = 'Excel5';
					break;
				case 'ods':				//	Open/Libre Offic Calc
				case 'ots':				//	Open/Libre Offic Calc Template
					$extensionType = 'OOCalc';
					break;
				case 'slk':
					$extensionType = 'SYLK';
					break;
				case 'xml':				//	Excel 2003 SpreadSheetML
					$extensionType = 'Excel2003XML';
					break;
				case 'gnumeric':
					$extensionType = 'Gnumeric';
					break;
				case 'htm':
				case 'html':
					$extensionType = 'HTML';
					break;
				case 'csv':
					// Do nothing
					// We must not try to use CSV reader since it loads
					// all files including Excel files etc.
					break;
				default:
					break;
			}

			if ($extensionType !== NULL) {
				$reader = self::createReader($extensionType);
				// Let's see if we are lucky
				if (isset($reader) && $reader->canRead($pFilename)) {
					return $reader;
				}
			}
		}

		// If we reach here then "lucky guess" didn't give any result
		// Try walking through all the options in self::$_autoResolveClasses
		foreach (self::$_autoResolveClasses as $autoResolveClass) {
			//	Ignore our original guess, we know that won't work
			if ($autoResolveClass !== $extensionType) {
				$reader = self::createReader($autoResolveClass);
				if ($reader->canRead($pFilename)) {
					return $reader;
				}
			}
		}

		throw new PHPExcel_Reader_Exception('Unable to identify a reader for this file');
	}	//	function createReaderForFile()
}

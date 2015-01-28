<?php

namespace CSF\Modules;

/**
 * Auto Loader - Club Systems Framework
 * Do NOT modify
 *
 * Usage: require_once("./CS-Framework/AutoLoader.Class.php");
 *		  $auto = new AutoLoader();
 *		  $auto->register();
 * 
 * Copyright Club Systems 2015
 * @author Joseph Kasavage
 */

class AutoLoader
{
	private $_ext = '.Class.php';
	private $_namespace = 'CSF\Modules';
	private $_path = '/CS-Framework/';
	private $_seperator = '\\';
	private $_classes = array(
								"Config",
								"Data",
								"Exceptions",
								"Forms",
								"Validate"
							);

	/**
	 * Get Extension
	 * 
	 * @return String
	 */
	public function getExt()
	{
		return $this->_ext;
	}

	/**
	 * Change Extension
	 *
	 * @param String $ext
	 * 
	 * @return Void
	 */
	public function setExt($ext)
	{
		$this->_ext = $ext;
	}

	/**
	 * Get Namespace
	 * 
	 * @return String
	 */
	public function getNamespace()
	{
		return $this->_namespace;
	}

	/**
	 * Change Namespace
	 * 
	 * @param String $ns
	 *
	 * @return Void
	 */
	public function setNamespace($ns)
	{
		$this->_namespace = $ns;
	}

	/**
	 * Get Path
	 * 
	 * @return String
	 */
	public function getPath()
	{
		return $this->_path;
	}

	/**
	 * Set Path
	 * 
	 * @param String $path
	 *
	 * @return String
	 */
	public function setPath($path)
	{
		$this->_path = $path;
	}

	/**
	 * Register Method for Autoloading
	 * 
	 * @return Void
	 */
	public function register()
	{
		spl_autoload_register(array($this, 'load'));
	}

	/**
	 * Load needed Classes
	 * 
	 * @param String $className
	 * 
	 * @return Void
	 */
	public function load($className)
	{
		$class = substr($className, strlen($this->_namespace.$this->_seperator), strlen($className));
		$file = $this->_path . $class . $this->_ext;

		if(in_array($class, $this->_classes)) {
			require($file);
		} else {
			return false;
		}
	}
}
<?php
/**
 * @version 	$Id: component.php 2725 2010-10-28 01:54:08Z johanjanssens $
 * @category	Koowa
 * @package		Koowa_Loader
 * @subpackage 	Adapter
 * @copyright	Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 */

/**
 * Loader Adapter for a component
 *
 * @author		Johan Janssens <johan@nooku.org>
 * @category	Koowa
 * @package     Koowa_Loader
 * @subpackage 	Adapter
 * @uses		KInflector
 */
class KLoaderAdapterComponent extends KLoaderAdapterAbstract
{
	/**
	 * The basepath 
	 * 
	 * @var string
	 */
	protected $_basepath = JPATH_BASE;
	
	/**
	 * The prefix
	 * 
	 * @var string
	 */
	protected $_prefix = 'Com';
	
	
	/**
	 * Get the class prefix
	 *
	 * @return string	Returns the class prefix
	 */
	public function getPrefix()
	{
		return $this->_prefix;
	}
	
	/**
	 * Get the path based on a class name
	 *
	 * @param  string		  	The class name 
	 * @return string|false		Returns the path on success FALSE on failure
	 */
	protected function _pathFromClassname($classname)
	{
		$path = false; 
		
		if (strpos($classname, $this->_prefix) === 0) 
		{
			$word  = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $classname));
			$parts = explode('_', $word);
			
			if (array_shift($parts) == 'com') 
			{
				$component = 'com_'.strtolower(array_shift($parts));
				$file 	   = array_pop($parts);
				
				if(count($parts)) 
				{
					foreach($parts as $key => $value) {
						$parts[$key] = KInflector::pluralize($value);
					}
					
					$path = implode('/', $parts);
					$path = $path.'/'.$file;
				} 
				else $path = $file;
			
				$path = $this->_basepath.'/components/'.$component.'/'.$path.'.php';
			}
		}
		
		return $path;
	}

	/**
	 * Get the path based on an identifier
	 *
	 * @param  object  			An Identifier object - [application::]com.component.view.[.path].name
	 * @return string|false		Returns the path on success FALSE on failure
	 */
	protected function _pathFromIdentifier($identifier)
	{
		$path = false;
		
		if($identifier->type == 'com')
		{
			$parts = $identifier->path;
				
			$component = 'com_'.strtolower($identifier->package);
			
			//Store the basepath for re-use
			$this->_setBasePath($identifier);

			if(!empty($identifier->name))
			{
				if(count($parts)) 
				{
					$path    = KInflector::pluralize(array_shift($parts));
					$path   .= count($parts) ? '/'.implode('/', $parts) : '';
					$path   .= '/'.strtolower($identifier->name);	
				} 
				else $path  = strtolower($identifier->name);	
			}
				
			$path = $this->_basepath.'/components/'.$component.'/'.$path.'.php';
		}	
		
		return $path;
	}
		
	/**
	 * Set the base path
	 *
	 * @param  object  	The class name or an identifier
	 */
	protected function _setBasePath($identifier)
	{
		if(!$app = $identifier->application) 
		{
			$app = KFactory::get('lib.koowa.application')->getName();
			
			//Add shortcuts
			$app = ($app == 'administrator') ? 'admin' : $app;
		}
		
		switch($app)
		{
			case 'admin' : $this->_basepath = JPATH_ADMINISTRATOR; break;
			case 'site'  : $this->_basepath = JPATH_SITE;			break;
 		}
		
		return $this;
	}
}
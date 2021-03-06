<?php
/**
 * @version		$Id: interface.php 2725 2010-10-28 01:54:08Z johanjanssens $
 * @category	Koowa
 * @package		Koowa_Command
 * @copyright	Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link     	http://www.nooku.org
 */

/**
 * Command Interface 
 *
 * @author		Johan Janssens <johan@nooku.org>
 * @category	Koowa
 * @package     Koowa_Command
 */
interface KCommandInterface
{
	/**
	 * Generic Command handler
	 * 
	 * @param 	string 	The command name
	 * @param 	object  The command context
	 * @return	boolean
	 */
	public function execute( $name, KCommandContext $context);
	
	/**
	 * Get an object handle
	 * 
	 * This function returns an unique identifier for the object. This id can be used as 
	 * a hash key for storing objects or for identifying an object
	 * 
	 * Override this function to implement implement dynamic commands. If you don't want
	 * the command to be enqueued in a chain return NULL instead of a valid handle.
	 * 
	 * @return string A string that is unique, or NULL
	 */
	public function getHandle();
	
	/**
	 * Get the priority of the command
	 *
	 * @return	integer The command priority
	 */
  	public function getPriority();
}

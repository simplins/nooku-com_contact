<?php
/**
* @version      $Id: read.php 2725 2010-10-28 01:54:08Z johanjanssens $
* @category		Koowa
* @package      Koowa_Template
* @subpackage	Filter
* @copyright    Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
* @license      GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
* @link 		http://www.nooku.org
*/

/**
 * Template Write Filter Interface
 *
 * Processes the template on input
 *
 * @author		Johan Janssens <johan@nooku.org>
 * @category	Koowa
 * @package     Koowa_Template
 * @subpackage	Filter 
 */
interface KTemplateFilterRead
{
	/**
	 * Parse the text and filter it
	 *
	 * @param string Block of text to parse
	 * @return KTemplateFilterRead
	 */
	public function read(&$text);
}
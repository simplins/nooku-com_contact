<?php
/**
* @version      $Id: new.php 2725 2010-10-28 01:54:08Z johanjanssens $
* @category		Koowa
* @package		Koowa_Toolbar
* @subpackage	Button
* @copyright    Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
* @license      GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
*/

/**
 * New button class for a toolbar
 * 
 * @author		Johan Janssens <johan@nooku.org>
 * @category	Koowa
 * @package		Koowa_Toolbar
 * @subpackage	Button
 */
class KToolbarButtonNew extends KToolbarButtonAbstract
{
	public function getLink()
	{
		$option = KRequest::get('get.option', 'cmd');
		$view	= KInflector::singularize(KRequest::get('get.view', 'cmd'));
		return 'index.php?option='.$option.'&view='.$view;
	}
}
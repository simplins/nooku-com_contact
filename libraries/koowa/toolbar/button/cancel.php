<?php
/**
* @version      $Id: cancel.php 2725 2010-10-28 01:54:08Z johanjanssens $
* @category		Koowa
* @package		Koowa_Toolbar
* @subpackage	Button
* @copyright    Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
* @license      GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
*/

/**
 * Cancel button class for a toolbar
 *
 * @author		Johan Janssens <johan@nooku.org>
 * @category	Koowa
 * @package		Koowa_Toolbar
 * @subpackage	Button
 */
class KToolbarButtonCancel extends KToolbarButtonPost
{
	public function getOnClick()
	{
		$option	= KRequest::get('get.option', 'cmd');
		$view	= KRequest::get('get.view', 'cmd');
		$id		= KRequest::get('get.id', 'int');
		$token 	= JUtility::getToken();
		$json 	= "{method:'post', url:'index.php?option=$option&view=$view&id=$id', formelem:'adminForm', params:{action:'cancel', _token:'$token'}}";

		return 'new KForm('.$json.').submit();';
	}

}
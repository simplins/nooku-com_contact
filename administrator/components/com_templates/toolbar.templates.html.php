<?php
/**
* @version		$Id: toolbar.templates.html.php 14401 2010-01-26 14:10:00Z louis $
* @package		Joomla
* @subpackage	Templates
* @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* @package		Joomla
* @subpackage	Templates
*/
class TOOLBAR_templates
{
	function _DEFAULT(&$client)
	{
		JToolBarHelper::title( JText::_( 'Template Manager' ), 'thememanager' );

		if ($client->id == '1') {
			JToolBarHelper::makeDefault('publish');
		} else {
			JToolBarHelper::makeDefault();
		}
		//JToolBarHelper::addNew();
	}
 	function _VIEW(&$client){

		JToolBarHelper::title( JText::_( 'Template Manager' ), 'thememanager' );
		JToolBarHelper::back();
	}

	function _EDIT(&$client){
		JToolBarHelper::title( JText::_( 'Edit' ).' '.JText::_( 'Template' ), 'thememanager' );
		JToolBarHelper::custom('preview', 'preview.png', 'preview_f2.png', 'Preview', false, false);
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply();
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
}
<?php
/**
* @version		$Id: toolbar.content.html.php 14401 2010-01-26 14:10:00Z louis $
* @package		Joomla
* @subpackage	Content
* @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/**
* @package		Joomla
* @subpackage	Content
*/
class TOOLBAR_content
{
	function _EDIT($edit)
	{
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		$cid = intval($cid[0]);

		$text = ( $edit ? JText::_( 'Edit' ) : JText::_( 'New' ) );

		JToolBarHelper::title( $text.' '.JText::_( 'Article' ), 'addedit.png' );
		JToolBarHelper::save();
		JToolBarHelper::apply();
		if ( $edit ) {
			// for existing articles the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		} else {
			JToolBarHelper::cancel();
		}
		JToolBarHelper::spacer();
		JToolBarHelper::preview( 'index.php?option=com_content&id='.$cid.'&tmpl=component', true );
	}
/*
	function _ARCHIVE()
	{
		JToolBarHelper::title( JText::_( 'Archive Manager' ), 'addedit.png' );
		JToolBarHelper::unarchiveList();
		JToolBarHelper::custom( 'remove', 'delete.png', 'delete_f2.png', 'Trash', false );
	}
*/
	function _MOVE()
	{
		JToolBarHelper::title( JText::_( 'Move Articles' ), 'move_f2.png' );
		JToolBarHelper::custom( 'movesectsave', 'save.png', 'save_f2.png', 'Save', false );
		JToolBarHelper::cancel();
	}

	function _COPY()
	{
		JToolBarHelper::title( JText::_( 'Copy Articles' ), 'copy_f2.png' );
		JToolBarHelper::custom( 'copysave', 'save.png', 'save_f2.png', 'Save', false );
		JToolBarHelper::cancel();
	}

	function _DEFAULT()
	{
		global $filter_state;

		JToolBarHelper::title( JText::_( 'Article Manager' ), 'article.png' );
		JToolBarHelper::addNewX();
		JToolBarHelper::spacer();
		JToolBarHelper::trash();
		JToolBarHelper::spacer();
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::customX( 'movesect', 'move.png', 'move_f2.png', 'Move' );
		JToolBarHelper::spacer();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::spacer();
		if ($filter_state == 'A' || $filter_state == NULL) {
			JToolBarHelper::unarchiveList();
		}
		if ($filter_state != 'A') {
			JToolBarHelper::archiveList();
		}
		JToolBarHelper::spacer();
		JToolBarHelper::preferences('com_content', '550');
	}
}
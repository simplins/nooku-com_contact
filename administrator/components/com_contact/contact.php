<?php

// Check if Koowa is active
if(!defined('KOOWA')) {
    JError::raiseWarning(0, JText::_("Koowa wasn't found. Please install the Koowa plugin and enable it."));
    return;
}
 
// Create the controller dispatcher
echo KFactory::get('admin::com.contact.dispatcher')->dispatch(KRequest::get('get.view', 'cmd', 'contacts'));
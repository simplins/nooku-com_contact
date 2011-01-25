<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

echo KFactory::get('site::com.contact.dispatcher')->dispatch(KRequest::get('get.view', 'cmd', 'categories'));
<?php

/**
* 
*/
class ComContactDatabaseRowContact extends KDatabaseRowDefault
{
	
	public function save()
	{
		if (isset($this->_modified['params'])) {
			$params = new JParameter;
			$params->bind($this->_data['params']);
			
			$this->params = $params->toString();
			$this_data['params'] = $params->toString();
		}

		return parent::save();
	}

	public function __get($column)
	{
		if ($column == 'params' && !($this->_data['params'] instanceof JParameter)) {
			$params = new JParameter($this->_data['params'], JPATH_ADMINISTRATOR.'/components/com_contact/models/contacts.xml');
			$this->_data['params'] = $params;
		}

		return parent::__get($column);
	}
}

?>
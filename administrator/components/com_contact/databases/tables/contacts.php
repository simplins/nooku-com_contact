<?php

/**
* 
*/
class ComContactDatabaseTableContacts extends KDatabaseTableDefault
{
	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->_column_map = array_merge(
			$this->_column_map,
			array(
				'enabled' 	=> 'published',
				'locked_on' => 'checked_out_time',
				'locked_by'	=> 'checked_out',
				'slug'		=> 'alias'
			)
		);

	}
	
	public function _initialize(KConfig $config)
	{
		$config->identity_column = 'id';
		$config->name = 'contact_details';
		$config->base = 'contact_details';

		$config->behaviors = array(
			'orderable',
			'lockable'
		);

		parent::_initialize($config);
	}
}

?>
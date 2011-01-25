<?php

/**
* 
*/
class ComContactDatabaseTableUsers extends KDatabaseTableDefault
{
	
	public function _initialize(KConfig $config)
	{
		$config->identity_column = 'id';
		$config->name = 'users';
		$config->base = 'users';
		
		parent::_initialize($config);
	}
}

?>

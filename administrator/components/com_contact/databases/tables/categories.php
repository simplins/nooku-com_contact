<?php

/**
* 
*/
class ComContactDatabaseTableCategories extends KDatabaseTableDefault
{
	
	public function __construct(KConfig $config)
	{
		parent::__construct($config);		
	}

	public function _initialize(Kconfig $config)
	{
		$config->identity_column = 'id';
		$config->name = 'categories';
		$config->base = 'categories';

		parent::_initialize($config);
	}

}

?>
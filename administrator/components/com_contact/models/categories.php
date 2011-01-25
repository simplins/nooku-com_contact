<?php

/**
* 
*/
class ComContactModelCategories extends KModelTable
{
	
	public function __construct(KConfig $config)
	{
		parent::__construct($config);
		
		$this->_state
			->insert('section', 'string');
	}

	protected function _buildQueryWhere(KDatabaseQuery $query)
	{
		$state = $this->_state;

		if ($state->section)
		{
			$query->where('tbl.section', '=', $state->section);
		}

		parent::_buildQueryWhere($query);
	}
}

?>
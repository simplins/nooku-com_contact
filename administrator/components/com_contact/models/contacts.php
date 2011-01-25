<?php

/**
* 
*/
class ComContactModelContacts extends KModelTable
{
	
	public function __construct(KConfig $config)
	{
		parent::__construct($config);
		
		$this->_state
			->insert('enabled', 'int')
			->insert('catid', 'int');
	}

	protected function _buildQueryColumns(KDatabaseQuery $query)
	{
		parent::_buildQueryColumns($query);
		
		$query->select('categories.title AS category');
		$query->select('users.name AS user');
		$query->select('v.name AS editor');
	}

	protected function _buildQueryJoins(KDatabaseQuery $query)
	{
		parent::_buildQueryJoins($query);
		
		$query->join('LEFT', 'categories AS categories', 'categories.id = tbl.catid');
		$query->join('LEFT', 'users AS users', 'users.id = tbl.user_id');
		$query->join('LEFT', 'users AS v', 'v.id = tbl.checked_out');
	}

	protected function _buildQueryWhere(KDatabaseQuery $query)
	{
		$state = $this->_state;
		
		if (is_numeric($state->enabled)) {
			$query->where('tbl.published', '=', $state->enabled);
		}

		if (is_numeric($state->catid)) {
			$query->where('tbl.catid', '=', $state->catid);
		}

		if ($state->search) {
			$search = '%'.$state->search.'%';
			$query->where('tbl.name', 'LIKE', $search);
		}

		parent::_buildQueryWhere($query);
	}
}

?>
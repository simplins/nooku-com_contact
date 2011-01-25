<?php

/**
* 
*/
class ComContactTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{
	
	public function catid($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name' 		=> 'catid',
			'attribs'	=> array(),
			'section'	=> 'com_contact_details',
			'deselect' 	=> true
		))->append(array(
			'selected' 	=> $config->{$config->name}
		));

		$options  = array();
	
		if ($config->deselect) {
			$options[] =  $this->option(array('text' => '- '.JText::_( 'Select' ).' -'));
		}

		$model = KFactory::tmp('admin::com.contact.model.categories');

		if ($config->section) {
			$model->set('section', $config->section);
		}

		$list = $model->getList();

		foreach ($list as $item) 
		{
			$options[] = $this->option(array('text' => $item->title, 'value' => $item->id));
		}

		$config->options = $options;

		return $this->optionlist($config);
	}

	public function userid($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'model' 	=> 'users',
			'name'		=> 'user_id',
			'value'		=> 'id',
			'text'		=> 'name'
		));

		return parent::_listbox($config);
	}

	public function ordering($config)
	{
		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'ordering'			
		))->append(array(
			'selected'	=> $config->{$config->name}
		));

		$model = KFactory::tmp('admin::com.contact.model.contacts');
		
		$list = $model->set('catid', $config->catid)->getList();

		$options = array();

		$options[] = $this->option(array('text' => '0 First', 'value' => 0));
		foreach ($list as $item) {
			$options[] = $this->option(array('text' => $item->ordering.' ('.$item->name.')', 'value' => $item->ordering));
		}
		$last = count($list) + 1;
		$options[] = $this->option(array('text' => $last.' Last', 'value' => $last));

		$config->options = $options;
		
		return $this->optionlist($config);
	}
}

?>
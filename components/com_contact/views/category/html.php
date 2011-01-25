<?php

/**
* 
*/
class ComContactViewCategoryHtml extends ComDefaultViewHtml
{
	
	public function display()
	{
		global $mainframe;

		$params = &$mainframe->getParams();
		
		$catid = KRequest::get('get.catid', 'int', 0);

		$model = KFactory::get('admin::com.contact.model.contacts');

		if ($catid) {
			$model->set('catid', $catid);
			$category = KFactory::get('admin::com.contact.model.categories')->set('id', $catid)->getItem();
		}

		$category = KFactory::tmp('admin::com.contact.model.categories')->set('section', 'com_contact_details')->getList();			

		$items = $model->getList();
		
		$this->assign('category', $category);
		$this->assign('items', $items);
		$this->assign('params', $params);
		
		return parent::display();
	}
}

?>
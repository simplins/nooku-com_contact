<?php

/**
* 
*/
class ComContactViewContactsHtml extends ComContactViewHtml
{
	
	public function display()
	{
		KFactory::get('admin::com.contact.toolbar.contacts')
			->setTitle('Contact Manager')
			->append('publish')
			->append('unpublish')
			->append('preferences');

		return parent::display();
	}
}

?>
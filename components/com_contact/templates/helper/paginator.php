<?php

class ComContactTemplateHelperPaginator extends KTemplateHelperPaginator
{
	public function pagescounter($config = array())
	{
		$config = new KConfig($config);
		
		$paginator = KFactory::tmp('lib.koowa.model.paginator')->setData(
			array(
				
			)
		);

		$html = '<div class="limit">';
		$html .= '<div class="limit"> '.JText::_('Page').' '.$paginator->current.' '.JText::_('of').' '.$paginator->count.'</div>';
		$html .= '</div>';

		return $html;
	}

	public function pageslinks($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'total' 	=> 0,
			'display' 	=> 4,
			'offset'	=> 0,
			'limit'		=> 0,			
		));

		$paginator = KFactory::tmp('lib.koowa.model.paginator')->setData(
			array(
				'total' 	=> $config->total,
				'offset'	=> $config->offset,
				'limit'		=> $config->limit,
				'display'	=> $config->display
			)
		);

		$list = $paginator->getList();

		$html = '<div class="pagination">';
		$html .= $this->_pages($list);
		$html .= '</div>';
		
		return $html;
	}

	public function testlang($config = array())
	{
		return '<b>hello</b>';
	}

}
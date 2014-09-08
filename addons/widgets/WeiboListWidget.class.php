<?php
class WeiboWidget extends Widget
{
	public function render($data)
	{
		//$data['list'] = array();
		
		$content = $this->renderFile(ADDON_PATH . '/widgets/WeiboList.html', $data);
		return $content;
	}
}
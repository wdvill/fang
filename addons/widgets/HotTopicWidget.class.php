<?php
/**
 * 热门话题Widget
 * 
 * @author 小川 <258396027@qq.com>
 */
class HotTopicWidget extends Widget {
	
	/**
	 * 热门话题Widget
	 * 
	 * $data接受的参数:
	 * arrary(
	 * 	'type'(可选)			=> $type, // 热门话题类型(默认站长设置的话题)
	 *  'title'(可选)        => $title, // 话题列表标题
	 * )
	 * 
	 * @see Widget::render()
	 */
	public function render($data) {
		$data['type'] = 'recommend' == $data['type'] ? $data['type'] : 'auto';
		if (!$data['title']) {
			if ('recommend' == $data['type']) {
				$data['title'] = '推荐话题榜';
			} else if ('auto' == $data['type']) {
				$time = intval(model('Xdata')->get('weibo:hotTopicTime'));
				if ($time < 1) {
					$data['title'] = '热门话题榜';
				} else {
					$data['title'] = 1 == $time ? '今日话题榜' : "{$time}天话题榜" ;
				}
			}
		}
		$data['hotTopic'] = D ('Topic', 'weibo')->getHot($data['type']);

		$content = $this->renderFile(ADDON_PATH . '/widgets/HotTopic.html', $data);
		return $content;
	}
}
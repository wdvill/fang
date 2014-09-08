<?php
/**
 * 来访的人
 * 
 * @author daniel <desheng.young@gmail.com>
 */
class VisitorWidget extends Widget
{
	/**
	 * 可能认识的人 = 不为好友的“好友的好友” || 不为好友的“IP相近用户”
	 * 
	 * $data接受的参数:
	 * array(
	 * 	'uid'(可选)		=> $uid,	// 用户ID(默认当前用户)
	 * 	'limit'(可选)	=> $limit,	// 展示的数量(默认为3x3=9个), 用户点击"关注"后自动补全
	 * 	'max'(可选)		=> $max,	// 一次搜索获取的最大数结果数(默认100)
	 * 	'title'(可选)	=> $title,	// 标题(默认"可能感兴趣的人")
	 * )
	 * 
	 * @see Widget::render()
	 */
	public function render($data)
	{
		if (1 != model('Xdata')->get('siteopt:site_user_visited')) {
            return '';
		}
		//$data['title']  = $data['title'] ? $data['title'] : '最近来访的人';
		$data['uid']	= $data['id'] ? intval($data['id']) : $GLOBALS['ts']['user']['uid'];
		$prefix = C("DB_PREFIX");
		$data['list'] = M('')->table("{$prefix}user_visited AS a LEFT JOIN {$prefix}user AS b ON a.uid=b.uid")->where("a.fid={$data['uid']} AND a.uid!={$data['uid']} AND b.is_avatar=1")->order('a.ctime DESC')->field('a.uid AS uid,b.uname AS uname')->limit(6)->findAll();
		
		foreach($data['list'] as $k=>$v){
			$v['url'] = getUserUrl($v['uid']);
			$v['face'] = getUserFace($v['uid']);
			$data['list'][$k] = $v;
		}
		$content = $this->renderFile(ADDON_PATH . '/widgets/Visitor.html', $data);

		return $content;
	}
}
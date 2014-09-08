<?php
//外部应用相关数据调用（群组，活动等）
class AppsModel extends Model {
	
	//获取用户群组列表
	function getUserGroup($uid,$limit=10,$is_page=0){
		$my_group = M("group_member")->field('gid')->where("uid={$uid} AND level>0")->order('level ASC,ctime DESC')->findAll();
		
		if($my_group){
		    $map = 'id IN (' . implode(',' ,getSubByKey($my_group, 'gid')) . ') AND is_del=0';
		    if($is_page == 0){
		    	$groupList = M("group")->field('id,uid,name,intro,type,membercount,logo,cid0,ctime,status')->where($map)->limit($limit)->findAll();
				foreach($groupList as $k=>$v){
					$v['uname'] = getUserName($v['uid']);
					$v['userurl'] = getUserUrl($v['uid']);
					$v['logo'] = __UPLOAD__.'/'.$v['logo'];
					$v['cdate'] = date("Y年m月d日",$v['ctime']);
					$v['m_intro'] = msubstr(real_strip_tags($v['intro']),0,100);
					$groupList[$k] = $v;
				}
		    }else{
		    	$groupList = M("group")->field('id,uid,name,intro,type,membercount,logo,cid0,ctime,status')->where($map)->findPage($limit);	
				foreach($groupList['data'] as $k=>$v){
					$v['uname'] = getUserName($v['uid']);
					$v['userurl'] = getUserUrl($v['uid']);
					$v['logo'] = __UPLOAD__.'/'.$v['logo'];
					$v['cdate'] = date("Y年m月d日",$v['ctime']);
					$v['m_intro'] = msubstr(real_strip_tags($v['intro']),0,100);
					$groupList['data'][$k] = $v;
				}
		    }
			
		    return  $groupList;
		}
		return false; 
	}
    
	//获取活动列表
	function getEventList($uid,$map,$limit=10){
        $result  = M("event")->where($map)->order('id DESC')->findPage($limit);
		//追加必须的信息
        if( !empty($result['data'])){
            foreach($result['data'] as &$value){
                //$value = $this->appendContent( $value );
                $value['cover'] = $this->getCover($value['coverId']);
				$value['url'] = U('event/index/eventDetail',array('id'=>$value['id'],'uid'=>$value['uid']));
				$value['intro'] = msubstr(real_strip_tags($value['explain']),0,100);
				$value['sdate'] = getFormatDate($value['sTime']);
            }
        }
		return $result;
	}
	
	public function getHotList($limit=6){
    	$opts_ids  = M("event_opts")->field('id')->where('isHot=1')->limit($limit)->findAll();
    	foreach( $opts_ids as &$v ){
    		$v = $v['id'];
    	}
    	$event_map['optsId'] = array('in',$opts_ids);
    	$event_ids = M("event")->where($event_map)->findAll();
    	foreach($event_ids as &$v){
			$v['m_title'] = msubstr($v['title'],0,15,'utf-8',false);
    		//$v['type']    = $this->getTypeName($v['type']);
            //$v['coverId'] = $this->getCover($v['coverId']);
			$v['url'] = U('event/index/eventDetail',array('id'=>$v['id'],'uid'=>$v['uid']));
			//$v['intro'] = msubstr(real_strip_tags($v['explain']),0,60);
			$v['sdate'] = date("Y-m-d",$v['sTime']);
    	}
    	return $event_ids;
    }
	
	//通过活动id获取活动类型名称
	public function getTypeName( $id ){
            $map['id'] = $id;
            $result = $this->where( $map )->field('name')->find();
            return $result['name'];
        }
	//获取活动封面存储地址
	function getCover($coverId,$width=150,$height=120){
		$cover = M('Attach')->field('savepath,savename')->find($coverId);
		if($cover){
			$cover	=	SITE_URL."/thumb.php?w=$width&h=$height&url=./data/uploads/".$cover['savepath'].$cover['savename'];
		}else{
			$cover	=	SITE_URL."/thumb.php?w=$width&h=$height&url=./apps/event/Tpl/default/Public/images/hdpic1.gif";
		}
		return $cover;
	}
}
?>
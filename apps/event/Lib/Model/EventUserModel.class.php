<?php
    /**
     * EventUserModel 
     * 活动用户项
     * @uses BaseModel
     * @package 
     * @version $id$
     * @copyright 2009-2011 SamPeng 
     * @author SamPeng <sampeng87@gmail.com> 
     * @license PHP Version 5.2 {@link www.sampeng.cn}
     */
    class EventUserModel extends BaseModel{
        /**
         * getUserList 
         * 获得用户列表
         * @param mixed $action 
         * @param mixed $eventId 
         * @param mixed $limit 
         * @access public
         * @return void
         */
        public function getUserList($map,$limit,$page=null){
            if( isset( $page ) ){
                return $this->where( $map )->field( 'distinct(uid),status,action,cTime,contact,id' )->order( 'cTime DESC' )->findPage($limit);
            }else{
                return $this->where( $map )->order( 'cTime DESC' )->limit( '0,'.$limit )->findAll();
            }
        }

        /**
         * hasUser 
         * 是否已经有了这个用户的关注
         * @param mixed $uid 
         * @param mixed $id 
         * @param mixed $action 
         * @access public
         * @return void
         */
        public function hasUser( $uid,$id,$action=NULL ){
            $map['uid']     = $uid;
            $map['eventId'] = $id;
            $map['action']  = $action;
            return $this->where( $map )->find();
        }
		
		//获取活动成员列表(不包括创建者)
		function getEventUserList($id,$limit,$page=null){
			$prefix = C("DB_PREFIX");
			if(isset($page)){
				$res = M("")->table("{$prefix}user AS a LEFT JOIN {$prefix}event_user AS b ON a.uid=b.uid")->where("b.eventId={$id} AND action='joinIn' AND status=1")->field("a.*,b.ctime AS jointime")->order("b.ctime DESC")->findPage($limit);
            }else{
                $res['data'] = M("")->table("{$prefix}user AS a LEFT JOIN {$prefix}event_user AS b ON a.uid=b.uid")->where("b.eventId={$id} AND action='joinIn' AND status=1")->field("a.*,b.ctime AS jointime")->order("b.ctime DESC")->limit($limit)->findAll();
            }
			foreach($res['data'] as $k=>$v){
				$v['face'] = getUserFace($v['uid'],'m');
				$v['url'] = getUserUrl($v['uid']);
				$res['data'][$k] = $v;
			}
			
			return $res;
		}
		
		//获取需要审批的活动用户
		function getVerifyUserList($id,$limit,$page=null){
			$prefix = C("DB_PREFIX");
			if(isset($page)){
				$res = M("")->table("{$prefix}user AS a LEFT JOIN {$prefix}event_user AS b ON a.uid=b.uid")->where("b.eventId={$id} AND action='verify' AND status=1")->field("a.*,b.ctime AS jointime")->order("b.ctime DESC")->findPage($limit);
            }else{
                $res['data'] = M("")->table("{$prefix}user AS a LEFT JOIN {$prefix}event_user AS b ON a.uid=b.uid")->where("b.eventId={$id} AND action='verify' AND status=1")->field("a.*,b.ctime AS jointime")->order("b.ctime DESC")->limit($limit)->findAll();
            }
			foreach($res['data'] as $k=>$v){
				$v['face'] = getUserFace($v['uid'],'m');
				$v['url'] = getUserUrl($v['uid']);
				$res['data'][$k] = $v;
			}
			
			return $res;
		}
		
		//审批用户加入活动
		function verifyUserToEvent($uid,$id){
			if(M('event_user')->setField("action",'joinIn',"uid={$uid} AND eventId={$id} AND status=1")){
				//积分操作
				X('Credit')->setUserCredit($uid,'join_event');
				return 1;
			}else{
				return 0;
			}
		}
		
		//删除活动成员
		function deleteMember($uid,$id){
			if(M('event_user')->where("uid={$uid} AND eventId={$id}")->delete()){
				//积分操作
				X('Credit')->setUserCredit($uid,'cancel_join_event');
				return 1;
			}else{
				return 0;
			}
		}
    }

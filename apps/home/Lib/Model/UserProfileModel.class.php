<?php

class UserProfileModel extends UserModel {
    var $tableName = 'user_profile';
    
    /* 见 home/UserModel/getUserList
    function getUserList(){
        return $this->table(C('DB_PREFIX').'user')->findall();
    }
    */
    
    //统一提取用户资料
    function getUserInfo($type=''){
		$map = 'uid='.$this->uid;
		//$map .= $type ? ' AND module='.$type:'';
        $userInfoList                      = $this->where($map)->field('id,uid,module,data,type')->findall();
        $userInfo                          = $this->dataProcess( $userInfoList );
        $userInfo['detail']		           = $this->table(C('DB_PREFIX').'user')->where("uid={$this->uid}")->find();
        $userInfo['base']['completeness']  = 100;
        return $userInfo;
    }
    
	//获取用户资料（通过module获取）
    function getUserProfileByModule($type=''){
		$type = $type ? $type:'intro';
		$map = "uid={$this->uid} AND module='".$type."'";
        $res = $this->where($map)->field('id,uid,module,data,type')->order("ctime DESC")->findAll();
		if(!$res) return;
		foreach($res as $k=>$v){
			$v['data'] = unserialize($v['data']);
			$res[$k] = $v;
		}

        return $res;
    }
	
	//判断用户基本资料和头像是否完整
	function isUserProfile($uid){
		if(!is_numeric($uid)) return ;
		$res = M('user')->where("uid={$uid} AND is_active=1")->field('uname,email,position,company,cellphone')->find();
		foreach($res as $k=>$v){
			if(empty($v[$k]))
				return ;
		}
		//判断用户头像
		if(!file_exists(SITE_PATH.'/data/uploads/avatar/'.$uid.'/big.jpg'))
			return ;
			
		return 1;
	}
	
    //数据处理
    private function dataProcess( $userInfoList ){
        $fieldList = $this->data_field();
        foreach ($userInfoList as $value){
            if( $value['type'] == 'info' ){
                $database[ $value['module'] ] = unserialize( $value['data'] );
            }else{
                $data[ 'profile' ]['list'][] = array_merge( array('module'=>$value['module'],'id'=>$value['id']) , unserialize($value['data']) );
            }
        }
        $data['profile']['completeness'] = round( count( array_unique( getSubByKey( $data[ 'profile' ]['list'] ,'module') ) ) / 2 , 2) *100;
        foreach ($fieldList as $key=>$value){
            foreach ( $value as $k=>$v){
                $t = $database[$key][$k];
                if( $t ) $complete++;
                $data[$key]['list'][]  = array('field' => $k,'name'  => $v,'value' => $t ); 
                
            }
            $data[$key]['completeness'] = round( $complete/count($value) , 2 ) * 100 ;
            unset($complete);
        }
        
        unset($userInfoList);
        unset($fieldList);
        unset($database);
        return $data;
    }
    
    //统一存储用户资料
    function doSave($module,$savedata,$type='info',$profile_id,$multi=false  ){
        if(!$module) return false;
		
		//编辑资料
		if(is_numeric($profile_id) && $profile_id > 0){
			$save_data['data'] = serialize( $savedata );
			$save_data['ctime']  = time();
			return $this->where("id=".$profile_id)->save($save_data);
		}else{
			$data['uid']    = $map['uid'] = $this->uid;
        	$data['module'] = $map['module'] = $module;
        	$data['type']   = $map['type'] = $type;
			
			if($module=='work' || $module=='edu'){
				$res = $this->where("uid={$this->uid} AND module='{$module}'")->findAll();
				foreach($res as $k=>$v){
					if($v['data'] == serialize($savedata)){
						return -1;
					}
				}
				$data['data'] = serialize( $savedata );
				$data['ctime']  = time();
				return $this->add( $data );
			}elseif( $this->where($map)->count()!=0 && $multi==false){
				$save_data['data'] = serialize( $savedata );
				$save_data['ctime']  = time();
				return $this->where($map)->save($save_data);
			}else{
				$data['data'] = serialize( $savedata );
				$data['ctime']  = time();
				return $this->add( $data );
			}
		}
    }
    
    //获取信息
    function getProfiles($uid){
        $list = $this->where( 'uid='.$uid )->order('id ASC')->findall();
        foreach ($list as $value){
            $unserData = unserialize( $value['data'] );
            $data[] = array_merge( array('module'=>$value['module'],'id'=>$value['id']) , $unserData );
        }
        return $data;
    }
    
    function delProfile($intId,$uid){
        return $this->where("id=$intId AND uid=$uid")->delete();
    }
    
    
	//更新个人情况
    function upintro(){
        $fieldList = $this->data_field( 'intro' );
        foreach ($fieldList as $key=>$value){
            $data[$key] = t( msubstr( $_POST['intro'][$key],0,70,'utf-8',false ) );
        }
        $this->dosave('intro',$data);
	   	$data['message'] = '更新完成';
		$data['boolen']  = 1;
		return $data;
    }
    
	//更新联系方式
    function upcontact(){
        $fieldList = $this->data_field( 'contact' );
        foreach ($fieldList as $key=>$value){
            $data[$key] = t( msubstr( $_POST['contact'][$key],0,70,'utf-8',false ) );   
        }
        $this->dosave('contact',$data);
	   	$data['message'] = '更新完成';
		$data['boolen']  = 1;
		return $data;
    }        
}
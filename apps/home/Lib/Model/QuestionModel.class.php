<?php
class QuestionModel extends Model {
	protected $tableName = 'question';
    
	//获取问题列表
	function getQuestionListByMap($uid,$map,$limit=10,$field='*',$order='ques_id DESC',$is_page=false){
		if($is_page){
			$res = M('question')->where($map)->order($order)->field($field)->findPage($limit);
		}else{
			$res['data'] = M('question')->where($map)->order($order)->field($field)->limit($limit)->findAll();
		}
		if(empty($res['data'])) return null;
		
		foreach($res['data'] as $k=>$v){
			$res['data'][$k] = $this->getDetail($v['ques_id'],$v);
		}
		
		return $res;
	}
	
	//获取某用户相关的提问
	function getQuestionListByUid($uid,$limit=10){
		if(!is_numeric($uid)) return null;
		$map = 'uid='.$uid.' AND status=1';
		$res = M('question')->where($map)->order('ques_id DESC')->field('ques_id,uid,answer,content,public,ctime')->findPage($limit);
		if(empty($res['data'])) return null;
		
		foreach($res['data'] as $k=>$v){
			$res['data'][$k] = $this->getDetail($v['ques_id'],$v);
		}
		
		return $res;
	}
	
	//获取问题详细信息
	function getDetail($id,$value){
		if(!$value){
			$value = M('question')->where("ques_id={$id} AND status=1")->find();
			if(!$value) return ;
		}
		
		$value['uname'] = getUserName($value['uid']);
		$value['url'] = getUserUrl($value['uid']);
		$value['face'] = getUserFace($value['uid']);
		$value['content'] = format(htmlspecialchars_decode($value['content']));
		$value['is_collect'] = $this->isCollect(intval($_SESSION['mid']),$value['ques_id']);
		$value['collect'] = $this->getCollectCounts($value['ques_id']);
		$value['cdate'] = date('Y-m-d H:i',$value['ctime']);
		$value['allow'] = $this->getAllowAnswerUser($value['ques_id'],$value['public']);
		
		return $value;
	}
	
	//用户提问
	function ask($uid,$post){
		if(!is_numeric($uid)) return ;
		
		//验证提问目标
		if(!$target = $this->checkTarget($post['target'])) return -1;
		if(empty($post['content'])) return -2;
		
		$data['uid'] = $uid;
		$data['content'] = t(h($post['content']));
		$data['ctime'] = time();
		$data['public'] = $target['public'];
		
		if($ques_id = M('question')->add($data)){
			//发布动态
			X("Feed")->put('question_ask',array('question_id'=>$ques_id),$uid);
			//积分操作
			X('Credit')->setUserCredit($uid,'add_question');
			
			$return['id'] = $ques_id;
			$return['target'] = $target;
			return $return;
		}
	}
	
	//收藏问题
	function doCollect($uid,$id){
		if(!is_numeric($uid) || !is_numeric($id)) return ;
		
		$data['uid'] = $uid;
		$data['ques_id'] = $id;
		
		if(M('question_collect')->add($data)){
			return 1;
		}
	}
	
	//取消收藏问题
	function deleteCollect($uid,$id){
		if(!is_numeric($uid) || !is_numeric($id)) return ;
		
		if(M('question_collect')->where("uid={$uid} AND ques_id={$id}")->delete()){
			return 1;
		}
	}
	
	//删除问题
	function deleteQuestion($uid,$id){
		if(!is_numeric($uid) || !is_numeric($id)) return ;
		if(M('question')->where("ques_id={$id} AND uid={$uid}")->delete()){	
			M('question_answer')->where("ques_id={$id}")->delete();
			//积分操作
			X('Credit')->setUserCredit($uid,'delete_question');
			return 1;
		}
	}
	
	//判断用户是否收藏此问题
	function isCollect($uid,$ques_id){
		return  M('question_collect')->where("uid={$uid} AND ques_id={$ques_id}")->count();
	}
	
	//获取问题收藏数量
	function getCollectCounts($ques_id){
		return intval(M('question_collect')->where("ques_id={$ques_id}")->count());
	}
	
	//验证问题目标
	function checkTarget($post){
		if($post['public']==0 && $post['private']==0) return ;
		
		if($post['private']==1){
			$data['public'] = 0;
			
			if($post['public']==0 && empty($post['to'])) return ;
			
			if($post['type']=='email'){
				//处理邮件
				$data['to'] = is_array($post['to']) ? $post['to']:explode(',',str_replace(array(' ','，',"\r","\n","\t"),',',$post['to']));
				foreach($data['to'] as $k=>$v){
					if(!isValidEmail($v))
						array_splice($data['to'],$k,1);
				}
			}else{
				//处理好友
				$data['to'] = is_array($post['to']) ? $post['to']:explode(',',$post['to']);
				foreach($data['to'] as $k=>$v){
					if(!is_numeric($v))
						array_splice($post['to'],$k,1);
				}
			}
			$data['to'] = array_unique($data['to']);
		}
		
		if($post['public']==1){
			$data['public'] = 1;
		}
		
		$data['type'] = $post['type'];
		
		return $data;
	}
	
	//问题发布成功后处理/存取目标信息
	function saveTarget($uid,$ques_id,$target){
		if(!is_numeric($uid) || !is_numeric($ques_id) || !$target['to']) return ;
		
		if($target['type']=='email'){
			$body = $this->getEmailTpl($uid,$ques_id);
			service("Mail")->send_email( $target['to'],'知行网问答提醒',$body);
		}else{
			$data['ques_id'] = $ques_id;
			foreach($target['to'] as $v){
				$data['uid'] = $v;
				M('question_target')->add($data);
			}
		}
	}
	
	//目标收取邮件的模板
	function getEmailTpl($uid,$ques_id){
		$content_tpl = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>知行网问答提醒</title>
		</head>
		<body>
		<table style="BORDER-BOTTOM: rgb(230,230,230) 4px solid; TEXT-ALIGN: left; BORDER-LEFT: rgb(230,230,230) 4px solid; LINE-HEIGHT: 1.4; FONT-FAMILY: Arial, Helvetica, sans-serif; BACKGROUND: rgb(255,255,255); COLOR: rgb(45,45,45); FONT-SIZE: 12px; BORDER-TOP: rgb(230,230,230) 4px solid; BORDER-RIGHT: rgb(230,230,230) 4px solid" border="0" cellspacing="0" cellpadding="5" width="700" align="center">
		  <tbody>
			<tr>
			  <td valign="top">
				<table style="BORDER-BOTTOM: rgb(163,194,224) 3px solid" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody>
					<tr>
					  <td align="left">
						<a href="'.SITE_URL.'" target="_blank"><img alt="知行网--zhixing001.com" src="http://www.zhixing001.com/public/themes/classic/images/logo.jpg" height="44" /></a>&nbsp;&nbsp;您好！
					  </td>
					  <td height="50"> </td>
					</tr>
				  </tbody>
				</table>
				<table style="BORDER-BOTTOM: rgb(220,220,220) 1px solid; MARGIN: 10px 0px; BORDER-COLLAPSE: collapse; BACKGROUND: rgb(244,244,244); FONT-SIZE: 12px; BORDER-TOP: rgb(220,220,220) 1px solid" border="0" cellspacing="0" cellpadding="4" width="100%">
				  <tbody>
					<tr>
					  <td>
						'.date("Y年m月d日",time()).'：<a href="'.getUserUrl($uid).'" target="_blank">'.getUserName($uid).'</a>向您提问了一个问题。
					  </td>
					</tr>
				  </tbody>
				</table>
				<table style="MARGIN-TOP: 20px" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody>
				  点击以下链接去看看吧：<br /><br />
				  <a href="'.U('home/space/qa',array('uid'=>$uid)).'">'.U('home/space/qa',array('uid'=>$uid)).'</a>
				  </tbody>
				</table>
				<table style="MARGIN-TOP: 20px" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody></tbody>
				</table>
				<table style="MARGIN-TOP: 15px; COLOR: rgb(130,130,130); BORDER-TOP: rgb(230,230,230) 2px solid" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody>
					<tr>
					  <td>
						<p style="MARGIN: 5px 0px 2px; FONT-SIZE: 12px">知行网</p>
						<p style="MARGIN: 0px; FONT-SIZE: 12px">
						  <a style="COLOR: rgb(130,130,130); TEXT-DECORATION: underline" href="'.SITE_URL.'" target="_blank">http://www.zhixing001.com</a>
						</p>
					  </td>
					</tr>
				  </tbody>
				</table>
			  </td>
			</tr>
		  </tbody>
		</table>
		</body>
		</html>';
		
		return $content_tpl;
	}
	
	/*
	**回答相关
	*/
	//回答问题
	function answer($uid,$post){
		$data['uid'] 		= $uid;
		$data['source_id'] 	= intval($post['sd']);
        $data['ques_id'] 	= intval($post['qd']);
		$data['public'] 	= intval($post['public']);
        $data['content'] 	= t(real_strip_tags(trim($post['content']),'<br>'));
        $data['ctime'] 		= time();
		if(empty($data['content'])){
			$return['msg'] = '说点什么吧！';
			$return['code']= 0;
			return $return;
		}
		
		//获取问题信息
		$question = M('question')->where("ques_id=".$data['ques_id']." AND status=1")->field('uid,public')->find();
		if($question['public']==0){
			$allow = $this->getAllowAnswerUser($ques_id,0);
			if($uid != $question['uid'] && !in_array($uid,$allow)){
				$return['msg'] = '您无权回答该问题！';
				$return['code']= 0;
				return $return;
			}
		}
		if($data['source_id']){
			if($uid != $question['uid']){
				$return['msg'] = '您无权回复该答案！';
				$return['code']= 0;
				return $return;
			}
			
			$answer = M('question_answer')->where("id='".$data['source_id']."' AND ques_id=".$data['ques_id']." AND reply_uid=0 AND status=1")->field('uid')->find();
			if(!$answer){
				$return['msg'] = '您无法回复该答案！';
				$return['code']= 0;
				return $return;
			}
			$data['reply_uid'] = $answer['uid'];
		}
		
		if($id = M('question_answer')->add($data)){
			//积分操作
			X('Credit')->setUserCredit($uid,'add_answer_question');
			//修改source_id
			if(!$data['source_id']){
				M('')->query("UPDATE ".C("DB_PREFIX")."question_answer set source_id={$id} WHERE id={$id}");
				//更新问题答案数量
				$this->updateAnswerCount($data['ques_id']);
			}
			
			$data['ques_uid'] = $question['uid'];
			
			$return['html'] = $this->getAnswerTpl($id,$data);
			$return['type'] = $data['reply_uid'] ? 1:0;
			$return['code'] = 1;
			return $return;
		}else{
			$return['msg'] = '操作失败，请稍后再试！';
			$return['code']= 0;
			return $return;
		}
	}
	
	//获取私密问题允许回答的用户集合
	function getAllowAnswerUser($ques_id,$public=1){
		if($public){
			return 1;
		}
		
		$res = M('question_target')->where("ques_id={$ques_id} AND status=1")->field('uid')->findAll();
		
		return getSubByKey($res,'uid');
	}
	
	//获取某问题的答案列表
	function getQuestionAnswer($ques_id,$limit=20){
		if(!is_numeric($ques_id)) return null;
		
		if(!$question = M('question')->where("ques_id={$ques_id} AND status=1")->field('uid')->find())
			return null;
		
		$res = M('question_answer')->where("ques_id={$ques_id} AND reply_uid=0 AND status=1")->order('id DESC')->findPage($limit);
		if(!$res['data']) return null;
		
		foreach($res['data'] as $k=>$v){
			$v['ques_uid'] = $question['uid'];
			$res['data'][$k] = $this->getAnswerDetail($v['id'],$v);
		}
		
		return $res;
	}
	
	//更新问题答案数量
	function updateAnswerCount($ques_id,$is_add=true){
		if($is_add){
			M('question')->setInc('answer',"ques_id={$ques_id}");
		}else{
			$cur_answer = M('question')->getField('answer',"ques_id={$ques_id}");
			if($cur_answer > 0){
				M('question')->setDec('answer',"ques_id={$ques_id}");
			}elseif($cur_answer < 0){
				M('question')->setField('answer',0,"ques_id={$ques_id}");
			}
		}
	}
	
	//获取答案详情
	function getAnswerDetail($id,$value){
		if(!$id || !$value) return null;
		
		if(!$value){
			if(!$value = M('question_answer')->where("id={$id} AND status=1")->find())
				return null;
		}
		
		if($value['reply_uid']==0){
			$value['reply'] = M('question_answer')->where("source_id={$id} AND reply_uid>0 AND status=1")->order('id ASC')->findAll();
			if($value['reply']){
				foreach($value['reply'] as $k=>$v){
					$v['content'] = htmlspecialchars_decode($v['content']);
					$value['reply'][$k] = $v;
				}
			}
		}
		
		$value['content']   = htmlspecialchars_decode($value['content']);
		$value['url']   = getUserUrl($value['uid']);
		$value['face']  = getUserFace($value['uid']);
		$value['uname'] = getUserName($value['uid']);
		
		return $value;
	}
	
	//删除问题答案
	function deleteAnswer($uid,$id){
		if(!is_numeric($uid) || !is_numeric($id)) return ;
		$res = M('question_answer')->where("id={$id} AND uid={$uid}")->find();
		if(!$res) return ;
		
		if(M('question_answer')->where("id={$id} AND uid={$uid}")->delete()){
			if($res['reply_uid'] == 0){
				//更新问题答案数量
				$this->updateAnswerCount($res['ques_id'],false);
				//积分操作
				X('Credit')->setUserCredit($uid,'delete_answer_question');
				
				M('question_answer')->where("source_id=".$res['id'])->delete();
			}
			
			return 1;
		}
	}
	
	//获取问题答案模板
	function getAnswerTpl($id,$data){
		if(!$data) return ;
		
		if($data['reply_uid']){
			$return = '<div id="reply_list_'.$id.'">
						<div class="r wid86 rtit5" style="background:#CBE1F3; color:#F00">
							<div class="l">博主回复&nbsp;&nbsp;<span style="color:#999">'.friendlyDate($data['ctime']).'</span></div>
							<div class="r mr10">
								<a href="javascript:void();" onclick="deleteReplyAnswer('.$id.');">删除</a>
							</div>
						</div>
						<div class="r wid86 rtit5">
							<span>'.formatComment($data['content'],true).'</span>
						</div>
					   </div>';
		}else{
			$return = '<div class="p10 l" style="width:750px;" id="answer_list_c_'.$id.'">
						<div class="l wid12 tc"><a href="'.getUserUrl($data['uid']).'" target="_blank"><img src="'.getUserFace($data['uid']).'" width="50" height="50"/></a></div>
						<div class="r wid86 rtit5 mb5">
							<p>
								<a href="'.getUserUrl($data['uid']).'" target="_blank">'.getUserName($data['uid']).'</a>&nbsp;&nbsp;<label>'.friendlyDate($data['ctime']).'</label>
							   &nbsp;&nbsp;&nbsp;&nbsp;';
			
			if($data['uid'] == $data['ques_uid']){
				$return .= '<a href="javascript:void();" onclick="replyAnswer('.$id.','.$data['ques_id'].');" style="color:#F00">回复</a>&nbsp;|&nbsp;'; 
			}
							   
			$return .= '<a href="javascript:void();" onclick="deleteAnswer('.$id.');" style="color:#F00">删除</a>
							</p>
							<span>'.formatComment($data['content'],true).'</span>
						</div>
					</div>
					<div class="cl '.$id.'" style="border-bottom:1px dashed #DCD2B5"></div>';
		}
		
		return $return;
	}
}
?>
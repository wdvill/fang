<?php
    /**
     * AdminAction 
     * 活动管理
     * @uses Action
     * @package Admin
     * @version $id$
     */
	import('admin.Action.AdministratorAction');
	class AdminAction extends AdministratorAction {
        /**
         * event 
         * EventModel的实例化对象
         * @var mixed
         * @access private
         */
        private $event;

        /**
         * config 
         * EventConfig的实例化对象
         * @var mixed
         * @access private
         */

        public function _initialize(){
	        //管理权限判定
	        parent::_initialize();
            $this->event = D( 'Event' );
        }

        /**
         * basic 
         * 基础设置管理
         * @access public
         * @return void
         */
        public function index (){
        	$config   = model('Xdata')->lget('event');
            $this->assign($config);

            $credit_types = X('Credit')->getCreditType();
            $this->assign('credit_types',$credit_types); 

            $this->display();

        } 

        /**
         * doChangeBase 
         * 修改全局设置
         * @access public
         * @return void
         */
        public function doChangeBase (){
	        //变量过滤 todo:更细致的过滤
	        foreach($_POST as $k=>$v){
	            $config[$k] =   t($v);
	        }
	        //$config['limitsuffix'] = preg_replace("/bmp\|||\|bmp/",'',$config['photo_file_ext']);//过滤bmp
	        if(model('Xdata')->lput('event',$config)){
	            $this->assign('jumpUrl', U('event/Admin/index'));
	            $this->success('设置成功！');
	        }else{
	            $this->error('设置失败！');
	        }
        }

        /**
         * eventlist 
         * 获得所有人的eventlist
         * @access public
         * @return void
         */
        public function eventlist (){
        	//get搜索参数转post
	        if(!empty($_GET['type'])){
	           $_POST['type'] = $_GET['type'];
	        }
            //为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
	        if ( !empty($_POST) ) {
	            $_SESSION['admin_search'] = serialize($_POST);
	        }else if ( isset($_GET[C('VAR_PAGE')]) ) {
	            $_POST = unserialize($_SESSION['admin_search']);
	        }else {
	            unset($_SESSION['admin_search']);
	        }   
	        $this->assign('isSearch', isset($_POST['isSearch'])?'1':'0');   
	
	        $_POST['uid']   && $map['uid']    =   intval($_POST['uid']);
	        $_POST['id']    && $map['id']     =   intval($_POST['id']);
            $_POST['type']  && $map['type']   =   intval($_POST['type']);
            $_POST['title'] && $map['title'] =   array( 'like','%'.t( $_POST['title'] ).'%' );
            //处理时间
            $_POST['sTime'] && $_POST['eTime'] && $this->event->cTime = $this->event->DateToTimeStemp(t( $_POST['stime'] ),t( $_POST['etime'] ) );
	        //处理排序过程
            $order = isset( $_POST['sorder'] )?t( $_POST['sorder'] )." ".t( $_POST['eorder'] ):"cTime DESC";
	        $_POST['limit']     && $limit         =   intval( t( $_POST['limit'] ) );
            
            $order && $list  = $this->event->getList($map,$order,$limit);
            $type_list = D('EventType')->getType();
            $this->assign( $_POST );
            $this->assign( $list );
            $this->assign( 'type_list',$type_list );
            $this->display();
        }

        /**
         * transferEventTab 
         * 转移活动
         * @access public
         * @return void
         */
        public function transferEventTab(){
        	$type_list = D('EventType')->getType();
            $this->assign( 'type_list',$type_list );
            $this->assign( 'id',$_GET['id'] );
            $this->display();
        }

        /**
         * doDeleteEvent 
         * 执行转移活动
         * @access public
         * @return void
         */
        public function doTransferEvent(){
            $id['id']     = array('in',t($_POST['id']));
            $data['type'] = intval($_POST['type']);
            if(!$_POST['id'] || !$data['type']){
                echo -2;
                exit;
            }
            if($this->event->where($id)->save($data)){
                if ( !strpos($_REQUEST['id'],",") ){
                    echo 2;            //说明只操作一个
                }else{
                    echo 1;            //操作多个
                }
            }else{
                echo -1;               //操作失败            	
            }
        }

        /**
         * doDeleteEvent 
         * 删除活动
         * @access public
         * @return int
         */
        public function doDeleteEvent(){
            $eventid['id'] = array( 'in',explode(',',$_REQUEST['id']));    //要删除的id.
            $result       = $this->event->doDeleteEvent($eventid);
            if( false != $result){
                if ( !strpos($_REQUEST['id'],",") ){
                    echo 2;            //说明只是删除一个
                }else{
                    echo 1;            //删除多个
                }
            }else{
                echo -1;               //删除失败
            }
        }

        //推荐操作
        public function doChangeIsHot(){
            $event['id'] = array( 'in',$_REQUEST['id']);        //要推荐的id.
            $act  = $_REQUEST['type'];  //推荐动作
            $result  = $this->event->doIsHot($event,$act);

            if( false != $result){
                    echo 1;            //推荐成功
            }else{
                echo -1;               //推荐失败
            }
        }

        /**
         * eventtype 
         * 活动类型列表
         * @access public
         * @return void
         */
        public function eventtype(){
            $type  = D( 'EventType' );
            $type  = $type->order('id ASC')->findAll();
            $this->assign( 'type_list',$type );

            $count = D('Event')->field('type,count(type) as count')->group('type')->findAll();
            foreach($count as $k => $v){
            	unset($count[$k]);
            	$count[$v['type']] = $v['count'];
            }
            $this->assign('count',$count);

            $this->display();
        }

        /**
         * editEventTab 
         * 添加分类
         * @access public
         * @return void
         */
        public function editEventTab(){
        	$id = intval($_GET['id']);
        	if($id){
        		$name = D( 'EventType' )->getField('name',"id={$id}");
                $this->assign('id',$id);
                $this->assign('name',$name);
        	}
        	$this->display();
        }
        /**
         * doAddType 
         * 添加分类
         * @access public
         * @return void
         */
        public function doAddType(){
            $type = D( 'EventType' );
            if( $result = $type->addType( $_POST ) ){
                echo $result;
            }else{
                echo -1;
            }
        }

        /**
         * doEditType 
         * 修改分类
         * @access public
         * @return void
         */
        public function doEditType(){
            $_POST['id']   = intval($_POST['id']);
            $_POST['name'] = t($_POST['name']);        	
            $type = D( 'EventType' );
            if( $result = $type->editType( $_POST ) ){
                echo 1;
            }else{
                echo -1;
            }

        }

        /**
         * doEditType 
         * 删除分类
         * @access public
         * @return void
         */
        public function doDeleteType(){
            $id['id']      = array( "in",$_POST['id']);
            $type = D( 'EventType' );
            if( $result = $type->deleteType( $id ) ){
                if ( !strpos($_POST['id'],",") ){
                    echo 2;            //说明只是删除一个
                }else{
                    echo 1;            //删除多个
                }
            }else{
                echo $result;
            }
        }
    }

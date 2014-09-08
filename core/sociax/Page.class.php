<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/**
 +------------------------------------------------------------------------------
 * 分页显示类
 +------------------------------------------------------------------------------
 * @category   ORG
 * @package  ORG
 * @subpackage  Util
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
class Page extends Think
{//类定义开始

    /**
     +----------------------------------------------------------
     * 分页起始行数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $firstRow ;

    /**
     +----------------------------------------------------------
     * 列表每页显示行数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $listRows ;

    /**
     +----------------------------------------------------------
     * 页数跳转时要带的参数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $parameter  ;

    /**
     +----------------------------------------------------------
     * 分页总页面数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $totalPages  ;

    /**
     +----------------------------------------------------------
     * 总行数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $totalRows  ;

    /**
     +----------------------------------------------------------
     * 当前页数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $nowPage    ;

    /**
     +----------------------------------------------------------
     * 分页的栏的总页数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $coolPages   ;

    /**
     +----------------------------------------------------------
     * 分页栏每页显示的页数
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */
    protected $rollPage   ;

    /**
     +----------------------------------------------------------
     * 分页记录名称
     +----------------------------------------------------------
     * @var integer
     * @access protected
     +----------------------------------------------------------
     */

    // 分页显示定制
    protected $config   =   array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页');

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $totalRows  总的记录数
     * @param array $firstRow  起始记录位置
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     +----------------------------------------------------------
     */
    public function __construct($totalRows,$listRows='',$parameter='')
    {
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        $this->rollPage = 5;
        $this->listRows = !empty($listRows)?$listRows:20;
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = !empty($_GET[C('VAR_PAGE')])&&($_GET[C('VAR_PAGE')] >0)?$_GET[C('VAR_PAGE')]:1;

        if( (!empty($this->totalPages) && $this->nowPage>$this->totalPages) || $_GET[C('VAR_PAGE')]=='last' ) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }

    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    /**
     +----------------------------------------------------------
     * 分页显示
     * 用于在页面显示的分页栏的输出
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function show($isArray=false){

        if(0 == $this->totalRows) return;
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url	=	$_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
		$url	=	eregi_replace("&p=[0-9]+",'',$url);
		
		//总数
		$countPage = '共' . $this->totalRows . $this->config['header'] . '&nbsp;&nbsp;&nbsp;';
		
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage="<a href='".$url."&".C('VAR_PAGE')."=$upRow'>".$this->config['prev']."</a>";
        }else{
            $upPage='<span class=disabled">'.$this->config['prev'].' </span>';
        }

        if ($downRow <= $this->totalPages){
            $downPage="<a href='".$url."&".C('VAR_PAGE')."=$downRow'>".$this->config['next']."</a>";
        }else{
            $downPage=' &nbsp;<span class=disabled">'.$this->config['next'].'</span>';
        }
        
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<a href='".$url."&".C('VAR_PAGE')."=$preRow' >上".$this->rollPage."页</a>";
            $theFirst = "<a href='".$url."&".C('VAR_PAGE')."=1' >1</a>...";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='".$url."&".C('VAR_PAGE')."=$nextRow' >下".$this->rollPage."页</a>";
            $theEnd = "...<a href='".$url."&".C('VAR_PAGE')."=$theEndRow' >{$theEndRow}</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage+1;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    $linkPage .= "<a href='".$url."&".C('VAR_PAGE')."=$page'> ".$page." </a>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= " <span class='current'>".$page."</span>";
                }
            }
        }
        //$pageStr = $upPage.$downPage.$theFirst.$prePage.$linkPage.$nextPage.$theEnd;
		$pageStr = $countPage.$upPage.$theFirst.$linkPage.$theEnd.$downPage;
		if($this->totalPages <= 1) return '';
        if($isArray) {
            $pageArray['totalRows'] =   $this->totalRows;
            $pageArray['upPage']    =   $url.'&'.C('VAR_PAGE')."=$upRow";
            $pageArray['downPage']  =   $url.'&'.C('VAR_PAGE')."=$downRow";
            $pageArray['totalPages']=   $this->totalPages;
            $pageArray['firstPage'] =   $url.'&'.C('VAR_PAGE')."=1";
            $pageArray['endPage']   =   $url.'&'.C('VAR_PAGE')."=$theEndRow";
            $pageArray['nextPages'] =   $url.'&'.C('VAR_PAGE')."=$nextRow";
            $pageArray['prePages']  =   $url.'&'.C('VAR_PAGE')."=$preRow";
            $pageArray['linkPages'] =   $linkPage;
            $pageArray['nowPage'] =   $this->nowPage;
            return $pageArray;
        }
        return $pageStr;
    }

}//类定义结束
?>

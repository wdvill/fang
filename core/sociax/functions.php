<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/**
 +------------------------------------------------------------------------------
 * Think公共函数库
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Common
 * @author   liu21st <liu21st@gmail.com>
 * @version  $Id$
 +------------------------------------------------------------------------------
 */


// URL组装 支持不同模式和路由 2010-2-5 更新
function U($url, $params = false, $redirect = false, $suffix = true)
{
	// 普通模式
	if (false === strpos($url, '/')) {
		$url .='//';
	}

	// 填充默认参数
	$urls = explode('/',$url);
	$app  = ($urls[0]) ? strtolower($urls[0]) : strtolower(APP_NAME);
	$mod  = ($urls[1]) ? $urls[1] : 'index';
	$act  = ($urls[2]) ? $urls[2] : 'index';

	$app1	=	($urls[0]) ? $urls[0] : APP_NAME;
	$mod1	=	($urls[1]) ? $urls[1] : 'Index';
	$act1	=	($urls[2]) ? $urls[2] : 'index';
	
	if(is_array($params)){
		foreach($params as $k=>$v){
			$param[] = $k.'='.$v;
		}
		$url_param = '?'.implode('&',$param);
	}
	
	//url重写
		if($app=='home'){
		if($mod == 'user'){
			if($act == 'index'){
				$site_url = "/main/";
			}else{
				$site_url = '/main/'.$act.'/'.$url_param;
			}
		}elseif($mod == 'space'){
			if($act == 'index'){
				if(is_numeric($params['uid'])){
					$site_url = '/profile/'.$params['uid'];
				}else{
					$site_url = '/'.$params['uid'];
				}
			}else{
				$site_url = '/profile/'.$act.'/'.$params['uid'];
			}
		}elseif($mod == 'account'){
			$site_url = '/setting/'.$act.'/'.$url_param;
		}elseif($mod == 'info'){
			if($act == 'index'){
				$site_url = '/info/';
			}elseif($act == 'detail' && is_numeric($params['ind'])){
				$site_url = '/info/'.$params['ind'];
			}else{
				$site_url = '/info/'.$act.'/'.$url_param;
			}
		}elseif($mod=='friend'){
			if($act == 'index'){
				$site_url = '/friend/';
			}else{
				$site_url = '/friend/'.$act.'/'.$url_param;
			}
		}elseif($mod=='project'){
			if($act == 'index'){
				$site_url = '/project/';
			}elseif($act == 'project_detail' && is_numeric($params['pro_id'])){
				$site_url = '/project/'.$params['pro_id'];
			}else{
				$site_url = '/project/'.$act.'/'.$url_param;
			}
		}elseif($mod=='public'){
			if($act=='login'){
				$site_url = '/login/';
			}elseif($act=='register'){
				//$site_url = $url_param ? '/register/'.$url_param:'/register/';
					$site_url = '/adminsite/';
			}else{
				$site_url = '/pub/'.$act.'/'.$url_param;
			}
		}else{
			$site_url = '/'.$mod.'/'.$act.'/'.$url_param;
		}
	}elseif($app=='group'){
		if($mod == 'index'){
			if($act == 'index'){
				$site_url = '/group/';
			}else{
				$site_url = '/group/'.$act.'/'.$url_param;
			}
		}elseif($mod=='group'){
			$site_url = '/gdetail/'.$act.'/'.$url_param;
		}else{
			$site_url = '/group/'.$mod.'/'.$act.'/'.$url_param;
		}
	}elseif($app=='event'){
		if($mod == 'index'){
			if($act == 'index'){
				$site_url = '/event/';
			}elseif($act=='eventdetail'){
				$site_url = '/eventdetail/'.$params['id'];
			}else{
				$site_url = '/event/'.$act.'/'.$url_param;
			}
		}else{
			$site_url = '/event/'.$mod.'/'.$act.'/'.$url_param;
		}
	}elseif($app=='weibo'){
		if($mod == 'index'){
			if($act == 'index'){
				$site_url = '/weibo/';
			}else{
				$site_url = '/weibo/'.$act.'/'.$url_param;
			}
		}else{
			$site_url = '/weibo/'.$mod.'/'.$act.'/'.$url_param;
		}
	}elseif($app=='admin'){
		if($mod == 'index' && $act == 'index'){
			$site_url = '/adminsite/';
		}else{
			$site_url = '/adminsite/'.$mod.'/'.$act.'/'.$url_param;
		}
	}else{
		$site_url = '/'.$app.'/'.$mod.'/'.$act.'/'.$url_param;
	}
	
	if(empty($site_url)){
		// 组合默认路径
		$site_url	=	'/index.php?'.C('VAR_APP').'='.$app1.'&'.C('VAR_MODULE').'='.$mod1.'&'.C('VAR_ACTION').'='.$act1;
		
		// 填充附加参数
		if ($params) {
			if (is_array($params)) {
				$params = http_build_query($params);
				$params = urldecode($params);
			}
			$params = str_replace('&amp;', '&', $params);
			$site_url .= '&' . $params;
		}
		
		// 开启路由和Rewrite
		if (C('URL_ROUTER_ON')) {
			// 载入路由
			$router_ruler = C('router');
			$router_key   = $app . '/' . ucfirst($mod) . '/' . $act;
			
			//路由命中
			if (isset($router_ruler[$router_key])){
				//填充路由参数
				$site_url = SITE_URL . '/' . $router_ruler[$router_key];
	
				//填充附加参数
				if ($params) {
					// 解析替换URL中的参数
					parse_str($params, $r);
					foreach ($r as $k => $v) {
						if (strpos($site_url, '['.$k.']'))
							$site_url = str_replace('['.$k.']', $v, $site_url);
						else
							$lr[$k]	= $v;
					}
	
					// 填充剩余参数
					if (is_array($lr) && count($lr) > 0)
						$site_url .= '?' . http_build_query($lr);
				}
				// 去除URL中无替换的参数
				$site_url = preg_replace('/\/\[(.+?)\]/i', '', $site_url);
			}
		}
	}

	//输出地址或跳转
	$site_url = SITE_URL.$site_url;
	if($redirect){
		redirect($site_url);
	}else{
		return $site_url;
	}
}

/**
 +----------------------------------------------------------
 * 字符串命名风格转换
 * type
 * =0 将Java风格转换为C的风格
 * =1 将C风格转换为Java的风格
 +----------------------------------------------------------
 * @access protected
 +----------------------------------------------------------
 * @param string $name 字符串
 * @param integer $type 转换类型
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function parse_name($name,$type=0) {
    if($type) {
        return ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));
    }else{
        $name = preg_replace("/[A-Z]/", "_\\0", $name);
        return strtolower(trim($name, "_"));
    }
}

// 错误输出
function halt($error) {
    if(IS_CLI)   exit ($error);
    $e = array();
    if(C('APP_DEBUG')){
        //调试模式下输出错误信息
        if(!is_array($error)) {
            $trace = debug_backtrace();
            $e['message'] = $error;
            $e['file'] = $trace[0]['file'];
            $e['class'] = $trace[0]['class'];
            $e['function'] = $trace[0]['function'];
            $e['line'] = $trace[0]['line'];
            $traceInfo='';
            $time = date("y-m-d H:i:m");
            foreach($trace as $t)
            {
                $traceInfo .= '['.$time.'] '.$t['file'].' ('.$t['line'].') ';
                $traceInfo .= $t['class'].$t['type'].$t['function'].'(';
                $traceInfo .= implode(', ', $t['args']);
                $traceInfo .=")<br/>";
            }
            $e['trace']  = $traceInfo;
        }else {
            $e = $error;
        }
        // 包含异常页面模板
        include C('TMPL_EXCEPTION_FILE');
    }
    else
    {
        //否则定向到错误页面
        $error_page =   C('ERROR_PAGE');
        if(!empty($error_page)){
            redirect($error_page);
        }else {
            if(C('SHOW_ERROR_MSG'))
                $e['message'] =  is_array($error)?$error['message']:$error;
            else
                $e['message'] = C('ERROR_MESSAGE');
            // 包含异常页面模板
            include C('TMPL_EXCEPTION_FILE');
        }
    }
    exit;
}

// URL重定向
function redirect($url,$time=0,$msg='') {
    //多行URL地址支持
    $url = str_replace(array("\n", "\r"), '', $url);
    if(empty($msg))
        $msg    =   "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if(0===$time) {
            header("Location: ".$url);
        }else {
            header("refresh:{$time};url={$url}");
            // 防止手机浏览器下的乱码
            $str = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            $msg = $str . $msg;
            echo($msg);
        }
        exit();
    }else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if($time!=0)
            $str   .=   $msg;
        exit($str);
    }
}

// 自定义异常处理
function throw_exception($msg,$type='ThinkException',$code=0)
{
    if(IS_CLI)   exit($msg);
    if(class_exists($type,false))
        throw new $type($msg,$code,true);
    else
        halt($msg);        // 异常类型不存在则输出错误信息字串
}

// 区间调试开始
function debug_start($label='')
{
    $GLOBALS[$label]['_beginTime'] = microtime(TRUE);
    if ( MEMORY_LIMIT_ON )  $GLOBALS[$label]['_beginMem'] = memory_get_usage();
}

// 区间调试结束，显示指定标记到当前位置的调试
function debug_end($label='')
{
    $GLOBALS[$label]['_endTime'] = microtime(TRUE);
    echo '<div style="text-align:center;width:100%">Process '.$label.': Times '.number_format($GLOBALS[$label]['_endTime']-$GLOBALS[$label]['_beginTime'],6).'s ';
    if ( MEMORY_LIMIT_ON )  {
        $GLOBALS[$label]['_endMem'] = memory_get_usage();
        echo ' Memories '.number_format(($GLOBALS[$label]['_endMem']-$GLOBALS[$label]['_beginMem'])/1024).' k';
    }
    echo '</div>';
}

// 浏览器友好的变量输出
function dump($var, $echo=true,$label=null, $strict=true)
{
    $label = ($label===null) ? '' : rtrim($label) . ' ';
    if(!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre style="text-align:left">'.$label.htmlspecialchars($output,ENT_QUOTES).'</pre>';
        } else {
            $output = $label . " : " . print_r($var, true);
        }
    }else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if(!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre style="text-align:left">'. $label. htmlspecialchars($output, ENT_QUOTES). '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}

// 取得对象实例 支持调用类的静态方法
function get_instance_of($name,$method='',$args=array())
{
    static $_instance = array();
    $identify   =   empty($args)?$name.$method:$name.$method.to_guid_string($args);
    if (!isset($_instance[$identify])) {
        if(class_exists($name)){
            $o = new $name();
            if(method_exists($o,$method)){
                if(!empty($args)) {
                    $_instance[$identify] = call_user_func_array(array(&$o, $method), $args);
                }else {
                    $_instance[$identify] = $o->$method();
                }
            }
            else
                $_instance[$identify] = $o;
        }
        else
            halt(L('_CLASS_NOT_EXIST_').':'.$name);
    }
    return $_instance[$identify];
}

/**
 +----------------------------------------------------------
 * 系统自动加载ThinkPHP基类库和当前项目的model和Action对象
 * 并且支持配置自动加载路径
 +----------------------------------------------------------
 * @param string $name 对象类名
 +----------------------------------------------------------
 * @return void
 +----------------------------------------------------------
 */
function __autoload($name)
{
    // 检查是否存在别名定义
    if(alias_import($name)) return ;
    // 自动加载当前项目的Actioon类和Model类
    if(substr($name,-5)=="Model") {
        require_cache(LIB_PATH.'Model/'.$name.'.class.php');
    }elseif(substr($name,-6)=="Action"){
        require_cache(LIB_PATH.'Action/'.$name.'.class.php');
    }else {
        // 根据自动加载路径设置进行尝试搜索
        if(C('APP_AUTOLOAD_PATH')) {
            $paths  =   explode(',',C('APP_AUTOLOAD_PATH'));
            foreach ($paths as $path){
                if(import($path.$name)) {
                    // 如果加载类成功则返回
                    return ;
                }
            }
        }
    }
    return ;
}

// 优化的require_once
function require_cache($filename)
{
    static $_importFiles = array();
    $filename   =  realpath($filename);
    if (!isset($_importFiles[$filename])) {
        if(file_exists_case($filename)){
            require $filename;
            $_importFiles[$filename] = true;
        }
        else
        {
            $_importFiles[$filename] = false;
        }
    }
    return $_importFiles[$filename];
}

// 区分大小写的文件存在判断
function file_exists_case($filename) {
    if(is_file($filename)) {
        if(IS_WIN && C('APP_FILE_CASE')){
            if(basename(realpath($filename)) != basename($filename))
                return false;
        }
        return true;
    }
    return false;
}

/**
 +----------------------------------------------------------
 * 导入所需的类库 同java的Import
 * 本函数有缓存功能
 +----------------------------------------------------------
 * @param string $class 类库命名空间字符串
 * @param string $baseUrl 起始路径
 * @param string $ext 导入的文件扩展名
 +----------------------------------------------------------
 * @return boolen
 +----------------------------------------------------------
 */
function import($class,$baseUrl = '',$ext='.class.php')
{
    static $_file = array();
    static $_class = array();
    $class    =   str_replace(array('.','#'), array('/','.'), $class);
    if('' === $baseUrl && false === strpos($class,'/')) {
        // 检查别名导入
        return alias_import($class);
    }    //echo('<br>'.$class.$baseUrl);
    if(isset($_file[$class.$baseUrl]))
        return true;
    else
        $_file[$class.$baseUrl] = true;
    $class_strut = explode("/",$class);
    if(empty($baseUrl)) {
        if('@'==$class_strut[0] || APP_NAME == $class_strut[0] ) {
            //加载当前项目应用类库
            $baseUrl   =  dirname(LIB_PATH);
            $class =  str_replace(array(APP_NAME.'/','@/'),LIB_DIR.'/',$class);
        }elseif(in_array(strtolower($class_strut[0]),array('think','org','com'))) {
            //加载ThinkPHP基类库或者公共类库
            // think 官方基类库 org 第三方公共类库 com 企业公共类库
            $baseUrl =  THINK_PATH.'/Lib/';
        }else {
            // 加载其它项目应用类库
            $class    =   substr_replace($class, '', 0,strlen($class_strut[0])+1);
			$baseUrl =  APPS_PATH.'/'.$class_strut[0].'/'.LIB_DIR.'/';
        }
    }
    if(substr($baseUrl, -1) != "/")    $baseUrl .= "/";
    $classfile = $baseUrl . $class . $ext;
	if($ext == '.class.php' && is_file($classfile)) {
        // 冲突检测
        $class = basename($classfile,$ext);
        if(isset($_class[$class]))
            throw_exception(L('_CLASS_CONFLICT_').':'.$_class[$class].' '.$classfile);
        $_class[$class] = $classfile;
    }
    //导入目录下的指定类库文件
    return require_cache($classfile);
}

/**
 +----------------------------------------------------------
 * 基于命名空间方式导入函数库
 * load('@.Util.Array')
 +----------------------------------------------------------
 * @param string $name 函数库命名空间字符串
 * @param string $baseUrl 起始路径
 * @param string $ext 导入的文件扩展名
 +----------------------------------------------------------
 * @return void
 +----------------------------------------------------------
 */
function load($name,$baseUrl='',$ext='.php') {
    $name    =   str_replace(array('.','#'), array('/','.'), $name);
    if(empty($baseUrl)) {
        if(0 === strpos($name,'@/')) {
            //加载当前项目函数库
            $baseUrl   =  APP_PATH.'/Common/';
            $name =  substr($name,2);
        }else{
            //加载ThinkPHP 系统函数库
            $baseUrl =  THINK_PATH.'/Common/';
        }
    }
    if(substr($baseUrl, -1) != "/")    $baseUrl .= "/";
    include $baseUrl . $name . $ext;
}

// 快速导入第三方框架类库
// 所有第三方框架的类库文件统一放到 系统的Vendor目录下面
// 并且默认都是以.php后缀导入
function vendor($class,$baseUrl = '',$ext='.php')
{
    if(empty($baseUrl))  $baseUrl    =   VENDOR_PATH;
    return import($class,$baseUrl,$ext);
}

// 快速定义和导入别名
function alias_import($alias,$classfile='') {
    static $_alias   =  array();
    if('' !== $classfile) {
        // 定义别名导入
        $_alias[$alias]  = $classfile;
        return ;
    }
    if(is_string($alias)) {
        if(isset($_alias[$alias]))
            return require_cache($_alias[$alias]);
    }elseif(is_array($alias)){
        foreach ($alias as $key=>$val)
            $_alias[$key]  =  $val;
        return ;
    }
    return false;
}

/**
 +----------------------------------------------------------
 * D函数用于实例化Model
 +----------------------------------------------------------
 * @param string name Model名称
 * @param string app Model所在项目
 +----------------------------------------------------------
 * @return Model
 +----------------------------------------------------------
 */
function D($name='',$app='')
{
    static $_model = array();
    static $_app   = array();
    if(empty($name)) return new Model;
    if(empty($app))   $app =  APP_NAME;
    if(isset($_model[$app.$name]))
        return $_model[$app.$name];
    $OriClassName = $name;
    if(strpos($name,C('APP_GROUP_DEPR'))) {
        $array   =  explode(C('APP_GROUP_DEPR'),$name);
        $name = array_pop($array);
        $className =  $name.'Model';
        import($app.'.Model.'.implode('.',$array).'.'.$className);
    }else{
        $className =  $name.'Model';
    	$_ENV['app'] = $app;
        import($app.'.Model.'.$className);
    }
    if(class_exists($className)){
        $model = new $className();
    }else{
        $model  = new Model($name);
    }
    $_model[$app.$OriClassName] =  $model;
    return $model;
}

/**
 +----------------------------------------------------------
 * M函数用于实例化一个没有模型文件的Model
 +----------------------------------------------------------
 * @param string name Model名称
 +----------------------------------------------------------
 * @return Model
 +----------------------------------------------------------
 */
function M($name='',$class='Model'){
    static $_model = array();
    if(!isset($_model[$name.'_'.$class]))
        $_model[$name.'_'.$class]   = new $class($name);
    return $_model[$name.'_'.$class];
}

/**
 +----------------------------------------------------------
 * A函数用于实例化Action
 +----------------------------------------------------------
 * @param string name Action名称
 * @param string app Model所在项目
 +----------------------------------------------------------
 * @return Action
 +----------------------------------------------------------
 */
function A($name,$app='@')
{
    static $_action = array();
    if(isset($_action[$app.$name]))
        return $_action[$app.$name];
    $OriClassName = $name;
    if(strpos($name,C('APP_GROUP_DEPR'))) {
        $array   =  explode(C('APP_GROUP_DEPR'),$name);
        $name = array_pop($array);
        $className =  $name.'Action';
        import($app.'.Action.'.implode('.',$array).'.'.$className);
    }else{
        $className =  $name.'Action';
        import($app.'.Action.'.$className);
    }
    if(class_exists($className)) {
        $action = new $className();
        $_action[$app.$OriClassName] = $action;
        return $action;
    }else {
        return false;
    }
}

function api($name) {
    static $_api = array();
//    $name = strtolower($name);
    if(isset($_api[$name])){
        return $_api[$name];
    }
    $OriClassName = $name;
    $className = $name.'Api';
    require_once(SITE_PATH.'/api/'.$name.'Api.class.php');
    if(class_exists($className)) {
        $api = new $className(true);
        $_api[$OriClassName] = $api;
        return $api;
    }else {
        return false;
    }     
}



// 远程调用模块的操作方法
function R($module,$action,$app='@') {
    $class = A($module,$app);
    if($class)
        return call_user_func(array(&$class,$action));
    else
        return false;
}

// 获取和设置语言定义(不区分大小写)
function L($name=null,$value=null) {
    static $_lang = array();
    // 空参数返回所有定义
    if(empty($name)) return $_lang;
    // 判断语言获取(或设置)
    // 若不存在,直接返回全大写$name
    if (is_string($name) )
    {
        $name = strtoupper($name);
        if (is_null($value))
            return isset($_lang[$name]) ? $_lang[$name] : $name;
        $_lang[$name] = $value;// 语言定义
        return;
    }
    // 批量定义
    if (is_array($name))
        $_lang += array_change_key_case($name,CASE_UPPER);
    return;
}

// 获取配置值
function C($name=null,$value=null)
{
    static $_config = array();
    // 无参数时获取所有
    if(empty($name)) return $_config;
    // 优先执行设置获取或赋值
    if (is_string($name))
    {
        if (!strpos($name,'.')) {
            $name = strtolower($name);
            if (is_null($value))
                return isset($_config[$name])? $_config[$name] : null;
            $_config[$name] = $value;
            return;
        }
        // 二维数组设置和获取支持
        $name = explode('.',$name);
        $name[0]   = strtolower($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : null;
        $_config[$name[0]][$name[1]] = $value;
        return;
    }
    // 批量设置
    if(is_array($name))
        return $_config = array_merge($_config,array_change_key_case($name));
    return null;// 避免非法参数
}

// 处理标签
function tag($name,$params=array()) {
    $tags   =  C('_tags_.'.$name);
    if($tags) {
        foreach ($tags   as $key=>$call){
            if(is_callable($call))
                $result = call_user_func_array($call,$params);
        }
        return $result;
    }
    return false;
}

// 实例化hook
function hook($name,$params=array()) {
    return X($name,$params=array(),'Hook');
}

// 实例化插件
function plugin($name,$params=array()) {
    return X($name,$params=array(),'Plugin');
}

// 实例化服务
function service($name,$params=array()) {
    return X($name,$params=array(),'Service');
}


// 实例化widget
function widget($name,$params=array(),$return=false) {
    return W($name,$params,$return);
}

// 实例化model
function model($name,$params=array()) {
    return X($name,$params=array(),'Model');
}

// 调用接口服务
function X($name,$params=array(),$domain='Service') {
    static $_service = array();
    //if(empty($app))
    $app =  C('DEFAULT_APP');

    if(isset($_service[$domain.'_'.$app.'_'.$name]))
        return $_service[$domain.'_'.$app.'_'.$name];

	$class = $name.$domain;
	if(file_exists(LIB_PATH.$domain.'/'.$class.'.class.php')){
		require_cache(LIB_PATH.$domain.'/'.$class.'.class.php');
	}else{
		require_cache(SITE_PATH.'/addons/'.strtolower($domain).'s/'.$class.'.class.php');
	}
	//服务不可用时 记录日志 或 抛出异常
	if(class_exists($class)){
		$obj   =  new $class($params);
		$_service[$domain.'_'.$app.'_'.$name] =  $obj;
		return $obj;
	}else{
		throw_exception(L('_CLASS_NOT_EXIST_').':'.$class);
	}
}

// 获取勋章类的一个实例
function medal($name) {
	if ( empty($name) )
		return ;
		
	static $_medal = array();
	if ( isset($_medal[$name]) )
		return $_medal[$name];
		
	$classname	= ucfirst($name) . 'Medal';
	$filename	= $classname . '.class.php';
	$basepath	= SITE_PATH . '/addons/plugins/Medal';
	$filepath	= $basepath . '/' . $name . '/' . $filename;
	
	// 加载基类
	if ( ! class_exists('BaseMedal') )
		require_cache($basepath . '/BaseMedal.class.php');
	
	if ( file_exists($filepath) )
		require_cache($filepath);
		
	if ( class_exists($classname) ) {
		$_medal[$name]	= new $classname();
		return $_medal[$name];
	}else {
		throw_exception(L('_CLASS_NOT_EXIST_').':'.$classname);
	}
}


// 执行 行为
//function B($name,$options=null) {
//    $class = 'BrowseBehavior';
//	if(file_exists(SITE_PATH.'/services/BrowseBehavior'.$class.'.class.php')){
//		require_cache(SITE_PATH.'/services/BrowseBehavior'.$class.'.class.php');
//	}else{
//		require_cache(SITE_PATH.'/addons/behaviors/'.$class.'.class.php');
//	}
//    $behavior   =  new $class($options);
//    return $behavior->run();
//}

// 渲染输出Widget
function W($name, $data = array(), $return = false) {
    $class = $name.'Widget';
    if(file_exists(LIB_PATH.'Widget/'.$class.'.class.php')){
		require_cache(LIB_PATH.'Widget/'.$class.'.class.php');
	}else{
		require_cache(SITE_PATH.'/addons/widgets/'.$class.'.class.php');
	}
    if(!class_exists($class))
        throw_exception(L('_CLASS_NOT_EXIST_').':'.$class);
    $widget		=	new $class();
    $content	=	$widget->render($data);
    if($return)
        return $content;
    else
        echo $content;
}

// 全局缓存设置和读取
function S($name,$value='',$expire='',$type='') {
//    static $_cache = array();
//    alias_import('Cache');
    //取得缓存对象实例
//    $cache  = Cache::getInstance($type);

    require_once CORE_PATH . '/sociax/Cache.class.php';
    require_once CORE_PATH . '/sociax/CacheFile.class.php';
    
    $cache = new CacheFile();
    if('' !== $value) {
        if(is_null($value)) {
            // 删除缓存
            $result =   $cache->rm($name);
            if($result)   unset($_cache[$type.'_'.$name]);
            return $result;
        }else{
            // 缓存数据
            $cache->set($name,$value,$expire);
            $_cache[$type.'_'.$name]     =   $value;
        }
        return ;
    }
    if(isset($_cache[$type.'_'.$name]))
        return $_cache[$type.'_'.$name];
    // 获取缓存数据
    $value      =  $cache->get($name);
    $_cache[$type.'_'.$name]     =   $value;
    return $value;
}

// 快速文件数据读取和保存 针对简单类型数据 字符串、数组
function F($name,$value='',$path=false) {
    static $_cache = array();
    if(!$path) {
    	$path	=	SITE_PATH.'/_runtime/_cache/';
    }
    if(!is_dir($path)) {
    	mkdir($path,0777,true);
    }
    $filename   =   $path.$name.'.php';
    if('' !== $value) {
        if(is_null($value)) {
            // 删除缓存
            return unlink($filename);
        }else {
            // 缓存数据
            $dir   =  dirname($filename);
            // 目录不存在则创建
            if(!is_dir($dir))  mkdir($dir);
            return file_put_contents($filename,"<?php\nreturn ".var_export($value,true).";\n?>");
        }
    }
    if(isset($_cache[$name])) return $_cache[$name];
    // 获取缓存数据
    if(is_file($filename)) {
        $value   =  include $filename;
        $_cache[$name]   =   $value;
    }else{
        $value  =   false;
    }
    return $value;
}

// 根据PHP各种类型变量生成唯一标识号
function to_guid_string($mix)
{
    if(is_object($mix) && function_exists('spl_object_hash')) {
        return spl_object_hash($mix);
    }elseif(is_resource($mix)){
        $mix = get_resource_type($mix).strval($mix);
    }else{
        $mix = serialize($mix);
    }
    return md5($mix);
}

//[RUNTIME]
// 编译文件
function compile($filename,$runtime=false) {
    $content = file_get_contents($filename);
    if(true === $runtime)
        // 替换预编译指令
        $content = preg_replace('/\/\/\[RUNTIME\](.*?)\/\/\[\/RUNTIME\]/s','',$content);
    $content = substr(trim($content),5);
    if('?>' == substr($content,-2))
        $content = substr($content,0,-2);
    return $content;
}

// 去除代码中的空白和注释
function strip_whitespace($content) {
    $stripStr = '';
    //分析php源码
    $tokens =   token_get_all ($content);
    $last_space = false;
    for ($i = 0, $j = count ($tokens); $i < $j; $i++)
    {
        if (is_string ($tokens[$i]))
        {
            $last_space = false;
            $stripStr .= $tokens[$i];
        }
        else
        {
            switch ($tokens[$i][0])
            {
                //过滤各种PHP注释
                case T_COMMENT:
                case T_DOC_COMMENT:
                    break;
                //过滤空格
                case T_WHITESPACE:
                    if (!$last_space)
                    {
                        $stripStr .= ' ';
                        $last_space = true;
                    }
                    break;
                default:
                    $last_space = false;
                    $stripStr .= $tokens[$i][1];
            }
        }
    }
    return $stripStr;
}
// 根据数组生成常量定义
function array_define($array) {
    $content = '';
    foreach($array as $key=>$val) {
        $key =  strtoupper($key);
        if(in_array($key,array('THINK_PATH','APP_NAME','APP_PATH','RUNTIME_PATH','RUNTIME_ALLINONE','THINK_MODE','NO_CACHE_RUNTIME')))
            $content .= 'if(!defined(\''.$key.'\')) ';
        if(is_int($val) || is_float($val)) {
            $content .= "define('".$key."',".$val.");";
        }elseif(is_bool($val)) {
            $val = ($val)?'true':'false';
            $content .= "define('".$key."',".$val.");";
        }elseif(is_string($val)) {
            $content .= "define('".$key."','".addslashes($val)."');";
        }
    }
    return $content;
}
//[/RUNTIME]

// 循环创建目录
function mk_dir($dir, $mode = 0755)
{
  if (is_dir($dir) || @mkdir($dir,$mode)) return true;
  if (!mk_dir(dirname($dir),$mode)) return false;
  return @mkdir($dir,$mode);
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents,$from,$to){
    $from   =  strtoupper($from)=='UTF8'? 'utf-8':$from;
    $to       =  strtoupper($to)=='UTF8'? 'utf-8':$to;
    if( strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents)) ){
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if(is_string($fContents) ) {
        if(function_exists('mb_convert_encoding')){
            return mb_convert_encoding ($fContents, $to, $from);
        }elseif(function_exists('iconv')){
            return iconv($from,$to,$fContents);
        }else{
            return $fContents;
        }
    }
    elseif(is_array($fContents)){
        foreach ( $fContents as $key => $val ) {
            $_key =     auto_charset($key,$from,$to);
            $fContents[$_key] = auto_charset($val,$from,$to);
            if($key != $_key )
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else{
        return $fContents;
    }
}

// xml编码
function xml_encode($data,$encoding='utf-8',$root="think") {
    $xml = '<?xml version="1.0" encoding="'.$encoding.'"?>';
    $xml.= '<'.$root.'>';
    $xml.= data_to_xml($data);
    $xml.= '</'.$root.'>';
    return $xml;
}

function data_to_xml($data) {
    if(is_object($data)) {
        $data = get_object_vars($data);
    }
    $xml = '';
    foreach($data as $key=>$val) {
        is_numeric($key) && $key="item id=\"$key\"";
        $xml.="<$key>";
        $xml.=(is_array($val)||is_object($val))?data_to_xml($val):$val;
        list($key,)=explode(' ',$key);
        $xml.="</$key>";
    }
    return $xml;
}

/**
 +----------------------------------------------------------
 * Cookie 设置、获取、清除 (支持数组或对象直接设置) 2009-07-9
 +----------------------------------------------------------
 * 1 获取cookie: cookie('name')
 * 2 清空当前设置前缀的所有cookie: cookie(null)
 * 3 删除指定前缀所有cookie: cookie(null,'think_') | 注：前缀将不区分大小写
 * 4 设置cookie: cookie('name','value') | 指定保存时间: cookie('name','value',3600)
 * 5 删除cookie: cookie('name',null)
 +----------------------------------------------------------
 * $option 可用设置prefix,expire,path,domain
 * 支持数组形式:cookie('name','value',array('expire'=>1,'prefix'=>'think_'))
 * 支持query形式字符串:cookie('name','value','prefix=tp_&expire=10000')
 * 2010-1-17 去掉自动序列化操作，兼容其它语言程序。
 */
function cookie($name,$value='',$option=null)
{
    // 默认设置
    $config = array(
        'prefix' => C('COOKIE_PREFIX'), // cookie 名称前缀
        'expire' => C('COOKIE_EXPIRE'), // cookie 保存时间
        'path'   => C('COOKIE_PATH'),   // cookie 保存路径
        'domain' => C('COOKIE_DOMAIN'), // cookie 有效域名
    );

    // 参数设置(会覆盖黙认设置)
    if (!empty($option)) {
        if (is_numeric($option)) {
            $option = array('expire'=>$option);
        }else if( is_string($option) ) {
            parse_str($option,$option);
    	}
    	$config	=	array_merge($config,array_change_key_case($option));
    }

    // 清除指定前缀的所有cookie
    if (is_null($name)) {
       if (empty($_COOKIE)) return;
       // 要删除的cookie前缀，不指定则删除config设置的指定前缀
       $prefix = empty($value)? $config['prefix'] : $value;
       if (!empty($prefix))// 如果前缀为空字符串将不作处理直接返回
       {
           foreach($_COOKIE as $key=>$val) {
               if (0 === stripos($key,$prefix)){
                    setcookie($_COOKIE[$key],'',time()-3600,$config['path'],$config['domain']);
                    unset($_COOKIE[$key]);
               }
           }
       }
       return;
    }
    $name = $config['prefix'].$name;

    if (''===$value){
        //return isset($_COOKIE[$name]) ? unserialize($_COOKIE[$name]) : null;// 获取指定Cookie
        return isset($_COOKIE[$name]) ? ($_COOKIE[$name]) : null;// 获取指定Cookie
    }else {
        if (is_null($value)) {
            setcookie($name,'',time()-3600,$config['path'],$config['domain']);
            unset($_COOKIE[$name]);// 删除指定cookie
        }else {
            // 设置cookie
            $expire = !empty($config['expire'])? time()+ intval($config['expire']):0;
            //setcookie($name,serialize($value),$expire,$config['path'],$config['domain']);
            setcookie($name,($value),$expire,$config['path'],$config['domain']);
            //$_COOKIE[$name] = ($value);
        }
    }
}
function ts_cookie($name,$value='',$option=null)
{
    // 默认设置
    $config = array(
        'prefix' => C('COOKIE_PREFIX'), // cookie 名称前缀
        'expire' => C('COOKIE_EXPIRE'), // cookie 保存时间
        'path'   => C('COOKIE_PATH'),   // cookie 保存路径
        'domain' => C('COOKIE_DOMAIN'), // cookie 有效域名
    );

    // 参数设置(会覆盖黙认设置)
    if (!empty($option)) {
        if (is_numeric($option)) {
            $option = array('expire'=>$option);
        }else if( is_string($option) ) {
            parse_str($option,$option);
    	}
    	$config	=	array_merge($config,array_change_key_case($option));
    }

    // 清除指定前缀的所有cookie
    if (is_null($name)) {
       if (empty($_COOKIE)) return;
       // 要删除的cookie前缀，不指定则删除config设置的指定前缀
       $prefix = empty($value)? $config['prefix'] : $value;
       if (!empty($prefix))// 如果前缀为空字符串将不作处理直接返回
       {
           foreach($_COOKIE as $key=>$val) {
               if (0 === stripos($key,$prefix)){
                    setcookie($_COOKIE[$key],'',time()-3600,$config['path'],$config['domain']);
                    unset($_COOKIE[$key]);
               }
           }
       }
       return;
    }
    $name = $config['prefix'].$name;

    if (''===$value){
        //return isset($_COOKIE[$name]) ? unserialize($_COOKIE[$name]) : null;// 获取指定Cookie
        return isset($_COOKIE[$name]) ? ($_COOKIE[$name]) : null;// 获取指定Cookie
    }else {
        if (is_null($value)) {
            setcookie($name,'',time()-3600,$config['path'],$config['domain']);
            unset($_COOKIE[$name]);// 删除指定cookie
        }else {
            // 设置cookie
            $expire = !empty($config['expire'])? time()+ intval($config['expire']):0;
            //setcookie($name,serialize($value),$expire,$config['path'],$config['domain']);
            setcookie($name,($value),$expire,$config['path'],$config['domain']);
            //$_COOKIE[$name] = ($value);
        }
    }
}

/**
 * 传统形式显示无限极分类树
 * @param array $data 树形结构数据
 * @param string $stable 所操作的数据表
 * @param integer $left 样式偏移
 * @param array $delParam 删除关联信息参数，app、module、method
 * @param integer $level 添加子分类层级，默认为0，则可以添加无限子分类
 * @param integer $times 用于记录递归层级的次数，默认为1，调用函数时，不需要传入值。
 * @param integer $limit 分类限制字数。
 * @return string 树形结构的HTML数据
 */
function showTreeCategory($data, $stable, $left, $delParam, $level = 0, $ext = '', $times = 1, $limit = 0) {
	$html = '<ul class="sort">';
	foreach($data as $val) {
		// 判断是否有符号
		$isFold = empty($val['child']) ? false : true;
		$html .= '<li id="'.$stable.'_'.$val['id'].'" class="underline" style="padding-left:'.$left.'px;"><div class="c1">';
		if($isFold) {
			$html .= '<a href="javascript:;" onclick="admin.foldCategory('.$val['id'].')"><img id="img_'.$val['id'].'" src="'.__THEME__.'/admin/image/on.png" /></a>';
		}
		$html .= '<span>'.$val['title'].'</span></div><div class="c2">';
		if($level == 0 || $times < $level) {
			$html .= '<a href="javascript:;" onclick="admin.addTreeCategory('.$val['id'].', \''.$stable.'\', '.$limit.');">添加子分类</a>&nbsp;-&nbsp;';
		}
		$html .= '<a href="javascript:;" onclick="admin.upTreeCategory('.$val['id'].', \''.$stable.'\', '.$limit.');">编辑</a>&nbsp;-&nbsp;';
		if(empty($delParam)) {
			$html .= '<a href="javascript:;" onclick="admin.rmTreeCategory('.$val['id'].', \''.$stable.'\');">删除</a>';
		} else {
			$html .= '<a href="javascript:;" onclick="admin.rmTreeCategory('.$val['id'].', \''.$stable.'\', \''.$delParam['app'].'\', \''.$delParam['module'].'\', \''.$delParam['method'].'\');">删除</a>';
		}
		$ext !== '' && $html .= '&nbsp;-&nbsp;<a href="'.U('admin/Public/setCategoryConf', array('cid'=>$val['id'], 'stable'=>$stable)).'&'.$ext.'">分类配置</a>';
		$html .= '</div><div class="c3">';
		$html .= '<a href="javascript:;" onclick="admin.moveTreeCategory('.$val['id'].', \'up\', \''.$stable.'\')" class="ico_top mr5"></a>';
		$html .= '<a href="javascript:;" onclick="admin.moveTreeCategory('.$val['id'].', \'down\', \''.$stable.'\')" class="ico_btm"></a>';
		$html .= '</div></li>';
		if(!empty($val['child'])) {
			$html .= '<li id="sub_'.$val['id'].'" style="display:none;">';
			$html .= showTreeCategory($val['child'], $stable, $left + 15, $delParam, $level, $ext, $times + 1, $limit);
			$html .= '</li>';
		}
	}
	$html .= '</ul>';

	return $html;
}
?>
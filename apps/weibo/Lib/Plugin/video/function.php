<?php 
/*function video_getContentUrl($url){
		return getShortUrl( $url[1] ).' ';
}

function video_getflash($link, $host) {
        $return = '';
        if('youku.com' == $host) {
                // http://v.youku.com/v_show/id_XNDg1MjA0ODg=.html
                preg_match_all("/id\_(\w+)[=.]/", $link, $matches);
                if(!empty($matches[1][0])) {
                        $return = $matches[1][0];
                }
        } elseif('ku6.com' == $host) {
                // http://v.ku6.com/show/bjbJKPEex097wVtC.html
                preg_match_all("/\/([\w\-]+)\.html/", $link, $matches);
                if(1 > preg_match("/\/index_([\w\-]+)\.html/", $link) && !empty($matches[1][0])) {
                        $return = $matches[1][0];
                }
        } elseif('youtube.com' == $host) {
                // http://tw.youtube.com/watch?v=hwHhRcRDAN0
                preg_match_all("/v\=([\w\-]+)/", $link, $matches);
                if(!empty($matches[1][0])) {
                        $return = $matches[1][0];
                }
        } elseif('5show.com' == $host) {
                // http://www.5show.com/show/show/160944.shtml
                preg_match_all("/\/(\d+)\.shtml/", $link, $matches);
                if(!empty($matches[1][0])) {
                        $return = $matches[1][0];
                }
        } elseif('mofile.com' == $host) {
                // http://tv.mofile.com/PPU3NTYW/
                //http://v.mofile.com/show/HLD5PLD2.shtml
                preg_match_all("/\/([\w\-]+)\.shtml/", $link, $matches);
                if(!empty($matches[1][0])) {
                        $return = $matches[1][0];
                }
        } elseif('sina.com.cn' == $host) {
                // http://you.video.sina.com.cn/b/16776316-1338697621.html
                //preg_match_all("/\/(\d+)-(\d+)\.html/", $link, $matches);
                //if(!empty($matches[1][0])) {
                        //$return = $matches[1][0];
                //}
        } elseif('sohu.com' == $host) {
                // http://v.blog.sohu.com/u/vw/1785928
                preg_match_all("/\/(\d+)\/*$/", $link, $matches);
                if(!empty($matches[1][0])) {
                        $return = $matches[1][0];
                }
        } elseif('tudou.com' == $host) {
		        // http://www.tudou.com/programs/view/oOrUqgezkOc/
		        //preg_match_all("/\/([\w\-]+)\/*$/", $link, $matches);
		      	//if(!empty($matches[1][0])) {
          	    		//$return = $matches[1][0];
        		//}
    	}
        return $return;
}*/

function video_getflashinfo($link, $host) {
        $return='';
        $content = file_get_contents($link);//获取
        if('youku.com' == $host)
        {
			preg_match('/http:\/\/v\.t\.sina\.com\.cn\/share\/share\.php\?[^"]+/i', $content, $share_url);
        	preg_match('/id\_(\w+)\.html/', $share_url[0], $flashvar);
        	preg_match('/pic=([^"&]+)/', $share_url[0], $img);
        	preg_match('/title=([^"&]+)/', $share_url[0], $title);
        	if (!empty($title[1])) {
				$title[1] = urldecode($title[1]);
        	} else {
        		preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	}
			if(!$img[1]){
				preg_match('/http:\/\/profile\.live\.com\/badge\/\?[^"]+/i', $content, $img_url);
				preg_match('/screenshot=([^"&]+)/', $img_url[0], $img);
			}
        }
        elseif('ku6.com' == $host)
        {
            preg_match("/\/([\w\-]+)\.html/",$link,$flashvar);
        	preg_match("/<span class=\"s_pic\">(.*?)<\/span>/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	$title[1] = iconv("GBK","UTF-8",$title[1]);
        }
        elseif('sina.com.cn' == $host)
        {
        	preg_match("/vid=(.*?)\/s\.swf/",$content,$flashvar);
        	preg_match("/pic\:[ ]*\'(.*?)\'/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);        	
        }
        elseif('tudou.com' == $host)
        {
        	preg_match('/i([0-9]+)\.html/', $link, $defaultIid );
        	if (empty($defaultIid[1])) {
        		preg_match('/,defaultIid = ([0-9]+)/', $content, $defaultIid );
        	}
			if (!empty($defaultIid[1])) {
        		preg_match('/iid:' . $defaultIid[1] . '\n,[\n\S]*icode:"([^"]+)"/', $content, $flashvar);
        		preg_match('/iid:' . $defaultIid[1] . '\n,[\n\S]*[\S ]*pic:"([^"]+)"/', $content, $img);
        		//preg_match('/iid:' . $defaultIid[1] . '\n,title:"([^"]+)"/', $content, $title);
        	}else{
        		preg_match('/iid_code[^\']+\'([^\']+)\'/', $content, $flashvar);
        		preg_match('/thumbnail[^\']+\'([^\']+)\'/', $content, $img);
        		//preg_match('/kw[^"]+"([^"]+)"/', $content, $title);
        	}
        	//if (empty($title[1])) {
        		preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	//}
        	$title[1] = iconv("GBK","UTF-8",$title[1]);
        }
 		elseif('youtube.com' == $host) {
 			
        }
        elseif('5show.com' == $host) {
        	
        }
        elseif('sohu.com' == $host) {
            preg_match("/vid=\"(.*?)\"/", $content, $flashvar);
        	preg_match('/\<meta property="og:image" content="([^"]+)" \/\>/', $content, $img);
        	preg_match("/<title>(.*?)<\/title>/", $content, $title);
        	$title[1] = iconv("GBK","UTF-8",$title[1]);
        }
        elseif('mofile.com' == $host)
        {
            preg_match("/\/([\w\-]+)\.shtml/",$link,$flashvar);
        	preg_match("/thumbpath=\"(.*?)\";/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        }

        $return['flashvar'] = $flashvar[1];
        $return['img']   = $img[1];
        $return['title'] = $title[1];
        return $return;
}
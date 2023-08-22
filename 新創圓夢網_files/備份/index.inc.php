<?php 
header('Content-Type: text/html; charset=utf-8');
header("Set-Cookie: hidden=value; httpOnly");
header('X-Frame-Options:DENY');
date_default_timezone_set('Asia/Taipei');

//https to http in 20190503 by 120
if( $_SERVER['SERVER_ADDR'] !='127.0.0.1'){
	if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || 
	   $_SERVER['HTTPS'] == 1) ||  
	   isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   
	   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
	{
	   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	   header('HTTP/1.1 301 Moved Permanently');
	   header('Location: ' . $redirect);
	   exit();
	}
}
if( isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'],'compatible')) {
	if (extension_loaded('zlib')) {
    	@ob_end_clean();
    	ob_start('ob_gzhandler');
  	}
} elseif(isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
  	if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    	if (extension_loaded('zlib')) {
      		$do_gzip_compress = true;
      		ob_start();
      		ob_implicit_flush(0);
      		if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
				header('Content-Encoding: gzip');
      		}
    	}
  	}
}
	//------ 擷取path -----
	$p_str_root="startup/";
	$p_ary_nowPageUrl=explode("/",dirname($_SERVER['PHP_SELF']));
	unset($p_ary_nowPageUrl[0]);
	$p_str_nowPageUrl=join("/",$p_ary_nowPageUrl); 
	$p_str_nowPageUrl=substr($p_str_nowPageUrl,(strrpos($p_str_nowPageUrl,$p_str_root)+strlen($p_str_root))); 
	$p_str_nowPageUrl=trim($p_str_nowPageUrl);  
	$p_str_dotPath="";
	if (strlen($p_str_nowPageUrl)>0){
		$p_ary_nowPageUrl=explode("/",$p_str_nowPageUrl);
		$p_str_dotPath=str_repeat("../",count($p_ary_nowPageUrl));
	}
	//------ 擷取path -----
	require_once($p_str_dotPath."includes/db.config.php"); 
	
	require_once($p_str_dotPath."includes/lib.inc.php"); 
	
	require_once($p_str_dotPath."includes/functions.inc.php"); 
		
	if( !(isset($p_obj_mydb) && is_object($p_obj_mydb))) $p_obj_mydb=f_pdoconn();
	
	//------ 擷取path -----
	
	$p_str_dotPath=f_getPathDot();
		
	//自動判斷裝置
 	autoChangeDevice();
	//fixXFS
	if(IS_XFS!=FALSE){fixXFS();}
	
	//GA監測連出網址使用
	$urlData=explode('/',$_SERVER['SCRIPT_NAME']);
	$formPage=($urlData[3])?$urlData[3]:"首頁";	
		
	//SEO
	$SeoData=getSEOData();
	$SeoTitle="新創圓夢網";	
	if(!empty($SeoData['title'])){
		$SeoTitle=(mb_strlen( $SeoData['title'] , "utf-8" ) > 15)?$SeoData['title']:$SeoData['title']."-新創圓夢網";
	}
	$SEO=array(
		"title"=>$SeoTitle,
		"description"=>($SeoData['description'])?$SeoData['description']:"新創圓夢網，臺灣最大的創業資源平台，提供創業貸款、創新創業、創業計劃書撰寫方法等資訊以及提供創業諮詢服務...。",
		"keywords"=>($SeoData['keywords'])?$SeoData['keywords'].",創業貸款,創業諮詢,青年創業貸款,微型創業貸款,創業計劃書,創業輔導,網路開店":"創業貸款,創業諮詢,青年創業貸款,微型創業貸款,創業計劃書,創業輔導,網路開店",
		"og_title"=>($SeoData['og_title'])?$SeoData['og_title']:"新創圓夢網",
		"og_img"=>($SeoData['og_img'])?$SeoData['og_img']:"https://sme.moeasmea.gov.tw/startup/images/web/fb_og_img.jpg",
		"og_description"=>($SeoData['og_description'])?$SeoData['og_description']:"新創圓夢網-臺灣最大創業創新資源網站平臺，提供創業貸款、創新創業、創業計劃書撰寫方法等資訊以及提供創業諮詢服務...。",
		"canonacal"=>($SeoData['canonacal'])?$SeoData['canonacal']:'',
		"m_canonacal"=>($SeoData['m_canonacal'])?$SeoData['m_canonacal']:'',
		"Schema"=>($SeoData['Schema'])?$SeoData['Schema']:'',
	);
?>
<!DOCTYPE html>
<html xmlns:fb="https://www.facebook.com/2008/fbml" lang="zh-Hant-TW">
<head>
	<script type = "application/ld+json" >
	{
		"@context": "http://schema.org",
		"@type": "Organization",
		"url": "https://sme.moeasmea.gov.tw/startup",
		"logo": "https://sme.moeasmea.gov.tw/startup/images/web/LOGO.png",
		"contactPoint": [{
			"@type": "ContactPoint",
			"telephone": "+886-8-0058-9168",
			"contactType": "customer service"
		}]
	} 
	</script>
	<?php if(!empty($SEO['Schema']))://結構化資料 2022.06.09 by 120?>
	<script type = "application/ld+json" >
		<?=$SEO['Schema']?>
	</script>
	<?php endif;?>
	<title><?=$SEO['title']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= $SEO['description']?>" />
	<meta name="keywords" content="<?= $SEO['keywords']?>" />
	<meta name="author" content="新創圓夢網">
	<meta name="company" content="經濟部中小企業處">
	<meta name="revisit-after" content="1 days">
	<meta name="rating" content="general">
	<meta name="robots" content="index,follow,noarchive">
	<meta property="og:site_name" content="新創圓夢網" />
	<meta property="og:title" content="<?= $SEO['og_title']?>" />
	<meta property="og:type" content="website" />
	<meta property="og:locale" content="zh_TW" />
	<meta property="og:image" content="<?= $SEO['og_img']?>" />
	<meta property="og:description" content="<?= $SEO['og_description']?>" />
	<meta property="fb:admins" content="532079607" />
	<meta property="fb:admins" content="10155894599357059" />
	<meta property="fb:admins" content="2331051563648497" />
	<meta property="fb:app_id" content="897249370336320" />
	<?php 
	//https://developers.google.com/search/mobile-sites/mobile-seo/other-devices?hl=zh-tw
	//if(!empty($SEO['canonacal'])){ echo "<link rel='canonical' href='{$SEO['canonacal']}' />"."\n";}
	//if(!empty($SEO['m_canonacal'])){echo "<link rel='alternate' media='only screen and (max-width: 640px)' href='{$SEO['m_canonacal']}'>"."\n";}
	if(!empty($SEO['m_canonacal'])){echo "<link rel='alternate' media='handheld' href='{$SEO['m_canonacal']}'>"."\n";}
	?>
	<link href="<?php echo $p_str_dotPath; ?>images/web/icon.ico" type="image/x-icon" rel="shortcut icon" />
	<link href="<?php echo $p_str_dotPath; ?>css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/bootstrap2.3.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $p_str_dotPath; ?>css/bootstrap-grid.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/swiper.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/bjqs.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/index.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/kyria.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $p_str_dotPath; ?>css/cycda.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo $p_str_dotPath; ?>css/common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $p_str_dotPath; ?>css/fund-button.css">	
	<link href="<?php echo $p_str_dotPath; ?>css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/style_2021.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/html5shiv.js"></script>
		<script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/respond.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]>
		<script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/jquery-2.1.0.min.js"></script>
	<![endif]-->	
	<!--[if !IE]>-->	
		<!-- <script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/jquery-2.1.0.min.js"></script> -->
		<script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/jquery-3.6.0.min.js"></script>
	<!--<![endif]-->
	<noscript>
		<P>本網頁需支援JAVASCRIPT，請修正您的瀏覽器設定，以便獲得最佳的瀏覽體驗</P>
	</noscript>	
</head>
<body>
<?
//顯示會員
online();
if(is_user())
{
	if(!(isset($user['image']) && !empty($user['image']) )) $user['image']=$p_str_dotPath.'images/web/login_btn.png';  //您好，陳先生，歡迎來到青年創業圓夢網！  [會員中心] [登出]
	if(!(isset($user['name']) && !empty($user['name']) )) $user['name']='Welcome!!'; 
	//$loginIcon='<a href="'.$p_str_dotPath.'modules/account"  style="text-decoration:none;color:#000000;" title="會員專區"><img src="'.$user['image'].'" width="16" height="19" style="height:19px;vertical-align:middle;" alt="'.$user['name'].'">&nbsp;'.substr($user['name'],0,20).'</a>，歡迎您！&nbsp;<a href="'.$p_str_dotPath.'modules/account"  style="font-weight:bold;text-decoration:none;color:#000000;" title="會員專區"><i class="fa fa-user" style="color:#000000;margin-top:5px;font-size:18px;"></i> 會員中心</a> &nbsp; <a href="/startup/modules/account/logout.php"  style="font-weight:bold;text-decoration:none;color:#000000" title="登出"> <i class="fa fa-sign-out" style="color:#000000;margin-top:5px;font-size:18px;"></i> 登出 </a> ';
	$loginIcon='<a href="'.$p_str_dotPath.'modules/account" class="menu-link" title="登入/註冊">會員中心</a>';
}
else $loginIcon='<a href="'.$p_str_dotPath.'modules/login" class="menu-link" title="登入/註冊">登入/註冊</a>';
?>
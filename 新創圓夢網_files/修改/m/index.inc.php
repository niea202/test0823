<?php 
	header('Content-Type: text/html; charset=utf-8');
	header("Set-Cookie: hidden=value; httpOnly");
	header('X-Frame-Options:DENY');
	date_default_timezone_set('Asia/Taipei');

	//------ 擷取path -----
	$p_str_root="startup/m/";

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
	
	require_once($p_str_dotPath."includes/m_functions.inc.php"); 

	require_once("../".$p_str_dotPath."includes/functions.inc.php"); 
	
	if( !(isset($p_obj_mydb) && is_object($p_obj_mydb))) $p_obj_mydb=f_pdoconn();
	
	
	//自動判斷裝置
 	autoChangeDevice();

	$p_str_dotPath=f_getPathDot();
	
	if($_GET){
		$_GET=chkData($_GET);
		$is_GET_tag=chkTag($_GET);
		if($is_tag!=''){
			alertmsg($is_tag);
			exit();
		}
	}
	if($_POST){
		$_POST=chkData($_POST);
		$is_POST_tag=chkTag($_POST);
		if($is_POST_tag!=''){
			alertmsg($is_POST_tag);
			exit();
		}
	}

	//------ 自動判斷目前所存在的模組 for GA 偵測聯外網站使用 -----
	$urlData=explode('/',$_SERVER['SCRIPT_NAME']);
	$formPage=($urlData[4])?$urlData[4]:"首頁";
	
	//SEO
	$SeoData=getMobileSEOData();
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<title><?= ($SEO['title'])?$SEO['title']:"找不到網頁"?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?= $SEO['description']?>" />
	<meta name="keywords" content="<?= $SEO['keywords']?>" />
	<meta name="author" content="新創圓夢網">
	<meta name="company" content="新創圓夢網">
	<meta name="revisit-after" content="1 days">
	<meta name="rating" content="general">
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
	if(!empty($SEO['canonacal'])){echo "<link rel='canonical' href='{$SEO['canonacal']}' />"."\n";}
	//if(!empty($SEO['m_canonacal'])){echo "	<link rel='alternate' media='only screen and (max-width: 640px)' href='{$SEO['m_canonacal']}'>"."\n";}
	?>
	<link href="<?php echo $p_str_dotPath; ?>images/web/icon.ico" type="image/x-icon" rel="shortcut icon" />
	<link href="<?php echo $p_str_dotPath; ?>css/reset_m.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $p_str_dotPath; ?>css/bootstrap2.3_m.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $p_str_dotPath; ?>css/bootstrap-grid.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/swiper.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $p_str_dotPath; ?>css/font-awesome.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo $p_str_dotPath; ?>css/calendar-mobile.css">
	<link rel="stylesheet" href="<?php echo $p_str_dotPath; ?>css/common-mobile.css">
	<link href="<?php echo $p_str_dotPath; ?>css/bjqs.css" rel="stylesheet" type="text/css">
	<!--<link href="<?php echo $p_str_dotPath; ?>css/index.css" rel="stylesheet" type="text/css">-->
	<!--<link href="<?php echo $p_str_dotPath; ?>css/kyria.css" rel="stylesheet" type="text/css"/>-->
	<!--<link href="<?php echo $p_str_dotPath; ?>css/cycda.css" rel="stylesheet" type="text/css">-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo $p_str_dotPath; ?>css/common.css">-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo $p_str_dotPath; ?>css/fund-button.css">	-->
	<link href="<?php echo $p_str_dotPath; ?>css/style_m.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $p_str_dotPath; ?>css/style_2021.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo $p_str_dotPath; ?>js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo$p_str_dotPath; ?>js/bootstrap.min.js"></script>	
	<script  type="text/javascript">g_str_dotPath="<?php echo $p_str_dotPath; ?>";</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({ pageLanguage: 'zh-TW', includedLanguages: 'zh-TW,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
	}
	</script>
</head>
<body>
<?
	//顯示會員
	/*
	online();
	if(is_user()){
		if(!(isset($user['image']) && !empty($user['image']) )) $user['image']=$p_str_dotPath.'images/web/login_btn.png'; 
		if(!(isset($user['name']) && !empty($user['name']) )) $user['name']='Welcome!!'; 
		$loginIcon='<a href="'.$p_str_dotPath.'modules/account"><img src="'.$user['image'].'" width="16" height="19">&nbsp;'.substr($user['name'],0,20).'</a>';
	}else{
		$loginIcon='<a href="'.$p_str_dotPath.'modules/login"><img src="'.$p_str_dotPath.'images/web/login_btn.png" width="16" height="19">&nbsp;登入/註冊</a>';
	}
	*/
?>
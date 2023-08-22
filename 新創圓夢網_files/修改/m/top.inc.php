<!-- nav bar start -->
<nav class="navbar">
	<div id="google_translate_element"></div>
	<a href="#u" accesskey="u" class="guiding-tile" title="選單連結區塊">:::</a>
	<div class="container">
		<div id="menu" name="menu">
			<div class="nav-main row">
				<a href="javascript:void(0);" title="開啟主選單" id="cross" name="cross" class="custom-toggle">
					<span class="cross"></span>
					<span class="cross"></span>
				</a>
				<h1 class="logo d-inline-block" title="新創圓夢網">
					<a href="<?php echo $p_str_dotPath; ?>" class="d-inline-block" title="新創圓夢網"><img src="<?php echo $p_str_dotPath; ?>images/web/LOGO.png"
							alt="新創圓夢網"></a>
				</h1>
				<a href="javascript:void(0);" class="custom-toggle" id="toggle" name="toggle" title="開啟選單與搜尋">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</a>
			</div>
			<!-- 上層選單 start -->
			<div class="nav-menu">
				<ul class="menu-list">
					<li class="menu-item"><a href="<?php echo $p_str_dotPath; ?>modules/download/" class="menu-link" title="下載專區"><span>下載專區</span></a></li>
					<li class="menu-item"><a href="https://startup.sme.gov.tw/" onclick="trackOutboundLink('https://startup.sme.gov.tw/','<?=$formPage?>'); return false;" class="menu-link" title="Foreigner info">Foreigner info</a></li>
					<?php if(!(isset($user['name']) && !empty($user['name']) )):?>
					<li class="menu-item"><a href="<?php echo $p_str_dotPath; ?>modules/login" class="menu-link" title="登入/註冊"><span>登入/註冊</span></a></li>
					<?php else:?>
					<li class="menu-item"><a href="<?php echo $p_str_dotPath; ?>modules/account" class="menu-link" title="會員中心"><span>會員中心</span></a></li>
					<li class="menu-item"><a href="<?php echo $p_str_dotPath; ?>modules/account/logout.php" class="menu-link" title="登出系統"><span>登出</span></a></li>
					<?php endif;?>
					<li class="menu-item" style="position: relative;">
						<form id="searchform" method="GET" action="<?php echo $p_str_dotPath; ?>modules/search/" class="m-0">
							<input type="text" placeholder="請輸入關鍵字" name="q" id="keyword" value="">
							<button type="submit" id="keyword-send" title="關鍵字搜尋">搜尋</button>	
						</form>
					</li>
				</ul>
			</div>
			<!-- 上層選單 end -->
			<!-- 主選單 start -->
			<div class="nav-menu-cross">
				<div class="container">
					<ul class="menu-list-cross">
						<li class="menu-item">
							<a href="javascript:void(0);" class="menu-link" title="關於我們" data-id="1">關於我們<span class="cross-more"><span class="cross-line"></span><span class="cross-line"></span></span></a>
							<ul class="more-list" id="more-list1">
								<li><a href="<?php echo $p_str_dotPath; ?>modules/article/aboutMe.php" title="認識新創圓夢網">認識圓夢網</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/introduction/" title="網站導覽">網站導覽</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/startuphub/about.php" title="新創基地">新創基地</a></li>
								<li><a href="/startupaward/" title="新創事業獎">新創事業獎</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/giverbar/" title="青創GiverBar">青創GiverBar</a></li>
								<li><a href="https://startup.sme.gov.tw/" title="Startup Portal Taiwan">Startup Portal Taiwan</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/epaper/" title="訂閱電子報">訂閱電子報</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/article/contactUs.php" title="聯絡我們">聯絡我們</a></li>
							</ul>
						</li>
						<li class="menu-item">
							<a href="javascript:void(0);" class="menu-link" title="資源搜尋" data-id="2">資源搜尋<span
									class="cross-more"><span class="cross-line"></span><span
										class="cross-line"></span></span></a>
							<ul class="more-list" id="more-list2">
								<li><a href="<?php echo $p_str_dotPath; ?>modules/rProject/" title="政府資源總覽">政府資源總覽</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/funding/" title="資金快搜">資金快搜</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/rmap/" title="資源地圖">資源地圖</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/rmap/creative_space_list.php" title="創育機構">創育機構</a></li>
								<!-- <li><a href="<?php echo $p_str_dotPath; ?>modules/infopack/detail/?sId=48" title="紓困資訊">紓困資訊</a></li> -->
								<li><a href="<?php echo $p_str_dotPath; ?>modules/infopack/detail/?sId=100" title="國際創業資源">國際創業資源</a></li>
								<li><a href="https://sme.moeasmea.gov.tw/startup/m/event/net_zero/" title="淨零排放資訊"  target="_blank">淨零排放資訊</a></li>
							</ul>
						</li>
						<li class="menu-item">
							<a href="javascript:void(0);" class="menu-link" title="活動消息" data-id="3">活動消息<span class="cross-more"><span class="cross-line"></span><span class="cross-line"></span></span></a>
							<ul class="more-list" id="more-list3">
								<li><a href="<?php echo $p_str_dotPath; ?>modules/news/" title="創業新訊">創業新訊</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/calendar/" title="近期活動">近期活動</a></li>
								<!-- <li><a href="<?php echo $p_str_dotPath; ?>modules/news/detial.php?sId=1287" title="國際線上連結">國際線上連結</a></li> -->
							</ul>
						</li>
						<li class="menu-item">
							<a href="javascript:void(0);" class="menu-link" title="創業工具" data-id="4">創業工具<span class="cross-more"><span class="cross-line"></span><span class="cross-line"></span></span></a>
							<ul class="more-list" id="more-list4">
								<li><a href="<?php echo $p_str_dotPath; ?>modules/faq/" title="創業QA">創業QA</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/talk/" title="預約諮詢">預約諮詢</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/infopack/" title="創業補給站">創業補給站</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/infopack/detail/?sId=69" title="遠距工具箱">遠距工具箱</a></li>
							</ul>
						</li>
						<li class="menu-item">
							<a href="javascript:void(0);" class="menu-link" title="成果亮點" data-id="5">成果亮點<span class="cross-more"><span class="cross-line"></span><span class="cross-line"></span></span></a>
							<ul class="more-list" id="more-list5">
								<li><a href="<?php echo $p_str_dotPath; ?>modules/highlight/" title="創業亮點">創業亮點</a></li>
								<li><a href="<?php echo $p_str_dotPath; ?>modules/startuphub/member.php" title="基地進駐團隊">基地進駐團隊</a></li>
								<li><a href="https://www.youtube.com/playlist?list=PLPON2GpIbbWHhbia7sVECHoSTgksdu_v4" onclick="trackOutboundLink('https://www.youtube.com/playlist?list=PLPON2GpIbbWHhbia7sVECHoSTgksdu_v4','<?=$formPage?>'); return false;" title="我是創業系">我是創業系</a></li>
								<li><a href="https://www.youtube.com/playlist?list=PLPON2GpIbbWHoYM_PKYz_IEc5LFj8g7yr" onclick="trackOutboundLink('https://www.youtube.com/playlist?list=PLPON2GpIbbWHoYM_PKYz_IEc5LFj8g7yr','<?=$formPage?>'); return false;" title="Podcast">Podcast</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<!-- 主選單 end -->
		</div>
	</div>
</nav>
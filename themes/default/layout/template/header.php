		<header>
			<a class="link_logo" href="{{CONFIG site_url}}">
				<img class="header__logo" src="{{CONFIG theme_url}}/img/logo.png"></img>
			</a>
			<!---->
			<div tabindex="0" class="onclick-menu onclick-menu-page">
				<span class="text_topbar_span text_topbar_span_page dp_page">{{LANG Menu_header}} <i class="fas fa-chevron-down"></i></span>
				<!--div class="dropdown-caret">
					<div class="caret-outer"></div>
					<div class="caret-inner"></div>
				</div-->
				<ul class="onclick-menu-content close-menu-content-page on_pages">
				
					<a href="{{CONFIG site_url}}/page/useterms"><li><span>{{LANG Terms_of_Use}}</span></li></a>
					<a href="{{CONFIG site_url}}/page/privacy"><li><span>{{LANG Privacy_Policy}}</span></li></a>
					{{DATA_FACEBOOK}}
					{{DATA_TWITTER}}
					{{DATA_EMAIL}}
				</ul>
			</div>			 
			<!---->
			<div tabindex="0" class="class_lags_div onclick-menu">
				<span class="text_topbar_span dp_lang">{{LANG languages_header}} <i class="fas fa-chevron-down"></i></span>
				<!--div class="dropdown-caret">
					<div class="caret-outer"></div>
					<div class="caret-inner"></div>
				</div-->
				<ul class="class_list_lang onclick-menu-content on_lang">
					<?php  echo displayLangSelect(''); ?>
				</ul>
			</div>
			<!---->
			<div class="dropdown_posts_box_header">
				<!---->
				<div class="account_posts_dropdown_header class_btn_login_header">
					<!--span id="stories_url_top" data-tooltip="{{LANG login}}">
						<i class="icon_user_header fas fa-user"></i>
					</span-->	
					<span id="stories_url_top"></span>
				</div>	
				<!---->
				<div class="submenu_header">
					<div class="dropdown-caret">
						<div class="caret-outer"></div>
						<div class="caret-inner"></div>
					</div>
					<ul class="root_header">
					<?php if(@$_COOKIE["m_user"]!=''){ ?>	
						<div id="drri_profile_user">
							<img id="img_profile_user_header" src="{{CONFIG theme_url}}/img/i_web_1.png"></img>
							<p id="drri_profile_user_p">{{ME_USER_NAME}}</p>
						</div>
						<li><a href="{{CONFIG site_url}}/me/history"><span>{{LANG history}}</span></a></li>
						<li><a href="{{CONFIG site_url}}/me/settings"><span>{{LANG Settings}}</span></a></li>
						<li><a href="{{CONFIG site_url}}/me/logout"><span>{{LANG Sign_off}}</span></a></li>
					<?php }else{} ?>	
					<?php if(@$CODE['USER_LOGIN']==true){ ?>	
						<li><a href="{{CONFIG site_url}}/me/register"><span>{{LANG register}}</span></a></li>
						<li><a href="{{CONFIG site_url}}/me/login"><span>{{LANG login}}</span></a></li>
					<?php }else{} ?>		
					</ul>
				</div>
				<!---->
			</div>
		</header>
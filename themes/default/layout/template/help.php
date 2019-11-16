 
	<div id="page" class="page">
	<!-- these are the files to generate the manners to download the videos --> 
	<!-- header -->	
	{{INCLUDE_HEADER}}
	<!-- END OF THE  header -->	
	<!-- section -->
	<section class="section_home">
	<!---->
		<div id="rotation_m"></div>
		<!-- background: linear-gradient(to right, #3d2fae, #6984d1); -->
		<div id="text_top_home">
			<p><br>
				<h2>{{LANG Privacy_Policy_page}}</h2>
			</p>
		</div>
	<!---->
		<div id="content_page_home">
	<!-- input of the search engine of videos and urls -->
			<div class="box_page_home">
<!-- Page_profile -->
<div class="page_index_home">
	<?php
		if($_GET['page'] == 'privacy'){
	?>
		following
	<?php
		} else if ($_GET['page'] == 'all_media') {
	?>
		
	<?php
		} else if ($_GET['page'] == 'help') {
	?>
		facebook 
	<?php		
	 	
		}else{
	?>
		Error - 404
	<?php		
		}
	?>
</div>

 
					 
				<!---->
				<div class="content_video">
 
				<!-- in the id="resultados" is to show in the content of the search engine -->	
					<div class="wall_two_div">
						<h2 class="h2_home">{{LANG site_Supported}}</h2>			
						{{ICONS_MEDIA}}
						<br>
						<div class="div_all_more_media">
							<a href="./" class="btn_all_more_media">{{LANG click_more_home}}</a>
						</div>
						<br><br>
					</div>
				</div>
				<!-- footer -->
				<div class="class_footer">
					<p class="class_footer_p_text">
						<b>{{NAME_SITE}}</b> Made with ❤️ by Csode<span> - {{DATA_YEAR}}</span>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- END OF THE section -->
	<!--div id="class_footer">
	</div-->
	</div>
 

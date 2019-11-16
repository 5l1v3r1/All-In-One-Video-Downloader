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
				<h2>{{LANG history}}</h2>
				 
			</p>
		</div>
	<!---->
		<div id="content_page_home">
	<!-- input of the search engine of videos and urls -->
			<div class="box_page_home">
				<div class="color_white_his wall_seach_home">
					<div class="text_modal_top">
						<p class="text_modal_top_p">{{LANG history}}</p>
					</div>
					<!---->
					<div id="close_load_modal" class="back_history class_back_search_btn" onclick="close_share_modal();">
						<!--i class="class_back_search_btn_icon fas fa-chevron-left"></i>{{LANG Back_search}}-->
					</div>
					<!---->
					{{LIST_DATA_HISTORY}}
				</div>
				<!-- footer -->
				{{INCLUDE_FOOTER}}
			</div>
		</div>
	</section>
	<!-- END OF THE section -->
	<!--div id="class_footer"-->

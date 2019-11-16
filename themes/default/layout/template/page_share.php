 
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
				<h2>{{LANG Text_1}}</h2>
				<h5>{{LANG Text_2}}</h5>
			</p>
		</div>
	<!---->
		<div id="content_page_home">
	<!-- input of the search engine of videos and urls -->
			<div class="box_page_home">
				<div class="wall_seach_home">
					<div class="class_back_search_btn" onclick="close_share();"><i class="class_back_search_btn_icon fas fa-chevron-left"></i>{{LANG Back_search}}</div>
					<div id="searcherror"></div>
					<div id="resultados"></div>
					<div id="ads_one_home" class="class_ads_css">
							{{ADS_ONE_CODE}}
						</div>
					<form id="liveSearch" method="POST">
						<input class="input_seach_home" type="text" placeholder="{{LANG Enter_url}}" name="search" id="search" value="">
						<button id="searchbtn" type="submit">
							<span id="loader_btn_no">{{LANG Get_link_btn}}</span>
							<span id="loader_btn"><i class="fa fa-spinner fa-spin"></i> {{LANG Get_link_btn_load}}</span>
						</button>						
						<br>
						<br>
						<!--a href="./page/help">
						<p class="class_help_home_p">
							<i class="icon_help fas fa-question-circle"></i> <span class="text_help_span">{{LANG help_home}}</span>
						</p>
						</a-->
					</form>
				</div>
				<!---->
				<div class="content_video">
					<div class="wall_one_div">
						<center class="advertising">
							<img class="banner1_img" src="{{CONFIG theme_url}}/img/banner1.png"></img>
						</center>
					</div>
					<br>
					<div class="class_ads_css">
						{{ADS_TWO_CODE}}
					</div>
				<!-- in the id="resultados" is to show in the content of the search engine -->	
					<div class="wall_two_div">
						<h2 class="h2_home">{{LANG site_Supported}}</h2>			
						{{ICONS_MEDIA}}
						<br>
						<div class="div_all_more_media">
							<a href="./page/all_media" class="btn_all_more_media">{{LANG click_more_home}}</a>
						</div>
						<br><br>
					</div>
				</div>
				<!-- footer -->
				{{INCLUDE_FOOTER}}
			</div>
		</div>
	</section>
	<!-- END OF THE section -->
	<!--div id="class_footer">
	</div-->
	</div>
	<!-- js.js file with ajax system functions -->
			
		<script>
		/*$('.text_topbar_span').on('click', function(){
		   $('.onclick-menu-content').css('display','block');
		})
		*/
		
			function close_share() {
				$("#resultados").hide();
				$(".class_back_search_btn").hide();
				$("#ads_one_home").hide();
				$("#liveSearch").show();
				$('#loader_btn_no').show();
				$('#loader_btn').hide();
			}
		// search of index
			$(document).ready(function () {
			  
				$('body').on('submit', '#liveSearch', function (e) {


					e.preventDefault();

					var DataString = new FormData($(this)[0]);
					var search = $("#search").val();
				  
					if (search == "") {

						$("#searcherror").html('<div class="error_div_data"><p class="error_div_data_p">{{LANG Error_1}}<br><span class="error_div_data_span">{{LANG Error_2}}</span></p></div>');
						$("#content_video").show();
						$("#resultados").hide();
					
					} else {

						$('#loader_btn_no').hide();
						$('#loader_btn').show();
						$("#searcherror").html("");
						$.ajax({
							url: Ajax_Requests_File(),
							// url: 'lib/module/search_MYSQL.php', only for mysql or mysqlite connection
							type: 'POST',
							data: DataString,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function () {

								$('#searcbtn').attr('disabled', 'disabled');
							},
							success: function (data) {

								$("#content_video").hide();
								$("#resultados").html(data).show();
								$(".class_back_search_btn").show();
								$("#ads_one_home").show();
								$("#liveSearch").hide();
								$('#searcbtn').removeAttr('disabled', 'disabled');
							},
							error: function(){
							   $("#searcherror").html('<center><br><br><img src="./assets/img/wifi_off.png"/><br><br></center>');
							   $("#resultados").hide();
							   $("#ads_one_home").hide();
						 
							}
						});
					}

				});
			   
			});
		</script>

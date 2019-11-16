 	<!---->
 	<div id="bg_anali_search">
		<div id="loader_noti_search_url">
			<div class="mas_div_anali">
				<img class="img_search_loader_anali" src="{{CONFIG theme_url}}/img/loader_search.gif"></img>
				<br>
				<p class="text_anali_search">{{LANG Analyzing_video_links}}</p>
			</div>
		</div>
	</div>
	<!---->
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
			<?php if (@$CODE['ACTIVE_MEDIA']=='ok'){
				$media = $CODE['ACTIVE_MEDIA_NAME'];
				include ('admin-panel/files/'.$media.'/lang.php');
				 
				echo '	<h2>'.$text_media.'</h2>
						<h5>'.$text_media_two.'</h5>
				';
			?>
			<?php }else{ ?>
				<h2>{{LANG Text_1}}</h2>
				<!--h5>{{LANG Text_2}}</h5-->
			<?php } ?>	
			</p>
		</div>
	<!---->
		<div id="content_page_home">
	<!-- input of the search engine of videos and urls -->
			<div class="box_page_home">
				<!---->
				<div id="ads_one_home" class="class_ads_css">
					{{ADS_ONE_CODE}}
				</div>
				<div class="wall_seach_home">
					<div class="class_modal_home_url">
						<div class="class_back_search_btn" onclick="close_share();">
							<!--i class="class_back_search_btn_icon fas fa-chevron-left"></i>{{LANG Back_search}}-->
						</div>
						<div id="searcherror"></div>
						<div id="resultados"></div>
					</div>
					<?php if (@$CODE['ACTIVE_SHARE']=='ok'){ ?>						
					<!---->
					<div class="class_ads_css">
						{{ADS_ONE_CODE}}
					</div>
					<div class="class_share_data class_modal_home_url">
						<a href="{{CONTAINER_URL_HOME}}">
							<div class="back_search_btn_on class_back_search_btn" onclick="close_share();">
								<!--i class="class_back_search_btn_icon fas fa-chevron-left"></i>{{LANG Back_search}}-->
							</div>
						</a>
						<div id="resultados">
							<?php echo @$CODE['share_data']; ?>					
						</div>	
					</div>	
					<?php }else{ ?>
					<form id="liveSearch" method="POST">
						<div class="class_search_div_d">
							<input class="input_seach_home" type="text" placeholder="{{LANG Enter_url}}" name="search" id="search" value="">
							<button id="searchbtn" type="submit">
								<span id="loader_btn_no_mm">
									<span id="loader_btn_no">{{LANG Download_file}}</span>
									<span id="loader_btn"><i class="fa fa-spinner fa-spin"></i> {{LANG Get_link_btn_load}}</span>
								</span>
							</button>
						</div>	
						<!--div class="spinner mb-8"></div-->						
						<br>
						<br>
						<!--a href="./page/help">
						<p class="class_help_home_p">
							<i class="icon_help fas fa-question-circle"></i> <span class="text_help_span">{{LANG help_home}}</span>
						</p>
						</a-->
					</form>
					<?php } ?>
				</div>
				<div class="class_ads_css">
					{{ADS_TWO_CODE}}
				</div>
				<!---->
				<div class="content_video">
					<div class="wall_one_div">
						<div class="box_videos_top_one">
							<img class="len_a img_videos_top" src="{{CONFIG theme_url}}/img/videos_hot.png"></img>
							<p class="text_videos_top_p">VIDEOS</p>
						</div>
						<!---->
						<center class="advertising">
							<img class="banner1_img" src="{{CONFIG theme_url}}/img/banner1.png"></img>
						</center>
					</div>
				<!-- in the id="resultados" is to show in the content of the search engine -->	
					<div class="wall_two_div">
						<!---->
						<div class="box_site_supported_top_home">
							<div class="box_site_supported_top_home_div_1">
								<h2 class="text_align_bb_h2 h2_home">{{LANG site_Supported}}</h2>
								<!--p class="text_site_supported_home">
								{{LANG info_plataforma}}
								</p-->
							</div>
							<div class="div_data_download_videos_home">
								<!---->
								<div class="div_data_download_videos_home_two">
									<p class="data_home_text_p">{{LANG Online_Video_Downloader}}</p>
									<img class="data_home_icon" src="{{CONFIG theme_url}}/img/ico_in_1.png"></img>
									<p class="data_home_text">{{LANG info_plataforma_2}}</p>
								</div>
								<!---->
								<div class="div_data_download_videos_home_two">
									<p class="data_home_text_p">{{LANG Any_Video_ite}}</p>
									<img class="data_home_icon" src="{{CONFIG theme_url}}/img/ico_in_2.png"></img>
									<p class="data_home_text">{{LANG info_plataforma}}</p>
								</div>
								<!---->
								<div class="div_data_download_videos_home_two">
									<p class="data_home_text_p">{{LANG Download_Audios}}</p>
									<img class="data_home_icon" src="{{CONFIG theme_url}}/img/ico_in_3.png"></img>
									<p class="data_home_text">{{LANG info_plataforma_3}}</p>
								</div>								
							</div>
							<div class="box_site_supported_top_home_div_2">	
								{{ICONS_MEDIA}}
								<br>
								<div class="div_all_more_media">
									<a href="./page/all_media" class="btn_all_more_media">{{LANG click_more_home}}</a>
								</div>
								<br><br>
							</div>
						</div>						
					</div>
					<!--div class="wall_three_div">
						<div class="box_site_supported_top_home">
							<div class="box_site_supported_top_home_div_1">	
								<img class="img_videos_top_b img_videos_top" src="{{CONFIG theme_url}}/img/dropbox.png"></img>
							</div>
							<div class="wall_slama box_site_supported_top_home_div_2">	
								<h2 class="text_align_bb_h2 h2_home">{{LANG site_Supported}}</h2>
								<p class="text_site_supported_home">
									text_more vesion 1.2.0
								</p>
							</div>
						</div>
					</div-->
					<div class="wall_four_div">
						<div class="div_all_data_user">
							<!--div class="plan_1_user">
								<div class="dis_data_top_user">
									<p class="dis_data_top_user_text">user no login
										<span class="dis_data_top_user_text_span">NORMAL</span>
									</p>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">2 descargas por día</p>
									<i class="div_text_data_bom_icon_no fas fa-times"></i>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">solo desgarcas de youtube</p>
									<i class="div_text_data_bom_icon_no fas fa-times"></i>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">inprotar videos a dropbox</p>
									<i class="div_text_data_bom_icon_no fas fa-times"></i>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">historial</p>
									<i class="div_text_data_bom_icon_no fas fa-times"></i>
								</div>
							</div-->
							<div class="plan_2_user">
								<div class="dis_data_top_user">
									<p class="dis_data_top_user_text">{{LANG Support_plan}}
										<!--span class="dis_data_top_user_text_span">PRO</span-->
									</p>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">{{LANG Support_plan_1}}</p>
									<i class="div_text_data_bom_icon fas fa-check"></i>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">{{LANG Support_plan_2}}</p>
									<i class="div_text_data_bom_icon fas fa-check"></i>
								</div>
								<!--div class="div_text_data_bom">
									<p class="div_text_data_bom_p">inprotar videos a dropbox</p>
									<i class="div_text_data_bom_icon fas fa-check"></i>
								</div-->
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">{{LANG Support_plan_3}}</p>
									<i class="div_text_data_bom_icon fas fa-check"></i>
								</div>
								<div class="div_text_data_bom">
									<p class="div_text_data_bom_p">{{LANG Support_plan_4}}</p>
									<i class="div_text_data_bom_icon fas fa-check"></i>
								</div>
								<br>
								<div class="div_icon_bb_logo">
									<img class="icon_bb_logo" src="{{CONFIG theme_url}}/img/icon.png"></img>
								</div>	
							</div>
						</div>
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
				$("#resultados_url").hide();
				$(".class_back_search_btn").hide();
				$(".class_modal_home_url").hide();
				$("#ads_one_home").hide();
				$("#liveSearch").show();
				$('#loader_btn_no').show();
				$('#loader_btn').hide();
				$('#bg_anali_search').hide();
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
						$('#bg_anali_search').show();
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
								$(".class_modal_home_url").show();
								$("#ads_one_home").show();
								$("#liveSearch").hide();
								$('#bg_anali_search').hide();
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

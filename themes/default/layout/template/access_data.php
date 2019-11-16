	<div id="page" class="page">
	<!-- these are the files to generate the manners to download the videos --> 
	<!-- header -->	
	{{INCLUDE_HEADER}}
	<!-- END OF THE  header -->	
	<!-- section -->
	<section class="section_home">
	<!---->
		<div id="rotation_m"></div>
		<div id="text_top_home">
			<p><br>
				<h2>{{TEXT_BTN_BOM}}</h2>
				 
			</p>
		</div>
	<!---->
		<div id="content_page_home">
	<!-- input of the search engine of videos and urls -->
			<div class="box_page_home">
				<div class="wall_seach_home">
					<!---->
					<form class="class_wall_login_more"  method="post" id="reg">
						<p class="ERRORS_data_page"><?php echo $CODE['ERRORS']; ?></p>
						<p class="SUCCESS_data_page"><?php echo $CODE['SUCCESS']; ?></p>
						<!---->
						
						<?php if(@$CODE['ACCESS'] == 'register'){ ?>
							<input type="hidden" name="sended" value="true"></input>
							<!---->
							<input class="login_input" type="text" name="username" id="username" placeholder="{{LANG username}}"  value="<?php echo $CODE['username']; ?>" required>
							<!---->
							<input class="login_input" type="password" name="password" id="password" placeholder="{{LANG password}}" required>
							<!---->
							<input class="login_input" type="text" name="email" id="email" placeholder="&#128231; {{LANG email}}"  value="<?php echo $CODE['EMAIL']; ?>" required>
							<div class="class_line">
								<input type="checkbox" id="agree" name="agree"> {{LANG terms__privacy}}
							</div>
							<button type="submit" class="login_btn__submit" id="next-terms" disabled>
								{{TEXT_BTN_BOM}}
							</button>
							<br>
								<a class="form__recover" href="{{CONFIG site_url}}/me/password">{{LANG reset_password}}</a>
							<br>
						<?php }else if(@$CODE['ACCESS'] == 'login'){?>
							<img class="access_img" src="{{CONFIG theme_url}}/img/i_web_1.png"></img>
							<!---->
							<input type="hidden" name="sended" value="true"></input>
							<!---->
							<input class="login_input" type="text" name="email" id="email" placeholder="&#128231; {{LANG email}}"  value="<?php echo $CODE['EMAIL']; ?>" required>
							<!---->
							<input class="login_input" type="password" name="password" id="password" placeholder="{{LANG password}}" required>
							<div class="class_line">
								<input type="checkbox" id="agree" name="agree"> {{LANG terms__privacy}}
							</div>
							<button type="submit" class="login_btn__submit" id="next-terms" disabled>
								{{TEXT_BTN_BOM}}
							</button>
							<br>
								<a class="form__recover" href="{{CONFIG site_url}}/me/password">{{LANG reset_password}}</a>
							<br>
						<?php }else if(@$CODE['ACCESS'] == 'password'){?>
							<!---->
							<input type="hidden" name="sended" value="true"></input>
							<!---->
							<input class="login_input" type="text" name="email" id="email" placeholder="&#128231; {{LANG email}}"  value="<?php echo $CODE['EMAIL']; ?>" required>
							<div class="class_line">
								<input type="checkbox" id="agree" name="agree"> {{LANG terms__privacy}}
							</div>
							<button type="submit" class="login_btn__submit" id="next-terms" disabled>
								{{TEXT_BTN_BOM}}
							</button>
							<br>
						<?php }else if(@$CODE['ACCESS'] == 'settings'){?>
							<input type="hidden" name="sended" value="true"></input>
							<!---->
							<input class="login_input" type="text" name="email" id="email" placeholder="&#128231; {{LANG email}}"  value="<?php echo $CODE['EMAIL']; ?>">
							<!---->
							<input class="login_input" type="password" name="password" id="password" placeholder="{{LANG password}}">
							<!---->
							<input class="login_input" type="password" name="r_password" id="r_password" placeholder="{{LANG confirm_password}}">
							<button type="submit" class="login_btn__submit">
								{{TEXT_BTN_BOM}}
							</button>
							<br>
						<?php }?>
					</form>
				</div>
				<!-- footer -->
				{{INCLUDE_FOOTER}}
			</div>
		</div>
	</section>
	<!-- END OF THE section -->
	<!--div id="class_footer"-->

<style>
    button:disabled {
		color: #fff !important;
		background: #d8d8d8;
		border: 1px solid #949494;
    }
</style>	
<script>

$(function() {
	$('.button').on('click', function () {
		if ($('#username').val() && $('#password').val() && $('#email').val()) {
			$(this).val('{{LANG please_wait}}');
		}
	});
});

	function SubmitButton() {
		$('button').attr('disabled', true);
		$('button').text('Please wait..');
		$('form').submit();
	}
	
    $(function() {
        $('#agree').change(function() {
            if($(this).is(":checked")) {
                $('#next-terms').attr('disabled', false);
            } else {
            	$('#next-terms').attr('disabled', true);
            }       
        });
    });
</script>
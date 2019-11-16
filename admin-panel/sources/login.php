<link href="./assets/css/login.css" rel="stylesheet" type="text/css">
<?php


//--

if (@$_COOKIE["auser"]!='') {
	@header("Location:./");
	exit('<meta http-equiv="Refresh" content="0;url=./">');
}
	@$cs_mail = htmlentities($_POST["cs_mail"]);
	@$cs_pass = md5($_POST["cs_pass"]);

if (@$_POST['sended']){	


		if ($cs_mail!='' && $cs_pass!='') {
			//$r = mysqli_query($con,"SELECT * from settings WHERE email = '$cs_mail' AND password = '$cs_pass'") or die ("error en la consulta". mysqli_connect_error()) ;
			if ($cs_mail == $email && $cs_pass == $password){
				$user = mysqli_fetch_array($r);
					$s = 3600; // seconds in a year
					//setcookie('auser', 'true');
					setcookie("auser", trim('true'), time() + $s, '/', null, null, true);
					@header("Location:./");
					exit('<meta http-equiv="Refresh" content="0;url=./">');
				
			} else {
				setcookie('auser', '');
				echo '<style>
							#error_user_login {
								display: block;
							}
							#user_login_ftp {
								display: block;
							}						
						</style>';
			}
		}else{
			echo '<style>
						#error_can_login {
							display: block;
						}
						#user_login_ftp {
							display: block;
						}					
					</style>';
		}
}
mysqli_close ($con);
setcookie('acceder', '');
?>
<?php
	include("./sources/home/index.php");
	echo '<script type="text/javascript"> document.title ="login | '.$titule_site.' ";</script>';		  
?>
<div id="user_login_ftp">
	<!-- wall login -->
	<div class="class_user_login">
		<p class="class_user_login_p_top">Login</p>
		<div style="display: grid;">
			<form method="post" style="display: grid;">
			<input type=hidden name=sended value="true"></input>
				<!--div class="div_port_login">
					<input class="class_input_login" type="text" name="cs_host" placeholder="SERVER FTP" value="ftp.zhareiv.com"/>
				</div-->
				<input class="class_input_login" type="email" name="cs_mail" placeholder="E-mail"/>
				<input class="class_input_login" type="password" name="cs_pass" placeholder="Password"/>
				<input class="btn_login btn_primary salir_user_ftp" type="submit" value="submit"/>
				 
			</form>	
		</div>	
	</div>
	<!-- errores -->
	<!-- user -->
	<div id="error_user_login" class="error_login_user"><p class="class_p_error">Error trying to access with the user</p></div>
	<!-- host -->
	<div id="error_host_login" class="error_login_user"><p class="class_p_error">Error trying to connect with</p></div>
	<!-- null -->
	<div id="error_can_login" class="error_login_user"><p class="class_p_error">Error: Fill in all the fields</p></div>
</div>
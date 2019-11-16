        <meta charset="UTF-8">
        <title>SharePlus | Installation</title>
        <link rel="shortcut icon" type="../admin-panel/assets/image/png" href="img/favicon.png"/>
		<link rel="stylesheet" href="../admin-panel/assets/css/style.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="../admin-panel/assets/js/script_js.js"></script>
 
	<header class="header_index">
		<!--img class="img_logo" src="./assets/img/logo.png"></img-->
	</header>
 
 
<?php
 
	@$plugin_action = $_GET['action'];
	
				$version = 'Version:1.1.3';
				$cURL = true;
				$php = true;
				$gd = true;
				$disabled = false;
				$mysqli = true;
				$is_writable = true;
				$mbstring = true;
				$is_htaccess = true;
				$is_mod_rewrite = true;
				$is_sql = true;
				$zip = true;
				$allow_url_fopen = true;
				$exif_read_data = true;
				if (!function_exists('curl_init')) {
				$cURL = false;
				$disabled = true;
				}
				if (!function_exists('mysqli_connect')) {
				$mysqli = false;
				$disabled = true;
				}
				if (!extension_loaded('mbstring')) {
				$mbstring = false;
				$disabled = true;
				}
				if (!extension_loaded('gd') && !function_exists('gd_info')) {
				$gd = false;
				$disabled = true;
				}
				if (!version_compare(PHP_VERSION, '5.5.0', '>=')) {
				$php = false;
				$disabled = true;
				}
				if (!is_writable('../config.php')) {
				$is_writable = false;
				$disabled = true;
				}
				if (!file_exists('../.htaccess')) {
				$is_htaccess = false;
				$disabled = true;
				}
				if (!file_exists('../SharePlus.sql')) {
				$is_sql = false;
				$disabled = true;
				}
				if (!extension_loaded('zip')) {
				$zip = false;
				$disabled = true;
				}
				if(!ini_get('allow_url_fopen') ) {
				$allow_url_fopen = false;
				$disabled = true;
				}
	
	switch ($plugin_action) {
 
				case 'admin_save':
					require ("../admin-panel/ConectarDtata.php");
						data_script('24','UPDATE',$_POST['email']);
						data_script('25','UPDATE',md5($_POST['password']));
						@header("Location:../admin-panel");
						exit('<meta http-equiv="Refresh" content="0;url=../admin-panel">');
?>
	<center>
		<p class="wall_info_p">the information is being processed</p>
	</center>
<?php						
					break;
				case 'admin':
					require ("../admin-panel/ConectarDtata.php");
?>						
	<div class="wall_index">
		<div class="wall_index_div">
			<div class="div_top_install">
				<img class="img_zhareiv" src="https://i.imgur.com/W0ImMt2.png"></img>
				<p class="div_top_install_p"><span class="text_copi">creator of</span> Shareplus+ <span class="div_top_install_span"><?php echo $version; ?></span></p>
			</div>	
			<div class="cen_db">
				<p class="wall_info_p">Administration</p>
				<form enctype="multipart/form-data" method="post" action="?action=admin_save" charset="UTF-8" >
				<p class="text_p">New E-mail</p>
				<input class="input__text_search_home" type="text" name="email" id="email" placeholder="E-mail">
				<p class="text_p">New Password</p>
				<input class="input__text_search_home" type="text" name="password" id="password" placeholder="Password">	 				
				</div>
				<input class="btn_a" type="submit" Value="Save data" ></input>
				</form> 
			<br>
		</div>  		
	</div> 
			
<?php						 
					break;
				case 'upload':
				
				$config_file_name = '../config.php';
					$host = $_POST['host'];
					$name = $_POST['name'];
					$username = $_POST['username'];
					$password = $_POST['password'];
					$web = $_POST['web'];
					$text = '<?php

// +------------------------------------------------------------------------+
// | @author_email: game123727@gmail.com   
// +------------------------------------------------------------------------+
// | shareplus - The Ultimate PHP Social Networking Platform
// | Copyright (c) 2018 shareplus. All rights reserved.
// +------------------------------------------------------------------------+
/*
Any doubt or failure in the system takes a capture and sends the creator in support
*/

//header("Location:install");

ob_start();
#----> Host name
$dbhost			= \''.$host.'\';
#----> Batabase name
$dbdatabase		= \''.$name.'\'; 
#----> User of the DB
$dbuser			= \''.$username.'\';
#----> Password of the DB
$dbpassword		= \''.$password.'\'; 

// URL web
$site_url = \''.$web.'\';

?>';
				
	$fp = fopen('../config.php', 'w');
	fwrite($fp, $text);
	fclose($fp);
 
	
	$con = @mysqli_connect($host, $username, $password);
	// Check connection

	// ...some PHP code for database "my_db"...

	// check the connection
	if (!$con){
			die(include ("./admin/error_db.php"));
		exit;
	}

	/* User datos */
	// Change database to "test"
	$bdselect = mysqli_select_db($con, $name);

	if (!$bdselect) { 
	// this function is to know if the system is installed
		if (!file_exists('./admin/install.php')) {
			die("ERROR TO BE CONNECTED WITH THE SERVER");
		}else{
			die(include ("./admin/install.php"));
		}
		exit;
	}
	
	
	
	// Name of the file
       $filename = '../SharePlus.sql';
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);
        // Loop through each line
        foreach ($lines as $line) {
           // Skip it if it's a comment
           if (substr($line, 0, 2) == '--' || $line == '')
              continue;
           // Add this line to the current segment
           $templine .= $line;
           $query = false;
           // If it has a semicolon at the end, it's the end of the query
           if (substr(trim($line), -1, 1) == ';') {
              // Perform the query
              $query = mysqli_query($con, $templine);
              // Reset temp variable to empty
              $templine = ''; 
           }
        }

?>
	<meta http-equiv="Refresh" content="30;url=?action=admin">
	<center>
		<p class="wall_info_p">the information is being processed</p>
	</center>
<?php	
					break;					
				case 'installation':
?>
	<div class="wall_index">
		<div class="wall_index_div">
			<div class="div_top_install">
				<img class="img_zhareiv" src="https://i.imgur.com/W0ImMt2.png"></img>
				<p class="div_top_install_p"><span class="text_copi">creator of</span> Shareplus+ <span class="div_top_install_span"><?php echo $version; ?></span></p>
			</div>	
			<div class="cen_db">
				<p class="wall_info_p">Installation</p>
				<form enctype="multipart/form-data" method="post" action="?action=upload" charset="UTF-8" >
				<p class="text_p">BD host name</p>
				<input class="input__text_search_home" type="text" name="host" id="host" placeholder="host">
				<p class="text_p">BD username</p>
				<input class="input__text_search_home" type="text" name="username" id="username" placeholder="username">
				<p class="text_p">BD password</p>
				<input class="input__text_search_home" type="text" name="password" id="password" placeholder="password">
				<p class="text_p">BD database name</p>
				<input class="input__text_search_home" type="text" name="name" id="name" placeholder="name">
				<p class="text_p">Site url</p>
				<input class="input__text_search_home" type="text" name="web" id="web" placeholder="http://siteurl.com/">	 				
				</div>
				<input class="btn_a" type="submit" Value="Save data" ></input>
				</form> 
			<br>
		</div>  		
	</div>  
									
<?php						
					break;
				
?>
<?php			
				case 'info':
?>
	<div class="wall_index">
		<div class="wall_index_div">
			<div class="div_top_install">
				<img class="img_zhareiv" src="https://i.imgur.com/W0ImMt2.png"></img>
				<p class="div_top_install_p"><span class="text_copi">creator of</span> Shareplus+ <span class="div_top_install_span"><?php echo $version; ?></span></p>
			</div>	
			<div class="div_meve_sroll">
				<table class="table">
				<tbody>
				  <tr>
					<td><b>tips</b></td>
					
					<td>server that uses this script is hostinger</td>
					<td><a target="_blank" href="https://www.hostg.xyz/SHi5"><font color="green" class="font_data"><i class="fa fa-check fa-fw"></i> click here</font></a></td>
				  </tr>
				  <tr>
					<td>PHP 5.5+</td>
					<td>Required PHP version 5.5 or more</td>
					<td><?php echo ($php == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Installed</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not installed</font>'?></td>
				  </tr>
				  <tr>
					<td>cURL</td>
					<td>Required cURL PHP extension</td>
					<td><?php echo ($cURL == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Installed</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not installed</font>'?></td>
				  </tr>
				  <tr>
					<td>MySQLi</td>
					<td>Required MySQLi PHP extension</td>
					<td><?php echo ($mysqli == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Installed</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not installed</font>'?></td>
				  </tr>
				  <tr>
					<td>GD Library</td>
					<td>Required GD Library for image cropping</td>
					<td><?php echo ($gd == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Installed</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not installed</font>'?></td>
				  </tr>
				  <tr>
					<td>Mbstring</td>
					<td>Required Mbstring extension for UTF-8 Strings</td>
					<td><?php echo ($mbstring == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Installed</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not installed</font>'?></td>
				  </tr>
				  <tr>
					<td>ZIP</td>
					<td>Required ZIP extension for backuping data</td>
					<td><?php echo ($zip == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Installed</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not installed</font>'?></td>
				  </tr>
				  <tr>
					<td>allow_url_fopen</td>
					<td>Required allow_url_fopen</td>
					<td><?php echo ($allow_url_fopen == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Enabled</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Disabled</font>'?></td>
				  </tr>
				  <tr>
					<td>.htaccess</td>
					<td>Required .htaccess file for script security </td>
					<td><?php echo ($is_htaccess == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Uploaded</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not uploaded</font>'?></td>
				  </tr>
				  <tr>
					<td>SharePlus.sql</td>
					<td>Required SharePlus.sql for the installation  </td>
					<td><?php echo ($is_sql == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Uploaded</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not uploaded</font>'?></td>
				  </tr>
				  <tr>
					<td>config.php</td>
					<td>Required config.php to be writable for the installation</td>
					<td><?php echo ($is_writable == true) ? '<font color="green"><i class="fa fa-check fa-fw"></i> Writable</font>' : '<font color="red"><i class="fa fa-times fa-fw"></i> Not writable</font>'?></td>
				  </tr>
				</tbody>
			  </table>
		  </div>
		  <a class="btn_a" href="?action=installation">start installation</a>
	 
		</div>  
	</div> 
<?php				
					break;
				default:
?>				
	<div class="wall_index">
		<div class="wall_index_div">
			<div class="div_top_install">
				<img class="img_zhareiv" src="https://i.imgur.com/W0ImMt2.png"></img>
				<p class="div_top_install_p"><span class="text_copi">creator of</span> Shareplus+ <span class="div_top_install_span"><?php echo $version; ?></span></p>
			</div>	
			<div class="div_meve_sroll">
				<h5>LICENSE AGREEMENT: one (1) Domain (site) Install</h5>
				<br>
				<b>Terms and Conditions:</b>
				<br>
				<br>
				<b>English</b>
				<br>
				Terms and conditions of shareplus are the following:<br>
				- If the buyer wants to change or modify the design or elements either a function and / or image can do it; but if you want the developer to do it the fee will be $20 US dollars, with the agreement to provide the developer with a previous list of changes to be made and based only on it. If modifications are required in the future, it will be necessary to hire the service again
				<br>
				<br>
				- All items can be returned within 30 calendar days of purchase.

				To return an item, please contact Customer Service through the app or website and follow the relevant instructions. Please keep in mind that we may not cover the 100% refund for company policies. For more information, please review our Return Policy.
				<br>
				<br>
				- To request a refund, you will be asked for the following information, which you can send by Email, Chat or Phone:

				Order number with which you purchased your product. (It is found in the MY ACCOUNT option).

				Description of the item and / or order.

				Reason for which the refund is requested.

				Form of payment with which the purchase was purchased since it will be by this same means that the refund will be applied, in case of bank deposit the client must provide an Interbank Clabe and a photocopy of the account statement, in order to apply the same
				<br>
				<br>
				--------------------------------------------------------------------------------------------
				<br>
				<br>
				<b>Español</b>
				<br>
				Términos y condiciones de shareplus son las siguientes:<br>
				- Si el comprador quiere cambiar o modificar el diseño o elementos ya sea una función y/o imagen lo puede hacer; pero si quiere que el desarrollador lo haga la tarifa será  de $20 dólares americanos, con el acuerdo de proporcionar al desarrollador una lista previa de los cambios ha hacer y basándose sólo en ella.  Si en el futuro se requiere hacer modificaciones será necesario contratar el servício nuevamente
				<br>
				<br>
				- Todos los artículos pueden ser devueltos dentro de 30 días naturales  siguiebtes a la compra.

				Para devolver un artículo, por favor ponte en contacto con Servicio al Cliente por medio de la app o del sitio web y sigue las indicaciones relevantes. Por favor ten en cuenta que  puede que no cubramos el reembolso al 100 % por políticas de la empresa. Para más información, por favor revisa nuestra Política de devolución.
				<br>
				<br>
				- Para solicitar un reembolso, se te pedirá la siguiente información, la cual puedes hacer llegar por Correo Electrónico, Chat o Telefónicamente:

				Número de pedido con el que compraste tu producto. (Se encuentra en la opción MI CUENTA).

				Descripción del artículo y/o pedido.

				Motivo por el cual se solicita el reembolso.

				Forma de pago con la que se adquirió la compra ya que será por este mismo medio que se aplicará el reembolso, en caso de depósito bancario el cliente deberá proporcionar una Clabe Interbancaria y una fotocopia del estado de cuenta, para poder aplicar el mismo
				<br>
				<!---->
				<br>
				<br>
				<!---->
				<b>You CAN:</b><br> 1) Use on one (1) domain only, additional license purchase required for each additional domain.<br> 2) Modify or edit as you see fit.<br> 3) Delete sections as you see fit.
				<br> 4) Translate to your choice of language.
				<br>5) Managing plugins you can modify, change as you like, but if you want to create a new plugin you have to contact the creator of the system to get a unique KEY to avoid errors in the system.<br>
				<!---->
				<br><b>You CANNOT:</b> <br>1) Resell, distribute, give away or trade by any means to any third party or individual without permission.<br> 2) Use on more than one (1) domain.
				<br>3) In case you have sold a copy or shared you will be charged $20 US dollars for each copy.
				<br><br>Unlimited Licenses are available.				
			</div>
			<br>
			<input type="checkbox" id="agree" name="agree"> I agree to the terms of use and privacy policy
			<form action="?action=info" method="post">
			<button type="submit" class="btn_a" id="next-terms" disabled>
				<i class="fa fa-arrow-right progress-icon" data-icon="paper-plane-o"></i> Next
			</button>
			</form>
		</div>  
	</div>  
			
<?php					
					break;
			}	
?> 
<style>
    button:disabled {
		color: #fff !important;
		background: #d8d8d8;
		border: 1px solid #949494;
    }
</style>
<script>
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
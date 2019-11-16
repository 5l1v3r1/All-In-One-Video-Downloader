
<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags19; ?><br><spam class="name_session_text_spam"><?php echo $lags20; ?></spam></p>
	</div>
	<div class="div_statistics_panel">
		<div class="wall_class_actions">
	

			<!-- action -->
<?php
	include('plugins.php');
	
	// code upload plugins
	$zip = new ZipArchive;
	$valid_formats = array("zip", "ZIP");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$name = $_FILES['file_plugin']['name'];
		$type = $_FILES['file_plugin']['type'];
		$size = $_FILES['file_plugin']['size'];
		
		$file_name = preg_replace("/\..*$/", "", $name);
		
		$path = "./files/"; // la carpeta de la imagen 

		if(strlen($name)){
				
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats)){
				if($size<(1024*5120)){
					$time = time();
					$actual_image_name = $name.".".$ext;
					$tmp = $_FILES['file_plugin']['tmp_name'];
					if(move_uploaded_file($tmp, $path.$actual_image_name)){
							
						$res = $zip->open('./files/'.$name.'.zip');
						if ($res === TRUE) {
							$zip->extractTo('./files/');
							$zip->close();
							unlink('./files/'.$name.'.zip');
								
							$default_headers = array(
								'Name' => 'Plugin Name',
								'Key' => 'Plugin Key',
								'Icon' => 'Plugin Icon',
								'Update_date' => 'Update date',
								'Version' => 'Version',
								'Author' => 'Author',
								'Url_line' => 'Url_line',
							);
								
							$plugin_data = PHP_get_file_data( 'files/'.$file_name.'/install.php', $default_headers, 'plugin' );
							
							$Data_name 		= $plugin_data['Name'];
							$Data_key 		= $plugin_data['Key'];
							$Data_icon		= $plugin_data['Icon'];
							$Data_Update	= $plugin_data['Update_date'];
							$Data_Version	= $plugin_data['Version'];
							$Data_Author	= $plugin_data['Author'];
							$Data_url_line	= $plugin_data['Url_line'];
							
							if (PHP_Data_Key_Plugin($Data_key) == false){
								//if(PHP_Data_Version_Plugin($Data_key,$Data_Version) == false){
								//	echo 'ya existe key';
								//	echo PHP_Data_Version_Plugin($Data_key,$Data_Version);
								//}else{
									$sql = "UPDATE platform_media SET platform='$Data_name',key_plugin='$Data_key',Data_Update='$Data_Update',version='$Data_Version',icon='$Data_icon',Author='$Data_Author',url_line='$Data_url_line' WHERE key_plugin='$Data_key'";
									$pedido = mysqli_query($con, $sql);
									if (!$pedido){
										echo "Error: No se pudo ingresar los datos, el erro fue".mysqli_error();
									}else{
										echo '	<div class="class_error_upload">
													<p class="class_error_upload_p">'.$lags33.'
														<div class="flex_div_upload_plugin">
															<img class="img_upload_plugin" src="'.$Data_icon.'"></img>
															<span class="span_upload_plugin_name"><span class="span_upload_plugin_data"></span>'.$Data_name.'</span>
														</div>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags42.':</span>'.$Data_Update.'</span>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags41.':</span>'.$Data_key.'</span>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags43.':</span>'.$Data_Author.'</span>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags40.':</span>'.$Data_Version.'</span>
													</p>
												</div>
												<div class="go_back">
													<a href="?action=actions">
														<p class="go_back_p">'.$lags35.'</p>
													</a>
												</div>';
									}
								//}
							}else{
								// Archivo descomprimido correctamente
								mysqli_query($con,"insert into platform_media (key_plugin,platform,Data_Update,version,Author,icon,active,url_line) values ('$Data_key','$Data_name','$Data_Update','$Data_Version','$Data_Author','$Data_icon','1','$Data_url_line')");
										echo '	<div class="class_error_upload">
													<p class="class_error_upload_p">'.$lags34.'
														<div class="flex_div_upload_plugin">
															<img class="img_upload_plugin" src="'.$Data_icon.'"></img>
															<span class="span_upload_plugin_name"><span class="span_upload_plugin_data"></span>'.$Data_name.'</span>
														</div>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags42.':</span>'.$Data_Update.'</span>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags41.':</span>'.$Data_key.'</span>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags43.':</span>'.$Data_Author.'</span>
														<span class="span_upload_plugin"><span class="span_upload_plugin_data">'.$lags40.':</span>'.$Data_Version.'</span>
													</p>
												</div>
												<div class="go_back">
													<a href="?action=actions">
														<p class="go_back_p">'.$lags35.'</p>
													</a>
												</div>';
							}	
						} else {
						   // Error descomprimiendo el archivo...
						   echo 'error zip_';
						}
							//echo 'se subio bien';			
					}
					else
						echo "failed";
				}
				else
					echo "Image file size max 5 MB";					
				}
				else
					echo "Invalid file format..".$type."";	
			}
		else
			echo "Please select image..!";	
		exit;
	}
mysqli_close ($con);
?>
			<br>
			<br>
		</div>		
	</div>
</section>

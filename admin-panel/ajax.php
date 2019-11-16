<?php

require ("ConectarDtata.php");

if (@$_COOKIE["auser"]!='') {
	function active_media ($data){
		global $con;
	 
		$sqli = mysqli_query($con,"Select * From platform_media WHERE id=".$data."");

		if (mysqli_num_rows($sqli) > 0){
			$data = mysqli_fetch_array($sqli, MYSQLI_ASSOC);
			
			if($data["active"] > 0){
				$data_return = '0';
			}else{
				$data_return = '1';
			}
		}
		return $data_return;
	}
	//--
	$data = mysqli_query($con,"Select * From platform_media WHERE id=".$_REQUEST['id']."");
	$check_result = @mysqli_num_rows(@$data);
				
	if($check_result){
		$sqli = "UPDATE platform_media SET active=".active_media($_REQUEST['id'])." WHERE id=".$_REQUEST['id']."";
		@mysqli_query($con, $sqli);
	}
				
}else{
	require ("sources/login.php");	
}			

?>
<?php
	require ("ConectarDtata.php");
	
	
	$year = $_POST['año'];
	
	$enero = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=1 AND YEAR(look)='$year'"));
	$febrero = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=2 AND YEAR(look)='$year'"));
	$marzo = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=3 AND YEAR(look)='$year'"));
	$abril = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=4 AND YEAR(look)='$year'"));
	$mayo = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=5 AND YEAR(look)='$year'"));
	$junio = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=6 AND YEAR(look)='$year'"));
	$julio = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=7 AND YEAR(look)='$year'"));
	$agosto = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=8 AND YEAR(look)='$year'"));
	$septiembre = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=9 AND YEAR(look)='$year'"));
	$octubre = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=10 AND YEAR(look)='$year'"));
	$noviembre = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=11 AND YEAR(look)='$year'"));
	$diciembre = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(Visits) AS r FROM admin_graphics WHERE MONTH(look)=12 AND YEAR(look)='$year'"));
	
	$data = array(0 => round($enero['r'],1),
				  1 => round($febrero['r'],1),
				  2 => round($marzo['r'],1),
				  3 => round($abril['r'],1),
				  4 => round($mayo['r'],1),
				  5 => round($junio['r'],1),
				  6 => round($julio['r'],1),
				  7 => round($agosto['r'],1),
				  8 => round($septiembre['r'],1),
				  9 => round($octubre['r'],1),
				  10 => round($noviembre['r'],1),
				  11 => round($diciembre['r'],1)
				  );			 
	echo json_encode($data);
?>
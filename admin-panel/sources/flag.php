<?php
					echo '<div class="flag">';
	$pedir = mysqli_query($con,"Select * From admin_graphics_countries ORDER BY Results DESC LIMIT 10");
	while($fila = mysqli_fetch_array($pedir)){		
					echo '	<div class="admin_wall__div_flag">';
					echo '		<img class="admin_img_flag" src="assets/img/flag/'.strtolower($fila["Countries"]).'.png" alt=""></img>';						
					echo '		<spam class="name_flag">'.$fila["Countries"].'</spam>';		
					echo '		<spam class="views_flag">'.$fila["Results"].'</spam>';						
					echo '	</div>';	
	}
					echo '</div>';
?>


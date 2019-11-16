<?php 
require ("ConectarDtata.php");
require_once ("languages/$Languages_panel.php");
	if (@$_COOKIE["auser"]!='') {

		
		$s = $_POST['report'];
		$report_yes = $_POST['report_yes'];
		if($report_yes){
			$sql = "DELETE FROM report_link WHERE id='$report_yes'";
			mysqli_query($con, $sql);
		}else{
			$sql = mysqli_query($con,"Select * From report_link WHERE platform = '$s' LIMIT 100");
			echo '<p class="text_plugin_p">'.$lags60.'</p>';
			if (mysqli_num_rows($sql) == 0){
				$line = '
							<p class="pp_jjs_link w_c_text_p">'.$lags61.'</p>
						';
				echo $line;
				
			}else{
				while($data = mysqli_fetch_array($sql)) {
					$line = '<div class="loader_data_link__no_'.$data['id'].' class_div_link_a">';
					$line.= '<div class="class_div_link_a_2"><p class="name_reporte_link_a">'.$data["platform"].'</p><a target="_blank" href="'.$data['report_link'].'"><p class="class_p_link_a">'.$data['report_link'].'</p></a></div>';
					$line.= '<p class="check_link loader_data_link_'.$data['id'].' click_a ba_link_re_a" data-id="'.$data['id'].'"><i class="icon_a_repo fas fa-check"></i></p>';
					$line.= '</div>';
					echo $line;	
				}
			}
		}	
	}else{
		require ("sources/login.php");	
	}					
	
?>

<script type="text/javascript">
//
 
	//report link	
         $('.check_link').on('click', function(){
            var data_id = $(this).data('id');
            $.ajax({
                url: 'report.php',
                type: 'POST',
                data: {report: data_id},
                success: function(data){
                    $("#more_data").html(data);//$('#more-info').html(data.html);
                }
            });
        });
//
	$('.click_a').on('click', function(){
		var data_id = $(this).data('id');
		$('.loader_data_link__no_'+data_id).hide();
		$('.loader_data_link_'+data_id).show();
		
		$.ajax({
			url: 'report.php',
            type: 'POST',
            data: {report_yes: data_id},
            success: function(data){
                $('.loader_data_link__no_'+data_id).hide();
				$('.loader_data_link_'+data_id).show();
			}
		});
    });	
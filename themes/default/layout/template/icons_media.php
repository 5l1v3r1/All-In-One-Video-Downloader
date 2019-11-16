<div class="flax_home_index">
	<?php
	
		
		if(count($CODE['GET_TRENDING_FUNCTION']) == 0){
			echo $CODE['GET_TRENDING_NO_CONTENT'];
		}else{
			foreach ($CODE['GET_TRENDING_FUNCTION'] as $data) {
				$line = '<div class="div_con_videos">';					
				$line .= '		<div class="div_social">';
				if ($data['platform']=='soundcloud'){
				$line .= '		<a href="'.strtolower (''.$config['site_url'].'/'.$data['platform'].'-music-downloader').'">';
				}else{
				$line .= '		<a href="'.strtolower (''.$config['site_url'].'/'.$data['platform'].'-video-downloader').'">';	
				}
				$line .= '			<img class="imgs_index_wall_home" src="'.$data['icon'].'"></img>';
				$line .= '			<p class="p_des_con"></p>';
				$line .= '		</a>';
				$line .= '		</div>';
				$line .= '		<p class="name_social">'.$data['platform'].'</p>';
				$line .= '</div>';
				echo $line;
			}
		}
	?>	
</div>	
<script>
		$("div.div_social").mouseenter(function(){
			$(this).addClass("icon_media_b").delay(1000).queue(function(){
				$(this).removeClass("icon_media_b").dequeue();
			});
			
		});
</script>		
<?php
		
	if(count($CODE['GET_URLS_FUNCTION']) == 0){
		echo '<div class="bom_striy cen_conte_modal"><br><img id="img_404_modal_history" src="{{CONFIG theme_url}}/img/i_web_10.png"></img>';
		echo '<br>{{LANG empty_modal}}</div><br><br>';
?>
	<style>
		.show_more {
			display: none;
		}
	</style>
<?php		
	}else{
?>
	<div class="postList">
<?php		
		foreach ($CODE['GET_URLS_FUNCTION'] as $data['INFO']) {
			$og_meta			= PHP_Get_Tags($data['INFO']['url']);
			$data_id 			= $data['INFO']['id'];
			$data_share 		= $data['INFO']['id_url'];
			$postID			    = PHP_Crypt_code($data_id,false);
			@include ("./themes/default/layout/template/list_urls_data.php");
		}
?>
<?php		
		echo '
				
				<div id="CONTENT_DOWNLOAD_MODAL"></div>
				<div id="CONTENT_SHARE_MODAL"></div>
			';
	}	
		@include ("./themes/default/layout/template/list_more_btn.php");
?>
		
	</div>
<script>
//--
	function close_share_modal() {
		$("#close_load_modal").hide();
		$("#CONTENT_DOWNLOAD_MODAL").hide();
		$("#CONTENT_SHARE_MODAL").hide();
		$(".div_modal_stories").show();
		$(".show_more").show();
		$(".btn_loader_url_no").show();
		$(".btn_loader_url").hide();
		$(".btn_loader_data_share_no").show();
		$(".btn_loader_data_share").hide();
	}
//--
	$(document).ready(function(){
		$(document).on('click','.show_more',function(){
			var ID = $(this).attr('id');
			$('.show_more').hide();
			$('.loding').show();
			$.ajax({
				url: Ajax_Requests_File(),
				type: 'POST',
				data: 'more_data_url='+ID,
				success:function(html){
					$('#show_more_main'+ID).remove();
					$('.postList').append(html);
				}
			});
		});
	});

//--
	function copy(element_id){
		var aux = document.createElement("div");
		aux.setAttribute("contentEditable", true);
		aux.innerHTML = document.getElementById(element_id).innerHTML;
		aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
		document.body.appendChild(aux);
		aux.focus();
		document.execCommand("copy");
		document.body.removeChild(aux);
		$("#copy_yes").show().delay(1000).fadeOut();
	}		
</script>		
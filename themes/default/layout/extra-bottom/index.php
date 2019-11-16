<script> 
		//--
			$(document).ready(function(){

				$(".account_posts_dropdown_header").click(function(){
					var X=$(this).attr('id');
					if(X==1){
						$(".submenu_header").hide();
						$(this).attr('id', '0'); 
					}else{
						$(".submenu_header").show();
						$(this).attr('id', '1');
					}

				});

				//Mouse click on sub menu
				$(".submenu_header").mouseup(function(){
					return false
				});

				//Mouse click on my account link
				$(".account_posts_dropdown_header").mouseup(function(){
					return false
				});
				
				//Mouse click on my account link
				$(".class_list_lang").mouseup(function(){
					return false
				});


				//Document Click
				$(document).mouseup(function(){
					$(".submenu_header").hide();
					$(".account_posts_dropdown_header").attr('id', '');
				});
			});	
//--

</script> 
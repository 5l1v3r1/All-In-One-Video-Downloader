//-- dropdown header
	$(document).ready(function(){

		$(".account_posts_dropdown").click(function(){
			var X=$(this).attr('id');
			if(X==1){
				$(".submenu").hide();
				$(this).attr('id', '0'); 
			}else{
				$(".submenu").show();
				$(this).attr('id', '1');
			}

		});

		//Mouse click on sub menu
		$(".submenu").mouseup(function(){
			return false
		});

		//Mouse click on my account link
		$(".account_posts_dropdown").mouseup(function(){
			return false
		});


		//Document Click
		$(document).mouseup(function(){
			$(".submenu").hide();
			$(".account_posts_dropdown").attr('id', '');
		});
	});	
 

////////////// modal twitter
$(document).ready(function(){
	
	$(document).on('click', '#twitter', function(e){
			
	var url = $('#twitter').data('id');   // it will get id of clicked row	
			
	e.preventDefault();
    var getLocation = function (href) {
        var l = document.createElement("a");
        l.href = href;
        return l;
    };

        document.getElementById("twitter").disabled = true;

        var parseUrl = getLocation(url);
        if (parseUrl.hostname == "twitter.com") {
            var fail = "";
            var cb = new Codebird;
            var tweet_url = url;
            cb.setConsumerKey("ZCY2bbZBsTCRjIwcREUIdpJIZ", "Q2cNeCKYcWXB6LPNVgCCCkXVVP2ex4LfB3nAuHrhqKoRpHXIKF");
            cb.setProxy(base_url() + "/api/twitter/codebird-cors-proxy/");
            var s_url = tweet_url.split("/")[5];
            if ((tweet_url.indexOf("twitter.com") == -1) || s_url == undefined) {
                fail += "Please enter a valid twitter link";
                failure(fail);
                return fail;
            } else {
                var valid = 1;
                var videoUrl;
                cb.__call(
                    "statuses_show_ID",
                    "id=" + s_url,
                    null,
                    true
                ).then(function (data) {
                    if (data.reply.extended_entities == null && data.reply.entities.media == null) {
                        valid = 0;
                        fail += "The tweet content is not accessible).";
                    }
                    else if ((data.reply.extended_entities.media[0].type) != "video" && (data.reply.extended_entities.media[0].type) != "animated_gif") {
                        valid = 0;
                        fail += "The tweet contains no video or gif file (or it is not accessible).";
                    } else {
                        videoUrl = data.reply.extended_entities.media[0].video_info.variants[0].url;
                        $.post('video_twitter.php', {url: videoUrl}, function (data) {
                            $('#dynamic-content-twitter').html(data);
                            $('#view-modal-twitter').modal();
							$('#modal-loader-twitter').hide();
                            document.getElementById("twitter").disabled = false;
                        });
                    }
                });
            }
        } else {
            $.post('video_twitter.php', {url: url}, function (data) {
                $('#dynamic-content-twitter').html(data);
                $('#view-modal-twitter').modal();
				$('#modal-loader-twitter').hide();
                document.getElementById("twitter").disabled = false;
            });
        }
        e.preventDefault();
 

    function base_url() {
        var pathparts = location.pathname.split('/');
        if (location.host == 'localhost') {
            var url = location.origin + '/' + pathparts[1].trim('/') + '/';
        } else {
            var url = location.origin;
        }
        return url;
    }

    function failure(fail) {
        $.post('video_twitter.php', {url: fail}, function (data) {
            $('#dynamic-content-twitter').html(data);
			$('#modal-loader-twitter').hide();
            $('#view-modal-twitter').modal();
            document.getElementById("twitter").disabled = false;
        });
    }
	})	
	
});


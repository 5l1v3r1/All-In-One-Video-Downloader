function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
function filterEmojis() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("InputSearch");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

//--

	$(function() {

		$(".media_yes").click(function()
		{

		var user_id = $(this).attr("id");
		var datastring = 'id='+ user_id ;

		 $.ajax({
		   type: "POST",
		   url: "ajax.php",
		   data: datastring,
		   success: function(html){}
		 });

			$("#media_yes"+user_id).hide();
			$("#media_no"+user_id).show();
			return false;

		});
	});



	$(function() 
	{

		$(".media_no").click(function()
		{

		var user_id = $(this).attr("id");
		var datastring = 'id='+ user_id ;

		 $.ajax({
		   type: "POST",
		   url: "ajax.php",
		   data: datastring,
		   success: function(html){}
		 });
		   $("#media_no"+user_id).hide();
		   $("#media_yes"+user_id).show();
			return false;

		});
	});


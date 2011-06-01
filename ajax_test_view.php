<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<title>CI/jQ - Ajax Test</title>

	<style type="text/css">
	body {
		margin: 50px 0 0 20px;
	}
	
	#box {
		width: 500px;
		height: 200px;
		border: 1px solid blue;
	}
	</style>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function()
	{
		$("#btn1").click(function(){
			var json = { "something_id" : '2'};
			var url = "<?php echo site_url('/test/get_something'); ?>";
			
			// You may also use the .post method without the extra error checking and flare of .ajax
			// $.post(url, json, function(data){
			// 	if (data){
			// 		$("#box").html(data.something);
			// 	}
			// });
			
			$.ajax({
				url: url,
				dataType: 'json',
				type: 'POST',
				data: json,
				success: function(data, textStatus, XMLHttpRequest)
				{
					$("#box").html(data.something);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown)
				{
					// Error Message
					$("#box").html('Error connecting to:' + url);
				}
			});
			
			// Loading message
			$("#box").html('loading...');
		});
	});
	</script>
</head>
<body>
	<section>
		<button id="btn1">Get Something</button>
		<p id="box"></p>
	</section>
</body>
</html>
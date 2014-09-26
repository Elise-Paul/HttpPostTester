<!doctype HTML>
<HTML>
	<HEAD>
	<title>HttpRequestTester</title>
	<style>	
	body 
	{
		background-color:grey; 
	}
	label,h1,h2,#run_test {
		font-family: Futura, "Trebuchet MS", Arial, sans-serif;
	}
	h2 {
		width:350px;
	}
	h1 {
		margin-left: 70px;
	}
	input,textarea {
		border: 5px solid white; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 15px;
    background: rgba(210,210,210,0.5);
    margin: 0 0 10px 0;
	} 
	textarea {
		margin-left:10px;
	}
	#main
	{
		background-color:white;
		width: 1200px;
		margin:0 auto;
		padding:10px;
	  		-webkit-box-shadow: 0 35px 20px #333;
	  		-moz-box-shadow: 0 35px 20px #333;
	  	box-shadow: 0 35px 20px #333;
	  	height:auto;
		overflow:hidden;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 6px; 
		-khtml-border-radius: 2px; 
	}
	ul {
		font-family:Georgia, Times, serif; font-size:15px; 
 		list-style: none; 
 		width:400px;
 	}

	ul li { text-decoration:none; color:#000000; background-color:#dddddd; line-height:30px;
	  border-bottom-style:solid; border-bottom-width:4px; border-bottom-color:#ffffff; padding-left:5px; cursor:pointer; }
	 .sub_wrap {
	 	vertical-align: middle;
	 }
	 #run_test {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
		color: #ffffff;
		padding: 10px 40px;
		background: -moz-linear-gradient(
			top,
			#8a8389 0%,
			#211d21);
		background: -webkit-gradient(
			linear, left top, left bottom,
			from(#8a8389),
			to(#211d21));
		-moz-border-radius: 30px;
		-webkit-border-radius: 30px;
		border-radius: 30px;
		border: 3px solid #ffffff;
		-moz-box-shadow:
			0px 3px 11px rgba(000,000,000,0.5),
			inset 0px 0px 1px rgba(122,122,122,1);
		-webkit-box-shadow:
			0px 3px 11px rgba(000,000,000,0.5),
			inset 0px 0px 1px rgba(122,122,122,1);
		box-shadow:
			0px 3px 11px rgba(000,000,000,0.5),
			inset 0px 0px 1px rgba(122,122,122,1);
		text-shadow:
			0px -1px 0px rgba(000,000,000,0.2),
			0px 1px 0px rgba(255,255,255,0.3);
		float:right;
		margin-top:-60px;
		margin-right:130px;
	 }
	 #general {
	 	float:right;
	 	margin-right: 80px;
	 }
	 .list_header {
	 	padding-left:24px;
	 }
	 iframe {
	 	width:100%;
	 	height:600px;
	 }
	</style>
	</HEAD>
	<BODY>
		<div id="main">
			<h1>HTTP Request Tool</h1>

			<FORM method="post" action="">
				<input id="run_test" type="submit" name="submit" id="submit" value="Test" />
				<div class="sub_wrap">
					<label>Post Headers</label>
					<textarea rows="2" cols="160" name="post_headers"><?php if ($_POST['post_headers']){echo htmlentities($_POST['post_headers']);}?></textarea>
				</div>
				<br>
				<div class="sub_wrap">
					<label>Post url    </label>
					<textarea rows="1" cols="160" name="post_url"><?php if ($_POST['post_url']){echo htmlentities($_POST['post_url']);}?></textarea>
				</div>
				<br>
				<div class="sub_wrap">
					<label>Post Body  </label>
					<textarea rows="7" cols="160" name="post_body"><?php if ($_POST['post_body']){echo htmlentities($_POST['post_body']);}?></textarea>
				</div>
				<br>
		
			</FORM>
			<div class="response">
				<?php 
				if ($_POST['post_body']&&$_POST['post_url']) {

					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL,$_POST['post_url']);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$_POST['post_body']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					$server_output = curl_exec ($ch);

					curl_close ($ch);
					$is_html = stristr($server_output,'<!DOCTYPE HTML');
					if ($is_html) {
						echo '<iframe id="iframe1"></iframe>';
					} else {
						echo htmlentities($server_output);
					}
				}
				?>
			</div>

		</div>
		<script>
			var html_string = '<?php echo ($is_html)?$server_output:"false";?>';
			if (html_string=='false') {
				document.getElementById('iframe1').contentWindow.document.write(html_string);
			}

		</script>
	</BODY>

</HTML>

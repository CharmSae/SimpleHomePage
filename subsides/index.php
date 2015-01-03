<!DOCTYPE html>
<html>
<head>
	<title>설문조사</title>
	<?php

	include('./header/header.php');

	?>
	<script src="jssor.slider.mini.js"></script>

	<script>
		$(function(){

			$('#panel1').fadeIn(1500);
			$('#panel2').fadeIn(1500);

			var options = { $AutoPlay: true };
			var jssor_slider1 = new $JssorSlider$('slider1_container', options);

			$('#silder_toggle').click(function(){
				$('#slider1_container').fadeToggle();
			});

		});

	</script>

</head>
<body>
	<br/>
	<center>
		<div style="width: 700px;">

			<div class="introduce" style="top: 10px; left: 0px;">
				<p><h2>About me</h2></p>
				<p>Hi! My name is Durumi and I am from Korea. Now I am a senior student in a college. Recently, I studied MEAN stack which is including node.js and angular.js but I don't feel comfortable with that. So I am currently working on test project using that. But if you want contact me, feel free to leave a message in <a href="/basic_board/get_basic_board.php">freeboard</a>. Or send a message to my email which is <b>ac12bd@gmail.com</b></p>
				<p>Then I'll check as soon as possible.</p>
			</div>

			<div class="btn-group" role="group" aria-label="...">
				<input id="silder_toggle" type="button" class="btn btn-default" value="Toggle the silder"></input>
			</div>
			<br/>
			<br/>

			<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;">
				<!-- Slides Container -->
				<div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 300px;">
					<div><img u="image" src="./image/slider/01.jpg" /></div>
					<div><img u="image" src="./image/slider/02.jpg" /></div>
					<div><img u="image" src="./image/slider/03.jpg" /></div>
					<div><img u="image" src="./image/slider/04.jpg" /></div>
					<div><img u="image" src="./image/slider/05.jpg" /></div>
				</div>
			</div>
		</div>

		<br/>	

		<table border="0" width="800" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation"><a href="./index.php">Home</a></li>
						<li role="presentation"><a href="./basic_board/get_basic_board.php">FreeBoard</a></li>
						<li role="presentation"><a href="./poll_board/get_poll_board.php">PollBoard</a></li>
						<li role="presentation"><a href="">Don't click</a></li>
						<li role="presentation"><a href="./ext.php">나나잇걸</a></li>
						<li role="presentation"><a href="./examgall.php">수능갤러리</a></li>
					</ul>

				</td>
				<td>
					<div id="panel1" class="col-sm-9 col-xs-12" style="display:none; float:right;">
						<div class="panel panel-primary">
							<div class="panel-heading">FreeBoard (Recent 10 posts)</div>
							<div class="panel-body">
								<ul>

									<?
									$limit = 10;

									require_once('./mysqli_connector.php');

									$query = "SELECT id, subject, date FROM basic_board ORDER BY id DESC LIMIT ".$limit;

									$response = @mysqli_query($dbc, $query);

									if($response){

										while($row = mysqli_fetch_array($response)){

			//댓글 세는 기능

											$reply_query = "SELECT * FROM basic_reply WHERE parents_id = ".$row['id']." LIMIT = ".$limit;
											$reply_response = @mysqli_query($dbc, $reply_query);
											$num_reply = $reply_response->num_rows;

											echo '<li><a href="./basic_board/get_basic_content.php?id='.$row['id'].'">'.$row['subject'];

											if($num_reply != 0){
												echo '['.$num_reply.']';
											}

											echo '</li>';

										}

									} else {

										echo "Couldn't issue database query ";

										echo mysqli_error($dbc);
									}


									?>
								</ul>
							</div>
						</div>
					</div>
				</td>

				<td>
					<div id="panel2" class="col-sm-9 col-xs-12" style="display:none;">
						<div class="panel panel-primary">
							<div class="panel-heading">PollBoard (Recent 10 posts)</div>
							<div class="panel-body">
								<ul>
									<?

									$query = "SELECT id, subject, date FROM poll_board ORDER BY id DESC LIMIT ".$limit;

									$response = @mysqli_query($dbc, $query);

									if($response){

										while($row = mysqli_fetch_array($response)){

			//댓글 세는 기능

											$reply_query = "SELECT * FROM poll_reply WHERE parents_id = ".$row['id']." LIMIT = ".$limit;
											$reply_response = @mysqli_query($dbc, $reply_query);
											$num_reply = $reply_response->num_rows;

											echo '<li><a href="./poll_board/get_poll_content.php?id='.$row['id'].'">'.$row['subject'];

											if($num_reply != 0){
												echo '['.$num_reply.']';
											}

											echo '</li>';

										}

									} else {

										echo "Couldn't issue database query ";

										echo mysqli_error($dbc);
									}

									mysqli_close($dbc);

									?>
								</ul>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<hr>
	</center>

</body>
<footer>
	<center>
		<h5>Tested in Chrome browser only.</h5>
		<h5>Copyright ⓒ2014 By Durumi, All Rights Resrved.</h5>
		<h5>Crafted with Sublime Text 3 and built with HTML 5, CSS3, jQuery, PHP and MySQL.</h5>
	</center>
</footer>
</html>

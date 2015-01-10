<!DOCTYPE html>
<html>
<head>
	<title>Take a Look</title>
<!-- 	<meta content='This is my test website. feel free to come in' name='description'>
	<meta content='Hello, HTML, CSS, Javascript, jQuery, PHP' name='keywords'>
	<meta content='index, follow' name='robots'> -->
	<?php

	include('./header/header.php');

	?>
	<script src="./javascript/jssor.slider.mini.js"></script>

	<script>
		$(function(){

			$('#introduce').fadeIn(1500);
			$('.recent_box').fadeIn(1500);


			var options = { $AutoPlay: true };
			var jssor_slider1 = new $JssorSlider$('slider1_container', options);

			$('#silder_toggle').click(function(){
				$('#slider1_container').fadeToggle();
			});

		});

	</script>

</head>
<body style="background-color: white;">
	<center>
		<div id="introduce">
			<br/>
			<div>
				<div><h1>About me</h1></div>
				<p>Hi! My name is Durumi and I am from Korea. Now I am a senior student in a college. Recently, I studied MEAN stack which is including node.js and angular.js but I don't feel comfortable with that. So I am currently working on test project using that. But if you want contact me, feel free to leave a message in <a href="/basic_board/get_basic_board.php">freeboard</a>. Or send a message to my email which is <b>ac12bd@gmail.com</b></p>
				<p>Then I'll check as soon as possible.</p>
			</div>
			<div class="btn-group" role="group" aria-label="...">
				<input id="silder_toggle" type="button" class="btn btn-default" value="Toggle the silder"></input>
			</div>
		</div>

		<article>
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

			<br/>
			<div>
				<div class="menu">
					<ul>
						<a href="./index.php"><li>Home</li></a>
						<a href="./basic_board/get_basic_board.php"><li>FreeBoard</li></a>
						<a href="./poll_board/get_poll_board.php"><li>PollBoard</li></a>
						<a href="./ext/nanaitgirl.php"><li>Nana it girl</li></a>
						<a href="./ext/examgall.php"><li>Dcinside</li></a>
						<a href=""><li>Don't click</li></a>
					</ul>
				</div>
				<div class="recent_box">
					<div class="title_box">FreeBoard - Recent 10</div>
					<div class="content_box">
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

								echo '<li><a href="./basic_board/get_basic_content.php?id='.$row['id'].'"><div class="list_text">'.$row['subject'];

								if($num_reply != 0){
									echo '['.$num_reply.']';
								}

								echo '</div></a></li>';

							}

						} else {

							echo "Couldn't issue database query ";

							echo mysqli_error($dbc);
						}


						?>
						</ul>
					</div>
				</div>

				<div class="recent_box">
					<div class="title_box">PollBoard - Recent 10</div>
					<div class="content_box">
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

								echo '<li><a href="./poll_board/get_poll_content.php?id='.$row['id'].'"><div class="list_text">'.$row['subject'];

								if($num_reply != 0){
									echo '['.$num_reply.']';
								}

								echo '</div></a></li>';

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
			<hr/>
		</article>
	</center>
</body>
<footer>

	<center>
		<h5>Tested in Chrome, Firefox and Exploer.</h5>
		<h5>Copyright ⓒ2014 By Durumi, All Rights Resrved.</h5>
		<h5>Crafted with Sublime Text 3 and built with HTML 5, CSS3, jQuery, PHP and MySQL.</h5>
	</center>
</footer>
</html>

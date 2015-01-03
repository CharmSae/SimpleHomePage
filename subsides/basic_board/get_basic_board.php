<!DOCTYPE html>
<html>
	<head>
		<title>게시판 - 목록</title>
		<?php

		include('../header/header.php');
		include('../board_query/board_query.php');

		?>

	</head>
<body>
	<center>
	<br/>
	<p>Free Board</p>
	<hr/>
<?

make_board_query('basic');

?>
	<hr/>
	<form action="./add_basic.html">
		<div class="btn-group" role="group" aria-label="...">
		  <input type="submit" class="btn btn-default" value="글쓰러가기(Add post)"></input>
		</div>
	</form>
	</center>
</body>
</html>

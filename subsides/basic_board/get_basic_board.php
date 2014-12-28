<!DOCTYPE html>
<html>
	<head>
		<title>게시판 - 목록</title>
		<?php

		include('../header/header.php');
		include('../board_query/board_query.php');

		make_header();

		?>
	</head>
<body>
	<center>
<?

make_board_query('basic');

?>
	<hr>
	
		<div class="btn-group" role="group" aria-label="...">
		  <button type="button" class="btn btn-default"><a href="http://subsides.hostei.com/basic_board/add_basic.html">글쓰러가기</a></button>
		</div>
	</center>
</body>
</html>

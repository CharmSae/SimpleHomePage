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

make_board_query('poll');

?>
	<hr>
			<div class="btn-group" role="group" aria-label="...">
			  <button type="button" class="btn btn-default"><a href="./add_poll.html">글쓰러가기</a></button>
			</div>
	</center>
</body>
</html>

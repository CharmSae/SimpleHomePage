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
	<div style="width:160px;"><h2>PollBoard</h2></div>
	
<?

make_board_query('poll');

?>
	<hr/>
	<form action="./add_poll.html">
		<div class="btn-group" role="group" aria-label="...">
		  <input type="submit" class="btn btn-default" value="글쓰러가기(Add post)"></input>
		</div>
	</form>
	</center>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
	<?php

	include('../header/header.php');
	include('../board_query/content_query.php');
	include('../board_query/reply_query.php');

	?>
</head>
<body>
	<center>
	<h2>게시판 - 내용</h2>
	<hr>
<?

make_content_query('basic', $_REQUEST['id']);
make_reply_query('basic', $_REQUEST['id']);

?>

	<hr>
	<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/basic_board/add_basic.html">글쓰러가기</a>
	<a href="http://subsides.hostei.com/basic_board/update_basic_content.php?id=<?=$_REQUEST['id']?>">수정하기</a>
	<a href="../board_query/delete_board_confirm.php?board_name=basic&id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>

</body>
</html>

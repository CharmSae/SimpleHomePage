<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>게시판 - 내용</title>
	<style type="text/css">
	.subject {text-align: center;}
	.subject tr td {border-bottom: 1px solid #E5E5E5;}
    .subject tr td a {text-decoration: none; font-family: dotum;}
	.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
	.gnb {padding: 0.3em; background-color: #F34677;}
	.gnb ul li {display: inline; padding: 0 2em;}
	.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none;}
	</style>

</head>
<body>
	<body bgcolor="EEEEEE">
	<br>
	<center>
	<h2>게시판 - 내용</h2>
	<header>
			<nav class="gnb">
			<h2>주요메뉴</h2>
			<ul>
				<li><a href="http://subsides.hostei.com/index.php">Home</a></li>
				<li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
				<li><a href="">갤러리</a></li>
				<li><a href="">쇼핑몰</a></li>
				<li><a href="http://subsides.hostei.com/get_basic_board.php">토렌트</a></li>

			</ul>
			</nav>

		</header>
	<hr>

	<?php

	require_once('./mysqli_connector.php');

	$stmt = mysqli_prepare($dbc, "UPDATE poll_board SET vote". $_REQUEST['vote']."=vote". $_REQUEST['vote']."+1 where id=?");

	mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

	mysqli_close($dbc);

	echo $_REQUEST['vote']."번에 투표하셨습니다";
	?>

	<a href="http://subsides.hostei.com/vote_result.php?id=<?=$_REQUEST['id']?>">결과보기</a>

	<hr>
	<a href="http://subsides.hostei.com/get_poll_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/basic_board.html">글쓰러가기</a>
	<a href="http://subsides.hostei.com/delete_board_confirm.php?id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>
</body>
</html>
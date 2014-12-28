<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
		<?php

		include('../header/header.php');

		make_header();

		?>
</head>
<body>
	<center>
	<h2>게시판 - 내용</h2>
	
	<hr>
		<form action="./delete_board_content.php" method = "post">
			<p>비밀번호를 입력하시면 삭제됩니다.</p>
			<p>
			<input type ="hidden" name = "id" value="<?=$_REQUEST['id']?>" />
			<input type ="hidden" name = "content_name" value="<?=$_REQUEST['content_name']?>" />
			</p>
			<p> <input type="password" name="password" size="30" value="" placeholder="이곳에 입력하세요"/>
			</P>
			<p>
			<input type ="submit" name = "submit" value="확인" />
			</p>
		</form>

	<hr>
	<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/basic_board/get_board_content.php?id=<?=$_REQUEST['id']?>">게시물로</a>
	<a href="http://subsides.hostei.com/basic_board/add_basic.html">글쓰러가기</a>
	</center>
</body>
</html>
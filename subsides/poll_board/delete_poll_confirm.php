<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
        <?php

        include('../header/header.php');
        include('../board_query/board_query.php');

        ?>
</head>
<body>
	<center>
	<h2>게시판 - 내용</h2>
	<hr>
		<form action="./delete_poll_content.php" method = "post">
			<p>비밀번호를 입력하시면 삭제됩니다.</p>
			<p>
			<input type ="hidden" name = "id" value="<?=$_REQUEST['id']?>" />
			</p>
			<p> <input type="password" name="password" size="30" value="" placeholder="이곳에 입력하세요"/>
			</P>
			<p>
			<input type ="submit" name = "submit" value="확인" />
			</p>
		</form>

	<hr>
	<a href="./get_poll_board.php">목록으로</a>
	<a href="./get_poll_content.php?id=<?=$_REQUEST['id']?>">게시물로</a>
	<a href="./add_poll.html">글쓰러가기</a>
	</center>
</body>
</html>
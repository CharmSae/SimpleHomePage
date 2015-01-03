<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
        <?php

        include('./header/header.php');
        include('./board_query/board_query.php');

        ?>
</head>
<body>
	
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
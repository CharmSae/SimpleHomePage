<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>게시판 - 내용</title>
	<style type="text/css">
	.subject {text-align: center;}
	.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
	.gnb {padding: 0.3em; background-color: #111;}
	.gnb ul li {display: inline; padding: 0 2em;}
	.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none;}
	</style>

</head>
<body>
	<body bgcolor="E5E5E5">
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

	$response = @mysqli_query($dbc, "SELECT password FROM basic_reply WHERE id =".$_REQUEST['id']."");

	if($response){

		$row = mysqli_fetch_array($response);
		
		if($row['password'] == $_REQUEST['password']){

	$query = "DELETE FROM basic_reply WHERE id = ?";

	$stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo '댓글삭제 완료';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo '댓글삭제 실패 <br/>';
                echo mysqli_error();

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);
            }
        } else {

        	echo "비밀번호가 틀렸습니다.";
        	mysqli_close($dbc);

        }

    } else {
    	echo "Couldn't issue database query ";

		echo mysqli_error($dbc);
		mysqli_close($dbc);
    }

    

	?>
	<a href="http://subsides.hostei.com/get_board_content.php?id=<?=$_REQUEST['parents_id']?>">원래글로</a>

	<hr>
	<a href="http://subsides.hostei.com/get_basic_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/basic_board.html">글쓰러가기</a>
	</center>
</body>
</html>
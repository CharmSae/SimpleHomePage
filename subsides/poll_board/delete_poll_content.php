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

	<?php

	require_once('../mysqli_connector.php');

	$response = @mysqli_query($dbc, "SELECT password FROM poll_board WHERE id =".$_REQUEST['id']."");

	if($response){

		$row = mysqli_fetch_array($response);
		
		if($row['password'] == $_REQUEST['password']){

	$query = "DELETE FROM poll_board WHERE id = ?";

	$stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo '글삭제 완료';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo '글삭제 실패 <br/>';
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

	<hr>
	<a href="./get_poll_board.php">목록으로</a>
	<a href="./add_poll.html">글쓰러가기</a>
	</center>
</body>
</html>
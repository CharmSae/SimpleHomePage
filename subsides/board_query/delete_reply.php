	<?php

	require_once('../mysqli_connector.php');

	$response = @mysqli_query($dbc, "SELECT password FROM ".$_REQUEST['content_name']."_reply WHERE id =".$_REQUEST['id']."");

	if($response){

		$row = mysqli_fetch_array($response);
		
		if($row['password'] == $_REQUEST['password']){

	$query = "DELETE FROM ".$_REQUEST['content_name']."_reply WHERE id = ?";

	$stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo '댓글삭제 완료 Delete success';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo '댓글삭제 실패 Delete failed';
                echo mysqli_error();

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);
            }
        } else {

        	echo "비밀번호가 틀렸습니다. (Wrong password)";
        	mysqli_close($dbc);

        }

    } else {
    	echo "Couldn't issue database query ";

		echo mysqli_error($dbc);
		mysqli_close($dbc);
    }

    

	?>
	<?php

	require_once('../mysqli_connector.php');

	$response = @mysqli_query($dbc, "SELECT password FROM ".$_POST['board_name']."_board WHERE id =".$_POST['id']);

	if($response){

		$row = mysqli_fetch_array($response);
		
		if($row['password'] == $_POST['password']){

			$query = "DELETE FROM ".$_POST['board_name']."_board WHERE id = ?";

			$stmt = mysqli_prepare($dbc, $query);


			mysqli_stmt_bind_param($stmt, "i", $_POST['id']);

			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if($affected_rows == 1){

				echo 'success';

				mysqli_stmt_close($stmt);
				mysqli_close($dbc);

			} else {

				echo 'failed';
				echo mysqli_error();

				mysqli_stmt_close($stmt);
				mysqli_close($dbc);
			}
		} else {

			echo "wrong password";
			mysqli_close($dbc);

		}

	} else {
		echo "Couldn't issue database query ";

		echo mysqli_error($dbc);
		mysqli_close($dbc);
	}


	?>
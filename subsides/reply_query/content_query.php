<?php

function make_content_query($content_name, $parents_id){

		require_once('../mysqli_connector.php');

		$stmt = mysqli_prepare($dbc, "UPDATE ".$content_name."_board SET hits=hits+1 where id=?");

		mysqli_stmt_bind_param($stmt, "i", $parents_id);

	    mysqli_stmt_execute($stmt);

	    mysqli_stmt_close($stmt);

		$query = "SELECT id, subject, content, writer, date, hits FROM ".$content_name."_board WHERE id = ".$parents_id."";

		$response = @mysqli_query($dbc, $query);

		if($response){

		echo '	<table width="920">
					<td>
				<div class="panel panel-default">
				  <!-- Default panel contents -->

				  <!-- Table -->
				  <table class="table">
				   	<tr class="first" align="center"><td width="70"><b>번호</b></td>
		            <td width="300"><b>제목</b></td>
		            <td width="100"><b>글쓴이</b></td>
		            <td width="100"><b>날짜</b></td>
		            <td width="50"><b>조회</b></td></tr>';

			$row = mysqli_fetch_array($response);

				echo '<tr align="center">
						<td>'.$row['id']. '</td>
						<td>'.$row['subject']. '</td>
						<td>'.$row['writer']. '</td>
						<td>'.$row['date']. '</td>
						<td>'.$row['hits']. '</td>

					</tr>
				</table></div></td></table>
				<hr>
			
				<table width="920">
				
				<tr>
					<td>'.nl2br($row['content']).'</td>
				</tr>
				</table>';

	} else {

		echo "Couldn't issue database query ";

		echo mysqli_error($dbc);
	}

	mysqli_close($dbc);
}
?>
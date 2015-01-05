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

	require_once('../mysqli_connector.php');

	$stmt = mysqli_prepare($dbc, "UPDATE poll_board SET hits=hits+1 where id=?");

	mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

	$query = "SELECT * FROM poll_board WHERE id = ".$_REQUEST['id']."";

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
			<hr>';

			if($_REQUEST)

			echo nl2br($row['content']).'<br>

			<table align="center" border="0" width="300" cellpadding="5" cellspacing="0">
			<tr>				
				<td><a href="./aftervote.php?id='.$_REQUEST['id'].'&vote=1"><img src="../image/poll/'.$row['src1'].'"  width="350"></a></td>
				<td><h1>VS.</h1></td>
				<td><a href="./aftervote.php?id='.$_REQUEST['id'].'&vote=2"><img src="../image/poll/'.$row['src2'].'"  width="350"></a></td>
			</tr>

			</table>';

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

	make_reply_query('poll', $_REQUEST['id']);

	?>

	<hr>
	<a href="./get_poll_board.php">목록으로</a>
	<a href="./add_poll.html">만들러가기</a>
	<a href="../board_query/delete_board_confirm.php?board_name=poll&id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>
	<br>
</body>
</html>
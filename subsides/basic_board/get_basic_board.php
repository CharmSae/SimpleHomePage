<!DOCTYPE html>
<html>
	<head>
		<title>게시판 - 목록</title>
		<?php

		include('../header/header.php');

		make_header();

		?>
	</head>
<body>
		<br><br><br>
		<center>
			    
<?

$per_page = 10;

require_once('../mysqli_connector.php');

$query = "SELECT * FROM basic_board ORDER BY id DESC";

$response = @mysqli_query($dbc, $query);

if($response){

	if($response->num_rows != 0){

		$total_results = $response->num_rows;
		$total_pages = ceil($total_results / $per_page);

		if(isset($_GET['page']) && is_numeric($_GET['page'])){

			$show_page = $_GET['page'];

			if($show_page > 0 && $show_page <= total_pages){

				$start = ($show_page - 1) * $per_page;
				$end = $start + $per_page;
			} else {

				$start = 0;
			$end = $per_page;
			}

		} else {

			$start = 0;
			$end = $per_page;
		}

		//display pagination

		//echo '<p><a href="get_all_board.php">전체보기</a> | <b>페이지</b><br>';
		?>
					<nav>
			  <ul class="pagination">
			    <li class="disabled">
			      <a href="#" aria-label="Previous">
			        <span aria-hidden="true">&laquo;</span>
			      </a>
			    </li> 
		<?
		for($i = 1; $i <= $total_pages; $i++){

			if(isset($_GET['page']) && $_GET['page'] == $i){

				echo '<li class="active"><a href="#">'.$i.'</a></li>';
			} else {
				echo '<li><a href="get_basic_board.php?page='.$i.'">'.$i.'</a></li>';
			}
		}

?>


			<li>
			      <a href="#" aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>
			
			<table width="920">
				<td>
			<div class="panel panel-default">
			  <!-- Default panel contents -->

			  <!-- Table -->
			  <table class="table">
			   	<tr style ="background-color: #E5E5E5" align="center"><td width="70"><b>번호</b></td>
	            <td width="300"><b>제목</b></td>
	            <td width="100"><b>글쓴이</b></td>
	            <td width="100"><b>날짜</b></td>
	            <td width="50"><b>조회</b></td></tr>
<?

		/*echo '<table class ="subject" border="0" width="920" cellpadding="5" cellspacing="0">
        <tr style ="background-color: #E5E5E5"><td width="70"><b>번호</b></td>
            <td width="400"><b>제목</b></td>
            <td width="100"><b>글쓴이</b></td>
            <td width="70"><b>날짜</b></td>
            <td width="50"><b>조회</b></td></tr>';*/

		for($i = $start; $i < $end; $i++){

			if($i == $total_results){
				break;
			}

			$response->data_seek($i);
			$row = $response->fetch_row();

			//댓글 세는 기능

			$reply_query = "SELECT * FROM basic_reply WHERE parents_id = ".$row[0];
			$reply_response = @mysqli_query($dbc, $reply_query);
			$num_reply = $reply_response->num_rows;
		

			echo '<tr align="center"><td>'.$row[0]. '</td>
					<td align="left">'.'<a href="http://subsides.hostei.com/get_board_content.php?id='.$row[0].'">'.
					$row[1];

			if($num_reply != 0){
				echo '['.$num_reply.']';
			}

			echo	'</a></td>
					<td>'.$row[3].'</td>
					<td>'.$row[5].'</td>
					<td>'.$row[6].'</td>';
			echo '</tr>';
		}

		echo '</table></div></td></table>';

	} else {
		echo "No results to display";
	}

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

/*$query = "SELECT id, subject, content, writer, date, hits FROM basic_board";

$response = @mysqli_query($dbc, $query);

if($response){

	echo '<table class ="subject" border="0" width="920" cellpadding="5" cellspacing="0">
        <tr style ="background-color: #EEEEEE"><td width="70"><b>번호</b></td>
            <td width="400"><b>제목</b></td>
            <td width="100"><b>글쓴이</b></td>
            <td width="70"><b>날짜</b></td>
            <td width="50"><b>조회</b></td></tr>';

		while($row = mysqli_fetch_array($response)){

			echo '<tr><td>'.$row['id']. '</td>
					<td align="left">'.'<a href="http://subsides.hostei.com/get_board_content.php?id='.$row['id'].'">'.
					$row['subject'].'</a></td>
					<td>'.$row['writer'].'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['hits'].'</td>';
			echo '</tr>';
		}

		echo '</table>';

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

*/

?>
	<hr>
	
		<div class="btn-group" role="group" aria-label="...">
		  <button type="button" class="btn btn-default"><a href="http://subsides.hostei.com/basic_board/basic_board.html">글쓰러가기</a></button>
		</div>
	</center>
</body>
</html>

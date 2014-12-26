<!DOCTYPE html>
<html>
	<head>
		<title>게시판 - 목록</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	  
	  <style>
	.subject {text-align: center;}
	.subject tr td {border-bottom: 1px solid #E5E5E5;}
    .subject tr td a {text-decoration: none; font-family: dotum;}
	.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
	.gnb {padding: 0.3em; background-color: #F34677;}
	.gnb ul li {display: inline; padding: 0 2em;}
	.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none;}
 	</style>

	</head>
<body>
	<body bgcolor="EEEEEE">
		<br>
		<center><h2>게시판 - 목록</h2>
		<header>
			<nav class="gnb">
			<h2>주요메뉴</h2>
			<ul>
				<li><a href="http://subsides.hostei.com/index.php">Home</a></li>
				<li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
				<li><a href="http://subsides.hostei.com/examgall.php">갤러리</a></li>
				<li><a href="http://subsides.hostei.com/ext.php">쇼핑몰</a></li>
				<li><a href="http://subsides.hostei.com/togoon_movie.php">토렌트</a></li>

			</ul>
			</nav>

		</header>
		<hr>
<?php

$per_page = 10;

require_once('./mysqli_connector.php');

$query = "SELECT * FROM poll_board ORDER BY id DESC";
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

		echo '<p><b>페이지</b><br>';
		for($i = 1; $i <= $total_pages; $i++){

			if(isset($_GET['page']) && $_GET['page'] == $i){

				echo '<b>'.$i.' </b>';
			} else {
				echo '<a href="get_poll_board.php?page='.$i.'">'.$i.'</a> ';
			}
		}

		echo '</p>';

		//display records in table
		echo '<table class ="subject" border="0" width="920" cellpadding="5" cellspacing="0">
        <tr style ="background-color: #E5E5E5"><td width="70"><b>번호</b></td>
            <td width="400"><b>제목</b></td>
            <td width="100"><b>글쓴이</b></td>
            <td width="70"><b>날짜</b></td>
            <td width="50"><b>조회</b></td></tr>';

		for($i = $start; $i < $end; $i++){

			if($i == $total_results){
				break;
			}

			$response->data_seek($i);
			$row = $response->fetch_row();

			$reply_query = "SELECT * FROM poll_reply WHERE parents_id = ".$row[0];
			$reply_response = @mysqli_query($dbc, $reply_query);
			$num_reply = $reply_response->num_rows;

			echo '<tr><td>'.$row[0]. '</td>
					<td align="left">'.'<a href="http://subsides.hostei.com/get_poll_content.php?id='.$row[0].'">'.
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

		echo '</table>';

	} else {
		echo "No results to display";
	}

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

?>
	<hr>
	<a href="http://subsides.hostei.com/add_poll.html">글쓰러가기</a>
	</center>
</body>
</html>

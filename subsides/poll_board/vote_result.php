<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>게시판 - 내용</title>
	<style type="text/css">
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

	$query = "SELECT * FROM poll_board WHERE id = ".$_REQUEST['id']."";

	$response = @mysqli_query($dbc, $query);

	if($response){

	echo '<table class ="subject" align="center" border="0" width="920" cellpadding="5" cellspacing="0">

		<tr style ="background-color: #E5E5E5"><td width="70"><b>번호</b></td>
            <td width="400"><b>제목</b></td>
            <td width="100"><b>글쓴이</b></td>
            <td width="70"><b>날짜</b></td>
            <td width="50"><b>조회</b></td></tr>
		</tr>';

		$row = mysqli_fetch_array($response);

			echo '<tr>
					<td>'.$row['id']. '</td>
					<td>'.$row['subject']. '</td>
					<td>'.$row['writer']. '</td>
					<td>'.$row['date']. '</td>
					<td>'.$row['hits']. '</td>

				</tr>
			</table>
			<hr>';

			echo nl2br($row['content']).'<br>

			<table class="subject" align="center" border="0" width="300" cellpadding="5" cellspacing="0">
			<tr>				
				<td><img src="./image/poll/'.$row['src1'].'" width="350"></td>
				<td><h1>VS.</h1></td>
				<td><img src="./image/poll/'.$row['src2'].'" width="350"></td>
			</tr>
			<tr>				
				<td><h1>'.$row['vote1'].'</h1></td>
				<td><h1>:</h1></td>
				<td><h1>'.$row['vote2'].'</h1></td>
			</tr>
			</table>';

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

	?>

	<hr>
	<a href="./get_poll_board.php">목록으로</a>
	<a href="./app_poll.html">글쓰러가기</a>
	<a href="./delete_poll_confirm.php?id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>
</body>
</html>
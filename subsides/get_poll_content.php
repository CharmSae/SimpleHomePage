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

	$stmt = mysqli_prepare($dbc, "UPDATE poll_board SET hits=hits+1 where id=?");

	mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

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

			if($_REQUEST)

			echo nl2br($row['content']).'<br>

			<table align="center" border="0" width="300" cellpadding="5" cellspacing="0">
			<tr>				
				<td><a href="aftervote.php?id='.$_REQUEST['id'].'&vote=1"><img src="poll/'.$row['src1'].'"  width="350"></a></td>
				<td><h1>VS.</h1></td>
				<td><a href="aftervote.php?id='.$_REQUEST['id'].'&vote=2"><img src="poll/'.$row['src2'].'"  width="350"></a></td>
			</tr>

			</table>';

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

//댓글 추가
	$date = date('ymdhis');
    $parents_id = $_REQUEST['id'];

	if(isset($_POST['submit'])){
        
        $data_missing = array();

        if(empty($_POST['content'])){
            $data_missing[] = '내용';
        } else {
            $content = trim($_POST['content']);
        }

        if(empty($_POST['nickname'])){
            $data_missing[] = '닉네임';
        } else {
            $nickname = trim($_POST['nickname']);
        }

        if(empty($_POST['password'])){
            $data_missing[] = '비밀번호';
        } else {
            $password = trim($_POST['password']);
        }
            

        if(empty($data_missing)){

            require_once('./mysqli_connector.php');

            $query = "INSERT INTO poll_reply (parents_id, content, nickname, password, date) VALUES(?,?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "isssd", $parents_id, $content, $nickname, $password, $date);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

        } else {

            echo '<script>alert(모든 항목을 입력하셔야 됩니다)</script>';

        }
    } 

    echo '<hr><table class="reply" align="center" border="0" width="920" cellpadding="2" cellspacing="0">';

	//댓글 조회
	$query = "SELECT * FROM poll_reply WHERE parents_id = ".$parents_id."";

	$response = @mysqli_query($dbc, $query);

	if($response){

		while($row = mysqli_fetch_array($response)){

		echo '<tr>
			<td width="100">
			<h5>'.$row['nickname'].
			'</td>
			<td>
			<h5>'.$row['content'].
			'</td>
			<td width="150">
			<h6>'.$row['date'].'</h6>
			</td>
			<td> 
			<a href="delete_poll_reply_confirm.php?parents_id='.$_REQUEST['id'].'&id='.$row['id'].'"><img src="btn_close.gif"></a>
			</td>
			</tr>';
		}

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

	?>

	<tr>
			<form action="get_poll_content.php" method="post">
			<td>
				<input type="hidden" name="id" value="<?=$_REQUEST['id']?>"/>
				<input type="text" name="nickname" size="10" value="" placeholder="닉네임"/>
				<input type="text" name="password" size="10" value="" placeholder="비밀번호"/>	
			</td>
			<td>
			<textarea name="content" cols="90" rows="3" value="">
			</textarea>
			</td>
			<td>
				<center>
				<input type="submit" name="submit" value="등록" style="height:45px; width:70px; font-size:12px; font-family:Gulim;"/>
			</center>
			</td>
			</form>
		</tr>
	</table>

	<hr>
	<a href="http://subsides.hostei.com/get_poll_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/add_poll.html">만들러가기</a>
	<a href="http://subsides.hostei.com/delete_poll_confirm.php?id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>
</body>
</html>
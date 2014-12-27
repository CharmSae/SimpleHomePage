<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
	<?php

	include('../header/header.php');

	make_header();

	?>

</head>
<body>
		<br><br><br>
		<center>

	<?

	date_default_timezone_set('Asia/Seoul');

	require_once('../mysqli_connector.php');

	$stmt = mysqli_prepare($dbc, "UPDATE basic_board SET hits=hits+1 where id=?");

	mysqli_stmt_bind_param($stmt, "i", $_REQUEST['id']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

	$query = "SELECT id, subject, content, writer, date, hits FROM basic_board WHERE id = ".$_REQUEST['id']."";

	$response = @mysqli_query($dbc, $query);

	if($response){

	?>
			
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

            $query = "INSERT INTO basic_reply (parents_id, content, nickname, password, date) VALUES(?,?,?,?,?)";

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
	$query = "SELECT * FROM basic_reply WHERE parents_id = ".$parents_id."";

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
			<a href="delete_reply_confirm.php?parents_id='.$_REQUEST['id'].'&id='.$row['id'].'"><img src="btn_close.gif"></a>
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
			<form action="get_board_content.php" method="post">
			<td>
				<input type="hidden" class="form-control"  name="id" value="<?=$_REQUEST['id']?>"/>
				<input type="text" class="form-control"  name="nickname" size="10" value="" placeholder="닉네임"/>
				<input type="text" class="form-control"  name="password" size="10" value="" placeholder="비밀번호"/>	
			</td>
			<td>
			<textarea class="form-control" name="content" cols="90" rows="3" value="">
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
	<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/basic_board/basic_board.html">글쓰러가기</a>
	<a href="http://subsides.hostei.com/basic_board/update_basic_content.php?id=<?=$_REQUEST['id']?>">수정하기</a>
	<a href="http://subsides.hostei.com/basic_board/delete_board_confirm.php?id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>

</body>
</html>
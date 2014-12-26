<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>게시판 - 내용</title>

		  	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style/main.css">

	<style type="text/css">
	.reply tr td {border-bottom: 1px solid #E5E5E5;}
	.subject {text-align: center;}
	.subject  tr td {border-bottom: 1px solid #E5E5E5;}
    .subject tr td a {text-decoration: none; font-family: dotum;}
	</style>

	 	<script src="./jquery-2.1.3.min.js"></script>
	<script>
	     $(function(){
	       	$(".dropdown-toggle").on('click', function() {
	       			var id = $(this).attr('data-id');
	    			$("#"+id).slideToggle();
	  	 });
	});
</script>
</head>
<body>
	<body bgcolor="EEEEEE">
	<header>
			 <nav class="navbar navbar-default navbar-fixed-top">
  				<div class="container-fluid">
    			<!-- Brand and toggle get grouped for better mobile display -->
    			<div class="navbar-header">
      			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        			<span class="sr-only">Toggle navigation</span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand">ReseachAll</a>
   				 </div>
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav navbar-right">
				      	<li><a href="http://subsides.hostei.com/index.php">Home <span class="sr-only">(current)</span></a></li>
				      	<li class="dropdown">
				          <a href="" data-id="dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">게시판<span class="caret"></span></a>
				          <ul id="dropdown" class="dropdown-menu" role="menu">
				            <li class="active"><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
				            <li class="divider"></li>
				            <li><a href="http://subsides.hostei.com/get_poll_board.php">투표게시판</a></li>
				          </ul>
				      </li>
				        
				        <li><a href="http://subsides.hostei.com/examgall.php">수능갤러리</a></li>
				        <li><a href="http://subsides.hostei.com/ext.php">나나잇걸</a></li>
				        <li class="dropdown">
				          <a href="" data-id="dropdown2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">토렌트<span class="caret"></span></a>
				          <ul id="dropdown2" class="dropdown-menu" role="menu">
				            <li><a href="http://subsides.hostei.com/togoon_movie.php">토군 - 영화</a></li>
				            <li class="divider"></li>
				            <li><a href="http://subsides.hostei.com/togoon_variety.php">토군 - 예능</a></li>
				            <li class="divider"></li>
				            <li><a href="http://subsides.hostei.com/togoon_drama.php">토군 - 드라마</a></li>
				          </ul>
				        </li>
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
		</header>
		<br><br><br>
		<center>

	<?php

	date_default_timezone_set('Asia/Seoul');

	require_once('./mysqli_connector.php');

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
	<a href="http://subsides.hostei.com/get_basic_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/basic_board.html">글쓰러가기</a>
	<a href="http://subsides.hostei.com/update_basic_content.php?id=<?=$_REQUEST['id']?>">수정하기</a>
	<a href="http://subsides.hostei.com/delete_board_confirm.php?id=<?=$_REQUEST['id']?>">삭제하기</a>
	</center>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
	</script>
</body>
</html>
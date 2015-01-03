<!DOCTYPE html>
<html>
	<head>
		<title>게시판 - 목록</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/main.css">
	  
	  <style>
	.subject {text-align: center;}
	.subject tr td {border-bottom: 1px solid #E5E5E5;}
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
				            <li class="active"><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판	</a></li>
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
		<center><br><br><br><br>
		<p><b>전체보기</b> | <a href="get_basic_board.php">페이지</a></p>
<?php

require_once('./mysqli_connector.php');

$query = "SELECT id, subject, content, writer, date, hits FROM basic_board ORDER BY id DESC";

$response = @mysqli_query($dbc, $query);

if($response){

	echo '<table class ="subject" border="0" width="920" cellpadding="5" cellspacing="0">
        <tr style ="background-color: #E5E5E5"><td width="70"><b>번호</b></td>
            <td width="400"><b>제목</b></td>
            <td width="100"><b>글쓴이</b></td>
            <td width="70"><b>날짜</b></td>
            <td width="50"><b>조회</b></td></tr>';

		while($row = mysqli_fetch_array($response)){

			//댓글 세는 기능

			$reply_query = "SELECT * FROM basic_reply WHERE parents_id = ".$row[0];
			$reply_response = @mysqli_query($dbc, $reply_query);
			$num_reply = $reply_response->num_rows;

			echo '<tr><td>'.$row['id']. '</td>
					<td align="left">'.'<a href="http://subsides.hostei.com/get_board_content.php?id='.$row['id'].'">'.
					$row['subject'];

			if($num_reply != 0){
				echo '['.$num_reply.']';
			}

			echo '</a></td>
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


?>
	<hr>
	<a href="http://subsides.hostei.com/basic_board.html">글쓰러가기</a>
	</center>
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
</script>
</body>
</html>

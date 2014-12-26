<!DOCTYPE html>
<html>
	<head>
		<title>게시판 - 목록</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<!-- Latest compiled and minified CSS -->
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style/main.css">

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
				      	<li><a href="http://subsides.hostei.com/index.php">Home</a></li>
				      	<li class="dropdown">
				          <a href="#" data-id="dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">게시판<span class="caret"></span></a>
				          <ul id="dropdown" class="dropdown-menu" role="menu">
				            <li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
				            <li class="divider"></li>
				            <li class="active"><a href="http://subsides.hostei.com/get_poll_board.php">투표게시판</a></li>
				          </ul>
				        
				        <li><a href="http://subsides.hostei.com/examgall.php">수능갤러리</a></li>
				        <li><a href="http://subsides.hostei.com/ext.php">나나잇걸</a></li>
				        <li class="dropdown">
				          <a href="#" data-id="dropdown2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">토렌트<span class="caret"></span></a>
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
		<br><br><br><center>
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

		//echo '<p><b>페이지</b><br>';
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
				echo '<li><a href="get_poll_board.php?page='.$i.'">'.$i.'</a></li>';
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


		//display records in table
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

			$reply_query = "SELECT * FROM poll_reply WHERE parents_id = ".$row[0];
			$reply_response = @mysqli_query($dbc, $reply_query);
			$num_reply = $reply_response->num_rows;

			echo '<tr align="center"><td>'.$row[0]. '</td>
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

		echo '</table></div></td></table>';

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
			<div class="btn-group" role="group" aria-label="...">
			  <button type="button" class="btn btn-default"><a href="http://subsides.hostei.com/add_poll.html">글쓰러가기</a></button>
			</div>
	</center>
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
</script>
</body>
</html>

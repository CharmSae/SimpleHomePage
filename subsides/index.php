<!DOCTYPE html>
<html>
<head>
<title>설문조사</title>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style/main.css">

<script src="./jquery-2.1.3.min.js"></script>
<script>
     $(function(){
        $('.panel').hide(1000).delay(500).show(500);

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
      			<a class="navbar-brand">ResearchAll</a>
   				 </div>
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav navbar-right">
				      	<li class="active"><a href="http://subsides.hostei.com/index.php">Home <span class="sr-only">(current)</span></a></li>
				      	<li class="dropdown">
				          <a href="" data-id="dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">게시판<span class="caret"></span></a>
				          <ul id="dropdown" class="dropdown-menu" role="menu">
				            <li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판	</a></li>
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
	<center>
		<br><br><br><br>
	<table border="0" width="900" cellpadding="0" cellspacing="0">
		<tr>
			<td>
		<ul class="nav nav-pills nav-stacked">
  		<li role="presentation"><a href="http://subsides.hostei.com/index.php">Home</a></li>
  		<li role="presentation"><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
  		<li role="presentation"><a href="http://subsides.hostei.com/get_poll_board.php">양자택일 - 게시판</a></li>
  		<li role="presentation"><a href="">토군</a></li>
  		<li role="presentation"><a href="http://subsides.hostei.com/ext.php">나나잇걸</a></li>
  		<li role="presentation"><a href="http://subsides.hostei.com/examgall.php">수능갤러리</a></li>
		</ul>
		</ul>
			</td>
			<td>
				<div class="col-sm-9 col-xs-12">
					<div class="panel panel-primary">
  					<div class="panel-heading">자유게시판</div>
  					<div class="panel-body">
  						<ul>

<?php
$limit = 10;

require_once('./mysqli_connector.php');

$query = "SELECT id, subject, date FROM basic_board ORDER BY id DESC LIMIT ".$limit;

$response = @mysqli_query($dbc, $query);

if($response){

		while($row = mysqli_fetch_array($response)){

			//댓글 세는 기능

			$reply_query = "SELECT * FROM basic_reply WHERE parents_id = ".$row['id']." LIMIT = ".$limit;
			$reply_response = @mysqli_query($dbc, $reply_query);
			$num_reply = $reply_response->num_rows;

			echo '<li><a href="http://subsides.hostei.com/get_board_content.php?id='.$row['id'].'">'.$row['subject'];

			if($num_reply != 0){
				echo '['.$num_reply.']';
			}

			echo '</li>';

		}

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}


?>
						</ul>
					</div>
					</div>
				</div>
			</td>

			<td>
				<div class="col-sm-9 col-xs-12">
					<div class="panel panel-primary">
  					<div class="panel-heading">투표게시판</div>
  					<div class="panel-body">
  						<ul>
<?

$query = "SELECT subject, date FROM poll_board ORDER BY id DESC LIMIT ".$limit;

$response = @mysqli_query($dbc, $query);

if($response){

	while($row = mysqli_fetch_array($response)){

			//댓글 세는 기능

			$reply_query = "SELECT * FROM poll_reply WHERE parents_id = ".$row['id']." LIMIT = ".$limit;
			$reply_response = @mysqli_query($dbc, $reply_query);
			$num_reply = $reply_response->num_rows;

			echo '<li><a href="http://subsides.hostei.com/get_board_content.php?id='.$row['id'].'">'.$row['subject'];

			if($num_reply != 0){
				echo '['.$num_reply.']';
			}

			echo '</li>';

		}

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

  mysqli_close($dbc);

?>
						</ul>
					</div>
					</div>
				</div>
			</td>
		</tr>
		</table>
		<table width="950">
			<tr>
				<td><hr></td>
			</tr>
		</table>
		</center>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
</script>

</body>
<footer>
	<center>
		<h5>Copyrightⓒ2014 By durumi. All right reserved.</h5>
		</center>
</footer>
</html>
<!DOCTYPE html>
<html>
<head>
<title>설문조사</title>
	<?php

	include('./header/header.php');

	make_header();

	?>

<script>
     $(function(){
        $('.panel').hide(1000).delay(500).show(500);
    });
</script>

</head>
<body>

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

<?
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

</body>
<footer>
	<center>
		<h5>Copyrightⓒ2014 By durumi. All right reserved.</h5>
		</center>
</footer>
</html>
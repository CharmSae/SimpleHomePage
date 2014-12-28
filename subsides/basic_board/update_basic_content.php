<!DOCTYPE html>
<html>

<head>

	<title>게시판 - 수정</title>
		<?php

		include('../header/header.php');

		make_header();

		?>
</head>
<body>
		<center>
		<b><h2>게시판 - 수정</h2></b>
<?

	require_once('../mysqli_connector.php');

	$query = "SELECT subject, content, writer FROM basic_board WHERE id = ".$_REQUEST['id'];

	$response = @mysqli_query($dbc, $query);

	if($response){

	$row = mysqli_fetch_array($response);
	$subject = nl2br($row['subject']);
	$content = nl2br($row['content']);
	$writer = nl2br($row['writer']);

	}

?>

	
	<table>
		<tr>
			<td>
			
	<form action = "http://subsides.hostei.com/basic_board/update_basic_content2.php" method = "post">
		<hr>

			<input type="hidden" name="id" value="<?=$_REQUEST['id']?>"/>
		<p>제목:
			<input type="text" name="subject" size="98" value="<?=$subject?>" placeholder="제목을 입력해 주세요"/>
		</p>
		<p>내용:
			<textarea name="content" cols="100" rows="15" value="" placeholder="내용을 쓰는 곳"><?=$content?></textarea>
		</p>
		<p>글쓴이:
			<input type="text" name="writer" size="30" value="<?=$writer?>" placeholder="이름을 입력해 주세요"/>
		</P>
		<p>비밀번호:
			<input type="password" name="password" size="30" value="" placeholder="비밀번호를 입력해 주세요"/>
		</P>
		<p>
			<input type ="submit" name = "submit" value="완료" />
		</p>
	</form>
		<hr>
			</td>
		</tr>
		
	</table>
	
	<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">게시판목록</a></center>
</body>
</html>
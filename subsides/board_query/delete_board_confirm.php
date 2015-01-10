<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
	<?php

	include('../header/header.php');

	?>

	<script>
		$(document).ready(function(){

			$('#button').on('click', deleteContent);

		});

		function deleteContent(event) {

			event.preventDefault();

			var delInfo = {
				'id': $('#id').val(),
				'board_name': $('#board_name').val(),
				'password': $('#password').val()
			}

			$.ajax({
				type: 'POST',
				data: delInfo,
				url: './delete_board_content.php',
				success: function(data){

					$('#result').html('<p>' + data +'</p>');

				}
				
			});

			$('#password_confirm').hide();
			$('#result').show();

		};
	</script>
</head>
<body>
	<center>
		<h2>게시판 - 내용</h2>

		<hr/>
		<div id="password_confirm">

			<p>비밀번호를 입력하시면 삭제됩니다. (Type the password)</p>
			<input id="id" type ="hidden" name = "id" value="<?=$_REQUEST['id']?>" />
			<input id="board_name" type ="hidden" name = "board_name" value="<?=$_REQUEST['board_name']?>" />
			<p><input id="password" type="password" name="password" size="30" value="" placeholder="이곳에 입력하세요 (here)"/></p>
			<p><input id="button" type="button" name ="button" value="확인" /></p>
			
		</div>
		<div id="result" style="display:none">
		</div>

		<hr/>
		<a href="http://subsides.hostei.com/basic_board/get_board_content.php?id=<?=$_REQUEST['id']?>">Go to the post</a>
		
		<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">Go to the board</a>
		<a href="http://subsides.hostei.com/basic_board/add_basic.html">New post</a>
	</center>
</body>
</html>
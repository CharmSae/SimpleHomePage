<!DOCTYPE html>
<html>
<head>
	<title>게시판 - 내용</title>
	<?php

	include('../header/header.php');

	?>

	<script>
		$(document).ready(function(){

			$('#button').on('click', deleteUser);

		});

		function deleteUser(event) {

			event.preventDefault();

			var delUser = {
				'id': $('#id').val(),
				'board_name': $('#board_name').val(),
				'password': $('#password').val()
			}

			$.ajax({
				type: 'POST',
				data: delUser,
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

		<hr>
		<div id="password_confirm">

			<p>비밀번호를 입력하시면 삭제됩니다.</p>
			<input id="id" type ="hidden" name = "id" value="<?=$_REQUEST['id']?>" />
			<input id="board_name" type ="hidden" name = "board_name" value="<?=$_REQUEST['board_name']?>" />
			<p><input id="password" type="password" name="password" size="30" value="" placeholder="이곳에 입력하세요"/></p>
			<p><input id="button" type="button" name ="button" value="확인" /></p>
			
		</div>
		<div id="result" style="display:none">
		</div>

		<hr>
		<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">목록으로</a>
		<a href="http://subsides.hostei.com/basic_board/get_board_content.php?id=<?=$_REQUEST['id']?>">게시물로</a>
		<a href="http://subsides.hostei.com/basic_board/add_basic.html">글쓰러가기</a>
	</center>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>게시판 - 내용</title>
	<style type="text/css">
	.subject {text-align: center;}
	.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
	.gnb {padding: 0.3em; background-color: #111;}
	.gnb ul li {display: inline; padding: 0 2em;}
	.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none;}
	</style>

</head>
<body>
	<body bgcolor="E5E5E5">
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
		<form action="http://subsides.hostei.com/delete_board_content.php" method = "post">
			<p>비밀번호를 입력하시면 삭제됩니다.</p>
			<p>
			<input type ="hidden" name = "id" value="<?=$_REQUEST['id']?>" />
			</p>
			<p> <input type="password" name="password" size="30" value="" placeholder="이곳에 입력하세요"/>
			</P>
			<p>
			<input type ="submit" name = "submit" value="확인" />
			</p>
		</form>

	<hr>
	<a href="http://subsides.hostei.com/get_basic_board.php">목록으로</a>
	<a href="http://subsides.hostei.com/get_board_content.php?id=<?=$_REQUEST['id']?>">게시물로</a>
	<a href="http://subsides.hostei.com/basic_board.html">글쓰러가기</a>
	</center>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>게시판 - 수정</title>
		  <style>
	.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
	.gnb {padding: 0.3em; background-color: #111;}
	.gnb ul li {display: inline; padding: 0 2em;}
	.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none;}
 	</style>
</head>
<body>
	<body bgcolor="EEEEEE">
		<br>
		<center>
		<b><h2>게시판 - 수정</h2></b>
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
<?php

	if(isset($_POST['submit'])){
        
        $data_missing = array();

        if(empty($_POST['subject'])){

            $data_missing[] = '제목';

        } else {
            $subject = trim($_POST['subject']);
        }

        if(empty($_POST['content'])){
            $data_missing[] = '내용';
        } else {
            $content = trim($_POST['content']);
        }

        if(empty($_POST['writer'])){
            $data_missing[] = '글쓴이';
        } else {
            $writer = trim($_POST['writer']);
        }

        if(empty($_POST['password'])){
            $data_missing[] = '비밀번호';
        } else {
            $password = trim($_POST['password']);
        }

    }

        if(empty($data_missing)){

			require_once('./mysqli_connector.php');



			$response = @mysqli_query($dbc, "SELECT password FROM basic_board WHERE id =".$_REQUEST['id']."");

			if($response){

				$row = mysqli_fetch_array($response);
		
					if($row['password'] == $_REQUEST['password']){

						$stmt = mysqli_prepare($dbc, "UPDATE basic_board SET subject=?, content=?, writer=? where id=?");

						mysqli_stmt_bind_param($stmt, "sssi", $subject, $content, $writer, $_REQUEST['id']);

   		 				mysqli_stmt_execute($stmt);

   		 				$affected_rows = mysqli_stmt_affected_rows($stmt);

            			if($affected_rows == 1){

                		echo '글쓰기 완료';

               			mysqli_stmt_close($stmt);
                		mysqli_close($dbc);

            			} else {

               				echo '글쓰기 실패 <br/>';
                			echo mysqli_error();

                			mysqli_stmt_close($stmt);
                			mysqli_close($dbc);
            			}


					} else {

        			echo "비밀번호가 틀렸습니다";
        			mysqli_close($dbc);

        			}

   		 	} else {
    				echo "쿼리를 실행할수 없습니다";

					echo mysqli_error($dbc);
					mysqli_close($dbc);
    		}

    	} else {

            echo '다음 항목을 입력하셔야 됩니다 <br/>';

            foreach($data_missing as $missing){

                echo "$missing <br/>";
            }
        }
?>
	<br>
	<a href="http://subsides.hostei.com/get_board_content.php?id=<?=$_POST['id']?>">수정글보기</a>
	<a href="http://subsides.hostei.com/get_basic_board.php">게시판목록</a></center>
</body>
</html>
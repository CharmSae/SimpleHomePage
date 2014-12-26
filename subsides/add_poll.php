<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

    <title>양자택일 - 만들기</title>
          <style>
    .subject {text-align: center;}
    .subject tr td {border-bottom: 1px solid #E5E5E5;}
    .subject tr td a {text-decoration: none; font-family: dotum;}
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
        <b><h2>양자택일 - 만들기</h2></b>
        <header>
            <nav class="gnb">
            <h2>주요메뉴</h2>
            <ul>
                <li><a href="http://subsides.hostei.com/index.php">Home</a></li>
                <li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
                <li><a href="">갤러리</a></li>
                <li><a href="">쇼핑몰</a></li>
                <li><a href="">토렌트</a></li>

            </ul>
            </nav>

        </header>

<?php

	$uploaddir = 'poll/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';

foreach ($_FILES["pictures"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {

        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
        $uploadfile = $uploaddir . basename($_FILES["pictures"]["name"][$key]);

        if (move_uploaded_file($tmp_name, $uploadfile)) {

    		echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";

		} else {

    		print "파일 업로드 공격의 가능성이 있습니다!\n";
		}
    }
}

	echo '자세한 디버깅 정보입니다:';
	print_r($_FILES);

	print "</pre>";

	$src1 = $_FILES['pictures']['name'][0];
	$src2 = $_FILES['pictures']['name'][1];

		echo '<img src="poll/'.$src1.'"/>';
		echo '<img src="poll/'.$src2.'"/>';

	//db에 입력
        
        $data_missing = array();

        if(empty($_POST['subject'])){

            $data_missing[] = '제목';

        } else {
            $subject = trim($_POST['subject']);
        }

        if(empty($_POST['content'])){
            $content = " ";
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

            $date = date('ymdHis');
            $hits = 0;
            $vote1 = 0;
            $vote2 = 0;

        if(empty($data_missing)){

            require_once('./mysqli_connector.php');

            $query = "INSERT INTO poll_board (subject, content, writer, password, date, hits, src1, src2, vote1, vote2) VALUES(?,?,?,?,?,?,?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "ssssdissii", $subject, $content, $writer, $password, $date, $hits, $src1, $src2, $vote1, $vote2);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo '만들기 완료';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo '만들기 실패 <br/>';
                echo mysqli_error();

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);
            }

        } else {

            echo '다음 항목을 입력하셔야 됩니다 <br/>';

            foreach($data_missing as $missing){

                echo "$missing <br/>";
            }
        }



?>

<hr>
<a href="http://subsides.hostei.com/get_poll_board.php">게시판목록</a>
</center>

</body>
</html>

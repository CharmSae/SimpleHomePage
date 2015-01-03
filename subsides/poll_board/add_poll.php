<!DOCTYPE html>
<html>
<head>
    <title>양자택일 - 만들기</title>
        <?php

        include('../header/header.php');
        include('../board_query/board_query.php');

        ?>
</head>
<body>
        <center>
        <label><h2>양자택일 - 만들기</h2></label>

<?php

	$uploaddir = '../image/poll/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';

foreach ($_FILES["pictures"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {

        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
        $uploadfile = $uploaddir . basename($_FILES["pictures"]["name"][$key]);

        if (move_uploaded_file($tmp_name, $uploadfile)) {

    		echo "파일이 유효하고, 성공적으로 업로드 되었습니다 (Image Upload Success).\n";

		} else {

    		print "파일 업로드 공격의 가능성이 있습니다! (Image Upload Failed)\n";
		}
    }
}

	print "</pre>";

	$src1 = $_FILES['pictures']['name'][0];
	$src2 = $_FILES['pictures']['name'][1];

		echo '<img src="../image/poll/'.$src1.'"/>';
		echo '<img src="../image/poll/'.$src2.'"/>';
        echo '</br>';

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

            require_once('../mysqli_connector.php');

            $query = "INSERT INTO poll_board (subject, content, writer, password, date, hits, src1, src2, vote1, vote2) VALUES(?,?,?,?,?,?,?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "ssssdissii", $subject, $content, $writer, $password, $date, $hits, $src1, $src2, $vote1, $vote2);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo '만들기 완료 (Success)';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo '만들기 실패 (Failed)<br/>';
                echo mysqli_error();

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);
            }

        } else {

            echo '다음 항목을 입력하셔야 됩니다 (You missing something)<br/>';

            foreach($data_missing as $missing){

                echo "$missing <br/>";
            }
        }



?>

<hr>
<a href="./get_poll_board.php">게시판목록</a>
</center>

</body>
</html>

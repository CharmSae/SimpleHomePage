<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

    <title>게시판 - 글쓰기</title>
        <?php

        include('../header/header.php');


        ?>
</head>
<body>

        <br><br><br>
        <center>
        <label><h2>게시판 - 글쓰기</h2></label>
        <br/>

<?php

    date_default_timezone_set('Asia/Seoul');
    
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

            $date = date('ymdHis');
            $hits = 0;


        if(empty($data_missing)){

            require_once('../mysqli_connector.php');

            $query = "INSERT INTO basic_board (subject, content, writer, password, date, hits) VALUES(?,?,?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "ssssdi", $subject, $content, $writer, $password, $date, $hits);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if($affected_rows == 1){

                echo '글쓰기 완료 (Success)';

                mysqli_stmt_close($stmt);
                mysqli_close($dbc);

            } else {

                echo '글쓰기 실패 (Failed)<br/>';
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
    } 

?>

<hr>
<a href="http://subsides.hostei.com/basic_board/get_basic_board.php">게시판목록</a>
</center>

</body>
</html>
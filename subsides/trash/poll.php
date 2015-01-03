<!DOCTYPE html>
<html>
<head>
    <title>나나잇걸</title>
    <meta charset="utf-8"/>
        <style>
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
        <h2><a href="http://www.nanaitgirl.com/">나나잇걸 닷컴</a></h2>
        <header>
            <nav class="gnb">
            <h2>주요메뉴</h2>
            <ul>
                <li><a href="http://subsides.hostei.com/index.php">Home</a></li>
                <li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
                <li><a href="http://subsides.hostei.com/examgall.php">갤러리</a></li>
                <li><a href="http://subsides.hostei.com/ext.php">쇼핑몰</a></li>
                <li><a href="http://subsides.hostei.com/togoon_movie.php">토렌트</a></li>

            </ul>
            </nav>

        </header>

</center>
<hr>
<br>
<?php

            require_once('./mysqli_connector.php');

            $query = "INSERT INTO poll (subject, content, writer, password, date, hits) VALUES(?,?,?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "ssssdi", $subject, $content, $writer, $password, $date, $hits);

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

            echo '다음 항목을 입력하셔야 됩니다 <br/>';

            foreach($data_missing as $missing){

                echo "$missing <br/>";
            }
        }
    } 	
	
?>
<hr>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>

</body>
</html>

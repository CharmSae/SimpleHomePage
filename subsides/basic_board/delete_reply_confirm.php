<!DOCTYPE html>
<html>
<head>
    <title>게시판 - 내용</title>
        <?php

        include('../header/header.php');

        make_header();

        ?>
</head>
<body>
    <br><br><br>
    <center>
    <h2>게시판 - 내용</h2>
    <hr>
        <form action="http://subsides.hostei.com/basic_board/delete_reply.php" method = "post">
            <p>비밀번호를 입력하시면 삭제됩니다.</p>
            <input type ="hidden" name = "parents_id" value="<?=$_REQUEST['parents_id']?>" />
              <input type ="hidden" name = "id" value="<?=$_REQUEST['id']?>" />
            <p> <input type="password" name="password" size="30" value="" placeholder="이곳에 입력하세요"/>
            </P>
            <p>
            <input type ="submit" name = "submit" value="확인" />
            </p>
        </form>

    <hr>
    </center>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>게시판 - 내용</title>
    <?php

    include('../header/header.php');

    ?>
    <script>
        $(document).ready(function(){

            $('#button').on('click', deleteReply);

        });

        function deleteReply(event) {

            event.preventDefault();

            var delInfo = {
                'parents_id': $('#parents_id').val(),
                'id': $('#id').val(),
                'content_name': $('#content_name').val(),
                'password': $('#password').val()
            }

            $.ajax({
                type: 'POST',
                data: delInfo,
                url: './delete_reply.php',
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
    <br><br><br>
    <center>
        <h2>게시판 - 내용</h2>
        <hr/>
        <div id="password_confirm">

            <p>비밀번호를 입력하시면 삭제됩니다. (Type the password)</p>
            <input type ="hidden" id = "parents_id" value="<?=$_REQUEST['parents_id']?>" />
            <input type ="hidden" id = "id" value="<?=$_REQUEST['id']?>" />
            <input type ="hidden" id = "content_name" value="<?=$_REQUEST['content_name']?>" />
            <p><input type="password" id="password" size="30" value="" placeholder="이곳에 입력하세요 (here)"/></p>
            <p><input type ="button" id = "button" value="확인" /></p>

        </div>
        <div id="result" style="display:none">
        </div>

        <hr/>
        <a href="../<?=$_REQUEST['content_name']?>_board/get_<?=$_REQUEST['content_name']?>_content.php?id=<?=$_REQUEST['parents_id']?>">Go to the post</a>
        <a href="../<?=$_REQUEST['content_name']?>_board/get_<?=$_REQUEST['content_name']?>_board.php">Go to the board</a>
        <a href="../<?=$_REQUEST['content_name']?>_board/add_<?=$_REQUEST['content_name']?>.html">New post </a>
    </center>
</body>
</html>
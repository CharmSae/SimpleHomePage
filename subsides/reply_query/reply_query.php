<?php

function make_reply_query($content_name, $parents_id){


//댓글 추가
	date_default_timezone_set('Asia/Seoul');
	$date = date('ymdhis');

	if(isset($_POST['submit'])){
        
        $data_missing = array();

        if(empty($_POST['content'])){
            $data_missing[] = '내용';
        } else {
            $content = trim($_POST['content']);
        }

        if(empty($_POST['nickname'])){
            $data_missing[] = '닉네임';
        } else {
            $nickname = trim($_POST['nickname']);
        }

        if(empty($_POST['password'])){
            $data_missing[] = '비밀번호';
        } else {
            $password = trim($_POST['password']);
        }
            

        if(empty($data_missing)){

            $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			OR die('Could not connect to MySQL ' . mysqli_connect_error());

            $query = "INSERT INTO ".$content_name."_reply (parents_id, content, nickname, password, date) VALUES(?,?,?,?,?)";

            $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_bind_param($stmt, "isssd", $parents_id, $content, $nickname, $password, $date);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

        } else {

            echo '<script>alert(모든 항목을 입력하셔야 됩니다)</script>';

        }
    }

    echo '<hr><table class="reply" align="center" border="0" width="920" cellpadding="2" cellspacing="0">';

	//댓글 조회
    $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
	OR die('Could not connect to MySQL ' . mysqli_connect_error());

	$query = "SELECT * FROM ".$content_name."_reply WHERE parents_id = ".$parents_id;

	$response = @mysqli_query($dbc, $query);

	if($response){

		while($row = mysqli_fetch_array($response)){

		echo '<tr>
			<td width="100">
			<h5>'.$row['nickname'].
			'</td>
			<td>
			<h5>'.$row['content'].
			'</td>
			<td width="150">
			<h6>'.$row['date'].'</h6>
			</td>
			<td> 
			<a href="../reply_query/delete_reply_confirm.php?parents_id='.$parents_id.'&id='.$row['id'].'&content_name='.$content_name.'"><img src="../image/btn_close.gif"></a>
			</td>
			</tr>';
		}

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

echo '		<tr>
			<form action="../'.$content_name.'_board/get_'.$content_name.'_content.php" method="post">
			<td>
				<input type="hidden" class="form-control"  name="id" value="'.$parents_id.'"/>
				<input type="text" class="form-control"  name="nickname" size="10" value="" placeholder="닉네임"/>
				<input type="text" class="form-control"  name="password" size="10" value="" placeholder="비밀번호"/>	
			</td>
			<td>
			<textarea class="form-control" name="content" cols="90" rows="3" value="">
			</textarea>
			</td>
			<td>
				<center>
				<input type="submit" name="submit" value="등록" style="height:45px; width:70px; font-size:12px; font-family:Gulim;"/>
			</center>
			</td>
			</form>
		</tr>
	</table>';
	
}
?>
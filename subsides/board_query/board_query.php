<?php
function make_board_query($board_name){

	$posts_per_page = 10;
	$pages_per_page = 10;

	$page_start = 1; // 1 start
	$page_end = $pages_per_page;

	$start = 0; // 0 start
	$end = $posts_per_page;
	$current_page_group = 1;

	$show_page = 1; // 1 start

	require_once('../mysqli_connector.php');

	$query = "SELECT * FROM ".$board_name."_board ORDER BY id DESC";

	$response = @mysqli_query($dbc, $query);

	if($response){

		if($response->num_rows != 0){

			$total_results = $response->num_rows;
			$total_pages = ceil($total_results / $posts_per_page);

			if(isset($_GET['page']) && is_numeric($_GET['page'])){

				$show_page = $_GET['page'];
				$current_page_group = ceil($show_page / $pages_per_page);

				$page_end = $current_page_group * $pages_per_page;
				$page_start = ($page_end - $pages_per_page + 1);

				if($page_start == 0){
					$page_start = 1;
				}
				
				if($show_page > 0 && $show_page <= total_pages){

					$start = ($show_page - 1) * $posts_per_page;
					$end = $start + $posts_per_page;
				}

			}

		//display pagination

		//echo '<p><a href="get_all_board.php">전체보기</a> | <b>페이지</b><br>';
			?>
			<nav>
				<ul class="pagination">
					
					<?

					if($current_page_group > 1){

						echo '<li>
						<a href="get_'.$board_name.'_board.php?page='.($page_start - 1).'" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>';

				} else {
					echo '<li class="disabled">
					<a href="" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>';

			}


			for($i = $page_start; $i <= $page_end; $i++){

				if($i > $total_pages){
					break;
				}

				if($i == $show_page){

					echo '<li class="active"><a href="#">'.$i.'</a></li>';

				} else {

					echo '<li><a href="get_'.$board_name.'_board.php?page='.$i.'">'.$i.'</a></li>';

				} 

			}

			if($current_page_group < ceil($total_pages/$pages_per_page)){

				echo '<li>
				<a href="get_'.$board_name.'_board.php?page='.($page_end + 1).'" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>';
		} else {
			echo '<li class = "disabled">
			<a href="" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>';
	}

	?>

</ul>
</nav>

<table width="920">
	<td>
		<div class="panel panel-default">
			<!-- Default panel contents -->

			<!-- Table -->
			<table class="table">
				<tr class="first" align="center"><td width="70"><b>번호</b></td>
					<td width="300"><b>제목</b></td>
					<td width="100"><b>글쓴이</b></td>
					<td width="100"><b>날짜</b></td>
					<td width="50"><b>조회</b></td></tr>
					<?

		/*echo '<table class ="subject" border="0" width="920" cellpadding="5" cellspacing="0">
        <tr style ="background-color: #E5E5E5"><td width="70"><b>번호</b></td>
            <td width="400"><b>제목</b></td>
            <td width="100"><b>글쓴이</b></td>
            <td width="70"><b>날짜</b></td>
            <td width="50"><b>조회</b></td></tr>';*/

            for($i = $start; $i < $end; $i++){

            	if($i == $total_results){
            		break;
            	}

            	$response->data_seek($i);
            	$row = $response->fetch_row();

			//댓글 세는 기능

            	$reply_query = "SELECT * FROM ".$board_name."_reply WHERE parents_id = ".$row[0];
            	$reply_response = @mysqli_query($dbc, $reply_query);
            	$num_reply = $reply_response->num_rows;


            	echo '<tr align="center"><td>'.$row[0]. '</td>
            	<td align="left">'.'<a href="./get_'.$board_name.'_content.php?id='.$row[0].'">'.
            		$row[1];

            		if($num_reply != 0){
            			echo '['.$num_reply.']';
            		}

            		echo	'</a></td>
            		<td>'.$row[3].'</td>
            		<td>'.$row[5].'</td>
            		<td>'.$row[6].'</td>';
            		echo '</tr>';
            	}

            	echo '</table></div></td></table>';

            } else {
            	echo "No results to display";
            }

        } else {

        	echo "Couldn't issue database query ";

        	echo mysqli_error($dbc);
        }

        mysqli_close($dbc);

}

?>
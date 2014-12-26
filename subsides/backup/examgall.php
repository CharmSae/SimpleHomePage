<!DOCTYPE html>
<html>
<head>
    <title>디씨 수능갤러리</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    
    <style>
    .subject {text-align: center;}
    .subject tr td {border-bottom: 1px solid #E5E5E5;}
    .subject tr td a {text-decoration: none; font-family: dotum; font-size: 3;}
.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
.gnb {padding: 0.3em; background-color: #45A8F1;}
.gnb ul li {display: inline; padding: 0 2em;}
.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none; font-size: 3;}
 </style>

</head>   
<body>
<body bgcolor="#EEEEEE">
<br>
    <center><h2>수능갤러리</h2></center>
    <center>
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
<hr>
</center>
<?php
	
	$url="http://job.dcinside.com/board/lists/?id=exam_new&page=1";
    $html = file_get_contents($url);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
	
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);

    $subjects = $finder->query("//*[contains(@class, 'tb')]");

    echo '<center>';
    echo '<table style = "border-spacing: 0px;" class="subject" valign = "top" cellspacing="6" cellpadding="6">

        <tr style ="background-color: #E5E5E5"><td><b>번호</b></td>
            <td><b>제목</b></td>
            <td><b>글쓴이</b></td>
            <td><b>날짜</b></td>
            <td><b>조회</b></td></tr>';

        for ($i=0; $i < $subjects->length; $i++) { 

            $id = $subjects->item($i)->childNodes->item(0)->textContent;
            $href = $subjects->item($i)->childNodes->item(2)->childNodes->item(0)->getAttribute("href");
            $subject = $subjects->item($i)->childNodes->item(2)->textContent;
            $writer = $subjects->item($i)->childNodes->item(4)->textContent;
            $date = $subjects->item($i)->childNodes->item(6)->textContent;
            $hits = $subjects->item($i)->childNodes->item(8)->textContent;

            $want = "지";
            $finding = strpos($id, $want);

            if($finding == true){
            echo '<tr><td align = "center"><b>'.
            $id.'</td><td align="left">'.
            '<a href="http://gall.dcinside.com/'.$href.'"><b>'.$subject.'</a>'.
            '</td><td align="center"><b>'.$writer.'</td>'.
            '<td align="center">'.$date.'</td>'.
            '<td align="center">'.$hits.'</td></tr>';

            } else {
            echo '<tr><td align = "center">'.
            $id.'</td><td align="left">'.
            '<a href="http://gall.dcinside.com/'.$href.'">'.$subject.'</a>'.
            '</td><td align="center">'.$writer.'</td>'.
            '<td align="center">'.$date.'</td>'.
            '<td align="center">'.$hits.'</td></tr>';

            }

            

    }
    echo '</table>';

    //var_dump($subjects->item(0)->childNodes->item(2)->childNodes->item(0)->getAttribute("href"));
   //var_dump($subjects->item(6)->childNodes->item(6)->textContent);
?>
<hr>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>
<br><br>
</body>
</html>

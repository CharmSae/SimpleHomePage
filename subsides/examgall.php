<!DOCTYPE html>
<html>
<head>
    <title>디씨 수능갤러리</title>
    <?php

    include('./header/header.php');

    ?>

</head>
<body>

<br/>
<center>
<p>This page is from <a href="http://job.dcinside.com/board/lists/?id=exam_new&page=1">here</a>
<br/>
<hr/>
<?php
	
	$url="http://job.dcinside.com/board/lists/?id=exam_new&page=1";
    $html = file_get_contents($url);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
	
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);

    $subjects = $finder->query("//*[contains(@class, 'tb')]");

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
<hr/>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>
<br><br>
</body>
</html>

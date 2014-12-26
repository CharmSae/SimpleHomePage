<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>   
<body>
<center>
<font size="5"> <b>게시판</b></font>
<hr>
</center>
<?php
	
	$url="http://www.ilbe.com/ilbe";
    $html = file_get_contents($url);
	
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);

    $subjects = $finder->query("//*[contains(@class, 'title')]");
    //$thumbs = $finder->query("//*[contains(@class, 'thumb')]");
    echo '<center><b>';
        for ($i=0; $i < $subjects->length; $i++) { 

            if($i >25 && $i <47){
            $title = $subjects->item($i)->childNodes->item(1)->getAttribute('href');

            echo '<br><a href="'.$title.'">'.$subjects->item($i)->childNodes->item(1)->textContent.' ('.$subjects->item($i)->childNodes->item(3)->textContent.')</a>';

    	echo '<br>';
        
        }

        }

    echo '</b>';
?>
<br>
<hr>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>
</body>
</html>

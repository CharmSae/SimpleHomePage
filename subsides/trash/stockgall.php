<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>   
<body>
<center>
<font size="5"> <b>디씨 주식갤러리 일간베스트</b></font>
<hr>
</center>
<?php

	$url="http://gall.dcinside.com/board/lists/?id=stock_new&page=1&exception_mode=best";

    $html = file_get_contents($url);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
	
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);

    $subjects = $finder->query("//*[contains(@class, 'icon_pic_b')]");
    //$thumbs = $finder->query("//*[contains(@class, 'thumb')]");
    echo '<center><b>';
        for ($i=0; $i < $subjects->length; $i++) { 

        //$mystring = $thumbs->item($i)->getAttribute("src");
    	//echo '<center><img src = ' . $mystring.' /><br>';

    	//echo '<b>'.$subjects->item($i)->nodeValue.'<b/><br><br></center>';
        //var_dump($subjects->item($i)->textContent);
        echo '<br><a href="http://gall.dcinside.com/'.$subjects->item($i)->getAttribute('href').'">'.$subjects->item($i)->textContent.'</a>';

        //echo $subjects->item($i)->childNodes->item(5)->childNodes->item(0)->childNodes->item(3)->nodeValue.'<br>';
    	//echo $subjects->item($i)->childNodes->item(5)->childNodes->item(2)->childNodes->item(3)->nodeValue.'<br>';
    	echo '<br>';
    }
    echo '</b>';
?>
<br>
<hr>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>나나잇걸</title>
    <?php

    include('./header/header.php');

    ?>
</head>   
<body>

<br/>
<center>
<p>This page is from <a href="http://www.nanaitgirl.com/">here</a>
<br/>
<hr/>
<?php
	
	$url="http://www.nanaitgirl.com/";
    $html = file_get_contents($url);
	
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);
    $boxes = $finder->query("//*[contains(@class, 'box')]");
    $thumbs = $finder->query("//*[contains(@class, 'thumb')]");
    echo '<center><b>';
        for ($i=0; $i < $thumbs->length; $i++) { 
        $mystring = $thumbs->item($i)->getAttribute("src");
    	echo '<img src = ' . $mystring.' /><br>';

    	//echo '<b>'.$boxes->item($i)->nodeValue.'<b/><br><br></center>';
        echo $boxes->item($i)->childNodes->item(3)->childNodes->item(1)->nodeValue.'<br>';
        echo $boxes->item($i)->childNodes->item(5)->childNodes->item(0)->childNodes->item(3)->nodeValue.'<br>';
    	echo $boxes->item($i)->childNodes->item(5)->childNodes->item(2)->childNodes->item(3)->nodeValue.'<br>';

    	}
    echo '</b>';
?>
<hr/>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>
</body>
</html>

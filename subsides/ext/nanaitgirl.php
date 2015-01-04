<!DOCTYPE html>
<html>
<head>
    <title>나나잇걸</title>
    <?php

    include('../header/header.php');

    ?>
</head>   
<body>

<br/>
<center>
<p>This page is from <a href="http://www.nanaitgirl.com/">here</a></p>
<hr/>
<center>
    <div style="display:inline-block;">
    <?php
    	
    	$url="http://www.nanaitgirl.com/";
        $html = file_get_contents($url);
    	
        $doc = new DOMDocument();
        @$doc->loadHTML($html);

        $finder = new DomXPath($doc);
        $boxes = $finder->query("//*[contains(@class, 'box')]");
        $thumbs = $finder->query("//*[contains(@class, 'thumb')]");

            for ($i=0; $i < $thumbs->length; $i++) { 

            $mystring = $thumbs->item($i)->getAttribute("src");
        	echo '<div style="float: left; width: 320px; height: 550px;""><img src = ' . $mystring.' /><br/>';

        	//echo '<b>'.$boxes->item($i)->nodeValue.'<b/><br><br></center>';
            echo '<b>'.$boxes->item($i)->childNodes->item(3)->childNodes->item(1)->nodeValue.'</b><br/>';
            echo $boxes->item($i)->childNodes->item(5)->childNodes->item(0)->childNodes->item(3)->nodeValue.'<br/>';
        	echo $boxes->item($i)->childNodes->item(5)->childNodes->item(2)->childNodes->item(3)->nodeValue.'<br/>';
            echo '<br/></div>';

        	}
    ?>
    </div>
<br/>
<hr/>
<footer>
<a href="http://subsides.hostei.com/index.php">메인화면</a>
</footer>
</center>
<br/>
</body>
</html>

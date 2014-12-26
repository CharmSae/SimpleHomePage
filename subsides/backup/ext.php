<!DOCTYPE html>
<html>
<head>
    <title>나나잇걸</title>
    <meta charset="utf-8"/>
        <style>
.gnb h2 {visibility: hidden; font-size: 0; height: 0;}
.gnb {padding: 0.3em; background-color: #111;}
.gnb ul li {display: inline; padding: 0 2em;}
.gnb ul li a {color: #fff; font-weight: bold; text-transform: uppercase; text-decoration: none;}
 </style>
</head>   
<body>
<body bgcolor="E5E5E5">
<br>
<center>
        <h2><a href="http://www.nanaitgirl.com/">나나잇걸 닷컴</a></h2>
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

</center>
<hr>
<br>
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
<hr>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>

</body>
</html>

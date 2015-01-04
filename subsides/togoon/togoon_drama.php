<!DOCTYPE html>
<html>
<head>
    <?php

    include('../header/header.php');

    ?>
</head>   
<body>
<center>
<br/>
<div style="width:220px;">
<h2>Togoon - Drama</h2>
</div>
<hr/>
<?php
    $url="http://www.togoon.org/bbs/board.php?bo_table=torrent_tv";

    $html = file_get_contents($url);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
    
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);

    $subjects = $finder->query("//*[contains(@class, 'subject')]");
    //$thumbs = $finder->query("//*[contains(@class, 'thumb')]");
    echo '<b>';
 
        for ($i=0; $i < $subjects->length; $i++) { 

            
            $title_text = $subjects->item($i)->childNodes->item(1)->textContent;

            

            $want = "[자막]";
            $finding = strpos($title_text, $want);

            if($finding == true){
                $title = $subjects->item($i)->childNodes->item(3)->getAttribute('href');
                echo '<br><a href="http://www.togoon.org/'.$title.'">';
                echo $title_text.' '.$subjects->item($i)->childNodes->item(3)->textContent.'</a>';

            } else {
                $title = $subjects->item($i)->childNodes->item(1)->getAttribute('href');
                echo '<br><a href="http://www.togoon.org/'.$title.'">'.$title_text;
                echo '</a>';
            }


        echo '<br>';  

        }


    echo '</b>';

?>
<br/>
<hr/>
<a href="http://subsides.hostei.com/index.php">메인화면</a></center>
</body>
</html>

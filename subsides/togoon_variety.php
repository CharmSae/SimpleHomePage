<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style/main.css">

    <script src="./jquery-2.1.3.min.js"></script>
    <script>
     $(function(){
        $(".dropdown-toggle").on('click', function() {
                var id = $(this).attr('data-id');
                $("#"+id).slideToggle();
            });
    });
</script>
</head>   
<body>
    <body bgcolor="E5E5E5">
        <header>
             <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">ReseachAll</a>
                 </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="http://subsides.hostei.com/index.php">Home <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                          <a href="" data-id="dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">게시판<span class="caret"></span></a>
                          <ul id="dropdown" class="dropdown-menu" role="menu">
                            <li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판  </a></li>
                            <li class="divider"></li>
                            <li><a href="http://subsides.hostei.com/get_poll_board.php">투표게시판</a></li>
                          </ul>
                      </li>
                        
                        <li><a href="http://subsides.hostei.com/examgall.php">수능갤러리</a></li>
                        <li><a href="http://subsides.hostei.com/ext.php">나나잇걸</a></li>
                        <li class="dropdown">
                          <a href="" data-id="dropdown2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">토렌트<span class="caret"></span></a>
                          <ul id="dropdown2" class="dropdown-menu" role="menu">
                            <li><a href="http://subsides.hostei.com/togoon_movie.php">토군 - 영화</a></li>
                            <li class="divider"></li>
                            <li><a href="http://subsides.hostei.com/togoon_variety.php">토군 - 예능</a></li>
                            <li class="divider"></li>
                            <li><a href="http://subsides.hostei.com/togoon_drama.php">토군 - 드라마</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
        </header>
        <br><br><br><br>
<?php
    
    $url="http://www.togoons.com/bbs/board.php?bo_table=torrent_variety";
    $html = file_get_contents($url);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
    
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $finder = new DomXPath($doc);

    $subjects = $finder->query("//*[contains(@class, 'subject')]");
    //$thumbs = $finder->query("//*[contains(@class, 'thumb')]");
    echo '<center><b>';
 
        for ($i=0; $i < $subjects->length; $i++) { 

            
            $title_text = $subjects->item($i)->childNodes->item(1)->textContent;

            

            $want = "[자막]";
            $finding = strpos($title_text, $want);

            if($finding == true){
                $title = $subjects->item($i)->childNodes->item(3)->getAttribute('href');
                echo '<br><a href="http://www.togoons.com/'.$title.'">';
                echo $title_text.' '.$subjects->item($i)->childNodes->item(3)->textContent.'</a>';

            } else {
                $title = $subjects->item($i)->childNodes->item(1)->getAttribute('href');
                echo '<br><a href="http://www.togoons.com/'.$title.'">'.$title_text;
                echo '</a>';
            }


        echo '<br>';  

        }


    echo '</b>';

?>
<br>
<hr>

<div class="container">
<ul class="nav nav-pills">
<li role="presentation" class="active" align="center"><a href="http://subsides.hostei.com/index.php">메인화면</a></li>
</ul>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
</script>
</body>
</html>

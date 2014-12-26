<!DOCTYPE html>
<html>
<head>
    <title>디씨 수능갤러리</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style/main.css">

    <style>
    .subject {text-align: center;}
    .subject tr td {border-bottom: 1px solid #E5E5E5;}
    .subject tr td a {text-decoration: none; font-family: dotum;}
    </style>

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
    <body bgcolor="#EEEEEE">
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
                        <li><a href="http://subsides.hostei.com/index.php">Home</a></li>
                        <li class="dropdown">
                          <a href="#" data-id="dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">게시판<span class="caret"></span></a>
                          <ul id="dropdown" class="dropdown-menu" role="menu">
                            <li><a href="http://subsides.hostei.com/get_basic_board.php">자유게시판</a></li>
                            <li class="divider"></li>
                            <li><a href="http://subsides.hostei.com/get_poll_board.php">투표게시판</a></li>
                          </ul>
                      </li>
                        
                        <li class="active"><a href="http://subsides.hostei.com/examgall.php">수능갤러리</a></li>
                        <li><a href="http://subsides.hostei.com/ext.php">나나잇걸</a></li>
                        <li class="dropdown">
                          <a href="#" data-id="dropdown2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">토렌트<span class="caret"></span></a>
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
        <br><br><br>

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
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
</script>
</body>
</html>

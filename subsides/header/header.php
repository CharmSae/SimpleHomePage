
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://subsides.hostei.com//css/main.css">

<script>
	$(function(){
		$(".dropdown").hover(function() {
			$(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
		}, function() {
		 	$(this).find('.dropdown-menu').first().stop(true, true).slideUp(105);
		});

		$('li').click(function(){
			$('li').removeClass("active");
		    $(this).addClass("active");
		});
	});
</script>

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
				<a href="http://subsides.hostei.com/index.php" class="navbar-brand">Take a Look</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://subsides.hostei.com/index.php">Home <span class="sr-only">(current)</span></a></li>
					<li class="dropdown">
						<a href="" data-id="dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Boards<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="http://subsides.hostei.com/basic_board/get_basic_board.php">FreeBaord</a></li>
							<li class="divider"></li>
							<li><a href="http://subsides.hostei.com/poll_board/get_poll_board.php">PollBoard</a></li>
						</ul>
					</li>

					<li><a href="http://subsides.hostei.com/ext/examgall.php">Dcinside</a></li>
					<li><a href="http://subsides.hostei.com/ext/nanaitgirl.php">Nana it girl</a></li>
					<li class="dropdown">
						<a href="" data-id="dropdown2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Togoon<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="http://subsides.hostei.com/togoon/togoon_movie.php">Togoon - Movie</a></li>
							<li class="divider"></li>
							<li><a href="http://subsides.hostei.com/togoon/togoon_variety.php">Togoon - Variety</a></li>
							<li class="divider"></li>
							<li><a href="http://subsides.hostei.com/togoon/togoon_drama.php">Togoon - Drama</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</header>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="../javascript/jquery-2.1.3.min.js"></script>
<br><br>


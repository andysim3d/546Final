<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Edit Answer</title>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/index_site.css" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"
		id="nav_bar">
		<div class="container">
			<div class="navbar-header" id="navbar_header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../pages/index.php">Answer</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><form class="navbar-form ">
							<input type="text" class="form-control" placeholder="Search..." >
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Search</button>
						</form></li>
					<li><a href="../pages/index.php">Home</a></li>
					<li><a href="../pages/article.php">Article</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Settings <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../pages/profile.php">Profile</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				
					<li>
					
					
					<?php 
					if(isset($_SESSION['UID'])){
						echo "<button class=\"btn btn-primary\" id=\"login_button\">";
						echo $_SESSION['Name'];
					}
					else{
						echo "<button class=\"btn btn-primary\" id=\"login_button\">"; 
						echo "Login";
					}
					?>
					</button></li>
					
					<li>
					
					
					<?php 
					if(isset($_SESSION['UID'])){
						echo "<button class=\"btn btn-primary\" id=\"signup_button\">";
						echo "Log Out";
					}
					else{
						echo "<button class=\"btn btn-primary\" id=\"signup_button\">";
						echo "Sign Up";
					}
					?>
					</button>
							</li>
						<li>	
							<?php 
					if(isset($_SESSION['UID'])){
						echo "<button class=\"btn btn-primary\" id=\"post_button\" onclick=\"Jump_question()\">";
						echo "<span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>";
						echo "Add Questions";
						echo "</button>";
					}
					?>
	
							</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container" id="dialog_container">
		<div id="dialog" title="LOGIN">
			<form action="../include/AJAXLOGIN.php" method="post" id="login_form" novalidate="novalidate">
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Email:</label> <input id="email" name="email" type="text">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Password:</label> 

							<input id="password" name="password"
								type="password"/>
								 <button id="LoginBtn" type="Button"
								value="Login">Login 	</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
    <div class="container">
	<?PHP
	if(isset($_GET['var']))
	{
	include("../include/");
	}
	?>
	</div>
	<!-- /container -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script
		src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	
	
	</body>
</html>

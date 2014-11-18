<?php session_start(); 
  
  //$_SESSION['ID'] = 1;
  foreach ( $_SESSION as $key => $val ){ 
    # code...
    echo "$key => $val";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Profile</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/profile_site.css" rel="stylesheet">

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
				<a class="navbar-brand" href="../pages/index.html">Answer</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><form class="navbar-form ">
							<input type="text" class="form-control" placeholder="Search...">
							<button type="submit" class="btn btn-primary">Search</button>
						</form></li>
					<li ><a href="../pages/index.html">Home</a></li>
					<li><a href="../pages/article.html">Article</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Settings <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../pages/profile.html">Profile</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><button class="btn btn-primary">LOGIN</button></li>
					<li><button class="btn btn-primary" onclick="newDoc()">Sign Up</button></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">

		<form role="form" action="profileView.php" method="get">
			<fieldset>
				<legend>Personal Information</legend>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="Photo">Photo:</label> <img src=""
								class="img-thumbnail" width="200" height="200">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="Name">Name:</label> <input type="text"
								class="form-control" id="Name" name="Name" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="email">Email:</label> <input type="email"
								class="form-control" id="email" name="email" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="location">Location:</label> <input type="text"
								class="form-control" id="locaction" name="location" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="bod">Date of Birth:</label> <input type="date"
								class="form-control" id="bod" name="bod" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="habits">Habits:</label> <input type="text"
								class="form-control" id="habits" name="habits" readonly>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="edit" id="edit">Edit</button>
			</fieldset>
		</form>

	</div>
	<!-- /container -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>
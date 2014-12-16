<?php session_start(); 
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{

}
else{
header("Location: http://localhost/546Final/pages/index.php");
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
<title>Edit Answer</title>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/index_site.css" rel="stylesheet">

</head>
<?PHP  include '../include/page_title.php'; ?>

	<div class="container" id="dialog_container">
		<div id="dialog" title="LOGIN">
			<form method="post" id="login_form" novalidate="novalidate">
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

	<form role="form"  action="../include/Modify_Answer.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Edit Answer</legend>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6"> 
							  <input type="hidden" id="AID" name="AID" value="
							  <?PHP
							  echo $_GET['var'];
							  ?>
							  ">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="Content">Content:</label> 
							 <textarea id="Content" rows="5" cols="40"></textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="answer_edit" id="answer_edit">Submit</button>
			</fieldset>
		</form>

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
<?php session_start();?>
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
<?PHP include '../include/page_title.php';?>

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
	echo "<filedset>";
	include("../include/DB.php");
	if(isset($_GET['var']))
	{
		$res = GetQuestion_ByID($_GET['var']);
		//echo question;
		echo "<legend>\n";
		
		echo $res[0]['Title'];
		
		echo "</legend>\n";
		echo "<div>\n";
		echo $res[0]['Content'];
		echo "</div>\n";
		echo "<div>\n";
		echo $res[0]['Name'];
		echo "</div>\n";

		echo "<div>\n";
		echo $res[0]['Time'];
		echo "</div>\n";

		//echo $_GET['var']. "<br/>";
		$results = GetQuestion_Answer($_GET['var']);
		
		//foreach ($results as $key => $val){
		//	echo "$key => $val<br/>";
		//}
		if($results <= 0|| count($results) == 0){
			;
		}
		else{

			foreach ($results as $keys => $values) {
				//echo each file

				echo "<div class='jumbotron'>\n";
				echo "<div>\n";

				echo "<h6>\n";
					//generate body here
				echo "Poster:  ".$values['Name'];
				echo "</h6>\n";

				echo "<p>\n";
					//generate body here
				echo $values['Content'];
				echo "</p>\n";


				echo "<h6>\n";
					//generate body here
				echo "Date:  ".$values['Time'];
				echo "</h6>\n";

				echo "</div>\n";
				echo "</div>\n";
				//}
			}
		}
	}

	echo "</filedset>";
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


<?php session_start();
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
//print_r($_SESSION);
}
else{
//header("Location: http://localhost/546Final/pages/index.php");
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

<?PHP  include '../include/page_title.php';?>

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
	    	<fieldset>
			<legend>Question</legend>
	<?PHP
	include("../include/DB.php");
	if(isset($_GET['var']))
	{
       $question_id=$_GET['var'];
	   $question_content=GetQuestion_ByID($question_id);
	  // print_r($question_content);
		echo "<h3>".$question_content[0]['Title']."</h4>\n";
		echo "<p>Details:".$question_content[0]['Content']."</p>\n";
	    echo "<h6>Poster:".$question_content[0]['Name']."</h6>\n";
        echo "<h6>Time:".$question_content[0]['Time']."</h6>\n";
		echo "</fieldset>";
		echo "</div>";
	
	
	?>
	
	<div class="container"
	<?php
	if((isset($_SESSION['login']))&&($_SESSION['login']==true))
	{
	//print_r($_SESSION);
	}
	else{
	
	echo "hidden='true'";
	//header("Location: http://localhost/546Final/pages/index.php");
	}
	?>
	>

	<form  role="form" action="../include/addAnswer.php" method="Post"   id ="addAnswer_form" enctype="multipart/form-data" novalidate="novalidate">
			<fieldset>
				<legend>Post Your Answer</legend>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
						<input  type="hidden" id="QID" name="QID" value="<?PHP if(isset($_GET['var'])){echo $_GET['var'];} ?>"></input>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="Content">Content:</label> 
							 <textarea id="Content" name="Content" rows="5" cols="40"></textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="answer_submit" id="answer_submit">Submit</button>
			</fieldset>
		</form>

	</div>
	
	<div class="container">
	<fieldset>
				<legend>Answers</legend>
		<?PHP
		$answer_content=GetQuestion_Answer($question_id);
		//print_r($answer_content[0]);
		$i=0;
		$num=count($answer_content);
		while($i<$num)
		{
		echo "<div class=\"jumbotron\">\n";
		echo "<h6>Answer by:".$answer_content[0]['Name']."</h6>\n";
        echo "<h6>Time:".$answer_content[0]['Time']."</h6>\n";	
	    echo "<p><font size=\"3\">".$answer_content[$i]['Content']."</font></p>";
        echo "</div>";		
		$i++;
		}
	}
	?>
</fieldset>
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Index of Answer</title>

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
				<a class="navbar-brand" href="../pages/index.html">Answer</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><form class="navbar-form ">
							<input type="text" class="form-control" placeholder="Search...">
							<button type="submit" class="btn btn-primary">Search</button>
						</form></li>
					<li class="active"><a href="../pages/index.php">Home</a></li>
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
					<li><button class="btn btn-primary" onclick="login_check()">LOGIN</button></li>
					<li><button class="btn btn-primary" onclick="newDoc()">Sign Up</button></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">

		<fieldset>
		<legend>Content</legend>
		<?php
//change to your path
include ("./include/DB.php");
$LIMITATION=10;
	$db = new database();
	$db->connect();
	$query_question ="SELECT user.Name,questions.Title,questions.time,questions.QID
                      FROM `user` 
                      INNER JOIN `questions`
                      ON user.UID=questions.UID
";
	if(!$res_question = $db->send_sql($query_question)){
		$db->disconnect();
		echo "Get Questions failed!<br>\n";
		return -1;
	}
	$num = mysqli_num_rows($res_question);
	$i=0;
	
	while($i<$num)
	{
	    $content=$res_question->fetch_assoc();
		$content_question[$i][0]=$content['Name'];
		$content_question[$i][1]=$content['Title'];
		$content_question[$i][2]=$content['time'];
		$content_question[$i][3]=$content['QID'];
		$i++;
	}
	$i=0;
	while($i<$num)
	{
	 $question_id=$content_question[$i][3];
	 $query_answer="SELECT user.Name,answers.Content,answers.Time,answers.Anonymity,answers.Up_Vote,answers.Down_Vote
                    FROM `user` 
                    INNER JOIN `answers`
                    ON user.UID=answers.UID and answers.QID=$question_id;
	 ";
	 echo "<div class=\"jumbotron\">\n";	
	 echo "<h4>".$content_question[$i][1]."</h4>\n";
	 echo "<h6>Poster:".$content_question[$i][0]."</h6>\n";
     echo "<h6>Time:".$content_question[$i][2]."</h6>\n";	
	 
    if(!$res_answer = $db->send_sql($query_answer)){
		$db->disconnect();
		echo "Get Questions failed!<br>\n";
		return -1;
	}
	$answer_content=$res_answer->fetch_assoc();
	 echo "<p>".$answer_content['Content']."</p>";
     echo "<h6>".$answer_content['Name']."<h6>";
     echo "</div>";
	 
	 $i++;
	}	
?>
		</fieldset>

	</div>
	<!-- /container -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/index.js"></script>
</body>
</html>

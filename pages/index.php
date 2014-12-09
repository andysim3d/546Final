<?php session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Index of Answer</title>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/index_site.css" rel="stylesheet">

</head>

<?php  include '../include/page_title.php'; ?>
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
			<legend>Content</legend>
					<?php
			
//change to your path
include ("../include/DB.php");
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
	$i = 0;
	$num = mysqli_num_rows($res_question);
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
	 $query_answer="SELECT user.Name,answers.Content,answers.Time,answers.Anonymity,answers.Up_Vote,answers.Down_Vote,answers.AID
                    FROM `user` 
                    INNER JOIN `answers`
                    ON user.UID=answers.UID and answers.QID=$question_id;
	 ";
	 echo "<div class=\"jumbotron\">\n";
     echo "<h4><a href=\"question_view.php?var=".$content_question[$i][3]."\">".$content_question[$i][1]."</a></h4>\n";
	 echo "<h6>Poster:".$content_question[$i][0]."</h6>\n";
     echo "<h6>Time:".$content_question[$i][2]."</h6>\n";	
	 
    if(!$res_answer = $db->send_sql($query_answer)){
		$db->disconnect();
		echo "Get Questions failed!<br>\n";
		return -1;
	}
	$answer_content=$res_answer->fetch_assoc();
	 $len=strlen($answer_content['Content']);
	 if($len>150)
	 //If the length of the answer is too long, cut it 
	 {
	 $answer_str=$answer_content['Content'];
	 $answer_short=substr($answer_str,0,150);
	 echo "<p>".$answer_content['AID']."</p>";
	 echo "<div class=\"answer_wrapper\" style=\"cursor:pointer;\">";
	 echo "<div class=\"answer_summary\" style=\"display: block;\">".$answer_short."......</div>";
	 echo "<div class=\"answer_rich\" style=\"display: none;\">".$answer_content['Content']."</div>";
     echo "<h6>".$answer_content['Name']."<h6>";
     echo "</div>";
	 echo "<h4></h4>";
	 echo "<a href=\"#\" ><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$answer_content['Up_Vote']."</span>&nbspUp</a>";
	 echo "<span>&nbsp &nbsp &nbsp</span>";
	 echo "<a padding-left:10px><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$answer_content['Down_Vote']."</span>&nbspDown</a>";
     echo "</div>";
	 }
	 else
	 //If the length of the answer is suitable
	 {
	 echo "<p>".$answer_content['Content']."</p>";
	 echo "<p>".$answer_content['Name']."</p>";
	 echo "</div>";
	 }
	 $i++;
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
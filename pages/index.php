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
<?PHP
  include '../include/page_title.php';
?>	
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
	$query_question_count="SELECT COUNT(*)
	                       FROM `questions`
	";
		if(!$res_question_count = $db->send_sql($query_question_count)){
		$db->disconnect();
		echo "Get Questions failed!<br>\n";
		return -1;
	}
	$count=$res_question_count->fetch_assoc();
	$page=(int)$count['COUNT(*)']/10;
	$page_offset=(int)$count['COUNT(*)']%10;
	if($page_offset==0)
	{
	$page_offset=10;
	}
	$page_num=ceil($page);
	if(isset($_GET['var']))
	{
	$page_tag=$_GET['var'];
	}
	else
	{
	$page_tag="1";
	}
	$page_tag_int=((int)$page_tag-1)*10;
	if((int)$page_tag==$page_num)
	{
	$page_tag_offset=$page_offset;
	}
	else
	{
	$page_tag_offset=10;
	}
	//echo $page_num;
	$query_question ="SELECT user.Name,questions.Title,questions.time,questions.QID,user.UID
                      FROM `user` 
                      INNER JOIN `questions`
                      ON user.UID=questions.UID
					  LIMIT $page_tag_int,$page_tag_offset
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
		$content_question[$i][4]=$content['UID'];
		$i++;
	}
	$i=0;
	while($i<$num)
	{
	 $question_id=$content_question[$i][3];
	 $query_answer="SELECT user.Name,answers.Content,answers.Time,answers.Anonymity,answers.Up_Vote,answers.Down_Vote,answers.AID,user.UID
                    FROM `user` 
                    INNER JOIN `answers`
                    ON user.UID=answers.UID and answers.QID=$question_id;
	 ";
	 echo "<div class=\"jumbotron\">\n";
	 echo "<h4><a href=\"edit_answer.php?var=".$content_question[$i][3]."\">".$content_question[$i][1]."</a></h4>\n";
	 echo "<h6>Poster:<a href=\"profile.php?UID=".$content_question[$i][4]."\">".$content_question[$i][0]."</a></h6>\n";
     echo "<h6>Time:".$content_question[$i][2]."</h6>\n";	
	 
    if(!$res_answer = $db->send_sql($query_answer)){
		$db->disconnect();
		echo "Get Questions failed!<br>\n";
		return -1;
	}
	$answer_count=mysqli_num_rows($res_answer);
	if($answer_count!=0)
	{
	$answer_content=$res_answer->fetch_assoc();
	 
	 $len=strlen($answer_content['Content']);
	 $up_count=GetUpCount($answer_content['AID']);
	 $down_count=GetDownCount($answer_content['AID']);
	 if($len>150)
	 //If the length of the answer is too long, cut it 
	 {
	 $answer_str=$answer_content['Content'];
	 $answer_short=substr($answer_str,0,150);
	 echo "<div class=\"answer_wrapper\" style=\"cursor:pointer;\">";
	 echo "<div class=\"answer_summary\" style=\"display: block;\">".$answer_short."......</div>";
	 echo "<div class=\"answer_rich\" style=\"display: none;\">".$answer_content['Content']."</div>";
     echo "<h6>Answer By:<a href=\"profile.php?UID=".$answer_content['UID']."\">".$answer_content['Name']."</a></h6>";
	 echo "</div>";
	 echo "<h4></h4>";
	  if(isset($_SESSION['UID']))
	 {
	  echo "<div id=\"answer_info\" style=\"display: none;\">".$answer_content['AID']."</div>";
	 echo "<a href=\"#\" class=\"up_count_btn\" id=\"up_count_".$answer_content['AID']."\"><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$up_count."</span>&nbspUp</a>";
	 echo "<span>&nbsp &nbsp &nbsp</span>";
	   echo "<div id=\"answer_info\" style=\"display: none;\">".$answer_content['AID']."</div>";
	 echo "<a padding-left:10px href=\"#\" class=\"down_count_btn\" id=\"down_count_".$answer_content['AID']."\"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$down_count."</span>&nbspDown</a>";
     echo "</div>";
	 }
	 else
	 {
	 echo "<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$up_count."</span>";
	 echo "<span>&nbsp &nbsp &nbsp</span>";
	 echo "<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$down_count."</span>";
     echo "</div>";
	 }
	 }
	 
	 else
	 //If the length of the answer is suitable
	 {
	 echo "<h4>".$answer_content['Content']."</h4>";
	 echo "<h6>Answer By:<a href=\"profile.php?UID=".$answer_content['UID']."\">".$answer_content['Name']."</a></h6>";
	  echo "<h4></h4>";
	  if(isset($_SESSION['UID']))
	  {
	  echo "<div id=\"answer_info\" style=\"display: none;\">".$answer_content['AID']."</div>";
	 echo "<a href=\"#\" class=\"up_count_btn\" id=\"up_count_".$answer_content['AID']."\"><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$up_count."</span>&nbspUp</a>";
	 echo "<span>&nbsp &nbsp &nbsp</span>";
	 echo "<div id=\"answer_info\" style=\"display: none;\">".$answer_content['AID']."</div>";
	 echo "<a padding-left:10px href=\"#\" class=\"down_count_btn\" id=\"down_count_".$answer_content['AID']."\"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$down_count."</span>&nbspDown</a>";
     echo "</div>";
	 }
	 else
	 {
	 echo "<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$up_count."</span>";
	 echo "<span>&nbsp &nbsp &nbsp</span>";
	 echo "<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$down_count."</span>";
	 echo "</div>";
	 }
	 }
	 }
	 else{
	 echo "</div>";
	 }
	 $i++;
	}
?>

<nav>
<center>
  <ul class="pagination">
    <li><a href="index.php"><span aria-hidden="true">First Page</span></a></li>
    <?PHP  
	$i=1;
	while($i<=$page_num)
	{
	echo "<li "; 
	if($page_tag==$i)
	{
	echo "class=\"active\"";
	}
	echo " ><a href=\"index.php?var=".$i."\">".$i."</a></li>";
	$i++;
	}
	?>
    <li><a href="index.php?var=<?PHP echo $page_num; ?>"><span aria-hidden="true">Last Page</a></li>
  </ul>
  </center>
</nav>
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

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Search Result</title>

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
			<legend>Search Result</legend>	
<?PHP
$search_word=$_POST["search_input"];

if(empty($search_word))
{
    echo "None input";
}
else
{
	include("../include/DB.php");
	$db=new database();
	$db->connect();
	$query_search_title="SELECT user.Name,questions.Title,questions.time,questions.QID
	               From `user`
				   INNER JOIN `questions`
				   ON user.UID=questions.UID
				   where Title Like '%$search_word%'
	";
	$query_search_content="SELECT user.Name,questions.Content,questions.time,questions.QID,questions.Title
	                       From `user`
						   INNER JOIN `questions`
						   ON user.UID=questions.UID
						   where Content LIKE '%$search_word%'
	";					 
	if(!$res_search=$db->send_sql($query_search_title)){
	$db->disconnect();
	echo "Get search result failed!<br>\n";
	return -1;
	}
	$i=0;
	$num_title=mysqli_num_rows($res_search);
	while($i<$num_title)
	{
	   $content=$res_search->fetch_assoc();
	   $str=$content['Title'];
       $rep="<span style=\"background-color: #66CCFF\">".$search_word."</span>";
	   $str=preg_replace('/'.$search_word.'/i',$rep,$str);
	   echo "<div class=\"jumbotron\">\n";
	   echo "<h4><a href=\"edit_answer.php?var=".$content['QID']."\" >".$str."</a></h4>\n";
	   echo "<h6>Poster:".$content['Name']."</h6>\n";
	   echo "<h6>Time:".$content['time']."</h6>\n";
	   echo "</div>";
	   $i++;
	}
	if(!$res_search_content=$db->send_sql($query_search_content)){
	$db->disconnect();
	echo "Get search result failed!<br>\n";
	return -1;
	}
	$i=0;
	$num_content=mysqli_num_rows($res_search_content);
		while($i<$num_content)
	{
	   $content=$res_search_content->fetch_assoc();
	   $str_title=$content['Title'];
	   $str_content=$content['Content'];
       $rep="<span style=\"background-color: #66CCFF\">".$search_word."</span>";
	   $str_title=preg_replace('/'.$search_word.'/i',$rep,$str_title);
	   $str_content=preg_replace('/'.$search_word.'/i',$rep,$str_content);
	   echo "<div class=\"jumbotron\">\n";
	   echo "<h4><a href=\"edit_answer.php?var=".$content['QID']."\" >".$str_title."</a></h4>\n";
	   echo "<h5>".$str_content."</h4>\n";
	   echo "<h6>Poster:".$content['Name']."</h6>\n";
	   echo "<h6>Time:".$content['time']."</h6>\n";
	   echo "</div>";
	   $i++;
	}
	if($num_content==0&&$num_title==0)
	{
	echo "There is no result found!";
	}
	$db->disconnect();
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
	<script src="../js/search.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	
	
	</body>
</html>

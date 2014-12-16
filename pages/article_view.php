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
<title>Article View</title>

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
	<?PHP
	$article_id=$_GET['var'];
	include("../include/DB.php");
	$res_art=GetArticle($article_id);
	echo "<div class=\"jumbotron\">\n";
	echo "<h4>".$res_art[0]['Title']."</h4>";
	echo "<h6>Author:".$res_art[0]['Name']."</h6>\n";
    echo "<h6>Time:".$res_art[0]['Time']."</h6>\n";
	echo "<p>".$res_art[0]['Content']."</p>";
	echo "<h4></h4>";
	echo "<a href=\"#\" class=\"up_count_btn\" id=\"up_count_".$article_id."\"><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$res_art[0]['Up_Vote']."</span>&nbspUp</a>";
	echo "<span>&nbsp &nbsp &nbsp</span>";
	echo "<a padding-left:10px href=\"#\" class=\"down_count_btn\" id=\"down_count_".$article_id."\"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$res_art[0]['Down_Vote']."</span>&nbspDown</a>";
	if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
	if($_SESSION['UID']==$res_art[0]['UID'])
	{
	echo "<h4></h4>";
	echo "<a href=\"edit_article.php?var=".$article_id."\" class=\"btn btn-primary\" >Edit</a>";     
	}
}

	if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
    $user_id=$_SESSION['UID'];
       $group=GetGroup($user_id);
	if((isset($group))&&($group>=5))
	{
	    echo "<br></br>";
		echo "<a padding-left:10px href=\"../include/Delete_Article.php?ArtID=".$article_id."\" class=\"btn btn-primary\" role=\"button\" >Delete</a>";   
	}
}

echo "</div>";
	?>
	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script
		src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	
	
	</body>
</html>
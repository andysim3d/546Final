<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Article</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/article_site.css" rel="stylesheet">

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

	<!-- /container -->
	<div class="container">

		<fieldset>
			<legend>Articles</legend>
<?PHP
include("../include/DB.php");
$db=new database();
$db->connect();
$query_article="SELECT user.Name,article.*,user.UID
                FROM `user`
				INNER JOIN `article`
				ON user.UID=article.UID
";
 	if(!$res_article = $db->send_sql($query_article)){
		$db->disconnect();
		echo "Get Questions failed!<br>\n";
		return -1;
	}
	$i=0;
	$num=mysqli_num_rows($res_article);
	while($i<$num)
	{
	$content=$res_article->fetch_assoc();
	echo "<div class=\"jumbotron\">\n";
	echo "<h4><a href=\"article_view.php?var=".$content['ArtID']."\">".$content['Title']."</a></h4>";
	echo "<h6>Author:".$content['Name']."</h6>\n";
    echo "<h6>Time:".$content['Time']."</h6>\n";
	echo "<h4></h4>";
	echo "<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$content['Up_Vote']."</span>";
	echo "<span>&nbsp &nbsp &nbsp</span>";
	echo "<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$content['Down_Vote']."</span>";
	echo "</div>";
	$i++;
	}
	$db->disconnect();
?>
		</fieldset>

	</div>
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
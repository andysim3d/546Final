<?php 
session_start(); 
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
//print_r($_SESSION);
}
else{
header("Location: http://localhost/546Final/pages/index.php");
}
include("../include/DB.php"); 
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
$Editable = 0;
$user_id=$_SESSION['UID'];
$profile=GetProfile($user_id);
$group=GetGroup($user_id);
$group_info=GetGRPName($group);
//print_r($profile);
echo "<br/>";
if(isset($_GET['UID'])){
	if (IDValidate($_GET['UID']) == 1) {
		if ($_GET['UID'] == $_SESSION['UID']) {
			$Editable = 1;
		}
		$user_id = $_GET['UID'];
		$profile=GetProfile($_GET['UID']);
		$group=GetGroup($_GET['UID']);
		$group_info=GetGRPName($group);
	}
}

echo $Editable;
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

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/profile_site.css" rel="stylesheet">
<link href="../css/index_site.css" rel="stylesheet">

</head>

<?PHP  include '../include/page_title.php';?>

<div class="container" id="dialog_container">
		<div id="dialog" title="LOGIN">
			<form action="../include/AJAXLOGIN.php" method="post" id="login_form" novalidate="novalidate">
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Email:</label> <input id="email" name="email" type="text"></input>
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

		<form role="form" >
			<fieldset>
				<legend>Personal Information</legend>
				<div class="form-group"  >
					<div class="row">
						<div class="col-md-6">
						
							<label for="Photo">Photo:</label> <img src=
							<?php
								if($profile['getProfile']==-1){} 
									else {
										if (isset($profile['Image'])) {
											echo "\"localhost/546final/upload/".$profile['Image']."\"";
										}
										echo "http://umsbc.com/wp-content/uploads/2013/03/img_logo_blue.jpg";
										}
							?>
								class="img-thumbnail" width="200" height="200">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="Name">Name:</label> <input type="text"
								class="form-control" id="Name" name="Name" readonly value="<?PHP 
								if(isset($profile['Name']))
								{
								echo $profile['Name'];
								}
								?>"></input>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="email">Email:</label> <input type="email"
								class="form-control" id="email" name="email" readonly value="<?PHP 
								if(isset($profile['Email']))
								{
								echo $profile['Email'];
								}
								?>"></input>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="group">Group:</label> <input type="text"
								class="form-control" id="group" name="group" readonly value="<?PHP 
							if($profile['getProfile']==-1){}else {echo $group_info;}
								?>"></input>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="location">Location:</label> <input type="text"
								class="form-control" id="locaction" name="location" readonly value="<?PHP  if($profile['getProfile']==-1){}else {echo $profile['Location'];} ?>"></input>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="bod">Date of Birth:</label> <input type="date"
								class="form-control" id="bod" name="bod" readonly value="<?PHP if($profile['getProfile']==-1){} else {echo $profile['BOD'];  } ?>"></input>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="habits">Habits:</label> <input type="text"
								class="form-control" id="habits" name="habits" readonly value="<?PHP if($profile['getProfile']==-1){} else { echo $profile['Habit']; }?>"></input>
						</div>
					</div>
				</div>
				<!--<a class="btn btn-primary" href="profile_edit.php" role="button" type=-->
				<?php
					if ($Editable == 1) {
						echo "<a class=\"btn btn-primary\" href=\"profile_edit.php\" role=\"button\">Edit</a>";
					}
					else{
					}
				?>
			</fieldset>
		</form>

	</div>
	
	<div class="container">

		<fieldset>
			<legend>Questions List</legend>
			<?PHP
			$questions_content=GetQuestionsByUID($user_id,10);
	$i=0;
	$num=count($questions_content);
	while($i<$num)
	{
	echo "<div class=\"jumbotron\">\n";
	 echo "<h4><a href=\"edit_answer.php?var=".$questions_content[$i]['QID']."\" >".$questions_content[$i]['Title']."</a></h4>\n";
	 echo "<h6>Time:".$questions_content[$i]['Time']."</h6>\n";
	 echo "</div>";
	$i++;
	}

			?>
		</fieldset>

	</div>
	
		<div class="container">

		<fieldset>
			<legend>Articles List</legend>
						<?PHP
			$article_content=GetArticlesByUID($user_id);
	$i=0;
	$num=count($article_content);
	while($i<$num)
	{
	echo "<div class=\"jumbotron\">\n";
	 echo "<h4><a href=\"article_view.php?var=".$article_content[$i]['ArtID']."\" >".$article_content[$i]['Title']."</a></h4>\n";
	 echo "<h6>Time:".$article_content[$i]['Time']."</h6>\n";
	  echo "<h4></h4>";
	 echo "<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span><span class=\"count\">&nbsp".$article_content[$i]['Up_Vote']."</span>";
	 echo "<span>&nbsp &nbsp &nbsp</span>";
	 echo "<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></span><span class=\"count\">&nbsp-".$article_content[$i]['Down_Vote']."</span>";
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
	<script
		src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
</body>
</html>
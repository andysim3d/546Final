<?php session_start(); 
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
include("../include/DB.php");
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
<title>Article Editing</title>

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
	   <legend>Article Editing</legend>
	   <form role="form" action="../include/Modify_Artcle.php" method="post" id="edit_article_form" novalidate="novalidate">
	      
		  <div class="form-group" enctype="multipart/form-data">
	         <div class="row">
	             <div class="col-md-8">
				 <input type="hidden" class="form-control" id="ArtID" name="ArtID" value="<?PHP
				 if(isset($_GET['var']))
				 {
	            $article_id=$_GET['var'];
			     echo $article_id;
				 }
				 ?>" ></input>
	             </div>
	           </div>
	        </div>
		  <div class="form-group" enctype="multipart/form-data">
	         <div class="row">
	             <div class="col-md-8">
	             <label for="Title">Title</label>
				 <input type="text" class="form-control" id="Title" name="Title" value="<?PHP
				 if(isset($_GET['var']))
				 {
				 $article_id=$_GET['var'];
				 $res_art=GetArticle($article_id);
			     echo $res_art[0]['Title'];
				 }
				 ?>" ></input>
	             </div>
	           </div>
	        </div>
		<div class="form-group" >
	         <div class="row">
	             <div class="col-md-4">
	             <label for="Content">Content:</label>
				 <textarea  id="Content" name="Content" rows="40" cols="100">
				 <?PHP
				 if(isset($_GET['var']))
				 {
			     $articleq_id=$_GET['var'];
				 $res_art=GetArticle($article_id);
				 echo $res_art[0]['Content'];
				 }
				 ?>
				 </textarea>
	             </div>
	           </div>
	        </div>
			<button type="submit" class="btn btn-primary" name="article_submit" id="article_submit">Submit</button>
	      </div>
	   </form>
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
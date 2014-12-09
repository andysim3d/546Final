<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Profile</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/profile_site.css" rel="stylesheet">

</head>

<?PHP  include '../include/page_title.php';?>

	<div class="container">

		<form role="form" action="profileView.php" method="get">
			<fieldset>
				<legend>Personal Information</legend>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="Photo">Photo:</label> <img src=""
								class="img-thumbnail" width="200" height="200">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="Name">Name:</label> <input type="text"
								class="form-control" id="Name" name="Name" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="email">Email:</label> <input type="email"
								class="form-control" id="email" name="email" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="location">Location:</label> <input type="text"
								class="form-control" id="locaction" name="location" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="bod">Date of Birth:</label> <input type="date"
								class="form-control" id="bod" name="bod" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label for="habits">Habits:</label> <input type="text"
								class="form-control" id="habits" name="habits" readonly>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="edit" id="edit">Edit</button>
			</fieldset>
		</form>

	</div>
	<!-- /container -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>
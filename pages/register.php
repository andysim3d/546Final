<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollment</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/register_site.css" rel="stylesheet">
    <script src="../js/jquery-1.11.1.js"> </script>
    <script src="../js/regist.js"> </script>
  </head>
  <body>
	 <div class="container">
      <form role="form" action="../include/regist.php" method="post">
	    <h1>Enrollment</h1>
	    		<div class="form-group">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
						 <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Input your email"/>
          <span class="glyphicon" id="frn1">::before </span>
						</div>
					</div>
				</div>
	    		<div class="form-group">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
						          <label for="Name">Name:</label>
                                  <input type="text" class="form-control" id="Name" name="Name" placeholder="Input your name"/>
                                  <span class="glyphicon" id="frn2">::before </span>
						</div>
					</div>
				</div>
				   <div class="form-group">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
						       <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Input your password"/>    
					<span class="glyphicon" id="frn3">::before </span>
          	</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
						         <label for="confirm_password">Confirm Password:</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-input your password"/>
					<span class="glyphicon" id="frn4">::before </span>
          
          	</div>
					</div>
				</div>
				<div class="col-md-2 col-md-offset-3">
				       <button type="submit" class="btn btn-default">Submit</button>
				</div>
				<div class="col-md-2 col-md-offset-3">
				       <button type="button" onClick="Goback()" id='back' class="btn btn-default">Back</button>
				</div>
	<!-- button id='back'>back</button> -->
      </form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
      function Goback(){
        window.history.back();
      }
    </script>
  </body>
  <script>
  </script>
</html>


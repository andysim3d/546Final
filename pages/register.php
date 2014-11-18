<?php session_start(); 
  
  //$_SESSION['ID'] = 1;
  foreach ( $_SESSION as $key => $val ){ 
    # code...
    echo "$key => $val";
  }
?>
<!DOCTYPE html>
<?php session_start(); ?>
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
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Input your email">
        </div>
		<div class="form-group">
          <label for="Name">Name:</label>
          <input type="text" class="form-control" id="Name" name="Name" placeholder="Input your name">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Input your password">
        </div>
		<div class="form-group">
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-input your password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
  <script>
  </script>
</html>


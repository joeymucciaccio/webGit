<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<link rel="stylesheet" href="weather.css">
	
    <title>Sign up</title>
  </head>
  
  <body>
	<div class="container-fluid">
		<div class="second">
	
        <h1>Sign Up</h1>
		<form method="post" action="register.php">
		<div>
			<label>Username: <input type="text" name="username" maxlength="8" autofocus></label>
		</div>
		<div>
			<label>Password: <input type="password" name="password_1" minlength="8" maxlength="15"></label>
		</div>
            <div>
			<label>Confirm Password: <input type="password" name="password_2" minlength="8" maxlength="15"></label>
		</div>
		<div>
			<label>Favorite ZIP Code: <input type="number" name="zip" maxlenth="5" required></label>
		</div>
			<button class="btn btn-outline-light" type="submit" name="reg_user">Create Account</button>
		</form>
		
		<br>
		<div class="sub">
			<p>Already a member? <a href="login.php">Log in</a></p>
		</div>
		<br>
		<button onclick="window.location.href = 'index.html';" class="btn btn-outline-light">Main Menu</button>
		
		</div>
		
	</div>
	
  </body>
  
  
</html>
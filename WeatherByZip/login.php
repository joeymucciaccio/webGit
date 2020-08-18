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
	
    <title>Login</title>
  </head>
  
  <body>
      <center>
        <div class="container-fluid">
            <div class="second">

            <h1>Login</h1>
            <form method="post" action="login.php">
                <?php include('errors.php'); ?>
                <div>
                    <label>Username: <input type="text" name="username" maxlength="8" autofocus></label>
                </div>
                <div>
                    <label>Password: <input type="password" name="password" minlength="8" maxlength="15"></label>
                </div>
                <div class="sub">
                    <p>Don't have an account? <a href="register.php">Sign up</a></p>
                </div>
                <div>
                    <button class="btn btn-outline-light" name="login_user" type="submit">Login</button>
                </div>
            </form>

                <br><br>
                <button onclick="window.location.href = 'index.html';" class="btn btn-outline-light">Main Menu</button>

                </div>

        </div>
	</center>  
	
  </body>
  
  
</html>
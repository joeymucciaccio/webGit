<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<?php  if (isset($_SESSION['username'])) : ?>
            <div class='row justify-content-center'>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>! </p>
			<p class="log"> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
            </div>
<?php endif ?>
<!DOCTYPE HTML>
<html lang="EN">
  <!--Start of HEAD-->
  <head>
    <link rel="stylesheet" href="weather.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Weather Forecast</title>

    <link rel="stylesheet" href="css\styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <!--Start of BODY-->
  <body class="pageBackground">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <h1>Weather by ZIP</h1>
      </div>

        <?php
          $apiUrl = "http://api.openweathermap.org/data/2.5/weather";
          $queryString = "&units=imperial&appid=aa4b7729467606a4902609078d576520"; //My personal API key

          $username = "";
          $username = $_SESSION["username"];

          //Query String SELECT favoriteZipCode FROM users WHERE username = "$username"


          $mysqli = new mysqli("localhost", "jmucciaccio2018", "Taztaz12!", "jmucciaccio2018");
          $sql = "SELECT zip FROM users1 WHERE username='" . $mysqli->real_escape_string($username) . "'";
          $result = $mysqli->query($sql);
          if (!$result) {
              die("Error executing query: ($mysqli->errno) $mysqli->error");
          }
          elseif ($result->num_rows == 0) {
              echo "<p>Incorrect username or password.</p>";
          }
          else {
            //Display the zipcode linked to the user's account.
            
            $row = $result->fetch_assoc();
            echo "<div class='row justify-content-center'>";
            echo "<p>The Favorite Zip Code you have saved to your account is: <strong>", $row["zip"], "</strong>. Here is the weather in that city:</p>";
            echo "</div>";
            $loadZip = $row["zip"];
            
            $response = file_get_contents("$apiUrl?zip=$loadZip$queryString");
            
            if ($response === FALSE) {
              die("Error contacting the web API");
            } 
            else {
              // Convert JSON response into PHP object.
              $obj = json_decode($response);

              $cityName = $obj->name;
              echo "<div class='row justify-content-center'>";
              echo "<h3>Weather Information for <b><u>$cityName</u></b></h3>";
              echo "</div>";

              $currentTemp = $obj->main->temp;
              echo "<div class='row justify-content-center'>";
              echo "<p><b>Current Temperature of $cityName: $currentTemp &deg;F</b></p>";
              echo "</div>";

              $description = $obj->weather[0]->description;
              echo "<div class='row justify-content-center'>";
              echo "<p><b>Description of the the Weather: ",ucwords($description),"</b></p>";
              echo "</div>";

              $humidity = $obj->main->humidity;
              echo "<div class='row justify-content-center'>";
              echo "<p><b>Humidity: $humidity%</b></p>";
              echo "</div><br><br><br>";
            }
            

          
          }
          

          if ($_SERVER["REQUEST_METHOD"]== "POST") {

            $enteredZIP = $_POST["inputZIP"];

            if (!is_numeric($enteredZIP)) {
              echo "<div class='row justify-content-center'>";
              die("Incorrect data type entered into the text box, try again with an integer ZIP Code value.");
              echo "</div>";
            }
            
            // Make HTTP request and wait for the response.
            $response = file_get_contents("$apiUrl?zip=$enteredZIP$queryString");
            
            if ($response === FALSE) {
              die("Error contacting the web API");
            } 
            else {
              // Convert JSON response into PHP object.
              $obj = json_decode($response);

              $cityName = $obj->name;
              echo "<div class='row justify-content-center'>";
              echo "<h2>Weather Information for <b><u>$cityName</u></b></h2>";
              echo "</div>";

              $currentTemp = $obj->main->temp;
              echo "<div class='row justify-content-center'>";
              echo "<p><b>Current Temperature of $cityName: $currentTemp &deg;F</b></p>";
              echo "</div>";

              $description = $obj->weather[0]->description;
              echo "<div class='row justify-content-center'>";
              echo "<p><b>Description of the the Weather: ",ucwords($description),"</b></p>";
              echo "</div>";

              $humidity = $obj->main->humidity;
              echo "<div class='row justify-content-center'>";
              echo "<p><b>Humidity: $humidity%</b></p>";
              echo "</div><br><br><br>";
            }
          }
        ?>


      <div class="row justify-content-center">
        <form method="post" action="index.php">
          <label for="enteredValue" class="text1">Enter a Zip Code:</label>
          <input id="enteredValue" type="text" name="inputZIP" autofocus>
          <input id="submitBtn" class="btn btn-outline-light" type="submit" value="Submit ZIP">
        </form>
      </div>
        <center>
        <br><br>
        <button onclick="window.location.href = 'index.html';" class="btn btn-outline-light">Main Menu</button>
        </center> 
    </div>
  </body>
</html>
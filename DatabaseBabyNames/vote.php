<?php
require_once 'php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vote</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">

<style>

.navbar-custom{

background-color:blue;

}

.nav-link{

color: white;

text-align: right;

}

.nav-link:hover{

color:white;

}

.centered {

position: absolute;

top: 20%;

left: 50%;

transform: translate(-50%, 0%);

}
table{
width:400px;
}
table td,th{
text-align:center;
}
.button1{
   color: Black;     
}

</style>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>

// Ajax code is used to call a search.php program file which will bring the data from table based on the key press.

$(function() {
    $("#baby_name").autocomplete({
        source: "search.php",
    });
});
</script>

</head>

<body class="text-center">


<?php
	include('php/db_connect.php');
?>
<div class="container">
<div class="page-header">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <nav class="navbar">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                  </button>
                </div>
                <div class="collapse navbar-collapse" id="navigation">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="loadtable.php">Most Popular</a>&nbsp;</li>
                    <li><a href="vote.php">Vote</a>&nbsp;</li>
                    <li><a href="https://lamp.cse.fau.edu/~jmucciaccio2018">Portal</a>&nbsp;</li>
                  </ul>
                </div>
              </div>
            </nav>
        <h1>Vote For Your Favorite Baby Name</h1>
    </div>

<?php
// Create table with two columns: id and value
$createStmt = 'CREATE TABLE IF NOT EXISTS babyvotes (' . PHP_EOL
. ' `id` int(11) NOT NULL AUTO_INCREMENT,' . PHP_EOL
. ' `name` varchar(50) DEFAULT NULL,' . PHP_EOL
. ' `gender` varchar(10) DEFAULT NULL,'.PHP_EOL
. ' `votes` int default 0,' . PHP_EOL
. ' PRIMARY KEY (`id`)' . PHP_EOL
. ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
?>

<?php
// this block of code will load the data from babyvotes in descending order of votes. 
// 
include('php/db_connect.php');
// Get the rows from the table
$selectStmt = 'SELECT * FROM babyvotes order by votes desc';
?>
<center>
<main class="inner cover">
<div class="container">
<div class="page-header">
<div id="step-three" class="well">
<?php
$result = $db->query($selectStmt);
if($result->num_rows > 0) {
    echo ' <div class="alert alert-success">' . PHP_EOL;
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Gender</th><th>Votes</th></tr>";
while($row = $result->fetch_assoc()) {

echo "<tr>	<td>".$row["id"]."</td>	<td>".$row["name"]."</td>	<td>".$row["gender"]."</td>	<td>".$row["votes"]."</td></tr>".  PHP_EOL;
}
echo "</table>";
echo ' </div>' . PHP_EOL;
} else {
echo ' <div class="alert alert-success">No Results</div>' . PHP_EOL;
}
?>
<!-- Creation of Form for Baby Name and Gender data collection -->
	<p><strong>Fill out the information below</strong></p>
	<form name='' method='POST' action='#'>
	<div class="auto-widget">
    
		<p>Gender : <input required type='radio' name='gender' value='M'>Boy 
		
		<input required type='radio' name='gender' value='F'>Girl</p>
		
		<p>Baby Name: <input required type="text" id="baby_name" name='babyname'/></p>

		
		<input type='submit' class="button1" name='submit' value='Vote' />
</div>		
	
	</form>
	<br><br>
<?php
// On click of submit button. isset function will perform the code execution.

	if(isset($_POST['submit']))
	{
		
		// declration of two variables to capture gender and babyname
		$gender = $_POST['gender'];
		$babyname = $_POST['babyname'];
		
		
	

include('php/db_connect.php');

// check for the baby name in table and get the vote value. and get the total votes.
//if no votes found then start with 1

$votes = getVotes($babyname, $gender);

// check if no votes then insert function is executed if already babyname exists then add 1 vote and update the table.

if($votes != 0)
{
	if($babyname != ''){
		$insertStmt = "UPDATE babyvotes set votes = $votes  where name='$babyname' and gender='$gender'";	
	}
}else{
	if($babyname != ''){
		$votes = 1;
		$insertStmt = "INSERT INTO babyvotes (name, gender, votes) VALUES ('$babyname','$gender',$votes)";
	}
}
?>
<?php
if($db->query($insertStmt)) {
    PHP_EOL;
} else {
echo ' <div class="alert alert-danger">Value insertion failed: (' . $db->errno . ') ' . $db->error . '</div>' . PHP_EOL;
$db->close();
exit();
}

} // isset ends here.


//function to check for babyname and return with adding 1 vote to existing number of votes.
function getVotes($babyname, $gender){
	include('php/db_connect.php');
	 $strSQL="select votes from babyvotes where name='$babyname' and gender='$gender'";
	$val=0;
	$result = $db->query($strSQL);
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$val = $row['votes'];
		$val = $val + 1;
	}else{
		$val = 0;
	}
	$db->close();
	
	return $val;
}
?>



</div>

</div>

</div>
</main>
</center>
</div>
</div>
</body>
</html>


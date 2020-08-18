<?php
require_once 'php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Most Popular Baby Names</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
</head>
<body>
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
        <h1>Most Popular Baby Names in 2018</h1>
</div>

<?php

// Create table with two columns: 
$createStmt = 'CREATE TABLE IF NOT EXISTS babynames (' . PHP_EOL
. ' `id` int(11) NOT NULL AUTO_INCREMENT,' . PHP_EOL
. ' `name` varchar(50) DEFAULT NULL,' . PHP_EOL
. ' `gender` varchar(10) DEFAULT NULL,'.PHP_EOL
. ' `votes` int default 0,' . PHP_EOL
. ' PRIMARY KEY (`id`)' . PHP_EOL
. ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
?>

<?php
if($db->query($createStmt)) {
    PHP_EOL;
} else {
echo ' . $db->errno . ' . $db->error . '</div>' . PHP_EOL;
exit();
}
?>


<div id="step-two" class="well">

<?php 
$file = fopen("yob2018short.txt","r");
$selectStatement = "SELECT * from babynames";
if ($result = $db->query($selectStatement)) {

$row_cnt = $result->num_rows;

$result->close();

}

if ($row_cnt==0) {

while(!feof($file))

{

$line=fgets($file);

$var = explode(",", $line);

$name=(string)$var[0];
$gender = (string)$var[1];
$votes = (int)$var[2];

echo "<br>";

$sql = "INSERT INTO babynames(name, gender, votes) VALUES ('$name','$gender',$votes)";

if ($db->query($sql) === TRUE) {

} else {

echo "Error: " . $sql . "<br>" . $db->error;

}
}
fclose($file);

}

$db->close();


$sqln = "select * from babynames order by votes desc limit 10";
?>

<center>
<?php
include('php/db_connect.php');


$result = $db->query($sqln);

if ($result->num_rows > 0) {

$i = 1;
echo ' <div class="alert alert-success">';
echo "<table width='400px' border='1'>";
echo "<tr><th> Number</th><th> Name</th><th> Gender</th><th> Votes</th> </tr>";
while($row = $result->fetch_assoc()) {

	$name=$row['name'];
	
	$votes=$row['votes'];
	$gender=$row['gender'];
	
	echo '<tr><td>' .$i.'</td>
	
	<td><label for="name"> ' .$name.'</label>
	</td><td><label for="voteno.">' .$gender.'</label>
	</td><td><label for="voteno.">' .$votes.'</label>
	</td>
	
	</tr>';
	
	$i = $i + 1;
	

}
echo "</table>";

}



?>
</center>
</div>


</div>
</div>
</body>
</html>

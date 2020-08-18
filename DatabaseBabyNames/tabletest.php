<?php
require_once './php/db_connect.php';
//this line will basically set the execution time of the
//page to 10 mins(600 seconds)
//the default time is 30 seconds but
//as we are inserting more than 10000 rows in the table
//so it will take more than that
ini_set('max_execution_time', 600);
//connect to the database
$con = mysqli_connect('localhost', 'jmucciaccio2018', 'Taztaz12!', 'jmucciaccio2018');
//select the database
mysqli_select_db($con,'jmucciaccio2018');
//create query for making a table
$q ="create table BABYNAMES(
Name varchar(15),
Sex varchar(1),
Occurence int);
";
//execute the query
mysqli_query($con,$q);

//open the file
$myfile = fopen("yob2018short.txt","r");

//while its not the end of the file
while(!feof($myfile)) {
//get the first line from the file and split the string
//into elements of an array where first element is the name
//2nd is sex and 3rd is number
$ar = explode(',',fgets($myfile));
//convert the third element which is a string to int
//because datatype for that column in our table is not
//string, it is int
$fre = (int)$ar[2];
//create a query for inserting the data into created table
$query = "insert into BABYNAMES values('$ar[0]','$ar[1]','$fre')";
//execute the query
mysqli_query($con,$query);
//displaying the occurence number, not necessary, modify as u need it
echo $fre;
echo '<br>';
}
fclose($myfile);

?>
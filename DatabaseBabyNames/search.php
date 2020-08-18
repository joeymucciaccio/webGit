<?php

include('php/db_connect.php');

// Get search entered key term
$searchName = $_GET['term'];

// Get matched data from babyvotes table
$query = $db->query("SELECT * FROM babyvotes WHERE name LIKE '%".$searchName."%' ORDER BY votes desc");

// Generate babyvotes data array
$babyName = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['value'] = $row['name'];
        array_push($babyName, $data);
    }
}

// Return results as json encoded array
echo json_encode($babyName);

?>
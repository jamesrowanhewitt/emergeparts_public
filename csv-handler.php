<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

 $DB_Server = "localhost";           //MySQL Server    
 $DB_Username = "root";              //MySQL Username  
 $DB_Password = "";                  //MySQL Password     
 $DB_DBName = "nodexlin_db_main";    //MySQL Database Name  

/* Attempt MySQL server connection. */  
$connection = mysqli_connect($DB_Server, $DB_Username, $DB_Password, $DB_DBName);


// Check connection
if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "SELECT * FROM parts";
$result = mysqli_query($connection, $query);


$number_of_fields = mysqli_num_fields($result);
$headers = array();
for ($i = 0; $i < $number_of_fields; $i++) {
    $headers[] = mysqli_field_name($result , $i);
}
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="EmergeParts.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

?>

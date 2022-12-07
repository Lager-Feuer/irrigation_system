<?php
include '/var/www/private/priv.php';
header('Content-Type: application/json');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

$query = sprintf("SELECT * FROM graph_data");
$result = $mysqli->query($query);

$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

$result->close();
$mysqli->close();

print_r( json_encode($data));

// $urlQuery = $_SERVER['REQUEST_URI']; // $_SERVER['REQUEST_URI'] = /sites/dbselect.php?
// $query_string = parse_url($urlQuery, PHP_URL_QUERY);
// switch ($query_string) {
//   case "timestamps":
//     break;
//   }
?>
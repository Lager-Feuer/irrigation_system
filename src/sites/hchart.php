<?php
header('Content-Type: application/json');

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'tech_humidity');
define('DB_PASSWORD', fread(fopen("/irrigation_system/keys/priv.key", "r") or die("Unable to connect to database. Missing Password."),filesize("/irrigation_system/keys/priv.key")));
define('DB_NAME', 'irrigation_system');
//$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
//echo fread(fopen("/irrigation_system/keys/priv.key", "r") or die("Unable to connect to database. Missing Password."),filesize("/irrigation_system/keys/priv.key"));
//fclose($myfile);

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
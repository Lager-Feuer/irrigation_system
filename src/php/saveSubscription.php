<?php
require '/var/www/private/priv.php';
require "../vendor/autoload.php";
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

$sub_data = json_decode($_POST["sub"], true);
$sub = Subscription::create($sub_data);

$endpoint = $sub_data['endpoint'];
$expirationTime = $sub_data['expirationTime'];
$p256dh = $sub_data['keys']['p256dh'];
$auth = $sub_data['keys']['auth'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}


//$query = sprintf("SELECT * FROM PNSubscriptions WHERE endpoint = '$endpoint';");
$query = sprintf("SELECT * FROM PNSubscriptions WHERE endpoint = ?");
$stmt = $mysqli->prepare("SELECT * FROM PNSubscriptions WHERE endpoint = ?");
$stmt->bind_param("s", $endpoint);

$stmt->execute();

$result = $stmt->get_result();
//$result = $mysqli->query($query);
if(mysqli_num_rows($result) != 0) die("Das Gerät hat Push-Benachrichtigungen bereits aktiviert.");
mysqli_stmt_close($stmt);

$query = sprintf("INSERT INTO PNSubscriptions(endpoint, expirationTime, p256dh, auth) VALUES ('$endpoint', '$expirationTime', '$p256dh', '$auth');");
$result = $mysqli->query($query);
$mysqli->close();

if($result != 1) die("Fehler beim Speichern des Abonnements für Push-Benachrichtigungen");

/*

// Set VAPID-Keys and email in push-object
$push = new WebPush(["VAPID" => [
  "subject" => "Ahlers@boehme-weihs.de",
  "publicKey" => "BNzNIThB0mHAgR-NzDKBfekQ4XD_WBauTUOwUfFZzKHAg5_HkMod1afp2M7sO-63rju-78zPJqmQSZuNvhYr9Qc",
  "privateKey" => "O-cuS6m7wLhZ3w1Z6If7BirxQNV9qi8M5rqYbeec3UA"
]]);

// Send notification to clients
$result = $push->sendOneNotification($sub, json_encode([
  "title" => "Welcome!",
  "body" => "Yes, it works!",
  "icon" => "i-loud.png",
  "image" => "i-zap.png"
]));
$endpoint = $result->getRequest()->getUri()->__toString();

// Output, if notification could be sent
if ($result->isSuccess()) {
   echo "Successfully sent {$endpoint}.";
} else {
   echo "Send failed {$endpoint}: {$result->getReason()}";
  // $result->getRequest();
  // $result->getResponse();
  // $result->isSubscriptionExpired();
}
*/
?>

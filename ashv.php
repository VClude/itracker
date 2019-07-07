<?php
date_default_timezone_set('Asia/Pontianak');
$string = file_get_contents("https://srv.nakulaproject.com/fetchxml.php");
$xml = new SimpleXMLElement($string);
$i=1;
$iyes=1;
$servername = "localhost";
$username = "admindb";
$password = "123qwe!@#QWE";
$dbname = "tracking_system_gps";
$storeArray = array();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM devices order by devices.device_name ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
echo '<li class="nav-item"><a class="nav-link" href="#">' . $row["device_name"] . '</a></li>';
}
}
 else {

}
$conn->close();

?>

<?php
// $string = file_get_contents('message.xml');
// $xml = new SimpleXMLElement($string);
// $awe = "";
// $storeArray = array();


// foreach($xml->feedMessageResponse->messages->message as $item){
//     echo "<tr>";
//     echo "<td>" . $item->id . "</td>";
//     echo "<td>" . $item->messengerId . "</td>";
//     echo "<td>" . $item->messengerName . "</td>";
//     echo "<td>" . $item->messageType . "</td>";
//     echo "<td>" . $item->latitude . "</td>";
//     echo "<td>" . $item->longitude . "</td>";
//     echo "<td>" . $item->dateTime . "</td>";
//     echo "<td>" . $item->batteryState . "</td>";
//     echo "<td>" . $item->altitude . "</td>";
//     echo "</tr>";
 
//       }

 ?>




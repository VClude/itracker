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
?>
             <?php 
foreach($xml->row as $item){
if ($item->messengerName == $row["device_name"]){


$asd = time();
$dsa = $item->unixTime;
$end = $asd - $dsa;
$conv = $end - 2960;
$epoch = $item->unixTime;
$dt = new DateTime("@$epoch"); 
$TimeStr =  $dt->format('Y-m-d H:i:s');
$TimeZoneNameFrom="UTC";
$TimeZoneNameTo="Asia/Pontianak";
$rel = relativeTime(($asd-$conv));
$ts = $asd-$conv;
$intrel = (int)$rel;

 if ($conv < 86400 && $item->messageType == "EXTREME-TRACK"){
 echo '<li id="'. $item->ID .'">
 <a href="#"><span class="mr-5">'.  $item->messengerName . '</span> <i
         class="fas fa-circle green-text';

 }
 elseif ($conv < 86400 && $item->messageType == "SOS"){

    echo '<li id="'. $item->ID .'">
    <a href="#"><span class="mr-5">'. $item->messengerName .'</span> <i
            class="fas fa-circle yellow-text';
 }
 elseif ($conv > 86400){

    echo '<li id="'. $item->ID .'">
    <a href="#"><span class="mr-5">'. $item->messengerName .'</span> <i
            class="fas fa-circle red-text';
 }

 elseif($conv > 259200){
    echo '<li id="'. $item->ID .'">
    <a href="#"><span class="mr-5">'. $item->messengerName .'</span> <i
            class="fas fa-square black-text';
 }
 else{

 }


break;    
}
else{
  continue;
}
    }

?> float-right mr-2 pt-1"></i></a>
            </li>
<?php
}
}
 else {

}
$conn->close();

?>

<?php


 ?>




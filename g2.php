<?php
date_default_timezone_set('Asia/Pontianak');
$string = file_get_contents("http://121869210359.ip-dynamic.com/itracker/fetchxml.php");
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
if ($item->device_name == $row["device_name"]){


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
echo '<tr id='. $item->ID .'>
<th scope="row">'. $item->device_name .'</th>
<td><i class="fas fa-circle green-text"></i> </td>
</tr>';
 }
 elseif ($conv < 86400 && $item->messageType == "SOS"){
    echo '<tr id='. $item->ID .'>
    <th scope="row">'. $item->device_name .'</th>
    <td><i class="fas fa-circle yellow-text"></i> </td>
    </tr>';
}
 elseif ($conv > 86400 && $conv < 259200){

    echo '<tr id='. $item->ID .'>
    <th scope="row">'. $item->device_name .'</th>
    <td><i class="fas fa-circle red-text"></i> </td>
    </tr>';
 }

 elseif($conv > 259200){
    echo '<tr id='. $item->ID .'>
    <th scope="row">'. $item->device_name .'</th>
    <td><i class="fas fa-square black-text"></i> </td>
    </tr>';
 }
 else{
    echo '<tr id='. $item->ID .'>
    <th scope="row">'. $item->device_name .'</th>
    <td><i class="fas fa-square black-text"></i> </td>
    </tr>';
 }


break;    
}
else{
  continue;
}
    }

?> 
<?php
}
}
 else {

}
$conn->close();

?>

<?php


 ?>




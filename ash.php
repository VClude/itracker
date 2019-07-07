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

$sql = "SELECT * FROM devices";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
if($iyes==1){     
 ?>
<div class="carousel-item active">      
<?php
}
else{
?>
<div class="carousel-item">      
<?php
}
?>
<div class="card weather-card" style="background-color:#9aced7 !important;">

<!-- Card content -->
<div class="card-body pb-3">

<!-- Title -->
<h4 class="card-title font-weight-bold"><?php echo $row["device_name"] ?> (ID : <?php echo $row["device_id"] ?>)</h4>
<!-- Text -->
<p class="card-text"><?php 
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

echo $rel; ?></p>
<?php

echo date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
	->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");
 ?></p>
 <?php
 if ($conv > 199999){

?>
<div class="d-flex justify-content-between">
  <p class="display-1"><i class="fa fa-times-circle"></i>Lost Signal</p>

</div>
<div class="d-flex justify-content-between mb-4">
  </div>
<div class="d-flex justify-content-between">
  
<p><i class="fa fa-envelope fa-lg text-info pr-2"></i>
Lost Signal</p>
<?php
 } //if intrel
 else{

?>
<div class="d-flex justify-content-between">
  <p class="display-1"><i class="fa fa-<?php 
  if ((string)$item->battery == "GOOD"){
    echo "battery-full";
  }
  else{
    echo "battery-quarter";
    } ?> pr-2"></i><?php echo $item->battery; ?></p>

</div>
<div class="d-flex justify-content-between mb-4">
  <p><i class="fa fa-tint fa-lg text-info pr-2"></i><?php echo $item->latitude;?> Latitude</p>
  <p><i class="fa fa-leaf fa-lg grey-text pr-2"></i><?php echo $item->longitude;?> Longitude</p>
</div>
<div class="d-flex justify-content-between">
  
<p><i class="fa fa-envelope fa-lg text-info pr-2"></i><?php
 if((string)$item->messageType == "OK"){
ECHO "SOS";
}
else{
echo $item->messageType;
}
?></p>
<?php
 } //else intrel
 ?>

</div>
<div class="progress md-progress">
  <div class="progress-bar black" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="100" style="width: 100%"></div>
</div>




<?php
$i++;
break;    
}
else{
  continue;
}
    }
$iyes++;
?>
</div>
</div>
</div>
<?php
}
} else {

}
$conn->close();

?>
<?php 

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




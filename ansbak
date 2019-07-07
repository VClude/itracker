<?php
$string = file_get_contents('message.xml');
$xml = new SimpleXMLElement($string);
$awe = "";
$storeArray = array();
$inc = 1;

foreach($xml->feedMessageResponse->messages->message as $item){
$asd = time();
$dsa = $item->unixTime;
$end = $asd - $dsa;
 $epoch = $item->unixTime;
$dt = new DateTime("@$epoch");
$TimeStr =  $dt->format('Y-m-d H:i:s');
$TimeZoneNameFrom="UTC";
$TimeZoneNameTo="Asia/Pontianak";
  
  echo "<tr>";
?>
<td><a href="#PRODUCT_DETAILS" class="item_add prod_detail" data-toggle="modal" data-target="#PRODUCT_DETAILS" data-id="<?php echo $item->id; ?>">check in map</a></td>
<?php
    echo "<td>" . $item->id . "</td>";
    echo "<td>" . $item->messengerId . "</td>";
    echo "<td>" . $item->messengerName . "</td>";
if((string)$item->messageType == "OK"){
 echo "<td>SOS</td>";

}
else{
 echo "<td>" . $item->messageType . "</td>";

}   
    echo "<td id='lat" . $inc .  "'>" . $item->latitude . "</td>";
    echo "<td id='long" . $inc . "'>" . $item->longitude . "</td>";
    echo "<td>" . date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
        ->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s")
 . "</td>";
    echo "<td>" . $item->batteryState . "</td>";
    echo "<td>" . $item->altitude . "</td>";
    echo "</tr>";
$inc++;
      }
 ?>

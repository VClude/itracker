<?php
$servername = "localhost";
$username = "admindb";
$password = "123qwe!@#QWE";
$dbname = "tracking_system_gps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT devices.device_name,message.* FROM `message`
LEFT JOIN devices ON message.messengerId = devices.device_id
GROUP BY message.datetime,message.messengerId
ORDER BY `message`.`datetime`  DESC";
$result = $conn->query($sql);
$xmlDom = new DOMDocument();
$xmlDom->appendChild($xmlDom->createElement('results'));
$xmlRoot = $xmlDom->documentElement;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = mysqli_fetch_row($result)) {
 $xmlRowElementNode = $xmlDom->createElement('row');

      $i=0;
      for($i=0;$i<mysqli_num_fields($result);$i++)
      {
          $xmlRowElement = $xmlDom->createElement(mysqli_fetch_field_direct($result, $i)->name);
          $xmlText = $xmlDom->createTextNode($row[$i]);
            $xmlRowElement->appendChild($xmlText);

            $xmlRowElementNode->appendChild($xmlRowElement);
      }

      $xmlRoot->appendChild($xmlRowElementNode);
    }
header('Content-type:  text/xml');
    echo $xmlDom->saveXML();
}

 else {
    echo "0 results";
}
$conn->close();
?> 

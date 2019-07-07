
<?php

$string = file_get_contents('data.xml');
$xml = new SimpleXMLElement($string);
$awe = "";
$servername = "localhost";
$username = "admindb";
$password = "123qwe!@#QWE";
$dbname = "tracking_system_gps";
$asd = time();


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    file_put_contents('feed.log', 'cant connect database \r');
}


foreach($xml->stuMessages->stuMessage as $item){
    echo $item;
    try{
$dsa = $item->unixTime;
$end = $asd - $dsa;
$epoch = $item->unixTime;
$dt = new DateTime("@$epoch");
$TimeStr =  $dt->format('Y-m-d H:i:s');
$TimeZoneNameFrom="UTC";
$TimeZoneNameTo="Asia/Pontianak";
$msgdete = '0xC02B5387BFF129090C';
$msgdet = substr($msgdete,2);
$binStringe = hexsec2decsec($msgdet);
$binString = decsec2binsec($binStringe);
$msgtypec = substr($binString, 6,2);

$msgdet = substr($item->payload, 2,2);
$binStringe = hexsec2decsec($msgdet);
$binString = decsec2binsec($binStringe);
$msgtypec = substr($binString, 6,2);
if($msgtypec == "00"){
$msgtype = "Standard Message";
standard($msgdet);
}
elseif($msgtypec == "01"){
$msgtype = "Truncated Message";
}
elseif($msgtypec == "10"){
    $msgtype = "Raw Message";
    }
    elseif($msgtypec == "11"){
        $msgtype = "Non-Standard Message";
        }
        else{
            $msgtype = "unknown";
        }
$ohyes =  date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
        ->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");
// $sql = "INSERT INTO`message`(`ID`, `messengerId`, `messengerName`, `unixTime`, `messageType`, `latitude`, `longitude`, `modelId`, `datetime`, `battery`, `altitude`)
// VALUES ('$item->id', '$item->messengerId', '$item->messengerName', '$item->unixTime', '$val', '$item->latitude', '$item->longitude', '$item->modelId', '$ohyes', '$item->batteryState', '$item->altitude')";
//     echo "canot updet <br/>";
//     echo $item->messengerId;
//     echo $item->messengerName;
//     echo $sql;
//     echo "<br/>";
// if ($conn->query($sql) === TRUE) {
//     file_put_contents('feed.log', 'added to db  \r');
// } else {
//     file_put_contents('feed.log', 'duplicate value are not added to db \r');
// }
    }
    catch(Exception $asd){

    }

}
// $awe = (string)$item->messengerId;

// }

// $conn->close();
 ?>

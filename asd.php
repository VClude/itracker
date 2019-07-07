<?php
$string = file_get_contents('message.xml');
$xml = new SimpleXMLElement($string);
$awe = "";
$servername = "localhost";
$username = "admindb";
$password = "123qwe!@#QWE";
$dbname = "tracking_system_gps";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    file_put_contents('feed.log', 'cant connect database \r');
}


foreach($xml->feedMessageResponse->messages->message as $item){
// if ($awe == (string)$item->messengerId){

// }
//  else {

$sqlw = "SELECT device_id,device_name FROM devices where device_name = '$item->messengerName' or device_id='$item->messengerName'";
$result = $conn->query($sqlw);   
if ($result->num_rows > 0) {
    try{
    $sql = "UPDATE `devices` SET `device_name`='$item->messengerName' WHERE `device_id`='$item->messengerId'";

if ($conn->query($sql) === TRUE) {
 echo "success";
} else {
    echo "canot updet1 : ";
    echo $sql;
    echo "<br/>";
}


}
catch(Exception $e){

}
}
else{
    try{

$sql = "INSERT INTO devices (device_id, device_name)
VALUES ('$item->messengerId', '$item->messengerName')";
    echo "canot updet <br/>";
    echo $item->messengerId;
    echo $item->messengerName;
    echo $sql;
    echo "<br/>";
if ($conn->query($sql) === TRUE) {
    file_put_contents('feed.log', 'added to db  \r');
} else {
    file_put_contents('feed.log', 'duplicate value are not added to db \r');
}
    }
    catch(Exception $asd){

    }

}
// $awe = (string)$item->messengerId;

// }
}
$conn->close();
 ?>
 <?php
date_default_timezone_set('Asia/Pontianak');
$servername = "localhost";
$username = "admindb";
$password = "123qwe!@#QWE";
$dbname = "tracking_system_gps";
if (isset($_POST['productID'])) {
// Create connection
$productID = $_POST['productID'];
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT devices.device_name as messengerName, message.* FROM message LEFT JOIN devices ON message.messengerId = devices.device_id WHERE message.ID='$productID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $asd = time();
        $dsa = (int)$row['unixTime']; 
        $end = $asd - $dsa;
        $conv = $end - 2960;
        $rel = relativeTime(($asd-$conv));
    $data['did'] = $row['ID']; 
	$data['device_id'] = $row['messengerId']; 
	$data['name'] = $row['messengerName']; 
	$data['message'] = $row['messageType']; 
	$data['date'] = $row['datetime']; 
	$data['battery'] = $row['battery']; 
	$data['lat'] = $row['latitude'];
    $data['lng'] = $row['longitude'];
    $data['last_timestamp'] = $rel;
    }
echo json_encode($data);
} else {
    echo "Hello !!";
}
$conn->close();
}
else{
echo "Hello !!";
}

function relativeTime($time) {

    $d[0] = array(1," detik");
    $d[1] = array(60," menit");
    $d[2] = array(3600," jam");
    $d[3] = array(86400," hari");
    $d[4] = array(604800," minggu");
    $d[5] = array(2592000," bulan");
    $d[6] = array(31104000," tahun");

    $w = array();

    $return = "";
    $now = time();
    $diff = ($now-$time);
    $secondsLeft = $diff;

    for($i=6;$i>-1;$i--)
    {
         $w[$i] = intval($secondsLeft/$d[$i][0]);
         $secondsLeft -= ($w[$i]*$d[$i][0]);
         if($w[$i]!=0)
         {
            $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'':'') ." ";
         }

    }

    $return .= ($diff>0)?" yang lalu":" tersisa";
    return $return;
}
?> 

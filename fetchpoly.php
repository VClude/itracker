 <?php
date_default_timezone_set('Asia/Pontianak');
$servername = "localhost";
$username = "admindb";
$password = "123qwe!@#QWE";
$arr = array();
$dbname = "tracking_system_gps";
if (isset($_POST['productID'])) {
// Create connection
$productID = $_POST['productID'];
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT latitude as lat,longitude as lng FROM `message` where messengerName=(SELECT messengerName FROM message WHERE ID ='$productID') ORDER BY datetime DESC LIMIT 5 ";
$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $arr[$i] = $row;
    $i++;
    }
echo json_encode($arr);
} else {
    echo "Hello !!";
}
$conn->close();
}
else{
echo "Hello !!";
}

?> 

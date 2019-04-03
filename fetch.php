 <?php
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

$sql = "SELECT * FROM message WHERE ID='$productID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$data['deviceid'] = $row['messengerId']; 
	$data['name'] = $row['messengerName']; 
	$data['message'] = $row['messageType']; 
	$data['timestamp'] = $row['datetime']; 
	$data['battery'] = $row['battery']; 
	$data['x'] = $row['latitude'];
        $data['y'] = $row['longitude'];

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
?> 

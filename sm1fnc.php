<?php 
 $servername = "localhost";
 $username = "admindb";
 $password = "123qwe!@#QWE";
 $dbname = "tracking_system_gps";
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
     echo('error');
 }
    function txt2dec($txt)
    {
        return ord($txt);
    }
   
    
    function txt2hex($txt)
    {
        return bin2hex($txt);
    }
   
    
    function txt2bin($txt)
    {
        $mybyte = decbin(ord($txt[0]));
        $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
        return $MyBitSec;
    }
   
   
    
    function dec2txt($dec)
    {
        return chr($dec);
    }
   
    
    function dec2hex($dec)
    {
        $THex = dechex($dec);
        $THex = substr("00",0,2 - strlen($THex)) . $THex;
        return $THex;
    }
   
    
    function dec2bin($dec)
    {
        $mybyte = decbin($dec);
        $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
        return $MyBitSec;
    }
   
   
    
    function hex2txt($hex)
    {
        $hex = substr("00",0,2 - strlen($hex)) . $hex;
        return chr(hexdec($hex));
    }
   
    
    function hex2dec($hex)
    {
        $hex = substr("00",0,2 - strlen($hex)) . $hex;
        return hexdec($hex);
    }
   
    
    function hex2bine($hex)
    {
        $hex = substr("00",0,2 - strlen($hex)) . $hex;
        $mybyte = decbin(hexdec($hex));
        $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
        return $MyBitSec;
    }
   
   
    
    function bin2txt($bin)
    {
        $bin = substr("00000000",0,8 - strlen($bin)) . $bin;
        return chr(bindec($bin));
    }
   
    
    function bin2dec($bin)
    {
        $bin = substr("00000000",0,8 - strlen($bin)) . $bin;
        return bindec($bin);
    }
   
    
    function bin2hex2($bin)
    {
        $bin = substr("00000000",0,8 - strlen($bin)) . $bin;
        $hex = dechex(bindec($bin));
        $hex = substr("00",0,2 - strlen($hex)) . $hex;
        return $hex;
    }
   
   
   
    
    function txtsec2decsec($txtsec)
    {
        $Data = '';
        for($i=0;$i<strlen($txtsec);$i++)
        {
            $Data .= ord($txtsec[$i]);
            if($i != strlen($txtsec)-1)
                $Data .= " ";
        }
        return $Data;
    }    
   
    
    function txtsec2hexsec($txtsec)
    {
        $Data = '';
        for($i=0;$i<strlen($txtsec);$i++)
        {
            $Data .= bin2hex($txtsec[$i]);
            
            
        }
        return $Data;
    }
   
    
    function txtsec2binsec($txtsec)
    {
        $Data = '';
        for($i=0;$i<strlen($txtsec);$i++)
        {
            $mybyte = decbin(ord($txtsec[$i]));
            $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
            $Data .= $MyBitSec;
            
            
        }
        return $Data;
    }
   
   
    
    function decsec2txtsec($decsec)
    {
        $Data = '';
        $DSplit = explode(" ", $decsec);
        for($i=0;$i<sizeof($DSplit);$i++)
        {
            $Data .= chr($DSplit[$i]);
            
            
        }
        return $Data;
    }
   
    
    function decsec2hexsec($decsec)
    {
        $Data = '';
        $DSplit = explode(" ", $decsec);
        for($i=0;$i<sizeof($DSplit);$i++)
        {
            $THex = dechex($DSplit[$i]);
            $THex = substr("00",0,2 - strlen($THex)) . $THex;
            $Data .= $THex;
            
            
        }
        return $Data;
    }
   
    
    function decsec2binsec($decsec)
    {
        $Data = '';
        $DSplit = explode(" ", $decsec);
        for($i=0;$i<sizeof($DSplit);$i++)
        {
            $mybyte = decbin($DSplit[$i]);
            $THex = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
            $Data .= $THex;
            
            
        }
        return $Data;
    }
   
   
    
    function hexsec2txtsec($hexsec)
    {
        $Data = '';
        for($i=0;$i<strlen($hexsec);$i+=2)
        {
            $Data .= chr(hexdec($hexsec[$i].$hexsec[$i+1]));
            
            
        }
        return $Data;
    }
   
    
    function hexsec2decsec($hexsec)
    {
        $Data = '';
        for($i=0;$i<strlen($hexsec);$i+=2)
        {
            $Data .= hexdec($hexsec[$i].$hexsec[$i+1]);
            if($i != strlen($hexsec)-2)
                $Data .= " ";
        }
        return $Data;
    }
   
    
    function hexsec2binsec($hexsec)
    {        
        $Data = '';
        for($i=0;$i<strlen($hexsec);$i+=2)
        {
            $mybyte = decbin(hexdec($hexsec[$i].$hexsec[$i+1]));
            $MyBitSec = substr("00000000",0,8 - strlen($mybyte)) . $mybyte;
            $Data .= $MyBitSec;
            
            
        }
        return $Data;
    }
   
    function standard($binsece) : void {
        $b1 = hexsec2decsec($binsece);
        $binsec = decsec2binsec($b1);
        $battery = substr($binsec,5,1);
        $gpsvalid = substr($binsec,4,1);
        $ein1 = substr($binsec,3,1);
        $ein2 = substr($binsec,2,1);
        $gpsc = substr($binsec,0,2);
        $laet = substr($binsece,2,6);
        $lonet = substr($binsece,8,6);
        $seclastbit = substr($binsec,56,8);
        $servername = "localhost";
        $username = "admindb";
        $password = "123qwe!@#QWE";
        $dbname = "tracking_system_gps";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo('error');
        }
        if ($battery == "0"){
            $a1 = 'GOOD';
        }
        else{
            $a1 = 'BAD';
        }
        
        if ($gpsvalid == "0"){
            $a2 = 'Valid';
        }
        else{
            $a2 = 'Non-Valid';
        }
        
        if ($ein1 == "0"){
            $a3 = "No Missed event on input 1";
        }
        else{
            $a3 = "Missed event on input 1";
        }
        
        if ($ein2 == "0"){
            $a4 = "No Missed event on input 2";
        }
        else{
            $a4 = "Missed event on input 2";
        }
        
        if($gpsc == "00"){
            $a5 = 0;
            }
            elseif($gpsc == "01"){
                $a5 = 1;
            }
            elseif($gpsc == "10"){
                $a5 = 2;
            }
                elseif($gpsc == "11"){
                    $a5 = 3;
                }
                    else{
                        $a5 = 0;
                    }


        $lat = hex2dec($laet);

        
        $divider = bcdiv(90,8388608,10);
        $latg = (float) $lat * ($divider);
        if ($latg > 90){
            $latg = $latg - 180;
        }
        else{
            $latg = $latg;
        } 
        $a6 = $latg;



        $lon = hex2dec($lonet);

        
        $divider = bcdiv(180,8388608,10);
        $long = (float) $lon * ($divider);
        if ($long > 180){
            $long = $long - 360;
        }
        else{
            $long = $long;
        } 
        $a7 = $long;

        if (substr($seclastbit,7,1) == "1"){
            $a8 = "Input 1 change trigger message";
        }
        else{
            $a8 = "Input 1 change didnt trigger message";
        }   
        if (substr($seclastbit,6,1) == "1"){
            $a9 = "Input 1 state open";
        }
        else{
            $a9 = "Input 1 state closed";
        }   
        if (substr($seclastbit,5,1) == "1"){
            $a10 = "Input 1 change trigger message";
        }
        else{
            $a10 = "Input 1 change didnt trigger message";
        }   
        if (substr($seclastbit,4,1) == "1"){
            $a11 = "Input 1 state open";
        }
        else{
            $a11 = "Input 1 state closed";
        }   
        switch(substr($seclastbit,0,4)){
            case '0001': $a12 = 'Device on'; break;
        
            case '0010': $a12 = 'device moved'; break;
        
            case '0011': $a12 = 'input status changed'; break;
        
            case '0100': $a12 = 'undesired input state'; break;
        
            case '0101': $a12 = 'recenter'; break;
        
            default : $a12 = 'none';
        }
    $lastbit = substr($binsec,64,8);
        if (substr($lastbit,7,1) == "1"){
            $a1b = 'non-precise';
        }
        else{
            $a1b = 'precise';
        }   
        if (substr($lastbit,6,1) == "1"){
            $a13 = 'In-Motion';
        }
        else{
            $a13 = 'Not In-Motion';
        } 
        if (substr($lastbit,5,1) == "1"){
            $a13 = '2D';
        }
        else{
            $a13 = '3D';
        }     
        if (substr($lastbit,4,1) == "1"){
            // echo "Device is on Vibrate while reporting" . "</br>";
        }
        else{
            // echo "Device is not on Vibrate while reporting" . "</br>";
        }           
        if (substr($lastbit,3,1) == "1"){
            $a14 = "Vibrate Trigger";
        }
        else{
            $a14 = "Non-Vibrate Trigger";
        }
        
        $string = file_get_contents('data.xml');
        $xml = new SimpleXMLElement($string);
        $asd = time();
        foreach($xml->stuMessages as $item){
            if (substr($item->stuMessage->payload,2) == $binsece){
            $dsa = $item->stuMessage->unixTime;
            $end = $asd - $dsa;
            $id = $item->stuMessage->esn;
            $epoch = $item->stuMessage->unixTime;
            $dt = new DateTime("@$epoch");
            $TimeStr =  $dt->format('Y-m-d H:i:s');
            $TimeZoneNameFrom="UTC";
            $TimeZoneNameTo="Asia/Pontianak";
            $msgid = xml_attribute($item,'messageID');
            $ohyes =  date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
                    ->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");

                    try{
                        $sql = "INSERT INTO`message`(`ID`, `messengerId`, `unixTime`, `messageType`, `latitude`, `longitude`,`datetime`, `battery`)
                        VALUES ('$msgid', '$id', '$epoch', '$a12', '$latg', '$long', '$ohyes', '$a1')";
                            if ($conn->query($sql) === TRUE) {
                                echo 'success add on : ' . $msgid . '</br>';
                            } else {
                                echo 'fail update on : ' . $msgid . '</br>';
                                
                            }
                    }
            
                    catch(Exception $asd){
                        
                    }
                }
    }
$conn->close();
    }
    function truncated($binsec) : void {
       
    }
    function raw($binsec) : void {
       
    }
    function nonstandard($binsec) : void {
       
    }
    function xml_attribute($object, $attribute)
{
    if(isset($object[$attribute]))
        return (string) $object[$attribute];
}
    function acctime($hexe){
        if ($hexe == 'FFFF'){
            return 65535;
        }
        else{
        $b1 = hex2dec($hexe) * 10;
        return (int)$b1;
        }
    }
    function accinput($hexe){
        if ($hexe == 'FF'){
            return 255;
        }
        else{
        $b1 = hex2dec($hexe);
        return (int)$b1;
        }
    }
    function accumulated($binsece) {
        $b1 = hexsec2decsec($binsece);
        $binsec = decsec2binsec($b1);
        $accinput1 = acctime(substr($binsece,2,4));
        $accinput2 = acctime(substr($binsece,6,4));
        $accvibrate = acctime(substr($binsec,10,4));
        $totalopi1 = accinput(substr($binsec,14,2));
        $totalopi2 = accinput(substr($binsec,16,2));
        $servername = "localhost";
        $username = "admindb";
        $password = "123qwe!@#QWE";
        $dbname = "tracking_system_gps";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo('error');
        }
        $string = file_get_contents('data.xml');
        $xml = new SimpleXMLElement($string);
        $asd = time();
        foreach($xml->stuMessages as $item){
            if (substr($item->stuMessage->payload,2) == $binsece){
            $dsa = $item->stuMessage->unixTime;
            $end = $asd - $dsa;
            $id = $item->stuMessage->esn;
            $epoch = $item->stuMessage->unixTime;
            $dt = new DateTime("@$epoch");
            $TimeStr =  $dt->format('Y-m-d H:i:s');
            $TimeZoneNameFrom="UTC";
            $TimeZoneNameTo="Asia/Pontianak";
            $msgid = xml_attribute($item,'messageID');
            $ohyes =  date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
                    ->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");

                    try{
                        $sql = "INSERT INTO`accmessage`(`id`, `messengerId`, `timestamp`, `i1acctime`, `i2acctime`, `vibrateacctime`, `i1opclcount`, `i2opclcount`)
                        VALUES ('$msgid', '$id', '$ohyes', '$accinput1', '$accinput2', '$accvibrate', '$totalopi1', '$totalopi2')";

                        if ($conn->query($sql) === TRUE) {
                            echo 'success add on : ' . $msgid . '</br>';
                        } else {
                            echo 'fail update on : ' . $msgid . '</br>';
                        }
                    }
            
                    catch(Exception $asd){
            
                    }
                }
    }
$conn->close();
        
    } 
    ?>
<?php
$string = file_get_contents('data.xml');
$xml = new SimpleXMLElement($string);
$asd = time();
foreach($xml->stuMessages as $item){
$dsa = $item->stuMessage->unixTime;
$end = $asd - $dsa;
$epoch = $item->stuMessage->unixTime;
$dt = new DateTime("@$epoch");
$TimeStr =  $dt->format('Y-m-d H:i:s');
$TimeZoneNameFrom="UTC";
$TimeZoneNameTo="Asia/Pontianak";
$msgdete = $item->stuMessage->payload;
$msgdet = substr($msgdete,2);
$msgdettype = substr($msgdete,2,2);
$binStringe = hexsec2decsec($msgdet);
$binString = decsec2binsec($binStringe);
$msgtypec = substr($binString, 6,2);
$ohyes =  date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
        ->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("Y-m-d H:i:s");
if($msgtypec == "00"){
$msgtype = "Standard Message";
standard($msgdet);
        

}
elseif($msgtypec == "01"){
$msgtype = "Truncated Message";
        
echo 'message type : ' . $msgtype;
echo '</br>';
echo 'Hex Address : ' . $msgdet;
echo '</br>';
echo 'Binary Address : ' . $binString;
echo '</br>';
echo 'Timestamp : ' . $ohyes . '</br>';
echo '--------------------------------------' . '</br>';
}
elseif($msgtypec == "10"){
    $msgtype = "Raw Message";
        
    echo 'message type : ' . $msgtype;
    echo '</br>';
    echo 'Hex Address : ' . $msgdet;
    echo '</br>';
    echo 'Binary Address : ' . $binString;
    echo '</br>';
    echo 'Timestamp : ' . $ohyes . '</br>';
    echo '--------------------------------------' . '</br>';
    }
    elseif($msgtypec == "11"){
        
        $msgtype = "Non-Standard Message";
        if($msgdettype == '63'){
            accumulated($msgdet);
        }

    }

        else{
            $msgtype = "unknown";
        
            echo 'message type : ' . $msgtype;
            echo '</br>';
            echo 'Hex Address : ' . $msgdet;
            echo '</br>';
            echo 'Binary Address : ' . $binString;
            echo '</br>';
            echo 'Timestamp : ' . $ohyes . '</br>';
            echo '--------------------------------------' . '</br>';
        }

    }
?>
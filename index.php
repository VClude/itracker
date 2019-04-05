<!DOCTYPE html>
<html lang="en">
<?php session_start(); /* Starts the session */
if(!isset($_SESSION['UserData']['Username'])){
header("location:login/index.php");
exit;
}
?>
<head>
    <meta charset="UTF-8">
    <title>ITracker-Sat</title>
    <!--<editor-fold desc="css">-->

    <link rel="stylesheet" href="source/css/main.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="source/css/mdb.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel=stylesheet href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="source/css/main.css">
    <link rel="stylesheet" href="source/css/animate-font.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.js"></script>

    <!--</editor-fold-->
</head>
<body>
<div class="wrapper">
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header">
            <img src="source/img/logo.png">
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#" style="color:#fff !important;">Monitoring Patok</a>
            </li>
            <li>

                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"><i
                        class="fas fa-align-justify mr-3"></i> Menu</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#"><i class="fas fa-home mr-3"></i> Home</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-map-signs mr-3"></i> Batas Darat</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-shield-alt mr-3"></i> Pamtas</a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fas fa-binoculars mr-3"></i> Monitoring</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-database mr-3"></i> Data Aset Patok</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-paste mr-3"></i> Resume</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-download mr-3"></i> Download</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-picture-o mr-3"></i> Gallery</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div>

        </div>
    </nav>

    <nav id="rightbar">
        <div id="dismiss-right">
            <i class="fas fa-arrow-right"></i>
        </div>

        <div class="sidebar-header">
            <h4>Info Perangkat Terkini</h4>
        </div>

        <ul class="list-unstyled components tracker scrollable">
            <?php include('g1.php');?>

        </ul>

        <div class="black-text p-1 font-weight-thin flex-row">

            <h4 class="title-info ml-3">Informasi Device</h4>
            <div class="container-fluid no-padding-left">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info">
                            <i class="fas fa-fingerprint pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">ID Record</span><br/>
                                <span class="info-desc" id="device_id"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 no-padding-left">
                        <div class="info">
                            <i class="fas fa-monument pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Nama Device</span><br/>
                                <span class="info-desc" id="device_name"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="info">
                            <i class="fas fa-battery-full pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Baterai</span><br/>
                                <span class="info-desc" id="battery"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 no-padding-left">
                        <div class="info">
                            <i class="fas fa-envelope pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Pesan Device</span><br/>
                                <span class="info-desc font-small" id="message"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="info">
                            <i class="fas fa-globe pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Latitude</span><br/>
                                <span class="info-desc" id="lat"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 no-padding-left">
                        <div class="info">
                            <i class="fas fa-globe pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Longitude</span><br/>
                                <span class="info-desc font-small" id="lng"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="font-small ml-3 mt-2">
                <span class="black-text" id="date"> </span>
                <span class="grey-text" id="timestamp"></span>
            </div>
        </div>
    </nav>

    <nav id="bottombar">

        <div class="sidebar-header">
            Detail Perangkat

            <div id="dismiss-bottom">
                <i class="fas fa-times"></i>
            </div>
        </div>

        <div class="container-fluid black-text">
            <div class="row">
                <div class="col-md-12">
                    <table id="deviceTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr class="low">
                            <th><i class="fas fa-globe-asia"></i> ID</th>
                            <th><i class="fas fa-globe-asia"></i> Device ID</th>
                            <th><i class="fas fa-pen-alt"></i> Device Name</th>
                            <th><i class="fas fa-envelope-open"></i> Message Type</th>
                            <th><i class="fas fa-compass"></i> Latitude</th>
                            <th><i class="fas fa-compass"></i> Longitude</th>
                            <th><i class="fas fa-clock"></i> Timestamp</th>
                            <th><i class="fas fa-battery-full"></i> Battery</th>
                            <th><i class="fas fa-plane-departure"></i> Altitude</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="0-3510065">
                            <td>1163352773</td>
                            <td>0-3510065</td>
                            <td>Project 1</td>
                            <td>EXTREME-TRACK</td>
                            <td>-6.35208</td>
                            <td>107.21465</td>
                            <td>2019-03-16 13:18:27</td>
                            <td>GOOD</td>
                            <td>455</td>
                        </tr>
                        <tr id="0-3510068">
                            <td>1163352773</td>
                            <td>0-3510068</td>
                            <td>Project 1</td>
                            <td>EXTREME-TRACK</td>
                            <td>-6.35208</td>
                            <td>107.21465</td>
                            <td>2019-03-16 13:18:27</td>
                            <td>GOOD</td>
                            <td>455</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </nav>

    <div id="map"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button type="button" id="sidebarCollapse" class="btn btn-white">
                    <i class="fas fa-align-left"></i>&nbsp;&nbsp;
                    <span>Buka Menu</span>
                </button>
                <button type="button" id="rightbarCollapse" class="btn btn-white" data-toggle="tooltip" data-html="true"
                        title="<i class='fas fa-question pr-2'></i> Klik untuk memunculkan status device terkini">
                    <i class="fas fa-info"></i>&nbsp;&nbsp;
                </button>

            </div>

        </div>
        <button type="button" id="bottombarCollapse" class="btn btn-white faa-parent animated-hover button-bottom"
                data-toggle="tooltip" data-html="true"
                title="<i class='fas fa-question pr-2'></i> Data Perangkat Detail">
            <i class="fas fa-arrow-alt-circle-up faa-float"></i>
        </button>

    </div>
</div>

<!--<editor-fold desc="script">-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>

<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <!--pls change the javascript back to original, i've added "&callback=initMap at the back-->
        <script type="text/javascript" src="source/js/animatemap.js"></script>

        <script type="text/javascript" src="source/js/screep.js"></script>
<script type="text/javascript" src="source/js/mdb.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
<!-- <script async defer type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOLOpJqaK_qRis79Ys1pX2aWjlPfJrgcU&callback=initMap"></script> -->

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOLOpJqaK_qRis79Ys1pX2aWjlPfJrgcU&callback=initMap"></script>
<script type="text/javascript" src="mappoint.js"></script>
<!--</editor-fold-->
<script type="text/javascript"> 
        </script>

<?php 
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

</body>
</html>
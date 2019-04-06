<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ITracker-Sat</title>
    <link rel="stylesheet" href="source/css/main.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="source/css/mdb.css">-->

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel=stylesheet href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="source/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <style>
        #modal-content-map {
            height: 100%;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.js"></script>

</head>
<body>


<div class="wrapper">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <!-- One of the primary actions on mobile is to call a business - This displays a phone button on mobile only -->
        <div class="navbar-toggler-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>


        <div class="collapse navbar-collapse flex-column " id="navbar">

            <div class="col-md-12 p-4 bg-white">

                <div class="float-left d-flex flex-row">
                    <img src="source/img/kemhan.png">
                    <div class="flex-column pl-4 black-text">
                        <h3>Border Monitoring System</h3>
                        <h6>Sistem Pelacakan Dan Monitoring Asset Negara</h6>
                    </div>
                </div>
  

            </div>
            <!-- justify-content-center to center the fkin nav back-->
            <ul class="navbar-nav w-100 bg-secondary px-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="#">
                        Batas Darat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="#">
                        Pamtas
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" id="#">
                        Monitoring
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="#">
                        Data Aset Patok
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="#">
                        Resume
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="#">
                        Download
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" id="#">
                        Logout
                    </a>
                </li>
            </ul>

        </div>
    </nav>
<!-- 
<nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header">
            <h4>Info Perangkat Terkini</h4>
        </div>

        <ul class="list-unstyled components tracker scrollable">
          

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
    </nav> -->
    <div class="container-fluid exclude-this-one">
        <div class="row">
            <div class="col-md-3">
            
        <div class="sidebar-header text-center">
            <h4>Status Terbaru</h4>
        </div>
        <div class="scrollable">
        
        <table class="table table-borderless text-center" id="deviceList">
                        <!--Table head-->
                        <thead>
                        <tr>
                            <th class="first_row">ID Device</th>
                            <th class="first_row_status">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php include('g2.php');?>
                        </tbody>
    </table>
            
        </div>

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
                    <div class="col-md-6">
                        <div class="info">
                            <i class="fas fa-monument pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Nama</span><br/>
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
                    <div class="col-md-6">
                        <div class="info">
                            <i class="fas fa-envelope pull-left pl-1 grey-text mr-3"></i>
                            <div class="info-content">
                                <span class="info-title grey-text">Pesan</span><br/>
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
                    <div class="col-md-6">
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
                <span class="black-text" id="date"> </span><br>
                <span class="grey-text" id="timestamp"></span>
            </div>
        </div>
            </div>
            <div class="col-md-9 p-2" style="height:618px !important;">
                <div id="map" style="width:100% !important; height:100% !important; position:block !important;"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

    <button type="button" id="bottombarCollapse" class="btn btn-white faa-parent animated-hover button-bottom"
                data-toggle="tooltip" data-html="true"
                title="<i class='fas fa-question pr-2'></i> Data Perangkat Detail">
            <i class="fas fa-arrow-alt-circle-up faa-float"></i>
        </button>
        
    </div>
    
</div>

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
                    <th><i class="fas fa-globe-asia"></i> Device ID</th>
                    <th><i class="fas fa-pen-alt"></i> Device Name</th>
                    <th><i class="fas fa-envelope-open"></i> Message Type</th>
                    <th><i class="fas fa-compass"></i> Latitude</th>
                    <th><i class="fas fa-compass"></i> Longitude</th>
                    <th><i class="fas fa-clock"></i> Timestamp</th>
                    <th><i class="fas fa-battery-full"></i> Battery</th>
                    <th><i class="fas fa-plane-departure"></i> Altitude</th>
                    <th><i class="fas fa-globe-asia"></i> ID</th>
                    
                </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>
        </div>
    </div>
</div>
</nav>

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

<div class="footer"><p>&nbsp;</p></div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!--pls change the javascript back to original, i've added "&callback=initMap at the back-->
<script type="text/javascript" src="source/js/screep.js"></script>
<script type="text/javascript" src="source/js/animatemap.js"></script>
<script type="text/javascript" src="source/js/mdb.js"></script>
<script async defer type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOLOpJqaK_qRis79Ys1pX2aWjlPfJrgcU&callback=initMap"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


</body>
</html>
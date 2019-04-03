<!DOCTYPE html>
<html lang="en">
<?php session_start(); /* Starts the session */
if(!isset($_SESSION['UserData']['Username'])){
header("location:login.php");
exit;
}
?>
<head>
    <meta charset="UTF-8">
    <title>ITracker-Sat</title>
    <link rel="stylesheet" href="source/css/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="source/css/mdb.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script
			  src="http://code.jquery.com/jquery-3.3.1.slim.js"
			  integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
			  crossorigin="anonymous"></script>
<style>
#gmap {
height: 400px;
}
</style>
</head>

<body>
    <!-- SideNav slide-out button -->


<!--/. Sidebar navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top black-text bg-faded scrolling-navbar primary-color">
        <div class="container">
    
            <a class="navbar-brand" href="index.html"> I-TrackerSat </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <a class="nav-link" href="logout.php">Logout</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                               <!-- <div class="text-center"> <a href="" class="btn btn-danger btn-rounded" data-toggle="modal" data-target="#darkModalForm">Sign In</a> </div> -->
 </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mt-5"></div>
        <!-- Section: Contact v.1 -->
        <section class="my-5 mt-5">

            <!-- Section heading -->
            <h2 class="h1-responsive font-weight-bold text-center my-5">I-TrackerSat</h2>
            <!-- Section description -->
        
            <!-- Grid row -->
            <div class="row">
<div class="col-lg-2">

                            <!-- Sticky content -->
                            <div class="sticky">

			<h3>Alat Terdaftar</h3>
                              <!--Scrollspy-->
                                <div id="scrollspy">
                                  
                                    <!-- Links -->
                                    <ul class="nav nav-pills default-pills smooth-scroll" data-allow-hashes="">
					<?php include('ashv.php');?>
                                    </ul>
                                    <!-- Links -->

                                </div>
                                <!--Scrollspy-->

                            </div>
				<div class="sticky-placeholder"></div>
				<div class="sticky-placeholder"></div>
                            <!-- Sticky content -->

                        </div>
                <!-- Grid column -->
  
                <!-- Grid column -->

                <!-- Grid column -->
                <div id="isimap" class="col-lg-10">
                        <div id="widget"></div>

                    <!-- Google map-->
           
                    <br>
                    <!-- Buttons-->
  

                </div>

                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </section>
        <!-- Section: Contact v.1 -->

    </div>
    <!--Table-->

                  <div class="container mt-5" id="stoppermap">
    <div class="row mt-5"></div>
        <!-- Section: Contact v.1 -->
<section class="my-5 mt-5">
<!-- Card -->
<div id="exde" class="carousel slide carousel-multi-item" data-ride="carousel">

  <!--Controls-->
<div class="ui-header">
<h1>Update Terbaru</h1>
</div>
  <div class="controls-top">

<a class="btn-floating" href="#exde" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
    <a class="btn-floating" href="#exde" data-slide="next"><i class="fa fa-chevron-right"></i></a>
  </div>

  <div class="carousel-inner" role="listbox">


<?php include('ash.php');?>
</div>
</div>
<!-- Card -->
</section>
<!-- Accordion wrapper -->

    </div>



<div class="col-lg-12">
            <!-- Extended material form grid -->
            <div class="table-responsive">
                <h1>Messages</h1>
            </div>
<!--<div class="table-wrapper-scroll-y my-custom-scrollbar">-->
<table id="dyntable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
             
<!-- <table id="dt-select" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
                    <thead>
                      <tr>
			<th class="th-sm">ID</th>
                        <th class="th-sm">Device ID</th>
                        <th class="th-sm">Device Name</th>
                        <th class="th-sm">Message Type</th>
                        <th class="th-sm">Latitude</th>
                        <th class="th-sm">Longitude</th>
                        <th class="th-sm">Timestamp</th>
                        <th class="th-sm">Battery</th>
                        <th class="th-sm">Altitude</th>
                        <th class="th-sm">-</th>
                      
			</tr>
                    </thead>
                    <tbody>
                   
 <?php //include('ans.php')?>  
                  </tbody>
                  </table>
<!--</div>-->                 
                  </div>
<div class="ui divider">&nbsp;</div>
    <!--/.Footer-->
    <!--MODAL-->

<!--Modal: Name-->
<div class="modal fade" id="modalRegular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <!--Google map-->
        <div id="map-container-google-16" class="z-depth-1-half map-container-9" style="height: 400px">
          <iframe src="https://maps.google.com/maps?q=new%20delphi&t=&z=13&ie=UTF8&iwloc=&output=embed"
            frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">

        <button type="button" class="btn btn-info btn-md">Save location <i class="fas fa-map-marker-alt ml-1"></i></button>
        <button type="button" class="btn btn-outline-info btn-md" data-dismiss="modal">Close <i class="fas fa-times ml-1"></i></button>

      </div>

    </div>
    <!--/.Content-->

  </div>
</div>

<div id="PRODUCT_DETAILS" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">                   
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="proNameTitle"></h4>
                </div>
                <div class="modal-body product_detail">
                    <div class="col-md-12">
                   
<!-- Card -->
<div class="card card-cascade wider reverse">


  <!-- Card content -->
  <div class="card-body card-body-cascade text-center">

    <!-- Title -->
    <h4 class="card-title"><strong id="proDevice"></strong></h4>
    <!-- Subtitle -->
   <h6 class="indigo-text py-2">Pukul Keberadaan : <span id="proTime"></span></h6>
    <!-- Text -->
			    <p class="d-none">Latitude : <span id="proName"></span></p>
                           <p class="d-none">Longitude :  <span id="proPrice"></span></p>                            


  </div>

</div>
<!-- Card -->

                    </div>
                    <div class="clearfix"> </div>                   
                </div>
	<div id="gmap"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
</div>
<script>
var lat;
var leng;
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="source/js/mdb.min.js" type="text/javascript"></script>
    
                        <!--Google Maps v3 API -->
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOLOpJqaK_qRis79Ys1pX2aWjlPfJrgcU"></script>
                        <script type="text/javascript" src="mappoint.js"></script>
                        
                        <script type="text/javascript"> 
$(function () {
    $(".sticky").sticky({
      topSpacing: 90
    , stickyClass: ['col-lg-2']    
    , zIndex: 2
    , stopper: "#stoppermap"
    });
});

function initMap() {
    var myLatlng = {lat: lat, lng: leng};

    var map = new google.maps.Map(document.getElementById('gmap'), {
      zoom: 12,
      center: myLatlng
    });

    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Click to zoom'
    });

    map.addListener('center_changed', function() {
      // 3 seconds after the center of the map has changed, pan back to the
      // marker.
      window.setTimeout(function() {
        map.panTo(marker.getPosition());
      }, 3000);
    });

    marker.addListener('click', function() {
        map.setZoom(16);
        map.setCenter(marker.getPosition());
      });
    }
function createMap() {
  var lat = $('#proPrice').val();
  var lng = $('#proName').val();
  var map;
  var marker;
  var myLatlng = new google.maps.LatLng(lat, lng);
  var geocoder = new google.maps.Geocoder();
  var infowindow = new google.maps.InfoWindow();

  var mapOptions = {
    zoom: 18,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById("gmap"), mapOptions);

  marker = new google.maps.Marker({
    map: map,
    position: myLatlng,
    draggable: true
  });

  geocoder.geocode({
    'latLng': myLatlng
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
      }
    }
  });


  google.maps.event.addListener(marker, 'dragend', function() {

    geocoder.geocode({
      'latLng': marker.getPosition()
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          infowindow.setContent(results[0].formatted_address);
          infowindow.open(map, marker);
        }
      }
    });
  });
}

                        $(function(){ 
                             $('#widget').spotLiveWidget({ 
                                  feedId: '0PcxybRdUaTdJ72LJuv5kXGPq7eGObYBF', 
                                  mapType: 'ROADMAP', 
                                  width: $('#isimap').width(), 
                                  height: 600 
                             }); });

  $('#PRODUCT_DETAILS').on('show.bs.modal', function (e) {
        var productID= $(e.relatedTarget).data('id');
        $.ajax({
            url:"fetch.php",
            method: "POST",
            data:{productID:productID},
            dataType:"JSON",
            success:function(data)
            {   
		lat = data.x;
		leng = data.y;
		$('#proPrice').val(data.x);
                $('#proName').val(data.y);
		$('#proPrice').text(data.x);
                $('#proName').text(data.y);
                $('#proDevice').text(data.name);
                $('#proTime').text(data.timestamp);
		createMap();

            }
        })
     });
                        </script>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="source/js/main.js"></script>

</body>
<?php 
function relativeTime($time) {

    $d[0] = array(1,"second");
    $d[1] = array(60,"minute");
    $d[2] = array(3600,"hour");
    $d[3] = array(86400,"day");
    $d[4] = array(604800,"week");
    $d[5] = array(2592000,"month");
    $d[6] = array(31104000,"year");

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
            $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'s':'') ." ";
         }

    }

    $return .= ($diff>0)?"ago":"left";
    return $return;
}?>
</html>



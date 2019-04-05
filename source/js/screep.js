$( document ).ready(function() {
    console.log( "ready!" );
    $('#deviceTable').DataTable({
        lengthChange: false,
        searching: false
    });

    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('[data-toggle="tooltip"]').tooltip({
        trigger: "hover"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#dismiss-right, .overlay').on('click', function () {
        $('#rightbar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#dismiss-bottom, .overlay').on('click', function () {
        $('#bottombar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    $('#rightbarCollapse').on('click', function () {
        $('#rightbar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    $('#bottombarCollapse').on('click', function () {
        $('#bottombar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    // $(function(){ 
    //     $('#map').spotLiveWidget({ 
    //          feedId: '0PcxybRdUaTdJ72LJuv5kXGPq7eGObYBF', 
    //          mapType: 'ROADMAP',
    //          width: $('#map').width(), 
    //          height: $('#map').height()
    //     }); });

});

var map, marker, device_arr;


function initMap() {
//     $('#map').spotLiveWidget({ 
//         feedId: '0PcxybRdUaTdJ72LJuv5kXGPq7eGObYBF', 
//         mapType: 'ROADMAP'
//    });
    var uluru = {lat: -6.21462, lng: 106.84513};

    var mapOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        center: uluru
    };
    //declaring array on map load
    declareArray();

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    marker = new google.maps.Marker({position: uluru, map: map});
}
function clickLihatMap(prod_id){
    alert("eat " + prod_id);
    moveMapToCenter(-6.281139, 107.034461);
}

function moveMapToCenter(latLng){
    smoothlyAnimatePanTo(map, latLng);
}
function placeMarker(latlng, map) {
    var marker = new google.maps.Marker({
      position: position,
      map: map
    });  
    map.smoothlyAnimatePanTo(map, latlng);
  }
//Emulates API Call with array
function declareArray() {
    device_arr = [
        {'device_id' : '0-3510065', 'name' : 'i-TrackerSat 1','battery' : 'Good', 'message' : 'No Signal',
            'lat' : '-6.451778', 'lng' : '106.840104', 'latlng' : new google.maps.LatLng(-6.451778, 106.840104),
            'date' : '2019-03-19 12:58:50', 'last_timestamp' : '6H 18J 14M 44D'},

        {'device_id' : '0-3510067', 'name' : 'i-TrackerSat 2','battery' : 'Bad', 'message' : 'Extreme-Track',
            'lat' : '-6.530543', 'lng' : '106.800566', 'latlng' : new google.maps.LatLng(-6.530543, 106.800566),
            'date' : '2019-03-19 12:58:50', 'last_timestamp' : '6H 18J 14M 44D'},

        {'device_id' : '0-3510068', 'name' : 'i-TrackerSat 2','battery' : 'Good', 'message' : 'Extreme-Track',
            'lat' : '-6.530543', 'lng' : '106.800566', 'latlng' : new google.maps.LatLng(-6.217448, 106.939683),
            'date' : '2019-03-19 12:58:50', 'last_timestamp' : '6H 18J 14M 44D'}
    ]
}
//setting on device on li Click Fn
$(document).ready(function () {
    $('.tracker li').click(function () {
        var device_id = this.id;
        var dev_name, battery, message, latlng, lat, lng, date, timestamp;
        $.ajax({
            url:"fetch.php",
            method: "POST",
            data:{productID:device_id},
            dataType:"JSON",
            success:function(data)
            {   
        //getting the id of the li that triggering the click
        
        //getting the right value for the device id
        dev_name = data.name;
        battery = data.battery;
        message = data.message;
        lng = data.lng;
        lat = data.lat;
        latlng = new google.maps.LatLng(lat, lng);
        date = data.date;
        timestamp = data.last_timestamp;
    //     var uluru = {lat: data.lat, lng: data.lng};
    // map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // marker = new google.maps.Marker({position: uluru, map: map});
//Move the map to the device location
smoothlyAnimatePanTo(map, latlng);
//Changing text at device informaion in the DOM
$('#device_id, #device_name, #battery, #message, #lat, #lng, #date, #timestamp').fadeOut(500, function() {
    $('#device_id').text(device_id).fadeIn(500);
    $('#device_name').text(dev_name).fadeIn(500);
    $('#battery').text(battery).fadeIn(500);
    $('#message').text(message).fadeIn(500);
    $('#lat').text(lat).fadeIn(500);
    $('#lng').text(lng).fadeIn(500);
    $('#date').text(date).fadeIn(500);
    $('#timestamp').text(timestamp).fadeIn(500);
});

            }
        })
    });
});

//Datatables onRowClicked Fn
$(document).ready(function () {
    $('#deviceTable tbody').on( 'click', 'tr', function () {
        //searching already given active class to table childs
        $('#deviceTable tbody').find('tr').removeClass('active');
        //setting the mew row visual to see the user
        $(this).toggleClass('active');

        //getting the id from the <tr> tag triggering the event
        var device_id = this.id;

        //getting the right value for the device id
        for (var index = 0; index < device_arr.length; ++index) {
            if(device_arr[index]['device_id'] === device_id){
                dev_name = device_arr[index]['name'];
                battery = device_arr[index]['battery'];
                message = device_arr[index]['message'];
                lng = device_arr[index]['lng'];
                lat = device_arr[index]['lat'];
                latlng = device_arr[index]['latlng'];
                date = device_arr[index]['date'];
                timestamp = device_arr[index]['last_timestamp'];
            }
        }

        //Move the map to the device location
        smoothlyAnimatePanTo(map, latlng);
    } );
});


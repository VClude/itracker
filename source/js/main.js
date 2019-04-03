 $(document).ready(function () {
     var tabel = null;
     $('.mdb-select').material_select();
     $('.Gender').material_select();
     $('.dropdown-toggle').dropdown();
     $(".button-collapse").sideNav();
     console.log( "ready!" );
     $('#wew').DataTable({
         lengthChange: false
     });
 
     $('.show').click(function () {
         $('#tablePreview').slideToggle(500, function () {
             if ($('#tablePreview').is(':visible')) {
                 $('.show').text(" sembunyikan..")
             }else{
                 $('.show').text(" tampilkan..")
             }
         });
     });

tabel = $('#dyntable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
	    "ajax":
            {
                "url": "xfetch.php", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[6, 10, 50],[6, 10, 50]], // Combobox Limit
            "columns": [
                { "data": "ID" },
                { "data": "messengerId" }, 
                { "data": "messengerName" }, 
                { "data": "messageType" }, 
                { "data": "latitude" }, 
                { "data": "longitude" }, 
                { "data": "datetime" }, 
                { "data": "battery" }, 
                { "data": "altitude" },
		{
		"render": function(data, type, row, meta) {
return '<a href="#PRODUCT_DETAILS" class="item_add prod_detail" data-toggle="modal" data-target="#PRODUCT_DETAILS" data-id="'+ row.ID +'">Lihat Map</a>';
	  }
	}
                
            ],
        });


// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);
     $('input:checkbox').click(function () {
         $('input:checkbox').not(this).prop('checked', false);
     });
     $('#bquote').hide();
     $('select[name=htm]').change(function() {
        if($('select[name=htm] option:nth(5)').is(':selected')){
         $('#bquote').fadeIn('slow');
     }else{
         $('#bquote').fadeOut('slow');
     }
     // Tooltips Initialization
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    });
 });

function validateRegist(){
    if($('select[name=gender] option:nth(0)').is(':selected')){
        alert('Please Select Gender');
        return false;
    }else if(grecaptcha.getResponse()===''){
       alert('Please fill captcha first');
       return false;
    }
}

 $('#fixed-action-btn').click(function () {
     $('#modalCart').modal('show');
 })

 var datezfiveyear = new Date();

 datezfiveyear.setFullYear(new Date().getFullYear() + 5);

 $("#expdate").pickadate({
     format: 'mmmm, yyyy',
     formatSubmit: 'mm, yyyy',
     min: new Date(),
     max: datezfiveyear
 });
var datezthreemonth = new Date();
datezthreemonth.setMonth(new Date().getMonth() + 3);

$('.datepicker').pickadate({
    min: new Date(),
    max: datezthreemonth,
});

function valindex() {
    var tanggalvalid = document.getElementById('tanggal_berangkat');
    if($('select[name=route] option:nth(0)').is(':selected')){
        alert('Please Select Route');
        return false;
    }else if($('select[name=st_from] option:nth(0)').is(':selected')){
        alert('Please Select Departure Station');
        return false;
    }else if($('select[name=st_to] option:nth(0)').is(':selected')){
        alert('Please Select Arrival Station');
        return false;
    }else if($('select[name=htm] option:nth(0)').is(':selected')){
        alert('Please select amount of passenger');
        return false;
    }else if(tanggalvalid.value == ""){
        alert('Please Choose departure date');
        return false;
    }
 }

 function validateDate() {
     var expvalid = document.getElementById("expdate");
     if (expvalid.value == "") {
         expvalid.setCustomValidity("Please Select Expiry Date");
         alert("Please Choose the expiracy date");
         return false;
     } else {
         expvalid.setCustomValidity("");
     }
 }

 var emailvalid = document.getElementById("inputemail");
 emailvalid.addEventListener("input", function (event) {
     if (emailvalid.validity.typeMismatch) {
         emailvalid.setCustomValidity("YANG BENER DONG!!!");
     } else {
         emailvalid.setCustomValidity("");
     }
 });

 var statevalid = document.getElementById("inputstate");

 statevalid.addEventListener("input", function (event) {
     if (statevalid.value == "") {
         statevalid.setCustomValidity("You haven't fill this form, fix plz.");
     } else if (statevalid.validity.patternMismatch) {
         statevalid.setCustomValidity("Is this a real City/State ?");
     } else {
         statevalid.setCustomValidity("");
     }
 });
 var namevalid = document.getElementById("inputlname");
 var namevalid1 = document.getElementById("inputfname");

 namevalid.addEventListener("input", function (event) {
     if (namevalid.validity.patternMismatch) {
         namevalid.setCustomValidity("This not look like a real name..");
     } else {
         namevalid.setCustomValidity("");
     }
 });

 namevalid1.addEventListener("input", function (event) {
     if (namevalid1.validity.patternMismatch) {
         namevalid1.setCustomValidity("This not look like a real name..");
     } else {
         namevalid1.setCustomValidity("");
     }
 });

 var zipvalid = document.getElementById("inputzip");
 zipvalid.addEventListener("input", function (event) {
     if (zipvalid.validity.patternMismatch) {
         zipvalid.setCustomValidity("This isn't earth zip code, do you live in mars ?");
     } else {
         zipvalid.setCustomValidity("");
     }
 });
 var countersel = 1;

 function addpass() {
     // $('.mdb-select').material_select('destroy');
     if (countersel >= 4) {
         $('#addanother').text("Limit Reached");
         $('#addanother').addClass("disabled");
     }

     countersel++;
     $('#passenjer').append("<div class=entry" + countersel + "><p>&nbsp;</p><h5 class='mb-5 ml-0'>Passenger #" + countersel + "</h5><a href='#' id=entry" + countersel + " onclick='removepass();'>Remove</a><div class='row' id=numberz" + countersel + "><div class='col-md-4 pt-3' id='selname2'><select class='mdb-select' id=sel" + countersel + "><option value='1' selected>Mr.</option><option value='2'>Mrs.</option><option value='3'>Miss</option></select></div><div class='col-md-8'><div class='md-form form-group'><input type='text' class='form-control' id=inputname" + countersel + " placeholder='Full Name'></div></div></div><div class='row' id=number" + countersel + "><div class='col-md-4 pt-3'><select class='mdb-select' id=idsel" + countersel + "><option value='1' selected>KTP/Govt. ID</option><option value='2'>SIM/Driving License</option><option value='3'>Passport</option><option value='3'>Other</option></select></div><div class='col-md-8'><div class='md-form form-group'><input type='text' class='form-control' id=inputid" + countersel + " placeholder='Type your ID Number'></div></div></div></div>");
     $('#sel' + countersel).material_select();
     $('#idsel' + countersel).material_select();
     $('.dropdown-toggle').dropdown();
     $('#number' + countersel).addClass('animated fadeInUp');
     $('#numberz' + countersel).addClass('animated fadeInUp');
     $('body, html').animate({
         scrollTop: $('#number' + countersel).offset().top
     }, 1000);
     $("div").remove('entry' + countersel);

 };

 function removepass() {
     $('.entry' + countersel).remove();
     countersel--;
     $('body, html').animate({
         scrollTop: $('#number' + countersel).offset().top
     }, 1000);
     if (countersel == 5) {
         $('#addanother').text("Limit Reached");
         $('#addanother').addClass("disabled");
     } else {
         $('#addanother').text("Add Another");
         $('#addanother').removeClass("disabled");
     }
 };

 function cekot() {
     var i;
     i = 0;
     for (i = 0; i < countersel; i++) {

         $('#cekotlist').append('<tr id="pesenjer' + countersel + '"><th scope="row">1</th><td>Nambo Jaya</td><td>1 Passenger</td><td>EUR 6000</td></tr>');

     }

 };

 function removecekot() {
     var i;
     i = 0;
     for (i = 0; i < countersel; i++) {

         $('#pesenjer' + countersel).remove();

     }
 };


 function dick() {

     var stuff = "";
     var ok = 'no';
     var myNode = document.getElementById("alertz");
     for (var i = 1; i <= countersel; i++) {
         if ($('#inputname' + i).val() == '') {
             stuff += 'Passenger name #' + i + ' are required <br>';

         } else if ($('#inputid' + i).val() == '') {
             stuff += 'Passenger ID #' + i + ' are required <br>';

         } else if ($('#inputname' + i).val() == '' && $('#inputid' + i).val() == '') {
             stuff += 'Passenger name and ID #' + i + ' are required <br>';

         }

     }
     while (myNode.firstChild) {
         myNode.removeChild(myNode.firstChild);
     }
     if (stuff == "") {
         $('#ikuzo').removeClass("disabled");
         $('#alertz').removeClass("alert alert-warning alert-dismissible fade show");


     } else {
         $('#alertz').addClass("alert alert-warning alert-dismissible fade show");
         $('#alertz').append(stuff);
         $('body, html').animate({
             scrollTop: $('#focus').offset().top
         });
         $('#ikuzo').addClass("disabled");
     }
 }

 function getTek() {
     return function () {


         return val;
     };
 }

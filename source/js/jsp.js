$(document).ready(function(){
    $('#login').click(function(){
        var uname = $('#Form-uname').val();
        var pwd = $('#Form-pass').val();
        $.ajax({
           type: "POST",
           url : "zugLogin",
           data : {"uname":uname, "pwd":pwd},
           success: function (resp){
               if(resp === "user"){
                   alert("Signed-in !");
                   location.reload();
               }else if (resp === "admin"){
                   alert("Welcome Adm00n !");
                   window.location.href = "crud.jsp";
               }else if (resp === "unauthorized"){
                   alert("Invalid Username and Password");
               }else{
                   alert("Invalid Username and Password");
               }
               
           },
           error: function(error){
               alert("error" + error);
           }
        });
    });
    $('#logout').click(function(){
        $.ajax({
            type: "GET",
            url: "zugLogout",
            success: function (resp){
                alert("Successfully Logged out");
                location.reload();
            },
            error: function (error){
                alert("Can not log out, please try again");
            }
        });
     });
     $('.dropdown-toggle').click(function(){
        $('.dropdown-toggle').dropdown('toggle'); 
     });
});

$('.st_from,.st_to').material_select();

$('select[name=route]').change(function() {
   $('.st_from,.st_to').material_select('destroy');
   var $select = $('#st_from,#st_to');
   var $select2 = $('#st_to');
   var selvalue = $('#route option:selected').val();
   $select.find("option").remove();
   $select2.find("option").remove();
   $('<option value="" disabled selected>Choose your option</option>').appendTo($select);
   $.get("SomeServlet",{ key: selvalue, target: "route", identifier: "station" }, function(responseJson){
        $.each(responseJson, function(key, value) {
            $("<option>").val(key).text(value).appendTo($select);
        });
        $('.st_from,.st_to').material_select();
    });
});
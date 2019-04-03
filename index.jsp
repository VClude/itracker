<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@include file="includes/dbimport.jsp" %>
<!DOCTYPE html>
<html class="full-height">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <link rel="stylesheet" href="source/css/index.css">
        <%@include file="includes/cssimport.jsp"%>
    </head>
    <body>
        <%@include file="includes/dbconnect.jsp" %>
        <header>
        <%@include file="includes/headerindex.jsp" %>
        <div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url('http://www.finnmoller.dk/rail-de/143/db143569.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-white-light d-flex justify-content-center align-items-center">
                <!-- Content -->
                <div class="container">
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-12 white-text text-center">
                            <h1 class="display-3 mb-0 pt-md-5 pt-5 white-text font-weight-bold wow fadeInDown" data-wow-delay="0.3s">Deutsche <a class="red-text font-weight-bold">Bahn</a> </h1>
                            <h5 class="text-uppercase pt-md-5 pt-sm-2 pt-5 pb-md-5 pb-sm-3 pb-5 white-text font-weight-bold wow fadeInDown" data-wow-delay="0.3s">Ihre Sicherheit ist unser Priorität</h5>
                            <div class="wow fadeInDown" data-wow-delay="0.3s"> <a class="btn btn-red btn-lg">Reserve a Ticket</a> <a class="btn btn-white btn-lg">Railpass</a> </div>
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </div>
                <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
        </div>
        </header>
        <main class="text-center py-5 mt-3">
        <div class="container overlap-header">
            <form action="book.html" class="md-form pr-3 pl-3" onsubmit="return valindex()" novalidate>
                <div class="row">
                    <div class="col">
                        <h3 id="searchtik">Search a Ticket</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col">
                        <sql:query dataSource = "${snapshot}" var = "result">
                            SELECT * FROM route;
                        </sql:query>
                        <select class="mdb-select" id="route" name="route" required>
                            <option value="" disabled selected>Choose your option</option>
                            <c:forEach var = "row" items = "${result.rows}">
                                <option value="${row.id}">${row.name}</option>
                            </c:forEach>
                        </select>
                        <label>Select a Route</label>
                    </div>
                    <div class="col">
                        <select class="st_from" id="st_from" name="st_from" required>
                            <option value="" disabled selected>Choose route first</option>
                        </select>
                        <label>From Station</label>
                    </div>
                    <div class="col">
                        <select class="st_to" id="st_to" name="st_to" required>
                            <option value="" disabled selected>Choose route first</option>
                        </select>
                        <label>To Station</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3">
                        <select class="mdb-select" name="htm" id="htm" required>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">1 Passenger</option>
                            <option value="2">2 Passenger</option>
                            <option value="3">3 Passenger</option>
                            <option value="4">4 Passenger</option>
                            <option value="">More than 4 Passenger</option>
                        </select>
                        <label>Passenger</label>
                    </div>
                    <div class="col">
                        <div class="md-form">
                            <input placeholder="Selected date" type="text" id="tanggal_berangkat" class="form-control datepicker">
                            <label for="date-picker-example">Date of Departure</label>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-flat btn-lg">Search Trains</button>
                    </div>
                </div>
                <div id="bquote" class="row">
                    <blockquote class="blockquote bq-success">
                        <p class="bq-title">Booking more than 4 Passenger ?</p>
                        <p>To prevent calo from using our online ticketing service, we limit to only 4 passenger per booking, if you want to book a ticket for more than 4 passenger, please go to nearest DB Station and ask the officer there.</p>
                    </blockquote>
                </div>
            </form>
        </div>
    </main>
    <!-- Section: Products v.4 -->
    <div class="view jarallax intro-2" data-jarallax='{"speed": 0.2}' style="background-image: url(source/image/4k_material_red_light-wallpaper-1440x900.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-white-slight">
            <div class="container">
                <section class="text-center my-5">
                    <!-- Section heading -->
                    <h2 class="h1-responsive font-weight-bold text-center my-5">Bahn Pass</h2>
                    <!-- Section description -->
                    <p class="h5-responsive text-center w-responsive mx-auto mb-5" style="font-weight: 200;">Book your Bahn Pass for unlimited train rides for a period of time !</p>
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
                            <!-- Collection card -->
                            <div class="card collection-card z-depth-1-half">
                                <!-- Card image -->
                                <div class="view zoom"> <img src="source/image/ice_train.jpg" class="img-fluid" alt="">
                                    <div class="stripe red">
                                        <a>
                                            <p>ICE Bahn Pass <i class="fa fa-angle-right"></i> </p>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card image -->
                            </div>
                            <!-- Collection card -->
                        </div>
                        <!-- Grid column -->
                        <!-- Grid column -->
                        <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
                            <!-- Collection card -->
                            <div class="card collection-card z-depth-1-half">
                                <!-- Card image -->
                                <div class="view zoom"> <img src="source/image/hamburg_train.jpg" class="img-fluid" alt="">
                                    <div class="stripe white">
                                        <a>
                                            <p>Hamburg Pass <i class="fa fa-angle-right"></i> </p>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card image -->
                            </div>
                            <!-- Collection card -->
                        </div>
                        <!-- Grid column -->
                        <!-- Grid column -->
                        <div class="col-lg-3 col-md-6 mb-md-0 mb-4">
                            <!-- Collection card -->
                            <div class="card collection-card z-depth-1-half">
                                <!-- Card image -->
                                <div class="view zoom"> <img src="source/image/berlin_train.jpg" class="img-fluid" alt="">
                                    <div class="stripe red">
                                        <a>
                                            <p>Berlin Pass <i class="fa fa-angle-right"></i> </p>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card image -->
                            </div>
                            <!-- Collection card -->
                        </div>
                        <!-- Grid column -->
                        <!-- Fourth column -->
                        <div class="col-lg-3 col-md-6">
                            <!-- Collection card -->
                            <div class="card collection-card z-depth-1-half">
                                <!-- Card image -->
                                <div class="view zoom"> <img src="source/image/allroute_train.jpg" class="img-fluid" alt="">
                                    <div class="stripe white">
                                        <a>
                                            <p>All-route Pass <i class="fa fa-angle-right"></i> </p>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card image -->
                            </div>
                            <!-- Collection card -->
                        </div>
                        <!-- Fourth column -->
                    </div>
                    <!-- Grid row -->
                </section>
            </div>
        </div>
    </div>
    <!-- Section: Products v.4 -->
    <div class="container">
        <!-- Projects section v.4 -->
        <section class="text-center my-5">
            <!-- Section heading -->
            <h2 class="h1-responsive font-weight-bold text-center my-5">Our costumer is our priority</h2>
            <!-- Section description -->
            <p class="grey-text text-center w-responsive mx-auto mb-5">Customer must be a number one priority to achieve our service achievement.</p>
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-12 mb-4">
                    <div class="card card-image" style="background-image: url(http://thekindtips.com/wp-content/uploads/Customer-Service-Tips-for-Ending-a-Phone-Call.jpeg);">
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4 rounded">
                            <div>
                                <h6 class="red-text"> <i class="fa fa-phone"></i> <strong> Customer Service</strong> </h6>
                                <h3 class="py-3 font-weight-bold"> <strong>Bahn Dedicated Service Line</strong> </h3>
                                <p class="pb-3">DB Offer number on quality service center ! If you want to book a ticket, check your booking status, or have a problem regarding our train services, feel free to contact us by clicking the button below! </p> <a href="contact-us.html" class="btn btn-danger btn-rounded btn-md"><i class="fa fa-clone left"></i> Contact us</a> </div>
                        </div>
                    </div>
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-6 mb-md-0 mb-4">
                    <div class="card card-image" style="background-image: url(http://farm8.staticflickr.com/7255/7031719473_4aa60973e9.jpg);">
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4 rounded">
                            <div>
                                <h6 class="red-text"> <i class="fa fa-hourglass"></i> <strong> Timeliness</strong> </h6>
                                <h3 class="py-3 font-weight-bold"> <strong>Zero Time Punctuation</strong> </h3>
                                <p class="pb-3">We offer a refund if a train is delayed, cancelled, or you missed a connecting train</p> <a href="claim.html" class="btn btn-danger btn-rounded btn-md"><i class="fa fa-clone left"></i> Refund</a> </div>
                        </div>
                    </div>
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-6">
                    <div class="card card-image" style="background-image: url(http://www.railjournal.com/images/ICE4-int4.jpg);">
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4 rounded">
                            <div>
                                <h6 class="red-text"> <i class="fa fa-bed"></i> <strong> Comfort</strong></h6>
                                <h3 class="py-3 font-weight-bold"> <strong>First Class Service</strong></h3>
                                <p class="pb-3">First class airplane like service, offer you a comfortable ride on even twelve-hours train ride. Experience Top-class service with DB. </p> <a href="features.html" class="btn btn-danger btn-rounded btn-md"><i class="fa fa-clone left"></i> First Class Facility</a> </div>
                        </div>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </section>
        <!-- Projects section v.4 -->
    </div>
        <%@include file="includes/footer.jsp" %>
        <%@include file="includes/loginmodal.jsp" %>
        <%@include file="includes/scriptimport.jsp" %>
    </body>
</html>

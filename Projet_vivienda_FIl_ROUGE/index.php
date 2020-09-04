
    
<?php 
// header-end
include 'ressources/header.php';
?>
    <!-- slider_area_start -->
    <div class="slider_area">
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="slider_text text-center justify-content-center">
                                    <h3>Find your best Property </h3>
                                    <p>Esteem spirit temper too say adieus who direct esteem.</p>
                                </div>
                            </div>
                        </div>
                  </div>
            </div>
    </div>
    <!-- slider_area_end -->
    <!-- popular_property  -->
    
    <div class="popular_property">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h3> empty and Availbale Properties</h3>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
$sql = 'select * from property where property.idStudent is null LIMIT 0, 4 ';
$stmt = $conn->prepare($sql);
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_OBJ);
// var_dump($properties);
foreach ($properties as $property) {?>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <div class="property_tag">
                                    empty 
                            </div>
                            <img src="<?php echo $property->Picture ?>" alt="">
                        </div>
                        <div class="property_content">
                            <div class="main_pro">
                                    <h3><a href="#"><?php echo $property->namePro ?></a></h3>
                                    <div class="mark_pro">
                                        <img src="img/svg_icon/location.svg" alt="">
                                        <span><?php echo $property->localisation ?></span>
                                    </div>
                                    <span class="amount">for <?php echo $property->price ?> /month</span>
                            </div>
                        </div>
                        <div class="footer_pro">
                                <ul>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="img/svg_icon/bed.svg" alt="">
                                            <span><?php echo $property->bedrooms ?> </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="img/svg_icon/bath.svg" alt="">
                                            <span><?php echo $property->bathrooms ?> </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </div>
<?php } ?>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="more_property_btn text-center">
                        <a href="property.php" class="boxed-btn3-line">More Properties</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /popular_property  -->
    
    <!-- home_details  -->
    <div class="home_details">
        <div class="container">
            <div class="row">   
                <div class="col-xl-12">
                    <div class="home_details_active owl-carousel">
                    <?php
$sql = 'select * from property where property.idStudent is null LIMIT 0, 4 ';
$stmt = $conn->prepare($sql);
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_OBJ);
// var_dump($properties);
foreach ($properties as $property) {?>
                        <div class="single_details">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                        <div class="modern_home_info">
                                                <div class="modern_home_info_inner">
                                                    <span class="for_sale">
                                                       Availbale For rent
                                                    </span>
                                                    <div class="info_header">
                                                            <h3><?php echo $property->namePro ?></h3>
                                                            <div class="popular_pro d-flex">
                                                                <img src="img/svg_icon/location.svg" alt="">
                                                                <span></span>
                                                            </div>
                                                    </div>
                                                    <div class="info_content">
                                                        <ul>
                                                            <li> <img src="img/svg_icon/bed.svg" alt=""> <span><?php echo $property->bedrooms ?></span> </li>
                                                            <li> <img src="img/svg_icon/bath.svg" alt=""> <span><?php echo $property->bathrooms ?></span> </li>
                                                        </ul>
                                                        <p><?php echo $property->description ?></p>
                                                        <div class="prise_view_details d-flex justify-content-between align-items-center">
                                                            <span>for <?php echo $property->price ?> /month</span>
                                                            <a class="boxed-btn3-line" href="#">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /home_details  -->
    <!-- counter_area  -->
    <?php
$sql = "SELECT count(*) as num FROM `user` ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$number = $stmt->fetch(PDO::FETCH_OBJ);
?>
    <div class="counter_area"  style="padding-top:10%;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="single_counter">
                        <h3> <span  class="counter" ><?php echo $number->num ?></span> <span>+</span> </h3>
                        <p>total users</p>
                    </div>
                </div>
                <?php
$sql = "SELECT count(*) as num FROM `school` ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$number = $stmt->fetch(PDO::FETCH_OBJ);
?>
                <div class="col-xl-4 col-md-4">
                    <div class="single_counter">
                        <h3> <span class="counter" ><?php echo $number->num ?></span></h3>
                        <p>schools</p>
                    </div>
                </div>
                <?php
$sql = "SELECT count(*) as num FROM `property` ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$number = $stmt->fetch(PDO::FETCH_OBJ);
?>
                <div class="col-xl-4 col-md-4">
                    <div class="single_counter">
                        <h3> <span class="counter" ><?php echo $number->num ?></span></h3>
                        <p>Properties for rent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer start -->
    <?php include 'ressources/footer.php' ?>
    <!--/ footer end  -->
    <!-- link that opens popup -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script>
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- <script src="js/vendor/jquery-1.12.4.min.js"></script> -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/slick.min.js"></script>
    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
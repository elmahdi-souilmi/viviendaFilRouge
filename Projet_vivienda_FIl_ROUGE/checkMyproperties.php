<?php 
// header-end
include 'ressources/header.php';
?>

    <!-- slider_area_start -->
    <div class="bradcam_area bradcam_bg_1">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="bradcam_text text-center">
                                    <h3> your properties</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- slider_area_end -->
    <div class="popular_property ">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h4>4 Properties found</h4>
                    </div>
                </div>
            </div>
            <div class="row"> 
            <?php
        $id = $_SESSION['id'];
$sql = "select * from property where property.idLandlord = $id ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($properties as $property) {?>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <?php 
                 if ($property->idStudent=="") {?>
                     <div class="property_tag" style="background:green;">
                                    availble property
                            </div>
                 <?php  } else {
                                   $sql = "  SELECT user.NeedRoomMate FROM user WHERE user.IdUser = $property->idStudent ";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $pro = $stmt->fetch(PDO::FETCH_OBJ);
                                        // var_dump($property->idStudent); 
                                        //  var_dump($pro->NeedRoomMate)  ; 
                        if($pro->NeedRoomMate == 1) { ?>
                        <div class="property_tag" >
                                    hey i need a roomate
                            </div>

                    <?php   }  if ($pro->NeedRoomMate == 0) {  ?> 
                        <div class="property_tag" style="background:red;">
                                    sorry it unvailble 
                            </div>
                            <?php   } }  ?>
                            <img src="<?php echo $property->Picture ?>" alt="">
                        </div>
                        <div class="property_content">
                            <div class="main_pro">
                                    <h3><a href="../property_details.php?id=<?php echo $property->IdProp  ?>"><?php echo $property->namePro ?> </a></h3>
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
                                            <img src="img/svg_icon/square.svg" alt="">
                                            <span>1200 Sqft</span>
                                        </div>
                                    </li>
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
      </div>
    </div> 

    <!-- contact_action_area  -->
    <div class="contact_action_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-7">
                    <div class="action_heading">
                        <h3>Add your property for sale</h3>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="call_add_action">
                        <span>+10 637 367 4567</span>
                        <a href="#" class="boxed-btn3-line">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /contact_action_area  -->
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
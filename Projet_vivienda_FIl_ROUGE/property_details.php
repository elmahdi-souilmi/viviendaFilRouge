<?php 
// header-end
include 'ressources/header.php';
include 'config/connect.php';

if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $iduser = $_SESSION['id'];
    $idpro = $_GET["id"];
  $sql = " INSERT INTO `comment` (`IdComment`, `dateCom`,`status`, `CmtText`, `IDuser`, `IdProperty`) VALUES (NULL, current_timestamp(),1, '$comment',$iduser, $idpro)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}



$id = $_GET["id"];
$sql = "select * FROM property WHERE IdProp= $id ";
//get result
$stmt = $conn->prepare($sql);
$stmt->execute();
$property = $stmt->fetch(PDO::FETCH_OBJ);
?>
    <!-- header-end -->
         <!-- bradcam_area  -->

        <div class="property_details_banner">
                <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-md-8 col-lg-6">
                                <div class="comfortable_apartment">
                                    <h4> <?php echo $property->namePro ?> </h4>
                                    <p> <img src="img/svg_icon/location.svg" alt=""> <?php echo $property->address ?></p>
                                    <div class="quality_quantity d-flex">
                                        <div class="single_quantity">
                                            <img src="img/svg_icon/color_bed.svg" alt="">
                                            <span><?php echo $property->bedrooms ?></span>
                                        </div>
                                        <div class="single_quantity">
                                            <img src="img/svg_icon/color_bath.svg" alt="">
                                            <span><?php echo $property->bathrooms ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-4 col-lg-6">
                                <div class="prise_quantity">
                                    <h4> <?php echo $property->price ?> DH for month</h4>
                                         <?php 
                                         $sql = "select Email FROM user WHERE IdUser= $property->idLandlord ";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $email = $stmt->fetch(PDO::FETCH_OBJ);
                                        ?>
                                        <button type="button" class="btn btn-primary"  onclick="window.open('mailto:<?php echo $email->Email ?>');" >  <?php echo $email->Email ?> </button>
                                </div>
                            </div>
                        </div>
                </div>
        </div>
            <!--/ bradcam_area  -->
    <!-- details  -->
    <div class="property_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="property_banner">
                        <div class="property_banner_active owl-carousel">
                            <div class="single_property">
                                <img src="<?php echo $property->Picture ?>" alt="">
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="details_info">
                        <h4>Description</h4>
                      <p>
                      <?php echo $property->description ?>
                      </p>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!-- /details  -->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
    <div class="comments-area">
    <?php
$sql = "SELECT count(*) as num FROM `comment` where `IdProperty` = $id and `comment`.`status` = 1 ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$number = $stmt->fetch(PDO::FETCH_OBJ);
?>
        <h4><?php echo $number->num ?>  Comments</h4>
             <?php  
             $sql = "select comment.*, user.Firstname as name,user.LastName as lastname,user.Picture as picture FROM comment,user WHERE user.IDuser= comment.IDuser and comment.IdProperty = $id and comment.status = 1 ";
            //get result
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ); 
            // var_dump($comments);
            foreach ($comments as $comment) {?>
        <div class="comment-list">
           <div class="single-comment justify-content-between d-flex">
              <div class="user justify-content-between d-flex">
                 <div class="thumb">
                    <img src="<?php echo $comment->picture ?>" alt="">
                 </div>
                 <div class="desc">
                    <p class="comment">
                      <?php echo $comment->CmtText  ?>
                    </p>
                    <div class="d-flex justify-content-between">
                       <div class="d-flex align-items-center">
                          <h5>
                             <a ><?php echo $comment->name . " " . $comment->lastname  ?></a>
                          </h5>
                          <p class="date"> <?php echo $comment->dateCom  ?></p>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
            <?php }?>
     <!-- </div> -->

     <div class="comment-form">
        <h4>Leave a Comment</h4>
        <form class="form-contact comment_form" method="POST" action="property_details.php?id=<?php echo $id ?>" id="commentForm">
           <div class="row">
              <div class="col-12">
                 <div class="form-group">
                    <textarea class="form-control w-100" name="comment" id="comment" cols="100" rows="10"
                       placeholder="Write Comment"></textarea>
                 </div>
              </div>
           </div>
           <div class="form-group">
              <button type="submit" name="submit" class="button button-contactForm btn_1 boxed-btn">Send</button>
           </div>
        </form>
     </div>
  </div></div>
    </div>
    </section>

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
                        <a href="#" class="boxed-btn3-line">Add Property</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <!-- /contact_action_area  -->


    <!-- footer start -->
 <?php include 'ressources/footer.php'; ?>
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
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
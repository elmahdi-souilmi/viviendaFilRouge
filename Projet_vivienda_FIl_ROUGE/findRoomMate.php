<?php 
// header-end
include 'ressources/header.php'; ?>
<!-- slider_area_start -->
<div class="bradcam_area bradcam_bg_1">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="bradcam_text text-center">
                                    <h3>Find a room mate</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- slider_area_end -->

<div class="popular_property">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title mb-40 text-center">
                    <h3>Future roommates</h3>
                </div>
            </div>
        </div>
        <div class="row">
        <?php 
$sql = 'select * from user where user.role = "student" and user.NeedRoomMate = 1';
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_OBJ);
// var_dump($properties);
foreach ($students as $student) {?>
<div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <!-- Card Regular -->
<div class="card card-cascade">

<!-- Card image -->
<div class="view view-cascade overlay">
  <img class="card-img-top" src="<?php echo $student->Picture ?>" alt="user image">
  <a>
    <div class="mask rgba-white-slight"></div>
  </a>
</div>

<!-- Card content -->
<div class="card-body card-body-cascade text-center">

  <!-- Title -->
  <h4 class="card-title"><strong><?php echo  $student->FirstName ." ". $student->LastName ?></strong></h4>
  <!-- Subtitle -->
  <h6 class="font-weight-bold indigo-text py-2"><?php echo  $student->role ?></h6>
  <!-- Text -->
  <p class="card-text"> hey friend im <strong> <?php echo  $student->FirstName ." ".  $student->LastName ?></strong>  and im also like i need a roommate i live in <strong><?php echo $student->Adress . " ". $student->city  ?></strong>  if you want to join me contact me by my <br> Email <i class="fas fa-mail-bulk    "></i> : <strong><?php echo $student->Email?>  </strong>  <br> call <i class="fa fa-phone" aria-hidden="true"></i>  : <strong> <?php echo $student->Phone?> </strong> 
  </p>

</div>

</div>
<!-- Card Regular -->
                           </div>
                         </div>
                    </div>
<?php } ?>
 
  
</div>
</div>
 <!-- footer start -->
 <?php include 'ressources/footer.php' ?>
    <!--/ footer end  -->
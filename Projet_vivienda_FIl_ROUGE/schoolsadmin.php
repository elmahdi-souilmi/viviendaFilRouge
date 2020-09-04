<?php
// header-end
include 'ressources/header.php';
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $city = $_POST['city'];
    $id = $_POST['hiden'];
    $picture = $_FILES['image']['name'];
    $target = "picture/" . $picture;
    if ($picture != "") {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE `school` SET `Name` = '$name', `Localisation` = '$city', `pictures` = '$target' WHERE `school`.`IdSchool` = $id;";
    } else {
        $sql = "UPDATE `school` SET `Name` = '$name', `Localisation` = '$city' WHERE `school`.`IdSchool` = $id;";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();

}
?>
    <!-- slider_area_start -->
    <div class="slider_area">
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="slider_text text-center justify-content-center">
                                    <h3>Find your school here </h3>
                                    <p> to see the avalable property near your school</p>
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
                        <h3>Schools</h3>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
$sql = 'select * from school ';
$stmt = $conn->prepare($sql);
$stmt->execute();
$schools = $stmt->fetchAll(PDO::FETCH_OBJ);
// var_dump($properties);
foreach ($schools as $school) {?>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <div class="property_tag">
                               school
                            </div>
                            <img src=" <?php echo $school->pictures ?>" alt="">
                        </div>
                        <div class="property_content">
                            <div class="main_pro">
                                    <h3><a href="#"><?php echo $school->Name ?></a></h3>
                                    <div class="mark_pro">
                                        <img src="img/svg_icon/location.svg" alt="">
                                        <span><?php echo $school->Localisation ?></span>
                                    </div>
                                    <button style="margin-bottom: 4px;" type="button"  onClick="test('<?php echo $school->Name ?>','<?php echo $school->Localisation ?>', '<?php echo $school->IdSchool ?>')"  class="btn btn-outline-primary btn-rounded waves-effect" data-backdrop="static" data-toggle="modal" data-target="#editEmployeeModal">Edit</button>
                                    <a class="btn btn-danger" href="deleteSchool.php?id=<?php echo $school->IdSchool ?>">X</a>
                        </div>
                        </div>
                    </div>
                </div>
<?php }?>
            </div>
        </div>
    </div>
 <!-- modal -->
    <div id="editEmployeeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  action="schoolsadmin.php" method="POST" enctype="multipart/form-data" >
				<div class="modal-header">
					<h4 class="modal-title">Edit schoool</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
				<div class="modal-body">
				<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" id="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" name="city" id="city" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Picture</label>
						<input type="file" name="image" id="image" class="form-control"  >
					</div>
					<div class="form-group">
						<input type="hidden" id="hiden" name="hiden" >
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name="update"  value="save">

				</div>
			</form>
		</div>
	</div>
</div>
        <!-- footer start -->
        <?php include 'ressources/footer.php'?>
         <!--/ footer end  -->

    <!-- link that opens popup -->
    <script>
function test (name, city, id )  {
    console.log(name, city, id );
	document.getElementById("name").value = name ;
    document.getElementById("city").value = city ;
    document.getElementById("hiden").value = id ;
	}
	</script>
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
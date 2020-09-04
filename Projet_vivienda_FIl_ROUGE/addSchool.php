<?php 
// header-end
include 'ressources/header.php';
include 'config/connect.php';
if (isset($_POST['submit'])) {
    $picture = ($_FILES['image']['name']);
    $target = "picture/" . $picture;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $name = $_POST['name'];
    $city = $_POST['city'];
    $picture = $target;
 {
        $sql = " INSERT INTO `school` (`IdSchool`, `Name`, `Localisation`, `pictures`) VALUES (NULL, '$name', '$city', '$picture '); ";}
    $stmt = $conn->prepare($sql);
    $stmt->execute();
     echo ' <script> setTimeout(function () {window.location.href= "schools.php";},100);  </script> ';
}

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
    <center> <form style="width: 70%; background-color: #BFE1F6;" method="POST" enctype="multipart/form-data" class="text-center border border-light p-5" action="addSchool.php" >

<p class="h4 mb-4">Add property</p>
<label> Name </label>
		<input type="text" name="name" id="name" class="form-control"   required>
<div class="form-row mb-4">
    <div class="col">
<div class="form-row mb-4">
    <div class="col">
        <!-- price -->
        <label>City </label>
						<input type="text" name="city" id="city" class="form-control"  required>

    </div>
    <div class="col">
        <!-- picture -->
        <label>Picture</label>
     <div class="input-group">
  <div class="input-group-prepend">

  </div>
  <div class="custom-file">
    <input type="file" name="image" class="custom-file-input" id="image"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Choose Picture</label>
  </div>
</div>
    </div>
</div>


<!-- Sign up button -->
<button class="btn btn-info my-4 btn-block" type="submit"  name="submit">Add</button>

<hr>
</form>
</center>

<?php include 'ressources/footer.php' ?>
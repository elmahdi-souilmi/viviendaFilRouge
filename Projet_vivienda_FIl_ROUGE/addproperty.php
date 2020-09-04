<?php 
// header-end
include 'ressources/header.php';
include 'config/connect.php';
if (isset($_POST['submit'])) {
    $picture = ($_FILES['image']['name']);
    $target = "picture/" . $picture;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $address = $_POST['address'];
    $name = $_POST['name'];
    $bathroom = $_POST['bathroom'];
    $bedrooms = $_POST['bedrooms'];
    $descreption = $_POST['descreption'];
    $distance = $_POST['distance'];
    $localisation = $_POST['localisation'];
    $price = $_POST['price'];
    $landlord = $_SESSION['id'];
    $school = $_POST['school'];
    $student = $_POST["student"];
    $picture = $target;
    if ($student == "") {
        $sql = " INSERT INTO property( `description`, `address`, `distance`,`namePro`, `picture` ,`bedrooms`, `bathrooms`, `localisation`, `price`, `idLandlord`, `Idschool`) VALUES(  '$descreption','$address', $distance, '$name', '$picture', $bedrooms, $bathroom, '$localisation', $price, $landlord, $school) ";
        var_dump($sql);
    } else {
        $sql = " INSERT INTO property( `description`, `address`, `distance`,`namePro`, `picture` , `bedrooms`, `bathrooms`, `localisation`, `price`, `idLandlord`, `Idschool`, `idStudent`) VALUES(  '$descreption','$address', $distance,'$name', '$picture', $bedrooms, $bathroom, '$localisation', $price, $landlord, $school,$student) ";}
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo ' <script> setTimeout(function () {window.location.href= "CheckMyproperties.php";},100);  </script> ';
}

?>
    <!-- slider_area_start -->
    <div class="bradcam_area bradcam_bg_1">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="bradcam_text text-center">
                                    <h3>Add new property</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- slider_area_end -->
    <center> <form style="width: 70%; background-color: #BFE1F6;" method="POST" enctype="multipart/form-data" class="text-center border border-light p-5" action="addproperty.php" >

<p class="h4 mb-4">Add property</p>
<label>  property Name </label>
		<input type="text" name="name" id="name" class="form-control"   required>
<div class="form-row mb-4">
    <div class="col">
        <!-- Address -->
        <label>Address</label>
						<input type="text" name="address" id="address1" class="form-control"  required>
    </div>
    <div class="col">
        <!-- bethroom -->
        <label> bathroom</label>
						<input type="number" name="bathroom" id="bathroom1" class="form-control"  min="1" value="1"  required>
    </div>
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- bedroom -->
        <label> bedrooms</label>
						<input type="number" name="bedrooms" id="bedrooms1" class="form-control"  min="1" value="1" required>
    </div>
    <div class="col">
        <!-- descriprtion -->
        <label>descreption</label>
						<textarea  name="descreption" id="descreption1" class="form-control" required>  </textarea>
    </div>
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- distance -->
        <label>distance from school in km</label>
						<input type="number" name="distance" id="distance1" class="form-control"  min="0" value="0"  required>
    </div>
    <div class="col">
        <!-- city -->
        <label>City</label>
						<input type="text" name="localisation" id="localisation1" class="form-control"    required>
    </div>
</div>

<div class="form-row mb-4">
    <div class="col">
    <label>school near</label>
						<select class="form-control"  name="school" id="school1">
												<?php
$sql = "SELECT school.Name, school.IdSchool FROM school";
$stmt = $conn->prepare($sql);
$stmt->execute();
$schools = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($schools as $school) {?>
					<option value="<?php echo $school->IdSchool ?>"><?php echo $school->Name ?></option>
					<?php }?>

					</select>

    </div>
    <div class="col">
    <label>Student</label>
					<select class="form-control"  name="student" id="student1">
					<option value="" selected>empty</option>
												<?php
$sql = "SELECT user.UserName, user.IdUser from user WHERE user.role='student'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($students as $student) {?>
					<option value="<?php echo $student->IdUser ?>"><?php echo $student->UserName ?></option>
					<?php }?>

					</select>
      
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- price -->
        <label>price (DH) </label>
						<input type="number" name="price" id="price1" class="form-control"  required>

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
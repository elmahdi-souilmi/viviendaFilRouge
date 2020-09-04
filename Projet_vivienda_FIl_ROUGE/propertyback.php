<?php
// connect to datebase
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
    $landlord = $_POST['landlord'];
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
}

if (isset($_POST['update'])) {
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
    $landlord = $_POST['landlord'];
    $school = $_POST['school'];
	$student = $_POST["student"];
	$id = $_POST["hiden"];
    $picture = $target;
    if ($picture != "") {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
	$sql = "UPDATE `property` SET `description` = ' $descreption', `namePro` = '$name', `Picture` = '$picture', `address` = '$address', `distance` = $distance, `bedrooms` = $bedrooms, `bathrooms` = $bathroom, `localisation` = '$localisation', `price` = $price, `Idschool` = $school, `idStudent` = $student WHERE `property`.`IdProp` = $id; ";
	
    } else {
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
		$sql = "UPDATE `property` SET `description` = ' $descreption', `namePro` = '$name',  `address` = '$address', `distance` = $distance, `bedrooms` = $bedrooms, `bathrooms` = $bathroom, `localisation` = '$localisation', `price` = $price, `Idschool` = $school, `idStudent` = $student WHERE `property`.`IdProp` = $id; ";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();

}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>backoffice</title>
  </head>
  <body>
<div class="container-xl">
	<div class="table-responsive" id= "fit-content">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Properties</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="back.php" class="btn btn-primary">back</a>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Landlord</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th> picture </th>
						<th> Adress </th>
						<th> name </th>
						<th> bathrooms</th>
						<th>bedrooms</th>
						<th>description</th>
						<th>distance</th>
						<th> localisation</th>
						<th>price</th>
						<th>landlord</th>
						<th>school near</th>
						<th>Student live in </th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
$sql = 'SELECT property.* ,user.FirstName as landlord, school.Name as school , U.FirstName as student FROM property JOIN user ON user.IdUser = property.idLandlord JOIN school ON school.IdSchool = property.Idschool JOIN user U ON U.IdUser = property.idStudent UNION SELECT property.* ,user.FirstName as landlord, school.Name as school , user.FirstName as student FROM property JOIN user ON user.IdUser = property.idLandlord JOIN school ON school.IdSchool = property.Idschool where property.idStudent IS NULL';
$stmt = $conn->prepare($sql);
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($properties as $property) {?>
					<tr>
						<td> <?php echo '<img src="' . $property->Picture . '" width="140%" />'; ?> </td>
						<td> <?php echo $property->address ?> </td>
						<td> <?php echo $property->namePro ?> </td>
						<td> <?php echo $property->bathrooms ?></td>
						<td> <?php echo $property->bedrooms ?></td>
						<td> <?php echo $property->description ?></td>
						<td> <?php echo $property->distance ?></td>
						<td> <?php echo $property->localisation ?></td>
						<td> <?php echo $property->price ?> </td>
						<td> <?php echo $property->landlord ?> </td>
						<td> <?php echo $property->IdProp ?></td>
						<td> <?php if ($property->idStudent == null) {echo $student = "no one live in it";} else {echo $student = $property->student;}?> </td>
						<input type="hidden" id="custId" name="custId" value="<?php echo $id = $property->IdProp; ?>">
						<td>
						<button style="margin-bottom: 4px;" type="button"   onClick="test('<?php echo $property->address ?>', '<?php echo $property->namePro ?>', '<?php echo $property->bathrooms ?>', '<?php echo $property->bedrooms ?>', '<?php echo $property->description ?>', '<?php echo $property->distance ?>', '<?php echo $property->localisation ?>', '<?php echo $property->price ?>', '<?php echo $property->landlord ?>','<?php echo $property->school ?>','<?php echo $student ?>','<?php echo $id ?>')"  class="btn btn-outline-primary btn-rounded waves-effect" data-backdrop="static" data-toggle="modal" data-target="#editEmployeeModal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></button>
						<a href="./deletePro.php?id=<?php echo $id ?>" class="btn btn-outline-danger btn-rounded waves-effect"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- ADD Modal HTML -->
<div id="addEmployeeModal" class="modal fade" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="propertyback.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Add property</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label> Name </label>
						<input type="text" name="name" id="name" class="form-control"   required>
					</div>
				<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" id="address1" class="form-control"  required>

					</div>

					<div class="form-group">
						<label> bathroom</label>
						<input type="number" name="bathroom" id="bathroom1" class="form-control"  min="1" value="1"  required>

					</div>
					<div class="form-group">
						<label> bedrooms</label>
						<input type="number" name="bedrooms" id="bedrooms1" class="form-control"  min="1" value="1" required>

					</div>
					<div class="form-group">
						<label>descreption</label>
						<textarea  name="descreption" id="descreption1" class="form-control" required>  </textarea>

					</div>
					<div class="form-group">
						<label>distance</label>
						<input type="number" name="distance" id="distance1" class="form-control"  min="0" value="0"  required>

					</div>
					<div class="form-group">
						<label>localisation</label>
						<input type="text" name="localisation" id="localisation1" class="form-control"    required>

					</div>
					<div class="form-group">
						<label>price (DH)  </label>
						<input type="number" name="price" id="price1" class="form-control"  required>

					</div>
					<div class="form-group">
					<label>landlord</label>
					<select class="form-control"  name="landlord" id="landlord1">
					<?php
$sql = "SELECT user.UserName, user.IdUser from user WHERE user.role='landlord'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$landlords = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($landlords as $landlord) {?>
					<option value="<?php echo $landlord->IdUser ?>"><?php echo $landlord->UserName ?></option>
					<?php }?>
					</select>
					</div>
					<div class="form-group">
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
					<div class="form-group">
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
					<div class="form-group">
					<div class="form-group">
						<label>Picture</label>
						<input type="file" name="image" id="image" class="form-control" required>
					</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name="submit"  value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  action="propertyback.php" method="POST" enctype="multipart/form-data" >
				<div class="modal-header">
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
				<div class="modal-body">
				<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" id="address" class="form-control"  required>

					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" id="namee" class="form-control"   required>

					</div>
					<div class="form-group">
						<label> bathroom</label>
						<input type="number" name="bathroom" id="bathroom" class="form-control"  min="1" value="1"  required>

					</div>
					<div class="form-group">
						<label> bedrooms</label>
						<input type="number" name="bedrooms" id="bedrooms" class="form-control"  min="1" value="1" required>

					</div>
					<div class="form-group">
						<label>descreption</label>
						<textarea  name="descreption" id="descreption" class="form-control" required>  </textarea>

					</div>
					<div class="form-group">
						<label>distance</label>
						<input type="number" name="distance" id="distance" class="form-control"  min="0" value="0"  required>

					</div>
					<div class="form-group">
						<label>localisation</label>
						<input type="text" name="localisation" id="localisation" class="form-control"    required>

					</div>
					<div class="form-group">
						<label>price (DH)  </label>
						<input type="number" name="price" id="price" class="form-control"  required>

					</div>
					<div class="form-group">
					<label>landlord</label>
					<select class="form-control"  name="landlord" id="landlord">
					<?php
$sql = "SELECT user.UserName, user.IdUser from user WHERE user.role='landlord'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$landlords = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($landlords as $landlord) {?>
					<option value="<?php echo $landlord->IdUser ?>"><?php echo $landlord->UserName ?></option>
					<?php }?>
					</select>
					</div>
					<div class="form-group">
						<label>school near</label>
						<select class="form-control"  name="school" id="school">
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
					<div class="form-group">
					<label>Student</label>
					<select class="form-control"  name="student" id="student">
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
					<div class="form-group">
						<input type="hidden" id="hiden" name="hiden" >">
					</div>
					<div class="form-group">
						<label>Picture</label>
						<input type="file" name="image" id="image" class="form-control"  >
					</div>
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
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
function test (addresse, name, bathrooms, bedrooms, description, distance, localisation, price, landlord, school, student , id )  {
    console.log(addresse, name, bathrooms, bedrooms, description, distance, localisation, price, landlord, school, student , id  );
	document.getElementById("address").value = addresse ;
	document.getElementById("namee").value = name ;
    document.getElementById("bathroom").value = bathrooms ;
    document.getElementById("bedrooms").value = bedrooms ;
	document.getElementById("descreption").value = description ;
    document.getElementById("distance").value = distance ;
	document.getElementById("localisation").value = localisation ;
    document.getElementById("price").value = price ;
	document.getElementById("landlord").value = landlord ;
	document.getElementById("school").value = school ;
	document.getElementById("student").value = student ;
	document.getElementById("hiden").value = id ;
	};
	</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
  </body>
</html>
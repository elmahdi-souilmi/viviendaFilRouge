<?php
// connect to datebase
include 'config/connect.php';
// array to stock the exepting error
$errors = ['username' => '', 'first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '', 'password' => '', 'picture' => '', 'city' => '', 'address' => ''];
// varaibles
$username = "";
$first_name = "";
$last_name = "";
$phone = "";
$email = "";
$password = "";
$photo = "";
$city = "";
$Adress = "";

if (isset($_POST['submit'])) {
    $picture = ($_FILES['image']['name']);
    $target = "picture/" . $picture;
    // validation form
    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email not VALID';
        }
    }
    // check first_name
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = 'title is required <br/>';
    } else {
        $first_name = $_POST['firstname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
            $errors['first_name'] = 'first name must be letters and spaces only';
        }
    }
    //check phone number
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'phone is required <br/>';
    } else {
        $phone = $_POST['phone'];
        if (!preg_match('/\+?([0-9]{2})-?([0-9]{3})-?([0-9]{6,7})/', $phone)) {
			$errors['phone'] = 'phone must be  + and number only';
			$phone = "";
        }
    }
    // check last_name
    if (empty($_POST['lastname'])) {
        $errors['last_name'] = 'last name is required <br/>';
    } else {
        $last_name = $_POST['lastname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
            $errors['lastname'] = 'last name must be letters and spaces only';
        }
    }
    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'username is required <br/>';
    } else {
        $username = $_POST['username'];
    }
    // check city
    if (empty($_POST['city'])) {
        $errors['city'] = 'city is required <br/>';
    } else {
        $city = $_POST['city'];
    }
    // check adress
    if (empty($_POST['address'])) {
        $errors['adress'] = 'adress is required <br/>';
    } else {
        $Adress = $_POST['address'];
    }
    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'password is required <br/>';
    } else {
        $title = $_POST['password'];
        if (!preg_match('/^(?=.*\d).{8,20}$/', $title)) {
            $errors['password'] = 'Password must be between 8 and 20 digits long and include at least one numeric digi';
        }
    }
    // check if the email is already used
    $email = $_POST['email'];
    $sql = " SELECT * FROM user WHERE Email = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
     echo $usercount = $stmt->rowCount();
    if ($usercount >= 1) {
        $errors['email'] = 'email is already used <br/>';
	}
	
    if (array_filter($errors)) {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
        echo "<script type='text/javascript'>
	 $(document).ready(function(){
	 $('#addEmployeeModal').modal('show');
	 });
	 </script>";

    } else {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $role = "landlord";
        $picture = $target;
        $sql = " INSERT INTO user(FirstName, LastName, Phone, UserName, Password, Email, Adress, City, role, picture) VALUES( '$first_name', '$last_name', '$phone', '$username', '$password', '$email', '$address', '$city', '$role','$picture' ) ";
        $stmt = $conn->prepare($sql);
		$stmt->execute();
		$username = "";
		$first_name = "";
		$last_name = "";
		$phone = "";
		$email = "";
		$password = "";
		$photo = "";
		$city = "";
		$Adress = "";
    }
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $id = $_POST['hiden'];
    $picture = $_FILES['image']['name'];
    $target = "picture/" . $picture;
    if ($picture != "") {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE user SET FirstName = '$firstname', LastName= '$lastname', Phone= '$phone', UserName= '$username', Password= '$password', Email= '$email', Adress= '$address' , City= '$city',picture='$target'  WHERE IdUser = $id ";
    } else {
        $sql = "UPDATE user SET FirstName = '$firstname', LastName= '$lastname', Phone= '$phone', UserName= '$username', Password= '$password', Email= '$email', Adress= '$address' , City= '$city'  WHERE IdUser = $id ";
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
						<h2>Manage <b>Landlord</b></h2>
					</div>
					<div class="col-sm-6">
					<a href="back.php" class="btn btn-primary">Back</a>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Landlord</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Picture</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Phone</th>
						<th>user name</th>
						<th>PassWord</th>
						<th>Email</th>
						<th>Address</th>
						<th>city</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
$sql = "SELECT * FROM user where role = 'landlord'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$landlords = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($landlords as $landlord) {?>
					<tr>
						<td> <?php echo '<img src="' . $landlord->Picture . '" width="140%" />'; ?> </td>
						<td> <?php echo $firstNamee = $landlord->FirstName ?></td>
						<td> <?php echo $LastNamee = $landlord->LastName ?></td>
						<td> <?php echo $phonee = $landlord->Phone ?></td>
						<td> <?php echo $usernamee = $landlord->UserName ?></td>
						<td> <?php echo $passe = $landlord->Password ?> </td>
						<td> <?php echo $emaile = $landlord->Email ?> </td>
						<td> <?php echo $Adresse = $landlord->Adress ?></td>
						<td> <?php echo $citye = $landlord->city ?> </td>
						<input type="hidden" id="custId" name="custId" value="<?php echo $id = $landlord->IdUser; ?>">
						<td>
						<button style="margin-bottom: 4px;" type="button"   onClick="test('<?php echo $firstNamee ?>','<?php echo $LastNamee ?>', '<?php echo $phonee ?>', '<?php echo $usernamee ?>', '<?php echo $passe ?>', '<?php echo $emaile ?>', '<?php echo $Adresse ?>', '<?php echo $citye ?>','<?php echo $id ?>','<?php echo $landlord->Picture ?>')"  class="btn btn-outline-primary btn-rounded waves-effect" data-backdrop="static" data-toggle="modal" data-target="#editEmployeeModal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></button>
						<a href="../deleteUser.php?id=<?php echo $id ?>" class="btn btn-outline-danger btn-rounded waves-effect"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
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
			<form action="landlord.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Add Landlord</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				<div class="form-group">
						<label>UserName</label>
						<input type="text" name="username" id="usernameA" class="form-control"  value="<?php echo $username ?> "   required>
						<p class="error" ><?php echo $errors['username'] ?> </p>
					</div>
					<div class="form-group">
						<label> First Name</label>
						<input type="text" name="firstname" id="firstnameA" class="form-control" value="<?php echo $first_name ?> "  required>
						<p><?php echo $errors['first_name'] ?> </p>
					</div>
					<div class="form-group">
						<label> Last Name</label>
						<input type="text" name="lastname" id="lastnameA" class="form-control" value="<?php echo $last_name ?> "  required>
						<p class="error"><?php echo $errors['last_name'] ?> </p>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="emailA" class="form-control" value="<?php echo $email ?> "  required>
						<p class="error"><?php echo $errors['email'] ?> </p>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" id="passwordA" class="form-control"    required>
						<p class="error"><?php echo $errors['password'] ?> </p>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea  name="address" id="addressA" class="form-control" required> <?php echo $Adress ?> </textarea>
						<p class="error"><?php echo $errors['address'] ?> </p>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" id="phoneA" class="form-control" value="<?php echo $phone ?> "  required>
						<p class="error"><?php echo $errors['phone'] ?> </p>
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" name="city" id="cityA" class="form-control" value="<?php echo $city ?> "  required>
						<p class="error"><?php echo $errors['city'] ?> </p>
					</div>
					<div class="form-group">
						<label>Picture</label>
						<input type="file" name="image" id="image" class="form-control" required>
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
			<form  action="landlord.php" method="POST" enctype="multipart/form-data" >
				<div class="modal-header">
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
				<div class="modal-body">
				<div class="form-group">
						<label>UserName</label>
						<input type="text" name="username" id="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label> First Name</label>
						<input type="text" name="firstname" id="firstname" class="form-control" required>
					</div>
					<div class="form-group">
						<label> Last Name</label>
						<input type="text" name="lastname" id="lastname" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" id="pass" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea  name="address" id="adress" class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" id="phone" class="form-control" required>
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
						<input type="hidden" id="hiden" name="hiden" value="<?php echo $id = $landlord->IdUser; ?>">
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
function test(firstname, lastname, phone, username, pass, email, adress, city, id, picture){
    console.log(firstname, lastname, phone, username, pass, email, adress, city, picture );
    document.getElementById("firstname").value =  firstname;
    document.getElementById("lastname").value =  lastname;
    document.getElementById("phone").value =  phone;
	document.getElementById("username").value =  username;
    document.getElementById("pass").value =  pass;
	document.getElementById("email").value =  email;
    document.getElementById("adress").value =  adress;
	document.getElementById("city").value =  city;
	document.getElementById("hiden").value =  id;
	document.getElementById("image").value = picture;};
	</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
  </body>
</html>
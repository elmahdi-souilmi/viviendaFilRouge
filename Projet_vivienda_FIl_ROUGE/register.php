

<?php
// header-end
  include 'ressources/header.php';
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
$welcome=" sing in ";
$registred = "register to use our website ";

if (isset($_POST['submit'])) {
    $picture = ($_FILES['image']['name']);
    $target = "fil_rouge_backoffic/picture/" . $picture;
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
    $usercount = $stmt->rowCount();
    if ($usercount >= 1) {
        $errors['email'] = 'email is already used <br/>';
    }

    if (array_filter($errors)) {
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
        $mate = $_POST['mate'];
        $role = $_POST['user'];;
        $picture = $target;
        $sql = " INSERT INTO user(FirstName, LastName, Phone, UserName, Password, Email, Adress, City, role, NeedRoomMate, picture) VALUES( '$first_name', '$last_name', '$phone', '$username', '$password', '$email', '$address', '$city', '$role',$mate,'$picture' ) ";
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
        $welcome=" welcome";
        $registred = "you are now one of us welcome you will be rederected after 2 seconds to login with your information";
        // header( "refresh:2;url=login.php" ); 
        echo ' <script> setTimeout(function () {window.location.href= "login.php";},2000);  </script> ';
    }
      
}
?>

    <!-- slider_area_start -->
    <div class="slider_area">
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="slider_text text-center justify-content-center">
                                    <h3><?php echo $welcome ?> </h3>
                                    <p><?php echo $registred ?></p>
                                </div>
                            </div>
                        </div>
                  </div>
            </div>
    </div>

<center> <form style="width: 70%; background-color: #BFE1F6;" method="POST" enctype="multipart/form-data" class="text-center border border-light p-5" action="register.php" >

<p class="h4 mb-4">Register</p>
<label> register  as  </label>
<select class="form-control" onchange="change()" name="user" id="user" class="form-control" placeholder="sing up as">
							<option value="Student"> Student </option>
							<option value="Landlord "> Landlord </option>
						</select>
<div class="form-row mb-4">
    <div class="col">
        <!-- user name -->
        <label>UserName</label>
						<input type="text" name="username" id="usernameA" class="form-control"  value="<?php echo $username ?> "   required>
						<p class="error" ><?php echo $errors['username'] ?> </p>
    </div>
    <div class="col">
        <!-- first name -->
        <label> First Name</label>
						<input type="text" name="firstname" id="firstnameA" class="form-control" value="<?php echo $first_name ?> "  required>
						<p><?php echo $errors['first_name'] ?> </p>
    </div>
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- Last name -->
        <label> Last Name</label>
						<input type="text" name="lastname" id="lastnameA" class="form-control" value="<?php echo $last_name ?> "  required>
						<p class="error"><?php echo $errors['last_name'] ?> </p>
    </div>
    <div class="col">
        <!-- phone -->
        <label>Phone</label>
						<input type="text" name="phone" id="phoneA" class="form-control" value="<?php echo $phone ?> "  required>
						<p class="error"><?php echo $errors['phone'] ?> </p>
    </div>
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- email -->
        <label>Email</label>
						<input type="email" name="email" id="emailA" class="form-control" value="<?php echo $email ?> "  required>
						<p class="error"><?php echo $errors['email'] ?> </p>
    </div>
    <div class="col">
        <!-- passWord -->
<label>Password</label>
						<input type="password" name="password" id="passwordA" class="form-control"    required>
						<p class="error"><?php echo $errors['password'] ?> </p>
<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
    At least 8 characters and 1 digit
</small>
    </div>
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- Address -->
        <label>Address</label>
						<textarea  name="address" id="addressA" class="form-control" required> <?php echo $Adress ?> </textarea>
						<p class="error"><?php echo $errors['address'] ?> </p>

    </div>
    <div class="col">
        <!-- city -->
        <label>City</label>
						<input type="text" name="city" id="cityA" class="form-control" value="<?php echo $city ?> "  required>
					<p class="error"><?php echo $errors['city'] ?> </p>
    </div>
</div>
<div class="form-row mb-4">
    <div class="col">
        <!-- room ate -->
        <label id="mate_l" >Need a room mate </label>
						<select class="form-control"  name="mate" id="mate">
							<option value="0">NO </option>
							<option value="1"> YES </option>
						</select>

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
<button class="btn btn-info my-4 btn-block" type="submit"  name="submit">Register</button>

<!-- Social register -->


<hr>

<!-- Terms of service -->
<p>By clicking
    <em>Sign up</em> you agree to our
    <a href="policy.php" target="_blank">terms of service</a>

</form>
</center>
<!-- Default form register -->

    <!-- footer start -->
    <?php include 'ressources/footer.php'?>
    <!--/ footer end  -->

    <!-- link that opens popup -->

        <script>
    function change() {
        var val=document.getElementById("user").value;
        console.log(val)
        if(val=="landlord"){
            console.log("moldar")
            document.getElementById("mate").style.display = 'none';
            document.getElementById("mate_l").style.display = 'none';
        }
        if(val=="Student"){
            document.getElementById("mate").style.display = 'block';
            
        }
    }
    </script>

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


</body>

</html>
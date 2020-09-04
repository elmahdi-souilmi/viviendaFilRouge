
 <!doctype html>
<html class="no-js" lang="zxx"><head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Real state</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- CSS here -->
    <!-- <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>
<body>
<header>
<?php  include 'config/connect.php';
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
         if (isset($_SESSION['id'])) {   
        
        $sql = 'SELECT * FROM user where IdUser = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $_SESSION['id']]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        
            ?> 
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                <?php 
                                     if ($user->role == "student") { ?>
                                     <!-- student -->
                                        <nav>
                                        <ul id="navigation">
                                            <li><a  href="index.php">home</a></li>
                                            <li><a href="schools.php">schools </a>
                                            </li>
                                            <li><a href="Property.php">Property<i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                        <li><a href="FindRoomMate.php">Find a room mate </a></li>

                                                </ul>
                                            </li>
                                            <li><a href="contact.php">Contact</a></li>
                                            <li><a href="about.php">About US</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                                    <?php }  if ($user->role == "landlord"){?>
                                        <!-- landlord -->
                                        <nav>
                                        <ul id="navigation">
                                            <li><a  href="index.php">home</a></li>
                                            <li><a href="schools.php">schools </a>
                                            </li>
                                            <li><a href="Property.php">Property<i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                        <li><a href="checkMyproperties.php">see your proprerty </a></li>
                                                        <li><a href="addproperty.php">add new property </a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.php">Contact</a></li>
                                            <li><a href="about.php">About US</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                                    <?php } if ($user->role == "admin"){ ?>
                                <!-- if admine  -->
                                    <nav>
                                        <ul id="navigation">
                                            <li><a  href="index.php">home</a></li>
                                            <li><a href="schoolsadmin.php">schools <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                        <li><a href="addSchool.php">Add school </a></li>
                                                </ul>
                                            </li>
                                            <li><a href="indexback.php">Back office</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                                    <?php } ?>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="search_btn">
                                      <a href ="logout.php"><i class="fa fa-sign-out" aria-hidden="true"> Log out</i> </a>
                                    </div>
                                    <div class="book_btn d-none d-lg-block">
                                        <a  href="login.php">hello <?php echo $user->FirstName ?> </a>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </header>
   <?php } else {?>
         <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                     <!-- student -->
                                        <nav>
                                        <ul id="navigation">
                                            <li><a  href="index.php">home</a></li>
                                            <li><a href="#">schools </a>
                                            </li>
                                            <li><a href="Property.php">Property</a>
                                            </li>
                                            <li><a href="contact.php">Contact</a></li>
                                            <li><a href="contact.php">About US</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="search_btn">
                                    </div>
                                    <div class="book_btn d-none d-lg-block">
                                        <a  href="login.php"> sing up  </a>
                                        <a  href="register.php"> register </a>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </header>
     <?php } ?>
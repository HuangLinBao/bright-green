<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>

<?php
$sql = null;
$errFlag = null;

console_log("hi");
$first_name = trim($_POST['firstName']);
$last_name = trim($_POST['lastName']);
$full_name = $first_name . " " . $last_name;
console_log($first_name);
console_log($last_name);
console_log($full_name);
$username = trim($_POST['username']);
$birthday = trim($_POST['birthday']);
$age = calculateAge($birthday);
$gender = trim($_POST['gender']);
console_log($username);
console_log($birthday);
console_log($age);
console_log($gender);
$role = trim($_POST['role']);
$email = trim($_POST['email']);
$phone_Num = trim($_POST['phone']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);
console_log($role);
console_log($email);
console_log($phone_Num);
console_log($password);
console_log($confirm_password);
$office = trim($_POST['office']);
$salary = trim($_POST['salary']) . "AED";
$position = trim($_POST['position']);
console_log($office);
console_log($salary);
console_log($position);
$start_date = $today;
console_log($start_date);

$sql = "SELECT * FROM `employees` ";
$stmt = $pdo->prepare($sql);
$stmt->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css" integrity="sha512-yJHCxhu8pTR7P2UgXFrHvLMniOAL5ET1f5Cj+/dzl+JIlGTh5Cz+IeklcXzMavKvXP8vXqKMQyZjscjf3ZDfGA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/5aca499382.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.js" integrity="sha512-sww7U197vVXpRSffZdqfpqDU2SNoFvINLX4mXt1D6ZecxkhwcHmLj3QcL2cJ/aCxrTkUcaAa6EGmPK3Nfitygw==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@barba/core"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="dashStyle.css">
    <title>Dashboard</title>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="dashboard.html">Bright Green</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <?php
                if (isset($_SESSION['login'])) { ?>
                    <?php
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link">';
                    echo '<i class="fas fa-user-circle"></i>';
                    echo "<span class='nav-link-text'> Welcome Back {$_SESSION['full_name']}</span>";
                    echo '</a>';
                    echo '</li>';
                    ?>
                <?php } ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Account">
                    <a class="nav-link" data-toggle="modal" data-target="#signUpModal">
                        <i class="fas fa-user-plus"></i>
                        <span class="nav-link-text">Create Account</span>
                    </a>

                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Stats">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-chart-line"></i>
                        <span class="nav-link-text">Stats</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-wrench"></i>
                        <span class="nav-link-text">Components</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a href="navbar.html">Edit cards</a>
                        </li>
                        <li>
                            <a style="cursor:pointer;" data-toggle="modal" data-target="#uploadModal">Add a new card</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="See Tasks">
                    <a class="nav-link" href="#">
                        <i class="fas fa-tasks"></i>
                        <span class="nav-link-text">See tasks</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i>
                        <span class="d-lg-none">Messages
                            <span class="badge badge-pill badge-primary">12 New</span>
                        </span>
                        <span class="indicator text-primary d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="d-lg-none">Alerts
                            <span class="badge badge-pill badge-warning">6 New</span>
                        </span>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">New Alerts:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-danger">
                                <strong>
                                    <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all alerts</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">26 New Messages!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">11 New Tasks!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5">123 New Orders!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Area Chart Example
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <!-- Example Bar Chart Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-bar-chart"></i> Bar Chart Example
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8 my-auto">
                                    <canvas id="myBarChart" width="100" height="50"></canvas>
                                </div>
                                <div class="col-sm-4 text-center my-auto">
                                    <div class="h4 mb-0 text-primary">$34,693</div>
                                    <div class="small text-muted">YTD Revenue</div>
                                    <hr>
                                    <div class="h4 mb-0 text-warning">$18,474</div>
                                    <div class="small text-muted">YTD Expenses</div>
                                    <hr>
                                    <div class="h4 mb-0 text-success">$16,219</div>
                                    <div class="small text-muted">YTD Margin</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                    <!-- Card Columns Example Social Feed-->
                    <div class="mb-0 mt-4">
                        <i class="fa fa-newspaper-o"></i> News Feed
                    </div>
                    <hr class="mt-2">
                    <div class="card-columns">
                        <!-- Example Social Card-->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=610" alt="">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title mb-1"><a href="#">David Miller</a></h6>
                                <p class="card-text small">These waves are looking pretty good today!
                                    <a href="#">#surfsup</a>
                                </p>
                            </div>
                            <hr class="my-0">
                            <div class="card-body py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i>Comment</a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i>Share</a>
                            </div>
                            <hr class="my-0">
                            <div class="card-body small bg-faded">
                                <div class="media">
                                    <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6>Very nice! I wish I was there! That looks amazing!
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="#">Like</a>
                                            </li>
                                            <li class="list-inline-item">·</li>
                                            <li class="list-inline-item">
                                                <a href="#">Reply</a>
                                            </li>
                                        </ul>
                                        <div class="media mt-3">
                                            <a class="d-flex pr-3" href="#">
                                                <img src="http://placehold.it/45x45" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1"><a href="#">David Miller</a></h6>Next time for sure!
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="#">Like</a>
                                                    </li>
                                                    <li class="list-inline-item">·</li>
                                                    <li class="list-inline-item">
                                                        <a href="#">Reply</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Posted 32 mins ago</div>
                        </div>
                        <!-- Example Social Card-->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=180" alt="">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title mb-1"><a href="#">John Smith</a></h6>
                                <p class="card-text small">Another day at the office...
                                    <a href="#">#workinghardorhardlyworking</a>
                                </p>
                            </div>
                            <hr class="my-0">
                            <div class="card-body py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i>Comment</a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i>Share</a>
                            </div>
                            <hr class="my-0">
                            <div class="card-body small bg-faded">
                                <div class="media">
                                    <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><a href="#">Jessy Lucas</a></h6>Where did you get that camera?! I want one!
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="#">Like</a>
                                            </li>
                                            <li class="list-inline-item">·</li>
                                            <li class="list-inline-item">
                                                <a href="#">Reply</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Posted 46 mins ago</div>
                        </div>
                        <!-- Example Social Card-->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=281" alt="">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title mb-1"><a href="#">Jeffery Wellings</a></h6>
                                <p class="card-text small">Nice shot from the skate park!
                                    <a href="#">#kickflip</a>
                                    <a href="#">#holdmybeer</a>
                                    <a href="#">#igotthis</a>
                                </p>
                            </div>
                            <hr class="my-0">
                            <div class="card-body py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i>Comment</a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i>Share</a>
                            </div>
                            <div class="card-footer small text-muted">Posted 1 hr ago</div>
                        </div>
                        <!-- Example Social Card-->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=185" alt="">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title mb-1"><a href="#">David Miller</a></h6>
                                <p class="card-text small">It's hot, and I might be lost...
                                    <a href="#">#desert</a>
                                    <a href="#">#water</a>
                                    <a href="#">#anyonehavesomewater</a>
                                    <a href="#">#noreally</a>
                                    <a href="#">#thirsty</a>
                                    <a href="#">#dehydration</a>
                                </p>
                            </div>
                            <hr class="my-0">
                            <div class="card-body py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i>Comment</a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i>Share</a>
                            </div>
                            <hr class="my-0">
                            <div class="card-body small bg-faded">
                                <div class="media">
                                    <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6>The oasis is a mile that way, or is that just a mirage?
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="#">Like</a>
                                            </li>
                                            <li class="list-inline-item">·</li>
                                            <li class="list-inline-item">
                                                <a href="#">Reply</a>
                                            </li>
                                        </ul>
                                        <div class="media mt-3">
                                            <a class="d-flex pr-3" href="#">
                                                <img src="http://placehold.it/45x45" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1"><a href="#">David Miller</a></h6>
                                                <img class="img-fluid w-100 mb-1" src="https://unsplash.it/700/450?image=789" alt="">I'm saved, I found a cactus. How do I open this thing?
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="#">Like</a>
                                                    </li>
                                                    <li class="list-inline-item">·</li>
                                                    <li class="list-inline-item">
                                                        <a href="#">Reply</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Posted yesterday</div>
                        </div>
                    </div>
                    <!-- /Card Columns-->
                </div>
                <div class="col-lg-4">
                    <!-- Example Pie Chart Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-pie-chart"></i> Pie Chart Example
                        </div>
                        <div class="card-body">
                            <canvas id="myPieChart" width="100%" height="100"></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                    <!-- Example Notifications Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-bell-o"></i> Feed Example
                        </div>
                        <div class="list-group list-group-flush small">
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <strong>David Miller</strong>posted a new article to
                                        <strong>David Miller Website</strong>.
                                        <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <strong>Samantha King</strong>sent you a new message!
                                        <div class="text-muted smaller">Today at 4:37 PM - 1hr ago</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <strong>Jeffery Wellings</strong>added a new photo to the album
                                        <strong>Beach</strong>.
                                        <div class="text-muted smaller">Today at 4:31 PM - 1hr ago</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <i class="fa fa-code-fork"></i>
                                        <strong>Monica Dennis</strong>forked the
                                        <strong>startbootstrap-sb-admin</strong>repository on
                                        <strong>GitHub</strong>.
                                        <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
            </div>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Data Table Example
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>phone number</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>phone number</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $post['emp_full_name']; ?></td>
                                        <td><?php echo $post['position']; ?></td>
                                        <td><?php echo $post['office']; ?></td>
                                        <td><?php echo $post['age']; ?></td>
                                        <td><?php echo $post['start_date']; ?></td>
                                        <td><?php echo $post['salary']; ?></td>
                                        <td><?php echo $post['gender']; ?></td>
                                        <td><?php echo $post['email']; ?></td>
                                        <td><?php echo $post['phone_number']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright © Bright Green Future Lighting 2018</small>
                </div>
            </div>
        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="wrapper wrapper--w780">
                            <div class="card card-3">
                                <div class="card-heading"></div>
                                <div class="card-body">
                                    <h2 class="title">Registration Info</h2>
                                    <form action="redirect.php" method="POST">
                                        <?php
                                        if (isset($errFlag)) {
                                            echo "<p>error. invalid_credentials</p>";
                                        }
                                        ?>
                                        <div class="input-group">
                                            <input class="input--style-3" type="text" placeholder="First Name" name="firstName">
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="text" placeholder="Last Name" name="lastName">
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="text" placeholder="Username" name="username">
                                        </div>
                                        <div class=" input-group">
                                            <input class="input--style-3 js-datepicker" type="text" placeholder="Birthdate" name="birthday">
                                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                        </div>
                                        <div class="input-group">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                                <select name="gender">
                                                    <option value="" class="genderChoice" disabled="disabled" selected="selected">Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>

                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                                <select name="role">
                                                    <option value="" class="roleChoice" disabled="disabled" selected="selected">Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Employee">Employee</option>

                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="email" placeholder="Email" name="email">
                                        </div>
                                        <div class="input-group">
                                            <input id="phone" class="input--style-3" type="tel" name="phone">
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="password" placeholder="Create Password" name="password">
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="password" placeholder="Confirm Password" name="confirm_password">
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="text" placeholder="Office" name="office">
                                        </div>
                                        <div class="input-group">
                                            <input id="slaray" class="input--style-3" type="text" placeholder="Salary" name="salary">
                                        </div>
                                        <div class="input-group">
                                            <input class="input--style-3" type="text" placeholder="Position" name="position">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Create</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="addPic.php" , method="POST" enctype="multipart/form-data">

                        <div class="modal-header">
                            <h5 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" class="modal-title" id="exampleModalLongTitle">Add A Card</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input name="img[]" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Name" name="name">
                            </div>
                            <div class="input-group">
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select id="type" name="type">
                                        <option value="" class="roleChoice" disabled="disabled" selected="selected">type</option>
                                        <option value="product">Product</option>
                                        <option value="project">Project</option>

                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select id="category" name="category">
                                        <option value="" class="roleChoice" disabled="disabled" selected="selected"> --Category-- </option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                            </div>
                    </form>
                </div>
                </form>
            </div>
        </div>


</body>
<script src="dashScript.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js" integrity="sha512-SvgzybymTn9KvnNGu0HxXiGoNeOi0TTK7viiG0EGn2Qbeu/NFi3JdWrJs2JHiGA1Lph+dxiDv5F9gDlcgBzjfA==" crossorigin="anonymous"></script>
<script src="popUp.js"></script>
<link rel="stylesheet" href="signup.css">

</html>

<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "ae",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });





    var cleave = new Cleave('#slaray', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function() {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function() {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
</script>
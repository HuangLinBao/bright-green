<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>

<?php


$sql = "SELECT * FROM `employees` ";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$msgsql = "SELECT * FROM `messages` WHERE `state`= :state ";
$msgstmt = $pdo->prepare($msgsql);
$msgstmt->execute([':state' => 0]);
$count = $msgstmt->rowCount();

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
    <title>Messages</title>
    <style>
        body {

            background-color: #f1f2f6;
            margin-top: 20px;
        }

        @media (min-width: 992px) {
            .inbox-wrapper .email-aside .aside-content {
                padding-right: 10px;
            }
        }

        .inbox-wrapper .email-aside .aside-content .aside-header {
            padding: 0 0 5px;
            position: relative;
        }



        .inbox-wrapper .email-aside .aside-content .aside-header .title {
            display: block;
            margin: 3px 0 0;
            font-size: 1.1rem;
            line-height: 27px;
            color: #2f3542;
        }

        .inbox-wrapper .email-aside .aside-content .aside-header .navbar-toggle {
            background: 0 0;
            display: none;
            outline: 0;
            border: 0;
            padding: 0 11px 0 0;
            text-align: right;
            margin: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: absolute;
        }

        @media (max-width: 991px) {
            .inbox-wrapper .email-aside .aside-content .aside-header .navbar-toggle {
                display: block;
            }
        }

        .inbox-wrapper .email-aside .aside-content .aside-header .navbar-toggle .icon {
            font-size: 24px;
            color: #a4b0be;
        }

        .inbox-wrapper .email-aside .aside-content .aside-compose {
            text-align: center;
            padding: 14px 0;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav {
            visibility: visible;
            padding: 0 0;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav.collapse {
            display: block;
        }

        @media (max-width: 991px) {
            .inbox-wrapper .email-aside .aside-content .aside-nav.collapse {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .inbox-wrapper .email-aside .aside-content .aside-nav.show {
                display: block;
            }
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .title {
            display: block;
            color: #57606f;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 20px 0 0;
            padding: 8px 14px 4px;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .nav li {
            width: 100%;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .nav li a {
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
            position: relative;
            color: #747d8c;
            padding: 7px 14px;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .nav li a:hover {
            text-decoration: none;
            background-color: rgba(69, 175, 13, 0.3);
            color: #45af0d;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .nav li a .badge {
            margin-left: auto;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .nav li a svg {
            width: 18px;
            margin-right: 10px;
        }

        .inbox-wrapper .email-aside .aside-content .aside-nav .nav li a {
            border-radius: 3px;
            color: #45af0d;
            background: rgba(69, 175, 13, 0.5);
        }

        .inbox-wrapper .email-content .email-inbox-header .email-title {
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
            font-size: 1rem;
        }

        .inbox-wrapper .email-content .email-filters {
            padding: 20px;
            border-bottom: 1px solid #e8ebf1;
            background-color: transparent;
            width: 100%;
            border-top: 1px solid #e8ebf1;
        }

        .inbox-wrapper .email-content .email-filters>div {
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
        }

        .inbox-wrapper .email-content .email-filters .email-filters-left input {
            margin-right: 8px;
        }

        .inbox-wrapper .email-content .email-filters .email-filters-right {
            text-align: right;
        }

        @media (max-width: 767px) {
            .inbox-wrapper .email-content .email-filters .email-filters-right {
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
        }

        .inbox-wrapper .email-content .email-filters .email-filters-right .email-pagination-indicator {
            display: inline-block;
            vertical-align: middle;
            margin-right: 13px;
        }

        .inbox-wrapper .email-content .email-list .email-list-item {
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
            border-bottom: 1px solid #f1f2f6;
            padding: 10px 20px;
            width: 100%;
            cursor: pointer;
            position: relative;
            font-size: 14px;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        .inbox-wrapper .email-content .email-list .email-list-item:hover {
            background: rgba(114, 124, 245, 0.08);
        }

        .inbox-wrapper .email-content .email-list .email-list-item:last-child {
            margin-bottom: 5px;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-actions {
            width: 40px;
            vertical-align: top;
            display: table-cell;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-actions .form-check {
            margin-bottom: 0;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-actions .form-check i::before {
            width: 15px;
            height: 15px;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-actions .form-check i::after {
            font-size: .8rem;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-actions .favorite {
            display: block;
            padding-left: 1px;
            line-height: 15px;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-detail {
            display: -webkit-flex;
            display: flex;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            -webkit-flex-grow: 1;
            flex-grow: 1;
            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-detail .from {
            display: block;
            font-weight: 400;
            margin: 0 0 1px 0;
            color: #2f3542;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-detail .msg {
            margin: 0;
            color: #71738d;
            font-size: .8rem;
        }

        .inbox-wrapper .email-content .email-list .email-list-item .email-list-detail .date {
            color: #2f3542;
        }


        .inbox-wrapper .email-content .email-list .email-list-item.email-list-item--unread {
            background-color: rgba(114, 124, 245, 0.09);
        }

        .inbox-wrapper .email-content .email-list .email-list-item.email-list-item--unread .from {
            color: #2f3542;
            font-weight: 800;
        }

        .inbox-wrapper .email-content .email-list .email-list-item.email-list-item--unread .msg {
            font-weight: 700;
            color: #a4b0be;
        }

        .rtl .inbox-wrapper .email-aside .aside-content .aside-header .navbar-toggle .icon {
            position: absolute;
            top: 0;
            left: 0;
        }

        .rtl .inbox-wrapper .email-aside .aside-content .aside-nav .nav {
            padding-right: 0;
        }



        .rtl .inbox-wrapper .email-content .email-inbox-header .email-title .new-messages {
            margin-left: 0;
            margin-right: 3px;
        }

        .email-head {
            background-color: transparent;
        }

        .email-head-subject {
            padding: 25px 25px;
            border-bottom: 1px solid #f1f2f6;
        }

        @media (max-width: 767px) {
            .email-head-subject {
                padding: 25px 10px;
            }
        }

        .email-head-subject .title {
            display: block;
            font-size: .99rem;
        }

        .email-head-subject .title a .icon svg {
            width: 18px;
        }

        .email-head-subject .icons {
            font-size: 14px;
            float: right;
        }

        .email-head-subject .icons .icon {
            color: #000;
            margin-left: 12px;
        }

        .email-head-subject .icons .icon svg {
            width: 18px;
        }

        .email-head-sender {
            padding: 13px 25px;
        }

        @media (max-width: 767px) {
            .email-head-sender {
                padding: 25px 10px;
            }
        }

        .email-head-sender .avatar {
            float: left;
            margin-right: 10px;
        }

        .email-head-sender .date {
            float: right;
            font-size: 12px;
        }

        .email-head-sender .avatar {
            float: left;
            margin-right: 10px;
        }

        .email-head-sender .avatar img {
            width: 36px;
        }

        .email-head-sender .sender>a {
            color: #2f3542;
        }

        .email-head-sender .sender span {
            margin-right: 5px;
            margin-left: 5px;
        }

        .email-head-sender .sender .actions {
            display: inline-block;
            position: relative;
        }

        .email-head-sender .sender .actions .icon {
            color: #a4b0be;
            margin-left: 7px;
        }

        .email-head-sender .sender .actions .icon svg {
            width: 18px;
        }

        .email-body {
            background-color: transparent;
            border-top: 1px solid #f1f2f6;
            padding: 30px 28px;
        }

        @media (max-width: 767px) {
            .email-body {
                padding: 30px 10px;
            }
        }

        .email-attachments {
            background-color: transparent;
            padding: 25px 28px 5px;
            border-top: 1px solid #f1f2f6;
        }

        @media (max-width: 767px) {
            .email-attachments {
                padding: 25px 10px 0;
            }
        }

        .email-attachments .title {
            display: block;
            font-weight: 500;
        }

        .email-attachments .title span {
            font-weight: 400;
        }

        .email-attachments ul {
            list-style: none;
            margin: 15px 0 0;
            padding: 0;
        }

        .email-attachments ul>li {
            margin-bottom: 5px;
        }

        .email-attachments ul>li:last-child {
            margin-bottom: 0;
        }

        .email-attachments ul>li a {
            color: #2f3542;
        }

        .email-attachments ul>li a svg {
            width: 18px;
            color: #a4b0be;
        }

        .email-attachments ul>li .icon {
            color: #a4b0be;
            margin-right: 2px;
        }

        .email-attachments ul>li span {
            font-weight: 400;
        }

        .rtl .email-head-subject .title a .icon {
            margin-right: 0;
            margin-left: 6px;
        }

        .rtl .email-head-subject .icons .icon {
            margin-left: 0;
            margin-right: 12px;
        }

        .rtl .email-head-sender .avatar {
            margin-right: 0;
            margin-left: 10px;
        }

        .rtl .email-head-sender .sender .actions .icon {
            margin-left: 0;
            margin-right: 7px;
        }

        .email-head-title {
            padding: 15px;
            border-bottom: 1px solid #e8ebf1;
            font-weight: 400;
            color: #3d405c;
            font-size: .99rem;
        }

        .email-head-title .icon {
            color: #696969;
            margin-right: 12px;
            vertical-align: middle;
            line-height: 31px;
            position: relative;
            top: -1px;
            float: left;
            font-size: 1.538rem;
        }

        .email-compose-fields {
            background-color: transparent;
            padding: 20px 15px;
        }

        .email-compose-fields .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            margin: -2px -14px;
        }

        .email-compose-fields .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            border-radius: 0;
            background: #727cf5;
            color: #ffffff;
            margin-top: 0px;
            padding: 4px 10px;
            font-size: 13px;
            border: 0;
        }

        .email-compose-fields .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice span {
            color: #ffffff;
        }

        .email-compose-fields .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-search {
            line-height: 15px;
        }

        .form-group.row {
            margin-bottom: 0;
            padding: 12px 0;
        }

        .form-group.row label {
            white-space: nowrap;
        }

        .email-compose-fields label {
            padding-top: 6px;
        }

        .email.editor {
            background-color: transparent;
        }

        .email.editor .editor-statusbar {
            display: none;
        }

        .email.action-send {
            padding: 8px 0px 0;
        }

        .btn-space {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .breadcrumb {
            margin: 0;
            background-color: transparent;
        }

        .rtl .email-compose-fields .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            float: right;
        }

        .rtl .btn-space {
            margin-right: 0;
            margin-left: 5px;
        }

        .card {
            margin-left: 0;
            margin-top: 20px;
            box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
            -webkit-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
            -moz-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
            -ms-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #f2f4f9;
            border-radius: 0.25rem;
        }

        .badge {
            padding: 6px 5px 3px;
        }

        .text-white {
            color: #ffffff !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .float-right {
            float: right !important;
        }

        .badge-danger-muted {
            color: #212529;
            background-color: #f77eb9;
        }
    </style>








</head>

<body>
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
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-envelope"></i>
                        <span class="nav-link-text">Messages</span>
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
                        <?php
                        
                        while ($msgs = $msgstmt->fetch(PDO::FETCH_ASSOC)) {
                            $ms_detail = $msgs['msg'];
                            $ms_name = $msgs['sender_name'];
                            $ms_email = $msgs['email'];
                            $ms_time = $msgs['date_sent']; ?>
                            <a class="dropdown-item">
                                <strong><?php echo $ms_name; ?></strong>
                                <span class="small float-right text-muted"><?php echo $ms_time; ?></span>
                                <div class="dropdown-message small"><?php echo $ms_detail; ?> </div>
                            </a>
                            <div class="dropdown-divider"></div>

                        <?php } ?>

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

        <div class="container-fluid ">
            <div class=" row inbox-wrapper">
                <div class="col-lg-12">
                    <div class="content-wrapper card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 email-aside border-lg-right">
                                    <div class="aside-content">
                                        <div class="aside-header">
                                            <button class="navbar-toggle" data-target=".aside-nav" data-toggle="collapse" type="button"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg></span></button>
                                            <span class="title">Messages</span>
                                        </div>
                                        <div class="aside-nav collapse">
                                            <div class="nav list-group">
                                                <?php
                                                $msgsql = "SELECT * FROM `messages` ";
                                                $msgstmt = $pdo->prepare($msgsql);
                                                $msgstmt->execute();
                                                $count = $msgstmt->rowCount();
                                                while ($msgs = $msgstmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $ms_email = $msgs['email'];
                                                    $ms_name = $msgs['sender_name'];
                                                    $ms_time = $msgs['date_sent']; ?>
                                                    <a href="#" class="list-group-item">
                                                        <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px; display: inline-block;"><?php echo $ms_name; ?></span>
                                                        <span class="text-muted small float-right" style="font-size: 11px;"><?php echo $ms_email ?></span> <span class="small float-right text-muted"><?php echo $ms_time; ?></span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                                            </span></span>
                                                    </a>

                                                <?php } ?>

                                                
                                                

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 email-content">
                                    <div class="email-head">
                                        <div class="email-head-subject">
                                            <div class="title d-flex align-items-center justify-content-between">


                                            </div>
                                        </div>
                                        <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="rounded-circle user-avatar-md">
                                                </div>
                                                <div class="sender d-flex align-items-center">
                                                    <a href="#">John Doe</a> <span>to</span><a href="#">me</a>
                                                    <div class="actions dropdown">
                                                        <a class="icon" href="#" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg></a>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item" href="#">Mark as read</a>
                                                            <a class="dropdown-item" href="#">Mark as unread</a>
                                                            <a class="dropdown-item" href="#">Spam</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="date">Nov 20, 11:20</div>
                                        </div>
                                    </div>
                                    <div class="email-body">
                                        <p>Hello,</p>
                                        <br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit
                                            amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                        <br>
                                        <p>Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
                                            adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam
                                            sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>
                                        <br>
                                        <p><strong>Regards</strong>,<br> John Doe</p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
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
</body>


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

<script>
    (function($) {
        "use strict"; // Start of use strict
        // Configure tooltips for collapsed side navigation
        $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        })
        // Toggle the side navigation
        $("#sidenavToggler").click(function(e) {
            e.preventDefault();
            $("body").toggleClass("sidenav-toggled");
            $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
            $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
        });
        // Force the toggled class to be removed when a collapsible nav link is clicked
        $(".navbar-sidenav .nav-link-collapse").click(function(e) {
            e.preventDefault();
            $("body").removeClass("sidenav-toggled");
        });
        // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
        $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        });
        // Scroll to top button appear
        $(document).scroll(function() {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });
        // Configure tooltips globally
        $('[data-toggle="tooltip"]').tooltip()
        // Smooth scrolling using jQuery easing
        $(document).on('click', 'a.scroll-to-top', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: ($($anchor.attr('href')).offset().top)
            }, 1000, 'easeInOutExpo');
            event.preventDefault();
        });

        $("#type").change(function() {
            var val = $(this).val();
            if (val == "product") {
                $("#category").html("<option value='' class='roleChoice' disabled='disabled' selected='selected'> --Select Category--  </option>" +
                    "<option value='chandeliers'>Chandeliers</option>" +
                    "<option value='down_Light'>Down Light</option>" +
                    "<option value='flood_light'>Flood Light</option>" +
                    "<option value='ground_light'>Ground Light</option>" +
                    "<option value='pendant_light'>Pendant Light</option>" +
                    "<option value='recessed_light'>Recessed Light</option>" +
                    "<option value='wall_recessed_light'>Wall Recessed Light</option>" +
                    "<option value='road_light'>Road Light</option>" +
                    "<option value='solar_light'>Solar Light</option>" +
                    "<option value='spot_light'>Spot Light</option>" +
                    "<option value='strip_light'>Strip Light</option>" +
                    "<option value='track_light'>Track Light</option>" +
                    "<option value='wall_surface_light'>Wall Surface Light</option>"
                );
            }
        });

    })(jQuery); // End of use strict
</script>

<style>

 .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
 .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
 .list-group .checkbox { display: inline-block;margin: 0px; }
 .list-group input[type="checkbox"]{ margin-top: 2px; }
 .list-group .glyphicon { margin-right:5px; }
 .list-group .glyphicon:hover { color:#FFBC00; }
 .list-group a {
     margin-top: 20px;
     text-decoration: none;
 }
a.list-group-item.read { color: #222;background-color: #F3F3F3; }
</style>
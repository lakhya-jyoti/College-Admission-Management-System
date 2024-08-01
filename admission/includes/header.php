<?php
// error_reporting(0);
$page = "index";
require_once('../includes/dbconfig.php');

$user = $_SESSION['username'];
$select = "select * from applicants,program where std_email = :username or std_mob = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $user);
$stmt->execute();
$fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);
$std_name = $fetch_user['std_f_name'] . " " . $fetch_user['std_m_name'] . " " . $fetch_user['std_l_name'];


if (isset($_SESSION['loggedin']) != true) {

    header('location: ../includes/logout.php');
}
if (isset($_SESSION['user_status']) == $fetch_user['user_status'] && $fetch_user['user_status'] == "Admin") {
?>
    <script>
        alert("You are not a Student ! Please Contact admin");
    </script>
<?php

    header('location: ../includes/logout.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>North Lakhimpur College (A) | Welcome</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= $web_socket ?>images/logo2.png" type="image/x-icon">
    <link href="<?= $web_socket ?>css/bootstrap.css" rel="stylesheet">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {
            height: 840px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: white;
            color: black;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }

        .table {
            border: 1px solid black;

        }
    </style>

</head>
</head>

<body>





    <div style="background-color:#04124f; width:100%; float:left;">
        <div class="col-sm-12 col-md-12">

            <div class="col-sm-3 col-md-3 logo-img" align="left">
                <a href="/" target="_blank"><img src="<?= $web_socket ?>images/logo2.png" width="100" height="111"></a>
            </div>

            <div class="col-sm-8 col-md-8 logo-img" align="center">
                <h2 class="header-title" style="color: #fff;font-weight: bold;font-size: 30px;margin: 35px 0 10px 0;">NORTH LAKHIMPUR COLLEGE (A)
                    <br> (Online Admission)
                </h2>
            </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row content">


            <div class="col-sm-12" class="table-responsive" style="padding:0;">
                <table class="table" style="margin:0">
                    <thead>
                        <tr class="well well-sm">
                            <td><b style="color: #4262a5;font-weight: 900;">Welcome : <?= $std_name ?></b></td>

                            <td> </td>

                            <td align="right"><a href="<?= $web_socket ?>includes/logout.php" class="btn btn-info btn-md" style="background-color:#800000; color: white;">
                                    <b>Log out</b></td>
                        </tr>
                    </thead>
                </table>
            </div>


            <div class="col-sm-3 sidenav" style="padding: 0;">
                <ul class="nav nav-pills nav-stacked">
                    <li style="background-color: #04124f;"><a style="color: white; font-weight:bold;" href="form-home.php">Home</a></li>
                    <li style="background-color: #04124f;"><a style="color: white; font-weight:bold;" href="steps.php">Information and Guidelines</a></li>
                    <li style="background-color: #04124f;"><a style="color: white; font-weight:bold;" href="redirect.php">Application form</a></li>
                    <li style="background-color: #04124f;"><a style="color: white; font-weight:bold;" href="paymenAcknowledgement.php">Payment Acknowledgement</a></li>
                    <li style="background-color: #04124f;"><a style="color: white; font-weight:bold;" href="Important_Dates.php">Important Dates</a></li>
                    <li style="background-color: #04124f;"><a style="color: white; font-weight:bold;" href="Contacts.php">Support & Contacts</a></li>
                </ul><br>
                <div class="input-group">
                </div>
            </div>
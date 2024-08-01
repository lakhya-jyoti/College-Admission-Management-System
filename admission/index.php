<?php
$page = "index";
require_once('../includes/dbconfig.php');
if (isset($_SESSION['loggedin']) == true ) {
    ?>
    <script>
        history.go(-1);
    </script>
    <?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>North Lakhimpur College (Autonomus)</title>
    <link rel="shortcut icon" href="<?= $web_socket ?>images/logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= $web_socket ?>css/style.css">
    <link rel="stylesheet" href="<?= $web_socket ?>css/responsive.css">
</head>

<body>
    <?php
    include_once("../includes/nav.php");
    ?>
    <div class="container">
        <!-- Need to include first row and second colonm -->
        <h1 class="header-text">
            QUICK TIPS
        </h1>
        <div id="msg"></div>

        <main>
            <!-- This is left side -->
            <div class="left-body">
                <h3>IMPORTANT INSTRUCTIONS FOR CANDIDATES BEFORE APPLYING ONLINE</h3>

                <div class="instructions">
                    <p class="acc-section">
                        Online Addmission Form for Academic Session 2023-24
                    </p>
                    <ol class="instruction-list">
                        <p>Keep the following items in your hand before applying :</p>
                        <li>Email id</li>
                        <li>Mobile No</li>
                        <li>Scanned photo</li>
                        <li>Scanned signature</li>
                        <li>Credit card, Net banking or ATM-cum-Debit card</li>
                    </ol>
                </div>
                <div class="prospucts">
                    <h2>NORTH LAKHIMPUR COLLEGE(A) PROSPECTUS (2023-24): <a href="#">Click Here</a></h2>
                    <div class="helpline">
                        <ol class="helpline-contact">
                            <p><u>HELPDESK</u></p>
                            <li>PHONE: <a href="tel:+919365653080">9365653080</a></li>
                            <li>Email: <a href="mailto:uprakash503@gmail.com">uprakash503@gmail.com</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="right-body">
                <h4>APPLICANT LOGIN</h4>

                <div class="user-logo">
                    <center><img src="<?= $web_socket ?>images/icon-login.png" alt="" srcset=""></center>
                </div>
                <div class="existing-user">
                    <p>Existing User?</p>
                    <button class="main-signin  signin-btn" id="signin-btn1">Sign In</button>
                    <p class="forgot-password">
                    <p>Forgot Password? <a href="<?=$web_socket?>admission/forgot-password.php">Click Here</a></p>
                    </p>
                    <a href="<?=$web_socket?>admission/registration.php" id="registration_form" class="new-regs">New Registration</a>
                    <button class="activate">Acctivate Your Account</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Sign in modal -->
    <?php
    include_once("../includes/signin-modal.php");
    ?>
    <footer>
        <p class="developer">This site is Developed By Prakash Upadhyaya & Lakhya Borah</p>
        <p class="copyright">Copyright &copy; 2023. All right reserved.</p>
    </footer>
    <script src="<?=$web_socket?>js/main.js"></script>
</body>

</html>
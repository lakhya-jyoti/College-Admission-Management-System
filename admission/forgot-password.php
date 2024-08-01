<?php
$page = "index";
require_once('../includes/dbconfig.php');
if (isset($_SESSION['loggedin']) == true) {
?>
    <script>
        history.go(-1);
    </script>
<?php
}

if (isset($_POST['reset_pass'])) {
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $date = $_POST['birth_date'];
    $month = $_POST['birth_month'];
    $year = $_POST['birth_year'];
    $email = $_POST['email'];
    $dob = $date . "-" . $month . "-" . $year;

    $select = "select * from applicants where std_email = :email";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':email', $email);
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $fetch_details = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($fetch_details['std_dob'] == $dob && $fetch_details['std_f_name'] == $f_name && $fetch_details['std_m_name'] == $m_name && $fetch_details['std_l_name'] == $l_name) {
                $_SESSION['email'] = true;
                $_SESSION['id'] = $email;
                header('location: reset-pass.php');
               
            } else {
                echo "You have entered Wrong Details";
                
            }
        } else {
            echo "You Have Entered worng email address";
        }
    }
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

        <form action="" method="post" id="reg_form">
            <div class="form-body">
                <div class="form-group">
                    <label class="input-label" for="name">Name of Applicant: <span class="red">*</span> </label>
                    <input type="text" class="form-input" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" id="f_name" name="f_name" placeholder="First Name" required>
                    <input type="text" class="form-input" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" id="m_name" name="m_name" placeholder="Mid Name">
                    <input type="text" class="form-input" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" id="l_name" name="l_name" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <label class="input-label" for="dob">Date Of Birth: <span class="red">*</span> </label>
                    <select name="birth_date" id="date" required>
                        <option value="">--DATE--</option>
                        <?php
                        $nums = 01;
                        //    $num =  sprintf("%04d", $nums);
                        for ($num =  1; $num < 32; $num++) {


                        ?>
                            <option value="<?= sprintf("%02d", $num) ?>"><?= sprintf("%02d", $num) ?></option>
                        <?php

                        } ?>
                    </select>
                    <select name="birth_month" id="month" required>
                        <option value="">--MONTH--</option>
                        <?php
                        for ($num = 1; $num < 13; $num++) {
                            $month = date('F', mktime(0, 0, 0, sprintf("%02d", $num), 1, 0));

                        ?>
                            <option value="<?= sprintf("%02d", $num) ?>"><?= $month ?></option>
                        <?php
                            // $month++;
                        } ?>
                    </select>
                    <select name="birth_year" id="year" required>
                        <option value="">--YEAR--</option>
                        <?php
                        $year = date("Y") - 10;
                        for ($num = 1974; $num < $year; $num++) {


                        ?>
                            <option value="<?= $num ?>"><?= $num ?></option>
                        <?php

                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="input-label" for="email">Email Id: <span class="red">*</span> </label>
                    <input type="email" class="form-input" name="email" id="email" placeholder="Email Id" required>
                    <div class="red small">Please note that all communication related to your Application including link registration for activation etc. will be sent to this email id.</div>
                </div>

                <div class="mb-3 col-md-3 form-group">
                    <label for="password" class="input-label">Enter Calculated Value</label>
                    <div class="input-group mb-3">
                        <?php
                        $ra1 = rand(1, 10);
                        $ra2 = rand(0, 9);
                        ?>
                        <input class="input-group-text col-md-3" value="<?= $ra1 ?>+<?= $ra2 ?>=" id="captcha" disabled>
                        <input type="hidden" value="<?= $ra1 ?>" id="ra1">
                        <input type="hidden" value="<?= $ra2 ?>" id="ra2">
                        <input type="text" onkeyup="myFunction()" class="form-control" id="entercaptcha" required>
                    </div>
                </div>
                <div class="button">
                    <button class="submit" id="reg_submit" name="reset_pass" disabled>Submit</button>
                    <button class="reset" type="reset">Reset</button>
                </div>
            </div>
        </form>

    </div>

    <footer>
        <p class="developer">This site is Developed By Prakash Upadhyaya & Lakhya Borah</p>
        <p class="copyright">Copyright &copy; 2023. All right reserved.</p>
    </footer>
    <script>
        function myFunction() {
            let a = document.getElementById('ra1').value;
            let b = document.getElementById('ra2').value;
            let c = +a + +b;
            let res = document.getElementById('entercaptcha').value;
            if (res == c) {
                document.getElementById("reg_submit").disabled = false;
            } else {
                document.getElementById("reg_submit").disabled = true;

            }
        }
    </script>
</body>

</html>
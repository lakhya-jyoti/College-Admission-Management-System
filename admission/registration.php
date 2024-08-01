<?php
$page = "registration";
require_once('../includes/dbconfig.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        .fa-eye {
            margin-left: -30px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    include_once("../includes/nav.php");
    ?>

    <div class="container">
        <div class="form">
            <div class="form-header">
                <p>REGISTRATION</p>
            </div>
            <form action="<?= $web_socket ?>includes/action.php" method="post" id="reg_form">
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
                        <label class="input-label" for="course">Select Course: <span class="red">*</span> </label>
                        <select name="course" id="course" class="form-control" required>
                            <option value="">--select--</option>
                            <?php
                            $select = "select * from program";
                            $stmt = $con->prepare($select);
                            $stmt->execute();
                            while ($fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                                <option value="<?= $fetch_prgm['prgm_id'] ?>"><?= $fetch_prgm['prgm_name'] ?></option>

                            <?php

                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="gender">Gender: <span class="red">*</span> </label>
                        <select name="gender" id="gender" required>
                            <option value="">--Select--</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                            <option value="TRANSGENDER">Transgender</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="father_name">Father's Name: <span class="red">*</span> </label>
                        <input type="text" class="form-input" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="father_name" id="father_name" placeholder="Father's Name" required>
                        <div class="red small">Please Don't add any salutation like Mr./Dr. etc before the Name. .</div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="mother_name">Mother's Name: <span class="red">*</span> </label>
                        <input type="text" class="form-input" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="mother_name" id="mother_name" placeholder="Mother's Name" required>
                        <div class="red small">Please Don't add any salutation like Mr./Dr. etc before the Name. .</div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="email">Email Id: <span class="red">*</span> </label>
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email Id" required>
                        <div class="red small">Please note that all communication related to your Application including link registration for activation etc. will be sent to this email id.</div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="password">Password: <span class="red">*</span> </label>
                        <input type="password" class="form-input" name="password" id="password" placeholder="Password" maxlength="20" required>
                        <i class="far fa-eye" id="togglePassword"></i>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="c_password">Confirm Password: <span class="red">*</span> </label>
                        <input type="password" onkeyup="checkPasswordStrength();" class="form-input" id="c_password" name="c_password" placeholder="Confirm Password" value="" maxlength="20" required>
                        <div class="red small">Your password length should be 8-20. (It must contain at least one letter, one number and one special character).</div>
                        <div id="password-strength-status"></div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="mobile_no">Mobile Number: <span class="red">*</span> </label>
                        <input type="tel" class="form-input" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="" minlength="10" maxlength="10" required>
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
                        <button class="submit" id="reg_submit" name="registration" disabled>Submit</button>
                        <button class="reset" type="reset">Reset</button>
                    </div>
                    <div id="loader" class="signin-modal">
                        <center><img src='<?= $web_socket ?>images/loader.gif' /></center>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("../includes/footer.php");
    ?>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        function IsEmail(email) {
            var regex =
                /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

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
    <script>
     
        $(function() {
            // $("#loader").hide();

            $('#reg_submit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?= $web_socket ?>includes/action.php",
                    data: $("#reg_form").serialize() + "&registration",
                    beforeSend: function() {
                        $("#loader").show();

                    },
                    
                    success: function(response) {
                        if (response == 100) {
                            alert("Registered Successfully");
                            $('#reg_form').trigger('reset');
                            location.href = "<?= $web_socket ?>admission/";

                        } else if (response == 101) {
                            alert("Error ! Please Try After Sometime !");
                        } else if (response == 102) {
                            alert("Error ! Please Enter the same password and confirm password !");

                        } else if (response == 103) {
                            alert("Error ! Your mobile no or email id already registered");

                        } else if (response == 104) {
                            alert("Error ! Please fill the all required (*)");

                        }
                    },
                    complete: function(data) {
                        // Hide image container
                        $("#loader").hide();
                    }

                });
            })
        })
    </script>



</body>

</html>
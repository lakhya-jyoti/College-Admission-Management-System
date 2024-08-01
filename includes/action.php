<?php
require('dbconfig.php');
if (isset($_POST['registration'])) {
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $birth_date = $_POST['birth_date'];
    $birth_month = $_POST['birth_month'];
    $birth_year = $_POST['birth_year'];
    $gender = $_POST['gender'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $mobile_no = $_POST['mobile_no'];
    $course = $_POST['course'];
    $application_id = "NLC" . date("ymdHis");

    $select = "select * from applicants where std_email = :email or std_mob = :mobile_no";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile_no', $mobile_no);
    $stmt->execute();
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($f_name && $l_name && $birth_date && $birth_month && $birth_year && $gender && $father_name && $mother_name && $email && $password && $c_password && $mobile_no != "") {
        if ($stmt->rowCount() <= 0) {
            if ($password == $c_password) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $dob = $birth_date . "-" . $birth_month . "-" . $birth_year;
                // $status = "Registered";
                $insert = "INSERT INTO `applicants`(`std_application_no`,`std_f_name`, `std_m_name`, `std_l_name`, `std_mob`, `std_email`, `std_dob`, `std_sex`,  `std_father`, `std_mother`,`std_course`, `std_pass`,`user_status`, `std_status`) VALUES (:application_no,:f_name,:m_name, :l_name,:mobile_no,:email , :dob,:gender,:father_name,:mother_name, :course, :hash, 'Student', 'Registered')";
                $stmt = $con->prepare($insert);
                $stmt->bindParam(':application_no', $application_id);
                $stmt->bindParam(':f_name', $f_name);
                $stmt->bindParam(':m_name', $m_name);
                $stmt->bindParam(':l_name', $l_name);
                $stmt->bindParam(':mobile_no', $mobile_no);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':dob', $dob);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':father_name', $father_name);
                $stmt->bindParam(':mother_name', $mother_name);
                $stmt->bindParam(':hash', $hash);
                $stmt->bindParam(':course', $course);
                // $stmt->bindParam(':status', $status);
                $run = $stmt->execute();
                if ($run) {
                    echo 100;
                } else {
                    echo 101;
                }
            } else {
                echo 102;
            }
        } else {
            echo 103;
        }
    } else {
        echo 104;
    }
}
// Login
if (isset($_POST['login'])) {
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $select = "select * from applicants where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    $fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() == 0) {
?>
        <script>
            alert("Error ! Username or password invalid");

            history.go(-1);
        </script>
        <?php

    } else {

        $verify = $fetch_user['std_pass'];

        if (password_verify($pass, $verify)) {
            $_SESSION['username'] = $user;
            $_SESSION['loggedin'] = true;
            $_SESSION['student'] = true;
            $_SESSION['user_status'] = true;
            header('location: ../admission/form-home.php');
        } else {
        ?>
            <script>
                alert("Error ! Username or password invalid");
                history.go(-1);
            </script>
        <?php
        }
    }
}

// First Stage Form-fillup Process
if (isset($_POST['term'])) {
    if ($_POST['terms'] == 1) {
        $update = "UPDATE `applicants` SET `user_status` = 'fst_stage' where  std_email = :username or std_mob = :username";
        $stmt = $con->prepare($update);
        $stmt->bindParam(':username', $_SESSION['username']);
        $stmt->execute();
        header('location: ../admission/get_std_details.php');
    } else {
        ?>
        <script>
            alert("Please Check the Terms and conditions");
            history.go(-1)
        </script>
    <?php


    }
}




// PIN CODES
if (isset($_POST['pincodeCheck'])) {
    $select = "select * from postel_codes where PINCODE = $_POST[pin]";
    $stmt = $con->prepare($select);
    $stmt->execute();

    if ($fetch_pin = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $state = $fetch_pin['STATE'];
        $dist = $fetch_pin['DISTRICT'];
        echo json_encode(array("state" => $state, "dist" => $dist));
    } else {
        echo "No data found";
    }
}



// Admin Login
if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];
    $select = "select * from applicants where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':username', $admin_username);
    $stmt->execute();
    $fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() == 0) {
    ?>
        <script>
            alert("Error ! Username or password invalid");

            history.go(-1);
        </script>
        <?php

    } else {

        $verify = $fetch_user['std_pass'];

        if (password_verify($admin_password, $verify)) {
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['admin_loggedin'] = true;
            $_SESSION['user_status'] = true;
            header('location: ../administration');
        } else {
        ?>
            <script>
                alert("Error ! Username or password invalid");
                history.go(-1);
            </script>
        <?php
        }
    }
}

// Admin Details Update
if (isset($_POST['update_admin'])) {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $update = "UPDATE `applicants` SET `std_prmt_locality` = :address, `std_mob` = :phone, std_email = :email where  std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':username', $_SESSION['admin_username']);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    if ($stmt->execute()) {
        ?>
        <script>
            alert("Details Updated Successfully");
            history.go(-1);
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something Went Wrong");
            history.go(-1);
        </script>
        <?php
    }
}
// Password Reset for admin
if (isset($_POST['admin_pass_reset'])) {
    $old_pass = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];

    $select = "select * from applicants where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':username', $_SESSION['admin_username']);
    if ($stmt->execute()) {
        $fetch_pass = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($old_pass, $fetch_pass['std_pass'])) {
            if ($newpassword == $renewpassword) {
                $new_hash = password_hash($newpassword, PASSWORD_BCRYPT);
                $update = "UPDATE `applicants` SET `std_pass` = :password where  std_email = :username or std_mob = :username";
                $stmt = $con->prepare($update);
                $stmt->bindParam(':password', $new_hash);
                $stmt->bindParam(':username', $_SESSION['admin_username']);
                if ($stmt->execute()) {
        ?>
                    <script>
                        alert("Password Updated Successfully");
                        history.go(-1);
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("Something Went Wrong");
                        history.go(-1);
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert('Password and Confirm password not matched');
                    history.go(-1);
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert('Please Enter a Valid Password');
                history.go(-1);
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert('Something went wrong');
            history.go(-1);
        </script>
        <?php
    }
}

// Add Program
if (isset($_POST['add_prgm'])) {
    $prgm_name = $_POST['prgm_name'];
    $prgm_duer = $_POST['prgm_duer'];
    $prgm_sem_cost = $_POST['prgm_sem_cost'];
    $prgm_add_fees = $_POST['prgm_add_fees'];
    $duer_peri = $_POST['duer_peri'];
    $prgm_type = $_POST['prgm_type'];
    $tot_duer = $prgm_duer . " " . $duer_peri;
    $select = "SELECT * FROM `program` WHERE `prgm_name` = :prgm_name and prgm_type = :prgm_type";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':prgm_name', $prgm_name);
    $stmt->bindParam(':prgm_type', $prgm_type);
    $stmt->execute();
    $fetch_prgm = $stmt->rowCount();
    if ($fetch_prgm == 0) {
        if ($prgm_add_fees && $prgm_duer && $prgm_sem_cost > 0) {
            $insert = "INSERT INTO `program`(`prgm_name`, `prgm_dure`, `prgm_sem_cost`, `prgm_add_fees`,`prgm_type`) VALUES (:prgm_name, :prgm_duer,:prgm_sem_cost,:prgm_add_fess,:prgm_type)";
            $stmt = $con->prepare($insert);
            $stmt->bindParam(':prgm_name', $prgm_name);
            $stmt->bindParam(':prgm_duer', $tot_duer);
            $stmt->bindParam(':prgm_sem_cost', $prgm_sem_cost);
            $stmt->bindParam(':prgm_add_fess', $prgm_add_fees);
            $stmt->bindParam(':prgm_type', $prgm_type);
            if ($stmt->execute()) {
                $last_id = $con->lastInsertId();
                $select = "select * from program where prgm_id = '$last_id'";
                $stmt = $con->prepare($select);
                $stmt->execute();
                if ($prgm_type == 'HS') {
                    $insert = "INSERT INTO `roll_no`(`prgm_id`, `roll_no`, `roll_desc`) VALUES ('$last_id','0','HS')";
                } elseif ($prgm_type == 'UG-GENERAL' || $prgm_type == 'UG-PROFESSIONAL') {
                    $insert = "INSERT INTO `roll_no`(`prgm_id`, `roll_no`, `roll_desc`) VALUES ('$last_id','0','UG')";
                } elseif ($prgm_type == 'PG-GENERAL' || $prgm_type == 'PG-PROFESSIONAL' || $prgm_type == 'PG-DIPLOMA') {
                    $insert = "INSERT INTO `roll_no`(`prgm_id`, `roll_no`, `roll_desc`) VALUES ('$last_id','0','PG')";
                }
                $stmt = $con->prepare($insert);
                $stmt->execute();
        ?>
                <script>
                    alert('Program add Successfully');
                    history.go(-1);
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('Something went wrong');
                    history.go(-1);
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert('Amount or Duration cannot be negetive');
                history.go(-1);
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert('Program Already Exits');
            history.go(-1);
        </script>
        <?php
    }
}

// Add Department
if (isset($_POST['add_dept'])) {
    $dept_name = $_POST['dept_name'];
    $select = "SELECT * FROM `dept` WHERE `dept_name` = :dept_name";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':dept_name', $dept_name);
    $stmt->execute();
    $fetch_dept = $stmt->rowCount();

    if ($fetch_dept == 0) {
        $insert = "INSERT INTO `dept`(`dept_name`) VALUES (:dept_name)";
        $stmt = $con->prepare($insert);
        $stmt->bindParam(':dept_name', $dept_name);
        if ($stmt->execute()) {
        ?>
            <script>
                alert('Department add Successfully');
                history.go(-1);
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('Something went wrong');
                history.go(-1);
            </script>
        <?php

        }
    } else {
        ?>
        <script>
            alert('Department Already Exits');
            history.go(-1);
        </script>
        <?php
    }
}


// Add subjects
if (isset($_POST['add_sub'])) {
    $dept_name = $_POST['dept_name'];
    $sub_name = $_POST['sub_name'];
    $select = "SELECT * FROM `subjects` WHERE `sub_name` = :sub_name";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':sub_name', $sub_name);
    $stmt->execute();
    $fetch_sub = $stmt->rowCount();

    if ($fetch_sub == 0) {
        $insert = "INSERT INTO `subjects`(`sub_name`, `dept_id`) VALUES (:sub_name,:dept_name)";
        $stmt = $con->prepare($insert);
        $stmt->bindParam(':sub_name', $sub_name);
        $stmt->bindParam(':dept_name', $dept_name);

        if ($stmt->execute()) {
        ?>
            <script>
                alert('Subject add Successfully');
                history.go(-1);
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('Something went wrong');
                history.go(-1);
            </script>
        <?php

        }
    } else {
        ?>
        <script>
            alert('Subject Already Exits');
            history.go(-1);
        </script>
    <?php
    }
}

// add_sub_prgm
if (isset($_POST['add_sub_prgm'])) {
    $prgm_name = $_POST['prgm_name'];
    $sub_name = $_POST['sub_name'];
    $int_cap = $_POST['int_cap'];
    $insert = "INSERT INTO `program_subject`(`prgm_id`, `sub_id`, `intake_cap`) VALUES (:prgm_name,:sub_name,:intake_cap)";
    $stmt = $con->prepare($insert);
    $stmt->bindParam(':prgm_name', $prgm_name);
    $stmt->bindParam(':sub_name', $sub_name);
    $stmt->bindParam(':intake_cap', $int_cap);
    if ($stmt->execute()) {
    ?>
        <script>
            alert("Add Successfully");
            history.go(-1);
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something went wrong");
            history.go(-1);
        </script>
    <?php
    }
}

// delete applicant 
if (isset($_POST['delete_applicants'])) {
    $application_id = $_POST['applicants_id'];
    $delete = "delete from applicants where applicants_id = :applicant_id";
    $stmt = $con->prepare($delete);
    $stmt->bindParam(':applicant_id', $application_id);
    if ($stmt->execute()) {
    ?>
        <script>
            alert("Student Deleted Successfully");
            history.go(-1);
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something Went Wrong");
            history.go(-1);
        </script>
<?php
    }
}

// Cource select
if (isset($_POST['courseCheck'])) {
    $course = $_POST['course'];
    $select = "select * from program where prgm_id = :course";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':course', $course);
    $qry = $stmt->execute();
    $fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $fetch_prgm['prgm_name'];
}

// subject preference 1
if (isset($_POST['pref_sub_1'])) {
    $select = "select * from program, subjects, program_subject where program.prgm_id = $_SESSION[prgm_id]";
    $stmt = $con->prepare($select);
    $stmt->execute();
    echo $_SESSION['prgm_id'];
    while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

        echo `<option value="<?= $fetch_sub[sub_id] ?>"><?= $fetch_sub[sub_name] ?></option>`;
    }
}
?>
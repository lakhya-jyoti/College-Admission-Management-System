<?php
require_once('../includes/dbconfig.php');
$user = $_SESSION['username'];
$select = "select * from applicants where std_email = :username or std_mob = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $user);
$stmt->execute();
$fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);
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

$select = "select * from applicants inner join applicants_edu_det on applicants.applicants_id = applicants_edu_det.applicants_id where std_mob = :username or std_email = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$fetch_details = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $fetch_details['std_f_name'] . " " . $fetch_details['std_m_name'] . " " . $fetch_details['std_l_name'];
$core_sub_pref = $fetch_details['std_core_sub1'] . "," . $fetch_details['std_std_core_sub2'] . "," . $fetch_details['std_core_sub3'];
$GE_sub_pref = $fetch_details['std_core_sub1'] . "," . $fetch_details['std_std_core_sub2'] . "," . $fetch_details['std_core_sub3'];

// For Submition of form without payment
if (isset($_POST['submit_preview'])) {
    $update = 'update applicants set user_status = "pre_final" where std_email = :username or std_mob = :username';
    $stmt = $con->prepare($update);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
    ?>
        <script>
            alert("Submited Successfully");
            location.href = "std-profile.php";
        </script>

    <?php
    } else {
    ?>
        <script>
            alert("Submited Successfully");
        </script>

<?php
    }
}

?>


<html>

<head>
    <title>North Lakhimpur College</title>
    <style>
        table {
            border: 1px solid #150517;
        }
    </style>
    <STYLE TYPE="text/css">
        TD {
            font-family: Arial;
            font-size: 6pt;
        }
    </STYLE>

</head>

<body>
    <basefont size="1">
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    </head>

    <body>
        <div style="display: flex; flex-direction: row;">
            <p colspan="1"><img src="../Images/logo.png" width="75px" height="75px" />
            </p>
            <p colspan="" style="margin-left: 20px; margin-bottom: 0;">
                NORTH LAKHIMPUR COLLEGE (AUTONOMOUS)<br /> An Autonomous College of Government of Assam under "Dibrugarh University "<br /> Email: nlcollege.autonomous@gmail.com, Website: www.nlc.ac.in

            </p>

        </div>
        <!-- <p style="margin: 0;" align="center"><u>APPLICATION FORM</u></p> -->
        <table style="BORDER-COLLAPSE: collapse" bgcolor="white" border="1" bordercolor="#000000" cellpadding="2" cellspacing="-2" width="100%" align="center">


            <tr>
                <td><b>Application no : </b></td>
                <td> <b><?= $fetch_details['std_application_no'] ?></b></td>
                <td width="18% " colspan="4 " rowspan="7 " valign="top " align="center "><img src="<?= $fetch_details['std_pass_photo'] ?>" style="width: 100px; height: 120px; " /><br />

                </td>
            </tr>
            <tr>
                <?php
                $select1 = "select * from applicants inner join program on applicants.std_course = program.prgm_id where std_mob = :username or std_email = :username";
                $stmt = $con->prepare($select1);
                $stmt->bindParam(':username', $_SESSION['username']);
                $stmt->execute();
                $fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <td><b>Program Name</b></td>
                <td><?= $fetch_prgm['prgm_name'] ?></td>

            </tr>
            <?php
            if ($fetch_prgm['prgm_type'] != 'UG-PROFESSIONAL' && $fetch_prgm['prgm_type'] != 'HS') {
            ?>
                <tr>
                    <td><b>Core Subjects</b></td>
                    <td>Computer Science, Maths, Physics Computer Science, Maths, Physics</td>
                </tr>
                <tr>
                    <td><b>Generic elective Subjects</b></td>
                    <td>Maths, Physics, Electronics</td>
                </tr>
            <?php
            } else {
            ?>
                <tr>
                    <td style="display: none;"><b></b></td>
                    <td style="display: none;"></td>
                </tr>
                <tr>
                    <td style="display: none;"><b></b></td>
                    <td style="display: none;"></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td><b>Applied for Hostel : </b></td>
                <td>NO</td>

            </tr>
            <tr>
                <td><b>Distance from Home: </b></td>
                <td colspan="5 "><?= $fetch_details['std_distance'] ?></td>
            </tr>

            <tr>
            <tr>
                <td colspan="1 "><b>APPLICANT'S NAME : </b></td>
                <td colspan="0 "><?= $name ?></td>
                <td colspan="3 "><b>Date of Birth : </b></td>
                <td colspan="0 "><?= $fetch_details['std_dob'] ?></td>

            </tr>


            <tr>
                <td colspan=" "><b>Father Name : </b></td>
                <td colspan="0 "><?= $fetch_details['std_father'] ?></td>
                <td colspan="3 "><b>Mother Name : </b></td>
                <td colspan="0 "><?= $fetch_details['std_mother'] ?></td>
            </tr>

            <tr>
                <td colspan="1 "> <b>Mobile No. :</b></td>
                <td colspan="1 "><?= $fetch_details['std_mob'] ?></td>
                <td colspan="3 "> <b>E-Mail. :</b> </td>
                <td colspan="1 "><?= $fetch_details['std_email'] ?></td>

            </tr>

            <tr>
                <td colspan="1 "> <b>Gender :</b></td>
                <td colspan="0 "><?= $fetch_details['std_sex'] ?></td>
                <td colspan="3 "> <b>Nationality :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_nation'] ?>
                </td>

            </tr>
            <tr>

                <td colspan="1 "> <b>Religion :</b></td>
                <td colspan="0 "><?= $fetch_details['std_religion'] ?></td>
                <td colspan="3 "> <b>Blood Group :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_blood'] ?>
                </td>

            </tr>

            <tr>

                <td colspan="1 "> <b>Study Continue? :</b></td>
                <td colspan="0 "><?= $fetch_details['std_stydy_cnt'] ?></td>
                <td colspan="3 "> <b>Caste :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_caste'] ?>
                </td>


            </tr>

            <tr>

                <td> <b>PWD? :</b></td>
                <td colspan="5 "><?= $fetch_details['std_pwd'] ?></td>


            </tr>

            <tr>
            <tr>
                <td colspan="8 "> <b>PARMENENT ADDRESS</b> </td>

            </tr>
            <tr>
                <td colspan="1 "> <b>Address Line 1 :</b></td>
                <td colspan="0 "><?= $fetch_details['std_prmt_add'] ?></td>
                <td colspan="3 "> <b>PIN Code :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_prmt_pin'] ?> </td>
            </tr>

            <tr>
                <td colspan="1 "> <b>District :</b></td>
                <td colspan="0 "><?= $fetch_details['std_prmt_dist'] ?></td>
                <td colspan="3 "> <b>State :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_prmt_state'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="1 "> <b>Locality :</b></td>
                <td colspan="0 "> <?= $fetch_details['std_prmt_locality'] ?></td>
                <td colspan="3 "> <b>Town/City :</b> </td>
                <td colspan="0 "><?= $fetch_details['std_prmt_add'] ?></td>

            </tr>
            <tr>
                <td><b>Police Station :</b> </td>
                <td colspan="5 "><?= $fetch_details['std_prmt_ps'] ?></td>
            </tr>



            <tr>
            <tr>
                <td colspan="8 "> <b>PRESENT ADDRESS</b> </td>

            </tr>
            <tr>
                <td colspan="1 "> <b>Address Line 1 :</b></td>
                <td colspan="0 "><?= $fetch_details['std_pres_add'] ?></td>
                <td colspan="3 "> <b>PIN Code :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_pres_pin'] ?>
                </td>
            </tr>

            <tr>
                <td colspan="1 "> <b>District :</b></td>
                <td colspan="0 "><?= $fetch_details['std_pres_dist'] ?></td>
                <td colspan="3 "> <b>State :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_pres_state'] ?> </td>
            </tr>
            <tr>
                <td colspan="1 "> <b>Locality :</b></td>
                <td colspan="0 "><?= $fetch_details['std_pres_locality'] ?></td>
                <td colspan="3 "> <b>Town/City :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_pres_add'] ?>
                </td>
            </tr>
            <tr>
                <td><b>Police Station :</b> </td>
                <td colspan="5 "><?= $fetch_details['std_pres_ps'] ?></td>
            </tr>




            <tr>
                <td colspan="1 "> <b>Guardian Name :</b></td>
                <td colspan="0 "><?= $fetch_details['std_father'] ?></td>
                <td colspan="3 "> <b>Guardian Mobile No. :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_mob'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="1 "> <b>Guardian Occupation :</b></td>
                <td colspan="0 "><?= $fetch_details['std_grdn_occ'] ?></td>
                <td colspan="3 "> <b>Guardian Income :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_grdn_inc'] ?> </td>
            </tr>
            <tr>
                <td colspan="1 "> <b>Local Guardian Name :</b> </td>
                <td colspan="0 "> <?= $fetch_details['std_l_grdn'] ?></td>
                <td colspan="3 "> <b>Local Grd. Mobile No. :</b></td>
                <td colspan="0 "><?= $fetch_details['std_mob'] ?></td>

            </tr>







            <tr>
                <td colspan="8 "> <b>EDUCATIONAL DETAILS (10th) : </b> </td>


            </tr>

            <tr>
                <td colspan="1 "> <b>Board:</b> </td>
                <td colspan="0 "> <?= $fetch_details['hslc_board'] ?> </td>
                <td colspan="3 "> <b>Institute :</b></td>
                <td colspan="0 "><?= $fetch_details['institution_name'] ?></td>

            </tr>
            <tr>
                <td colspan="1 "> <b>Passing Year :</b> </td>
                <td colspan="0 "> <?= $fetch_details['hslc_year'] ?></td>
                <td colspan="3 "> <b>Roll No :</b></td>
                <td colspan="0 "><?= $fetch_details['hslc_roll_no'] ?></td>

            </tr>

            <tr>
                <td> <b>Subjects Taken :</b> </td>
                <td colspan="5 "><?= $fetch_details['hslc_subjects'] ?></td>
            </tr>
            <tr>

                <td colspan="1 "> <b>Total Marks :</b></td>
                <td colspan="0 "><?= $fetch_details['hslc_toal_marks'] ?></td>
                <td colspan="3 "> <b>Marks Obtained :</b></td>
                <td colspan="0 "><?= $fetch_details['hslc_obt_mark'] ?></td>


            </tr>


            <tr>
                <td> <b>Percentage :</b> </td>
                <td colspan="5 "><?= $fetch_details['hslc_percentage'] ?></td>

            </tr>




            <tr>
                <td colspan="5 "> <b>EDUCATIONAL DETAILS (12th) : </b> </td>


            </tr>

            <tr>
                <td colspan="1 "> <b>Board :</b> </td>
                <td colspan="0 "> <?= $fetch_details['hs_board'] ?> </td>
                <td colspan="3 "> <b>Institute :</b></td>
                <td colspan="0 "><?= $fetch_details['hs_inst_name'] ?></td>

            </tr>

            <tr>
                <td colspan="1 "> <b>Stream :</b> </td>
                <td colspan="0 "> <?= $fetch_details['hs_stream'] ?> </td>
                <td colspan="3 "> <b>Passing Year :</b></td>
                <td colspan="0 "><?= $fetch_details['hs_year'] ?></td>

            </tr>


            <tr>
                <td colspan="1 "> <b>Roll No. :</b> </td>
                <td colspan="0 "> <?= $fetch_details['hs_roll_no'] ?> </td>
                <td colspan="3 "> <b>Subjects Taken :</b></td>
                <td colspan="0 "><?= $fetch_details['hs_subjects'] ?></td>

            </tr>

            <tr>

                <td colspan="1 "> <b>Total Marks :</b></td>
                <td colspan="0 "><?= $fetch_details['hs_toal_marks'] ?></td>
                <td colspan="3 "> <b>Marks Obtained :</b></td>
                <td colspan="0 "><?= $fetch_details['hs_mark_obt'] ?></td>


            </tr>

            <tr>
                <td> <b>Percentage :</b> </td>
                <td colspan="5 "><?= $fetch_details['hs_percentage'] ?></td>
            </tr>
            

            <?php
            if ($fetch_prgm['prgm_type'] != 'HS') {
            ?>

                <!-- <tr>
                    <td colspan="5 "> <b>GRADUATION :</b> </td>


                </tr> -->


                <!-- <tr>
                    <td colspan="1 "> <b>Board/University :</b> </td>
                    <td colspan="0 "> <?= $fetch_details['ug_uni'] ?></td>
                    <td colspan="3 "> <b>Institute :</b></td>
                    <td colspan="0 "><?= $fetch_details['ug_inst'] ?></td>

                </tr> -->
                <!-- <tr>
                    <td colspan="1 "> <b>Degree Name :</b> </td>
                    <td colspan="0 "><?= $fetch_details['ug_degree'] ?></td>
                    <td colspan="3 "> <b>Passing Status :</b></td>
                    <td colspan="0 ">Yes<?= $fetch_details['ug_pass_stst'] ?></td>

                </tr> -->

                <!-- <tr>
                    <td colspan="1 "> <b>Passing Year :</b> </td>
                    <td colspan="0 "><?= $fetch_details['ug_pass_year'] ?></td>
                    <td colspan="3 "> <b>Roll No. :</b></td>
                    <td colspan="0 "><?= $fetch_details['gradu_roll_no'] ?></td>

                </tr> -->

                <!-- <tr>
                    <td colspan="1 "> <b>Percentage :</b> </td>
                    <td colspan="0 "><?= $fetch_details['ug_percentage'] ?></td>
                    <td colspan="3 "> <b>Grade/CGPA :</b></td>
                    <td colspan="0 "><?= $fetch_details['ug_percentage'] ?></td>

                </tr> -->
            <?php
            }
            ?>
            <tr>
                <td colspan="8 "> <b><u><br></u></b>
                </td>

            </tr>


            <tr>
                <td colspan="8 "> <b><u>BANK DETAILS : </u></b> </td>

            </tr>

            <tr>
                <td colspan="1 "> <b>Bank Name :</b> </td>
                <td colspan="0 "><?= $fetch_details['std_bank'] ?></td>
                <td colspan="3 "> <b>Bank Branch :</b></td>
                <td colspan="0 "><?= $fetch_details['std_bank_branch'] ?></td>

            </tr>
            <tr>
                <td colspan="1 "> <b>Account Holder Name :</b> </td>
                <td colspan="0 "><?= $fetch_details['std_bank_holder'] ?></td>
                <td colspan="3 "> <b>Bank IFSC :</b></td>
                <td colspan="0 "><?= $fetch_details['std_bank_ifsc'] ?></td>

            </tr>

            <tr>
                <td> <b>Account No. :</b> </td>
                <td colspan="5 "><?= $fetch_details['std_bank_ac_no'] ?></td>
            </tr>
            <tr>
                <td colspan="1 "> <b>Payment Status :</b> </td>
                <?php
                if ($fetch_details['pay_status'] != "") {
                ?>
                    <td colspan="0 ">Success</td>
                <?php } else {
                ?>
                    <td colspan="0 ">Not Paid</td>

                <?php
                } ?>
                <td colspan="3 "> <b>Uploaded Documents :</b></td>

                <td colspan="0 ">

                    <?php
                    if ($fetch_details['std_hslc_admit'] != "") {
                        echo "HSLC Admit";
                    }
                    if ($fetch_details['std_hslc_marksheet'] != "") {
                        echo ", HSLC Marksheet";
                    }
                    if ($fetch_details['std_hgql_marksheet'] != "") {
                        echo ", HS Marksheet";
                    }
                    if ($fetch_details['std_auth_id'] != "") {
                        echo ", Domicial Documents";
                    }
                    ?>

                </td>

            </tr>

            <tr>
                <td colspan="4 ">
                    <font size="2 "> <b>Date of Application : <?= $fetch_details['std_reg_date'] ?><br>
                            <br>

                    </font>
                   
                    <svg id="barcode"></svg>
                    
                </td>
                <td width="17% " valign="bottom " align="center "><br>
                    <img src="<?= $fetch_details['std_sign'] ?>" style="width: 100px; height: 50px; " /><br>
                    Signature <br />
                    of the Candidate
                </td>
            </tr>
            

        </table>
        <?php
        if ($fetch_user['user_status'] != 'pre_final') {
        ?>
            <center><button type="button" class="btn btn-warning" id="printbtn" onclick="window.print()">Print Form</button>
            </center>
            <br>


            <form action="" method="post">
                <center><button type="submit" name="submit_preview" class="btn btn-success">Submit</button>
                </center>
            </form>

        <?php
        } else {
        ?>
            <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

            <script>
                JsBarcode("#barcode", "<?= $fetch_details['std_application_no']  ?>", {
                    height: 50
                });
                window.print();
                window.onafterprint = function(event) {
                    window.location.href = 'std-profile.php'
                };
            </script>
        <?php
        }
        ?>

    </body>

    </html>
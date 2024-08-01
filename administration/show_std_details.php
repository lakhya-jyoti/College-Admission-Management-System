<?php
include('includes/header.php');
include('includes/sidebar.php');


$det = $_GET['id'];
if (isset($det)) {
    $select = "select * from applicants inner join applicants_edu_det on applicants.applicants_id = applicants_edu_det.applicants_id where applicants.applicants_id = '$det'";
    $stmt = $con->prepare($select);
    $stmt->execute();
    $fetch_details = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $fetch_details['std_f_name'] . " " . $fetch_details['std_m_name'] . " " . $fetch_details['std_l_name'];
    $core_sub_pref = $fetch_details['std_core_sub1'] . "," . $fetch_details['std_std_core_sub2'] . "," . $fetch_details['std_core_sub3'];
    $GE_sub_pref = $fetch_details['std_core_sub1'] . "," . $fetch_details['std_std_core_sub2'] . "," . $fetch_details['std_core_sub3'];
}

if (isset($_POST['rej_submit'])) {
    $reason = $_POST['reason'];
    $update = "update applicants set reason_for_rejection = :reason , std_status = 'Rejected' where applicants_id = :det";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':reason', $reason);
    $stmt->bindParam(':det', $det);
    if ($stmt->execute()) {
?>
        <script>
            alert("Successfully Updated");
            history.go(-2);
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something Went Wrong !!!");
            history.go(-1);
        </script>
    <?php
    }
}
if (isset($_POST['add_approve'])) {
    $update = "update applicants set std_status = 'Approved' where applicants_id = :det";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':det', $det);
    if ($stmt->execute()) {
    ?>
        <script>
            alert("Successfully Updated");
            history.go(-2);
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something Went Wrong !!!");
            history.go(-1);
        </script>
<?php
    }
}
?>
<main id="main" class="main">



    <section class="section">


        <html>

        <head>
            <title>North Lakhimpur College</title>
            <style>
                table {
                    border: 1px solid #150517 !important;
                }
            </style>
            <STYLE TYPE="text/css">
                TD {
                    font-family: Arial;
                    font-size: 8pt;
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
                <table style="BORDER-COLLAPSE: collapse; border: 1px solid #150517 ;" bgcolor="white" border="1" bordercolor="#000000" cellpadding="2" cellspacing="-2" width="100%" align="center">


                    <tr>
                        <td><b>Application no : </b></td>
                        <td> <b><?= $fetch_details['std_application_no'] ?></b></td>
                        <td width="18% " colspan="4 " rowspan="7 " valign="top " align="center "><img src="<?= $fetch_details['std_pass_photo'] ?>" style="width: 100px; height: 120px; " /><br />

                        </td>
                    </tr>
                    <tr>
                        <?php
                        $select = "select * from applicants inner join program on applicants.std_course = program.prgm_id where applicants.applicants_id = '$det'";
                        $stmt = $con->prepare($select);

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

                        <tr>
                            <td colspan="5 "> <b>GRADUATION :</b> </td>


                        </tr>


                        <tr>
                            <td colspan="1 "> <b>Board/University :</b> </td>
                            <td colspan="0 "> <?= $fetch_details['ug_uni'] ?></td>
                            <td colspan="3 "> <b>Institute :</b></td>
                            <td colspan="0 "><?= $fetch_details['ug_inst'] ?></td>

                        </tr>
                        <tr>
                            <td colspan="1 "> <b>Degree Name :</b> </td>
                            <td colspan="0 "><?= $fetch_details['ug_degree'] ?></td>
                            <td colspan="3 "> <b>Passing Status :</b></td>
                            <td colspan="0 ">Yes<?= $fetch_details['ug_pass_stst'] ?></td>

                        </tr>

                        <tr>
                            <td colspan="1 "> <b>Passing Year :</b> </td>
                            <td colspan="0 "><?= $fetch_details['ug_pass_year'] ?></td>
                            <td colspan="3 "> <b>Roll No. :</b></td>
                            <td colspan="0 "><?= $fetch_details['gradu_roll_no'] ?></td>

                        </tr>

                        <tr>
                            <td colspan="1 "> <b>Percentage :</b> </td>
                            <td colspan="0 "><?= $fetch_details['ug_percentage'] ?></td>
                            <td colspan="3 "> <b>Grade/CGPA :</b></td>
                            <td colspan="0 "><?= $fetch_details['ug_percentage'] ?></td>

                        </tr>
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
                <div class="row">

                    <div class="col-12">



                        <h4 style="color:blue; text-align: center;padding-bottom: 5px; ">ID (ADHAAR/PAN/VOTER ID)</h4>


                        <div class="form-group row">

                            <div class="col-8">

                                <br>

                                <!-- <img style="width: 100%; height:100% " src="<?= $fetch_details['std_auth_id'] ?>"> -->
                                <iframe src="<?= $fetch_details['std_auth_id'] ?>" style="height:1200px;width:1000px;" frameborder="0"></iframe>

                                <br>
                            </div>
                        </div>

                    </div>

                </div> <br>

                <div class="row">

                    <div class="col-4">


                        <h4 style="color:blue;text-align: center;padding-bottom: 5px; ">10th ADMIT</h4>



                        <div class="form-group row">

                            <div class="col-12">
                                <br>
                                <iframe src="<?= $fetch_details['std_hslc_admit'] ?>" style="height:1200px;width:1000px;" frameborder="0"></iframe>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-4">
                        <h4 style="color:blue;text-align: center;padding-bottom: 5px; ">10th MARKSHEET</h4>


                        <div class="form-group row">

                            <div class="col-12">
                                <br>
                                <iframe src="<?= $fetch_details['std_hslc_marksheet'] ?>" style="height:1200px;width:1000px;" frameborder="0"></iframe>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-4">

                        <h4 style="color:blue;text-align: center;padding-bottom: 5px; ">10th CERTIFICATE</h4>


                        <div class="form-group row">

                            <div class="col-12">
                                <br>
                                <!-- <iframe src="<?= $fetch_details['std_hslc_admit'] ?>" style="height:1200px;width:1120px;"
        frameborder="0"></iframe> -->
                                <br>
                            </div>
                        </div>

                    </div>

                </div>

                <br>

                <div class="row">

                    <div class="col-4">

                        <h4 style="color:blue;text-align: center;padding-bottom: 5px; ">12th ADMIT</h4>



                        <div class=" form-group row">

                            <div class="col-12">
                                <br>
                                <iframe src="<?= $fetch_details['std_hslc_admit'] ?>" style="height:1200px;width:1000px;" frameborder="0"></iframe>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-4">
                        <h4 style="color:blue;text-align: center;padding-bottom: 5px; ">12th MARKSHEET</h4>



                        <div class="form-group row">

                            <div class="col-12">
                                <br>
                                <iframe src="<?= $fetch_details['std_hslc_marksheet'] ?>" style="height:1200px;width:1000px;" frameborder="0"></iframe>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
                <br>
                <br>
                <form action="" method="post">
                    <center><button type="submit" name="add_approve" class="btn btn-success" id="app-btn">APPROVE</button>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Reject
                </button>
                </center>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reason for Rejection</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Reason For Rejection</label>
                                        <input type="text" name="reason" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <button type="submit" name="rej_submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <br>

            </body>

            </html>

    </section>
    <script>
        reject_btn = document.getElementById('rej_btn');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode("#barcode", "<?= $fetch_details['std_application_no'] ?>", {
            height: 50
        });
    </script>
    <?php
    include('includes/footer.php');
    ?>
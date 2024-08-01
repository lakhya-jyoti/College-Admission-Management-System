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

if(isset($_POST['rej_submit'])){
    $reason = $_POST['reason'];
    $update = "update applicants set reason_for_rejection = :reason , std_status = 'Rejected' where applicants_id = :det";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':reason', $reason);
    $stmt->bindParam(':det', $det);
    if($stmt->execute()){
        ?>
        <script>
            alert("Successfully Updated");
            history.go(-2);
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Something Went Wrong !!!");
            history.go(-1);
        </script>
        <?php
    }
}
if(isset($_POST['add_approve'])){
    $update = "update applicants set std_status = 'Approved' where applicants_id = :det";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':det', $det);
    if($stmt->execute()){
        ?>
        <script>
            alert("Successfully Updated");
            history.go(-2);
        </script>
        <?php
    }else{
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


        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>NORTH LAKHIMPUR COLLEGE</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="<?= $web_socket ?>css/preview.css">
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <style type="text/css">
                @page {
                    size: auto;
                    margin: 10mm;
                    margin-right: -70px;
                    margin-left: -70px;
                }

                @media print {
                    a[href]:after {
                        content: none !important;
                    }
                }

                @media print {
                    #printbtn {
                        display: none !important;
                    }

                    .main-heading {
                        font-size: 25px !important;
                    }

                    .underline {
                        line-height: 27px !important;
                        text-decoration-style: dotted !important;
                    }
                }
            </style>
        </head>

        <body>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-1">

                    </div>

                    <div class="col-sm-10" style="border: 2px solid black; padding:15px;">

                        <div class="row">
                            <div class="col-2">
                                <img src="/images/logo.png" class="img-fluid">
                            </div>
                            <div class="col">
                                <div class="main-heading">
                                    <h3>NORTH LAKHIMPUR COLLEGE (AUTONOMOUS)</h3>

                                </div>
                                <p class="sub-heading"> ACCREDIATED BY NAAC WITH A++</p>
                                <div class="address"> North Lakhimpur College
                                    Khelmati, North Lakhimpur
                                    Dist- Lakhimpur, Assam-787031
                                </div>
                                <p class="email"> Email: nlcollege.autonomous@gmail.com, Website: www.nlc.ac.in</p>
                            </div>
                            <div class="col-sm-12">
                                <hr class="hrcls">
                            </div>

                        </div>



                        <div class="row">
                            <p id="message"></p>
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8" style="text-align: center;padding-bottom: 5px; color:green;">
                                <h4> <u>APPLICATION FORM</u></h4>
                                <br>
                            </div>

                            <div class="row">
                                <div class="col-2">

                                    <img style="width: 150px; height:150px " src="<?= $fetch_details['std_pass_photo'] ?>" width="150" height="150">
                                    <br>
                                </div>

                                <div class="col-10">
                                    <div class="form-group" style="float: right;">
                                        <br>
                                        <div class="col-8">

                                            <svg id="barcode"></svg>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-8" style="text-align: center;padding-bottom: 5px;">
                                <h3> <u><br></u></h3>
                                <br>
                            </div>




                        </div>

                        <div class="row">

                            <br>
                            <p style="color:green;"><b><u>PERSONAL DETAILS</u></b></p>
                            <div class="col-12">

                                <div class="form-group row">
                                    <div class="col-2">

                                        <label class="lable">Application No</label>
                                    </div>
                                    <div class="col-4"><b>
                                            : <?= $fetch_details['std_application_no'] ?>
                                        </b>
                                    </div>
                                    <div class="col-2">

                                        <label class="lable">Applicant's Name</label>
                                    </div>
                                    <div class="col-4">
                                        : <?= $name ?>
                                    </div>



                                </div>



                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Applicant's Email</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_email'] ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Mobile no</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_mob'] ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Date of Birth</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_dob'] ?>

                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Gender</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_sex'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Religion</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_religion'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Blood Group</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_blood'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Caste</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_caste'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Study continue</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_stydy_cnt'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">PWD</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_pwd'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Nationality</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_nation'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Home Distance</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_distance'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Father Name</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_father'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Mother Name</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_mother'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Guardain Name</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_grdn'] ?>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Guardian Mobile no</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_grdn'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Guardian Occupation</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_grdn_occ'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Guardian Income</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_grdn_inc'] ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">

                                        <label class="lable">Local Guardian Name</label>
                                    </div>
                                    <div class="col-8">
                                        : <?= $fetch_details['std_l_grdn'] ?>

                                    </div>
                                </div>
                                <div class="col-4">

                                    <label class="lable">Local Guardian Mobile no</label>
                                </div>
                                <div class="col-8">
                                    <!-- <?= $fetch_details['std_l_grdn_mob'] ?> -->

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <hr class="hrcls">
                            </div>
                            <p style="color:green;"><b><u>ADRESS DETAILS</u></b></p>

                            <p style="color:purple"><b>Parmenant Address</b></p>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">STD PRMT ADD</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_prmt_add'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">PIN Code</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_prmt_pin'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">District</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_prmt_dist'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Sate</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_prmt_state'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Locality</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_prmt_locality'] ?>


                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Police Station</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_prmt_ps'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Town/City</label>
                                </div>
                                <div class="col-8">
                                    ab
                                </div>
                            </div>
                            <br>


                            <p style="color:purple"><b>Present Address</b></p>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">std-prmt-address</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_pres_add'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">PIN Code</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_pres_pin'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">District</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_pres_dist'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Sate</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_pres_state'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Locality</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_pres_locality'] ?>


                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Police Station</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_pres_ps'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Town/City</label>
                                </div>
                                <div class="col-8">
                                    : ab
                                </div>
                            </div>
                            <br>

                            <br>
                            <p style="color:green;"><b><u>APPLIED PROGRAM DETAILS</u></b></p>

                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Program name</label>
                                </div>
                                <div class="col-8">
                                <?php
                            $select = "select * from applicants inner join program on applicants.std_course = program.prgm_id where applicants.applicants_id = '$det'";
                                $stmt = $con->prepare($select);
                                
                                $stmt->execute();
                                $fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>

                                : <?= $fetch_prgm['prgm_name'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Core Subject Preferences</label>
                                </div>
                                <div class="col-8">
                                    : <?= $core_sub_pref ?>


                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">General Elective Preferences</label>
                                </div>
                                <div class="col-8">
                                    : <?= $GE_sub_pref ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">MIL</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['std_mil'] ?>

                                </div>
                            </div>
                            <br>
                            <p style="color:green;"><b><u>ACADEMIC DETAILS</u></b></p>

                            <p style="color:purple"><b>HSLC or Class 10th Equivalent</b></p>

                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Board</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_board'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Institute Name</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['institution_name'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Passing Year</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_year'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">10th Roll no</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_roll_no'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Subjects taken</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_subjects'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Total Marks</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_toal_marks'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Marks Obtained</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_obt_mark'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Percentage</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_percentage'] ?>

                                </div>
                            </div>
                            <br>

                            <p style="color:purple"><b>Class 12th or Equivalent</b></p>


                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Board</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_board'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Institute Name</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hs_inst_name'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Passing Year</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hs_year'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Stream</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hslc_stream'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">12th Roll no</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hs_roll_no'] ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Subjects taken</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hs_subjects'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Total Marks</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hs_toal_marks'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Marks Obtained</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['hs_mark_obt'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Percentage</label>
                                </div>
                                <div class="col-8">
                                    <!-- <?= $fetch_details['hs_percentage'] ?> -->

                                </div>
                            </div>

                            <br>

                            <p style="color:purple"><b>Graduation</b></p>


                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Board/University</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['ug_uni'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Institute Name</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['ug_inst'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Degree Name</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['ug_degree'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Roll no</label>
                                </div>
                                <div class="col-8">
                                    : <?= $fetch_details['gradu_roll_no'] ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Passing Status</label>
                                </div>

                                <div class="col-8">
                                    : <?= $fetch_details['ug_pass_stst'] ?>


                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Passing Year</label>
                                </div>
                                <div class="col-8">
                                    <!-- <?= $fetch_details['ug_year'] ?> -->

                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Percentage</label>
                                </div>
                                <div class="col-8">
                                    <!-- <?= $fetch_details['ug_percentage'] ?> -->

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">

                                    <label class="lable">Grade/CGPA</label>
                                </div>
                                <div class="col-8">
                                    <!-- <?= $fetch_details['ug_cgpa-grd'] ?> -->

                                </div>
                            </div>

                        </div>
                        <br>
                        <p style="color:green"><b>Bank Details</b></p>

                        <div class="form-group row">
                            <div class="col-4">

                                <label class="lable">Bank Name</label>
                            </div>
                            <div class="col-8">
                                : <?= $fetch_details['std_bank'] ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-4">

                                <label class="lable">Bank Branch</label>
                            </div>
                            <div class="col-8">
                                : <?= $fetch_details['std_bank_branch'] ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">

                                <label class="lable">Account Holder</label>
                            </div>
                            <div class="col-8">
                                : <?= $fetch_details['std_bank_holder'] ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">

                                <label class="lable">IFSC</label>
                            </div>
                            <div class="col-8">
                                : <?= $fetch_details['std_bank_ifsc'] ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">

                                <label class="lable">Account No</label>
                            </div>
                            <div class="col-8">
                                : <?= $fetch_details['std_bank_ac_no'] ?>

                            </div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-8">
                                        <label class="lable" style="color:green">Application Fees</label>
                                    </div>
                                    <div class="col-4">
                                        : 2000
                                        INR
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="lable" style="color:green">Payment Status</label>
                                    </div>
                                    <div class="col-8">
                                        : AB

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- 
                                <div class="form-group row">

                                    <div class="col-8">
                                        <br>
                                        <label class="lable" style="color:green">Documents Uploaded</label>
                                    </div>
                                    <div class="col-4"><br>
                                        : prc, admit
                                        <br>
                                        <a href="std-view-docs.php">View Documents</a>

                                    </div>
                                    <div class="col-4"><br>

                                    </div>

                                </div> -->

                            </div>


                            <div class="row">
                                <div class="col-11">
                                    <div class="form-group" style="float: right;">
                                        <br>
                                        <div class="col-8">

                                            <img style="width: 150px; height:150px " src="<?= $fetch_details['std_sign'] ?>" width="200" height="100">


                                        </div>
                                        <label class="lable" style="color:green">Signature</label>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Row 4 end -->
                    <!-- php -->
                </div>

                <div class="col-2">

                </div>

            </div>

            <br>


            <br>

            <h4 style="text-align: center;padding-bottom: 5px; color:green;"> <u>UPLOADED DOCUMENTS</u></h4>
            <br>


            <!-- <} -->
            <div class="container-fluid">

                <!-- <div class="row">

            <div class="col-4">

                <div class="">

                    <label class="lable" style="color:blue;">ID (ADHAAR/PAN/VOTER ID)</label>
                </div>

                <div class="form-group row">

                    <div class="col-4">
                        <br>
                        <!-- <img style="width: 100%; height:100% " src="<?= $fetch_details['std_hslc_admit'] ?>" width="150"
            height="150"> -->
                <!-- <iframe src="<?= $fetch_details['std_hslc_admit'] ?>" style="height:1200px;width:1120px;"
                            frameborder="0"></iframe>
                        <br>
                    </div>
                </div>

            </div> -->

                <!-- </div>
        <br> -->
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



            </div>

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
<?php
$msg = "";
include_once 'includes/header.php';
$_SESSION['pre_final'] = "pre_final";

if (isset($_SESSION['pre_final']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "pre_final") {
?>
    <script>
        history.go(-1);
    </script>

    <?php
}

if (isset($_POST['make_payment'])) {
    $update = 'update applicants set pay_status = "success" where std_mob = :username or std_email = :username';
    $stmt = $con->prepare($update);
    $stmt->bindParam(':username', $_SESSION['username']);

    if ($stmt->execute()) {
        $p_ref_no = "PAYREF" . date("ymdHis");
        $status = "Success";
        $amnt = "500";
        $insert = 'INSERT INTO `payment`(`app_id`,  `p_ref_no`, `p_status`, `p_amnt`) values (:app_id,:ref_no,:statu,:amnt)';
        $stmt = $con->prepare($insert);
        $stmt->bindParam(':app_id', $fetch_user['applicants_id']);
        $stmt->bindParam(':ref_no', $p_ref_no);
        $stmt->bindParam(':statu', $status);
        $stmt->bindParam(':amnt', $amnt);
        $stmt->execute();
    ?>
        <script>
            alert("Your Payment Was successfull");
            location.href = 'std-profile.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something Went Wrong");
            location.href = 'std-profile.php';
        </script>
<?php
    }
}
?>
<?php
$select = "SELECT * FROM `applicants` where std_mob = :username or std_email = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$fetch_applicants = $stmt->fetch(PDO::FETCH_ASSOC);

$select1 = "select * from applicants inner join program on applicants.std_course = program.prgm_id where std_mob = :username or std_email = :username";
$stmt = $con->prepare($select1);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php
// Take addmission
if (isset($_POST['take_admission'])) {
    $update = "update applicants set addmission_status = 1 where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $select_roll = "select * from roll_no inner join program on program.prgm_id = roll_no.prgm_id";
    $stmt = $con->prepare($select_roll);
    $stmt->execute();
    $fetch_prgm_det = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fetch_prgm['prgm_type'] == 'HS') {
        $sl = sprintf("%03d", $fetch_prgm_det['roll_no'] + 1);
        $std_roll_no = date('y') . $fetch_prgm_det['roll_desc'] . $sl;
        $update = "UPDATE `roll_no` SET roll_no='$sl' where roll_desc = '$fetch_prgm[prgm_type]'";
    } elseif ($prgm_type == 'UG-GENERAL' || $prgm_type == 'UG-PROFESSIONAL') {
        $sl = sprintf("%03d", $fetch_prgm_det['roll_no'] + 1);
        $std_roll_no = date('y') . $fetch_prgm_det['roll_desc'] . $sl;
        $update = "UPDATE `roll_no` SET roll_no='$sl' where roll_desc = '$fetch_prgm[prgm_type]'";
    } elseif ($prgm_type == 'PG-GENERAL' || $prgm_type == 'PG-PROFESSIONAL' || $prgm_type == 'PG-DIPLOMA') {
        $sl = sprintf("%03d", $fetch_prgm_det['roll_no'] + 1);
        $std_roll_no = date('y') . $fetch_prgm_det['roll_desc'] . $sl;
        $update = "UPDATE `roll_no` SET roll_no='$sl' where roll_desc = '$fetch_prgm[prgm_type]'";
    }
    $stmt = $con->prepare($update);
    $stmt->execute();

    $insert = "INSERT INTO `students`(`applicant_id`, `std_roll_no`, `prgm_id`) VALUES (:applicants_id,:std_roll_no,:prgm_id)";
    $stmt = $con->prepare($insert);
    $stmt->bindParam(':applicants_id', $fetch_applicants['applicants_id']);
    $stmt->bindParam(':std_roll_no', $std_roll_no);
    $stmt->bindParam(':prgm_id', $fetch_prgm['prgm_id']);
    if ($stmt->execute()) {


?>
        <script>
            alert('Congratulation ! You are successfully addmitted into North Lakhimpur College(A)');
            location.href = "std-profile.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something Went Wrong');
            location.href = "std-profile.php";
        </script>
<?php
    }
}
?>


<div class="col-sm-9">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <?php

                if ($fetch_applicants['addmission_status'] == "" || $fetch_applicants['addmission_status'] == "0") {
                ?>
                    <div class="card">

                        <div class="card-body table-responsive">
                            <h5 class="card-title">Applicants</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-hover table-responsive" style="font-size: 14px;">
                                <thead>
                                    <tr>

                                        <th scope="col">Application ID</th>
                                        <th scope="col">Applicant Name</th>
                                        <th scope="col">Applied Program</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="">

                                    <tr>


                                        <td><?= $fetch_applicants['std_application_no'] ?></td>
                                        <td><?= $std_name ?></td>
                                        <td><?= $fetch_prgm['prgm_name'] ?></td>
                                        <?php
                                        if ($fetch_applicants['pay_status'] != 'success') {
                                        ?>
                                            <td>
                                                <form action="" method="post">
                                                    <button type="submit" class="btn btn-success" name="make_payment">Make Payment</button>
                                                </form>

                                            </td>
                                            <?php
                                        } else {
                                            if ($fetch_applicants['std_status'] == 'Approved') {
                                            ?>
                                                <td>
                                                    <form action="" method="post">
                                                        <button type="submit" class="btn btn-success" name="take_admission">Take Admission</button>
                                                    </form>

                                                </td>
                                            <?php
                                            } elseif ($fetch_applicants['std_status'] == 'Registered') {
                                            ?>
                                                <td>
                                                    <p class="text-warning" style="font-weight: bold;">Your Application is under Process</p>
                                                </td>
                                            <?php
                                            } elseif ($fetch_applicants['std_status'] == 'Rejected') {
                                            ?>
                                                <td>
                                                    <p class="text-danger" style="font-weight: bold;">Your Application is Rejected due to: <?= $fetch_applicants['reason_for_rejection'] ?></p>
                                                </td>
                                            <?php
                                            } elseif ($fetch_applicants['std_status'] == 'verified') {
                                            ?>
                                                <td>
                                                    <p class="text-success" style="font-weight: bold;">Your Application is Verified By Admin</p>
                                                </td>
                                        <?php
                                            }
                                        }

                                        ?>
                                        <td>
                                            <a href="preview.php" class="btn btn-success"><i class="bi bi-receipt-cutoff"></i></a>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-success my-5" style="margin-top: 20px; color:seagreen;" role="alert">
                        <b style="opacity: .90 !important;">Congratulation ! You are successfully addmitted into North Lakhimpur College(A)</b>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h5 class="card-title">Applicants</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-hover table-responsive" style="font-size: 14px;">
                                <thead>
                                    <tr>

                                        <th scope="col">Application ID</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Applied Program</th>
                                        <th scope="col">Roll No</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="">

                                    <tr>


                                        <td><?= $fetch_applicants['std_application_no'] ?></td>
                                        <td><?= $std_name ?></td>
                                        <td><?= $fetch_prgm['prgm_name'] ?></td>

                                        <td>
                                            <?php
                                            $select = "select * from students inner join applicants on applicants.applicants_id = students.applicant_id  where applicants.applicants_id = '$fetch_applicants[applicants_id]'";
                                            $stmt = $con->prepare($select);
                                            $stmt->execute();
                                            $fetch_roll = $stmt->fetch(PDO::FETCH_ASSOC);

                                            ?>
                                            <b class="text-success"><?= $fetch_roll['std_roll_no'] ?></b>

                                        </td>
                                        <td>
                                            <a href="preview.php" class="btn btn-primary"><i class="bi bi-receipt-cutoff"></i></a>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                <?php
                }
                ?>

            </div>
        </div>
    </section>

</div>


<?php
include_once 'includes/footer.php';
?>
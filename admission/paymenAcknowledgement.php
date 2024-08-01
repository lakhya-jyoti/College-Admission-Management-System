<?php
include_once 'includes/header.php';
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
            location.href = 'paymenAcknowledgement.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Something Went Wrong");
            location.href = 'paymenAcknowledgement.php';
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
                $select = "select * from applicants where std_email = :username or std_mob = :username";
                $stmt = $con->prepare($select);
                $stmt->bindParam(':username', $_SESSION['username']);
                $stmt->execute();
                $fetch_applicants = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($fetch_applicants['pay_status'] != 'success') {
                    if ($fetch_applicants['user_status'] == 'pre_final') {
                ?>
                        <td>
                            <b class="text-success">Please Pay the Fees.</b>
                            <form action="" method="post">
                                <button type="submit" class="btn btn-success" name="make_payment">Make Payment</button>
                            </form>
                        </td>
                    <?php
                    } else {
                    ?>
                        <td>
                            <b class="text-success">Please Complete Your Application First.</b>

                        </td>
                    <?php
                    }
                } else {
                    ?>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h5 class="card-title">Payment Receipt</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-hover table-responsive" style="font-size: 14px;">
                                <thead>
                                    <tr>

                                        <th scope="col">Application ID</th>
                                        <th scope="col">Applicant Name</th>

                                        <th scope="col">Reference No</th>


                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php



                                    $select = "select * from applicants inner join payment on applicants.applicants_id = payment.app_id where applicants.std_email = :username or applicants.std_mob = :username";
                                    $stmt = $con->prepare($select);
                                    $stmt->bindParam(':username', $_SESSION['username']);
                                    $stmt->execute();
                                    $fetch_applicants = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <tr>


                                        <td><?= $fetch_applicants['std_application_no'] ?></td>
                                        <td><?= $std_name ?></td>
                                        <td><?= $fetch_applicants['p_ref_no'] ?></td>
                                        <?php
                                        if ($fetch_applicants['pay_status'] != 'success') {
                                        ?>
                                            <td>
                                                <b class="text-success">Please Pay the Fees.</b>
                                            </td>
                                        <?php

                                        } else {

                                        ?>
                                            <td>
                                                <b class="text-success">Your Payment Was Successfull.</b>

                                            </td>
                                        <?php
                                        }
                                        ?>


                                        <?php
                                        if ($fetch_applicants['pay_status'] != 'success') {
                                            if ($fetch_applicants['user_status'] == "pre_final") {
                                        ?>
                                                <td>
                                                <td>
                                                    <form action="" method="post">
                                                        <button type="submit" class="btn btn-success" name="make_payment">Make Payment</button>
                                                    </form>

                                                </td>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <b class="text-success">Complete Your Application First.</b>

                                                </td>
                                            <?php
                                            }
                                        } else {

                                            ?>
                                            <td>
                                                <a href="pay_rec.php" class="btn btn-primary" target="_blank"><i class="bi bi-receipt-cutoff"></i></a>

                                            </td>
                                        <?php
                                        }
                                        ?>

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
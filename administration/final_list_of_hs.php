<?php
require('../includes/dbconfig.php');
header('Content-disposition: attachment; filename=data.xls');
header('Content-type: application/ms-excel');
if (isset($_POST['generate_hs_merit_list'])) {
    $prgm_name = $_POST['prgm_name'];
    $capacity = $_POST['intake_cap'];
    $pc_gen = $_POST['pc_gen'];
    $pc_obc = $_POST['pc_obc'];
    $pc_sc = $_POST['pc_sc'];
    $pc_st = $_POST['pc_st'];
    $pc_ews = $_POST['pc_ews'];

    $tot_pc = $pc_gen + $pc_obc + $pc_sc + $pc_st + $pc_ews;
    if ($tot_pc != 100) {
?>
        <script>
            alert('Total entered Percentage is not equals to 100');
            history.go(-1);
        </script>
        <?php
    } else {

        // Calculation of general merit percentage
        $gen_std_no = round($capacity * ($pc_gen / 100)) + 1;

        // Calculation of sc merit percentage
        $sc_std_no = round($capacity * ($pc_sc / 100)) + 1;
        // Calculation of sc merit percentage
        $st_std_no = round($capacity * ($pc_st / 100)) + 1;
        // Calculation of sc merit percentage
        $ews_std_no = round($capacity * ($pc_ews / 100)) + 1;
        // $crt_prc = "select  from applicants,"

        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 order by applicants_edu_det.hslc_percentage desc limit $gen_std_no";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);

        $stmt->execute();

        $update = "update applicants, applicants_edu_det, program set applicants_edu_det.m_status = 1, applicants.std_status = 'Approved' where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 order by applicants_edu_det.hslc_percentage desc limit $gen_std_no";
        $stmt2 = $con->prepare($update);
        $stmt2->bindParam(':prgm_name', $prgm_name);

        $stmt2->execute();

        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>
            <title>All Student List</title>
            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>
                    <center>-----North Lakhimpur College(A)-----</center><br>
                    <center>-----ALL APPLICSNTS LIST IN THE YEAR OF <?= date('Y') ?>-----</center><br>
                    <center>-----General Merit for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
        <?php

        }
    }
    if (isset($_POST['generate_hs_merit_list'])) {
        // OBC merit list
        // Calculation of obc merit percentage
        $obc_std_no = round($capacity * ($pc_obc / 100)) + 1;


        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'OBC/MOBC' order by applicants_edu_det.hslc_percentage desc limit $obc_std_no";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);
        $stmt->execute();

        $update = "update applicants, applicants_edu_det, program set applicants_edu_det.m_status = 1, applicants.std_status = 'Approved' where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'OBC/MOBC' order by applicants_edu_det.hslc_percentage desc limit $obc_std_no";
        $stmt2 = $con->prepare($update);
        $stmt2->bindParam(':prgm_name', $prgm_name);

        $stmt2->execute();

        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----OBC Merit for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
        <?php

        }
    }



    // sc merit list
    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'ST' order by applicants_edu_det.hslc_percentage desc limit $st_std_no";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);

        $stmt->execute();

        $update = "update applicants, applicants_edu_det, program set applicants_edu_det.m_status = 1, applicants.std_status = 'Approved' where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'ST' order by applicants_edu_det.hslc_percentage desc limit $st_std_no";
        $stmt2 = $con->prepare($update);
        $stmt2->bindParam(':prgm_name', $prgm_name);

        $stmt2->execute();

        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----ST Merit for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }


    // sc merit list
    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'SC' order by applicants_edu_det.hslc_percentage desc limit $sc_std_no";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);

        $stmt->execute();

        $update = "update applicants, applicants_edu_det, program set applicants_edu_det.m_status = 1, applicants.std_status = 'Approved' where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'SC' order by applicants_edu_det.hslc_percentage desc limit $sc_std_no";
        $stmt2 = $con->prepare($update);
        $stmt2->bindParam(':prgm_name', $prgm_name);

        $stmt2->execute();

        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----SC Merit for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }





    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'EWS' order by applicants_edu_det.hslc_percentage desc limit $ews_std_no";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);

        $stmt->execute();

        $update = "update applicants, applicants_edu_det, program set applicants_edu_det.m_status = 1, applicants.std_status = 'Approved' where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'EWS' order by applicants_edu_det.hslc_percentage desc limit $ews_std_no";
        $stmt2 = $con->prepare($update);
        $stmt2->bindParam(':prgm_name', $prgm_name);

        $stmt2->execute();

        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----EWS Merit for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }


    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0   order by applicants_edu_det.hslc_percentage desc";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);
        $stmt->execute();
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----General Waiting for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }



    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'OBC/MOBC'  order by applicants_edu_det.hslc_percentage desc";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);
        $stmt->execute();
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----OBC Waiting for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }



    
    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'SC'  order by applicants_edu_det.hslc_percentage desc";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);
        $stmt->execute();
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----SC Waiting for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }






    
    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'ST'  order by applicants_edu_det.hslc_percentage desc";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);
        $stmt->execute();
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----ST Waiting for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }





    
    if (isset($_POST['generate_hs_merit_list'])) {
        $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:prgm_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants_edu_det.m_status = 0 and applicants.std_caste = 'EWS'  order by applicants_edu_det.hslc_percentage desc";
        $stmt = $con->prepare($select);
        $stmt->bindParam(':prgm_name', $prgm_name);
        $stmt->execute();
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <style>
                table,
                th,
                td {
                    border: 1px solid black;
                    padding: 3px;
                    border-collapse: collapse;
                    text-align: center;
                    font-size: 12px;
                }

                p {
                    padding: 0;
                    margin: 0;
                }
            </style>

            <table style="margin: 0 auto;">
                <tbody>
                    <tr>
                        <td>Sl No</td>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>Program Name</th>
                        <th>Caste</th>
                        <th>Phone No</th>
                        <th>Father Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>

                    <center><br><br><br>-----EWS Waiting for HS-Commerce in the year of <?= date('Y') ?>-----</center><br>

                    <?php
                    $sl = 1;
                    while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $std_name = $fetch_seat['std_f_name'] . " " . $fetch_seat['std_m_name'] . " " . $fetch_seat['std_l_name'];
                    ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td style="text-align: left;"><?php echo $std_name ?></td>
                            <td><?php echo $fetch_seat['prgm_name'] ?></td>
                            <td><?php echo $fetch_seat['std_caste'] ?></td>
                            <td><?php echo $fetch_seat['std_mob'] ?></td>
                            <td style="text-align: left;"><?php echo $fetch_seat['std_father'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php
                        $sl++;
                    } ?>
                </tbody>
            </table>
<?php

        }
    }




}
?>
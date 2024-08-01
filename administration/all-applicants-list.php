<?php
require('../includes/dbconfig.php');
if (isset($_POST['generate_all_list'])) {
    
    // header('Content-disposition: attachment; filename=data.xls');
    // header('Content-type: application/ms-excel');
    $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:cr_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' order by applicants_edu_det.hslc_percentage desc;";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':cr_name', $_POST['cr_name']);
    $stmt->execute();
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
        p{
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
            <p style="text-align: left;">Total Applicants : <?=$stmt->rowCount()?></p>
            <?php
            $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:cr_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants.std_caste = 'General'";
            $stmt1 = $con->prepare($select);
            $stmt1->bindParam(':cr_name', $_POST['cr_name']);
            $stmt1->execute();
            ?>
             <p style="text-align: left;">Total General Caste Applicants : <?=$stmt1->rowCount()?></p>


            <?php
            $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:cr_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants.std_caste = 'OBC / MOBC'";
            $stmt2 = $con->prepare($select);
            $stmt2->bindParam(':cr_name', $_POST['cr_name']);
            $stmt2->execute();
            ?>
             <p style="text-align: left;">Total OBC/MOBC Caste Applicants : <?=$stmt2->rowCount()?></p>

             
            <?php
            $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:cr_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants.std_caste = 'SC'";
            $stmt3 = $con->prepare($select);
            $stmt3->bindParam(':cr_name', $_POST['cr_name']);
            $stmt3->execute();
            ?>
             <p style="text-align: left;">Total SC Caste Applicants : <?=$stmt3->rowCount()?></p>


            <?php
            $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:cr_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants.std_caste = 'ST'";
            $stmt4 = $con->prepare($select);
            $stmt4->bindParam(':cr_name', $_POST['cr_name']);
            $stmt4->execute();
            ?>
             <p style="text-align: left;">Total ST Caste Applicants : <?=$stmt4->rowCount()?></p>

            <?php
            $select = "select * from applicants, applicants_edu_det, program where applicants.applicants_id = applicants_edu_det.applicants_id and applicants.std_course=:cr_name and applicants.std_course=program.prgm_id and applicants.user_status = 'pre_final' and applicants.pay_status = 'success' and user_status!='Admin' and applicants.std_caste = 'EWS'";
            $stmt5 = $con->prepare($select);
            $stmt5->bindParam(':cr_name', $_POST['cr_name']);
            $stmt5->execute();
            ?>
             <p style="text-align: left;">Total EWS Caste Applicants : <?=$stmt5->rowCount()?></p><br>


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
    <div style="text-align: right; margin-top:100px;">
        <b>Principal's Signature</b>
    </div>
<?php
}
?>
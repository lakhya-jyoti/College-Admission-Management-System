<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>


    <?php
    require('../includes/dbconfig.php');
    header('Content-disposition: attachment; filename=data.xls');
    header('Content-type: application/ms-excel');

    if (isset($_POST['generate_list'])) {
        $category = $_POST['category'];
        $qry1 = "select * from merit_list where category='$category'";
        $stmt = $con->prepare($qry1);
        $stmt->execute();
        $fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC);
        $cap =  $fetch_seat['no_of_std'];
        $cat_id = $fetch_seat['m_id'];
        if ($category == "General") {
            $qry = "select  * from applicants_edu_det inner join applicants on applicants.applicants_id = applicants_edu_det.applicants_id where m_status = 0 ORDER BY `hslc_percentage` desc LIMIT $cap";
            $stmt = $con->prepare($qry);
            $stmt->execute();
            echo "General Merit List";
    ?>

            <table>
                <tbody>
                    <tr>
                        <th>id</th>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>
                    <?php while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $fetch_seat['applicants_id'] ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td><?php echo $fetch_seat['std_f_name'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php
            $update = "update applicants_edu_det set m_status = '$cat_id' where m_status = 0  ORDER BY `hslc_percentage` desc LIMIT $cap";
            $stmt = $con->prepare($update);
            $stmt->execute();
        } elseif ($category == 'OBC') {
            $qry = "select  * from applicants_edu_det inner join applicants on applicants.applicants_id = applicants_edu_det.applicants_id where m_status = 0 AND std_caste = 'OBC' ORDER BY `hslc_percentage` desc LIMIT $cap";
            $stmt = $con->prepare($qry);
            $stmt->execute();
            echo "OBC Merit List";

        ?>

            <table>
                <tbody>
                    <tr>
                        <th>id</th>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>
                    <?php while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $fetch_seat['applicants_id'] ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td><?php echo $fetch_seat['std_f_name'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php

            $update = "update applicants_edu_det inner join applicants on applicants.applicants_id = applicants_edu_det.applicants_id set m_status = '$cat_id' where applicants_edu_det.m_status = 0 and applicants.std_caste = 'OBC'  ORDER BY applicants_edu_det.hslc_percentage desc LIMIT $cap";
            $stmt = $con->prepare($update);
            $stmt->execute();
        } elseif ($category == 'SC') {
            $qry = "select  * from applicants_edu_det inner join applicants on applicants.applicants_id = applicants_edu_det.applicants_id where m_status = 0 AND std_caste = 'SC' ORDER BY `hslc_percentage` desc LIMIT $cap";
            $stmt = $con->prepare($qry);
            $stmt->execute();
            echo "<center style='color:green; font-size:22px;'>SC Merit List</center>";

        ?>

            <table>
                <tbody>
                    <tr>
                        <th></th>
                        <th>id</th>
                        <th>Application id</th>
                        <th>Name</th>
                        <th>%</th>

                    </tr>
                </tbody>
                <tbody>
                    <?php while ($fetch_seat = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td></td>
                            <td><?php echo $fetch_seat['applicants_id'] ?></td>
                            <td><?php echo $fetch_seat['std_application_no'] ?></td>
                            <td><?php echo $fetch_seat['std_f_name'] ?></td>
                            <td><?php echo $fetch_seat['hslc_percentage'] ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <?php

            $update = "update applicants_edu_det inner join applicants on applicants.applicants_id = applicants_edu_det.applicants_id set m_status = '$cat_id' where applicants_edu_det.m_status = 0 and applicants.std_caste = 'SC'  ORDER BY applicants_edu_det.hslc_percentage desc LIMIT $cap";
            $stmt = $con->prepare($update);
            $stmt->execute();
        }
    }
    ?>
</body>

</html>
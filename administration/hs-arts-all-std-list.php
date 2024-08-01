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


    $qry = "select  * from applicants_edu_det inner join applicants on applicants.applicants_id = applicants_edu_det.applicants_id where m_status = 1 and std_course = 15 and std_status = 'Approved' and pay_status = 'Success' ORDER BY `hslc_percentage`";
    $stmt = $con->prepare($qry);
    $stmt->execute();
    echo "HS-ARTS Merit List";

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




</body>

</html>
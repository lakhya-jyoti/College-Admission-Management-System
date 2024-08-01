<?php
$page = "list_postel";
include('includes/header.php');
include('includes/sidebar.php');
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Program Subject</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Program Subjects</li>
                <li class="breadcrumb-item active">Manage Program Subject</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <?php






        $select = "SELECT * FROM `program`";
        $stmt = $con->prepare($select);
        $stmt->execute();

        while ($fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= $fetch_prgm['prgm_id'] ?></th>
                        <th scope="col"><?= $fetch_prgm['prgm_name'] ?></th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <?php
                        $select = "SELECT * FROM `program_subject` inner join subjects on subjects.sub_id= program_subject.sub_id where prgm_id = $fetch_prgm[prgm_id]";
                        $stmt = $con->prepare($select);
                        $stmt->execute();
                        $fetch_subname = $stmt->fetch(PDO::FETCH_ASSOC); 
                        ?>
                            <th scope="row"><?= $fetch_subname['sub_name'] ?></th>
                        
                    </tr>

                </tbody>
            </table>


        <?php

        }

        ?>
    </section>


    <!-- ======= Footer ======= -->
    <?php
    include('includes/footer.php');
    ?>

    <!-- SELECT Orders.OrderID, Customers.CustomerName, Shippers.ShipperName FROM ((Orders INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID) INNER JOIN Shippers ON Orders.ShipperID = Shippers.ShipperID); -->
<?php
$page = "list_postel";
include('includes/header.php');
include('includes/sidebar.php');
 
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Applicant</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Applicants</li>
                <li class="breadcrumb-item active">Manage Applicant</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive-sm">
                        <h5 class="card-title">Applicants List</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-hover" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Application ID</th>
                                    <th scope="col">Mobile No</th>
                                    <th scope="col">Father Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "SELECT * FROM `applicants`where user_status !='Admin' && `std_status`='Rejected'  order by std_f_name asc";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl = 1;
                                while ($fetch_applicants = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $std_name = $fetch_applicants['std_f_name'] . " " . $fetch_applicants['std_m_name'] . " " . $fetch_applicants['std_l_name'];
                                ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $std_name ?></td>
                                        <td><?= $fetch_applicants['std_application_no'] ?></td>
                                        <td><?= $fetch_applicants['std_mob'] ?></td>
                                        <td><?= $fetch_applicants['std_father'] ?></td>
                                        
                                        <td>
                                            <a href="show_std_details.php?id=<?= $fetch_applicants['applicants_id'] ?>" class="btn btn-primary my-2" name="applicants_edit">Show</a>
                                            <form action="<?= $web_socket ?>includes/action.php" method="post">
                                                <input type="hidden" name="applicants_id" value="<?= $fetch_applicants['applicants_id'] ?>">
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" name="delete_applicants">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                    $sl++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>


</main><!-- End #main -->




<!-- ======= Footer ======= -->
<?php
include('includes/footer.php');
?>
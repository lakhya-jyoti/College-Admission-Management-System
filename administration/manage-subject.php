<?php
$page = "list_postel";
include('includes/header.php');
include('includes/sidebar.php');
?>



<main id="main" class="main" >

    <div class="pagetitle">
        <h1>Subject</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Subjects</li>
                <li class="breadcrumb-item active">Manage Subject</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive-sm">
                        <h5 class="card-title">Subjects List</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Subject Department</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "SELECT * FROM `subjects` INNER JOIN dept ON dept.dept_id=subjects.dept_id";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl=1;
                                while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $fetch_sub['sub_name'] ?></td>
                                        <td><?= $fetch_sub['dept_name'] ?></td>
                                        <td>
                                            <form action="<?=$web_socket?>administration/edit_subject.php" method="post">
                                                <input type="hidden" name="sub_id" value="<?=$fetch_sub['sub_id']?>">
                                                <button class="btn btn-primary my-2" name="sub_edit" onclick="return confirm('Are you sure?')">Edit</button>
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" name="delete_sub">Remove</button>
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
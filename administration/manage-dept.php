<?php
$page = "list_postel";
include('includes/header.php');
include('includes/sidebar.php');
?>



<main id="main" class="main" >

    <div class="pagetitle">
        <h1>Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Departments</li>
                <li class="breadcrumb-item active">Manage Department</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive-sm">
                        <h5 class="card-title">Departments List</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "SELECT * FROM `dept` order by dept_name asc";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl=1;
                                while ($fetch_dept = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $fetch_dept['dept_name'] ?></td>
                                        <td>
                                            <form action="<?=$web_socket?>administration/edit_department.php" method="post">
                                                <input type="hidden" name="dept_id" value="<?=$fetch_dept['dept_id']?>">
                                                <button class="btn btn-primary my-2" name="dept_edit" onclick="return confirm('Are you sure?')">Edit</button>
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" name="delete_dept">Remove</button>
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
<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Capacity</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">List Master</li>
                <li class="breadcrumb-item active">Course wise applicants</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">HS Merit List Generation(All)</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 " method="post" action="final_list_of_hs.php">



                        <label for="validationCustom02" class="form-label">Select Course</label>
                        <div class="input-group col-md-12">

                            <select class="form-select" name="prgm_name" required>
                                <option value="">--select--</option>
                                <?php
                                $select = "SELECT * FROM `program` where prgm_type = 'HS'";
                                $stmt = $con->prepare($select);
                                $stmt->execute();

                                while ($fetch_merit = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $fetch_merit['prgm_id'] ?>"><?= $fetch_merit['prgm_name'] ?></option>
                                <?php } ?>
                            </select>

                        </div>
                 
                        <label for="validationCustom02" class="form-label">Enter Intake Capacity</label>
                        <div class="input-group col-md-12">
                            <input type="number" name="intake_cap" id="" class="form-control">
                        </div>


                        <label for="validationCustom02" class="form-label">Enter Percentage for General</label>
                        <div class="input-group col-md-12">
                            <input type="number" name="pc_gen" id="pc_gen" class="form-control">
                        </div>
                        <label for="validationCustom02" class="form-label">Enter Percentage for OBC/MOBC</label>
                        <div class="input-group col-md-12">
                            <input type="number" name="pc_obc" id="pc_obc" class="form-control">
                        </div>
                        <label for="validationCustom02" class="form-label">Enter Percentage for SC</label>
                        <div class="input-group col-md-12">
                            <input type="number" name="pc_sc" id="pc_obc" class="form-control">
                        </div>
                        <label for="validationCustom02" class="form-label">Enter Percentage for ST</label>
                        <div class="input-group col-md-12">
                            <input type="number" name="pc_st" id="pc_st" class="form-control">
                        </div>
                        <label for="validationCustom02" class="form-label">Enter Percentage for EWS</label>
                        <div class="input-group col-md-12">
                            <input type="number" name="pc_ews" id="pc_ews" onkeyup="calculate_pc()" class="form-control">
                        </div>
                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="generate_hs_merit_list" type="submit">Generate</button>
                        </div>
                    </form>

                    <!-- <?= $gen_std_no ?> -->
                </div>
            </div>



        </div>


    </section>
    <script>
        function calculate_pc() {
            var pc_genn = parseInt(document.getElementById("pc_gen").value);
            var pc_obcs = parseInt(document.getElementById("pc_obc").value);
            var pc_scc = parseInt(document.getElementById("pc_sc").value);
            var pc_stt = parseInt(document.getElementById("pc_st").value);
            var pc_ewss = parseInt(document.getElementById("pc_ews").value);
            console.log(pc_genn);
            console.log(pc_obcs);
            console.log(pc_scc);
            console.log(pc_stt);
            console.log(pc_ewss);
        }
    </script>


    <?php
    include('includes/footer.php');
    ?>
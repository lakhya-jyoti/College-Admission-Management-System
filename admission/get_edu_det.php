<?php
include_once 'includes/header.php';
$_SESSION['thrd_stage'] = "thrd_stage";

if (isset($_SESSION['thrd_stage']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "thrd_stage") {
?>
  <script>
    history.go(-1);
  </script>

  <?php
}
if (isset($_POST['thrd_stage'])) {
  echo '<pre>';
  print_r($_POST);
  echo '</pre>';

  $insert = "INSERT INTO `applicants_edu_det`(
    `hslc_board`,
    `institution_name`,
    `hslc_year`,
    `hslc_roll_no`,
    `hslc_subjects`,
    `hslc_toal_marks`,
    `hslc_obt_mark`,
    `hslc_percentage`,
    -- `hs_board`,
    -- `hs_inst_name`,
    -- `hs_year`,
    -- `hslc_stream`,
    -- `hs_roll_no`,
    -- `hs_subjects`,
    -- `hs_toal_marks`,
    -- `hs_mark_obt`,
    -- `ug_uni`,
    -- `ug_inst`,
    -- `ug_degree`,
    -- `gradu_roll_no`,
    -- `ug_core_subject`,
    -- `ug_pass_stst`,
    `applicants_id`
)
VALUES(
    :hslc_board,
    :institution_name,
    :hslc_year,
    :hslc_roll_no,
    :hslc_subjects,
    :hslc_toal_marks,
    :hslc_obt_mark,
    :hslc_percentage,
    -- :hs_board,
    -- :hs_inst_name,
    -- :hs_year,
    -- :hslc_stream,
    -- :hs_roll_no,
    -- :hs_subjects,
    -- :hs_toal_marks,
    -- :hs_mark_obt,
    -- :ug_uni,
    -- :ug_inst,
    -- :ug_degree,
    -- :gradu_roll_no,
    -- :ug_core_subject,
    -- :ug_pass_stst,
    :applicants_id
)";
  $stmt = $con->prepare($insert);
  $stmt->bindParam(':hslc_board', $_POST['hslc_board']);
  $stmt->bindParam(':institution_name', $_POST['institution_name']);
  $stmt->bindParam(':hslc_year', $_POST['hslc_year']);
  $stmt->bindParam(':hslc_roll_no', $_POST['hslc_roll_no']);
  $stmt->bindParam(':hslc_subjects', $_POST['hslc_subjects']);
  $stmt->bindParam(':hslc_toal_marks', $_POST['hslc_toal_marks']);
  $stmt->bindParam(':hslc_obt_mark', $_POST['obt_mark']);
  $stmt->bindParam(':hslc_percentage', $_POST['percentage']);
  // $stmt->bindParam(':hs_board', $_POST['hs_board']);
  // $stmt->bindParam(':hs_inst_name', $_POST['hs_inst_name']);
  // $stmt->bindParam(':hs_year', $_POST['hs_year']);
  // $stmt->bindParam(':hslc_stream', $_POST['hslc_stream']);
  // $stmt->bindParam(':hs_roll_no', $_POST['hs_roll_no']);
  // $stmt->bindParam(':hs_subjects', $_POST['hs_subjects']);
  // $stmt->bindParam(':hs_toal_marks', $_POST['hs_toal_marks']);
  // $stmt->bindParam(':hs_mark_obt', $_POST['hs_mark_obt']);
  // $stmt->bindParam(':ug_uni', $_POST['ug_uni']);
  // $stmt->bindParam(':ug_inst', $_POST['ug_inst']);
  // $stmt->bindParam(':ug_degree', $_POST['ug_degree']);
  // $stmt->bindParam(':gradu_roll_no', $_POST['gradu_roll_no']);
  // $stmt->bindParam(':ug_core_subject', $_POST['ug_core_subject']);
  // $stmt->bindParam(':ug_pass_stst', $_POST['pass_stst']);
  $stmt->bindParam(':applicants_id', $fetch_user['applicants_id']);
  if ($stmt->execute()) {
    $update = "UPDATE `applicants` SET `user_status` = 'frth_stage' where std_mob = :username or std_email = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
  ?>
      <script>
        alert('Details Added Successfully');
        location.href = 'get-bank-det.php';
      </script>
    <?php
    } else {
    ?>
      <script>
        alert('Something Went Wrong');
        // location.href = 'get-bank-det.php';
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert('Something Went Wrong');
      // location.href = 'get-bank-det.php';
    </script>
<?php
  }
}


?>

<div class="col-sm-9" class="table-responsive">

  <form action="" method="POST">
    <table class="table">
      <thead>

        <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Academic Details</b></td>
        </tr>

        <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:small;"><b>Fill the information as per Marksheet</b></td>
        </tr>
        <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Application Number : <?= $fetch_user['std_application_no'] ?></b></td>
        </tr>

        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>HSLC or Class 10th Equivalent</b></td>
        </tr>


        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Board </b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select id="hslc-board" name="hslc_board" class="form-control" onChange=showHide() required>
              <option value="">--select--</option>

              <option value="SEBA">SEBA</option>

              <option value="CBSE">CBSE</option>

              <option value="ICSE">ICSE</option>
              <option value="5">Others</option>

            </select>
          </td>
        </tr>



        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b></b>

          </td>
          <td style="display:none" id="hidden-panel">
            <input type="text" name="hslc_board" class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="80" placeholder="Enter the Board">
          </td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Institute Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" name="institution_name" maxlength="80" placeholder="Institute Name" required>
          </td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Passing year</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select class="form-control" name="hslc_year" id="year" required>
              <option value="">--YEAR--</option>
              <?php
              $year = date("Y");
              for ($num = 1974; $num <= $year; $num++) {


              ?>
                <option value="<?= $num ?>"><?= $num ?></option>
              <?php

              } ?>
            </select>
          </td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>10th Roll No</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" name="hslc_roll_no" maxlength="80" placeholder="XXX-XXX XXXX" required>
          </td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Subjects taken</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" name="hslc_subjects" maxlength="80" placeholder="Enter 10th Subjects" required>
          </td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Total Marks</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="number" class="form-control" id="total-marks" name="hslc_toal_marks" maxlength="80" placeholder="10th Total Marks ">
          </td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Total Marks Obtained</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="number" class="form-control" id="obtained-marks" name="obt_mark" maxlength="80" placeholder="Total Marks Obtained" required>
          </td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Percentage</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" onclick="percent()" class="form-control" id="percentage" name="percentage" maxlength="80" placeholder="Percentage" readonly required>
          </td>
        </tr>

        <!-- hs details  -->

       
       
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-12" colspan="2" align="center">
            <button type="submit" name="thrd_stage" class="btn btn-primary" style="background-color: #04124f; color: white;">Save & Next</button>
          </td>
        </tr>



      </thead>
    </table>
    <br />
    <br />
  </form>
</div>

<!-- scripts  -->
<script>

document.getElementById('not_req').style.display === "none";

  function percent() {
    var tmarks, omarks, pc;
    tmarks = parseInt(document.getElementById("total-marks").value);
    omarks = parseInt(document.getElementById("obtained-marks").value);
    pc = omarks / tmarks * 100;
    fixedpc = Math.round(pc * 100) / 100;
    document.getElementById("percentage").value = fixedpc;
  }




</script>






<?php
include_once 'includes/footer.php';
?>
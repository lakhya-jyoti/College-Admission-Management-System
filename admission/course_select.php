<?php
include_once 'includes/header.php';

$_SESSION['snd_stage'] = "snd_stage";

if (isset($_SESSION['snd_stage']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "snd_stage") {
?>
  <script>
    history.go(-1);
  </script>

  <?php
}




if (isset($_POST['snd_stage_f'])) {
  $select1 = "select * from applicants, program_subject,subjects,program where (program_subject.prgm_id = applicants.std_course) and (program_subject.sub_id = subjects.sub_id)";
  $stmt1 = $con->prepare($select1);
  $stmt1->execute();
  $sub_pref_1 = $_POST['pref_sub_1'];
  $sub_pref_2 = $_POST['pref_sub_2'];
  $sub_pref_3 = $_POST['pref_sub_3'];
  $pref_GE_1 = $_POST['pref_GE_1'];
  $pref_GE_2 = $_POST['pref_GE_2'];
  $pref_GE_3 = $_POST['pref_GE_3'];
  $mil = $_POST['mil'];
  $update = "UPDATE applicants SET `std_core_sub1` = :sub_pref_1, `std_std_core_sub2` = :sub_pref_2, `std_core_sub3` = :sub_pref_3, `std_ge_sub1` = :pref_GE_1, `std_ge_sub2` = :pref_GE_2, `std_ge_sub3` = :pref_GE_3, `std_mil` = :mil, `user_status` = 'thrd_stage' WHERE std_email = :username or std_mob = :username";
  $stmt = $con->prepare($update);
  $stmt->bindParam(':sub_pref_1', $sub_pref_1);
  $stmt->bindParam(':sub_pref_2', $sub_pref_2);
  $stmt->bindParam(':sub_pref_3', $sub_pref_3);
  $stmt->bindParam(':pref_GE_1', $pref_GE_1);
  $stmt->bindParam(':pref_GE_2', $pref_GE_2);
  $stmt->bindParam(':pref_GE_3', $pref_GE_3);
  $stmt->bindParam(':username', $_SESSION['username']);
  $stmt->bindParam(':mil', $mil);
  if ($stmt->execute()) {
  ?>
    <script>
      alert("Details Uploaded Successfully");
      location.href = 'get_edu_det.php';
    </script>
<?php
  }
}
$select_cour = "select * from applicants inner join program on applicants.std_course = program.prgm_id where std_email = :username or std_mob = :username";
$stmt2 = $con->prepare($select_cour);
$stmt2->bindParam(':username', $_SESSION['username']);
$stmt2->execute();
$fetch_cour = $stmt2->fetch(PDO::FETCH_ASSOC);

$select = "select * from program_subject, subjects, program , applicants where program_subject.prgm_id = program.prgm_id AND subjects.sub_id = program_subject.sub_id AND program.prgm_id = 12";
$stmt1 = $con->prepare($select);
$stmt1->execute();


?>


<div class="col-sm-9" class="table-responsive">

  <form id="ApplicantDetails" action="" method="post">
    <table class="table">
      <thead>

        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Course Details</b></td>
        </tr>

        <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Application Number : <?= $fetch_user['std_application_no'] ?></b></td>
        </tr>

        <div>
          <tr class="hide_sec">
            <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Core Subject preference:1</b>
              <font color="red" size="3"><b>*</b></font>

            </td>
            <td class="col-sm-7" align="left">
              <select id="pref_sub_1" oninput="pref_sub()" name="pref_sub_1" class="form-control" required>
                <option value="">--select--</option>
                <option value="BOTANY">BOTANY</option>
                <option value="ZOOLOGY">ZOOLOGY</option>


                <!-- <?php
             
             while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

             ?>
               <option value="<?= $fetch_sub['sub_id'] ?>"><?= $fetch_sub['sub_name'] ?></option>

             <?php
             }
             ?> -->

              </select>
            </td>

          </tr>

          <tr class="hide_sec">
            <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Core Subject preference:2</b>

            </td>
            <td class="col-sm-7" align="left">
              <select id="pref_sub_2" oninput="pref_sub()" name="pref_sub_2" class="form-control" required>
                <option value="">--select--</option>
                <option value="ZOOLOGY">ZOOLOGY</option>
                <option value="MATHS">MATHS</option>




<!-- 
                <?php
             
                while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

                ?>
                  <option value="<?= $fetch_sub['sub_name'] ?>"><?= $fetch_sub['sub_name'] ?></option>

                <?php
                }
                ?> -->

              </select>
            </td>
          </tr>


          <!-- <tr class="hide_sec">
            <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Core Subject preference:3</b>


            </td>
            <td class="col-sm-7" align="left">
              <select id="pref_sub_2" oninput="pref_sub()" name="pref_sub_3" class="form-control" required>
                <option value="">--select--</option>

                <!-- <?php
                $select = "select * from applicants, program_subject,subjects where (program_subject.prgm_id = applicants.std_course) and (program_subject.sub_id = subjects.sub_id)";
                $stmt = $con->prepare($select);
                $stmt->execute();
                while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

                ?>
                  <option value="<?= $fetch_sub['sub_name'] ?>"><?= $fetch_sub['sub_name'] ?></option>

                <?php
                }
                ?> -->

              </select>
            </td>
          </tr> 


          <div class="hide_gen_elective">
            <tr class="hide_sec hide_gen_elective">
              <td style="background-color:#E5E4E2;" class="col-sm-5"><b>General elective preference:1</b>
                <font color="red" size="3"><b>*</b></font>

              </td>
              <td class="col-sm-7" align="left">
                <select id="pref_GE_1" oninput="pref_sub()" name="pref_GE_1" class="form-control" required>
                  <option value="">--select--</option>
                  <option value="BOTANY">BOTANY</option>
                <option value="ZOOLOGY">ZOOLOGY</option>


                  <?php
                  $select = "select * from applicants, program_subject,subjects where (program_subject.prgm_id = applicants.std_course) and (program_subject.sub_id = subjects.sub_id)";
                  $stmt = $con->prepare($select);
                  $stmt->execute();
                  while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  ?>
                    <option value="<?= $fetch_sub['sub_name'] ?>"><?= $fetch_sub['sub_name'] ?></option>

                  <?php
                  }
                  ?>

                </select>
              </td>
            </tr>

            <tr class="hide_sec hide_gen_elective">
              <td style="background-color:#E5E4E2;" class="col-sm-5"><b>General elective preference:2</b>


              </td>
              <td class="col-sm-7" align="left">
                <select id="pref_GE_2" oninput="pref_sub()" name="pref_GE_2" class="form-control" required>
                  <option value="">--select--</option>
                  <option value="BOTANY">BOTANY</option>
                  <option value="ZOOLOGY">ZOOLOGY</option>

                  <?php
                  $select = "select * from applicants, program_subject,subjects where (program_subject.prgm_id = applicants.std_course) and (program_subject.sub_id = subjects.sub_id)";
                  $stmt = $con->prepare($select);
                  $stmt->execute();
                  while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  ?>
                    <option value="<?= $fetch_sub['sub_name'] ?>"><?= $fetch_sub['sub_name'] ?></option>

                  <?php
                  }
                  ?>

                </select>
              </td>
            </tr>


            <!-- <tr class="hide_sec hide_gen_elective">
              <td style="background-color:#E5E4E2;" class="col-sm-5"><b>General elective preference:3</b>

              </td>
              <td class="col-sm-7" align="left">
                <select id="pref_GE_3" oninput="pref_sub()" name="pref_GE_3" class="form-control" required>
                  <option value="">--select--</option>

                  <?php
                  $select = "select * from applicants, program_subject,subjects where (program_subject.prgm_id = applicants.std_course) and (program_subject.sub_id = subjects.sub_id)";
                  $stmt = $con->prepare($select);
                  $stmt->execute();
                  while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  ?>
                    <option value="<?= $fetch_sub['sub_name'] ?>"><?= $fetch_sub['sub_name'] ?></option>

                  <?php
                  }
                  ?>

                </select>
              </td>
            </tr> -->


            <tr class="hide_sec hide_gen_elective">
              <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Modern Indian Language</b>
                <font color="red" size="3"><b>*</b></font>

              </td>
              <td class="col-sm-7" align="left">
                <select id="mil" name="mil" class="form-control" required>
                  <option value="">--select--</option>

                  <option value="Alt-English">Alt English</option>

                  <option value="MILAssamese">Assamese</option>
                  <option value="MILAssamese">Hindi</option>

                </select>
              </td>
            </tr>
          </div>
        </div>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-12" colspan="2" align="center">
            <button type="submit" name="snd_stage_f" class="btn btn-primary" style="background-color: #04124f; color: white;">Save & Next</button>
          </td>
        </tr>




      </thead>
    </table>
    <br />
    <br />
  </form>
</div>







<?php
include_once 'includes/footer.php';
?>


<script>
  function course_select() {
    $(function() {
      var course = $('#course').val();


      $.ajax({
        type: "post",
        url: "<?= $web_socket ?>includes/action.php",
        data: "course=" + course + "&courseCheck",
        // dataType: "json",
        success: function(response) {
          console.log(response);

          switch (response) {
            case "BCA":
              $('.hide_sec').hide();
              $('#pref_sub_1').removeAttr('required');
              $('#pref_sub_2').removeAttr('required');
              $('#pref_sub_3').removeAttr('required');
              $('#general_pref_1').removeAttr('required');
              $('#general_pref_2').removeAttr('required');
              $('#general_pref_3').removeAttr('required');
              $('#mil').removeAttr('required');
              break;

            case "BPES":
              $('.hide_sec').hide();
              $('#pref_sub_1').removeAttr('required');
              $('#pref_sub_2').removeAttr('required');
              $('#pref_sub_3').removeAttr('required');
              $('#general_pref_1').removeAttr('required');
              $('#general_pref_2').removeAttr('required');
              $('#general_pref_3').removeAttr('required');
              $('#mil').removeAttr('required');
              break;

            case "MA":
              $('.hide_gen_elective').hide();
              $('#general_pref_1').removeAttr('required');
              $('#general_pref_2').removeAttr('required');
              $('#general_pref_3').removeAttr('required');
              $('#mil').removeAttr('required');
              break;

            case "MSC":
              $('.hide_gen_elective').hide();
              $('#general_pref_1').removeAttr('required');
              $('#general_pref_2').removeAttr('required');
              $('#general_pref_3').removeAttr('required');
              $('#mil').removeAttr('required');
              break;


            default:
              $('.hide_sec').show();
              $('.hide_gen_elective').show();
              $("#pref_sub_1").attr("required", "true");
              $("#pref_sub_2").attr("required", "true");
              $("#pref_sub_3").attr("required", "true");
              $("#general_pref_1").attr("required", "true");
              $("#general_pref_2").attr("required", "true");
              $("#general_pref_3").attr("required", "true");
              $("#mil").attr("required", "true");

              $('#pref_sub_1').addAttr('required');
              $('#pref_sub_2').removeAttr('required');
              $('#pref_sub_3').removeAttr('required');
              $('#general_pref_1').removeAttr('required');
              $('#general_pref_2').removeAttr('required');
              $('#general_pref_3').removeAttr('required');
              $('#mil').removeAttr('required');
              break;
          }
        }
      });




    });
  }

  function pref_sub() {
    $(function() {
      var course = $('#course').val();
      var pref_sub_1 = $('#pref_sub_1').val();
      $.ajax({
        type: "POST",
        url: "<?= $web_socket ?>includes/action.php",
        data: "pref_sub_1" + "&pref_sub_1",
        // dataType: "json",
        success: function(response) {
          console.log(response);
        }
      });
    });
  }
</script>
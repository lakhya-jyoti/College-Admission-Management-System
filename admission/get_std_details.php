<?php
include_once 'includes/header.php';
$_SESSION['fst_stage'] = "fst_stage";

if (isset($_SESSION['fst_stage']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "fst_stage") {
?>
  <script>
    history.go(-1);
  </script>

  <?php
}

// This is after first stage formfillup
if (isset($_POST['snd_details_sumbit'])) {
  $logged_user = $_SESSION['username'];
  $religion = $_POST['religion'];
  $blood = $_POST['blood'];
  $stdy_cnt = $_POST['stdy_cnt'];
  $community = $_POST['community'];
  $parentname = $_POST['parentname'];
  $parentmobile = $_POST['parentmobile'];
  $parentoccu = $_POST['parentoccu'];
  $localparentname = $_POST['localparentname'];
  $parentinc = $_POST['parentinc'];
  $per_pincode = $_POST['per_pincode'];
  $per_state = $_POST['per_state'];
  $per_dist = $_POST['per_dist'];
  $per_locality = $_POST['per_locality'];
  $per_police_station = $_POST['per_police_station'];
  $per_cityname = $_POST['per_cityname'];
  $pre_pincode = $_POST['pre_pincode'];
  $pre_state = $_POST['pre_state'];
  $pre_dist = $_POST['pre_dist'];
  $pre_locality = $_POST['pre_locality'];
  $pre_police_station = $_POST['pre_police_station'];
  $pre_cityname = $_POST['pre_cityname'];
  $status = "snd_stage";

  $update = "UPDATE
  `applicants`
SET
  `std_religion` = :religion,
  `std_blood` = :blood,
  `std_caste` = :community ,
  `std_stydy_cnt` = :stdy_cnt,
  `std_grdn` = :parentname,
  `std_grdn_occ` = :parentoccu,
  `std_l_grdn` = :localparentname,
  `std_grdn_inc` = :parentinc,
  `std_prmt_add` = :per_cityname,
  `std_prmt_locality` = :per_locality,
  `std_prmt_ps` = :per_police_station,
  `std_prmt_pin` = :per_pincode,
  `std_prmt_state` = :per_state,
  `std_prmt_dist` = :per_dist,
  `std_pres_add` = :pre_cityname,
  `std_pres_locality` = :pre_locality,
  `std_pres_ps` = :pre_police_station,
  `std_pres_pin` = :pre_pincode,
  `std_pres_dist` = :pre_dist,
  `std_pres_state` = :pre_state,
  `user_status` = :user_status WHERE std_email = :username or std_mob = :username";
  $stmt = $con->prepare($update);
  $stmt->bindParam(':username', $_SESSION['username']);
  $stmt->bindParam(':religion', $religion);
  $stmt->bindParam(':blood', $blood);
  $stmt->bindParam(':community', $community);
  $stmt->bindParam(':stdy_cnt', $stdy_cnt);
  $stmt->bindParam(':parentname', $parentname);
  $stmt->bindParam(':parentoccu', $parentoccu);
  $stmt->bindParam(':localparentname', $localparentname);
  $stmt->bindParam(':parentinc', $parentinc);
  $stmt->bindParam(':per_cityname', $per_cityname);
  $stmt->bindParam(':per_locality', $per_locality);
  $stmt->bindParam(':per_police_station', $per_police_station);
  $stmt->bindParam(':per_pincode', $per_pincode);
  $stmt->bindParam(':per_state', $per_state);
  $stmt->bindParam(':per_dist', $per_dist);
  $stmt->bindParam(':pre_cityname', $pre_cityname);
  $stmt->bindParam(':pre_locality', $pre_locality);
  $stmt->bindParam(':pre_police_station', $pre_police_station);
  $stmt->bindParam(':pre_pincode', $pre_pincode);
  $stmt->bindParam(':pre_dist', $pre_dist);
  $stmt->bindParam(':pre_state', $pre_state);
  $stmt->bindParam(':user_status', $status);
  $qry = $stmt->execute();
  if ($qry) {

    $select = "select * from applicants inner join program on applicants.std_course = program.prgm_id where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $fetch_select = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fetch_select['prgm_type'] == 'HS' || $fetch_select['prgm_type'] == 'UG-PROFESSIONAL' || $fetch_select['prgm_type'] == 'PG-PROFESSIONAL' || $fetch_select['prgm_type'] == 'PG-GENERAL' || $fetch_select['prgm_type'] == 'PG-DIPLOMA') {
      $update = 'update applicants set user_status = "thrd_stage" where std_email = :username or std_mob = :username';
      $stmt = $con->prepare($update);
      $stmt->bindParam(':username', $_SESSION['username']);
      $stmt->execute();
      // header('location:get_edu_det.php');
  ?>
      <script>
        alert("Student Updated Successfully");
        location.href = 'get_edu_det.php';
      </script>
    <?php
    } elseif ($fetch_select['prgm_type'] == 'UG-GENERAL') {

      $update1 = 'update applicants set user_status = "snd_stage" where std_email = :username or std_mob = :username';
      $stmt1 = $con->prepare($update1);
      $stmt1->bindParam(':username', $_SESSION['username']);
      $stmt1->execute();
      // header('location: course_select.php');
      ?>
      <script>
        alert("Student Updated Successfully");
        location.href = 'course_select.php';
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      history.go(-1);
    </script>

<?php
  }
}
?>

<!-- Starts Here -->
<div class="col-sm-9" class="table-responsive">

  <form id="ApplicantDetails" action="" method="post">
    <table class="table">
      <thead>



        <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Application Number : <?= $fetch_user['std_application_no'] ?></b></td>
        </tr>

        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Registration Details</b></td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Name of the Candidate</b></td>
          <td><b><?= $std_name ?></b></td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Father's Name</b></td>
          <td><b><?= $fetch_user['std_father'] ?></b></td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Mother's Name</b></td>
          <td><b><?= $fetch_user['std_mother'] ?></b></td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Registered mobile number</b></td>
          <td><b><?= $fetch_user['std_mob'] ?></b></td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Registered email address</b></td>
          <td><b><?= $fetch_user['std_email'] ?></b></td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Date of Birth (DD-MM-YYYY) (born on or after <b>01.07.2001</b>)</b></td>
          <td>
            <b><?= $fetch_user['std_dob'] ?></b>
          </td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Gender</b></td>
          <td>
            <b><?= $fetch_user['std_sex'] ?></b>
          </td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Course Applied</b></td>
          <td>
            <?php
            $select_cour = "select * from applicants inner join program on applicants.std_course = program.prgm_id where std_email = :username or std_mob = :username";
            $stmt = $con->prepare($select_cour);
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->execute();
            $fetch_cour = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <b><?= $fetch_cour['prgm_name'] ?></b>
          </td>
        </tr>

        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Personal Details</b></td>
        </tr>



        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Religion </b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td align="left">
            <input type="radio" value="Hinduism" name="religion">&nbsp;Hinduism&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" value="Christianity" name="religion" required>&nbsp;Christianity&nbsp;&nbsp;
            <input type="radio" value="Islam" name="religion" required>&nbsp;Islam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" value="Others" name="religion" required>&nbsp;Others
          </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Blood Group </b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select name="blood" class="form-control" required>
              <option value="">--select--</option>
              <option value="O-">O-</option>
              <option value="O+">O+</option>
              <option value="A-">A-</option>
              <option value="A+">A+</option>
              <option value="B-">B-</option>
              <option value="B+">B+</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
            </select>
          </td>
        <tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Study Continue </b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td align="left">
            <input type="radio" value="Yes" name="stdy_cnt">&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" value="No" name="stdy_cnt" required>&nbsp;No&nbsp;&nbsp;
          </td>
        </tr>

        <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Caste </b>
          <font color="red" size="3"><b>*</b></font>
        </td>
        <td class="col-sm-7" align="left">
          <select name="community" class="form-control" required>
            <option value="">--select--</option>

            <option value="General">General</option>

            <option value="OBC / MOBC">OBC / MOBC</option>

            <option value="SC">SC</option>

            <option value="ST">ST</option>
            <option value="EWS">EWS</option>

          </select>
        </td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Name of the Parent/Guardian</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" name="parentname" maxlength="80" placeholder="Parent/Guardian Name" required>
          </td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Parent/Guardian Mobile Number</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control phone-txt" autocomplete="off" name="parentmobile" maxlength="13" placeholder="Parent mobile no." required>
          </td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Occupation of the Parent/Guardian</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" name="parentoccu" maxlength="80" placeholder="Parent/Guardian Occupation" required>
          </td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Local Parent/Guardian Name</b>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" name="localparentname" maxlength="80" placeholder="Local Parent/Guardian Name">
          </td>
        </tr>
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Parent/Guardian Income</b>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" name="parentinc" maxlength="80" placeholder="Parent/Guardian Income">
          </td>
        </tr>


        <tr style="background-color:#04124f;color: white;">
          <td colspan="3"><b>Permanent Address</b></td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Enter Pincode</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" name="per_pincode" id="pin" onkeyup="CheckPin()" onblur="CheckPin()" size="15" maxlength="6" autocomplete="off" placeholder="Enter pincode" required>
          </td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>District Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select id="dist" name="per_dist" class="form-control" required>
              <option value="">--select--</option>
            </select>
          </td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>State Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select id="state" name="per_state" class="form-control" required>
              <option value="">--select--</option>
            </select>
          </td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Locality</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td><input class="form-control" type="text" name="per_locality" id="per_locality" size="45" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="45" placeholder="Enter area name" required></td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Police Station</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td><input class="form-control" type="text" name="per_police_station" id="per_police_station" size="45" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="45" placeholder="Police Station" required></td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Town / City</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td><input class="form-control" type="text" name="per_cityname" id="per_cityname" size="45" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="45" placeholder="Enter city name" required></td>
        </tr>



        <!-- Present address -->

        <tr style="background-color:#04124f;color: white;">
          <td colspan="3"><b>Present Address</b></td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Same As Permanent Address</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="checkbox" id="check_add">
          </td>
        </tr>



        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Enter Pincode</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" name="pre_pincode" id="pins" onblur="CheckPins()" onkeyup="CheckPins()" onpointermove="CheckPins()" onforminput="CheckPins()" size="15" maxlength="6" autocomplete="off" placeholder="Enter pincode" required>
          </td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>District Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select id="dists" name="pre_dist" class="form-control" required>
              <option value="">--select--</option>
            </select>
          </td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>State Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td class="col-sm-7" align="left">
            <select id="states" name="pre_state" class="form-control" required>
              <option value="">--select--</option>
            </select>
          </td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Locality</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td><input class="form-control" type="text" name="pre_locality" id="pre_locality" size="45" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="45" placeholder="Enter area name" required></td>
        </tr>


        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Police Station</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td><input class="form-control" type="text" name="pre_police_station" id="pre_police_station" size="45" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="45" placeholder="Police Station" required></td>
        </tr>

        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-5"><b>Town / City</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td><input class="form-control" type="text" name="pre_cityname" id="pre_cityname" size="45" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" maxlength="45" placeholder="Enter city name" required></td>
        </tr>




        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-12" colspan="2" align="center">
            <button type="submit" name="snd_details_sumbit" class="btn btn-primary" style="background-color: #04124f; color: white;">Save & Next</button>
          </td>
        </tr>



      </thead>
    </table>
    <br />
    <br />
  </form>
</div>


<!-- Ends Here -->

<?php
include_once 'includes/footer.php';
?>


<!-- Pin Code extraction -->
<script>
  function CheckPin() {
    $(function() {
      var pin = document.getElementById('pin').value;
      $.ajax({
        type: "POST",
        url: "<?= $web_socket ?>includes/action.php",
        data: "pin=" + pin + "&pincodeCheck",
        dataType: "json",
        success: function(response) {

          document.getElementById('state').innerHTML = "<option value=" + response.state + ">" + response.state + "</option>"
          document.getElementById('dist').innerHTML = "<option value=" + response.dist + ">" + response.dist + "</option>"

        }
      });
    })
  }

  function CheckPins() {
    $(function() {
      var pin = document.getElementById('pins').value;
      $.ajax({
        type: "POST",
        url: "<?= $web_socket ?>includes/action.php",
        data: "pin=" + pin + "&pincodeCheck",
        dataType: "json",
        success: function(response) {

          document.getElementById('states').innerHTML = "<option value=" + response.state + ">" + response.state + "</option>"
          document.getElementById('dists').innerHTML = "<option value=" + response.dist + ">" + response.dist + "</option>"

        }
      });
    })
  }

  // Fetch permanent address and present address
  $(document).ready(function() {
    $("#check_add").on("click", function() {
      if (this.checked) {
        $("#pins").val($("#pin").val());
        $("#dists").val($("#dist").val());
        $("#states").val($("#state").val());
        $("#pre_locality").val($("#per_locality").val());
        $("#pre_police_station").val($("#per_police_station").val());
        $("#pre_cityname").val($("#per_cityname").val());

        $('#pins').prop('readonly', true);
        $('#states').prop('readonly', true);
        $('#dists').prop('readonly', true);
        $('#pre_locality').prop('readonly', true);
        $('#pre_police_station').prop('readonly', true);
        $('#pre_cityname').prop('readonly', true);
      } else {
        $('#pins').prop('readonly', false);
        $('#states').prop('readonly', false);
        $('#dists').prop('readonly', false);
        $('#pre_locality').prop('readonly', false);
        $('#pre_police_station').prop('readonly', false);
        $('#pre_cityname').prop('readonly', false);
      }

    });
  });
</script>
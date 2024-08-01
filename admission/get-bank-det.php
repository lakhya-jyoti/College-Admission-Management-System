<?php
include_once 'includes/header.php';
$_SESSION['frth_stage'] = "frth_stage";

if (isset($_SESSION['frth_stage']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "frth_stage") {
?>
  <script>
    history.go(-1);
  </script>

  <?php
}
if (isset($_POST['frth_stage'])) {
  $bank_name = $_POST['bank_name'];
  $branch_name = $_POST['branch_name'];
  $acc_hldr = $_POST['acc_hldr'];
  $ifsc = $_POST['ifsc'];
  $acc_no = $_POST['acc_no'];
  $cf_acc_no = $_POST['cf_acc_no'];
  if ($acc_no == $cf_acc_no) {
    $update = "UPDATE `applicants` SET  `std_bank` = :bank_name,`std_bank_branch` = :branch_name,`std_bank_ac_no`=:acc_no,`std_bank_holder` = :acc_hldr,`std_bank_ifsc` = :ifsc, `user_status` ='fth_stage' where `std_mob`= :username or `std_email`= :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':bank_name', $bank_name);
    $stmt->bindParam(':branch_name', $branch_name);
    $stmt->bindParam(':acc_no', $acc_no);
    $stmt->bindParam(':acc_hldr', $acc_hldr);
    $stmt->bindParam(':ifsc', $ifsc);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
?>
      <script>
        alert("Bank details inserted successfully !!")
        location.href = 'form-doc-up.php'
      </script>
    <?php
    } else {
    ?>
      <script>
        alert("Something Went Wrong !!")
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Not matched !!")
    </script>
<?php
  }
}

?>

<div class="col-sm-9" class="table-responsive">

  <form id="ApplicantDetails" action="" method="POST">
    <table class="table">
      <thead>

        <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Bank Details</b></td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Bank Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="bank_name" maxlength="80" placeholder="Bank Name" required>
          </td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Account Holder name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="acc_hldr" maxlength="80" placeholder="Account Holder name" required>
          </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Branch Name</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="branch_name" maxlength="80" placeholder="Branch Name" required>
          </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Bank IFSC</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" name="ifsc" maxlength="80" placeholder="Bank IFSC" required>
          </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Account no.</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="number" id="acc-no" class="form-control" name="acc_no" maxlength="80" placeholder="Account no." required>
          </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Confirm Account no.</b>
            <font color="red" size="3"><b>*</b></font>
          </td>
          <td>
            <input type="number" onkeyup="Validate()" id="cf-acc-no" class="form-control" name="cf_acc_no" maxlength="80" placeholder="Confirm Account no." required>
            <font style="display:none;" id="font" color="red" size="1"><b>Not matched </b></font>
          </td>
        </tr>



        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-12" colspan="2" align="center">
            <button type="submit" id="vali" name="frth_stage" class="btn btn-primary" style="background-color: #04124f; color: white; display:none;">Save & Next</button>
          </td>
        </tr>



      </thead>
    </table>
    <br />
    <br />
  </form>
</div>

<!-- scripts  -->
<script type="text/javascript">
  function Validate() {
    var accno = document.getElementById("acc-no").value;
    var con_accno = document.getElementById("cf-acc-no").value;
    var x = document.getElementById("font");
    var vali = document.getElementById('vali');
    if (accno != con_accno) {
      x.style.display = "block";
      vali.style.display = "none";
    } else {
      x.style.display = "none";
      vali.style.display = "block";

    }

  }
</script>




<?php
include_once 'includes/footer.php';
?>
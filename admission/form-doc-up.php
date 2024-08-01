<?php
include_once 'includes/header.php';
$_SESSION['fth_stage'] = "fth_stage";

if (isset($_SESSION['fth_stage']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "fth_stage") {
?>
  <script>
    history.go(-1);
  </script>

  <?php
}

// Student Photo

if (isset($_POST['photo_upload'])) {
  $photo = $_FILES['std_photo'];
  $photo_name = $_FILES['std_photo']['name'];
  $temp_name = $_FILES['std_photo']['tmp_name'];
  $ext = explode(".", $photo_name);
  $photo_r_name = "../administration/student-docs/" . $fetch_user['std_application_no'] . "_photo_." . $ext[1];
  if (move_uploaded_file($temp_name,  $photo_r_name)) {
    $update = "UPDATE `applicants` SET `std_pass_photo`=:photo_name where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':photo_name', $photo_r_name);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
  ?>
      <script>
        alert("Photo Upload Successfully");
        location.href = "form-doc-up.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
    <?php
  }
}

// std sign
if (isset($_POST['sign_upload'])) {
  $sign = $_FILES['std_sign'];
  $sign_name = $_FILES['std_sign']['name'];
  $temp_name = $_FILES['std_sign']['tmp_name'];
  $ext = explode(".", $sign_name);
  $sign_r_name = "../administration/student-docs/" . $fetch_user['std_application_no'] . "_sign_." . $ext[1];
  if (move_uploaded_file($temp_name,  $sign_r_name)) {
    $update = "UPDATE `applicants` SET `std_sign`=:sign_name where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':sign_name', $sign_r_name);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
    ?>
      <script>
        alert("Signatiure Upload Successfully");
        location.href = "form-doc-up.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
    <?php
  }
}


// Std id
if (isset($_POST['id_upload'])) {
  $id = $_FILES['std_id'];
  $id_name = $_FILES['std_id']['name'];
  $temp_name = $_FILES['std_id']['tmp_name'];
  $ext = explode(".", $id_name);
  $id_r_name = "../administration/student-docs/" . $fetch_user['std_application_no'] . "_id_." . $ext[1];
  if (move_uploaded_file($temp_name,  $id_r_name)) {
    $update = "UPDATE `applicants` SET `std_auth_id`=:id_name where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':id_name', $id_r_name);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
    ?>
      <script>
        alert("Identity Upload Successfully");
        location.href = "form-doc-up.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
    <?php
  }
}

// std 10 marksheet
if (isset($_POST['ten_mark_upload'])) {
  $id = $_FILES['std_ten_mark'];
  $ten_mark_name = $_FILES['std_ten_mark']['name'];
  $temp_name = $_FILES['std_ten_mark']['tmp_name'];
  $ext = explode(".", $ten_mark_name);
  $ten_mark_r_name = "../administration/student-docs/" . $fetch_user['std_application_no'] . "_10marksheet_." . $ext[1];
  if (move_uploaded_file($temp_name,  $ten_mark_r_name)) {
    $update = "UPDATE `applicants` SET `std_hslc_marksheet`=:marksheet_name where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':marksheet_name', $ten_mark_r_name);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
    ?>
      <script>
        alert("10th Marksheet Upload Successfully");
        location.href = "form-doc-up.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
    <?php
  }
}

// std 10 Admit
if (isset($_POST['std_hslc_admit_upload'])) {
  $id = $_FILES['std_hslc_admit'];
  $ten_admit_name = $_FILES['std_hslc_admit']['name'];
  $temp_name = $_FILES['std_hslc_admit']['tmp_name'];
  $ext = explode(".", $ten_admit_name);
  $ten_admit_r_name = "../administration/student-docs/" . $fetch_user['std_application_no'] . "_10admit_." . $ext[1];
  if (move_uploaded_file($temp_name,  $ten_admit_r_name)) {
    $update = "UPDATE `applicants` SET `std_hslc_admit`=:admit_name where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':admit_name', $ten_admit_r_name);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
    ?>
      <script>
        alert("10th Admit Upload Successfully");
        location.href = "form-doc-up.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
    <?php
  }
}

// std hgql marksheet
if (isset($_POST['std_hgql_marksheet_upload'])) {
  $id = $_FILES['std_hgql_marksheet'];
  $hgql_mark_name = $_FILES['std_hgql_marksheet']['name'];
  $temp_name = $_FILES['std_hgql_marksheet']['tmp_name'];
  $ext = explode(".", $hgql_mark_name);
  $hgql_mark_r_name = "../administration/student-docs/" . $fetch_user['std_application_no'] . "_12marksheet_." . $ext[1];
  if (move_uploaded_file($temp_name,  $hgql_mark_r_name)) {
    $update = "UPDATE `applicants` SET `std_hgql_marksheet`=:mark_name where std_email = :username or std_mob = :username";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':mark_name', $hgql_mark_r_name);
    $stmt->bindParam(':username', $_SESSION['username']);
    if ($stmt->execute()) {
    ?>
      <script>
        alert("12th Marksheet Upload Successfully");
        location.href = "form-doc-up.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
<?php
  }
}

// Final Submit
if(isset($_POST['thrd_details_sumbit'])){
  $user_status = "fth_stage";
  $update = "update applicants set user_status=:user_status where std_email = :username or std_mob = :username";
  $stmt = $con->prepare($update);
  $stmt->bindParam(':user_status',$user_status);
  $stmt->bindParam(':username',$_SESSION['username']);
  if($stmt->execute()){
   ?>
   <script>
    alert('Document Uploaded Successfully');
    location.href = "preview.php";
   </script>
   <?php
  }else{
    ?>
    <script>
      alert("Something Went Wrong");
      location.href = "form-doc-up.php";
    </script>
    <?php
  }

}


?>

<div class="col-sm-9" class="table-responsive">


  <table class="table">
    <thead>
      <tr style="background-color:white; color: green;" align="center">
        <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Documents Upload</b></td>
      </tr>
      <tr style="background-color:#04124f; color: white;">
        <td colspan="3"><b>Personal Documents</b></td>
      </tr>
      <?php
      if ($fetch_user['std_pass_photo'] == "") {
      ?>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Applicant's Passport Photo</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <form action="" method="post" enctype="multipart/form-data">
              <input class="form-control" type="file" value="file" name="std_photo" accept="image/*"><br>
              <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="photo_upload" required>

            </form>
            <!-- <input class="btn btn-primary" style="background-color: blue; color: white" value="Preview" name="app-image"> -->

          </td>
        </tr>
      <?php
      } else {
      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b class="text-success">You Have Already Upload Your Photo</b>

          </td>

        </tr>
      <?php
      }
      if ($fetch_user['std_sign'] == "") {

      ?>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Applicant's Signature</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <form action="" method="post" enctype="multipart/form-data">
              <input class="form-control" type="file" value="file" name="std_sign" accept="image/*"><br>
              <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="sign_upload" required>
            </form>
          </td>
        </tr>
      <?php
      } else {
      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b class="text-success">You Have Already Upload Your Signature</b></td>
        </tr>
      <?php
      }

      if ($fetch_user['std_auth_id'] == "") {

      ?>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Applicant's Identity ID</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <form action="" method="post" enctype="multipart/form-data">
              <input class="form-control" type="file" value="file" name="std_id" accept="pdf/*"><br>
              <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="id_upload" required>
            </form>
          </td>
        </tr>
      <?php
      } else {
      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b class="text-success">You Have Already Upload Your ID Documents</b></td>
        </tr>
      <?php
      }

      ?>

      <tr style="background-color:#04124f; color: white;">
        <td colspan="3"><b>Academic Documents</b></td>
      </tr>
      <?php


      if ($fetch_user['std_hslc_admit'] == "") {

      ?>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Class 10th Admit</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <form action="" method="post" enctype="multipart/form-data">
              <input class="form-control" type="file" value="file" name="std_hslc_admit" accept="pdf/*"><br>
              <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="std_hslc_admit_upload" required>
            </form>
          </td>
        </tr>
      <?php
      } else {
      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b class="text-success">You Have Already Upload Your HSLC Admit Card</b></td>
        </tr>
      <?php
      }



      if ($fetch_user['std_hslc_marksheet'] == "") {

      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Class 10th Marksheet</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <form action="" method="post" enctype="multipart/form-data">
              <input class="form-control" type="file" value="file" name="std_ten_mark" accept="pdf/*"><br>
              <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="ten_mark_upload" required>
            </form>
          </td>
        </tr>
      <?php
      } else {
      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b class="text-success">You Have Already Upload Your HSLC Marksheet</b></td>
        </tr>
      <?php
      }



      if ($fetch_user['std_hgql_marksheet'] == "") {

      ?>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Class 12th Marksheet</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <form action="" method="post" enctype="multipart/form-data">
              <input class="form-control" type="file" value="file" name="std_hgql_marksheet" accept="pdf/*"><br>
              <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="std_hgql_marksheet_upload" required>
            </form>
          </td>
        </tr>
      <?php
      } else {
      ?>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b class="text-success">You Have Already Upload Your HS Marksheet</b></td>
        </tr>
      <?php
      }


      ?>


      <form action="" method="post">
        <tr>
          <td style="background-color:#E5E4E2;" class="col-sm-12" colspan="2" align="center">
            <button type="submit" name="thrd_details_sumbit" class="btn btn-primary" style="background-color: #04124f; color: white;"> Next</button>
          </td>
        </tr>
      </form>


    </thead>
  </table>
  <br />
  <br />
</div>







<?php
include_once 'includes/footer.php';
?>
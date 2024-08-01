<?php
include_once 'includes/header.php';
$_SESSION['3rd_stage'] = "3rd_stage";

if (isset($_SESSION['2nd_stage']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "2nd_stage") {
?>
  <script>
    history.go(-1);
  </script>

<?php
}


?>

<div class="col-sm-9" class="table-responsive">

  <form id="ApplicantDetails" action="" method="post">
    <table class="table">
      <thead>
      <tr style="background-color:white; color: green;" align="center">
          <td colspan="3" style="background-color:white; color: green; font-size:x-large;"><b>Documents Upload</b></td>
        </tr>



      <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Personal Documents</b></td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Applicant's Passport Photo</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload" accept="image/*"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>

            <!-- <input class="btn btn-primary" style="background-color: blue; color: white" value="Preview" name="app-image"> -->
         <div class="input-group-btn">
          <button type="button" class="btn btn-default btn-sm">
          <i class="fa fa-upload"> Upload</i>
         </div>
        </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Applicant's Signature</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload" accept="image/*"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>
            <!-- <input class="btn btn-primary" style="background-color: blue; color: white" value="Preview" name="app-image"> -->
         
        </td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Applicant's Identity ID</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.pdf]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload" ><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>

            <!-- <input class="btn btn-primary" style="background-color: blue; color: white" value="Preview" name="app-image"> -->
         
        </td>
        </tr>

        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Academic Documents</b></td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Class 10th Admit</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>
        </td>
        </tr>

        
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Class 10th Marksheet</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>
        </td>
        </tr>
        
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Class 12th Marksheet</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>
        </td>
        </tr>
 
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Graduation Marksheet</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>
        </td>
        </tr>

        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Published Reserach Paper (if any)</b>
            <br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image">
        </td>
        </tr>

        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Bank Documents</b></td>
        </tr>
        
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Bank Passbook</b>
            <font color="red" size="3"><b>*</b></font><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image" required>
        </td>
        </tr>
        <tr style="background-color:#04124f; color: white;">
          <td colspan="3"><b>Other Documents</b></td>
        </tr>
        
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Caste Certificate</b>
           <br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image">
        </td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>Guardian's Income Certificate</b>
         <br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image">
        </td>
        </tr>
        <tr>
          <td class="col-sm-5" style="background-color:#E5E4E2;" align="left"><b>pwd Certificate</b><br>
            [maximum size 500kb Format:.jpg .jpeg .png]
          </td>
          <td class="col-sm-7" align="left">
            <input class="form-control" type="file" value="file" name="FileToUpload"><br>
            <input class="form-control" style="background-color: #E5E4E2; color: Black" type="submit" value="Upload" name="app-image">
        </td>
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







<?php
include_once 'includes/footer.php';
?>
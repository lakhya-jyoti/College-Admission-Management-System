<?php
include_once'includes/header.php';
$_SESSION['Student']="Student";

if(isset($_SESSION['Student'])==$fetch_user['user_status'] && $fetch_user['user_status']!="Student"){
    ?>
    <script>
     history.go(-1);
    </script>
    
    <?php
}
?>

<!-- Starts Here -->
<div class="col-sm-9">

    <form name="one" action="<?=$web_socket?>includes/action.php" method="post">
        <table class="table">
            <thead>



                <tr style="background-color:#04124f; color:white;" align="center">
                    <td><b>Declaration</b></td>
                </tr>

                <tr style="background-color:#C6C2C2; color:black;" align="left">
                    <td style="text-align: justify;">
                        I solemnly and sincerely affirm that I am Indian National / PIO/OCI holder and that all particulars furnished by me in this application form are true and correct. I have not concealed any information. However, in the event of any
                        information being found to be incorrect, fraudulent or untrue, either before or after the examination or after my admission to the programme,
                        I understand that I am liable to face criminal prosecution and the management can claim all authority to cancel my candidature / selection or admission
                        as the case may be and I would have to forgo my seat and the fees.
                        I will pay the required Tuition fees and the Hostel fees within the stipulated time to ensure my admission in NLC.
                        I agree to abide by the rules and regulations governing the examination as well as the rules pertaining to the refund of Tuition and Hostel fees.
                        I further undertake to submit all the required certificates as per the rule, either at the time of counselling or during
                        the admission process, failing which I understand that I would have to forego my seat and the fees.
                        I have read the NLC 2023 information brochure and understood the contents in general and the method of Equipercentile Equating in particular.
                        I accept this method to be adopted for Merit List preparation by NLC.
                        I understand that all information related to NLC application form and NLC exam will be only sent through the valid mobile number/email as provided by me in
                        the same form and consent to receive alerts / information by NLC through my mobile / email / connected social media platform.
                        I am also aware that the application cost and the Counselling Processing Fee are non-refundable. I understand that if I fail to fulfill the eligibility criteria my admission will be cancelled.
                    </td>
                </tr>






            </thead>
        </table>

        <center>
            <p style="font-size:medium; color: red;">
                <input type="checkbox" name="terms" value="1" required=""> &nbsp;&nbsp;
                <b>I read the NLC 2023 information brochure, fully understand the declaration and will comply with the guidelines.</b>
            </p>
            <button type="submit" name="term" class="btn btn-info" style="background-color: #04124f; color: white;"> Submit</button>


        </center>
    </form>
</div>
<!-- Ends Here -->

<?php
include_once'includes/footer.php';
?>
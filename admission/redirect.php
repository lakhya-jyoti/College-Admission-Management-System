<!-- This page created for redirecting the pages in the proper way -->
<!-- This site is Developed by Prakash Upadhyaya -->
<?php
require_once('../includes/dbconfig.php');

$user = $_SESSION['username'];
$select = "select * from applicants where std_email = :username or std_mob = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $user);
$stmt->execute();
$fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($fetch_user['user_status'] == 'Student') {
    header('location:aggrement.php');
} elseif ($fetch_user['user_status'] == 'fst_stage') {
    header('location:get_std_details.php');
} elseif ($fetch_user['user_status'] == 'snd_stage') {

header('location: course_select.php');
} elseif ($fetch_user['user_status'] == 'thrd_stage') {
    header('location:get_edu_det.php');
} elseif ($fetch_user['user_status'] == 'frth_stage') {
    header('location: get-bank-det.php');
} elseif ($fetch_user['user_status'] == 'fth_stage') {
    header('location:form-doc-up.php');
} elseif ($fetch_user['user_status'] == 'preview') {
    header('location: preview.php');
} elseif ($fetch_user['user_status'] == "pre_final") {
    header('location: std-profile.php');
} else {
    header('location: form-home.php');
}

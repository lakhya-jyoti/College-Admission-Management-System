<?php
error_reporting(0);
$page = "index";
require_once('../includes/dbconfig.php');

$user = $_SESSION['username'];
$select = "select * from applicants where std_email = :username or std_mob = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $user);
$stmt->execute();
$fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);
$std_name = $fetch_user['std_f_name'] . " " . $fetch_user['std_m_name'] . " " . $fetch_user['std_l_name'];


if (isset($_SESSION['loggedin']) != true) {

  header('location: ../includes/logout.php');
}
if (isset($_SESSION['user_status']) == $fetch_user['user_status'] && $fetch_user['user_status'] == "Admin") {
?>
  <script>
    alert("You are not a Student ! Please Contact admin");
  </script>
<?php

  header('location: ../includes/logout.php');
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Student Fee Payment Receipt</title>
  <style>
    .receipt {
      max-width: 400px;
      margin: auto auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
      border: 1px solid #ccc;

    }

    table td {
      padding: 5px;
      border: 1px solid #ccc;
    }

    table td:first-child {
      width: 150px;
      font-weight: bold;
    }

    p {
      text-align: center;
    }

    .paid {
      color: red;
      border: 1px solid black;
      padding: 4px;
      display: inline-table;
    }
    .rec{
      border: 1px solid #ccc;
    }
  </style>
</head>

<body>
  <div class="receipt">

    <?php
    $select = "select * from applicants inner join payment on applicants.applicants_id = payment.app_id where applicants.std_email = :username or applicants.std_mob = :username";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $fetch_payment = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="rec">
      <h2>North Lakhimpur College (A)</h2>
      <h2>Fee Payment Receipt</h2>
      <table>
        <svg id="barcode"></svg>
        </svg>
        <tr>
          <td><strong>Reference no:</strong></td>
          <td><?= $fetch_payment['p_ref_no'] ?></td>
        </tr>
        <tr>
          <td><strong>Student Name:</strong></td>
          <td><?= $std_name ?></td>
        </tr>
        <tr>
          <td><strong>Student ID:</strong></td>
          <td><?= $fetch_payment['std_application_no'] ?></td>
        </tr>
        <tr>
          <td><strong>Payment Date:</strong></td>
          <td><?= $fetch_payment['p_date'] ?></td>
        </tr>
        <tr>

        <tr>
          <td><strong>Payment Amount:</strong></td>
          <td>&#x20B9; <?= $fetch_payment['p_amnt'] ?>/-</td>
        </tr>
        <tr>
          <td><strong>Payment Method:</strong></td>
          <td>Online</td>
        </tr>
      </table>
      <p>Thank you for your payment!</p>
    </div>
    <h4 class="paid">PAID</h4>
    <h6><b>This is Computer Generated Receipt. No Signature is required</b></h6>
    <h6>N.B. : This Receipt must be produced at the time of next admission/payment.</h6>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <script>
    JsBarcode("#barcode", "<?= $fetch_payment['p_ref_no'] ?>", {
      height: 50
    });
    window.print();
    window.onafterprint = function(event) {
      window.close();
    };
  </script>
</body>

</html>
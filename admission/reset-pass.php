<?php
$page = "index";
require_once('../includes/dbconfig.php');
if (isset($_SESSION['email']) != true) {
    header('location: /');
    session_destroy();
}
if(isset($_POST['reset'])){
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    if($password == $c_password){
        $hash = password_hash($password,PASSWORD_BCRYPT);
        $update = 'UPDATE `applicants` SET `std_pass`=:password WHERE  std_email = :id';
        $stmt = $con->prepare($update);
        $stmt->bindParam(':password',$hash);
        $stmt->bindParam(':id',$_SESSION['id']);
        if($stmt->execute()){
            session_destroy();
            ?>
            <script>
                alert('Password Updated Successfully');
                location.href='/';
            </script>
            <?php
        }else{
            session_destroy();
            ?>
            <script>
                alert('Something went wrong');
                location.href='/';
            </script>
            <?php
        }
    }else{
        ?>
        <script>
            alert('Password and confirm password not matched');
        </script>
        <?php
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="col-md-4 mx-auto mt-4">
            <form action="" method="POST">
                <div class="alert alert-dark" role="alert">
                    Reset Password
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Enter a new Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                    <input type="password" name="c_password" class="form-control" id="exampleInputPassword1" required>
                </div>

                <button type="submit" name="reset" class="btn btn-primary">Reset</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
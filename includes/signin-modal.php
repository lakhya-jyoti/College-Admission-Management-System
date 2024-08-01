<div class="signin-modal" id="signin-modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h1>SIGN IN</h1>
        </div>
        <div class="main-form">
            <form action="<?= $web_socket ?>includes/action.php" id="login_form" method="POST">
                <div class="email">
                    <label for="email">Email Id / Mobile No</label><br>
                    <input type="text" name="email" id="email" placeholder="Email Id / Mobile No" required><br>
                </div>
                <div class="password">
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" placeholder="Password" required><br>
                </div>
                <div class="forget">
                    <a href="<?=$web_socket?>admission/forgot-password.php">Forget Password?</a>
                </div>
                <button type="submit" name="login" id="login_submit">Sign In</button>
            </form>
        </div>
    </div>
</div>
<script>
    var modal = document.getElementById("signin-modal");


    var btn1 = document.getElementById("signin-btn1");

    var span = document.getElementsByClassName("close")[0];
    btn1.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
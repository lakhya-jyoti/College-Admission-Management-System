<div class="sticky-header">
    
        <div class="first-header" style="margin: auto;">
            <?php
            if(isset($_SESSION['username'])){
                ?>
            <p>Welcome <?=$_SESSION['username']?></p>
            <a href="<?=$web_socket?>includes/logout.php" style="padding: 5px; background-color: black;" class="new-regs">Logout</a>
                
                <?php
            }else{
                ?>
                <p>nlcollege.autonomous@gmail.com</p>
                
                <?php
            }
            ?>
        </div>
    
    <div class="main-header">
        <div class="left-logo">
            <img class="new-logo" src="<?= $web_socket ?>images/logo2.png" alt="" srcset="">
            <img class="logo-new" src="<?= $web_socket ?>images/logo_new.png" alt="" srcset="">
        </div>
        <div class="right-logo">
            <p>North Lakhimpur College (A)
            </p>
        </div>
    </div>
    <hr>
    <div class="welcome-note">
        <p>Welcome to North Lakhimpur College(Autonomous)</p>
    </div>
</div>
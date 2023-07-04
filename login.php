<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location: homepage.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="title">
            Login Form
        </div>
        <center><strong id="errorMsg">

                <?php
       
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];

                    unset($_SESSION['error']);
                }


                ?>

            </strong></center>
        <form action="signin.php" method="post">
            <div class="field">
                <input type="email" name="Email_ID" value="<?php echo $_SESSION['email']; 
                                                            ?>" required>
                <label>Email Address</label>
            </div>
            <div class="field">
                <input type="password" name="Password" required>
                <label>Password</label>
            </div>
            <!-- <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="pass-link">
                    <a href="#">Forgot password?</a>
                </div>
            </div> -->
            <div class="field">
                <input type="submit" name="login" value="Login">
            </div>
            <div class="signup-link">
                Don't have an account ? <a href="index.php">Register now</a>
            </div>
        </form>
    </div>

</body>

</html>

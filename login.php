<?php
// Connection to db and db functions
include 'phpScripts/connection.php';
include 'phpScripts/db_functions.php';

// start session
session_start();

if (isset($_SESSION['login_failed'])) {
    $register_prompt = "Invalid Password. Need an account? <a href='register.php'>Register here!</a>";

} else {
    $register_prompt = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register on SYSCX</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <h1>SYSCX</h1>
        <p>Social media for SYSC students in Carleton University</p>
    </header>

    <!-- Container for page layout -->
    <div class="container">
        <!-- Nav section-->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="profile.php">Profile</a></li> -->
                <li><a href="register.php">Register</a></li>
                <li class="active"><a href="login.php">Log In</a></li>
            </ul>
        </nav>

        <!-- Main section -->
        <main>
            <div class="login-section">
                <form action="phpScripts/process_login.php" method="POST">

                    <fieldset class="login-fieldset">
                        <legend><span>Login</span></legend>
                        <table>
                            <tr>
                                <td><label for="student_email">Email Address:</label></td>
                                <td><input type="text" id="student_email" name="student_email"></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password:</label></td>
                                <td><input type="password" id="password" name="password"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Submit"></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
                <!-- Prompt user with link to register if login attempt failed -->
                <p>
                    <?php
                    echo "{$register_prompt}";
                    // unset($_SESSION['login_failed']);
                    ?>
                </p>

            </div>
        </main>

        <!-- User info section -->
        <div class="user-info">
            <p>
                First Last Name
            </p>
            <img src="images/img_avatar1.png" alt="">
            <p>Email:</p>
            <a href="mailto:student@cmail.carleton.ca">student@cmail.carleton.ca</a>
            <p>Program:</p>
            <p>Computer Systems Engineering</p>
        </div>
    </div>
</body>

</html>
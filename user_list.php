<?php
// connection to db and db functions
include 'phpScripts/connection.php';
include 'phpScripts/db_functions.php';

// start session
session_start();

// Check if user is logged in and an admin
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
    // Try connection
    try {
        // Connect to database
        $conn = new mysqli($server_name, $username, $password, $database_name);

        // Check if user is admin
        $user_permissions = getUserPermissions($conn, $student_id);
        if ($user_permissions['account_type'] == 1) {
            header("Location: index.php");
            exit();
        }

        // Required table info
        // - student_id (users_info)
        // - first_name (users_info)
        // - last_name (users_info)
        // - student_email (users_info)
        // - program (users_program)
        // - account_type (users_permissions)
        $user_list = getUserList($conn);

        // Get user_info data
        $users_info = getUserInfo($conn, $student_id);
        $users_program = getUserProgram($conn, $student_id);
        $users_avatar = getUserAvatar($conn, $student_id);
        $users_address = getUserAddress($conn, $student_id);

        extract($users_info);
        extract($users_program);
        extract($users_avatar);
        extract($users_address);

    } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
        echo $error;
    }
}
// User not logged in or not an admin
else {
    // Redirect user to login page
    header("Location: login.php");
    exit();
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Log Out</a></li>
                <li class="active"><a href="logout.php">User List</a></li>
            </ul>
        </nav>

        <!-- Main section -->
        <main>
            <div class="wrapper">
                <legend><span>User List</span></legend>
                <table>
                    <!-- <caption><span>User List</span></caption> -->
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Program</th>
                            <th>Account Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($user_list as $user): ?>
                            <tr>
                                <td data-cell="student_id"><?php echo $user['student_id']; ?></td>
                                <td data-cell="first_name"><?php echo $user['first_name']; ?></td>
                                <td data-cell="last_name"><?php echo $user['last_name']; ?></td>
                                <td data-cell="student_email"><?php echo $user['student_email']; ?></td>
                                <td data-cell="program"><?php echo $user['program']; ?></td>
                                <td data-cell="account_type"><?php echo $user['account_type']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>

        <!-- User Info section -->
        <!-- User info section -->
        <div class="user-info">
            <p>
                <?php
                if ($first_name != NULL) {
                    echo "{$first_name} {$last_name}";
                } else {
                    echo "first last name";
                }
                ?>
            </p>

            <img src="
         <?php
         if ($avatar == 2) {
             echo "images/img_avatar2.png";
         } else if ($avatar == 3) {
             echo "images/img_avatar3.png";
         } else if ($avatar == 4) {
             echo "images/img_avatar4.png";
         } else if ($avatar == 5) {
             echo "images/img_avatar5.png";
         } else {
             echo "images/img_avatar1.png";
         }
         ?>" alt="">

            <p>Email:</p>
            <!-- If user is registered through register.php (db not empty): -->
            <!-- Mailto link for sending email to users own stored email address through default email client -->
            <!-- If user not registered (db is empty): -->
            <!-- Hyperlink for sending new email to the default email from A01 (student@cmail.carleton.ca) -->
            <a href="mailto:<?php if ($student_email != NULL) {
                echo $student_email;
            } else {
                echo "student@cmail.carleton.ca";
            } ?>">
                <!-- If user has registered: set link text to stored student email if user has registered -->
                <!-- If user has not registered: set link text to default email from A01 -->
                <?php if ($student_email != NULL) {
                    echo $student_email;
                } else {
                    echo "student@cmail.carleton.ca";
                } ?>
            </a>

            <p>Program:</p>
            <p>
                <?php
                if ($program != NULL) {
                    echo $program;
                } else {
                    echo "Computer Systems Engineering";
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>
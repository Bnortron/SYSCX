<?php
// Include server info
include ("connection.php");

// start session
session_start();

// Check if email/password entered
if (isset($_POST['student_email']) && isset($_POST['password'])) {
    try {
        // Connect to database
        $conn = new mysqli($server_name, $username, $password, $database_name);

        // Login form info
        $student_email = $_POST['student_email'];
        $password = $_POST['password'];

        // Find password from users_passwords corresponding to entered student_email
        $sql = "SELECT u.student_id, p.password FROM users_info u INNER JOIN users_passwords p ON u.student_id = p.student_id
            WHERE u.student_email = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param('s', $student_email);
        $statement->execute();
        $result = $statement->get_result();

        // Row found with entered email
        if ($result->num_rows == 1) {
            // Get the hashed password from row
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify hashed password
            if (password_verify($password, $hashed_password)) {
                // Password verified and student_id stored
                $_SESSION['student_id'] = $row['student_id'];

                // Redirect user
                header("Location: ../index.php");
                // echo "Passwords match!";
                exit();
            } else {
                // echo "Password invalid!";
                $_SESSION['login_failed'] = true;
                header("Location: ../login.php");
                exit();
            }
        }
        // No row found with entered email 
        else {
            // echo "Email does not exist!";
            $_SESSION['login_failed'] = true;
            header("Location: ../login.php");
            exit();
        }

    } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
        echo $error;
    }


}
// No email/password submitted
else {
    // Mark failed login attempt
    $_SESSION['login_failed'] = true;
    // echo "Please enter your Email and Password";

    // Redirect user back to login page
    header("Location: ../login.php");
    exit();
}


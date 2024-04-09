<?php
// Include server information
include ("connection.php");

// check session started
session_start();

// Check if student id is set
if (isset($_SESSION['student_id'])) {
	$student_id = $_SESSION['student_id'];

	// Try connection
	try {
		// Connect to database
		$conn = new mysqli($server_name, $username, $password, $database_name);
		// echo "Connected Successfully <br>";

		// Get new post
		$new_post = mysqli_real_escape_string($conn, $_POST['new_post']);

		// Update users_posts
		$sql = "INSERT INTO users_posts (student_id, new_post) VALUES (?,?)";
		$statement = $conn->prepare($sql);
		$statement->bind_param('is', $student_id, $new_post);
		$statement->execute();

		// Redirect user back to index after post submission
		header("Location: ../index.php");
	} catch (mysqli_sql_exception $e) {
		$error = $e->getMessage();
		echo $error;
	}

} else {
	echo "Invalid Student ID";
}
?>
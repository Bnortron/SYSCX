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

		// Personal Information:
		// - first_name
		// - last_name
		// - DOB
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$dob = $_POST['DOB'];

		// Address information:
		// - street_number
		// - street_name
		// - city
		// - province
		// - postal_code
		$street_number = $_POST['street_number'];
		$street_name = $_POST['street_name'];
		$city = $_POST['city'];
		$province = $_POST['province'];
		$postal_code = $_POST['postal_code'];

		// Profile Information:
		// - student_email
		// - program
		// - avatar
		$student_email = $_POST['student_email'];
		$program = $_POST['program'];
		$avatar = $_POST['avatar'];

		// Update users_info
		$sql = "UPDATE users_info SET first_name = ?, last_name = ?, dob = ?, student_email = ? WHERE student_id = ?";
		$statement = $conn->prepare($sql);
		$statement->bind_param('ssssi', $first_name, $last_name, $dob, $student_email, $student_id);
		$statement->execute();

		// Update users_program
		$sql = "UPDATE users_program SET program = ? WHERE student_id = ?";
		$statement = $conn->prepare($sql);
		$statement->bind_param('si', $program, $student_id);
		$statement->execute();

		// update users_avatar
		$sql = "UPDATE users_avatar SET avatar = ? WHERE student_id = ?";
		$statement = $conn->prepare($sql);
		$statement->bind_param('ii', $avatar, $student_id);
		$statement->execute();

		// update users_address
		$sql = "UPDATE users_address SET street_number = ?, street_name = ?, city = ?, province = ?, postal_code = ? WHERE student_id = ?";
		$statement = $conn->prepare($sql);
		$statement->bind_param('issssi', $street_number, $street_name, $city, $province, $postal_code, $student_id);
		$statement->execute();

		header("Location: ../profile.php");
	} catch (mysqli_sql_exception $e) {
		$error = $e->getMessage();
		echo $error;
	}

} else {
	echo "Invalid Student ID";
}
?>
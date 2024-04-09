<?php
//Start a new session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Update SYSCBOOK profile</title>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<header>
		<h1>SYSCBOOK</h1>
		<p>Social media for SYSC students in Carleton University</p>
	</header>
	<!-- remove -->
	<nav id="nav-bar-left">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="profile.php" class="active">Profile</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<!-- remove -->

	<main>
		<section>
			<h2>Update Profile information</h2>
			<!-- solution as a table-->
			<form method="POST">
				<fieldset>
					<legend><span>Personal information</span></legend>
					<!-- remove -->
					<table>
						<tr>
							<td><label>First Name:</label><input type="text" name="first_name" placeholder="ex: John Snow"></td>
							<td><label>Last Name:</label> <input type="text" name="last_name"></td>
							<td><label>DOB:</label><input type="date" name="DOB"></td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend><span>Address</span></legend>
					<table>
						<tr>
							<td><label>Street Number:</label><input type="number" name="street_number"></td>
							<td colspan="2"><label>Street Name:</label><input type="text" name="street_name"></td>
						</tr>
						<tr>
							<td><label>City:</label><input type="text" name="city"></td>
							<td><label>Province:</label><input type="text" name="province"></td>
							<td><label>Postal Code:</label><input type="text" name="postal_code"></td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend><span>Profile information</span></legend>

					<table>
						<tr>
							<td><label>Email addrress:</label><input type="email" name="student_email"></td>
						</tr>
						<tr>
							<td><label>Program</label>
								<select name="Program">
									<option>Choose Program</option>
									<option>Computer Systems Engineering</option>
									<option>Software Engineering</option>
									<option>Communications Engineering</option>
									<option>Biomedical and Electrical</option>
									<option>Electrical Engineering</option>
									<option>Special</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label>Choose your Avatar</label><br>
								<input type="radio" id="avatar1" name="avatar" value="0" checked>
								<label for="avatar1"><img src="images/img_avatar1.png" alt="avatar1"></label>
								<input type="radio" id="avatar2" name="avatar" value="1">
								<label for="avatar2"><img src="images/img_avatar2.png" alt="avatar2"></label>
								<input type="radio" id="avatar3" name="avatar" value="2">
								<label for="avatar3"><img src="images/img_avatar3.png" alt="avatar3"></label>
								<input type="radio" id="avatar4" name="avatar" value="3">
								<label for="avatar4"><img src="images/img_avatar4.png" alt="avatar4"></label>
								<input type="radio" id="avatar5" name="avatar" value="4">
								<label for="avatar5"><img src="images/img_avatar5.png" alt="avatar5"></label>
							</td>
						</tr>
					</table>
					<input type="submit" name="submit_profile">
					<input type="reset">
					<!-- remove -->
				</fieldset>
			</form>

			<?php
			if (isset($_SESSION) && isset($_POST["submit_register"])) {
				try {
					include_once("connection.php");
					$conn = new mysqli($server_name, $username, $password, $database_name);

					$first_name = $_POST["first_name"];
					$last_name = $_POST["last_name"];
					$DOB = $_POST["DOB"];
					$student_email = $_POST["student_email"];
					$Program = $_POST["Program"];

					$sql = "INSERT INTO users_info VALUES (NULL, '" . $student_email . "','" . $first_name . "','" . $last_name . "','" . $DOB . "');";
					$conn->query($sql);

					$sql = "SELECT max(student_ID) AS student_ID FROm users_info WHERE 1;";
					$_SESSION['student_ID'] = $conn->query($sql)->fetch_assoc()['student_ID'];

					$sql = "INSERT INTO users_address VALUES ('" . $_SESSION['student_ID'] . "',NULL, NULL, NULL, NULL, NULL);";
					$conn->query($sql);

					$sql = "INSERT INTO users_avatar VALUES ('" . $_SESSION['student_ID'] . "', 0);";
					$conn->query($sql);

					$sql = "INSERT INTO users_program VALUES ('" . $_SESSION['student_ID'] . "', '" . $Program . "');";
					$conn->query($sql);

			?>
					<script type='text/javascript'>
						const inputControl = document.querySelectorAll("input, select");
						console.log("<?php echo $first_name; ?>");
						for (let inputCont of inputControl) {
							switch (inputCont.name) {
								case "first_name":
									inputCont.value = "<?php echo $first_name; ?>";
									break;
								case "last_name":
									inputCont.value = "<?php echo $last_name; ?>";
									break;
								case "DOB":
									inputCont.value = "<?php echo $DOB; ?>";
									break;
								case "student_email":
									inputCont.value = "<?php echo $student_email; ?>";
									break;
								case "Program":
									inputCont.value = "<?php echo $Program; ?>";
									break;
							}
						}
					</script>

			<?php
					$conn->close();
				} catch (mysqli_sql_exception $e) { // check if the connection was successful
					$error = $e->getMessage();
					echo $error;
				}
			} elseif (isset($_SESSION['student_ID']) && isset($_POST["submit_profile"])) {
			
				/*
				
				Handle profile form submission
				
				*/
			
			}
			?>
		</section>
	</main>

	<div id="user-info-right">
		<ul>
			<li>
				<p id="name">First Last Name</p>
			</li>
			<li><img src="images/img_avatar2.png" alt="avatar2"></li>
			<li>Email: <a href="mailto:student@cmail.carleton.ca">student@cmail.carleton.ca</a></li>
			<li>Program: <p>Computer Systems Engineering</p>
			</li>
		</ul>

	</div>
</body>

</html>
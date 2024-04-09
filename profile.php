<?php
// Include connection to db and db functions
require_once 'phpScripts/connection.php';
require_once 'phpScripts/db_functions.php';

// Check session
session_start();

if (isset($_SESSION['student_id'])) {
   $student_id = $_SESSION['student_id'];

   // Try connection
   try {
      // Connect to database
      $conn = new mysqli($server_name, $username, $password, $database_name);
      // echo "Connected Successfully <br>";

      // Get user_info data
      $users_info = getUserInfo($conn, $student_id);
      $users_program = getUserProgram($conn, $student_id);
      $users_avatar = getUserAvatar($conn, $student_id);
      $users_address = getUserAddress($conn, $student_id);

      // If user has registered and tables user_info, user_program, users_avatar, users_address are not NULL
      // Prevents fatal error from extract() on empty array(s)
      if ($users_info && $users_program && $users_avatar && $users_address) {
         // Extract keys from function arrays and turn them into variables with associated value from db
         extract($users_info);
         extract($users_program);
         extract($users_avatar);
         extract($users_address);
      }
      // If user has not registered through register.php page, then set all php variables to NULL/empty
      // Prevents undefined variable error(s) (crashes page if user navigates from register.php without registering)
      else {
         $first_name = '';
         $last_name = '';
         $dob = '';

         $street_number = NULL;
         $street_name = '';
         $city = '';
         $province = '';
         $postal_code = '';

         $student_email = '';
         $program = '';
         $avatar = NULL;
      }

   } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      echo $error;
   }

} else {
   echo "Invalid Student ID";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Update SYSCX profile</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
   <header>
      <h1>SYSCX</h1>
      <p>Social media for SYSC students in Carleton University</p>
   </header>
   <div class="container">
      <nav>
         <ul>
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="profile.php">Profile</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="">Log out</a></li>
         </ul>
      </nav>

      <main>
         <div class="main-container">
            <h2>Update Profile information</h2>
            <form action="phpScripts/process_profile.php" method="POST">
               <fieldset>
                  <legend><span>Personal information</span></legend>
                  <table>
                     <tr>
                        <td><label for="first_name">First Name:</label></td>
                        <td><input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                        </td>

                        <td><label for="last_name">Last Name:</label></td>
                        <td><input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>"></td>

                        <td><label for="DOB">DOB:</label></td>
                        <td><input type="date" id="DOB" name="DOB" value="<?php echo $dob; ?>"></td>
                     </tr>
                  </table>
               </fieldset>

               <fieldset>
                  <legend><span>Address</span></legend>
                  <table>
                     <tr>
                        <td colspan="2"><label for="street_number">Street Number:</label></td>
                        <td><input type="number" id="street_number" name="street_number" min="1" max="100000"
                              value="<?php echo $street_number; ?>"></td>

                        <td colspan="2"><label for="street_name">Street Name:</label></td>
                        <td><input type="text" id="street_name" name="street_name" value="<?php echo $street_name; ?>">
                        </td>
                     </tr>

                     <tr>
                        <td><label for="city">City:</label></td>
                        <td><input type="text" id="city" name="city" value="<?php echo $city; ?>"></td>

                        <td><label for="province">Province:</label></td>
                        <td><input type="text" id="province" name="province" value="<?php echo $province; ?>"></td>

                        <td><label for="postal_code">Postal Code:</label></td>
                        <td><input type="text" id="postal_code" name="postal_code" value="<?php echo $postal_code; ?>">
                        </td>
                     </tr>
                  </table>
               </fieldset>


               <fieldset>
                  <legend><span>Profile Information</span></legend>
                  <table>
                     <tr>
                        <td colspan="5"><label for="student_email">Email Address:</label></td>
                        <td colspan="5"><input type="text" id="student_email" name="student_email"
                              value="<?php echo $student_email; ?>"></td>
                     </tr>

                     <tr>
                        <td colspan="5"><label for="program">Program</label></td>
                        <td colspan="5">
                           <select name="program" id="program">
                              <option value="placeholder" <?php if ($program == '')
                                 echo 'selected'; ?>>Choose Program
                              </option>

                              <option value="Computer Systems Engineering" <?php if ($program == 'Computer Systems Engineering')
                                 echo 'selected'; ?>>Computer Systems
                                 Engineering</option>

                              <option value="Software Engineering" <?php if ($program == 'Software Engineering')
                                 echo 'selected'; ?>>Software Engineering</option>

                              <option value="Communications Engineering" <?php if ($program == 'Communications Engineering')
                                 echo 'selected'; ?>>Communications Engineering
                              </option>

                              <option value="Biomedical and Electrical" <?php if ($program == 'Biomedical and Electrical')
                                 echo 'selected'; ?>>Biomedical and Electrical</option>

                              <option value="Electrical Engineering" <?php if ($program == 'Electrical Engineering')
                                 echo 'selected'; ?>>Electrical Engineering</option>

                              <option value="special" <?php if ($program == 'special')
                                 echo 'selected'; ?>>Special</option>
                           </select>
                        </td>
                     </tr>

                     <tr>
                        <td colspan="10"><label>Choose your Avatar</label></td>
                     </tr>

                     <tr>
                        <td><input type="radio" id="avatar_1" name="avatar" value="1" <?php echo ($avatar == 1) ? 'checked' : ''; ?>></td>
                        <td><label for="avatar_1"><img src="images/img_avatar1.png" alt=""></label></td>

                        <td><input type="radio" id="avatar_2" name="avatar" value="2" <?php echo ($avatar == 2) ? 'checked' : ''; ?>></td>
                        <td><label for="avatar_2"><img src="images/img_avatar2.png" alt=""></label></td>

                        <td><input type="radio" id="avatar_3" name="avatar" value="3" <?php echo ($avatar == 3) ? 'checked' : ''; ?>></td>
                        <td><label for="avatar_3"><img src="images/img_avatar3.png" alt=""></label></td>

                        <td><input type="radio" id="avatar_4" name="avatar" value="4" <?php echo ($avatar == 4) ? 'checked' : ''; ?>></td>
                        <td><label for="avatar_4"><img src="images/img_avatar4.png" alt=""></label></td>

                        <td><input type="radio" id="avatar_5" name="avatar" value="5" <?php echo ($avatar == 5) ? 'checked' : ''; ?>></td>
                        <td><label for="avatar_5"><img src="images/img_avatar5.png" alt=""></label></td>
                     </tr>
                  </table>
                  <input type="submit" value="Submit">
                  <input type="reset" value="Reset">
               </fieldset>
            </form>
         </div>

      </main>

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
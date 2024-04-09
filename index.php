<?php
// Connection to db and db functions
include 'phpScripts/connection.php';
include 'phpScripts/db_functions.php';

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
      $user_info = getUserInfo($conn, $student_id);
      $user_program = getUserProgram($conn, $student_id);
      $user_avatar = getUserAvatar($conn, $student_id);

      // If user has registered:
      if ($user_info && $user_program && $user_avatar) {
         // Extract keys from function arrays and turn them into variables with associated value from db
         extract($user_info);
         extract($user_program);
         extract($user_avatar);
      } else {
         $first_name = '';
         $last_name = '';
         $student_email = '';
         $program = '';
         $avatar = NULL;
      }

      // Get last 5 posts from all users
      $sql = "SELECT * FROM users_posts ORDER BY post_ID DESC LIMIT 5";
      $result = $conn->query($sql);

      // Put posts & post timestamps in arrays
      $posts = array();
      $post_times = array();
      while ($row = $result->fetch_assoc()) {
         $posts[] = $row['new_post'];
         $post_times[] = $row['post_date'];
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
   <title>Register on SYSCX</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
   <!-- Header code -->
   <header>
      <h1>SYSCX</h1>
      <p>Social media for SYSC students in Carleton University</p>
   </header>
   <!-- Nav section -->
   <div class="container">
      <nav>
         <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="">Log out</a></li>
         </ul>
      </nav>

      <!-- Main section -->
      <main>
         <div class="main-container">
            <div class="new-post-container">
               <h2>New post</h2>
               <form action="phpScripts/process_index.php" method="POST">
                  <fieldset>
                     <table>
                        <tr>
                           <td colspan="2" class="new_post"><textarea name="new_post" id="new_post" cols="50" rows="5"
                                 placeholder="What is happening?! (max 280 char)" maxlength="280"></textarea></td>
                        </tr>
                        <tr>
                           <td><input type="submit" value="Submit"></td>
                           <td><input type="reset" value="Reset"></td>
                        </tr>
                     </table>
                  </fieldset>
               </form>

               <table>
                  <?php $count = 0; ?>
                  <?php foreach ($posts as $post): ?>
                     <tr>
                        <td>
                           <div class="post">
                              <details>
                                 <summary>Post
                                    <span class=".post-time">[
                                       <?php echo $post_times[$count]; ?>
                                       ]
                                    </span>
                                 </summary>
                                 <p class="post-text">
                                    <?php echo $post ?>
                                 </p>
                              </details>
                           </div>
                        </td>
                     </tr>
                     <?php $count++; ?>
                  <?php endforeach; ?>
               </table>

            </div>

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
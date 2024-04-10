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
            <li class="active"><a href="register.php">Register</a></li>
            <li><a href="login.php">Log In</a></li>
         </ul>
      </nav>
      <!-- Main section -->
      <main>
         <div class="main-container">
            <h2>Register a new profile</h2>
            <form action="phpScripts/process_register.php" method="POST" onsubmit="return validateForm()">
               <!-- 1d. Changes to register -->
               <fieldset>
                  <legend><span>Password Information</span></legend>
                  <table>
                     <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" required></td>

                        <td><label for="confirm_password">Confirm Password:</label></td>
                        <td><input type="password" id="confirm_password" name="confirm_password" required></td>

                        <script>
                           function validateForm() {
                              var password = document.getElementById("password").value;
                              var confirmPassword = document.getElementById("confirm_password").value;

                              if (password != confirmPassword) {
                                 alert("Passwords must match");
                                 return false;
                              }
                              return true;
                           }
                        </script>
                     </tr>
                  </table>
               </fieldset>

               <fieldset>
                  <legend><span>Personal information</span></legend>
                  <table>
                     <tr>
                        <td><label for="first_name">First Name:</label></td>
                        <td><input type="text" id="first_name" name="first_name" required></td>

                        <td><label for="last_name">Last Name:</label></td>
                        <td><input type="text" id="last_name" name="last_name" required></td>

                        <td><label for="DOB">DOB:</label></td>
                        <td><input type="date" id="DOB" name="DOB" required></td>
                     </tr>
                  </table>
               </fieldset>

               <fieldset>
                  <legend><span>Profile Information</span></legend>
                  <table>
                     <tr>
                        <td><label for="student_email">Email Address:</label></td>
                        <td><input type="text" id="student_email" name="student_email" required></td>
                     </tr>

                     <tr>
                        <td><label for="program">Program</label></td>
                        <td>
                           <select name="program" id="program" required>
                              <option value="placeholder">Choose Program</option>
                              <option value="Computer Systems Engineering">Computer Systems Engineering</option>
                              <option value="Software Engineering">Software Engineering</option>
                              <option value="Communications Engineering">Communications Engineering</option>
                              <option value="Biomedical and Electrical">Biomedical and Electrical</option>
                              <option value="Electrical Engineering">Electrical Engineering</option>
                              <option value="special">Special</option>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td><input type="submit" value="Submit"></td>
                        <td><input type="reset" value="Reset"></td>
                     </tr>
                  </table>
               </fieldset>
            </form>
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
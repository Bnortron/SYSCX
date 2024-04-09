# SYSCBOOK

## SYSCBOOK Overview

This project involves updating and adding new features to an existing web application. The goal is to implement user authentication, registration, and user permissions functionality.

## Part 3 - Checklist

### Updating assignment 02’s files:

- [ ] Switch all MySQL statements to prepared statements.
- [ ] Update index.php page:
  - [ ] Check if the user is logged in.
  - [ ] Display the last 10 posts if the user is logged in.
- [ ] Update profile.php page:
  - [ ] Check if the user is logged in.
  - [ ] Display user information if logged in.
- [ ] Update register.php page:
  - [ ] Add password and confirm password fields.
  - [ ] Validate password confirmation with JavaScript.
  - [ ] Check if the email address already exists in the database.
  - [ ] Hash the password using `password_hash()` function.
  - [ ] Prompt the user to log in if they don't have an account.
- [ ] Update user info section:
  - [ ] Display user information based on login status.
- [ ] Update navigation menu:
  - [ ] Display appropriate links based on login status and user type.

### Adding new features:

- [ ] Create users_passwords table:
  - [ ] Create a table with columns student_id (primary key) and password.
- [ ] Create login.php page:
  - [ ] Implement login functionality with email and password authentication.
  - [ ] Redirect the user to index.php upon successful login.
  - [ ] Prompt the user to register if they don't have an account.
- [ ] Create logout.php page:
  - [ ] Implement logout functionality to destroy the session.
  - [ ] Redirect the user to login.php after logout.
- [ ] Create users_permissions table:
  - [ ] Create a table with columns student_id (primary key) and account_type.
- [ ] Create user_list.php page:
  - [ ] Display a list of users and their information.
  - [ ] Accessible only by users with admin permissions.

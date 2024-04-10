# SYSCBOOK

## SYSCBOOK Overview

This project involves updating and adding new features to an existing web application. The goal is to implement user authentication, registration, and user permissions functionality.

## Part 3 - Checklist

### Updating assignment 02’s files:

- [x] Switch all MySQL statements to prepared statements.
- [x] Update index.php page:
  - [x] Check if the user is logged in.
  - [x] Display the last 10 posts if the user is logged in.
- [x] Update profile.php page:
  - [x] Check if the user is logged in.
  - [x] Display user information if logged in.
- [x] Update register.php page:
  - [x] Add password and confirm password fields.
  - [x] Validate password confirmation with JavaScript.
  - [x] Check if the email address already exists in the database.
  - [x] Hash the password using `password_hash()` function.
  - [x] Prompt the user to log in if they don't have an account.
- [x] Update user info section:
  - [x] Display user information based on login status.
- [x] Update navigation menu:
  - [x] Display appropriate links based on login status and user type.

### Adding new features:

- [x] Create users_passwords table:
  - [x] Create a table with columns student_id (primary key) and password.
- [x] Create login.php page:
  - [x] Implement login functionality with email and password authentication.
  - [x] Redirect the user to index.php upon successful login.
  - [x] Prompt the user to register if they don't have an account.
- [x] Create logout.php page:
  - [x] Implement logout functionality to destroy the session.
  - [x] Redirect the user to login.php after logout.
- [x] Create users_permissions table:
  - [x] Create a table with columns student_id (primary key) and account_type.
- [x] Create user_list.php page:
  - [x] Display a list of users and their information.
  - [x] Accessible only by users with admin permissions.

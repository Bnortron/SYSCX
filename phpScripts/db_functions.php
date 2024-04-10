<?php
// Include server information
include ("connection.php");

// Gets all data from users_info table in db for given student_id row
function getUserInfo($conn, $student_id)
{
    $sql = "SELECT * FROM users_info WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from users_address table in db for given student_id row
function getUserAddress($conn, $student_id)
{
    $sql = "SELECT * FROM users_address WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from users_program table in db for given student_id row
function getUserProgram($conn, $student_id)
{
    $sql = "SELECT program FROM users_program WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from users_avatar table in db for given student_id row
function getUserAvatar($conn, $student_id)
{
    $sql = "SELECT avatar FROM users_avatar WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from users_passwords table in db for given student_id row
function getUserPasswords($conn, $student_id)
{
    $sql = "SELECT password FROM users_passwords WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from users_permissions table in db for given student_id row
function getUserPermissions($conn, $student_id)
{
    $sql = "SELECT account_type FROM users_permissions WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets list of all users in db
function getUserList($conn)
{
    $sql = "SELECT uInfo.student_id, uInfo.first_name, uInfo.last_name, uInfo.student_email, uProgram.program, uPermissions.account_type
                FROM users_info uInfo
                INNER JOIN users_program uProgram ON uInfo.student_id = uProgram.student_id
                INNER JOIN users_permissions uPermissions on uInfo.student_id = uPermissions.student_id";
    $statement = $conn->query($sql);

    $user_list = [];

    while ($row = $statement->fetch_assoc()) {
        $user_list[] = $row;
    }

    return $user_list;
}

// Gets all data from users_posts table in db for given student_id row
function getUserPosts($conn, $student_id)
{
    $sql = "SELECT * FROM users_posts WHERE student_id = ? ORDER BY post_ID DESC LIMIT 10";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}

?>
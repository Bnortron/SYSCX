<?php
// Include server information
include ("connection.php");

// Gets all data from user_info table in db for given student_id row
function getUserInfo($conn, $student_id) {
    $sql = "SELECT * FROM users_info WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from user_address table in db for given student_id row
function getUserAddress($conn, $student_id){
    $sql = "SELECT * FROM users_address WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from user_program table in db for given student_id row
function getUserProgram($conn, $student_id) {
    $sql = "SELECT program FROM users_program WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

// Gets all data from user_avatar table in db for given student_id row
function getUserAvatar($conn, $student_id) {
    $sql = "SELECT avatar FROM users_avatar WHERE student_id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $student_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

?>
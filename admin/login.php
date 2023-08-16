<?php
// Start session
session_start();

// Array to store validation errors
$errmsg_arr = array();

// Validation error flag
$errflag = false;

// Connect to MySQL server using MySQLi
$mysqli = new mysqli('localhost', 'root', '', 'if0_34583391_milkybaby.sql');
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Function to sanitize values received from the form. Prevents SQL injection
function clean($str)
{
    global $mysqli;
    $str = trim($str);
    $str = stripslashes($str);
    return $mysqli->real_escape_string($str);
}

// Sanitize the POST values
$login = clean($_POST['username']);
$password = clean($_POST['password']);

// Input Validations
if ($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

// If there are input validations, redirect back to the login form
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
}

// Create query using prepared statements
$query = "SELECT * FROM user WHERE username=? AND password=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $login, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check whether the query was successful or not
if ($result) {
    if ($result->num_rows > 0) {
        // Login Successful
        session_regenerate_id();
        $member = $result->fetch_assoc();
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['name'];
        $_SESSION['SESS_LAST_NAME'] = $member['position'];
        session_write_close();
        header("location: main/index.php");
        exit();
    } else {
        // Login failed
        header("location: index.php");
        exit();
    }
} else {
    die("Query failed");
}
?>

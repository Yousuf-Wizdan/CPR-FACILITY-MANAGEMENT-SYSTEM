<?php
include('database.php');
session_start();

$staffno = $_POST['staffno'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE staff_no = '$staffno' AND pass = '$password' " ;

$result = mysqli_query($conn , $sql);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['staffno'] = $row['staff_no'];
    $_SESSION['username'] = $row['user_name'];
    $_SESSION['dept_code'] = $row['dept_code'];
    $_SESSION['role_id'] = $row['role_id'];
    header('Location: dashboard.php');
    exit();
        
}else{
    $error = "Invalid staff number or password.";
    header("Location: index.php?error=" . urlencode($error));
    exit;
}

mysqli_close($conn)
?>

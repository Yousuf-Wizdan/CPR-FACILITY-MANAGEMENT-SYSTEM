<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div>
        <form action="register.php" method="post">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" />
            <br>
            <label>Staff No</label>
            <input type="text" name="staffno" placeholder="Staff No" />
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder="password" />
            <br>
            <label>Department code</label>
            <input type="text" name="dept_code" placeholder="Dept Code" />

            <input type="submit" placeholder="submit"/>
        </form>
    </div>
    
</body>
</html>

<?php
    include('database.php');

    $staffno = $_POST['staffno'];
    $pass = $_POST['password'];
    $name = $_POST['name'];
    $dept_code = $_POST['dept_code'];

    $sql = "INSERT INTO users (staff_no, user_name , pass , dept_code) VALUES ('$staffno' , '$name'  , '$pass' , '$dept_code')";

    $result = mysqli_query($conn , $sql);

    mysqli_close($conn);
?>



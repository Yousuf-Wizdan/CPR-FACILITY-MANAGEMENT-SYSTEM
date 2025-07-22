<?php

    include('database.php');

    session_start();
    $staffno = $_SESSION['staffno'];
    $dept_code = $_SESSION['dept_code'];

    $staff_info = $_POST['other_staff_info'];
    $category = $_POST['category'];
    $contact = $_POST['contact'];
    $justification = $_POST['justification'];

    // File upload
    $upload_dir = 'uploads/stamps/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $stamp_file = $_FILES['stamp_file'];
    $file_name = basename($stamp_file['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg'];

    if (!in_array($file_ext, $allowed_ext)) {
        die("Only JPG files are allowed.");
    }

    $new_file_name = uniqid('stamp_', true) . '.' . $file_ext;
    $destination = $upload_dir . $new_file_name;

    if (!move_uploaded_file($stamp_file['tmp_name'], $destination)) {
        die("Failed to upload file.");
    }

    $sql =  "INSERT INTO cpr_reqiuis_master (Req_for , staffno , dept_code , category_id , cateory_desc , sub_category , contact_no , purpose_justif , file_path , add_by , add_dt , leg_id ) 
        VALUES ('$staff_info' , '$staffno' , '$dept_code' , 7 , 'Rubber_Stamp' , '$category' , '$contact' , '$justification' , '$destination' , '$staffno' , CURDATE() , 1)";

    mysqli_query($conn , $sql);

    mysqli_close($conn);

    header('Location: stamp.php?submitted=true');
    exit();


?>

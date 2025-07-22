<?php 
    include('database.php');

    session_start();
    $staffno = $_SESSION['staffno'];
    $dept_code = $_SESSION['dept_code'];
    //FURNITURE SUBMIT
  
    $staff_info = $_POST['other_staff_info'];
    $category = $_POST['category'];
    $contact_details = $_POST['contact'];
    $item_details = $_POST['item_detail'];
    $justification = $_POST['justification'];

    $sql = "INSERT INTO cpr_reqiuis_master  (Req_for , staffno , dept_code , category_id , cateory_desc , sub_category , contact_no , item_desc , purpose_justif , add_by , add_dt , leg_id)
    VALUES ('$staff_info' , '$staffno' ,'$dept_code', 1, 'Office_Furniture' , '$category', '$contact_details' , '$item_details' , '$justification' , '$staffno' , CURDATE() , 1) ";

    mysqli_query($conn , $sql);

    mysqli_close($conn);

    header('Location: furniture.php?submitted=true');
    exit();
?>
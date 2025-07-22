<?php  
    include('database.php');

    session_start();

    $staffno = $_SESSION['staffno'];
    $dept_code = $_SESSION['dept_code'];


    $category = $_POST['category'];
    $contact_details = $_POST['contact'];
    $item_details = $_POST['item_details'];
    $purpose = $_POST['purpose'];

    $sql = "INSERT INTO cpr_reqiuis_master (Req_for ,staffno ,dept_code ,category_id ,cateory_desc, sub_category, contact_no, item_desc , purpose_justif , add_by , add_dt , leg_id) 
            VALUES ('$staffno' , '$staffno' , '$dept_code' , 5 , 'Office Cutlery' , '$category' , '$contact_details' , '$item_details' , '$purpose' , '$staffno' , CURDATE() , 0 )";

    mysqli_query($conn , $sql);
   
    mysqli_close($conn);

    header('Location: cutlery.php?submitted=true');
    exit;
?>


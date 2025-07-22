<?php 
    include('database.php');

    session_start();
    $staffno = $_SESSION['staffno'];
    $dept_code = $_SESSION['dept_code'];

    $category = $_POST['category'];
    $contact_details = $_POST['contact'];
    $item_details = $_POST['item_details'];
    $event_details = $_POST['event_details'];

    $sql = "INSERT INTO cpr_reqiuis_master (Req_for , staffno , dept_code , category_id , cateory_desc , sub_category , item_desc , event_detail , contact_no , add_by , add_dt , leg_id
    ) VALUES ('$staffno' , '$staffno' , '$dept_code' , 2 , 'Mementoes_Gifts' , '$category' , '$item_details' , '$event_details' , '$contact_details' , '$staffno' , CURDATE() , 2)";

    mysqli_query($conn , $sql);

    mysqli_close($conn);

    header('Location: mementoes.php?submitted=true');
    exit();

?>
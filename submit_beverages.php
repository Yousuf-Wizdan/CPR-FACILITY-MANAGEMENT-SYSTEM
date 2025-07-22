<?php 

    include('database.php');

    session_start();
    $staffno = $_SESSION['staffno'];
    $dept_code = $_SESSION['dept_code'];

    $event_detail = $_POST['event_detail'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $pax = $_POST['pax'];
    $place_of_event = $_POST['place'];
    $beverage = $_POST['beverage'];
    $snacks = $_POST['snacks'];
    $contact = $_POST['contact'];
    $items = $beverage . " " . $snacks;

    $sql = "INSERT INTO cpr_reqiuis_master (Req_for ,staffno ,dept_code ,category_id ,cateory_desc , item_desc, event_detail, event_date, event_place, event_start_time , service_hour, contact_no, add_by , add_dt , leg_id) 
            VALUES ('$staffno','$staffno','$dept_code', 6 , 'Beverages_Snacks', '$items' , '$event_detail' , '$event_date' , '$place_of_event' , '$event_time' , '$pax' , '$contact' , '$staffno' , CURDATE() , 2) ";

    mysqli_query($conn , $sql);
   
    mysqli_close($conn);

    header('Location: beverages.php?submitted=true');
?>
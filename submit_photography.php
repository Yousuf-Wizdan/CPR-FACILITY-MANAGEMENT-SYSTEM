<?php
    include('database.php');

    session_start();
    $staffno = $_SESSION['staffno'];
    $dept_code = $_SESSION['dept_code'];

    $event_details = $_POST['event_details'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $service_hour = $_POST['service_hours'];
    $place_of_event = $_POST['event_place'];
    $contact = $_POST['contact_details'];

    $sql = "INSERT INTO cpr_reqiuis_master (Req_for , staffno , dept_code , category_id , cateory_desc , event_detail, event_date ,  event_place ,  event_start_time , service_hour , contact_no , add_by , add_dt , leg_id
    ) VALUES('$staffno','$staffno','$dept_code', 4 , 'Photography' , '$event_details' , '$event_date' , '$place_of_event' , '$start_time' , '$service_hour' , '$contact' , '$staffno' , CURDATE() , 2 )";

    mysqli_query($conn , $sql);

    mysqli_close($conn);

    header('Location: photography.php?submitted=true');
    exit();

?>
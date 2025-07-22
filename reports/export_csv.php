<?php
include('../database.php');

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="requisition_report.csv"');

$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Req ID', 'Date', 'Staff No', 'Department', 'Category', 'Item', 'Status']);

// Fetch data from DB
$query = "SELECT * FROM CPR_REQIUIS_MASTER ORDER BY Req_id DESC";
$result = mysqli_query($conn, $query);

// Map leg_id to status
function legStatus($id) {
    return [
        0 => 'Draft',
        1 => 'Sent to CPR',
        2 => 'Sent to Approver',
        3 => 'Cancelled',
        4 => 'Approved by Approver',
        5 => 'Rejected by Approver',
        6 => 'Approved by CPR',
        7 => 'Rejected by CPR',
        8 => 'Verified'
    ][$id] ?? 'Pending';
}

// Output each row
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['Req_id'],
        $row['add_dt'],
        $row['staffno'],
        $row['dept_code'],
        $row['cateory_desc'],
        $row['item_desc'],
        legStatus($row['leg_id'])
    ]);
}

fclose($output);
exit;
?>

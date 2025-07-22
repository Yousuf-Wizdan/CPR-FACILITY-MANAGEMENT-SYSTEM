<?php
require_once('../auth.php');
authorize([3,4]); // Only CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

$staffno = $_SESSION['staffno'];
$req_id = $_GET['req_id'] ?? null;

if (!$req_id) {
    echo "Invalid Request ID.";
    exit;
}

// Handle approval/rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $current_date = date('Y-m-d');

    if ($action === 'approve') {
        $update = "UPDATE CPR_REQIUIS_MASTER 
                   SET leg_id = 4, app_by = '$staffno', app_dt = '$current_date' 
                   WHERE Req_id = '$req_id'";
        $redirectStatus = 'approved';
    } elseif ($action === 'reject') {
        $update = "UPDATE CPR_REQIUIS_MASTER 
                   SET leg_id = 5, close_by = '$staffno', close_dt = '$current_date', close_remark = 'Rejected By Approver' 
                   WHERE Req_id = '$req_id'";
        $redirectStatus = 'rejected';
    }

    if (isset($update)) {
        mysqli_query($conn, $update);
        header("Location: /CPR_SYSTEM/pending_approval/?status=$redirectStatus");
        exit;
    }
}

// Fetch data
$query = "SELECT * FROM CPR_REQIUIS_MASTER WHERE Req_id = '$req_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "No data found.";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Videography Request</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-100 via-white to-blue-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white rounded-xl shadow-2xl p-10 space-y-6 border border-yellow-300">
        <h1 class="text-3xl font-extrabold text-center text-yellow-800 mb-2">📹 Videography Request</h1>
        <p class="text-sm text-center text-gray-500 mb-6">Requested by: <span class="font-semibold text-gray-800"><?= htmlspecialchars($data['staffno']) ?></span></p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Event Details</label>
                <div class="bg-gray-50 border border-gray-300 rounded p-3"><?= htmlspecialchars($data['event_detail']) ?></div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Event Date</label>
                <div class="bg-gray-50 border border-gray-300 rounded p-3"><?= htmlspecialchars($data['event_date']) ?></div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Start Time</label>
                <div class="bg-gray-50 border border-gray-300 rounded p-3"><?= htmlspecialchars($data['event_start_time']) ?></div>
            </div> 
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Place of Event</label>
                <div class="bg-gray-50 border border-gray-300 rounded p-3"><?= htmlspecialchars($data['event_place']) ?></div>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Contact Details</label>
                <div class="bg-gray-50 border border-gray-300 rounded p-3"><?= htmlspecialchars($data['contact_no']) ?></div>
            </div>
        </div>

        <!-- Approve/Reject -->
        <form method="POST" class="flex flex-col sm:flex-row justify-center items-center gap-6 pt-6">
            <button type="submit" name="action" value="approve"
                style="background-color: #16a34a; color: white; padding: 12px 24px; border-radius: 9999px; border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.2); font-weight: 600; cursor: pointer; transition: all 0.3s ease;"
                onmouseover="this.style.backgroundColor='#15803d';"
                onmouseout="this.style.backgroundColor='#16a34a';">
                ✅ Approve
            </button>

            <button type="submit" name="action" value="reject"
                style="background-color: #dc2626; color: white; padding: 12px 24px; border-radius: 9999px; border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.2); font-weight: 600; cursor: pointer; transition: all 0.3s ease;"
                onmouseover="this.style.backgroundColor='#b91c1c';"
                onmouseout="this.style.backgroundColor='#dc2626';">
                ❌ Reject
            </button>
        </form>
    </div>
</main>
</body>
</html>

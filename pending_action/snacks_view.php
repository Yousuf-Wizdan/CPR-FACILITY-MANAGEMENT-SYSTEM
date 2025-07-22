<?php
require_once('../auth.php');
authorize([4]); //CPR
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
    $now = date('Y-m-d H:i:s');

    if ($action === 'approve') {
        $remark = mysqli_real_escape_string($conn, $_POST['acknow_remark'] ?? '');
        $update = "UPDATE CPR_REQIUIS_MASTER SET 
                    leg_id = 6, 
                    acknow_by = '$staffno', 
                    acknow_dt = '$now',
                    acknow_remark = '$remark' 
                   WHERE Req_id = '$req_id'";
        $redirectStatus = 'approved';
    } elseif ($action === 'reject') {
        $remark = mysqli_real_escape_string($conn, $_POST['acknow_remark'] ?? 'Rejected by CPR');
        $update = "UPDATE CPR_REQIUIS_MASTER SET 
                    leg_id = 7, 
                    close_by = '$staffno', 
                    close_dt = '$now',
                    close_remark = '$remark' 
                   WHERE Req_id = '$req_id'";
        $redirectStatus = 'rejected';
    }

    if (isset($update)) {
        mysqli_query($conn, $update);
        header("Location: /CPR_SYSTEM/pending_action/?status=$redirectStatus");
        exit;
    }
}

$query = "SELECT * FROM CPR_REQIUIS_MASTER WHERE Req_id = '$req_id'";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "Request not found.";
    exit;
}
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snacks Request View</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-green-100 via-white to-blue-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white shadow-xl rounded-xl p-8 space-y-6 border border-blue-300">
        <h1 class="text-3xl font-bold text-center text-blue-900 mb-4">🍹 Snacks & Beverages Request</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium text-gray-700">Event Details:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['event_detail']) ?></div>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Event Date:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['event_date']) ?></div>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Event Time:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['event_start_time']) ?></div>
            </div>
            <div>
                <label class="block font-medium text-gray-700">No. of Pax:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['person_no']) ?></div>
            </div>
            <div class="col-span-2">
                <label class="block font-medium text-gray-700">Place of Event:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['event_place']) ?></div>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Beverage Items:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['sub_category']) ?></div>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Snacks:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['item_desc']) ?></div>
            </div>
            <div class="col-span-2">
                <label class="block font-medium text-gray-700">Contact Number:</label>
                <div class="border border-gray-300 p-3 rounded bg-gray-50"><?= htmlspecialchars($data['contact_no']) ?></div>
            </div>
        </div>

        <form method="POST" class="space-y-6 pt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Acknowledge / Reject Remark:</label>
                <textarea required name="acknow_remark" placeholder="Enter your remark..." class="w-full mt-1 p-3 border rounded bg-gray-50"></textarea>
            </div>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <button type="submit" name="action" value="approve"
                    style="background-color: #16a34a; color: white; padding: 12px 24px; border-radius: 9999px; border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.2); font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.backgroundColor='#15803d';"
                    onmouseout="this.style.backgroundColor='#16a34a';">
                    ✅ Approve
                </button>

                <button type="submit" name="action" value="reject"
                    style="background-color: #dc2626; color: white; padding: 12px 24px; border-radius: 9999px; border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.2); font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.backgroundColor='#b91c1c';"
                    onmouseout="this.style.backgroundColor='#dc2626';">
                    ❌ Reject
                </button>
            </div>
        </form>
    </div>
</main>
</body>
</html>

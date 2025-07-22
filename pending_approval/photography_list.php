<?php
require_once('../auth.php');
authorize([3,4]); // Only CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch pending Photography requests
$query = "SELECT Req_id, add_dt, event_detail, event_date, event_place FROM CPR_REQIUIS_MASTER 
          WHERE category_id = 4 AND leg_id = 2 
          ORDER BY add_dt DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photography Requests - Pending Approval</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-100 via-white to-blue-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="bg-white shadow-2xl rounded-2xl border border-blue-300 p-8">
        <h1 class="text-3xl font-bold text-blue-900 mb-8 text-center">📸 Photography Requests - Pending Approval</h1>

        <div class="overflow-x-auto rounded-lg shadow-inner">
            <table class="min-w-full divide-y divide-gray-300 bg-white text-sm text-gray-800">
                <thead class="bg-blue-500 text-white text-left text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Req. No.</th>
                        <th class="px-4 py-3">Request Date</th>
                        <th class="px-4 py-3">Event Details</th>
                        <th class="px-4 py-3">Event Date</th>
                        <th class="px-4 py-3">Event Place</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3"><?= htmlspecialchars($row['Req_id']) ?></td>
                                <td class="px-4 py-3"><?= date("d M Y", strtotime($row['add_dt'])) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($row['event_detail']) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($row['event_date']) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($row['event_place']) ?></td>
                                <td class="px-4 py-3 text-center">
                                    <a href="photography_view.php?req_id=<?= $row['Req_id'] ?>"
                                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-full shadow transition">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">No pending photography requests.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>

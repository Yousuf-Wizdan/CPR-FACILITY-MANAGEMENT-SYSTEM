<?php
require_once('../auth.php');
authorize([4]); //CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT Req_id, add_dt, event_detail, event_date, sub_category, item_desc 
          FROM CPR_REQIUIS_MASTER 
          WHERE category_id = 6 AND leg_id IN (1, 4)";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Snacks Requests</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="bg-white rounded-xl shadow-xl border border-blue-300 p-10">
        <h1 class="text-3xl font-extrabold text-center text-blue-900  mb-10">Pending Snacks Requests</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-blue-100 text-blue-900">
                    <tr>
                        <th class="px-4 py-2">Req. No.</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Event Detail</th>
                        <th class="px-4 py-2">Event Date</th>
                        <th class="px-4 py-2">Beverages</th>
                        <th class="px-4 py-2">Snacks</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2"><?= htmlspecialchars($row['Req_id']) ?></td>
                        <td class="px-4 py-2"><?= date("d M Y", strtotime($row['add_dt'])) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['event_detail']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['event_date']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['sub_category']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['item_desc']) ?></td>
                        <td class="px-4 py-2">
                            <a href="snacks_view.php?req_id=<?= $row['Req_id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-full text-sm font-medium shadow"> View</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p class="text-center text-gray-500 font-semibold">No pending snacks requests found.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>

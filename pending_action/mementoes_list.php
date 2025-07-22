<?php
require_once('../auth.php');
authorize([4]); //CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT Req_id, add_dt, cateory_desc, sub_category, item_desc FROM CPR_REQIUIS_MASTER 
        WHERE category_id = 2 AND leg_id IN (1,4)";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mementoes & Gifts List</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="bg-white shadow-xl rounded-xl border border-blue-300 p-8">
        <h1 class="text-2xl font-bold text-blue-900 mb-6">🎁 Mementoes & Gifts - Pending Approvals</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-200 text-blue-900 text-left text-sm font-semibold">
                    <tr>
                        <th class="px-4 py-2">Req No.</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Sub-Category</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-2"><?= htmlspecialchars($row['Req_id']) ?></td>
                <td class="px-4 py-2"><?= date('d M Y', strtotime($row['add_dt'])) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($row['sub_category']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($row['item_desc']) ?></td>
                <td class="px-4 py-2 text-center">
                    <a href="memento_view.php?req_id=<?= $row['Req_id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-full text-sm font-medium shadow">
                        View
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center py-6 text-gray-500">No pending Mementoes requests found.</td>
        </tr>
    <?php endif; ?>
</tbody>

            </table>
        </div>
    </div>
</main>
</body>
</html>

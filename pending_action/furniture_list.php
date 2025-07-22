<?php
require_once('../auth.php');
authorize([4]); //CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

// Fetch Office Furniture requests with leg_id = 1 or 4
$query = "SELECT Req_id, add_dt, cateory_desc, sub_category, item_desc, staffno
          FROM CPR_REQIUIS_MASTER
          WHERE category_id = 1 AND leg_id IN (1, 4)
          ORDER BY add_dt DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Office Furniture Requests</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-100 via-white to-gray-100 min-h-screen font-sans text-gray-800">
<?php include('../components/navbar.php'); ?>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="bg-white rounded-2xl shadow-xl border border-blue-200 p-10">
        <h1 class="text-3xl font-extrabold text-center text-blue-900 mb-8">🪑 Office Furniture Requests</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-100 text-blue-900">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold">Req. No.</th>
                        <th class="px-4 py-2 text-left font-semibold">Req. Date</th>
                        <th class="px-4 py-2 text-left font-semibold">Category</th>
                        <th class="px-4 py-2 text-left font-semibold">Sub-Category</th>
                        <th class="px-4 py-2 text-left font-semibold">Item Description</th>
                        <th class="px-4 py-2 text-left font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2"><?= htmlspecialchars($row['Req_id']) ?></td>
                        <td class="px-4 py-2"><?= date('d M Y', strtotime($row['add_dt'])) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['sub_category']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['item_desc']) ?></td>
                        <td class="px-4 py-2">
                            <a href="furniture_view.php?req_id=<?= $row['Req_id'] ?>" class="inline-block text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-full text-xs font-semibold shadow transition">View</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p class="text-center text-gray-500 mt-6">No Office Furniture requests pending for action.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>

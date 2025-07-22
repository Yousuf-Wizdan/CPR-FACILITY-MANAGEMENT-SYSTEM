<?php
require_once('../auth.php');
authorize([4]); // Only CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

// Fetch filters
$staffno     = $_GET['staffno']     ?? '';
$dept_code   = $_GET['dept_code']   ?? '';
$from_date   = $_GET['from_date']   ?? '';
$to_date     = $_GET['to_date']     ?? '';
$category_ids = $_GET['service']    ?? [];

// Build WHERE clause
$where = "1 = 1";

if (!empty($staffno)) {
    $where .= " AND staffno = '" . mysqli_real_escape_string($conn, $staffno) . "'";
}
if (!empty($dept_code)) {
    $where .= " AND dept_code = '" . mysqli_real_escape_string($conn, $dept_code) . "'";
}
if (!empty($from_date)) {
    $where .= " AND DATE(add_dt) >= '" . mysqli_real_escape_string($conn, $from_date) . "'";
}
if (!empty($to_date)) {
    $where .= " AND DATE(add_dt) <= '" . mysqli_real_escape_string($conn, $to_date) . "'";
}
if (!empty($category_ids) && is_array($category_ids)) {
    $category_ids = array_map('intval', $category_ids);
    $cat_str = implode(',', $category_ids);
    $where .= " AND category_id IN ($cat_str)";
}

// Query
$query = "SELECT * FROM CPR_REQIUIS_MASTER WHERE $where ORDER BY Req_id DESC";
$result = mysqli_query($conn, $query);

// Map view pages
$viewPages = [
    1 => 'furniture_view.php',
    2 => 'mementoes_view.php',
    3 => 'videography_view.php',
    4 => 'photography_view.php',
    5 => 'cutlery_view.php',
    6 => 'snacks_view.php',
    7 => 'stamp_view.php',
    8 => 'visitingcard_view.php'
];

// Status helper
function getLegStatus($leg_id) {
    switch ($leg_id) {
        case 0: return '📝 Draft';
        case 1: return '📤 Submitted to CPR';
        case 2: return '📤 Sent to Approver';
        case 3: return '❎ Cancelled';
        case 4: return '🧑‍⚖️ Approved by Approver';
        case 5: return '🚫 Rejected by Approver';
        case 6: return '✅ Approved by CPR';
        case 7: return '❌ Rejected by CPR';
        case 8: return '🟢 Verified';
        default: return '⏳ Pending';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Result</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-sky-50 via-white to-blue-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>
<main class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-4xl font-bold text-center text-red-600 underline mb-8">REPORTS</h1>

    <?php
    $template1 = [1, 2, 5, 7, 8];
    $template2 = [3, 4, 6];
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    ?>

    <?php if (!empty($rows)): ?>

        <!-- Template 1 -->
        <h2 class="text-xl font-semibold mb-4 text-gray-800">🔷 Template for “Office Furniture, Mementoes & Gifts, Office Cutlery, Rubber Stamp, Visiting Card”</h2>
        <div class="overflow-auto mb-10 border border-gray-300 rounded-lg">
            <table class="min-w-full table-auto bg-white text-sm">
                <thead class="bg-sky-200 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border">Req. No</th>
                    <th class="px-4 py-2 border">Req. Date</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Item / Work Details</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Remarks / Comments</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): if (in_array($row['category_id'], $template1)): ?>
                    <?php $viewLink = $viewPages[$row['category_id']] ?? '#'; ?>
                    <tr class="hover:bg-blue-50">
                        <td class="px-4 py-2 border text-blue-600 underline">
                            <a href="<?= $viewLink ?>?req_id=<?= $row['Req_id'] ?>"><?= $row['Req_id'] ?></a>
                        </td>
                        <td class="px-4 py-2 border"><?= date('Y-m-d', strtotime($row['add_dt'])) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['item_desc']) ?></td>
                        <td class="px-4 py-2 border"><?= getLegStatus($row['leg_id']) ?></td>
                        <td class="px-4 py-2 border"><?= $row['acknow_remark'] ?: $row['close_remark'] ?></td>
                    </tr>
                <?php endif; endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Template 2 -->
        <h2 class="text-xl font-semibold mb-4 text-gray-800">🔷 Template for “Videography, Photography, and Beverages & Snacks”</h2>
        <div class="overflow-auto border border-gray-300 rounded-lg">
            <table class="min-w-full table-auto bg-white text-sm">
                <thead class="bg-sky-200 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border">Req. No</th>
                    <th class="px-4 py-2 border">Req. Date</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Event Detail</th>
                    <th class="px-4 py-2 border">Event Date</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Remarks / Comments</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): if (in_array($row['category_id'], $template2)): ?>
                    <?php $viewLink = $viewPages[$row['category_id']] ?? '#'; ?>
                    <tr class="hover:bg-blue-50">
                        <td class="px-4 py-2 border text-blue-600 underline">
                            <a href="<?= $viewLink ?>?req_id=<?= $row['Req_id'] ?>"><?= $row['Req_id'] ?></a>
                        </td>
                        <td class="px-4 py-2 border"><?= date('Y-m-d', strtotime($row['add_dt'])) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['event_detail']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['event_date']) ?></td>
                        <td class="px-4 py-2 border"><?= getLegStatus($row['leg_id']) ?></td>
                        <td class="px-4 py-2 border"><?= $row['acknow_remark'] ?: $row['close_remark'] ?></td>
                    </tr>
                <?php endif; endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <p class="text-center text-gray-600 mt-8">No records found for your filters.</p>
    <?php endif; ?>
</main>
</body>
</html>

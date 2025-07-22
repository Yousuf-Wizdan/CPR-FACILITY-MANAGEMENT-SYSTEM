<?php
require_once('../auth.php');
authorize([3,4]); // Only CPR

if (!isset($_SESSION['staffno'])) {
    header("Location: ../login.php");
    exit;
}
include('../database.php');

$staffno = $_SESSION['staffno'];

// Get only pending requisitions (leg_id = 2 typically means pending)
$sql = "SELECT Req_id, cateory_desc, category_id, add_dt, sub_category 
        FROM CPR_REQIUIS_MASTER 
        WHERE staffno = '$staffno' 
        AND leg_id IN (2)
        ORDER BY add_dt DESC";

$result = mysqli_query($conn, $sql);

// Map category ID to specific view page
function getViewPage($category_id)
{
    $map = [
        1 => 'furniture_view.php',
        2 => 'mementoes_view.php',
        5 => 'cutlery_view.php',
        3 => 'videography_view.php',
        8 => 'visitingcard_view.php',
        6 => 'snacks_view.php',
        4 => 'photography_view.php',
        7 => 'rubberstamp_view.php',
    ];
    return $map[$category_id] ?? '#';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pending Approvals</title>
    <link href="../output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-sky-100 to-green-100 min-h-screen font-sans">

    <?php include('../components/navbar.php'); ?>
    <?php if (isset($_GET['status'])): ?>
            <div id="toast" class="fixed top-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-down">
                <?= $_GET['status'] === 'approved' ? '✅ Request approved successfully!' : ($_GET['status'] === 'rejected' ? '❌ Request rejected.' : '✔️ Action completed.') ?>
            </div>

            <script>
                setTimeout(() => {
                    const toast = document.getElementById('toast');
                    if (toast) toast.style.display = 'none';
                }, 3000);
            </script>

            <style>
                @keyframes fade-in-down {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-fade-in-down {
                    animation: fade-in-down 0.5s ease-out;
                }
            </style>
        <?php endif; ?>
    <main class="max-w-6xl mx-auto px-6 py-12">
        
        <h1 class="text-3xl font-bold text-blue-900 mb-6">🕒 Pending Approval Requests</h1>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-500 text-white text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">Req. ID</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Category</th>
                        <th class="px-6 py-3 text-left">Sub-Category</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4"><?= htmlspecialchars($row['Req_id']) ?></td>
                                <td class="px-6 py-4"><?= date("d M Y", strtotime($row['add_dt'])) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['sub_category']) ?></td>
                                <td class="px-6 py-4">
                                    <?php $page = getViewPage($row['category_id']); ?>
                                    <?php if ($page !== '#'): ?>
                                        <a href="<?= $page ?>?req_id=<?= $row['Req_id'] ?>" class="text-blue-600 hover:underline font-medium">View</a>
                                    <?php else: ?>
                                        <span class="text-gray-400 italic">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">No pending approvals found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>
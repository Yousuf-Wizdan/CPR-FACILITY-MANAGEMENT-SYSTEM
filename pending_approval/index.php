<?php
require_once('../auth.php');
authorize([3,4]); // Only CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

// Count Function
function getPendingCount($conn, $categoryIds) {
    $ids = implode(',', $categoryIds);
    $query = "SELECT COUNT(*) as total FROM CPR_REQIUIS_MASTER WHERE leg_id = 2 AND category_id IN ($ids)";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}

// Counts
$pending_mementoes = getPendingCount($conn, [2]);
$pending_videography = getPendingCount($conn, [3]);
$pending_photography = getPendingCount($conn, [4]);
$pending_snacks = getPendingCount($conn, [6]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Approvals</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-tr from-blue-100 via-white to-green-100 min-h-screen font-sans text-gray-800">
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
    <section class="bg-white border border-gray-200 rounded-2xl shadow-lg p-10">
        <h1 class="text-3xl font-bold text-center text-blue-900 mb-10 tracking-wide">🕒 Pending Approvals Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Mementoes & Gifts -->
            <a href="mementoes_list.php" class="group">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-blue-900">🎁 Mementoes</h2>
                        <span class="text-sm bg-blue-200 text-blue-800 font-medium px-3 py-0.5 rounded-full"><?= $pending_mementoes ?></span>
                    </div>
                    <p class="text-gray-600 text-sm">Pending approval requests</p>
                </div>
            </a>

            <!-- Videography -->
            <a href="videography_list.php" class="group">
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-green-900">🎥 Videography</h2>
                        <span class="text-sm bg-green-200 text-green-800 font-medium px-3 py-0.5 rounded-full"><?= $pending_videography ?></span>
                    </div>
                    <p class="text-gray-600 text-sm">Pending approval requests</p>
                </div>
            </a>

            <!-- Photography -->
            <a href="photography_list.php" class="group">
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-yellow-900">📸 Photography</h2>
                        <span class="text-sm bg-yellow-200 text-yellow-800 font-medium px-3 py-0.5 rounded-full"><?= $pending_photography ?></span>
                    </div>
                    <p class="text-gray-600 text-sm">Pending approval requests</p>
                </div>
            </a>

            <!-- Beverages & Snacks -->
            <a href="snacks_list.php" class="group">
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-red-900">🍹 Snacks</h2>
                        <span class="text-sm bg-red-200 text-red-800 font-medium px-3 py-0.5 rounded-full"><?= $pending_snacks ?></span>
                    </div>
                    <p class="text-gray-600 text-sm">Pending approval requests</p>
                </div>
            </a>
        </div>
    </section>
</main>

</body>
</html>

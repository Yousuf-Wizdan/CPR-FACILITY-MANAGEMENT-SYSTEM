<?
require_once('../auth.php');
authorize([3,4]); // Only CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

// Function to count pending entries (leg_id = 2)
function getPendingCount($conn, $categoryIds) {
    $ids = implode(',', $categoryIds);
    $query = "SELECT COUNT(*) as total FROM CPR_REQIUIS_MASTER WHERE leg_id = 2 AND category_id IN ($ids)";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}

// Get pending counts
$pending_mementoes = getPendingCount($conn, [1, 5, 7, 8]);
$pending_videography = getPendingCount($conn, [3]);
$pending_photography = getPendingCount($conn, [4]);
$pending_snacks = getPendingCount($conn, [6]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending for Approval</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-5xl mx-auto px-6 py-12">
    <div class="bg-white rounded-2xl shadow-xl border border-blue-300 p-10">
        <h1 class="text-3xl font-extrabold text-center text-red-600 underline mb-10">PENDING FOR APPROVAL</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Mementoes & Gifts -->
            <a href="mementoes_list.php" class="transition transform hover:scale-105">
                <div class="bg-blue-100 hover:bg-blue-200 text-blue-900 rounded-xl p-6 shadow-md border border-blue-300">
                    <h2 class="text-xl font-bold mb-2">🎁 Mementoes & Gifts</h2>
                    <p class="text-sm">Pending requests: <span class="font-semibold"><?= $pending_mementoes ?></span></p>
                </div>
            </a>

            <!-- Videography -->
            <a href="videography_list.php" class="transition transform hover:scale-105">
                <div class="bg-green-100 hover:bg-green-200 text-green-900 rounded-xl p-6 shadow-md border border-green-300">
                    <h2 class="text-xl font-bold mb-2">🎥 Videography</h2>
                    <p class="text-sm">Pending requests: <span class="font-semibold"><?= $pending_videography ?></span></p>
                </div>
            </a>

            <!-- Photography -->
            <a href="photography_list.php" class="transition transform hover:scale-105">
                <div class="bg-yellow-100 hover:bg-yellow-200 text-yellow-900 rounded-xl p-6 shadow-md border border-yellow-300">
                    <h2 class="text-xl font-bold mb-2">📸 Photography</h2>
                    <p class="text-sm">Pending requests: <span class="font-semibold"><?= $pending_photography ?></span></p>
                </div>
            </a>

            <!-- Beverages & Snacks -->
            <a href="snacks_list.php" class="transition transform hover:scale-105">
                <div class="bg-red-100 hover:bg-red-200 text-red-900 rounded-xl p-6 shadow-md border border-red-300">
                    <h2 class="text-xl font-bold mb-2">🍹 Beverages & Snacks</h2>
                    <p class="text-sm">Pending requests: <span class="font-semibold"><?= $pending_snacks ?></span></p>
                </div>
            </a>
        </div>
    </div>
</main>
</body>
</html>

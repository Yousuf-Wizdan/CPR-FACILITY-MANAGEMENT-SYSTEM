<?php
require_once('../auth.php');
authorize([4]); //CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

// Function to count action-pending entries (leg_id = 1 or 4)
function getActionCount($conn, $categoryIds) {
    $ids = implode(',', $categoryIds);
    $query = "SELECT COUNT(*) as total FROM CPR_REQIUIS_MASTER 
              WHERE leg_id IN (1, 4) AND category_id IN ($ids)";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}

// Get pending counts
$counts = [
    'Office Furniture'      => getActionCount($conn, [1]),
    'Mementoes & Gifts'     => getActionCount($conn, [2]),
    'Videography'           => getActionCount($conn, [3]),
    'Photography'           => getActionCount($conn, [4]),
    'Office Cutlery'        => getActionCount($conn, [5]),
    'Beverages & Snacks'    => getActionCount($conn, [6]),
    'Rubber Stamp'          => getActionCount($conn, [7]),
    'Visiting Card'         => getActionCount($conn, [8]),
];

// Link map for categories (link only if implemented)
$links = [
    'Office Furniture'      => 'furniture_list.php',
    'Mementoes & Gifts'     => 'mementoes_list.php',
    'Videography'           => 'videography_list.php',
    'Photography'           => 'photography_list.php',
    'Beverages & Snacks'    => 'snacks_list.php',
    'Rubber Stamp'          => 'stamp_list.php',
    'Visiting Card'         => 'visitingcard_list.php',
    'Office Cutlery'        => 'cutlery_list.php'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending for Action</title>
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
    <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-10">
        <h1 class="text-3xl font-extrabold text-center text-blue-900  mb-10">PENDING FOR ACTION</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $icons = [
                'Office Furniture'      => '🪑',
                'Mementoes & Gifts'     => '🎁',
                'Videography'           => '🎥',
                'Photography'           => '📸',
                'Office Cutlery'        => '🍴',
                'Beverages & Snacks'    => '🍹',
                'Rubber Stamp'          => '🖋️',
                'Visiting Card'         => '💳',
            ];

            $colors = ['blue', 'green', 'yellow', 'red', 'indigo', 'teal', 'rose', 'purple'];
            $i = 0;

            foreach ($counts as $label => $count):
                $color = $colors[$i % count($colors)];
                $emoji = $icons[$label];
                $link = $links[$label] ?? '#';
                $clickable = ($link !== '#');
            ?>
            <a href="<?= $link ?>" class="<?= $clickable ? 'hover:scale-[1.02] transition transform' : 'pointer-events-none opacity-80' ?>">
                <div class="bg-gradient-to-br from-<?= $color ?>-50 to-white border border-<?= $color ?>-200 p-6 rounded-xl shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-<?= $color ?>-900"><?= $emoji ?> <?= $label ?></h2>
                        <span class="text-sm bg-<?= $color ?>-200 text-<?= $color ?>-800 font-medium px-3 py-0.5 rounded-full"><?= $count ?></span>
                    </div>
                    <p class="text-gray-600 text-sm">Pending Action Items</p>
                </div>
            </a>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</main>
</body>
</html>

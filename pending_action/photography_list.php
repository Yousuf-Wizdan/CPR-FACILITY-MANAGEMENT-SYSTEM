<?php
require_once('../auth.php');
authorize([4]); //CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT Req_id, event_detail, event_date 
        FROM CPR_REQIUIS_MASTER 
        WHERE category_id = 4 AND leg_id IN (1, 4)
        ORDER BY add_dt DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Photography Action</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-5xl mx-auto px-6 py-12">
    <div class="bg-white rounded-2xl shadow-xl border border-blue-300 p-10">
        <h1 class="text-2xl font-bold text-blue-900 mb-6 text-center">📸 Photography - Pending Action</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="min-w-full text-sm border border-gray-200 rounded-md overflow-hidden">
                <thead class="bg-yellow-100 text-yellow-900">
                    <tr>
                        <th class="px-4 py-2 text-left">Req. ID</th>
                        <th class="px-4 py-2 text-left">Event Detail</th>
                        <th class="px-4 py-2 text-left">Event Date</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="px-4 py-2"><?= htmlspecialchars($row['Req_id']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['event_detail']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['event_date']) ?></td>
                            <td class="px-4 py-2">
                                <a href="photography_view.php?req_id=<?= $row['Req_id'] ?>" class="text-yellow-600 hover:underline font-medium">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-gray-500">No pending photography action requests.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>

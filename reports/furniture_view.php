<?php
require_once('../auth.php');
authorize([4]); // Only CPR
include('../database.php');


if (!isset($_SESSION['staffno'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['req_id'])) {
    echo "❌ Invalid Request ID.";
    exit;
}

$req_id = intval($_GET['req_id']);
$query = "SELECT * FROM CPR_REQIUIS_MASTER WHERE Req_id = $req_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "❌ Request not found.";
    exit;
}

$data = mysqli_fetch_assoc($result);

function getLegStatus($leg_id) {
    switch ($leg_id) {
        case 0: return '📝 Draft';
        case 1: return '📤 Sent to CPR';
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
    <title>Furniture Request Report View</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-sky-100 min-h-screen text-gray-800 font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-6xl mx-auto px-4 sm:px-8 py-10">
    <div class="bg-white rounded-3xl shadow-2xl border border-blue-200 p-10 transition hover:shadow-blue-300">
        <h1 class="text-4xl font-extrabold text-center text-blue-700 underline underline-offset-4 mb-10">
            🪑 Furniture Request Report
        </h1>

        <section class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-[15px]">
            <?php
            $fields = [
                '📌 Request ID' => $data['Req_id'],
                '📅 Request Date' => date('d M Y', strtotime($data['add_dt'])),
                '🙍 Requested For' => $data['Req_for'],
                '🧑 Staff No' => $data['staffno'],
                '🏢 Department Code' => $data['dept_code'],
                '📂 Category' => $data['cateory_desc'],
                '📁 Sub-Category' => $data['sub_category'],
                '🛠️ Item / Work Details' => $data['item_desc'],
            ];

            foreach ($fields as $label => $value) {
                echo "<div><span class='font-semibold text-gray-600'>{$label}:</span>
                        <div class='bg-blue-50 border border-blue-100 p-3 rounded mt-1 text-gray-800 whitespace-pre-wrap'>" . htmlspecialchars($value) . "</div></div>";
            }
            ?>

            <div class="sm:col-span-2">
                <span class="font-semibold text-gray-600">🎯 Purpose / Justification:</span>
                <div class="bg-blue-50 border border-blue-100 p-3 rounded mt-1 text-gray-800 whitespace-pre-wrap">
                    <?= nl2br(htmlspecialchars($data['purpose_justif'])) ?>
                </div>
            </div>

            <div>
                <span class="font-semibold text-gray-600">📍 Current Status:</span>
                <div class="bg-green-50 border border-green-200 p-3 rounded mt-1 text-blue-700 font-medium whitespace-pre-wrap">
                    <?= getLegStatus($data['leg_id']) ?>
                </div>
            </div>

            <div>
                <span class="font-semibold text-gray-600">✅ CPR Remark:</span>
                <div class="bg-blue-50 border border-blue-100 p-3 rounded mt-1 text-gray-800 whitespace-pre-wrap">
                    <?= $data['acknow_remark'] ? htmlspecialchars($data['acknow_remark']) : '—' ?>
                </div>
            </div>

            <div>
                <span class="font-semibold text-gray-600">❌ Rejection Remark:</span>
                <div class="bg-red-50 border border-red-100 p-3 rounded mt-1 text-gray-800 whitespace-pre-wrap">
                    <?= $data['close_remark'] ? htmlspecialchars($data['close_remark']) : '—' ?>
                </div>
            </div>
        </section>

        <div class="mt-10 text-center">
            <a href="javascript:history.back()" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full shadow-lg transition-all">
                ⬅️ Back to Report
            </a>
        </div>
    </div>
</main>

</body>
</html>

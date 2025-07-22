<?php
session_start();
if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}
include('database.php');
$staffno = $_SESSION['staffno'];

function getLegStatus($id) {
    switch ($id) {
        case '0': return ['Draft', 'bg-gray-100 text-gray-700'];
        case '1': return ['Submitted to C&PR', 'bg-blue-100 text-blue-700'];
        case '2': return ['Submitted to Approver', 'bg-blue-100 text-blue-700'];
        case '3': return ['Cancelled', 'bg-red-100 text-red-700'];
        case '4': return ['Approved by Approver', 'bg-green-100 text-green-700'];
        case '5': return ['Rejected by Approver', 'bg-yellow-100 text-yellow-700'];
        case '6': return ['Approved by CPR', 'bg-green-100 text-green-700'];
        case '7': return ['Rejected by CPR', 'bg-red-100 text-red-700'];
        default:  return ['Unknown', 'bg-black-200 text-gray-800'];
    }
}

$furniture_sql = "SELECT Req_id, add_dt, cateory_desc ,sub_category, item_desc, leg_id, close_remark 
                  FROM CPR_REQIUIS_MASTER 
                  WHERE staffno='$staffno' AND category_id IN (1, 7 , 2, 5, 8)";

$furniture_result = mysqli_query($conn, $furniture_sql);

$event_sql = "SELECT Req_id, add_dt, cateory_desc, event_detail, event_date, leg_id, close_remark 
              FROM CPR_REQIUIS_MASTER 
              WHERE staffno='$staffno' AND category_id IN (3 ,4 ,6)";
$event_result = mysqli_query($conn, $event_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Status of Requisitions</title>
  <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen font-sans text-gray-800">

<?php include('./components/navbar.php'); ?>

<main class="max-w-7xl mx-auto px-6 py-12">
  <h1 class="text-4xl font-bold text-blue-800 mb-10 text-center">📊 STATUS OF REQUISITION</h1>

  <!-- Furniture Section -->
  <section class="">
    <h2 class="text-2xl font-semibold text-blue-900 mb-6">🪑 Office Furniture, Mementoes, Cutlery, Rubber Stamp, Visiting Card</h2>
    <div class="rounded-2xl overflow-hidden shadow-xl bg-white border border-gray-200">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200">
          <thead class="bg-blue-100 text-blue-900 uppercase font-semibold text-xs">
            <tr>
              <th class="px-6 py-4 text-left">Req. No.</th>
              <th class="px-6 py-4 text-left">Req. Date</th>
              <th class="px-6 py-4 text-left">Category</th>
              <th class="px-6 py-4 text-left">Sub-Category</th>
              <th class="px-6 py-4 text-left">Item / Work Details</th>
              <th class="px-6 py-4 text-left">Status</th>
              <th class="px-6 py-4 text-left">Remarks</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            <?php while ($row = mysqli_fetch_assoc($furniture_result)): ?>
              <?php $status = getLegStatus($row['leg_id']); ?>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><?= htmlspecialchars($row['Req_id']) ?></td>
                <td class="px-6 py-4"><?= date("d M Y", strtotime($row['add_dt'])) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['sub_category']) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['item_desc']) ?></td>
                <td class="px-6 py-4"><span class="inline-block rounded-full px-3 py-1 text-xs font-medium <?= $status[1] ?>"><?= $status[0] ?></span></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['close_remark']) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Event Section -->
  <section class="pt-10">
    <h2 class="text-2xl font-semibold text-blue-900 mb-6">🎥 Videography, Photography and Beverage & Snacks</h2>
    <div class="rounded-2xl overflow-hidden shadow-xl bg-white border border-gray-200">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200">
          <thead class="bg-blue-100 text-blue-900 uppercase font-semibold text-xs">
            <tr>
              <th class="px-6 py-4 text-left">Req. No.</th>
              <th class="px-6 py-4 text-left">Req. Date</th>
              <th class="px-6 py-4 text-left">Category</th>
              <th class="px-6 py-4 text-left">Event Detail</th>
              <th class="px-6 py-4 text-left">Event Date</th>
              <th class="px-6 py-4 text-left">Status</th>
              <th class="px-6 py-4 text-left">Remarks</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            <?php while ($row = mysqli_fetch_assoc($event_result)): ?>
              <?php $status = getLegStatus($row['leg_id']); ?>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><?= htmlspecialchars($row['Req_id']) ?></td>
                <td class="px-6 py-4"><?= date("d M Y", strtotime($row['add_dt'])) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['cateory_desc']) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['event_detail']) ?></td>
                <td class="px-6 py-4"><?= date("d M Y", strtotime($row['event_date'])) ?></td>
                <td class="px-6 py-4"><span class="inline-block rounded-full px-3 py-1 text-xs font-medium <?= $status[1] ?>"><?= $status[0] ?></span></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['close_remark']) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}

$role_id = $_SESSION['role_id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BHEL Jhansi Dashboard</title>
  <link href="./output.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-blue-100 via-white to-green-100 min-h-screen font-sans">

  <?php include('./components/navbar.php') ?>

  <main class="max-w-7xl mx-auto py-12 px-6">

    <!-- Services Section -->
    <h2 class="text-3xl text-blue-900 font-bold mb-6 border-b-2 border-blue-200 pb-2">🛠️ Available Services</h2>
    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
      <?php
        $features = [
            "Office Furniture" => ["furniture.php", "🪑"],
            "Mementoes & Gifts" => ["mementoes.php", "🎁"],
            "Videography" => ["videography.php", "🎬"],
            "Photography" => ["photography.php", "📷"],
            "Office Cutlery" => ["cutlery.php", "🍽️"],
            "Beverages & Snacks (For Meetings)" => ["beverages.php", "☕"],
            "Rubber Stamp" => ["stamp.php", "📬"],
            "Visiting Card" => ["visitingcard.php", "💼"]
        ];
        foreach ($features as $title => [$link, $icon]):
      ?>
      <a href="<?= htmlspecialchars($link) ?>"
         class="glass rounded-xl p-6 hover:shadow-xl transition transform hover:-translate-y-1 border border-blue-100 flex items-start gap-4">
        <div class="text-4xl"><?= $icon ?></div>
        <div>
          <h3 class="text-xl font-semibold text-blue-800"><?= $title ?></h3>
          <p class="text-sm text-gray-600 mt-1">Click to request or view details.</p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- Requisition Tracking Section -->
    <div class="max-w-7xl mx-auto py-12">
      <h2 class="text-3xl font-bold text-blue-900 mb-8 border-b-2 border-blue-200 pb-2">📋 Requisition Tracking</h2>

      <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

        <!-- Status of Requisition: visible to all -->
        <a href="status.php"
           class="glass border border-blue-100 rounded-xl p-6 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 hover:border-blue-400">
          <div class="flex items-center space-x-4">
            <div class="text-blue-600 text-3xl">📄</div>
            <div>
              <h3 class="text-xl font-semibold text-blue-900">Status of Requisition</h3>
              <p class="text-gray-600 text-sm mt-1">Track the current status of your submitted requests.</p>
            </div>
          </div>
        </a>

        <?php if ($role_id >= 3): ?>
        <!-- Pending for Approval: visible to role_id 3 and 4 -->
        <a href="/CPR_SYSTEM/pending_approval/"
           class="glass border border-yellow-100 rounded-xl p-6 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 hover:border-yellow-400">
          <div class="flex items-center space-x-4">
            <div class="text-yellow-500 text-3xl">🕒</div>
            <div>
              <h3 class="text-xl font-semibold text-yellow-700">Pending for Approval</h3>
              <p class="text-gray-600 text-sm mt-1">View requests waiting for approver action.</p>
            </div>
          </div>
        </a>
        <?php endif; ?>

        <?php if ($role_id == 4): ?>
        <!-- Pending for Action: only for role_id 4 -->
        <a href="/CPR_SYSTEM/pending_action/"
           class="glass border border-red-100 rounded-xl p-6 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 hover:border-red-400">
          <div class="flex items-center space-x-4">
            <div class="text-red-600 text-3xl">⚠️</div>
            <div>
              <h3 class="text-xl font-semibold text-red-700">Pending for Action</h3>
              <p class="text-gray-600 text-sm mt-1">Final processing of approved requests.</p>
            </div>
          </div>
        </a>

        <!-- Reports: only for role_id 4 -->
        <a href="/CPR_SYSTEM/reports/"
           class="glass border border-purple-100 rounded-xl p-6 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 hover:border-purple-400">
          <div class="flex items-center space-x-4">
            <div class="text-purple-600 text-3xl">📊</div>
            <div>
              <h3 class="text-xl font-semibold text-purple-800">Reports</h3>
              <p class="text-gray-600 text-sm mt-1">Analyze requests with summarized reports and insights.</p>
            </div>
          </div>
        </a>
        <?php endif; ?>

      </div>
    </div>

  </main>
</body>
</html>

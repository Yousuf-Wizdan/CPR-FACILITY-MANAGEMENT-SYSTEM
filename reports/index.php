<?php
require_once('../auth.php');
authorize([4]); // Only CPR

include('../database.php');





if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Filters</title>
  <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-sky-50 via-white to-blue-100 min-h-screen text-gray-800 font-sans">
<?php include('../components/navbar.php'); ?>

<main class="max-w-5xl mx-auto p-10">
  <div class="bg-white border border-blue-200 rounded-2xl shadow-xl p-10">
    <h1 class="text-3xl font-extrabold text-center text-blue-700 underline decoration-blue-400 mb-8">REPORTS</h1>

    <form action="report_result.php" method="GET" class="space-y-8">
      <!-- Search Filters -->
      <div>
        <p class="text-lg font-semibold text-blue-600 mb-2">🔎 Search Filters</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Staff No -->
          <div>
            <label class="block text-sm font-medium mb-1">Staff No.</label>
            <input type="text" name="staffno" class="w-full border border-blue-300 rounded px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>

          <!-- Dept. Code -->
          <div>
            <label class="block text-sm font-medium mb-1">Dept. Code</label>
            <input type="text" name="dept_code" class="w-full border border-blue-300 rounded px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>

          <!-- From Date -->
          <div>
            <label class="block text-sm font-medium mb-1">From Date</label>
            <input type="date" name="from_date" class="w-full border border-blue-300 rounded px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>

          <!-- To Date -->
          <div>
            <label class="block text-sm font-medium mb-1">To Date</label>
            <input type="date" name="to_date" class="w-full border border-blue-300 rounded px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>

          <!-- Service Selection -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Service</label>
            <select name="service[]" multiple class="w-full border border-blue-300 rounded px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400 h-40">
              <!-- <option value="all">....</option> -->
              <option value="1">Office Furniture</option>
              <option value="2">Mementoes & Gifts</option>
              <option value="3">Videography</option>
              <option value="4">Photography</option>
              <option value="5">Office Cutlery</option>
              <option value="6">Beverages & Snacks (Meetings)</option>
              <option value="7">Rubber Stamp</option>
              <option value="8">Visiting Card</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">Hold Ctrl (or Cmd on Mac) to select multiple.</p>
          </div>
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow-md transition-all">
          📊 Show Report
        </button>
      </div>
      </form>
      <!-- <form method="GET" action="export_csv.php">
        <div >
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-full shadow-md transition-all">
            ⬇️ Download Excel
          </button>
        </div>
      </form> -->
    
  </div>
</main>
</body>
</html>

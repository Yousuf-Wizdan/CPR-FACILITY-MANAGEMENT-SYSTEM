<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Cutlery Request</title>
  <link href="./output.css" rel="stylesheet"> 
</head>
<body class="bg-gradient-to-br from-blue-100 to-green-100 min-h-screen font-sans">

  <!-- Navbar -->
  <?php include('./components/navbar.php') ?>

  

  <!-- Form Section -->
  <div class="max-w-3xl mx-auto py-12 px-6">
    <div class="bg-white shadow-xl rounded-xl p-8">

    <?php if (isset($_GET['submitted']) && $_GET['submitted'] === 'true'): ?>
    <div class="mb-6 border border-green-400 text-green-800 px-4 py-3 rounded-md text-center shadow-md">
      ✅ Your request has been submitted successfully!
    </div>
    <?php endif; ?>

    <h2 class="text-3xl font-bold text-center text-blue-900 mb-6 border-b pb-2">OFFICE CUTLERY</h2>

    <form action="submit_cutlery.php" method="POST" class="space-y-6">
      <!-- Category / Item -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Category / Item</label>
        <select name="category" required class="w-full border border-gray-300 rounded px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="" disabled selected>Select an item</option>
          <option value="Water Jug">Water Jug</option>
          <option value="Cup with Saucer">Cup with Saucer (AGM & Above)</option>
          <option value="Serving Tray">Serving Tray (AGM & Above)</option>
          <option value="Other">Other Items</option>
        </select>
      </div>

      <!-- Contact Details -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Contact Details of Requisitioner</label>
        <input type="text" name="contact" required placeholder="Enter mobile/extension/email"
               class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Item Details -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Item Details</label>
        <textarea name="item_details" rows="3" required placeholder="Enter detailed description"
                  class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Purpose -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Purpose</label>
        <textarea name="purpose" rows="3" required placeholder="Mention the purpose"
                  class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit"
                class="bg-blue-600  hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md transition duration-300">
          Submit
        </button>
      </div>
    </form>
    </div>
  </div>
</body>
</html>

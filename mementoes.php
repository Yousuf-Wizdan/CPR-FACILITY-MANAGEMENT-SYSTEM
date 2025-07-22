<?php
session_start();
if (!isset($_SESSION['staffno'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mementoes & Gifts</title>
  <link href="./output.css" rel="stylesheet"> <!-- Tailwind CSS -->
</head>
<body class="bg-gradient-to-br from-blue-100 to-green-100 min-h-screen font-sans">

  <!-- Navbar -->
  <?php include('./components/navbar.php'); ?>

  <!-- Main Form -->
  <div class="max-w-3xl mx-auto py-12 px-6">
    <div class="bg-white shadow-xl rounded-xl p-8">

    <?php if (isset($_GET['submitted']) && $_GET['submitted'] === 'true'): ?>
    <div class="mb-6 border border-green-400 text-green-800 px-4 py-3 rounded-md text-center shadow-md">
      ✅ Your request has been submitted successfully!
    </div>
    <?php endif; ?>
    
    <h2 class="text-3xl font-bold text-center text-blue-900 mb-8">MEMENTOES & GIFTS</h2>

    <form action="submit_mementoes.php" method="POST" class="space-y-6">

      <!-- Category/Item -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Category / Item</label>
        <select name="category" required class="w-full border border-blue-300 rounded px-4 py-2 bg-white">
          <option value="">Select an item</option>
          <option value="Brass Statue (Small)">Brass Statue (Small size, ₹700 - ₹1100)</option>
          <option value="Brass Statue (Medium)">Brass Statue (Medium size, ₹1200 - ₹2000)</option>
          <option value="Brass Statue (Big)">Brass Statue (Big size, ₹2100 - ₹3500)</option>
          <option value="Brass Statue (Large)">Brass Statue (Large size, ₹4000 - ₹8000)</option>
          <option value="Shawl">Shawl</option>
          <option value="Other">Other Item</option>
        </select>
      </div>

      <!-- Contact Details -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Contact Details</label>
        <input type="text" name="contact" required placeholder="Phone / Email" class="w-full border border-blue-300 rounded px-4 py-2">
      </div>

      <!-- Item Details -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Item Details</label>
        <textarea name="item_details" rows="3" required placeholder="Enter item details" class="w-full border border-blue-300 rounded px-4 py-2 resize-none"></textarea>
      </div>

      <!-- Event Details -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Event Details</label>
        <textarea name="event_details" rows="3" required placeholder="Enter event information" class="w-full border border-blue-300 rounded px-4 py-2 resize-none"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-md shadow-md transition duration-300">
          Submit
        </button>
      </div>
    </form>
    </div>
  </div>

</body>
</html>

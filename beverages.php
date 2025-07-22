<?php
include('session.php'); // Assumes $staffno and $user_name available
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Beverage & Snacks Request</title>
  <link href="./output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-blue-100 to-green-100 min-h-screen font-sans">
  <?php include('./components/navbar.php'); ?>

  <div class="max-w-3xl mx-auto py-12 px-6">
    <div class="bg-white shadow-xl rounded-xl p-8">
      <?php if (isset($_GET['submitted']) && $_GET['submitted'] === 'true'): ?>
        <div class="mb-6 border border-green-400 text-green-800 px-4 py-3 rounded-md text-center shadow-md">
          ✅ Your request has been submitted successfully!
        </div>
      <?php endif; ?>
      <h1 class="text-3xl font-bold text-blue-900 mb-6 text-center">🍹 Beverage & Snacks Request</h1>

      <form action="submit_beverages.php" method="POST" class="space-y-6">

        <!-- Event Details -->
        <div>
          <label class="block text-gray-700 font-medium mb-1">Event Details</label>
          <textarea name="event_detail" rows="2" required placeholder="Enter event description"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Date, Time, Pax -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-gray-700 font-medium mb-1">Event Date</label>
            <input type="date" name="event_date" required
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-gray-700 font-medium mb-1">Event Time</label>
            <input type="time" name="event_time" required
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-gray-700 font-medium mb-1">No. of Pax</label>
            <input type="number" name="pax" required min="1"
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <!-- Place -->
        <div>
          <label class="block text-gray-700 font-medium mb-1">Place of Event</label>
          <input type="text" name="place" required placeholder="Enter venue"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Beverage and Snacks -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-medium mb-1">Beverage</label>
            <select type="text" name="beverage" placeholder="Tea, Coffee, etc."
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="Tea">Tea</option>
              <option value="Coffee">Coffee</option>
              <option value="Cold Drink">Cold Drink</option>
            </select>
          </div>
          <div>
            <label class="block text-gray-700 font-medium mb-1">Snacks</label>
            <input type="text" name="snacks" placeholder="Biscuits, Samosa, etc."
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <!-- Contact -->
        <div>
          <label class="block text-gray-700 font-medium mb-1">Contact Details of Requisitioner</label>
          <input type="text" name="contact" required placeholder="Phone / Email"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit -->
        <div class="text-center mt-6">
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 shadow-lg transition-all duration-200 rounded-md">
            Submit
          </button>
        </div>

      </form>
    </div>
  </div>
</body>

</html>
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
  <title>Videography Requisition</title>
  <link href="./output.css" rel="stylesheet"> <!-- Ensure Tailwind is included -->
</head>
<body class="bg-gradient-to-br from-blue-100 to-green-100 min-h-screen font-sans">

  <!-- Navbar -->
  <?php include('./components/navbar.php'); ?>

  <div class="max-w-3xl mx-auto py-12 px-6">
    <div class="bg-white shadow-xl rounded-xl p-8">

    <?php if (isset($_GET['submitted']) && $_GET['submitted'] === 'true'): ?>
    <div class="mb-6 border border-green-400 text-green-800 px-4 py-3 rounded-md text-center shadow-md">
      ✅ Your request has been submitted successfully!
    </div>
    <?php endif; ?>
    
    <h1 class="text-center text-3xl font-bold text-blue-900  mb-8">VIDEOGRAPHY</h1>

    <form action="submit_videography.php" method="POST" class="space-y-6">

      <!-- Event Details -->
      <div>
        <label class="block font-semibold text-gray-700 mb-1">Event Details:</label>
        <input type="text" name="event_details" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Enter event description...">
      </div>

      <!-- Event Date, Time, Service Hours -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Event Date:</label>
          <input type="date" name="event_date" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Start Time:</label>
          <input type="time" name="start_time" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Service Hours:</label>
          <input type="number" name="service_hours" min="1" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="e.g. 2">
        </div>
      </div>

      <!-- Place of Event -->
      <div>
        <label class="block font-semibold text-gray-700 mb-1">Place of Event:</label>
        <input type="text" name="event_place" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Enter event location...">
      </div>

      <!-- Contact Details -->
      <div class="">
        <label class="block font-semibold text-gray-700 mb-1">Contact Details of Requisitioner:</label>
        <input type="text" name="contact_details" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Name, Phone Number, etc.">
      </div>

      <!-- Submit Button -->
      <div class="text-center mt-10">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-md shadow-md transition duration-300">
          Submit
        </button>
      </div>
    </form>
    </div>
  </div>

</body>
</html>

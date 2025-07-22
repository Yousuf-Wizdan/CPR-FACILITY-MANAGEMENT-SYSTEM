<header class="bg-white/90 backdrop-blur shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <!-- Left Side: Logo + CPR Login -->
      <div class="flex items-center space-x-6">
        <!-- Logo & Title -->
        <a href="/CPR_SYSTEM/dashboard.php" class="flex items-center space-x-3">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/BHEL_logo.svg/1200px-BHEL_logo.svg.png" alt="BHEL Logo" width="50">
          <span class="text-xl font-bold text-blue-900 tracking-wide">CPR SYSTEM</span>
        </a>

        <!-- CPR Login Button -->
        <!-- CPR Login Button -->
      <!-- <a href="cpr_login.php"
        class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-md text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md">
        CPR Login
      </a> -->
      </div>

      <!-- Right Side: User Info & Logout -->
      <!-- Right Side: User Info & Actions -->
<div class="flex items-center space-x-6">

  <!-- Requisition Tracking Dropdown -->

  <!-- User Info -->
  <div class="text-sm text-gray-700">
    Logged in as <span class="font-semibold text-blue-800"><?= htmlspecialchars($_SESSION['username']) ?></span>
  </div>

  <!-- Logout -->
  <a href="/CPR_SYSTEM/logout.php"
     class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow hover:shadow-md transition-all duration-200">
    Logout
  </a>
</div>

    </div>
  </div>


</header>

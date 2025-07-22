<?php
    // include('database.php');

    session_start();
    if(isset($_SESSION['staffno'])){
        header('Location: dashboard.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BHEL Jhansi Login</title>
    <link href="./output.css" rel="stylesheet"> 
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen flex items-center justify-center font-sans">

    <div class="backdrop-blur-sm bg-white/80 shadow-2xl border border-blue-200 rounded-2xl p-8 max-w-md w-full transition-all duration-300">
        <div class="text-center mb-6">
            <div class="flex justify-center mb-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/BHEL_logo.svg/1200px-BHEL_logo.svg.png" alt="bhel logo" width="100" />
            </div>
            <!-- <h2 class="text-xl font-semibold text-blue-800">BHEL Jhansi</h2> -->
            <h3 class="text-2xl font-bold text-blue-800">CPR SYSTEM</h3>
            <h3 class="text-xl font-bold text-blue-800">Login</h3>
            <p class="text-sm text-gray-600 mt-1">Please enter your Staff No and Password</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <form action="process_login.php" method="POST" class="space-y-5">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Staff No</label>
                <input type="text" name="staffno" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200 hover:scale-105">
                    Login
                </button>
            </div>
        </form>

        <!-- <p class="mt-6 text-center text-sm text-gray-500">
            Having trouble logging in? <a href="#" class="text-blue-600 hover:underline">Contact IT Support</a>
        </p> -->
    </div>

</body>
</html>

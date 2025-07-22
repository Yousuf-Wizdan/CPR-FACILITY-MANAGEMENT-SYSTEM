<?php
include('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Office Furniture Request</title>
    <link href="./output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-blue-100 to-green-100 min-h-screen font-sans">

    <!-- Header -->
    <?php include('./components/navbar.php') ?>

    <div class="max-w-3xl mx-auto py-12 px-6">
        <div class="bg-white shadow-xl rounded-xl p-8">

            <?php if (isset($_GET['submitted']) && $_GET['submitted'] === 'true'): ?>
                <div class="mb-6 border border-green-400 text-green-800 px-4 py-3 rounded-md text-center shadow-md">
                    ✅ Your request has been submitted successfully!
                </div>
            <?php endif; ?>

            <h1 class="text-3xl font-bold text-blue-900 mb-6 text-center">Office Furniture Request</h1>
            <form action="submit_furniture.php" method="POST" class="space-y-6">

                <!-- User Selection -->
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">User</label>
                        <select onchange="toggleOther()" id="userType" name="user_type"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="SELF" selected>SELF</option>
                            <option value="OTHERS">OTHERS</option>
                        </select>
                    </div>

                    <div id="otherStaffContainer">
                        <label class="block text-gray-700 font-medium mb-1">User Name & Staff No. (if OTHERS)</label>
                        <input type="text" id="otherStaffInput" name="other_staff_info"
                            value="<?= htmlspecialchars($staffno . ' - ' . $user_name) ?>"
                            placeholder="Name / Staff No"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            readonly>
                    </div>
                </div>


                <!-- Category & Contact -->
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Category</label>
                        <select name="category" required class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="New Furniture">New Furniture</option>
                            <option value="Repairing of Furniture">Repairing of Furniture</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Contact Details</label>
                        <input type="text" name="contact" required placeholder="Phone / Email" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Item Details -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Item/Work Detail</label>
                    <textarea name="item_detail" required rows="3" placeholder="Describe the required item or work"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Justification -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Justification</label>
                    <textarea name="justification" required rows="3" placeholder="Provide justification for the request"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center align-middle">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 shadow-lg transition-all duration-200 rounded-md">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleOther() {
            const userType = document.getElementById('userType').value;
            const otherStaffContainer = document.getElementById('otherStaffContainer');
            const input = document.getElementById('otherStaffInput');

            if (userType === 'SELF') {
                otherStaffContainer.classList.remove('hidden');
                input.value = "<?= htmlspecialchars($staffno) ?>";
                input.readOnly = true;
            } else {
                otherStaffContainer.classList.remove('hidden');
                input.value = "";
                input.readOnly = false;
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', toggleOther);
    </script>

</body>

</html>
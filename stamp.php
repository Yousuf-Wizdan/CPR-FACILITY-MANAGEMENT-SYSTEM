<?php
include('session.php'); // ensures $staffno and $user_name are available
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rubber Stamp Request</title>
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

            <h1 class="text-3xl font-bold text-center text-blue-900 mb-6">🖋️ Rubber Stamp Request</h1>

            <form action="submit_stamp.php" method="POST" enctype="multipart/form-data" class="space-y-6">

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
                            value="<?= htmlspecialchars($staffno) ?>"
                            placeholder="Name / Staff No"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            readonly>
                    </div>
                </div>

                <!-- Category and Contact -->
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Category</label>
                        <select name="category" required class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="New">New</option>
                            <option value="Change">Change</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Contact Details</label>
                        <input type="text" name="contact" required placeholder="Phone / Email" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Justification -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Justification</label>
                    <textarea name="justification" required rows="3" placeholder="Why is this stamp needed?"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Upload File -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Upload the Template (JPG only)</label>
                    <input type="file" name="stamp_file" accept=".jpg,.jpeg" required class="block w-full text-sm text-gray-600 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Submit -->
                <div class="text-center mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 shadow-lg transition-all duration-200 rounded-full">
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

        // Run on page load
        document.addEventListener('DOMContentLoaded', toggleOther);
    </script>
</body>

</html>
<?php
session_start();

if (!isset($_SESSION['staffno'])) {
    header("Location: /CPR_SYSTEM/login.php");
    exit;
}

// Function to check required role(s)
function authorize($allowed_roles = []) {
    $user_role = $_SESSION['role_id'] ?? 0;
    if (!in_array($user_role, $allowed_roles)) {
        http_response_code(403); // Forbidden
        echo "<h1 style='color:red; font-family:sans-serif;'>403 Forbidden</h1><p>You are not authorized to access this page.</p>";
        exit;
    }
}

<?php
session_start();
include 'connection.php'; // Ensure this is included correctly

$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input data
    $accountId = filter_input(INPUT_POST, 'accountId', FILTER_SANITIZE_NUMBER_INT);
    $password = $_POST['password'];

    // Validate Account ID
    if (!preg_match('/^\d{6}$/', $accountId)) {
        $error = 'Account ID must be exactly 6 digits!';
    } else {
        // Prepare and execute SQL query using prepared statements
        $stmt = $conn->prepare("SELECT password FROM bcp_sms3_useracc WHERE accountId = ?");
        $stmt->execute([$accountId]);
        $user = $stmt->fetch();

        // Check if user exists
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, set session and redirect
            $_SESSION['accountId'] = $accountId; // Store account ID in session
            header("Location: eventdash.php"); // Redirect to dashboard
            exit();
        } else {
            $error = 'Invalid account ID or password!';
        }
    }
}

// Close the connection
$conn = null; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="assets/img/bcp logo.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clinic Management System.">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Login - CMS</title>
</head>
<body>
    <div class="logo">
        <img src="assets/img/bcp logo.png" alt="Logo">
        <p>Clinic Management System</p> 
    </div>
    
    <div class="login-container">
        <h2>Log Into Your Account</h2>
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red;">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form id="loginForm" action="index.php" method="post">
            <label for="accountId">Account ID</label>
            <input type="text" id="accountId" name="accountId" required aria-label="Account ID">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required aria-label="Password">

            <div class="forgot-password">
                <a href="#" aria-label="Forgot password?">Forgot your password?</a>
            </div>

            <button type="submit">LOGIN</button>
        </form>
        <script src="js/script.js"></script>
    </div>
</body>
</html>
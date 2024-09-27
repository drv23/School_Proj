<?php
require_once 'vendor/autoload.php';

session_start();

$clientID = '715419043850-anim5lmb1hphi48jmjne5jhcpvept2vq.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUrl = 'http://localhost/glogin/landing.php';

// Create Google Client Request
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);

// Add Scopes for Profile and Email
$client->addScope('profile');
$client->addScope('email');

// Check if the user is logging in via Google
if (isset($_GET['code'])) {
    try {
        // Fetch the OAuth 2.0 token using the authorization code
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // Get User Profile Info from Google
        $gauth = new Google_Service_Oauth2($client);
        $google_info = $gauth->userinfo->get();

        // Store user info in session
        $_SESSION['email'] = $google_info->email;
        $_SESSION['name'] = $google_info->name;

        // Redirect to landing page
        header('Location: landing.php');
        exit();
    } catch (Exception $e) {
        // Handle exception if any
        echo 'Error fetching user info: ' . $e->getMessage();
    }
}

// Check if user is already logged in
if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
} else {
    // Redirect back to login page if not logged in
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <div class="landing-container">
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
        <p>You are logged in with the email: <?php echo htmlspecialchars($email); ?></p>
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
</body>
</html>

<?php
    require_once 'vendor/autoload.php';

    $clientID = '715419043850-anim5lmb1hphi48jmjne5jhcpvept2vq.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUrl = 'http://localhost/glogin/landing.php';

    // Creating Client Request to Google
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUrl);

    // Adding scopes for profile and email
    $client->addScope('profile');
    $client->addScope('email');

    // Generate Google login URL
    $googleLoginUrl = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>

    <div class="login-container">
        <h2 class="loginTitle">Login</h2>
        
        <!-- Normal email/password login form -->
        <form method="POST" action="landing.php">
            <input type="email" id="email" class="form-input" placeholder="Email" required><br>
            <input type="password" id="password" class="form-input" placeholder="Password" required><br>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <hr>

        <!-- Facebook login button (not implemented, placeholder) -->
        <button class="social-btn facebook-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" class="social-icon" alt="Facebook Icon"> Login with Facebook
        </button>

        <!-- Google login button -->
        <a href="<?php echo $googleLoginUrl; ?>">
            <button class="social-btn google-btn">
                <img src="https://cdn4.iconfinder.com/data/icons/logos-brands-7/512/google_logo-google_icongoogle-512.png" class="social-icon" alt="Google Icon"> Login with Google
            </button>
        </a>
    </div>

</body>
</html>

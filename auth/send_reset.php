<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(32));
    
    $expire = date("Y-m-d H:i:s", strtotime("+15 minutes"));

    $check_query = "SELECT * FROM users WHERE email = $1";
    $check_result = pg_query_params($conn, $check_query, [$email]);

    if (pg_num_rows($check_result) > 0) {
        $update_query = "UPDATE users SET reset_token = $1, token_expire = $2 WHERE email = $3";
        $update_result = pg_query_params($conn, $update_query, [$token, $expire, $email]);

        if ($update_result) {
            $link = "http://localhost:8080/Tutorials/auth/reset_password.php?token=$token";
            
            echo "<div class='container mt-5 alert alert-info'>";
            echo "<h4>Mail Server Error (Localhost)</h4>";
            echo "Change password using this link for testing. <br><br>";
            echo "<a href='$link' class='btn btn-primary'>Reset Password Link</a>";
            echo "</div>";
        } else {
            echo "Update Error: " . pg_last_error($conn);
        }
    } else {
        echo "<script>alert('Email not found in database'); window.location='forgot_password.php';</script>";
    }
}
?>
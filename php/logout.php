<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    // $_SESSION['is_logged_in'] = false;

    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Finally, destroy the session.
    session_destroy();

    header("Location: ../login.php");
    exit;
}else {
    header ("Location: ../index.php");
}
 



 
?>
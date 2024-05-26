<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "includes/config.php";
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if(isset($logout_id)){
        $status = "Offline now";
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$logout_id}'");
        if($sql){
            session_destroy();
            header("location: login.php");
        }
    }else {

    }
}else {
    header("location: login.php");
}
// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     // $_SESSION['is_logged_in'] = false;

//     $_SESSION = array();

//     // If it's desired to kill the session, also delete the session cookie.
//     // Note: This will destroy the session, and not just the session data!
//     if (ini_get("session.use_cookies")) {
//         $params = session_get_cookie_params();
//         setcookie(session_name(), '', time() - 42000,
//             $params["path"], $params["domain"],
//             $params["secure"], $params["httponly"]
//         );
//     }

//     // Finally, destroy the session.
//     session_destroy();

//     header("Location: login.php");
//     exit;
// }else {
//     header ("Location: users.php");
// }
 



 
?>
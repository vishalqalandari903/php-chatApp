<?php
    session_start();

    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
        die();
    }

    include_once "../includes/config.php";

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // ? check if email is verified or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // ? check if email already exists in database or not 
            $sql_qry = "SELECT email FROM users WHERE email = '{$email}'";
            $sql = mysqli_query($conn, $sql_qry);
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exists";
            }else {
                if($_FILES['image']['name'] !== ""){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $img_tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode(".", $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ["png", "jpg", "jpeg"];
                    if(in_array($img_ext, $extensions) === true){
                        $time = time();
                        
                        $new_img_name = $time.$img_name;
                        
                        if(move_uploaded_file($img_tmp_name, "users-images/".$new_img_name)){
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id,fname, lname, email, password, img, status)
                                                VALUES ('{$random_id}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}' )");

                            if($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    
                                    $status = "Active now";
                                    $sql4 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$row['unique_id']}'");
                                    if($sql4){
                                        $_SESSION['unique_id'] = $row['unique_id'];
                                        echo "success";
                                    }
                                }
                            }else {
                                echo "Something went wrong";
                            }
                        };
                    }else {
                        echo "Please select an image file - jpg, png, jpeg!";
                    }
                }else {
                    echo "Please select an image file";
                }
            }

        }else {
            echo $email." this is not valid email";
        }
    }else {
        echo "All Input Fields are required";
    }
?>
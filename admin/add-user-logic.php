<?php
require 'config/database.php';

// get user if submit button was clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    //validate input values
    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter first name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter last name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    }elseif ($is_admin !=1 && $is_admin != 0) {
        $_SESSION['add-user'] = "Please select user role";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should be at least 8 characters long";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please add avatar";
    } else {
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Usename or email already registered";
            } else {
                // Work on avatar
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;
                // Make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $avatar_name);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    // Make sure file is not more than 1mb in size
                    if($avatar['size'] < 1000001 ) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = "File size should not be more than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "File should be a photo in the png, jpg, or jpeg format";
                }
            }
        }
    }
    
    // Redirect to add-user page in case there was any problem or else insert new user
    if(isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL .'admin/add-user.php');
        die();
    } else {
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) 
        VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', $is_admin)";
        $insert_user_result = mysqli_query($connection, $insert_user_query);
        
        if($connection_errno == 0) {
            $_SESSION['add-user-success'] = "new user " . $firstname . " " . $lastname . " successfully registered.";
            header('location: ' . ROOT_URL .'admin/manage-users.php');
            die();           
        } else {
            echo"AW Snap ". mysqli_error($connection);
            die(); 
        }
    }

} else {
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
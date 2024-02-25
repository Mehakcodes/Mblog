<?php

require'config/database.php';

// get add user form data if add-user button was clicked

if(isset($_POST['submit'])){
    $firstname=filter_var($_POST['firstname'],FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname=filter_var($_POST['lastname'],FILTER_SANITIZE_SPECIAL_CHARS);
    $username=filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    $createpassword=filter_var($_POST['createpassword'],FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmpassword=filter_var($_POST['confirmpassword'],FILTER_SANITIZE_SPECIAL_CHARS);
    $avatar=$_FILES['avatar'];
    $is_admin=filter_var($_POST['userrole'],FILTER_SANITIZE_NUMBER_INT);
    

    //VALIDATE INPUT VALUES
    if(!$firstname){
        $_SESSION['add-user']='Please enter user first name';
    } elseif (!$lastname){
        $_SESSION['add-user']= 'Please enter user last name';
    } elseif (!$username){  
        $_SESSION['add-user']= 'Please enter user username';
    } elseif (!$email){
        $_SESSION['add-user']= 'Please enter user email';
    }  elseif (!empty($is_admin)){
        $_SESSION['add-user']= 'Please enter user role';
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['add-user']= 'Password shouls have at least 8 characters';
    } elseif (!$avatar['name']){
        $_SESSION['add-user']= 'Please upload user avatar';
    } else {
        // check if passwords dont match
        if($createpassword !== $confirmpassword){
            $_SESSION['add-user']= "Passwords do not match";
            
        }else{
            
            $hashedpassword=password_hash($confirmpassword, PASSWORD_DEFAULT);

            // check if username or email already exist in database
            $user_check_query= "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result= mysqli_query($connection,$user_check_query);
            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION["add-user"]= "Username or Email already exists";
                
            } else {
                
                //work on avatar
                //rename avatar
                $time=time(); //make each image unique using current timestamp
                $avatar_name=$time.$avatar["name"];
                $avatar_tmp_name=$avatar["tmp_name"];
                $avatar_desination_path= '../images/'.$avatar_name;

                // make sure file is an image
                $allowed_files=['png','jpg','jpeg','heic'];
                $extension=explode('.',$avatar_name);
                $extension=end($extension);
                if(in_array($extension,$allowed_files)){
                    // make sure image is less than 10mb
                    if($avatar['size'] < 10000000){
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name,$avatar_desination_path);

                    } else{
                        $_SESSION['add-user']= 'Image size should be less than 10mb';
                    }
                }else{
                    $_SESSION['add-user']= "Image should be pnj, jpg, jpeg, or heic";
                }

            }
            
        }
    }


    // redirect back to add-user page if any problem
    if(isset($_SESSION['add-user'])){
        // pass form data back to add-user page
        $_SESSION['add-user-data']= $_POST;
        header('location:'.ROOT_URL.'admin/add-user.php');
        die();
    } else {
        //insert new user into users table
        $insert_user_query= "INSERT INTO users (firstname, lastname, username ,email, password, avatar, is_admin) VALUES ('$firstname','$lastname','$username','$email','$hashedpassword','$avatar_name', '$is_admin')";
        $insert_user_result=mysqli_query($connection,$insert_user_query);
        if(!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION["add-user-success"]= "Registeration Successful.";
            header("location:".ROOT_URL."admin/manage-users.php");
            die();
        }
         

    }

    
    
}else{
    //if button wasn't clicked go back to add-user page
    header('location:'.ROOT_URL.'admin/add-user.php');
    die();
}


?>
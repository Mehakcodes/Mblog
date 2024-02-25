<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@10..48,300&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
 
</head>
<body>

    <section class="form-section">
        <div class="container form-section-container">
            <h2>Sign In</h2>
            <?php if(isset($_SESSION['signup-success'])) : ?>
            <div class="alert-message success">
                <p>
                    <?= $_SESSION['signup-success'] ;
                    unset($_SESSION['signup-success']);?>
                </p>
            </div>

            <?php elseif (isset($_SESSION['signin'])) : ?>
            <div class="alert-message error">
                <p>
                    <?= $_SESSION['signin'] ;
                    unset($_SESSION['signin']);?>
                </p>
            </div>
            <?php endif ?>

            <form action="<?=ROOT_URL?>signin-logic.php" method= "post"  >
            
                <input type="text" name="username_email" placeholder="Username or Email" value="<?= $username_email?>">
                <input type="password" name="password" id="" placeholder="Password" value="<?=$password?>">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have an account <a href="signup.php">Sign Up</a></small>
            </form>
               
        </div>
    </section>
    
</body>
</html>

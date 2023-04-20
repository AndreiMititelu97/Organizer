<?php
    require_once 'functions/sql_functions.php';
    session_start();
    if(isset($_POST['login'])){
        $email = $_POST['email_user'];
        $password = $_POST['password_user'];
        
        $resultLogin = connectUser($email, $password);
        
        if($resultLogin){
            if(isset($_SESSION['connect_error'])) unset($_SESSION['connect_error']);
            
            $user = getUserByEmail($email);
            $_SESSION['id_user'] = $user['id'];
            
            $_SESSION['user'] = $email;
        }else{
            $_SESSION['connect_error'] = 'Log in error!';
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Organizer app</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel='stylesheet' type='text/css' href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dreampulse/computer-modern-web-font/master/fonts.css">
    </head>
    <body>
        <nav class="navbar navbar-light" id='banner'>
            <a class="navbar-brand" style='color: white; font-size: large;'>
                <img src="img/logo.png" width="35" height="35" alt="img logo">Organizer app
            </a>
        </nav>
        
        <?php
            if(isset($_SESSION['user'])){
                require_once 'templates/template_connected.php';
            }else{
                require_once 'templates/template_not_connected.php';
            }  
        ?>
    </body>
</html>

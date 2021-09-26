<h1 class="header-reg-login" id='login'>Register</h1>

<form method="post">
    <div class="form-group">
        <label for="first_name">First name:</label>
        <input type="text" class="form-control" id="first_name" aria-describedby="emailHelp" name="first_name_user" required>
    </div>
    
    <div class="form-group">
        <label for="first_name">Last name:</label>
        <input type="text" class="form-control" id="last_name" aria-describedby="emailHelp" name="last_name_user" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email_user" required>
    </div>
    
    <div class="form-group">
        <label for="pass">Password:</label>
        <input type="password" class="form-control" id="pass" name="password_user" required><br>
        
        <button type="submit" class="btn btn-info" name="register">Register</button>
    </div>   
    <br>
</form>

<?php
    if(isset($_POST['register'])){
        $firstName = $_POST['first_name_user'];
        $lastName = $_POST['last_name_user'];
        $email = $_POST['email_user'];
        $password = $_POST['password_user'];
        
        $resultRegister = registerUser($firstName, $lastName, $email, $password);
        
        if($resultRegister){
            $_SESSION['user'] = $email;
            $user = getUserByEmail($email);
            $_SESSION['id_user'] = $user['id'];
            header('location: index.php');
        }else{
            print '<div style="color:red">Registration failed </div>';
        }
    }
?>
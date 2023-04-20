<h1 class="header-reg-login" id='login'>Connect</h1>

<form method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email_user" required>
    </div>
    
    <div class="form-group">
        <label for="pass">Password:</label>
        <input type="password" class="form-control" id="pass" name="password_user" required><br>
        
        <button type="submit" class="btn btn-info" name="login">Log in</button>
    </div>
    <br>
</form>

<?php 
    if(isset($_SESSION['connect_error'])){
        print '<div style="color:red">'.$_SESSION['connect_error'].'</div>';
    }
?>
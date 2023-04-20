<nav class="nav">
  <a class="nav-link" href="index.php">Connect</a>
  <a class="nav-link" href="index.php?page=1">Register</a>
</nav>

<section>
    <?php 
        if(isset($_GET['page'])){
            $page = $_GET['page'];
            if($page == 1){
                require_once 'pages/not_connected/register.php';
            }else{
                require_once 'pages/error.php';
            }
        }else{
            require_once 'pages/not_connected/login.php';
        }
    ?>
</section>
<nav class="navbar fixed-bottom navbar-light bg-light justify-content-center">
  <a class="navbar-brand" href="#">Organizer app &copy;</a>
</nav>
<nav class="nav">
  <a class="nav-link" href="index.php">Task List</a>
  <a class="nav-link" href="index.php?page=1">Add Task</a>
  <a class="nav-link" href="index.php?page=2">View profile</a>
  <a class="nav-link" href="index.php?logout">Disconect, (<?php print $_SESSION['user']; ?>)</a>
</nav>
    
<?php 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if($page == 1){
            require_once 'pages/connected/addTask.php';
        }else if ($page == 2){
            require_once 'pages/connected/viewProfile.php';
        }else{
            require_once 'pages/error.php';
        }
    }else{
            require_once 'pages/connected/taskList.php';
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: index.php");
    }

?>
<nav class="navbar fixed-bottom navbar-light bg-light justify-content-center">
  <a class="navbar-brand" href="#">Organizer app &copy;</a>
</nav>

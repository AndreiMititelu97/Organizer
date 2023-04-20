<h1>Add Task</h1>
<form method="post">
    <div class="mb-3" style='width:50%;'>
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="mb-3" style='width:20%;'>
        <label for="date" class="form-label">Date:</label>
        <input type="date" class="form-control" id="date" name="date">
    </div>
    
    <div class="mb-3" style='width:20%;'>
        <label for="type" class="form-label">Type:</label>
        <select name='type' id='type'>
            <option value='Task'>Task</option>
            <option value='Reminder'>Reminder</option>
            <option value='Meeting'>Meeting</option>
            <option value='Event'>Event</option>
        </select>
    </div>
    
    <div class="mb-3" style='width:50%;'>
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" rows="3" name='description'></textarea><br>
        
        <input type='hidden' name='status' value='0'>
        <button type="submit" class="btn btn-info" name="add">Add task</button>
    </div>
</form>

<?php
    if(isset($_POST['add']) && isset($_SESSION['user'])){
        $title = $_POST['title'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        $description  = $_POST['description'];
        $status = $_POST['status'];
        $id_user = $_SESSION['id_user'];
        
        $resultAdd = addTask($title, $date, $type, $description, $status, $id_user);
        if($resultAdd){   
            print '<div style="color:green">Task added successfully</div>';
        }else{
            print '<div style="color:red">Task could not be added</div>';
        }
    }
?>
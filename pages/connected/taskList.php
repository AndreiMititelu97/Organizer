<h1>Task List</h1>
<?php

$tasks = getTasks($_SESSION['id_user']);

if(count($tasks) == 0){
    print '<h2>No task available. <a href="index.php?page=1">Add a task</a></h2>';
}else{
?>
<Table class="table table-striped table-secondary table-bordered">
    <thead>
        <tr>
            <th scope="col">Titlu</th>
            <th scope="col">Data</th>
            <th scope="col">Tip</th>
            <th scope="col">Descriere</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($tasks as $task){
            ?>
        <tr>
            <td><?php print $task['titlu']; ?></td>
            <td><?php print $task['data']; ?></td>
            <td><?php print $task['tip']; ?></td>
            <td><?php print $task['descriere']; ?></td>
            <td><?php print $task['status']; ?></td>
            <td><form method='post'>
                    <input type='hidden' name='id' value="<?php print $task['id'];?>">
                    <button type="submit" class="btn btn-danger" name="endTask">End task</button>
                </form>
            </td>
        </tr>
        <?php
        }
        print '</tbody></table>';
}
if(isset($_POST['endTask'])){
    endTask($_POST['id']);
    header("location: index.php");
}
?>

<?php
    $errors = "";
    $db = mysqli_connect('localhost','root','','todo');
    if(isset($_POST['submit']))
    {
        $date = $_POST['date'];
        $task = $_POST['task'];
        $time = $_POST['time'];
        if(empty($task)){
            $errors= "Task Can,t Be Empty";
        }else{
             mysqli_query($db,"INSERT INTO tasks (task,time,date) VALUES ('$task','$time','$date')");
             header('location: todo.php');   
        }
        
    }
    
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: todo.php');
    }
    if (isset($_POST['edit_task'])) {
        $id = $_POST['task_id'];
        $editedTask = $_POST['edited_task'];
        mysqli_query($db, "UPDATE tasks SET task = '$editedTask' WHERE id = $id");
        header('location: todo.php');
    }
    if (isset($_GET['done_task'])) {
        $id = $_GET['done_task'];
        mysqli_query($db, "UPDATE tasks SET is_done = 1 WHERE id=$id");
        header('location: todo.php');
    }
    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html>
<head>
    <title>To_do List</title>
    <link rel="stylesheet" href="todo.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="Screenshot_20230720_191453_Chrome.jpg">
</head>
<body>
    <div class="container">
        <div class="info">
            <img class="img" src="Screenshot_20230720_191453_Chrome.jpg" alt="">
            <div class="h1" >
            <h1>Organize your work <br> and life, finally.</h1>
            </div>
        </div>
        <nav>
        <ul>
            <li><a class="abt" href="main.php#middle">About</a></li>
            <li><a class="con" href="main.php#foot">Contact</a></li>
            <li><a class="edi" href="edit.php">Edit Tasks</a></li>
            <li><a class="com" href="completed.php">Completed Tasks</a></li>
            <li><a class="status" href="#" onclick="confirmLogout()">Log Out</a></li>    
        </ul>
    </nav>
    <div class="bdy">
        <div class="heading">
            <h2>To Do List</h2>
        </div>
        <div class="search1">
    <input class="sea" type="text" id="searchInput" placeholder="Search tasks...">
</div>
        <form class="f1" method = "POST" action="todo.php">
        <div class="search">
        <?php if(isset($errors)){?>
        <m><?php echo $errors; ?></m> 
        <?php } ?>
        
            <div class="dat">
                <div class="ti">
                    <label for="appt" class="ti">Select a time:</label >
                    <input required type="time" id="appt" name="time" class="da1">
                </div>
                <div class="da">
                    <label for="birthday">Date:</label>
                    <input required type="date" id="date" name="date" class="da2">
                </div> 
            </div>
            <input type="text" name="task" placeholder="Add tasks...." class="task_input" required>
            <button type ="submit" class="add_btn" name="submit">Add task</button>
        </form>
        </div>
        <div >
        <table>
            <thead class="he">
                <tr>
                    <th >N</th>
                    <th>date</th>
                    <th>Time</th>
                    <th>Task</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; while($row = mysqli_fetch_array($tasks)) { ?>
                    <tr>
                    <td><?php echo $i; ?></td>
                    <td class="date"><?php echo $row['date'];?></td>
                    <td class="time"><?php echo $row['time'];?></td>
                    <td class="task"><?php echo $row['task'];?></td>
                    <td  class="delete">
                     <a class="ix" href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">X</a>
                    </td>
                    <td class="do">
                    <a onclick="done()" class="don" href="todo.php?done_task=<?php echo $row['id'];?>">Done</i></a>
                    </td>
                    </td>
                   
                </tr>            
                <?php $i++ ; } ?>
            </tbody>
        </table>
    </div>
    </div>
</div> 
    
<script>
    // function for the conformation functionality
    function confirmDelete(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            window.location.href = 'todo.php?del_task=' + taskId;
        }
    }

    function done() {
        alert('task is completed');
    }

    function confirmLogout() {
        if (confirm('Are you sure you want to log out?')) {
            window.location.href = 'main.php';
        }
    }
</script>   

<script>
    // function for the search functionality
    function searchTasks() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3]; // Assuming the Task column is the fourth column (index 3)

            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; // Show the row if the search text matches
                } else {
                    tr[i].style.display = "none"; // Hide the row if the search text doesn't match
                }
            }
        }
    }
    document.getElementById("searchInput").addEventListener("keyup", searchTasks);
</script>
</body>
</html>
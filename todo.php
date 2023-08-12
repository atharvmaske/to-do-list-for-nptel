<?php
    session_start();

    // Get the task details from the form
    if (!isset($_SESSION['username'])) {
        header('location: main.php'); // Redirect users who are not logged in
        exit();
    }
    
    $currentUser = $_SESSION['username'];
    $errors = "";
    $db = mysqli_connect('localhost','root','','todo');
    if(isset($_POST['submit']))
    {
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $task = isset($_POST['task']) ? $_POST['task'] : "";
        $time = isset($_POST['time']) ? $_POST['time'] : "";
        if(empty($task)){
            $errors= "Task Can,t Be Empty";
        }else{
            mysqli_query($db, "INSERT INTO tasks (username, task, time, date) VALUES ('$currentUser', '$task', '$time', '$date')");
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
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="info">
            <img class="img" src="img/logo.png" alt="">
            <div class="h1" >
            <h1>Organize your work <br> and life, finally.</h1>
            </div>
            <div class="user">
            <i class="fa-solid fa-user fa-xl" style="  color: #6B8E23; margin-left: 10px; "></i>
                <div class="name">
                <?php
                echo ":"; 
                echo  $currentUser?>
                </div>
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
            <?php
            // Fetch tasks associated with the logged-in user
            $currentUser = $_SESSION['username'];
            $tasks_query = "SELECT * FROM tasks WHERE username='$currentUser'";
            $tasks_result = mysqli_query($db, $tasks_query);
                

                // Check if the query was successful
                if (!$tasks_result) {
                    echo "Error: " . mysqli_error($db);
                } else {
                    // Iterate through tasks and display them
                    $id = 1;
                    while ($row = mysqli_fetch_assoc($tasks_result)) {
                        echo "<tr>";
                        echo "<td>" . $id  . "</td>";
                        echo "<td class='date'>" . $row['date'] . "</td>";
                        echo "<td class='time'>" . $row['time'] . "</td>";
                        echo "<td class='task'>" . $row['task'] . "</td>";
                        echo "<td class='delete'><a class='ix' href='#' onclick='confirmDelete(" . $row['id'] . ")'>X</a></td>";
                        echo "<td class='do'><a class='don' href='todo.php?done_task=" . $row['id'] . "'>Done</a></td>";
                        echo "</tr>";
                        $id++;
                    }
                }

            ?>
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
            window.location.href = 'logout.php';
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
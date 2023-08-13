<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: main.php');
    exit();
}

$db = mysqli_connect('localhost', 'root', '', 'todo');

// Get completed tasks for the logged-in user
$currentUser = $_SESSION['username'];
$completed_tasks = mysqli_query($db, "SELECT * FROM tasks WHERE username='$currentUser' AND is_done = 1");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Completed Tasks</title>
    <link rel="stylesheet" href="todo.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
</head>
<body>
    <div class="container1">
        <a class="back" href="todo.php">Todo</a>
        <h2 class="h2">Completed Tasks</h2>
        <table>
            <thead class="he">
                <tr>
                    <th>N</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Task</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while ($row = mysqli_fetch_array($completed_tasks)) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="date"><?php echo $row['date']; ?></td>
                        <td class="time"><?php echo $row['time']; ?></td>
                        <td class="task"><?php echo $row['task']; ?></td>
                    </tr>
                <?php $i++;  } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

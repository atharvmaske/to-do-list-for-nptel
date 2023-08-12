<?php
session_start();

// Redirect users who are not logged in
if (!isset($_SESSION['username'])) {
    header('location: main.php');
    exit();
}

$currentUser = $_SESSION['username'];
$db = mysqli_connect('localhost', 'root', '', 'todo');

if (isset($_POST['edit_task'])) {
    $id = $_POST['task_id'];
    $editedDate = $_POST['edited_date'];
    $editedTime = $_POST['edited_time'];
    $editedTask = $_POST['edited_task'];

    // Update the task only if it belongs to the logged-in user
    mysqli_query($db, "UPDATE tasks SET date = '$editedDate', time = '$editedTime', task = '$editedTask' WHERE id = $id AND username = '$currentUser'");
    header('location: edit.php');
}

$tasks = mysqli_query($db, "SELECT * FROM tasks WHERE username = '$currentUser'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tasks</title>
    <link rel="stylesheet" href="edit.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
</head>
<body>
    <div class="container">
        <a class="back" href="todo.php">Todo</a>
        <div class="bdy">
            <div class="heading">
                <h2>Edit Tasks</h2>
            </div>
            <table>
                <thead class="he">
                    <tr>
                        <th>N</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Task</th>
                        <th>Save</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_array($tasks)) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <form method="POST" action="edit.php">
                                    <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                                    <input class="id" type="date" name="edited_date" value="<?php echo $row['date']; ?>" required>
                            </td>
                            <td>
                                    <input class="it" type="time" name="edited_time" value="<?php echo $row['time']; ?>" required>
                            </td>
                            <td>
                                    <input class="tt" type="text" name="edited_task" value="<?php echo $row['task']; ?>" required>
                            </td>
                            <td>
                            <button type="submit" class="edit_btn" name="edit_task">Save</button>
                             </form>
                            </td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

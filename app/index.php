<?php
    session_start();

    $todoList = array();

    if (isset($_SESSION["todoList"])) $todoList = $_SESSION["todoList"];

    function appendData($data) {
        $todoList = $data;
        return $todoList;
    }

    function deleteData($toDelete, $todoList) {
        foreach ($todoList as $index => $taskName) {
            if ($taskName === $toDelete) {
                unset( $todoList[$index] );
            }

        }

        return $todoList;
    }

    if($_SERVER["REQUEST_METHOD"] =="POST") {
        if (empty( $_POST["task"] )){
            echo '<script>alert("Error: there is no data to add in array")</script>';
            exit;
        }

        array_push($todoList, appendData($_POST["task"]));
        $_SESSION["todoList"] = $todoList;
    }

    if (isset($_GET['task'])) {
        $_SESSION["todoList"] = deleteData($_GET['task'], $todoList);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">To-Do List</h1>
        <div class="card">
            <div class="card-header">Add a new task</div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="task" placeholder="Enter your task here">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Tasks</div>
            <ul class="list-group list-group-flush">
            <?php
                foreach ($todoList as $task) {
                    echo '<div class="d-flex p-2 bd-highlight w-100 justify-content-between"> <li class="list-group-item w-100">' . $task . ' </li><a href="index.php?delete=true&task=' . $task . '" class="btn btn-danger">Delete</a></div>';
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

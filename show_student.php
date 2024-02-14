<?php
require_once("config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo "css/random.css" ?>">
</head>

<body>
    <header>
        <h1>Welcome to my assignment 09</h1>
    </header>

    <nav>
        <ul>
            <li><a href="./add_form.php">Add a student</a></li>
        </ul>
    </nav>

    <main>


        <h1>Administering DB from a Form.</h1>

        <h2> This project is done by: Ritesh Maharjan</h2>

        <?php
        require_once("security_guard.php");

        if (isset($_SESSION["error"])) {
            $erros = $_SESSION["error"];

            foreach ($erros as $error) {
                echo "<p class='error'>$error</p>";
            }
        }

        if (isset($_SESSION["message"])) {
            $messages = $_SESSION["message"];
            foreach ($messages as $message) {
                echo "<p class='success'>$message</p>";
            }
        }

        $username = $_SESSION['user'];

        if (isset($_GET["query"])) {
            $query = $_GET["query"];


            // depending upon the query we want to sort
            if ($query == "id") {
                $query = "SELECT id, firstname, lastname FROM students ORDER BY id;";
                $result = $mysqli->query($query);
            } else if ($query == "firstname") {
                $query = "SELECT id, firstname, lastname FROM students ORDER BY firstname;";
                $result = $mysqli->query($query);
            } else if ($query == "lastname") {
                $query = "SELECT id, firstname, lastname FROM students ORDER BY lastname;";
                $result = $mysqli->query($query);
            }
        } else {

            // default, if no query given
            $query = "SELECT id, firstname, lastname FROM students ORDER BY id;";
            $result = $mysqli->query($query);
        }

        // Outputing all the students
        echo "<table>";

        // grabbing the fields to put it as a th
        $arrayOfFieldNames = $result->fetch_fields();
        echo "<thead> <tr>";
        foreach ($arrayOfFieldNames as $oneFieldAsAnObject) {
            echo "<th><a href='show_student.php?query=" . $oneFieldAsAnObject->name . "'>" . $oneFieldAsAnObject->name . "</th>";
        }
        echo "<th>Delete</th>";
        echo "<th>Update</th>";

        echo "</tr></thead>";

        echo "<tbody>";
        while ($record = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $record["id"] . "</a></td>";
            echo "<td><a href='show_student.php?query=firstname'>" . $record["firstname"] . "</a></td>";
            echo "<td><a href='show_student.php?query=lastname'>" . $record["lastname"] . "</a></td>";
            echo "<td><a href='delete_form.php?id=" . $record["id"] . "'>Delete</td>";
            echo "<td><a href='update_form.php?id=" . $record["id"] . "'>Update</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        //close MySQL connection
        $mysqli->close();
        ?>

        <a href="logout.php">Logout</a>


    </main>

    <footer>
        <p>&copy;Copyright 2024 All rights reserved</p>
    </footer>
</body>

</html>
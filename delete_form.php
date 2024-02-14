<?php
require_once("config.php");
require_once("security_guard.php");
// emptying all the errors and message
if (isset($_SESSION["error"])) {
    $_SESSION["error"] = array();
    $_SESSION["message"] = array();
}
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

    <main>
        <h1>Administering DB from a Form.</h1>
        
        <h3>Delete the student</h3>

        <?php
        if (isset($_GET["id"])) {
            $id = trim($_GET["id"]);

            // protecting from sql injection attack
            $safeNumber = $mysqli->real_escape_string($id);

            $query = "SELECT * FROM students WHERE id = '$safeNumber'";
            $query = $mysqli->query($query);

            while ($record = $query->fetch_assoc()) {
                $id = $record["id"];
                $firstname = $record["firstname"];
                $lastname = $record["lastname"];
            }

            $mysqli->close();
        }
        ?>


        <form enctype="multipart/form-data" method="post" action="delete_process.php?id=<?php echo $id ?>">

            <h2>Delete a record - Are you sure?</h2>

            <?php echo $id . " " . $firstname . " " . $lastname ?>
            <div>
                <input type="radio" name="delete" value="yes" id="yes">
                <label for="yes">Yes</label>
            </div>
            <div>
                <input type="radio" name="delete" value="no" id="no" checked>
                <label for="no">No</label>

            </div>
            <br />
            <input class="btn" type="submit" value="Submit" />
        </form>


    </main>

    <footer>
        <p>&copy;Copyright 2024 All rights reserved</p>
    </footer>
</body>

</html>
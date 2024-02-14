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


        <h3>Update the student</h3>


        <?php
        if (isset($_GET["id"])) {
            $id = trim($_GET["id"]);

            // protecting from sql injection attack
            $safeNumber = $mysqli->real_escape_string($id);

            $query = "SELECT * FROM students WHERE id = '$safeNumber'";
            $query = $mysqli->query($query);

            // grabbing the name to display it
            while ($record = $query->fetch_assoc()) {
                $id = $record["id"];
                $firstname = $record["firstname"];
                $lastname = $record["lastname"];
            }

            $mysqli->close();
        }
        ?>

        <form enctype="multipart/form-data" method="post" action="update_form_process.php?id=<?php echo $id ?>">

            <div>
                <label for="number">Number:</label>
                <input type="text" name="number" id="number" value="<?php echo $id ?>" />
            </div>

            <div>
                <label for="firstname">First name:</label>
                <input type="firstname" name="firstname" id="firstname" value="<?php echo $firstname ?>" />
            </div>


            <div>
                <label for=" lastname">Last name:</label>
                <input type="lastname" name="lastname" id="lastname" value="<?php echo $lastname ?>" />
            </div>


            <input class="btn" type="submit" value="Submit" />
        </form>


    </main>

    <footer>
        <p>&copy;Copyright 2024 All rights reserved</p>
    </footer>
</body>

</html>
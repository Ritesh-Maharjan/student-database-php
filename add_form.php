<?php
require_once("config.php");
require_once("security_guard.php");

// emptying all the errors and message
if (isset($_SESSION["error"])) {
    $_SESSION["error"] = array();
    $_SESSION["message"] = array();
}

$mysqli->close();
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

        <h3>Add a student</h3>

        <form enctype="multipart/form-data" method="post" action="add_form_process.php">

            <div>
                <label for="number">Number:</label>
                <input type="text" name="number" id="number" />
            </div>

            <div>
                <label for="firstname">First name:</label>
                <input type="firstname" name="firstname" id="firstname" />
            </div>


            <div>
                <label for="lastname">Last name:</label>
                <input type="lastname" name="lastname" id="lastname" />
            </div>


            <input class="btn" type="submit" value="Submit" />
        </form>


    </main>

    <footer>
        <p>&copy;Copyright 2024 All rights reserved</p>
    </footer>
</body>

</html>
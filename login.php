<?php
require_once("config.php");

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

        <?php
        $errors = array();
        if (isset($_SESSION["errors"])) {
            $errors = $_SESSION["errors"];

            // check whether there was errors or not
            if (count($errors) > 0) {
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li class='error'>$error</li>";
                }
                echo "</ul>";
            }
        } 
        ?>


        <form enctype="multipart/form-data" method="post" action="login_process.php">

            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" />
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" />
            </div>


            <input class="btn" type="submit" value="Submit" />
        </form>


    </main>

    <footer>
        <p>&copy;Copyright 2024 All rights reserved</p>
    </footer>
</body>

</html>
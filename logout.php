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
        session_destroy();
        ?>

        <p>You have been logged out</p>

        <a href="login.php">Login</a>
    </main>

    <footer>
        <p>&copy;Copyright 2024 All rights reserved</p>
    </footer>
</body>

</html>
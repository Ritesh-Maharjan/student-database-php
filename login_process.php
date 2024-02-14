<?php
require_once("config.php");

$username;
$password;
$errors = array();
$usernameMatched = false;

// if username and password not set in the forum;
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $_SESSION["errors"] = [];

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username !== "") {

        if ($password !== "") {

            // protecting from sql injection attack
            $safeUsername = $mysqli->real_escape_string($username);

            // getting data with the username
            $query = "SELECT  username, password FROM secure_users WHERE username = '$safeUsername';";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                // Fetch the data from the result set
                $row = $result->fetch_assoc();


                // fetching the password from the row
                $fetchedPassword = $row['password'];
                if (password_verify($password, $fetchedPassword)) {
                    $_SESSION["user"] = $username;
                    $_SESSION["last_active"] = time();
                    $_SESSION["errors"] = array();
                    header("Location: show_student.php");
                } else {
                    // username didnt match
                    $errors[] = "Password doesnt match, Please try again";
                    $_SESSION["errors"] = $errors;
                    header("Location: login.php");
                }

            } else {

                // username didnt match
                $errors[] = "Username $username doesnt matched";
                $_SESSION["errors"] = $errors;
                // header("Location: login.php");
            }

            $mysqli->close();

        } else {
            $errors[] = "Password cannot be empty";
            $_SESSION["errors"] = $errors;
            header("Location: login.php");
        }

    } else {
        $errors[] = "Username can not be empty";
        $_SESSION["errors"] = $errors;
        header("Location: login.php");
    }
} else {
    $errors[] = "Username Not Set";
    $errors[] = "Password Not Set";
    $_SESSION["errors"] = $errors;
    header("Location: login.php");
}
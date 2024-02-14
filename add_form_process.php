<?php
require_once("config.php");
require_once("security_guard.php");

$errorMessage = array();
$message = array();
if (isset($_POST["number"]) && $_POST["firstname"] && $_POST["lastname"]) {


    $number = trim($_POST["number"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);

    echo "asdbnasndslajd";
    // protecting from sql injection attack
    $safeNumber = $mysqli->real_escape_string($number);

    $safeFirstname = $mysqli->real_escape_string($firstname);

    // protecting from sql injection attack
    $safeLastname = $mysqli->real_escape_string($lastname);

    // making sure all the fields are filled
    if ($safeNumber !== "" && $safeFirstname !== "" && $safeLastname !== "") {

        // making sure correct student number is used
        if (preg_match("/^a0[0-9]{7}$/i", $safeNumber)) {

            // Inserting data to the table
            $query = "INSERT  INTO students( id, firstname, lastname) VALUES ('$safeNumber','$safeFirstname', '$safeLastname');";

            try {
                $result = $mysqli->query($query);

                // if we didnt insert results will be 0 so something went wrong
                if ($mysqli->affected_rows == 0) {
                    $errorMessage[] = "Something went wrong and was not able to add";
                    $_SESSION["message"] = $errorMessage;
                } else {
                    // was added
                    $message[] = "Record Added: ID = $safeNumber firstname = $safeFirstname lastnaame = $safeLastname";
                    $_SESSION["message"] = $message;
                }
            } catch (Exception $e) {
                // catches any exception and sent it back t
                $error = $e->getMessage();
                $errorMessage[] = $error . "Record NOT Added: $safeNumber studentNumber is a Duplicate";
                $_SESSION["error"] = $errorMessage;
            }
            header("location: show_student.php");

            $mysqli->close();
        } else {
            // when the invalid studnet id is used
            $errorMessage[] = "Invalid student id";
            $_SESSION["error"] = $errorMessage;
            header("location: show_student.php");
        }
    } else {
        $errorMessage[] = "All the field should be filled";
        $_SESSION["error"] = $errorMessage;
        header("location: show_student.php");
    }

} else {
    $errorMessage[] = "All the field should be filled";
    $_SESSION["error"] = $errorMessage;
    header("location: show_student.php");
}

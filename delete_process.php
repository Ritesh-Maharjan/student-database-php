<?php

require_once("config.php");
require_once("security_guard.php");

if (isset($_GET["id"])) {
    $id = trim($_GET["id"]);

    if ($id === "") {
        $_SESSION["errors"] = "Student id shouldnt be empty";
    } else {

        // check if we have delete in the form post
        if (isset($_POST["delete"])) {

            $delete = trim($_POST["delete"]);

            // if the vlaue is yes delete it
            if ($delete == "yes") {
                try {
                    // deleting data with the matching id
                    $query = "DELETE FROM students WHERE id = '$id';";
                    $result = $mysqli->query($query);

                    // if we didnt delete results will be 0 so something went wrong
                    if ($mysqli->affected_rows == 0) {
                        $errorMessage[] = "Something went wrong and was not able to add";
                        $_SESSION["message"] = $errorMessage;
                    } else {
                        // was added
                        $message[] = "Record Deleted sucessfully of ID $id";
                        $_SESSION["message"] = $message;
                    }
                } catch (Exception $e) {
                    // catches any exception and sent it back t
                    $error = $e->getMessage();
                    $errorMessage[] = $error;
                    $_SESSION["error"] = $errorMessage;
                }
                header("location: show_student.php");
                
                $mysqli->close();

            } else {
                header("location: show_student.php");
                // was added
                $message[] = "Record deletion cancelled for ID $id";
                $_SESSION["message"] = $message;
            }
        }

    }


} else {
    echo "asd";
}
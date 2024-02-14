<?php

//ensure a timestamp exists
if (isset($_SESSION['last_active'])) {

    // current time
    $timeNow = time();
    // setup time last active
    $timeLastActive = 0;

    // if its inside the cookie update the time last active
    if (isset($_SESSION['last_active'])) {
        $timeLastActive = $_SESSION['last_active'];
    }

    // if time last active + timeout in seconds is smaller than time now that means the timeout has been exceeded
    if ($timeLastActive + TIMEOUT_IN_SECONDS < $timeNow) {
        echo "<p>Timeout has been exceeded!</p>";
        //prepare error message
        $_SESSION['errors'] = array("<p class='error'>You have been logged out due to inactivity</p>");
        //forward user to login page
        header("location: login.php");
        die();
    } else {
        $_SESSION["last_active"] = time();
    }


} else {
    //prepare error message
    echo "<p>Timeout has been exceeded!</p>";
    $_SESSION['errors'] = array("<p class='error'>You have been logged out due to inactivity</p>");
    //forward user to login page
    header("location: login.php");
    die();
}

?>
<?php

        //studio-ini.php
        //Get or set remote BNO055 sensor readings.
        //This page services the write requests from sensors and read
        //requests from PLC client.


// Parse action, sensor and payload as required

$action = (isset($_GET['action']) ? $_GET['action'] : null);
if ($action == "r") { //if action is equal to read
        $cmd = "tail -1 queue.txt";
        $cmdout = shell_exec($cmd);
        echo $cmdout;
} elseif ($action == "w") { //if action is equal to write
        $payload = (isset($_GET['payload']) ? $_GET['payload'] : null);
        $cmd = "echo \"$payload\" > serviced.txt";
        // echo $cmd;
        shell_exec($cmd);
} else {
        echo "Malformed URL - action=(w|r) required.";
}

?>

<?php

#Receive request from android phone for file saving
$action = $_GET['action'];
print $action;
$cmd = "echo \"$action\" > filesaving.txt";
$cmdout = shell_exec($cmd);

?>

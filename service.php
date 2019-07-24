<?php
# Parse action, sensor and payload as required

$action = (isset($_GET['action']) ? $_GET['action'] : null);
if ($action == "r") { #if action is equal to read
        $cmd = "tail -1 queue.txt";
        $cmdout = shell_exec($cmd);
        echo $cmdout;
        $emptyStr = "";
	$deleteQueueContent = "echo \"$emptyStr\" > queue.txt";
        shell_exec($deleteQueueContent);
} elseif ($action == "w") { #if action is equal to write
        $payload = (isset($_GET['payload']) ? $_GET['payload'] : null);
        $cmd = "echo \"$payload\" > serviced.txt";
        echo $cmd;
        shell_exec($cmd);
} else {
        echo "Malformed URL - action=(w|r) required.";
}

$pid = (isset($_GET['id']) ? $_GET['id'] : null);
# todo add timestamp to file
# date > /ids/' . $pid . etc

$execDir = 'touch /ids/' . $pid . '.txt';
shell_exec($execDir)

#if($pid != '') {
 #$execDir = "sudo /usr/bin/touch /ids/ok.txt";
 #$execDir = "sudo /usr/bin/touch /var/www/html/ids/$pid.txt";
 #shell_exec($execDir);
#}

?>

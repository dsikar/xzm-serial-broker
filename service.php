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
	// log empty quey
	$str = "echo \"[2] - Job request removed from queue.\" >> log.txt" . "\n" . "\n";
	shell_exec($str);
} elseif ($action == "w") { #if action is equal to write
        $payload = (isset($_GET['payload']) ? $_GET['payload'] : null);
        $cmd = "echo \"$payload\" > serviced.txt";
        echo $cmd;
        shell_exec($cmd);
	$str = "echo \"[3] - Job completed.\" >> log.txt" . "\n" . "\n";
	shell_exec($str);
} else {
        echo "Malformed URL - action=(w|r) required.";
}

?>

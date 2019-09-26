<?php
# Parse action, sensor and payload as required

$action = (isset($_GET['action']) ? $_GET['action'] : null);
$pid = (isset($_GET['id']) ? $_GET['id'] : null);

if ($action == "r") { #if action is equal to read
        $cmd = "tail -1 ".$pid."queue.txt";
        $cmdout = shell_exec($cmd);
        echo $cmdout;
        $emptyStr = "";
	$deleteQueueContent = "echo \"$emptyStr\" > ".$pid."queue.txt";
        shell_exec($deleteQueueContent);
} elseif ($action == "w") { #if action is equal to write
        $payload = (isset($_GET['payload']) ? $_GET['payload'] : null);
        $cmd = "echo \"$payload\" > ".$pid."serviced.txt";
        echo $cmd;
        shell_exec($cmd);
} else {
        echo "Malformed URL - action=(w|r) required.";
}

$pid = (isset($_GET['id']) ? $_GET['id'] : null);
# todo add timestamp to file
# date > /ids/' . $pid . etc

#Touch the file if it has not been created before
#$execDir = 'touch /ids/' . $pid . '.txt';
#shell_exec($execDir)

if($pid != '') {
 $execDir = 'touch /ids/' . $pid . '.txt';
 shell_exec($execDir);
}

#Insert timestamp for later use
$timeVar = time();
$fileLocation = "/ids/".$pid.".txt";
file_put_contents($fileLocation, $timeVar);
#$saveTime = "echo \"$timeVar\" > /ids/". $pid .".txt";
#shell_exec(saveTime)
?>

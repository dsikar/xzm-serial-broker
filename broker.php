<?php
#Current Script
#Server side brokering script for android phone to pi communication

# 1. Receive request from android phone
#$emptyStr = "";
#echo shell_exec($emptyStr);

if(isset($_GET['id'])){
  $pid = $_GET['id'];
}

if(isset($_GET['action'])){
	# 1.1 add to request queue
	$action = $_GET['action'];
	$queueDataSaving = $pid."queue.txt";
	if(!file_exists($queueDataSaving)){
	    file_put_contents($queueDataSaving, $action);
	} 
	else {
	    $cmd = "echo \"$action\" > $queueDataSaving";
	    $cmdout = shell_exec($cmd);
	}
}
if(isset($_GET['filesaving'])){
	$savedData = $_GET['filesaving'];
	$fileDataSaving = $pid."_Data.txt";
	if(!file_exists($fileDataSaving)){
	    file_put_contents($fileDataSaving, $savedData); 
	}
	else {
	    $cmd = "echo \"$savedData\" >> $fileDataSaving";
	    shell_exec($cmd);
	}
}

# 2. Add delay - using while loop
$bool = true;
$payloadContent;

while ($bool) {
# 3. Check if pi has serviced request 
      $serviceDataSaving = $pid."serviced.txt";
      if(!file_exists($serviceDataSaving)){
          file_put_contents($serviceDataSaving, "");
      }
      $fp = fopen($pid.'serviced.txt', 'r+');
      $payloadContent = fgets($fp);
      
      if(strlen($payloadContent) != 0){

# 4. read request and write back to browser
      $cmd = "tail -1 ".$pid."serviced.txt";
      $cmdout = shell_exec($cmd);
      ftruncate($fp, 0);
      echo $cmdout; 
      $bool = false;
      }

      fclose($fp);
      sleep(0.1);
}
# Keep filesaving.txt last 3000 lines
$cmd = "tail -3000 ".$pid."_Data.txt > ".$pid."log.txt";
shell_exec($cmd);
$cmd = "cat ".$pid."log.txt > ".$pid."_Data.txt";
shell_exec($cmd);

$arguement = $pid."_Data";
putenv("FILENAME=$arguement");

$cmd = ". /var/www/html/make-html.sh";
#make data available to self refreshing web page
shell_exec($cmd);

?>

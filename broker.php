<?php
#Server side brokering script for android phone to pi communication

# 1. Receive request from android phone
#$emptyStr = "";
#echo shell_exec($emptyStr);

if(isset($_GET['action'])){
	# 1.1 add to request queue
	$action = $_GET['action'];
	$cmd = "echo \"$action\" > queue.txt";
	$cmdout = shell_exec($cmd);
}
if(isset($_GET['filesaving'])){
	$savedData = $_GET['filesaving'];
	$cmd = "echo \"$savedData\" >> filesaving.txt";
	shell_exec($cmd);
}

# 2. Add delay - using while loop
$bool = true;
$payloadContent;

while ($bool) {
# 3. Check if pi has serviced request 
      $fp = fopen('serviced.txt', 'r+');
      $payloadContent = fgets($fp);
      if(strlen($payloadContent) != 0){

# 4. read request and write back to browser
          $cmd = "tail -1 serviced.txt";
          $cmdout = shell_exec($cmd);
          ftruncate($fp);
          echo $cmdout;
          $bool = false;
	  $str = "echo \"[4] - Payload cleared from serviced.txt.\" >> log.txt" . "\n";
	  shell_exec($str);
      }
      sleep(0.1);
}

?>

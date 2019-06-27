<?php

# 1. Receive request from android phone
$action = $_GET['action']; 
#echo $action;
# 1.1 add to request queue
$cmd = "echo \"$action\" > queue.txt";
# echo $cmd;
$cmdout = shell_exec($cmd);

#$fp = fopen('queue.txt', 'w');
#fwrite($fp, $action);
#fclose($fp);
# 2. Add delay - or loop
#time.sleep(1)
$bool = true;
$payloadContent;
while ($bool) {
      $fp = fopen('serviced.txt', 'r+');
      $payloadContent = fgets($fp);
      if(strlen($payloadContent) != 0){
          $cmd = "tail -1 serviced.txt";
          $cmdout = shell_exec($cmd);
          ftruncate($fp);
          echo $cmdout;
          $bool = false;
      }
      #fclose($fp)
      #time.sleep(0.2);
}

# 3. Check if pi has serviced request - hopefully yes
# 4. read request and write back to browser
#$fp = fopen('serviced.txt', 'r+');
#echo fgets($fp)
#fclose($fp);
#$cmd = "tail -1 serviced.txt";
#$cmdout = shell_exec($cmd);
#echo $cmdout;

# 4. Print response to browser
# echo "0x1,0xa,0x35,0xe4,0x0,0x0,0xfd,0x12,0x0,0x4,0x0,0x95,0x0,0x0,0x0,0xc,0x1,0x0,0x2,0x0,0x1,0x56,0x99,0x0,0x2,0x0,0x1,0xfe,0x1,0x0,0x7e,0x5,0x0,0x0,0x0,0x0,0x0,0x0,0x3,0x1,0x9,0x0,0x2a,0x0,0x0,0x4,0x0,0x4,0x0,0x4,0x0,0x0,0x0,0x0,0x0,0x92,";

#echo "1,1,58,228,0,0,0,4,253,146,0,148,0,12,1,0,5,0,254,0,0,1,3,0,0,3,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,255,127,0,10,199";
?>

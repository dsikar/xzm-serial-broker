<?php
#Script to get number of files in directory.

# For each file, open file and read timestamp
# Compare saved timestamp to current timestamp
# If greater than (to be defined number of seconds)
# No heartbeat, otherwise, list, it's alive

$directoryPath = "/ids/";
$panelFiles = scandir($directoryPath);

unset($panelFiles[0]);
unset($panelFiles[1]);

#$panelFiles = str_replace(".", "", $panelFiles);
#$panelFiles = str_replace("..","", $panelFiles);

foreach($panelFiles as $singleFile) {
  $oldTime = file_get_contents("/ids/".$singleFile."");
  $currentTime = time();
  $elapsedTime = $currentTime - $oldTime;
  #echo "oldTime  is $oldTime <br />";
  #echo "currentTime is $currentTime <br />"; 
  #echo "I've been alive for $elapsedTime seconds <br />";
  if($elapsedTime > 60){#if grreater than one minute
    $expiredFile = "rm /ids/".$singleFile;
    #echo "$expiredFile <br />";
    unset($panelFiles[$singleFile]);
    shell_exec($expiredFile);
    #echo "File is being removed";
  }
}

#echo "<br />";
foreach($panelFiles as $individualFile) {
  echo "$individualFile <br />";
}

#return $panelFiles;
?>

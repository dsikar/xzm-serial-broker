<?php
#Script to get number of files in directory.

# For each file, open file and read timestamp
# Compare saved timestamp to current timestamp
# If greater than (to be defined number of seconds)
# No heartbeat, otherwise, list, it's alive

$directoryPath = "/var/www/html/ids";
$panelFiles = scandir($directoryPath);

unset($panelFiles[0]);
unset($panelFiles[1]);

#$panelFiles = str_replace(".", "", $panelFiles);
#$panelFiles = str_replace("..","", $panelFiles);

foreach($panelFiles as $singleFile) {
  echo "$singleFile <br />";
}
#return $panelFiles;
?>

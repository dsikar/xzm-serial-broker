<?php 

if(isset($_GET['action'])){

    $com1Data = $_GET['action'];
    $cmd = "echo \"$com1Data\" >> com1saving.txt";
    shell_exec($cmd);

}
$linefilter = "tail -1000 com1saving.txt > com1-log.txt";
shell_exec($linefilter);
$linefilter = "cat com1-log.txt > com1saving.txt";
shell_exec($linefilter);
$linefilter = ". /var/www/html/com1make-html.sh";
shell_exec($linefilter);

?>

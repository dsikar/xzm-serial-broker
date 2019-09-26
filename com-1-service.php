<?php 


if(isset($_GET['id'])){
    $com1_ID = $_GET['id'];
}



if(isset($_GET['action'])){

    $com1Data = $_GET['action'];
    $cmd = "echo \"$com1Data\" >> ".$com1_ID."_com1.txt";
    shell_exec($cmd);

}
$linefilter = "tail -1000 ".$com1_ID."_com1.txt > ".$com1_ID."_com1-log.txt";
shell_exec($linefilter);
$linefilter = "cat ".$com1_ID."_com1-log.txt > ".$com1_ID."_com1.txt";
shell_exec($linefilter);

$arguement = $com1_ID."_com1";
putenv("COM1NAME=$arguement");

$linefilter = ". /var/www/html/com1make-html.sh";
shell_exec($linefilter);

?>

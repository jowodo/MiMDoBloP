<?php
$BASEDIR="/var/www/html/blog";
include "$BASEDIR/res/res.php"; 
#include '../res/res.php'; 
$title=shell_exec("head -n1 ./index.md");
startit($title);
###############
doit();
###############
endit();
?>

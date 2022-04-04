<?php
include substr(strval(__FILE__),0,-9)."config.php";
#$HOMEPATH="/var/www/html/blog";
include "$HOMEPATH/res/res.php"; 
#include '../res/res.php'; 
$title=shell_exec("head -n1 ./index.md");
startit($title);
###############
make_article();
###############
endit();
?>

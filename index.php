<?php
include './res/res.php'; 
$title="Overview"; 
startit($title); 
###############
#
echo "<article>";
echo "<h1>About this blog</h1>"; 
echo "In this blog technical issues about Linux, Unix, bash and so on will be treated."; 
echo "<h2>List of articles</h2>";
echo "<ul>";
$PAGES=get_pages();
foreach ($PAGES as $PAGE)
{
	echo "<li> <a href=\"./$PAGE\">$PAGE</a> </li>";
}
echo "</ul>";
echo "</article>";
#
###############
endit();
?>

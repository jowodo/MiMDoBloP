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
#$files=scandir('.');
$files=scandir(getcwd());
$exclude=['index.php', 'res', '.git'] ; 
# index starts at 2 because we ignore '.' (this dir) and '..' (parent dir)
for ($i=2; $i < count($files); $i++) {
	if ($files[$i] == "index.php" 
		or $files[$i] == "res" 
		or $files[$i] == ".git" 
		or $files[$i] == ".htaccess" 
		or $files[$i]=="tempdir") {
		continue; 
	}
	echo "<li> <a href=\"./$files[$i]\">$files[$i]</a> </li>";
}
echo "</ul>";
echo "</article>";
#
###############
endit();
?>

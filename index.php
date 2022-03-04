<?php
include './res/res.php'; 
$title="Overview"; 
startit($title); 
###############
#
echo "<article>";
echo "
List of articles
";
echo "<ul>";
#$files=scandir('.');
$files=scandir(getcwd());
$exclude=['index.php', 'res', '.git'] ; 
# index starts at 2 because we ignore '.' (this dir) and '..' (parent dir)
for ($i=2; $i < count($files); $i++) {
	if ($files[$i] == "index.php" 
		or $files[$i] == "res" 
		or $files[$i] == ".git" 
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

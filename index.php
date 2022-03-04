<?php
include './res/res.php'; 
$title="Overview"; 
startit($title); 
###############
#
echo "
This is the body
";
echo "<ul>";
#$files=scandir('.');
$files=scandir(getcwd());
$exclude=['index.php', 'res', '.git'] ; 
# index starts at 2 because we ignore '.' (this dir) and '..' (parent dir)
for ($i=2; $i < count($files); $i++) {
	if ($files[$i] == $exclude[0] or $files[$i] == $exclude[1] or $files[$i] == $exlude[2] or $files[$i]=="tempdir") {
#		echo $i;
#		echo $files[$i];
		continue; 
	}
	echo "<li> <a href=\"./$files[$i]\">$files[$i]</a> </li>";
}
echo "</ul>";
#
###############
endit();
?>

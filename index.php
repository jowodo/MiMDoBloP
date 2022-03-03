<?php
include 'res/res.php'; 
$title="First Blog Post"; 
start($title); 
###############
#
echo "
This is the body
";
echo "<ul>";
$arrFiles=scandir('.');
# index starts at 2 because we ignore . and .. 
for ($i=2; $i < count($arrFiles); $i++) {
	if ($arrFiles[$i] == "index.php" or $arrFiles[$i] == "res" ) {
		continue; 
	}
	echo "<li> <a href=\"./$arrFiles[$i]\">$arrFiles[$i]</a> </li>";
}
echo "</ul>";
#
###############
endt();
?>

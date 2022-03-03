<?php
function start($title)
{
	echo "<html>";
	echo "<body>";
	echo "<h1>$title</h1>"; 
}

function endt()
{
	echo "</body>";
	echo "</html>";
}

function body($dir)
{
	
	echo "<article>";
#	echo "this is the body due\n";
#	echo "$dir"; 
	$body = shell_exec("/usr/bin/markdown $dir/index.md ") ; 
#	$body = file_get_contents("$dir/index.md");
	echo $body;
	echo "</article>";
}
?>

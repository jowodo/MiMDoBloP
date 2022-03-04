<?php function start($title)
{
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
	echo "	<base href=\".\" >";
	echo "	<meta charset=\"UTF-8\">";
	echo "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" >";
	echo "	<link href=\"../res/style.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "	<title>JohnsBlog - $title</title>";
	echo "</head>";
	echo "<body>";
	echo "	<header>";
	echo "<h1>$title</h1>"; 
	echo "	</header>";
}

function endt()
{
	echo "</body>";
	echo "</html>";
}

function body($dir)
{
	
	echo "<article>";
	$body = shell_exec("/usr/bin/markdown $dir/index.md ") ; 
	echo $body;
	echo "</article>";
}
?>

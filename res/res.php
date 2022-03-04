<?php 
$HOMEDIR="https://wlankabel.at/john/blog";
function startit($title)
{
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
	echo "	<base href=\".\" >";
	echo "	<meta charset=\"UTF-8\">";
	echo "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" >";
	echo "	<link href=\"../res/style.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "	<link href=\"./res/style.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "	<title>JohnsBlog - $title</title>";
	echo "</head>";
	echo "<body>";
	echo "	<header>";
	echo "<h1>$title</h1>"; 
	echo "	</header>";
	echo "<navigation>";
	echo "<table><tr><td><a href=\"https://wlankabel.at\" >WLANKABEL</a></td>"; 
	echo "<td><a href=\"$HOMEDIR\">BLOG-HOME</a></td></tr></table>"; 
	echo "</navigation>";
}

function doit($dir)
{
	
	echo "<article>";
	$body = shell_exec("/usr/bin/tail -n+3 $dir/index.md | /usr/bin/markdown ") ; 
	echo $body;
	echo "</article>";
}

function endit()
{
	echo "</body>";
	echo "</html>";
}

?>

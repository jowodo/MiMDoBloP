<?php 
$HOMEDIR="https://wlankabel.at/john/blog/";
function startit($title)
{
	GLOBAL $HOMEDIR;
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
#	echo "	<base href=\".\" >";
	echo "	<base href=\"$HOMEDIR\" >";
	echo "	<meta charset=\"UTF-8\">";
	echo "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" >";
	echo "	<link href=\"./res/style.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "	<title>JohnsBlog - $title</title>";
	echo "</head>";
	echo "<body>";
	echo "	<header>";
	echo "<h1>$title</h1>"; 
	echo "	</header>";
	echo "<navigation>";
	echo "<table><tr><td><a href=\"https://wlankabel.at\" >wlankabel</a></td>"; 
	echo "<td><a href=\"$HOMEDIR\">blog-home</a></td></tr></table>"; 
	echo "</navigation>";
}

function doit()
{
	$AUTHOR=shell_exec("ls -l ./index.md | awk '{print $3}'"); 
	$DIRNAME=shell_exec("basename `pwd`"); 
	$DATE=substr($DIRNAME,0,10);
	$MONTH_LASTCHANGE=shell_exec("ls -l ./index.md | awk '{print $6,$7}'");
	$LASTCHANGE=shell_exec("ls -l ./index.md | awk '{print $8}'"); 
	$YEAR=$LASTCHANGE;
	# if the file was edited this year this column is the time instead of year
	# and therefore the length of the var is 5(+1)
	if (strlen($LASTCHANGE) == 6){
		$YEAR=date('Y');
	}
	echo "created by $AUTHOR on $DATE - last changed on $YEAR $MONTH_LASTCHANGE";
	echo "<article>";
	$body = shell_exec("/usr/bin/tail -n+3 ./index.md | /usr/bin/markdown ") ; 
	echo $body;
	echo "</article>";
}

function endit()
{
	echo "</body>";
	echo "</html>";
}

?>

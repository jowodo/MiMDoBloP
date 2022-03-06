<?php 
$HOMEURL="https://wlankabel.at/john/blog/";
$HOMEPATH="/var/www/html/john/blog";

function startit($title)
{
	GLOBAL $HOMEURL;
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
	echo "	<base href=\"$HOMEURL\" >";
	echo "	<meta charset=\"UTF-8\">";
	echo "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" >";
	echo "	<link href=\"./res/style.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "	<title>JohnsBlog - $title</title>";
	echo "</head>";
	echo "<body>";
	echo "	<header>";
	echo "<h1>$title</h1>"; 
	echo "	</header>";
	navi();

}
function navi()
{
	GLOBAL $HOMEURL;
	$PAGES=get_pages();
	$THISDIR=shell_exec("basename `pwd` "); 
	# cut last character ("\n")
	$THISDIR=substr($THISDIR,0,-1);
	$CURRENTPAGENUMBER=array_search($THISDIR,$PAGES);
	echo "<navigation>";
	echo "<table><tr>";
	if ($CURRENTPAGENUMBER != 0 ) {
		$PRVPG=$PAGES[$CURRENTPAGENUMBER-1];
		$PREV=$HOMEURL.$PRVPG;
		echo "<td><a href=\"$PREV\"> &lt; prev </a></td>"; 
	}
	echo "<td><a href=\"$HOMEURL\"> home </a></td>"; 
	if ($CURRENTPAGENUMBER != count($PAGES)-1){
		$NXTPG=$PAGES[$CURRENTPAGENUMBER+1];
		$NEXT=$HOMEURL.$NXTPG;
		echo "<td><a href=$NEXT > next &gt; </a></td>"; 
	}
	echo "</tr></table>"; 
	echo "</navigation>";
}

function get_pages()
{
	GLOBAL $HOMEPATH;
	$PAGES=scandir($HOMEPATH);
	$excludes=['index.php', 'res', '.git', '.htaccess', '.', '..'];
	$Npages=count($PAGES);
	foreach ($excludes as $exclude)
	{
		unset( $PAGES[array_search($exclude,$PAGES)] );
	}
	$PAGES=array_values($PAGES);
//	print_r($PAGES); echo "<br>";
	return $PAGES;
}


function doit()
{
	created();
	echo "<article>";
	$body = shell_exec("/usr/bin/tail -n+3 ./index.md | /usr/bin/markdown ") ; 
	echo $body;
	echo "</article>";
}

function created()
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
}

function endit()
{
	echo "</body>";
	echo "</html>";
}

?>

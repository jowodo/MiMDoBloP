<?php 
include substr(strval(__FILE__),0,-7)."config.php";
#echo __FILE__;

function startit($title)
{
	GLOBAL $HOMEURL;
	GLOBAL $PAGENAME;
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
	echo "	<base href=\"$HOMEURL\" >";
	echo "	<meta charset=\"UTF-8\">";
	echo "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" >";
	echo "	<link href=\"./res/style.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "	<title>$PAGENAME - $title</title>";
	echo "</head>";
	echo "<body>";
	echo "	<header>";
	echo "<h1>$title</h1>"; 
	echo "	</header>";
	navigation();

}
function navigation()
{
	GLOBAL $HOMEURL;
	GLOBAL $HOMEPATH;
	$PAGES=get_pages();
	$THISDIR=shell_exec("basename `pwd` "); 
// get parent directory (date)
	$DATE=shell_exec("basename `readlink -f ..`");
// cut last character ("\n")
	$DATE=substr($DATE,0,-1);
	$THISDIR="$DATE"."/"."$THISDIR";
// cut last character ("\n")
	$THISDIR=substr($THISDIR,0,-1);
	$CURRENTPAGENUMBER=array_search($THISDIR,$PAGES);
// PHP predifined array_search doesnt work ...? so reimplemented
	$CURRENTPAGENUMBER=get_position($PAGES,$THISDIR);
	echo "<navigation>";
	echo "<table><tr>";
// if  not first article show prev button
	if ($CURRENTPAGENUMBER != 0 ) {
		$PRVPG=$PAGES[$CURRENTPAGENUMBER-1];
		$PREV=$HOMEURL.$PRVPG;
		echo "<td><a href=\"$PREV\"> &lt; prev </a></td>"; 
	}
	echo "<td><a href=\"$HOMEURL\"> home </a></td>"; 
// if not last article, show next button
	if ($CURRENTPAGENUMBER != count($PAGES)-1){
		$NXTPG=$PAGES[$CURRENTPAGENUMBER+1];
		$NEXT=$HOMEURL.$NXTPG;
		$HOMEPATHDIR=shell_exec("basename $HOMEPATH");
// cut last character ("\n")
		$HOMEPATHDIR=substr($HOMEPATHDIR,0,-1);
// next buttom show to first article 
			if ( $THISDIR == $HOMEPATHDIR ) {
				$NXTPG=$PAGES[0];
				$NEXT=$HOMEURL.$NXTPG;
			} 
		echo "<td><a href=$NEXT > next &gt; </a></td>"; 
	}
	echo "</tr></table>"; 
	echo "</navigation>";
}

function get_position($array, $value)
{
	$i=0;
	foreach ( $array as $array_value ) { 
		if ($value == $array[$i]) {
			return $i;
		}
		$i++;
	}
	return NULL;
}


function get_pages()
{
	GLOBAL $HOMEPATH;
	GLOBAL $EXCLUDES;
	$PAGES=scandir($HOMEPATH);
//	$EXCLUDES=['index.php', 'res', '.git', '.htaccess', '.', '..'];
//	$Npages=count($PAGES);
	foreach ($EXCLUDES as $exclude)
	{
		unset( $PAGES[array_search($exclude,$PAGES)] );
	}
	# MAKE CONTINUOUS INDEX 
	$PAGES=array_values($PAGES);
//	print_r($PAGES); echo "<br>";
//
	$DATES=$PAGES;
	$REALPAGES = new ArrayObject(array());
	foreach ($DATES as $DATE)
	{
		$PAGES_PER_DATE=scandir($HOMEPATH."/".$DATE);
#		print_r($PAGES_PER_DATE); echo "<br>";
		foreach ($PAGES_PER_DATE as $BLOGPOST)
		{
			if ( $BLOGPOST != "." && $BLOGPOST != "..") 
			{
#				echo "$BLOGPOST"."<br>";
#				echo $HOMEPATH."/".$DATE."/".$BLOGPOST;
				if ( in_array("index.php", scandir($HOMEPATH."/".$DATE."/".$BLOGPOST) ) )
				{		
					$REALPAGES->append("$DATE"."/"."$BLOGPOST");
				}
			}
		}
	}
#	print_r($REALPAGES);
	$PAGES=$REALPAGES;
//
	return $PAGES;
}


function make_article()
{
	GLOBAL $MD_EXECUTABLE;
	show_creation_date();
	echo "<article>";
	$body = shell_exec("/usr/bin/tail -n+3 ./index.md | "."$MD_EXECUTABLE"." ") ; 
	echo $body;
	echo "</article>";
}

function show_creation_date()
{
	$AUTHOR=shell_exec("ls -l ./index.md | awk '{print $3}'"); 
	$DATE=shell_exec("basename `readlink -f ..`");
	$LASTCHANGE=shell_exec("ls --full-time ./index.md | awk '{print $6}'");
	echo "created by $AUTHOR on $DATE - last changed on $LASTCHANGE";
}

function endit()
{
	echo "</body>";
	echo "</html>";
}

?>

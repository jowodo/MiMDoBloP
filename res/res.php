<?php 
include substr(strval(__FILE__),0,-7)."config.php";
#echo __FILE__;
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

function startit($title)
{
	GLOBAL $HOMEURL;
	GLOBAL $PAGENAME;
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
	echo "	<base href=\"$HOMEURL/\" >";
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

function get_date()
{
	$DAY=substr( shell_exec("basename `readlink -f ..`"), 0,-1);
	$MONTH=substr( shell_exec("basename `readlink -f ../..`"), 0,-1);
	$YEAR=substr( shell_exec("basename `readlink -f ../../..`"), 0,-1);
	$DATE="$YEAR/$MONTH/$DAY";
	return $DATE;
}

function get_name()
{
	$DIRNAME=shell_exec("basename \"`pwd`\" ");
#	cut trailing ?space? 
	$NAME=substr($DIRNAME, 0,-1);
	return $NAME;
}

function navigation()
{
	/*
	 * CREATE NAVIGATION BUTTONS
	 */
	GLOBAL $HOMEURL;
	GLOBAL $HOMEPATH;
	GLOBAL $REVERSE_CHRON;
	$PAGES=get_pages();
	$THISDIR=get_name();
	$DATE=get_date();
	$THISDIR="$DATE/$THISDIR";
	$CURRENTPAGENUMBER=array_search($THISDIR,$PAGES);
// PHP predifined array_search doesnt work ...? so reimplemented
	$CURRENTPAGENUMBER=get_position($PAGES,$THISDIR);
	echo "<navigation>";
	echo "<table><tr>";
// PREV BUTTON
	if (false){ 
		echo " ";
	} else {
		### if  not first article show prev button
		if ($CURRENTPAGENUMBER != 0 ) {
			$PRVPG=$PAGES[$CURRENTPAGENUMBER-1];
			$PREV="$HOMEURL/$PRVPG";
			echo "<td><a href=\"$PREV\"> &lt; prev </a></td>"; 
		}
		### HOME BUTTON
		echo "<td><a href=\"$HOMEURL\"> home </a></td>"; 
		### NEXT BUTTON
		### if not the last page
		if ($CURRENTPAGENUMBER != count($PAGES)-1){
			$NXTPG=$PAGES[$CURRENTPAGENUMBER+1];
			$HOMEPATHDIR=shell_exec("basename $HOMEPATH");
			### cut last character ("\n")
			$HOMEPATHDIR=substr($HOMEPATHDIR,0,-1);
			### next button show to first article 
			if ($CURRENTPAGENUMBER === NULL ){
					$NXTPG=$PAGES[0];
			} 
			$NEXT="$HOMEURL/$NXTPG";
			echo "<td><a href=\"$NEXT\"> next &gt; </a></td>"; 
		}
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

function exclude_from_array($orig_array, $excludes)
{
	foreach ($excludes as $exclude)
	{
		unset( $orig_array[array_search($exclude,$orig_array)] );
	}
	# MAKE CONTINUOUS INDEX 
	$new_array=array_values($orig_array);
	return $new_array;
}

function get_pages()
{
	GLOBAL $HOMEPATH;
	GLOBAL $EXCLUDES;
	GLOBAL $REVERSE_CHRON;
	$YEARS=exclude_from_array(scandir($HOMEPATH),$EXCLUDES);
	$REALPAGES = new ArrayObject(array());
	#$REALPAGES = array();
	foreach ($YEARS as $YEAR)
	{
		$MONTHS_PER_YEAR=exclude_from_array(scandir("$HOMEPATH/$YEAR"), [".",".."]);
		foreach ($MONTHS_PER_YEAR as $MONTH)
		{
			$DAYS_PER_MONTH=exclude_from_array(scandir("$HOMEPATH/$YEAR/$MONTH"), [".",".."]);
			foreach ($DAYS_PER_MONTH as $DAY)
			{
				$PAGES_PER_DAY=exclude_from_array(scandir("$HOMEPATH/$YEAR/$MONTH/$DAY"), [".",".."]);
				foreach ($PAGES_PER_DAY as $BLOGPOST)
				{
					if ( in_array("index.php", scandir("$HOMEPATH/$YEAR/$MONTH/$DAY/$BLOGPOST") ) )
					{		
						$REALPAGES->append("$YEAR/$MONTH/$DAY/$BLOGPOST");
					}
				}
			}
		}
	}
	### REVERSE ARRAY
	if ($REVERSE_CHRON)
		$REALPAGES->uksort('compare');
		$REALPAGES=array_values( (array) $REALPAGES);
#	print_r($REALPAGES);
	return (array) $REALPAGES;
}

function compare($a,$b)
{
	return $b-$a;
}


function make_article()
{
	GLOBAL $MD_EXECUTABLE;
	echo show_creation_date();
	echo "<article>";
	$body = shell_exec("/usr/bin/tail -n+3 ./index.md | "."$MD_EXECUTABLE"." ") ; 
	echo $body;
	echo "</article>";
}

function show_creation_date()
{
	$AUTHOR=shell_exec("ls -l ./index.md | awk '{print $3}'"); 
	$DATE=shell_exec("basename `readlink -f ..`");
	$DATE=get_date();
	$LASTCHANGE=shell_exec("ls --full-time ./index.md | awk '{print $6}' | tr - / ");
	return  "created by $AUTHOR on $DATE - last changed on $LASTCHANGE";
}

function endit()
{
	echo "</body>";
	echo "</html>";
}

?>

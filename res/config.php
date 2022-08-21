<?php
$MD_EXECUTABLE="/usr/local/bin/markdown";		# executable which parses markdown into html 
$HOMEURL="https://blog.wlankabel.at";			# 
$HOMEPATH="/var/www/html/blog";					# path to the blog's base directory
$PAGENAME="Mimdoblop";							# 
$EXCLUDES=['index.php', 'res', '.git', '.htaccess', '.', '..', '.note'];		# folders which will be ignored from the blog post listing
$REVERSE_CHRON=true;							# true for newest post on top, false for oldest post on top 
$ESTIMATE_READING_TIME=true;					# true to show estimated reading time at top of posts
$WORDSPERMINUTE=100;							# will be used to estimate reading time
?>

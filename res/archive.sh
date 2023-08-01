#!/bin/bash 

# TEST IF ARGUMENT COUNT IS CORRECT
print_usage(){
	echo "USAGE:"
	echo "  $0 <article name>"
	exit 0
}
test $# -ne 1 && echo "too many arguments" && print_usage

# FIND ARTICLE 
found_articles=$(find . -path ./archive -prune -o -type d -name "*$1*" -print )
#count=$(find . -type d -name "*africa*" | wc -l)
## IF MORE THAN ONE FOUND, LET USER CHOOSE
#if [ $count -gt 1 ] ; then 
	i=1
	echo "[0] abort"
	for article in $found_articles
	do
		echo "[$i]  $article"
		i=$(($i+1))
	done
	read choice 
	test $choice -eq 0 && echo "exiting ..." && exit 
	articles_array=($found_articles)
	article=${articles_array[$choice]}
#else 
#	article=$found_articles
#fi

# FROM ARTICLE GET PATH 
dirpath=$(dirname $article)
# CREATE PATH IN ARCHIVE DIR
mkdir -vp archive/$dirpath
# MOVE ARTICLE FOLDER TO ARCHIVE
mv $article $dirpath






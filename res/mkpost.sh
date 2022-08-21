#!/bin/bash 

if [ $# -eq 0 ] ; then 
	echo -e "\nUSAGE:\t$0 [blog-post-title]\n"
	exit
fi

sluggify()
{
	# from https://blog.codeselfstudy.com/blog/how-to-slugify-strings-in-bash/
	echo "$@" | sed -e "s/ /-/g" -e "s/[^[:alnum:]-]//g" | tr -s "-" | tr A-Z a-z
}
NAME=$(sluggify $@)
VERBOSE=0
DATESTRING="%Y/%m/%d"

if [ ${VERBOSE} -gt 0 ] 
then
	VFLAG="-v"
fi

[ $(basename `pwd`) == res ] && cd .. 
DIRNAME="$(date +$DATESTRING)/${NAME}"
mkdir -p ${VFLAG} "${DIRNAME}"
cd "${DIRNAME}"
ln ${VFLAG} -s ../../../../res/index.php . 
echo $@ > index.md
echo "=========" >> index.md 

echo "to edit your freshly created post do:"
echo "cd ${DIRNAME} && vim index.md"


#!/bin/bash 

NAME=$1
VERBOSE=0

if [ ${VERBOSE} -gt 0 ] 
then
	VFLAG="-v"
fi

DIRNAME=$(date +"%Y-%m-%d")-${NAME}
mkdir ${VFLAG} ${DIRNAME}
cd ${DIRNAME}
ln ${VFLAG} -s ../res/index.php . 
echo $1 > index.md
echo "=========" >> index.md 

echo "to edit your freshly created post do:"
echo "cd ${DIRNAME} && vim index.md"


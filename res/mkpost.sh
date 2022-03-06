#!/bin/bash 

NAME=$1

DIRNAME=$(date +"%Y-%m-%d")-${NAME}
mkdir -v ${DIRNAME}
cd ${DIRNAME}
ln -sv ../res/index.php . 
echo "FILE: index.md"
echo $1 | tee index.md
echo "=========" | tee -a index.md 


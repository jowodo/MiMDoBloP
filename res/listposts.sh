#!/bin/bash 
echo ""

ls */*/*/* | grep ":" | grep -v archive | sed "s/://"
if [ "$1" == "-a" ] 
then 
	ls archive/*/*/*/* | grep ":" | sed "s/://"
fi


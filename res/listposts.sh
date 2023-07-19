#!/bin/bash 
echo ""

ls */*/*/* | grep ":" | grep -v archive | sed "s/://"
ls archive/*/*/*/* | grep ":" | sed "s/://"


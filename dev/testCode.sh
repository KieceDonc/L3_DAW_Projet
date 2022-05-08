#!/bin/bash

USER="dev"

if [ "$#" -eq 1 ]; then
   USER=$1
fi


rsync -rvc --delete --exclude quizxml --exclude compteur.txt ../* $USER@daw.privatedns.org:/var/www/html/
echo '----------'
echo ''
echo '   done'
echo ''
echo '----------'

# https://unix.stackexchange.com/a/351112
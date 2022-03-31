#!/bin/bash

USER="dev"

if [ "$#" -eq 1 ]; then
   USER=$1
fi
ssh -t $USER@daw.privatedns.org "cd /var/www/html/dev/ && sudo git stash push --include-untracked && sudo git pull origin prod"
echo '----------'
echo ''
echo '   done'
echo ''
echo '----------'

# https://unix.stackexchange.com/a/351112
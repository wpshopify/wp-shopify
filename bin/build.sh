#! /bin/bash

#
# Exit on error
#
set -o errexit

#
# Setting up our variables ...
#
PLUGINS_FOLDER="/Users/andrew/www/wpstest/public/wp-content/plugins/"
PLUGIN_PATH="/Users/andrew/www/wpstest/public/wp-content/plugins/wp-shopify-pro/"
BUILD_FOLDER="/Users/andrew/www/wpstest/assets/_build/wp-shopify-pro"

GREEN='\033[0;32m'
NC='\033[0m'
ENV='prod'

#
# Creating a temp _build folder
#
mkdir -p $BUILD_FOLDER
printf "${GREEN}Success: ${NC}Created build folder\n"

#
# Copy all the files and folders to our temp build folder
#
rsync -ar --exclude=node_modules --exclude=.happypack --exclude=stats.html --exclude=.git --exclude=.gitignore $PLUGIN_PATH $BUILD_FOLDER
printf "${GREEN}Success: ${NC}Copied plugin to build folder\n"

#
# Go into the build folder and .zip up all the files + folders
#
cd $BUILD_FOLDER
cd ..
zip -rq $BUILD_FOLDER/wpshopify.zip ./wp-shopify-pro
printf "${GREEN}Success: ${NC}Created .zip\n"

#
# Delete all files and folders inside _build except our new .zip
#
find $BUILD_FOLDER/* ! -name 'wpshopify.zip' -type f -exec rm -f {} +
find $BUILD_FOLDER/* ! -name 'wpshopify.zip' -type d -exec rm -rf {} +
printf "${GREEN}Success: ${NC}Isolated .zip\n"

#
# Copy new .zip to server
#
scp $BUILD_FOLDER/wpshopify.zip arobbins@162.243.170.76:~
ssh -t arobbins@162.243.170.76 "sudo rm /var/www/$ENV/html/live/latest/wpshopify.zip && sudo mv wpshopify.zip /var/www/$ENV/html/live/latest/"
printf "${GREEN}Success: ${NC}Transfered new .zip to server\n"

#
# Remove temp build folder
#
cd $BUILD_FOLDER
cd ../../
rm -rf _build/
printf "${GREEN}Success: ${NC}Removed temp build folder\n"
printf "${GREEN}Done!\n"

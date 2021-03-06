#!/bin/bash

####################################################################
# script to deploy the webapp to a distant server via ssh and rsync.
# @author  nicolas malservet
# @version 1.0 
####################################################################

MUSER="root"
MURL="de519.ispfr.net"
MPATH="/var/www/vhosts/de519.ispfr.net/SIP"

#echo "delete local cache files"
#rm -Rf ./assets/*


echo "sync sources files"
rsync --exclude '/CommonProperties.php' --exclude '/protected/runtime' -avz -e 'ssh'  $MUSER@$MURL:$MPATH ./

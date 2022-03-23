#!/bin/bash
if [ -z "${1}"]
then
echo "Profile name is empty"
else
echo "Delete profile"
read CLIENT_PUBLIC_KEY <keys/${1}_pub.key
WWW_DIR="/home/${USERNAME}/wguard/www/public/profiles"
rm keys/${1}_pub.key
rm keys/${1}_priv.key
rm $WWW_DIR/${1}.conf

sudo wg set wg0 peer $CLIENT_PUBLIC_KEY remove
sudo wg-quick down wg0
sudo wg-quick up wg0
fi

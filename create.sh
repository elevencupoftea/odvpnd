#!/bin/bash

if [ -z "${1}"]
then
echo "Profile name is empty"
else
echo "Create new client keys"
./gen_key.sh ${1}

echo "Create Config file"
#SETTINGS
IP='i'
IP_FULL=$IP${2}
SERVER_IP='s'
SERVER_PORT=51820
DNS_1=$IP'1'
DNS_2='9.9.9.9'
USERNAME='u'
WG_DIR='d'
WWW_DIR="/home/${USERNAME}/wguard/www/public/profiles"
read CLIENT_PRIVATE_KEY <keys/${1}_priv.key
read SERVER_PUBLIC_KEY <keys/server_pub.key
read CLIENT_PUBLIC_KEY <keys/${1}_pub.key

echo "
[Interface]
PrivateKey = ${CLIENT_PRIVATE_KEY}
Address = ${IP_FULL}
DNS = ${DNS_1}, ${DNS_2}
MTU = 1412
[Peer]
PublicKey = ${SERVER_PUBLIC_KEY}
AllowedIPs = 0.0.0.0/0, ::/0
Endpoint = ${SERVER_IP}:${SERVER_PORT}
PersistentKeepalive=25
" > $WWW_DIR/${1}.conf

echo "Restart wg"
sudo wg set wg0 peer $CLIENT_PUBLIC_KEY allowed-ips $IP_FULL/32
sudo wg-quick down wg0
sudo wg-quick up wg0
#sudo bandwidth.sh
fi

#!/bin/bash
wg genkey | tee keys/${1}_priv.key | wg pubkey > keys/${1}_pub.key

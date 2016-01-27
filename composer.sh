#!/usr/bin/env bash
# Enable swap, run composer update, disable swap. That's it.
set +x
if [ ! -f /swapfile ]; then
    sudo fallocate -l 4G /swapfile
    sudo chmod 600 /swapfile
    sudo mkswap /swapfile
fi

sudo swapon /swapfile
COMPOSER_PROCESS_TIMEOUT=2000 composer "${@:1}"
sudo swapoff /swapfile

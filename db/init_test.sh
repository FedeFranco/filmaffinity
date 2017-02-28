#!/bin/sh

sudo -u postgres dropdb filma_test
sudo -u postgres createdb -O filma filma_test

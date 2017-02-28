#!/bin/sh

#sudo -u postgres dropuser filma
#sudo -u postgres dropdb filma
sudo -u postgres psql -c "create user filma password 'filma' superuser;"
sudo -u postgres createdb -O filma filma

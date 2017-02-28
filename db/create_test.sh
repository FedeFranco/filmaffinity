#!/bin/sh

SCRIPT=$(readlink -f "$0")
DIR=$(dirname "$SCRIPT")
psql -U filma filma_test < $DIR/filma.sql

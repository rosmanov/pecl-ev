#!/bin/bash -
set -e
phpize --clean && phpize
#aclocal && libtoolize --force && autoreconf
./configure --enable-ev --enable-ev-debug "$@"
make clean
make

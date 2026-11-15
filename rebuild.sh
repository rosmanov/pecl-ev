#!/bin/bash -
set -e
phpize --clean && phpize
#aclocal && libtoolize --force && autoreconf
# EV_DEBUG=no builds without --enable-ev-debug (libev assertions compiled out)
ev_debug_flag=--enable-ev-debug
if [ "${EV_DEBUG:-yes}" = no ]; then
    ev_debug_flag=
fi
./configure --enable-ev $ev_debug_flag "$@"
make clean

# Run make via bear locally to rebuild the compile_commands.json file
# for IDEs (e.g., Neovim with the ccls LSP)
if command -v bear >/dev/null 2>&1; then
    bear -- make
else
    make
fi

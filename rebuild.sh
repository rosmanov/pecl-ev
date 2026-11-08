#!/bin/bash -
set -e
phpize --clean && phpize
#aclocal && libtoolize --force && autoreconf
./configure --enable-ev --enable-ev-debug "$@"
make clean

# Run make via bear locally to rebuild the compile_commands.json file
# for IDEs (e.g., Neovim with the ccls LSP)
if command -v bear >/dev/null 2>&1; then
    bear -- make
else
    make
fi

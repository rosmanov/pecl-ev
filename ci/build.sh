#!/bin/sh

set -eux

case "${SANITIZER:-none}" in
    none)
        ;;
    asan)
        export CFLAGS="${CFLAGS:-} -fsanitize=address -fno-omit-frame-pointer -g -O0"
        export LDFLAGS="${LDFLAGS:-} -fsanitize=address"
        ;;
    *)
        echo "Unknown sanitizer: ${SANITIZER}" >&2
        exit 1
        ;;
esac

# Release build by default; EV_DEBUG=yes enables --enable-ev-debug
export EV_DEBUG="${EV_DEBUG:-no}"
./rebuild.sh

make install

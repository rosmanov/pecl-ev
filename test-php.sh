#!/bin/sh -
# Can be used to run tests when `make test` fails because of the extension loading order issues.
# E.g.: TEST_PHP_EXECUTABLE="$(pwd)/run-tests.sh" php run-tests.php

dir=$(cd $(dirname "$0"); pwd)
local_libs_dir="${dir}/.libs"

sockets_option=''
if ! php -m | grep -q sockets; then
    sockets_so_path="$(php-config --extension-dir)/sockets.so"
    if test -e "$sockets_so_path"; then
        cp "$sockets_so_path" "$local_libs_dir"
        sockets_option='-dextension=sockets.so'
    fi
fi

posix_option=''
if ! php -m | grep -q posix; then
    posix_so_path="$(php-config --extension-dir)/posix.so"
    if test -e "$posix_so_path"; then
        cp "$posix_so_path" "$local_libs_dir"
        posix_option='-dextension=posix.so'
    fi
fi

if [ "${SANITIZER:-none}" = "asan" ]; then
    libasan="$(gcc -print-file-name=libasan.so)"

    exec env \
        LD_PRELOAD="$libasan" \
        ASAN_OPTIONS="${ASAN_OPTIONS:-detect_leaks=0:abort_on_error=1}" \
        php -n $sockets_option $posix_option -dextension=ev.so -dextension_dir="${local_libs_dir}" "$@"
else
    exec php -n $sockets_option $posix_option -dextension=ev.so -dextension_dir="${local_libs_dir}" "$@"
fi

#!/bin/sh -
# Can be used to run tests when `make test` fails because of the extension loading order issues.
# E.g.: TEST_PHP_EXECUTABLE="$(pwd)/run-tests.sh" php run-tests.php

dir=$(cd $(dirname "$0"); pwd)
local_libs_dir="${dir}/.libs"

# `php -n` ignores the ini files, so load the optional extensions explicitly (sockets goes first).
ext_options=''
for ext in pcntl posix sockets; do
    ext_so_path="$(php-config --extension-dir)/${ext}.so"
    # Skip the extensions compiled into PHP
    if ! php -n -m | grep -qx "$ext" && [ -f "$ext_so_path" ]; then
        # Parallel test workers run this script concurrently: a plain cp truncates the file
        # another worker may be loading (segfault), so copy once and rename atomically.
        if [ ! -f "${local_libs_dir}/${ext}.so" ]; then
            cp "$ext_so_path" "${local_libs_dir}/${ext}.so.$$"
            mv -f "${local_libs_dir}/${ext}.so.$$" "${local_libs_dir}/${ext}.so"
        fi
        ext_options="-dextension=${ext}.so ${ext_options}"
    fi
done

if [ "${SANITIZER:-none}" = "asan" ]; then
    libasan="$(gcc -print-file-name=libasan.so)"

    exec env \
        LD_PRELOAD="$libasan" \
        ASAN_OPTIONS="${ASAN_OPTIONS:-detect_leaks=0:abort_on_error=1}" \
        php -n $ext_options -dextension=ev.so -dextension_dir="${local_libs_dir}" "$@"
else
    exec php -n $ext_options -dextension=ev.so -dextension_dir="${local_libs_dir}" "$@"
fi

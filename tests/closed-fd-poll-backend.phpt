--TEST--
Release build (-DNDEBUG) must warn when closing a watched fd under the poll backend (libev assertions compiled out)
--SKIPIF--
<?php
// Release builds only: with --enable-ev-debug (or a PHP debug build) NDEBUG is not defined, so libev's
// assert() aborts the process before fd_kill() can feed EV_ERROR to the watcher.
if (!(Ev::supportedBackends() & Ev::BACKEND_POLL)) die('skip poll backend unavailable');
?>
--FILE--
<?php
$loop = new EvLoop(Ev::BACKEND_POLL);
var_dump($loop->backend === Ev::BACKEND_POLL);

[$a, $b] = stream_socket_pair(STREAM_PF_UNIX, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
$watcher = $loop->io($a, Ev::READ, static function (): void {
    echo "callback\n";
});
$loop->run(Ev::RUN_NOWAIT);

// poll() reports POLLNVAL for the closed descriptor: libev's assertion used to abort the process here. Now libev
// stops the watcher, and its error is reported as a warning.
fclose($a);
$loop->run(Ev::RUN_NOWAIT);
var_dump($watcher->is_active);
echo "done\n";
?>
--EXPECTF--
bool(true)

Warning: EvLoop::run(): Libev error(%d): %s in %s on line %d
bool(false)
done

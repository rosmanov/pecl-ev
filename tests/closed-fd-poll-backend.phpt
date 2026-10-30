--TEST--
A watched descriptor closed under the poll backend stops its watcher with an error instead of aborting
--SKIPIF--
<?php
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

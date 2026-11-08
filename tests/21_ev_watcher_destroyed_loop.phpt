--TEST--
Watcher methods tolerate a destroyed parent loop
--FILE--
<?php
$loop = new EvLoop();
$timer = $loop->timer(1, 1, function () {});
$periodic = $loop->periodic(0, 1, null, function () {});
$io = $loop->io(STDIN, Ev::READ, function () {});
$timer->keepalive(false);
unset($loop);

var_dump($timer->getLoop());
var_dump($periodic->getLoop());
$timer->again();
$periodic->again();
var_dump($timer->remaining);
var_dump($io->clear());
$io->invoke(Ev::READ);
$io->feed(Ev::READ);
$timer->keepalive(true);
$timer->keepalive(false);
$timer->start();
$timer->stop();
echo "ok\n";
?>
--EXPECT--
NULL
NULL
float(0)
int(0)
ok

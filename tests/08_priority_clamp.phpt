--TEST--
Watcher priority is clamped before the watcher is started
--FILE--
<?php
$w = EvIo::createStopped(STDIN, Ev::READ, function () {}, null, 1000000);
var_dump($w->priority);
$w->feed(Ev::READ);
$w->priority = 0; // pending: warning, the priority is kept
$w->stop();

$w2 = EvTimer::createStopped(1, 0, function () {}, null, -1000000);
var_dump($w2->priority);
$w2->feed(Ev::TIMER);
$w3 = EvTimer::createStopped(1, 0, function () {});
$w3->priority = 1000000;
var_dump($w3->priority);
?>
--EXPECTF--
int(2)

Warning: %s: Can't set priority: the watcher is pending in %s on line %d
int(-2)
int(2)

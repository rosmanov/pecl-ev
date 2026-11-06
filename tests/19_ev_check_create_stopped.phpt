--TEST--
EvCheck::createStopped() works with the default loop and with a custom one
--FILE--
<?php
$w = EvCheck::createStopped(function () {});
var_dump($w instanceof EvCheck, $w->is_active);
$w->start();
var_dump($w->is_active);

$loop = new EvLoop();
$w2 = $loop->check(function () {});
var_dump($w2 instanceof EvCheck, $w2->is_active);

$w3 = new EvCheck(function () {});
var_dump($w3->is_active);
?>
--EXPECT--
bool(true)
bool(false)
bool(true)
bool(true)
bool(true)
bool(true)

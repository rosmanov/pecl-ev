--TEST--
EvSignal::set() accepts a valid signal number
--FILE--
<?php
$w = new EvSignal(2, static function (): void {});
$w->set(15);
var_dump($w->signum);
?>
--EXPECT--
int(15)

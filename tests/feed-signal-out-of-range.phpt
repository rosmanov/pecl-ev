--TEST--
Ev::feedSignal() rejects a signal number out of range, which libev would use as an index
--FILE--
<?php
Ev::feedSignal(100000);
echo "not reached\n";
?>
--EXPECTF--
Fatal error: Ev::feedSignal(): Invalid signal value in %s on line %d

--TEST--
Ev::feedSignalEvent() rejects out-of-range signal numbers
--FILE--
<?php
Ev::feedSignalEvent(2147483647);
?>
--EXPECTF--
Fatal error: %SInvalid signal value%s

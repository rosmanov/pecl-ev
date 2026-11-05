--TEST--
Ev::feedSignal() rejects out-of-range signal numbers
--FILE--
<?php
Ev::feedSignal(0);
?>
--EXPECTF--
Fatal error: %SInvalid signal value%s

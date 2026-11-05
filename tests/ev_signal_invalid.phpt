--TEST--
EvSignal constructor rejects out-of-range signal numbers
--FILE--
<?php
new EvSignal(0, function () {});
?>
--EXPECTF--
Fatal error: %SInvalid signal value%s

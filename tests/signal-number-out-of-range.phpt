--TEST--
EvSignal rejects a signal number out of range, which libev would use as an index
--FILE--
<?php
new EvSignal(100000, static function (): void {});
echo "not reached\n";
?>
--EXPECTF--
Fatal error: EvSignal::__construct(): Invalid signal value in %s on line %d

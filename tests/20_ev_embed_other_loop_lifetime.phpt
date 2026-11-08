--TEST--
EvEmbed keeps the embedded loop alive
--SKIPIF--
<?php
if (!(Ev::embeddableBackends() & Ev::recommendedBackends())) die("skip no embeddable backend");
?>
--FILE--
<?php
$loop = new EvLoop();
if (!($loop->backend & Ev::embeddableBackends())) {
    $loop = new EvLoop(Ev::embeddableBackends() & -Ev::embeddableBackends());
}
$w = new EvEmbed($loop, function () {});
unset($loop);

$w->sweep();
$w->stop();
$w->sweep();
$w2 = EvEmbed::createStopped($w->other, function () {});
$w->set($w2->other);
$w->sweep();
echo "ok\n";
?>
--EXPECT--
ok

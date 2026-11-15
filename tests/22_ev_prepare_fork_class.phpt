--TEST--
EvPrepare and EvFork factories create objects of their own class
--FILE--
<?php
$loop = new EvLoop();
foreach ([
    EvPrepare::createStopped(function () {}),
    $loop->prepare(function () {}),
    EvFork::createStopped(function () {}),
    $loop->fork(function () {}),
] as $w) {
    echo get_class($w), ': ', implode(',', array_keys((array)$w)), "\n";
    echo json_encode($w), "\n";
}
?>
--EXPECT--
EvPrepare: is_active,data,is_pending,priority
{"is_active":false,"data":null,"is_pending":false,"priority":0}
EvPrepare: is_active,data,is_pending,priority
{"is_active":true,"data":null,"is_pending":false,"priority":0}
EvFork: is_active,data,is_pending,priority
{"is_active":false,"data":null,"is_pending":false,"priority":0}
EvFork: is_active,data,is_pending,priority
{"is_active":true,"data":null,"is_pending":false,"priority":0}

<?php
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add(
    'Doctrine\Tests',
    array(
        __DIR__ . '/../vendor/doctrine/common/tests',
        __DIR__ . '/../vendor/doctrine/dbal/tests'
    )
);
$loader->add(
    'Ajgl',
    array(
        __DIR__ . '/Ajgl'
    )
);

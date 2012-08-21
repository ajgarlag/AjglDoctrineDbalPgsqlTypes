<?php
PHPUnitBootstrap::setUp();

/**
 * Class to bootstrap the tests
 */
abstract class PHPUnitBootstrap
{
    protected static $initialized = false;

    protected static function init()
    {
        if (!self::$initialized) {
            require_once 'PHPUnit/Autoload.php';
            /* @var $loader \Composer\Autoload\ClassLoader */
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
                    __DIR__ . '/src',
                    __DIR__ . '/../src'
                )
            );
        }
        self::$initialized = true;
    }

    /**
     * Set up the bootstrap
     */
    public static function setUp()
    {
        self::init();
    }
}

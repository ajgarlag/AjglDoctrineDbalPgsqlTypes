<?php
namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class InetType extends StringType
{
    const INET = 'inet';

    protected $sqlDeclaration = 'INET';

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "{$this->sqlDeclaration}";
    }

    public function getName()
    {
        return self::INET;
    }
}

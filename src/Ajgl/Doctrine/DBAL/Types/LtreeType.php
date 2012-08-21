<?php
namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class LtreeType extends StringType
{
    const LTREE = 'ltree';

    protected $sqlDeclaration = 'LTREE';

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "{$this->sqlDeclaration}";
    }

    public function getName()
    {
        return self::LTREE;
    }
}

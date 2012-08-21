<?php
namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class IssnType extends StringType
{
    const ISSN = 'issn';

    protected $sqlDeclaration = 'ISSN';

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "{$this->sqlDeclaration}";
    }

    public function getName()
    {
        return self::ISSN;
    }
}

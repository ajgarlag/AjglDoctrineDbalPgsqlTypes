<?php
namespace Ajgl\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Connection;

class IntegerArrayType extends Type
{
    const INTEGERARRAY = 'int[]';

    protected static $name = self::INTEGERARRAY;

    protected $sqlDeclaration = 'INTEGER';

    protected static $typeMapping = array(
        '_int',
        '_int4',
        '_integer'
    );

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $length = '';
        if (isset($fieldDeclaration['length'])) {
            $length = $fieldDeclaration['length'];
        }

        return "{$this->sqlDeclaration}[$length]";
    }

    public function canRequireSQLConversion()
    {
        return true;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = explode(',', substr($value, 1, -1));

        return array_map(function($v){return (integer) $v;}, $value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return '{' . implode(',', $value) . '}';
    }

    public function getName()
    {
        return static::$name;
    }

    public static function registerDoctrineTypeMapping(Connection $conn)
    {
        foreach (static::$typeMapping as $type) {
            $conn->getDatabasePlatform()->registerDoctrineTypeMapping($type, static::$name);
        }
    }
}

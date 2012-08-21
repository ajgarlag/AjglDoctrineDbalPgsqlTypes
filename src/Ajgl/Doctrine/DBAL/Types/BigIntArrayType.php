<?php
namespace Ajgl\Doctrine\DBAL\Types;

class BigIntArrayType extends IntegerArrayType
{
    const BIGINTARRAY = 'bigint[]';

    protected static $name = self::BIGINTARRAY;

    protected $sqlDeclaration = 'BIGINT';

    protected static $typeMapping = array(
        '_bigint',
        '_int8'
    );
}

<?php
namespace Ajgl\Doctrine\DBAL\Types;

class SmallIntArrayType extends IntegerArrayType
{
    const SMALLINTARRAY = 'smallint[]';

    protected static $name = self::SMALLINTARRAY;

    protected $sqlDeclaration = 'SMALLINT';

    protected static $typeMapping = array(
        '_smallint',
        '_int2'
    );
}

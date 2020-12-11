<?php
namespace Ajgl\Doctrine\DBAL\Types;

class BigIntArrayType extends ArrayTypeAbstract
{
    const BIGINTARRAY = 'bigint[]';

    protected $name = self::BIGINTARRAY;

    protected $innerTypeName = 'bigint';
}

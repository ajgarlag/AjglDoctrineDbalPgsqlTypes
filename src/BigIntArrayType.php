<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class BigIntArrayType extends ArrayTypeAbstract
{
    const BIGINTARRAY = 'bigint[]';

    protected $name = self::BIGINTARRAY;

    protected $innerTypeName = 'bigint';
}

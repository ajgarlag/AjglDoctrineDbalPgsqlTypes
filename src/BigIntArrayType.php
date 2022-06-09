<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class BigIntArrayType extends ArrayTypeAbstract
{
    const BIGINTARRAY = 'bigint[]';

    protected string $name = self::BIGINTARRAY;

    protected string $innerTypeName = 'bigint';
}

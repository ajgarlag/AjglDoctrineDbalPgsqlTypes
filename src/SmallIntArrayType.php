<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class SmallIntArrayType extends ArrayTypeAbstract
{
    const SMALLINTARRAY = 'smallint[]';

    protected string $name = self::SMALLINTARRAY;

    protected string $innerTypeName = 'smallint';
}

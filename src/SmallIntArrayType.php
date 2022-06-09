<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class SmallIntArrayType extends ArrayTypeAbstract
{
    const SMALLINTARRAY = 'smallint[]';

    protected $name = self::SMALLINTARRAY;

    protected $innerTypeName = 'smallint';
}

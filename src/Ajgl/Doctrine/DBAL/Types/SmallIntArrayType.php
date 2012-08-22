<?php
namespace Ajgl\Doctrine\DBAL\Types;

class SmallIntArrayType extends ArrayTypeAbstract
{
    const SMALLINTARRAY = 'smallint[]';

    protected $name = self::SMALLINTARRAY;

    protected $innerTypeName = 'smallint';
}

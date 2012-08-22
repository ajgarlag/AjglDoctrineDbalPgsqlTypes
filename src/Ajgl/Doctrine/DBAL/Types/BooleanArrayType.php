<?php
namespace Ajgl\Doctrine\DBAL\Types;

class BooleanArrayType extends ArrayTypeAbstract
{
    const BOOLEANARRAY = 'boolean[]';

    protected $name = self::BOOLEANARRAY;

    protected $innerTypeName = 'boolean';
}

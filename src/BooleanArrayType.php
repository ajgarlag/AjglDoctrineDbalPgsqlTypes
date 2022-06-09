<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class BooleanArrayType extends ArrayTypeAbstract
{
    const BOOLEANARRAY = 'boolean[]';

    protected $name = self::BOOLEANARRAY;

    protected $innerTypeName = 'boolean';
}

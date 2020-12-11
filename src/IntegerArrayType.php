<?php
namespace Ajgl\Doctrine\DBAL\Types;

class IntegerArrayType extends ArrayTypeAbstract
{
    const INTEGERARRAY = 'integer[]';

    protected $name = self::INTEGERARRAY;

    protected $innerTypeName = 'integer';
}

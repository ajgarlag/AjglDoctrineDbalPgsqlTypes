<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class IntegerArrayType extends ArrayTypeAbstract
{
    const INTEGERARRAY = 'integer[]';

    protected $name = self::INTEGERARRAY;

    protected $innerTypeName = 'integer';
}

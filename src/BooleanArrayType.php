<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class BooleanArrayType extends ArrayTypeAbstract
{
    const BOOLEANARRAY = 'boolean[]';

    protected string $name = self::BOOLEANARRAY;

    protected string $innerTypeName = 'boolean';
}

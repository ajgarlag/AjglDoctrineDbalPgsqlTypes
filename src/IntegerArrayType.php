<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class IntegerArrayType extends ArrayTypeAbstract
{
    const INTEGERARRAY = 'integer[]';

    protected string $name = self::INTEGERARRAY;

    protected string $innerTypeName = 'integer';
}

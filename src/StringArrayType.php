<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class StringArrayType extends ArrayTypeAbstract
{
    const STRINGARRAY = 'string[]';

    protected string $name = self::STRINGARRAY;

    protected string $innerTypeName = 'string';
}

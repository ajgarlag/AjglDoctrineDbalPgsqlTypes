<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class StringArrayType extends ArrayTypeAbstract
{
    const STRINGARRAY = 'string[]';

    protected $name = self::STRINGARRAY;

    protected $innerTypeName = 'string';
}

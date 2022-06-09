<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class TextArrayType extends ArrayTypeAbstract
{
    const TEXTARRAY = 'text[]';

    protected $name = self::TEXTARRAY;

    protected $innerTypeName = 'text';
}

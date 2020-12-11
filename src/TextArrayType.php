<?php
namespace Ajgl\Doctrine\DBAL\Types;

class TextArrayType extends ArrayTypeAbstract
{
    const TEXTARRAY = 'text[]';

    protected $name = self::TEXTARRAY;

    protected $innerTypeName = 'text';
}

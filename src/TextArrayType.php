<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class TextArrayType extends ArrayTypeAbstract
{
    const TEXTARRAY = 'text[]';

    protected string $name = self::TEXTARRAY;

    protected string $innerTypeName = 'text';
}

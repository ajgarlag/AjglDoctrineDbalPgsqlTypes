<?php
namespace Ajgl\Doctrine\DBAL\Types;

final class XmlArrayType extends ArrayTypeAbstract
{
    const XMLARRAY = 'xml[]';

    protected string $name = self::XMLARRAY;

    protected string $innerTypeName = 'xml';
}
